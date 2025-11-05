<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Tambahkan timestamps ke tabel barang_masuk
        Schema::table('barang_masuk', function (Blueprint $table) {
            $table->timestamps();
        });

        // Tambahkan timestamps ke tabel barang_keluar
        Schema::table('barang_keluar', function (Blueprint $table) {
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Hapus timestamps dari tabel barang_masuk
        Schema::table('barang_masuk', function (Blueprint $table) {
            $table->dropTimestamps();
        });

        // Hapus timestamps dari tabel barang_keluar
        Schema::table('barang_keluar', function (Blueprint $table) {
            $table->dropTimestamps();
        });
    }
};
