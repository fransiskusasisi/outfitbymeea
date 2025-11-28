<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Tetap buat tabel dengan nama 'barang' sesuai skema yang Anda berikan
        Schema::create('barangs', function (Blueprint $table) {

            // Kolom Primary Key (bigint(20) UNSIGNED AUTO_INCREMENT)
            $table->bigIncrements('barang_id');

            // Kolom Data
            $table->string('nama_barang', 150)->nullable(false);
            $table->bigInteger('kategori_id')->unsigned()->nullable(); // Nullable
            $table->string('ukuran', 50)->nullable(); // Nullable
            $table->enum('kondisi', ['baru', 'bekas bagus', 'bekas sedang'])->default('baru');
            $table->decimal('harga_beli', 12, 2)->nullable(false);
            $table->decimal('harga_jual', 12, 2)->nullable(false);
            $table->integer('stok')->default(0);

            // Kolom created_at dan updated_at
            // Karena created_at Anda memiliki default Current_timestamp(), kita bisa eksplisit:
            $table->timestamp('created_at')->useCurrent();
            // Tambahkan updated_at
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
