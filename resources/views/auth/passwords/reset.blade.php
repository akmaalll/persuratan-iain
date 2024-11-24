<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: MetronicProduct Version: 8.2.6
Purchase: https://1.envato.market/EA4JP
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">
<!--begin::Head-->

<head>
    <base href="../../../" />
    <title>Reset Password - SISTEM INFORMASI KEARSIPAN IAIN PAREPARE</title>
    <meta charset="utf-8" />
    <meta name="description"
        content="The most advanced Bootstrap 5 Admin Theme with 40 unique prebuilt layouts on Themeforest trusted by 100,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel versions. Grab your copy now and get life-time updates for free." />
    <meta name="keywords"
        content="metronic, bootstrap, bootstrap 5, angular, VueJs, React, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel starter kits, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Reset Password - SISTEM INFORMASI KEARSIPAN IAIN PAREPARE" />
    <meta property="og:url" content="https://keenthemes.com/metronic" />
    <meta property="og:site_name" content="Metronic by Keenthemes" />
    <link rel="canonical" href="http://preview.keenthemes.comauthentication/layouts/overlay/new-password.html" />
    <link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('themes/dist/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('themes/dist/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    <script>
        // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }
    </script>
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="app-blank bgi-size-cover bgi-attachment-fixed bgi-position-center">
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
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <!--begin::Page bg image-->
        <style>
            body {
                background-image: url('{{ asset('/') }}logo/bg-iain.png');
            }

            [data-bs-theme="dark"] body {
                background-image: url('{{ asset('/') }}logo/bg-iain.png');
            }
        </style>
        <!--end::Page bg image-->
        <!--begin::Authentication - New password -->
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <!--begin::Aside-->
            <div class="d-flex flex-lg-row-fluid">
                <!--begin::Content-->
                <div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
                    <!--begin::Image-->
                    <a href="#" class="mb-7">
                        <img alt="Logo" src="{{ asset('/logo/logo-login.png') }}" style="width:100%" />
                    </a>
                    <!--end::Image-->
                    <!--begin::Title-->

                    <!--end::Text-->
                </div>
                <!--end::Content-->
            </div>
            <!--begin::Aside-->
            <!--begin::Body-->
            <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
                <!--begin::Wrapper-->
                <div class="bg-body d-flex flex-column flex-center rounded-4 w-md-600px p-10">
                    <!--begin::Content-->
                    <div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-center flex-column flex-column-fluid pb-15 pb-lg-20">
                            <!--begin::Form-->
                            <form class="form w-100" id="kt_new_password_form" data-kt-redirect-url="" action=""
                                method="POST">
                                @csrf
                                <!--begin::Heading-->
                                <div class="text-center mb-10">
                                    <!--begin::Title-->
                                    <h1 class="text-gray-900 fw-bolder mb-3">Buat Password Baru Anda</h1>
                                    <!--end::Title-->
                                    <!--begin::Link-->
                                    <div class="text-gray-500 fw-semibold fs-6">Sudah reset password ? Silahkan login
                                        <a href="{{ route('admin.login') }}" class="link-primary fw-bold">Sign in</a>
                                    </div>
                                    <!--end::Link-->
                                </div>
                                <!--begin::Heading-->
                                <div class="fv-row mb-8">
                                    <!--begin::Repeat Password-->
                                    <input type="text" placeholder="Username" name="username" id="username"
                                        autocomplete="on" class="form-control bg-transparent" required />
                                    <!--end::Repeat Password-->
                                </div>

                                <!--begin::Input group-->
                                <div class="fv-row mb-8">
                                    <!--begin::Wrapper-->
                                    <input class="form-control bg-transparent" type="password"
                                        placeholder="Password baru" name="password" id="password" autocomplete="off"
                                        required />
                                </div>
                                <!--end::Input group=-->
                                <!--end::Input group=-->
                                <!--begin::Action-->
                                <div class="d-grid mb-10">
                                    <button type="submit" id="kt_reset_button" class="btn btn-success">
                                        <!--begin::Indicator label-->
                                        <span class="indicator-label">Submit</span>
                                        <!--end::Indicator label-->
                                        <!--begin::Indicator progress-->
                                        <span class="indicator-progress">Please wait...
                                            <span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        <!--end::Indicator progress-->
                                    </button>
                                </div>
                                <!--end::Action-->
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Wrapper-->

                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Authentication - New password-->
    </div>
    <!--end::Root-->
    <!--begin::Javascript-->
    <script>
        var hostUrl = "assets/";
    </script>
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="{{ asset('themes/dist/assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('themes/dist/assets/js/scripts.bundle.js') }}"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Custom Javascript(used for this page only)-->
    {{-- <script src="{{ asset('themes/dist/assets/js/custom/authentication/reset-password/new-password.js') }}"></script> --}}
    <!--end::Custom Javascript-->
    <script type="text/javascript">
        $(document).ready(function() {

            const form = document.getElementById('kt_new_password_form');

            // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
            var validator = FormValidation.formValidation(
                form, {
                    fields: {
                        // 'name': {
                        //     validators: {
                        //         notEmpty: {
                        //             message: 'Nama is required'
                        //         }
                        //     }
                        // },
                        // 'code': {
                        //     validators: {
                        //         notEmpty: {
                        //             message: 'Kode is required'
                        //         }
                        //     }
                        // },
                    },

                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        bootstrap: new FormValidation.plugins.Bootstrap5({
                            rowSelector: '.fv-row',
                            eleInvalidClass: '',
                            eleValidClass: ''
                        })
                    },

                }
            );
            // proses update data
            const submitButtonUpdate = document.getElementById('kt_reset_button');
            submitButtonUpdate.addEventListener('click', function(e) {
                // Prevent default button action
                e.preventDefault();

                // Validate form before submit
                if (validator) {
                    validator.validate().then(function(status) {
                        if (status == 'Valid') {
                            // Show loading indication
                            submitButtonUpdate.setAttribute('data-kt-indicator', 'on');
                            submitButtonUpdate.disabled = true;
                            let formData = new FormData(kt_new_password_form);
                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                        'content')
                                },
                                data: formData,
                                url: '{{ route('reset.password') }}',
                                type: "POST",
                                dataType: 'json',
                                processData: false,
                                contentType: false,
                                success: function(data) {
                                    console.log(data.success);
                                    if (data.success) {
                                        toastr.success("Successful reset password!");
                                        setTimeout(() => {
                                            window.location.replace(
                                                "{{ route('admin.login') }}"
                                            );
                                        }, 1000);
                                    } else {
                                        toastr.error("Username tidak ditemukan!");
                                        submitButtonUpdate.removeAttribute(
                                            'data-kt-indicator');
                                        submitButtonUpdate.disabled = false;
                                    }

                                },
                                error: function(data) {
                                    submitButtonUpdate.removeAttribute(
                                        'data-kt-indicator');
                                    submitButtonUpdate.disabled = false;
                                    toastr.error("Failed to update data!");
                                }
                            });
                        }
                    });
                }
            });

        });
    </script>

    <!--end::Javascript-->


</body>
<!--end::Body-->

</html>
