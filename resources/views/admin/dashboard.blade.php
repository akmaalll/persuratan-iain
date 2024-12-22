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
                filterForm.show()
                hideBtnFilter.show()
                showBtnFilter.hide()
            });

            hideBtnFilter.on('click', function(e) {
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
