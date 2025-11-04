@extends('layouts.app') 

@section('content')
<div class="container">
    <h2>Daftar Barangku</h2>
    <a href="{{ route('barangku.create') }}" class="btn btn-primary mb-3">Tambah Barang Baru</a>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">{{ $message }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Kondisi</th>
                <th>Harga Jual</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barang as $item)
            <tr>
                <td>{{ $item->barang_id }}</td>
                <td>{{ $item->nama_barang }}</td>
                <td>{{ $item->kondisi }}</td>
                <td>Rp {{ number_format($item->harga_jual, 0, ',', '.') }}</td>
                <td>
                    {{-- Menggunakan $item->barang_id karena itu primary key-nya --}}
                    <form action="{{ route('barangku.destroy', $item->barang_id) }}" method="POST">
                        <a class="btn btn-info btn-sm" href="{{ route('barangku.show', $item->barang_id) }}">Show</a>
                        <a class="btn btn-primary btn-sm" href="{{ route('barangku.edit', $item->barang_id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $barang->links() }}
</div>
@endsection