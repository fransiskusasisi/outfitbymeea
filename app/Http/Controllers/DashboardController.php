<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil hanya 5 data barang beserta kategori
        $stok = Barang::with('kategori')
            ->latest('created_at')
            ->take(5)
            ->get();

        $totalBarangMasuk = BarangMasuk::count();
        $totalBarangKeluar = BarangKeluar::count();

        if (role() === 'pemilik') {
            return view('dashboard.pemilik', compact('stok', 'totalBarangMasuk', 'totalBarangKeluar'));
        } elseif (role() === 'petugas_gudang') {
            return view('dashboard.gudang', compact('stok', 'totalBarangMasuk', 'totalBarangKeluar'));
        } elseif (role() === 'kasir') {
            return view('dashboard.kasir', compact('stok', 'totalBarangMasuk', 'totalBarangKeluar'));
        }
    }
}