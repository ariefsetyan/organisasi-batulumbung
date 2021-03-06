<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $table = 'kegiatan';
    protected $fillable = [
        'nama_kegiatan', 
        'organisasi_id', 
        'tanggal', 
        'waktu', 
        'tempat', 
        'deskripsi', 
        'image'];
        
    protected $guarded = ['id'];

    public function scopeFilter($query, array $filters) {
       
        $query->when($filters['cariKegiatan'] ?? false, function($query, $cariKegiatan) {
            return $query->where('nama_kegiatan', 'like', '%' . $cariKegiatan . '%')
            ->orWhere('tempat', 'like', '%' . $cariKegiatan . '%')
            ->orWhere('deskripsi', 'like', '%' . $cariKegiatan . '%');        
        });

        $query->when($filters['cariKegiatanAnggota'] ?? false, function($query, $cariKegiatanAnggota) {
            return $query->where('nama_kegiatan', 'like', '%' . $cariKegiatanAnggota . '%')
            ->orWhere('tempat', 'like', '%' . $cariKegiatanAnggota . '%')
            ->orWhere('deskripsi', 'like', '%' . $cariKegiatanAnggota . '%');        
        });

        $query->when($filters['jenis'] ?? false, function($query, $cariKegiatanAnggota) {
            return $query->whereHas('organisasi', function($query) use ($cariKegiatanAnggota) {
                $query->where('jenis', $cariKegiatanAnggota);
            });
        });
    }

    public function organisasi()
    {
        return $this->belongsTo(Organisasi::class);
    }
    
}
