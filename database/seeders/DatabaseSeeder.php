<?php

namespace Database\Seeders;

use App\Models\Petugas;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Petugas::create([
            'id_petugas' => 'PE0001',
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'nama_petugas' => 'Reihan Andika AM',
            'level' => 'Admin'
        ]);
    }
}
