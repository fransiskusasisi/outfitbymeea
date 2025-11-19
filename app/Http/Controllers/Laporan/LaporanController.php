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
        $barangMasuk = BarangMasuk::with('barang')->orderBy('masuk_id', 'desc')->get();
        $barangKeluar = BarangKeluar::with('barang')->orderBy('keluar_id', 'desc')->get();

        $pdf = Pdf::loadView('pages.laporan.cetak-transaksi', compact('barangMasuk', 'barangKeluar'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('laporan-transaksi.pdf');
    }
}