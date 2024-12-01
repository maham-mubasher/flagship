<?php

namespace App\Http\Controllers\Frontend;

use App\DataTables\OrderSupplies\AddressBookDataTable;
use App\Http\Controllers\Controller;
use App\Models\AddressGroup;
use App\Models\Country;
use App\Models\OrderSupply;
use Illuminate\Http\Request;

class OrderSupplyController extends Controller
{
    public function index(AddressBookDataTable $addressBookDataTable)
    {
        $countries = Country::where('name', 'Canada')->get();
        $addressGroups = auth()->user()->addressGroups;

        return $addressBookDataTable->with(['address_group_id' => \request()->get('address_group_id')])
            ->render('pages.order-supplies.index', compact(
            'countries',
            'addressGroups'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            "to.name" => "required",
            "to.attn" => "required",
            "to.address" => "required",
            "to.suite" => "nullable",
            "to.country_id" => "required",
            "to.postal_code" => "required",
            "to.city" => "required",
            "to.province" => "required",
            "to.phone" => "required",
            "to.ext" => "required",
            "to.note" => "required",
        ]);

        OrderSupply::create($request->only(['user_id' => auth()->id(), 'ups', 'dhl', 'fedex', 'purolator', 'gls', 'nationex', 'to']));

        session()->flash('success', true);
        return back();
    }
}
