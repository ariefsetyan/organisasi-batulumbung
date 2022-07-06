@extends('layouts.main-anggota')

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
        <div class="row ">
            <div class="card bg-light" style="width: 100rem;">
                <div class="card-body bg-light">
                    <div class="table-responsive mt-3">
                        <table class="table table-info table-striped">
                            <thead>
                                <tr>
                                    <th style="font-weight: 800">NO</th>
                                    <th style="font-weight: 800">ID ANGGOTA</th>
                                    <th style="font-weight: 800">NAMA ANGGOTA</th>
                                    <th style="font-weight: 800">NAMA KEGIATAN</th>
                                    <th style="font-weight: 800">TANGGAL KEGIATAN</th>
                                    <th style="font-weight: 800">JENIS ORGANISASI</th>
                                    <th style="font-weight: 800">STATUS</th>
                                </tr>
                            </thead>
                            <tbody>
                            <!-- melakukan looping data -->
                            @php
                                $no = 0;
                            @endphp

                            @forelse ($data_absensi as $absen)
                                <tr>
                                    <th scope="row">{{ ++$no }}</th>
                                    <td>{{$absen->user_id}}</td>
                                    <td>{{$absen->nama}}</td>
                                    <td>{{$absen->nama_kegiatan}}</td>
                                    <td>{{ \Carbon\Carbon::parse($absen->tanggal)->format('d/m/Y')}}</td> 
                                    <!-- carbon format (y-m-d) -->
                                    <td>{{$absen->organisasi->jenis}}</td>
                                    <td>{{$absen->status}}</td>
                                </tr>
                                @empty
                                <td colspan="8" class="table-active text-center">Tidak Ada Data</td>
                                @endforelse
                            </tbody>
                        </table>  
                    </div>  
                </div>  
            </div>                 
        </div>          
    </div>
</div>
@endsection