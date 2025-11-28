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
    // public function stok()
    // {
    //     $barangs = Barang::with('kategori')->get();
    //     return view('pages.laporan.stok', compact('barangs'));
    // }
    public function stok(Request $request)
    {
        if ($request->ajax()) {
            $query = Barang::with('kategori'); // eager-load

            return DataTables::of($query)
                ->addIndexColumn()
                ->editColumn('barang_id', function ($row) {
                    return 'BRG-' . $row->barang_id;
                })
                ->editColumn('nama_barang', function ($row) {
                    return $row->nama_barang;
                })
                ->editColumn('kategori_id', function ($row) {
                    return optional($row->kategori)->nama;
                })
                ->editColumn('harga_jual', function ($row) {
                    return $row->latestMasuk ? formatRupiah($row->latestMasuk->harga_jual) : '-';
                })
                ->editColumn('stok', function ($row) {
                    return $row->stok;
                })
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
                return $row->jumlah;
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

    public function transaksiBarangKeluar(Request $request)
    {
        $data = DataTables::of(BarangKeluar::query()->orderBy('keluar_id', 'desc'))
            ->addIndexColumn()
            ->editColumn('gambar', function ($row) {
                $gambar = optional($row->barang->latestMasuk)->gambar;
                $imgSrc = $gambar ? asset('storage/images/barang/' . $gambar) : asset('images/no-img.jpg');

                return '<div class="w-12 h-12">
                <img class="w-full h-full object-cover shadow-md rounded-md" src="' . $imgSrc . '" alt="' . e(optional($row->barang)->nama_barang) . '">
                </div>';
            })
            ->editColumn('barang_id', function ($row) {
                return $row->barang->nama_barang;
            })
            ->editColumn('kode_barang', function ($row) {
                return $row->barang->kode_barang ?? '-';
            })
            ->editColumn('harga_jual', function ($row) {
                return $row->barang->latestMasuk ? formatRupiah($row->barang->latestMasuk->harga_jual) : '-';
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
                return $row->user->nama;
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
        // gunakan builder (tanpa ->get())
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
                // total nilai masuk = harga_jual * jumlah (dari latestMasuk)
                if (! $row->latestMasuk) {
                    return 'Rp 0';
                }
                $hargaJual = $row->latestMasuk->harga_jual ?? 0;
                $jumlah = $row->latestMasuk->jumlah ?? 0;
                $total = $hargaJual * $jumlah;
                return 'Rp ' . number_format($total, 0, ',', '.');
            })
            ->addColumn('jml_trans_brg_keluar', function ($row) {
                // jumlah transaksi barang keluar (dari relasi latestKeluar)
                return $row->latestKeluar ? (int) $row->latestKeluar->jumlah : 0;
            })
            ->addColumn('total_nilai_brg_keluar', function ($row) {
                // untuk total nilai keluar: ambil jumlah dari latestKeluar
                // lalu ambil harga_jual dari latestMasuk (atau dari BarangMasuk terakhir jika ingin jaminan)
                $jumlahKeluar = $row->latestKeluar ? ($row->latestKeluar->jumlah ?? 0) : 0;
                if ($jumlahKeluar == 0) {
                    return 'Rp 0';
                }

                // Prioritas: pakai latestMasuk yang sudah eager loaded.
                $hargaJual = 0;
                if ($row->latestMasuk && isset($row->latestMasuk->harga_jual)) {
                    $hargaJual = $row->latestMasuk->harga_jual;
                } else {
                    // fallback: cari record BarangMasuk terakhir (mirip dengan kode blade)
                    $masukRecord = BarangMasuk::where('barang_id', $row->barang_id)
                        ->orderBy('created_at', 'desc')
                        ->first();
                    $hargaJual = $masukRecord ? ($masukRecord->harga_jual ?? 0) : 0;
                }

                $totalKeluar = $hargaJual * $jumlahKeluar;
                return 'Rp ' . number_format($totalKeluar, 0, ',', '.');
            })
            // jika mau menampilkan kolom raw HTML, gunakan ->rawColumns(['kolom1','kolom2'])
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
