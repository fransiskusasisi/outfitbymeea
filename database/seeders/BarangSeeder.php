<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barang;

class BarangSeeder extends Seeder
{
    public function run()
    {
        Barang::create([
            'nama_barang' => 'T-Shirt',
            'kategori_id' => 1, // Pastikan ada kategori dengan ID 1
            'ukuran' => 'L',
            'kondisi' => 'baru',
            'harga_beli' => 50000,
            'harga_jual' => 70000,
            'stok' => 100,
        ]);

        Barang::create([
            'nama_barang' => 'Jeans',
            'kategori_id' => 2, // Pastikan ada kategori dengan ID 2
            'ukuran' => 'M',
            'kondisi' => 'bekas bagus',
            'harga_beli' => 80000,
            'harga_jual' => 120000,
            'stok' => 50,
        ]);

        Barang::create([
            'nama_barang' => 'Sepatu',
            'kategori_id' => 1, // Pastikan ada kategori dengan ID 1
            'ukuran' => '42',
            'kondisi' => 'bekas sedang',
            'harga_beli' => 150000,
            'harga_jual' => 250000,
            'stok' => 30,
        ]);
    }
}
