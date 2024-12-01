<div class="card mb-5 mb-xxl-8 bg-primary">
    <div class="card-body py-0">
        <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
            <li class="nav-item">
                <a href="{{route('address-groups.index')}}"
                   class="nav-link text-active-light text-light ms-0 me-10 py-5 {{(request()->is('address-groups/*') or request()->is('address-groups')) ? "active" : ""}}">
                    Address Books
                </a>
            </li>

            <li class="nav-item">
                <a href="{{route('products.index')}}"
                   class="nav-link text-active-light text-light ms-0 me-10 py-5 {{(request()->is('products/*') or request()->is('products')) ? "active" : ""}}">
                    Products
                </a>
            </li>

            <li class="nav-item">
                <a href="{{route('packages.index')}}"
                   class="nav-link text-active-light text-light ms-0 me-10 py-5 {{(request()->is('packages/*') or request()->is('packages')) ? "active" : ""}}">
                    Packages
                </a>
            </li>
        </ul>
    </div>
</div>
