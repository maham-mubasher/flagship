<x-base-layout>

    @section('toolbar_actions')
        <div class="d-flex flex-wrap">
            <a href="{{route('products.create')}}" class="btn btn-primary btn-sm font-weight-bolder me-4">
                <i class="fa-solid fa-plus"></i> Add New
            </a>
            <a href="{{route('products.import')}}" class="btn btn-success btn-sm font-weight-bolder">
                <i class="fa-solid fa-file-import"></i> Import CSV
            </a>
        </div>
    @endsection

    @include('pages.partials.address_package_product_quick_links')

    <div class="card card-custom">
        <div class="card-body">
            <!--begin::Table-->
            {{ $dataTable->table() }}
            <!--end::Table-->
        </div>
    </div>

    {{-- Inject Scripts --}}
    @section('scripts')
        {{ $dataTable->scripts() }}
    @endsection
</x-base-layout>
