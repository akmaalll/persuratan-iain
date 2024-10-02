@extends('livewire.admin.layouts.index')

{{-- @push('Data Master')
    here show
@endpush --}}

@push($title)
    active
@endpush

@section('content')
    <!--begin::Toolbar-->
    @component('livewire.admin.card.breadcrumb')
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
                        <span class="card-label fw-bold fs-3 mb-1">Form {{ $sm_id ? 'Edit Post' : 'Buat Post' }}</span>
                    </h3>
                </div>
                <!--end::Header-->

                <!--begin::Body-->
                <div class="card-body pt-3">

                    <div class="row mt-5">
                        <!--begin:Form-->
                        <form id="kt_modal_new_target_form" class="form" wire:submit.prevent="store">
                            @csrf

                            <!-- Kode Klasifikasi -->
                            <div class="row g-9 mb-8">
                                    <div class="col-md-6 fv-row" x-init="$nextTick(() => {
                                        $('#kd_klasifikasi_id').select2({
                                            placeholder: 'Pilih Kode Klasifikasi',
                                            allowClear: true
                                        }).on('change', function() {
                                            $wire.set('kd_klasifikasi_id', $(this).val());
                                        });
                                    })">
                                        <label class="fs-6 fw-semibold mb-2">Kode Klasifikasi</label>
                                        <select class="form-select" id="kd_klasifikasi_id" data-control="select2"
                                            data-hide-search="false" data-placeholder="Pilih Kode Klasifikasi">
                                            <option value="">--- Pilih Kode Klasifikasi ---</option>
                                            @foreach (Helper::getData('kd_klasifikasis') as $v)
                                                <option value="{{ $v->id }}">{{ $v->nama }} - {{ $v->nomor }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('kd_klasifikasi_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                <!-- Tanggal Surat -->
                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Tanggal Surat</label>
                                    <input type="date" class="form-control" wire:model="tgl_surat" />
                                    @error('tgl_surat')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Nomor Surat dan Perihal -->
                            <div class="row g-9 mb-8">
                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Nomor Surat</label>
                                    <input type="text" class="form-control" wire:model="nomor" />
                                    @error('nomor')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Perihal</label>
                                    <input type="text" class="form-control" wire:model="perihal" />
                                    @error('perihal')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Status dan Asal -->
                            <div class="row g-9 mb-8">
                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Status</label>
                                    <input type="text" class="form-control" wire:model="status" />
                                    @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Asal</label>
                                    <input type="text" class="form-control" wire:model="asal" />
                                    @error('asal')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Tanggal Terima dan Tanggal Input -->
                            <div class="row g-9 mb-8">
                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Tanggal Terima</label>
                                    <input type="date" class="form-control" wire:model="tgl_terima" />
                                    @error('tgl_terima')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Tanggal Input</label>
                                    <input type="date" class="form-control" wire:model="tgl_input" />
                                    @error('tgl_input')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- TTD dan Tujuan -->
                            <div class="row g-9 mb-8">
                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">TTD</label>
                                    <input type="text" class="form-control" wire:model="ttd" />
                                    @error('ttd')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Tujuan</label>
                                    <input type="text" class="form-control" wire:model="tujuan" />
                                    @error('tujuan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Kepala dan Jenis -->
                            <div class="row g-9 mb-8">
                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Kepada</label>
                                    <input type="text" class="form-control" wire:model="kepada" />
                                    @error('kepada')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Jenis</label>
                                    <input type="text" class="form-control" wire:model="jenis" />
                                    @error('jenis')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Retensi dan Riwayat Mutasi -->
                            <div class="row g-9 mb-8">
                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Retensi</label>
                                    <input type="text" class="form-control" wire:model="retensi" />
                                    @error('retensi')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Riwayat Mutasi</label>
                                    <input type="text" class="form-control" wire:model="riwayat_mutasi" />
                                    @error('riwayat_mutasi')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">
                                    <span class="indicator-label">{{ $sm_id ? 'Update' : 'Simpan' }}</span>
                                    <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                </button>
                                <button type="button" class="btn btn-secondary ms-3"
                                    wire:click="closeModal()">Batal</button>
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
@endpush
