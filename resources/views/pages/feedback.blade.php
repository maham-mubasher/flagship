<x-base-layout>
    @if(session()->has('success'))
        <div class="row">
            <div class="col-md-12">
                <!--begin::Alert-->
                <div class="alert bg-light-success d-flex flex-column flex-sm-row p-5 mb-10">
                    <!--begin::Icon-->
                    <i class="ki-duotone ki-shield-tick fs-2hx text-success me-4"><span class="path1"></span><span class="path2"></span></i>
                    <!--end::Icon-->

                    <!--begin::Wrapper-->
                    <div class="d-flex flex-column pe-0 pe-sm-10">
                        <!--begin::Content-->
                        <span>Your message was successfully sent to {{config('app.name')}} customer service.</span>
                        <!--end::Content-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Alert-->
            </div>
        </div>
    @endif

    @include('pages.partials.supplies_import_feedback_quick_links')

    <x-card>
        <x-slot name="title">Send Feedback</x-slot>
        <form action="{{route('feedback.store')}}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <textarea name="message" required id="message" cols="30" rows="5" class="form-control" placeholder="Type your message here..."></textarea>
                    </div>
                </div>

                <div class="col-md-12">
                    <!--begin::Submit button-->
                    <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                        <!--begin::Indicator label-->
                        <span class="indicator-label"><i class="fa fa-paper-plane"></i> Send</span>
                        <!--end::Indicator label-->
                        <!--begin::Indicator progress-->
                        <span class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        <!--end::Indicator progress-->
                    </button>
                    <!--end::Submit button-->
                </div>
            </div>
        </form>
    </x-card>
</x-base-layout>
