<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    public function getBarangMenipis()
    {
        $barangMenipis = Barang::where('stok', '<=', 25)
            ->orderBy('updated_at', 'desc')
            ->get(['nama_barang', 'stok', 'updated_at']);

        return response()->json($barangMenipis);
    }
}
