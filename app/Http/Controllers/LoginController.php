<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DetailUser;
use App\Models\Kegiatan;
use App\Models\Pengumuman;
use App\Models\Organisasi;
use App\Models\Event;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexPengurus()
    {
        return view('pengurus.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function prosesLogin(Request $request)
    {
        //login anggota
        $emaillogin = User::where('email', $request->email)->first();
        // dd($emaillogin);

        if(!$emaillogin)
        {
            //dd('email salah');
            return redirect()->back()->with('status', 'Email salah');
        }

        $passwordpengurus = Hash::check($request->password, $emaillogin->password);

        if(!$passwordpengurus)
        {
            //dd('password salah');
            return redirect()->back()->with('status', 'Password salah');
        }

        $loginpengurus = Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password,'status'=>"1"]);
        if($loginpengurus == false)
        {
            //dd('password salah');
            return redirect()->back()->with('status', 'Menunggu Konfirmasi dari Pengurus');
        }
        $id = User::where('email', $request->email)->value('id');
                session([
                    'idlogin' => $id,
                    // 'namalogin' => $tampilnama,
                ]);

        if($loginpengurus)
        {
            $request->session()->regenerate();

            $level = User::where('email', $request->email)->value('level');

            if($level == "Anggota"){
                return redirect()->intended('/dashboard-anggota');
            }
            else{
                return redirect()->intended('/pengurus/dashboard');
            }
        }
        // else
        // {
        //     return redirect()->back()->with('status', 'Akun tidak terdaftar');
        // }

    }

    public function dashboardPengurus(Request $request)
    {
        $auth_id = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id', Auth::id());
        })->pluck('id');


        $id = $request->session()->get('idlogin');
        $semua = User::whereHas('detail_user',function($q) use($auth_id){
            $q->where('organisasi_id',$auth_id);
        })->where('id', $id)->get();

        $kegiatan = Kegiatan::whereIn('organisasi_id',$auth_id)->whereYear('tanggal', date('Y'))->whereMonth('tanggal', date('m'))->get();
        $organisasi = Organisasi::all();
        $pengumuman = Pengumuman::whereIn('organisasi_id',$auth_id)->whereYear('tanggal', date('Y'))->whereMonth('tanggal', date('m'))->get();
        $event = Event::whereIn('organisasi_id',$auth_id)->whereYear('tanggal', date('Y'))->whereMonth('tanggal', date('m'))->get();

        //hitung
        $hitunganggota= User::where('level', 'Anggota')->whereHas('detail_user',function($q) use($auth_id){
            $q->whereIn('organisasi_id',$auth_id);
        })->count();
        $hitungevent = count($event);
        $hitungkegiatan = count($kegiatan);
        $hitungpengumuman = count($pengumuman);

        $grafik = DB::table('absensi as a')
            ->select('jenis','a.nama_kegiatan',DB::raw('count(*) as jumlah'))
            ->leftJoin('kegiatan as k','a.nama_kegiatan','=','k.nama_kegiatan')
            ->leftJoin('organisasi as o','a.organisasi_id','=','o.id')
            ->groupBy('a.nama_kegiatan','jenis')
            ->get();
        $grafik1 = DB::table('absensi as a')
            ->select('a.nama_kegiatan',DB::raw('count(*) as jumlah'))
            ->leftJoin('kegiatan as k','a.nama_kegiatan','=','k.nama_kegiatan')
            ->groupBy('a.nama_kegiatan')
            ->get();

        return view('/pengurus/dashboard', compact(['kegiatan', 'organisasi', 'pengumuman', 'event', 'hitunganggota', 'hitungevent', 'hitungkegiatan', 'hitungpengumuman','grafik1','grafik']));

    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/pengurus/login');
    }

    public function indexAnggota()
    {
        return view('anggota.login');
    }

    public function prosesLoginAnggota(Request $request)
    {
        //login anggota
        $emaillogin = User::where('email', $request->email)->first();
        // dd($emaillogin);

        if(!$emaillogin)
        {
            //dd('email salah');
            return redirect()->back()->with('status', 'Email salah');
        }

        $passwordanggota = Hash::check($request->password, $emaillogin->password);

        if(!$passwordanggota)
        {
            //dd('password salah');
            return redirect()->back()->with('status', 'Password salah');
        }

        $loginanggota = Auth::guard('anggota')->attempt(['email' => $request->email, 'password' => $request->password]);
        $id = User::where('email', $request->email)->value('id');
                session([
                    'idlogin' => $id,
                    // 'namalogin' => $tampilnama,
                ]);

        if($loginanggota)
        {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard-anggota');
        }
        // else
        // {
        //     return redirect()->back()->with('status', 'Akun tidak terdaftar');
        // }

    }

    public function dashboardAnggota(Request $request)
    {
        $id = $request->session()->get('idlogin');
        $semua = User::where('id', $id)->get();
        $organisasis = DetailUser::where('user_id', $id)->get();
        // dd($organisasis);
        $or = Organisasi::all();

        return view('/anggota/dashboard-anggota', (compact(['semua', 'organisasis','or'])));

    }

    // public function logoutAnggota(Request $request)
    // {
    //     Auth::logout();
    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();
    //     return redirect('/anggota/login');
    // }

    public function homePage(Request $request)
    {
        $kegiatan = Kegiatan::latest()->paginate(5);
        $organisasi = Organisasi::all();
        $pengumuman = Pengumuman::latest()->paginate(5);
        // dd($pengumuman);
        $event = Event::whereYear('tanggal', date('Y'))->whereMonth('tanggal', date('m'))->latest()->paginate(5);

        return view('/pengurus/index', compact(['kegiatan', 'organisasi', 'pengumuman', 'event']));
    }

    function downloadPengumuman($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        $pathToFile = public_path('files_pengumuman/' . $pengumuman->file);
        
        if(!File::exists($pathToFile)){
            return redirect('pengurus/index'.$id)->with('file_404', 'Berkas/file tidak ditemukan');
        }

        return response()->download($pathToFile, $pengumuman->file_name);
    }      

    
}
