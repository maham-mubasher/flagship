<x-base-layout>

    <style>
        .price-breakdown
        {
            font-size: 12px;

        }
        table>tbody>tr>td, table>tbody>tr>th, table>tfoot>tr>td, table>tfoot>tr>th, table>thead>tr>td, table>thead>tr>th 
        {
            border-top: none;
            border-bottom: 1px solid #83d3ef !important;
        }
        tr:hover:not(thead tr)
        {
            background-color: #f5f5f5 !important; 
        }
        tr.selected-row {
            background-color: #faf2cc !important;
        }
        tr.selected-row:hover {
            background-color: #faf2cc !important;
        }
        .text-right
        {
            text-align: right !important;
        }
        .table-condensed>tr:hover
        {
            background-color: #faf2cc;
        }
        .pull-right {
            float: right!important;
        }
        .table-condensed, .table-condensed>tbody, .table-condensed>tbody>tr, .table-condensed>tbody>tr>td, .table-condensed>tbody>tr>th
        {
            padding: 0;
            margin: 0;
            border: none;
        }
        .table-condensed > :not(caption) > * > *
        {
            padding: 0%;
            border: none !important;
            background-color: #faf2cc;
        }
        .table-condensed > :not(caption) > * > *:hover
        {
            background-color: #faf2cc;
        }
        .table th
        {
            font-weight: bold !important;
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
    <form method="post" action="/convert_qoute">

        @csrf        
        <div class="row mb-5">
            <div class="col-md-12">
                <div style="border: 1px solid #009ef7 !important">
                <x-card>
                    <input type="hidden" name="shipment" value="{{$shipment_id}}">
                    <table class="table table-main border-bottom" style="font-size: 125%; font-weight: 400">
                        <thead>
                            <tr style="font: bold !important">
                                <th><span class="">Courier</span></th> 
                                <th><span class="">Service</span></th> 
                                <th class="text-right"><span >Total</span></th> 
                            </tr>
                        </thead> 
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach($rates as $item)

                            
                            
                            <tr class="">
                                <td><p>{{$item['courier_name']}}</p></td> 
                                <td><p>{{$item['service_name']}} <br><span style="font-size:12px;"> <i>Delivered on {{$item['expected_delivery_date']}}</i></span> </p></td> 
                                <td>
                                    <div id="details_{{$i}}" class="price-breakdown d-none" style="">
                                        <div class="col-xs-12">
                                            <table cellspacing="0" cellpadding="0" border="0" class="table-condensed table pull-right">
                                                <tr class="border-bottom">
                                                    <th>Freight</th> 
                                                    <td class="text-right">${{$item['sub_details']['Freight']}}</td>
                                                </tr> 
                                                <tr>
                                                    <th colspan="2">Surcharge</th>
                                                </tr> 
                                                <tr></tr> 
                                                <tbody><!----></tbody>
                                                <tbody>
                                                    <tr class="">
                                                        <th class="media-right" style="padding-left: 20px;">Residential surcharge</th> 
                                                        <td class="text-right"> ${{$item['sub_details']['Surcharge']['Residential surcharge']}}</td>
                                                    </tr>
                                                </tbody>
                                                <tbody>
                                                    <tr class="">
                                                        <th class="media-right" style="padding-left: 20px;">Fuel surcharge</th> 
                                                        <td class="text-right">${{$item['sub_details']['Surcharge']['Fuel surcharge']}}</td>
                                                    </tr>
                                                </tbody> 
                                                <tr class="border-bottom" style="display: none;">
                                                    <th colspan="2" class="media-right"><em>No Surcharges</em></th>
                                                </tr> 
                                                <tr class="border-bottom">
                                                    <th>Subtotal</th> 
                                                    <td class="text-right">${{$item['sub_details']['Subtotal']}}</td>
                                                </tr> 
                                                <tr>
                                                    <th colspan="2">Taxes</th>
                                                </tr> 
                                                @foreach ($item['sub_details']['Taxes'] as $taxType => $taxAmount)
                                                <tr class="">
                                                    <th class="media-right" style="padding-left: 20px;">{{$taxType}}</th>
                                                    <td class="text-right">${{$taxAmount}}</td>
                                                </tr> 
                                                @endforeach
                                            </table>
                                        </div>
                                    </div>
                                    
                                    <p class="text-right"><b>{{$item['total']}}</b></p>
                                </td>
                                <td id="checkbox_{{$i}}"><input type="radio" name="courier_check" class="checkbox" data-target="details_{{$i}}" value="{{$item['courier_name']}} - {{$item['service_name']}} - {{$item['total']}} - {{json_encode($item)}}"></td>
                                <?php $i++; ?>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </x-card>
                </div>
            </div>
           
        </div>
        <div class="row mb-5">
            <div class="col-md-3">
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
            <div class="col-md-3">
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
            <div class="col-md-6">
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
        <div class="row mb-5">
            <div class="col-md-12">
                <x-card>
                    <x-slot name="title" class="gap-2">
                        <i class="fa-solid fa-info-circle text-white"></i> About this service
                    </x-slot>

                    <div class="row">
                        <div class="col-lg-12">
                            <ul>
                                <li id="transit-warning" class="m-t-sm" style="">Please note this transit time is not guaranteed. For more information, please see our <a href="https://www.SHIPSCANcompany.com/terms-and-conditions" target="_blank">Terms and Conditions</a>.</li> 
                                <li id="express-transit-warning" class="m-t-sm" style="display: none;">The service guarantee will not apply to Express shipments that require special handling, shipments that contains Dangerous Goods and any Heavyweight Shipments</li> 
                                <li id="commercial-warning" class="m-t-sm" style="display: none;">The residential option was not selected. However, if the delivery location is a residence as per courier’s discretion, an additional residential charge will be added to the rate shown above.</li> 
                                <li id="fedex-express-international-warning" class="m-t-sm" style="display: none;">For shipments going out of Canada: The rates appearing above do not include custom clearance fees. Once converted to a shipment, the rate will include custom processing fees.</li> 
                                <li id="brokerage-warning" class="m-t-sm" style="display: none;">This shipment will be automatically cleared by UPS brokerage department.</li> 
                                <li id="dhl-warning" class="m-t-sm" style="display: none;">Please note DHL will add a $20.00 admin fee if duty and tax is applied. No admin fee will apply if shipment contains document only.</li> 
                                <li id="no-brokerage-warning" class="m-t-sm" style="display: none;">The rates shown do not include brokerage fees, processing fees, duty, tax and other governmental charges if applicable.</li> 
                                <li id="no-duty-warning" class="m-t-sm" style="display: none;">The rates shown do not include duty, tax and other governmental charges if applicable.</li> 
                                <li id="fedex-international-warning" class="m-t-sm" style="display: none;">If you select your own custom broker to clear the shipment, FedEx will charge additional fees.</li> 
                                <li id="puro-osnr-warning" class="m-t-sm" style="display: none;">Purolator has deemed this address to be in a residential area. As such, the OSNR notification will appear on the shipping label giving the driver the option of leaving the package without a signature. If you require a signature, please go back and select "signature required" from the options section</li>
                            </ul>
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
                    <span class="indicator-label"><i class="fa fa-paper-plane"></i> Convert</span>
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

  
    @section('scripts')
    <script>
        $(document).ready(function() {

            $('input[type="radio"][name="courier_check"]').change(function() {
                var selectedValue = $(this).closest('input').find('.selected_a').val();
               
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
