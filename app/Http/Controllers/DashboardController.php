<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
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

        $totalBarangMasuk = BarangMasuk::count();
        $totalBarangKeluar = BarangKeluar::count();
        $totalBarang = Barang::count();

        if (role() === 'pemilik') {
            return view('dashboard.pemilik', compact('stok', 'totalBarangMasuk', 'totalBarangKeluar', 'totalBarang'));
        } elseif (role() === 'petugas_gudang') {
            return view('dashboard.gudang', compact('stok', 'totalBarangMasuk', 'totalBarangKeluar', 'totalBarang'));
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

            if (role() === 'pemilik') {
                $data->addColumn('action', function ($row) {
                    $btnEdit = '<div><a href="' . route('pemilik.barangmasuk.edit', $row->masuk_id) . '" class="btn-kuning">' . iconEdit() . 'Edit</a></div>';
                    $btnHapus = '<div><form id="delete-form-' . $row->masuk_id . '" action="' . route('pemilik.barangmasuk.destroy', $row->masuk_id) . '" method="POST" style="display:inline;">'
                        . csrf_field() . method_field('DELETE') . '
                    <button type="button" onclick="deleteBarangMasuk(' . $row->masuk_id . ')" class="btn-merah">'
                        . iconHapus() . 'Hapus</button></form></div>';
                    return '<div class="flex space-x-2 justify-center">' . $btnEdit . $btnHapus . '</div>';
                });
                $data->rawColumns(['action']);
            }

            if (role() === 'petugas_gudang') {
                $data->addColumn('action', function ($row) {
                    $btnEdit = '<div><a href="' . route('gudang.barangmasuk.edit', $row->masuk_id) . '" class="btn-kuning">' . iconEdit() . 'Edit</a></div>';
                    $btnHapus = '<div><form id="delete-form-' . $row->masuk_id . '" action="' . route('gudang.barangmasuk.destroy', $row->masuk_id) . '" method="POST" style="display:inline;">'
                        . csrf_field() . method_field('DELETE') . '
                    <button type="button" onclick="deleteBarangMasuk(' . $row->masuk_id . ')" class="btn-merah">'
                        . iconHapus() . 'Hapus</button></form></div>';
                    return '<div class="flex space-x-2 justify-center">' . $btnEdit . $btnHapus . '</div>';
                });
                $data->rawColumns(['action']);
            }

            return $data->toJson();
        }

        // ini penting: kalau bukan request AJAX
        return view('dashboard.kasir');
    }
}
