<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Transaksi Barang</title>
    <style>
        body {
            font-family: "Times", serif;
            font-size: 12px;
            padding: 30px;
        }

        table {
            border-collapse: collapse;
        }

        .header-table {
            width: 100%;
            margin-bottom: 10px;
            border: none;
        }

        .logo-container {
            width: 15%;
            text-align: left;
            vertical-align: top;
        }

        .logo-img {
            width: 80px;
            height: auto;
        }

        .header-text {
            width: 85%;
            text-align: center;
            vertical-align: middle;
        }

        .header-text h2 {
            margin: 0;
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .header-text h1 {
            margin: 5px 0;
            font-size: 18px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .header-text p {
            margin: 0;
            font-size: 12px;
        }

        hr.divider {
            border: 0;
            border-top: 3px solid #000;
            margin-top: 5px;
            margin-bottom: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
        }

        h3 {
            text-align: left;
            margin-top: 20px;
        }

        #data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        #th-data-table,
        #td-data-table {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        #th-data-table {
            background-color: #f3f3f3;
        }
    </style>
</head>

<body>
    <table class="header-table">
        <tr>
            <td class="logo-container">
                <img src="{{ public_path('images/logo-compressed.png') }}" class="logo-img" alt="Logo">
            </td>
            <td class="header-text">
                <h2>LAPORAN TRANSAKSI</h2>
                <h1>OUFITBYMEE YOGYAKARTA</h1>
                <p>Jl. Pogung Rejo, Pogung Kidul, Sinduadi, Kec. Mlati,</p>
                <p>Kabupaten Sleman, Daerah Istimewa Yogyakarta</p>
            </td>
            <td class="logo-container">
            </td>
        </tr>
    </table>
    <hr class="divider">
    @if ($tipe == 'masuk')
        <h3>BARANG MASUK</h3>
        <table id="data-table">
            <thead>
                <tr>
                    <th id="th-data-table" style="text-align: center;">No</th>
                    <th id="th-data-table" style="text-align: center;">Nama Barang</th>
                    <th id="th-data-table" style="text-align: center;">Kode Barang</th>
                    <th id="th-data-table" style="text-align: center;">Harga Jual</th>
                    <th id="th-data-table" style="text-align: center;">Ukuran</th>
                    <th id="th-data-table" style="text-align: center;">Kondisi</th>
                    <th id="th-data-table" style="text-align: center;">Jumlah</th>
                    <th id="th-data-table" style="text-align: center;">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barangMasuk as $index => $item)
                    <tr>
                        <td id="td-data-table" style="text-align: center;">{{ $index + 1 }}</td>
                        <td id="td-data-table">{{ $item->barang->nama_barang ?? '-' }}</td>
                        <td id="td-data-table">{{ $item->barang->kode_barang ?? '-' }}</td>
                        <td id="td-data-table">{{ formatRupiah($item->harga_jual) ?? '-' }}</td>
                        <td id="td-data-table">{{ $item->barang->ukuran ?? '-' }}</td>
                        <td id="td-data-table">{{ ucwords($item->barang->kondisi) ?? '-' }}</td>
                        <td id="td-data-table">{{ $item->jumlah ?? '-' }}</td>
                        <td id="td-data-table">{{ formatTanggal($item->tanggal) ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @elseif($tipe == 'keluar')
        <h3>BARANG KELUAR</h3>
        <table id="data-table">
            <thead>
                <tr>
                    <th id="th-data-table" style="text-align: center;">No</th>
                    <th id="th-data-table" style="text-align: center;">Nama Barang</th>
                    <th id="th-data-table" style="text-align: center;">Kode Barang</th>
                    <th id="th-data-table" style="text-align: center;">Harga Jual</th>
                    <th id="th-data-table" style="text-align: center;">Ukuran</th>
                    <th id="th-data-table" style="text-align: center;">Kondisi</th>
                    <th id="th-data-table" style="text-align: center;">Jumlah</th>
                    <th id="th-data-table" style="text-align: center;">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barangKeluar as $index => $item)
                    <tr>
                        <td id="td-data-table" style="text-align: center;">{{ $index + 1 }}</td>
                        <td id="td-data-table">{{ $item->barang->nama_barang ?? '-' }}</td>
                        <td id="td-data-table">{{ $item->barang->kode_barang ?? '-' }}</td>
                        <td id="td-data-table">
                            {{ formatRupiah(optional($item->barang->latestMasuk)->harga_jual) ?? '-' }}
                        </td>
                        <td id="td-data-table">{{ $item->barang->ukuran ?? '-' }}</td>
                        <td id="td-data-table">{{ ucwords($item->barang->kondisi) ?? '-' }}</td>
                        <td id="td-data-table">{{ $item->jumlah ?? '-' }}</td>
                        <td id="td-data-table">{{ formatTanggal($item->tanggal) ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    <p style="text-align: right; margin-top: 30px;">
        Dicetak pada: {{ \Carbon\Carbon::now()->translatedFormat('d F Y, H:i') }}
    </p>
</body>

</html>
