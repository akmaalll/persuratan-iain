@foreach ($data as $key => $v)
    <tr class="text-start text-gray-600 fs-7">
        <td>
            <span class="fw-semibold">
                {{ ++$i }}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->rencanaKerja->rencana ?? '' }}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->indikatorKinerja->indikator ?? '' }}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->target ?? '' }}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->pic ?? '' }}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->januari ?? '' }}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                @if (!empty($v->januari_realisasi) && file_exists(public_path('uploads/triwulan/' . $v->januari_realisasi)))
                    <a href="{{ asset('uploads/triwulan/' . $v->januari_realisasi) }}" target="_blank">Link Data</a>
                @else
                    {{ $v->januari_realisasi }}
                @endif
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->februari ?? '' }}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                @if (!empty($v->februari_realisasi) && file_exists(public_path('uploads/triwulan/' . $v->februari_realisasi)))
                    <a href="{{ asset('uploads/triwulan/' . $v->februari_realisasi) ?? '#' }}" target="_blank">Link
                        Data</a>
                @else
                    {{ $v->februari_realisasi }}
                @endif
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->maret ?? '' }}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                @if (!empty($v->maret_realisasi) && file_exists(public_path('uploads/triwulan/' . $v->maret_realisasi)))
                    <a href="{{ asset('uploads/triwulan/' . $v->maret_realisasi) }}" target="_blank">Link Data</a>
                @else
                    {{ $v->maret_realisasi }}
                @endif
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->kendala_tw1 ?? '' }}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->tindak_lanjut_tw1 ?? '' }}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                @if (!empty($v->link_data_tw1))
                    <a href="{{ asset('uploads/triwulan/' . ($v->link_data_tw1 ?? '#')) }}" target="_blank">Link
                        Data</a>
                @endif
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->april ?? '' }}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                @if (!empty($v->april_realisasi) && file_exists(public_path('uploads/triwulan/' . $v->april_realisasi)))
                    <a href="{{ asset('uploads/triwulan/' . $v->april_realisasi) }}" target="_blank">Link Data</a>
                @else
                    {{ $v->april_realisasi }}
                @endif
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->mei ?? '' }}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                @if (!empty($v->mei_realisasi) && file_exists(public_path('uploads/triwulan/' . $v->mei_realisasi)))
                    <a href="{{ asset('uploads/triwulan/' . $v->mei_realisasi) }}" target="_blank">Link Data</a>
                @else
                    {{ $v->mei_realisasi }}
                @endif
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->juni ?? '' }}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                @if (!empty($v->juni_realisasi) && file_exists(public_path('uploads/triwulan/' . $v->juni_realisasi)))
                    <a href="{{ asset('uploads/triwulan/' . $v->juni_realisasi) }}" target="_blank">Link Data</a>
                @else
                    {{ $v->juni_realisasi }}
                @endif
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->kendala_tw2 ?? '' }}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->tindak_lanjut_tw2 ?? '' }}
            </span>
        </td>
        <td>
            @if (!empty($v->link_data_tw2))
                <span class="fw-semibold"><a href="{{ asset('uploads/triwulan/' . ($v->link_data_tw2 ?? '#')) }}"
                        target="_blank">Link Data</a>
                </span>
            @endif
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->semester1 ?? '' }}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->juli ?? '' }}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                @if (!empty($v->juli_realisasi) && file_exists(public_path('uploads/triwulan/' . $v->juli_realisasi)))
                    <a href="{{ asset('uploads/triwulan/' . $v->juli_realisasi) }}" target="_blank">Link Data</a>
                @else
                    {{ $v->juli_realisasi }}
                @endif
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->agustus ?? '' }}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                @if (!empty($v->agustus_realisasi) && file_exists(public_path('uploads/triwulan/' . $v->agustus_realisasi)))
                    <a href="{{ asset('uploads/triwulan/' . $v->agustus_realisasi) }}" target="_blank">Link Data</a>
                @else
                    {{ $v->agustus_realisasi }}
                @endif
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->september ?? '' }}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                @if (!empty($v->september_realisasi) && file_exists(public_path('uploads/triwulan/' . $v->september_realisasi)))
                    <a href="{{ asset('uploads/triwulan/' . $v->september_realisasi) }}" target="_blank">Link Data</a>
                @else
                    {{ $v->september_realisasi }}
                @endif
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->kendala_tw3 ?? '' }}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->tindak_lanjut_tw3 ?? '' }}
            </span>
        </td>
        <td>
            @if (!empty($v->link_data_tw3))
                <span class="fw-semibold"><a href="{{ asset('uploads/triwulan/' . ($v->link_data_tw3 ?? '#')) }}"
                        target="_blank">Link Data</a>
                </span>
            @endif
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->oktober ?? '' }}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                @if (!empty($v->oktober_realisasi) && file_exists(public_path('uploads/triwulan/' . $v->oktober_realisasi)))
                    <a href="{{ asset('uploads/triwulan/' . $v->oktober_realisasi) }}" target="_blank">Link Data</a>
                @else
                    {{ $v->oktober_realisasi }}
                @endif
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->november ?? '' }}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                @if (!empty($v->november_realisasi) && file_exists(public_path('uploads/triwulan/' . $v->november_realisasi)))
                    <a href="{{ asset('uploads/triwulan/' . $v->november_realisasi) }}" target="_blank">Link Data</a>
                @else
                    {{ $v->november_realisasi }}
                @endif
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->desember ?? '' }}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                @if (!empty($v->desember_realisasi) && file_exists(public_path('uploads/triwulan/' . $v->desember_realisasi)))
                    <a href="{{ asset('uploads/triwulan/' . $v->desember_realisasi) }}" target="_blank">Link Data</a>
                @else
                    {{ $v->desember_realisasi }}
                @endif
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->kendala_tw4 ?? '' }}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->tindak_lanjut_tw4 ?? '' }}
            </span>
        </td>
        <td>
            @if (!empty($v->link_data_tw4))
                <span class="fw-semibold">
                    <a href="{{ asset('uploads/triwulan/' . ($v->link_data_tw4 ?? '#')) }}" target="_blank">Link
                        Data</a>
                </span>
            @endif
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->semester2 ?? '' }}
            </span>
        </td>
    </tr>
@endforeach
