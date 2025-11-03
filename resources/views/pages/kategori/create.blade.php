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
                <form action="{{ route('kategori.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="nama" class="block text-gray-700 font-semibold mb-2">Nama Kategori</label>
                        <input type="text" name="nama" id="nama" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600"
                            placeholder="Masukkan nama kategori">
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="btn-ungu">
                            @include('icons.save-icon')Simpan Kategori
                        </button>
                    </div>
                </form>
                {{-- <table id="my-table" class="table-main">
                    <thead class="thead-main">
                        <tr class="tr-main">
                            <th class="text-center">No</th>
                            <th>Nama Kategori</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="tbody-main"></tbody>
                </table> --}}
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
