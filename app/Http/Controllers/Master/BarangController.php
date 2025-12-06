<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Barang::with('kategori')
                ->join('kategori', 'barang.kategori_id', '=', 'kategori.kategori_id')
                ->select('barang.*', 'kategori.nama as kategori_nama');
            $data = DataTables::of($query)
                ->addIndexColumn()
                ->orderColumn('kategori_nama', 'kategori.nama $1')
                ->editColumn('kode_barang', function ($row) {
                    return $row->kode_barang ?? '-';
                })
                ->editColumn('kategori_id', function ($row) {
                    return $row->kategori->nama;
                })
                ->editColumn('kondisi', function ($row) {
                    return ucwords($row->kondisi);
                });

            if (role() === 'pemilik') {
                $data->addColumn('action', function ($row) {
                    $btnEdit = '<div><a href="' . route('pemilik.barang.edit', $row->barang_id) . '" class="btn-kuning">' . iconEdit() . 'Edit</a></div>';
                    $btnHapus = '<div><form id="delete-form-' . $row->barang_id . '" action="' . route('pemilik.barang.destroy', $row->barang_id) . '" method="POST" style="display:inline;">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="button" onclick="deleteBarang(' . $row->barang_id . ')" class="btn-merah">' . iconHapus() . 'Hapus</button>
                        </form></div>';
                    return '<div class="flex space-x-2 justify-center">' . $btnEdit . $btnHapus . '</div>';
                });
                $data->rawColumns(['action']);
            }

            if (role() === 'petugas_gudang') {
                $data->addColumn('action', function ($row) {
                    $btnEdit = '<div><a href="' . route('gudang.barang.edit', $row->barang_id) . '" class="btn-kuning">' . iconEdit() . 'Edit</a></div>';
                    $btnHapus = '<div><form id="delete-form-' . $row->barang_id . '" action="' . route('gudang.barang.destroy', $row->barang_id) . '" method="POST" style="display:inline;">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="button" onclick="deleteBarang(' . $row->barang_id . ')" class="btn-merah">' . iconHapus() . 'Hapus</button>
                        </form></div>';
                    return '<div class="flex space-x-2 justify-center">' . $btnEdit . $btnHapus . '</div>';
                });
                $data->rawColumns(['action', 'gambar']);
            }

            return $data->toJson();
        }
        return view('pages.barang.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = Kategori::all();
        return view('pages.barang.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori,kategori_id',
            'ukuran' => 'required|string|in:S,M,L,XL',
            'kondisi' => 'required|in:bekas bagus,bekas sedang',
            'stok' => 'required|integer|min:0',
        ]);

        $simpan = Barang::create([
            'nama_barang' => $request->nama_barang,
            'kode_barang' => $request->kode_barang,
            'kategori_id' => $request->kategori_id,
            'ukuran' => $request->ukuran,
            'kondisi' => $request->kondisi,
            'stok' => $request->stok,
        ]);

        if ($simpan) {
            session()->flash('berhasil', 'Barang berhasil ditambahkan!');
            if (role() === 'pemilik') {
                return redirect()->route('pemilik.barang.index');
            } elseif (role() === 'petugas_gudang') {
                return redirect()->route('gudang.barang.index');
            }
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan barang!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        $kategori = Kategori::all();
        return view('pages.barang.edit', compact('barang', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori,kategori_id',
            'ukuran' => 'required|string|max:50',
            'kondisi' => 'required|in:bekas bagus,bekas sedang',
            'stok' => 'required|integer|min:0',
        ]);

        $barang = Barang::findOrFail($id);
        $update = $barang->update([
            'nama_barang' => $request->nama_barang,
            'kode_barang' => $request->kode_barang,
            'kategori_id' => $request->kategori_id,
            'ukuran' => $request->ukuran,
            'kondisi' => $request->kondisi,
            'stok' => $request->stok,
        ]);

        if ($update) {
            session()->flash('berhasil', 'Barang berhasil diperbarui!');
            if (role() === 'pemilik') {
                return redirect()->route('pemilik.barang.index');
            } elseif (role() === 'petugas_gudang') {
                return redirect()->route('gudang.barang.index');
            }
        } else {
            return redirect()->back();
        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $hapus = $barang->delete();
        if ($hapus) {
            session()->flash('berhasil', 'Barang berhasil dihapus!');
            if (role() === 'pemilik') {
                return redirect()->route('pemilik.barang.index');
            } elseif (role() === 'petugas_gudang') {
                return redirect()->route('gudang.barang.index');
            }
        } else {
            return redirect()->back();
        }
    }

    public function getStok($id)
    {
        $barang = Barang::find($id);

        if (!$barang) {
            return response()->json([
                'success' => false,
                'message' => 'Barang tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'stok' => (int) $barang->stok
        ]);
    }
}