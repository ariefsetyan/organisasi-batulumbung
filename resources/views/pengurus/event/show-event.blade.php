@extends('layouts.main-pengurus')

@section('title', 'Detail Data Event')

@section('content')

<div class="page-wrapper">

    <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Detail Event</h4>
            </div>
        </div>
    </div>
    
    <div class="container-fluid">
    <table class="table table-light table-borderless" style="text-align:justify">
        
        <tr>
            <th style="width:150px">Nama Event</th>
            <td>{{ $event->nama_event}}</td>
        </tr>

        <tr>
            <th>Tanggal | Waktu</th>
            <td>{{ $event->tanggal }} | {{ $event->waktu }}</td>
        </tr>

        <tr>
            <th>Tempat</th>
            <td>{{ $event->tempat }}</td>
        </tr>

        <tr>
            <th>Jenis Organisasi</th>
            <td>{{ $event->organisasi->jenis }}</td>
        </tr>
        
        <tr>
            <th>Keterangan</th>
            <td>{{ $event->keterangan }}</td>
        </tr>
    
    </table>
        
        <a href ="{{ $event->id }}/edit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editData">Edit</a>
        
        <form action="{{ $event->id }}" method="post" class="d-inline">
            @method('delete')
            @csrf
            <button type="submit" class="btn btn-danger text-light">Delete</button>
        </form>
        
        <a href="/event/event" class=" btn btn-success card-link text-light">Kembali</a>
       
    </div>

    <!-- Edit Event -->
    <div class="modal fade" id="editData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editDataLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editDataLabel">Form Edit Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="/event/event/{{ $event->id }}" enctype="multipart/form-data" style="width:100%">
                    @method('patch')
                    @csrf
                        <div class="form-group">
                            <label for="nama_event">Nama Event</label> 
                            <input type="text" name="nama_event" value="{{ $event->nama_event }}" class="form-control @error('nama_event') is-invalid @enderror" 
                            id="nama_event" placeholder="Masukkan Nama Event">
                            @error ('nama_event')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label form="tanggal">Tanggal</label>
                            <input type="date" name="tanggal" value="{{ $event->tanggal }}" class="form-control @error('tanggal') is-invalid @enderror"
                            id="tanggal" placeholder="Masukkan Tanggal">
                            @error('tanggal')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="waktu" class="form-label">Waktu</label>
                            <input type="time" name="waktu" value="{{ $event->waktu }}" class="form-control @error('waktu') is-invalid @enderror" 
                            id="waktu" placeholder="Masukkan Waktu">
                            @error ('waktu')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tempat" class="form-label">Tempat</label>
                            <input type="text" name="tempat" value="{{ $event->tempat }}" class="form-control @error('tempat') is-invalid @enderror" 
                            id="tempat" placeholder="Tempat">
                            @error ('tempat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <input type="keterangan" name="keterangan" value="{{ $event->keterangan }}" class="form-control @error('keterangan') is-invalid @enderror" 
                            id="keterangan" placeholder="Masukkan Keterangan event">
                            @error ('keterangan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                        <label for="exampleFormControlSelect">Jenis Organisasi</label>
                            <select name="organisasi_id" value="{{ $event->organisasi_id }}" class="form-control @error('organisasi_id') is-invalid @enderror" 
                            id="exampleFormControlSelect">
                                <option value="1" @if($event->organisasi_id == "1") selected @endif>Sekaa Teruna</option>
                                <option value="2" @if($event->organisasi_id == "2") selected @endif>Sekaa Gong</option>
                                <option value="3" @if($event->organisasi_id == "3") selected @endif>Sekaa Santi</option>
                                <option value="4" @if($event->organisasi_id == "4") selected @endif>PKK</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <button type="button" class="btn btn-danger text-light" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
            
           
    