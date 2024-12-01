{{--@foreach($errors->all() as $error)--}}
{{--    {{$error}}--}}
{{--@endforeach--}}
<div class="row">
    <div class="col-md-12">
        <div class="mb-10">
            <label class="form-label" for="packages_documents_only">
                <input type="checkbox" name="packages_documents_only" id="packages_documents_only" value="1" @if($package->packages_documents_only) checked @endif />
                This courier letter only contains documents. I do not require a commercial invoice.
            </label>
        </div>
    </div>

    <div class="col-md-12">
        <div class="mb-10">
            <label class="form-label required" for="name">Package Name</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" required value="{{old('name', $package->name)}}" />
            @error('name')
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-2">
        <label for="package_count" class="form-label required"># of Packages:</label>
    </div>

    <div class="col-md-3">
        <input type="number" name="package_count" id="package_count" class="form-control" min="1" max="50" value="{{old('package_count', $package->package_count)}}" />
    </div>

    <div class="col-md-4">
        <select name="type" id="type" class="form-select">
            <option {{old('type', $package->type) === "package" ? "selected" : ""}} value="package">Package (express box not included)</option>
            <option {{old('type', $package->type) === "pack" ? "selected" : ""}} value="pack">Courier Pack (max 3 lbs)</option>
            <option {{old('type', $package->type) === "letter" ? "selected" : ""}} value="letter">Courier Letter</option>
        </select>
    </div>

    <div class="col-md-3">
        <select name="unit" id="unit" class="form-select">
            <option {{old('unit', $package->unit) === "imperial" ? "selected" : ""}} value="imperial">Imperial (Inch,Lbs)</option>
            <option {{old('unit', $package->unit) === "metric" ? "selected" : ""}} value="metric">Metric (Cm,Kg)</option>
        </select>
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
                @forelse($package->items as $index => $item)
                    <tr>
                        <td>
                            <div class="mb-3">
                                <label class="form-label d-sm-none required" for="packages_items_0_length">Length</label>
                                <input type="number" name="packages[{{$index}}][length]" id="packages[{{$index}}][length]" value="{{$item->length}}" required class="form-control" />
                            </div>
                        </td>
                        <td>
                            <div class="mb-3">
                                <label class="form-label d-sm-none required" for="packages_items_0_width">Width</label>
                                <input type="number" name="packages[{{$index}}][width]" id="packages[{{$index}}][width]" value="{{$item->width}}" required class="form-control" />
                            </div>
                        </td>
                        <td>
                            <div class="mb-3">
                                <label class="form-label d-sm-none required" for="packages_items_0_height">Height</label>
                                <input type="number" name="packages[{{$index}}][height]" id="packages[{{$index}}][height]" value="{{$item->height}}" required class="form-control" />
                            </div>
                        </td>
                        <td>
                            <div class="mb-3">
                                <label class="form-label d-sm-none required" for="packages_items_0_weight">Weight</label>
                                <input type="number" name="packages[{{$index}}][weight]" id="packages[{{$index}}][weight]" value="{{$item->weight}}" required class="form-control" />
                            </div>
                        </td>

                        <td>
                            <div class="mb-3">
                                <label class="form-label d-sm-none" for="packages_items_0_description">Description</label>
                                <input type="text" name="packages[{{$index}}][description]" id="packages[{{$index}}][description]" value="{{$item->description}}" class="form-control" />
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
                @empty
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
                @endforelse
            </tbody>
        </table>
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

@section('scripts')
    <script>
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
