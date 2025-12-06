<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class KategoriController extends Controller
{
    public function index(Request $request)
    {
        $role = Auth::user()->role;
        if ($request->ajax()) {
            $data = DataTables::of(Kategori::query()->orderBy('kategori_id', 'desc'))
                ->addIndexColumn()
                ->editColumn('kategori_id', function ($row) {
                    return $row->kategori_id;
                });

            if ($role === 'pemilik') {
                $data->addColumn('action', function ($row) {
                    $btnEdit = '<div><a href="' . route('pemilik.kategori.edit', $row->kategori_id) . '" class="btn-kuning">' . iconEdit() . 'Edit</a></div>';

                    $btnHapus = '<div><form id="delete-form-' . $row->kategori_id . '" action="' . route('pemilik.kategori.destroy', $row->kategori_id) . '" method="POST" style="display:inline;">
                    ' . csrf_field() . '
                    ' . method_field('DELETE') . '
                    <button type="button" onclick="deleteKategori(' . $row->kategori_id . ')" class="btn-merah">' . iconHapus() . 'Hapus</span>
                    </button>
                    </form></div>';
                    return '<div class="flex space-x-2 justify-center">' . $btnEdit . $btnHapus . '</div>';
                });
                $data->rawColumns(['action']);
            }

            if ($role === 'petugas_gudang') {
                $data->addColumn('action', function ($row) {
                    $btnEdit = '<div><a href="' . route('gudang.kategori.edit', $row->kategori_id) . '" class="btn-kuning">' . iconEdit() . 'Edit</a></div>';

                    $btnHapus = '<div><form id="delete-form-' . $row->kategori_id . '" action="' . route('gudang.kategori.destroy', $row->kategori_id) . '" method="POST" style="display:inline;">
                    ' . csrf_field() . '
                    ' . method_field('DELETE') . '
                    <button type="button" onclick="deleteKategori(' . $row->kategori_id . ')" class="btn-merah">' . iconHapus() . 'Hapus</span>
                    </button>
                    </form></div>';
                    return '<div class="flex space-x-2 justify-center">' . $btnEdit . $btnHapus . '</div>';
                });
                $data->rawColumns(['action']);
            }
            return $data->toJson();
        }
        return view('pages.kategori.index');
    }

    public function create()
    {
        return view('pages.kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $simpan = Kategori::create([
            'nama' => $request->nama,
        ]);

        if ($simpan) {
            session()->flash('berhasil', 'Kategori berhasil ditambahkan!');
            if (role() === 'pemilik') {
                return redirect()->route('pemilik.kategori.index');
            } elseif (role() === 'petugas_gudang') {
                return redirect()->route('gudang.kategori.index');
            }
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan kategori!');
        }
    }

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('pages.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $kategori_id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $kategori = Kategori::findOrFail($kategori_id);
        $update = $kategori->update([
            'nama' => $request->nama,
        ]);

        if ($update) {
            session()->flash('berhasil', 'Kategori berhasil diperbarui!');
            if (role() === 'pemilik') {
                return redirect()->route('pemilik.kategori.index');
            } elseif (role() === 'petugas_gudang') {
                return redirect()->route('gudang.kategori.index');
            }
        } else {
            return redirect()->back();
        }
    }

    public function destroy($kategori_id)
    {
        $kategori = Kategori::findOrFail($kategori_id);
        $hapus = $kategori->delete();

        if ($hapus) {
            session()->flash('berhasil', 'Kategori berhasil dihapus!');
            if (role() === 'pemilik') {
                return redirect()->route('pemilik.kategori.index');
            } elseif (role() === 'petugas_gudang') {
                return redirect()->route('gudang.kategori.index');
            }
        } else {
            return redirect()->back();
        }
    }
}