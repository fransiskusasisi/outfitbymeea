<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->id('barang_id');
            $table->string('nama_barang', 150);
            $table->foreignId('kategori_id')->nullable()
                ->constrained('kategori', 'kategori_id')
                ->onDelete('set null');
            $table->string('ukuran', 50)->nullable();
            $table->enum('kondisi', ['baru', 'bekas bagus', 'bekas sedang'])->default('baru');
            $table->decimal('harga_beli', 12, 2);
            $table->decimal('harga_jual', 12, 2);
            $table->integer('stok')->default(0);
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
