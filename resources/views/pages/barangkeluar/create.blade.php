@extends('layouts.app')

@section('title', 'Data Kategori')

@section('content')
    <div class="p-8 space-y-6 ">
        <!-- Judul Halaman -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Tambah Barang Keluar</h1>
            <p class="text-gray-500 text-sm mt-1">Tambah barang keluar di Outfitbymee</p>
        </div>

        <!-- Tabel Data -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="w-1/2 mx-auto p-6 overflow-x-auto">
                @if (Auth::user()->role === 'pemilik')
                    <form action="{{ route('pemilik.barangkeluar.store') }}" method="POST">
                    @elseif(Auth::user()->role === 'petugas_gudang')
                        <form action="{{ route('gudang.barangkeluar.store') }}" method="POST">
                @endif
                @csrf
                <div class="mb-4">
                    <label for="barang_id" class="block text-gray-700 font-semibold mb-2">Nama Barang</label>
                    <select name="barang_id" id="barang_id" required class="form-input">
                        <option value="" disabled selected>Pilih Barang</option>
                        @foreach ($barang as $item)
                            <option value="{{ $item->barang_id }}">{{ $item->nama_barang }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="jumlah" class="block text-gray-700 font-semibold mb-2">Jumlah</label>
                    <input type="number" name="jumlah" id="jumlah" required class="form-input"
                        placeholder="Masukkan jumlah barang">
                </div>
                <div class="mb-4">
                    <label for="tanggal" class="block text-gray-700 font-semibold mb-2">Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal" required class="form-input">
                </div>
                <div class="flex justify-end mt-8">
                    <button type="submit" class="btn-ungu">
                        @include('icons.save-icon')Simpan Barang
                    </button>
                </div>
                </form>
            </div>
        </div>

    </div>
@endsection

@if (session('gagal'))
    <script>
        const iconOke = `{!! view('icons.centang-icon')->render() !!}`;
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                position: "center",
                icon: "error",
                text: "{{ session('gagal') }}",
                confirmButtonColor: "#d33",
                confirmButtonText: `<div class="flex items-center gap-2">
            <span class="inline-block">${iconOke}</span>
            <span>Oke</span>
        </div>`,
                customClass: {
                    confirmButton: "btn-ungu",
                },
            });
        });
    </script>
@endif

@push('scripts')
    <script>
        @if (role() === 'pemilik')
            const indexUrl = "{{ route('pemilik.barangkeluar.index') }}";
        @elseif (role() === 'petugas_gudang')
            const indexUrl = "{{ route('gudang.barangkeluar.index') }}";
        @elseif (role() === 'kasir')
            const indexUrl = "{{ route('kasir.barangkeluar.index') }}";
        @endif
    </script>
    <script src="{{ asset('js/kategori.js') }}"></script>
@endpush
