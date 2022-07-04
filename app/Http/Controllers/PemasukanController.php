<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organisasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PemasukanController extends Controller
{
    public function index()
    {
        $data = DB::table('pemasukan as p')->select('p.id','jenis','jmlh_pemasukan','tanggal','sumber_dana','keterangan')
            ->leftJoin('organisasi as o','p.organisasi_id','=','o.id')
            ->get();
        $organisasi = DB::table('organisasi')->get();

        return view('pengurus.pemasukan.index',compact('data','organisasi'));
    }

    public function form()
    {
        $auth_id = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id', Auth::id());
        })->value('id');

        $auth = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id', Auth::id());
        })->value('jenis');

        $organisasi = DB::table('organisasi')->get();
        return view('pengurus.pemasukan.form',compact('organisasi', 'auth', 'auth_id'));
    }

    public function simpan(Request $request)
    {
        $data = array(
            "organisasi_id"=>$request->organisasi_id,
            "jmlh_pemasukan"=>$request->jumlah_pemasukan,
            "tanggal"=>"$request->tanggal",
            "sumber_dana"=>"$request->sumber_dana",
            "keterangan"=>"$request->keterangan",
            "user_id"=>Auth::user()->id
        );
        $pemasukan = DB::table('pemasukan')->insert($data);
        return redirect('pemasukan');
    }

    public function hapus($id)
    {
        DB::table('pemasukan')->where('id',$id)->delete();
        return redirect('pemasukan');
    }

    public function form_edit($id)
    {
        $organisasi = DB::table('organisasi')->get();
        $datas = DB::table('pemasukan')->where('id','=',$id)->get();
        return view('pengurus.pemasukan.form_edit',compact('organisasi','datas'));
    }

    public function update_pemasukan(Request $request)
    {
        $data = array(
           
            "jmlh_pemasukan"=>$request->jumlah_pemasukan,
            "tanggal"=>"$request->tanggal",
            "sumber_dana"=>"$request->sumber_dana",
            "keterangan"=>"$request->keterangan",
            "user_id"=>Auth::user()->id
        );
        $pemasukan = DB::table('pemasukan')->where('id',$request->id)->update($data);
        return redirect('pemasukan');
    }

    public function indexAnggota()
    {
        $data = DB::table('pemasukan as p')->select('p.id','jenis','jmlh_pemasukan','tanggal','sumber_dana','keterangan')
            ->leftJoin('organisasi as o','p.organisasi_id','=','o.id')
            ->get();
        $organisasi = DB::table('organisasi')->get();
        return view('anggota.pemasukan_anggota',compact('data','organisasi'));
    }
}
