<?php

namespace App\Http\Controllers;
use App\Models\Event;
use App\Models\Organisasi;

use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $organisasi = Organisasi::all();
        $event = Event::latest()->paginate(10);
        return view('pengurus/event/event', compact(['event', 'organisasi']));
    }

    public function cariEvent(Request $request)
	{
        $organisasi = Organisasi::all();
        $event = Event::latest()->filter(request(['cariEvent', 'jenis']))->paginate(10)->withQueryString();
       
		return view('pengurus/event/event', compact(['organisasi', 'event']));
 
    }

    public function filterTanggal(Request $request)
    {
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
        $organisasi = Organisasi::all();

        return view ('/pengurus/event/event', ['event' => $event, 'dari' => $request->dari, 'sampai' => $request->sampai, 'organisasi' => $organisasi]);
    }

    public function store(Request $request)
    {
       $validateData = $request->validate([
            'nama_event'    => 'required',
            'tanggal'       => 'required',
            'waktu'         => 'required',
            'tempat'        => 'required',
            'organisasi_id' => 'required',
            'keterangan'    => 'required',
        ]);

        Event::create($validateData);
        
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
            'organisasi_id' => 'required',
            'keterangan'     => 'required',
        ]);

        Event::where('id', $event->id)
                ->update([ 
                    'nama_event'    => $request->nama_event,
                    'tanggal'       => $request->tanggal,
                    'waktu'         => $request->waktu,
                    'tempat'        => $request->tempat,
                    'organisasi_id' => $request->organisasi_id,
                    'keterangan'    => $request->keterangan,
                ]);

        return redirect('/event/event')-> with('success', 'Data Event Berhasil Diubah!');
    }

    public function destroy(Event $event)
    {
        Event::destroy($event -> id);

        return redirect('/event/event')-> with('status', 'Data Event Berhasil Dihapus!');
    }
}
