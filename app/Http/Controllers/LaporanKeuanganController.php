<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use App\Models\Organisasi;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanKeuanganExport;
use App\Models\Pemasukan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use PDF;

class LaporanKeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { $auth_id = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id', Auth::id());
        })->pluck('id');

        $auth = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id', Auth::id());
        })->value('jenis');

        $organisasi = Organisasi::all();
        $pengeluaran = Pengeluaran::whereIn('organisasi_id',$auth_id)->get();
        //$pemasukan = DB::table('pemasukan as p')->select('p.id','jenis','jmlh_pemasukan','tanggal','sumber_dana','keterangan');
        $pemasukan = Pemasukan::whereIn('organisasi_id',$auth_id)->get();

        $rekapan = $pemasukan->merge($pengeluaran)->sortByDesc('tanggal');

        $total_pemasukan = Pemasukan::whereIn('organisasi_id',$auth_id)->selectRaw('sum(jmlh_pemasukan) as total_pemasukan')->value('total_pemasukan');
        $total_pengeluaran = Pengeluaran::whereIn('organisasi_id',$auth_id)->selectRaw('sum(total) as total_pengeluaran')->value('total_pengeluaran');
        //$pdf = PDF::loadview('pengurus/rekapan/cetak-keuangan', compact('rekapan'));
   
        return view('pengurus.rekapan.rekapan-keuangan', compact(['rekapan', 'organisasi', 'pemasukan', 'auth', 'auth_id','total_pemasukan','total_pengeluaran'])); 
    }

    public function cariLaporan(Request $request)
	{
        $auth_id = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id', Auth::id());
        })->pluck('id');

        $auth = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id', Auth::id());
        })->value('jenis');

        $organisasi = Organisasi::all();
        $pengeluaran = Pengeluaran::whereIn('organisasi_id',$auth_id)->filter(request(['cariLaporan']))->paginate(10)->withQueryString();
        //$pemasukan = DB::table('pemasukan as p')->select('p.id','jenis','jmlh_pemasukan','tanggal','sumber_dana','keterangan');
        $pemasukan = Pemasukan::whereIn('organisasi_id',$auth_id)->filter(request(['cariLaporan']))->paginate(10)->withQueryString();

        $rekapan = $pemasukan->merge($pengeluaran)->sortByDesc('tanggal');

        $total_pemasukan = Pemasukan::whereIn('organisasi_id',$auth_id)->selectRaw('sum(jmlh_pemasukan) as total_pemasukan')->value('total_pemasukan');
        $total_pengeluaran = Pengeluaran::whereIn('organisasi_id',$auth_id)->selectRaw('sum(total) as total_pengeluaran')->value('total_pengeluaran');
        
		return view('pengurus/rekapan/rekapan-keuangan', compact('organisasi', 'rekapan', 'auth', 'auth_id', 'total_pemasukan', 'total_pengeluaran'));
    }

    public function filterTanggal(Request $request)
    {
        $dari = $request->dari .'.'. '00:00:00';
        $sampai = $request->sampai .'.'. '23:59:59';

        if($request->dari == '' && $request->sampai == ''){
            return redirect('rekapan/rekapan-keuangan');
        }

        if($request->dari == ''){
            return redirect()->back()->withInput()->with('status', 'Tanggal awal filter harus diisi');
        }

        if($request->sampai == ''){
            return redirect()->back()->withInput()->with('status', 'Tanggal akhir filter harus diisi');
        }
        
        if($request->dari > $request->sampai){
            return redirect()->back()->withInput()->with('status', 'Tanggal awal tidak boleh lebih dari tanggal akhir filter');
        }

        $auth_id = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id', Auth::id());
        })->pluck('id');

        $auth = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id', Auth::id());
        })->value('jenis');

        $organisasi = Organisasi::all();
        $pengeluaran = Pengeluaran::whereIn('organisasi_id',$auth_id)->whereBetween('tanggal', [$dari, $sampai])->get();
        //$pemasukan = DB::table('pemasukan as p')->select('p.id','jenis','jmlh_pemasukan','tanggal','sumber_dana','keterangan');
        $pemasukan = Pemasukan::whereIn('organisasi_id',$auth_id)->whereBetween('tanggal', [$dari, $sampai])->get();

        $rekapan = $pemasukan->merge($pengeluaran)->sortByDesc('tanggal');
        $organisasi = Organisasi::all();

        $total_pemasukan = Pemasukan::whereIn('organisasi_id',$auth_id)->selectRaw('sum(jmlh_pemasukan) as total_pemasukan')->value('total_pemasukan');
        $total_pengeluaran = Pengeluaran::whereIn('organisasi_id',$auth_id)->selectRaw('sum(total) as total_pengeluaran')->value('total_pengeluaran');
        //$pdf = PDF::loadview('pengurus/rekapan/cetak-keuangan', compact('rekapan'));

        return view ('/pengurus/rekapan/rekapan-keuangan', ['rekapan' => $rekapan, 'dari' => $request->dari, 'sampai' => $request->sampai, 'organisasi' => $organisasi, 'auth' => $auth, 'total_pemasukan' =>  $total_pemasukan,'total_pengeluaran' => $total_pengeluaran]);
    }
    
    public function cetakKeuangan(Request $request) {
        $auth_id = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id', Auth::id());
        })->pluck('id');

        $auth = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id', Auth::id());
        })->value('jenis');

        $pengeluaran = Pengeluaran::whereIn('organisasi_id',$auth_id)->get();
        //$pemasukan = DB::table('pemasukan as p')->select('p.id','jenis','jmlh_pemasukan','tanggal','sumber_dana','keterangan');
        $pemasukan = Pemasukan::whereIn('organisasi_id',$auth_id)->get();

        $rekapan = $pemasukan->merge($pengeluaran)->sortByDesc('tanggal');
        $total_pemasukan = Pemasukan::whereIn('organisasi_id',$auth_id)->selectRaw('sum(jmlh_pemasukan) as total_pemasukan')->value('total_pemasukan');
        $total_pengeluaran = Pengeluaran::whereIn('organisasi_id',$auth_id)->selectRaw('sum(total) as total_pengeluaran')->value('total_pengeluaran');
        //$pdf = PDF::loadview('pengurus/rekapan/cetak-keuangan', compact('rekapan'));
               
        return view('pengurus.rekapan.cetak-keuangan',compact(['rekapan','auth','total_pemasukan','total_pengeluaran']));
    }

    
}