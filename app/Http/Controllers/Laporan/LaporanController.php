<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function stok()
    {
        $barangs = Barang::with('kategori')->get();
        return view('pemilik.laporan.stok', compact('barangs'));
    }

    public function cetakStok()
    {
        $barangs = Barang::with('kategori')->get();

        $pdf = Pdf::loadView('pemilik.laporan.cetak-stok', compact('barangs'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('laporan-stok.pdf');
    }
}
