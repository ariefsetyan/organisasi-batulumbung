@extends('layouts.main-anggota')

@section('title', 'Kegiatan')

@section('content')

<div class="page-wrapper">
    <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Kegiatan</h4>
            </div>
            <div class="col-md-6 ms-auto">
                <form class="form mb-3" method="get" action="{{ route ('cariKegiatanAnggota') }}">
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
            @forelse($kegiatan as $kegiatan)
            <div class="card bg-light" style="width: 100rem;">
                <div class="card-body">
                    <h4 class="card-title" style="font-weight: 800; ">{{$kegiatan->nama_kegiatan}} - {{$auth}}</h4>
                    <p class="card-text">{!! $kegiatan->deskripsi !!}</p>
                    <a href="/kegiatan/kegiatan_pdf/{{$kegiatan->id}}" class="btn btn-danger text-white"><i class="bi bi-download"></i> Download</a>
                    <p align="right" style="font-size: 12px">Diposting : {!! $kegiatan->created_at !!}</p>
                </div>
            </div>
            @empty
            <div class="card-body bg-light"  style="font-weight: 500; text-align:center; font-size:15px">Tidak Ada Data</div>
            @endforelse
            </div>                 
        </div>          
    </div>

@endsection