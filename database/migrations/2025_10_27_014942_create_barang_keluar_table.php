<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('barang_keluar', function (Blueprint $table) {
            $table->id('keluar_id');
            $table->foreignId('barang_id')->constrained('barang','barang_id')->onDelete('cascade');
            $table->integer('jumlah');
            $table->date('tanggal');
            $table->foreignId('user_id')->nullable()->constrained('users','user_id')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barang_keluar');
    }
};
