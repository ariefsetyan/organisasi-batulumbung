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
        'status',
        'is_label'
    ];

    public function scopeFilter($query, array $filters) {
    
            $query->when($filters ?? false, function($query, $filters) {
                return $query->where('nama', 'like', '%' . $filters['cariAbsensi'] . '%');
                    $query->where('organisasi_id','=', $filters['organisasi']);  
            });

            $query->when($filters ?? false, function($query, $filters) {
                return $query->where('status', 'like', '%' . $filters['cariStatus'] . '%');
                    $query->where('organisasi_id','=', $filters['organisasi']);  
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