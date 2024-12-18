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
                                                {{ $v->jenis_klasifikasi->kode . '.' . $v->nomor }} - {{ $v->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Tanggal Surat</label>
                                    <input value="{{ isset($data->tgl_surat) ? $data->tgl_surat : '' }}" type="text"
                                        placeholder="dd/mm/yyyy" onfocus="(this.type='date')" onblur="(this.type='text')"
                                        class="form-control" name="tgl_surat" id="tgl_surat" />
                                </div>
                            </div>

                            <div class="row g-9 mb-8">
                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Jenis</label>
                                    <select class="form-select" data-control="select2" data-hide-search="false"
                                        data-placeholder="Pilih Jenis" name="jenis" id="jenis">
                                        <option value="">Jenis...</option>
                                        <option
                                            {{ isset($data->jenis) && $data->jenis == 'nomor_surat' ? 'selected' : '' }}
                                            value="nomor_surat">Nomor Surat</option>
                                        <option {{ isset($data->jenis) && $data->jenis == 'nomor_sk' ? 'selected' : '' }}
                                            value="nomor_sk">Nomor SK</option>
                                    </select>
                                </div>

                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Perihal</label>
                                    <input type="text" class="form-control" name="perihal" id="perihal"
                                        value="{{ isset($data->perihal) ? $data->perihal : '' }}" />
                                </div>
                            </div>

                            <div class="row g-9 mb-8">
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

                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Asal</label>
                                    <select class="form-select" data-control="select2" data-hide-search="false"
                                        data-placeholder="Pilih atau Ketikkan Asal" name="asal" id="asal">
                                        <option value="">Pilih Asal...</option>
                                        @if (isset($data->asal) && !in_array($data->asal, Helper::getData('kd_units')->pluck('id')->toArray()))
                                            <option value="{{ $data->asal }}" selected>
                                                {{ $data->asal }}
                                            </option>
                                        @endif
                                        @foreach (Helper::getData('kd_units') as $v)
                                            <option {{ isset($data->asal) && $data->asal == $v->id ? 'selected' : '' }}
                                                value="{{ $v->id }}" data-nomor="{{ $v->nomor }}"
                                                data-kode="{{ $v->kode }}">
                                                {{ $v->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row g-9 mb-12">
                                <div class="col-md-12 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Nomor Surat</label>
                                    <input type="text" class="form-control" name="nomor" id="nomor"
                                        value="{{ isset($data->nomor) ? $data->nomor : '' }}" readonly />
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
                                        <span class="indicator-progress">Please wait... <span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                @else
                                    <button type="submit" id="kt_modal_new_target_save" class="btn btn-primary">
                                        <span class="indicator-label">Simpan</span>
                                        <span class="indicator-progress">Please wait... <span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
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
            // Inisialisasi select2
            $('#asal').select2({
                tags: true, // Memungkinkan input manual
                placeholder: "Pilih Asal..."
            });

            const asalOption = $('.asal-lain');
            const asalForm = $('#asalLain');
            asalOption.hide();

            // jika form edit
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
                if (asalValue == '20') {
                    asalOption.show();
                } else {
                    asalOption.hide();
                }
            });

            const editAsal = "{{ isset($data->asal) ? $data->asal : '' }}";
            if (editAsal && editAsal?.length > 0) {
                $("#asal").val(editAsal).trigger("change")
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
                        handleInputChange(field);
                    });
                }
            });

            ['kd_klasifikasi_id', 'status', 'asal'].forEach(field => {
                if (form[field]) {
                    $(document.body).on("change", `#${field}`, function() {
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
                    url: '{{ route('no-surat.last-number') }}',
                    method: 'POST',
                    data: {
                        kd_klasifikasi: form.kd_klasifikasi_id.value,
                        status: form.status.value,
                        asal: form.asal.value,
                        _token: document.querySelector('meta[name="csrf-token"]').content // CSRF token
                    },
                    success: function(data) {
                        const nextNumber = (data.last_number + 1).toString().padStart(3, '0');

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

        // Define form element
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
