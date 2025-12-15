<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'barang_id';
    public $timestamps = true;

    protected $fillable = [
        'nama_barang',
        'kode_barang',
        'kategori_id',
        'ukuran',
        'kondisi',
        'stok',
        'created_at',
        'updated_at',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'kategori_id');
    }

    public function latestMasuk()
    {
        return $this->hasOne(BarangMasuk::class, 'barang_id', 'barang_id')->latestOfMany('masuk_id');
    }

    public function latestKeluar()
    {
        return $this->hasOne(BarangKeluar::class, 'barang_id', 'barang_id')->latestOfMany('keluar_id');
    }
}
