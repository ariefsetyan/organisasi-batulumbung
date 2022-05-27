@extends('layouts.main-pengurus')

@section('title', 'Pengumuman')

@section('content')
<div class="page-wrapper">

    <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Daftar Pengumuman</h4>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                <form class="form mb-3" method="get" action="{{ route ('cariPengumuman') }}">
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
                        <div class="col-md-6 ms-auto">
                            <div class="form-group">
                                <input type="text" name="cariPengumuman" class="form-control w-75 d-inline" value="{{ request('cariPengumuman')}}" id="cariPengumuman" placeholder="Cari ...">
                                <button type="submit" class="btn btn-primary mb-1"><i class="fa fa-search"></i> Cari</button>  
                            </div>
                        </div>
                    </div>                    
                </form>
             
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
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Tambah Data
                </button>

                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Form Tambah Data</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                    <form method="post" action="/pengurus/pengumuman/pengumuman" style="width:100%"
                                    enctype="multipart/form-data">
                                    @csrf
                                        <div class="form-group">
                                            <label for="judul">Judul</label> 
                                            <input type="text" name="judul" value="{{ old ('judul') }}" class="form-control @error('judul') is-invalid @enderror" 
                                            id="judul" placeholder="Masukkan Judul">
                                            @error ('judul')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="tanggal">Tanggal</label> 
                                            <input type="date" name="tanggal" value="{{ old ('tanggal') }}" class="form-control @error('tanggal') is-invalid @enderror" 
                                            id="tanggal">
                                            @error ('tanggal')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="waktu">Waktu</label> 
                                            <input type="time" name="waktu" value="{{ old ('waktu') }}" class="form-control @error('waktu') is-invalid @enderror" 
                                            id="waktu">
                                            @error ('waktu')
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
                                            <label for="isi" class="form-label">Isi Pengumuman</label>
                                            <input type="text" name="isi" value="{{ old ('isi') }}" class="form-control @error('isi') is-invalid @enderror" 
                                            id="isi" placeholder="Masukkan Isi">
                                            @error ('isi')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="file" class="form-label">File</label>
                                            <input type="file" name="file" accept="application/pdf" class="form-control @error('file') is-invalid @enderror" 
                                            id="file">
                                            @error ('file')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
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
                                    <th class="border-top-0">ID PENGUMUMAN</th>
                                    <th class="border-top-0">JUDUL PENGUMUMAN</th>
                                    <th class="border-top-0">TANGGAL</th>
                                    <th class="border-top-0">JENIS ORGANISASI</th>
                                    <th class="border-top-0">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($pengumuman as $result => $pengumumans)
                                <tr>
                                    <th scope="row">{{ $result + $pengumuman -> firstItem()}}</th>
                                    <td>{{$pengumumans->id}}</td>
                                    <td>{{$pengumumans->judul}}</td>
                                    <td>{{$pengumumans->tanggal}}</td>
                                    <td>{{$pengumumans->organisasi->jenis}}</td>
                                    <td><a href="\pengumuman\pengumuman\{{ $pengumumans->id }}" class="btn btn-primary"><i class="bi bi-eye-fill m-r-5"></i>Detail</a></td>
                                </tr>
                                @empty
                                <td colspan="6" class="table-active text-center">Tidak Ada Data</td>
                            @endforelse
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-start">
                            {{$pengumuman->links()}}
                        </div>

                    </div>
                </div>
            </div>
        </div>  
    </div>
</div>
@endsection