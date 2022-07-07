<?php

namespace Database\Seeders;

use App\Models\DetailUser;
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
            'nik'             => '5103026908200005',
            'tempat_lahir'    => 'Denpasar',
            'tgl_lahir'       => '2000-08-29',
            'level'           => 'Sekretaris',
            'email'           => 'windimasyundarii@gmail.com',         
            'password'        => bcrypt('12345'),
            'no_telp'         => '085872300219',
            'jenis_kelamin'   => 'Perempuan',
            'alamat'          => 'Br. Batulumbung, Gulingan',
            'pekerjaan'       => 'Mahasiswa',
            'status'          => '1',
        ]);
       
        User::create([
            'nama'            => 'I Putu Febry Masprayoga',
            'nik'             => '5103020802010009',
            'tempat_lahir'    => 'Denpasar',
            'tgl_lahir'       => '2001-01-08',
            'level'           => 'Ketua',
            'email'           => 'febrymasprayoga@gmail.com',         
            'password'        => bcrypt('12345'),
            'no_telp'         => '08587221219',
            'jenis_kelamin'   => 'Laki-Laki',
            'alamat'          => 'Br. Batulumbung, Gulingan',
            'pekerjaan'       => 'Mahasiswa',
            'status'          => '1',
        ]);

        User::create([
            'nama'            => 'Ni Kadek Lia Mastika',
            'nik'             => '5103024301050082',
            'tempat_lahir'    => 'Denpasar',
            'tgl_lahir'       => '2005-03-01',
            'level'           => 'Sekretaris',
            'email'           => 'liamastika@gmail.com',         
            'password'        => bcrypt('12345'),
            'no_telp'         => '085872300119',
            'jenis_kelamin'   => 'Perempuan',
            'alamat'          => 'Br. Batulumbung, Gulingan',
            'pekerjaan'       => 'Mahasiswa',
            'status'          => '1',
        ]);

        User::create([
            'nama'            => 'Ni Putu Indah Ariandini',
            'nik'             => '5103026901990002',
            'tempat_lahir'    => 'Denpasar',
            'tgl_lahir'       => '2000-01-29',
            'level'           => 'Sekretaris',
            'email'           => 'indahariandini@gmail.com',         
            'password'        => bcrypt('12345'),
            'no_telp'         => '08587230119',
            'jenis_kelamin'   => 'Perempuan',
            'alamat'          => 'Br. Batulumbung, Gulingan',
            'pekerjaan'       => 'Mahasiswa',
            'status'          => '1',
        ]);

        DetailUser::create([
            'user_id'          => '1',
            'organisasi_id'    => '1',
            'status'           => '1'
        ]);

        DetailUser::create([
            'user_id'          => '2',
            'organisasi_id'    => '2',
            'status'           => '1'
        ]);

        DetailUser::create([
            'user_id'          => '3',
            'organisasi_id'    => '3',
            'status'           => '1'
        ]);

        DetailUser::create([
            'user_id'          => '4',
            'organisasi_id'    => '4',
            'status'           => '1'
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
