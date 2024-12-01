<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <form class="form w-100" novalidate="novalidate" method="post" action="{{route('address-groups.update', $addressGroup)}}" id="kt_update_address_group_form">
            @method('put')

            <div class="modal-header">
                <h3 class="modal-title">@lang('Edit Address Group')</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">
                @csrf

                <div class="fv-row mb-8 fv-plugins-icon-container fv-plugins-bootstrap5-row-valid">
                    <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="{{$addressGroup->name}}" />
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <!--begin::Submit button-->
                <button type="submit" id="update_address_group_submit" class="btn btn-primary">
                    @include('partials.general._button-indicator', ['label' => __('Submit')])
                </button>
                <!--end::Submit button-->
            </div>
        </form>
    </div>
</div>
