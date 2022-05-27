@extends('layouts.main-pengurus')

@section('title', 'Event')

@section('content')
<div class="page-wrapper">

    <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Daftar Event</h4>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                <form action="{{ route ('filterTanggalEvent') }}" method="get">
                @csrf
                    <div class="col-md-6">
                        <div class="input-group mb-3" style="width:570px">
                            <input type="text" class="form-control" name="dari" value="{{ isset($dari) ? $dari : old('dari')}}" onfocusin="(this.type='date')" outfocusin="(this.type='text)" placeholder="Tanggal Awal">
                            <input type="text" class="form-control" name="sampai" value="{{ isset($sampai) ? $sampai : old('sampai')}}"  onfocusin="(this.type='date')" outfocusin="(this.type='text)" placeholder="Tanggal Akhir">
                            <button class="btn btn-primary" type="submit" style="width:80px"> Filter</button>
                        </div>
                    </div>
                </form>
                <form class="form" method="get" action="{{route('cariEvent')}}">
                <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <select name="jenis" id="jenis" class="form-control" onchange="this.form.submit()" >
                                    <option value="" selected>Filter Organisasi</option>
                                    @foreach($organisasi as $organisasis)
                                    <option value="{{$organisasis->jenis}}">{{$organisasis->jenis}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">    
                            <div class="form-group">
                                <input type="text" name="cariEvent" class="form-control w-75 d-inline" id="cariEvent" value="{{ request('cariEvent')}}" placeholder="Cari ...">
                                <button type="submit" class="btn btn-primary mb-1 d-inline"><i class="fa fa-search"></i> Cari</button>
                            </div>  
                        </div>
                    </div>                        
                </form>

                <!-- Tambah Data -->
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahData">
                Tambah Data
                </button>

                 
                @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @if(session()->has('status'))
                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                    {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <!-- Modal -->
                <div class="modal fade" id="tambahData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="tambahDataLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="tambahDataLabel">Form Tambah Data</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="/pengurus/event/event" enctype="multipart/form-data" style="width:100%">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nama_event">Nama Event</label> 
                                        <input type="text" name="nama_event" value="{{ old ('nama_event') }}" class="form-control @error('nama_event') is-invalid @enderror" 
                                        id="nama_event" placeholder="Masukkan Nama Event">
                                        @error ('nama_event')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="tanggal">Tanggal</label> 
                                        <input type="date" name="tanggal" value="{{ old ('tanggal') }}" class="form-control @error('tanggal') is-invalid @enderror" 
                                        id="tanggal" placeholder="Masukkan Tanggal">
                                        @error ('tanggal')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="waktu" class="form-label">Waktu</label>
                                        <input type="time" name="waktu" value="{{ old ('waktu') }}" class="form-control @error('waktu') is-invalid @enderror" 
                                        id="waktu" placeholder="Masukkan Waktu">
                                        @error ('waktu')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="tempat" class="form-label">Tempat</label>
                                        <input type="textarea" name="tempat" value="{{ old ('tempat') }}" class="form-control @error('tempat') is-invalid @enderror" 
                                        id="tempat" placeholder="Tempat">
                                        @error ('tempat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="keterangan" class="form-label">Keterangan</label>
                                        <input type="keterangan" name="keterangan" value="{{ old ('keterangan') }}" class="form-control @error('keterangan') is-invalid @enderror" 
                                        id="keterangan" placeholder="Masukkan Keterangan event">
                                        @error ('keterangan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleFormControlSelect">Jenis Organisasi</label>
                                        <select name="organisasi_id" class="form-control" id="exampleFormControlSelect">
                                            <option value="">--Pilih--</option>
                                            <option value="1">Sekaa Teruna</option>
                                            <option value="2">Sekaa Gong</option>
                                            <option value="3">Sekaa Santi</option>
                                            <option value="4">PKK</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Tambah</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="table-responsive mt-3">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="border-top-0">NO</th>
                                <th class="border-top-0">ID EVENT</th>
                                <th class="border-top-0">NAMA EVENT</th>
                                <th class="border-top-0">TANGGAL</th>
                                <th class="border-top-0">JENIS ORGANISASI</th>
                                <th class="border-top-0">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($event as $result => $events)
                            <tr>
                                <th scope="row">{{ $result + $event->firstItem()}}</th>
                                <td>{{$events->id}}</td>
                                <td>{{$events->nama_event}}</td>
                                <td>{{$events->tanggal}}</td>
                                <td>{{$events->organisasi->jenis}}</td>
                                <td><a href="\event\event\{{ $events->id }}" class="btn btn-primary"><i class="bi bi-eye-fill m-r-5"></i>Detail</a></td>
                            </tr>
                            @empty
                            <td colspan="6" class="table-active text-center">Tidak Ada Data</td>
                        @endforelse
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-start">
                        {{$event->links()}}
                    </div>
                   
                    </div>
                </div>
            </div>
        </div>  
    </div>
</div>
@endsection