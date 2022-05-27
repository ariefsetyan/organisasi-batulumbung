<?php

namespace App\Http\Controllers;

use App\Models\Register;
use App\Models\User;
use App\Models\DetailUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $register = Register::all();
        return view('pengurus.register', compact('register'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pengurus.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = [
            'required' => 'Wajib diisi!',
            'min'      => 'Wajib diisi minimal : 5, maksimal : 10  karakter!',
            'max'      => 'Wajib diisi minimal : 5, maksimal : 10 karakter!',
            'unique'   => 'NIK sudah terdaftar'
        ];

//        $request->validate([
//            'nama'              => 'required',
//            'nik'               => 'required|unique',
//            'tempat_lahir'      => 'required',
//            'tgl_lahir'         => 'required',
//            'email'             => 'required',
//            'password'          => 'required|min:5|max:10',
//            'konfirmpassword'   => 'required|min:5|max:10',
//            'no_telp'           => 'required',
//            'jenis_kelamin'     => 'required',
//            'pekerjaan'         => 'required',
//            'alamat'            => 'required',
//            'level'             => 'required',
//            'status'            => 'required'
//        ], $message);

        $user = User :: create([
                'nama'              => $request->nama,
                'nik'               => $request->nik,
                'tempat_lahir'      => $request->tempat_lahir,
                'tgl_lahir'         => $request->tgl_lahir,
                'email'             => $request->email,
                'password'          => Hash::make($request->password),
                'no_telp'           => $request->no_telp,
                'jenis_kelamin'     => $request->jenis_kelamin,
                'pekerjaan'         => $request->pekerjaan,
                'alamat'            => $request->alamat,
                'level'             => $request->level,
                'status'            => $request->status
            ]);

            $organisasi = collect($request->organisasi_id);
            $indeks = count($organisasi);

            for($i=0;$i<$indeks;$i++){
                DetailUser::create([
                    'user_id' => $user->id,
                    'organisasi_id' => $organisasi[$i],
                ]);
            }

    // dd ($request->all());
        return redirect('/pengurus/login')->with('success', 'Registrasi Berhasil!');
    }

    public function verifikasi_akun()
    {
        $data_user = DB::table('user')->where('status','=','Tidak Aktif')->get();
        return view('pengurus.verifikasi.index',compact('data_user'));
    }

    public function update_akun($id)
    {
        DB::table('user')
            ->where('id','=',$id)
            ->update(['status'=>'Aktif']);
        return redirect('verifikasi-akun');
    }

}
