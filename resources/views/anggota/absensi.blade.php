@extends('layouts.main-anggota')

@section('title', 'Absensi')

@section('content')

<div class="page-wrapper">
    <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
            <div class="col-md-4">
                <h4 class="page-title">Daftar Absensi</h4>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row ">
            <div class="card bg-light">
                <div class="card-body bg-light">
                    <div class="col-md-6 ms-auto">
                        <form class="form" method="get" action="{{ route ('cariAbsensiAnggota') }}">
                            <div class="row">
                                <!-- <div class="col-md-6 ms-auto">
                                    <input type="text" name="cariAbsensiAnggota" class="form-control" value="{{ request('cariAbsensiAnggota')}}" id="cariAbsensiAnggota" placeholder="Cari ...">
                                </div>   -->
                                <div class="col-md-6 ms-auto">
                                    <div class="form-group">
                                        <select name="jenis" id="jenis" class="form-control" onchange="this.form.submit()">
                                            <option value="" selected>Filter Organisasi</option>
                                            @foreach($organisasi as $organisasis)
                                            <option value="{{$organisasis->jenis}}">{{$organisasis->jenis}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>                  
                        </form>
                    </div>
                    <div class="table-responsive mt-3">
                        <table class="table table-striped" id="myTable">
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
                                    <td>{{$absen->user->nama}}</td>
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