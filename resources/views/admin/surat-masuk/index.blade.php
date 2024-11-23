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
                {{-- @include('admin._card.action2') --}}
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
                            <input id="input_search" type="text" class="form-control form-control-solid w-250px me-3"
                                placeholder="Search">

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
                </div>

                <!-- Advanced Search Fields (Hidden by Default) -->
                <div id="advanced_search_fields" class="mt-3 card-header align-items-center py-5 gap-2 gap-md-5"
                    style="display: none;">
                    <div class="row">
                        <!-- Input for Nomor Surat -->
                        <div class="col-md-4 mb-3">
                            <label for="input_nomor_surat" class="form-label">Nomor Surat</label>
                            <div class="input-group">
                                <input id="nomor" type="text" class="form-control"
                                    placeholder="Masukkan Nomor Surat">
                                <button type="button" class="btn btn-outline-danger bg-secondary"
                                    onclick="clearField('nomor')">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Input for Kepada -->
                        <div class="col-md-4 mb-3">
                            <label for="input_kepada" class="form-label">Kepada</label>
                            <div class="input-group">
                                <input id="kepada" type="text" class="form-control" placeholder="Masukkan Kepada">
                                <button type="button" class="btn btn-outline-danger bg-secondary"
                                    onclick="clearField('kepada')">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Input for Tanggal Surat -->
                        <div class="col-md-4 mb-3">
                            <label for="input_tanggal_surat" class="form-label">Tanggal Surat</label>
                            <div class="input-group">
                                {{-- <input id="tgl_surat" type="date" class="form-control"> --}}
                                <input value="{{ isset($data->tgl_surat) ? $data->tgl_surat : '' }}" type="text"
                                    placeholder="dd/mm/yyyy" onfocus="(this.type='date')" onblur="(this.type='text')"
                                    class="form-control" name="tgl_surat" id="tgl_surat" />
                                <button type="button" class="btn btn-outline-danger bg-secondary"
                                    onclick="clearField('tgl_surat')">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Input for Perihal -->
                        <div class="col-md-4 mb-3">
                            <label for="input_perihal" class="form-label">Perihal</label>
                            <div class="input-group">
                                <input id="perihal" type="text" class="form-control" placeholder="Masukkan Perihal">
                                <button type="button" class="btn btn-outline-danger bg-secondary"
                                    onclick="clearField('perihal')">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Input for Status -->
                        <div class="col-md-4 mb-3">
                            <label for="input_status" class="form-label">Status</label>
                            <div class="d-flex">
                                <select class="form-select" data-control="select2" data-hide-search="false"
                                    data-placeholder="Pilih Status" name="status" id="status">
                                    <option value="">Status...</option>
                                    <option value="biasa">Biasa</option>
                                    <option value="penting">Penting</option>
                                    <option value="terbatas">Terbatas</option>
                                    <option value="sangat terbatas">Sangat Terbatas</option>
                                    <option value="rahasia">Rahasia</option>
                                </select>
                            </div>
                        </div>

                        <!-- Input for Asal -->
                        <div class="col-md-4 mb-3">
                            <label for="input_asal" class="form-label">Asal</label>
                            <div class="input-group">
                                <select class="form-select" data-control="select2" data-hide-search="false"
                                    data-placeholder="Pilih Asal" name="asal" id="asal">
                                    <option value="">Pilih Asal...</option>
                                    @foreach (Helper::getData('kd_units') as $v)
                                        <option value="{{ $v->id }}">{{ $v->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Input for Tanggal Terima -->
                        <div class="col-md-4 mb-3">
                            <label for="input_tanggal_terima" class="form-label">Tanggal Terima</label>
                            <div class="input-group">
                                {{-- <input id="tgl_terima" type="date" class="form-control"> --}}
                                <input value="{{ isset($data->tgl_terima) ? $data->tgl_terima : '' }}" type="text"
                                    placeholder="dd/mm/yyyy" onfocus="(this.type='date')" onblur="(this.type='text')"
                                    class="form-control" name="tgl_terima" id="tgl_terima" />
                                <button type="button" class="btn btn-outline-danger bg-secondary"
                                    onclick="clearField('tgl_terima')">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Input for Tanggal Input -->
                        <div class="col-md-4 mb-3">
                            <label for="input_tanggal_input" class="form-label">Tanggal Input</label>
                            <div class="input-group">
                                {{-- <input id="tgl_input" type="date" class="form-control"> --}}
                                <input value="{{ isset($data->tgl_input) ? $data->tgl_input : '' }}" type="text"
                                    placeholder="dd/mm/yyyy" onfocus="(this.type='date')" onblur="(this.type='text')"
                                    class="form-control" name="tgl_input" id="tgl_input" />
                                <button type="button" class="btn btn-outline-danger bg-secondary"
                                    onclick="clearField('tgl_input')">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Input for TTD -->
                        <div class="col-md-4 mb-3">
                            <label for="input_ttd" class="form-label">TTD</label>
                            <div class="input-group">
                                <input id="ttd" type="text" class="form-control" placeholder="Masukkan TTD">
                                <button type="button" class="btn btn-outline-danger bg-secondary"
                                    onclick="clearField('ttd')">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Input for Tujuan -->
                        <div class="col-md-4 mb-3">
                            <label for="input_tujuan" class="form-label">Tujuan</label>
                            <div class="d-flex">
                                <select class="form-select" data-control="select2" data-hide-search="false"
                                    data-placeholder="Pilih Tujuan" name="tujuan" id="tujuan">
                                    <option value="">Pilih Tujuan...</option>
                                    @foreach (Helper::getData('kd_units') as $a)
                                        <option value="{{ $a->id }}">{{ $a->nama }}</option>
                                    @endforeach
                                    <option value="lainnya">Lainnya (Ketikkan Tujuan)</option>
                                </select>
                            </div>
                        </div>

                        <!-- Input for Jenis Surat -->
                        <div class="col-md-4 mb-3">
                            <label for="input_jenis_surat" class="form-label">Jenis Surat</label>
                            <div class="d-flex">
                                <select class="form-select" data-control="select2" data-hide-search="false"
                                    data-placeholder="Pilih Jenis Surat" name="jenis" id="jenis">
                                    <option value="">Jenis...</option>
                                    <option value="vital">Vital</option>
                                    <option value="umum">Umum</option>
                                    <option value="terjaga">Terjaga</option>
                                </select>
                            </div>
                        </div>

                        <!-- Input for Retensi Aktif -->
                        <div class="col-md-4 mb-3">
                            <label for="input_retensi_aktif" class="form-label">Retensi Aktif</label>
                            <div class="input-group">
                                <input value="{{ isset($data->retensi) ? $data->retensi : '' }}" type="text"
                                    placeholder="dd/mm/yyyy" onfocus="(this.type='date')" onblur="(this.type='text')"
                                    class="form-control" name="retensi" id="retensi" />
                                <button type="button" class="btn btn-outline-danger bg-secondary"
                                    onclick="clearField('retensi')">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Input for Retensi Inaktif -->
                        <div class="col-md-4 mb-3">
                            <label for="input_retensi_inaktif" class="form-label">Retensi Inaktif</label>
                            <div class="input-group">
                                <input value="{{ isset($data->retensi2) ? $data->retensi2 : '' }}" type="text"
                                    placeholder="dd/mm/yyyy" onfocus="(this.type='date')" onblur="(this.type='text')"
                                    class="form-control" name="retensi2" id="retensi2" />
                                <button type="button" class="btn btn-outline-danger bg-secondary"
                                    onclick="clearField('retensi2')">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Input for Retensi Nasib -->
                        <div class="col-md-4 mb-3">
                            <label for="input_retensi_nasib" class="form-label">Retensi Nasib</label>
                            <div class="d-flex">
                                <select class="form-select mb-2" data-control="select2" name="retensi3" id="retensi3">
                                    <option value="">Status Retensi</option>
                                    <option value="aktif">Aktif</option>
                                    <option value="inaktif">Inaktif</option>
                                </select>
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
                                    <th class="min-w-140px">Tanggal Surat</th>
                                    <th class="min-w-120px">Nomor Surat</th>
                                    <th class="min-w-120px">Perihal Surat</th>
                                    <th class="min-w-120px">Status Surat</th>
                                    <th class="min-w-120px">Asal Surat</th>
                                    <th class="min-w-120px">Tujuan Surat</th>
                                    <th class="min-w-120px">Retensi</th>
                                    <th class="min-w-120px">File</th>
                                    <th class="text-center min-w-70px">Actions</th>
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

        document.getElementById('clear_all').addEventListener('click', function() {
            const fields = ['nomor', 'kepada', 'tgl_surat', 'perihal', 'status', 'asal', 'tgl_terima', 'tgl_input',
                'ttd', 'tujuan', 'jenis', 'retensi', 'retensi2', 'retensi3'
            ];

            fields.forEach(fieldId => {
                const field = document.getElementById(fieldId);
                if (field) {
                    if (field.type === 'select-one') {
                        field.selectedIndex = 0; // Reset dropdowns
                    } else {
                        field.value = ''; // Clear text and date fields
                    }
                }
            });
        });


        document.getElementById('button_advanced_search').addEventListener('click', function() {
            const advancedFields = document.getElementById('advanced_search_fields');
            if (advancedFields.style.display === 'none' || advancedFields.style.display === '') {
                advancedFields.style.display = 'block';
            } else {
                advancedFields.style.display = 'none';
            }
        });

        $(document).ready(function() {
            $('#asal').select2({
                tags: true, // Memungkinkan input manual
                placeholder: "Pilih Asal..."
            });
            $('#tujuan').select2({
                tags: true, // Memungkinkan input manual
                placeholder: "Pilih Tujuan..."
            });
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

            // document.getElementById('button_advanced_submit').addEventListener('click', function() {
            //     const formData = {
            //         nomor: document.getElementById('input_nomor_surat').value || null,
            //         kepada: document.getElementById('input_kepada').value || null,
            //         tanggal_surat: document.getElementById('input_tanggal_surat').value || null,
            //         perihal: document.getElementById('input_perihal').value || null,
            //         status: document.getElementById('input_status').value || null,
            //         asal: document.getElementById('input_asal').value || null,
            //         tanggal_terima: document.getElementById('input_tanggal_terima').value || null,
            //         tanggal_input: document.getElementById('input_tanggal_input').value || null,
            //         ttd: document.getElementById('input_ttd').value || null,
            //         tujuan: document.getElementById('input_tujuan').value || null,
            //         jenis_surat: document.getElementById('input_jenis_surat').value || null,
            //         retensi_aktif: document.getElementById('input_retensi_aktif').value || null,
            //         retensi_inaktif: document.getElementById('input_retensi_inaktif').value || null,
            //         retensi_nasib: document.getElementById('input_retensi_nasib').value || null,
            //     };

            //     // Cek apakah semua nilai kosong
            //     const isEmpty = Object.values(formData).every(value => value === null || value === '');

            //     // Tampilkan hasil ke console untuk debugging
            //     console.log('Form Data Advanced Search:', formData);
            //     let per_page = $('#perPage').val() ?? 5;
            //     loadpage(per_page, formData);
            // });
            $("#perPage").on('click change', function(event) {
                let per_page = $('#perPage').val() || 5;
                loadpage(per_page, '');
            });

            $("#button_refresh").on('click', function(event) {
                $('#input_search').val('');
                loadpage(5, '');
            });

            // $("#button_search, #perPage").on('click change', function(event) {
            //     let search = $('#input_search').val();
            //     let per_page = $('#perPage').val() ?? 5;
            //     loadpage(per_page, search);
            // });

            $("#button_refresh").on('click', function(event) {
                $('#input_search').val('');
                loadpage(5, '');
            });

            $('#search_filter').on('click', function() {
                let tgl_surat = $('#tgl_surat').val()
                let nomor = $('#nomor').val()
                let perihal = $('#perihal').val()
                let status = $('#status').val()
                let asal = $('#asal').val()
                let tgl_terima = $('#tgl_terima').val()
                let tgl_input = $('#tgl_input').val()
                let ttd = $('#ttd').val()
                let tujuan = $('#tujuan').val()
                let kepada = $('#kepada').val()
                let jenis = $('#jenis').val()
                let retensi = $('#retensi').val()
                let retensi2 = $('#retensi2').val()
                let retensi3 = $('#retensi3').val()

                const formData = {
                    'tgl_surat': tgl_surat || null,
                    'nomor': nomor || null,
                    'perihal': perihal || null,
                    'status': status || null,
                    'asal': asal || null,
                    'tgl_terima': tgl_terima || null,
                    'tgl_input': tgl_input || null,
                    'ttd': ttd || null,
                    'tujuan': tujuan || null,
                    'kepada': kepada || null,
                    'jenis': jenis || null,
                    'retensi': retensi || null,
                    'retensi2': retensi2 || null,
                    'retensi3': retensi3 || null,
                }

                // Object.values(formData).forEach((key) => {
                //     console.log(key, formData[key]);
                // });
                // console.log(formData);
                let cekValue = Object.values(formData).every(v => v == '' || v == null || v == undefined);
                if (cekValue) {
                    loadpage(5, '');
                } else {
                    loadpage(5, formData);
                }


            });
            $("#button_search, #perPage").on('click change', function(event) {
                let search = $('#input_search').val();
                let per_page = $('#perPage').val() ?? 5;
                loadpage(per_page, search);
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
