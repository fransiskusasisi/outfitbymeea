@extends('layouts.app')

@section('title', 'Dashboard Pemilik')
@section('page-title', 'Dashboard Pemilik')
@section('page-subtitle', 'Selamat datang di dashboard Outfitbymee')

@section('content')
    <div class="w-full p-8 space-y-6">

        <!-- Judul Halaman -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Dashboard Pemilik</h1>
            <p class="text-gray-500 text-sm mt-1">Selamat datang kembali, semoga harimu menyenangkan ✨</p>
        </div>

        <!-- Laporan Stok -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="bg-gradient-to-r from-purple-600 to-indigo-600 px-6 py-4">
                <h3 class="text-lg font-bold text-white">Laporan Stok Terkini</h3>
                <p class="text-purple-100 text-sm">Data stok barang terbaru</p>
            </div>

            <div class="p-6">
                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-100 border-b-2 border-gray-200">
                                <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">No</th>
                                <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Gambar</th>
                                <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Nama Barang</th>
                                <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Kategori</th>
                                <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Stok</th>
                                <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Harga Beli</th>
                                <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Harga Jual</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($barangs as $key => $barang)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="py-3 px-4 text-sm text-gray-600">{{ $key + 1 }}</td>
                                    <td class="py-3 px-4">
                                        @if ($barang->gambar)
                                            <img src="{{ asset('storage/' . $barang->gambar) }}"
                                                alt="{{ $barang->nama_barang }}" class="w-16 h-16 object-cover rounded-lg">
                                        @else
                                            <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                                <span class="text-gray-400 text-xs">No Image</span>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="py-3 px-4 text-sm text-gray-600">{{ $barang->nama_barang }}</td>
                                    <td class="py-3 px-4 text-sm text-gray-600">
                                        {{ $barang->kategori->nama ?? '-' }}</td>
                                    <td class="py-3 px-4 text-sm text-gray-600">{{ $barang->stok }}</td>
                                    <td class="py-3 px-4 text-sm text-gray-600">Rp
                                        {{ number_format($barang->harga_beli, 0, ',', '.') }}</td>
                                    <td class="py-3 px-4 text-sm text-gray-600">Rp
                                        {{ number_format($barang->harga_jual, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-gray-500">Tidak ada data stok.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
