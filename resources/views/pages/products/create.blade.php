<x-base-layout>

    <div class="card card-custom">
        <div class="card-body">
            <form action="{{route('products.store')}}" method="post">
                @csrf

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
