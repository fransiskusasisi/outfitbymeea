<?php

use Illuminate\Support\Facades\Route;

// =============================
// 🧭 CONTROLLER IMPORTS
// =============================
use App\Http\Controllers\Auth\AuthController;
// use App\Http\Controllers\Master\BarangkuController;
use App\Http\Controllers\Master\KategoriController;
use App\Http\Controllers\Master\JenisBarangController;
use App\Http\Controllers\Transaksi\BarangMasukController;
use App\Http\Controllers\Transaksi\BarangKeluarController;
use App\Http\Controllers\Laporan\LaporanController;
use App\Http\Controllers\Master\BarangController;
use App\Http\Controllers\Pemilik\PemilikController; // ← TAMBAH INI

/*
|--------------------------------------------------------------------------
| WEB ROUTES - OUTFITBYMEE
|-------Z-------------------------------------------------------------------
| Semua route aplikasi, sudah dikelompokkan per role pengguna.
|--------------------------------------------------------------------------
*/

// =============================
// 🔐 AUTHENTICATION ROUTES
// =============================

// Halaman awal → redirect ke login
Route::get('/', fn() => redirect('/login'));
// Route::resource('barang', BarangkuController::class);

// Login & Logout
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// =============================
// 🧑‍💼 PEMILIK (Role: pemilik)
// =============================
Route::middleware(['role:pemilik'])->group(function () {

    // ---------- Dashboard ----------
    Route::get('/pemilik/dashboard', [PemilikController::class, 'dashboard'])
        ->name('pemilik.dashboard');

    // ---------- Data Master ----------
    // Barang
    Route::prefix('pemilik')->group(function () {
        // Route::get('/', [BarangkuController::class, 'index'])->name('barang.index');
        // Route::get('/create', [BarangCrudController::class, 'create'])->name('barang.create');
        // Route::post('/', [BarangCrudController::class, 'store'])->name('barang.store');
        // Route::get('/{id}/edit', [BarangCrudController::class, 'edit'])->name('barang.edit');
        // Route::put('/{id}', [BarangCrudController::class, 'update'])->name('barang.update');
        // Route::delete('/{id}', [BarangCrudController::class, 'destroy'])->name('barang.destroy');
        // Route::resource('barangku', BarangkuController::class);
        Route::resource('barang', BarangController::class);
    });

    // Kategori
    Route::prefix('pemilik/kategori')->group(function () {
        Route::get('/', [KategoriController::class, 'index'])->name('kategori.index');
        Route::get('/create', [KategoriController::class, 'create'])->name('kategori.create');
        Route::post('/', [KategoriController::class, 'store'])->name('kategori.store');
        Route::get('/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
        Route::put('/{id}', [KategoriController::class, 'update'])->name('kategori.update');
        Route::delete('/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
    });

    // Jenis Barang
    Route::prefix('pemilik/jenis-barang')->group(function () {
        Route::get('/', [JenisBarangController::class, 'index'])->name('jenisbarang.index');
        Route::get('/create', [JenisBarangController::class, 'create'])->name('jenisbarang.create');
        Route::post('/', [JenisBarangController::class, 'store'])->name('jenisbarang.store');
        Route::get('/{id}/edit', [JenisBarangController::class, 'edit'])->name('jenisbarang.edit');
        Route::put('/{id}', [JenisBarangController::class, 'update'])->name('jenisbarang.update');
        Route::delete('/{id}', [JenisBarangController::class, 'destroy'])->name('jenisbarang.destroy');
    });

    // ---------- Transaksi ----------
    // Barang Masuk
    Route::prefix('pemilik/barang-masuk')->group(function () {
        Route::get('/', [BarangMasukController::class, 'index'])->name('barangmasuk.index');
        Route::get('/create', [BarangMasukController::class, 'create'])->name('barangmasuk.create');
        Route::post('/', [BarangMasukController::class, 'store'])->name('barangmasuk.store');
    });

    // Barang Keluar
    Route::prefix('pemilik/barang-keluar')->group(function () {
        Route::get('/', [BarangKeluarController::class, 'index'])->name('barangkeluar.index');
        Route::get('/create', [BarangKeluarController::class, 'create'])->name('barangkeluar.create');
        Route::post('/', [BarangKeluarController::class, 'store'])->name('barangkeluar.store');
    });

    // ---------- Laporan ----------
    Route::prefix('pemilik/laporan')->group(function () {
        Route::get('/stok', [LaporanController::class, 'stok'])->name('laporan.stok');
        Route::get('/stok/cetak', [LaporanController::class, 'cetakStok'])->name('laporan.stok.cetak');
    });
});


// =============================
// 💳 KASIR (Role: kasir)
// =============================
Route::middleware(['role:kasir'])->group(function () {
    Route::view('/kasir/dashboard', 'dashboard.kasir')->name('kasir.dashboard');
    // Tambah route kasir lain di sini
});


// =============================
// 📦 PETUGAS GUDANG (Role: petugas_gudang)
// =============================
Route::middleware(['role:petugas_gudang'])->group(function () {
    Route::view('/gudang/dashboard', 'dashboard.gudang')->name('gudang.dashboard');
    // Tambah route gudang lain di sini
});
