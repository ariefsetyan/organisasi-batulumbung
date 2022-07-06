<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model
{
    use HasFactory;
    protected $table = 'pemasukan';
    protected $fillable = [
        'user_id', 
        'organisasi_id',
        'jmlh_pemasukan',
        'tanggal', 
        'sumber_dana', 
        'keterangan'];

    public function scopeFilter($query, array $filters) {

        $query->when($filters['cariPemasukanAnggota'] ?? false, function($query, $cariPemasukanAnggota) {
            return $query->where('sumber_dana', 'like', '%' . $cariPemasukanAnggota . '%')
            ->orWhere('keterangan', 'like', '%' . $cariPemasukanAnggota . '%');        
        });

        $query->when($filters['cariLaporan'] ?? false, function($query, $cariLaporan) {
            return $query->where('sumber_dana', 'like', '%' . $cariLaporan . '%')
            ->orWhere('keterangan', 'like', '%' . $cariLaporan . '%');        
        });
    }

    public function organisasi()
    {
        return $this->belongsTo(Organisasi::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

