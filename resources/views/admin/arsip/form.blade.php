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
                                    <label class="fs-6 fw-semibold mb-2">Nomor Arsip</label>
                                    <input value="{{ isset($data->nomor) ? $data->nomor : '' }}" type="text"
                                        class="form-control" name="nomor" />
                                </div>

                                <!-- Tanggal Surat -->
                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Tanggal Arsip</label>
                                    <input value="{{ isset($data->tgl) ? $data->tgl : '' }}" type="date"
                                        class="form-control" name="tgl" />
                                </div>
                            </div>

                            <!-- Nomor Surat dan Perihal -->
                            <div class="row g-9 mb-8">
                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Pencipta Arsip</label>
                                    <select class="form-select" name="pencipta" id="pencipta" data-control="select2"
                                        data-hide-search="false" data-placeholder="-- Pilih unit --">
                                        <option value="">-- Pilih unit --</option>
                                        @foreach (Helper::getData('jenis_klasifikasis') as $v)
                                            <option {{ isset($data->id) && $data->pencipta == $v->id ? 'selected' : '' }}
                                                value="{{ $v->id }}">
                                                {{ $v->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Perihal Arsip/Surat</label>
                                    <input value="{{ isset($data->perihal) ? $data->perihal : '' }}" type="text"
                                        class="form-control" name="perihal" />
                                </div>
                            </div>

                            <!-- Status dan Asal -->
                            <div class="row g-9 mb-8">

                                {{-- untuk tabel kode klasifikasi --}}
                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Kode Klasifikasi</label>
                                    <select class="form-select" name="kd_klasifikasi_id" id="kd_klasifikasi_id"
                                        data-control="select2" data-hide-search="false" data-placeholder="-- Pilih kode --">
                                        <option value="">-- Pilih kode --</option>
                                        @foreach (Helper::getData('kd_klasifikasis') as $v)
                                            <option
                                                {{ isset($data->id) && $data->kd_klasifikasi_id == $v->id ? 'selected' : '' }}
                                                value="{{ $v->id }}">
                                                {{ $v->nama }} - {{ $v->nomor }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>


                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Unit Pengolah</label>
                                    <select class="form-select" name="unit_pengolah" id="unit_pengolah"
                                        data-control="select2" data-hide-search="false"
                                        data-placeholder="-- Pilih pengolah --">
                                        <option value="">-- Pilih pengolah --</option>
                                        @foreach (Helper::getData('jenis_klasifikasis') as $v)
                                            <option
                                                {{ isset($data->id) && $data->unit_pengolah == $v->id ? 'selected' : '' }}
                                                value="{{ $v->id }}">
                                                {{ $v->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                            <!-- Tanggal Terima dan Tanggal Input -->
                            <div class="row g-9 mb-8">
                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Lokal Arsip</label>
                                    <select data-placeholder="-- Pilih lokal --" name="lokal" id=""
                                        class="form-select">
                                        <option value="">-- Pilih lokal --</option>
                                        <option {{ isset($data->id) && $data->lokal == 'Gedung A' ? 'selected' : '' }}
                                            value="Gedung A">Gedung A</option>
                                        <option {{ isset($data->id) && $data->lokal == 'Gedung B' ? 'selected' : '' }}
                                            value="Gedung B">Gedung B</option>
                                        <option {{ isset($data->id) && $data->lokal == 'Gedung C' ? 'selected' : '' }}
                                            value="Gedung C">Gedung C</option>
                                    </select>
                                </div>
                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Jenis Media</label>
                                    <select data-placeholder="-- Pilih jenis media --" name="jenis_media" id=""
                                        class="form-select">
                                        <option value="">-- Pilih jenis media --</option>
                                        <option {{ isset($data->id) && $data->jenis_media == 'Audio' ? 'selected' : '' }}
                                            value="Audio">Audio</option>
                                        <option {{ isset($data->id) && $data->jenis_media == 'Text' ? 'selected' : '' }}
                                            value="Text">Text</option>
                                        <option {{ isset($data->id) && $data->jenis_media == 'File' ? 'selected' : '' }}
                                            value="File">File</option>
                                    </select>
                                </div>

                            </div>

                            <!-- TTD dan Tujuan -->
                            <div class="row g-9 mb-8">
                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Keterangan Keaslian</label>
                                    {{-- <input type="text" class="form-control" name="ket_keaslian" /> --}}
                                    <select data-placeholder="-- Pilih --" name="ket_keaslian" id=""
                                        class="form-select">
                                        <option value="">-- Pilih --</option>
                                        <option {{ isset($data->id) && $data->ket_keaslian == 'Asli' ? 'selected' : '' }}
                                            value="Asli">Asli</option>
                                        <option
                                            {{ isset($data->id) && $data->ket_keaslian == 'Tidak asli' ? 'selected' : '' }}
                                            value="Tidak asli">Tidak asli</option>
                                    </select>
                                </div>
                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Jumlah</label>
                                    <input value="{{ isset($data->jumlah) ? $data->jumlah : '' }}" type="number"
                                        class="form-control" name="jumlah" />
                                </div>

                            </div>

                            <!-- Kepala dan Jenis -->
                            <div class="row g-9 mb-8">
                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Nomor Rak</label>
                                    <input value="{{ isset($data->no_rak) ? $data->no_rak : '' }}" type="text"
                                        class="form-control" name="no_rak" />
                                </div>
                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Nomor Box</label>
                                    <input value="{{ isset($data->no_box) ? $data->no_box : '' }}" type="text"
                                        class="form-control" name="no_box" />
                                </div>


                            </div>

                            <!-- Retensi dan Riwayat Mutasi -->
                            <div class="row g-9 mb-8">
                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Retensi</label>
                                    <input value="{{ isset($data->retensi) ? $data->retensi : '' }}" type="date"
                                        class="form-control" name="retensi" />
                                </div>
                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Upload File</label>
                                    <input type="file" onchange="return validateFile(this)" class="form-control"
                                        name="file" id="file" />
                                    <input type="hidden" name="files_old" id="files_old" />
                                </div>


                            </div>
                            <div class="row g-9 mb-8">
                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Uraian</label>
                                    <textarea id="uraian" name="uraian" class="form-control" id="" rows="5">
                                        {!! isset($data->uraian) ? $data->uraian : '' !!}
                                    </textarea>
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
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
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
