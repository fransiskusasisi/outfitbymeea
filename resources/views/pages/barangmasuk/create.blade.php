@extends('layouts.app')

@section('title', 'Tambah Barang Masuk')

@section('content')
    <div class="p-8 space-y-6 ">
        <!-- Judul Halaman -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Tambah Barang Masuk</h1>
            <p class="text-gray-500 text-sm mt-1">Tambah barang masuk di Outfitbymee</p>
        </div>


        <!-- Tabel Data -->
        @if (Auth::user()->role === 'pemilik')
            <form action="{{ route('pemilik.barangmasuk.store') }}" method="POST" enctype="multipart/form-data">
            @elseif(Auth::user()->role === 'petugas_gudang')
                <form action="{{ route('gudang.barangmasuk.store') }}" method="POST" enctype="multipart/form-data">
        @endif
        @csrf
        <div class="bg-white rounded-xl shadow-md overflow-hidden flex justify-center gap-2">
            <div class="w-1/3 p-6 ">
                <div class="w-2/3 mx-auto">
                    <label for="gambar" class="block text-gray-700 font-semibold mb-2">Gambar</label>
                    <img src="{{ asset('images/no-img.jpg') }}" alt="Gambar Barang"
                        class="w-full mx-auto object-cover rounded-xl mb-4 shadow-md">
                    <input type="file" name="gambar" id="gambar" class="form-input">
                </div>
            </div>
            <div class="w-1/2 p-6 overflow-x-auto">
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
                    <input type="number" name="jumlah" id="jumlah" required class="form-input-disabled"
                        placeholder="Jumlah" readonly>
                </div>
                <div class="mb-4">
                    <label for="harga_jual" class="block text-gray-700 font-semibold mb-2">Harga Jual</label>
                    <div class="flex items-center">
                        <p class="form-rupiah">Rp.</p>
                        <input type="number" id="harga_jual" name="harga_jual" class="form-input-harga" required />
                    </div>
                </div>
                <div class="mb-4">
                    <label for="tanggal" class="block text-gray-700 font-semibold mb-2">Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal" required class="form-input-disabled"
                        value="{{ now()->format('Y-m-d') }}" readonly>
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
            const indexUrl = "{{ route('pemilik.barangmasuk.index') }}";
        @elseif (role() === 'petugas_gudang')
            const indexUrl = "{{ route('gudang.barangmasuk.index') }}";
        @elseif (role() === 'kasir')
            const indexUrl = "{{ route('kasir.barangmasuk.index') }}";
        @endif
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectBarang = document.getElementById('barang_id');
            const inputJumlah = document.getElementById('jumlah');
            selectBarang.addEventListener('change', function() {
                const barangId = this.value;
                if (!barangId) {
                    inputJumlah.value = '';
                    return;
                }
                inputJumlah.value = '...';
                const url = `/barang/${barangId}/stok`;
                fetch(url, {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json',
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Gagal mengambil data stok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success === false) {
                            inputJumlah.value = '';
                            alert(data.message || 'Barang tidak ditemukan');
                            return;
                        }
                        inputJumlah.value = data.stok ?? '';
                    })
                    .catch(err => {
                        console.error(err);
                        inputJumlah.value = '';
                        alert('Terjadi kesalahan saat mengambil data stok.');
                    });
            });
        });
    </script>
@endpush
