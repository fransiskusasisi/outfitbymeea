@extends('layouts.app')

@section('title', 'Data Kategori')

@section('content')
    <div class="p-8 space-y-6 ">
        <!-- Judul Halaman -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Tambah Barang</h1>
            <p class="text-gray-500 text-sm mt-1">Tambah barang di Outfitbymee</p>
        </div>


        <!-- Tabel Data -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="w-1/2 mx-auto p-6 overflow-x-auto">
                <form action="{{ route('barang.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="nama_barang" class="block text-gray-700 font-semibold mb-2">Nama Barang</label>
                        <input type="text" name="nama_barang" id="nama_barang" required class="form-input"
                            placeholder="Masukkan nama barang">
                    </div>
                    <div class="mb-4">
                        <label for="nama_barang" class="block text-gray-700 font-semibold mb-2">Kategori</label>
                        <select name="kategori_id" id="kategori_id" required class="form-input">
                            <option value="" disabled selected>Pilih Kategori</option>
                            @foreach ($kategori as $item)
                                <option value="{{ $item->kategori_id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="ukuran" class="block text-gray-700 font-semibold mb-2">Ukuran</label>
                        <input type="text" name="ukuran" id="ukuran" required class="form-input"
                            placeholder="Masukkan ukuran barang">
                    </div>
                    <div class="mb-4">
                        <label for="kondisi" class="block text-gray-700 font-semibold mb-2">Kondisi</label>
                        <input type="text" name="kondisi" id="kondisi" required class="form-input"
                            placeholder="Masukkan kondisi barang">
                    </div>
                    <div class="mb-4">
                        <label for="kondisi" class="block text-gray-700 font-semibold mb-2">Harga Beli</label>
                        <div class="flex items-center">
                            <p class="form-rupiah">Rp.</p>
                            <input type="number" id="harga_beli" name="harga_beli" class="form-input-harga" required />
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="kondisi" class="block text-gray-700 font-semibold mb-2">Harga Jual</label>
                        <div class="flex items-center">
                            <p class="form-rupiah">Rp.</p>
                            <input type="number" id="harga_jual" name="harga_jual" class="form-input-harga" required />
                        </div>
                    </div>
                    <div class="flex justify-end mt-8">
                        <button type="submit" class="btn-ungu">
                            @include('icons.save-icon')Simpan Barang
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
