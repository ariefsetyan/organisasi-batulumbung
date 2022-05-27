@extends('layouts.main-pengurus')

@section('title', 'Organisasi')

@section('content')
<div class="page-wrapper">

    <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Daftar Organisasi</h4>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                
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
                                <form name="form-tambah" id="form-tambah" method="post" action="{{ route ('tambahOrganisasi') }}" style="width:100%">
                                @csrf
                                    <div class="form-group">
                                        <label for="kode">Kode</label> 
                                        <input type="text" name="kode" value="{{ old ('kode') }}" class="form-control @error('kode') is-invalid @enderror" 
                                        id="kode" placeholder="Masukkan Kode Organisasi">
                                        @error ('kode')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="jenis">Jenis</label> 
                                        <input type="text" name="jenis" value="{{ old ('jenis') }}" class="form-control @error('jenis') is-invalid @enderror" 
                                        id="jenis" placeholder="Masukkan Jenis">
                                        @error ('jenis')
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
                                <th class="border-top-0">ID ORGANISASI</th>
                                <th class="border-top-0">KODE ORGANISASI</th>
                                <th class="border-top-0">JENIS ORGANISASI</th>
                                <th class="border-top-0">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($organisasi as $organisasis)
                            <tr>
                                <th scope="row">{{ $loop->iteration}}</th>
                                <td>{{$organisasis->id}}</td>
                                <td>{{$organisasis->kode}}</td>
                                <td>{{$organisasis->jenis}}</td>
                                <td><a href="/organisasi/{{ $organisasis->id }}" class="btn btn-primary" data-toggle="modal" 
                                    data-target="#editOrganisasi{{ $organisasis->id }}"><i class="bi bi-pencil-square"></i></a>
                                    <div class="modal fade" id="editOrganisasi{{ $organisasis->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editOrganisasiLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editOrganisasiLabel">Form Edit Data</h5>
                                                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form name="form-edit" id="form-edit" method="post" action="{{ route ('editOrganisasi', $organisasis->id) }}" style="width:100%">
                                                        @method('patch')
                                                        @csrf
                                                        <div class="form-group1">
                                                            <label for="kode">Kode Organisasi</label> 
                                                            <input type="text" name="kode" value="{{$organisasis->kode}}" class="form-control @error('kode') is-invalid @enderror" 
                                                            id="kode" placeholder="Masukkan Kode Organisasi">
                                                            @error ('kode')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div> <br/>
                                                        <div class="form-group1">
                                                            <label for="jenis">Jenis Organisasi</label> 
                                                            <input type="text" name="jenis" value="{{$organisasis->jenis}}" class="form-control @error('jenis') is-invalid @enderror" 
                                                            id="jenis" placeholder="Masukkan Jenis Organisasi">
                                                            @error ('jenis')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div> <br/>
                                                        <div class="form-group">
                                                            <button type="button" class="btn btn-danger text-light" data-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div> | 
                                    <form action="/organisasi/organisasi/{{ $organisasis->id }}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger text-light"><i class="bi bi-trash-fill"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <td colspan="4" class="table-active text-center">Tidak Ada Data</td>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                 <!-- Edit Organisasi -->
                <!-- Modal -->
                
            </div>
        </div>  
    </div>
</div>
@endsection