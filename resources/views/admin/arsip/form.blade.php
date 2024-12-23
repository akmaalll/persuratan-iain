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
                                                {{ $v->jenis_klasifikasi->kode . '.' . $v->nomor }} - {{ $v->nama }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>

                            </div>

                            <!-- Nomor Surat dan Perihal -->
                            <div class="row g-9 mb-8">

                                <!-- Tanggal Surat -->
                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Tanggal Arsip</label>
                                    <input value="{{ isset($data->tgl) ? $data->tgl : '' }}" type="text"
                                        placeholder="dd/mm/yyyy" onfocus="(this.type='date')" onblur="(this.type='text')"
                                        class="form-control" name="tgl" id="tgl" />
                                </div>

                                {{--  --}}
                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Perihal Arsip/Surat</label>
                                    <input value="{{ isset($data->perihal) ? $data->perihal : '' }}" type="text"
                                        class="form-control" name="perihal" />
                                </div>



                                {{-- <div class="col-md-6 fv-row pencipta-lain">
                                    <label class="fs-6 fw-semibold mb-2">Pencipta Lain</label>
                                    <input value="{{ isset($data->pencipta) ? $data->pencipta : '' }}" type="text"
                                    class="form-control" name="penciptaLain" id="penciptaLain"
                                    placeholder="masukkan pencipta lain" />
                                </div> --}}
                            </div>

                            <!-- Status dan Asal -->
                            <div class="row g-9 mb-8">

                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Pencipta Arsip </label>
                                    <select class="form-select opsiLain" name="pencipta" id="pencipta" data-tags="true"
                                        data-control="select2" data-hide-search="false"
                                        data-placeholder="-- Pilih  atau Ketikkan unit --">
                                        <option value="">-- Pilih unit --</option>
                                        @if (isset($data->pencipta) && !in_array($data->pencipta, Helper::getData('kd_units')->pluck('id')->toArray()))
                                            <option value="{{ $data->pencipta }}" selected>
                                                {{ $data->pencipta }}
                                            </option>
                                        @endif
                                        @foreach (Helper::getData('kd_units') as $v)
                                            <option {{ isset($data->id) && $data->pencipta == $v->id ? 'selected' : '' }}
                                                value="{{ $v->id }}">
                                                {{ $v->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Unit Pengolah </label>
                                    <select class="form-select opsiLain" name="unit_pengolah" id="unit_pengolah"
                                        data-control="select2" data-hide-search="false"
                                        data-placeholder="-- Pilih atau Ketikkan pengolah --">
                                        <option value="">-- Pilih pengolah --</option>
                                        @if (isset($data->unit_pengolah) && !in_array($data->unit_pengolah, Helper::getData('kd_units')->pluck('id')->toArray()))
                                            <option value="{{ $data->unit_pengolah }}" selected>
                                                {{ $data->unit_pengolah }}
                                            </option>
                                        @endif
                                        @foreach (Helper::getData('kd_units') as $v)
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
                                    <label class="fs-6 fw-semibold mb-2">Lokal Arsip </label>
                                    <select class="form-select opsiLain" name="lokal" id="lokal"
                                        data-control="select2" data-hide-search="false"
                                        data-placeholder="-- Pilih atau Ketikkan lokal --">
                                        <option value="">-- Pilih lokal --</option>
                                        @if (isset($data->lokal) && !in_array($data->lokal, Helper::getData('kd_units')->pluck('id')->toArray()))
                                            <option value="{{ $data->lokal }}" selected>
                                                {{ $data->lokal }}
                                            </option>
                                        @endif
                                        @foreach (Helper::getData('kd_units') as $v)
                                            <option {{ isset($data->id) && $data->lokal == $v->id ? 'selected' : '' }}
                                                value="{{ $v->id }}">
                                                {{ $v->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- <div class="col-md-6 fv-row unit-lain">
                                    <label class="fs-6 fw-semibold mb-2">Unit Pengolah Lain</label>
                                    <input value="{{ isset($data->unit_pengolah) ? $data->unit_pengolah : '' }}"
                                        type="text" class="form-control" name="unitLain" id="unitLain"
                                        placeholder="masukkan pengolah lain" />
                                </div>

                                <div class="col-md-6 fv-row lokal-lain">
                                    <label class="fs-6 fw-semibold mb-2">Lokal Arsip Lain</label>
                                    <input value="{{ isset($data->lokal) ? $data->lokal : '' }}" type="text"
                                        class="form-control" name="lokalLain" id="lokalLain"
                                        placeholder="masukkan lokal lain" />
                                </div> --}}

                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Jenis Media </label>
                                    <select data-placeholder="-- Pilih atau Ketikkan jenis media --" name="jenis_media"
                                        data-control="select2" id="jenis_media" class="form-select opsiLain">
                                        <option value="">-- Pilih jenis media --</option>
                                        @if (isset($data->jenis_media) && !in_array($data->jenis_media, Helper::getData('kd_units')->pluck('id')->toArray()))
                                            <option value="{{ $data->jenis_media }}" selected>
                                                {{ $data->jenis_media }}
                                            </option>
                                        @endif
                                        <option {{ isset($data->id) && $data->jenis_media == 'Audio' ? 'selected' : '' }}
                                            value="Audio">Audio</option>
                                        <option
                                            {{ isset($data->id) && $data->jenis_media == 'Tekstual' ? 'selected' : '' }}
                                            value="Tekstual">Tekstual</option>
                                        <option {{ isset($data->id) && $data->jenis_media == 'Video' ? 'selected' : '' }}
                                            value="Video">Video</option>
                                        <option {{ isset($data->id) && $data->jenis_media == 'Foto' ? 'selected' : '' }}
                                            value="Foto">Foto</option>
                                        <option {{ isset($data->id) && $data->jenis_media == 'Kaset' ? 'selected' : '' }}
                                            value="Kaset">Kaset</option>
                                        <option {{ isset($data->id) && $data->jenis_media == 'CD' ? 'selected' : '' }}
                                            value="CD">CD</option>
                                        <option {{ isset($data->id) && $data->jenis_media == 'FD' ? 'selected' : '' }}
                                            value="FD">FD</option>
                                        {{-- <option {{ isset($data->id) && $data->jenis_media == '20' ? 'selected' : '' }}
                                            value="20">Lainnya</option>  --}}

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
                                            {{ isset($data->id) && $data->ket_keaslian == 'Salinan' ? 'selected' : '' }}
                                            value="Salinan">Salinan</option>
                                    </select>
                                </div>

                                {{-- <div class="col-md-6 fv-row media-lain">
                                    <label class="fs-6 fw-semibold mb-2">Media Lain</label>
                                    <input value="{{ isset($data->jenis_media) ? $data->jenis_media : '' }}"
                                        type="text" class="form-control" name="mediaLain" id="mediaLain"
                                        placeholder="masukkan media lain" />
                                </div> --}}

                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Jumlah</label>
                                    <input value="{{ isset($data->jumlah) ? $data->jumlah : '' }}" type="number"
                                        class="form-control" name="jumlah" />
                                </div>

                            </div>

                            <!-- Kepala dan Jenis -->
                            <div class="row g-9 mb-8">
                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Nomor Rak / Lemari</label>
                                    <input value="{{ isset($data->no_rak) ? $data->no_rak : '' }}" type="text"
                                        class="form-control" name="no_rak" />
                                </div>
                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Nomor Box / Bundel</label>
                                    <input value="{{ isset($data->no_box) ? $data->no_box : '' }}" type="text"
                                        class="form-control" name="no_box" />
                                </div>


                            </div>

                            <!-- Retensi dan Riwayat Mutasi -->
                            <div class="row g-9 mb-8">

                                {{-- <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Retensi</label>
                                    <input value="{{ isset($data->retensi) ? $data->retensi : '' }}" type="date"
                                        class="form-control" name="retensi" />
                                </div> --}}

                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Upload File</label>
                                    <input type="file" onchange="return validateFile(this)" class="form-control"
                                        name="file" id="file" />
                                    <input type="hidden" value="{{ isset($data->file) ? $data->file : '' }}"
                                        name="files_old" id="files_old" />
                                </div>

                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Retensi Aktif</label>

                                    <select class="form-select mb-2" data-control="select2" name="retensi"
                                        id="retensi" data-selected="{{ $data->retensi ?? '' }}">
                                        <option value="">Pilih Retensi...</option>
                                        <!-- Opsi retensi akan ditambahkan melalui JavaScript -->
                                    </select>
                                    <div id="retensi_warning" style="display: none; color: red;" class="mt-2">
                                        <strong>Warning:</strong> Retensi period has expired!
                                    </div>
                                </div>

                            </div>



                            <div class="row g-9 mb-8">

                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Retensi Inaktif</label>

                                    <select class="form-select mb-2" data-control="select2" name="retensi2"
                                        id="retensi2" data-selected="{{ $data->retensi2 ?? '' }}">
                                        <option value="">Pilih Retensi...</option>
                                        <!-- Opsi retensi inaktif akan ditambahkan melalui JavaScript -->
                                    </select>
                                    <div id="retensi_warning" style="display: none; color: red;" class="mt-2">
                                        <strong>Warning:</strong> Retensi period has expired!
                                    </div>
                                </div>

                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Retensi Nasib</label>

                                    <select class="form-select mb-2" data-control="select2" name="retensi3">
                                        <option value="">Pilih Retensi...</option>
                                        <option value="musnah"
                                            {{ isset($data->retensi3) && $data->retensi3 == 'musnah' ? 'selected' : '' }}>
                                            Musnah</option>
                                        <option value="permanen"
                                            {{ isset($data->retensi3) && $data->retensi3 == 'permanen' ? 'selected' : '' }}>
                                            Permanen</option>
                                    </select>
                                    <div id="retensi_warning" style="display: none; color: red;" class="mt-2">
                                        <strong>Warning:</strong> Retensi period has expired!
                                    </div>
                                </div>
                            </div>

                            <div class="row g-9 mb-8">

                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Keterangan</label>
                                    <textarea id="uraian" name="uraian" class="form-control" id="" rows="5">
                                        {{ isset($data->uraian) ? strip_tags($data->uraian) : '' }}
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
        $(document).ready(function() {
            $('.opsiLain').select2({
                tags: true, // Memungkinkan input manual
                placeholder: "Pilih ...",
                allowClear: true,
            });

            const penciptaOption = $('.pencipta-lain');
            const unitOption = $('.unit-lain');
            const lokalOption = $('.lokal-lain');
            const mediaOption = $('.media-lain');

            const penciptaForm = $('#penciptaLain');
            const unitForm = $('#unitLain');
            const lokalForm = $('#lokalLain');
            const mediaForm = $('#mediaLain');

            penciptaOption.hide();
            unitOption.hide();
            lokalOption.hide();
            mediaOption.hide();

            // jika form edit
            const getValuePenciptaOption = $('#pencipta option').filter((i, v) => {
                return v.value == penciptaForm.val();
            });

            if (getValuePenciptaOption.length === 0 && penciptaForm.val() !== '') {
                penciptaOption.show();
                penciptaForm.val(penciptaForm.val());
                $('#pencipta').val('20').change();
            } else {
                penciptaOption.hide();
            }

            $('#pencipta').on('change', function() {
                let penciptaValue = $(this).val();

                if (penciptaValue == '20') {
                    penciptaOption.show();
                } else {
                    penciptaOption.hide();
                }
            });

            // unit pengolah
            const getValueUnitOption = $('#unit_pengolah option').filter((i, v) => {
                return v.value == unitForm.val();
            });

            if (getValueUnitOption.length === 0 && unitForm.val() !== '') {
                unitOption.show();
                unitForm.val(unitForm.val());
                $('#unit_pengolah').val('20').change();
            } else {
                unitOption.hide();
            }

            $('#unit_pengolah').on('change', function() {
                let unitValue = $(this).val();

                if (unitValue == '20') {
                    unitOption.show();
                } else {
                    unitOption.hide();
                }
            });

            // lokal arsip
            const getValueLokalOption = $('#lokal option').filter((i, v) => {
                return v.value == lokalForm.val();
            });

            if (getValueLokalOption.length === 0 && lokalForm.val() !== '') {
                lokalOption.show();
                lokalForm.val(lokalForm.val());
                $('#lokal').val('20').change();
            } else {
                lokalOption.hide();
            }

            $('#lokal').on('change', function() {
                let lokalValue = $(this).val();

                if (lokalValue == '20') {
                    lokalOption.show();
                } else {
                    lokalOption.hide();
                }
            });


            // media 
            const getValueMediaOption = $('#jenis_media option').filter((i, v) => {
                return v.value == mediaForm.val();
            });

            if (getValueMediaOption.length === 0 && mediaForm.val() !== '') {
                mediaOption.show();
                mediaForm.val(mediaForm.val());
                $('#jenis_media').val('20').change();
            } else {
                mediaOption.hide();
            }

            $('#jenis_media').on('change', function() {
                let mediaValue = $(this).val();

                if (mediaValue == '20') {
                    mediaOption.show();
                } else {
                    mediaOption.hide();
                }
            });


        });

        ClassicEditor
            .create(document.querySelector('#uraian'))
            .then(editor => {
                window.editor = editor

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

        function updateRetensi() {
            var tglSurat = document.getElementById('tgl').value;
            var retensiSelect2 = document.getElementById('retensi2');

            // Initially disable retensi2
            $(retensiSelect2).prop('disabled', true).select2();

            if (tglSurat) {
                var baseDate = new Date(tglSurat);
                var retensiSelect = document.getElementById('retensi');
                var selectedRetensi = retensiSelect.getAttribute('data-selected');

                // Destroy existing Select2 instance
                $(retensiSelect).select2('destroy');

                retensiSelect.innerHTML = '<option value="">Pilih Retensi...</option>';

                // Menambahkan opsi retensi aktif (1-5 Tahun)
                for (var i = 1; i <= 5; i++) {
                    var retensiDate = new Date(baseDate);
                    retensiDate.setFullYear(baseDate.getFullYear() + i);

                    var option = document.createElement("option");
                    option.value = retensiDate.toISOString().split('T')[0];
                    option.text = i + " Tahun (Aktif hingga: " + retensiDate.toLocaleDateString('id-ID') + ")";
                    if (option.value === selectedRetensi) {
                        option.selected = true;
                    }
                    retensiSelect.appendChild(option);
                }

                // Reinitialize Select2
                $(retensiSelect).select2();

                // Add event listener for the first retensi dropdown using Select2 event
                $(retensiSelect).off('select2:select').on('select2:select', function(e) {
                    if (e.target.value) {
                        $(retensiSelect2).prop('disabled', false).select2();
                        updateRetensi2(e.target.value);
                    } else {
                        $(retensiSelect2).prop('disabled', true).select2();
                        retensiSelect2.innerHTML = '<option value="">Pilih Retensi...</option>';
                    }
                });

                // Initial update of retensi2 if retensi1 has a value
                if (retensiSelect.value) {
                    $(retensiSelect2).prop('disabled', false).select2();
                    updateRetensi2(retensiSelect.value);
                } else {
                    $(retensiSelect2).prop('disabled', true).select2();
                    retensiSelect2.innerHTML = '<option value="">Pilih Retensi...</option>';
                }
            }
        }

        function updateRetensi2(selectedActiveDate) {
            if (selectedActiveDate) {
                var baseDate = new Date(selectedActiveDate);
                var retensiSelect2 = document.getElementById('retensi2');
                var selectedRetensi2 = retensiSelect2.getAttribute('data-selected');

                // Destroy existing Select2 instance
                $(retensiSelect2).select2('destroy');

                retensiSelect2.innerHTML = '<option value="">Pilih Retensi...</option>';

                for (var i = 2; i <= 15; i++) {
                    var retensiDate2 = new Date(baseDate);
                    retensiDate2.setFullYear(baseDate.getFullYear() + i);

                    var option2 = document.createElement("option");
                    option2.value = retensiDate2.toISOString().split('T')[0];
                    option2.text = i + " Tahun (Inaktif hingga: " + retensiDate2.toLocaleDateString('id-ID') + ")";
                    if (option2.value === selectedRetensi2) {
                        option2.selected = true;
                    }
                    retensiSelect2.appendChild(option2);
                }

                // Reinitialize Select2
                $(retensiSelect2).select2();
            }
        }

        // Make sure to call updateRetensi when tgl_surat changes
        document.getElementById('tgl').addEventListener('change', function() {
            updateRetensi();
        });

        // Initial call to set up the initial state
        document.addEventListener('DOMContentLoaded', function() {
            updateRetensi();
        });

        

        const retensiCategory = document.getElementById('retensi_category');
        const retensiDuration = document.getElementById('retensi');
        const retensiTampil = document.getElementById('retensi_tampil');
        const retensiDate = document.getElementById('retensi_date');
        const retensiWarning = document.getElementById('retensi_warning');

        // Populate duration options based on selected category
        retensiCategory.addEventListener('change', function() {
            retensiTampil.style.display = 'block';
            retensiDuration.innerHTML = '';
            if (this.value == 'aktif') {
                retensiDuration.style.display = 'block';

                retensiDuration.innerHTML = `
                <option value="">Pilih Durasi...</option>
                <option value="{{ $tahun->addYears(1) }}">1 Tahun</option>
                <option value="{{ $tahun->addYears(2) }}">2 Tahun</option>
                <option value="{{ $tahun->addYears(3) }}">3 Tahun</option>
                <option value="{{ $tahun->addYears(4) }}">4 Tahun</option>
                <option value="{{ $tahun->addYears(5) }}">5 Tahun</option>
                `;
            } else if (this.value == 'inaktif') {
                retensiDuration.style.display = 'block';
                retensiDuration.innerHTML = `
                <option value="">Pilih Durasi...</option>
                <option value="{{ $tahun->addYears(2) }}">2 Tahun</option>
                <option value="{{ $tahun->addYears(3) }}">3 Tahun</option>
                <option value="{{ $tahun->addYears(4) }}">4 Tahun</option>
                <option value="{{ $tahun->addYears(5) }}">5 Tahun</option>
                <option value="{{ $tahun->addYears(6) }}">6 Tahun</option>
                <option value="{{ $tahun->addYears(7) }}">7 Tahun</option>
                <option value="{{ $tahun->addYears(8) }}">8 Tahun</option>
                <option value="{{ $tahun->addYears(9) }}">9 Tahun</option>
                <option value="{{ $tahun->addYears(10) }}">10 Tahun</option>
                <option value="{{ $tahun->addYears(11) }}">11 Tahun</option>
                <option value="{{ $tahun->addYears(12) }}">12 Tahun</option>
                <option value="{{ $tahun->addYears(13) }}">13 Tahun</option>
                <option value="{{ $tahun->addYears(14) }}">14 Tahun</option>
                <option value="{{ $tahun->addYears(15) }}">15 Tahun</option>
                `;
            } else if (this.value == 'nasib') {
                retensiDuration.style.display = 'block';
                retensiDuration.innerHTML = `
                <option value="musnah">Musnah</option>
                <option value="permanen">Permanen</option>
            `;
            } else {
                retensiDuration.style.display = 'none';
            }
        });

        // Check if the retention period has expired
        retensiDate.addEventListener('change', function() {
            checkRetentionExpiration();
        });

        retensiDuration.addEventListener('change', function() {
            // Hanya lakukan pengecekan durasi jika kategori bukan 'nasib'
            if (retensiCategory.value !== 'nasib') {
                checkRetentionExpiration();
            }
        });

        function checkRetentionExpiration() {
            const selectedDate = new Date(retensiDate.value);
            const duration = parseInt(retensiDuration.value);

            if (!isNaN(duration) && retensiCategory.value !== 'nasib') {
                const expirationDate = new Date(selectedDate);
                expirationDate.setFullYear(expirationDate.getFullYear() + duration);

                const currentDate = new Date();
                if (currentDate > expirationDate) {
                    retensiWarning.style.display = 'block';
                } else {
                    retensiWarning.style.display = 'none';
                }
            } else {
                retensiWarning.style.display = 'none';
            }
        }
    </script>

    @if (isset($data->id))
        @include('admin._card._updateAjax')
    @else
        @include('admin._card._createAjax')
    @endif

@endpush
