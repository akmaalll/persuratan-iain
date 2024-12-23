@foreach ($data as $key => $v)
    <tr>
        <td class="text-gray-600 fw-semibold">
            {{ ++$i }}
        </td>
        <td>
            <span class="fw-semibold text-nowrap">
                {{ $v->nomor }}
            </span>
        </td>
        {{-- <td class="text-gray-600 fw-semibold">
            {{ $v->klasifikasi->nama . ' - ' . $v->klasifikasi->nomor }}
        </td> --}}
        <td>
            <span class="fw-semibold text-nowrap">
                {{ Helper::getDateIndo($v->tgl_surat) }}
            </span>
        </td>

        <td>
            <span class="fw-semibold text-nowrap">
                {{ $v->perihal }}
            </span>
        </td>
        <td>
            <span class="fw-semibold text-nowrap">
                {{ $v->jenis == 'nomor_sk' ? 'SK' : 'Surat' }}
            </span>
        </td>
        {{-- <td>
            <span class="fw-semibold">
                {{ ucwords($v->status) }}
            </span>
        </td> --}}
        <td>
            <span class="fw-semibold text-nowrap">
                @if (is_numeric($v->asal))
                    {{ $v->asalSurat->kode == '-' ? '' : $v->asalSurat->kode . ' - ' }} {{ $v->asalSurat->nama }}
                @else
                    {{ $v->asal }}
                @endif
            </span>
        </td>
        <td>
            <span class="fw-semibold text-nowrap">
                @if (is_numeric($v->tujuan))
                    {{ $v->tujuanSurat->kode == '-' ? '' : $v->tujuanSurat->kode . ' - ' }} {{ $v->tujuanSurat->nama }}
                @else
                    {{ $v->tujuan }}
                @endif
            </span>
        </td>
        <td class="text-end text-nowrap">
            {!! Helper::btnAction($v->id, $title) !!}
        </td>
    </tr>
@endforeach
