@extends('admin._layouts.index')

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
            Form
        @endslot
    @endcomponent
    <!--end::Toolbar-->

    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">

            <!--begin::Tables Widget 10-->
            <div class="card mb-5 mb-xl-8">

                <!--begin::Header-->
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold fs-3 mb-1">Form {{ isset($data->id) ? 'Edit' : 'Input' }}</span>
                    </h3>
                </div>
                <!--end::Header-->

                <!--begin::Body-->
                <div class="card-body pt-3">

                    <div class="row mt-5">
                        <!--begin:Form-->
                        <form id="kt_modal_new_target_form" class="form" action="#">
                            <input name="_method" type="hidden" id="methodId"
                                value="{{ isset($data->id) ? 'PUT' : 'POST' }}">
                            <input type="hidden" name="id" id="formId" value="{{ $data->id ?? null }}">
                            @csrf

                            <!-- Kode Klasifikasi -->
                            <div class="row g-9 mb-8">

                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Kode Klasifikasi</label>
                                    <select class="form-select" name="jenis_klasifikasi_id" id="jenis_klasifikasi_id" data-control="select2"
                                        data-hide-search="false" data-placeholder="-- Pilih unit --">
                                        <option value="">-- Pilih unit --</option>
                                        @foreach (Helper::getData('jenis_klasifikasis') as $v)
                                            <option {{ isset($data->id) && $data->jenis_klasifikasi_id == $v->id ? 'selected' : '' }}
                                                value="{{ $v->id }}">
                                                {{ $v->nama }} - {{ $v->kode }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Nomor</label>
                                    <input value="{{ isset($data->nomor) ? $data->nomor : '' }}" type="text"
                                        class="form-control" name="nomor" />
                                </div>

                                <!-- Tanggal Surat -->
                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Nama</label>
                                    <input value="{{ isset($data->nama) ? $data->nama : '' }}" type="text"
                                        class="form-control" name="nama" />
                                </div>
                            </div>


                            <!--begin::Actions-->
                            <div class="d-flex justify-content-end">
                                <a href="{{ route($title . '.index') }}">
                                    <button type="button" id="kt_modal_new_target_cancel" class="btn btn-secondary me-3"
                                        data-bs-dismiss="modal">Batal</button>
                                </a>
                                @if (isset($data->id))
                                    <button type="submit" id="kt_modal_new_target_update" class="btn btn-primary">
                                        <span class="indicator-label">Update</span>
                                        <span class="indicator-progress">Please wait...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                @else
                                    <button type="submit" id="kt_modal_new_target_save" class="btn btn-primary">
                                        <span class="indicator-label">Simpan</span>
                                        <span class="indicator-progress">Please wait...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                @endif
                            </div>
                            <!--end::Actions-->

                        </form>
                        <!--end:Form-->
                    </div>

                </div>
                <!--begin::Body-->
            </div>
            <!--end::Tables Widget 10-->

        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
@endsection

@push('jsScriptForm')
    <script type="text/javascript">

        ClassicEditor
            .create(document.querySelector('#uraian'))
            .then(editor => {
                window.editor = editor
                console.log(editor);

            })
            .catch(error => {
                console.error('CKEditor initialization failed:', error);
            });
        // Define form element
        const form = document.getElementById('kt_modal_new_target_form');

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


        function validateFile(fld) {
            // if (!/(\.pdf)$/i.test(fld.value)) {
            //     Swal.fire('File Tidak Valid !', 'File Harus Berupa PDF', 'error')
            //     fld.value = "";
            //     fld.focus();
            //     return (false);
            // }
            if (fld.files[0].size / 1024 / 1024 > 2) {
                Swal.fire('File terlalu besar !', 'maksimum ukuran file : 2 MB', 'error')
                fld.value = "";
                fld.focus();
                return (false);
            }
            return (true);


        }
    </script>

    @if (isset($data->id))
        @include('admin._card._updateAjax')
    @else
        @include('admin._card._createAjax')
    @endif

@endpush
