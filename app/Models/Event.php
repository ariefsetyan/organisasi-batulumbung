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
