<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JenisBarang;

class JenisBarangController extends Controller
{
    /**
     * Tampilkan semua jenis barang
     */
    public function index()
    {
        $jenisbarangs = JenisBarang::all();
        return view('pemilik.jenisbarang.index', compact('jenisbarangs'));
    }

    /**
     * Form tambah jenis barang
     */
    public function create()
    {
        return view('pemilik.jenisbarang.create');
    }

    /**
     * Simpan jenis barang baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_jenis' => 'required|string|max:255',
        ]);

        JenisBarang::create([
            'nama_jenis' => $request->nama_jenis,
        ]);

        return redirect()->route('jenisbarang.index')->with('success', 'Jenis barang berhasil ditambahkan!');
    }

    /**
     * Form edit jenis barang
     */
    public function edit($id_jenis)
    {
        $jenisbarang = JenisBarang::findOrFail($id_jenis);
        return view('pemilik.jenisbarang.edit', compact('jenisbarang'));
    }

    /**
     * Update jenis barang
     */
    public function update(Request $request, $id_jenis)
    {
        $request->validate([
            'nama_jenis' => 'required|string|max:255',
        ]);

        $jenisbarang = JenisBarang::findOrFail($id_jenis);
        $jenisbarang->update([
            'nama_jenis' => $request->nama_jenis,
        ]);

        return redirect()->route('jenisbarang.index')->with('success', 'Jenis barang berhasil diperbarui!');
    }

    /**
     * Hapus jenis barang
     */
    public function destroy($id_jenis)
    {
        $jenisbarang = JenisBarang::findOrFail($id_jenis);
        $jenisbarang->delete();

        return redirect()->route('jenisbarang.index')->with('success', 'Jenis barang berhasil dihapus!');
    }
}
