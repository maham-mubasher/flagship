<div class="table-responsive">
    <table class="table align-middle table-rounded table-striped table-hover table-row-bordered gy-3 gs-7 fs-6">
        @isset($header)
            <thead> {!! $header !!} </thead>
        @endisset

        <tbody>{!! $slot !!}</tbody>
    </table>
</div>
