<form class="form w-100 " novalidate="novalidate" action="{{route('address-groups.store')}}" id="kt_address_group_form">
    <div class="modal fade" tabindex="-1" id="kt_modal_stacked_1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">@lang('Add New Address Group')</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    @csrf

                    <div class="fv-row mb-8 fv-plugins-icon-container fv-plugins-bootstrap5-row-valid">
                        <input type="text" name="name" id="name" class="form-control" placeholder="Name" />
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <!--begin::Submit button-->
                    <button type="submit" id="kt_address_group_submit" class="btn btn-primary">
                        @include('partials.general._button-indicator', ['label' => __('Submit')])
                    </button>
                    <!--end::Submit button-->
                </div>
            </div>
        </div>
    </div>
</form>
