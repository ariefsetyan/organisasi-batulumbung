<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Organisasi;
use App\Models\DetailUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function indexAnggota()
    {

        $auth_id = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id',Auth::id());
        })->value('id');
        
        $level = User::where('level','Anggota')->pluck('id');
         $user = User::whereHas('detail_user', function($q) use($auth_id){
             $q->where('organisasi_id',$auth_id);
         })->whereIn('id',$level)->get();
       
        // $user = User::where('level', '=', 'Anggota')->paginate(10);
        // $jenis = DetailUser::where('user_id', $user->id)->get();
        $jenis = DetailUser::all();
        $organisasi = Organisasi::all();
        $auth = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id',Auth::id());
        })->value('jenis');


        return view('pengurus/anggota/anggota', compact(['user', 'organisasi', 'jenis','auth','auth_id']));
    }

    public function indexPengurus()
    {
        $auth_id = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id',Auth::id());
        })->value('id');

        $level = User::where('level','Anggota')->pluck('id');
         $user = User::whereHas('detail_user', function($q) use($auth_id){
             $q->where('organisasi_id',$auth_id);
         })->whereNotIn('id',$level)->get();
       
        // $user = User::where('level', '=', 'Anggota')->paginate(10);
        // $jenis = DetailUser::where('user_id', $user->id)->get();
        $jenis = DetailUser::all();
        $organisasi = Organisasi::all();
        $auth = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id',Auth::id());
        })->value('jenis');
        
        return view('pengurus/pengurus-crud/pengurus', compact(['user', 'organisasi', 'jenis', 'auth', 'auth_id']));
    }

    public function cariAnggota(Request $request)
	{
        $auth_id = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id',Auth::id());
        })->value('id');
        // dd($auth);

        $level = User::where('level','Anggota')->pluck('id');
        $user = User::whereHas('detail_user', function($q) use($auth_id){
            $q->where('organisasi_id',$auth_id);
        })->whereIn('id',$level)->get();
        
        $jenis = DetailUser::all();
        $auth = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id',Auth::id());
        })->value('jenis');
        
        $user = User::whereHas('detail_user', function($q) use($auth_id){
            $q->where('organisasi_id',$auth_id);
        })->whereIn('id',$level)->latest()->filter(request(['cariAnggota']))->paginate(10)->withQueryString();
		return view('pengurus/anggota/anggota', compact( 'user', 'auth', 'auth_id'));
    }

    public function cariStatusAnggota(Request $request)
	{
        // dd($request);
        $auth_id = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id',Auth::id());
        })->value('id');

        $level = User::where('level','Anggota')->pluck('id');
         $user = User::whereHas('detail_user', function($q) use($auth_id){
             $q->where('organisasi_id',$auth_id);
         })->whereIn('id',$level)->get();

         $auth = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id',Auth::id());
        })->value('jenis');

        $user = User::where('status', $request->jenis)
        ->where('level', 'Anggota')->get();

		return view('pengurus/anggota/anggota', compact( 'user', 'auth', 'auth_id'));
    }

    public function cariPengurus(Request $request)
	{
        $auth_id = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id',Auth::id());
        })->value('id');
        // dd($auth);

        $level = User::where('level','Anggota')->pluck('id');
        $user = User::whereHas('detail_user', function($q) use($auth_id){
            $q->where('organisasi_id',$auth_id);
        })->whereNotIn('id',$level)->get();
        
        $jenis = DetailUser::all();
        $auth = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id',Auth::id());
        })->value('jenis');
        
        $user = User::whereHas('detail_user', function($q) use($auth_id){
            $q->where('organisasi_id',$auth_id);
        })->whereNotIn('id',$level)->latest()->filter(request(['cariPengurus']))->paginate(10)->withQueryString();

		return view('pengurus/pengurus-crud/pengurus', compact( 'user', 'auth', 'auth_id'));

    }

    public function cariStatus(Request $request)
	{
        $auth_id = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id',Auth::id());
        })->value('id');

        $level = User::where('level','Anggota')->pluck('id');
         $user = User::whereHas('detail_user', function($q) use($auth_id){
             $q->where('organisasi_id',$auth_id);
         })->whereNotIn('id',$level)->get();
       
         $user = User::where('status', $request->jenis)
         ->whereHas('detail_user',  function($q) use($auth_id){
            $q->where('organisasi_id',$auth_id);
        })->whereNotIn('id',$level)->get();

        $jenis = DetailUser::all();
        $organisasi = Organisasi::all();
        $auth = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id',Auth::id());
        })->value('jenis');

		return view('pengurus/pengurus-crud/pengurus', compact('organisasi', 'user', 'auth', 'auth_id'));

    }

    public function storeUser(Request $request)
    {
        $message = [
            'required' => 'Wajib diisi!',
            'unique'   => 'NIK sudah terdaftar'
        ];

        $request->validate([
            'nama'              => 'required',
            'nik'               => 'required|unique:user|max:16',
            'tempat_lahir'      => 'required',
            'tgl_lahir'         => 'required',
            'email'             => 'required',
            'password'          => 'required|min:5|max:10',
            'konfirmpassword'   => 'required|min:5|max:10',
            'no_telp'           => 'required',
            'jenis_kelamin'     => 'required',
            'pekerjaan'         => 'required',
            'alamat'            => 'required',
            'level'             => 'required',
            'status'            => 'required'
        ], $message);

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



            DetailUser::create([
                'user_id' => $user->id,
                'organisasi_id' => $request->organisasi_id,
            ]);
        

        if($user->level == "Anggota"){
            return redirect('/anggota/anggota')-> with('success', 'Data Anggota Berhasil Ditambahkan!');
        }
        else{
            return redirect('/pengurus-crud/pengurus')-> with('success', 'Data Pengurus Berhasil Ditambahkan!');
        }

    }

    public function showUser(User $user)
    {
        $organisasis = DetailUser::where('user_id', $user->id)->get();
        // dd($organisasis);
        if($user->level == "Anggota"){
            return view('pengurus.anggota.show-anggota', compact(['user','organisasis']));
        }else{
            return view('pengurus.pengurus-crud.show-pengurus', compact(['user','organisasis']));
        }
    }

    public function updateUser(Request $request, User $user)
    {
        $validateData = $request->validate([
            'nama'          => 'required',
            'nik'           => 'required',
            'tempat_lahir'  => 'required',
            'tgl_lahir'     => 'required',
            'email'         => 'required',
            'no_telp'       => 'required',
            'jenis_kelamin' => 'required',
            'pekerjaan'     => 'required',
            'alamat'        => 'required',
            'level'         => 'required',
            'status'        => 'required'
        ]);

        User::where('id', $user->id)
        ->update($validateData);

        // $organisasi = collect($request->organisasi_id);
        // $indeks = count($organisasi);

        // for($i=0;$i<$indeks;$i++){
        //     DetailUser::where('user_id',$user->id)->delete();
        //     DetailUser::updateOrCreate([
        //         'user_id' => $user->id,
        //         'organisasi_id' => $organisasi[$i],
        //     ]);

        // }

        if($user->level == "Anggota"){
            return redirect('/anggota/anggota')-> with('success', 'Data Anggota Berhasil Diubah!');
        }
        else{
            return redirect('/pengurus-crud/pengurus')-> with('success', 'Data Pengurus Berhasil Diubah!');
        }
    }

    public function destroyUser(User $user)
    {
        User::where('id', $user->id)->delete();

        if($user->level == "Anggota"){
            return redirect('/anggota/anggota')-> with('status', 'Data Anggota Berhasil Dihapus!');
        }else{
            return redirect('/pengurus-crud/pengurus')-> with('status', 'Data Pengurus Berhasil Dihapus!');
        }
    }

    public function updatePasswordPengurus(Request $request)
    {
        
        $gantipass = bcrypt($request->passwordbaru);

        //panggil id session yang login
        $id = $request->session()->get('idlogin');

        //cek password yang di db sesuai dengan id yg login
        $cekpassdb = User::where('id', $id)->value('password');

        if( $gantipass == $cekpassdb || $request->password == $request->konfirmpassword)
        {
            $request->validate([
                'password'        => 'required|min:5|max:10',
                'konfirmpassword' => 'required|min:5|max:10'
            ]);

            User::where('id', $id)->update([
                'password' => bcrypt($request->password)
            ]);
            return redirect('/pengurus/login')->with('success', 'Password Berhasil Diubah!');
        }
        else
        {
            return back()->with('status', 'Gagal Ubah Password!');
        }
    }

    public function profilPengurus(Request $request)
    {
        $id = $request->session()->get('idlogin');
        $user = User::where('id', $id)->get();
        $jenis = DetailUser::where('user_id', $id)->get();

        return view('pengurus.pengurus-crud.profil-pengurus', ['user' => $user, 'jenis' =>$jenis]);
    }

    public function updateProfilPengurus(Request $request, User $user)
    {
        $message = [
            'required' => 'Wajib diisi!',
            'min'      => 'Wajib diisi minimal : 5, maksimal : 10  karakter!',
            'max'      => 'Wajib diisi minimal : 5, maksimal : 10 karakter!',
            'unique'   => 'Data sudah terdaftar'
        ];
        
        $validateData = $request->validate([
            'nama'          => 'required',
            'tempat_lahir'  => 'required',
            'tgl_lahir'     => 'required',
            'level'         => 'required',
            'email'         => 'required',
            'no_telp'       => 'required',
            'jenis_kelamin' => 'required',
            'pekerjaan'     => 'required',
            'alamat'        => 'required',
            'status'        => 'required'
        ]);
        
        User::where('id', $user->id)
                ->update($validateData);

        // $organisasi = collect($request->organisasi_id);
        // $indeks = count($organisasi);

        // for($i=0;$i<$indeks;$i++){
        //     DetailUser::updateOrCreate([
        //         'user_id' => $user->id
        //     ],['organisasi_id' => $organisasi[$i]])->save();

        // }

        return redirect('pengurus-crud/profil-pengurus')-> with('success', 'Data Berhasil Diubah!');
    }

    public function updateProfilAnggota(Request $request, User $user)
    {
        $message = [
            'required' => 'Wajib diisi!',
            'min'      => 'Wajib diisi minimal : 5, maksimal : 10  karakter!',
            'max'      => 'Wajib diisi minimal : 5, maksimal : 10 karakter!',
            'unique'   => 'Data sudah terdaftar'
        ];

        $validateData = $request->validate([
            'nama'          => 'required',
            'tempat_lahir'  => 'required',
            'tgl_lahir'     => 'required',
            'level'         => 'required',
            'email'         => 'required',
            'no_telp'       => 'required',
            'jenis_kelamin' => 'required',
            'pekerjaan'     => 'required',
            'alamat'        => 'required',
            'status'        => 'required'
        ]);
        
        User::where('id', $user->id)
                ->update($validateData);

        // $organisasi = collect($request->organisasi_id);
        // $indeks = count($organisasi);

        // for($i=0;$i<$indeks;$i++){
        //     DetailUser::updateOrCreate([
        //         'user_id' => $user->id
        //     ],['organisasi_id' => $organisasi[$i]])->save();

        // }
        return redirect('/dashboard-anggota')-> with('success', 'Data Berhasil Diubah!');
    }

    public function updatePasswordAnggota(Request $request)
    {
        $gantipass = bcrypt($request->passwordbaru);

        //panggil id session yang login
        $id = $request->session()->get('idlogin');

        //cek password yang di db sesuai dengan id yg login
        $cekpassdb = User::where('id', $id)->value('password');

        if( $gantipass == $cekpassdb || $request->password == $request->konfirmpassword)
        {
            $request->validate([
                'password'        => 'required|min:5|max:10',
                'konfirmpassword' => 'required|min:5|max:10'
            ]);

            User::where('id', $id)->update([
                'password' => bcrypt($request->password)
            ]);
            return redirect('/pengurus/login')->with('success', 'Password Berhasil Diubah!');
        }
        else
        {
            return back()->with('status', 'Gagal Ubah Password!');
        }
    }


}
