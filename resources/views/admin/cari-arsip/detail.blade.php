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
                        <span class="card-label fw-bold fs-3 mb-1">Arsip</span>
                    </h3>
                    <a href="{{ route($title . '.index') }}">
                        <button type="button" id="kt_modal_new_target_cancel" style="background-color: #337ab7;"
                            class="btn btn-dark me-3" data-bs-dismiss="modal">Kembali</button>
                    </a>
                </div>
                <!--end::Header-->

                <!--begin::Body-->
                <div class="card-body pt-3">

                    <div class="row ">
                        <!--begin:Form-->

                        <!-- Kode Klasifikasi -->
                        <div class="row g-4">
                            <div class="col-md-6 fv-row">
                                <label class="fs-2 fw-bold mb-2">Nomor Arsip</label>
                                <p class="fw-semibold fs-3">{{ $data->nomor }}</p>
                            </div>

                            <!-- Tanggal Surat -->
                            <div class="col-md-6 fv-row">
                                <label class="fs-2 fw-bold mb-2">Tanggal Arsip</label>
                                <p class="fs-3 fw-semibold mb-2">{{ Helper::getDateIndo($data->tgl) }}</p>
                            </div>
                        </div>

                        <!-- Nomor Surat dan Perihal -->
                        <div class="row g-4">
                            <div class="col-md-6 fv-row">
                                <label class="fs-2 fw-bold mb-2">Pencipta Arsip</label>
                                <p class="fs-3 fw-semibold mb-2">
                                    {{ isset($data->cipta->kode) ? $data->cipta->kode . ' - ' : $data->pencipta }}
                                    {{ isset($data->cipta->nama) ? $data->cipta->nama : '' }}</p>
                            </div>

                            <div class="col-md-6 fv-row">
                                <label class="fs-2 fw-bold mb-2">Perihal Arsip/Surat</label>
                                <p class="fs-5 fw-semibold mb-2">{{ $data->perihal }}</p>
                            </div>
                        </div>

                        <!-- Status dan Asal -->
                        <div class="row g-4">

                            {{-- untuk tabel kode klasifikasi --}}
                            <div class="col-md-6 fv-row">
                                <label class="fs-2 fw-bold mb-2">Kode Klasifikasi</label>
                                <p class="fs-3 fw-semibold mb-2"> {{ $data->klasifikasi->jenis_klasifikasi->kode . '.' . $data->klasifikasi->nomor }} -
                                    {{ $data->klasifikasi->nama }}</p>
                            </div>


                            <div class="col-md-6 fv-row">
                                <label class="fs-2 fw-bold mb-2">Unit Pengolah</label>
                                <p class="fs-3 fw-semibold mb-2">
                                    {{ isset($data->unit->kode) ? $data->unit->kode . ' - ' . $data->unit->nama : $data->unit_pengolah }}
                            </div>

                        </div>

                        <!-- Tanggal Terima dan Tanggal Input -->
                        <div class="row g-4">
                            <div class="col-md-6 fv-row">
                                <label class="fs-2 fw-bold mb-2">Lokal Arsip</label>
                                <p class="fs-3 fw-semibold mb-2">
                                    {{ isset($data->lokasi->nama) ? $data->lokasi->nama : $data->lokal }}</p>
                            </div>
                            <div class="col-md-6 fv-row">
                                <label class="fs-2 fw-bold mb-2">Jenis Media</label>
                                <p class="fs-3 fw-semibold mb-2">{{ $data->jenis_media }}</p>
                            </div>
                        </div>

                        <!-- TTD dan Tujuan -->
                        <div class="row g-4">
                            <div class="col-md-6 fv-row">
                                <label class="fs-2 fw-bold mb-2">Keterangan Keaslian</label>
                                <p class="fs-3 fw-semibold mb-2">{{ $data->ket_keaslian }}</p>
                            </div>
                            <div class="col-md-6 fv-row">
                                <label class="fs-2 fw-bold mb-2">Jumlah</label>
                                <p class="fs-3 fw-semibold mb-2">{{ $data->jumlah }}</p>
                            </div>
                        </div>

                        <!-- Kepala dan Jenis -->
                        <div class="row g-4">
                            <div class="col-md-6 fv-row">
                                <label class="fs-2 fw-bold mb-2">Nomor Rak</label>
                                <p class="fs-3 fw-semibold mb-2">{{ $data->no_rak }}</p>
                            </div>
                            <div class="col-md-6 fv-row">
                                <label class="fs-2 fw-bold mb-2">Nomor Box</label>
                                <p class="fs-3 fw-semibold mb-2">{{ $data->no_box }}</p>
                            </div>
                        </div>

                        <!-- Retensi dan Riwayat Mutasi -->
                        <div class="row g-4">
                            <div class="col-md-6 fv-row">
                                <label class="fs-2 fw-bold mb-2">Retensi</label>
                                <p class="fs-3 fw-semibold mb-2">{{ Helper::getDateIndo($data->retensi) }}</p>
                            </div>
                            <div class="col-md-6 fv-row">
                                <label class="fs-2 fw-bold mb-2">Uraian Arsip</label>
                                <p class="fs-3 fw-semibold mb-2">{!! $data->uraian !!}</p>
                            </div>
                        </div>

                        <div class="row g-4">
                            <div class="col-md fv-row">
                                <label class="fs-2 fw-bold mb-2">File</label>
                                @php
                                    $eks = explode('.', $data->file);
                                @endphp
                                @if ($eks[count($eks) - 1] == 'pdf')
                                    <iframe src="{{ url('uploads/arsip/' . $data->file) }}" width="100%" height="400"
                                        title="File preview"></iframe>
                                @else
                                    <div class="d-flex">
                                        <span class="fw-semibold me-3">
                                            <a href="{{ asset('uploads/arsip/' . $data->file) }}" target="_blank"
                                                class="btn btn-icon btn-bg-secondary btn-active-color-primary btn-sm">
                                                <i class="ki-duotone ki-folder-down fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </a>
                                        </span>
                                        <p class="fs-3 fw-semibold">ekstensi file adalah .docx, file tidak bisa preview</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!--begin::Actions-->
                        <div class="d-flex justify-content-end">

                        </div>
                        <!--end::Actions-->

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
@endpush
