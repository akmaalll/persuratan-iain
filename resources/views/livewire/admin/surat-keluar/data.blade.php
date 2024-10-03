@foreach ($suratkeluar as $key => $v)
    <tr class="text-start text-gray-600 fs-7">
        <td>
            <span class="fw-semibold">
                {{ ++$key }}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->kd_klasifikasi_id }}
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
        <td class="text-muted fw-semibold">
            {{ $v->asal }}
        </td>
        <td class="text-muted fw-semibold">
            {{ $v->tgl_kirim }}
        </td>
        <td class="text-muted fw-semibold">
            {{ $v->tgl_input }}
        </td>
        <td class="text-muted fw-semibold">
            {{ $v->ttd }}
        </td>
        <td class="text-muted fw-semibold">
            {{ $v->tujuan }}
        </td>
        <td class="text-muted fw-semibold">
            {{ $v->kepada }}
        </td>
        <td class="text-muted fw-semibold">
            {{ $v->jenis }}
        </td>
        <td class="text-muted fw-semibold">
            {{ $v->retensi }}
        </td>
        <td class="text-end row">
            {!! Helper::btnAction($v->id, $title) !!}
        </td>
    </tr>
@endforeach
