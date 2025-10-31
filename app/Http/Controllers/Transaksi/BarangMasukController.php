<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class BarangMasukController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(BarangMasuk::query()->orderBy('masuk_id', 'desc'))
                ->addIndexColumn()
                ->editColumn('masuk_id', function ($row) {
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
                    $btnEdit = '<div><a href="' . route('barangmasuk.edit', $row->masuk_id) . '" class="btn-kuning">' . iconEdit() . 'Edit</a></div>';
                    $btnHapus = '<div><form id="delete-form-' . $row->masuk_id . '" action="' . route('barangmasuk.destroy', $row->masuk_id) . '" method="POST" style="display:inline;">
                    ' . csrf_field() . '
                    ' . method_field('DELETE') . '
                    <button type="button" onclick="deleteBarangMasuk(' . $row->masuk_id . ')" class="btn-merah">' . iconHapus() . 'Hapus</span>
                    </button>
                    </form></div>';
                    return  '<div class="flex space-x-2 justify-center">' .  $btnEdit . $btnHapus . '</div>';
                })
                ->rawColumns(['action'])
                ->toJson();
            // ->make(true);
        }
        return view('pemilik.barangmasuk.index');
    }

    public function create()
    {
        $barang = Barang::all();
        return view('pemilik.barangmasuk.create', compact('barang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barang,barang_id',
            'jumlah' => 'required|integer|min:1',
            'tanggal' => 'required|date',
        ]);

        $user = Auth::user()->user_id;
        $simpan = BarangMasuk::create([
            'barang_id' => $request->barang_id,
            'jumlah' => $request->jumlah,
            'tanggal' => $request->tanggal,
            'user_id' => $user,
        ]);

        if ($simpan) {
            session()->flash('berhasil', 'Barang masuk berhasil ditambahkan!');
            return redirect()->route('barangmasuk.index');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan barang!');
        }
    }

    public function edit($id)
    {
        $barangmasuk = BarangMasuk::findOrFail($id);
        $barang = Barang::all();
        return view('pemilik.barangmasuk.edit', compact('barangmasuk', 'barang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'barang_id' => 'required|exists:barang,barang_id',
            'jumlah' => 'required|integer|min:1',
            'tanggal' => 'required|date',
        ]);

        $barangmasuk = BarangMasuk::findOrFail($id);
        $update = $barangmasuk->update([
            'barang_id' => $request->barang_id,
            'jumlah' => $request->jumlah,
            'tanggal' => $request->tanggal,
        ]);

        if ($update) {
            session()->flash('berhasil', 'Barang masuk berhasil diperbarui!');
            return redirect()->route('barangmasuk.index');
        } else {
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        $barangmasuk = BarangMasuk::findOrFail($id);
        $hapus = $barangmasuk->delete();

        if ($hapus) {
            session()->flash('berhasil', 'Barang masuk berhasil dihapus!');
            return redirect()->route('barangmasuk.index');
        } else {
            return redirect()->back();
        }
    }
}
