<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use App\Models\Kategori;
use App\Models\RiwayatLogin;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil hanya 5 data barang beserta kategori
        $stok = Barang::with('kategori')
            ->latest('created_at')
            ->take(5)
            ->get();

        $barangMasuk = BarangMasuk::with('barang')->latest()->take(5)->get();
        $barangKeluar = BarangKeluar::with('barang')->latest()->take(5)->get();
        $totalKategori = Kategori::count();
        $totalBarangMasuk = BarangMasuk::count();
        $totalBarangKeluar = BarangKeluar::count();
        $totalBarang = Barang::count();
        $riwayatLogin = RiwayatLogin::count();

        if (role() === 'pemilik') {
            return view('dashboard.pemilik', compact('stok', 'totalBarangMasuk', 'totalBarangKeluar', 'totalBarang', 'riwayatLogin'));
        } elseif (role() === 'petugas_gudang') {
            return view('dashboard.gudang', compact('stok', 'totalKategori',  'totalBarangMasuk', 'totalBarangKeluar', 'totalBarang', 'barangMasuk', 'barangKeluar'));
        } elseif (role() === 'kasir') {
            return view('dashboard.kasir', compact('stok', 'totalBarangMasuk', 'totalBarangKeluar', 'totalBarang'));
        }
    }

    public function kasir(Request $request)
    {
        if ($request->ajax()) {
            $data = DataTables::of(BarangMasuk::query()->orderBy('masuk_id', 'desc'))
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
                });

            return $data->toJson();
        }

        // ini penting: kalau bukan request AJAX
        return view('dashboard.kasir');
    }
}
