@extends('layouts.main-anggota')

@section('title', 'Laporan Keuangan')

@section('content')

<div class="page-wrapper">
    <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Laporan Keuangan</h4>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row ">
        <table class="table table-primary">
                            <thead>
                                <tr>
                                    <th class="border-top-0">NO</th>
                                    <th class="border-top-0">TANGGAL</th>
                                    <th class="border-top-0">PEMASUKAN</th>
                                    <th class="border-top-0">PENGELUARAN</th>
                                    <th class="border-top-0">NAMA BARANG</th>
                                    <th class="border-top-0">JENIS ORGANISASI</th>
                                    <th class="border-top-0">SUMBER DANA</th>
                                    <th class="border-top-0">RINCIAN</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($laporan as $laporans)
                                <tr>
                                    <th scope="row">{{ $loop->iteration}}</th>
                                    <td>{{$laporans->tanggal}}</td>
                                    <td>Rp {{ number_format($laporans->jmlh_pemasukan) }}</td>
                                    <td>Rp {{ number_format($laporans->jmlh_pengeluaran) }}</td>                                    
                                    <td>{{$laporans->nama_barang}}</td>
                                    <td>{{$laporans->organisasi->jenis}}</td>
                                    <td>{{$laporans->sumber_dana}}</td>
                                    <td>{{$laporans->jumlah}} * Rp {{ number_format($laporans->harga_satuan) }}</td>
                                </tr>
                                @empty
                                <td colspan="9" class="table-active text-center">Tidak Ada Data</td>
                            @endforelse
                            <tbody>
                        </table> 
        </div>          
    </div>
@endsection