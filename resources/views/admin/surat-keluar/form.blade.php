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
                                <input type="hidden" name="kd_klasifikasi_id" value="1" id="kd_klasifikasi_id">
                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Nomor Surat</label>
                                    <input type="text" class="form-control" name="nomor" id="nomor"
                                        value="{{ isset($data->nomor) ? $data->nomor : '' }}" />
                                </div>
                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Tanggal Surat</label>
                                    <input type="date" class="form-control" name="tgl_surat" id="tgl_surat"
                                        value="{{ isset($data->tgl_surat) ? $data->tgl_surat : '' }}" />
                                </div>
                            </div>

                            <div class="row g-9 mb-8">

                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Perihal</label>
                                    <input type="text" class="form-control" name="perihal" id="perihal"
                                        value="{{ isset($data->perihal) ? $data->perihal : '' }}" />
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
                                            <option {{ isset($data->id) && $data->id == $v->id ? 'selected' : '' }}
                                                value="{{ $v->id }}">
                                                {{ $v->nama }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Tanggal Kirim</label>
                                    <input type="date" class="form-control" name="tgl_kirim" id="tgl_kirim"
                                        value="{{ isset($data->tgl_kirim) ? $data->tgl_kirim : '' }}" />
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
                                    <label class="required fs-6 fw-semibold mb-2">TTD</label>
                                    <input type="text" class="form-control" name="ttd" id="ttd"
                                        value="{{ isset($data->ttd) ? $data->ttd : '' }}" />
                                </div>
                            </div>

                            <div class="row g-9 mb-8">


                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Tujuan</label>
                                    <input type="text" class="form-control" name="tujuan" id="tujuan"
                                        value="{{ isset($data->tujuan) ? $data->tujuan : '' }}" />
                                </div>
                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Kepada</label>
                                    <input type="text" class="form-control" name="kepada" id="kepada"
                                        value="{{ isset($data->kepada) ? $data->kepada : '' }}" />
                                </div>
                            </div>

                            <div class="row g-9 mb-8">


                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Jenis Surat</label>
                                    <select class="form-select" data-control="select2" data-hide-search="false"
                                        data-placeholder="Pilih Status" name="jenis" id="jenis">
                                        <option value="">Jenis...</option>
                                        <option {{ isset($data->jenis) && $data->jenis == 'dinamis' ? 'selected' : '' }}
                                            value="dinamis">Dinamis</option>
                                        <option {{ isset($data->jenis) && $data->jenis == 'statis' ? 'selected' : '' }}
                                            value="statis">Statis</option>
                                        <option {{ isset($data->jenis) && $data->jenis == 'vital' ? 'selected' : '' }}
                                            value="vital">Vital</option>
                                        <option {{ isset($data->jenis) && $data->jenis == 'umum' ? 'selected' : '' }}
                                            value="umum">Umum</option>
                                        <option {{ isset($data->jenis) && $data->jenis == 'terjaga' ? 'selected' : '' }}
                                            value="terjaga">Terjaga</option>
                                        <option {{ isset($data->jenis) && $data->jenis == 'aktif' ? 'selected' : '' }}
                                            value="aktif">Aktif</option>
                                        <option {{ isset($data->jenis) && $data->jenis == 'inaktif' ? 'selected' : '' }}
                                            value="inaktif">Inaktif</option>
                                    </select>
                                </div>

                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Retensi</label>
                                    <select class="form-control" data-control="select2" data-hide-search="false"
                                        data-placeholder="Pilih Retensi" name="retensi" id="retensi" required>
                                        <option value="">Pilih Retensi</option>
                                        <option value="1"
                                            {{ isset($data->retensi) && $data->retensi == 1 ? 'selected' : '' }}>1 Tahun
                                        </option>
                                        <option value="3"
                                            {{ isset($data->retensi) && $data->retensi == 3 ? 'selected' : '' }}>3 Tahun
                                        </option>
                                        <option value="5"
                                            {{ isset($data->retensi) && $data->retensi == 5 ? 'selected' : '' }}>5 Tahun
                                        </option>
                                        <option value="8"
                                            {{ isset($data->retensi) && $data->retensi == 8 ? 'selected' : '' }}>8 Tahun
                                        </option>
                                        <option value="10"
                                            {{ isset($data->retensi) && $data->retensi == 10 ? 'selected' : '' }}>10 Tahun
                                        </option>
                                        <option value="15"
                                            {{ isset($data->retensi) && $data->retensi == 15 ? 'selected' : '' }}>15 Tahun
                                        </option>
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
