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
                <form class="form" method="get" action="{{ route ('cariKegiatanAnggota') }}">
                    <div class="row">
                        <div class="col-md-6 ms-auto">
                            <input type="text" name="cariKegiatanAnggota" class="form-control" value="{{ request('cariKegiatanAnggota')}}" id="cariKegiatanAnggota" placeholder="Cari ...">
                        </div>  
                        <div class="col-md-6 ms-auto">
                            <div class="form-group">
                                <select name="jenis" id="jenis" class="form-control" onchange="this.form.submit()">
                                    <option value="" selected>Filter Organisasi</option>
                                    @foreach($organisasi as $organisasis)
                                    <option value="{{$organisasis->jenis}}">{{$organisasis->jenis}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
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
                    <table class="table table-sm">
                        <tr>
                            <td colspan="2" style="font-weight: 800; text-align: center">{{$kegiatan->nama_kegiatan}} - {{$kegiatan->organisasi->jenis}}</td>
                        </tr>
                        <tr>
                            <td colspan="2"><b>Tanggal</b> : {{$kegiatan->tanggal}} | <b>Waktu</b> : {{$kegiatan->waktu}} | <b>Tempat</b> : {{$kegiatan->tempat}}</td>  
                        </tr>
                        <tr>
                            <td colspan="2">{!! $kegiatan->deskripsi !!}</td>
                        </tr>
                        <tr>
                            <td><a href="/kegiatan/kegiatan_pdf/{{$kegiatan->id}}" class="btn btn-danger text-white"><i class="bi bi-download"></i> Download</a></td>
                            <td style="font-size: 12px; text-align:right"> Diposting : {!! $kegiatan->created_at !!}</td>
                        </tr>
                    </table>
                    
                </div>
            </div>
            @empty
            <div class="card-body"  style="font-weight: 800; text-align:center; font-size:15px;">Tidak Ada Data</div>
            @endforelse
            </div>                 
        </div>          
    </div>

@endsection