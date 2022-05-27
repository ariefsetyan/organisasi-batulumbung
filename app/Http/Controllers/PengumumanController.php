<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use App\Models\Organisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organisasi = Organisasi::all();
        $pengumuman = Pengumuman::latest()->paginate(10);
        return view('pengurus/pengumuman/pengumuman', compact('pengumuman', 'organisasi'));
    }

    public function cariPengumuman(Request $request)
	{
		$organisasi = Organisasi::all();
        $pengumuman = Pengumuman::latest()->filter(request(['cariPengumuman', 'jenis']))->paginate(10)->withQueryString();
       
		return view('pengurus/pengumuman/pengumuman', compact('organisasi', 'pengumuman'));
 
 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validateData = $request->validate([
        $request->validate([
            'judul'             => 'required|max:255',
            'tanggal'           => 'required',
            'waktu'             => 'required',
            'organisasi_id'     => 'required',
            'isi'               => 'required',
            'file'              => 'file|nullable|mimes:pdf|max:1024'
        ]);

        $create_data = [
            'judul'         => $request->judul,
            'tanggal'       => $request->tanggal,
            'waktu'         => $request->waktu,
            'organisasi_id' => $request->organisasi_id,
            'isi'           => $request->isi,
        ];

        if($request->file('file')) {
            $file = $request->file('file');

            // membuat nama file unik
            $nama_file = rand() . $file->getClientOriginalName();
    
            // upload ke folder file_pengumuman di dalam folder public
            $file->move('files_pengumuman', $nama_file);

            $create_data['file'] = $nama_file;

            // $validateData['file'] = $request->file('file')->store('files-pengumuman');
        }

        Pengumuman::create($create_data);
        
        return redirect('/pengumuman/pengumuman')-> with('success', 'Data Pengumuman Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function show(Pengumuman $pengumuman)
    {
        return view('pengurus/pengumuman/show-pengumuman', compact('pengumuman'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    // public function edit(Pengumuman $pengumuman)
    // {
    //     return view('pengurus/pengumuman/show-pengumuman', compact('pengumuman'));
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengumuman $pengumuman)
    {
        $request->validate([
            'judul'             => 'required|max:255',
            'tanggal'           => 'required',
            'waktu'             => 'required',
            'organisasi_id'     => 'required',
            'isi'               => 'required',
            'file'              => 'file|nullable|mimes:pdf|max:1024'
        ]);

        $update_data = [
            'judul'             => $request->judul,
            'tanggal'           => $request->tanggal,
            'waktu'             => $request->waktu,
            'organisasi_id'     => $request->organisasi_id,
            'isi'               => $request->isi,
        ];

        if($request->file('file')) {
            if($request->oldFile) {
                Storage::delete($request->oldFile);
            }

            $file = $request->file('file');

            // membuat nama file unik
            $nama_file = rand() . $file->getClientOriginalName();
    
            // upload ke folder file_pengumuman di dalam folder public
            $file->move('files_pengumuman', $nama_file);

            $update_data['file'] = $nama_file;
            // $validateData['file'] = $request->file('file')->store('files-pengumuman');
        }
        
        Pengumuman::where('id', $pengumuman->id)->update($update_data);

        return redirect('/pengumuman/pengumuman')-> with('success', 'Data Pengumuman Berhasil Diubah!');
    }

    function downloadPengumuman($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        $pathToFile = public_path('files_pengumuman/' . $pengumuman->file);
        
        if(!File::exists($pathToFile)){
            return redirect('pengumuman/pengumuman/'.$id)->with('file_404', 'Berkas/file tidak ditemukan');
        }

        return response()->download($pathToFile, $pengumuman->file_name);
    }      

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengumuman $pengumuman)
    {
        if($pengumuman->file) {
            Storage::delete($pengumuman->file);
        }

        Pengumuman::destroy($pengumuman->id);

        return redirect('/pengumuman/pengumuman')-> with('status', 'Data Pengumuman Berhasil Dihapus!');
    }

    public function indexAnggota()
    {   
        
        $pengumuman = Pengumuman::latest()->paginate(10);
        return view('anggota/pengumuman', compact('pengumuman'));
    }

    public function cariPengumumanAnggota(Request $request)
	{
		return view('anggota/pengumuman', [
            "active" => "pengumuman", 
            "pengumuman" => Pengumuman::latest()->filter(request(['cari']))->paginate(10)->withQueryString()
        ]);
 
    }

}
