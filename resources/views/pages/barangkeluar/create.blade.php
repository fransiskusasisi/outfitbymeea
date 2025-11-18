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
                        @elseif(Auth::user()->role === 'kasir')
                            <form action="{{ route('kasir.barangkeluar.store') }}" method="POST">
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
                    <p class="text-sm mt-2 italic text-gray-600 mr-2">Jumlah Stok tersedia: <span id="stok_tersedia"></span>
                    </p>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectBarang = document.getElementById('barang_id');
            const stokTersedia = document.getElementById('stok_tersedia');
            const inputJumlah = document.getElementById('jumlah');
            const submitButton = document.querySelector('button[type="submit"]');

            if (!selectBarang) return;

            // Helper untuk men-set UI ketika stok diketahui
            function setStokUI(stok) {
                if (stok === null || stok === undefined || stok === '') {
                    stokTersedia.textContent = '';
                    inputJumlah.removeAttribute('max');
                    inputJumlah.disabled = false;
                    if (submitButton) submitButton.disabled = false;
                    return;
                }

                // pastikan stok sebagai number
                const stokNum = parseInt(stok, 10);
                stokTersedia.textContent = isNaN(stokNum) ? '-' : stokNum;

                if (!isNaN(stokNum)) {
                    inputJumlah.max = stokNum;
                    // jika stok 0 -> disable input & tombol submit
                    if (stokNum <= 0) {
                        inputJumlah.value = '';
                        inputJumlah.disabled = true;
                        if (submitButton) submitButton.disabled = true;
                    } else {
                        inputJumlah.disabled = false;
                        if (submitButton) submitButton.disabled = false;
                    }
                } else {
                    inputJumlah.removeAttribute('max');
                    inputJumlah.disabled = false;
                    if (submitButton) submitButton.disabled = false;
                }
            }

            selectBarang.addEventListener('change', function() {
                const barangId = this.value;
                if (!barangId) {
                    setStokUI(null);
                    return;
                }

                // Bangun URL stok dengan base url blade untuk menghindari masalah path
                const baseUrl = "{{ url('barang') }}"; // menghasilkan /barang
                const url = `${baseUrl}/${barangId}/stok`;

                // fetch
                fetch(url, {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json',
                        },
                    })
                    .then(response => {
                        if (!response.ok) throw new Error('Gagal mengambil data stok');
                        return response.json();
                    })
                    .then(data => {
                        // asumsi struktur: { success: true, stok: 10 } atau { success: false, message: '...' }
                        if (data === null) {
                            setStokUI(null);
                            return;
                        }

                        if (data.success === false) {
                            // jika API mengembalikan gagal
                            setStokUI(null);
                            stokTersedia.textContent = data.stok ?? '';
                            alert(data.message || 'Barang tidak ditemukan');
                            return;
                        }

                        // jika berhasil
                        const stok = data.stok ?? null;
                        setStokUI(stok);
                    })
                    .catch(err => {
                        console.error(err);
                        setStokUI(null);
                        alert('Terjadi kesalahan saat mengambil data stok.');
                    });
            });

            // Inisialisasi awal jika ada value default terpilih
            if (selectBarang.value) {
                selectBarang.dispatchEvent(new Event('change'));
            }
        });
    </script>
@endpush
