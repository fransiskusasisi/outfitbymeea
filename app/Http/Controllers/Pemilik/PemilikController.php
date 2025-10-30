<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Barangku;
use Illuminate\Http\Request;

class PemilikController extends Controller
{
    /**
     * Dashboard Pemilik (Read-Only View)
     */
    public function dashboard(Request $request)
    {
        // Ambil semua data barang beserta kategori
        $query = Barang::with('kategori');

        // Urutkan berdasarkan 'created_at' (tanggal dibuat)
        $barangs = $query->latest('created_at')->get();

        // Mengirim data ke view
        return view('pemilik.dashboard', compact('barangs'));
    }
}
