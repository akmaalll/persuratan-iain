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
    <div class="d-flex flex-column flex-column-fluid">

        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">

                <!--begin::Timeline-->
                <div class="card">
                    <!--begin::Card head-->
                    <div class="card-header card-header-stretch">
                        <!--begin::Title-->
                        <div class="card-title d-flex align-items-center">
                            <i class="ki-duotone ki-calendar-8 fs-1 text-primary me-3 lh-0">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                                <span class="path5"></span>
                                <span class="path6"></span>
                            </i>
                            <h3 class="fw-bold m-0 text-gray-800">Hari ini,
                                {{ Helper::getHari(Carbon\Carbon::now()->format('D')) }}
                                {{ Helper::getDateIndo(Carbon\Carbon::now()) }}</h3>
                        </div>
                        <!--end::Title-->
                        <!--begin::Toolbar-->
                        <div class="card-toolbar m-0">
                            {{-- <!--begin::Tab nav-->
                            <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0 fw-bold" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a id="kt_activity_today_tab"
                                        class="nav-link justify-content-center text-active-gray-800 active"
                                        data-bs-toggle="tab" role="tab" href="#kt_activity_today">Today</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a id="kt_activity_week_tab"
                                        class="nav-link justify-content-center text-active-gray-800" data-bs-toggle="tab"
                                        role="tab" href="#kt_activity_week">Week</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a id="kt_activity_month_tab"
                                        class="nav-link justify-content-center text-active-gray-800" data-bs-toggle="tab"
                                        role="tab" href="#kt_activity_month">Month</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a id="kt_activity_year_tab"
                                        class="nav-link justify-content-center text-active-gray-800 text-hover-gray-800"
                                        data-bs-toggle="tab" role="tab" href="#kt_activity_year">2024</a>
                                </li>
                            </ul>
                            <!--end::Tab nav--> --}}
                        </div>
                        <!--end::Toolbar-->
                    </div>
                    <!--end::Card head-->
                    <!--begin::Card body-->
                    <div class="card-body">
                        <!--begin::Tab Content-->
                        <div class="tab-content">
                            <!--begin::Tab panel-->
                            <div id="kt_activity_today" class="card-body p-0 tab-pane fade show active" role="tabpanel"
                                aria-labelledby="kt_activity_today_tab">
                                <!--begin::Timeline-->
                                <div class="timeline timeline-border-dashed">
                                    <div class="datatables">

                                    </div>
                                </div>
                                <!--end::Timeline-->
                            </div>
                            <!--end::Tab panel-->
                        </div>
                        <!--end::Tab Content-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Timeline-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content-->
@endsection

@php
    $routeName = $title . '.data';   
@endphp

@push('jsScript')
    <script type="text/javascript">
        $(document).ready(function() {

            const fetchData = '{{ $routeName }}'
            console.log('{{ route($routeName) }}');
            loadpage();
            var $pagination = $('.twbs-pagination');
            var defaultOpts = {
                totalPages: 1,
                prev: '&#8672;',
                next: '&#8674;',
                first: '&#8676;',
                last: '&#8677;',
            };
            $pagination.twbsPagination(defaultOpts);
            function loaddata() {
                $.ajax({
                    url: '{{ route($routeName) }}',
                    type: "GET",
                    datatype: "json",
                    success: function(data) {
                        console.log(data);
                        $(".datatables").html(data.html);
                    }
                });
            }

            function loadpage() {
                $.ajax({
                    url: '{{ route($routeName) }}',
                    type: "GET",
                    datatype: "json",
                    success: function(response) {
                        if ($pagination.data("twbs-pagination")) {
                            $pagination.twbsPagination('destroy');
                            $(".datatables").html('<tr><td colspan="4">Data not found</td></tr>');
                        }
                        loaddata();
                    }
                });
            }




        });
    </script>
@endpush
