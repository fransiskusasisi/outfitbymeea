@extends('layouts.app')

@section('title', 'Laporan Stok Barang')

@section('content')
    <div class="p-8 space-y-6">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Laporan Stok Barang</h1>
            </div>

            {{-- Tombol Cetak PDF --}}
            <a href="{{ route('pemilik.laporan.stok.cetak') }}" target="_blank" class="btn-cetak">
                @include('icons.print-icon')Cetak Stok Barang
            </a>
        </div>
        <!-- Tabel Data -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-6 overflow-x-auto">
                <table id="my-table" class="table-main">
                    <thead class="thead-main">
                        <tr class="tr-main">
                            <th class="text-center">No</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th>Harga Jual</th>
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
        const indexUrl = "{{ route('pemilik.laporan.stok') }}";
    </script>
    <script src="{{ asset('js/stok.js') }}"></script>
@endpush

{{-- <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="p-6 overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-100 border-b-2 border-gray-200">
                        <th class="py-3 px-4 text-sm font-semibold text-gray-700">No</th>
                        <th class="py-3 px-4 text-sm font-semibold text-gray-700">Nama Barang</th>
                        <th class="py-3 px-4 text-sm font-semibold text-gray-700">Kategori</th>
                        <th class="py-3 px-4 text-sm font-semibold text-gray-700">Stok</th>
                        <th class="py-3 px-4 text-sm font-semibold text-gray-700">Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($barangs as $key => $barang)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3 px-4 text-sm">{{ $key + 1 }}</td>
                            <td class="py-3 px-4 text-sm">{{ $barang->nama_barang }}</td>
                            <td class="py-3 px-4 text-sm">{{ $barang->kategori->nama_kategori ?? '-' }}</td>
                            <td class="py-3 px-4 text-sm">{{ $barang->stok }}</td>
                            <td class="py-3 px-4 text-sm">Rp {{ number_format($barang->harga, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div> --}}
