<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barangku extends Model
{
    use HasFactory;

    // Model Barangku menggunakan tabel 'barang'
    protected $table = 'barang'; 

    // Model ini menggunakan 'barang_id' sebagai primary key
    protected $primaryKey = 'barang_id'; 

    // Kolom-kolom yang diperbolehkan untuk Mass Assignment
    protected $fillable = [
        'nama_barang',
        'kategori_id',
        'ukuran',
        'kondisi',
        'harga_beli',
        'harga_jual',
        'stok',
    ];

    // Jika Anda ingin menonaktifkan created_at dan updated_at:
    // public $timestamps = false;
    // Namun berdasarkan skema Anda, timestamps diaktifkan.
}