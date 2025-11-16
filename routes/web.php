<?php

use Illuminate\Support\Facades\Route;

// =============================
// 🧭 CONTROLLER IMPORTS
// =============================
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
// use App\Http\Controllers\Master\BarangkuController;
use App\Http\Controllers\Master\KategoriController;
use App\Http\Controllers\Master\JenisBarangController;
use App\Http\Controllers\Transaksi\BarangMasukController;
use App\Http\Controllers\Transaksi\BarangKeluarController;
use App\Http\Controllers\Laporan\LaporanController;
use App\Http\Controllers\Master\BarangController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\Pemilik\PemilikController; // ← TAMBAH INI
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RiwayatLoginController;
use App\Models\Barang;

// Halaman awal → redirect ke login
Route::get('/', fn() => redirect('/login'));
// Login & Logout
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Notifikasi barang menipis
Route::get('/notifikasi-barang', [NotifikasiController::class, 'getBarangMenipis'])->name('notifikasi.barang');
Route::get('/barang/{id}/stok', [BarangController::class, 'getStok'])->name('barang.getStok');

Route::middleware('auth')->group(function () {
    Route::get('/profile', function () {
        return view('pages.profile.index');
    })->name('profile');
});


// Role: Pemilik
Route::middleware(['role:pemilik'])->group(function () {
    Route::get('/pemilik/dashboard', [DashboardController::class, 'index'])->name('pemilik.dashboard');
    Route::prefix('pemilik')->name('pemilik.')->group(function () {
        Route::resource('barang', BarangController::class);
        Route::resource('kategori', KategoriController::class);
        Route::resource('barangmasuk', BarangMasukController::class);
        Route::resource('barangkeluar', BarangKeluarController::class);
        Route::resource('riwayatlogin', RiwayatLoginController::class);
        Route::get('/laporan/stok', [LaporanController::class, 'stok'])->name('laporan.stok');
        Route::get('/laporan/stok/cetak', [LaporanController::class, 'cetakStok'])->name('laporan.stok.cetak');
    });
});

// Role: Petugas Gudang
Route::middleware(['role:petugas_gudang'])->group(function () {
    // Route::view('/gudang/dashboard', 'dashboard.gudang')->name('gudang.dashboard');
    Route::get('/gudang/dashboard', [DashboardController::class, 'index'])->name('gudang.dashboard');
    Route::prefix('gudang')->name('gudang.')->group(function () {
        Route::resource('barang', BarangController::class);
        Route::resource('kategori', KategoriController::class);
        Route::resource('barangmasuk', BarangMasukController::class);
        Route::resource('barangkeluar', BarangKeluarController::class);
    });
});

// Role: Kasir
Route::middleware(['role:kasir'])->group(function () {
    // Route::get('/kasir/dashboard', [DashboardController::class, 'kasir'])->name('kasir.dashboard');
    Route::get('/kasir/dashboard', [DashboardController::class, 'kasir'])->name('kasir.dashboard');
    Route::get('/kasir/dashboard/data', [DashboardController::class, 'kasirData'])->name('kasir.dashboard.data'); // <-- Tambahkan ini

    Route::prefix('kasir')->name('kasir.')->group(function () {
        Route::resource('barang', BarangController::class);
        Route::resource('kategori', KategoriController::class);
        Route::resource('barangmasuk', BarangMasukController::class);
        Route::resource('barangkeluar', BarangKeluarController::class);
    });
});
