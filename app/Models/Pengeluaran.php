<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pengeluaran extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pengeluaran';

    public function scopeGet_data()
    {
        $data = DB::table('pengeluaran as p')
            ->select('o.jenis','p.total', 'ps.sumber_dana', 'p.keterangan','p.tanggal',DB::raw("GROUP_CONCAT(p.id) as id"))
            ->leftJoin('organisasi as o','p.organisasi_id','=','o.id')
            ->leftJoin('pemasukan as ps','p.sumber_dana', '=', 'ps.id')
            ->groupBy('o.jenis','p.total', 'ps.sumber_dana', 'p.keterangan','p.tanggal')
            ->get();
        return $data;
    }

    public function scopeFilter($query, array $filters) {

        $query->when($filters['cariPengeluaranAnggota'] ?? false, function($query, $cariPengeluaranAnggota) {
            return $query->where('sumber_dana', 'like', '%' . $cariPengeluaranAnggota . '%')
            ->orWhere('keterangan', 'like', '%' . $cariPengeluaranAnggota . '%');        
        });

        $query->when($filters['cariLaporan'] ?? false, function($query, $cariLaporan) {
            return $query->where('sumber_dana', 'like', '%' . $cariLaporan . '%')
            ->orWhere('keterangan', 'like', '%' . $cariLaporan . '%');        
        });

        $query->when($filters['jenis'] ?? false, function($query, $cariPengeluaranAnggota) {
            return $query->whereHas('organisasi', function($query) use ($cariPengeluaranAnggota) {
                $query->where('jenis', $cariPengeluaranAnggota);
            });
        });
    }

    public function scopeGet_sumber_dana(){
        return $sumber_dana = DB::table('pemasukan')->get();
    }
    public function scopeGet_organisasi(){
        return DB::table('organisasi')->get();
    }
    public function scopeInsert_pemasukan($data){
        return DB::table('pengeluaran')->insert($data);
    }

    public function organisasi()
    {
        return $this->belongsTo(Organisasi::class);
    }

}
