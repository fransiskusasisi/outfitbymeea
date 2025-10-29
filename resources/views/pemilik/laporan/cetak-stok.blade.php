<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Stok Barang</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h2 { text-align: center; margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #f3f3f3; }
    </style>
</head>
<body>
    <h2>LAPORAN STOK BARANG<br>Outfitbymee</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangs as $key => $barang)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $barang->nama_barang }}</td>
                <td>{{ $barang->kategori->nama_kategori ?? '-' }}</td>
                <td>{{ $barang->stok }}</td>
                <td>Rp {{ number_format($barang->harga, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p style="text-align: right; margin-top: 30px;">
        Dicetak pada: {{ \Carbon\Carbon::now()->translatedFormat('d F Y, H:i') }}
    </p>
</body>
</html>
