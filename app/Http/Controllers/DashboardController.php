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
        $listTahun = range(now()->format('Y'), now()->subYear(4)->format('Y'));

        if (role() === 'pemilik') {
            return view('dashboard.pemilik', compact('stok', 'totalBarangMasuk', 'totalBarangKeluar', 'totalBarang', 'riwayatLogin', 'listTahun'));
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
        $query = BarangMasuk::with('user', 'barang')
            ->join('users', 'barang_masuk.user_id', '=', 'users.user_id')
            ->join('barang', 'barang_masuk.barang_id', '=', 'barang.barang_id')
            ->select('barang_masuk.*', 'users.nama as user_nama', 'barang.nama_barang as nama_barang');
        $data = DataTables::of($query)
            ->addIndexColumn()
            // mapping order for jumlah & barang.nama_barang
            ->orderColumn('jumlah', 'barang_masuk.jumlah $1')
            ->orderColumn('nama_barang', 'barang.nama_barang $1')
            // tambahkan mapping order untuk user_nama
            ->orderColumn('user_nama', 'users.nama $1')
            ->editColumn('masuk_id', function ($row) {
                return $row->barang_id;
            })
            ->editColumn('gambar', function ($row) {
                $imgSrc = $row->gambar
                    ? asset('storage/images/barang/' . $row->gambar)
                    : asset('images/no-img.jpg');

                return '<div class="w-12 h-12">
                <img class="w-full h-full object-cover shadow-md rounded-md" src="' . $imgSrc . '" alt="' . e($row->barang->nama_barang) . '">
                </div>';
            })
            ->editColumn('barang_id', function ($row) {
                return $row->nama_barang ?? ($row->barang->nama_barang ?? '-');
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
                return $row->user_nama ?? ($row->user->nama ?? '-');
            })
            ->editColumn('harga_jual', function ($row) {
                return formatRupiah($row->harga_jual);
            })
            ->rawColumns(['gambar'])
            ->make(true);

        return $data;
    }

    public function getChartData(Request $request)
    {
        $tahun = $request->query('tahun', now()->format('Y'));

        $dataBarangMasuk = BarangMasuk::selectRaw('MONTH(tanggal) as bulan, COUNT(masuk_id) as total')
            ->whereYear('tanggal', $tahun)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total', 'bulan');

        $dataBarangKeluar = BarangKeluar::selectRaw('MONTH(tanggal) as bulan, COUNT(keluar_id) as total')
            ->whereYear('tanggal', $tahun)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total', 'bulan');

        $bulanLabels = [
            1 => 'Jan',
            2 => 'Feb',
            3 => 'Mar',
            4 => 'Apr',
            5 => 'Mei',
            6 => 'Jun',
            7 => 'Jul',
            8 => 'Agu',
            9 => 'Sep',
            10 => 'Okt',
            11 => 'Nov',
            12 => 'Des'
        ];

        $barangMasuk = [];
        $barangKeluar = [];

        foreach (range(1, 12) as $bulan) {
            $barangMasuk[] = [
                'x' => $bulanLabels[$bulan],
                'y' => $dataBarangMasuk->get($bulan, 0)
            ];
            $barangKeluar[] = [
                'x' => $bulanLabels[$bulan],
                'y' => $dataBarangKeluar->get($bulan, 0)
            ];
        }

        return response()->json([
            'barangMasuk' => $barangMasuk,
            'barangKeluar' => $barangKeluar,
        ]);
    }
}
