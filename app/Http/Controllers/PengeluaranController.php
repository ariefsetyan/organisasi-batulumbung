<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use App\Models\Pemasukan;
use App\Models\Organisasi;
use App\Models\DetailUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class PengeluaranController extends Controller
{
    public function index()
    {
        // $data = Pengeluaran::Get_data();

        $auth_id = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id',Auth::id());
        })->pluck('id');
        
        $auth = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id',Auth::id());
        })->value('jenis');

        $data = Pengeluaran::whereIn('organisasi_id',$auth_id)->latest()->paginate(10);

        return view('pengurus.pengeluaran.index',compact('data', 'auth', 'auth_id'));
    }
    public function form_pengeluaran()
    {
      
        $auth_id = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id',Auth::id());
        })->value('id');

        $auth = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id',Auth::id());
        })->value('jenis');

        $sumber_dana = Pemasukan::where('organisasi_id', $auth_id)->get();
        $organisasi = Pengeluaran::Get_organisasi();

        return view('pengurus.pengeluaran.form',compact('organisasi','sumber_dana', 'auth', 'auth_id'));
    }

    public function simpan(Request $request)
    {

        for ($i = 0;$i<count($request->post('nama_barang')); $i++){
            $nama_barang = $request->nama_barang[$i];
            $data = array(
                "organisasi_id"=>$request->organisasi_id,
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
        $auth_id = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id',Auth::id());
        })->value('jenis');

        $auth = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id',Auth::id());
        })->value('id');

        $myarray = explode(',',$id);
        // $data1 = DB::table('pengeluaran as p')
        //     ->select('o.jenis','p.total', 'ps.sumber_dana', 'p.keterangan','p.tanggal',DB::raw("GROUP_CONCAT(p.id) as id"))
        //     ->leftJoin('organisasi as o','p.organisasi_id','=','o.id')
        //     ->leftJoin('pemasukan as ps','p.sumber_dana', '=', 'ps.id')
        //     ->whereIn('p.id',$myarray)
        //     ->groupBy('o.jenis','p.total', 'ps.sumber_dana', 'p.keterangan','p.tanggal')
        //     ->get();

        $data1 = Pengeluaran::where('id', $myarray)->get();
        $data = DB::table('pengeluaran')->orWhereIn('id',$myarray)->get();
        return view('pengurus.pengeluaran.view',compact('data1','data', 'auth_id'));
    }

    public function download($id)
    {
        $auth_id = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id',Auth::id());
        })->value('jenis');

        $auth = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id',Auth::id());
        })->value('id');

        $myarray = explode(',',$id);
        // $data1 = DB::table('pengeluaran as p')
        //     ->select('o.jenis','p.total', 'ps.sumber_dana', 'p.keterangan','p.tanggal',DB::raw("GROUP_CONCAT(p.id) as id"))
        //     ->leftJoin('organisasi as o','p.organisasi_id','=','o.id')
        //     ->leftJoin('pemasukan as ps','p.sumber_dana', '=', 'ps.id')
        //     ->whereIn('p.id',$myarray)
        //     ->groupBy('o.jenis','p.total', 'ps.sumber_dana', 'p.keterangan','p.tanggal')
        //     ->get();

        $data1 = Pengeluaran::where('id', $myarray)->get();
        $data = DB::table('pengeluaran')->orWhereIn('id',$myarray)->get();

            $pdf = PDF::loadview('pengurus.pengeluaran.view',['data1'=>$data1,'data'=>$data,'auth'=>$auth,'auth_id'=>$auth_id]);
            return $pdf->download('pengeluaran.pdf');
    }

    public function indexAnggota()
    {
        
        $auth_id = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id',Auth::id());
        })->pluck('id');
        
        $auth = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id',Auth::id());
        })->value('jenis');

        $pengeluaran = Pengeluaran::whereIn('organisasi_id',$auth_id)->latest()->paginate(5);

        return view('anggota.pengeluaran_anggota',compact('pengeluaran', 'auth', 'auth_id'));
    }

    public function cariPengeluaranAnggota(Request $request)
	{
        $auth_id = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id',Auth::id());
        })->pluck('id');
        // dd($auth);
        
        $jenis = DetailUser::all();
        $auth = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id',Auth::id());
        })->value('jenis');
        
        $pengeluaran = Pengeluaran::whereIn('organisasi_id',$auth_id)->latest()->filter(request(['cariPengeluaranAnggota']))->paginate(10)->withQueryString();
       
		return view('anggota/pengeluaran_anggota', compact('auth_id', 'auth', 'pengeluaran'));
 
    }
}
