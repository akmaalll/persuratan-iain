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
                @if (is_numeric($v->asal))
                    {{ $v->asalsurat->kode == '-' ? '' : $v->asalSurat->kode . ' - ' }} {{ $v->asalSurat->nama }}
                @else
                    {{ $v->asal }}
                @endif
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                @if (is_numeric($v->tujuan))
                    {{ $v->tujuanSurat->kode == '-' ? '' : $v->tujuanSurat->kode . ' - ' }} {{ $v->tujuanSurat->nama }}
                @else
                    {{ $v->tujuan }}
                @endif
            </span>
        </td>
        <td>
            <span class="fw-semibold text-nowrap">
                {{ Helper::getRentangTanggal($v->tgl_surat, $v->retensi) }} (Aktif Hingga
                {{ Helper::getDateIndo($v->retensi) }}) <br>
                {{ Helper::getRentangTanggal($v->tgl_surat, $v->retensi2) }} (Inaktif Hingga
                {{ Helper::getDateIndo($v->retensi2) }}) <br>
                {{ $v->retensi3 }} (Nasib)<br>
            </span>
        </td>
        <td class="text-nowrap">
            <span class="fw-bold badge badge-{{ $v->status_arsip == 'arsip' ? 'danger' : 'primary' }}">
                @if ($v->status_arsip == 'arsip')
                    Telah di arsipkan
                @else
                    Masih aktif
                @endif
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->no_box }}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->no_rak }}
            </span>
        </td>
        @if (empty($v->upload_file))
            <td>
                <span class="fw-semibold">
                    Tidak ada file
                </span>
            </td>
        @else
            <td>
                <span class="fw-semibold">
                    {{-- {{ $v->file }}  --}}
                    <a href="{{ asset('uploads/ttd/surat-masuk/' . $v->upload_file) }}" target="_blank"
                        class="btn btn-icon btn-bg-secondary btn-active-color-primary btn-sm">
                        <i class="ki-duotone ki-folder-down fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </a>
                </span>
            </td>
        @endif
        <td class="text-nowrap">
            @if ($v->status_arsip != 'arsip')
                @if (date('Y-m-d') == $v->retensi)
                    <a href="{{ route('surat-masuk.arsip', $v->id) }}" data-toggle="tooltip"
                        title="Export data ke arsip">
                        <button type="button" class="btn btn-bg-secondary btn-active-color-success btn-sm">
                            Export ke arsip
                        </button>
                    </a>
                @endif
            @endif
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
