<x-base-layout>

    @section('toolbar_actions')
        <a href="{{route('address-groups.addresses.create', $addressGroup)}}" class="btn btn-primary btn-sm font-weight-bolder">
            <i class="fa-solid fa-plus"></i> Add New
        </a>
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
