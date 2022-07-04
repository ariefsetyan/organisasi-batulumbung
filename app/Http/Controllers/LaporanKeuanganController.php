<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use App\Models\Organisasi;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanKeuanganExport;
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
    {
        $organisasi = Organisasi::all();
        $pengeluaran = Pengeluaran::latest()->paginate(10);
        $pemasukan = DB::table('pemasukan as p')->select('p.id','jenis','jmlh_pemasukan','tanggal','sumber_dana','keterangan');

        $auth_id = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id', Auth::id());
        })->value('id');

        $auth = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id', Auth::id());
        })->value('jenis');
        return view('pengurus.rekapan.rekapan-keuangan', compact(['pengeluaran', 'organisasi', 'pemasukan', 'auth', 'auth_id'])); 
    }

    public function cariLaporan(Request $request)
	{
        // dd($request->jenis);
        $organisasi = Organisasi::all();
        $rekapan = LaporanKeuangan::latest()->filter(request(['cariLaporan', 'jenis']))->paginate(10)->withQueryString();
       
		return view('pengurus/rekapan/rekapan-keuangan', compact('organisasi', 'rekapan'));
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

        $rekapan = LaporanKeuangan::whereBetween('tanggal', [$dari, $sampai])->latest()->paginate(10);
        $organisasi = Organisasi::all();

        return view ('/pengurus/rekapan/rekapan-keuangan', ['rekapan' => $rekapan, 'dari' => $request->dari, 'sampai' => $request->sampai, 'organisasi' => $organisasi]);
    }

    public function export_excel()
	{
        $nama_file = 'laporan_keuangan'.date('Y-m-d_H-i-s').'.xlsx';
		return Excel::download(new LaporanKeuanganExport, $nama_file);
    }
    
    public function exportPDFKeuangan(Request $request, $id) {
        $data = LaporanKeuangan::Where('id', $id)->firstOrFail();

        $pdf = PDF::loadview('pengurus/laporan/laporan_keuangan_pdf', compact('data'));
               
        return $pdf->stream('laporan-keuangan.pdf');
    }

    
}