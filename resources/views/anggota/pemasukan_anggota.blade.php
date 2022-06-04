@extends('layouts.main-anggota')

@section('title', 'Pemasukan')

@section('content')

<div class="page-wrapper">
    <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Pemasukan</h4>
            </div>
        </div>
    </div>

    <div class="card" style="width:50rem; margin-left: 25px; margin-top: 25px;">
    @forelse($data as $row)
        <div class="card-body">
            <h5 class="card-title">{{$row->jenis}}</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
           
        </div>
        @empty
        <td colspan="8" class="table-active text-center">Tidak Ada Data</td>
    @endforelse
    </div>

    <div class="table-responsive mt-3">
        <table class="table table-striped" id="myTable" style="width:100%">
            <thead>
            <tr>
                <th class="border-top-0">NO</th>
                <th class="border-top-0">Jumlah Pemasukan</th>
                <th class="border-top-0">Tanggal</th>
                <th class="border-top-0">Sumber Dana</th>
                <th class="border-top-0">Jenis Organisasi</th>
                <th class="border-top-0">Keterangan</th>
                <th class="border-top-0">AKSI</th>
            </tr>
            </thead>

            <tbody>
            <?php $no=1 ?>
            @foreach($data as $row)
            <tr>
                <td>{{$no++}}</td>
                <td>Rp {{number_format ($row->jmlh_pemasukan) }}</td>
                <td>{{$row->tanggal}}</td>
                <td>{{$row->sumber_dana}}</td>
                <td>{{$row->jenis}}</td>
                <td>{{$row->keterangan}}</td>
            </tr>
            @endforeach
            </tbody>
        </table>

    </div>
@endsection