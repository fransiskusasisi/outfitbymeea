@extends('layouts.app')

@section('title', 'Data Kategori')

@section('content')
    <div class="p-8 space-y-6 ">
        <!-- Judul Halaman -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Data Kategori</h1>
            <p class="text-gray-500 text-sm mt-1">Kelola kategori barang di Outfitbymee</p>
        </div>

        <!-- Tombol Tambah -->
        <div class="flex justify-end mb-4">
            <a href="{{ route('kategori.create') }}"
                class="bg-purple-600 hover:bg-purple-700 text-white px-5 py-2 rounded-lg text-sm font-semibold shadow transition">
                + Tambah Kategori
            </a>
        </div>

        <!-- Tabel Data -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-6 overflow-x-auto">
                <table id="my-table" class="table-main">
                    <thead class="thead-main">
                        <tr class="tr-main">
                            <th class="text-center">No</th>
                            <th>Nama Kategori</th>
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
        const indexUrl = "{{ route('kategori.index') }}";
    </script>
    <script src="{{ asset('js/kategori.js') }}"></script>
@endpush


{{-- <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-100 border-b-2 border-gray-200">
                            <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700 w-16">No</th>
                            <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Nama Kategori</th>
                            <th class="text-center py-3 px-4 text-sm font-semibold text-gray-700 w-40">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kategoris as $index => $kategori)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-3 px-4 text-sm text-gray-600">{{ $index + 1 }}</td>
                                <td class="py-3 px-4 text-sm text-gray-600">{{ $kategori->nama }}</td>
                                <td class="py-3 px-4 text-center">
                                    <div class="flex justify-center space-x-2">
                                        <a href="{{ route('kategori.edit', $kategori->kategori_id) }}"
                                            class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-sm font-medium transition">
                                            Edit
                                        </a>
                                        <form action="{{ route('kategori.destroy', $kategori->kategori_id) }}"
                                            method="POST" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm font-medium transition">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-4 text-gray-500">Belum ada data kategori.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table> --}}
