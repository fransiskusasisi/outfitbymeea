<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use App\Models\Kategori;
use App\Models\RiwayatLogin;
use Illuminate\Http\Request;
use Illuminate\Support\HtmlString; // paling atas file controller
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

    // Di DashboardController.php

    public function kasir(Request $request)
    {
        if ($request->ajax()) {
            return $this->kasirData($request);
        }
        return view('dashboard.kasir');
    }

    // Method baru untuk AJAX DataTables
    public function kasirData(Request $request)
    {
        $data = DataTables::of(BarangMasuk::with(['barang', 'user'])->orderBy('masuk_id', 'desc')) // Optimalkan relasi
            ->addIndexColumn()
            ->editColumn('gambar', function ($row) {
                $imgSrc = $row->gambar
                    ? asset('storage/images/barang/' . $row->gambar)
                    : asset('images/no-img.jpg');

                return '<div class="w-12 h-12">
                <img class="w-full h-full object-cover shadow-md rounded-md" src="' . $imgSrc . '" alt="' . e($row->barang->nama_barang) . '">
                </div>';
            })
            ->editColumn('barang_id', function ($row) {
                return $row->barang->nama_barang;
            })
            ->editColumn('kode_barang', function ($row) {
                return $row->barang->kode_barang ?? '-';
            })
            ->editColumn('ukuran', function ($row) {
                return $row->barang->ukuran ?? '-';
            })
            ->editColumn('kondisi', function ($row) {
                return ucwords($row->barang->kondisi) ?? '-';
            })
            ->editColumn('jumlah', function ($row) {
                return $row->barang->stok;
            })
            ->editColumn('tanggal', function ($row) {
                return formatTanggal($row->tanggal);
            })
            ->editColumn('user_id', function ($row) {
                return $row->user->nama;
            })
            ->editColumn('harga_jual', function ($row) {
                return formatRupiah($row->harga_jual);
            })
            ->rawColumns(['gambar'])
            ->make(true);

        return $data;
    }
}