<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    // use HasFactory;
    protected $table = 'event';
    protected $fillable = [
        'nama_event', 
        'organisasi_id', 
        'tanggal', 
        'waktu', 
        'tempat', 
        'keterangan'];
    
    public function scopeFilter($query, array $filters) {
    
        $query->when($filters['cariEvent'] ?? false, function($query, $cariEvent) {
            return $query->where('nama_event', 'like', '%' . $cariEvent . '%')
            ->orWhere('tempat', 'like', '%' . $cariEvent . '%')
            ->orWhere('keterangan', 'like', '%' . $cariEvent . '%');        
        });

        $query->when($filters['cariEventAnggota'] ?? false, function($query, $cariEventAnggota) {
            return $query->where('nama_event', 'like', '%' . $cariEventAnggota . '%')
            ->orWhere('tempat', 'like', '%' . $cariEventAnggota . '%')
            ->orWhere('keterangan', 'like', '%' . $cariEventAnggota . '%');      
        });
        
        $query->when($filters['jenis'] ?? false, function($query, $cariEventAnggota) {
            return $query->whereHas('organisasi', function($query) use ($cariEventAnggota) {
                $query->where('jenis', $cariEventAnggota);
            });
        });
    }

    public function organisasi()
    {
        return $this->belongsTo(Organisasi::class);
    }
    
}
