<div id="kt_app_sidebar" style="background-color: #337ab7;" class="app-sidebar flex-column" data-kt-drawer="true"
    data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
    data-kt-drawer-width="225px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <!--begin::Logo-->
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
        <!--begin::Logo image-->
        <a href="#">
            <img alt="Logo" src="{{ asset('/logo/logo-admin-white.png') }}"
                class="h-50px app-sidebar-logo-default" />
            <img alt="Logo" src="{{ asset('/logo/logo.png') }}" class="h-50px app-sidebar-logo-minimize" />
        </a>
        <!--end::Logo image-->

        <div id="kt_app_sidebar_toggle"
            class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary h-30px w-30px position-absolute top-50 start-100 translate-middle rotate"
            data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
            data-kt-toggle-name="app-sidebar-minimize">
            <i class="ki-duotone ki-black-left-line fs-3 rotate-180">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </div>
        <!--end::Sidebar toggle-->

    </div>
    <!--end::Logo-->
    <!--begin::sidebar menu-->
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <!--begin::Menu wrapper-->
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper">
            <!--begin::Scroll wrapper-->
            <div id="kt_app_sidebar_menu_scroll" class="scroll-y my-5 mx-3" data-kt-scroll="true"
                data-kt-scroll-activate="true" data-kt-scroll-height="auto"
                data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
                data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px"
                data-kt-scroll-save-state="true">
                <!--begin::Menu-->
                <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu"
                    data-kt-menu="true" data-kt-menu-expand="false">
                    <!--begin:Menu item-->


                    <div data-kt-menu-trigger="click"
                        class="menu-item @stack('dashboard') menu-dashboard  menu-accordion">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->is('admin') ? 'active' : '' }}" href="{{ url('admin/') }}">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-element-11 fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                </i>
                            </span>
                            <span class="menu-title">Dashboards</span>
                        </a>

                        {{-- <span class="menu-link">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-element-11 fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                </i>
                            </span>
                            <span class="menu-title">Dashboards</span>
                        </span> --}}
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    @foreach (Session::get('main_menu') as $mm)
                        <!--begin:Menu item-->
                        <div class="menu-item pt-5">
                            <!--begin:Menu content-->
                            <div class="menu-content">
                                <span class="menu-heading fw-bold text-uppercase fs-7">{{ $mm['name'] }}</span>
                            </div>
                            <!--end:Menu content-->
                        </div>
                        <!--end:Menu item-->
                        @foreach (Session::get('menu') as $menu)
                            @if ($menu['parent'] == $mm['id'])
                                @if ($menu['active'] == '1')
                                    @if (auth()->user()->id_role == '3')
                                        @if (
                                            $menu['name'] == 'Daftar Kemampuan' ||
                                                $menu['name'] == 'Permohonan Selesai' ||
                                                $menu['name'] == 'Permohonan Batal' ||
                                                $menu['name'] == 'Permohonan Inhouse')
                                            <div class="menu-item">
                                                <!--begin:Menu link-->
                                                <a class="menu-link @stack($menu['url']) "
                                                    href="{{ url('admin/' . $menu['url']) }}">
                                                    <span class="menu-icon">
                                                        <i class="bi {{ $menu['icon'] }} fs-3"></i>
                                                    </span>
                                                    <span
                                                        class="menu-title">{{ $menu['name'] == 'Permohonan Selesai' ? 'Permohonan' : $menu['name'] }}</span>
                                                </a>
                                                <!--end:Menu link-->
                                            </div>
                                        @endif
                                    @else
                                        <div class="menu-item">
                                            <!--begin:Menu link-->
                                            <a class="menu-link @stack($menu['url']) "
                                                href="{{ url('admin/' . $menu['url']) }}">
                                                <span class="menu-icon">
                                                    <i class="bi {{ $menu['icon'] }} fs-3"></i>
                                                </span>
                                                <span class="menu-title">{{ $menu['name'] }}</span>
                                            </a>
                                            <!--end:Menu link-->
                                        </div>
                                    @endif
                                @endif
                            @endif
                        @endforeach
                    @endforeach


                    <!--begin:Menu item-->
                    {{-- <div class="menu-item pt-5">
                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-7">Layouts</span>
                        </div>
                    </div> --}}
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    {{-- <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <!--begin:Menu link-->
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-element-7 fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                            <span class="menu-title">Layout Options</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <!--end:Menu link-->
                        <!--begin:Menu sub-->
                        <div class="menu-sub menu-sub-accordion">
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="layouts/light-sidebar.html">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Light Sidebar</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        <!--end:Menu sub-->
                    </div> --}}
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    {{-- <div class="menu-item pt-5">
                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-7">Help</span>
                        </div>
                    </div> --}}
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    {{-- <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="https://preview.keenthemes.com/html/metronic/docs/base/utilities"
                            target="_blank">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-rocket fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                            <span class="menu-title">Components</span>
                        </a>
                        <!--end:Menu link-->
                    </div> --}}
                    <!--end:Menu item-->

                </div>
                <!--end::Menu-->
            </div>
            <!--end::Scroll wrapper-->
        </div>
        <!--end::Menu wrapper-->
    </div>
    <!--end::sidebar menu-->
    <!--begin::Footer-->
    <div class="app-sidebar-footer flex-column-auto pt-2 pb-6 px-6" id="kt_app_sidebar_footer">
        <a href="{{ url('logout') }}" class="btn btn-flex flex-center btn-custom btn-primary px-0 h-40px w-100">
            <span class="btn-label">Sign Out</span>
            <i class="ki-duotone ki-document btn-icon fs-2 m-0">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </a>
    </div>
    <!--end::Footer-->
</div>
