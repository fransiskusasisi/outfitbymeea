@extends('layouts.app')

@section('title', 'Dashboard Pemilik')
@section('page-title', 'Dashboard Pemilik')
@section('page-subtitle', 'Selamat datang di dashboard Outfitbymee')

@section('content')
    <div class="w-full p-8 space-y-6 text-gray-600">

        <!-- Judul Halaman -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Dashboard Pemilik</h1>
            <p class="text-gray-500 text-sm mt-1">Selamat datang kembali, semoga harimu menyenangkan ✨</p>
        </div>

        {{-- isi dashboard --}}
        <div class="flex gap-4">
            <div class="w-full">
                <div
                    class="bg-gradient-to-r from-hijautosca to-emerald-300 rounded-t-lg shadow-md p-6 text-white flex items-center gap-4">
                    <div class="w-20 h-20 flex justify-center items-center">
                        @include('icons.history-icon')
                    </div>
                    <div class="w-full flex">
                        <div class="items-center flex-grow">
                            <p class="font-bold mb-2">Riwayat Login</p>
                            <p class="text-4xl font-bold ">{{ $riwayatLogin }}</p>
                        </div>
                        <div class="flex justify-end items-end">
                            <p class="italic text-sm font-bold">Users</p>
                        </div>
                    </div>
                </div>
                <div class="w-full flex bg-white py-2 px-4 rounded-b-lg shadow-md">
                    <a href="{{ route('pemilik.riwayatlogin.index') }}" class="font-bold hover:opacity-60">Detail</a>
                </div>
            </div>
            {{-- <div
                class="w-1/2 bg-gradient-to-r from-merahorange to-orange-300 rounded-lg shadow-md p-6 text-white flex items-center gap-4">
                <div class="w-20 h-20 flex justify-center items-center">
                    @include('icons.barangkeluar-icon')
                </div>
                <div class="w-full flex">
                    <div class="items-center flex-grow">
                        <p class="font-bold mb-2">---</p>
                        <p class="text-4xl font-bold ">{{ $totalBarangKeluar }}</p>
                    </div>
                    <div class="flex justify-end items-end">
                        <p class="italic text-sm font-bold">Unit</p>
                    </div>
                </div>
            </div> --}}
        </div>
        <hr>
        <div class="bg-white rounded-xl shadow-md w-full">
            <div class="bg-gradient-to-r from-purple-600 to-indigo-600 p-6 rounded-t-xl">
                <h3 class="text-2xl font-bold text-white">Laporan Stok Terkini</h3>
            </div>
            <div class="p-6">
                @foreach ($stok as $item)
                    <div class="w-full border-b py-2 flex justify-between mb-2">
                        <div class=" flex items-center gap-4">
                            <div class="w-20 h-20 rounded-full overflow-hidden shadow-lg">
                                <img class="w-full h-full object-cover"
                                    src="{{ $item->gambar == null ? asset('/images/no-img.jpg') : asset('storage/images/barang/' . $item->gambar) }}"
                                    alt="{{ $item->nama_barang }}">
                            </div>
                            <div>
                                <p class="font-semibold text-lg">{{ $item->nama_barang }}</p>
                                <p class="text-sm text-gray-500">Kategori: {{ $item->kategori->nama ?? '-' }}</p>
                            </div>
                        </div>
                        <div>
                            <p class="font-semibold text-lg">Stok: {{ $item->stok }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Laporan Stok -->
        {{-- <div class="bg-white rounded-xl shadow-md overflow-hidden">
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
        </div> --}}

    </div>
@endsection
