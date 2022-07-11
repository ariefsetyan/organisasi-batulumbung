@extends('layouts.main-anggota')

@section('title', 'Pengumuman')

@section('content')

<div class="page-wrapper">
    <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Pengumuman</h4>
            </div>
            <div class="col-md-6 ms-auto">
                <form class="form mb-3" method="get" action="{{ route ('cariPengumumanAnggota') }}">
                    <div class="col-md-6 ms-auto">
                        <input type="text" name="cariPengumumanAnggota" class="form-control w-75 d-inline" value="{{ request('cariPengumumanAnggota')}}" id="cariPengumumanAnggota" placeholder="Cari ...">
                        <button type="submit" class="btn btn-primary mb-1"><i class="fa fa-search"></i> Cari</button>  
                    </div>                    
                </form>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row ">
            @forelse ($pengumuman as $pengumuman)
                <div class="card bg-light" style="width: 100rem">
                    <div class="card-body">
                        <table class="table table-sm">
                            <tr>
                                <td colspan="2" style="font-weight: 800; text-align: center">{{$pengumuman->judul}} - {{$pengumuman->organisasi->jenis}}</td>
                            </tr>
                            <tr>
                                <td colspan="2"><b>Tanggal</b> : {{$pengumuman->tanggal}} | <b>Waktu</b> : {{$pengumuman->waktu}}</td>
                            </tr>
                            <tr>
                                <td colspan="2">{{$pengumuman->isi}}</td>
                            </tr>
                            <tr>
                                <td><a href="{{route('file.download', $pengumuman->id)}}" class="btn btn-danger text-light"><i class="bi bi-download"></i> Download</a></td>
                                <td style="font-size: 12px; text-align:right">Diposting : {!! $pengumuman->created_at !!}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                @empty
            <div class="card-body"  style="font-weight: 500; text-align:center; font-size:15px; background-color: lightblue">Tidak Ada Data</div>
            @endforelse
        </div>                 
    </div>          
</div>

@endsection