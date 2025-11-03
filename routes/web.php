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
// Role: Pemilik
Route::middleware(['role:pemilik'])->group(function () {
    Route::prefix('pemilik')->name('pemilik.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('pemilik.dashboard');
        Route::resource('barang', BarangController::class);
        Route::resource('kategori', KategoriController::class);
        Route::resource('barangmasuk', BarangMasukController::class);
        Route::resource('barangkeluar', BarangMasukController::class);
        Route::get('/laporan/stok', [LaporanController::class, 'stok'])->name('laporan.stok');
        Route::get('/laporan/stok/cetak', [LaporanController::class, 'cetakStok'])->name('laporan.stok.cetak');
    });
});


// Route::middleware(['role:pemilik'])->group(function () {
//     Route::prefix('pemilik')->name('pemilik.')->group(function () {
//         Route::resource('barang', BarangController::class);
//         Route::resource('kategori', KategoriController::class);
//         Route::resource('barangmasuk', BarangMasukController::class);
//         Route::resource('barangkeluar', BarangMasukController::class);
//     });
//     // ---------- Dashboard ----------
//     Route::get('/pemilik/dashboard', [PemilikController::class, 'dashboard'])
//         ->name('pemilik.dashboard');

//     // ---------- Data Master ----------
//     // Barang

//     // Kategori
//     // Route::prefix('pemilik/kategori')->group(function () {
//     //     Route::get('/', [KategoriController::class, 'index'])->name('kategori.index');
//     //     Route::get('/create', [KategoriController::class, 'create'])->name('kategori.create');
//     //     Route::post('/', [KategoriController::class, 'store'])->name('kategori.store');
//     //     Route::get('/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
//     //     Route::put('/{id}', [KategoriController::class, 'update'])->name('kategori.update');
//     //     Route::delete('/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
//     // });

//     // // Jenis Barang
//     // Route::prefix('pemilik/jenis-barang')->group(function () {
//     //     Route::get('/', [JenisBarangController::class, 'index'])->name('jenisbarang.index');
//     //     Route::get('/create', [JenisBarangController::class, 'create'])->name('jenisbarang.create');
//     //     Route::post('/', [JenisBarangController::class, 'store'])->name('jenisbarang.store');
//     //     Route::get('/{id}/edit', [JenisBarangController::class, 'edit'])->name('jenisbarang.edit');
//     //     Route::put('/{id}', [JenisBarangController::class, 'update'])->name('jenisbarang.update');
//     //     Route::delete('/{id}', [JenisBarangController::class, 'destroy'])->name('jenisbarang.destroy');
//     // });

//     // // ---------- Transaksi ----------
//     // // Barang Masuk
//     // Route::prefix('pemilik/barang-masuk')->group(function () {
//     //     Route::get('/', [BarangMasukController::class, 'index'])->name('barangmasuk.index');
//     //     Route::get('/create', [BarangMasukController::class, 'create'])->name('barangmasuk.create');
//     //     Route::post('/', [BarangMasukController::class, 'store'])->name('barangmasuk.store');
//     //     Route::get('/{id}/edit', [BarangMasukController::class, 'edit'])->name('barangmasuk.edit');
//     //     Route::put('/{id}', [BarangMasukController::class, 'update'])->name('barangmasuk.update');
//     //     Route::delete('/{id}', [BarangMasukController::class, 'destroy'])->name('barangmasuk.destroy');
//     // });

//     // // Barang Keluar
//     // Route::prefix('pemilik/barang-keluar')->group(function () {
//     //     Route::get('/', [BarangKeluarController::class, 'index'])->name('barangkeluar.index');
//     //     Route::get('/create', [BarangKeluarController::class, 'create'])->name('barangkeluar.create');
//     //     Route::post('/', [BarangKeluarController::class, 'store'])->name('barangkeluar.store');
//     //     Route::get('/{id}/edit', [BarangKeluarController::class, 'edit'])->name('barangkeluar.edit');
//     //     Route::put('/{id}', [BarangKeluarController::class, 'update'])->name('barangkeluar.update');
//     //     Route::delete('/{id}', [BarangKeluarController::class, 'destroy'])->name('barangkeluar.destroy');
//     // });

//     // ---------- Laporan ----------
//     Route::prefix('pemilik/laporan')->group(function () {
//         Route::get('/stok', [LaporanController::class, 'stok'])->name('laporan.stok');
//         Route::get('/stok/cetak', [LaporanController::class, 'cetakStok'])->name('laporan.stok.cetak');
//     });
// });


// =============================
// 💳 KASIR (Role: kasir)
// =============================
// Route::middleware(['role:kasir'])->group(function () {
//     Route::view('/kasir/dashboard', 'dashboard.kasir')->name('kasir.dashboard');
//     // Tambah route kasir lain di sini
// });


// =============================
// 📦 PETUGAS GUDANG (Role: petugas_gudang)
// =============================
// Route::middleware(['role:petugas_gudang'])->group(function () {
//     Route::view('/gudang/dashboard', 'dashboard.gudang')->name('gudang.dashboard');
//     Route::prefix('gudang/')->group(function () {
//         Route::resource('barang', BarangController::class);
//         Route::resource('kategori', KategoriController::class);
//         Route::resource('barangmasuk', BarangMasukController::class);
//         Route::resource('barangkeluar', BarangMasukController::class);

//         // Route::get('/', [BarangController::class, 'index'])->name('gudang.barang.index');
//         // Route::get('/create', [BarangController::class, 'create'])->name('gudang.barang.create');
//         // Route::get('/{id}/edit', [BarangController::class, 'edit'])->name('gudang.barang.edit');
//     });
// });

// Role: Petugas Gudang
Route::middleware(['role:petugas_gudang'])->group(function () {
    Route::view('/gudang/dashboard', 'dashboard.gudang')->name('gudang.dashboard');
    Route::prefix('gudang')->name('gudang.')->group(function () {
        Route::resource('barang', BarangController::class);
        Route::resource('kategori', KategoriController::class);
        Route::resource('barangmasuk', BarangMasukController::class);
        Route::resource('barangkeluar', BarangMasukController::class);
    });
});

// Role: Kasir
Route::middleware(['role:kasir'])->group(function () {
    Route::view('/kasir/dashboard', 'dashboard.kasir')->name('kasir.dashboard');
    Route::prefix('kasir')->name('kasir.')->group(function () {
        Route::resource('barang', BarangController::class);
        Route::resource('kategori', KategoriController::class);
        Route::resource('barangmasuk', BarangMasukController::class);
        Route::resource('barangkeluar', BarangMasukController::class);
    });
});

// Route::middleware(['role:pemilik|kasir|petugas_gudang'])->group(function () {
//     Route::prefix('barang')->group(function () {
//         Route::get('/', [BarangController::class, 'index'])->name('barang.index');
//     });
// });