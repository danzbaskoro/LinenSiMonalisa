<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px"
    data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <!--begin::Header-->
    <div class="app-sidebar-header d-none d-lg-flex px-6 pt-8 pb-4" id="kt_app_sidebar_header">
        <!--begin::Toggle-->
        <button type="button" data-kt-element="selected" class="btn btn-outline btn-custom btn-flex w-100"
            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" data-kt-menu-offset="0px, -1px">
            <!--begin::Logo-->
            <span class="d-flex flex-center flex-shrink-0 w-110px me-3">
                <img alt="Logo" src="{{ env('APP_URL') }}/assets/media/logos/logomonalisa.svg"
                    data-kt-element="logo" class="h-70px" />
            </span>
            <!--end::Logo-->
            <!--begin::Info-->
            {{-- <span class="d-flex flex-column align-items-start flex-grow-1">
            <span class="fs-5 fw-bold text-white text-uppercase" data-kt-element="title">Metronic</span>
            <span class="fs-7 fw-bold text-gray-700 lh-sm" data-kt-element="desc">Workspace</span>
        </span> --}}
            <!--end::Info-->

        </button>
        <!--end::Toggle-->

    </div>
    <!--end::Header-->
    <!--begin::Navs-->
    <div class="app-sidebar-navs flex-column-fluid mx-2 py-6" id="kt_app_sidebar_navs">
        <div id="kt_app_sidebar_navs_wrappers" class="hover-scroll-y my-2" data-kt-scroll="true"
            data-kt-scroll-activate="true" data-kt-scroll-height="auto"
            data-kt-scroll-dependencies="#kt_app_sidebar_header, #kt_app_sidebar_footer"
            data-kt-scroll-wrappers="#kt_app_sidebar_navs" data-kt-scroll-offset="5px">
            <!--begin::Quick links-->

            <!--end::Quick links-->
            <!--begin::Separator-->
            {{-- <div class="separator mx-10"></div> --}}
            <!--end::Separator-->
            <!--begin::Sidebar menu-->
            <div id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false"
                class="menu menu-column menu-rounded menu-sub-indention menu-active-bg">
                <!--begin:Menu item-->

                <div class="menu-item">
                    <!--begin::Menu link-->
                    <a class="menu-link" href="{{ route('daftar-steril') }}">
                        <!--begin::Bullet-->
                        <span class="menu-icon">
                            <i class="ki-outline ki-abstract-35 fs-2"></i>
                        </span>
                        <!--end::Bullet-->
                        <!--begin::Title-->
                        <span class="menu-title">Daftar Ajuan Sterilisasi</span>
                        <!--end::Title-->
                        <!--begin::Badge-->

                        <!--end::Badge-->
                    </a>
                    <!--end::Menu link-->
                </div>
                <div class="menu-item">
                    <!--begin::Menu link-->
                    <a class="menu-link" href="{{ route('ajuan-steril') }}">
                        <!--begin::Bullet-->
                        <span class="menu-icon">
                            <i class="ki-outline ki-notification-status fs-1"></i>
                        </span>
                        <!--end::Bullet-->
                        <!--begin::Title-->
                        <span class="menu-title">Ajuan Sterilisasi</span>
                        <!--end::Title-->
                        <!--begin::Badge-->

                        <!--end::Badge-->
                    </a>
                    <!--end::Menu link-->
                </div>
                <div class="menu-item">
                    <!--begin::Menu link-->
                    <a class="menu-link" href="{{ route('ajuan-laundry') }}">
                        <!--begin::Bullet-->
                        <span class="menu-icon">
                            <i class="ki-outline ki-notification-status fs-1"></i>
                        </span>
                        <!--end::Bullet-->
                        <!--begin::Title-->
                        <span class="menu-title">Ajuan Laundry</span>
                        <!--end::Title-->
                        <!--begin::Badge-->

                        <!--end::Badge-->
                    </a>
                    <!--end::Menu link-->
                </div>
                <!--end:Menu item-->

            </div>
            <!--end:Menu item-->

        </div>
        <!--end::Sidebar menu-->
        <!--begin::Separator-->
        <div class="separator mx-10"></div>
        <!--end::Separator-->

    </div>
</div>
<!--end::Navs-->
