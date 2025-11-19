<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class BarangMasukController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = BarangMasuk::query()
                ->join('barang', 'barang_masuk.barang_id', '=', 'barang.barang_id')
                ->orderBy('barang.nama_barang', 'asc')
                ->select('barang_masuk.*');
            $data = DataTables::of($query)
                ->addIndexColumn()
                ->editColumn('masuk_id', function ($row) {
                    return $row->barang_id;
                })
                ->editColumn('gambar', function ($row) {
                    $imgSrc = $row->gambar
                        ? asset('storage/images/barang/' . $row->gambar)
                        : asset('images/no-img.jpg');

                    return '<div class="w-12 h-12">
                        <img class="w-full h-full object-cover shadow-md rounded-md" src="' . $imgSrc . '" alt="' . $row->barang->nama_barang . '">
                        </div>';
                })
                ->editColumn('barang_id', function ($row) {
                    return $row->barang->nama_barang;
                })
                ->editColumn('kode_barang', function ($row) {
                    return $row->barang->kode_barang ?? '-';
                })
                ->editColumn('ukuran', function ($row) {
                    return $row->barang->ukuran ?? '-';
                })
                ->editColumn('kondisi', function ($row) {
                    return ucwords($row->barang->kondisi) ?? '-';
                })
                ->editColumn('tanggal', function ($row) {
                    return formatTanggal($row->tanggal);
                })
                ->editColumn('user_id', function ($row) {
                    return $row->user->nama;
                })
                ->editColumn('harga_jual', function ($row) {
                    return formatRupiah($row->harga_jual);
                });

            if (role() === 'pemilik') {
                $data->addColumn('action', function ($row) {
                    $btnEdit = '<div><a href="' . route('pemilik.barangmasuk.edit', $row->masuk_id) . '" class="btn-kuning">' . iconEdit() . 'Edit</a></div>';
                    $btnHapus = '<div><form id="delete-form-' . $row->masuk_id . '" action="' . route('pemilik.barangmasuk.destroy', $row->masuk_id) . '" method="POST" style="display:inline;">
                    ' . csrf_field() . '
                    ' . method_field('DELETE') . '
                    <button type="button" onclick="deleteBarangMasuk(' . $row->masuk_id . ')" class="btn-merah">' . iconHapus() . 'Hapus</span>
                    </button>
                    </form></div>';
                    return  '<div class="flex space-x-2 justify-center">' .  $btnEdit . $btnHapus . '</div>';
                });
                $data->rawColumns(['action']);
            };

            if (role() === 'petugas_gudang') {
                $data->addColumn('action', function ($row) {
                    $btnEdit = '<div><a href="' . route('gudang.barangmasuk.edit', $row->masuk_id) . '" class="btn-kuning">' . iconEdit() . 'Edit</a></div>';
                    $btnHapus = '<div><form id="delete-form-' . $row->masuk_id . '" action="' . route('gudang.barangmasuk.destroy', $row->masuk_id) . '" method="POST" style="display:inline;">
                    ' . csrf_field() . '
                    ' . method_field('DELETE') . '
                    <button type="button" onclick="deleteBarangMasuk(' . $row->masuk_id . ')" class="btn-merah">' . iconHapus() . 'Hapus</span>
                    </button>
                    </form></div>';
                    return  '<div class="flex space-x-1 justify-center">' .  $btnEdit . $btnHapus . '</div>';
                });
                $data->rawColumns(['action', 'gambar']);
            };

            // if (role() === 'kasir') {
            //     $data->addColumn('action', function ($row) {
            //         $btnEdit = '<div><a href="' . route('kasir.barangmasuk.edit', $row->masuk_id) . '" class="btn-kuning">' . iconEdit() . 'Edit</a></div>';
            //         return  '<div class="flex space-x-2 justify-center">' .  $btnEdit .  '</div>';
            //     });
            //     $data->rawColumns(['action']);
            // };

            return $data->toJson();
        }
        return view('pages.barangmasuk.index');
    }

    public function create()
    {
        $barang = Barang::orderBy('nama_barang', 'asc')->get();
        return view('pages.barangmasuk.create', compact('barang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barang,barang_id',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'harga_jual' => 'required|numeric|min:0',
            'jumlah' => 'required|integer|min:1',
            'tanggal' => 'required|date',
        ]);

        // $updateBarang = Barang::find($request->barang_id);
        // $updateBarang->stok += $request->jumlah;
        // $updateBarang->save();

        $user = Auth::user()->user_id;
        $simpan = BarangMasuk::create([
            'barang_id' => $request->barang_id,
            'harga_jual' => $request->harga_jual,
            'jumlah' => $request->jumlah,
            'tanggal' => $request->tanggal,
            'user_id' => $user,
        ]);

        $barangIni = Barang::find($request->barang_id);
        if ($request->file('gambar')) {
            $gambar = $request->file('gambar');
            $namaGambar = $simpan->masuk_id . '-' . $barangIni->nama_barang . '-' . time() . '.' . $gambar->getClientOriginalExtension();
            $gambar->storeAs('public/images/barang', $namaGambar);

            $simpanGambar = BarangMasuk::findOrFail($simpan->masuk_id);
            $simpanGambar->gambar = $namaGambar;
            $simpanGambar->save();
        }

        if ($simpan) {
            session()->flash('berhasil', 'Barang masuk berhasil ditambahkan!');
            if (role() === 'pemilik') {
                return redirect()->route('pemilik.barangmasuk.index');
            } elseif (role() === 'petugas_gudang') {
                return redirect()->route('gudang.barangmasuk.index');
            } elseif (role() === 'kasir') {
                return redirect()->route('kasir.barangmasuk.index');
            }
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan barang!');
        }
    }

    public function edit($id)
    {
        $barangmasuk = BarangMasuk::findOrFail($id);
        $barang = Barang::all();
        return view('pages.barangmasuk.edit', compact('barangmasuk', 'barang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'barang_id' => 'required|exists:barang,barang_id',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'harga_jual' => 'required|numeric|min:0',
            'jumlah' => 'required|integer|min:1',
            'tanggal' => 'required|date',
        ]);

        $barangmasuk = BarangMasuk::findOrFail($id);
        $update = $barangmasuk->update([
            'barang_id' => $request->barang_id,
            'jumlah' => $request->jumlah,
            'harga_jual' => $request->harga_jual,
            'tanggal' => $request->tanggal,
        ]);

        $barangIni = Barang::find($request->barang_id);
        if ($request->hasFile('gambar')) {
            if ($barangmasuk->gambar) {
                Storage::delete('public/images/barang/' . $barangmasuk->gambar);
            }
            $gambar = $request->file('gambar');
            $namaGambar = $id . '-' . $barangIni->nama_barang . '-' . time() . '.' . $gambar->getClientOriginalExtension();
            $gambar->storeAs('public/images/barang', $namaGambar);
            $barangmasuk->gambar = $namaGambar;
            $barangmasuk->save();
        }

        if ($update) {
            session()->flash('berhasil', 'Barang masuk berhasil diperbarui!');
            if (role() === 'pemilik') {
                return redirect()->route('pemilik.barangmasuk.index');
            } elseif (role() === 'petugas_gudang') {
                return redirect()->route('gudang.barangmasuk.index');
            } elseif (role() === 'kasir') {
                return redirect()->route('kasir.barangmasuk.index');
            }
        } else {
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        $barangmasuk = BarangMasuk::findOrFail($id);
        if ($barangmasuk->gambar) {
            Storage::delete('public/images/barang/' . $barangmasuk->gambar);
        }
        $hapus = $barangmasuk->delete();

        if ($hapus) {
            session()->flash('berhasil', 'Barang masuk berhasil dihapus!');
            if (role() === 'pemilik') {
                return redirect()->route('pemilik.barangmasuk.index');
            } elseif (role() === 'petugas_gudang') {
                return redirect()->route('gudang.barangmasuk.index');
            } elseif (role() === 'kasir') {
                return redirect()->route('kasir.barangmasuk.index');
            }
        } else {
            return redirect()->back();
        }
    }
}