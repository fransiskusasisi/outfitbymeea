<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // ✅ Jalankan semua seeder yang kamu buat
        $this->call([
            UserSeeder::class,
            BarangSeeder::class,
        ]);
    }
}
