<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'nama' => 'Pemilik',
                'username' => 'pemilik',
                'password' => 'pemilik',
                'role' => 'pemilik',
                'created_at' => now(),
            ],
            [
                'nama' => 'Kasir',
                'username' => 'kasir',
                'password' => 'kasir',
                'role' => 'kasir',
                'created_at' => now(),
            ],
            [
                'nama' => 'Petugas Gudang',
                'username' => 'gudang',
                'password' => 'gudang',
                'role' => 'petugas_gudang',
                'created_at' => now(),
            ],
        ]);
    }
}
