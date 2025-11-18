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
        @if (role() !== 'kasir')
            <div class="flex justify-end mb-4">
                @if (role() === 'pemilik')
                    <a href="{{ route('pemilik.barang.create') }}" class="btn-ungu">
                    @elseif (role() === 'petugas_gudang')
                        <a href="{{ route('gudang.barang.create') }}" class="btn-ungu">
                @endif
                @include('icons.add-icon')Tambah Barang
                </a>
            </div>
        @endif

        <!-- Tabel Data -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-6 overflow-x-auto">
                <table id="my-table" class="table-main">
                    <thead class="thead-main">
                        <tr class="tr-main">
                            <th class="text-center">No</th>
                            {{-- <th>Gambar</th> --}}
                            <th>Nama Barang</th>
                            <th>Kode Barang</th>
                            <th>Kategori</th>
                            <th>Ukuran</th>
                            <th>Kondisi</th>
                            {{-- <th>Harga Jual</th> --}}
                            <th>Stok</th>
                            @if (role() !== 'kasir')
                                <th class="text-center">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="tbody-main"></tbody>
                </table>
            </div>
        </div>

    </div>
@endsection

@if (session('berhasil'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                position: "center",
                icon: "success",
                text: "{{ session('berhasil') }}",
                showConfirmButton: false,
                timer: 1500,
            });
        });
    </script>
@endif

@push('scripts')
    <script>
        @if (role() === 'pemilik')
            const indexUrl = "{{ route('pemilik.barang.index') }}";
        @elseif (role() === 'petugas_gudang')
            const indexUrl = "{{ route('gudang.barang.index') }}";
        @elseif (role() === 'kasir')
            const indexUrl = "{{ route('kasir.barang.index') }}";
        @endif
        const userRole = "{{ Auth::user()->role }}"
        const iconOke = `{!! view('icons.centang-icon')->render() !!}`;
        const iconBatal = `{!! view('icons.batal-icon')->render() !!}`;
    </script>
    <script src="{{ asset('js/barang.js') }}"></script>
@endpush
