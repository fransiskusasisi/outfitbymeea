<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;
use Yajra\DataTables\Facades\DataTables;

class KategoriController extends Controller
{
    /**
     * Tampilkan semua kategori
     */
    // public function index()
    // {
    //     $kategoris = Kategori::all();
    //     return view('pemilik.kategori.index', compact('kategoris'));
    // }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(Kategori::query()->orderBy('kategori_id', 'desc'))
                ->addIndexColumn()
                ->editColumn('kategori_id', function ($row) {
                    return 'KTGR-' . $row->kategori_id;
                })
                ->addColumn('action', function ($row) {
                    $btnEdit = '<a class="btn-kuning">Edit</a>';
                    $btnHapus = '<a class="btn-merah">Hapus</a>';
                    return  '<div class="flex space-x-2 justify-center">' .  $btnEdit . $btnHapus . '</div>';
                })
                ->rawColumns(['action'])
                ->toJson();
            // ->make(true);
        }
        return view('pemilik.kategori.index');
    }

    /**
     * Form tambah kategori
     */
    public function create()
    {
        return view('pemilik.kategori.create');
    }

    /**
     * Simpan kategori baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    /**
     * Form edit kategori
     */
    public function edit($id_kategori)
    {
        $kategori = Kategori::findOrFail($id_kategori);
        return view('pemilik.kategori.edit', compact('kategori'));
    }

    /**
     * Update kategori
     */
    public function update(Request $request, $id_kategori)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        $kategori = Kategori::findOrFail($id_kategori);
        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    /**
     * Hapus kategori
     */
    public function destroy($id_kategori)
    {
        $kategori = Kategori::findOrFail($id_kategori);
        $kategori->delete();

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus!');
    }
}