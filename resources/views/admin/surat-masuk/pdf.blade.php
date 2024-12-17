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
            font-weight: bold;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            /* Menjadikan lebar kolom tetap */
        }

        .table th,
        .table td {
            border: 1px solid #000;
            padding: 4px;
            font-size: 12px;
            word-wrap: break-word;
            /* Memastikan teks terbungkus jika terlalu panjang */
        }

        .table th {
            background-color: #f2f2f2;
            text-align: left;
        }

        /* Pengaturan lebar kolom */
        .table th:nth-child(1) {
            width: 5%;
        }

        /* No */
        .table th:nth-child(2) {
            width: 10%;
        }

        /* Tanggal Surat */
        .table th:nth-child(3) {
            width: 15%;
        }

        /* Nomor Surat */
        .table th:nth-child(4) {
            width: 15%;
        }

        /* Perihal Surat */
        .table th:nth-child(5) {
            width: 10%;
        }

        /* Status Surat */
        .table th:nth-child(6) {
            width: 15%;
        }

        /* Asal Surat */
        .table th:nth-child(7) {
            width: 10%;
        }

        /* Tanggal Terima */
        .table th:nth-child(8) {
            width: 10%;
        }

        /* Tanggal Input */
        .table th:nth-child(9) {
            width: 10%;
        }

        /* Ttd */
        .table th:nth-child(10) {
            width: 10%;
        }

        /* Kepada */
        .table th:nth-child(11) {
            width: 10%;
        }

        /* Jenis */
        .table th:nth-child(12) {
            width: 15%;
        }

        /* Tujuan Surat */
        .table th:nth-child(13),
        .table td:nth-child(13) {
            width: 20%;
            word-wrap: break-word;
            word-break: break-word;
            overflow-wrap: break-word;
            white-space: normal;
        }

        /* Retensi */
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
                {{-- <th>Nomor Box</th>
                <th>Nomor Rak</th> --}}
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
                    {{-- <td>{{ $item->nomor_box }}</td>
                    <td>{{ $item->nomor_rak }}</td> --}}
                    <td>
                        <span class="fw-semibold">
                            - {{ Helper::getRentangTanggal($item->tgl, $item->retensi) }} ( Aktif Hingga
                            {{ Helper::getDateIndo($item->retensi) }} ) <br>
                            - {{ Helper::getRentangTanggal($item->tgl, $item->retensi2) }} ( Inaktif Hingga
                            {{ Helper::getDateIndo($item->retensi2) }} ) <br>
                            - {{ $item->retensi3 }} ( Nasib )
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
