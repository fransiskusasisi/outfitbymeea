@extends('layouts.app')

@section('title', 'Data Kategori')

@section('content')
    <div class="p-8 space-y-6 ">
        <!-- Judul Halaman -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Edit Barang Keluar</h1>
            <p class="text-gray-500 text-sm mt-1">Edit barang keluar di Outfitbymee</p>
        </div>

        <!-- Tabel Data -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="w-1/2 mx-auto p-6 overflow-x-auto">
                <form action="{{ route('barangkeluar.update', $barangkeluar->keluar_id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="mb-4">
                        <label for="barang_id" class="block text-gray-700 font-semibold mb-2">Nama Barang</label>
                        <select name="barang_id" id="barang_id" required class="form-input">
                            <option value="" disabled selected>Pilih Barang</option>
                            @foreach ($barang as $item)
                                <option {{ $barangkeluar->barang_id == $item->barang_id ? 'selected' : '' }}
                                    value="{{ $item->barang_id }}">{{ $item->nama_barang }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="jumlah" class="block text-gray-700 font-semibold mb-2">Jumlah</label>
                        <input type="number" name="jumlah" id="jumlah" required class="form-input"
                            value="{{ $barangkeluar->jumlah }}">
                    </div>
                    <div class="mb-4">
                        <label for="tanggal" class="block text-gray-700 font-semibold mb-2">Tanggal</label>
                        <input type="date" name="tanggal" id="tanggal" required class="form-input"
                            value="{{ $barangkeluar->tanggal }}">
                    </div>
                    <div class="flex justify-end mt-8">
                        <button type="submit" class="btn-indigo">
                            @include('icons.update-icon')Update Barang Keluar
                        </button>
                    </div>
                </form>
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
