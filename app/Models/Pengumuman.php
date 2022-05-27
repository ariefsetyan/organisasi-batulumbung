<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $table = 'pengumuman';
    protected $fillable = [
        'judul', 
        'organisasi_id', 
        'tanggal', 
        'waktu', 
        'isi', 
        'file'];

    public function scopeFilter($query, array $filters) {
       
        $query->when($filters['cariPengumuman'] ?? false, function($query, $cariPengumuman) {
            return $query->where('judul', 'like', '%' . $cariPengumuman . '%')
            ->orWhere('isi', 'like', '%' . $cariPengumuman . '%');        
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



