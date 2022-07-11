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
                        <input type="text" name="cariEventAnggota" class="form-control w-75 d-inline" value="{{ request('cariEventAnggota')}}" id="cariEventAnggota" placeholder="Cari ...">
                        <button type="submit" class="btn btn-primary mb-1"><i class="fa fa-search"></i> Cari</button>  
                    </div>                    
                </form>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        @forelse ($event as $events)
        <div class="col-sm-6">
            <div class="card white-box p-0">
                <div class="card-body">
                    <div class="card-body bg-light mb-2"> 
                        <table class="table table-sm">
                            <tr>
                                <td colspan="3" style="font-weight:900; text-align:center">{{$events->nama_event}}</td>
                            </tr>
                            <tr>
                                <td style="width: 150px; font-weight:700">Tanggal</td>
                                <td style="width: 10px">:</td>
                                <td>{{$events->tanggal}}</td>
                            </tr>
                            <tr>
                                <td style="font-weight:700">Jenis Organisasi</td>
                                <td>:</td>
                                <td>{{$events->organisasi->jenis}}</td>
                            </tr>
                            <tr>
                                <td style="font-weight:700">Keterangan</td>
                                <td>:</td>
                                <td>{{$events->keterangan}}</td>
                            </tr>
                            <tr>
                                <td colspan="2"><a href ="{{$events->id}}/detail" class="btn btn-danger text-light m-t-10" data-bs-toggle="modal" data-bs-target="#detailEvent{{$events->id}}">Detail</a></td>
                                <td style="font-size: 12px; text-align:right">Diposting : {!! $events->created_at !!}</td>
                            </tr>
                        </table>
                            
                        <!-- Modal -->
                        <div class="modal fade" id="detailEvent{{$events->id}}" tabindex="-1" role="dialog" aria-labelledby="detailEventTitle" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="detailEventTitle">Detail Event</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card-body bg-light mb-2"> 
                                            <h4 class="card-title" style="font-weight:900; text-align:center" >{{$events->nama_event}}</h4>
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
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="card-body"  style="font-weight: 500; text-align:center; font-size:15px; background-color: lightblue">Tidak Ada Data</div>
    @endforelse
</div>          
    

@endsection