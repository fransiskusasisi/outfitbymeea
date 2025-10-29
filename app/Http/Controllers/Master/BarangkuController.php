<?php

namespace App\Http\Controllers\Master; // Sesuaikan namespace karena ada di folder Master

use App\Http\Controllers\Controller;
use App\Models\Barangku; // Import Model Barangku
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BarangkuController extends Controller
{
    // READ (Index)
    public function index()
    {
        $barang = Barangku::latest()->paginate(10);
        return view('barang.index', compact('barang'));
    }

    // CREATE (Form)
    public function create()
    {
        // Ubah pemanggilan view menjadi 'barangku.index'
        return view('barangku.index', compact('barang'));
    }

    // CREATE (Store Data)
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_barang' => 'required|string|max:150',
            'kategori_id' => 'nullable|integer',
            'kondisi' => 'required|in:baru,bekas bagus,bekas sedang',
            'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            // 'ukuran' tidak required karena di DB nullable
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Barangku::create($request->all());

        return redirect()->route('barangku.index')
            ->with('success', 'Barang berhasil ditambahkan.');
    }

    // READ (Show Detail)
    public function show(Barangku $barangku)
    {
        // Ubah pemanggilan view menjadi 'barangku.index'
        return view('barangku.index', compact('barang'));
    }

    // UPDATE (Form Edit)
    public function edit(Barangku $barangku)
    {
        // Ubah pemanggilan view menjadi 'barangku.index'
        return view('barangku.index', compact('barang'));
    }

    // UPDATE (Update Data)
    public function update(Request $request, Barangku $barangku)
    {
        // Validasi yang sama seperti di store
        $validator = Validator::make($request->all(), [
            'nama_barang' => 'required|string|max:150',
            'kategori_id' => 'nullable|integer',
            'kondisi' => 'required|in:baru,bekas bagus,bekas sedang',
            'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $barangku->update($request->all());

        return redirect()->route('barangku.index')
            ->with('success', 'Barang berhasil diperbarui.');
    }

    // DELETE (Destroy)
    public function destroy(Barangku $barangku)
    {
        $barangku->delete();

        return redirect()->route('barangku.index')
            ->with('success', 'Barang berhasil dihapus.');
    }
}