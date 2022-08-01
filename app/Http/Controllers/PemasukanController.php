<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organisasi;
use App\Models\DetailUser;
use App\Models\Pemasukan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PemasukanController extends Controller
{
    public function index()
    {
        // $organisasi = DB::table('organisasi')->get();

        $auth_id = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id',Auth::id());
        })->pluck('id');
        
        $auth = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id',Auth::id());
        })->value('jenis');

        $data = Pemasukan::whereIn('organisasi_id',$auth_id)->latest()->paginate(10);

        return view('pengurus.pemasukan.index',compact('data', 'auth', 'auth_id'));
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
        return redirect('pemasukan')->with('success', 'Data Pemasukan Berhasil Ditambahkan!');
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
        $organisasi = DB::table('organisasi')->get();

        $auth_id = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id',Auth::id());
        })->pluck('id');
        
        $auth = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id',Auth::id());
        })->value('jenis');

        $rganisasi = Organisasi::all();
        $pemasukan = Pemasukan::whereIn('organisasi_id',$auth_id)->latest()->paginate(5);
        
        return view('anggota.pemasukan_anggota',compact('auth', 'auth_id', 'pemasukan', 'organisasi'));
    }

    public function cariPemasukanAnggota(Request $request)
	{
        $auth_id = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id',Auth::id());
        })->pluck('id');
        // dd($auth);
        
        $jenis = DetailUser::all();
        $auth = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id',Auth::id());
        })->value('jenis');
        
        $organisasi = Organisasi::all();
        $pemasukan = Pemasukan::whereIn('organisasi_id',$auth_id)->latest()->filter(request(['cariPemasukanAnggota', 'jenis']))->paginate(10)->withQueryString();
       
		return view('anggota/pemasukan_anggota', compact('auth_id', 'auth', 'pemasukan', 'organisasi'));
 
    }
}
