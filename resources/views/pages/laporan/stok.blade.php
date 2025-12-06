@extends('layouts.app')

@section('title', 'Laporan Stok Barang')

@section('content')
    <div class="p-8 space-y-6">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Laporan Stok Barang</h1>
            </div>

            <a href="{{ route('pemilik.laporan.stok.cetak') }}" target="_blank" class="btn-cetak">
                @include('icons.print-icon')Cetak Stok Barang
            </a>
        </div>
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-6 overflow-x-auto">
                <table id="my-table" class="table-main">
                    <thead class="thead-main">
                        <tr class="tr-main">
                            <th class="text-center">No</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th>Harga Jual</th>
                        </tr>
                    </thead>
                    <tbody class="tbody-main"></tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        const indexUrl = "{{ route('pemilik.laporan.stok') }}";
    </script>
    <script src="{{ asset('js/stok.js') }}"></script>
@endpush
