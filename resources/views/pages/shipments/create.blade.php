<x-base-layout>

    <style>
        /* Custom styles for the Flatpickr calendar */
        .flatpickr-day {
            color: #000000 !important;
        }
        .flatpickr-day.today {
            background: #d1a990e9 !important;
            font-weight: bold;
        }
        .error-list {
        color: red;
        list-style-type: disc;
        }
        td
        {
            padding: 2px !important;
        }
    
      </style>
    

    @if(session()->has('success'))
        <div class="row">
            <div class="col-md-12">
                <!--begin::Alert-->
                <div class="alert bg-light-success d-flex flex-column flex-sm-row p-5 mb-10">
                    <!--begin::Icon-->
                    <i class="ki-duotone ki-shield-tick fs-2hx text-success me-4"><span class="path1"></span><span class="path2"></span></i>
                    <!--end::Icon-->

                    <!--begin::Wrapper-->
                    <div class="d-flex flex-column pe-0 pe-sm-10">
                        <!--begin::Content-->
                        <span>Your message was successfully sent to {{config('app.name')}} customer service.</span>
                        <!--end::Content-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Alert-->
            </div>
        </div>
    @endif

    @include('pages.partials.shipment_quick_links')

    @foreach($errors->all() as $error) {{$error}} @endforeach
    <div class="row">
        <div class="col-md-12">
            <p>To receive a quote for your import shipment, simply provide full shipment information and click 'Send'. Upon submitting your quote request, we will send you shipping rates for each of our couriers along with instructions on how to process the shipment.</p>
        </div>
    </div>
    <form method="post" action="{{route('shipments.store')}}">
        @csrf
        <div class="row mb-5">
            <div class="col-md-6">
                <x-card>
                    <x-slot name="title" class="gap-2"><i class="fa-solid fa-truck text-white"></i> Shipper</x-slot>
                    <x-slot name="tool">
                        <button type="button" class="ms-3 btn btn-light btn-sm swap-address" data-bs-target="" data-prefix="shipper" data-bs-toggle="modal">Swap Address</button>
                        <button type="button" class="ms-3 btn btn-light btn-sm" data-bs-target="#addressbook_modal" data-prefix="shipper" data-bs-toggle="modal">Address Book</button>
                        <button type="button" class="ms-3 btn btn-light btn-sm clear-fields" data-bs-target="#clear_all" data-prefix="shipper" data-bs-toggle="modal">Clear</button>
                    </x-slot>
                    <div class="row mb-3">
                        <div class="col-md-12 col-12 form-check">
                            <input type="checkbox" class="form-check-input" id="shipper_address_correction" name="shipper[address_correction]" value="1">
                            <label class="form-label" for="shipper_address_correction"> I do not want the address to be corrected automatically</label>
                            
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label for="shipper_company_name" class="form-label required">Company / Name</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <input type="text" id="shipper_company_name" autocomplete="off" name="shipper[company_name]" required="required" maxlength="30" placeholder="Company / Sender's Name" class="form-control" value="{{ old('company_name') }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label class="form-label required" for="shipper_attention">Attention</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <input type="text" id="shipper_attention" autocomplete="off" name="shipper[attention]" required="required" maxlength="30" placeholder="Sender's Name" class="form-control"  value="{{ old('attention') }}">
                        </div>
                    </div>

                   

                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label class="form-label required" for="shipper_address">Address</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <input type="text" id="shipper_address" autocomplete="off" name="shipper[address]" required="required" maxlength="30" placeholder="eg. 148 Brunswick Blvd" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label class="form-label" for="shipper_suite">Apt./Suite#</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <input type="text" id="shipper_suite" autocomplete="off" name="shipper[suite]" maxlength="30" placeholder="eg. 101" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label class="form-label" for="shipper_dpt">Department</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <input type="text" id="shipper_dpt" autocomplete="off" name="shipper[department]" maxlength="30" placeholder="eg. 101" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label for="shipper_country" class="form-label required">Country</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <select name="shipper[country_id]" id="shipper_country" class="form-select" data-control="select2">
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}">{{{$country->name}}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label class="form-label required" for="shipper_postal_code">Postal Code</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <input type="text" id="shipper_postal_code" autocomplete="off" name="shipper[postal_code]" required="required" placeholder="eg. H9R 5P9" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label class="form-label required" for="shipper_city">City</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <input type="text" id="shipper_city" autocomplete="off" name="shipper[city]" required="required" placeholder="eg. Montreal" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label class="form-label" for="shipper_province">Province</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <select name="shipper[province_id]" id="shipper_province" class="form-select select_class" data-control="select2">
                               
                                <option value="0">Select Province</option>
                                @foreach($provinces as $province)
                                <option value="{{$province->id}}" {{ old('province_id') == $province->id ? 'selected' : '' }}>{{{$province->name}}}</option>
                                @endforeach
                               
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label class="form-label required" for="shipper_phone">Phone</label>
                        </div>

                        <div class="col-md-4">
                            <input type="text" id="shipper_phone" autocomplete="off" name="shipper[phone]" required="required" placeholder="eg. 18663208383" class="form-control"  value="{{ old('phone') }}">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label" for="shipper_ext">Ext.</label>
                        </div>

                        <div class="col-md-3">
                            <input type="text" id="shipper_ext" autocomplete="off" name="shipper[ext]" placeholder="" class="form-control"  value="{{ old('ext') }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label class="form-label required" for="shipper_tracking_email">Tracking Emails</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <input type="text" id="shipper_tracking_email" name="shipper[tracking_email]" required="required" placeholder="example@domain.com" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6 col-12 form-check">
                            <input type="checkbox" class="form-check-input" id="save_address_shipper" name="save_address_shipper" value="1">
                            <label class="form-label" for="save_address_shipper"> Save this address in your address book:</label>
                            
                        </div>

                        <div class="col-md-6 col-12 form-check">
                            <select name="shipper_address_group" id="shipper_address_group" class="form-select select_class" data-control="select2" disabled>
                               
                                <option value="">Select an address group</option>
                                    @foreach($addressGroups as $addressGroup)
                                        <option value="{{$addressGroup->id}}">{{$addressGroup->name}}</option>
                                    @endforeach
                               
                            </select>
                        </div>
                    </div>
                    
                </x-card>
            </div>

            <div class="col-md-6">
                <x-card>
                    <x-slot name="title" class="gap-2"><i class="fa-solid fa-sign-out text-white"></i> receiver</x-slot>

                    <x-slot name="tool">
                        <button type="button" class="ms-3 btn btn-light btn-sm swap-address" data-bs-target="" data-prefix="receiver" data-bs-toggle="modal">Swap Address</button>
                        <button type="button" class="ms-3 btn btn-light btn-sm" data-bs-target="#addressbook_modal" data-prefix="receiver" data-bs-toggle="modal">Address Book</button>
                        <button type="button" class="ms-3 btn btn-light btn-sm clear-fields" data-bs-target="#clear_all" data-prefix="receiver" data-bs-toggle="modal">Clear</button>
                    </x-slot>

                    <div class="row mb-3">
                        <div class="col-md-12 col-12 form-check">
                            <input type="checkbox" class="form-check-input" id="receiver_address_correction" name="receiver[address_correction]" value="1">
                            <label class="form-label" for="receiver_address_correction"> I do not want the address to be corrected automatically</label>
                            
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label for="receiver_company_name" class="form-label required">Company / Name</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <input type="text" id="receiver_company_name"  autocomplete="off" name="receiver[company_name]" required="required" maxlength="30" placeholder="Company / Sender's Name" class="form-control" value="{{ old('company_name') }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label class="form-label required" for="receiver_attention">Attention</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <input type="text" id="receiver_attention" name="receiver[attention]"  autocomplete="off" required="required" maxlength="30" placeholder="Sender's Name" class="form-control"  value="{{ old('attention') }}">
                        </div>
                    </div>

                    

                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label class="form-label required" for="receiver_address">Address (PO Boxes are
                                not accepted)</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <input type="text" id="receiver_address" name="receiver[address]" autocomplete="off" required="required" maxlength="30" placeholder="eg. 148 Brunswick Blvd" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label class="form-label" for="receiver_suite">Apt./Suite#</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <input type="text" id="receiver_suite" name="receiver[suite]" autocomplete="off" maxlength="30" placeholder="eg. 101" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label class="form-label" for="receiver_dpt">Department</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <input type="text" id="receiver_dpt" name="receiver[department]" autocomplete="off" maxlength="30" placeholder="eg. 101" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label for="to_country" class="form-label required">Country</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <select name="receiver[country_id]" id="receiver_country" class="form-select">
                                @foreach($countries as $country)
                                    @if($country->name === "Canada")
                                        <option value="{{$country->id}}">{{{$country->name}}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label class="form-label required" for="receiver_postal_code">Postal Code</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <input type="text" id="receiver_postal_code" name="receiver[postal_code]" autocomplete="off" required="required" placeholder="eg. H9R 5P9" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label class="form-label required" for="receiver_city">City</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <input type="text" id="receiver_city" name="receiver[city]" required="required" autocomplete="off" placeholder="eg. Montreal" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label class="form-label" for="receiver_province">Province</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <select name="receiver[province_id]" id="receiver_province" class="form-select select_class" data-control="select2">
                               
                                <option value="0">Select Province</option>
                                @foreach($provinces as $province)
                                <option value="{{$province->id}}" {{ old('province_id') == $province->id ? 'selected' : '' }}>{{{$province->name}}}</option>
                                @endforeach
                               
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label class="form-label" for=""></label>
                        </div>
                        <div class="col-md-9 col-12 form-check">
                            <input type="checkbox" class="form-check-input" id="receiver_is_commercial" name="receiver[is_commercial]" value="1">
                            <label class="form-label" for="receiver_is_commercial"> This is a residential address</label>
                            
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label class="form-label required" for="receiver_phone">Phone</label>
                        </div>

                        <div class="col-md-4">
                            <input type="text" id="receiver_phone" autocomplete="off" name="receiver[phone]" autocomplete="off" required="required" placeholder="eg. 18663208383" class="form-control"  value="{{ old('phone') }}">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label" for="receiver_ext">Ext.</label>
                        </div>

                        <div class="col-md-3">
                            <input type="text" id="receiver_ext" autocomplete="off" name="receiver[ext]" placeholder="" autocomplete="off" class="form-control"  value="{{ old('ext') }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label class="form-label required" for="receiver_tracking_email">Tracking Emails</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <input type="text" id="receiver_tracking_email" name="receiver[tracking_email]" autocomplete="off" placeholder="example@domain.com" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6 col-12 form-check">
                            <input type="checkbox" class="form-check-input" id="save_address_receiver" name="save_address_receiver" value="1">
                            <label class="form-label" for="save_address_receiver"> Save this address in your address book:</label>
                            
                        </div>

                        <div class="col-md-6 col-12 form-check">
                            <select name="receiver_address_group" id="receiver_address_group" class="form-select select_class" data-control="select2" disabled>
                               
                                <option value="">Select an address group</option>
                                    @foreach($addressGroups as $addressGroup)
                                        <option value="{{$addressGroup->id}}">{{$addressGroup->name}}</option>
                                    @endforeach
                               
                            </select>
                        </div>
                    </div>
                </x-card>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-md-5">
                <x-card>
                    <x-slot name="title" class="gap-2">
                        <i class="fa-solid fa-gears text-white"></i> Options
                    </x-slot>

                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label class="form-label" for="pickup_address">Shipment Date</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <div class="input-group" id="shipment_date" data-td-target-input="nearest" data-td-target-toggle="nearest">
                                <input id="shipment_date_input" type="text" name="shipment[shipment_date]" required="required" maxlength="30" value="{{ date('F-d-Y') }}" class="form-control" data-td-target="#shipment_date"/>
                                <span class="input-group-text" data-td-target="#shipment_date" data-td-toggle="datetimepicker">
                                    <i class="ki-duotone ki-calendar fs-2"><span class="path1"></span><span class="path2"></span></i>
                                </span>
                            </div>
                            
                        </div>
                    </div>
                    <div class="help-block mb-3"><span class="fa fa-info-circle"></span> Pickup is based on local time of the shipper
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label class="form-label" for=""></label>
                        </div>
                        <div class="col-md-9 col-12 form-check">
                            <input type="checkbox" class="form-check-input" id="pickup_options_toggle_pickup" name="shipment[is_schedule_pickup]" value="1" checked>
                            <label class="form-label" for="pickup_options_toggle_pickup"> I want to schedule a pickup for this shipment</label>  
                        </div>
                    </div>
                    
                    <div style="background: white !important; padding: 2%; margin-bottom: 2%" id="pickup_options_toggle_pickup_check">
                        <div class="help-block mb-3"> Pickup is based on local time of the shipper
                        </div>
    
                        <div class="row mb-3">
                            <div class="col-md-6 col-12">
                                <div class="row mb-3">
                                    <div class="col-md-5">
                                        <label class="form-label required" for="time_from">Time From</label>
                                    </div>
    
                                    <div class="col-md-6">
                                        <input type="text" autocomplete="off" id="time_from" name="pickup[time_from]" maxlength="30" placeholder="" class="form-control" value="{{ old('time_from') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="row mb-3">
                                    <div class="col-md-5">
                                        <label class="form-label required" for="time_until">Time Until</label>
                                    </div>
    
                                    <div class="col-md-6">
                                        <input type="text" autocomplete="off" id="time_until" name="pickup[time_until]" maxlength="30" placeholder="" class="form-control" value="{{ old('time_until') }}">
                                    </div>
                                </div>
                            </div>
                            
                        </div>
    
                        <div class="row mb-3">
                            <div class="col-md-3 col-12">
                                <label class="form-label required" for="pickup_postal_code">Pickup Location</label>
                            </div>
    
                            <div class="col-md-9 col-12">
                                <input type="text" autocomplete="off" id="pickup_postal_code" name="pickup[pickup_location]" placeholder="eg. H9R 5P9" class="form-control"  value="{{ old('pickup_location') }}">
                            </div>
                        </div>
    
                        <div class="row mb-3">
                            <div class="col-md-3 col-12">
                                <label class="form-label" for="pickup_instructions">Pickup Instructions</label>
                            </div>
    
                            <div class="col-md-9 col-12">
                                <input type="text" autocomplete="off" id="pickup_instructions" name="pickup[pickup_instruction]" placeholder="" class="form-control"  value="{{ old('pickup_instruction') }}">
                            </div>
                        </div>
                        <div class="help-block mb-3">
                            <b> NOTE: </b> If you choose FedEx Ground, a 8am to 6pm pickup will be scheduled; If you choose Canpar Ground, a 8am to 5pm pickup will be scheduled.<br>
                            FedEx Ground and Canpar Ground do not allow same day pickup. They will automatically be scheduled for the next business day instead.
                        </div>

                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label class="form-label" for="options_reference">Refernece</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <input type="text" id="options_reference" name="shipment[reference]" placeholder="eg. H9R 5P9" class="form-control"  value="{{ old('pickup_location') }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label class="form-label" for="options_driver_instructions">Delivery Driver Instructions</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <input type="text" id="options_driver_instructions" name="shipment[driver_instructions]"  autocomplete="off" placeholder="" class="form-control"  value="{{ old('pickup_instruction') }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label class="form-label" for="options_driver_instructions">Signature Options</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <div id="options_signature_required">
                                <label class="font-normal"><input type="radio" id="options_signature_required_0" name="shipment[signature_required]" value="no" checked="checked"> No Signature Required on Delivery</label>
                                <label class="font-normal"><input type="radio" id="options_signature_required_1" name="shipment[signature_required]" value="yes" data-gtm-form-interact-field-id="0"> Require a Signature on Delivery</label>
                                <label class="font-normal"><input type="radio" id="options_signature_required_2" name="shipment[signature_required]" value="adult" data-gtm-form-interact-field-id="1"> Require an <b>Adult Only</b> Signature on Delivery</label>
                            </div>
                            <span class="help-block m-b-none d-none" id="options_signature_required_2_check">
                               <b> NOTE:</b> Only FedEx, UPS and Purolator services will be available if an adult signature is requested.<br>
                                An adult signature is required for all tobacco or tobacco related products, including e-cigarette products.
                            </span>
                            
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12 col-12 form-check">
                            <input type="checkbox" class="form-check-input" id="options_saturday_delivery" name="shipment[saturday_delivery]" value="1">
                            <label class="form-label" for="options_saturday_delivery"> Saturday Delivery</label>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12 col-12 form-check">
                            <input type="checkbox" class="form-check-input" id="options_cod_toggle_cod" name="shipment[is_cod]" value="1">
                            <label class="form-label" for="options_cod_toggle_cod"> COD</label>
                        </div>
                        <span class="help-block m-b-none">
                            COD is only available for Purolator and UPS. However, it is not available for Third Party or Collect shipments.
                          </span>
                    </div>
                    <div id="cod_check" style="background: white !important; padding: 2%; margin-bottom: 2%" class="d-none">
                        
                        <div class="row mb-3">
                            <div class="col-md-3 col-12">
                                <label class="form-label required" for="payment_method">Payment Method</label>
                            </div>
                            <div class="col-md-9 col-12">
                                <select id="payment_method" name="cod[payment_method]" class="form-control select_class" data-control="select2">
                                    <option value="">--Payment Method--</option>
                                    <option value="check">Check</option>
                                    <option value="cert_check">Certified Check</option>
                                    <option value="money_order">Money Order</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3 col-12">
                                <label class="form-label required" for="payable_to">Payable To</label>
                            </div>
                            <div class="col-md-9 col-12">
                                <input type="text" id="payable_to" autocomplete="off" name="cod[payable_to]" placeholder="Payable To" class="form-control">
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-3 col-12">
                                <label class="form-label required" for="cod_receiver_phone">Receiver Phone</label>
                            </div>
                            <div class="col-md-9 col-12">
                                <input type="text" autocomplete="off" id="cod_receiver_phone" name="cod[receiver_phone]" placeholder="Receiver Phone" class="form-control">
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-3 col-12">
                                <label class="form-label required" for="amount">Amount</label>
                            </div>
                            <div class="col-md-9 col-12">
                                <input type="text" id="amount" autocomplete="off" name="cod[amount]" placeholder="Amount" class="form-control">
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-3 col-12">
                                <label class="form-label required" for="currency">Currency</label>
                            </div>
                            <div class="col-md-9 col-12">
                                <select id="currency" name="cod[currency]" class="form-control select_class" data-control="select2">
                                    <option value="">--Choose a Currency--</option>
                                    <option value="CAD">CAD Canadian Dollar</option>
                                    <option value="USD">USD US Dollar</option>
                                </select>
                            </div>
                        </div>
                        
                        

                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label for="payment_payer" class="form-label required">Payment</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <select name="shipment[payment_payer]" id="payment_payer" class="form-select select_class" data-control="select2">
                                <option {{old('payment_payer') === "My SHIPSCAN Account" ? "selected" : ""}} value="My SHIPSCAN Account">My SHIPSCAN Account</option>
                                <option {{old('payment_payer') === "Collect" ? "selected" : ""}} value="Collect">Collect</option>
                                <option {{old('payment_payer') === "Third Party" ? "selected" : ""}} value="Third Party">Third Party</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3 d-none" id="account_number">
                        <div class="col-md-8 col-12">
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label required" for="payment_account_number">Account #</label>
                                </div>

                                <div class="col-md-8">
                                    <input type="text" autocomplete="off" id="payment_account_number" name="shipment[payment_account_number]" maxlength="30" placeholder="" class="form-control" value="{{ old('shipment[payment_account_number]') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <button type="button" class="ms-3 btn btn-primary btn-sm" data-bs-target="#addressbook_modal" data-prefix="shipper" data-bs-toggle="modal">Address Book</button>

                        </div>
                        
                    </div>
                    <div id="third_party_div" class="d-none">

                    
                        <div class="row mb-3">
                            <div class="col-md-3 col-12">
                                <label for="third_company_name" class="form-label required">Company / Name</label>
                            </div>

                            <div class="col-md-9 col-12">
                                <input type="text" autocomplete="off" id="third_company_name" name="third_party[company_name]" maxlength="30" placeholder="Company / Sender's Name" class="form-control" value="{{ old('company_name') }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3 col-12">
                                <label class="form-label required" for="third_attention">Attention</label>
                            </div>

                            <div class="col-md-9 col-12">
                                <input type="text" autocomplete="off" id="third_attention" name="third_party[attention]" maxlength="30" placeholder="Sender's Name" class="form-control"  value="{{ old('attention') }}">
                            </div>
                        </div>

                    

                        <div class="row mb-3">
                            <div class="col-md-3 col-12">
                                <label class="form-label required" for="third_address">Address</label>
                            </div>

                            <div class="col-md-9 col-12">
                                <input type="text" autocomplete="off" id="third_address" name="third_party[address]" maxlength="30" placeholder="eg. 148 Brunswick Blvd" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3 col-12">
                                <label class="form-label" for="third_suite">Apt./Suite#</label>
                            </div>

                            <div class="col-md-9 col-12">
                                <input type="text" autocomplete="off" id="third_suite" name="third_party[suite]" maxlength="30" placeholder="eg. 101" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3 col-12">
                                <label class="form-label" for="third_suite">Department</label>
                            </div>

                            <div class="col-md-9 col-12">
                                <input type="text" autocomplete="off" id="third_suite" name="third_party[department]" maxlength="30" placeholder="eg. 101" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3 col-12">
                                <label for="third_country" class="form-label required">Country</label>
                            </div>

                            <div class="col-md-9 col-12">
                                <select name="third_party[country_id]" id="third_country" class="form-select" data-control="select2">
                                    @foreach($countries as $country)
                                        <option value="{{$country->id}}">{{{$country->name}}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3 col-12">
                                <label class="form-label required" for="third_postal_code">Postal Code</label>
                            </div>

                            <div class="col-md-9 col-12">
                                <input type="text" autocomplete="off" id="third_postal_code" name="third_party[postal_code]" placeholder="eg. H9R 5P9" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3 col-12">
                                <label class="form-label required" for="third_party_city">City</label>
                            </div>

                            <div class="col-md-9 col-12">
                                <input type="text" id="third_party_city" autocomplete="off" name="third_party[city]" placeholder="eg. Montreal" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3 col-12">
                                <label class="form-label" for="pickup_province">Province</label>
                            </div>

                            <div class="col-md-9 col-12">
                                <select name="third_party[province_id]" id="pickup_province" class="form-select select_class" data-control="select2">
                                
                                    <option value="0">Select Province</option>
                                    @foreach($provinces as $province)
                                    <option value="{{$province->id}}" {{ old('province_id') == $province->id ? 'selected' : '' }}>{{{$province->name}}}</option>
                                    @endforeach
                                
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label class="form-label required" for="third_phone">Phone</label>
                            </div>

                            <div class="col-md-4">
                                <input type="text" id="third_phone" autocomplete="off" name="third_party[phone]" placeholder="eg. 18663208383" class="form-control"  value="{{ old('phone') }}">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label" for="third_ext">Ext.</label>
                            </div>

                            <div class="col-md-3">
                                <input type="text" id="third_ext" autocomplete="off" name="third_party[ext]" placeholder="" class="form-control"  value="{{ old('ext') }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3 col-12">
                                <label class="form-label required" for="third_tracking_email">Tracking Emails</label>
                            </div>

                            <div class="col-md-9 col-12">
                                <input type="text" id="third_tracking_email" autocomplete="off" name="third_party[tracking_email]" placeholder="example@domain.com" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6 col-12 form-check">
                                <input type="checkbox" class="form-check-input" id="save_address_shipment" name="save_address_shipment" value="1">
                                <label class="form-label" for="save_address_shipment"> Save this address in your address book:</label>
                                
                            </div>

                            <div class="col-md-6 col-12 form-check">
                                <select name="pickup_address_group" id="pickup_address_group" class="form-select select_class" data-control="select2" disabled>
                                
                                    <option value="">Select</option>
                                        @foreach($addressGroups as $addressGroup)
                                            <option value="{{$addressGroup->id}}">{{$addressGroup->name}}</option>
                                        @endforeach
                                
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12 col-12 form-check">
                                <input type="checkbox" class="form-check-input" id="shippment_address_correction" name="third_party[address_correction]" value="1">
                                <label class="form-label" for="shippment_address_correction"> I do not want the address to be corrected automatically</label>
                                
                            </div>
                        </div>
                    </div>




                </x-card>
            </div>
            <div class="col-md-7">
                <x-card>
                    <x-slot name="title" class="gap-2">
                        <i class="fa-solid fa-archive text-white"></i> Packages
                    </x-slot>
                    <div class="row">
                        <div class="row mb-3">
                            <div class="col-md-3 col-12">
                                <label for="company_name" class="form-label required"># of Packages:</label>
                            </div>
    
                            <div class="col-md-2 col-12">
                                <input type="number" name="package[package_count]" id="package_count" class="form-control" min="1" max="50" value="{{old('package_count')}}" />
                            </div>
                            <div class="col-md-4 col-12">
                                <select name="package[type]" id="type" class="form-select">
                                    <option {{old('type') === "package" ? "selected" : ""}} value="package">Package (express box not included)</option>
                                    <option {{old('type') === "pack" ? "selected" : ""}} value="pack">Courier Pack (max 3 lbs)</option>
                                    <option {{old('type') === "letter" ? "selected" : ""}} value="letter">Courier Letter</option>
                                </select>                            
                            </div>
                            <div class="col-md-3 col-12">
                                <select name="package[unit]" id="unit" class="form-select">
                                    <option {{old('unit') === "imperial" ? "selected" : ""}} value="imperial">Imperial (Inch,Lbs)</option>
                                    <option {{old('unit') === "metric" ? "selected" : ""}} value="metric">Metric (Cm,Kg)</option>
                                </select>                            
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12 col-12 form-check" >
                                {{-- <div style="border-bottom: 2px dotted !important"> --}}
                                <input type="checkbox" id="options_special_handling" name="options[special_handling]" value="1" data-toggle="tooltip" data-placement="top" title="" data-original-title="If your package requires special handling, please check this (Extra fee will be charged)." data-gtm-form-interact-field-id="0">
                                <label class="form-label" for="options_special_handling"> Special Handling Required</label>
                                {{-- </div> --}}
                            </div>
                            <span class="help-block m-b-none">
                                The shipped items require special handling and will incur additional fees
                            </span>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-md-12 table-mobile">
                            <table class="table" id="packages-table">
                                <thead>
                                <tr>
                                    <th><label class="form-label required mb-0">Length</label></th>
                                    <th><label class="form-label required mb-0">Width</label></th>
                                    <th><label class="form-label required mb-0">Height</label></th>
                                    <th><label class="form-label required mb-0">Weight</label></th>
                                    <th><label class="form-label mb-0">Description</label></th>
                                    <th>&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <div class="mb-3">
                                            <label class="form-label d-sm-none required" for="packages_items_0_length">Length</label>
                                            <input type="number" name="packages[0][length]" id="packages[0][length]" required class="form-control" />
                                        </div>
                                    </td>
                                    <td>
                                        <div class="mb-3">
                                            <label class="form-label d-sm-none required" for="packages_items_0_width">Width</label>
                                            <input type="number" name="packages[0][width]" id="packages[0][width]" required class="form-control" />
                                        </div>
                                    </td>
                                    <td>
                                        <div class="mb-3">
                                            <label class="form-label d-sm-none required" for="packages_items_0_height">Height</label>
                                            <input type="number" name="packages[0][height]" id="packages[0][height]" required class="form-control" />
                                        </div>
                                    </td>
                                    <td>
                                        <div class="mb-3">
                                            <label class="form-label d-sm-none required" for="packages_items_0_weight">Weight</label>
                                            <input type="number" name="packages[0][weight]" id="packages[0][weight]" required class="form-control" />
                                        </div>
                                    </td>

                                    <td>
                                        <div class="mb-3">
                                            <label class="form-label d-sm-none" for="packages_items_0_description">Description</label>
                                            <input type="text" name="packages[0][description]" id="packages[0][description]" class="form-control" />
                                        </div>
                                    </td>

                                    <td>
                                        <div class="d-flex gap-3">
                                            <button type="button" id="copy-to-all" class="btn btn-success btn-sm" style="white-space: nowrap;" title="Copy to All"data-toggle="tooltip" data-placement="top">
                                                <i class="fa-solid fa-copy"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm delete-row" style="white-space: nowrap;" title="Delete" data-toggle="tooltip" data-placement="top">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12 col-12 form-check" >
                         
                            <input type="checkbox" id="packages_save_package" name="packages[save_package]" value="1" data-toggle="tooltip" data-placement="top" title="" data-original-title="If your package requires special handling, please check this (Extra fee will be charged)." data-gtm-form-interact-field-id="0">
                            <label class="form-label" for="packages_save_package"> Save package in your Package Book</label>
                           
                        </div>
                    </div>
                    <div class="row mb-3 d-none" id="save_package_name">
                        <div class="col-md-3 col-12">
                            <label class="form-label" for="packages_name">Package Configuration Name</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <input type="text" id="packages_name" name="packages[name]" placeholder="" class="form-control"  value="{{ old('pickup_instruction') }}">
                        </div>
                    </div>
                </x-card>

                <x-card>
                    <x-slot name="title" class="gap-2">
                        <i class="fa-solid fa-check-square text-white"></i> Insurance
                    </x-slot>

                    <div class="row mb-3">
                        <div class="col-md-12 col-12 form-check">
                            <input type="checkbox" class="form-check-input" id="insurance_toggle_insurance" name="shipment[is_insurance]" value="1">
                            <label class="form-label" for="insurance_toggle_insurance"> I want to insure my shipment for more than 100 CAD$</label>
                        </div>
                        <span class="help-block m-b-none">
                            Insurance is not available for Third Party or Collect shipments as well as any Canpar shipments
                        </span>
                    </div>
                    <div id="insurance_check" style="background: white !important; padding: 2%; margin-bottom: 2%;" class="d-none">
                        <div class="help-block mb-3"> Pickup is based on local time of the shipper
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3 col-12">
                                <label class="form-label required" for="insurance_value">Total invoice value including freight in CAD$</label>
                            </div>
    
                            <div class="col-md-9 col-12">
                                <input type="text" id="insurance_value" name="insurance[value]" placeholder="eg. H9R 5P9" class="form-control"  value="{{ old('insurance[value]') }}">
                            </div>
                        </div>
    
                        <div class="row mb-3">
                            <div class="col-md-3 col-12">
                                <label class="form-label" for="insurance_description">Description</label>
                            </div>
    
                            <div class="col-md-9 col-12">
                                <input type="text" id="insurance_description" name="insurance[description]" placeholder="" class="form-control"  value="{{ old('insurance[description]') }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12 col-12 form-check" >
                             
                                <input type="checkbox" id="insurance_agreement" name="insurance[agreement]" value="1" data-toggle="tooltip" data-placement="top">
                                <label class="form-label" for="insurance_agreement"> I agree and understand that SHIPSCAN’s insurance does not apply to all items.</label>
                               
                            </div>
                        </div>
                        <div class="help-block mb-3">
                            For a list of products that can not be insured, click here
                        </div>

                    </div>

                </x-card>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 text-end">
                <!--begin::Submit button-->
                <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                    <!--begin::Indicator label-->
                    <span class="indicator-label"><i class="fa fa-paper-plane"></i> Send</span>
                    <!--end::Indicator label-->
                    <!--begin::Indicator progress-->
                    <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    <!--end::Indicator progress-->
                </button>
                <!--end::Submit button-->
            </div>
        </div>
    </form>

    <div class="modal fade" tabindex="-1" id="addressbook_modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header py-3 bg-primary">
                    <h3 class="modal-title text-white">Address Book</h3>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-10">
                                <label class="form-label" for="address_group_id">Address Group</label>
                                <select name="address_group_id" id="address_group_id" class="form-select" data-control="select2" data-hide-search="true">
                                    <option value="">Select an address group</option>
                                    @foreach($addressGroups as $addressGroup)
                                        <option value="{{$addressGroup->id}}">{{$addressGroup->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <!--begin::Table-->
                    {{ $dataTable->table() }}
                    <!--end::Table-->
                </div>
            </div>
        </div>
    </div>

    <script id="package_prototype" type="text/template">
        <tr>
            <td>
                <div class="mb-3">
                    <label class="form-label d-sm-none required" for="packages_items___index___length">Length</label>
                    <input type="number" name="packages[__index__][length]" id="packages[__index__][length]" required class="form-control" />
                </div>
            </td>
            <td>
                <div class="mb-3">
                    <label class="form-label d-sm-none required" for="packages_items___index___width">Width</label>
                    <input type="number" name="packages[__index__][width]" id="packages[__index__][width]" required class="form-control" />
                </div>
            </td>
            <td>
                <div class="mb-3">
                    <label class="form-label d-sm-none required" for="packages_items___index___height">Height</label>
                    <input type="number" name="packages[__index__][height]" id="packages[__index__][height]" required class="form-control" />
                </div>
            </td>
            <td>
                <div class="mb-3">
                    <label class="form-label d-sm-none required" for="packages_items___index___weight">Weight</label>
                    <input type="number" name="packages[__index__][weight]" id="packages[__index__][weight]" required class="form-control" />
                </div>
            </td>
            <td>
                <div class="mb-3">
                    <label class="form-label d-sm-none" for="packages_items___index___description">Description</label>
                    <input type="text" name="packages[__index__][description]" id="packages[__index__][description]" class="form-control" />
                </div>
            </td>
            <td>
                <div class="d-flex gap-3">
                    <button type="button" class="btn btn-success btn-sm copy_above" style="white-space: nowrap;" title="Copy Above Inputs" data-toggle="tooltip" data-placement="top" id="__index__">
                        <i class="fa-solid fa-copy"></i>
                    </button>
                    <button type="button" class="btn btn-danger btn-sm delete-row" style="white-space: nowrap;" title="Delete" data-toggle="tooltip" data-placement="top">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>
            </td>
        </tr>
    </script>

    <input type="hidden" id="prefix_input" />
    @section('scripts')
        {{$dataTable->scripts()}}
    
        <script>
            $(document).ready(function() {
                $('#options_cod_toggle_cod').change(function() {
                    if ($(this).is(':checked')) {
                        $('#cod_check').removeClass('d-none');
                    } else {
                        $('#cod_check').addClass('d-none');
                    }
                });

                $('#insurance_toggle_insurance').change(function() {
                    if ($(this).is(':checked')) {
                        $('#insurance_check').removeClass('d-none');
                    } else {
                        $('#insurance_check').addClass('d-none');
                    }
                });
                $('#pickup_options_toggle_pickup').change(function() {
                    if ($(this).is(':checked')) {
                        $('#pickup_options_toggle_pickup_check').removeClass('d-none');
                    } else {
                        $('#pickup_options_toggle_pickup_check').addClass('d-none');
                    }
                });

                $('#pickup_options_toggle_pickup').change(function() {
                    if ($(this).is(':checked')) {
                        $('#pickup_options_toggle_pickup_check').removeClass('d-none');
                    } else {
                        $('#pickup_options_toggle_pickup_check').addClass('d-none');
                    }
                });
                $('#packages_save_package').change(function() {
                    if ($(this).is(':checked')) {
                        $('#save_package_name').removeClass('d-none');
                    } else {
                        $('#save_package_name').addClass('d-none');
                    }
                });
                $('#options_signature_required_2').change(function() {
                    if ($(this).is(':checked')) {
                        $('#options_signature_required_2_check').removeClass('d-none');
                    } else {
                        $('#options_signature_required_2_check').addClass('d-none');
                    }
                });
                $('#payment_payer').change(function() {
                    var selectedOption = $(this).val();

                    if (selectedOption === 'Collect') {
                    $('#options_cod_toggle_cod').prop('disabled', true);
                    $('#cod_check').addClass('d-none');
                    $('#insurance_toggle_insurance').prop('disabled', true);
                    $('#account_number').removeClass('d-none');
                    $('#third_party_div').addClass('d-none');
                    } else if (selectedOption === 'My SHIPSCAN Account') {
                    $('#options_cod_toggle_cod').prop('disabled', false);
                    if ($('#options_cod_toggle_cod').is(':checked')) {
                        $('#cod_check').removeClass('d-none');
                    } else {
                        $('#cod_check').addClass('d-none');
                    }
                    $('#insurance_toggle_insurance').prop('disabled', false);
                    $('#account_number').addClass('d-none');
                    $('#third_party_div').addClass('d-none');
                    }else if(selectedOption === 'Third Party'){
                        $('#options_cod_toggle_cod').prop('disabled', true);
                        $('#cod_check').addClass('d-none');
                        $('#insurance_toggle_insurance').prop('disabled', true);
                        $('#account_number').removeClass('d-none');
                        $('#third_party_div').removeClass('d-none');
                    }
                });
                $('#save_address_shipment').change(function() {                    
                    if ($(this).is(':checked')) {
                    $('#pickup_address_group').removeAttr('disabled');
                    } else {
                    $('#pickup_address_group').attr('disabled', 'disabled');
                    }
                });
                $('#save_address_shipper').change(function() {
                    
                    
                    if ($(this).is(':checked')) {
                    $('#shipper_address_group').removeAttr('disabled');
                    } else {
                    $('#shipper_address_group').attr('disabled', 'disabled');
                    }
                });
                $('#save_address_receiver').change(function() {

                    
                    if ($(this).is(':checked')) {
                    $('#receiver_address_group').removeAttr('disabled');
                    } else {
                    $('#receiver_address_group').attr('disabled', 'disabled');
                    }
                });
            });
        </script>
    <script>
        function copy_prev(current_row_index) {

        const prev_row_index = current_row_index - 1;
        if (prev_row_index >= 0) {
            const currentRow = $(this).closest('tr');
            alert(currentRow);
            const aboveRow = $(`#packages-table tr:eq(${prev_row_index})`);

            // Copy data from the above row to the current row
            const inputsToCopy = ['length', 'width', 'height', 'weight', 'description'];
            inputsToCopy.forEach(input => {
                const inputName = `packages[${current_row_index}][${input}]`;
                alert(currentRow.find(`input[name="${inputName}"]`).val());

                currentRow.find(`input[name="${inputName}"]`).val(aboveRow.find(`input[name="${inputName}"]`).val());
            });
        }
    }
    </script>
        <script>
            $(function () {
                $('[data-bs-target="#addressbook_modal"]').on('click', function () {

                    $("#prefix_input").val( $(this).data('prefix') );
                });

                $('#address_group_id').on('change', function () {
                    LaravelDataTables["addresses-table"].ajax.reload();
                });
            });

            const Package = {
                container: $('#packages-table > tbody'),
                copyFirstRow: function (i = "all") {

                    const firstRow = Package.container.find('tr:first');
                    if (i === "all") {

                        $(`input[id$="[length]"]`).val(firstRow.find('input[id="packages[0][length]"]').val());
                        $(`input[id$="[height]"]`).val(firstRow.find('input[id="packages[0][height]"]').val());
                        $(`input[id$="[width]"]`).val(firstRow.find('input[id="packages[0][width]"]').val());
                        $(`input[id$="[weight]"]`).val(firstRow.find('input[id="packages[0][weight]"]').val());

                        $(`input[id$="[description]"]`).val(firstRow.find('input[id="packages[0][description]"]').val());
                    } else {

                        $(`input[id$="[${i}][length]"]`).val(firstRow.find('input[id="packages[0][length]"]').val());
                        $(`input[id$="[${i}][height]"]`).val(firstRow.find('input[id="packages[0][height]"]').val());
                        $(`input[id$="[${i}][width]"]`).val(firstRow.find('input[id="packages[0][width]"]').val());
                        $(`input[id$="[${i}][weight]"]`).val(firstRow.find('input[id="packages[0][weight]"]').val());

                        $(`input[id$="[${i}][description]"]`).val(firstRow.find('input[id="packages[0][description]"]').val());
                    }
                },
                copyAboveRow: function () {

                const currentRow = (this).closest('tr');
                const row_number =  currentRow.find('.copy_above').attr('id');
                alert(row_number);
                if (i === "all") {

                    $(`input[id$="[length]"]`).val(firstRow.find('input[id="packages[0][length]"]').val());
                    $(`input[id$="[height]"]`).val(firstRow.find('input[id="packages[0][height]"]').val());
                    $(`input[id$="[width]"]`).val(firstRow.find('input[id="packages[0][width]"]').val());
                    $(`input[id$="[weight]"]`).val(firstRow.find('input[id="packages[0][weight]"]').val());

                    $(`input[id$="[description]"]`).val(firstRow.find('input[id="packages[0][description]"]').val());
                } else {

                    $(`input[id$="[${i}][length]"]`).val(firstRow.find('input[id="packages[0][length]"]').val());
                    $(`input[id$="[${i}][height]"]`).val(firstRow.find('input[id="packages[0][height]"]').val());
                    $(`input[id$="[${i}][width]"]`).val(firstRow.find('input[id="packages[0][width]"]').val());
                    $(`input[id$="[${i}][weight]"]`).val(firstRow.find('input[id="packages[0][weight]"]').val());

                    $(`input[id$="[${i}][description]"]`).val(firstRow.find('input[id="packages[0][description]"]').val());
                }
                },
                types: {
                    package: function () {

                        $('#package_count, #unit').removeAttr('disabled');
                        Package.container.find('[name^="packages"]').removeAttr('disabled');
                    },
                    pack: function () {

                        Package.types.letter();
                        Package.container.find('[name$="[weight]"]').removeAttr('disabled');
                        $('#package_count, #unit').removeAttr('disabled');
                    },
                    letter: function () {

                        Package.container.find('[name$="[length]"]').attr('disabled', 'disabled');
                        Package.container.find('[name$="[width]"]').attr('disabled', 'disabled');
                        Package.container.find('[name$="[height]"]').attr('disabled', 'disabled');
                        Package.container.find('[name$="[weight]"]').attr('disabled', 'disabled');
                        $('#package_count, #unit').attr('disabled', 'disabled');
                    }
                }
            }

            $(function () {
                $('#package_count').on('change', function () {

                    let package_count = $(this).val();
                    if ( package_count > 50 ) package_count = 50;
                    for(let i = Package.container.children().length; i < package_count;) {

                        let template = $("#package_prototype").html().toString().replace(/__index__/g, i);
                        Package.container.append(template);
                        Package.copyFirstRow(i)
                        i++;
                    }

                    const type = $('#type').val();
                    Package.types[type]();

                    let i = 1;
                    Package.container.children().each(function() {
                        i > package_count && $(this).remove();
                        i++;
                    });
                });

                $('#type').on('change', function () {

                    const type = $(this).val();
                    Package.types[type]();
                });

                $('#copy-to-all').on('click', function () {

                    Package.copyFirstRow();
                });
                $('.copy_above').on('click', function () {

                    Package.copyAboveRow();
                });

                $('body').on('click', '.delete-row', function () {

                    $(this).closest('tr').remove();
                });
            });
        </script>
         <script type="text/javascript">
            flatpickr("#shipment_date_input", {
                dateFormat: "F-d-Y",
                  minDate: "today",
               });
        </script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                flatpickr("#time_from, #time_until", {
                    enableTime: true,
                    noCalendar: true,
                    dateFormat: "H:i",
                });
            });
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
      
        <script type="text/javascript"
            src="https://maps.google.com/maps/api/js?key={{ $google_key }}&libraries=places" >
        </script>
        <script>
            function extractExtension(phoneNumber) {
                // var extensionPattern = /(?:\s|ext\.?|#)\s*(\d+)/i;
                // var extensionMatch = phoneNumber.match(extensionPattern);

                // if (extensionMatch && extensionMatch[1]) {
                //     return extensionMatch[1];
                // }

                return '';
            }
        </script>
        
            <script>
                google.maps.event.addDomListener(window, 'load', initialize);
          
                function initialize() {
                    var input = document.getElementById('receiver_address');
                    var autocomplete = new google.maps.places.Autocomplete(input);
          
                    autocomplete.addListener('place_changed', function () {
                        var place = autocomplete.getPlace();
                        var placeId = place.place_id;
                        var address = place.formatted_address;
                        var postalCode = '';
                        for (var i = 0; i < place.address_components.length; i++) {
                            var component = place.address_components[i];
                            if (component.types.includes('postal_code')) {
                                postalCode = component.long_name;
                                break;
                            }
                        }
                        $('#receiver_postal_code').val(postalCode);
                        var city = '';
                        for (var i = 0; i < place.address_components.length; i++) {
                            var component = place.address_components[i];
                            if (component.types.includes('locality')) {
                                city = component.long_name;
                                break;
                            }
                        }
                        $('#receiver_city').val(city);
                        if (placeId) {
                            var service = new google.maps.places.PlacesService(document.createElement('div'));
                            service.getDetails({
                                placeId: placeId,
                                fields: ['formatted_phone_number']
                            }, function(placeResult, status) {
                                if (status === google.maps.places.PlacesServiceStatus.OK) {
                                    var phoneNumber = placeResult.formatted_phone_number;
                                    $('#receiver_phone').val(phoneNumber);
                                    var extension = extractExtension(phoneNumber);
                                    // $('#pickup_ext').val(phoneNumber);
                                }
                            });
                        }
                        var aptSuite = '';

                        // Check if the address has "subpremise" type component
                        for (var i = 0; i < place.address_components.length; i++) {
                            var component = place.address_components[i];
                            if (component.types.includes('subpremise')) {
                                aptSuite = component.long_name;
                                break;
                            }
                        }
                        $('#receiver_suite').val(aptSuite);
                    });
                }
            </script>

<script>
    google.maps.event.addDomListener(window, 'load', initialize);

    function initialize() {
        var input = document.getElementById('shipper_address');
        var autocomplete = new google.maps.places.Autocomplete(input);

        autocomplete.addListener('place_changed', function () {
            var place = autocomplete.getPlace();
            var placeId = place.place_id;
            var address = place.formatted_address;
            var postalCode = '';
            for (var i = 0; i < place.address_components.length; i++) {
                var component = place.address_components[i];
                if (component.types.includes('postal_code')) {
                    postalCode = component.long_name;
                    break;
                }
            }
            $('#shipper_postal_code').val(postalCode);
            var city = '';
            for (var i = 0; i < place.address_components.length; i++) {
                var component = place.address_components[i];
                if (component.types.includes('locality')) {
                    city = component.long_name;
                    break;
                }
            }
            $('#shipper_city').val(city);
            if (placeId) {
                var service = new google.maps.places.PlacesService(document.createElement('div'));
                service.getDetails({
                    placeId: placeId,
                    fields: ['formatted_phone_number']
                }, function(placeResult, status) {
                    if (status === google.maps.places.PlacesServiceStatus.OK) {
                        var phoneNumber = placeResult.formatted_phone_number;
                        $('#shipper_phone').val(phoneNumber);
                        var extension = extractExtension(phoneNumber);
                        // $('#pickup_ext').val(phoneNumber);
                    }
                });
            }
            var aptSuite = '';

            // Check if the address has "subpremise" type component
            for (var i = 0; i < place.address_components.length; i++) {
                var component = place.address_components[i];
                if (component.types.includes('subpremise')) {
                    aptSuite = component.long_name;
                    break;
                }
            }
            $('#shipper_suite').val(aptSuite);receiver
        });
    }
</script>
<script>
    $(".swap-address").click(function() {
            var prefix = $(this).data("prefix");

             // Get the shipper fields values
             var s_companyField = $("#shipper_company_name").val();
            var s_attentionField = $("#shipper_attention").val();
            var s_addressField = $("#shipper_address").val();
            var s_suiteField = $("#shipper_suite").val();
            var s_departmentField = $("#shipper_department").val();
            var s_countryField = $("#shipper_country").val();
            var s_postalCodeField = $("#shipper_postal_code").val();
            var s_cityField = $("#shipper_city").val();
            var s_provinceField = $("#shipper_province").val();
            var s_phoneField = $("#shipper_phone").val();
            var s_extField = $("#shipper_ext").val();
            var s_trackingEmailField = $("#shipper_tracking_email").val();

            // Get the receiver fields values
            var r_companyField = $("#receiver_company_name").val();
            var r_attentionField = $("#receiver_attention").val();
            var r_addressField = $("#receiver_address").val();
            var r_suiteField = $("#receiver_suite").val();
            var r_departmentField = $("#receiver_department").val();
            var r_countryField = $("#receiver_country").val();
            var r_postalCodeField = $("#receiver_postal_code").val();
            var r_cityField = $("#receiver_city").val();
            var r_provinceField = $("#receiver_province").val();
            var r_phoneField = $("#receiver_phone").val();
            var r_extField = $("#receiver_ext").val();
            var r_trackingEmailField = $("#receiver_tracking_email").val();

            // Swap shipper and receiver fields
            $("#shipper_company_name").val(r_companyField);
            $("#shipper_attention").val(r_attentionField);
            $("#shipper_address").val(r_addressField);
            $("#shipper_suite").val(r_suiteField);
            $("#shipper_department").val(r_departmentField);
            $("#shipper_country").val(r_countryField);
            $("#shipper_postal_code").val(r_postalCodeField);
            $("#shipper_city").val(r_cityField);
            $("#shipper_province").val(r_provinceField);
            $("#shipper_phone").val(r_phoneField);
            $("#shipper_ext").val(r_extField);
            $("#shipper_tracking_email").val(r_trackingEmailField);

            $("#receiver_company_name").val(s_companyField);
            $("#receiver_attention").val(s_attentionField);
            $("#receiver_address").val(s_addressField);
            $("#receiver_suite").val(s_suiteField);
            $("#receiver_department").val(s_departmentField);
            $("#receiver_country").val(s_countryField);
            $("#receiver_postal_code").val(s_postalCodeField);
            $("#receiver_city").val(s_cityField);
            $("#receiver_province").val(s_provinceField);
            $("#receiver_phone").val(s_phoneField);
            $("#receiver_ext").val(s_extField);
            $("#receiver_tracking_email").val(s_trackingEmailField);
        });
</script>
<script>
    $(".clear-fields").click(function() {
            var prefix = $(this).data("prefix");

            $("#" + prefix + "_address_correction").prop("checked", false);
            $("#" + prefix + "_company_name").val("");
            $("#" + prefix + "_attention").val("");
            $("#" + prefix + "_address").val("");
            $("#" + prefix + "_suite").val("");
            $("#" + prefix + "_dpt").val("");
            $("#" + prefix + "_country").val("");
            $("#" + prefix + "_postal_code").val("");
            $("#" + prefix + "_city").val("");
            $("#" + prefix + "_province").val("0");
            $("#" + prefix + "_phone").val("");
            $("#" + prefix + "_ext").val("");
            $("#" + prefix + "_tracking_email").val("");
            $("#" + prefix + "_is_commercial").prop("checked", false);
            $("#" + prefix + "_address_group").val("").prop("disabled", true);
        });
</script>
    @endsection
</x-base-layout>
