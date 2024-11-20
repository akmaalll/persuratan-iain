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
        Kearsipan Persuratan IAIN Parepare
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Klasifikasi</th>
                <th>Nomor</th>
                <th style="width: 100px">Uraian</th>
                <th>Retensi</th>
                <th>Pencipta</th>
                <th>Unit Pengolah</th>
                <th>Media</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->klasifikasi->nomor . ' - ' . $item->klasifikasi->nama }}</td>
                    <td>{{ $item->nomor }}</td>
                    <td>{{ strip_tags($item->uraian) }}</td>
                    <td style="white-space: nowrap">{{ Helper::getDateIndo($item->retensi) }}</td>
                    <td>{{ isset($item->cipta->nama) ? $item->cipta->nama : $item->pencipta }}</td>
                    <td>{{ isset($item->unit->nama) ? $item->unit->nama : $item->unit_pengolah }}</td>
                    <td>{{ $item->jenis_media }}</td>
                    <td style="white-space: nowrap">{{ Helper::getDateIndo($item->tgl) }}</td>
                    <td>{{ $item->ket_keaslian }}</td>
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
