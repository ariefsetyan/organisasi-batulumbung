<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organisasi extends Model
{
    protected $table = 'organisasi';
    protected $fillable = ['jenis', 'kode'];

    public function user()
    {
        return $this->HasMany(User::class);
    }

    public function detailUser()
    {
        return $this->HasMany(DetailUser::class);
    }

    public function kegiatan()
    {
        return $this->HasMany(Kegiatan::class);
    }
    public function absensi()
    {
        return $this->HasMany(Absensi::class);
    }

    public function event()
    {
        return $this->HasMany(Event::class);
    }

    public function pengumuman()
    {
        return $this->HasMany(Pengumuman::class);
    }

    public function laporanKeuangan()
    {
        return $this->HasMany(LaporanKeuangan::class);
    }
}


