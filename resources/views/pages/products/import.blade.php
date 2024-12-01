<x-base-layout>

    @include('pages.partials.address_package_product_quick_links')

    <div class="row">
        <div class="col-md-12">
            <!--begin::Alert-->
            <div class="alert bg-light-warning d-flex flex-column flex-sm-row p-5 mb-10">
                <!--begin::Icon-->
                <i class="ki-duotone ki-notification-bing fs-2hx text-primary me-4 mb-5 mb-sm-0 align-items-center"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                <!--end::Icon-->

                <!--begin::Wrapper-->
                <div class="d-flex flex-column pe-0 pe-sm-10">
                    <!--begin::Content-->
                    <span>To prepare your product list in CSV format, download the template file below.
Make sure you don't change the column names in the header or the file will be rejected.
Your data must respect the constraints mentioned in the template file.
Delete all lines except the first line, then fill your file with your data.
The maximum number of rows allowed is 500.<br />
                        <a href="/products.csv">Download template file</a>
                    </span>
                    <!--end::Content-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Alert-->
        </div>

        @if(!$errors->has('products_csv') and $errors->count())
            <!--begin::Alert-->
            <div class="alert bg-danger d-flex flex-column flex-sm-row p-5 mb-10">
                <!--begin::Icon-->
                <i class="ki-duotone ki-information fs-2hx text-light me-4 mb-5 mb-sm-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                <!--end::Icon-->

                <!--begin::Wrapper-->
                <div class="d-flex flex-column text-light pe-0 pe-sm-10">
                    <!--begin::Content-->
                    <span>
                        Something went wrong, please fix the following errors at row number {{session()->get('errorIndex')}}:
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </span>
                    <!--end::Content-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Alert-->
        @endif

        <div class="col-md-4">
            <x-card>
                <form method="post" enctype="multipart/form-data" action="{{route('products.store-import')}}">
                    @csrf

                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-10">
                                <label class="form-label required" for="products_csv">CSV File</label>
                                <input type="file" name="products_csv" id="products_csv" class="form-control @error('products_csv') is-invalid @enderror" accept=".csv" />
                                @error('products_csv')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fa-solid fa-paper-plane"></i> Submit
                            </button>
                        </div>
                    </div>
                </form>
            </x-card>
        </div>

        <div class="col-md-8">
            <x-card>
                <x-slot name="title">Instructions</x-slot>

                <strong>Follow the instructions carefully before importing the file.</strong>
                <p>The columns of the file should be in the following order.</p>

                <x-table>
                    <x-slot name="header">
                        <tr class="fw-bold fs-6 text-gray-800">
                            <th>Column Number</th>
                            <th>Column Name</th>
                        </tr>
                    </x-slot>

                    <tr>
                        <td>1</td>
                        <td>Name <small class="text-muted">(required)</small></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Description <small class="text-muted">(required)</small></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>HS Code <small class="text-muted">(option)</small></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Country of Origin <small class="text-muted">(required)</small></td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Weight <small class="text-muted">(option)</small></td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Unit of measurement <small class="text-muted">(required)</small></td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>Reference <small class="text-muted">(required)</small></td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>Unit Price <small class="text-muted">(required)</small></td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td>Unit <small class="text-muted">(required)</small></td>
                    </tr>
                </x-table>
            </x-card>
        </div>
    </div>
</x-base-layout>
