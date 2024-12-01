<x-base-layout>
    <style>
        .price-breakdown
        {
            font-size: 12px;

        }
        .text-right
        {
            text-align: right !important;
        }

        .pull-right {
            float: right!important;
        }
        
        .border-bottom {
            border-bottom: 1px solid #83d3ef !important;
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
    <form method="post" action="/confirm">
       

        @csrf
        <input type="hidden" name="shipment_id" value="{{$shipment_id}}">
        <div class="row mb-5">
           
            <div class="col-md-6">
                <div class="mb-5">
                    <x-card>
                        <x-slot name="title" class="gap-2">
                            <i class="fa-solid fa-truck text-white"></i> Shipper
                        </x-slot>
    
                        <div class="row">
                            <div class="col-lg-12">
                                <p class="border-bottom"><strong>{{$sender->address}}</strong></p> 
                                <p class="border-bottom"><strong>{{$sender->city}} , CA</strong></p>
                            </div>
                        </div>
    
                       
                        
                    </x-card>
                </div>
                <div class="mb-5">
                <x-card>
                    <x-slot name="title" class="gap-2">
                        <i class="fa-solid fa-truck text-white"></i> Service, Pickup and Transit
                    </x-slot>

                    <div class="row">
                        <div class="col-lg-12">
                            <p class="border-bottom">Tracking ID : <strong>{{$tracking_number}}</strong></p> 
                            <p class="border-bottom"><strong>{{$rates['courier_name']}}</strong></p> 
                            <p class="border-bottom"><strong>{{$rates['service_name']}}</strong></p>
                            <p class="border-bottom">Expected Delivery Date : <strong>{{$rates['expected_delivery_date']}}</strong></p>
                        </div>
                    </div>

                   
                    
                </x-card>
                </div>
                <div class="mb-5">
                <x-card>
                    <x-slot name="title" class="gap-2">
                        <i class="fa-solid fa-archive text-white"></i> Packages
                    </x-slot>

                    <table class="table border-bottom">
                        <thead>
                            <tr>
                                <th><span class="visible-lg visible-md">Length</span> <span class="visible-xs visible-sm">L</span></th> 
                                <th><span class="visible-lg visible-md">Height</span> <span class="visible-xs visible-sm">H</span></th> 
                                <th><span class="visible-lg visible-md">Width</span> <span class="visible-xs visible-sm">W</span></th> 
                                <th><span class="visible-lg visible-md">Weight</span> <span class="visible-xs visible-sm">W</span></th> 
                                <th><span class="visible-lg visible-md">PIN &amp; Description</span> <span class="visible-xs visible-sm">PIN &amp; Desc</span></th>
                            </tr>
                        </thead> 
                        <tbody>
                            <?php $total_weight = 0;?>
                           @foreach($packages as $package)
                            @foreach($package->items as $item)
                            <tr class="">
                                <td><p>{{$item->length}}"</p></td> 
                                <td><p>{{$item->width}}"</p></td> 
                                <td><p>{{$item->height}}"</p></td> 
                                <td><p style="white-space: nowrap;">{{$item->weight}} lbs</p></td> 
                                <td><p> N/A <br> <small>N/A</small></p></td>
                                <?php $total_weight += $item->weight; ?>
                            </tr>
                            @endforeach
                            
                            <tr class="border-top">
                                <th colspan="4">Package Type</th>
                                <td class="text-right">{{$package->type}}</td>
                            </tr> 
                            <tr>
                                <th colspan="4">Total packages</th>
                                <td class="text-right">{{$package->package_count}}</td>
                            </tr> 
                            <tr>
                                <th colspan="4">Total Weight</th> 
                                <td class="text-right">{{$total_weight}} lbs</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                   
                    
                </x-card>
                </div>

                

              
            </div>
            <div class="col-md-6">
                <div class="mb-5">

                    <x-card>
                        <x-slot name="title" class="gap-2">
                            <i class="fa-solid fa-truck text-white"></i> Receiver
                        </x-slot>
    
                        <div class="row">
                            <div class="col-lg-12">
                                <p class="border-bottom"><strong>{{$receiver->address}}</strong></p> 
                                <p class="border-bottom"><strong>{{$receiver->city}} , CA</strong></p>
                            </div>
                        </div>
    
                       
                        
                    </x-card>
                </div>
                <div class="mb-5">
                <x-card>
                    <x-slot name="title" class="gap-2">
                        <i class="fa-solid fa-truck text-white"></i> Price
                    </x-slot>

                    <div class="row">
                        <div class="col-lg-12">
                            <div id="" class="price-breakdown" style="">
                                <div class="col-xs-12">
                                    <table cellspacing="0" cellpadding="0" class="table-condensed table">
                                        <tr class="border-bottom">
                                            <th>Freight</th> 
                                            <td class="text-right">${{$rates['sub_details']['Freight']}}</td>
                                        </tr> 
                                        <tr>
                                            <th colspan="2">Surcharge</th>
                                        </tr> 
                                        <tr></tr> 
                                        <tbody><!----></tbody>
                                        <tbody>
                                            <tr class="">
                                                <th class="media-right" style="padding-left: 20px;">Residential surcharge</th> 
                                                <td class="text-right"> ${{$rates['sub_details']['Surcharge']['Residential surcharge']}}</td>
                                            </tr>
                                        </tbody>
                                        <tbody>
                                            <tr class="">
                                                <th class="media-right" style="padding-left: 20px;">Fuel surcharge</th> 
                                                <td class="text-right">${{$rates['sub_details']['Surcharge']['Fuel surcharge']}}</td>
                                            </tr>
                                        </tbody> 
                                        <tr class="border-bottom" style="display: none;">
                                            <th colspan="2" class="media-right"><em>No Surcharges</em></th>
                                        </tr> 
                                        <tr class="border-bottom">
                                            <th>Subtotal</th> 
                                            <td class="text-right">${{$rates['sub_details']['Subtotal']}}</td>
                                        </tr> 
                                        <tr>
                                            <th colspan="2">Taxes</th>
                                        </tr> 
                                        @foreach ($rates['sub_details']['Taxes'] as $taxType => $taxAmount)
                                        <tr class="">
                                            <th class="media-right" style="padding-left: 20px;">{{$taxType}}</th>
                                            <td class="text-right">${{$taxAmount}}</td>
                                        </tr> 
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                   
                    
                </x-card>
                </div>
                <div class="mb-5">
                <x-card>
                    <x-slot name="title" class="gap-2">
                        <i class="fa-solid fa-truck text-white"></i> Options
                    </x-slot>

                    <div class="row">
                        
                                <div class="col-md-6"><p class="border-bottom"><strong>Shipment Date :</strong> </p> 
                                    <p class="border-bottom"><strong>Is this a Residential Address</strong> </p> 
                                    <p class="border-bottom"><strong>Reference</strong></p>
                                    <p class="border-bottom"><strong>Delivery Driver Instructions</strong></p>
                                    <p class="border-bottom"><strong>Require a SIgnature on Delivery</strong></p>
                                    <p class="border-bottom"><strong>Saturday Delivery</strong></p>
                                    <p class="border-bottom"><strong>Tracking Emails</strong></p>
                                    <p class="border-bottom"><strong>COD</strong></p>
                                    <p class="border-bottom"><strong>Insurance</strong></p>
                                    <p class="border-bottom"><strong>Payment Type</strong></p>
                                </div>

                                <div class="col-md-6">
                                    <p class="border-bottom">{{$shipment->shipment_date ?: 'N/A'}}</p> 
                                    <p class="border-bottom">{{$receiver->is_residential == 1 ? 'Yes' : 'No'}}</p> 
                                    <p class="border-bottom">{{$shipment->reference ?: 'N/A'}}</p> 
                                    <p class="border-bottom">{{$shipment->driver_instructions ?: 'N/A'}}</p> 
                                    <p class="border-bottom">{{$shipment->signature_required ?: 'N/A'}}</p> 
                                    <p class="border-bottom">{{$shipment->saturday_delivery == 1 ? 'Yes' : 'No'}}</p> 
                                    <p class="border-bottom">{{$receiver->tracking_email ?: 'N/A'}}</p> 
                                    <p class="border-bottom">{{ $shipment->is_cod == 1 ? 'Yes' : 'No'}}</p> 
                                    <p class="border-bottom">{{$shipment->is_insurance == 1 ? 'Yes' : 'No'}}</p> 
                                    <p class="border-bottom">{{$shipment->payment_payer ?: 'N/A'}}</p> 
                                    
                                </div>
                           
                    </div>

                   
                    
                </x-card>
                </div>

                

              
            </div>
        </div>
        
    </form>

  
    @section('scripts')
    <script>
        $(document).ready(function() {

            $('input[type="radio"][name="courier_check"]').change(function() {
            var selectedValue = $(this).val();
            $('#selected_courier').val(selectedValue);
            });

            $('.checkbox').on('click', function() {
                var targetDiv = '#' + $(this).data('target');
                $('.price-breakdown').addClass('d-none');
                $('tr').removeClass('selected-row');
                
                if ($(this).is(':checked')) {
                    $(targetDiv).removeClass('d-none');
                            $(this).closest('tr').addClass('selected-row');
                } else {
                    $('tr').removeClass('selected-row');
                }
            });
        });
      </script>
       
    @endsection
</x-base-layout>
