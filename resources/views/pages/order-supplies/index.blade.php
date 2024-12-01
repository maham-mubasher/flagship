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
                        <span>Your message was successfully sent to {{config('app.name')}} customer service.</span>
                        <!--end::Content-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Alert-->
            </div>
        </div>
    @endif

    @include('pages.partials.supplies_import_feedback_quick_links')

    <form method="post" action="{{route('order-supplies.store')}}">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <x-card>
                    <x-slot name="title" class="gap-2">
                        <i class="fa-solid fa-shopping-cart text-white"></i> Order Supplies
                    </x-slot>
                    <!--begin::Accordion-->
                    <div class="accordion" id="kt_accordion_1">
                        <div class="accordion-item" style="background: none;">
                            <h2 class="accordion-header" id="kt_accordion_1_header_1">
                                <button style="border-bottom: 1px solid #83d3ef;" class="bg-transparent accordion-button fs-4 fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#kt_accordion_1_body_1" aria-expanded="true" aria-controls="kt_accordion_1_body_1">
                                    <img src="{{asset(theme()->getMediaUrlPath().'logos/ups.png')}}" alt="ups logo" />
                                </button>
                            </h2>

                            <div id="kt_accordion_1_body_1" class="accordion-collapse collapse" aria-labelledby="kt_accordion_1_header_1" data-bs-parent="#kt_accordion_1">
                                <div class="accordion-body">

                                    <div class="row mb-3">
                                        <div class="col-md-3 col-sm-9">
                                            <label class="form-label" for="ups_waybill_pouches">Waybill pouches</label>
                                        </div>

                                        <div class="col-md-9 col-sm-12">
                                            <input type="number" id="ups_waybill_pouches" name="ups[waybill_pouches]" min="1" class="form-control" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-3 col-sm-12">
                                                <label class="form-label" for="ups_courier_envelopes">Courier envelopes</label>
                                        </div>

                                        <div class="col-md-9 col-sm-12">
                                            <input type="number" id="ups_courier_envelopes" name="ups[courier_envelopes]" min="1" class="form-control">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-3 col-sm-12">
                                                <label class="form-label" for="ups_courier_packs">Courier packs</label>
                                        </div>

                                        <div class="col-md-9 col-sm-12">
                                            <input type="number" id="ups_courier_packs" name="ups[courier_packs]" min="1" class="form-control">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-3 col-sm-12">
                                            <label class="form-label" for="ups_plain_white_envelopes">Plain white envelopes</label>
                                        </div>

                                        <div class="col-md-9 col-sm-12">
                                            <input type="number" id="ups_plain_white_envelopes" name="ups[plain_white_envelopes]" min="1" class="form-control">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-3 col-sm-12">
                                            <label class="form-label" for="ups_small_poly_bags">Small generic poly bags</label>
                                        </div>

                                        <div class="col-md-9 col-sm-12">
                                            <input type="number" id="ups_small_poly_bags" name="ups[small_poly_bags]" min="1" class="form-control">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-3 col-sm-12">
                                                <label class="form-label" for="ups_medium_poly_bags">Medium generic poly bags</label>
                                        </div>

                                        <div class="col-md-9 col-sm-12">
                                            <input type="number" id="ups_medium_poly_bags" name="ups[medium_poly_bags]" min="1" class="form-control">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-3 col-sm-12">
                                            <label class="form-label" for="ups_large_poly_bags">Large generic poly bags</label>
                                        </div>

                                        <div class="col-md-9 col-sm-12">
                                            <input type="number" id="ups_large_poly_bags" name="ups[large_poly_bags]" min="1" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item" style="background: none;">
                            <h2 class="accordion-header" id="kt_accordion_1_header_2">
                                <button style="border-bottom: 1px solid #83d3ef;" class="bg-transparent accordion-button fs-4 fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#kt_accordion_1_body_2" aria-expanded="true" aria-controls="kt_accordion_1_body_2">
                                    <img src="{{asset(theme()->getMediaUrlPath().'logos/dhl.png')}}" alt="ups logo" />
                                </button>
                            </h2>

                            <div id="kt_accordion_1_body_2" class="accordion-collapse collapse" aria-labelledby="kt_accordion_1_header_2" data-bs-parent="#kt_accordion_1">
                                <div class="accordion-body">

                                    <div class="row mb-3">
                                        <div class="col-md-3 col-sm-9">
                                            <label class="form-label" for="dhl_waybill_pouches">Waybill pouches</label>
                                        </div>

                                        <div class="col-md-9 col-sm-12">
                                            <input type="number" id="dhl_waybill_pouches" name="dhl[waybill_pouches]" min="1" class="form-control" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-3 col-sm-12">
                                                <label class="form-label" for="dhl_courier_envelopes">Courier envelopes</label>
                                        </div>

                                        <div class="col-md-9 col-sm-12">
                                            <input type="number" id="dhl_courier_envelopes" name="dhl[courier_envelopes]" min="1" class="form-control">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-3 col-sm-12">
                                                <label class="form-label" for="dhl_courier_packs">Courier packs</label>
                                        </div>

                                        <div class="col-md-9 col-sm-12">
                                            <input type="number" id="dhl_courier_packs" name="dhl[courier_packs]" min="1" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item" style="background: none;">
                            <h2 class="accordion-header" id="kt_accordion_1_header_fedex">
                                <button style="border-bottom: 1px solid #83d3ef;" class="bg-transparent accordion-button fs-4 fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#kt_accordion_1_body_fedex" aria-expanded="true" aria-controls="kt_accordion_1_body_fedex">
                                    <img src="{{asset(theme()->getMediaUrlPath().'logos/fedex.png')}}" alt="fedex logo" />
                                </button>
                            </h2>

                            <div id="kt_accordion_1_body_fedex" class="accordion-collapse collapse" aria-labelledby="kt_accordion_1_header_fedex" data-bs-parent="#kt_accordion_1">
                                <div class="accordion-body">

                                    <div class="row mb-3">
                                        <div class="col-md-3 col-sm-9">
                                            <label class="form-label" for="fedex_waybill_pouches">Waybill pouches</label>
                                        </div>

                                        <div class="col-md-9 col-sm-12">
                                            <input type="number" id="fedex_waybill_pouches" name="fedex[waybill_pouches]" min="1" class="form-control" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-3 col-sm-12">
                                                <label class="form-label" for="fedex_courier_envelopes">Courier envelopes</label>
                                        </div>

                                        <div class="col-md-9 col-sm-12">
                                            <input type="number" id="fedex_courier_envelopes" name="fedex[courier_envelopes]" min="1" class="form-control">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-3 col-sm-12">
                                                <label class="form-label" for="fedex_courier_packs">Courier packs</label>
                                        </div>

                                        <div class="col-md-9 col-sm-12">
                                            <input type="number" id="fedex_courier_packs" name="fedex[courier_packs]" min="1" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item" style="background: none;">
                            <h2 class="accordion-header" id="kt_accordion_1_header_purolator">
                                <button style="border-bottom: 1px solid #83d3ef;" class="bg-transparent accordion-button fs-4 fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#kt_accordion_1_body_purolator" aria-expanded="true" aria-controls="kt_accordion_1_body_purolator">
                                    <img src="{{asset(theme()->getMediaUrlPath().'logos/purolator.png')}}" alt="ups logo" />
                                </button>
                            </h2>

                            <div id="kt_accordion_1_body_purolator" class="accordion-collapse collapse" aria-labelledby="kt_accordion_1_header_purolator" data-bs-parent="#kt_accordion_1">
                                <div class="accordion-body">

                                    <div class="row mb-3">
                                        <div class="col-md-3 col-sm-9">
                                            <label class="form-label" for="purolator_waybill_pouches">Waybill pouches</label>
                                        </div>

                                        <div class="col-md-9 col-sm-12">
                                            <input type="number" id="purolator_waybill_pouches" name="purolator[waybill_pouches]" min="1" class="form-control" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-3 col-sm-12">
                                                <label class="form-label" for="purolator_courier_envelopes">Courier envelopes</label>
                                        </div>

                                        <div class="col-md-9 col-sm-12">
                                            <input type="number" id="purolator_courier_envelopes" name="purolator[courier_envelopes]" min="1" class="form-control">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-3 col-sm-12">
                                                <label class="form-label" for="purolator_courier_packs">Courier packs</label>
                                        </div>

                                        <div class="col-md-9 col-sm-12">
                                            <input type="number" id="purolator_courier_packs" name="purolator[courier_packs]" min="1" class="form-control">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-3 col-sm-12">
                                                <label class="form-label" for="purolator_online_shipping_labels">Online shipping labels</label>
                                        </div>

                                        <div class="col-md-9 col-sm-12">
                                            <input type="number" id="purolator_online_shipping_labels" name="purolator[online_shipping_labels]" min="1" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item" style="background: none;">
                            <h2 class="accordion-header" id="kt_accordion_1_header_gls">
                                <button style="border-bottom: 1px solid #83d3ef;" class="bg-transparent accordion-button fs-4 fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#kt_accordion_1_body_gls" aria-expanded="true" aria-controls="kt_accordion_1_body_gls">
                                    <img src="{{asset(theme()->getMediaUrlPath().'logos/gls.png')}}" alt="ups logo" />
                                </button>
                            </h2>

                            <div id="kt_accordion_1_body_gls" class="accordion-collapse collapse" aria-labelledby="kt_accordion_1_header_gls" data-bs-parent="#kt_accordion_1">
                                <div class="accordion-body">

                                    <div class="row mb-3">
                                        <div class="col-md-3 col-sm-9">
                                            <label class="form-label" for="gls_waybill_pouches">Waybill pouches (pack of 50)</label>
                                        </div>

                                        <div class="col-md-9 col-sm-12">
                                            <input type="number" id="gls_waybill_pouches" name="gls[waybill_pouches]" min="1" class="form-control" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-3 col-sm-12">
                                                <label class="form-label" for="gls_courier_envelopes">Courier envelopes (pack of 5)</label>
                                        </div>

                                        <div class="col-md-9 col-sm-12">
                                            <input type="number" id="gls_courier_envelopes" name="gls[courier_envelopes]" min="1" class="form-control">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-3 col-sm-12">
                                                <label class="form-label" for="gls_dex_pack">Dex pack(pack of 25)</label>
                                        </div>

                                        <div class="col-md-9 col-sm-12">
                                            <input type="number" id="gls_dex_pack" name="gls[dex_pack]" min="1" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item" style="background: none;">
                            <h2 class="accordion-header" id="kt_accordion_1_header_nationex">
                                <button style="border-bottom: 1px solid #83d3ef;" class="bg-transparent accordion-button fs-4 fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#kt_accordion_1_body_nationex" aria-expanded="true" aria-controls="kt_accordion_1_body_nationex">
                                    <img src="{{asset(theme()->getMediaUrlPath().'logos/nationex.png')}}" alt="ups logo" />
                                </button>
                            </h2>

                            <div id="kt_accordion_1_body_nationex" class="accordion-collapse collapse" aria-labelledby="kt_accordion_1_header_nationex" data-bs-parent="#kt_accordion_1">
                                <div class="accordion-body">

                                    <div class="row mb-3">
                                        <div class="col-md-3 col-sm-9">
                                            <label class="form-label" for="nationex_waybill_pouches">Waybill pouches</label>
                                        </div>

                                        <div class="col-md-9 col-sm-12">
                                            <input type="number" id="nationex_waybill_pouches" name="nationex[waybill_pouches]" min="1" class="form-control" />
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Accordion-->
                </x-card>
            </div>

            <div class="col-md-6">
                <x-card>
                    <x-slot name="title" class="gap-2">
                        <i class="fa-solid fa-sign-out text-white"></i> Ship to
                    </x-slot>

                    <x-slot name="tool">
                        <button type="button" class="btn btn-light btn-sm" data-bs-target="#addressbook_modal" data-bs-toggle="modal">Address Book</button>
                    </x-slot>

                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label class="form-label required" for="to_name">Company/Name</label>
                        </div>
                        <div class="col-md-9 col-12">
                            <input type="text" name="to[name]" id="to_name" class="form-control" placeholder="Company / Sender's Name" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label class="form-label required" for="to_attn">Attension</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <input type="text" id="to_attn" name="to[attn]" required="required" maxlength="21" placeholder="Sender's Name" class="form-control" autocomplete="off">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label class="form-label required" for="to_address">Address</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <input type="text" id="to_address" name="to[address]" required="required" maxlength="30" placeholder="eg. 148 Brunswick Blvd" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label class="form-label" for="to_suite">Apt./Suite#</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <input type="text" id="to_suite" name="to[suite]" required="required" maxlength="30" placeholder="eg. 101" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label for="to_country" class="form-label required">Country</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <select name="to[country_id]" id="to_country" class="form-select">
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}">{{{$country->name}}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label class="form-label required" for="to_postal_code">Postal Code</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <input type="text" id="to_postal_code" name="to[postal_code]" required="required" placeholder="eg. H9R 5P9" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label class="form-label required" for="to_city">City</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <input type="text" id="to_city" name="to[city]" required="required" placeholder="eg. Montreal" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label class="form-label required" for="to_province">Province</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <select name="to[province]" id="to_province" class="form-select">
                                @if($countries->count() === 1)
                                    <option value="">Select Province</option>
                                    @foreach($countries->first()->provinces as $province)
                                        <option value="{{$province->id}}">{{$province->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label class="form-label" for="to_phone">Phone</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <input type="text" id="to_phone" name="to[phone]" placeholder="eg. 18663208383" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label class="form-label" for="to_ext">Ext</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <input type="text" id="to_ext" name="to[ext]" placeholder="eg. 18663208383" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="to_note">Note</label>
                                <textarea name="to[note]" id="to_note" cols="30" rows="3" class="form-control"></textarea>
                            </div>
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

    {{-- Inject Scripts --}}
    @section('scripts')
        {{ $dataTable->scripts() }}
            <script>
                $(function () {
                    $('#address_group_id').on('change', function () {
                        LaravelDataTables["addresses-table"].ajax.reload();
                    });
                });
            </script>
    @endsection
</x-base-layout>
