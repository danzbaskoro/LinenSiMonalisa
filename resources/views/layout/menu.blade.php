<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <!--begin::Header-->
    <div class="app-sidebar-header d-none d-lg-flex px-6 pt-8 pb-4" id="kt_app_sidebar_header">
        <!--begin::Toggle-->
        <button type="button" data-kt-element="selected" class="btn btn-outline btn-custom btn-flex w-100" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" data-kt-menu-offset="0px, -1px">
            <!--begin::Logo-->
            <span class="d-flex flex-center flex-shrink-0 w-40px me-3">
                <img alt="Logo" src="{{ env('APP_URL') }}/assets/media/logos/logomonalisa.svg" data-kt-element="logo" class="h-30px" />
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
        <div id="kt_app_sidebar_navs_wrappers" class="hover-scroll-y my-2" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_header, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_navs" data-kt-scroll-offset="5px">
            <!--begin::Quick links-->
            
            <!--end::Quick links-->
            <!--begin::Separator-->
            {{-- <div class="separator mx-10"></div> --}}
            <!--end::Separator-->
            <!--begin::Sidebar menu-->
            <div id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false" class="menu menu-column menu-rounded menu-sub-indention menu-active-bg">
                <!--begin:Menu item-->
                
                <div class="menu-item">
                    <!--begin::Menu link-->
                    <a class="menu-link" href="{{ route('dashboard') }}">
                        <!--begin::Bullet-->
                        <span class="menu-icon">
                            <i class="ki-outline ki-home-2 fs-2"></i>
                        </span>
                        <!--end::Bullet-->
                        <!--begin::Title-->
                        <span class="menu-title">Dashboards</span>
                        <!--end::Title-->
                        <!--begin::Badge-->
                        
                        <!--end::Badge-->
                    </a>
                    <!--end::Menu link-->
                </div>
                <!--end:Menu item-->
                <!--begin:Menu item-->
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-outline ki-gift fs-2"></i>
                        </span>
                        <span class="menu-title">Master Data</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->
                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion">
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link" href="{{ route('data-alat') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Alat</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link" href="{{ route('data-ruang') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Ruangan</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link" href="{{ route('data-user') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">User</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                    </div>
                    <!--end:Menu sub-->
                </div>
                <!--end:Menu item-->
                <!--begin:Menu item-->
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-outline ki-graph-3 fs-1"></i>
                        </span>
                        <span class="menu-title">Steril</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->
                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion">
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link" href="{{ route('data-steril') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Data Steril</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link" href="{{ route('laporan') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Laporan Steril</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                        {{-- <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link" href="{{ route('grafik') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Grafik Steril</span>
                            </a>
                            <!--end:Menu link-->
                        </div> --}}
                        
                    </div>
                    <!--end:Menu sub-->
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
    <!--begin::Footer-->
    <div class="app-sidebar-footer d-flex flex-stack px-11 pb-10" id="kt_app_sidebar_footer">
        <!--begin::User menu-->
       
        <!--end::User menu-->
        <!--begin::Logout-->
        <a href="javascript:void(0)" class="btn btn-sm btn-outline btn-flex btn-custom px-3" onclick="logout()">
        <i class="ki-outline ki-entrance-left fs-2 me-2"></i>Logout</a>
        <!--end::Logout-->
    </div>
    <!--end::Footer-->
</div>