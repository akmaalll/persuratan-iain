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
                        <div class="d-flex">
                            <input id="input_search" type="text" class="form-control form-control-solid w-300px me-3"
                                placeholder="cari nomor / uraian">

                            <button id="button_search" class="btn btn-secondary me-3">
                                <span class="btn-label">
                                    <i class="fa fa-search"></i>
                                </span>
                            </button>

                            <button id="button_refresh" class="btn btn-secondary me-3">
                                <span class="btn-label">
                                    <i class="fa fa-sync"></i>
                                </span>
                            </button>

                            {{-- <button id="button_filter" class="btn btn-secondary">
                                Pencarian lanjut
                            </button> --}}

                            {{-- <button id="button_hideFilter" class="btn btn-secondary">
                                Sembunyikan pencarian
                            </button> --}}
                        </div>
                    </div>
                    <!--end::Card title-->

                    <!--begin::Card toolbar-->
                    <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                        <a href="{{ route($title . '.create') }}" class="btn btn-success">
                            <span class="btn-label">
                                <i class="fa fa-plus"></i>
                            </span>
                            Add New
                        </a>
                    </div>

                    <!--end::Card toolbar-->

                    <div class="card-body" id="filterArsip">

                        <div class="row">
                            <!--begin:Form-->

                            <!-- Kode Klasifikasi -->
                            <div class="row mb-8">
                                <div class="col-md-5 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Nomor Arsip</label>
                                    <input type="text" class="form-control reset-filter" name="nomor" id="nomor"
                                        placeholder="Masukkan nomor surat" />
                                </div>

                                <!-- Tanggal Surat -->
                                <div class="col-md-5 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Uraian</label>
                                    <input type="text" class="form-control reset-filter" name="uraian" id="uraian"
                                        placeholder="Masukkan uraian surat" />
                                </div>

                                <div class="col-md-2 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Retensi</label>
                                    <select data-placeholder="Semua" name="retensi" id="retensi"
                                        data-control="select2" data-hide-search="false" class="form-select  reset-filter">
                                        <option value="">Semua</option>
                                        <option value="1 tahun">1 tahun</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Nomor Surat dan Perihal -->
                            <div class="row g-9 mb-8">
                                <div class="col-md-4 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Pencipta Arsip</label>
                                    <select class="form-select  reset-filter" name="pencipta" id="pencipta"
                                        data-control="select2" data-hide-search="false"
                                        data-placeholder="Semua">
                                        <option value="">Semua</option>
                                        <option value="Keuangan">Keuangan</option>

                                    </select>
                                </div>

                                <div class="col-md-4 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Unit pengolah</label>
                                    <select class="form-select  reset-filter" name="unit_pengolah" id="unit_pengolah"
                                        data-control="select2" data-hide-search="false" data-placeholder="Semua">
                                        <option value="">Semua</option>
                                        <option value="Tata Usaha">Tata Usaha</option>

                                    </select>
                                </div>
                                <div class="col-md-2 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Lokasi</label>
                                    <select class="form-select reset-filter" name="lokal" id="lokal"
                                        data-control="select2" data-hide-search="false"
                                        data-placeholder="Semua">
                                        <option value="">Semua</option>
                                        <option value="BAAK">BAAK</option>

                                    </select>
                                </div>
                                <div class="col-md-2 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Media</label>
                                    <select class="form-select reset-filter" name="media" id="media"
                                        data-control="select2" data-hide-search="false"
                                        data-placeholder="Semua">
                                        <option value="">Semua</option>
                                        <option value="Text">Text</option>

                                    </select>
                                </div>
                            </div>

                            <!-- Status dan Asal -->
                            <div class="row g-9 mb-8">

                                <div class="col-md-4 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Tanggal arsip</label>
                                    <input type="date" data-placeholder="-- Pilih lokal --" name="tgl"
                                        id="tgl" class="form-control reset-filter" />
                                </div>

                                <div class="col-md-2 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Keterangan</label>
                                    <select data-placeholder="Semua" name="ket" id="ket"
                                        class="form-select reset-filter">
                                        <option value="">Semua</option>
                                        <option value="Gedung A">Gedung A</option>
                                        <option value="Gedung B">Gedung B</option>
                                        <option value="Gedung C">Gedung C</option>
                                    </select>
                                </div>

                                {{-- untuk tabel kode klasifikasi --}}
                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Kode Klasifikasi</label>
                                    <select class="form-select reset-filter" name="kd_klasifikasi_id"
                                        id="kd_klasifikasi_id" data-control="select2" data-hide-search="false"
                                        data-placeholder="Semua">
                                        <option value="">Semua</option>
                                        @foreach (Helper::getData('kd_klasifikasis') as $v)
                                            <option value="{{ $v->id }}">
                                                {{ $v->nama }} - {{ $v->nomor }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>

                            </div>

                            <!--begin::Actions-->
                            <div class="d-flex justify-content-end">
                                <button type="submit" id="search_filter" class="btn btn-primary">
                                    <span class="indicator-label">Cari</span>
                                    <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>

                            </div>
                            <!--end::Actions-->

                        </div>

                    </div>
                </div>

                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_products_table">
                            <thead>
                                <tr class="text-start text-gray-600 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-20px pe-2">No</th>
                                    <th class="min-w-120px text-nowrap">Nomor Arsip</th>
                                    <th class="min-w-140px">Tanggal Arsip</th>
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
            loadpage(5, '');
            var $pagination = $('.twbs-pagination');
            var defaultOpts = {
                totalPages: 1,
                prev: '&#8672;',
                next: '&#8674;',
                first: '&#8676;',
                last: '&#8677;',
            };
            $pagination.twbsPagination(defaultOpts);



            function loaddata(page, per_page, search) {
                $.ajax({
                    url: '{{ route($title . '.data') }}',
                    data: {
                        "page": page,
                        "per_page": per_page,
                        "search": search,
                    },
                    type: "GET",
                    datatype: "json",
                    success: function(data) {
                        $(".datatables").html(data.html);
                    }
                });
            }

            function loadpage(per_page, search) {
                $.ajax({
                    url: '{{ route($title . '.data') }}',
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

            const filterForm = $('#filterArsip');
            const hideBtnFilter = $('#button_hideFilter')
            const showBtnFilter = $('#button_filter')
            const resetFilter = $('.reset-filter')


            filterForm.hide()
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


            $("#button_search, #perPage").on('click change', function(event) {
                let search = $('#input_search').val();
                let per_page = $('#perPage').val() ?? 5;
                loadpage(per_page, search);
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

                const formData = {
                    'nomor' : nomor,
                    'uraian' : uraian,
                    'retensi' : retensi,
                    'pencipta' : pencipta,
                    'unit_pengolah' : unit_pengolah,
                    'lokal' : lokal,
                    'media' : media,
                    'tgl' : tgl,
                    'ket' : ket,
                    'kd_klasifikasi_id' : kd_klasifikasi_id
                }
                loadpage(5, formData)

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
    </script>
@endpush
