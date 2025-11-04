@extends('layouts.app')

@section('title', 'Data Kategori')

@section('content')
    <div class="p-8 space-y-6 ">
        <!-- Judul Halaman -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Edit Barang</h1>
            <p class="text-gray-500 text-sm mt-1">Edit barang di Outfitbymee</p>
        </div>


        <!-- Tabel Data -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="w-1/2 mx-auto p-6 overflow-x-auto">
                @if (role() === 'pemilik')
                    <form action="{{ route('pemilik.barang.update', $barang->barang_id) }}" method="POST">
                    @elseif(role() === 'petugas_gudang')
                        <form action="{{ route('gudang.barang.update', $barang->barang_id) }}" method="POST">
                @endif
                @method('PUT')
                @csrf
                <div class="mb-4">
                    <label for="nama_barang" class="block text-gray-700 font-semibold mb-2">Nama Barang</label>
                    <input type="text" name="nama_barang" id="nama_barang" required class="form-input"
                        value="{{ $barang->nama_barang }}">
                </div>
                <div class="mb-4">
                    <label for="kategori_id" class="block text-gray-700 font-semibold mb-2">Kategori</label>
                    <select name="kategori_id" id="kategori_id" required class="form-input">
                        <option value="" disabled selected>Pilih Kategori</option>
                        @foreach ($kategori as $item)
                            <option {{ $barang->kategori_id == $item->kategori_id ? 'selected' : '' }}
                                value="{{ $item->kategori_id }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="ukuran" class="block text-gray-700 font-semibold mb-2">Ukuran</label>
                    <input type="text" name="ukuran" id="ukuran" required class="form-input"
                        value="{{ $barang->ukuran }}">
                </div>
                <div class="mb-4">
                    <label for="kondisi" class="block text-gray-700 font-semibold mb-2">Kondisi</label>
                    <select name="kondisi" id="kondisi" required class="form-input ">
                        <option {{ $barang->kondisi == 'baru' ? 'selected' : '' }} value="baru">Baru</option>
                        <option {{ $barang->kondisi == 'bekas bagus' ? 'selected' : '' }} value="bekas bagus">
                            Bekas
                            Bagus</option>
                        <option {{ $barang->kondisi == 'bekas sedang' ? 'selected' : '' }} value="bekas sedang">
                            Bekas
                            Sedang</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="harga_beli" class="block text-gray-700 font-semibold mb-2">Harga Beli</label>
                    <div class="flex items-center">
                        <p class="form-rupiah">Rp.</p>
                        <input type="number" id="harga_beli" name="harga_beli" class="form-input-harga" required
                            value="{{ $barang->harga_beli }}" />
                    </div>
                </div>
                <div class="mb-4">
                    <label for="harga_jual" class="block text-gray-700 font-semibold mb-2">Harga Jual</label>
                    <div class="flex items-center">
                        <p class="form-rupiah">Rp.</p>
                        <input type="number" id="harga_jual" name="harga_jual" class="form-input-harga" required
                            value="{{ $barang->harga_jual }}" />
                    </div>
                </div>
                <div class="mb-4">
                    <label for="stok" class="block text-gray-700 font-semibold mb-2">Jumlah Stok</label>
                    <input type="number" name="stok" id="stok" required class="form-input"
                        value="{{ $barang->stok }}">
                </div>
                <div class="flex justify-end mt-8">
                    <button type="submit" class="btn-indigo">
                        @include('icons.update-icon')Update Barang
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
            const indexUrl = "{{ route('pemilik.barang.index') }}";
        @elseif (role() === 'petugas_gudang')
            const indexUrl = "{{ route('gudang.barang.index') }}";
        @elseif (role() === 'kasir')
            const indexUrl = "{{ route('kasir.barang.index') }}";
        @endif
    </script>
    <script src="{{ asset('js/barang.js') }}"></script>
@endpush
