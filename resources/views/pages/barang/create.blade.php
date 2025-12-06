@extends('layouts.app')

@section('title', 'Tambah Barang')

@section('content')
    <div class="p-8 space-y-6 ">
        <!-- Judul Halaman -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Tambah Barang</h1>
            <p class="text-gray-500 text-sm mt-1">Tambah barang di Outfitbymee</p>
        </div>
        <!-- Tabel Data -->
        @if (Auth::user()->role === 'pemilik')
            <form action="{{ route('pemilik.barang.store') }}" method="POST" enctype="multipart/form-data">
            @elseif(Auth::user()->role === 'petugas_gudang')
                <form action="{{ route('gudang.barang.store') }}" method="POST" enctype="multipart/form-data">
        @endif
        @csrf
        <div class="bg-white rounded-xl shadow-md overflow-hidden flex justify-center gap-2">
            <div class="w-1/2 p-6 overflow-x-auto">
                <div class="mb-4">
                    <label for="nama_barang" class="block text-gray-700 font-semibold mb-2">Nama Barang</label>
                    <input type="text" name="nama_barang" id="nama_barang" required class="form-input"
                        placeholder="Masukkan nama barang">
                </div>
                <div class="mb-4">
                    <label for="kode_barang" class="block text-gray-700 font-semibold mb-2">Kode Barang</label>
                    <input type="text" name="kode_barang" id="kode_barang" required class="form-input"
                        placeholder="Masukkan kode barang">
                </div>
                <div class="mb-4">
                    <label for="kategori_id" class="block text-gray-700 font-semibold mb-2">Kategori</label>
                    <select name="kategori_id" id="kategori_id" required class="form-input">
                        <option value="" disabled selected>Pilih Kategori</option>
                        @foreach ($kategori as $item)
                            <option value="{{ $item->kategori_id }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="ukuran" class="block text-gray-700 font-semibold mb-2">Ukuran</label>
                    <select name="ukuran" id="ukuran" required class="form-input ">
                        <option value="" disabled selected>-- Pilih Ukuran --</option>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="kondisi" class="block text-gray-700 font-semibold mb-2">Kondisi</label>
                    <select name="kondisi" id="kondisi" required class="form-input ">
                        <option value="" disabled selected>-- Pilih Kondisi --</option>
                        <option value="bekas bagus">Bekas Bagus</option>
                        <option value="bekas sedang">Bekas Sedang</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="stok" class="block text-gray-700 font-semibold mb-2">Jumlah Stok</label>
                    <input type="number" name="stok" id="stok" required class="form-input"
                        placeholder="Masukkan jumlah stok barang">
                </div>
                <div class="flex justify-end mt-8">
                    <button type="submit" class="btn-ungu">
                        @include('icons.save-icon')Simpan Barang
                    </button>
                </div>
            </div>
        </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        @if (role() === 'pemilik')
            const indexUrl = "{{ route('pemilik.barang.index') }}";
        @elseif (role() === 'petugas_gudang')
            const indexUrl = "{{ route('gudang.barang.index') }}";
        @elseif (role() === 'kasir')
            const indexUrl = "{{ route('kasir.barang.index') }}";
        @endif
    </script>
    <script src="{{ asset('js/kategori.js') }}"></script>
@endpush
