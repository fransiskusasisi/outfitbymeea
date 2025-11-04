@extends('layouts.app')

@section('title', 'Data Kategori')

@section('content')
    <div class="p-8 space-y-6 ">
        <!-- Judul Halaman -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Edit Barang Masuk</h1>
            <p class="text-gray-500 text-sm mt-1">Edit barang masuk di Outfitbymee</p>
        </div>

        <!-- Tabel Data -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="w-1/2 mx-auto p-6 overflow-x-auto">
                @if (role() === 'pemilik')
                    <form action="{{ route('pemilik.barangmasuk.update', $barangmasuk->masuk_id) }}" method="POST">
                    @elseif(role() === 'petugas_gudang')
                        <form action="{{ route('gudang.barangmasuk.update', $barangmasuk->masuk_id) }}" method="POST">
                        @elseif(role() === 'kasir')
                            <form action="{{ route('kasir.barangmasuk.update', $barangmasuk->masuk_id) }}" method="POST">
                @endif
                @method('PUT')
                @csrf
                <div class="mb-4">
                    <label for="barang_id" class="block text-gray-700 font-semibold mb-2">Nama Barang</label>
                    <select name="barang_id" id="barang_id" required class="form-input">
                        <option value="" disabled selected>Pilih Barang</option>
                        @foreach ($barang as $item)
                            <option {{ $barangmasuk->barang_id == $item->barang_id ? 'selected' : '' }}
                                value="{{ $item->barang_id }}">{{ $item->nama_barang }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="jumlah" class="block text-gray-700 font-semibold mb-2">Jumlah</label>
                    <input type="number" name="jumlah" id="jumlah" required class="form-input"
                        value="{{ $barangmasuk->jumlah }}">
                </div>
                <div class="mb-4">
                    <label for="tanggal" class="block text-gray-700 font-semibold mb-2">Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal" required class="form-input"
                        value="{{ $barangmasuk->tanggal }}">
                </div>
                <div class="flex justify-end mt-8">
                    <button type="submit" class="btn-indigo">
                        @include('icons.update-icon')Update Barang Masuk
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
            const indexUrl = "{{ route('pemilik.barangmasuk.index') }}";
        @elseif (role() === 'petugas_gudang')
            const indexUrl = "{{ route('gudang.barangmasuk.index') }}";
        @elseif (role() === 'kasir')
            const indexUrl = "{{ route('kasir.barangmasuk.index') }}";
        @endif
    </script>
    <script src="{{ asset('js/kategori.js') }}"></script>
@endpush
