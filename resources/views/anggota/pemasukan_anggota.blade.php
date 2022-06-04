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

    <div class="container-fluid">
        <div class="row">
            @forelse($data as $row)
            <div class="card bg-purple" style="width: 30rem; margin-left: 25px; font-size:large">
                <div class="card-body" style="color:white">
                    <h4 class="card-title" style="font-weight: 800; text-align:center">{{$row->jenis}}</h4>
                    <table style="width: 30rem;">
                        <tr>
                            <th>Jumlah Pemasukan </th>
                            <td style="text-align: left;"> Rp {{number_format ($row->jmlh_pemasukan) }}</td>
                        </tr>
                        <tr>
                            <th>Sumber Dana</th>
                            <td style="text-align: left;">{{$row->sumber_dana}}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Masuk</th>
                            <td style="text-align: left;">{{$row->tanggal}}</td>
                        </tr>
                   </table>
                        <p style="text-align: left;">{!! $row->keterangan !!}</p>    
                </div>
            </div>
            @empty
        <div class="card-body bg-purple"  style="font-weight: 800; color:white; text-align:center; font-size:30px">Tidak Ada Data</div>
        @endforelse
        </div>                 
    </div>       
  
@endsection