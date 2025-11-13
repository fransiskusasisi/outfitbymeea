<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('barang', function (Blueprint $table) {
            $table->dropColumn('harga_beli');
        });

        Schema::table('barang', function (Blueprint $table) {
            $table->string('gambar', 100)->after('kondisi')->nullable();
        });
    }

    public function down()
    {
        // Hapus kolom yang ditambahkan pada up()
        Schema::table('barang', function (Blueprint $table) {
            $table->dropColumn('gambar');
        });

        // Tambahkan kembali kolom yang di-drop pada up()
        Schema::table('barang', function (Blueprint $table) {
            $table->integer('harga_beli')->after('kondisi')->nullable()->default(0);
        });
    }
};
