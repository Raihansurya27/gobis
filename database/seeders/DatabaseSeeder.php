<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Role;
use App\Models\Kabupaten;
use App\Models\Provinsi;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Fasilitas;

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

        Provinsi::create([
            'nama' => 'sumatera barat',
        ]);

        Provinsi::create([
            'nama' => 'riau',
        ]);

        Kabupaten::create([
            'nama' => 'padang',
            'provinsi_id' => 1,
        ]);

        Kabupaten::create([
            'nama' => 'Pekanbaru',
            'provinsi_id' => 2,
        ]);

        Kecamatan::create([
            'nama' => 'pauh',
            'kabupaten_id' => 1,
        ]);

        Kecamatan::create([
            'nama' => 'padang utara',
            'kabupaten_id' => 1,
        ]);

        Kecamatan::create([
            'nama' => 'panam',
            'kabupaten_id' => 2,
        ]);

        Fasilitas::create([
            'nama' => 'Full AC'
        ]);

        Fasilitas::create([
            'nama' => 'WiFi'
        ]);

    }
}
