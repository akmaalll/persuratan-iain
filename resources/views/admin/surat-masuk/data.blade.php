@foreach ($data as $key => $v)
    {{-- {{ dd($v) }} --}}
    <tr class="text-start text-gray-600 fs-7">
        <td>
            <span class="fw-semibold">
                {{ ++$i }}
            </span>
        </td>
        <td>
            <span class="fw-semibold text-nowrap">
                {{ Helper::getDateIndo($v->tgl_surat) }}
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
            <span class="fw-semibold text-nowrap">
                {{ isset($v->asalSurat->kode) ? $v->asalSurat->kode . ' - ' . $v->asalSurat->nama : $v->asal }}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
<<<<<<< HEAD
                {{ $v->tujuanSurat->kode . ' - ' . $v->tujuanSurat->nama }}
=======
                {{ isset($v->tujuanSurat->nama) ? $v->tujuanSurat->nama : $v->tujuan }}
>>>>>>> 5596161615edc32639a4c98e94b20ab522cc97e4
            </span>
        </td>
        <td>
            <span class="fw-semibold text-nowrap">
                Aktif ({{ Helper::getDateIndo($v->retensi) }}) <br>
                Inaktif ({{ Helper::getDateIndo($v->retensi2) }}) <br>
                Nasib ({{ $v->retensi3 }}) <br>
            </span>
        </td>
        <td class="text-nowrap">
            <a href="{{ route('surat-masuk.detail', $v->id) }}" data-toggle="tooltip" data-id="' . $id . '"
                title="Detail" class="DetailData">
                <button type="button" class="btn btn-icon btn-bg-secondary btn-active-color-warning btn-sm">
                    <i class="ki-duotone ki-eye fs-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                    </i>
                </button>
            </a>
            {!! Helper::btnAction($v->id, $title) !!}
        </td>
    </tr>
@endforeach
