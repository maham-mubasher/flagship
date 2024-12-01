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

    @foreach($errors->all() as $error) {{$error}} @endforeach
    <div class="row">
        <div class="col-md-12">
            <p>To receive a quote for your import shipment, simply provide full shipment information and click 'Send'. Upon submitting your quote request, we will send you shipping rates for each of our couriers along with instructions on how to process the shipment.</p>
        </div>
    </div>
    <form method="post" action="{{route('import-quotes.store')}}">
        @csrf
        <div class="row mb-5">
            <div class="col-md-6">
                <x-card>
                    <x-slot name="title" class="gap-2"><i class="fa-solid fa-truck text-white"></i> Pickup</x-slot>
                    <x-slot name="tool">
                        <button type="button" class="btn btn-light btn-sm" data-bs-target="#addressbook_modal" data-prefix="pickup" data-bs-toggle="modal">Address Book</button>
                    </x-slot>

                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label for="to_country" class="form-label required">Country</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <select name="pickup[country_id]" id="pickup_country" class="form-select" data-control="select2">
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}">{{{$country->name}}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label class="form-label required" for="pickup_address">Address</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <input type="text" id="pickup_address" name="pickup[address]" required="required" maxlength="30" placeholder="eg. 148 Brunswick Blvd" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label class="form-label" for="pickup_suite">Apt./Suite#</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <input type="text" id="pickup_suite" name="pickup[suite]" maxlength="30" placeholder="eg. 101" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label class="form-label required" for="pickup_postal_code">Postal Code</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <input type="text" id="pickup_postal_code" name="pickup[postal_code]" required="required" placeholder="eg. H9R 5P9" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label class="form-label required" for="pickup_city">City</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <input type="text" id="pickup_city" name="pickup[city]" required="required" placeholder="eg. Montreal" class="form-control">
                        </div>
                    </div>
                </x-card>
            </div>

            <div class="col-md-6">
                <x-card>
                    <x-slot name="title" class="gap-2"><i class="fa-solid fa-sign-out text-white"></i> Delivery</x-slot>

                    <x-slot name="tool">
                        <button type="button" class="btn btn-light btn-sm" data-bs-target="#addressbook_modal" data-prefix="delivery" data-bs-toggle="modal">Address Book</button>
                    </x-slot>

                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label for="to_country" class="form-label required">Country</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <select name="delivery[country_id]" id="delivery_country" class="form-select">
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
                            <label class="form-label required" for="delivery_address">Address</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <input type="text" id="delivery_address" name="delivery[address]" required="required" maxlength="30" placeholder="eg. 148 Brunswick Blvd" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label class="form-label" for="delivery_suite">Apt./Suite#</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <input type="text" id="delivery_suite" name="delivery[suite]" maxlength="30" placeholder="eg. 101" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label class="form-label required" for="delivery_postal_code">Postal Code</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <input type="text" id="delivery_postal_code" name="delivery[postal_code]" required="required" placeholder="eg. H9R 5P9" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label class="form-label required" for="delivery_city">City</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <input type="text" id="delivery_city" name="delivery[city]" required="required" placeholder="eg. Montreal" class="form-control">
                        </div>
                    </div>
                </x-card>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-md-12">
                <x-card>
                    <x-slot name="title" class="gap-2">
                        <i class="fa-solid fa-archive text-white"></i> Packages
                    </x-slot>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-10">
                                <label class="form-label" for="shipment_value">Value of shipment</label>
                                <input type="text" name="shipment_value" id="shipment_value" class="form-control @error('shipment_value') is-invalid @enderror" required value="{{old('shipment_value')}}" />
                                @error('shipment_value')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-10">
                                <label for="package_count" class="form-label required"># of Packages:</label>
                                <input type="number" name="package_count" id="package_count" class="form-control" min="1" max="50" value="{{old('package_count')}}" />
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-10">
                                <label for="type" class="form-label required">Package Type</label>
                                <select name="type" id="type" class="form-select">
                                    <option {{old('type') === "package" ? "selected" : ""}} value="package">Package (express box not included)</option>
                                    <option {{old('type') === "pack" ? "selected" : ""}} value="pack">Courier Pack (max 3 lbs)</option>
                                    <option {{old('type') === "letter" ? "selected" : ""}} value="letter">Courier Letter</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-10">
                                <label for="unit" class="form-label required">Unit of measurement</label>
                                <select name="unit" id="unit" class="form-select">
                                    <option {{old('unit') === "imperial" ? "selected" : ""}} value="imperial">Imperial (Inch,Lbs)</option>
                                    <option {{old('unit') === "metric" ? "selected" : ""}} value="metric">Metric (Cm,Kg)</option>
                                </select>
                            </div>
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
                                    <th><label class="form-label">Description</label></th>
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
                                            <button type="button" id="copy-to-all" class="btn btn-success btn-sm" style="white-space: nowrap;">
                                                <i class="fa-solid fa-copy"></i> Copy to all
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm delete-row" style="white-space: nowrap;">
                                                <i class="fa-solid fa-trash"></i> Delete
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
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
                    <button type="button" class="btn btn-success btn-sm" style="white-space: nowrap;">
                        <i class="fa-solid fa-copy"></i> Copy above inputs
                    </button>
                    <button type="button" class="btn btn-danger btn-sm delete-row" style="white-space: nowrap;">
                        <i class="fa-solid fa-trash"></i> Delete
                    </button>
                </div>
            </td>
        </tr>
    </script>

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

                $('body').on('click', '.delete-row', function () {

                    $(this).closest('tr').remove();
                });
            });
        </script>
    @endsection
</x-base-layout>
