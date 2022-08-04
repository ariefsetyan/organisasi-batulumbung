@extends('layouts.main-pengurus')

@section('title', 'Absensi')

@section('content')
<div class="page-wrapper">

    <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Daftar Absensi</h4>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">


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

                    <div class="row">
                        <div class="col-md-6">
                            <form class="form mb-3" method="get" action="{{ route ('cariStatus') }}">
                                <div class="form-group">
                                <input type="hidden" name="kegiatan" value="{{$kegiatan ?? ''}}">  
                                    <select name="jenis" id="jenis" class="form-control" style="width: 500px" onchange="this.form.submit()" >
                                        <option value="" selected>Filter Status</option>
                                        <option value="Hadir">Hadir</option>
                                        <option value="Tidak Hadir">Tidak Hadir</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="table-responsive mt-3">
                        <table class="table table-striped" id="myTable">
                            <thead>
                                <tr>
                                    <th class="border-top-0">NO</th>
                                    <th class="border-top-0">ID USER</th>
                                    <th class="border-top-0">NAMA ANGGOTA</th>
                                    <th class="border-top-0">NAMA KEGIATAN</th>
                                    <th class="border-top-0">TANGGAL</th>
                                    <th class="border-top-0">JENIS ORGANISASI</th>
                                    <th class="border-top-0">STATUS</th>
                                    <th class="border-top-0">AKSI</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($absensi as $absensi)
                                <tr>
                                    <th>{{$loop->iteration}}</th>
                                    <td>{{$absensi->user_id}}</td>
                                    <td>{{$absensi->user->nama ?? 'Belum Terdaftar'}}</td>
                                    
                                    <td>{{$absensi->nama_kegiatan}}</td>
                                    <td>{{ \Carbon\Carbon::parse($absensi->tanggal)->format('Y-m-d')}}</td>
                                    <!-- carbon format (y-m-d) -->
                                    <td>{{$auth}}</td>
                                    <td>{{$absensi->status}}</td>
                                    <td><a href="/absensi/absensi/{{$absensi->id}}"  class="btn btn-primary" data-toggle="modal" data-target="#editData{{ $absensi->id }}"><i class="bi bi-pencil-square"></i></a> |
                                    <div class="modal fade" id="editData{{ $absensi->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editDataLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editDataLabel">Form Edit Data</h5>
                                                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                <form method="post" action="{{ route ('editAbsensi', $absensi->id)}}" style="width:100%">
                                                    @method('patch')
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="exampleFormControlSelect">Status</label>
                                                        <select name="status" value="{{ $absensi->status }}" class="form-control @error('status') is-invalid @enderror" 
                                                        id="exampleFormControlSelect">
                                                            <option value="Hadir" @if($absensi->status == "Hadir") selected @endif>Hadir</option>
                                                            <option value="Tidak Hadir" @if($absensi->status == "Tidak Hadir") selected @endif>Tidak Hadir</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <button type="button" class="btn btn-danger text-light" data-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <form action="/absensi/absensi/{{$absensi->id}}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger text-light"><i class="bi bi-trash-fill"></i></button>
                                    </form> 
                                    </td>
                                </tr>
                                @empty
                                <td colspan="8" class="table-active text-center">Tidak Ada Data</td>
                                @endforelse
                            </tbody>
                        </table>
                        
                        <a href="/absensi/rekapan-absensi" class="btn btn-danger my-3 text-light">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
