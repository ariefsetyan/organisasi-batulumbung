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

        $query->when($filters['jenis'] ?? false, function($query, $organisasi) {
            return $query->whereHas('organisasi', function($query) use ($organisasi) {
                $query->where('jenis', $organisasi);
            });
        });
    }

    public function organisasi()
    {
        return $this->belongsTo(Organisasi::class);
    }
    
}
