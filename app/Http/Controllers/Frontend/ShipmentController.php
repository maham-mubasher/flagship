<?php

namespace App\Http\Controllers\Frontend;

use App\DataTables\ShipmentDataTable;
use App\Models\Shipment;
use App\Models\ShipmentsPickupInfo;
use App\Models\ShipmentsInsurance;
use App\Models\ShipmentsCod;
use App\Models\ShipmentsCouriers;
use App\Models\ShipmentsAddress;
use App\Models\Package;
use App\Models\Address;
use App\Models\AddressGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Services\Couriers\FedexShippingService;
use App\Services\Couriers\UpsShippingService;
use App\Services\Couriers\PurolatorShippingService;
use App\Models\Country;
use App\Models\Province;
use App\DataTables\ImportQuotes\AddressBookDataTable;
use Hamcrest\Arrays\IsArray;
use Setting;

class ShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ShipmentDataTable $shipmentDataTable)
    {
        return $shipmentDataTable->render('pages.shipments.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(AddressBookDataTable $addressBookDataTable)
    {
        $countries = Country::all();
        $addressGroups = auth()->user()->addressGroups;
        $provinces = Province::where('country_id', '1')->get();
        $google_key = Setting::get('google_map_key');

        return $addressBookDataTable
            ->with(['address_group_id' => \request()->get('address_group_id')])
            ->render('pages.shipments.create', [
            'countries' => $countries,
            'addressGroups' => $addressGroups,
            'provinces' => $provinces,
            'google_key' => $google_key,
        ]);
    }

    public function qoute(AddressBookDataTable $addressBookDataTable)
    {
        $countries = Country::all();
        $addressGroups = auth()->user()->addressGroups;
        $provinces = Province::where('country_id', '1')->get();
        $google_key = Setting::get('google_map_key');

        return $addressBookDataTable
            ->with(['address_group_id' => \request()->get('address_group_id')])
            ->render('pages.shipments.qoute', [
            'countries' => $countries,
            'addressGroups' => $addressGroups,
            'provinces' => $provinces,
            'google_key' => $google_key,
        ]);
    }

    public function quote_courier(Request $request)
    {
        $data = array();
        $shipmentId = $request->query('id');
        $shipment = Shipment::find($shipmentId);
        $sender_address = $shipment->addresses()->where('address_type','shipper')->first();
        $receiver_address = $shipment->addresses()->where('address_type','receiver')->first();
        $rates = [];
        $packages = $shipment->packages()->with('items')->get();
        
        $FedexShippingService = new FedexShippingService();
        $fedex_rates = $FedexShippingService->getShippingRates($data);
        $fedex_rates = json_decode($fedex_rates, true);
        // echo "<pre>";
        // print_r($fedex_rates);
        //   dd('maham');
           
        foreach ($fedex_rates['output']['rateReplyDetails'] as $rateDetail) {
            $serviceName = $rateDetail['serviceName'];
            $totalAmount = $rateDetail['ratedShipmentDetails'][0]['totalNetCharge'];
            $basePrice = $rateDetail['ratedShipmentDetails'][0]['totalBaseCharge'];
            $peakSurcharge = $rateDetail['ratedShipmentDetails'][0]['shipmentRateDetail']['surCharges'][1]['amount'];
            $fuelSurcharge = $rateDetail['ratedShipmentDetails'][0]['shipmentRateDetail']['surCharges'][0]['amount'];
            $subtotal = $basePrice + $fuelSurcharge;
        
            $taxes = [];
            foreach ($rateDetail['ratedShipmentDetails'][0]['shipmentRateDetail']['surCharges'] as $surcharge) {
                $taxes[$surcharge['description']] = $surcharge['amount'];
            }

            $subDetails = [
                'Freight' => $basePrice,
                'Surcharge' => [
                    'Residential surcharge' => $fuelSurcharge,
                    'Fuel surcharge' => $fuelSurcharge,
                    'Peak surcharge' => $peakSurcharge
                ],
                'Subtotal' => $subtotal,
                'Taxes' => $taxes,
            ];
        
            $totalTaxes = array_sum($taxes);
            $taxes['Total'] = $totalTaxes;
            $rates[] = [
                        'courier_name' => 'Fedex',
                        'service_name' => $serviceName,
                        'total' => $totalAmount,
                        'expected_delivery_date' => '',
                        'sub_details' => $subDetails,

            ];
        }

        // $UpsShippingService = new UpsShippingService();
        // $ups_rates = $UpsShippingService->getShippingRates($data);

        $PurolatorShippingService = new PurolatorShippingService();
        $Purolator_rates = $PurolatorShippingService->getShippingRates($data);
        
        
        if($Purolator_rates != null)
        {
            foreach ($Purolator_rates->ShipmentEstimates->ShipmentEstimate as $estimate) 
            {
                $expectedDeliveryDate = date('l, F j, Y', strtotime($estimate->ExpectedDeliveryDate));
                if(isset($estimate->Surcharges->Surcharge) and is_array($estimate->Surcharges->Surcharge)){
                    $Residential_surcharge =  $estimate->Surcharges->Surcharge[0]->Amount;
                    $Fuel_surcharge =  $estimate->Surcharges->Surcharge[0]->Amount;
                }
                else
                {
                    $Residential_surcharge =  0;
                    $Fuel_surcharge =  $estimate->Surcharges->Surcharge->Amount;
                }
                $subDetails = [
                    'Freight' => $estimate->BasePrice,
                    
                    'Surcharge' => [
                        'Residential surcharge' =>  $Residential_surcharge,
                        'Fuel surcharge' =>  $Fuel_surcharge,
                    ],
                    'Subtotal' =>  ($estimate->BasePrice + $Residential_surcharge + $Fuel_surcharge),
                    'Taxes' => [],
                ];
                
                $totalTaxes = 0;

                foreach ($estimate->Taxes->Tax as $tax) {
                    $taxAmount = floatval($tax->Amount);
                    $subDetails['Taxes'][$tax->Type] = $taxAmount;
                    $totalTaxes += $taxAmount;
                }

                $subDetails['Taxes']['Total'] = $totalTaxes;

                $rates[] = [
                        'courier_name' => 'Purolator',
                        'service_name' => $estimate->ServiceID,
                        'expected_delivery_date' => $expectedDeliveryDate,
                        'total' => $estimate->TotalPrice,
                        'sub_details' => $subDetails,
                        
                ];
            }
        }

        return view('pages.shipments.quote_courier', [
            'sender' => $sender_address,
            'receiver' => $receiver_address,
            'packages' => $packages,
            'rates' => $rates,
            'shipment_id' => $shipmentId
        ]);
    }

    public function summary()
    {
        return view('pages.shipments.summary');
    }


    public function pre_dispatch(Request $request)
    {
        $shipmentId = $request->query('id');
        $shipment = Shipment::find($shipmentId);
        $shipment_details = $shipment->first();
        $sender_address = $shipment->addresses()->where('address_type','shipper')->first();
        $receiver_address = $shipment->addresses()->where('address_type','receiver')->first();
        $packages = $shipment->packages()->with('items')->get();
        $price = $shipment->courier()->get();
        $prices = $price->first();
        $rates = json_decode($prices->details, true);
        return view('pages.shipments.pre_dispatch' , [
            'shipment_id' => $shipmentId,
            'shipment' => $shipment_details,
            'sender' => $sender_address,
            'receiver' => $receiver_address,
            'packages' => $packages,
            'rates' => $rates,
            'shipment_id' => $shipmentId
        ]);
    }

    public function confirm_shipment(Request $request)
    {
        $data = array();
        $shipmentId = $request->shipment_id;
        $shipment = Shipment::find($shipmentId);
        $shipment_details = $shipment->first();
        $sender_address = $shipment->addresses()->where('address_type','shipper')->first();
        $receiver_address = $shipment->addresses()->where('address_type','receiver')->first();
        $packages = $shipment->packages()->with('items')->get();
        $price = $shipment->courier()->get();
        $prices = $price->first();
        $rates = json_decode($prices->details, true);
        if($rates['courier_name'] == 'Fedex')
        {
            $FedexShippingService = new FedexShippingService();
            $fedex_create_shipment = $FedexShippingService->create_shipment($data);
        }
        elseif($rates['courier_name'] == 'Purolator')
        {
            $PurolatorShippingService = new PurolatorShippingService();
            $Purolator_create_shipment = $PurolatorShippingService->create_shipment($data);
        }
        return view('pages.shipments.confirm' , [
            'tracking_number' => rand(100000000000, 999999999999),
            'shipment' => $shipment_details,
            'sender' => $sender_address,
            'receiver' => $receiver_address,
            'packages' => $packages,
            'rates' => $rates,
            'shipment_id' => $shipmentId
        ]);
    }

    
    public function convert_qoute(Request $request)
    {
        $request->validate([
            'courier_check' => 'required',
        ]);


        if($request->has('courier_check'))
        { 
            $courier_check = $request->courier_check;
            $shipment_id = $request->shipment;
            $parts = explode(" - ", $courier_check);
            $courier = $parts[0];
            $service = $parts[1];
            $price = floatval($parts[2]);
            $item = $parts[3];
            
            $insurance = ShipmentsCouriers::create([
                'shipment_id' => $shipment_id,
                'courier_name' => $courier,
                'service_name' => $service,
                'total' => $price,
                'details' => $item
            ]);
    
        }   
        
        return  redirect('shipping/pre_dispatch?id=' . $shipment_id)
            ->with('success', 'Qoute created successfully.');

        // return redirect()->route('shipments.index')
        //     ->with('success', 'Shipment created successfully.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'shipment.shipment_date' => 'required',
        ]);

        $userId = auth()->user()->id;
        $addressGroup = new AddressGroup();
        $is_cod = 0;
        $is_insurance = 0;
        $is_schedule_pickup = 0;
        $saturday_delivery = 0;
        $is_qoute = 0;
        $shipment_date = $request->shipment['shipment_date'];

        if (isset($request->shipment['is_cod']) && $request->shipment['is_cod'] === '1') {$is_cod = 1;}
        if (isset($request->shipment['is_insurance']) && $request->shipment['is_insurance'] === '1') {$is_insurance = 1;}
        if (isset($request->shipment['is_schedule_pickup']) && $request->shipment['is_schedule_pickup'] === '1') {$is_schedule_pickup = 1;}
        if (isset($request->shipment['saturday_delivery']) && $request->shipment['saturday_delivery'] === '1') {$saturday_delivery = 1;}
        if($request->has('is_qoute')) { $is_qoute = 1; }

        $shipment = Shipment::create([
            'user_id' => $userId,
            'shipment_date' => $request->shipment['shipment_date'],
            'reference' => $request->shipment['reference'],
            'driver_instructions' => $request->shipment['driver_instructions'],
            'signature_required' => $request->shipment['signature_required'],
            'saturday_delivery' => $saturday_delivery,
            'payment_payer' => $request->shipment['payment_payer'],
            'payment_account_number' => $request->shipment['payment_account_number'],
            'is_schedule_pickup' => $is_schedule_pickup,
            'is_cod' => $is_cod,
            'is_insurance' => $is_insurance,
            'is_qoute' => $is_qoute
        ]);

        $shipper = [
            'shipment_id' => $shipment->id,
            'country_id' => isset($request->shipper['country_id']) ? $request->shipper['country_id'] : '1',
            'province_id' => isset($request->shipper['province_id']) ? $request->shipper['province_id'] : null,
            'address' => isset($request->shipper['address']) ? $request->shipper['address'] : null,
            'address_type' => 'shipper',
            'tracking_email' => isset($request->shipper['tracking_email']) ? $request->shipper['tracking_email'] : null,
            'company_name' => isset($request->shipper['company_name']) ? $request->shipper['company_name'] : null,
            'attention' => isset($request->shipper['attention']) ? $request->shipper['attention'] : null,
            'suite' => isset($request->shipper['suite']) ? $request->shipper['suite'] : null,
            'department' => isset($request->shipper['department']) ? $request->shipper['department'] : null,
            'postal_code' => isset($request->shipper['postal_code']) ? $request->shipper['postal_code'] : null,
            'city' => isset($request->shipper['city']) ? $request->shipper['city'] : null,
            'phone' => isset($request->shipper['phone']) ? $request->shipper['phone'] : null,
            'ext' => isset($request->shipper['ext']) ? $request->shipper['ext'] : null,

        ];
        $shipper_save = ShipmentsAddress::create($shipper);
        if($request->has('save_address_shipper'))
        {
            unset($shipper['address_type']);
            unset($shipper['shipment_id']);
            unset($shipper['tracking_email']);
            unset($shipper['province_id']);
            $shipper['email'] = $request->shipper['tracking_email'];
            $shipper['province'] = $request->shipper['province_id'];
            $shipper['address_group_id'] = $request->shipper_address_group;
            //dd($shipper);
            
            $addressGroup = AddressGroup::findOrFail($shipper['address_group_id']);
            $addressGroup->addresses()->create($shipper);
        }
        $receiver = [
            'shipment_id' => $shipment->id,
            'country_id' => isset($request->receiver['country_id']) ? $request->receiver['country_id'] : '1',
            'province_id' => isset($request->receiver['province_id']) ? $request->receiver['province_id'] : null,
            'address' => isset($request->receiver['address']) ? $request->receiver['address'] : null,
            'address_type' => 'receiver',
            'tracking_email' => isset($request->receiver['tracking_email']) ? $request->receiver['tracking_email'] : null,
            'company_name' => isset($request->receiver['company_name']) ? $request->receiver['company_name'] : null,
            'attention' => isset($request->receiver['attention']) ? $request->receiver['attention'] : null,
            'suite' => isset($request->receiver['suite']) ? $request->receiver['suite'] : null,
            'department' => isset($request->receiver['department']) ? $request->receiver['department'] : null,
            'postal_code' => isset($request->receiver['postal_code']) ? $request->receiver['postal_code'] : null,
            'city' => isset($request->receiver['city']) ? $request->receiver['city'] : null,
            'phone' => isset($request->receiver['phone']) ? $request->receiver['phone'] : null,
            'ext' => isset($request->receiver['ext']) ? $request->receiver['ext'] : null,

        ];
        $receiver_save = ShipmentsAddress::create($receiver);
        if($request->has('save_address_receiver'))
        {
            unset($receiver['shipment_id']);
            unset($receiver['address_type']);
            unset($receiver['tracking_email']);
            unset($receiver['province_id']);
            $receiver['email'] = $request->receiver['tracking_email'];
            $receiver['province'] = $request->receiver['province_id'];
            $addressGroup = AddressGroup::findOrFail($shipper['address_group_id']);
            $receiver['address_group_id'] = $request->receiver_address_group;
            $addressGroup->addresses()->create($receiver);
        }
        if($request->shipment['payment_payer'] === 'Third Party'){
            $third_party =  [
                'shipment_id' => $shipment->id,
                'country_id' => $request->third_party['country_id'],
                'province_id' => $request->third_party['province_id'],
                'address' => $request->third_party['address'],
                'address_type' => 'third_party',
                'tracking_email' => $request->third_party['tracking_email'],
                'company_name' => $request->third_party['company_name'],
                'attention' => $request->third_party['attention'],
                'suite' => $request->third_party['suite'],
                'department' => $request->third_party['department'],
                'postal_code' => $request->third_party['postal_code'],
                'city' => $request->third_party['city'],
                'phone' => $request->third_party['phone'],
                'ext' => $request->third_party['ext'],
            ];
            $third_party_save = ShipmentsAddress::create($third_party);
            if($request->has('save_address_shipment'))
        {
            unset($third_party['shipment_id']);
            unset($third_party['address_type']);
            unset($third_party['tracking_email']);
            unset($third_party['province_id']);
            $third_party['email'] = $request->third_party['tracking_email'];
            $third_party['province'] = $request->third_party['province_id'];
            $third_party['address_group_id'] = $request->pickup_address_group;
            $addressGroup->addresses()->create($third_party);
        }

        }
        
        if ($request->has('shipment') and isset($request->shipment['is_schedule_pickup'])) {
            $pickup_info = ShipmentsPickupInfo::create([
                'shipment_id' => $shipment->id,
                'time_from' => $request->pickup['time_from'],
                'time_until' => $request->pickup['time_until'],
                'pickup_location' => $request->pickup['pickup_location'],
                'pickup_instruction' => $request->pickup['pickup_instruction'],
            ]);

        }
        if ($request->has('shipment') and isset($request->shipment['is_insurance'])) {
            $insurance = ShipmentsInsurance::create([
                'shipment_id' => $shipment->id,
                'value' => $request->insurance['value'],
                'description' => $request->insurance['description'],
            ]);
        }

        if ($request->has('shipment') and isset($request->shipment['is_cod'])) {
            $cod = ShipmentsCod::create([
                'shipment_id' => $shipment->id,
                'payment_method' => $request->cod['payment_method'],
                'payable_to' => $request->cod['payable_to'],
                'receiver_phone' => $request->cod['receiver_phone'],
                'amount' => $request->cod['amount'],
                'currency' => $request->cod['currency'],
            ]);
        }
        $package_array = [
            'name' => isset($request->packages['name']) ? $request->packages['name'] : null,
            'package_count' => isset($request->package['package_count']) ? $request->package['package_count'] : '0',
            'type' => isset($request->package['type']) ? $request->package['type'] : null,
            'unit' => isset($request->package['unit']) ? $request->package['unit'] : null,

        ];

        $package = $shipment->packages()->create( $package_array );
        foreach ($request->post('packages') as $packageItem) {

            if (
                !empty($packageItem['length']) or !empty($packageItem['width']) or
                !empty($packageItem['height']) or !empty($packageItem['weight']) or
                !empty($packageItem['description'])
            ) {

                $package->items()->create($packageItem);
            }
        }

       

        if($request->has('save_package') )
        {
            $save_package = auth()->user()->packages()->create( $package_array );
            foreach ($request->post('packages') as $packageItem) {

                if (
                    !empty($packageItem['length']) or !empty($packageItem['width']) or
                    !empty($packageItem['height']) or !empty($packageItem['weight']) or
                    !empty($packageItem['description'])
                ) {

                    $save_package->items()->create($packageItem);
                }
            }
        }
        
            return  redirect('shipping/quote_courier?id=' . $shipment->id)
            ->with('success', 'Qoute created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Shipment $shipment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shipment $shipment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shipment $shipment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shipment $shipment)
    {
        $shipment->delete();
    }
}
