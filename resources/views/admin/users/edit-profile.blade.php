<!--begin::Modal - Upgrade plan-->
<div class="modal fade" id="kt_modal_profile" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <!--begin::Modal content-->
        <div class="modal-content rounded">
            <!--begin::Modal header-->
            <div class="modal-header justify-content-end border-0 pb-0">
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body pt-0 pb-15 px-5 px-xl-20">
                <!--begin::Heading-->
                <div class="mb-13 text-center">
                    <h1 class="mb-3">Edit Profile</h1>
                </div>
                <!--end::Heading-->
                <!--begin::Plans-->
                <div class="d-flex flex-column">
                    <!--begin::Row-->
                    <div class="row">
                        <!--begin:Form-->
                        <form id="kt_modal_new_target_form" class="form" action="#">
                            <input name="_method" type="hidden" id="methodId"
                                value="{{ isset($data->id) ? 'PUT' : 'POST' }}">
                            <input type="hidden" name="id" id="formId" value="{{ $data->id ?? null }}">
                            <input type="hidden" class="form-control" placeholder="Profile" name="profileOld"
                                id="profileOld" value="{{ $data->profile ?? '' }}" />
                            @csrf

                            <!--begin::Input group-->
                            <div class="row g-9 mb-8">
                                <div class="col-md fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Profile</label>
                                    <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                        <img src="{{ asset('uploads/user/' . $data->profile) }}" alt="image" />
                                        {{-- <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px"></div> --}}
                                        <input type="file" class="form-control mt-3" placeholder="Profile"
                                            name="profile" id="profile" value="" />
                                    </div>

                                </div>
                            </div>
                            <!--begin::Input group-->
                            <div class="row g-9 mb-8">
                                <div class="col-md fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Nama</label>
                                    <input type="text" class="form-control" placeholder="Name" name="name"
                                        id="name" value="{{ $data->name ?? '' }}" />
                                </div>
                            </div>
                            <!--begin::Input group-->
                            <div class="row g-9 mb-8">
                                <div class="col-md fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Email</label>
                                    <input type="text" class="form-control" placeholder="Email" name="email"
                                        id="email" value="{{ $data->email ?? '' }}" />
                                </div>
                            </div>
                            <div class="row g-9 mb-8">
                                <div class="col-md fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Username</label>
                                    <input type="text" class="form-control" placeholder="Username" name="username"
                                        id="username" value="{{ $data->username ?? '' }}" />
                                </div>
                            </div>

                            <div class="row g-9 mb-8">
                                <div class="col-md fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Password</label>
                                    <input type="password" class="form-control" placeholder="Paswsword" name="password"
                                        id="password" />
                                </div>
                            </div>
                            <!--end::Input group-->

                            <!--begin::Actions-->
                            <div class="d-flex justify-content-end">
                                <button type="button" id="kt_modal_new_target_cancel" class="btn btn-secondary me-3"
                                    data-bs-dismiss="modal">Batal</button>
                                <button type="submit" id="kt_modal_new_target_update" class="btn btn-primary">
                                    <span class="indicator-label">Update</span>
                                    <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>

                            </div>
                            <!--end::Actions-->

                        </form>
                        <!--end:Form-->
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Plans-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Upgrade plan-->
