<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Stok Barang</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
        }

        h3 {
            text-align: left;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        th {
            background-color: #f3f3f3;
        }
    </style>
</head>

<body>
    <h2>LAPORAN TRANSAKSI BARANG<br>Outfitbymee</h2>
    <h3>BARANG MASUK</h3>
    <table>
        <thead>
            <tr>
                <th style="text-align: center;">No</th>
                <th style="text-align: center;">Nama Barang</th>
                <th style="text-align: center;">Kode Barang</th>
                <th style="text-align: center;">Harga Jual</th>
                <th style="text-align: center;">Ukuran</th>
                <th style="text-align: center;">Kondisi</th>
                <th style="text-align: center;">Jumlah</th>
                <th style="text-align: center;">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangMasuk as $index => $item)
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td>{{ $item->barang->nama_barang ?? '-' }}</td>
                    <td>{{ $item->barang->kode_barang ?? '-' }}</td>
                    <td>{{ formatRupiah($item->harga_jual) ?? '-' }}</td>
                    <td>{{ $item->barang->ukuran ?? '-' }}</td>
                    <td>{{ ucwords($item->barang->kondisi) ?? '-' }}</td>
                    <td>{{ $item->jumlah ?? '-' }}</td>
                    <td>{{ formatTanggal($item->tanggal) ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <hr style="margin-top: 10px;">
    <h3>BARANG KELUAR</h3>
    <table>
        <thead>
            <tr>
                <th style="text-align: center;">No</th>
                <th style="text-align: center;">Nama Barang</th>
                <th style="text-align: center;">Kode Barang</th>
                <th style="text-align: center;">Harga Jual</th>
                <th style="text-align: center;">Ukuran</th>
                <th style="text-align: center;">Kondisi</th>
                <th style="text-align: center;">Jumlah</th>
                <th style="text-align: center;">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangKeluar as $index => $item)
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td>{{ $item->barang->nama_barang ?? '-' }}</td>
                    <td>{{ $item->barang->kode_barang ?? '-' }}</td>
                    <td>
                        {{ formatRupiah(optional($item->barang->latestMasuk)->harga_jual) ?? '-' }}
                    </td>
                    <td>{{ $item->barang->ukuran ?? '-' }}</td>
                    <td>{{ ucwords($item->barang->kondisi) ?? '-' }}</td>
                    <td>{{ $item->jumlah ?? '-' }}</td>
                    <td>{{ formatTanggal($item->tanggal) ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p style="text-align: right; margin-top: 30px;">
        Dicetak pada: {{ \Carbon\Carbon::now()->translatedFormat('d F Y, H:i') }}
    </p>
</body>

</html>
