@extends('admin._layouts.index')

{{-- @push('cssScript')
    @include('admin._layouts.partial._css')
@endpush --}}

{{-- @push('Data Master')
    here show
@endpush --}}

@push($title)
    active
@endpush

@section('content')
    <!--begin::Toolbar-->
    @component('admin._card.breadcrumb')
        @slot('header')
            {{ $title }}
        @endslot
        @slot('page')
            Profile
        @endslot
    @endcomponent
    <!--end::Toolbar-->

    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card mb-5 mb-xl-10 col-lg-8" id="kt_profile_details_view">
                <!--begin::Card header-->
                <div class="card-header cursor-pointer">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0">Profile Details</h3>
                    </div>
                    <!--end::Card title-->
                    <!--begin::Action-->
                    {{-- <a href="{{ route('users.profile-edit', $data->id) }}" class="btn btn-sm btn-primary align-self-center">Edit Profile</a> --}}
                    <button type="button" data-bs-toggle="modal" data-bs-target="#kt_modal_profile"
                        class="btn btn-sm btn-primary align-self-center">Edit Profile</button>
                    <!--end::Action-->
                </div>
                <!--begin::Card header-->
                <!--begin::Card body-->
                <div class="card-body p-9">
                    <!--begin::Row-->
                    <div class="row mb-7">
                        <!--begin::Label-->
                        <label class="col-lg-4 fw-semibold text-muted">Profile</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8">
                            <div class="symbol symbol-150px symbol-lg-200px symbol-fixed position-relative">
                                <img src="{{ asset('uploads/user/' . $data->profile) }}" alt="image" />
                                {{-- <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px"></div> --}}
                            </div>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                    <!--begin::Row-->
                    <div class="row mb-7">
                        <!--begin::Label-->
                        <label class="col-lg-4 fw-semibold text-muted">Nama</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8">
                            <span class="fw-bold fs-6 text-gray-800">{{ $data->name }}</span>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                    <!--begin::Row-->
                    <div class="row mb-7">
                        <!--begin::Label-->
                        <label class="col-lg-4 fw-semibold text-muted">Email</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8">
                            <span class="fw-bold fs-6 text-gray-800">{{ $data->email }}</span>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                    <!--begin::Input group-->
                    <div class="row mb-7">
                        <!--begin::Label-->
                        <label class="col-lg-4 fw-semibold text-muted">Username</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <span class="fw-semibold text-gray-800 fs-6">{{ $data->username }}</span>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-7">
                        <!--begin::Label-->
                        <label class="col-lg-4 fw-semibold text-muted">Password
                            <span class="ms-1" data-bs-toggle="tooltip"
                                title="Bisa di kosongkan jika tidak ada perubahan">
                                <i class="ki-duotone ki-information fs-7">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </span></label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 d-flex align-items-center">
                            <span class="fw-bold fs-6 text-gray-800 me-2">************</span>
                            {{-- <span class="badge badge-success">Verified</span> --}}
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                </div>
                <!--end::Card body-->
            </div>
        </div>
    </div>
    <!--end::Content-->
    @include('admin.users.edit-profile')
@endsection

@push('jsScriptForm')
    <script type="text/javascript">
        $(document).ready(function() {

            const form = document.getElementById('kt_modal_new_target_form');

            // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
            var validator = FormValidation.formValidation(
                form, {
                    fields: {
                        'name': {
                            validators: {
                                notEmpty: {
                                    message: 'Nama is required'
                                }
                            }
                        },
                        'code': {
                            validators: {
                                notEmpty: {
                                    message: 'Kode is required'
                                }
                            }
                        },
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
            const submitButtonUpdate = document.getElementById('kt_modal_new_target_update');
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
                            let formData = new FormData(kt_modal_new_target_form);
                            let id = $('#formId').val();
                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                        'content')
                                },
                                data: formData,
                                url: '{{ url("admin/$title") }}/' + id,
                                type: "POST",
                                dataType: 'json',
                                processData: false,
                                contentType: false,
                                success: function(data) {
                                    if (data == 'konfirmasi password salah') {
                                        toastr.error("Konfirmasi password salah!");
                                        submitButtonUpdate.removeAttribute(
                                            'data-kt-indicator');
                                        submitButtonUpdate.disabled = false;
                                    } else {
                                        Swal.fire({
                                            text: "Berhasil update profile",
                                            icon: "success",
                                            buttonsStyling: false,
                                            confirmButtonText: "Ok",
                                            customClass: {
                                                confirmButton: "btn btn-primary"
                                            }
                                        }).then(() => {
                                            setTimeout(() => {
                                                window.location.replace(
                                                    "{{ route('admin') }}"
                                                );
                                            }, 500);
                                        });
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
@endpush
