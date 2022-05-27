<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Organisasi;

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

        User::create([
            'nama'            => 'Ni Putu Windi Masyundari',
            'nik'             => '510302608200005',
            'tempat_lahir'    => 'Denpasar',
            'tgl_lahir'       => '2000-08-29',
            'level'           => 'Sekretaris',
            'email'           => 'windimasyundarii@gmail.com',         
            'password'        => bcrypt('12345'),
            'no_telp'         => '085872300219',
            'jenis_kelamin'   => 'Perempuan',
            'alamat'          => 'Br. Batulumbung, Gulingan',
            'no_telp'         => '08567809809',
            'pekerjaan'       => 'Mahasiswa',
            'status'          => 'Aktif',
        ]);

        Organisasi::create([
            'kode' => 'ST',
            'jenis' => 'Sekaa Teruna'
        ]);

        Organisasi::create([
            'kode' => 'SG',
            'jenis' => 'Sekaa Gong'
        ]);

        Organisasi::create([
            'kode' => 'SS',
            'jenis' => 'Sekaa Santi'
        ]);

        Organisasi::create([
            'kode' => 'PKK',
            'jenis' => 'PKK'
        ]);
    }
}
