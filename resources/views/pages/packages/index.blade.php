<x-base-layout>

    @section('toolbar_actions')
        <div class="d-flex flex-wrap">
            <a href="{{route('packages.create')}}" class="btn btn-primary btn-sm font-weight-bolder me-4">
                <i class="fa-solid fa-plus"></i> Add New
            </a>
        </div>
    @endsection

    @include('pages.partials.address_package_product_quick_links')

    <x-card>
        <!--begin::Table-->
        {{ $dataTable->table() }}
        <!--end::Table-->
    </x-card>

    {{-- Inject Scripts --}}
    @section('scripts')
        {{ $dataTable->scripts() }}
    @endsection
</x-base-layout>
