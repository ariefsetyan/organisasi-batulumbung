<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $table = 'absensi';
    protected $fillable = [
        'user_id',
        'organisasi_id',
        'nama', 
        'nama_kegiatan', 
        'tanggal',
        'status'
    ];

    public function scopeFilter($query, array $filters) {
    
        $query->when($filters['cariAbsensi'] ?? false, function($query, $cariAbsensi) {
            return $query->where('nama', 'like', '%' . $cariAbsensi . '%')
            ->orWhere('status', 'like', '%' . $cariAbsensi . '%');
        });
    
        $query->when($filters['jenis'] ?? false, function($query, $organisasi) {
            return $query->whereHas('organisasi', function($query) use ($organisasi) {
                $query->where('jenis', $organisasi);
            });
        });
    }

    // relasi
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function organisasi()
    {
        return $this->belongsTo(Organisasi::class);
    }

}