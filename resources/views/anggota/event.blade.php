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
        <div class="col-lg-5 col-md-12 col-sm-12">
                <div class="card white-box p-0">
                    <div class="card-body">
                        @foreach ($event as $events)
                            <div class="card-body bg-purple mb-2"  style="color:white"> 
                                <h4 class="card-title text-light" style="font-weight:900; color:white" >{{$events->nama_event}}</h4>
                                <ul class="list-inline two-part d-flex align-items-center mb-0">
                                    <li>
                                        <span  class="card-text text-light">Tanggal : {{$events->tanggal}}</span>
                                    </li>
                                </ul>
                                <ul class="list-inline two-part d-flex align-items-center mb-0">
                                    <li>
                                        <span  class="card-text text-light">Jenis Organisasi : {{$events->organisasi->jenis}}</span>
                                    </li>
                                    <li class="ms-auto">
                                        <a href="\event\event\{{ $events->id }}" class="btn btn-danger text-light"><i class="bi bi-eye-fill m-r-5"></i>Detail</a>
                                    </li>
                                </ul>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>          
    </div>

@endsection