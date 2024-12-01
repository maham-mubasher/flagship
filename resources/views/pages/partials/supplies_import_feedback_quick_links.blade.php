<div class="card mb-5 mb-xxl-8 bg-primary">
    <div class="card-body py-0">
        <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
            <li class="nav-item">
                <a href="{{route('order-supplies.index')}}"
                   class="nav-link text-active-light text-light ms-0 me-10 py-5 {{(request()->is('order-supplies/*') or request()->is('order-supplies')) ? "active" : ""}}">
                    Order Supplies
                </a>
            </li>

            <li class="nav-item">
                <a href="{{route('import-quotes.index')}}"
                   class="nav-link text-active-light text-light ms-0 me-10 py-5 {{(request()->is('import-quotes/*') or request()->is('import-quotes')) ? "active" : ""}}">
                    Import Quote
                </a>
            </li>

            <li class="nav-item">
                <a href="{{route('feedback.index')}}"
                   class="nav-link text-active-light text-light ms-0 me-10 py-5 {{(request()->is('feedback/*') or request()->is('feedback')) ? "active" : ""}}">
                    Feedback
                </a>
            </li>
        </ul>
    </div>
</div>
