<div class="card card-custom" style="background-color: #e6f4fc;">
    @isset($title)
        <div class="card-header bg-primary">
            <div {{$title->attributes->merge(['class' => 'card-title text-white'])}}>{{$title}}</div>

            @isset($tool)
                <div class="card-toolbar">{{$tool}}</div>
            @endisset
        </div>
    @endisset

    <div class="card-body">
        {!! $slot !!}
    </div>
</div>
