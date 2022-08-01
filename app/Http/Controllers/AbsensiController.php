<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Organisasi;
use App\Models\User;
use App\Models\DetailUser;
use App\Models\Kegiatan;
use App\Models\ExcelAbsensi;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AbsensiImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $absensi = Absensi::where('is_label','f')->latest()->paginate(10);
        $organisasi = Organisasi::all();

        $auth_id = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id',Auth::id());
        })->value('id');

        $auth = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id',Auth::id());
        })->value('jenis');

        $kegiatan = Kegiatan::where('organisasi_id', $auth_id)->get();
        // dd($absensi);
        return view('pengurus.absensi.absensi', compact('absensi', 'organisasi', 'kegiatan', 'auth', 'auth_id'));
    }

    public function daftarAbsensi(Absensi $absensi, Kegiatan $kegiatan )
    {
               
        $auth_id = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id',Auth::id());
        })->value('id');
        
        $auth = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id',Auth::id());
        })->value('jenis');

        $absensi = Absensi::where('organisasi_id', $auth_id)
        ->where('nama_kegiatan', $kegiatan->nama_kegiatan)->get();

        // dd($absensi);
        return view('pengurus/absensi/daftar_absensi', ['kegiatan'=>$kegiatan->nama_kegiatan], compact(['absensi',  'auth', 'auth_id']));
    }

    public function rekapanAbsensi(Absensi $absensi)
    {
        $organisasi = Organisasi::all();
        $level = User::where('level','Anggota')->pluck('id');
        
        $auth_id = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id',Auth::id());
        })->pluck('id');
        
        $auth = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id',Auth::id());
        })->value('jenis');
        
        $kegiatan = Kegiatan::whereIn('organisasi_id', $auth_id)->get();
        $absensi = Absensi::whereIn('organisasi_id',$auth_id)->latest()->paginate(10);
        $user = DetailUser::whereIn('organisasi_id', $auth_id)->whereIn('id',$level)->get();
        
        return view('pengurus/absensi/rekapan-absensi', compact('absensi', 'organisasi', 'user', 'kegiatan', 'auth', 'auth_id'));
    }

    public function cariAbsensi(Request $request)
    {
        
        $auth_id = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id',Auth::id());
        })->pluck('id');
        
        $auth = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id',Auth::id());
        })->value('jenis');

        $absensi = Absensi::where('organisasi_id',$auth_id)
        ->where('nama_kegiatan', $request->kegiatan)->filter(request(['cariAbsensi']))->paginate(10)->withQueryString();
        $kegiatan = $request->kegiatan;

        // $kegiatan = Kegiatan::whereIn('organisasi_id',$auth_id)->latest()->paginate(10);
        // $absensi = Absensi::whereIn('organisasi_id',$auth_id)->latest()->filter(request(['cariAbsensi']))->paginate(10)->withQueryString();

        return view('pengurus/absensi/daftar_absensi', compact('absensi', 'kegiatan', 'auth_id', 'auth'));
    }


    public function cariStatus(Request $request)
    {
        
        $auth_id = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id',Auth::id());
        })->pluck('id');
        
        $auth = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id',Auth::id());
        })->value('jenis');

        $absensi = Absensi::where('status', $request->jenis)
        ->where('organisasi_id',$auth_id)
        ->where('nama_kegiatan', $request->kegiatan)->get();

        $kegiatan = $request->kegiatan;

        return view('pengurus/absensi/daftar_absensi', compact(['absensi', 'auth_id', 'auth', 'kegiatan']));
    }

    public function filterTanggal(Request $request)
    {
        // dd($request->all());
        $dari = $request->dari;
        $sampai = $request->sampai;

        if($request->dari == '' && $request->sampai == ''){
            return redirect('absensi/rekapan-absensi');
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
        
        $auth = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id',Auth::id());
        })->value('jenis');
        
        
        $auth_id = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id',Auth::id());
        })->pluck('id');

        $kegiatan = Kegiatan::whereBetween('tanggal', [$dari, $sampai])
        ->where('organisasi_id', $auth_id)->latest()->paginate(10);


        return view('/pengurus/absensi/rekapan-absensi', ['kegiatan' => $kegiatan, 'dari' => $request->dari, 'sampai' => $request->sampai, 'auth' => $auth, 'auth_id' => $auth_id]);
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

    public function cetakAbsensi(Request $request, Kegiatan $kegiatan)
    {        
    
        $auth_id = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id',Auth::id());
        })->value('id');
        
        $auth = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id',Auth::id());
        })->value('jenis');

        $absensi = Absensi::where('organisasi_id', $auth_id)->get();

        return view('pengurus/absensi/cetak-absensi',  compact(['absensi',  'auth', 'auth_id']));
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
        Absensi::where('is_label','f')->update(['is_label'=>'t']);
        foreach($excel_absensi as $key){
        $create_data = [
            'nama_kegiatan' => $request->nama_kegiatan,
            'tanggal'       => $request->tanggal,
            'organisasi_id' => $request->organisasi_id,
            'nama'          => $key->nama,
            'status'        => $key->status,
            'user_id'        => $key->user_id,
            'is_label'=>'f'
        ];

        Absensi::create($create_data);
    }

    DB::table('excel_absensi')->truncate();

        return redirect('/absensi/absensi')->with('success', 'Data Absensi Berhasil Ditambahkan!');
    }

    
    public function update(Request $request, Absensi $absensi)
    {
        $request->validate([
            'status' => 'required'
        ]);

        Absensi::where('id', $absensi->id)
            ->update([
                'status' => $request->status
            ]);
        
        $kegiatan = Kegiatan::where('nama_kegiatan', $absensi->nama_kegiatan)->get();

        return redirect('/absensi/daftar_absensi/'  .$kegiatan[0]->id)->with('success', 'Data Absensi Berhasil Diubah!');
    }

   
    public function destroy(Absensi $absensi)
    {
        Absensi::destroy($absensi->id);

        return redirect('/absensi/absensi')->with('status', 'Data Absensi Berhasil Dihapus!');
    }

    public function indexAnggota(Request $request)
    {
        // dd(Auth::guard('web')->user()->id);
        $absensi = Auth::guard('web')->user()->id;
        $organisasi = Organisasi::all();
        $data_absensi = Absensi::where('user_id', $absensi)->latest()->paginate(10);

        return view('anggota.absensi', compact('data_absensi', 'organisasi', 'absensi'));
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

    public function hapus($id)
    {
        DB::table('absensi')->where('id',$id)->delete();
        return redirect('/absensi/absensi')->with('status', 'Data Absensi Berhasil Dihapus!');
    }

    public function cariAbsensiAnggota(Request $request)
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
    
        $absensi = Auth::guard('web')->user()->id;
        $data_absensi = Absensi::where('user_id', $absensi)->whereIn('organisasi_id',$auth_id)->latest()->filter(request(['cariAbsensiAnggota', 'jenis']))->paginate(10)->withQueryString();
       
		return view('anggota/absensi', compact('auth_id', 'auth', 'data_absensi', 'organisasi'));
 
    }
}
