<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Laporan Outfitbymee</title>
    <style>
        body {
            font-family: "Times", serif;
            font-size: 12px;
            padding: 30px;
        }

        /* Mengatur margin halaman PDF langsung via CSS */
        /* @page {
            padding: 40px;
        } */

        table {
            border-collapse: collapse;
            /* KUNCI PERBAIKAN: Semua tabel harus collapse */
        }

        .header-table {
            width: 100%;
            margin-bottom: 10px;
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

        /* --- Statistics Box Styles --- */
        .section-title {
            background-color: #dbead5;
            border: 1px solid #000;
            padding: 5px;
            text-align: center;
            font-weight: bold;
            margin-bottom: 15px;
        }

        /* Container untuk statistik agar lurus */
        .stats-wrapper {
            width: 100%;
            margin-bottom: 15px;
            border: none;
        }

        .stats-wrapper td {
            vertical-align: top;
            padding: 0;
            /* Penting agar tidak ada padding extra */
            border: none;
            /* Hilangkan border container */
        }

        /* Kotak statistik individual */
        .stat-box {
            width: 100%;
            border: 1px solid #000;
        }

        .stat-box th {
            text-align: left;
            padding: 5px;
            font-weight: normal;
            border-bottom: 1px solid #000;
            font-size: 11px;
        }

        .stat-box td {
            padding: 5px;
            font-weight: bold;
            font-size: 12px;
            background-color: #fff;
        }

        /* Warna Header Box */
        .bg-green {
            background-color: #dbead5;
        }

        .bg-orange {
            background-color: #fce4d6;
        }

        .bg-blue {
            background-color: #daeef3;
        }

        /* Main Data Table */
        .data-table {
            width: 100%;
            margin-top: 10px;
        }

        .data-table th,
        .data-table td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
            vertical-align: top;
        }

        .data-table th {
            background-color: #dbead5;
            font-weight: bold;
            text-align: center;
        }

        .text-center {
            text-align: center;
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
                <h2>LAPORAN</h2>
                <h1>OUFITBYMEE YOGYAKARTA</h1>
                <p>Jl. Pogung Rejo, Pogung Kidul, Sinduadi, Kec. Mlati,</p>
                <p>Kabupaten Sleman, Daerah Istimewa Yogyakarta</p>
            </td>
            <td class="logo-container">
            </td>
        </tr>
    </table>
    <hr class="divider">

    <div class="section-title">Statistik</div>

    <table class="stats-wrapper">
        <tr>
            <td width="5%">
                <table class="stat-box">
                    <tr>
                        <th class="bg-green">Jumlah Transaksi Barang Masuk</th>
                    </tr>
                    <tr>
                        <td>{{ $jmlTransaksiMasuk }}</td>
                    </tr>
                </table>
            </td>
            <td width="4%"></td>
            <td width="5%">
                <table class="stat-box">
                    <tr>
                        <th class="bg-orange">Jumlah Transaksi Barang Keluar</th>
                    </tr>
                    <tr>
                        <td>{{ $jmlTransaksiKeluar }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table class="stats-wrapper">
        <tr>
            <td width="32%">
                <table class="stat-box">
                    <tr>
                        <th class="bg-green">Total Nilai Barang Masuk</th>
                    </tr>
                    <tr>
                        <td>{{ formatRupiah($totalNilaiMasuk) }}</td>
                    </tr>
                </table>
            </td>
            <td width="10%"></td>
            <td width="20%">
                <table class="stat-box">
                    <tr>
                        <th class="bg-blue">Total Jumlah Transaksi</th>
                    </tr>
                    <tr>
                        <td>{{ $totalTransaksi }}</td>
                    </tr>
                </table>
            </td>
            <td width="10%"></td>
            <td width="32%">
                <table class="stat-box">
                    <tr>
                        <th class="bg-orange">Total Nilai Barang Keluar</th>
                    </tr>
                    <tr>
                        <td>{{ formatRupiah($totalNilaiKeluar) }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table class="data-table">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="25%">Nama<br>Barang</th>
                <th width="15%">Jml Trans<br>Brg Masuk</th>
                <th width="22%">Total Nilai<br>Brg Masuk</th>
                <th width="15%">Jml Trans<br>Brg Keluar</th>
                <th width="23%">Total Nilai<br>Brg Keluar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barang as $index => $item)
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td>{{ $item->nama_barang }}</td>
                    <td style="text-align: center;">
                        {{ $item->latestMasuk ? $item->latestMasuk->jumlah : 0 }}
                    </td>
                    <td>
                        @php
                            $hargaJual = $item->latestMasuk ? $item->latestMasuk->harga_jual : 0;
                            $jumlahMasuk = $item->latestMasuk ? $item->latestMasuk->jumlah : 0;
                            $totalBarangMasuk = $hargaJual * $jumlahMasuk;
                        @endphp
                        {{ $totalBarangMasuk ? formatRupiah($totalBarangMasuk) : 'Rp 0' }}
                    </td>
                    <td style="text-align: center;">
                        {{ $item->latestKeluar ? $item->latestKeluar->jumlah : 0 }}
                    </td>
                    <td>
                        @php
                            $totalBarangKeluar = 0;
                            if ($item->latestKeluar) {
                                $barangKeluar = $item->latestKeluar;
                                $barangId = $barangKeluar->barang_id;
                                $jumlahKeluar = $barangKeluar->jumlah ?? 0;
                                $masukRecord = \App\Models\BarangMasuk::where('barang_id', $barangId)
                                    ->orderBy('created_at', 'desc')
                                    ->first();
                                $hargaJual = $masukRecord ? $masukRecord->harga_jual ?? 0 : 0;
                                $totalBarangKeluar = $hargaJual * $jumlahKeluar;
                            }
                        @endphp
                        {{ $totalBarangKeluar ? formatRupiah($totalBarangKeluar) : 'Rp 0' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <p style="text-align: right; margin-top: 30px;">
        Dicetak pada: {{ \Carbon\Carbon::now()->translatedFormat('d F Y, H:i') }}
    </p>
</body>

</html>
