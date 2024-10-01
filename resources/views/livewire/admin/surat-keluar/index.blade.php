@extends('livewire.admin.layouts.index')

{{-- @push('cssScript')
    @include('livewire.admin._layouts.partial._css')
@endpush --}}

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
            Data
        @endslot
    @endcomponent
    <!--end::Toolbar-->
    <div wire:loading class="spinner-overlay"
        style="position: fixed;
                                top: 0;
                                left: 50%;
                                transform: translateX(-50%);
                                /* z-index: 9999; */
                                /* display: flex; */
                                justify-content: center;
                                align-items: flex-start;
                                /* width: 100%; */
                                height: 100vh;">

        <span class="spinner-border spinner-border-sm align-middle ms-2 spinner"
            style="margin-top: 50px;width: 20px; height: 20px;"></span>
    </div>

    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <!--begin::Products-->
            <div class="card card-flush">

                <!--begin::Card header-->
                @include('livewire.admin.card.action')
                <!--end::Card header-->
                @if ($isopen)
                    @include('livewire.admin.surat-keluar.form')
                @endif
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_products_table">
                            <thead>
                                <tr class="text-start text-gray-600 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-20px pe-2">No</th>
                                    <th class="min-w-140px">kode klasifikasi</th>
                                    <th class="min-w-140px">Tanggal Surat</th>
                                    <th class="min-w-120px">Nomor Surat</th>
                                    <th class="min-w-120px">Perihal Surat</th>
                                    <th class="min-w-120px">Status Surat</th>
                                    <th class="min-w-120px">Asal Surat</th>
                                    <th class="min-w-120px">Tanggal Kirim Surat</th>
                                    <th class="min-w-120px">Tanggal Input</th>
                                    <th class="min-w-120px">Ttd Surat</th>
                                    <th class="min-w-120px">Tujuan Surat</th>
                                    <th class="min-w-120px">Cq.</th>
                                    <th class="min-w-120px">Jenis Surat</th>
                                    <th class="min-w-120px">Retensi</th>
                                    <th class="text-end min-w-70px">Actions</th>
                                </tr>
                            </thead>

                            <tbody class="fw-semibold text-gray-600 datatables">
                                @include('livewire.admin.surat-keluar.data')
                            </tbody>



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



            $("#button_search, #perPage").on('click change', function(event) {
                let search = $('#input_search').val();
                let per_page = $('#perPage').val() ?? 5;
                loadpage(per_page, search);
            });

            $("#button_refresh").on('click', function(event) {
                $('#input_search').val('');
                loadpage(5, '');
            });


          


        });
    </script>
@endpush
