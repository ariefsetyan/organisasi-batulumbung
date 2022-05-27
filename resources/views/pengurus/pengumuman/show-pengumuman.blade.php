@extends('layouts.main-pengurus')

@section('title', 'Detail Data Pengumuman')

@section('content')

<div class="page-wrapper">

    <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Detail Pengumuman</h4>
            </div>
        </div>
    </div>
    
    <div class="container-fluid">
        @if(session()->has('file_404'))
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                {{ session('file_404') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    <table class="table table-light table-borderless">
        <tr>
            <th width ="200px ">Judul</th>
            <td>{{ $pengumuman->judul }}</td>
        </tr>

        <tr>
            <th>Tanggal | Waktu</th>
            <td>{{ $pengumuman->tanggal }} | {{ $pengumuman->waktu }}</td>
        </tr>

        <tr>
            <th>Jenis Organisasi</th>
            <td>{{ $pengumuman->organisasi->jenis }}</td>
        </tr>
        
        <tr>
            <th>Isi Pengumuman</th>
            <td>{{ $pengumuman->isi }}</td>
        </tr>
        
        <tr>
            <th>File</th>
            <td><a href="{{route('file.download', $pengumuman->id)}}">Download File</a></td>
        </tr>
    </table>

    <a href ="{{ $pengumuman->id }}/edit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editPengumuman">Edit</a>

    <form action="{{ $pengumuman->id }}" method="post" class="d-inline">
        @method('delete')
        @csrf
        <button type="submit" class="btn btn-danger text-light">Delete</button>
    </form>

    <span class="btn btn-success"><a href="/pengumuman/pengumuman" class="card-link text-light">Kembali</a></span>

    </div>
       
    <!-- Modal -->
    <div class="modal fade" id="editPengumuman" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editPengumumanLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPengumumanLabel">Form Edit Pengumuman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="/pengumuman/pengumuman/{{ $pengumuman->id }}" style="width:100%"
                    enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                        <div class="form-group">
                            <label for="judul">Judul</label> 
                            <input type="text" name="judul" value="{{ $pengumuman->judul }}" class="form-control @error('judul') is-invalid @enderror" 
                            id="judul" placeholder="Masukkan Judul Pengumuman">
                            @error ('judul')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label form="tanggal">Tanggal</label>
                            <input type="date" name="tanggal" value="{{ $pengumuman->tanggal }}" class="form-control @error('tanggal') is-invalid @enderror"
                            id="tanggal">
                            @error('tanggal')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="waktu">Waktu</label> 
                            <input type="time" name="waktu" value="{{ $pengumuman->waktu }}" class="form-control @error('waktu') is-invalid @enderror" 
                            id="waktu">
                            @error ('waktu')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                        <label for="exampleFormControlSelect">Jenis Organisasi</label>
                            <select name="organisasi_id" value="{{ $pengumuman->organisasi_id }}" class="form-control @error('organisasi_id') is-invalid @enderror" 
                            id="exampleFormControlSelect">
                                <option value="1" @if($pengumuman->organisasi_id == "1") selected @endif>Sekaa Teruna</option>
                                <option value="2" @if($pengumuman->organisasi_id == "2") selected @endif>Sekaa Gong</option>
                                <option value="3" @if($pengumuman->organisasi_id == "3") selected @endif>Sekaa Santi</option>
                                <option value="4" @if($pengumuman->organisasi_id == "4") selected @endif>PKK</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="isi" class="form-label">Isi Pengumuman</label>
                            <input type="text" name="isi" value="{{ $pengumuman->isi }}" class="form-control @error('isi') is-invalid @enderror" 
                            id="isi" placeholder="Masukkan Isi Pengumuman">
                            @error ('isi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="file" class="form-label">File</label>
                            <label type="hidden" name="oldFile" value="{{$pengumuman->file}}"></label>
                            
                            <input type="file" name="file" accept="application/pdf" value="{{ old ('file') }}" class="form-control @error('file') is-invalid @enderror" 
                            id="file" placeholder="Masukkan file">
                            @error ('file')
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
            
           
    