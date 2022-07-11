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

                    <form action="{{ route ('filterTanggal') }}" method="get">
                        @csrf
                        <div class="col-md-6">
                            <div class="input-group mb-3" style="width:500px">
                                <input type="text" class="form-control" name="dari" value="{{ isset($dari) ? $dari : old('dari')}}" onfocusin="(this.type='date')" outfocusin="(this.type='text)" placeholder="Tanggal Awal">
                                <input type="text" class="form-control" name="sampai" value="{{ isset($sampai) ? $sampai : old('sampai')}}"  onfocusin="(this.type='date')" outfocusin="(this.type='text)" placeholder="Tanggal Akhir">
                                <button class="btn btn-primary" type="submit" style="width:70px"> Filter</button>
                            </div>
                        </div>
                    </form>

                    <a href="{{ route ('cetak-absensi') }}" class="btn btn-success my-3 text-light">CETAK ABSENSI</a>

                    <div class="table-responsive mt-3">
                        <table class="table table-striped" id="myTable">
                            <thead>
                                <tr>
                                    <th class="border-top-0">NO</th>
                                    <th class="border-top-0">NAMA KEGIATAN</th>
                                    <th class="border-top-0">TANGGAL</th>
                                    <th class="border-top-0">JENIS ORGANISASI</th>
                                    <th class="border-top-0">AKSI</th>
                                </tr>
                            </thead>

                            <tbody>
                            @forelse ($kegiatan as $result => $keg)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{$keg->nama_kegiatan}}</td>
                                    <td>{{ \Carbon\Carbon::parse($keg->tanggal)->format('Y-m-d')}}</td>
                                    <!-- carbon format (y-m-d) -->
                                    <td>{{$auth}}</td>
                                    <td><a href="/absensi/daftar_absensi/{{$keg->id}}" class="btn btn-primary">Lihat Daftar Absensi</a>
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

