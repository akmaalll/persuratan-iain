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
            Pencarian
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
                {{-- @include('admin._card.action') --}}
                <div class="card-header align-items-center py-5 gap-2 gap-md-5 flex-column flex-md-row">
                    <!--begin::Card title-->
                    <div class="card-title flex-column flex-sm-row gap-2 gap-md-0">
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
                        <div class="d-flex flex-column flex-sm-row gap-2 gap-md-0">
                            <input id="input_search" type="text" class="form-control form-control-solid w-250px me-3"
                                placeholder="Search">

                            <div class="d-flex">
                                <button id="button_search" class="btn btn-secondary me-3">
                                    <span class="btn-label">
                                        <i class="fa fa-search"></i>
                                    </span>
                                </button>

                                <button id="button_advanced_search" class="btn btn-secondary me-3 text-gray-600">
                                    <span class="btn-label">
                                        <i class="fa fa-sliders "></i>
                                    </span>
                                </button>

                                <button id="button_refresh" class="btn btn-secondary">
                                    <span class="btn-label">
                                        <i class="fa fa-sync"></i>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!--end::Card title-->

                    <!-- Advanced Search Fields (Hidden by Default) -->
                    <div id="advanced_search_fields"
                        class="mt-3 card-header align-items-center py-5 gap-2 gap-md-5 col-md-12 p-0"
                        style="display: none;">
                        <div class="row">
                            <!-- Tanggal Surat -->
                            <div class="col-md-6 mb-3">
                                <label for="input_tanggal_surat" class="form-label">Tanggal Surat</label>
                                <div class="input-group">
                                    <input value="{{ isset($data->tgl_surat) ? $data->tgl_surat : '' }}" type="text"
                                        placeholder="dd/mm/yyyy" onfocus="(this.type='date')" class="form-control"
                                        name="tgl_surat" id="tgl_surat" />
                                    <button type="button" class="btn btn-outline-danger bg-secondary"
                                        onclick="clearField('tgl_surat')">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Asal -->
                            <div class="col-md-6 mb-3">
                                <label for="input_asal" class="form-label">Asal</label>
                                <div class="input-group-btn" style="display: flex; align-items: center;">
                                    <select class="form-select" style="flex: 1;" data-control="select2"
                                        data-hide-search="false" data-placeholder="Pilih Asal" name="asal"
                                        id="asal">
                                        <option value="">Pilih Asal...</option>
                                        @foreach (Helper::getData('kd_units') as $v)
                                            <option value="{{ $v->id }}">{{ $v->nama }}</option>
                                        @endforeach
                                    </select>
                                    <button type="button" class="btn btn-outline-danger bg-secondary"
                                        style="margin-left: -6px;  border-top-left-radius: 0; border-bottom-left-radius: 0; z-index: 1;"
                                        onclick="clearField('asal')">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- Global Clear All Button -->
                        <div class="mt-3">
                            <button id="clear_all" class="btn btn-secondary">
                                <span class="btn-label">
                                    <i class="fa fa-eraser"></i> Clear All
                                </span>
                            </button>
                            <button id="search_filter" class="btn btn-primary">
                                <span class="btn-label">
                                    <i class="fa fa-search"></i> Search
                                </span>
                            </button>
                        </div>
                    </div>
                    <!--end::Advanced Search Fields (Hidden by Default)-->

                    <div class="d-flex justify-content-end" style="flex: 1">
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar justify-content-end gap-5 me-3">
                            <a href="{{ route($title . '.create') }}" class="btn btn-success">
                                <span class="btn-label">
                                    <i class="fa fa-plus"></i>
                                </span>
                                Tambah Nomor
                            </a>
                        </div>

                        <div class="card-toolbar justify-content-end gap-5">
                            <a href="{{ route($title . '.create', ['type' => 'sisip']) }}" class="btn btn-primary">
                                <span class="btn-label">
                                    <i class="ki-duotone ki-black-right"></i>
                                </span>
                                Sisipkan Nomor
                            </a>
                        </div>
                        <!--end::Card toolbar-->
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
                                    <th class="min-w-20px pe-2"> No </th>
                                    <th class="min-w-140px"> Nomor </th>
                                    {{-- <th class="min-w-20px pe-2"> Kode Klasifikasi </th> --}}
                                    <th class="min-w-140px"> Tanggal Surat </th>
                                    <th class="min-w-140px"> Perihal </th>
                                    <th class="min-w-140px"> Jenis </th>
                                    <th class="min-w-140px"> Status </th>
                                    <th class="min-w-140px"> Asal </th>
                                    <th class="min-w-140px"> Tujuan </th>
                                    <th class="text-end min-w-70px"> Aksi </th>
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
        document.getElementById('button_advanced_search').addEventListener('click', function() {
            const advancedFields = document.getElementById('advanced_search_fields');
            if (advancedFields.style.display === 'none' || advancedFields.style.display === '') {
                advancedFields.style.display = 'block';
            } else {
                advancedFields.style.display = 'none';
            }
        });

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

            $("#button_search, #perPage").on('click change', function(event) {
                let search = $('#input_search').val();
                let per_page = $('#perPage').val() ?? 5;
                loadpage(per_page, search);
            });

            $("#button_refresh").on('click', function(event) {
                $('#input_search').val('');
                loadpage(5, '');
            });

            $('#search_filter').on('click', function() {
                const tgl_surat = $('#tgl_surat').val() || null;
                const asal = $('#asal').val() || null;

                const checkVal = Object.values({
                    tgl_surat,
                    asal
                }).every(v => v == '' || v == null || v == undefined);

                if (checkVal) {
                    loadpage(5, '');
                } else {
                    loadpage(5, {
                        tgl_surat,
                        asal
                    });
                }
            });

            document.getElementById('clear_all').addEventListener('click', function() {
                const fields = ['tgl_surat', 'asal'];

                fields.forEach(fieldId => {
                    const field = document.getElementById(fieldId);
                    if (field) {
                        if (field.type === 'select-one') {
                            if ($(field).data('select2')) {
                                $(field).val(null).trigger('change'); // Reset Select2
                            } else {
                                field.selectedIndex = 0; // Reset dropdown standar
                            }
                        } else {
                            field.value = ''; // Clear text and date fields
                        }

                        loadpage(5, '');
                    }
                });
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
