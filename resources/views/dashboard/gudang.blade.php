@extends('layouts.app')

@section('title', 'Dashboard Gudang')
@section('page-title', 'Dashboard Gudang')
@section('page-subtitle', 'Selamat datang di dashboard Outfitbymee')

@section('content')
    <div class="w-full p-8 space-y-6 text-gray-600">

        <!-- Judul Halaman -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Dashboard Gudang</h1>
            <p class="text-gray-500 text-sm mt-1">Selamat datang kembali, semoga harimu menyenangkan ✨</p>
        </div>

        {{-- isi dashboard --}}
        <div class="flex gap-4">
            <div class="w-1/3">
                <div
                    class="w-full bg-gradient-to-r from-rose-500 to-rose-300 rounded-t-lg shadow-md p-6 text-white flex items-center gap-4 hover:shadow-lg">
                    <div class="w-20 h-20 flex justify-center items-center">
                        @include('icons.kategori-icon')
                    </div>
                    <div class="w-full flex">
                        <div class="items-center flex-grow">
                            <p class="font-bold mb-2">Semua Kategori</p>
                            <p class="text-4xl font-bold ">{{ $totalKategori }}</p>
                        </div>
                        <div class="flex justify-end items-end">
                            <p class="italic text-sm font-bold">Jenis</p>
                        </div>
                    </div>
                </div>
                <div class="w-full flex bg-white py-2 px-4 rounded-b-lg shadow-md">
                    <a href="{{ route('gudang.kategori.index') }}" class="font-bold hover:opacity-60">Detail</a>
                </div>
            </div>
            <div class="w-1/3">
                <div
                    class="bg-gradient-to-r from-hijautosca to-emerald-300 rounded-t-lg shadow-md p-6 text-white flex items-center gap-4">
                    {{-- <div class="w-1/2 bg-hijautosca rounded-lg shadow-md p-6 text-white"> --}}
                    <div class="w-20 h-20 flex justify-center items-center">
                        @include('icons.barangmasuk-icon')
                    </div>
                    <div class="w-full flex">
                        <div class="items-center flex-grow">
                            <p class="font-bold mb-2">Barang Masuk</p>
                            <p class="text-4xl font-bold ">{{ $totalBarangMasuk }}</p>
                        </div>
                        <div class="flex justify-end items-end">
                            <p class="italic text-sm font-bold">Unit</p>
                        </div>
                    </div>
                </div>
                <div class="w-full flex bg-white py-2 px-4 rounded-b-lg shadow-md">
                    <a href="{{ route('gudang.barangmasuk.index') }}" class="font-bold hover:opacity-60">Detail</a>
                </div>
            </div>
            <div class="w-1/3">
                <div
                    class="bg-gradient-to-r from-birumuda to-cyan-300 rounded-t-lg shadow-md p-6 text-white flex items-center gap-4">
                    <div class="w-20 h-20 flex justify-center items-center">
                        @include('icons.barang-icon')
                    </div>
                    <div class="w-full flex">
                        <div class="items-center flex-grow">
                            <p class="font-bold mb-2">Barang Tersedia</p>
                            <p class="text-4xl font-bold ">{{ $totalBarang }}</p>
                        </div>
                        <div class="flex justify-end items-end">
                            <p class="italic text-sm font-bold">Unit</p>
                        </div>
                    </div>
                </div>
                <div class="w-full flex bg-white py-2 px-4 rounded-b-lg shadow-md">
                    <a href="{{ route('gudang.barang.index') }}" class="font-bold hover:opacity-60">Detail</a>
                </div>
            </div>
        </div>
        <hr>
        <div class="flex gap-4">
            <div class="w-1/2 bg-white rounded-xl shadow-md">
                <div class="bg-gradient-to-r from-purple-600 to-indigo-600 p-6 rounded-t-xl">
                    <h3 class="text-xl font-bold text-white">Barang Masuk Terkini</h3>
                </div>
                <div class="p-6">
                    @foreach ($barangMasuk as $item)
                        <div class="w-full border-b py-2 flex justify-between mb-2">
                            <div class=" flex items-center">
                                <div
                                    class="bg-emerald-300 rounded-full p-2 flex justify-center items-center mr-4 text-white">
                                    @include('icons.barangmasukkecil-icon')
                                </div>
                                <div>
                                    <p class="font-semibold text-lg">{{ $item->barang->nama_barang ?? '-' }}</p>
                                    <p class="text-sm text-gray-500">Jumlah: {{ $item->jumlah ?? '-' }}</p>
                                </div>
                            </div>
                            <div class="items-center flex">
                                <p class="text-sm italic">{{ formatTanggal($item->tanggal) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="w-1/2 bg-white rounded-xl shadow-md">
                <div class="bg-gradient-to-r from-purple-600 to-indigo-600 p-6 rounded-t-xl">
                    <h3 class="text-xl font-bold text-white">Barang Keluar Terkini</h3>
                </div>
                <div class="p-6">
                    @foreach ($barangKeluar as $item)
                        <div class="w-full border-b py-2 flex justify-between mb-2">
                            <div class=" flex items-center">
                                <div
                                    class="bg-orange-300 rounded-full p-2 flex justify-center items-center mr-4 text-white">
                                    @include('icons.barangkeluarkecil-icon')
                                </div>
                                <div>
                                    <p class="font-semibold text-lg">{{ $item->barang->nama_barang ?? '-' }}</p>
                                    <p class="text-sm text-gray-500">Jumlah: {{ $item->jumlah ?? '-' }}</p>
                                </div>
                            </div>
                            <div class="items-center flex">
                                <p class="text-sm italic">{{ formatTanggal($item->tanggal) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        {{-- <div class="bg-white rounded-xl shadow-md w-full">
            <div class="bg-gradient-to-r from-purple-600 to-indigo-600 p-6 rounded-t-xl">
                <h3 class="text-2xl font-bold text-white">Laporan Stok Terkini</h3>
            </div>
            <div class="p-6">
                @foreach ($stok as $item)
                    <div class="w-full border-b py-2 flex justify-between mb-2">
                        <div>
                            <p class="font-semibold text-lg">{{ $item->nama_barang }}</p>
                            <p class="text-sm text-gray-500">Kategori: {{ $item->kategori->nama ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="font-semibold text-lg">Stok: {{ $item->stok }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div> --}}

    </div>
@endsection
