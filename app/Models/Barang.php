<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'barang_id';
    public $timestamps = false;

    protected $fillable = [
        'nama_barang',
        'kategori_id',
        'ukuran',
        'kondisi',
        'harga_beli',
        'harga_jual',
        'stok',
        'created_at',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'kategori_id');
    }
}
