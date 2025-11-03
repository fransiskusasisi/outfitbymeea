<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang;
use Barryvdh\DomPDF\Facade\Pdf;
use Yajra\DataTables\Facades\DataTables;

class LaporanController extends Controller
{
    // public function stok()
    // {
    //     $barangs = Barang::with('kategori')->get();
    //     return view('pages.laporan.stok', compact('barangs'));
    // }
    public function stok(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(Barang::query()->orderBy('barang_id', 'desc'))
                ->addIndexColumn()
                ->editColumn('barang_id', function ($row) {
                    return 'BRG-' . $row->barang_id;
                })
                ->editColumn('kategori_id', function ($row) {
                    return $row->kategori->nama;
                })
                ->editColumn('harga_jual', function ($row) {
                    return formatRupiah($row->harga_jual);
                })
                ->toJson();
            // ->make(true);
        }
        return view('pages.laporan.stok');
    }

    public function cetakStok()
    {
        $barangs = Barang::with('kategori')->get();

        $pdf = Pdf::loadView('pages.laporan.cetak-stok', compact('barangs'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('laporan-stok.pdf');
    }
}