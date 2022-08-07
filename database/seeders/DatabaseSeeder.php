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
            'nama'            => 'I Wayan Sukarma',
            'nik'             => '5103020412740001',
            'tempat_lahir'    => 'Badung',
            'tgl_lahir'       => '1974-12-04',
            'level'           => 'Ketua',
            'email'           => 'sukarma@gmail.com',         
            'password'        => bcrypt('12345'),
            'no_telp'         => '081809334055',
            'jenis_kelamin'   => 'Laki-Laki',
            'alamat'          => 'Br. Batulumbung, Gulingan',
            'pekerjaan'       => 'Pegawai Swasta',
            'status'          => '1',
        ]);

        User::create([
            'nama'            => 'Ni Nyoman Rai Wiryani',
            'nik'             => '5103024211700002',
            'tempat_lahir'    => 'Gulingan',
            'tgl_lahir'       => '1970-11-02',
            'level'           => 'Sekretaris',
            'email'           => 'wiryani@gmail.com',         
            'password'        => bcrypt('12345'),
            'no_telp'         => '08155759023',
            'jenis_kelamin'   => 'Perempuan',
            'alamat'          => 'Br. Batulumbung, Gulingan',
            'pekerjaan'       => 'Pegawai Swasta',
            'status'          => '1',
        ]);

        User::create([
            'nama'            => 'Ni Luh Sri Artini',
            'nik'             => '5103025610770001',
            'tempat_lahir'    => 'Penyaringan',
            'tgl_lahir'       => '1977-10-16',
            'level'           => 'Ketua',
            'email'           => 'sriartini@gmail.com',         
            'password'        => bcrypt('12345'),
            'no_telp'         => '08587230119',
            'jenis_kelamin'   => 'Perempuan',
            'alamat'          => 'Br. Batulumbung, Gulingan',
            'pekerjaan'       => 'Pegawai Swasta',
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
