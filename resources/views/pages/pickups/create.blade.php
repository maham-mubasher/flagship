
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

  </style>

<x-base-layout>

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
                        <span>Your Pickup Has Been Successfully Scheduled.</span>
                        <!--end::Content-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Alert-->
            </div>
        </div>
    @endif

    @include('pages.partials.pickup_quick_links')
    @if ($errors->any())
    <ul class="error-list">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif
    <div class="row">
        <div class="col-md-12">
            <p>To receive a quote for your import shipment, simply provide full shipment information and click 'Send'. Upon submitting your quote request, we will send you shipping rates for each of our couriers along with instructions on how to process the shipment.</p>
        </div>
    </div>
    <form id="form1" method="post" action="{{route('pickups.store')}}">
        @csrf
        <div class="row mb-5">
            <div class="col-md-6">
                <x-card>
                    <x-slot name="title" class="gap-2"><i class="fa-solid fa-truck text-white"></i> Pickup Address</x-slot>
                    <x-slot name="tool">
                        <button type="button" class="btn btn-light btn-sm" data-bs-target="#addressbook_modal" data-prefix="pickup" data-bs-toggle="modal">Address Book</button>
                        <button type="button" class="ms-3 btn btn-light btn-sm" data-bs-target="#clear_all" data-prefix="pickup" data-bs-toggle="modal" onclick="confirmClear()">Clear</button>
                    </x-slot>

                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label for="company_name" class="form-label required">Company / Sender's Name</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <input type="text" id="company_name" name="company_name" required="required" maxlength="30" placeholder="Company / Sender's Name" class="form-control" value="{{ old('company_name') }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label class="form-label required" for="sender_name">Sender's Name</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <input type="text" id="sender_name" name="sender_name" required="required" maxlength="30" placeholder="Sender's Name" class="form-control"  value="{{ old('sender_name') }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label for="to_country" class="form-label required">Country</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <select name="country_id" id="pickup_country" class="form-select select_class" data-control="select2">
                                {{-- <option value="">---Select Country---</option> --}}
                                <option value="1" selected>Canada</option>
                                
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label class="form-label required" for="autocomplete">Address</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <input type="text" id="autocomplete" autocomplete="off" name="address" required="required" maxlength="30" placeholder="eg. 148 Brunswick Blvd" class="form-control"  value="{{ old('address') }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label class="form-label" for="pickup_suite">Apt./Suite#</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <input type="text" id="pickup_suite" autocomplete="off" name="suite" maxlength="30" placeholder="eg. 101" class="form-control" value="{{ old('suite') }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label class="form-label required" for="pickup_postal_code">Postal Code</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <input type="text" id="pickup_postal_code" autocomplete="off" name="postal_code" required="required" placeholder="eg. H9R 5P9" class="form-control"  value="{{ old('postal_code') }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label class="form-label required" for="pickup_city">City</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <input type="text" id="pickup_city" autocomplete="off" name="city" required="required" placeholder="eg. Montreal" class="form-control"  value="{{ old('city') }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label class="form-label" for="pickup_province">Province</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <select name="province_id" id="pickup_province" class="form-select select_class" data-control="select2">
                               
                                <option value="">Select Province</option>
                                @foreach($provinces as $province)
                                <option value="{{$province->id}}" {{ old('province_id') == $province->id ? 'selected' : '' }}>{{{$province->name}}}</option>
                                @endforeach
                               
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label class="form-label required" for="pickup_phone">Phone</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <input type="text" id="pickup_phone" autocomplete="off" name="phone" required="required" placeholder="eg. 18663208383" class="form-control"  value="{{ old('phone') }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label class="form-label" for="pickup_ext">Ext.</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <input type="text" id="pickup_ext" autocomplete="off" name="ext" placeholder="" class="form-control"  value="{{ old('ext') }}">
                        </div>
                    </div>
                </x-card>
            </div>

            <div class="col-md-6">
                <x-card>
                    <x-slot name="title" class="gap-2"><i class="fa-solid fa-truck text-white"></i> Pickup Information</x-slot>
                    <x-slot name="tool">
                        <button type="button" class="btn btn-light btn-sm" data-bs-target="" data-prefix="" data-bs-toggle="modal">Shipments for Pickups</button>
                    </x-slot>

                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label for="courier_name" class="form-label required">Courier</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <select name="courier_name" id="courier_name" class="form-select select_class" data-control="select2" required>
                                <option value="" selected="selected">--Select a Courier--</option>
                                <option value="ups" {{old('courier_name') === "ups" ? "selected" : ""}}>UPS</option>
                                {{-- <option value="dhl" {{old('courier_name') === "dhl" ? "selected" : ""}}>DHL</option> --}}
                                <option value="fedex" {{old('courier_name') === "fedex" ? "selected" : ""}}>FedEx</option>
                                <option value="purolator" {{old('courier_name') === "purolator" ? "selected" : ""}}>Purolator</option>
                                {{-- <option value="canpar" {{old('courier_name') === "canpar" ? "selected" : ""}}>Canpar</option> --}}
                                {{-- <option value="gls" {{old('courier_name') === "gls" ? "selected" : ""}}>GLS</option> --}}
                                <option value="loomis" {{old('courier_name') === "loomis" ? "selected" : ""}}>Loomis</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label class="form-label required" for="no_of_boxes">Nb's of Boxes</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <input type="text" id="no_of_boxes" name="package_count" required="required" maxlength="30" placeholder="" class="form-control"  value="{{ old('package_count') }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label class="form-label required" for="weight">Total Weight</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <input type="text" id="weight" name="weight" required="required" maxlength="30" placeholder="" class="form-control"  value="{{ old('weight') }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label for="to_country" class="form-label required">Units</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <select name="unit" id="unit" class="form-select select_class" data-control="select2">
                                <option value="">---Select Unit---</option>
                                <option {{old('unit') === "lb" ? "selected" : ""}} value="lb">Imperial (Inch,Lbs)</option>
                                <option {{old('unit') === "kg" ? "selected" : ""}} value="kg">Metric (Cm,Kg)</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label for="to_country" class="form-label required">To Country</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <select name="to_country_id" id="pickup_country" class="form-select select_class" data-control="select2">
                                {{-- <option value="">---Select Country---</option> --}}
                                <option value="1" selected>Canada</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label class="form-label required" for="pickup_address">Pickup Date</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <div class="input-group" id="pickup_date" data-td-target-input="nearest" data-td-target-toggle="nearest">
                                <input id="pickup_date_input" type="text" name="pickup_date" required="required" maxlength="30" value="{{ old('pickup_date') }}" class="form-control" data-td-target="#pickup_date"/>
                                <span class="input-group-text" data-td-target="#pickup_date" data-td-toggle="datetimepicker">
                                    <i class="ki-duotone ki-calendar fs-2"><span class="path1"></span><span class="path2"></span></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="help-block mb-3"><span class="fa fa-info-circle"></span> Pickup is based on local time of the shipper
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6 col-12">
                            <div class="row mb-3">
                                <div class="col-md-5">
                                    <label class="form-label required" for="time_from">Time From</label>
                                </div>

                                <div class="col-md-6">
                                    <input type="text" id="time_from" name="time_from" maxlength="30" placeholder="" class="form-control" value="{{ old('time_from') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="row mb-3">
                                <div class="col-md-5">
                                    <label class="form-label required" for="time_until">Time Until</label>
                                </div>

                                <div class="col-md-6">
                                    <input type="text" id="time_until" name="time_until" maxlength="30" placeholder="" class="form-control" value="{{ old('time_until') }}">
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label class="form-label required" for="pickup_location">Pickup Location</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <input type="text" id="pickup_location" name="pickup_location" required="required" placeholder="eg. H9R 5P9" class="form-control"  value="{{ old('pickup_location') }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label class="form-label" for="pickup_instructions">Pickup Instructions</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <input type="text" id="pickup_instructions" name="pickup_instruction" required="required" placeholder="" class="form-control"  value="{{ old('pickup_instruction') }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label class="form-label" for=""></label>
                        </div>

                        <div class="col-md-9 col-12 form-check">
                            <input type="checkbox" class="form-check-input" id="is_ground" name="is_ground" value="1"> Is ground
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
                    <span class="indicator-label"><i class="fa fa-paper-plane"></i> Schedule Pickup</span>
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


    <input type="hidden" id="prefix_input" />
    @section('scripts')
        {{$dataTable->scripts()}}

        <script>
            $(function () {
                $('[data-bs-target="#addressbook_modal"]').on('click', function () {

                    $("#prefix_input").val( $(this).data('prefix') );
                });

                $('#address_group_id').on('change', function () {
                    LaravelDataTables["addresses-table"].ajax.reload();
                });
            });

            // $(function () {
            //     $('[data-bs-target="#clear_all"]').on('click', function () {
            //         if(confirm("Want to clear?")){
			// 			$('#form1 input[type="text"]').val('');
			// 			$('#form1 input[type="checkbox"]').prop('checked',false);
            //             $('.select_class').val('0');
			// 		}
            //     });
            // });
        </script>
        <script>
            function confirmClear() {
                Swal.fire({
                    icon: 'question',
                    title: 'Confirmation',
                    text: 'Are you sure you want to clear all?',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#form1 input[type="text"]').val('');
						$('#form1 input[type="checkbox"]').prop('checked',false);
                        $('.select_class').val('');
                    }
                });
            }
        
            
        </script>

        <script type="text/javascript">
            flatpickr("#pickup_date_input", {
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
                    var input = document.getElementById('autocomplete');
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
                        $('#pickup_postal_code').val(postalCode);
                        var city = '';
                        for (var i = 0; i < place.address_components.length; i++) {
                            var component = place.address_components[i];
                            if (component.types.includes('locality')) {
                                city = component.long_name;
                                break;
                            }
                        }
                        $('#pickup_city').val(city);
                        if (placeId) {
                            var service = new google.maps.places.PlacesService(document.createElement('div'));
                            service.getDetails({
                                placeId: placeId,
                                fields: ['formatted_phone_number']
                            }, function(placeResult, status) {
                                if (status === google.maps.places.PlacesServiceStatus.OK) {
                                    var phoneNumber = placeResult.formatted_phone_number;
                                    $('#pickup_phone').val(phoneNumber);
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
                        $('#pickup_suite').val(aptSuite);
                    });
                }
            </script>
    @endsection
</x-base-layout>
