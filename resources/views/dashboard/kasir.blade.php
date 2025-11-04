@extends('layouts.app')

@section('title', 'Dashboard Kasir')

@section('page-title', 'Dashboard Kasir')

@section('page-subtitle', 'Selamat datang di dashboard Outfitbymee')

@section('content')
    <div class="w-full p-8 space-y-6 text-gray-600">
        <!-- Judul Halaman -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Dashboard Kasir</h1>
            <p class="text-gray-500 text-sm mt-1">Selamat datang kembali, semoga harimu menyenangkan ✨</p>
        </div>

        {{-- isi dashboard --}}
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-6 overflow-x-auto">
                <table id="my-table" class="table-main">
                    <thead class="thead-main">
                        <tr class="tr-main">
                            <th class="text-center">No</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Tanggal</th>
                            <th>Nama User</th>
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

@push('scripts')
    <script>
        @if (role() === 'pemilik')
            const indexUrl = "{{ route('pemilik.barangmasuk.index') }}";
        @elseif (role() === 'petugas_gudang')
            const indexUrl = "{{ route('gudang.barangmasuk.index') }}";
        @elseif (role() === 'kasir')
            const indexUrl = "{{ route('kasir.barangmasuk.index') }}";
        @endif
        const userRole = "{{ Auth::user()->role }}"
        const iconOke = `{!! view('icons.centang-icon')->render() !!}`;
        const iconBatal = `{!! view('icons.batal-icon')->render() !!}`;
    </script>
    <script src="{{ asset('js/barang-masuk.js') }}"></script>
@endpush
