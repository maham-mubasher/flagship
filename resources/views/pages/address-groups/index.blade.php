<x-base-layout>

    @section('toolbar_actions')
        <div class="d-flex flex-wrap">
            <button type="button" data-bs-toggle="modal" data-bs-target="#kt_modal_stacked_1" class="btn btn-primary btn-sm font-weight-bolder me-4">
                <i class="fa-solid fa-plus"></i> Add New
            </button>
            <a href="{{route('address-groups.import')}}" class="btn btn-success btn-sm font-weight-bolder">
                <i class="fa-solid fa-file-import"></i> Import CSV
            </a>
        </div>
    @endsection

    @include('pages.partials.address_package_product_quick_links')

    <x-card>
        <!--begin::Table-->
        {{ $dataTable->table() }}
        <!--end::Table-->
    </x-card>

    @include('pages.address-groups.partials._modal')

    <div class="modal fade" tabindex="-1" id="kt_update_address_group_modal"></div>


    {{-- Inject Scripts --}}
    @section('scripts')
        {{ $dataTable->scripts() }}
        <script>
            "use strict";
            // Class definition
            var KTAddressGroup = function () {
                // Elements
                var form;
                var submitButton;
                var validator;

                // Handle form
                var handleForm = function (e) {
                    // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
                    validator = FormValidation.formValidation(
                        form,
                        {
                            fields: {
                                'name': {
                                    validators: {
                                        notEmpty: {
                                            message: 'Address group name is required'
                                        }
                                    }
                                }
                            },
                            plugins: {
                                trigger: new FormValidation.plugins.Trigger(),
                                bootstrap: new FormValidation.plugins.Bootstrap5({
                                    rowSelector: '.fv-row',
                                    eleInvalidClass: '',
                                    eleValidClass: ''
                                })
                            }
                        }
                    );

                    // Handle form submit
                    submitButton.addEventListener('click', function (e) {
                        // Prevent button default action
                        e.preventDefault();

                        // Validate form
                        validator.validate().then(function (status) {
                            if (status === 'Valid') {
                                // Show loading indication
                                submitButton.setAttribute('data-kt-indicator', 'on');

                                // Disable button to avoid multiple click
                                submitButton.disabled = true;

                                // Simulate ajax request
                                axios.post(submitButton.closest('form').getAttribute('action'), new FormData(form))
                                    .then(function (response) {
                                        window.location.reload();
                                    })
                                    .catch(function (error) {
                                        let dataMessage = error.response.data.message;
                                        let dataErrors = error.response.data.errors;

                                        for (const errorsKey in dataErrors) {
                                            if (!dataErrors.hasOwnProperty(errorsKey)) continue;
                                            dataMessage += "\r\n" + dataErrors[errorsKey];
                                        }

                                        if (error.response) {
                                            Swal.fire({
                                                text: dataMessage,
                                                icon: "error",
                                                buttonsStyling: false,
                                                confirmButtonText: "Ok, got it!",
                                                customClass: {
                                                    confirmButton: "btn btn-primary"
                                                }
                                            });
                                        }
                                    })
                                    .then(function () {
                                        // always executed
                                        // Hide loading indication
                                        submitButton.removeAttribute('data-kt-indicator');

                                        // Enable button
                                        submitButton.disabled = false;
                                    });
                            } else {
                                // Show error popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                                Swal.fire({
                                    text: "Sorry, looks like there are some errors detected, please try again.",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                });
                            }
                        });
                    });
                }

                // Public functions
                return {
                    // Initialization
                    init: function () {
                        form = document.querySelector('#kt_address_group_form');
                        submitButton = document.querySelector('#kt_address_group_submit');

                        handleForm();
                    }
                };
            }();

            // On document ready
            KTUtil.onDOMContentLoaded(function () {
                KTAddressGroup.init();
            });
        </script>
    @endsection
</x-base-layout>
