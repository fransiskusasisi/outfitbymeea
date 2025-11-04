<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class BarangKeluarController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DataTables::of(BarangKeluar::query()->orderBy('keluar_id', 'desc'))
                ->addIndexColumn()
                ->editColumn('keluar_id', function ($row) {
                    return $row->barang_id;
                })
                ->editColumn('barang_id', function ($row) {
                    return $row->barang->nama_barang;
                })
                ->editColumn('tanggal', function ($row) {
                    return formatTanggal($row->tanggal);
                })
                ->editColumn('user_id', function ($row) {
                    return $row->user->nama;
                });

            if (role() === 'pemilik') {
                $data->addColumn('action', function ($row) {
                    $btnEdit = '<div><a href="' . route('pemilik.barangkeluar.edit', $row->keluar_id) . '" class="btn-kuning">' . iconEdit() . 'Edit</a></div>';
                    $btnHapus = '<div><form id="delete-form-' . $row->keluar_id . '" action="' . route('pemilik.barangkeluar.destroy', $row->keluar_id) . '" method="POST" style="display:inline;">
                    ' . csrf_field() . '
                    ' . method_field('DELETE') . '
                    <button type="button" onclick="deleteBarangKeluar(' . $row->keluar_id . ')" class="btn-merah">' . iconHapus() . 'Hapus</span>
                    </button>
                    </form></div>';
                    return  '<div class="flex space-x-2 justify-center">' .  $btnEdit . $btnHapus . '</div>';
                });
                $data->rawColumns(['action']);
            };

            if (role() === 'petugas_gudang') {
                $data->addColumn('action', function ($row) {
                    $btnEdit = '<div><a href="' . route('gudang.barangkeluar.edit', $row->keluar_id) . '" class="btn-kuning">' . iconEdit() . 'Edit</a></div>';
                    $btnHapus = '<div><form id="delete-form-' . $row->keluar_id . '" action="' . route('gudang.barangkeluar.destroy', $row->keluar_id) . '" method="POST" style="display:inline;">
                    ' . csrf_field() . '
                    ' . method_field('DELETE') . '
                    <button type="button" onclick="deleteBarangKeluar(' . $row->keluar_id . ')" class="btn-merah">' . iconHapus() . 'Hapus</span>
                    </button>
                    </form></div>';
                    return  '<div class="flex space-x-2 justify-center">' .  $btnEdit . $btnHapus . '</div>';
                });
                $data->rawColumns(['action']);
            };

            if (role() === 'kasir') {
                $data->addColumn('action', function ($row) {
                    $btnEdit = '<div><a href="' . route('kasir.barangkeluar.edit', $row->keluar_id) . '" class="btn-kuning">' . iconEdit() . 'Edit</a></div>';

                    $btnHapus = '<div><form id="delete-form-' . $row->keluar_id . '" action="' . route('kasir.barangkeluar.destroy', $row->keluar_id) . '" method="POST" style="display:inline;">
                    ' . csrf_field() . '
                    ' . method_field('DELETE') . '
                    <button type="button" onclick="deleteBarangKeluar(' . $row->keluar_id . ')" class="btn-merah">' . iconHapus() . 'Hapus</span>
                    </button>
                    </form></div>';

                    return  '<div class="flex space-x-2 justify-center">' .  $btnEdit . $btnHapus . '</div>';
                });
                $data->rawColumns(['action']);
            };

            return $data->toJson();
        }
        return view('pages.barangkeluar.index');
    }

    public function create()
    {
        $barang = Barang::orderBy('nama_barang', 'asc')->get();
        return view('pages.barangkeluar.create', compact('barang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barang,barang_id',
            'jumlah' => 'required|integer|min:1',
            'tanggal' => 'required|date',
        ]);

        $updateBarang = Barang::find($request->barang_id);
        $stokBarang = $updateBarang->stok;
        if ($stokBarang - $request->jumlah < 0) {
            session()->flash('gagal', 'Stok barang tidak cukup!, Sisa stok: ' . $stokBarang);
            return redirect()->back();
        }
        $updateBarang->stok -= $request->jumlah;
        $updateBarang->save();

        $user = Auth::user()->user_id;
        $simpan = BarangKeluar::create([
            'barang_id' => $request->barang_id,
            'jumlah' => $request->jumlah,
            'tanggal' => $request->tanggal,
            'user_id' => $user,
        ]);

        if ($simpan) {
            session()->flash('berhasil', 'Barang keluar berhasil ditambahkan!');
            if (role() === 'pemilik') {
                return redirect()->route('pemilik.barangkeluar.index');
            } elseif (role() === 'petugas_gudang') {
                return redirect()->route('gudang.barangkeluar.index');
            } elseif (role() === 'kasir') {
                return redirect()->route('kasir.barangkeluar.index');
            }
        } else {
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $barangkeluar = BarangKeluar::findOrFail($id);
        $barang = Barang::all();
        return view('pages.barangkeluar.edit', compact('barangkeluar', 'barang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'barang_id' => 'required|exists:barang,barang_id',
            'jumlah' => 'required|integer|min:1',
            'tanggal' => 'required|date',
        ]);

        $barangkeluar = BarangKeluar::findOrFail($id);
        $update = $barangkeluar->update([
            'barang_id' => $request->barang_id,
            'jumlah' => $request->jumlah,
            'tanggal' => $request->tanggal,
        ]);

        if ($update) {
            session()->flash('berhasil', 'Barang keluar berhasil diperbarui!');
            if (role() === 'pemilik') {
                return redirect()->route('pemilik.barangkeluar.index');
            } elseif (role() === 'petugas_gudang') {
                return redirect()->route('gudang.barangkeluar.index');
            } elseif (role() === 'kasir') {
                return redirect()->route('kasir.barangkeluar.index');
            }
        } else {
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        $barangkeluar = BarangKeluar::findOrFail($id);
        $hapus = $barangkeluar->delete();

        if ($hapus) {
            session()->flash('berhasil', 'Barang keluar berhasil dihapus!');
            if (role() === 'pemilik') {
                return redirect()->route('pemilik.barangkeluar.index');
            } elseif (role() === 'petugas_gudang') {
                return redirect()->route('gudang.barangkeluar.index');
            } elseif (role() === 'kasir') {
                return redirect()->route('kasir.barangkeluar.index');
            }
        } else {
            return redirect()->back();
        }
    }
}
