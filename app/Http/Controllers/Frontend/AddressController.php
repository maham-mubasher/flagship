<?php

namespace App\Http\Controllers\Frontend;

use App\DataTables\Addresses\AddressDataTable;
use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\AddressGroup;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(AddressGroup $addressGroup, AddressDataTable $addressDataTable)
    {
        return $addressDataTable
            ->with(['address_group_id' => $addressGroup->id])
            ->render('pages.address-groups.addresses.index', compact('addressGroup'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(AddressGroup $addressGroup)
    {
        $address = new Address();
        return view('pages.address-groups.addresses.create', compact('addressGroup', 'address'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, AddressGroup $addressGroup)
    {
        $data = $this->validateRequest($request);
        $addressGroup->addresses()->create($data);

        return redirect()->route('address-groups.addresses.index', $addressGroup);
    }

    /**
     * Display the specified resource.
     */
    public function show(AddressGroup $addressGroup, Address $address)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AddressGroup $addressGroup, Address $address)
    {
        return view('pages.address-groups.addresses.edit', compact('addressGroup', 'address'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AddressGroup $addressGroup, Address $address)
    {
        $data = $this->validateRequest($request);

        $address->update($data);
        return redirect()->route('address-groups.addresses.index', $addressGroup);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AddressGroup $addressGroup, Address $address)
    {
        $address->delete();
    }

    public function validateRequest(Request $request)
    {
        return $request->validate([
            'company_name' => 'required',
            'attention' => 'required',
            'address' => 'required',
            'suite' => 'nullable',
            'department' => 'nullable',
            'country_id' => 'required',
            'postal_code' => 'required',
            'city' => 'required',
            'province' => 'required',
            'is_residential_address' => 'boolean',
            'phone' => 'required',
            'ext' => 'nullable',
            'tax_id' => 'nullable',
            'shipping_account' => 'nullable',
            'email' => 'nullable',
        ]);
    }
}
