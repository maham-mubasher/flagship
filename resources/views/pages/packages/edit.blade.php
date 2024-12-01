<x-base-layout>

    @include('pages.partials.address_package_product_quick_links')

    <x-card>
        <form action="{{route('packages.update', $package)}}" method="post">
            @csrf
            @method('put')

            @include('pages.packages.partials._form')

            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fa-solid fa-paper-plane"></i> Submit
                    </button>
                </div>
            </div>
        </form>
    </x-card>
</x-base-layout>
