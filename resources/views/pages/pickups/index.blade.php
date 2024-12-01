<x-base-layout>

    @include('pages.partials.pickup_quick_links')

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
