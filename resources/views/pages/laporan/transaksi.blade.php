@extends('layouts.app')

@section('title', 'Laporan Stok Barang')

@section('content')
    <div class="p-8 space-y-6">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Laporan Transaksi Barang</h1>
                <p class="text-gray-500 text-sm mt-1">Data transaksi keseluruhan</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('pemilik.laporan.transaksi.cetak', ['tipe' => 'masuk']) }}" target="_blank"
                    class="btn-cetak">
                    @include('icons.print-icon')Cetak Transaksi Masuk
                </a>
                <a href="{{ route('pemilik.laporan.transaksi.cetak', ['tipe' => 'keluar']) }}" target="_blank"
                    class="btn-cetak">
                    @include('icons.print-icon')Cetak Transaksi Keluar
                </a>
            </div>
        </div>
        <div x-data="{ activeTab: 'masuk' }" class="relative">
            <div class="flex gap-4 justify-start mb-6">
                <button @click="activeTab = 'masuk'"
                    :class="{ 'bg-purple-600 text-white shadow-md font-bold': activeTab === 'masuk', 'bg-gray-200 shadow-md font-bold text-gray-800': activeTab !== 'masuk' }"
                    class="px-4 py-2 rounded-lg font-medium transition-colors">
                    Transaksi Barang Masuk
                </button>
                <button @click="activeTab = 'keluar'"
                    :class="{ 'bg-purple-600 text-white shadow-md font-bold': activeTab === 'keluar', 'bg-gray-200 shadow-md font-bold text-gray-800': activeTab !== 'keluar' }"
                    class="px-4 py-2 rounded-lg font-medium transition-colors">
                    Transaksi Barang Keluar
                </button>
            </div>

            <div class="text-center text-lg text-gray-700">
                <div x-show="activeTab === 'masuk'" x-cloak class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="p-6 overflow-x-auto">
                        <table id="barang-masuk-table" class="table-main">
                            <thead class="thead-main">
                                <tr class="tr-main">
                                    <th class="text-center">No</th>
                                    <th style="width: 10%">Gambar</th>
                                    <th>Nama Barang</th>
                                    <th>Kode Barang</th>
                                    <th>Harga Jual</th>
                                    <th>Ukuran</th>
                                    <th>Kondisi</th>
                                    <th>Jumlah</th>
                                    <th>Tanggal</th>
                                    <th>Nama User</th>
                                </tr>
                            </thead>
                            <tbody class="tbody-main"></tbody>
                        </table>
                    </div>
                </div>

                <div x-show="activeTab === 'keluar'" x-cloak class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="p-6 overflow-x-auto">
                        <table id="barang-keluar-table" class="table-main">
                            <thead class="thead-main">
                                <tr class="tr-main">
                                    <th class="text-center">No</th>
                                    <th style="width: 10%">Gambar</th>
                                    <th>Nama Barang</th>
                                    <th>Kode Barang</th>
                                    <th>Harga Jual</th>
                                    <th>Ukuran</th>
                                    <th>Kondisi</th>
                                    <th>Jumlah</th>
                                    <th>Tanggal</th>
                                    <th>Nama User</th>
                                </tr>
                            </thead>
                            <tbody class="tbody-main"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@push('scripts')
    <script>
        const indexBarangMasukUrl = "{{ route('pemilik.laporan.transaksi.barang-masuk') }}";
        const indexBarangKeluarUrl = "{{ route('pemilik.laporan.transaksi.barang-keluar') }}";
    </script>
    <script src="{{ asset('js/lap-transaksi.js') }}"></script>
@endpush
