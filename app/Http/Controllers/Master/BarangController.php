<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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
                ->editColumn('harga_beli', function ($row) {
                    return formatRupiah($row->harga_beli);
                })
                ->editColumn('harga_jual', function ($row) {
                    return formatRupiah($row->harga_jual);
                })
                ->addColumn('action', function ($row) {
                    $btnEdit = '<div><a href="' . route('barang.edit', $row->barang_id) . '" class="btn-kuning">' . iconEdit() . 'Edit</a></div>';

                    $btnHapus = '<a href="#" class="btn-merah">Hapus</a>';
                    return  '<div class="flex space-x-2 justify-center">' .  $btnEdit . $btnHapus . '</div>';
                })
                ->rawColumns(['action'])
                ->toJson();
            // ->make(true);
        }
        return view('pemilik.barang.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = Kategori::all();
        return view('pemilik.barang.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
