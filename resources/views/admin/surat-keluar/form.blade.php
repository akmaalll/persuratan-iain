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

                            <!--begin::Input group-->
                            <div class="row g-9 mb-8">
                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Kode Klasifikasi</label>
                                    <select class="form-select" name="kd_klasifikasi_id" id="kd_klasifikasi_id"
                                        data-control="select2" data-hide-search="false"
                                        data-placeholder="Pilih Kode Klasifikasi">
                                        <option value="">--- Pilih Kode Klasifikasi ---</option>
                                        @foreach (Helper::getData('kd_klasifikasis') as $v)
                                            <option
                                                {{ isset($data->kd_klasifikasi_id) && $data->kd_klasifikasi_id == $v->id ? 'selected' : '' }}
                                                value="{{ $v->id }}" data-kode="{{ $v->jenis_klasifikasi->kode }}"
                                                data-nomor="{{ $v->nomor }}">
                                                {{ $v->jenis_klasifikasi->nama . ' - ' . $v->nomor ?? null }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Status</label>
                                    <select class="form-select" data-control="select2" data-hide-search="false"
                                        data-placeholder="Pilih Status" name="status" id="status">
                                        <option value="">Status...</option>
                                        <option {{ isset($data->status) && $data->status == 'rahasia' ? 'selected' : '' }}
                                            value="rahasia">Rahasia</option>
                                        <option {{ isset($data->status) && $data->status == 'biasa' ? 'selected' : '' }}
                                            value="biasa">Biasa</option>
                                        <option {{ isset($data->status) && $data->status == 'penting' ? 'selected' : '' }}
                                            value="penting">Penting</option>
                                        <option {{ isset($data->status) && $data->status == 'terbatas' ? 'selected' : '' }}
                                            value="terbatas">Terbatas</option>
                                        <option
                                            {{ isset($data->status) && $data->status == 'sangat_terbatas' ? 'selected' : '' }}
                                            value="sangat_terbatas">Sangat Terbatas</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row g-9 mb-8">
                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Asal</label>
                                    <select class="form-select" data-control="select2" data-hide-search="false"
                                        data-placeholder="Pilih Asal" name="asal" id="asal">
                                        <option value="">Pilih Asal...</option>
                                        @foreach (Helper::getData('kd_units') as $v)
                                            <option {{ isset($data->id) && $data->asal == $v->id ? 'selected' : '' }}
                                                value="{{ $v->id }}" data-kode="{{ $v->kode }}"
                                                data-nomor="{{ $v->nomor }}">
                                                {{ $v->nama }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Tanggal Surat</label>
                                    <input type="date" class="form-control" name="tgl_surat" id="tgl_surat"
                                        value="{{ isset($data->tgl_surat) ? $data->tgl_surat : '' }}" />
                                </div>
                            </div>
                            <div class="row g-9 mb-8">
                                <div class="col-md-6 fv-row asal-lain">
                                    <label class="fs-6 fw-semibold mb-2">Asal Lainnya</label>
                                    <input value="{{ isset($data->asal) ? $data->asal : '' }}" type="text"
                                        class="form-control" name="asalLain" id="asalLain"
                                        placeholder="Masukkan asal lain" />
                                </div>
                            </div>

                            <div class="row g-9 mb-8">
                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Tanggal Kirim</label>
                                    <input type="date" class="form-control" name="tgl_kirim" id="tgl_kirim"
                                        value="{{ isset($data->tgl_kirim) ? $data->tgl_kirim : '' }}" />
                                </div>
                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Perihal</label>
                                    <input type="text" class="form-control" name="perihal" id="perihal"
                                        value="{{ isset($data->perihal) ? $data->perihal : '' }}" />
                                </div>
                            </div>

                            <div class="row g-9 mb-8">
                                <div class="col-md-12 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Nomor Surat</label>
                                    <input type="text" class="form-control" name="nomor" id="nomor"
                                        value="{{ isset($data->nomor) ? $data->nomor : '' }}" />
                                </div>
                            </div>

                            <div class="row g-9 mb-8">

                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Tanggal Input</label>
                                    <input type="date" class="form-control" name="tgl_input" id="tgl_input"
                                        value="{{ isset($data->tgl_input) ? $data->tgl_input : \Carbon\Carbon::now()->format('Y-m-d') }}"
                                        readonly />
                                </div>
                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">TTD</label>
                                    <input type="text" class="form-control" name="ttd" id="ttd"
                                        value="{{ isset($data->ttd) ? $data->ttd : '' }}" />
                                </div>
                            </div>

                            <div class="row g-9 mb-8">
                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Tujuan</label>
                                    <select class="form-select" data-control="select2" data-hide-search="false"
                                        data-placeholder="Pilih Tujuan" name="tujuan" id="tujuan">
                                        <option value="">Pilih Tujuan...</option>
                                        @foreach (Helper::getData('kd_units') as $v)
                                            <option {{ isset($data->id) && $data->tujuan == $v->id ? 'selected' : '' }}
                                                value="{{ $v->id }}">
                                                {{ $v->nama }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Kepada</label>
                                    <input type="text" class="form-control" name="kepada" id="kepada"
                                        value="{{ isset($data->kepada) ? $data->kepada : '' }}" />
                                </div>
                            </div>

                            <div class="row g-9 mb-8">
                                <div class="col-md-6 fv-row tujuan-lain">
                                    <label class="fs-6 fw-semibold mb-2">Tujuan Lainnya</label>
                                    <input
                                        value="{{ isset($data->tujuan) && !is_numeric($data->tujuan) ? $data->tujuan : '' }}"
                                        type="text" class="form-control" name="tujuanLain" id="tujuanLain"
                                        placeholder="Masukkan tujuan lain" />
                                </div>
                            </div>

                            <div class="row g-9 mb-8">
                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Jenis Surat</label>
                                    <select class="form-select" data-control="select2" data-hide-search="false"
                                        data-placeholder="Pilih Status" name="jenis" id="jenis">
                                        <option value="">Jenis...</option>
                                        <option {{ isset($data->jenis) && $data->jenis == 'vital' ? 'selected' : '' }}
                                            value="vital">Vital</option>
                                        <option {{ isset($data->jenis) && $data->jenis == 'umum' ? 'selected' : '' }}
                                            value="umum">Umum</option>
                                        <option {{ isset($data->jenis) && $data->jenis == 'terjaga' ? 'selected' : '' }}
                                            value="terjaga">Terjaga</option>
                                    </select>
                                </div>

                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Retensi</label>
                                    <input type="hidden" name="riwayat_mutasi" value="tes" id="">

                                    <select class="form-select mb-2" name="retensi_kategori" id="retensi_category">
                                        <option value="">Pilih Retensi...</option>
                                        <option value="aktif">Aktif</option>
                                        <option value="inaktif">Inaktif</option>
                                        <option value="nasib">Nasib</option>
                                    </select>

                                    <div id="retensi_warning" style="display: none; color: red;" class="mt-2">
                                        <strong>Warning:</strong> Retensi period has expired!
                                    </div>
                                </div>
                            </div>

                            <div class="row g-9 mb-8">
                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">File</label>
                                    <input type="file" class="form-control" name="file" id="file" />
                                    <input type="hidden" value="{{ isset($data->file) ? $data->file : '' }}"
                                        name="file_old" id="file_old" />
                                </div>
                                <div class="col-md-6 fv-row" id="retensi_tampil" style="display: none;">
                                    <label class="required fs-6 fw-semibold mb-2">Durasi Retensi</label>
                                    <select class="form-select mb-2" name="retensi" id="retensi">
                                        <!-- Options will be populated dynamically -->
                                    </select>
                                </div>
                            </div>


                            <!--end::Input group-->

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
        const asalOption = $('.asal-lain');
        const asalForm = $('#asalLain');

        const tujuanOption = $('.tujuan-lain');
        const tujuanForm = $('#tujuanLain');


        asalOption.hide();
        tujuanOption.hide();


        const getValueAsalOption = $('#asal option').filter((i, v) => {
            return v.value == asalForm.val();
        });

        if (getValueAsalOption.length === 0 && asalForm.val() !== '') {
            asalOption.show();
            asalForm.val(asalForm.val());
            $('#asal').val('20').change();
        } else {
            asalOption.hide();
        }

        $('#asal').on('change', function() {
            let asalValue = $(this).val();

            console.log($('#asal option:selected').text());
            if (asalValue == '20') {
                asalOption.show();
            } else {
                asalOption.hide();
            }
        });

        const getValueTujuanOption = $('#tujuan option').filter((i, v) => {
            return v.value == tujuanForm.val();
        });

        if (getValueTujuanOption.length === 0 && tujuanForm.val() !== '') {
            tujuanOption.show();
            tujuanForm.val(tujuanForm.val());
            $('#tujuan').val('20').change();
        } else {
            tujuanOption.hide();
        }

        $('#tujuan').on('change', function() {
            let tujuanValue = $(this).val();

            console.log($('#tujuan option:selected').text());
            if (tujuanValue == '20') {
                tujuanOption.show();
            } else {
                tujuanOption.hide();
            }
        });

        const retensiCategory = document.getElementById('retensi_category');
        const retensiDuration = document.getElementById('retensi');
        const retensiTampil = document.getElementById('retensi_tampil');
        const retensiDate = document.getElementById('retensi_date');
        const retensiWarning = document.getElementById('retensi_warning');

        retensiCategory.addEventListener('change', function() {
            retensiTampil.style.display = 'block';
            retensiDuration.innerHTML = '';

            if (this.value === 'aktif') {
                retensiDuration.innerHTML = `
                <option value="">Pilih Durasi...</option>
                <option value="{{ $tahun->addYears(1) }}">1 Tahun</option>
                <option value="{{ $tahun->addYears(2) }}">2 Tahun</option>
                <option value="{{ $tahun->addYears(3) }}">3 Tahun</option>
                <option value="{{ $tahun->addYears(4) }}">4 Tahun</option>
                <option value="{{ $tahun->addYears(5) }}">5 Tahun</option>
            `;
            } else if (this.value === 'inaktif') {
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
            } else if (this.value === 'nasib') {
                retensiDuration.innerHTML = `
                <option value="musnah">Musnah</option>
                <option value="permanen">Permanen</option>
            `;
            } else {
                retensiDuration.style.display = 'none';
            }
        });

        // generate no surat
        document.addEventListener('DOMContentLoaded', function() {
            const form = {
                kd_klasifikasi_id: document.getElementById('kd_klasifikasi_id'),
                status: document.getElementById('status'),
                tglSurat: document.getElementById('tgl_surat'),
                asal: document.getElementById('asal'),
                nomorField: document.getElementById('nomor')
            };

            let counter = 0;
            let previousValues = {
                kd_klasifikasi_id: '',
                status: '',
                tglSurat: '',
                asal: ''
            };

            // Add event listeners
            ['tglSurat'].forEach(field => {
                if (form[field]) {
                    form[field].addEventListener('change', () => {
                        console.log(`${field} changed`);
                        handleInputChange(field);
                    });
                }
            });

            ['kd_klasifikasi_id', 'status', 'asal'].forEach(field => {
                if (form[field]) {
                    $(document.body).on("change", `#${field}`, function() {
                        console.log(`${field} changed`);
                        handleInputChange(field);
                    });
                }
            });

            function handleInputChange(changedField) {
                // Check if the value actually changed
                const currentValue = form[changedField].value;
                if (previousValues[changedField] === currentValue) {
                    return;
                }


                // Update previous value
                previousValues[changedField] = currentValue;

                if (areAllFieldsFilled()) {
                    counter++;
                    generateNomor();
                } else {
                    form.nomorField.value = '';
                }
            }

            function generateNomor() {
                $.ajax({
                    //url: '/admin/surat-keluar/last-number',
                    url: '{{ route('surat-keluar.last-number') }}',
                    method: 'POST',
                    data: {
                        kd_klasifikasi: form.kd_klasifikasi_id.value,
                        status: form.status.value,
                        asal: form.asal.value,
                        _token: document.querySelector('meta[name="csrf-token"]').content // CSRF token
                    },
                    success: function(data) {
                        const nextNumber = (data.last_number + 1).toString().padStart(3, '0');
                        console.log(nextNumber);

                        const values = {
                            status: form.status.value,
                            klasifikasi: form.kd_klasifikasi_id.options[form.kd_klasifikasi_id
                                .selectedIndex],
                            asal: form.asal.options[form.asal.selectedIndex],
                            date: new Date(form.tglSurat.value)
                        };

                        const components = {
                            status: getStatus(values.status),
                            counterNoSurat: nextNumber,
                            asalCode: values.asal.dataset.kode,
                            asalNomor: values.asal.dataset.nomor,
                            kodeKlasifikasi: values.klasifikasi.dataset.kode,
                            noKlasifikasi: values.klasifikasi.dataset.nomor,
                            month: String(values.date.getMonth() + 1).padStart(2, '0'),
                            year: values.date.getFullYear(),
                            isFTAR: values.asal.dataset.kode === 'FTAR'
                        };

                        const documentNumber = formatDocumentNumber(components);
                        form.nomorField.value = documentNumber;
                    },
                    error: function(error) {
                        console.error('Error generating nomor:', error);
                    }
                });
            }

            function noKlasifkasi(text) {
                const parts = text.split('-').map(part => part.trim().replace(/\n/g, ''));
                return parts[1] || '';
            }

            function areAllFieldsFilled() {
                return form.status.value &&
                    form.kd_klasifikasi_id.selectedIndex !== 0 &&
                    form.asal.selectedIndex !== 0 &&
                    form.tglSurat.value;
            }

            function getStatus(status) {
                const prefixMap = {
                    'rahasia': 'R',
                    'biasa': 'B',
                    'penting': 'P',
                    'terbatas': 'T',
                    'sangat_terbatas': 'ST',
                };
                return prefixMap[status] || '';
            }

            function formatDocumentNumber(components) {
                if (components.isFTAR) {
                    return `${components.status}-${components.counterNoSurat}/ln.39/${components.asalCode}.${components.asalNomor}/${components.kodeKlasifikasi}.${components.noKlasifikasi}/${components.month}/${components.year}`;
                } else {
                    return `${components.status}-${components.counterNoSurat}/ln.39/${components.kodeKlasifikasi}.${components.noKlasifikasi}/${components.month}/${components.year}`;
                }
            }
        });


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
    </script>

    @if (isset($data->id))
        @include('admin._card._updateAjax')
    @else
        @include('admin._card._createAjax')
    @endif

@endpush
