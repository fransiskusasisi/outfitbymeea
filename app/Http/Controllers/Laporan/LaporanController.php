<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use Barryvdh\DomPDF\Facade\Pdf;
use Yajra\DataTables\Facades\DataTables;

class LaporanController extends Controller
{
    public function stok(Request $request)
    {
        if ($request->ajax()) {
            $sub = BarangMasuk::selectRaw('barang_id, MAX(masuk_id) as max_masuk_id')
                ->groupBy('barang_id');

            $query = Barang::query()
                ->leftJoin('kategori', 'barang.kategori_id', '=', 'kategori.kategori_id')
                ->leftJoinSub($sub, 'bm_latest', function ($join) {
                    $join->on('barang.barang_id', '=', 'bm_latest.barang_id');
                })
                ->leftJoin('barang_masuk as bm', 'bm.masuk_id', '=', 'bm_latest.max_masuk_id')
                ->select(
                    'barang.*',
                    'kategori.nama as kategori_nama',
                    'bm.harga_jual as harga_jual_latest'
                );

            return DataTables::of($query)
                ->addIndexColumn()
                ->editColumn('barang_id', function ($row) {
                    return 'BRG-' . $row->barang_id;
                })
                ->editColumn('nama_barang', function ($row) {
                    return $row->nama_barang;
                })
                ->editColumn('kategori_id', function ($row) {
                    return $row->kategori_nama ?? '-';
                })
                ->editColumn('harga_jual', function ($row) {
                    return $row->harga_jual_latest ? formatRupiah($row->harga_jual_latest) : '-';
                })
                ->editColumn('stok', function ($row) {
                    return $row->stok;
                })
                ->orderColumn('harga_jual', 'bm.harga_jual $1')
                ->toJson();
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

    public function transaksi(Request $request)
    {
        if ($request->ajax()) {
            return $this->transaksiBarangMasuk($request);
        }
        return view('pages.laporan.transaksi');
    }

    public function transaksiBarangMasuk(Request $request)
    {
        $query = BarangMasuk::with('user', 'barang')
            ->join('users', 'barang_masuk.user_id', '=', 'users.user_id')
            ->join('barang', 'barang_masuk.barang_id', '=', 'barang.barang_id')
            ->select('barang_masuk.*', 'users.nama as user_nama', 'barang.nama_barang as nama_barang');

        $data = DataTables::of($query)
            ->addIndexColumn()
            ->orderColumn('jumlah', 'barang_masuk.jumlah $1')
            ->orderColumn('nama_barang', 'barang.nama_barang $1')
            ->orderColumn('user_nama', 'users.nama $1')

            ->filterColumn('nama_barang', function ($query, $keyword) {
                $keyword = str_replace("'", "", $keyword); // sanitasi sederhana
                $query->whereRaw("barang.nama_barang like ?", ["%{$keyword}%"]);
            })
            ->filterColumn('user_nama', function ($query, $keyword) {
                $keyword = str_replace("'", "", $keyword);
                $query->whereRaw("users.nama like ?", ["%{$keyword}%"]);
            })

            ->editColumn('gambar', function ($row) {
                $imgSrc = $row->gambar
                    ? asset('storage/images/barang/' . $row->gambar)
                    : asset('images/no-img.jpg');

                return '<div class="w-12 h-12">
                <img class="w-full h-full object-cover shadow-md rounded-md" src="' . $imgSrc . '" alt="' . e($row->nama_barang ?? '-') . '">
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
                return $row->jumlah;
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


    public function transaksiBarangKeluar(Request $request)
    {
        $sub = BarangMasuk::selectRaw('barang_id, MAX(masuk_id) as max_masuk_id')
            ->groupBy('barang_id');

        $query = BarangKeluar::with('user', 'barang')
            ->join('users', 'barang_keluar.user_id', '=', 'users.user_id')
            ->join('barang', 'barang_keluar.barang_id', '=', 'barang.barang_id')
            ->leftJoinSub($sub, 'bm_latest', function ($join) {
                $join->on('barang.barang_id', '=', 'bm_latest.barang_id');
            })
            ->leftJoin('barang_masuk as bm', 'bm.masuk_id', '=', 'bm_latest.max_masuk_id')
            ->select(
                'barang_keluar.*',
                'users.nama as user_nama',
                'barang.nama_barang as nama_barang',
                'bm.harga_jual as harga_jual_latest'
            );

        $data = DataTables::of($query)
            ->addIndexColumn()
            ->orderColumn('jumlah', 'barang_keluar.jumlah $1')
            ->orderColumn('nama_barang', 'barang.nama_barang $1')
            ->orderColumn('harga_jual', 'bm.harga_jual $1')
            ->orderColumn('user_nama', 'users.nama $1')

            ->filterColumn('nama_barang', function ($q, $keyword) {
                $keyword = str_replace("'", "", $keyword);
                $q->whereRaw("barang.nama_barang like ?", ["%{$keyword}%"]);
            })
            ->filterColumn('user_nama', function ($q, $keyword) {
                $keyword = str_replace("'", "", $keyword);
                $q->whereRaw("users.nama like ?", ["%{$keyword}%"]);
            })

            ->editColumn('gambar', function ($row) {
                $gambar = optional($row->barang->latestMasuk)->gambar;
                $imgSrc = $gambar ? asset('storage/images/barang/' . $gambar) : asset('images/no-img.jpg');

                return '<div class="w-12 h-12">
                <img class="w-full h-full object-cover shadow-md rounded-md" src="' . $imgSrc . '" alt="' . e($row->nama_barang ?? '-') . '">
                </div>';
            })
            ->editColumn('barang_id', function ($row) {
                return $row->nama_barang ?? ($row->barang->nama_barang ?? '-');
            })
            ->editColumn('kode_barang', function ($row) {
                return $row->barang->kode_barang ?? '-';
            })
            ->editColumn('harga_jual', function ($row) {
                return $row->harga_jual_latest ? formatRupiah($row->harga_jual_latest) : '-';
            })
            ->editColumn('ukuran', function ($row) {
                return $row->barang->ukuran ?? '-';
            })
            ->editColumn('kondisi', function ($row) {
                return ucwords($row->barang->kondisi) ?? '-';
            })
            ->editColumn('jumlah', function ($row) {
                return $row->jumlah;
            })
            ->editColumn('tanggal', function ($row) {
                return formatTanggal($row->tanggal);
            })
            ->editColumn('user_id', function ($row) {
                return $row->user_nama ?? ($row->user->nama ?? '-');
            })
            ->rawColumns(['gambar'])
            ->make(true);

        return $data;
    }

    public function cetakTransaksi()
    {
        $tipe = request()->get('tipe');
        $barangMasuk = BarangMasuk::with('barang')->orderBy('masuk_id', 'desc')->get();
        $barangKeluar = BarangKeluar::with('barang')->orderBy('keluar_id', 'desc')->get();

        $pdf = Pdf::loadView('pages.laporan.cetak-transaksi', compact('tipe', 'barangMasuk', 'barangKeluar'))
            ->setPaper('a4', 'portrait');

        $timestamp = \Carbon\Carbon::now()->format('YmdHis');
        $fileName = $tipe == 'masuk' ? "Laporan-Transaksi-Masuk-{$timestamp}.pdf" : "Laporan-Transaksi-Keluar-{$timestamp}.pdf";
        return $pdf->stream($fileName);
    }

    public function laporanLengkap(Request $request)
    {
        if (request()->ajax()) {
            return $this->laporanLengkapData($request);
        }
        $jmlTransaksiMasuk = BarangMasuk::count();
        $jmlTransaksiKeluar = BarangKeluar::count();
        $totalTransaksi = $jmlTransaksiMasuk + $jmlTransaksiKeluar;
        $totalNilaiMasuk = BarangMasuk::get()->map(function ($item) {
            return $item->harga_jual * $item->jumlah;
        })->sum();

        $barangIds = BarangKeluar::pluck('barang_id')->toArray();
        $totalNilaiKeluar = BarangMasuk::whereIn('barang_id', $barangIds)->get()->map(function ($item) {
            return $item->harga_jual * $item->jumlah;
        })->sum();
        return view('pages.laporan.laporan-lengkap', compact(
            'jmlTransaksiMasuk',
            'jmlTransaksiKeluar',
            'totalTransaksi',
            'totalNilaiMasuk',
            'totalNilaiKeluar'
        ));
    }

    public function laporanLengkapData(Request $request)
    {
        $query = Barang::with('latestMasuk', 'latestKeluar');

        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->editColumn('nama_barang', function ($row) {
                return $row->nama_barang;
            })
            ->addColumn('jml_trans_brg_masuk', function ($row) {
                // jumlah transaksi barang masuk (dari relasi latestMasuk)
                return $row->latestMasuk ? (int) $row->latestMasuk->jumlah : 0;
            })
            ->addColumn('total_nilai_brg_masuk', function ($row) {
                if (! $row->latestMasuk) {
                    return 'Rp 0';
                }
                $hargaJual = $row->latestMasuk->harga_jual ?? 0;
                $jumlah = $row->latestMasuk->jumlah ?? 0;
                $total = $hargaJual * $jumlah;
                return 'Rp ' . number_format($total, 0, ',', '.');
            })
            ->addColumn('jml_trans_brg_keluar', function ($row) {
                return $row->latestKeluar ? (int) $row->latestKeluar->jumlah : 0;
            })
            ->addColumn('total_nilai_brg_keluar', function ($row) {
                $jumlahKeluar = $row->latestKeluar ? ($row->latestKeluar->jumlah ?? 0) : 0;
                if ($jumlahKeluar == 0) {
                    return 'Rp 0';
                }

                $hargaJual = 0;
                if ($row->latestMasuk && isset($row->latestMasuk->harga_jual)) {
                    $hargaJual = $row->latestMasuk->harga_jual;
                } else {
                    $masukRecord = BarangMasuk::where('barang_id', $row->barang_id)
                        ->orderBy('created_at', 'desc')
                        ->first();
                    $hargaJual = $masukRecord ? ($masukRecord->harga_jual ?? 0) : 0;
                }

                $totalKeluar = $hargaJual * $jumlahKeluar;
                return 'Rp ' . number_format($totalKeluar, 0, ',', '.');
            })
            ->toJson();
    }

    public function cetakLaporanLengkap()
    {
        $jmlTransaksiMasuk = BarangMasuk::count();
        $jmlTransaksiKeluar = BarangKeluar::count();
        $totalTransaksi = $jmlTransaksiMasuk + $jmlTransaksiKeluar;
        $totalNilaiMasuk = BarangMasuk::get()->map(function ($item) {
            return $item->harga_jual * $item->jumlah;
        })->sum();

        $barangIds = BarangKeluar::pluck('barang_id')->toArray();
        $totalNilaiKeluar = BarangMasuk::whereIn('barang_id', $barangIds)->get()->map(function ($item) {
            return $item->harga_jual * $item->jumlah;
        })->sum();

        $barang = Barang::with(['latestMasuk', 'latestKeluar'])->get();
        $pdf = Pdf::loadView('pages.laporan.cetak-laporan-lengkap', compact(
            'jmlTransaksiMasuk',
            'jmlTransaksiKeluar',
            'totalTransaksi',
            'totalNilaiMasuk',
            'totalNilaiKeluar',
            'barang'
        ))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('laporan-lengkap.pdf');
    }
}
