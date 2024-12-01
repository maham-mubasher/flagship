<?php

namespace App\Http\Controllers\Frontend;

use App\DataTables\Addresses\AddressGroupDataTable;
use App\Http\Controllers\Controller;
use App\Models\AddressGroup;
use Illuminate\Http\Request;

class AddressGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(AddressGroupDataTable $addressGroupDataTable)
    {
        return $addressGroupDataTable->render('pages.address-groups.index');
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
            'name' => 'required|string'
        ]);

        AddressGroup::create($request->only(['name']));
    }

    /**
     * Display the specified resource.
     */
    public function show(AddressGroup $addressGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AddressGroup $addressGroup)
    {
        return view('pages.address-groups.edit', compact('addressGroup'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AddressGroup $addressGroup)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        $addressGroup->update($request->only(['name']));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AddressGroup $addressGroup)
    {
        $addressGroup->delete();
    }

    public function import()
    {
        return view("pages.address-groups.import");
    }

    public function storeImport(Request $request)
    {
        $request->validate([
            'address_group_id' => 'required',
            'csv' => 'required|mimes:csv'
        ]);
    }
}
