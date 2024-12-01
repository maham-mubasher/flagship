<!--begin::Toolbar-->
<div class="{{ theme()->printHtmlClasses('header-container', false) }} py-6 py-lg-0 d-flex flex-column flex-lg-row align-items-lg-stretch justify-content-lg-between">
    {{ theme()->getView('layout/_page-title') }}

    <!--begin::Action group-->
    <div class="d-flex align-items-center overflow-auto pt-3 pt-lg-0">
        <!--begin::Action wrapper-->
        <div class="d-flex align-items-center">
            <!--begin::Actions-->
            <div class="d-flex">
                <!--begin::Notifications-->
                <div class="d-flex align-items-center">
                    <!--begin::Menu- wrapper-->
                    <a href="#" class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-30px h-30px w-md-40px h-md-40px"
                       data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end" data-kt-menu-flip="bottom">
                        {!! theme()->getIcon("notification-on", "fs-2 fs-lg-1") !!}
                    </a>
                    {{ theme()->getView('partials/topbar/_notifications-menu')  }}
                    <!--end::Menu wrapper-->
                </div>
                <!--end::Notifications-->

                <!--begin::Quick links-->
                <div class="d-flex align-items-center">
                    <!--begin::Menu wrapper-->
                    <a href="#"
                       class="btn btn-sm cursor-pointer symbol symbol-30px symbol-md-40px"
                       data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end" data-kt-menu-flip="bottom">
                        <!--begin::Symbol-->
                        <img src="{{ auth()->user()->avatar_url }}" alt="" />
                        <!--end::Symbol-->
                    </a>
                    {{ theme()->getView('partials/topbar/_user-menu') }}
                    <!--end::Menu wrapper-->
                </div>
                <!--end::Quick links-->
            </div>
            <!--end::Actions-->
        </div>
        <!--end::Action wrapper-->
    </div>
    <!--end::Action group-->
</div>
<!--end::Toolbar-->
