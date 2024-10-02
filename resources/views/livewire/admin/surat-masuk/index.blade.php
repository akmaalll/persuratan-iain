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
                    @include('livewire.admin.surat-masuk.form')
                @endif
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
                                    <th class="min-w-120px">Tanggal Terima Surat</th>
                                    <th class="min-w-120px">Tanggal Input</th>
                                    <th class="min-w-120px">Ttd Surat</th>
                                    <th class="min-w-120px">Tujuan Surat</th>
                                    <th class="min-w-120px">Cq.</th>
                                    <th class="min-w-120px">Jenis Surat</th>
                                    <th class="min-w-120px">Retensi</th>
                                    <th class="min-w-120px">Riwayat Mutasi Surat</th>
                                    <th class="text-end min-w-70px">Actions</th>
                                </tr>
                            </thead>

                            <tbody class="fw-semibold text-gray-600 datatables">
                                @include('livewire.admin.surat-masuk.data')
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
                        {{-- {{ $suratmasuk->links() }} --}}

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
        document.addEventListener('livewire:load', function() {
            toastr.success('tes');
            Livewire.on('showToastr', event => {
                toastr.success(event.message);
            });
        });

        $(document).ready(function() {
            // loadpage(5, '');
            // var $pagination = $('.twbs-pagination');
            // var defaultOpts = {
            //     totalPages: 1,
            //     prev: '&#8672;',
            //     next: '&#8674;',
            //     first: '&#8676;',
            //     last: '&#8677;',
            // };
            // $pagination.twbsPagination(defaultOpts);



            // $("#button_search, #perPage").on('click change', function(event) {
            //     let search = $('#input_search').val();
            //     let per_page = $('#perPage').val() ?? 5;
            //     loadpage(per_page, search);
            // });

            // $("#button_refresh").on('click', function(event) {
            //     $('#input_search').val('');
            //     loadpage(5, '');
            // });


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
