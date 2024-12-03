@extends('admin._layouts.index')

{{-- @push('cssScript')
    @include('admin._layouts.partial._css')
@endpush --}}

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
            Data
        @endslot
    @endcomponent
    <!--end::Toolbar-->

    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <!--begin::Products-->
            <div class="card card-flush">

                <!--begin::Card header-->
                {{-- @include('admin._card.action') --}}
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <div class="mw-100px me-3">
                            <select class="form-select form-select-solid me-3" data-control="select2" data-hide-search="true"
                                data-placeholder="Per Page" id="perPage">
                                <option>5</option>
                                <option>10</option>
                                <option>25</option>
                                <option>50</option>
                                <option>100</option>
                            </select>
                        </div>
                    </div>


                    <!--end::Card title-->

                    <!--begin::Card toolbar-->
                    {{-- <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                        <a href="{{ route($title . '.create') }}" class="btn btn-success">
                            <span class="btn-label">
                                <i class="fa fa-plus"></i>
                            </span>
                            Add New
                        </a>
                    </div> --}}

                    <!--end::Card toolbar-->
                </div>

                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body pt-0">

                    <!-- Kode Klasifikasi -->
                    <div class="row">
                        <div class="col-md-4 fv-row">
                            <label class="fs-6 fw-semibold mb-2">Nomor Arsip</label>
                            <div class="input-group">
                                <input type="text" class="form-control reset-filter" name="nomor" id="nomor"
                                    placeholder="Masukkan nomor surat" />
                                <button type="button" class="btn btn-outline-danger bg-secondary"
                                    onclick="clearField('nomor')">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>

                        {{-- untuk tabel kode klasifikasi --}}
                        <div class="col-md-4 fv-row">
                            <label class="fs-6 fw-semibold mb-2">Kode Klasifikasi</label>
                            <select class="form-select reset-filter opsiLain" name="kd_klasifikasi_id"
                                id="kd_klasifikasi_id" data-tags="true" data-control="select2" data-hide-search="false"
                                data-placeholder="Semua">
                                <option value="" selected>Semua</option>
                                @foreach (Helper::getData('kd_klasifikasis') as $v)
                                    <option value="{{ $v->id }}">
                                        {{ $v->jenis_klasifikasi->kode . '.' . $v->nomor }} - {{ $v->nama }}
                                    </option>
                                @endforeach
                            </select>

                        </div>

                        <!-- Tanggal Surat -->
                        <div class="col-md-4 fv-row">
                            <label class="fs-6 fw-semibold mb-2">Tanggal arsip</label>
                            <div class="input-group">
                                <input type="text" placeholder="dd/mm/yyyy" onfocus="(this.type='date')"
                                    onblur="(this.type='text')" data-placeholder="-- Pilih lokal --" name="tgl"
                                    id="tgl" class="form-control reset-filter" />
                                <button type="button" class="btn btn-outline-danger bg-secondary"
                                    onclick="clearField('tgl')">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>

                    </div>

                    <!-- Nomor Surat dan Perihal -->
                    <div class="row g-9 mt-0">


                        <div class="col-md-4 fv-row">
                            <label class="fs-6 fw-semibold mb-2">Perihal</label>
                            <div class="input-group">
                                <input type="text" data-placeholder="-- Pilih lokal --" name="perihal" id="perihal"
                                    class="form-control reset-filter" />
                                <button type="button" class="btn btn-outline-danger bg-secondary"
                                    onclick="clearField('nomor')">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <div class="col-md-4 fv-row">
                            <label class="fs-6 fw-semibold mb-2">Pencipta Arsip</label>
                            <select class="form-select reset-filter opsiLain" name="pencipta" id="pencipta"
                                data-control="select2" data-tags="true" data-hide-search="false" data-placeholder="Semua">
                                <option value="">Semua</option>
                                @foreach (Helper::getData('kd_units') as $v)
                                    <option {{ isset($data->id) && $data->pencipta == $v->id ? 'selected' : '' }}
                                        value="{{ $v->id }}">
                                        {{ $v->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4 fv-row">
                            <label class="fs-6 fw-semibold mb-2">Unit pengolah</label>
                            <select class="form-select  reset-filter opsiLain" name="unit_pengolah" id="unit_pengolah"
                                data-control="select2" data-tags="true" data-hide-search="false" data-placeholder="Semua">
                                <option value="">Semua</option>
                                @foreach (Helper::getData('kd_units') as $v)
                                    <option {{ isset($data->id) && $data->unit_pengolah == $v->id ? 'selected' : '' }}
                                        value="{{ $v->id }}">
                                        {{ $v->nama }}
                                    </option>
                                @endforeach

                            </select>
                        </div>


                    </div>

                    <div class="row g-9 mt-0">
                        <div class="col-md-3 fv-row">
                            <label class="fs-6 fw-semibold mb-2">Lokal Arsip</label>
                            <select class="form-select reset-filter opsiLain" name="lokal" id="lokal"
                                data-control="select2" data-tags="true" data-hide-search="false" data-placeholder="Semua">
                                <option value="">Semua</option>
                                @foreach (Helper::getData('kd_units') as $v)
                                    <option {{ isset($data->id) && $data->lokal == $v->id ? 'selected' : '' }}
                                        value="{{ $v->id }}">
                                        {{ $v->nama }}
                                    </option>
                                @endforeach

                            </select>
                        </div>
                        <div class="col-md-3 fv-row">
                            <label class="fs-6 fw-semibold mb-2">Jenis Media</label>
                            <select class="form-select reset-filter opsiLain" name="jenis_media" id="jenis_media"
                                data-control="select2" data-tags="true" data-hide-search="false"
                                data-placeholder="Semua">
                                <option value="">Semua</option>
                                <option {{ isset($data->id) && $data->jenis_media == 'Audio' ? 'selected' : '' }}
                                    value="Audio">Audio</option>
                                <option {{ isset($data->id) && $data->jenis_media == 'Tekstual' ? 'selected' : '' }}
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
                            </select>
                        </div>

                        <div class="col-md-2 fv-row">
                            <label class="fs-6 fw-semibold mb-2">Keterangan Keaslian</label>
                            <select data-placeholder="Semua" data-tags="true" name="ket" id="ket"
                                class="form-select reset-filter opsiLain">
                                <option value="">Semua</option>
                                <option value="Asli">Asli</option>
                                <option value="Salinan">Salinan</option>
                            </select>
                        </div>

                        <div class="col-md-2 fv-row">
                            <label class="fs-6 fw-semibold mb-2">Jumlah</label>
                            <div class="input-group">
                                <input type="number" class="form-control reset-filter" name="jumlah" id="jumlah"
                                    placeholder="Masukkan jumlah" />
                                <button type="button" class="btn btn-outline-danger bg-secondary"
                                    onclick="clearField('jumlah')">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <div class="col-md-2 fv-row">
                            <label class="fs-6 fw-semibold mb-2">Nomor Rak / Lemari</label>
                            <div class="input-group">
                                <input type="text" class="form-control reset-filter" name="no_rak" id="no_rak"
                                    placeholder="Masukkan nomor rak surat" />
                                <button type="button" class="btn btn-outline-danger bg-secondary"
                                    onclick="clearField('no_rak')">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>

                    </div>

                    <div class="row g-9 mt-2">


                        <div class="col-md-3 fv-row">
                            <label class="fs-6 fw-semibold mb-2">Nomor Box / Bundel</label>
                            <div class="input-group">
                                <input type="text" class="form-control reset-filter" name="no_box" id="no_box"
                                    placeholder="Masukkan nomor box surat" />
                                <button type="button" class="btn btn-outline-danger bg-secondary"
                                    onclick="clearField('no_box')">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <div class="col-md-3 fv-row">
                            <label class="required fs-6 fw-semibold mb-2">Retensi Aktif</label>

                            <select class="form-select mb-2 opsiLain" data-control="select2" name="retensi"
                                id="retensi" data-tags="true" data-selected="{{ $data->retensi ?? '' }}">
                                <option value="">Pilih Retensi...</option>
                                <!-- Opsi retensi akan ditambahkan melalui JavaScript -->
                            </select>
                            <div id="retensi_warning" style="display: none; color: red;" class="mt-2">
                                <strong>Warning:</strong> Retensi period has expired!
                            </div>
                        </div>

                        <div class="col-md-3 fv-row">
                            <label class="required fs-6 fw-semibold mb-2">Retensi Inaktif</label>

                            <select class="form-select mb-2 opsiLain" data-control="select2" name="retensi2"
                                id="retensi2" data-tags="true" data-selected="{{ $data->retensi2 ?? '' }}">
                                <option value="">Pilih Retensi...</option>
                                <!-- Opsi retensi inaktif akan ditambahkan melalui JavaScript -->
                            </select>
                            <div id="retensi_warning" style="display: none; color: red;" class="mt-2">
                                <strong>Warning:</strong> Retensi period has expired!
                            </div>
                        </div>


                        <div class="col-md-3 fv-row">
                            <label class="required fs-6 fw-semibold mb-2">Retensi Nasib</label>

                            <select class="form-select mb-2 opsiLain" data-tags="true" data-control="select2"
                                name="retensi3" id="retensi3">
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

                    <!-- Status dan Asal -->
                    <div class="row g-9 mt-0">

                        <div class="col-md-3 fv-row">
                            <label class="fs-6 fw-semibold mb-2">Keterangan</label>
                            <div class="input-group">
                                <input type="text" class="form-control reset-filter" name="uraian" id="uraian"
                                    placeholder="Masukkan keterangan surat" />
                                <button type="button" class="btn btn-outline-danger bg-secondary"
                                    onclick="clearField('uraian')">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>


                        <div class="col-md-3">
                            <label for="dari_tanggal" class="form-label">Pencarian Asip dari tanggal</label>
                            <div class="input-group">
                                <input type="text" placeholder="dd/mm/yyyy" onfocus="(this.type='date')"
                                    onblur="(this.type='text')" class="form-control" name="dari_tanggal"
                                    id="dari_tanggal" />
                                <button type="button" class="btn btn-outline-danger bg-secondary"
                                    onclick="clearField('dari_tanggal')">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="sampai_tanggal" class="form-label">Sampai tanggal</label>
                            <div class="input-group">
                                <input type="text" placeholder="dd/mm/yyyy" onfocus="(this.type='date')"
                                    onblur="(this.type='text')" class="form-control" name="sampai_tanggal"
                                    id="sampai_tanggal" />
                                <button type="button" class="btn btn-outline-danger bg-secondary"
                                    onclick="clearField('sampai_tanggal')">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="row g-9 mt-0">
                        <div class="card-toolbar flex-row-fluid justify-content-end gap-2">
                            <button type="submit" id="search_filter" class="btn mb-2  btn-primary">
                                <span class="indicator-label">Cari</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </button>
                            <button type="reset" id="clear_filter" class="btn mb-2  btn-warning">
                                <span class="indicator-label">Clear All</span>
                            </button>
                            <button type="submit" id="excel_filter" class="btn mb-2  btn-success">
                                <span class="btn-label">
                                    <i class="fa-solid fa-table fs-3"></i>
                                </span>
                            </button>
                            <button type="submit" id="print_filter" class="btn mb-2  btn-info">
                                <span class="btn-label">
                                    <i class="fa-solid fa-print fs-3"></i>
                                </span>
                            </button>


                            {{-- <button id="button_filter" class="btn btn-secondary">
                                Pencarian lanjut
                            </button>
    
                            <button id="button_hideFilter" class="btn btn-secondary">
                                Sembunyikan pencarian
                            </button> --}}
                        </div>
                    </div>



                    <div class="table-responsive mt-15">
                        <!--begin::Table-->
                        <table class="table align-middle table-bordered table-hover table-row-dashed fs-6 gy-5"
                            id="kt_ecommerce_products_table">
                            <thead>
                                <tr class="text-start text-gray-600 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-20px pe-2">No</th>
                                    <th class="min-w-120px text-nowrap">Nomor Arsip</th>
                                    <th class="min-w-140px text-nowrap">Tanggal Arsip</th>
                                    <th class="min-w-120px text-nowrap">Kodel Klasifikasi</th>
                                    {{-- <th class="min-w-120px">Perihal Arsip</th> --}}
                                    {{-- <th class="min-w-120px">Unit Pengolah Arsip</th> --}}
                                    {{-- <th class="min-w-120px">Lokal Arsip</th> --}}
                                    {{-- <th class="min-w-120px">Jenis Media Arsip</th> --}}
                                    <th class="min-w-300px">Uraian Arsip</th>
                                    <th class="min-w-120px">Keterangan</th>
                                    <th class="min-w-120px">File</th>
                                    {{-- <th class="min-w-120px">Nomor Rak</th> --}}
                                    <th class="min-w-120px">Jumlah </th>
                                    <th class="min-w-120px text-nowrap">Nomor Box</th>
                                    {{-- <th class="min-w-120px">Pencipta Arsip</th> --}}
                                    <th class="min-w-120px">Retensi</th>
                                    <th class="text-end ">Actions</th>
                                </tr>
                            </thead>

                            <tbody class="fw-semibold text-gray-600 datatables">

                            </tbody>

                            {{-- <tbody class="fw-semibold text-gray-600">
                                <tr>
                                    <td class="text-end">
                                        <a href="#"
                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                            data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                    class="menu-link px-3">Edit</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3"
                                                    data-kt-ecommerce-product-filter="delete_row">Delete</a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                </tr>
                            </tbody> --}}

                        </table>
                        <!--end::Table-->
                    </div>

                    <!--begin::Pagination-->
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <div class="d-flex flex-wrap py-2 mr-3">
                            <div class="text-center pagination">
                                <div id="contentPage"></div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center py-3">
                            <ul class="pagination twbs-pagination">
                            </ul>
                        </div>
                    </div>
                    <!--end::Pagination-->

                </div>



                <!--end::Card body-->
            </div>
            <!--end::Products-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
@endsection

@push('jsScript')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.opsiLain').select2({
                tags: true, // Memungkinkan input manual
                placeholder: "Pilih ...",
                allowClear: true,
            });



            loadpage(5, '');

            const filterForm = $('#filterArsip');
            const hideBtnFilter = $('#button_hideFilter')
            const showBtnFilter = $('#button_filter')
            const resetFilter = $('.reset-filter')

            hideBtnFilter.hide()

            showBtnFilter.on('click', function(e) {
                console.log('show filter');
                filterForm.show()
                hideBtnFilter.show()
                showBtnFilter.hide()
            });

            hideBtnFilter.on('click', function(e) {
                console.log('hide filter');
                filterForm.hide()
                hideBtnFilter.hide()
                showBtnFilter.show()
                resetFilter.val('')
            });

            var $pagination = $('.twbs-pagination');
            var defaultOpts = {
                totalPages: 1,
                prev: '&#8672;',
                next: '&#8674;',
                first: '&#8676;',
                last: '&#8677;',
            };
            $pagination.twbsPagination(defaultOpts);

            function loadcetak(search = '') {
                $.ajax({
                    url: '{{ route('cari-arsip.data.pdf') }}',
                    data: {
                        "search": search,
                    },
                    type: "GET",
                    datatype: "json",
                    success: function(data) {
                        console.log('data : ', data);
                        if (data.pdf_url) {
                            window.open(data.pdf_url, '_blank');
                        } else {
                            window.open(data.pdf_url, '_blank');
                            console.error("PDF URL tidak ditemukan di respons");
                        }
                    },
                    error: function(error) {
                        console.error("Error:", error);
                    }
                });
            }

            function loadexport(search) {
                console.log('cetak :', search);
                const url = '{{ route('cari-arsip.data.export') }}' + '?search=' + encodeURIComponent(JSON
                    .stringify(
                        search));
                window.open(url, '_blank');
                return
            }


            function loaddata(page, per_page, search) {
                $.ajax({
                    url: '{{ route('cari-arsip' . '.data') }}',
                    data: {
                        "page": page,
                        "per_page": per_page,
                        "search": search,
                    },
                    type: "GET",
                    datatype: "json",
                    success: function(data) {
                        console.log(data);
                        $(".datatables").html(data.html);
                    }
                });
            }

            function loadpage(per_page, search) {
                $.ajax({
                    url: '{{ route('cari-arsip' . '.data') }}',
                    data: {
                        "per_page": per_page,
                        "search": search,
                    },
                    type: "GET",
                    datatype: "json",
                    success: function(response) {
                        if ($pagination.data("twbs-pagination")) {
                            $pagination.twbsPagination('destroy');
                            $(".datatables").html('<tr><td colspan="4">Data not found</td></tr>');
                        }
                        $pagination.twbsPagination($.extend({}, defaultOpts, {
                            startPage: 1,
                            totalPages: response.total_page,
                            visiblePages: 8,
                            prev: '&#8672;',
                            next: '&#8674;',
                            first: '&#8676;',
                            last: '&#8677;',
                            onPageClick: function(event, page) {
                                if (page == 1) {
                                    var to = 1;
                                } else {
                                    var to = page * per_page - (per_page - 1);
                                }
                                if (page == response.total_page) {
                                    var end = response.total_data;
                                } else {
                                    var end = page * per_page;
                                }
                                $('#contentPage').text('Showing ' + to + ' to ' + end +
                                    ' of ' +
                                    response.total_data + ' entries');
                                loaddata(page, per_page, search);
                            }
                        }));
                    }
                });
            }

            $("#perPage").on('click change', function(event) {
                let per_page = $('#perPage').val() || 5;
                loadpage(per_page, '');
            });

            $("#button_refresh").on('click', function(event) {
                $('#input_search').val('');
                loadpage(5, '');
            });

            // clear filter
            document.getElementById('clear_filter').addEventListener('click', function() {
                const fields = ['nomor', 'kepada', 'tgl_surat', 'perihal', 'status', 'asal', 'tgl_terima',
                    'tgl_input',
                    'ttd', 'tujuan', 'jenis', 'retensi', 'retensi2', 'retensi3', 'dari_tanggal',
                    'sampai_tanggal',
                    'kd_klasifikasi_id', 'tgl', 'pencipta', 'unit_pengolah', 'lokal', 'jenis_media',
                    'ket_keaslian', 'jumlah',
                    'no_rak', 'no_box', 'ket'
                ];

                fields.forEach(fieldId => {
                    const field = document.getElementById(fieldId);
                    if (field) {
                        if (field.type === 'select-one') {
                            // Jika Select2 digunakan, reset dengan Select2 API
                            if ($(field).data('select2')) {
                                $(field).val(null).trigger('change'); // Reset Select2
                            } else {
                                field.selectedIndex = 0; // Reset dropdown standar
                            }
                        } else {
                            field.value = ''; // Kosongkan input teks atau tanggal
                        }
                    }
                });
            });

            // more filter
            $('#search_filter').on('click', function() {
                let nomor = $('#nomor').val()
                let uraian = $('#uraian').val()
                let retensi = $('#retensi').val()
                let retensi2 = $('#retensi2').val()
                let retensi3 = $('#retensi3').val()
                let pencipta = $('#pencipta').val()
                let jumlah = $('#jumlah').val()
                let unit_pengolah = $('#unit_pengolah').val()
                let lokal = $('#lokal').val()
                let media = $('#media').val()
                let tgl = $('#tgl').val()
                let ket = $('#ket').val()
                let kd_klasifikasi_id = $('#kd_klasifikasi_id').val()
                let perihal = $('#perihal').val()
                let no_rak = $('#no_rak').val()
                let no_box = $('#no_box').val()
                let dari_tanggal = $('#dari_tanggal').val()
                let sampai_tanggal = $('#sampai_tanggal').val()

                const formData = {
                    'nomor': nomor || null,
                    'uraian': uraian || null,
                    'retensi': retensi || null,
                    'retensi2': retensi2 || null,
                    'retensi3': retensi3 || null,
                    'pencipta': pencipta || null,
                    'jumlah': jumlah || null,
                    'unit_pengolah': unit_pengolah || null,
                    'lokal': lokal || null,
                    'media': media || null,
                    'tgl': tgl || null,
                    'ket': ket || null,
                    'kd_klasifikasi_id': kd_klasifikasi_id || null,
                    'perihal': perihal || null,
                    'no_rak': no_rak || null,
                    'no_box': no_box || null,
                    'dari_tanggal': dari_tanggal || null,
                    'sampai_tanggal': sampai_tanggal || null,
                }

                // Object.values(formData).forEach((key) => {
                //     console.log(key, formData[key]);
                // });
                console.log(formData);
                let cekValue = Object.values(formData).every(v => v == '' || v == null || v == undefined);
                if (cekValue) {
                    loadpage(5, '');
                } else {
                    loadpage(5, formData);
                }


            });

            $('#print_filter').on('click', function(e) {
                e.preventDefault();

                let nomor = $('#nomor').val()
                let uraian = $('#uraian').val()
                let retensi = $('#retensi').val()
                let retensi2 = $('#retensi2').val()
                let retensi3 = $('#retensi3').val()
                let pencipta = $('#pencipta').val()
                let unit_pengolah = $('#unit_pengolah').val()
                let lokal = $('#lokal').val()
                let media = $('#media').val()
                let tgl = $('#tgl').val()
                let ket = $('#ket').val()
                let kd_klasifikasi_id = $('#kd_klasifikasi_id').val()
                let perihal = $('#perihal').val()
                let no_rak = $('#no_rak').val()
                let no_box = $('#no_box').val()
                let jumlah = $('#jumlah').val()

                const formData = {
                    'nomor': nomor || null,
                    'uraian': uraian || null,
                    'retensi': retensi || null,
                    'retensi2': retensi2 || null,
                    'retensi3': retensi3 || null,
                    'pencipta': pencipta || null,
                    'unit_pengolah': unit_pengolah || null,
                    'lokal': lokal || null,
                    'media': media || null,
                    'tgl': tgl || null,
                    'ket': ket || null,
                    'kd_klasifikasi_id': kd_klasifikasi_id || null,
                    'perihal': perihal || null,
                    'no_rak': no_rak || null,
                    'no_box': no_box || null,
                    'jumlah': jumlah || null,
                }

                // Object.values(formData).forEach((key) => {
                //     console.log(key, formData[key]);
                // });
                let cekValue = Object.values(formData).every(v => v == '' || v == null || v == undefined);


                if (cekValue) {
                    loadcetak('');
                } else {
                    loadcetak(formData);
                }


            });

            $('#excel_filter').on('click', function(e) {
                e.preventDefault();

                let nomor = $('#nomor').val()
                let uraian = $('#uraian').val()
                let retensi = $('#retensi').val()
                let retensi2 = $('#retensi2').val()
                let retensi3 = $('#retensi3').val()
                let pencipta = $('#pencipta').val()
                let unit_pengolah = $('#unit_pengolah').val()
                let lokal = $('#lokal').val()
                let media = $('#media').val()
                let tgl = $('#tgl').val()
                let ket = $('#ket').val()
                let kd_klasifikasi_id = $('#kd_klasifikasi_id').val()
                let perihal = $('#perihal').val()
                let no_rak = $('#no_rak').val()
                let no_box = $('#no_box').val()
                let jumlah = $('#jumlah').val()

                const formData = {
                    'nomor': nomor || null,
                    'uraian': uraian || null,
                    'retensi': retensi || null,
                    'retensi2': retensi2 || null,
                    'retensi3': retensi3 || null,
                    'pencipta': pencipta || null,
                    'unit_pengolah': unit_pengolah || null,
                    'lokal': lokal || null,
                    'media': media || null,
                    'tgl': tgl || null,
                    'ket': ket || null,
                    'kd_klasifikasi_id': kd_klasifikasi_id || null,
                    'perihal': perihal || null,
                    'no_rak': no_rak || null,
                    'no_box': no_box || null,
                    'jumlah': jumlah || null,
                }

                // Object.values(formData).forEach((key) => {
                //     console.log(key, formData[key]);
                // });
                let cekValue = Object.values(formData).every(v => v == '' || v == null || v == undefined);


                if (cekValue) {
                    loadexport('');
                } else {
                    loadexport(formData);
                }


            });

            // proses delete data
            $('body').on('click', '.deleteData', function() {
                var id = $(this).data("id");
                Swal.fire({
                    title: "Are you sure to Delete?",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonText: "Yes, delete it!"
                }).then(function(result) {
                    if (result.value) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: "DELETE",
                            url: '{{ url("admin/$title") }}/' + id,
                            success: function(data) {
                                loadpage(5, '');
                                toastr.success("Successful delete data!");
                            },
                            error: function(data) {
                                toastr.error("Failed delete data!");
                            }
                        });
                    }
                });
            });




        });

        function clearField(fieldId) {
            const field = document.getElementById(fieldId);
            if (field) {
                if (field.type === 'select-one') {
                    field.selectedIndex = 0; // Reset dropdowns
                } else {
                    field.value = ''; // Clear text and date fields
                }
            }
        }

        function updateRetensi() {
            var tglSurat = document.getElementById('tgl').value;

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

        document.getElementById('tgl').addEventListener('change', updateRetensi);

        // Memanggil fungsi saat halaman pertama kali dimuat jika tgl sudah ada
        if (document.getElementById('tgl').value) {
            updateRetensi();
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
@endpush
