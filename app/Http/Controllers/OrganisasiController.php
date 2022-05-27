<?php

namespace App\Http\Controllers;

use App\Models\Organisasi;
use Illuminate\Http\Request;

class OrganisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organisasi = Organisasi::all();
        return view('pengurus/organisasi/organisasi', compact('organisasi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     return view('pengurus/organisasi/organisasi');
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
            'kode' => 'required',
            'jenis' => 'required'
        ]);

        Organisasi :: create([
            'kode' => $request->kode,
            'jenis' => $request->jenis
        ]); 
        
        return redirect('/organisasi/organisasi')-> with('success', 'Data Organisasi Berhasil Ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Organisasi  $organisasi
     * @return \Illuminate\Http\Response
     */
    // public function edit(Organisasi $organisasi)
    // {
    //     return view('pengurus/organisasi/organisasi', compact('organisasi'));
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Organisasi  $organisasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Organisasi $organisasi)
    {
        $request->validate([
            'kode' => 'required',
            'jenis' => 'required'
        ]);
        
        Organisasi::where('id', $organisasi->id)
                ->update([
                    'kode'=>$request->kode,
                    'jenis'=>$request->jenis
                ]);

            return redirect('/organisasi/organisasi')-> with('success', 'Data Organisasi Berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Organisasi  $organisasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organisasi $organisasi)
    {
        Organisasi::destroy($organisasi->id);

        return redirect('/organisasi/organisasi')-> with('status',' Data Organisasi Berhasil Dihapus!');
    }
}
