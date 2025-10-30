<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;
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
                    $btnEdit = '<a href="#" class="btn-kuning">Edit</a>';
                    $btnHapus = '<a href="#" class="btn-merah">Hapus</a>';
                    return  '<div class="flex space-x-2 justify-center">' .  $btnEdit . $btnHapus . '</div>';
                })
                ->rawColumns(['action'])
                ->toJson();
            // ->make(true);
        }
        return view('pemilik.barangmasuk.index');
    }
}
