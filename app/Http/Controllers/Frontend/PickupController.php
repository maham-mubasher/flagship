<?php

namespace App\Http\Controllers\Frontend;

use App\DataTables\PickupDataTable;
use App\DataTables\ImportQuotes\AddressBookDataTable;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Pickup;
use App\Models\Province;
use Illuminate\Http\Request;
use App\Services\Couriers\FedexShippingService;
use App\Services\Couriers\PurolatorShippingService;
use App\Services\Couriers\UpsShippingService;
use App\Services\Couriers\LoomisShippingService;
use Carbon\Carbon;
use Setting;



class PickupController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index(PickupDataTable $pickupDataTable)
    {
        $provinces = Province::where('country_id', '1');

        return $pickupDataTable
            ->render('pages.pickups.index', [
            'provinces' => $provinces
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(AddressBookDataTable $addressBookDataTable)
    {
        $provinces = Province::where('country_id', '1')->get();
        $google_key = Setting::get('google_map_key');
        
        $addressGroups = auth()->user()->addressGroups;
        return $addressBookDataTable
            ->render('pages.pickups.create', [
            'provinces' => $provinces,
            'addressGroups' => $addressGroups,
            'google_key' => $google_key,
        ]);

        //return view('pages.pickups.schedule_pickup', $data);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $input_data = $request->validate([

            'company_name'      => 'required|max:50',
            'sender_name'       => 'required|max:50',
            'country_id'        => 'required|numeric|max:50',
            'address'           => 'required',
            'postal_code'       => 'required',
            'city'              => 'required|max:50',
            'phone'             => 'required',
            'courier_name'      => 'required',
            'pickup_location'   => 'required|max:100',
            'package_count'     => 'required|numeric|max:50',
            'unit'              => 'required|in:kg,lb',
            'province_id'       => '',
            'suite'       => '',
            'ext'       => '',
            'to_country_id'       => 'required',
            'pickup_date'       => 'required',
            'time_from'       => 'required',
            'time_until'       => 'required',
            'is_ground'       => '',
            'weight'       => 'required',
            
        ]);
        $date = Carbon::parse($input_data['pickup_date']); 
        $input_data['pickup_date'] = $date->format('Y-m-d');

        if ($input_data) {
            $courierName = $input_data['courier_name'];
            switch ($courierName) {
                case 'fedex':
                    $fedexClient = new FedexShippingService();
                    $schedule = $fedexClient->createPickup($input_data);
                    break;
                case 'ups':
                    $upsClient = new UpsShippingService();
                    $schedule = $upsClient->createPickup($input_data);
                    break;
                case 'purolator':
                    $purolatorClient = new PurolatorShippingService();
                    $schedule = $purolatorClient->createPickup($input_data);
                    break;
                case 'loomis':
                    $loomisClient = new LoomisShippingService();
                    $schedule = $loomisClient->createPickup($input_data);
                    break;
            }

            dd($schedule);
            if($schedule)
            {
                $pickup_insert = Pickup::create(array_merge(
                    ['user_id' => auth()->id(), 'confirmation_number' => $schedule, 'pickup_date' => $input_data['pickup_date']],
                    $request->only([
                        'company_name', 'sender_name', 'country_id', 'province_id',
                        'address', 'suite', 'postal_code', 'city', 'phone', 'ext', 'courier_name',
                        'package_count', 'unit', 'weight', 'to_country_id',
                        'time_from', 'time_until', 'pickup_location', 'pickup_instruction', 'is_ground'
                    ]))
                );
    
                if($pickup_insert){
                    session()->flash('success', true);
                }

            }
            else{
                echo "Error in API Registration";
            }

            

        }

        return back();

    }

    /**
     * Display the specified resource.
     */
    public function show(Pickup $pickup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pickup $pickup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pickup $pickup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $input_data = Pickup::findOrFail($id);
        dd($input_data);
        $courierName = $input_data['courier_name'];
        $confirmation_number = $input_data['confirmation_number'];
            switch ($courierName) {
                case 'fedex':
                    $fedexClient = new FedexShippingService();
                    $cancel_pickup = $fedexClient->cancelPickup($confirmation_number);
                    break;
                case 'ups':
                    $upsClient = new UpsShippingService();
                    $cancel_pickup = $upsClient->cancelPickup($confirmation_number);
                    break;
                case 'purolator':
                    $purolatorClient = new PurolatorShippingService();
                    $cancel_pickup = $purolatorClient->cancelPickup($confirmation_number);
                    break;
            }
        if($cancel_pickup)
        {
            Pickup::where('id',$id)->delete();
        }

    }
}
