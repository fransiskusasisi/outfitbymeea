@extends('layouts.app')
@section('title', 'Data Barang')
@section('content')
    <div class="p-8 space-y-6 ">
        <!-- Judul Halaman -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Data Barang</h1>
            <p class="text-gray-500 text-sm mt-1">Kelola barang di Outfitbymee</p>
        </div>

        <!-- Tombol Tambah -->
        <div class="flex justify-end mb-4">
            <a href="{{ route('barang.create') }}"
                class="bg-purple-600 hover:bg-purple-700 text-white px-5 py-2 rounded-lg text-sm font-semibold shadow transition">
                + Tambah Barang
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
                            <th>Ukuran</th>
                            <th>Kondisi</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Stok</th>
                            <th class="text-center">Aksi</th>
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
        const indexUrl = "{{ route('barang.index') }}";
    </script>
    <script src="{{ asset('js/barang.js') }}"></script>
@endpush
