@extends('layouts.main-anggota')

@section('title', 'Event')

@section('content')

<div class="page-wrapper">
    <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Event</h4>
            </div>
            <div class="col-md-6 ms-auto">
                <form class="form mb-3" method="get" action="{{ route ('cariEventAnggota') }}">
                    <div class="col-md-6 ms-auto">
                        <input type="text" name="cari" class="form-control w-75 d-inline" value="{{ request('cari')}}" id="cari" placeholder="Cari ...">
                        <button type="submit" class="btn btn-primary mb-1"><i class="fa fa-search"></i> Cari</button>  
                    </div>                    
                </form>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="card white-box p-0">
                    <div class="card-body">
                        @forelse ($event as $events)
                            <div class="card-body bg-light mb-2"> 
                                <h4 class="card-title" style="font-weight:900; text-align:center" >{{$events->nama_event}}</h4>
                                <table>
                                    <tr>
                                        <td style="width: 120px"><b>Tanggal</b></td>
                                        <td style="width: 10px">:</td>
                                        <td>{{$events->tanggal}}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Jenis Organisasi</b></td>
                                        <td>:</td>
                                        <td>{{$auth}}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Keterangan</b></td>
                                        <td>:</td>
                                        <td>{{$events->keterangan}}</td>
                                    </tr>
                                </table>
                                
                                    <a href ="{{$events->id}}/detail" class="btn btn-danger text-light m-t-10" data-bs-toggle="modal" data-bs-target="#detailEvent">Detail</a>
                                        <!-- Modal -->
                                        <div class="modal fade" id="detailEvent" tabindex="-1" role="dialog" aria-labelledby="detailEventTitle" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="detailEventTitle">Detail Event</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        @foreach ($event as $data)
                                                        <div class="card-body bg-light mb-2"> 
                                                            <h4 class="card-title" style="font-weight:900; text-align:center" >{{$data->nama_event}}</h4>
                                                            <table class="table table-success table-striped">
                                                                <tr>
                                                                    <td style="width: 120px"><b>Tanggal</b></td>
                                                                    <td style="width: 10px">:</td>
                                                                    <td>{{$events->tanggal}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b>Waktu</b></td>
                                                                    <td>:</td>
                                                                    <td>{{$events->waktu}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b>Tempat</b></td>
                                                                    <td>:</td>
                                                                    <td>{{$events->tempat}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b>Jenis Organisasi</b></td>
                                                                    <td>:</td>
                                                                    <td>{{$auth}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b>Keterangan</b></td>
                                                                    <td>:</td>
                                                                    <td>{{$events->keterangan}}</td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                   
                                <br>
                                <p align="right" style="font-size: 12px">Diposting : {!! $events->created_at !!}</p>
                            </div>
                            @empty
                            <div class="card-body bg-light"  style="font-weight: 500; text-align:center; font-size:15px">Tidak Ada Data</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>          
    </div>

@endsection