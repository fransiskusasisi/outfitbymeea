@extends('layouts.app')

@section('title', 'Data Kategori')

@section('content')
    <div class="p-8 space-y-6 ">
        <!-- Judul Halaman -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Tambah Kategori</h1>
            <p class="text-gray-500 text-sm mt-1">Tambah kategori barang di Outfitbymee</p>
        </div>


        <!-- Tabel Data -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="w-1/2 mx-auto p-6 overflow-x-auto">
                @if (role() === 'pemilik')
                    <form action="{{ route('pemilik.kategori.update', $kategori->kategori_id) }}" method="POST">
                    @elseif(role() === 'petugas_gudang')
                        <form action="{{ route('gudang.kategori.update', $kategori->kategori_id) }}" method="POST">
                @endif
                @method('PUT')
                @csrf
                <div class="mb-4">
                    <label for="nama" class="block text-gray-700 font-semibold mb-2">Nama Kategori</label>
                    <input type="text" name="nama" id="nama" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600"
                        placeholder="Masukkan nama kategori" value="{{ $kategori->nama }}">
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="btn-indigo">
                        @include('icons.update-icon')Update Kategori
                    </button>
                </div>
                </form>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        @if (role() === 'pemilik')
            const indexUrl = "{{ route('pemilik.kategori.index') }}";
        @elseif (role() === 'petugas_gudang')
            const indexUrl = "{{ route('gudang.kategori.index') }}";
        @elseif (role() === 'kasir')
            const indexUrl = "{{ route('kasir.kategori.index') }}";
        @endif
    </script>
    <script src="{{ asset('js/kategori.js') }}"></script>
@endpush
