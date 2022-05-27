@extends('layouts.main-pengurus')

@section('title', 'Detail Data Kegiatan')

@section('content')

<div class="page-wrapper">

    <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Detail Kegiatan</h4>
            </div>
        </div>
    </div>
    
    <div class="container-fluid">
    <table class="table table-light table-borderless" style="text-align:justify">
        
        <tr>
            <th style="width:150px">Nama Kegiatan</th>
            <td>{{$kegiatan->nama_kegiatan}}</td>
        </tr>

        <tr>
            <th>Tanggal | Waktu</th>
            <td>{{ $kegiatan->tanggal }} | {{ $kegiatan->waktu }}</td>
        </tr>

        <tr>
            <th>Tempat</th>
            <td>{{ $kegiatan->tempat }}</td>
        </tr>

        <tr>
            <th>Jenis Organisasi</th>
            <td>{{ $kegiatan->organisasi->jenis }}</td>
        </tr>
        
        <tr>
            <th>Deskripsi</th>
            <td>{!! $kegiatan->deskripsi !!}</td>
        </tr>
        
        <tr>
            <th>Gambar</th>
            <td>  
            @if($kegiatan->image)
                <div style="overflow:hidden; width:300px">
                   <img src="{{ asset('storage/'. $kegiatan->image) }}" class="img-fluid mb-3"  style="width:100%">
                </div>
            @endif
            </td>
        </tr> 
    </table>
        
        <a href ="{{ $kegiatan->id }}/edit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editData">Edit</a>
        
        <form action="{{ $kegiatan->id }}" method="post" class="d-inline">
            @method('delete')
            @csrf
            <button type="submit" class="btn btn-danger text-light">Delete</button>
        </form>
        
        <a href="/kegiatan/kegiatan_pdf/{{$kegiatan->id}}" target="_blank" class="btn btn-warning text-light"> Download</a>
        <a href="/kegiatan/kegiatan" class=" btn btn-success card-link text-light">Kembali</a>
       
    </div>

    <!-- Edit Kegiatan -->
    <div class="modal fade" id="editData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editDataLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editDataLabel">Form Edit Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="/kegiatan/kegiatan/{{ $kegiatan->id }}" enctype="multipart/form-data" style="width:100%">
                    @method('patch')
                    @csrf
                        <div class="form-group">
                            <label for="nama_kegiatan">Nama Kegiatan</label> 
                            <input type="text" name="nama_kegiatan" value="{{ $kegiatan->nama_kegiatan }}" class="form-control @error('nama_kegiatan') is-invalid @enderror" 
                            id="nama_kegiatan" placeholder="Masukkan Nama Kegiatan">
                            @error ('nama_kegiatan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label form="tanggal">Tanggal</label>
                            <input type="date" name="tanggal" value="{{ $kegiatan->tanggal }}" class="form-control @error('tanggal') is-invalid @enderror"
                            id="tanggal" placeholder="Masukkan Tanggal">
                            @error('tanggal')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="waktu" class="form-label">Waktu</label>
                            <input type="time" name="waktu" value="{{ $kegiatan->waktu }}" class="form-control @error('waktu') is-invalid @enderror" 
                            id="waktu" placeholder="Masukkan Waktu">
                            @error ('waktu')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tempat" class="form-label">Tempat</label>
                            <input type="text" name="tempat" value="{{ $kegiatan->tempat }}" class="form-control @error('tempat') is-invalid @enderror" 
                            id="tempat" placeholder="Tempat">
                            @error ('tempat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea type="deskripsi" name="deskripsi" value="{{ $kegiatan->deskripsi }}" class="form-control @error('deskripsi') is-invalid @enderror" 
                            id="mytextarea" placeholder="Masukkan Deskripsi Kegiatan"></textarea>
                            @error ('deskripsi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                        <label for="exampleFormControlSelect">Jenis Organisasi</label>
                            <select name="organisasi_id" value="{{ $kegiatan->organisasi_id }}" class="form-control @error('organisasi_id') is-invalid @enderror" 
                            id="exampleFormControlSelect">
                                <option value="1" @if($kegiatan->organisasi_id == "1") selected @endif>Sekaa Teruna</option>
                                <option value="2" @if($kegiatan->organisasi_id == "2") selected @endif>Sekaa Gong</option>
                                <option value="3" @if($kegiatan->organisasi_id == "3") selected @endif>Sekaa Santi</option>
                                <option value="4" @if($kegiatan->organisasi_id == "4") selected @endif>PKK</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="image" class="form-label">Image</label>
                            <label type="hidden" name="old" value="{{$kegiatan->image}}"></label>
                                @if($kegiatan->image)
                                    <img src="{{ asset('storage/'.$kegiatan->image) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block">
                                @else
                                    <img class="img-preview img-fluid mb-3 col=sm-5">
                                @endif
                            <input type="file" name="image" value="{{ $kegiatan->image }}" class="form-control @error('image') is-invalid @enderror" id="image">
                            @error ('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
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
            
           
    