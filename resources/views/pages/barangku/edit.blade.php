@extends('layouts.app') 
{{-- Asumsikan Anda memiliki layout dasar 'layouts.app' --}}

@section('content')
<div class="container">
    <h2>Edit Barang: {{ $barangku->nama_barang }}</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Ada masalah dengan input Anda.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Arahkan form ke route 'barangku.update' dengan mengirim ID barang --}}
    <form action="{{ route('barangku.update', $barangku->barang_id) }}" method="POST">
        @csrf
        {{-- Spoofing method POST menjadi PUT/PATCH untuk operasi update --}}
        @method('PUT') 
        
        {{-- Input Nama Barang --}}
        <div class="mb-3">
            <label for="nama_barang" class="form-label">Nama Barang:</label>
            <input 
                type="text" 
                name="nama_barang" 
                class="form-control" 
                placeholder="Nama Barang" 
                value="{{ old('nama_barang', $barangku->nama_barang) }}"
            >
        </div>

        {{-- Input Kategori ID --}}
        <div class="mb-3">
            <label for="kategori_id" class="form-label">Kategori ID:</label>
            <input 
                type="number" 
                name="kategori_id" 
                class="form-control" 
                placeholder="Kategori ID (opsional)" 
                value="{{ old('kategori_id', $barangku->kategori_id) }}"
            >
        </div>
        
        {{-- Input Ukuran --}}
        <div class="mb-3">
            <label for="ukuran" class="form-label">Ukuran:</label>
            <input 
                type="text" 
                name="ukuran" 
                class="form-control" 
                placeholder="Ukuran (opsional)" 
                value="{{ old('ukuran', $barangku->ukuran) }}"
            >
        </div>

        {{-- Input Kondisi (Enum) --}}
        <div class="mb-3">
            <label for="kondisi" class="form-label">Kondisi:</label>
            <select name="kondisi" class="form-control">
                @php $current_kondisi = old('kondisi', $barangku->kondisi); @endphp
                <option value="baru" {{ $current_kondisi == 'baru' ? 'selected' : '' }}>Baru</option>
                <option value="bekas bagus" {{ $current_kondisi == 'bekas bagus' ? 'selected' : '' }}>Bekas Bagus</option>
                <option value="bekas sedang" {{ $current_kondisi == 'bekas sedang' ? 'selected' : '' }}>Bekas Sedang</option>
            </select>
        </div>

        {{-- Input Harga Beli --}}
        <div class="mb-3">
            <label for="harga_beli" class="form-label">Harga Beli:</label>
            <input 
                type="number" 
                step="0.01" 
                name="harga_beli" 
                class="form-control" 
                placeholder="Harga Beli" 
                value="{{ old('harga_beli', $barangku->harga_beli) }}"
            >
        </div>

        {{-- Input Harga Jual --}}
        <div class="mb-3">
            <label for="harga_jual" class="form-label">Harga Jual:</label>
            <input 
                type="number" 
                step="0.01" 
                name="harga_jual" 
                class="form-control" 
                placeholder="Harga Jual" 
                value="{{ old('harga_jual', $barangku->harga_jual) }}"
            >
        </div>
        
        {{-- Input Stok --}}
        <div class="mb-3">
            <label for="stok" class="form-label">Stok:</label>
            <input 
                type="number" 
                name="stok" 
                class="form-control" 
                placeholder="Stok" 
                value="{{ old('stok', $barangku->stok) }}"
            >
        </div>
        
        <button type="submit" class="btn btn-success">Update Data</button>
        <a class="btn btn-primary" href="{{ route('barangku.index') }}">Batal</a>
    </form>
</div>
@endsection