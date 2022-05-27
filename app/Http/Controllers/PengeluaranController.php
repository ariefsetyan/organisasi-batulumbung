<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class PengeluaranController extends Controller
{
    public function index()
    {
        $data = Pengeluaran::Get_data();
        return view('pengurus.pengeluaran.index',compact('data'));
    }
    public function form_pengeluaran()
    {
        $sumber_dana = Pengeluaran::Get_sumber_dana();
        $organisasi = Pengeluaran::Get_organisasi();
        return view('pengurus.pengeluaran.form',compact('organisasi','sumber_dana'));
    }

    public function simpan(Request $request)
    {

        for ($i = 0;$i<count($request->post('nama_barang')); $i++){
            $nama_barang = $request->nama_barang[$i];
            $data = array(
                "organisasi_id"=>$request->nama_kegiatan,
                "user_id"=>Auth::user()->id,
                "total"=>$request->sum,
                "tanggal"=>"$request->tanggal",
                "nama_barang"=>$nama_barang,
                "jmlh_barang"=>$request->jumlah_barang[$i],
                "satuan_harga"=>$request->harga_barang[$i],
                "sumber_dana"=>$request->sumber_dana,
                "keterangan"=>"$request->keterangan"
            );
//            $pemasukan = Pengeluaran::Insert_pemasukan($data);
            $pemasukan = DB::table('pengeluaran')->insert($data);
        }
        return redirect('pengeluaran');

    }

    public function hapus($id)
    {
        $myarray = explode(',',$id);
        DB::table('pengeluaran')->whereIn('id',$myarray)->delete();
        return redirect('pengeluaran');
    }

    public function view($id)
    {
        return view('pengurus.pengeluaran.detail',compact('id'));
    }

    public function detil($id)
    {
        $myarray = explode(',',$id);
        $data1 = DB::table('pengeluaran as p')
            ->select('o.jenis','p.total', 'ps.sumber_dana', 'p.keterangan','p.tanggal',DB::raw("GROUP_CONCAT(p.id) as id"))
            ->leftJoin('organisasi as o','p.organisasi_id','=','o.id')
            ->leftJoin('pemasukan as ps','p.sumber_dana', '=', 'ps.id')
            ->whereIn('p.id',$myarray)
            ->groupBy('o.jenis','p.total', 'ps.sumber_dana', 'p.keterangan','p.tanggal')
            ->get();
        $data = DB::table('pengeluaran')->orWhereIn('id',$myarray)->get();
        return view('pengurus.pengeluaran.view',compact('data1','data'));
    }

    public function download($id)
    {

        $myarray = explode(',',$id);
        $data1 = DB::table('pengeluaran as p')
            ->select('o.jenis','p.total', 'ps.sumber_dana', 'p.keterangan','p.tanggal',DB::raw("GROUP_CONCAT(p.id) as id"))
            ->leftJoin('organisasi as o','p.organisasi_id','=','o.id')
            ->leftJoin('pemasukan as ps','p.sumber_dana', '=', 'ps.id')
            ->whereIn('p.id',$myarray)
            ->groupBy('o.jenis','p.total', 'ps.sumber_dana', 'p.keterangan','p.tanggal')
            ->get();

        $data = DB::table('pengeluaran')->orWhereIn('id',$myarray)->get();

            $pdf = PDF::loadview('pengurus.pengeluaran.view',['data1'=>$data1,'data'=>$data]);
            return $pdf->download('pengeluaran.pdf');
    }
}
