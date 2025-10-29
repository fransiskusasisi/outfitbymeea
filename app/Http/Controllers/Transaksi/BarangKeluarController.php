<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    public function index()
    {
        return view('pemilik.barangkeluar.index');
    }
}
