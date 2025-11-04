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
        @if (role() !== 'kasir')
            <div class="flex justify-end mb-4">
                @if (role() === 'pemilik')
                    <a href="{{ route('pemilik.kategori.create') }}" class="btn-ungu">
                    @elseif (role() === 'petugas_gudang')
                        <a href="{{ route('gudang.kategori.create') }}" class="btn-ungu">
                @endif
                @include('icons.add-icon')Tambah Kategori
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
                            <th>Nama Kategori</th>
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
            const indexUrl = "{{ route('pemilik.kategori.index') }}";
        @elseif (role() === 'petugas_gudang')
            const indexUrl = "{{ route('gudang.kategori.index') }}";
        @elseif (role() === 'kasir')
            const indexUrl = "{{ route('kasir.kategori.index') }}";
        @endif
        const userRole = "{{ Auth::user()->role }}"
        const iconOke = `{!! view('icons.centang-icon')->render() !!}`;
        const iconBatal = `{!! view('icons.batal-icon')->render() !!}`;
    </script>
    <script src="{{ asset('js/kategori.js') }}"></script>
@endpush
