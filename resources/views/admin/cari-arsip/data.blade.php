@foreach ($data as $key => $v)
    <tr class="text-start text-gray-600 fs-7">

        <td>
            <span class="fw-semibold">
                {{ ++$key }} {{-- Kode Klasifikasi --}}
            </span>
        </td>
        <td>
            <span class="fw-semibold text-nowrap">
                {{ $v->nomor . ' - ' }}
                {{ $v->jenis_nosurat == 'nomor_sk' ? 'Nomor SK' : ($v->jenis_nosurat == 'nomor_surat' ? 'Nomor Surat' : '') }}
                {{-- Nomor Surat --}}
            </span>
        </td>
        <td>
            <span class="fw-semibold text-nowrap">
                {{ Helper::getDateIndo($v->tgl ?? $v->tgl_surat) }} {{-- Tanggal Surat --}}
            </span>
        </td>
        <td>
            <span class="fw-semibold text-nowrap">
                @if ($v->kd_klasifikasi_id != 0)
                    {{ $v->klasifikasi->jenis_klasifikasi->kode . '.' . $v->klasifikasi->nomor }} -
                    {{ $v->klasifikasi->nama }} {{-- Perihal Surat --}}
                @else
                    Tidak ada klasifikasi
                @endif
            </span>
        </td>
        {{-- <td>
            <span class="fw-semibold">
                {{ $v->perihal }}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->unit_pengolah }} 
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->lokal }} 
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->jenis_media }} 
            </span>
        </td> --}}
        <td>
            <span class="fw-semibold">
                {!! $v->uraian !!}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->ket_keaslian ?? '-' }} {{-- Tanggal Input --}}
            </span>
        </td>
        @if (empty($v->file))
            <td>
                <span class="fw-semibold">
                    Tidak ada file
                </span>
            </td>
        @else
            <td>
                <span class="fw-semibold">
                    @if ($type == 'Surat Keluar')
                        <a href="{{ asset('uploads/surat-keluar/' . $v->file) }}" target="_blank"
                            class="btn btn-icon btn-bg-secondary btn-active-color-primary btn-sm">
                            <i class="ki-duotone ki-folder-down fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </a>
                    @elseif($type == 'Surat Masuk')
                        <a href="{{ asset('uploads/ttd/surat-masuk/' . $v->file) }}" target="_blank"
                            class="btn btn-icon btn-bg-secondary btn-active-color-primary btn-sm">
                            <i class="ki-duotone ki-folder-down fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </a>
                    @else
                        <a href="{{ asset('uploads/arsip/' . $v->file) }}" target="_blank"
                            class="btn btn-icon btn-bg-secondary btn-active-color-primary btn-sm">
                            <i class="ki-duotone ki-folder-down fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </a>
                    @endif
                </span>
            </td>
        @endif

        {{-- <td>
            <span class="fw-semibold">
                {{ $v->no_rak }} 
            </span>
        </td> --}}
        <td>
            <span class="fw-semibold">
                {{ $v->jumlah ?? '-' }} {{-- TTD --}}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->no_box }}
            </span>
        </td>
        {{-- 
        <td>
            <span class="fw-semibold">
                {{ $v->pencipta }} 
            </span>
        </td> --}}
        <td>
            <span class="fw-semibold text-nowrap">
                <span class="fw-semibold text-nowrap">
                    {{ Helper::getRentangTanggal($v->tgl ?? $v->tgl_surat, $v->retensi) }} ( Aktif Hingga
                    {{ Helper::getDateIndo($v->retensi) }} ) <br>
                    {{ Helper::getRentangTanggal($v->tgl ?? $v->retensi, $v->retensi2) }} ( Inaktif Hingga
                    {{ Helper::getDateIndo($v->retensi2) }} ) <br>
                    {{ $v->retensi3 }} ( Nasib )<br>
                </span>
            </span>
        </td>
        <td class="text-nowrap text-center">
            @if ($type == 'Surat Keluar')
                <a href="{{ route('surat-keluar.detail', $v->id) }}" data-toggle="tooltip" data-id="' . $id . '"
                    title="Detail" class="DetailData me-1">
                    <button type="button" class="btn btn-icon btn-bg-secondary btn-active-color-warning btn-sm">
                        <i class="ki-duotone ki-information fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        </i>
                    </button>
                </a>
            @elseif ($type == 'Surat Masuk')
                <a href="{{ route('surat-masuk.detail', $v->id) }}" data-toggle="tooltip" data-id="' . $id . '"
                    title="Detail" class="DetailData me-1">
                    <button type="button" class="btn btn-icon btn-bg-secondary btn-active-color-warning btn-sm">
                        <i class="ki-duotone ki-information fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        </i>
                    </button>
                </a>
            @else
                <a href="{{ route('cari-arsip.detail', $v->id) }}" data-toggle="tooltip" data-id="' . $id . '"
                    title="Detail" class="DetailData me-1">
                    <button type="button" class="btn btn-icon btn-bg-secondary btn-active-color-warning btn-sm">
                        <i class="ki-duotone ki-information fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        </i>
                    </button>
                </a>
            @endif
            {{-- Tombol aksi --}}
            {{-- {!! Helper::btnAction($v->id, $title) !!}  --}}
        </td>
    </tr>
@endforeach
