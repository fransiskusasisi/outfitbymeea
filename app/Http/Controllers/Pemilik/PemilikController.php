<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\Barangku;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;

class PemilikController extends Controller
{
    /**
     * Dashboard Pemilik (Read-Only View)
     */
    public function dashboard(Request $request)
    {
        // Ambil hanya 5 data barang beserta kategori
        $stok = Barang::with('kategori')
            ->latest('created_at')
            ->take(5)
            ->get();

        $totalBarangMasuk = BarangMasuk::count();
        $totalBarangKeluar = BarangKeluar::count();

        // Mengirim data ke view
        return view('dashboard.pemilik', compact('stok', 'totalBarangMasuk', 'totalBarangKeluar'));
    }
}