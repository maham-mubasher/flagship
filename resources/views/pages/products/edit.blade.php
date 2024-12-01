<x-base-layout>

    @include('pages.partials.address_package_product_quick_links')

    <div class="card card-custom">
        <div class="card-body">
            <form action="{{route('products.update', $product)}}" method="post">
                @csrf
                @method('put')

                @include('pages.products.partials._form')

                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fa-solid fa-paper-plane"></i> Submit
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-base-layout>
