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
                        <input type="text" name="cari" class="form-control w-75 d-inline" value="{{ request('cari')}}" id="cari" placeholder="Cari ...">
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
                        <h4 class="card-title" style="font-weight: 800; ">{{$pengumuman->judul}} - {{$auth}}</h4>
                        <p class="card-text">{{$pengumuman->isi}}</p>
                        <a href="{{route('file.download', $pengumuman->id)}}" class="btn btn-danger text-light"><i class="bi bi-download"></i> Download</a>
                        <p align="right" style="font-size: 12px">Diposting : {!! $pengumuman->created_at !!}</p>
                    </div>
                </div>
                @empty
            <div class="card-body bg-light"  style="font-weight: 500; text-align:center; font-size:15px">Tidak Ada Data</div>
            @endforelse
        </div>                 
    </div>          
</div>

@endsection