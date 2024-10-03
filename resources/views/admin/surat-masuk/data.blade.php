@foreach ($data as $key => $v)
    <tr class="text-start text-gray-600 fs-7">
        <td>
            <span class="fw-semibold">
                {{ ++$i }}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->tgl_surat }}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->nomor }}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->perihal }}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->status }}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->asal }}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->tgl_terima }}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->tgl_input }}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->ttd }}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->tujuan }}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->kepada }}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->jenis }}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->retensi }}
            </span>
        </td>
        <td class="text-muted fw-semibold">
            {{ $v->riwayat_mutasi }}
        </td>
        <td class="text-end">
            {!! Helper::btnAction($v->id, $title) !!}
        </td>
    </tr>
@endforeach
