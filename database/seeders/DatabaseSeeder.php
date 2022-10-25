<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Role;

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

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::factory(3)->create();

        Kelas::create([
            'nama_kelas' => 'ekonomi',
        ]);

        Kelas::create([
            'nama_kelas' => 'eksekutif',
        ]);

        Role::create([
            'nama_role' => 'admin',
        ]);

        Role::create([
            'nama_role' => 'pelanggan',
        ]);

    }
}
