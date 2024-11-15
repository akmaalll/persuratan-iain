@extends('admin._layouts.index')

@push('dashboard')
    here
@endpush

@section('content')
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="/admin" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">Dashboards</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <!--begin::Row-->
            <div class="row gx-5 gx-xl-10">
                <!--begin::Col-->
                <div class="col-xl-12 mb-10">
                    <!--begin::Lists Widget 19-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Heading-->
                        <div class="card-header rounded bgi-no-repeat bgi-size-cover bgi-position-y-top bgi-position-x-center align-items-start h-250px"
                            {{-- style="background-image:url({{ asset('themes/dist/assets/media/svg/shapes/top-green.png') }})" --}} style="background-color: #337ab7" data-bs-theme="light">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column text-white pt-15">
                                <span class="fw-bold fs-2x">
                                    Selamat Datang - Kearsipan IAIN Pare-Pare
                                </span>
                            </h3>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Body-->
                        <div class="card-body mt-n20">
                            <!--begin::Stats-->
                            <div class="mt-n20 position-relative">
                                <!--begin::Row-->
                                <div class="row g-3 g-lg-6">
                                    <!--begin::Col-->
                                    <div class="col-4">
                                        <!--begin::Items-->
                                        <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-30px me-5 mb-8">
                                                <span class="symbol-label">
                                                    <i class="ki-duotone ki-file-down fs-1 text-primary">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                </span>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Stats-->
                                            <div class="m-0">
                                                <!--begin::Number-->
                                                <span
                                                    class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1">{{ $data['countMasuk'] }}</span>
                                                <!--end::Number-->
                                                <!--begin::Desc-->
                                                <span class="text-gray-500 fw-semibold fs-6">Surat Masuk</span>
                                                <!--end::Desc-->
                                            </div>
                                            <!--end::Stats-->
                                        </div>
                                        <!--end::Items-->
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-4">
                                        <!--begin::Items-->
                                        <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-30px me-5 mb-8">
                                                <span class="symbol-label">
                                                    <i class="ki-duotone ki-file-up fs-1 text-primary">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                </span>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Stats-->
                                            <div class="m-0">
                                                <!--begin::Number-->
                                                <span
                                                    class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1">{{ $data['countKeluar'] }}</span>
                                                <!--end::Number-->
                                                <!--begin::Desc-->
                                                <span class="text-gray-500 fw-semibold fs-6">Surat Keluar</span>
                                                <!--end::Desc-->
                                            </div>
                                            <!--end::Stats-->
                                        </div>
                                        <!--end::Items-->
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-4">
                                        <!--begin::Items-->
                                        <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-30px me-5 mb-8">
                                                <span class="symbol-label">
                                                    <i class="ki-duotone ki-abstract-14 fs-1 text-primary">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                </span>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Stats-->
                                            <div class="m-0">
                                                <!--begin::Number-->
                                                <span
                                                    class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1">{{ $data['countArsip'] }}</span>
                                                <!--end::Number-->
                                                <!--begin::Desc-->
                                                <span class="text-gray-500 fw-semibold fs-6">Data Arsip</span>
                                                <!--end::Desc-->
                                            </div>
                                            <!--end::Stats-->
                                        </div>
                                        <!--end::Items-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Stats-->

                            <div class="mt-5">

                                <div class="row">
                                    <div class="d-flex justify-content-between flex-wrap">

                                        <h3 class="card-title align-items-start flex-column text-dark pt-10 pb-5">
                                            <span class="fw-bold fs-2x">
                                                Pencarian Persuratan
                                            </span>
                                        </h3>
                                        <!--begin::Actions-->
                                        <div class="mx-8 mt-10">
                                            <button type="submit" id="search_filter" class="btn mb-2 btn-primary">
                                                <span class="indicator-label">Cari</span>
                                                <span class="indicator-progress">Please wait...
                                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                            </button>
                                            <button type="submit" id="excel_filter" class="btn mb-2 btn-success">
                                                <span class="btn-label">
                                                    <i class="fa-solid fa-table fs-3"></i>
                                                </span>
                                            </button>
                                            <button type="submit" id="print_filter" class="btn mb-2 btn-info">

                                                <span class="btn-label">
                                                    <i class="fa-solid fa-print fs-3"></i>
                                                </span>
                                            </button>

                                        </div>
                                        <!--end::Actions-->
                                    </div>
                                    <!--begin:Form-->

                                    <div id="filterArsip">

                                        <!-- Kode Klasifikasi -->
                                        <div class="row">
                                            <div class="col-md-4 fv-row">
                                                <label class="fs-6 fw-semibold mb-2">Nomor Arsip</label>
                                                <input type="text" class="form-control reset-filter" name="nomor"
                                                    id="nomor" placeholder="Masukkan nomor surat" />
                                            </div>

                                            <!-- Tanggal Surat -->
                                            <div class="col-md-3 fv-row">
                                                <label class="fs-6 fw-semibold mb-2">Tanggal arsip</label>
                                                <input type="date" data-placeholder="-- Pilih lokal --" name="tgl"
                                                    id="tgl" class="form-control reset-filter" />
                                            </div>




                                            <div class="col-md-5 fv-row">
                                                <label class="fs-6 fw-semibold mb-2">Perihal</label>
                                                <input type="text" data-placeholder="-- Pilih lokal --" name="perihal"
                                                    id="perihal" class="form-control reset-filter" />
                                            </div>


                                        </div>

                                        <!-- Nomor Surat dan Perihal -->
                                        <div class="row g-9 mt-0">

                                            {{-- untuk tabel kode klasifikasi --}}
                                            <div class="col-md-4 fv-row">
                                                <label class="fs-6 fw-semibold mb-2">Kode Klasifikasi</label>
                                                <select class="form-select reset-filter" name="kd_klasifikasi_id"
                                                    id="kd_klasifikasi_id" data-control="select2"
                                                    data-hide-search="false" data-placeholder="Semua">
                                                    <option value="">Semua</option>
                                                    @foreach (Helper::getData('kd_klasifikasis') as $v)
                                                        <option value="{{ $v->id }}">
                                                            {{ $v->nama }} - {{ $v->nomor }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                            </div>

                                            <div class="col-md-4 fv-row">
                                                <label class="fs-6 fw-semibold mb-2">Pencipta Arsip</label>
                                                <select class="form-select reset-filter" name="pencipta" id="pencipta"
                                                    data-control="select2" data-hide-search="false"
                                                    data-placeholder="Semua">
                                                    <option value="">Semua</option>
                                                    @foreach (Helper::getData('kd_units') as $v)
                                                        <option
                                                            {{ isset($data->id) && $data->pencipta == $v->id ? 'selected' : '' }}
                                                            value="{{ $v->id }}">
                                                            {{ $v->nama }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-4 fv-row">
                                                <label class="fs-6 fw-semibold mb-2">Unit pengolah</label>
                                                <select class="form-select  reset-filter" name="unit_pengolah"
                                                    id="unit_pengolah" data-control="select2" data-hide-search="false"
                                                    data-placeholder="Semua">
                                                    <option value="">Semua</option>
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

                                        <div class="row g-9 mt-0">
                                            <div class="col-md-3 fv-row">
                                                <label class="fs-6 fw-semibold mb-2">Lokasi</label>
                                                <select class="form-select reset-filter" name="lokal" id="lokal"
                                                    data-control="select2" data-hide-search="false"
                                                    data-placeholder="Semua">
                                                    <option value="">Semua</option>
                                                    @foreach (Helper::getData('kd_units') as $v)
                                                        <option
                                                            {{ isset($data->id) && $data->lokal == $v->id ? 'selected' : '' }}
                                                            value="{{ $v->id }}">
                                                            {{ $v->nama }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                            </div>
                                            <div class="col-md-3 fv-row">
                                                <label class="fs-6 fw-semibold mb-2">Media</label>
                                                <select class="form-select reset-filter" name="media" id="media"
                                                    data-control="select2" data-hide-search="false"
                                                    data-placeholder="Semua">
                                                    <option value="">Semua</option>
                                                    <option
                                                        {{ isset($data->id) && $data->jenis_media == 'Audio' ? 'selected' : '' }}
                                                        value="Audio">Audio</option>
                                                    <option
                                                        {{ isset($data->id) && $data->jenis_media == 'Tekstual' ? 'selected' : '' }}
                                                        value="Tekstual">Tekstual</option>
                                                    <option
                                                        {{ isset($data->id) && $data->jenis_media == 'Video' ? 'selected' : '' }}
                                                        value="Video">Video</option>
                                                    <option
                                                        {{ isset($data->id) && $data->jenis_media == 'Foto' ? 'selected' : '' }}
                                                        value="Foto">Foto</option>
                                                    <option
                                                        {{ isset($data->id) && $data->jenis_media == 'Kaset' ? 'selected' : '' }}
                                                        value="Kaset">Kaset</option>
                                                    <option
                                                        {{ isset($data->id) && $data->jenis_media == 'CD' ? 'selected' : '' }}
                                                        value="CD">CD</option>
                                                    <option
                                                        {{ isset($data->id) && $data->jenis_media == 'FD' ? 'selected' : '' }}
                                                        value="FD">FD</option>
                                                </select>
                                            </div>

                                            <div class="col-md-3 fv-row">
                                                <label class="fs-6 fw-semibold mb-2">Keterangan</label>
                                                <select data-placeholder="Semua" name="ket" id="ket"
                                                    class="form-select reset-filter">
                                                    <option value="">Semua</option>
                                                    <option value="Asli">Asli</option>
                                                    <option value="Salinan">Salinan</option>
                                                </select>
                                            </div>

                                            <div class="col-md-3 fv-row">
                                                <label class="fs-6 fw-semibold mb-2">Retensi</label>
                                                <select data-placeholder="Semua" name="retensi" id="retensi"
                                                    data-control="select2" data-hide-search="false"
                                                    class="form-select  reset-filter">
                                                    <option value="">Semua</option>
                                                    <option value="1 tahun">1 tahun</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Status dan Asal -->
                                        <div class="row g-9 mt-0">


                                            <div class="col-md-3 fv-row">
                                                <label class="fs-6 fw-semibold mb-2">Nomor Rak / Lemari</label>
                                                <input type="text" class="form-control reset-filter" name="no_rak"
                                                    id="no_rak" placeholder="Masukkan nomor rak surat" />
                                            </div>

                                            <div class="col-md-3 fv-row">
                                                <label class="fs-6 fw-semibold mb-2">Nomor Box / Bundel</label>
                                                <input type="text" class="form-control reset-filter" name="no_box"
                                                    id="no_box" placeholder="Masukkan nomor box surat" />
                                            </div>


                                            <div class="col-md-6 fv-row">
                                                <label class="fs-6 fw-semibold mb-2">Uraian</label>
                                                <input type="text" class="form-control reset-filter" name="uraian"
                                                    id="uraian" placeholder="Masukkan uraian surat" />
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="">
                                    <div style="padding: 0;" class="card-header align-items-center py-5 gap-2 gap-md-5">
                                        <!--begin::Card title-->
                                        <div class="card-title">
                                            <h3 class="align-items-start flex-column text-dark pt-5 pb-5 me-10">
                                                <span class="fw-bold ">
                                                    Hasil Pencarian
                                                </span>
                                            </h3>
                                            <div class="mw-100px me-3">
                                                <select class="form-select form-select-solid me-3" data-control="select2"
                                                    data-hide-search="true" data-placeholder="Per Page" id="perPage">
                                                    <option>5</option>
                                                    <option>10</option>
                                                    <option>25</option>
                                                    <option>50</option>
                                                    <option>100</option>
                                                </select>
                                            </div>

                                            <button id="button_refresh" class="btn btn-secondary me-3">
                                                <span class="btn-label">
                                                    <i class="fa fa-sync"></i>
                                                </span>
                                            </button>
                                        </div>
                                        <!--end::Card title-->


                                    </div>
                                    <div class="table-responsive mt-5">
                                        <!--begin::Table-->
                                        <table class="table align-middle table-bordered fs-6 gy-5"
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
                                                    <th class="text-end ">Detail</th>
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


                            </div>

                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Lists Widget 19-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
@endsection

@push('jsScript')
    <script type="text/javascript">
        $(document).ready(function() {
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

            function loadcetak(search) {
                console.log('cetak :', search);
                $.ajax({
                    url: '{{ route('arsip.data.pdf') }}',
                    data: {
                        "search": search,
                    },
                    type: "GET",
                    datatype: "json",
                    success: function(data) {
                        if (data.pdf_url) {
                            // Buka PDF di tab baru
                            window.open(data.pdf_url, '_blank');
                        } else {
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
                const url = '{{ route('arsip.data.export') }}' + '?search=' + encodeURIComponent(JSON.stringify(
                    search));
                window.open(url, '_blank');
                return
            }


            function loaddata(page, per_page, search) {
                $.ajax({
                    url: '{{ route('arsip' . '.data.dashboard') }}',
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
                    url: '{{ route('arsip' . '.data.dashboard') }}',
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

            // more filter
            $('#search_filter').on('click', function() {
                let nomor = $('#nomor').val()
                let uraian = $('#uraian').val()
                let retensi = $('#retensi').val()
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

                const formData = {
                    'nomor': nomor || null,
                    'uraian': uraian || null,
                    'retensi': retensi || null,
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

                const formData = {
                    'nomor': nomor || null,
                    'uraian': uraian || null,
                    'retensi': retensi || null,
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
                }

                // Object.values(formData).forEach((key) => {
                //     console.log(key, formData[key]);
                // });
                console.log(formData);
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

                const formData = {
                    'nomor': nomor || null,
                    'uraian': uraian || null,
                    'retensi': retensi || null,
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
                            url: '{{ url('admin/arsip') }}/' + id,
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



        })
    </script>
@endpush
