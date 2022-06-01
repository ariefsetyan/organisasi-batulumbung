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
        if($filters['jenis'] == null){
            $query->when($filters['cariAbsensi'] ?? false, function($query, $cariAbsensi) {
            return $query->where('nama', 'like', '%' . $cariAbsensi . '%')
            ->orWhere('status', 'like', '%' . $cariAbsensi . '%')->orWhere('organisasi_id','=',$filters['jenis']);
        });
        }
        if($filters['cariAbsensi'] == null){
            $query->when($filters['jenis'] ?? false, function($query, $organisasi) {
                return $query->whereHas('organisasi', function($query) use ($organisasi) {
                    $query->where('organisasi_id','=', $organisasi);
                });
            });
        }else{
            $query->when($filters ?? false, function($query, $filters) {
                return $query->where('nama', 'like', '%' . $filters['cariAbsensi'] . '%');
                    $query->where('organisasi_id','=', $filters['organisasi']);  
            });
        }
        
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