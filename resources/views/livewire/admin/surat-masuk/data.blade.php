@foreach ($suratmasuk as $key => $v)
    <tr class="text-start text-gray-600 fs-7">

        <td>
            <span class="fw-semibold">
                {{ ++$key }} {{-- Kode Klasifikasi --}}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->kd_klasifikasi_id }} {{-- Tanggal Surat --}}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->tgl_surat }} {{-- Tanggal Surat --}}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->nomor }} {{-- Nomor Surat --}}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->perihal }} {{-- Perihal Surat --}}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->status }} {{-- Status Surat --}}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->asal }} {{-- Asal Surat --}}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->tgl_terima }} {{-- Tanggal Terima --}}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->tgl_input }} {{-- Tanggal Input --}}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->ttd }} {{-- TTD --}}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->tujuan }} {{-- Tujuan --}}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->kepada }} {{-- Kepada --}}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->jenis }} {{-- Jenis --}}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->retensi }} {{-- Retensi --}}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->riwayat_mutasi }} {{-- Riwayat Mutasi --}}
            </span>
        </td>
        <td class="text-end row">
            {!! Helper::btnAction($v->id, $title) !!} {{-- Tombol aksi --}}
        </td>
    </tr>
@endforeach
