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
                                {{-- <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Kode Klasifikasi</label>
                                    <select class="form-select" id="kd_klasifikasi_id" data-control="select2"
                                        data-hide-search="false" data-placeholder="Pilih Kode Klasifikasi">
                                        <option value="">--- Pilih Kode Klasifikasi ---</option>
                                        @foreach (Helper::getData('kd_klasifikasis') as $v)
                                            <option
                                                {{ isset($data->kd_klasifikasi_id) && $data->kd_klasifikasi_id == $v->id ? 'selected' : '' }}
                                                value="{{ $v->id }}">{{ $v->nama . ' - ' . $v->nomor ?? null }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div> --}}

                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Nomor Surat</label>
                                    <input type="text" class="form-control" name="nomor" id="nomor"
                                        value="{{ isset($data->nomor) ? $data->nomor : '' }}" />
                                </div>
                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Perihal </label>
                                    <input type="text" class="form-control" name="perihal" id="perihal"
                                        value="{{ isset($data->perihal) ? $data->perihal : '' }}" />
                                </div>

                            </div>

                            <div class="row g-9 mb-8">
                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Tanggal Surat</label>
                                    {{-- <input type="date" class="form-control" placeholder="dd-mm-yyyy" name="tgl_surat"
                                        id="tgl_surat" value="{{ isset($data->tgl_surat) ? $data->tgl_surat : '' }}" /> --}}
                                    <input value="{{ isset($data->tgl_surat) ? $data->tgl_surat : '' }}" type="text"
                                        placeholder="dd/mm/yyyy" onfocus="(this.type='date')" onblur="(this.type='text')"
                                        class="form-control" name="tgl_surat" id="tgl_surat" />
                                </div>

                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Tanggal Terima</label>
                                    {{-- <input type="date" class="form-control" name="tgl_terima" id="tgl_terima"
                                        placeholder="dd-mm-yyyy"
                                        value="{{ isset($data->tgl_terima) ? $data->tgl_terima : '' }}" /> --}}
                                    <input value="{{ isset($data->tgl_terima) ? $data->tgl_terima : '' }}" type="text"
                                        placeholder="dd/mm/yyyy" onfocus="(this.type='date')" onblur="(this.type='text')"
                                        class="form-control" name="tgl_terima" id="tgl_terima" />
                                </div>


                            </div>

                            <div class="row g-9 mb-8">
                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Tanggal Input</label>
                                    <input type="date" class="form-control" name="tgl_input" id="tgl_input"
                                        placeholder="dd-mm-yyyy"
                                        value="{{ isset($data->tgl_input) ? $data->tgl_input : \Carbon\Carbon::now()->format('Y-m-d') }}"
                                        readonly />
                                </div>

                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Status</label>
                                    <select class="form-select" data-control="select2" data-hide-search="false"
                                        data-placeholder="Pilih Status" name="status" id="status">
                                        <option value="">Status...</option>
                                        <option {{ isset($data->status) && $data->status == 'biasa' ? 'selected' : '' }}
                                            value="biasa">Biasa</option>
                                        <option {{ isset($data->status) && $data->status == 'penting' ? 'selected' : '' }}
                                            value="penting">Penting</option>
                                        <option {{ isset($data->status) && $data->status == 'terbatas' ? 'selected' : '' }}
                                            value="terbatas">Terbatas</option>
                                        <option
                                            {{ isset($data->status) && $data->status == 'sangat terbatas' ? 'selected' : '' }}
                                            value="sangat terbatas">Sangat Terbatas</option>
                                        <option {{ isset($data->status) && $data->status == 'rahasia' ? 'selected' : '' }}
                                            value="rahasia">Rahasia</option>
                                    </select>
                                </div>


                            </div>

                            <div class="row g-9 mb-8">
                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Kepada</label>
                                    <input type="text" class="form-control" name="kepada" id="kepada"
                                        value="{{ isset($data->kepada) ? $data->kepada : '' }}" />
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
                                                value="{{ $v->id }}">
                                                {{ $v->nama }}
                                            </option>
                                        @endforeach
                                        {{-- <option value="other">Lainnya (Ketikkan Asal Surat)</option> --}}
                                        <!-- Menambahkan opsi 'lainnya' -->
                                    </select>
                                </div>



                                {{-- <div class="col-md-6 fv-row asal-lain">
                                    <label class="fs-6 fw-semibold mb-2">Asal</label>
                                    <input value="{{ isset($data->asal) ? $data->asal : '' }}" type="text"
                                        class="form-control" name="asalLain" id="asalLain"
                                        placeholder="masukkan asal lain" />
                                </div> --}}


                            </div>

                            <div class="row g-9 mb-8">
                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Tujuan</label>
                                    <select class="form-select" data-control="select2" data-hide-search="false"
                                        data-placeholder="Pilih atau Ketikkan Tujuan" name="tujuan" id="tujuan">
                                        <option value="">Pilih Tujuan...</option>
                                        @if (isset($data->tujuan) && !in_array($data->tujuan, Helper::getData('kd_units')->pluck('id')->toArray()))
                                            <option value="{{ $data->tujuan }}" selected>
                                                {{ $data->tujuan }}
                                            </option>
                                        @endif
                                        @foreach (Helper::getData('kd_units') as $a)
                                            <option {{ isset($data->tujuan) && $data->tujuan == $a->id ? 'selected' : '' }}
                                                value="{{ $a->id }}">
                                                {{ $a->nama }}
                                            </option>
                                        @endforeach
                                        {{-- <option value="lainnya">Lainnya (Ketikkan Tujuan)</option> --}}
                                    </select>
                                </div>

                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">TTD (opsional)</label>

                                    <input type="text" class="form-control" name="ttd"
                                        placeholder="Nama Penandatangan"
                                        value="{{ isset($data->ttd) ? $data->ttd : '' }}" id="ttd" />
                                </div>



                                {{-- <div class="col-md-6 fv-row tujuan-lain">
                                    <label class="fs-6 fw-semibold mb-2">Tujuan Lain</label>
                                    <input value="{{ isset($data->tujuanLain) ? $data->tujuanLain : '' }}" type="text"
                                        class="form-control" name="tujuanLain" id="tujuanLain"
                                        placeholder="Masukkan tujuan lain" />
                                </div> --}}

                            </div>

                            <div class="row g-9 mb-8">
                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Upload File</label>
                                    <input type="file" onchange="return validateFile(this)" class="form-control"
                                        name="upload_file" id="upload_file" />

                                    @if (isset($data->upload_file) && !empty($data->upload_file))
                                        <!-- Display the existing file link if it exists -->
                                        <div class="mb-2">
                                            <a href="{{ asset('uploads/ttd/surat-masuk/' . $data->upload_file) }}"
                                                target="_blank">Lihat File Saat Ini</a>
                                        </div>
                                    @endif

                                    <input type="hidden"
                                        value="{{ isset($data->upload_file) ? $data->upload_file : '' }}"
                                        name="upload_file_old" id="upload_file_old" />
                                </div>

                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Jenis Surat</label>
                                    <select class="form-select" data-control="select2" data-hide-search="false"
                                        data-placeholder="Pilih Jenis Surat" name="jenis" id="jenis">
                                        <option value="">Jenis...</option>
                                        <option {{ isset($data->jenis) && $data->jenis == 'vital' ? 'selected' : '' }}
                                            value="vital">Vital</option>
                                        <option {{ isset($data->jenis) && $data->jenis == 'umum' ? 'selected' : '' }}
                                            value="umum">Umum</option>
                                        <option {{ isset($data->jenis) && $data->jenis == 'terjaga' ? 'selected' : '' }}
                                            value="terjaga">Terjaga</option>
                                    </select>
                                </div>


                            </div>

                            <div class="row g-9 mb-8">

                                {{-- <div class="col-md-6 fv-row" id="retensi_tampil" style="display: none;">
                                    <label class="required fs-6 fw-semibold mb-2">Durasi Retensi</label>
                                    <select class="form-select mb-2" name="retensi" id="retensi">
                                        <!-- Options will be populated dynamically -->
                                    </select>
                                </div> --}}


                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Retensi Aktif</label>
                                    <input type="hidden" name="riwayat_mutasi" value="tes" id="">

                                    <select class="form-select mb-2" data-control="select2" name="retensi"
                                        id="retensi" data-selected="{{ $data->retensi ?? '' }}">
                                        <option value="">Pilih Retensi...</option>
                                        <!-- Opsi retensi akan ditambahkan melalui JavaScript -->
                                    </select>
                                    <div id="retensi_warning" style="display: none; color: red;" class="mt-2">
                                        <strong>Warning:</strong> Retensi period has expired!
                                    </div>
                                </div>

                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Retensi Inaktif</label>
                                    <input type="hidden" name="riwayat_mutasi" value="tes" id="">

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
                                    <input type="hidden" name="riwayat_mutasi" value="tes" id="">

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

                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Keterangan</label>
                                    <textarea id="uraian" name="uraian" class="form-control" id="" rows="5">
                                        {{ isset($data->uraian) ? strip_tags($data->uraian) : '' }}
                                    </textarea>
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
        // Fungsi untuk memperbarui pilihan retensi aktif dan inaktif
        function updateRetensi() {
            var tglSurat = document.getElementById('tgl_surat').value;

            if (tglSurat) {
                var baseDate = new Date(tglSurat); // Mengambil nilai tgl_surat
                var retensiSelect = document.getElementById('retensi');
                var retensiSelect2 = document.getElementById('retensi2');

                // Ambil nilai yang sudah dipilih dari atribut data-selected
                var selectedRetensi = retensiSelect.getAttribute('data-selected');
                var selectedRetensi2 = retensiSelect2.getAttribute('data-selected');

                // Membersihkan opsi sebelumnya
                retensiSelect.innerHTML = '<option value="">Pilih Retensi...</option>';
                retensiSelect2.innerHTML = '<option value="">Pilih Retensi...</option>';

                // Menambahkan opsi retensi aktif (1-5 Tahun)
                for (var i = 1; i <= 5; i++) {
                    var retensiDate = new Date(baseDate);
                    retensiDate.setFullYear(baseDate.getFullYear() + i); // Menambahkan tahun ke tgl_surat

                    var option = document.createElement("option");
                    option.value = retensiDate.toISOString().split('T')[0]; // Format yyyy-mm-dd
                    option.text = i + " Tahun (Aktif hingga: " + retensiDate.toLocaleDateString('id-ID') + ")";
                    if (option.value === selectedRetensi) {
                        option.selected = true;
                    }
                    retensiSelect.appendChild(option);
                }

                // Menambahkan opsi retensi inaktif (2-15 Tahun)
                for (var i = 2; i <= 15; i++) {
                    var retensiDate2 = new Date(baseDate);
                    retensiDate2.setFullYear(baseDate.getFullYear() + i); // Menambahkan tahun ke tgl_surat

                    var option2 = document.createElement("option");
                    option2.value = retensiDate2.toISOString().split('T')[0]; // Format yyyy-mm-dd
                    option2.text = i + " Tahun (Inaktif hingga: " + retensiDate2.toLocaleDateString('id-ID') + ")";
                    if (option2.value === selectedRetensi2) {
                        option2.selected = true;
                    }
                    retensiSelect2.appendChild(option2);
                }
            }
        }

        // Event listener untuk memperbarui retensi setiap kali tgl_surat diubah
        document.getElementById('tgl_surat').addEventListener('change', updateRetensi);

        // Memanggil fungsi saat halaman pertama kali dimuat jika tgl_surat sudah ada
        if (document.getElementById('tgl_surat').value) {
            updateRetensi();
        }



        $(document).ready(function() {
            // Inisialisasi select2
            $('#asal').select2({
                tags: true, // Memungkinkan input manual
                placeholder: "Pilih Asal..."
            });
            $('#tujuan').select2({
                tags: true, // Memungkinkan input manual
                placeholder: "Pilih Tujuan..."
            });

            const asalOption = $('.asal-lain');
            const asalForm = $('#asalLain');
            asalOption.hide();

            const tujuanOption = $('.tujuan-lain');
            const tujuanForm = $('#tujuanLain');
            tujuanOption.hide();

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

            // jika form edit
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

                if (tujuanValue == '20') {
                    tujuanOption.show();
                } else {
                    tujuanOption.hide();
                }
            });

            const editAsal = "{{ isset($data->asal) ? $data->asal : '' }}";
            if (editAsal && editAsal?.length > 0) {
                $("#asal").val(editAsal).trigger("change")
            }

            const editTujuan = "{{ isset($data->tujuan) ? $data->tujuan : '' }}";
            if (editTujuan && editTujuan?.length > 0) {
                $("#tujuan").val(editTujuan).trigger("change")
            }
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

        function validateFile(fld) {
            if (fld.files[0].size / 1024 / 1024 > 2) {
                Swal.fire('File terlalu besar !', 'maksimum ukuran file : 2 MB', 'error')
                fld.value = "";
                fld.focus();
                return (false);
            }
            return (true);
        }

        const retensiCategory = document.getElementById('retensi_category');
        const retensiDuration = document.getElementById('retensi');
        const retensiTampil = document.getElementById('retensi_tampil');
        const retensiDate = document.getElementById('retensi_date');
        const retensiWarning = document.getElementById('retensi_warning');

        // Populate duration options based on selected category
        retensiCategory?.addEventListener('change', function() {
            retensiTampil.style.display = 'block';
            retensiDuration.innerHTML = '';
            console.log(this.value);
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
        retensiDate?.addEventListener('change', function() {
            checkRetentionExpiration();
        });

        retensiDuration?.addEventListener('change', function() {
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
