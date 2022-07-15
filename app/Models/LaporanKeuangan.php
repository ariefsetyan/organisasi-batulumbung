<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanKeuangan extends Model
{
    use HasFactory;
    protected $table = 'laporan_keuangan';
    protected $fillable = [
        'jmlh_pemasukan', 
        'jmlh_pengeluaran', 
        'tanggal',
        'keterangan',
        'sumber_dana', 
        'nama_barang', 
        'jumlah', 
        'harga_satuan', 
        'organisasi_id',
        'user_id'];

    public function scopeFilter($query, array $filters) {

        $query->when($filters['cariLaporan'] ?? false, function($query, $cariLaporan) {
            return $query->where('keterangan', 'like', '%' . $cariLaporan . '%');
        });
    
        $query->when($filters['jenis'] ?? false, function($query, $organisasi) {
            return $query->whereHas('organisasi', function($query) use ($organisasi) {
                $query->where('jenis', $organisasi);
            });
        });
    }

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'kegiatan_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function organisasi()
    {
        return $this->belongsTo(Organisasi::class);
    }

}

