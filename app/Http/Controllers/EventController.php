<?php

namespace App\Http\Controllers;
use App\Models\Event;
use App\Models\DetailUser;
use App\Models\Organisasi;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class EventController extends Controller
{
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
        
        $event = Event::whereIn('organisasi_id',$auth_id)->latest()->paginate(10);

        return view('pengurus/event/event', compact(['event', 'organisasi', 'jenis', 'auth']), ['auth_id' => $auth_id[0]]);
    }

    public function cariEvent(Request $request)
	{
        $auth_id = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id',Auth::id());
        })->pluck('id');
        // dd($auth);
        
        $jenis = DetailUser::all();
        $auth = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id',Auth::id());
        })->value('jenis');

        $event = Event::whereIn('organisasi_id',$auth_id)->latest()->filter(request(['cariEvent']))->paginate(10)->withQueryString();
       
		return view('pengurus/event/event', compact(['auth', 'auth_id', 'event']));
 
    }

    public function filterTanggal(Request $request)
    {
        $auth_id = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id',Auth::id());
        })->pluck('id');
        // dd($auth);
        
        $jenis = DetailUser::all();
        $auth = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id',Auth::id());
        })->value('jenis');

        $dari = $request->dari .'.'. '00:00:00';
        $sampai = $request->sampai .'.'. '23:59:59';

        if($request->dari == '' && $request->sampai == ''){
            return redirect('event/event');
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

        $event = Event::whereBetween('tanggal', [$dari, $sampai])->latest()->paginate(10);

        return view ('/pengurus/event/event', ['event' => $event, 'auth' => $auth, 'auth_id' => $auth_id, 'dari' => $request->dari, 'sampai' => $request->sampai]);
    }

    public function store(Request $request)
    {
       $request->validate([
            'nama_event'    => 'required',
            'tanggal'       => 'required',
            'waktu'         => 'required',
            'tempat'        => 'required',
            'organisasi_id' => 'required',
            'keterangan'    => 'required',
        ]);

        // dd($request);
        
        Event::create([
            'nama_event'    => $request->nama_event,
            'tanggal'       => $request->tanggal,
            'waktu'         => $request->waktu,
            'tempat'        => $request->tempat,
            'organisasi_id' => $request->organisasi_id,
            'keterangan'    => $request->keterangan,
            
            ]);
            
            
            
        return redirect('/event/event')-> with('success', 'Data Event Berhasil Ditambahkan!');
    }

    public function show(Event $event)
    {   
        return view('pengurus.event.show-event', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
       $request->validate([
            'nama_event'    => 'required',
            'tanggal'       => 'required',
            'waktu'         => 'required',
            'tempat'        => 'required',
            'keterangan'     => 'required',
        ]);

        Event::where('id', $event->id)
                ->update([ 
                    'nama_event'    => $request->nama_event,
                    'tanggal'       => $request->tanggal,
                    'waktu'         => $request->waktu,
                    'tempat'        => $request->tempat,
                    'keterangan'    => $request->keterangan,
                ]);

        return redirect('/event/event')-> with('success', 'Data Event Berhasil Diubah!');
    }

    public function destroy(Event $event)
    {
        Event::destroy($event -> id);

        return redirect('/event/event')-> with('status', 'Data Event Berhasil Dihapus!');
    }

    public function indexAnggota()
    {
        $auth_id = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id',Auth::id());
        })->pluck('id');
        // dd($auth);
        
        // $jenis = DetailUser::all();
        $auth = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id',Auth::id());
        })->value('jenis');

        $event = Event::whereIn('organisasi_id',$auth_id)->latest()->paginate(10);

        return view ('anggota/event', compact([ 'event', 'auth_id', 'auth']));
    }

    public function cariEventAnggota(Request $request)
	{
        $auth_id = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id',Auth::id());
        })->pluck('id');
        // dd($auth);
        
        $jenis = DetailUser::all();
        $auth = Organisasi::whereHas('detailUser',function($q){
            $q->where('user_id',Auth::id());
        })->value('jenis');

        $event = Event::whereIn('organisasi_id',$auth_id)->latest()->filter(request(['cariEventAnggota']))->paginate(10)->withQueryString();
       
		return view('anggota/event', compact(['auth', 'auth_id', 'event']));
 
 
    }
}
