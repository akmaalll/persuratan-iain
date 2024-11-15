@foreach ($data as $key => $v)
    <tr>
        <td class="text-gray-600 fw-semibold">
            {{ $v->jenis_klasifikasi->kode . "." . $v->nomor }}
        </td>
        <td class="text-gray-600 fw-semibold">
            {{ $v->nama }}
        </td>
        <td class="text-gray-600 fw-semibold">
            {{ "-" }}
        </td>
        <td class="text-end min-w-70px">
            {!! Helper::btnAction($v->id, $title) !!}
        </td>
    </tr>
@endforeach
