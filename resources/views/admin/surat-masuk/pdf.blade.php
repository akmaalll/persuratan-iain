<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Dokumen Arsip' }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .title {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
            font-weight: 'bold';
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table,
        .table th,
        .table td {
            border: 1px solid #000;
            padding: 4px;
            font-size: 12px;
        }

        .table th {
            background-color: #f2f2f2;
            text-align: left;
        }
    </style>
</head>

<body>

    <div class="title">
        Surat Masuk Persuratan IAIN Parepare
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Surat</th>
                <th>Nomor Surat</th>
                <th>Perihal Surat</th>
                <th>Status Surat</th>
                <th>Asal Surat</th>
                <th>Tanggal Terima</th>
                <th>Tanggal Input</th>
                <th>Ttd</th>
                <th>Kepada</th>
                <th>Jenis</th>
                <th>Tujuan Surat</th>
                <th>Retensi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ Helper::getDateIndo($item->tgl_surat) }}</td>
                    <td>{{ $item->nomor }}</td>
                    <td>{{ $item->perihal }}</td>
                    <td>{{ $item->status }}</td>
                    <td>
                        @if (is_numeric($item->asal))
                            {{ $item->asalsurat->kode . ' - ' . $item->asalSurat->nama }}
                        @else
                            {{ $item->asal }}
                        @endif
                    </td>
                    <td>{{ Helper::getDateIndo($item->tgl_terima) }}</td>
                    <td>{{ Helper::getDateIndo($item->tgl_input) }}</td>
                    <td>{{ $item->ttd }}</td>
                    <td>{{ $item->kepada }}</td>
                    <td>{{ $item->jenis }}</td>
                    <td>
                        @if (is_numeric($item->tujuan))
                            {{ $item->tujuanSurat->kode . ' - ' . $item->tujuanSurat->nama }}
                        @else
                            {{ $item->tujuan }}
                        @endif
                    </td>
                    <td style="white-space: nowrap">
                        <span class="fw-semibold text-nowrap">
                            {{ Helper::getRentangTanggal($item->tgl, $item->retensi) }} ( Aktif Hingga
                            {{ Helper::getDateIndo($item->retensi) }} ) <br>
                            {{ Helper::getRentangTanggal($item->tgl, $item->retensi2) }} ( Inaktif Hingga
                            {{ Helper::getDateIndo($item->retensi2) }} ) <br>
                            {{ $item->retensi3 }} ( Nasib )<br>
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" style="text-align: center;">Tidak ada data tersedia</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>

</html>
