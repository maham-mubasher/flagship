<div class="card mb-5 mb-xxl-8 bg-primary">
    <div class="card-body py-0">
        <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
            <li class="nav-item">
                <a href="{{route('pickups.index')}}"
                   class="nav-link text-active-light text-light ms-0 me-10 py-5 {{(request()->is('pickups')) ? "active" : ""}}">
                    View Your Pickups
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('pickups.create')}}"
                   class="nav-link text-active-light text-light ms-0 me-10 py-5 {{(request()->is('pickups/create')) ? "active" : ""}}">
                    Schedule Pickup
                </a>
            </li>
            
        </ul>
    </div>
</div>
