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
            Detail
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
                        <span class="card-label fw-bold fs-3 mb-1">Detail Surat Keluar</span>
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
                                    <input type="text" class="form-control" name="kd_klasifikasi_id"
                                        id="kd_klasifikasi_id"
                                        value="{{ isset($data->kd_klasifikasi_id) ? $data->klasifikasi->nama . ' - ' . $data->klasifikasi->nomor : '' }}"
                                        readonly />
                                </div>
                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Status</label>
                                    <input type="text" class="form-control" name="status" id="status"
                                        value="{{ isset($data->status) ? $data->status : '' }}" readonly />
                                </div>
                            </div>

                            <div class="row g-9 mb-8">
                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Asal</label>
                                    <input type="text" class="form-control" name="asal" id="asal"
                                        value="{{ isset($data->asal) ? (is_numeric($data->asal) ? $data->asalSurat->kode . ' - ' . ($data->asalSurat ? $data->asalSurat->nama : 'Lainnya') : $data->asal) : '' }}"
                                        readonly />
                                </div>
                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Tanggal Surat</label>
                                    <input type="date" class="form-control" name="tgl_surat" id="tgl_surat"
                                        value="{{ isset($data->tgl_surat) ? $data->tgl_surat : '' }}" readonly />
                                </div>

                            </div>

                            <div class="row g-9 mb-8">
                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Tanggal Kirim</label>
                                    <input type="date" class="form-control" name="tgl_kirim" id="tgl_kirim"
                                        value="{{ isset($data->tgl_kirim) ? $data->tgl_kirim : '' }}" readonly />
                                </div>
                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Perihal</label>
                                    <input type="text" class="form-control" name="perihal" id="perihal"
                                        value="{{ isset($data->perihal) ? $data->perihal : '' }}" readonly />
                                </div>
                            </div>

                            <div class="row g-9 mb-8">
                                <div class="col-md-12 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Nomor Surat</label>
                                    <input type="text" class="form-control" name="nomor" id="nomor"
                                        value="{{ isset($data->nomor) ? $data->nomor : '' }}" readonly />
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
                                        value="{{ isset($data->ttd) ? $data->ttd : '' }}" readonly />
                                </div>
                            </div>

                            <div class="row g-9 mb-8">


                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Tujuan</label>
                                    <input type="text" class="form-control" name="tujuan" id="tujuan"
                                        value="{{ isset($data->tujuan) ? (is_numeric($data->tujuan) ? $data->tujuanSurat->kode . ' - ' . ($data->tujuanSurat ? $data->tujuanSurat->nama : 'Lainnya') : $data->tujuan) : '' }}"
                                        readonly />

                                </div>
                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Kepada</label>
                                    <input type="text" class="form-control" name="kepada" id="kepada"
                                        value="{{ isset($data->kepada) ? $data->kepada : '' }}" readonly />
                                </div>
                            </div>


                            <div class="row g-9 mb-8">
                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Jenis Surat</label>
                                    <input type="text" class="form-control" name="jenis" id="jenis"
                                        value="{{ isset($data->jenis) ? $data->jenis : '' }}" readonly />
                                </div>

                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">File</label>
                                    @if (isset($data->file) && !empty($data->file))
                                        <!-- Display the existing file link if it exists -->
                                        <div class="mb-2">
                                            <a href="{{ asset('uploads/surat-keluar/' . $data->file) }}" target="_blank"
                                                class="form-control">Lihat File</a>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="row g-9 mb-8">
                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Nomor Box (opsional)</label>

                                    <input type="text" class="form-control" name="nomor_box" placeholder="Nomor Box"
                                        value="{{ isset($data->nomor_box) ? $data->nomor_box : '' }}" id="nomor_box"
                                        readonly />
                                </div>

                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Nomor Rak (opsional)</label>

                                    <input type="text" class="form-control" name="nomor_rak" placeholder="Nomor Rak"
                                        value="{{ isset($data->nomor_rak) ? $data->nomor_rak : '' }}" id="nomor_rak"
                                        readonly />
                                </div>
                            </div>

                            <div class="row g-9 mb-8">
                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Retensi Aktif</label>
                                    <input type="hidden" name="riwayat_mutasi" value="tes" id="">
                                    <input type="text" class="form-control" name="retensi" id="retensi"
                                        value="{{ isset($data->retensi) ? $data->retensi : '' }}" readonly />
                                </div>
                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Retensi Inaktif</label>
                                    <input type="hidden" name="riwayat_mutasi" value="tes" id="">
                                    <input type="text" class="form-control" name="retensi" id="retensi"
                                        value="{{ isset($data->retensi2) ? $data->retensi2 : '' }}" readonly />
                                </div>
                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Retensi Nasib</label>
                                    <input type="hidden" name="riwayat_mutasi" value="tes" id="">
                                    <input type="text" class="form-control" name="retensi" id="retensi"
                                        value="{{ isset($data->retensi3) ? $data->retensi3 : '' }}" readonly />
                                </div>


                            </div>

                            <div class="row g-9 mb-8">
                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Permintaan Nomor Surat</label>
                                    <input type="text" class="form-control" name="permintaan" id="permintaan"
                                        value="{{ isset($data->permintaan) ? $data->permintaan : '' }}" readonly />
                                </div>
                            </div>

                            <!--end::Input group-->
                            <div class="d-flex justify-content-end">
                                <a href="{{ route($title . '.index') }}">
                                    <button type="button" id="kt_modal_new_target_cancel" class="btn btn-secondary me-3"
                                        data-bs-dismiss="modal">Batal</button>
                                </a>
                            </div>

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
