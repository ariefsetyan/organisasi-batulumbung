@extends('layouts.main-pengurus')

@section('title', 'Rekapan Absensi')

@section('content')
<div class="page-wrapper">

    <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Rekapan Absensi</h4>
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

                    <form action="{{ route ('filterTanggalAbsensi') }}" method="get">
                        @csrf
                        <div class="col-md-6">
                            <div class="input-group mb-3" style="width:500px">
                                <input type="text" class="form-control" name="dari" value="{{ isset($dari) ? $dari : old('dari')}}" onfocusin="(this.type='date')" outfocusin="(this.type='text)" placeholder="Tanggal Awal">
                                <input type="text" class="form-control" name="sampai" value="{{ isset($sampai) ? $sampai : old('sampai')}}"  onfocusin="(this.type='date')" outfocusin="(this.type='text)" placeholder="Tanggal Akhir">
                                <button class="btn btn-primary" type="submit" style="width:70px"> Filter</button>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                    <div class="col-md-6">
                            <form class="form mb-3" method="get" action="{{ route ('cariStatus') }}">
                                <div class="form-group">
                                    <select name="jenis" id="jenis" class="form-control" style="width: 500px" onchange="this.form.submit()" >
                                        <option value="" selected>Filter Status</option>
                                        <option value="Hadir">Hadir</option>
                                        <option value="Tidak Hadir">Tidak Hadir</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <form class="form mb-3" method="get" action="{{ route ('cariAbsensi') }}">
                                <div class="form-group">
                                    <input type="text" name="cariAbsensi" class="form-control w-75 d-inline" value="{{ request('cariAbsensi')}}" id="cariAbsensi" placeholder="Cari ...">
                                    <button type="submit" class="btn btn-primary mb-1"><i class="fa fa-search"></i> Cari</button>
                                </div>  
                            </form>
                        </div>
                    </div>
                    
                    <a href="{{ route ('cetak-absensi') }}" class="btn btn-success my-3 text-light" target="_blank">CETAK ABSENSI</a>

                    <div class="table-responsive mt-3">
                        <table class="table table-striped">
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
                            @forelse ($absensi as $result => $absen)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{$absen->user_id}}</td>
                                    <td>{{$absen->nama}}</td>
                                    <td>{{$absen->nama_kegiatan}}</td>
                                    <td>{{ \Carbon\Carbon::parse($absen->tanggal)->format('Y-m-d')}}</td>
                                    <!-- carbon format (y-m-d) -->
                                    <td>{{$auth}}</td>
                                    <td>{{$absen->status}}</td>
                                    <td><a href="/absensi/absensi/{{$absen->id}}"  class="btn btn-primary" data-toggle="modal" data-target="#editData{{ $absen->id }}"><i class="bi bi-pencil-square"></i></a> |
                                    <div class="modal fade" id="editData{{ $absen->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editDataLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editDataLabel">Form Edit Data</h5>
                                                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                <form method="post" action="{{ route ('editAbsensi', $absen->id)}}" style="width:100%">
                                                    @method('patch')
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="exampleFormControlSelect">Status</label>
                                                        <select name="status" value="{{ $absen->status }}" class="form-control @error('status') is-invalid @enderror"
                                                        id="exampleFormControlSelect">
                                                            <option value="Hadir" @if($absen->status == "Hadir") selected @endif>Hadir</option>
                                                            <option value="Tidak Hadir" @if($absen->status == "Tidak Hadir") selected @endif>Tidak Hadir</option>
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
                                    <form action="/absensi/absensi/{{$absen->id}}" method="post" class="d-inline">
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
                       
                        <a href="/absensi/absensi" class="btn btn-danger my-3 text-light">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
