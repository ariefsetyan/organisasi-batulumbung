@extends('layouts.main-anggota')

@section('title', 'Pemasukan')

@section('content')

<div class="page-wrapper">
    <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Pemasukan</h4>
            </div>
            <div class="col-md-6 ms-auto">
                <form class="form mb-3" method="get" action="{{ route ('cariPemasukanAnggota') }}">
                    <div class="col-md-6 ms-auto">
                        <input type="text" name="cariPemasukanAnggota" class="form-control w-75 d-inline" value="{{ request('cariPemasukanAnggota')}}" id="cariPemasukanAnggota" placeholder="Cari ...">
                        <button type="submit" class="btn btn-primary mb-1"><i class="fa fa-search"></i> Cari</button>  
                    </div>                    
                </form>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        @forelse ($pemasukan as $pemasukans)
        <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="card white-box p-0">
                    <div class="card-body">
                        <div class="card-body bg-light mb-2"> 
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td colspan="2" style="font-weight:900; text-align:center; font-size:20px">{{$pemasukans->organisasi->jenis}}</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="width: 160px; font-weight:700 ">Tanggal</td>
                                        <td>{{$pemasukans->tanggal}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 160px; font-weight:700 ">Jumlah Pemasukan</td>
                                        <td>Rp {{number_format($pemasukans->jmlh_pemasukan)}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 160px; font-weight:700 ">Sumber Dana</td>
                                        <td>{{$pemasukans->sumber_dana}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 160px; font-weight:700 ">Keterangan</td>
                                        <td>{{$pemasukans->keterangan}}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <p align="right" style="font-size: 12px">Diposting : {!! $pemasukans->created_at !!}</p>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="card-body"  style="font-weight: 500; text-align:center; font-size:15px; background-color: lightblue">Tidak Ada Data</div>
        @endforelse
        </div>                 
    </div>       
  
@endsection