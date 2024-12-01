<?php

namespace App\Http\Controllers\Frontend;

use App\DataTables\ShipmentDataTable;
use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ShipmentDataTable $packageDataTable)
    {
        return $packageDataTable->render('pages.shipments.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $package = new Package();
        $package->package_count = 1;
        $package->type = "package";
        $package->unit = "imperial";

        return view('pages.packages.create', compact('package'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'packages_documents_only' => 'boolean',
            'name' => 'required',
            'package_count' => 'required|numeric|max:50',
            'type' => 'required|in:package,pack,letter',
            'unit' => 'required|in:imperial,metric',
            'packages.*.length' => 'required_if:type,package',
            'packages.*.width' => 'required_if:type,package|numeric',
            'packages.*.height' => 'required_if:type,package|numeric',
            'packages.*.weight' => 'required_if:type,package|numeric',
            'packages.*.description' => 'nullable',
        ]);

        $package = auth()->user()->packages()->create( $request->only(['name', 'package_count', 'type', 'unit', 'packages_documents_only']) );
        foreach ($request->post('packages') as $packageItem) {

            if (
                !empty($packageItem['length']) or !empty($packageItem['width']) or
                !empty($packageItem['height']) or !empty($packageItem['weight']) or
                !empty($packageItem['description'])
            ) {

                $package->items()->create($packageItem);
            }
        }

        return redirect()->route('packages.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Package $package)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Package $package)
    {
        return view('pages.packages.edit', compact('package'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Package $package)
    {
        $request->validate([
            'packages_documents_only' => 'boolean',
            'name' => 'required',
            'package_count' => 'required|numeric|max:50',
            'type' => 'required|in:package,pack,letter',
            'unit' => 'required|in:imperial,metric',
            'packages.*.length' => 'required_if:type,package',
            'packages.*.width' => 'required_if:type,package|numeric',
            'packages.*.height' => 'required_if:type,package|numeric',
            'packages.*.weight' => 'required_if:type,package|numeric',
            'packages.*.description' => 'nullable',
        ]);

        try {

            \DB::beginTransaction();
            $package->update( $request->only(['name', 'package_count', 'type', 'unit', 'packages_documents_only']) );
            $package->items()->delete();

            foreach ($request->post('packages') as $packageItem) {

                if (
                    !empty($packageItem['length']) or !empty($packageItem['width']) or
                    !empty($packageItem['height']) or !empty($packageItem['weight']) or
                    !empty($packageItem['description'])
                ) {

                    $package->items()->create($packageItem);
                }
            }
            \DB::commit();
        } catch (\Exception $exception) {

            \DB::rollBack();
            dd($exception->getMessage());
            return back();
        }

        return redirect()->route('packages.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Package $package)
    {
        //
    }
}
