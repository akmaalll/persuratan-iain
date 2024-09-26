<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <title>Admin Apps - BPFK Makassar</title>
    <meta charset="utf-8" />
    <meta name="description" content="bpfk." />
    <meta name="keywords" content="bpfk" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="BPFK Makassar" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" href="{{ asset('/') }}logo/logo.png" />

    @livewireStyles
    {{-- @stack('cssScript') --}}
    @include('livewire.admin.layouts.partials._css')

</head>
<!--end::Head-->

<!--begin::Body-->

<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true"
    data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true"
    data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true"
    data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">

    <!--begin::Theme mode setup on page load-->
    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>
    <!--end::Theme mode setup on page load-->

    <!--begin::App-->
    {{ $slot }}
    <!--end::App-->

    <!--begin::Scrolltop-->
    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <i class="ki-duotone ki-arrow-up">
            <span class="path1"></span>
            <span class="path2"></span>
        </i>
    </div>
    <!--end::Scrolltop-->

    <!--begin::Modals-->
    {{-- @include('livewire.admin.layouts.partial.modal') --}}
    <!--end::Modals-->

    <!--begin::Javascript-->
    @livewireScripts

    @include('livewire.admin.layouts.partials._js')

    @stack('jsScriptForm')

    @stack('jsScript')
    <!--end::Javascript-->

</body>
<!--end::Body-->

</html>
