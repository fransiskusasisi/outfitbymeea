@extends('layouts.app')

@section('title', 'Laporan Lengkap Barang')

@section('content')
    <div class="p-8 space-y-6">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Detail Lengkap Laporan</h1>
            </div>
            <a href="{{ route('pemilik.laporan.lengkap.cetak') }}" target="_blank" class="btn-cetak">
                @include('icons.print-icon')Cetak Laporan
            </a>
        </div>
        <div class="flex w-full gap-2 mb-4 text-sm text-gray-600">
            <div class="w-1/3 bg-white shadow-md p-6 rounded-lg">
                <table>
                    <tr>
                        <td>Jumlah Transaksi Barang Masuk</td>
                        <td class="px-4">:</td>
                        <td class="font-semibold">{{ $jmlTransaksiMasuk }}</td>
                    </tr>
                    <tr>
                        <td>Total Nilai Barang Masuk</td>
                        <td class="px-4">:</td>
                        <td class="font-semibold">{{ formatRupiah($totalNilaiMasuk) }}</td>
                    </tr>
                </table>
            </div>
            <div class="w-1/3 bg-white shadow-md p-6 rounded-lg">
                <table>
                    <tr>
                        <td>Jumlah Transaksi Barang Keluar</td>
                        <td class="px-4">:</td>
                        <td class="font-semibold">{{ $jmlTransaksiKeluar }}</td>
                    </tr>
                    <tr>
                        <td>Total Nilai Barang Keluar</td>
                        <td class="px-4">:</td>
                        <td class="font-semibold">{{ formatRupiah($totalNilaiKeluar) }}</td>
                    </tr>
                </table>
            </div>
            <div class="w-1/3 bg-white shadow-md p-6 rounded-lg">
                <table>
                    <tr>
                        <td>Total Jumlah Transaksi</td>
                        <td class="px-4">:</td>
                        <td class="font-semibold">{{ $totalTransaksi }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- Tabel Data -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-6 overflow-x-auto">
                <table id="my-table" class="table-main">
                    <thead class="thead-main">
                        <tr class="tr-main">
                            <th class="text-center">No</th>
                            <th>Nama Barang</th>
                            <th>Jml Trans Brg Masuk</th>
                            <th>Total Nilai Brg Masuk</th>
                            <th>Jml Trans Brg Keluar</th>
                            <th>Total Nilai Brg Keluar</th>
                        </tr>
                    </thead>
                    <tbody class="tbody-main"></tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        const indexUrl = "{{ route('pemilik.laporan.lengkap.data') }}";
    </script>
    <script src="{{ asset('js/laporan-lengkap.js') }}"></script>
@endpush