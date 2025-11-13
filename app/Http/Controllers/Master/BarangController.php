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
            $data = DataTables::of(Barang::query()->orderBy('barang_id', 'desc'))
                ->addIndexColumn()
                ->editColumn('barang_id', function ($row) {
                    return 'BRG-' . $row->barang_id;
                })
                ->editColumn('gambar', function ($row) {
                    $imgSrc = $row->gambar
                        ? asset('storage/images/barang/' . $row->gambar)
                        : asset('images/no-img.jpg');

                    return '<div class="w-12 h-12">
                        <img class="w-full h-full object-cover shadow-md rounded-md" src="' . $imgSrc . '" alt="' . $row->nama_barang . '">
                        </div>';
                })

                ->editColumn('kategori_id', function ($row) {
                    return $row->kategori->nama;
                })
                ->editColumn('kondisi', function ($row) {
                    return ucfirst($row->kondisi);
                })
                ->editColumn('harga_jual', function ($row) {
                    return formatRupiah($row->harga_jual);
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
            'kategori_id' => 'required|exists:kategori,kategori_id',
            'ukuran' => 'required|string|max:50',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'kondisi' => 'required|in:bekas bagus,bekas sedang',
            'harga_jual' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
        ]);

        $simpan = Barang::create([
            'nama_barang' => $request->nama_barang,
            'kategori_id' => $request->kategori_id,
            'ukuran' => $request->ukuran,
            'kondisi' => $request->kondisi,
            'harga_jual' => $request->harga_jual,
            'stok' => $request->stok,
        ]);

        if ($request->file('gambar')) {
            $gambar = $request->file('gambar');
            $namaGambar = $simpan->barang_id . '-' . $request->nama_barang . '-' . time() . '.' . $gambar->getClientOriginalExtension();
            $gambar->storeAs('public/images/barang', $namaGambar);

            $simpanGambar = Barang::findOrFail($simpan->barang_id);
            $simpanGambar->gambar = $namaGambar;
            $simpanGambar->save();
        }

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
        // dd($request->all());
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori,kategori_id',
            'ukuran' => 'required|string|max:50',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'kondisi' => 'required|in:bekas bagus,bekas sedang',
            'harga_jual' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
        ]);

        $barang = Barang::findOrFail($id);
        $update = $barang->update([
            'nama_barang' => $request->nama_barang,
            'kategori_id' => $request->kategori_id,
            'ukuran' => $request->ukuran,
            'kondisi' => $request->kondisi,
            'harga_jual' => $request->harga_jual,
            'stok' => $request->stok,
        ]);

        if ($request->hasFile('gambar')) {
            if ($barang->gambar) {
                Storage::delete('public/images/barang/' . $barang->gambar);
            }
            $gambar = $request->file('gambar');
            $namaGambar = $barang->barang_id . '-' . $request->nama_barang . '-' . time() . '.' . $gambar->getClientOriginalExtension();
            $gambar->storeAs('public/images/barang', $namaGambar);
            $barang->gambar = $namaGambar;
            $barang->save();
        }

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

        if ($barang->gambar) {
            Storage::delete('public/images/barang/' . $barang->gambar);
        }
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
}