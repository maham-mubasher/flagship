<?php

namespace App\Http\Controllers\Frontend;

use App\DataTables\ImportQuotes\AddressBookDataTable;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\ImportQuote;
use Illuminate\Http\Request;

class ImportQuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(AddressBookDataTable $addressBookDataTable)
    {
        $countries = Country::all();
        $addressGroups = auth()->user()->addressGroups;

        return $addressBookDataTable
            ->with(['address_group_id' => \request()->get('address_group_id')])
            ->render('pages.import-quotes.index', [
            'countries' => $countries,
            'addressGroups' => $addressGroups
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'shipment_value' => 'nullable',
            'package_count' => 'required|numeric|max:50',
            'type' => 'required|in:package,pack,letter',
            'unit' => 'required|in:imperial,metric',
            'packages.*.length' => 'required_if:type,package',
            'packages.*.width' => 'required_if:type,package|numeric',
            'packages.*.height' => 'required_if:type,package|numeric',
            'packages.*.weight' => 'required_if:type,package|numeric',
            'packages.*.description' => 'nullable',
        ]);

        $importQuote = ImportQuote::create( array_merge(['user_id' => auth()->id()], $request->only(['shipment_value', 'package_count', 'type', 'unit', 'pickup', 'delivery'])) );
        foreach ($request->post('packages') as $packageItem) {

            if (
                !empty($packageItem['length']) or !empty($packageItem['width']) or
                !empty($packageItem['height']) or !empty($packageItem['weight']) or
                !empty($packageItem['description'])
            ) {

                $importQuote->packageItems()->create($packageItem);
            }
        }

        session()->flash('success', true);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(ImportQuote $importQuote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ImportQuote $importQuote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ImportQuote $importQuote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ImportQuote $importQuote)
    {
        //
    }
}
