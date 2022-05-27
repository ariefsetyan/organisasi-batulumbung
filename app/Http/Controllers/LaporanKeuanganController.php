<?php

namespace App\Http\Controllers;

use App\Models\LaporanKeuangan;
use App\Models\Organisasi;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanKeuanganExport;
use Illuminate\Http\Request;
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
        $laporan = LaporanKeuangan::latest()->paginate(10);
        return view('pengurus.laporan.laporan-keuangan', compact(['laporan', 'organisasi'])); 
    }

    public function cariLaporan(Request $request)
	{
        // dd($request->jenis);
        $organisasi = Organisasi::all();
        $laporan = LaporanKeuangan::latest()->filter(request(['cariLaporan', 'jenis']))->paginate(10)->withQueryString();
       
		return view('pengurus/laporan/laporan-keuangan', compact('organisasi', 'laporan'));
    }

    public function filterTanggal(Request $request)
    {
        $dari = $request->dari .'.'. '00:00:00';
        $sampai = $request->sampai .'.'. '23:59:59';

        if($request->dari == '' && $request->sampai == ''){
            return redirect('laporan/laporan-keuangan');
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

        $laporan = LaporanKeuangan::whereBetween('tanggal', [$dari, $sampai])->latest()->paginate(10);
        $organisasi = Organisasi::all();

        return view ('/pengurus/laporan/laporan-keuangan', ['laporan' => $laporan, 'dari' => $request->dari, 'sampai' => $request->sampai, 'organisasi' => $organisasi]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     return view('pengurus.laporan.laporan-keuangan');
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'jmlh_pemasukan'    => 'required',
            'jmlh_pengeluaran'  => 'required',
            'tanggal'           => 'required',
            'keterangan'        => 'required',
            'sumber_dana'       => 'required',
            'nama_barang'       => 'nullable',
            'jumlah'            => 'nullable',
            'harga_satuan'      => 'nullable',
            'organisasi_id'     => 'required',
            'user_id'           => 'required'
        ]);

        LaporanKeuangan :: create($validateData); 
        
        return redirect('/laporan/laporan-keuangan')-> with('success', 'Data Laporan Keuangan Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LaporanKeuangan  $laporanKeuangan
     * @return \Illuminate\Http\Response
     */
    public function show(LaporanKeuangan $laporanKeuangan, $id)
    {
        $laporan = LaporanKeuangan::with('user')->find($id);
        return view('pengurus/laporan/show-laporan-keuangan', compact('laporan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LaporanKeuangan  $laporanKeuangan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'jmlh_pemasukan'    => 'required',
            'jmlh_pengeluaran'  => 'required',
            'tanggal'           => 'required',
            'keterangan'        => 'required',
            'sumber_dana'       => 'required',
            'nama_barang'       => 'nullable',
            'jumlah'            => 'nullable',
            'harga_satuan'      => 'nullable',
            'organisasi_id'     => 'required',
        ]);
        
        LaporanKeuangan::where('id', $id)
                ->update([
            'jmlh_pemasukan'    => $request->jmlh_pemasukan,
            'jmlh_pengeluaran'  => $request->jmlh_pengeluaran,
            'tanggal'           => $request->tanggal,
            'keterangan'        => $request->keterangan,
            'sumber_dana'       => $request->sumber_dana,
            'nama_barang'       => $request->nama_barang,
            'jumlah'            => $request->jumlah,  
            'harga_satuan'      => $request->harga_satuan,
            'organisasi_id'     => $request->organisasi_id,

            ]);

        return redirect('/laporan/laporan-keuangan')-> with('success', 'Data Laporan Keuangan Berhasil Diubah!');
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LaporanKeuangan  $laporanKeuangan
     * @return \Illuminate\Http\Response
     */
    public function destroy(LaporanKeuangan $laporanKeuangan, $id)
    {
        $laporan = LaporanKeuangan::find($id);
        $laporan->delete();

        return redirect('/laporan/laporan-keuangan')-> with('status', 'Data Laporan Keuangan Berhasil Dihapus!');
    }

    public function indexAnggota()
    {
        $laporan = LaporanKeuangan::latest()->paginate(10);
        return view('anggota.laporan-keuangan', compact('laporan')); 
    }
}