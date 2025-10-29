<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    public function index()
    {
        return view('pemilik.barangmasuk.index');
    }
}
