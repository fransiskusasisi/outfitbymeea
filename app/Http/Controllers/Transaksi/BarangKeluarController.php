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
            return DataTables::of(BarangKeluar::query()->orderBy('keluar_id', 'desc'))
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
                })
                ->addColumn('action', function ($row) {
                    $btnEdit = '<div><a href="' . route('barangkeluar.edit', $row->keluar_id) . '" class="btn-kuning">' . iconEdit() . 'Edit</a></div>';
                    $btnHapus = '<div><form id="delete-form-' . $row->keluar_id . '" action="' . route('barangkeluar.destroy', $row->keluar_id) . '" method="POST" style="display:inline;">
                    ' . csrf_field() . '
                    ' . method_field('DELETE') . '
                    <button type="button" onclick="deleteBarangKeluar(' . $row->keluar_id . ')" class="btn-merah">' . iconHapus() . 'Hapus</span>
                    </button>
                    </form></div>';
                    return  '<div class="flex space-x-2 justify-center">' .  $btnEdit . $btnHapus . '</div>';
                })
                ->rawColumns(['action'])
                ->toJson();
            // ->make(true);
        }
        return view('pemilik.barangkeluar.index');
    }

    public function create()
    {
        $barang = Barang::orderBy('nama_barang', 'asc')->get();
        return view('pemilik.barangkeluar.create', compact('barang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barang,barang_id',
            'jumlah' => 'required|integer|min:1',
            'tanggal' => 'required|date',
        ]);

        $user = Auth::user()->user_id;
        $simpan = BarangKeluar::create([
            'barang_id' => $request->barang_id,
            'jumlah' => $request->jumlah,
            'tanggal' => $request->tanggal,
            'user_id' => $user,
        ]);

        if ($simpan) {
            session()->flash('berhasil', 'Barang keluar berhasil ditambahkan!');
            return redirect()->route('barangkeluar.index');
        } else {
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $barangkeluar = BarangKeluar::findOrFail($id);
        $barang = Barang::all();
        return view('pemilik.barangkeluar.edit', compact('barangkeluar', 'barang'));
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
            return redirect()->route('barangkeluar.index');
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
            return redirect()->route('barangkeluar.index');
        } else {
            return redirect()->back();
        }
    }
}
