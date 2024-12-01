<div class="card mb-5 mb-xxl-8 bg-primary">
    <div class="card-body py-0">
        <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
            <li class="nav-item">
                <a href="{{route('shipments.index')}}"
                   class="nav-link text-active-light text-light ms-0 me-10 py-5 {{(request()->is('shipments/*') or request()->is('shipments')) ? "active" : ""}}">
                    Manage Shipments
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('shipments.create')}}"
                   class="nav-link text-active-light text-light ms-0 me-10 py-5 {{(request()->is('shipments/*') or request()->is('shipments')) ? "active" : ""}}">
                    New Shipment
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('shipping/quote')}}"
                   class="nav-link text-active-light text-light ms-0 me-10 py-5 {{(request()->is('shipping/quote')) ? "active" : ""}}">
                    Courier Quote
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('shipping/summary')}}"
                   class="nav-link text-active-light text-light ms-0 me-10 py-5 {{(request()->is('shipping/summary')) ? "active" : ""}}">
                    Summary Report
                </a>
            </li>
            
        </ul>
    </div>
</div>
