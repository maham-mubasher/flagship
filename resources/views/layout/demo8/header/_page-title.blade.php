@php
    $breadcrumb = bootstrap()->getBreadcrumb();
@endphp

<div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">



        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                {{theme()->getPageTitle()}}
            </h1>
            <!--end::Title-->

            @if ( !empty($breadcrumb) )
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 pt-1">
                    @foreach ($breadcrumb as $item)
                        <!--begin::Item-->
                        @if ( $item['active'] === true )
                            <li class="breadcrumb-item text-dark">
                                {{ $item['title'] }}
                            </li>
                        @else
                            <li class="breadcrumb-item text-muted">
                                @if ( ! empty($item['path']) )
                                    <a href="{{ theme()->getPageUrl($item['path']) }}" class="text-muted text-hover-primary">
                                        {{ $item['title'] }}
                                    </a>
                                @else
                                    {{ $item['title'] }}
                                @endif
                            </li>
                        @endif
                        <!--end::Item-->
                        @if (next($breadcrumb))
                            <!--begin::Item-->
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-400 w-5px h-2px"></span>
                            </li>
                            <!--end::Item-->
                        @endif
                    @endforeach
                </ul>
                <!--end::Breadcrumb-->
            @endif
        </div>
        <!--end::Page title-->
        <!--begin::Actions-->
        @yield('toolbar_actions')
        <!--end::Actions-->
    </div>
    <!--end::Toolbar container-->
</div>
