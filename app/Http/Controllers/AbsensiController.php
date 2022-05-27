<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Organisasi;
use App\Models\Kegiatan;
use App\Models\ExcelAbsensi;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AbsensiImport;
use App\Exports\AbsensiExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Carbon\Carbon;


class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $absensi = Absensi::latest()->paginate(10);
        $organisasi = Organisasi::all();
        $kegiatan = Kegiatan::all();

        // dd($absensi);
        return view('pengurus.absensi.absensi', compact('absensi', 'organisasi', 'kegiatan'));
    }

    public function daftarAbsensi(Absensi $absensi)
    {
        $absensi = Absensi::latest()->paginate(10);
        $organisasi = Organisasi::all();
        $kegiatan = Kegiatan::all();

        // dd($absensi);
        return view('pengurus/absensi/daftar_absensi', compact('absensi', 'organisasi', 'kegiatan'));
    }

    public function cariAbsensi(Request $request)
    {
        $organisasi = Organisasi::all();
        $absensi = Absensi::latest()->filter(request(['cariAbsensi', 'jenis']))->paginate(10)->withQueryString();

        return view('pengurus/absensi/absensi', compact('organisasi', 'absensi'));
    }

    public function filterTanggal(Request $request)
    {
        $dari = $request->dari .'.'. '00:00:00';
        $sampai = $request->sampai .'.'. '23:59:59';

        if($request->dari == '' && $request->sampai == ''){
            return redirect('absensi/absensi');
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

        $absensi = Absensi::whereBetween('tanggal', [$dari, $sampai])->latest()->paginate(10);
        $organisasi = Organisasi::all();


        return view('/pengurus/absensi/absensi', ['absensi' => $absensi, 'dari' => $request->dari, 'sampai' => $request->sampai, 'organisasi' => $organisasi]);
    }

    // public function import_excel(Request $request)
    // {
    //     // validasi
    //     $this->validate($request, [
    //         'file' => 'required|mimes:csv,xls,xlsx'
    //     ]);

    //     if($request->file('file')) {

    //     // menangkap file excel
    //     $file = $request->file('file');

    //     // membuat nama file unik
    //     $nama_file = rand() . $file->getClientOriginalName();

    //     // upload ke folder file_absensi di dalam folder public
    //     $file->move('files_absensi', $nama_file);
    //     // import data
    //     Excel::import(new AbsensiImport, public_path('files_absensi/' . $nama_file));
    //     }

    //     // alihkan halaman kembali
    //     return redirect('/absensi/absensi');
    // }

    public function export_excel()
    {

        $nama_file = 'absensi' . date('Y-m-d_H-i-s') . '.xlsx';
        return Excel::download(new AbsensiExport, $nama_file);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     return view('pengurus.absensi.create-absensi');
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kegiatan' => 'required',
            'tanggal'       => 'required',
            'organisasi_id' => 'required',
            'file'          => 'required|mimes:csv,xls,xlsx'
        ]);

        // dd($request->validate);

        if($request->file('file')) {
            $file = $request->file('file');

            // menangkap file excel
            $file = $request->file('file');

            // membuat nama file unik
            $nama_file = rand() . $file->getClientOriginalName();

            // upload ke folder file_absensi di dalam folder public
            $file->move('files_absensi', $nama_file);
            // import data
            Excel::import(new AbsensiImport, public_path('files_absensi/' . $nama_file));
        }

        $excel_absensi = ExcelAbsensi::all();

        foreach($excel_absensi as $key){
        $create_data = [
            'nama_kegiatan' => $request->nama_kegiatan,
            'tanggal'       => $request->tanggal,
            'organisasi_id' => $request->organisasi_id,
            'anggota_id'    => $key->anggota_id,
            'nama'          => $key->nama,
            'status'        => $key->status,
            'user_id'        => Auth::user()->id,
        ];


        Absensi::create($create_data);
    }

    DB::table('excel_absensi')->truncate();

        return redirect('/absensi/absensi')->with('success', 'Data Absensi Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    // public function show(Absensi $absensi)
    // {
    //     return view('pengurus.absensi.show-absensi', compact('absensi'));
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    // public function edit(Absensi $absensi)
    // {
    //     return view('pengurus.absensi.edit-absensi', compact('absensi'));
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Absensi $absensi)
    {
        $request->validate([
            'status' => 'required'
        ]);

        Absensi::where('id', $absensi->id)
            ->update([
                'status' => $request->status
            ]);

        return redirect('/absensi/absensi')->with('success', 'Data Absensi Berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Absensi $absensi)
    {
        Absensi::destroy($absensi->id);

        return redirect('/absensi/absensi')->with('status', 'Data Absensi Berhasil Dihapus!');
    }

    public function indexAnggota(Request $request)
    {
        // dd(Auth::guard('web')->user()->id);
        $absensi = Auth::guard('web')->user()->id;
        $data_absensi = Absensi::where('user_id', $absensi)
            ->paginate(10);

        return view('anggota.absensi', compact('data_absensi'));
    }

    public function get_kegiatan($kegiatan)
    {
        $data = DB::table('kegiatan')
        ->where('nama_kegiatan','=',$kegiatan)
        ->get();
        return json_encode($data);

    }

    public function get_absen($params)
    {
        $data = DB::table('absensi')
        ->where('id','=',$params)
        ->get();
        return json_encode($data);

    }

    public function update_absen(Request $request)
    {

        $data = DB::table('absensi')
            ->where('id', $request->id)
            ->update(['nama' => $request->nama_anggota,'nama_kegiatan'=>$request->nama_kegiatan,"organisasi_id"=>$request->jenis_absen,'tanggal'=>$request->tanggal,'status'=>$request->status]);
            return redirect('/absensi/absensi')->with('status', 'Data Absensi Berhasil Diupdate!');
    }

    public function hapus($id)
    {
        DB::table('absensi')->where('id',$id)->delete();
        return redirect('/absensi/absensi')->with('status', 'Data Absensi Berhasil Dihapus!');
    }
}
