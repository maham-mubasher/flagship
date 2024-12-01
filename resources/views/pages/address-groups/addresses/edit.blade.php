<x-base-layout>

    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">
                    @lang('New Address')
                    <span class="d-block text-muted pt-2 font-size-sm">@lang('Let me know the text you\'d like to add')</span>
                </h3>
            </div>
        </div>

        <div class="card-body">
            <form method="post" action="{{route('address-groups.addresses.update', ['address_group' => $addressGroup, 'address' => $address])}}">
                @csrf
                @method('PUT')

                @include('pages.address-groups.addresses.partials._form')

                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-lg btn-primary d-inline-block" data-kt-stepper-action="submit">
                                        <span class="indicator-label">
                                            Update
                                            <i class="ki-duotone ki-arrow-right fs-3 ms-2 me-0"><span class="path1"></span><span class="path2"></span></i>                                        </span>
                            <span class="indicator-progress">
                                            Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Inject Scripts --}}
    @section('scripts')
{{--        <script>--}}
{{--            "use strict";--}}
{{--            // Class definition--}}
{{--            var KTAddressGroup = function () {--}}
{{--                // Elements--}}
{{--                var form;--}}
{{--                var submitButton;--}}
{{--                var validator;--}}

{{--                console.log(form, submitButton, validator);--}}
{{--                // Handle form--}}
{{--                var handleForm = function (e) {--}}
{{--                    // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/--}}
{{--                    validator = FormValidation.formValidation(--}}
{{--                        form,--}}
{{--                        {--}}
{{--                            fields: {--}}
{{--                                'name': {--}}
{{--                                    validators: {--}}
{{--                                        notEmpty: {--}}
{{--                                            message: 'Address group name is required'--}}
{{--                                        }--}}
{{--                                    }--}}
{{--                                }--}}
{{--                            },--}}
{{--                            plugins: {--}}
{{--                                trigger: new FormValidation.plugins.Trigger(),--}}
{{--                                bootstrap: new FormValidation.plugins.Bootstrap5({--}}
{{--                                    rowSelector: '.fv-row',--}}
{{--                                    eleInvalidClass: '',--}}
{{--                                    eleValidClass: ''--}}
{{--                                })--}}
{{--                            }--}}
{{--                        }--}}
{{--                    );--}}

{{--                    // Handle form submit--}}
{{--                    submitButton.addEventListener('click', function (e) {--}}
{{--                        // Prevent button default action--}}
{{--                        e.preventDefault();--}}

{{--                        // Validate form--}}
{{--                        validator.validate().then(function (status) {--}}
{{--                            if (status === 'Valid') {--}}
{{--                                // Show loading indication--}}
{{--                                submitButton.setAttribute('data-kt-indicator', 'on');--}}

{{--                                // Disable button to avoid multiple click--}}
{{--                                submitButton.disabled = true;--}}

{{--                                // Simulate ajax request--}}
{{--                                axios.post(submitButton.closest('form').getAttribute('action'), new FormData(form))--}}
{{--                                    .then(function (response) {--}}
{{--                                        window.location.reload();--}}
{{--                                    })--}}
{{--                                    .catch(function (error) {--}}
{{--                                        let dataMessage = error.response.data.message;--}}
{{--                                        let dataErrors = error.response.data.errors;--}}

{{--                                        for (const errorsKey in dataErrors) {--}}
{{--                                            if (!dataErrors.hasOwnProperty(errorsKey)) continue;--}}
{{--                                            dataMessage += "\r\n" + dataErrors[errorsKey];--}}
{{--                                        }--}}

{{--                                        if (error.response) {--}}
{{--                                            Swal.fire({--}}
{{--                                                text: dataMessage,--}}
{{--                                                icon: "error",--}}
{{--                                                buttonsStyling: false,--}}
{{--                                                confirmButtonText: "Ok, got it!",--}}
{{--                                                customClass: {--}}
{{--                                                    confirmButton: "btn btn-primary"--}}
{{--                                                }--}}
{{--                                            });--}}
{{--                                        }--}}
{{--                                    })--}}
{{--                                    .then(function () {--}}
{{--                                        // always executed--}}
{{--                                        // Hide loading indication--}}
{{--                                        submitButton.removeAttribute('data-kt-indicator');--}}

{{--                                        // Enable button--}}
{{--                                        submitButton.disabled = false;--}}
{{--                                    });--}}
{{--                            } else {--}}
{{--                                // Show error popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/--}}
{{--                                Swal.fire({--}}
{{--                                    text: "Sorry, looks like there are some errors detected, please try again.",--}}
{{--                                    icon: "error",--}}
{{--                                    buttonsStyling: false,--}}
{{--                                    confirmButtonText: "Ok, got it!",--}}
{{--                                    customClass: {--}}
{{--                                        confirmButton: "btn btn-primary"--}}
{{--                                    }--}}
{{--                                });--}}
{{--                            }--}}
{{--                        });--}}
{{--                    });--}}
{{--                }--}}

{{--                // Public functions--}}
{{--                return {--}}
{{--                    // Initialization--}}
{{--                    init: function () {--}}
{{--                        form = document.querySelector('#kt_address_group_form');--}}
{{--                        submitButton = document.querySelector('#kt_address_group_submit');--}}

{{--                        handleForm();--}}
{{--                    }--}}
{{--                };--}}
{{--            }();--}}

{{--            // On document ready--}}
{{--            KTUtil.onDOMContentLoaded(function () {--}}
{{--                KTAddressGroup.init();--}}
{{--            });--}}
{{--        </script>--}}
    @endsection
</x-base-layout>
