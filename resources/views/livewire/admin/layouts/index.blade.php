<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
    <!--begin::Page-->
    <div class="app-page flex-column flex-column-fluid" id="kt_app_page">

        <!--begin::Header-->
        @include('livewire.admin.layouts.partials.header')
        <!--end::Header-->

        <!--begin::Wrapper-->
        <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">

            <!--begin::Sidebar-->
            @include('livewire.admin.layouts.partials.sidebar')
            <!--end::Sidebar-->

            <!--begin::Main-->
            <div class="app-main flex-column flex-row-fluid" id="kt_app_main">

                <!--begin::Content wrapper-->
                <div class="d-flex flex-column flex-column-fluid">
                    @yield('content')
                </div>
                <!--end::Content wrapper-->

                <!--begin::Footer-->
                @include('livewire.admin.layouts.partials.footer')
                <!--end::Footer-->

            </div>
            <!--end:::Main-->

        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Page-->
</div>
