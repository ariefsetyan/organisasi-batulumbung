<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Organisasi;
use App\Models\DetailUser;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $auth_id = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id',Auth::id());
        })->pluck('id');
        // dd($auth_id);
        
        $jenis = DetailUser::all();
        $organisasi = Organisasi::all();
        $auth = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id',Auth::id());
        })->value('jenis');
        
        $kegiatan = Kegiatan::whereIn('organisasi_id',$auth_id)->latest()->paginate(10);

        return view('pengurus/kegiatan/kegiatan', compact(['kegiatan', 'organisasi', 'jenis', 'auth']) , ['auth_id' => $auth_id[0]]);
    }

    public function cariKegiatan(Request $request)
	{
        $auth_id = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id',Auth::id());
        })->pluck('id');
        // dd($auth);
        
        $jenis = DetailUser::all();
        $auth = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id',Auth::id());
        })->value('jenis');
        
        $kegiatan = Kegiatan::latest()->filter(request(['cariKegiatan', 'jenis']))->paginate(10)->withQueryString();
       
		return view('pengurus/kegiatan/kegiatan', compact(['auth', 'auth_id', 'kegiatan']));
 
    }

    public function filterTanggal(Request $request)
    {
        $auth_id = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id',Auth::id());
        })->pluck('id');
        // dd($auth);
        
        $organisasi = Organisasi::all();
        $auth = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id',Auth::id());
        })->value('jenis');

        $dari = $request->dari .'.'. '00:00:00';
        $sampai = $request->sampai .'.'. '23:59:59';

        if($request->dari == '' && $request->sampai == ''){
            return redirect('kegiatan/kegiatan');
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

        $kegiatan = Kegiatan::whereBetween('tanggal', [$dari, $sampai])->latest()->paginate(10);
        $organisasi = Organisasi::all();

        return view ('/pengurus/kegiatan/kegiatan', ['auth' => $auth, 'auth_id' => $auth_id, 'kegiatan' => $kegiatan, 'dari' => $request->dari, 'sampai' => $request->sampai, 'organisasi' => $organisasi]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $validateData = $request->validate([
            'nama_kegiatan' => 'required',
            'tanggal'       => 'required',
            'waktu'         => 'required',
            'tempat'        => 'required',
            'organisasi_id' => 'required',
            'deskripsi'     => 'required',
            'image'         => 'image|file|mimes:jpg,jpeg,png|max:1024'
        ]);

        // if($request->file('image')) {
        //     $validateData['image'] =  $request->image->move(public_path('images'));
        // }
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        $validateData = array(
            'nama_kegiatan' =>$request->nama_kegiatan,
            'tanggal'       =>$request->tanggal,
            'waktu'         =>$request->waktu,
            'tempat'        =>$request->tempat,
            'organisasi_id' =>$request->organisasi_id,
            'deskripsi'     =>$request->deskripsi,
            'image'         =>$imageName,
            
        );

        Kegiatan::create($validateData);
        
        return redirect('/kegiatan/kegiatan')-> with('success', 'Data Kegiatan Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kegiatan  $kegiatan
     * @return \Illuminate\Http\Response
     */
    public function show(Kegiatan $kegiatan)
    {   
        // dd($kegiatan);
       
    //    $kegiatan = Kegiatan::find($id);
    //    $kegiatan = Kegiatan::all();
       
        return view('pengurus.kegiatan.show-kegiatan', compact('kegiatan'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kegiatan  $kegiatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kegiatan $kegiatan)
    {
        $validateData = $request->validate([
            'nama_kegiatan' => 'required',
            'tanggal'       => 'required',
            'waktu'         => 'required',
            'tempat'        => 'required',
            'deskripsi'     => 'required',
            'image'         => 'required|file|mimes:jpg,jpeg,png|max:1024'
        ]);
       
        
        // dd($request->file('image'));
        // if($request->file('image')){
        //     if($request->oldImage) {
        //         Storage::delete($request->oldImage);
        //         }
        //     $validateData['image'] = $request->file('image')->store('images-kegiatan');  
        // }
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        
        $img_old = Kegiatan::where('id', $kegiatan->id)->get();
        foreach ($img_old as $value) {
            if(!empty($img_old->image)){
                unlink("images/".$value->image);
            }
        }

        Kegiatan::where('id', $kegiatan->id)
                ->update([ 
                    'nama_kegiatan' =>$request->nama_kegiatan,
                    'tanggal'       =>$request->tanggal,
                    'waktu'         =>$request->waktu,
                    'tempat'        =>$request->tempat,
                    'deskripsi'     =>$request->deskripsi,
                    'image'         =>$imageName,
                ]);

        return redirect('/kegiatan/kegiatan')-> with('success', 'Data Kegiatan Berhasil Diubah!');
    }

    public function exportPDF(Request $request, $id) {
        $data = Kegiatan::Where('id', $id)->firstOrFail();
        
        // dd($data->nama_kegiatan);
        // dd($data);

        $pdf = PDF::loadview('pengurus/kegiatan/kegiatan_pdf', compact('data'));
               
        return $pdf->stream('laporan-kegiatan.pdf');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kegiatan  $kegiatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kegiatan $kegiatan)
    {
        if($kegiatan->image) {
            Storage::delete($kegiatan->image);
        }

        Kegiatan::destroy($kegiatan -> id);

        return redirect('/kegiatan/kegiatan')-> with('status', 'Data Kegiatan Berhasil Dihapus!');
    }

    public function indexAnggota()
    {
        $auth_id = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id',Auth::id());
        })->pluck('id');
        // dd($auth);
        
        $jenis = DetailUser::all();
        $auth = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id',Auth::id());
        })->value('jenis');
        
        $kegiatan = Kegiatan::whereIn('organisasi_id',$auth_id)->latest()->paginate(10);

        return view ('anggota/kegiatan', compact(['auth_id', 'auth', 'kegiatan']));
    }

    public function cariKegiatanAnggota(Request $request)
	{
		return view('anggota/kegiatan', [
            "active" => "kegiatan", 
            "kegiatan" => Kegiatan::latest()->filter(request(['cari']))->paginate(10)->withQueryString()
        ]);
 
    }

}
