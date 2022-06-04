@extends('layouts.main-anggota')

@section('title', 'Pengeluaran')

@section('content')

<div class="page-wrapper">
    <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Pengeluaran</h4>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="card bg-purple" style=" font-size:large">
                <div class="card-body" style="color:white">
                @forelse($data1 as $x)
                    <table style="width: 60rem; border: 1px;">
                        <tr align="center">
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Harga Satuan</th>
                            <th>Total</th>
                        </tr>
                        @foreach($data as $y)
                        <tr align="center">
                            <td>{{$y->nama_barang}}</td>
                            <td>{{$y->jmlh_barang}}</td>
                            <td>Rp {{number_format ($y->satuan_harga) }}</td>
                            <td>Rp {{number_format ($y->jmlh_barang*$y->satuan_harga)}}</td>
                        </tr>
                        @endforeach
                    </table>
            <br>
                    <p>Subtotal : Rp {{number_format($x->total)}}</p>
                    <p>Sumber Dana :  {{$x->sumber_dana}}</p>
                    <p>Organisasi :  {{$x->jenis}}</p>
                    <p>Keterangan : {{$x->keterangan}}</p>
                </div>
            </div>
            @empty
        <div class="card-body bg-purple"  style="font-weight: 800; color:white; text-align:center; font-size:30px">Tidak Ada Data</div>
        @endforelse
        </div>                 
    </div>       
  
@endsection