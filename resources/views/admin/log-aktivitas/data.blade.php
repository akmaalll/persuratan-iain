@foreach ($data as $key => $v)
    <!--begin::Timeline item-->
    <div class="timeline-item">
        <!--begin::Timeline line-->
        <div class="timeline-line"></div>
        <!--end::Timeline line-->
        <!--begin::Timeline icon-->
        {!! Helper::logIcon($v->activity) !!}
        <!--end::Timeline icon-->
        <!--begin::Timeline content-->
        <div class="timeline-content mb-10 mt-n2">
            <!--begin::Timeline heading-->
            <div class="overflow-auto pe-3">
                <!--begin::Title-->
                <div class="fs-5 fw-semibold mb-2"><strong>{{ $v->user->name ?? '-' }}</strong> {{ $v->desc }}</div>
                <!--end::Title-->
                <!--begin::Description-->
                <div class="d-flex align-items-center mt-1 fs-6">
                    <!--begin::Info-->
                    @php
                        $split_datetime = explode(' ', $v->created_at);
                    @endphp
                    {{-- {{ dd(Helper::getDateIndo(Carbon\Carbon::parse($v->created_at))) }} --}}
                    <div class="text-muted me-2 fs-7">
                        Pada
                        {{ Helper::getHari(Carbon\Carbon::parse($v->created_at)->format('D')) .
                            ', ' .
                            Helper::getDateIndo(Carbon\Carbon::parse($v->created_at)) }}.
                        <br>
                        Pukul {{ Carbon\Carbon::parse($v->created_at)->format('H:i') . ' WITA' }}
                    </div>
                    <!--end::Info-->
                    <!--begin::User-->
                    {{-- <div class="symbol symbol-circle symbol-25px" data-bs-toggle="tooltip" data-bs-boundary="window"
                        data-bs-placement="top" title="Alan Nilson">
                        <img src="assets/media/avatars/300-1.jpg" alt="img" />
                    </div> --}}
                    <!--end::User-->
                </div>
                <!--end::Description-->
            </div>
            <!--end::Timeline heading-->
        </div>
        <!--end::Timeline content-->
    </div>
    <!--end::Timeline item-->
@endforeach
