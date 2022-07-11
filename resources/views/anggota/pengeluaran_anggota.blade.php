@extends('layouts.main-anggota')

@section('title', 'Pengeluaran')

@section('content')

<div class="page-wrapper">
    <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Pengeluaran</h4>
            </div>
            <div class="col-md-6 ms-auto">
                <form class="form mb-3" method="get" action="{{ route ('cariPengeluaranAnggota') }}">
                    <div class="col-md-6 ms-auto">
                        <input type="text" name="cariPengeluaranAnggota" class="form-control w-75 d-inline" value="{{ request('cariPengeluaranAnggota')}}" id="cariPengeluaranAnggota" placeholder="Cari ...">
                        <button type="submit" class="btn btn-primary mb-1"><i class="fa fa-search"></i> Cari</button>  
                    </div>                    
                </form>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        @forelse ($pengeluaran as $data)
        <div class="col-lg-6 col-md-12 col-sm-12">
            <div class="card white-box p-0">
                <div class="card-body">
                        <div class="card-body bg-light mb-2">
                            <table class="table table-sm">
                                <thead class="thead-light">
                                    <tr>
                                        <td colspan="2" style="font-weight:900; text-align:center; font-size:20px" >{{$data->organisasi->jenis}}</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="width: 160px; font-weight:700 ">Tanggal</td>
                                        <td>{{$data->tanggal}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 160px; font-weight:700 ">Total Pengeluaran</td>
                                        <td>Rp {{number_format($data->total)}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 160px; font-weight:700 ">Sumber Dana</td>
                                        <td>{{$data->sumber_dana}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 160px; font-weight:700 ">Keterangan</td>
                                        <td>{{$data->keterangan}}</td>
                                    </tr>
                                    <tr>
                                        <td><a href ="{{$data->id}}/detail" class="btn btn-danger text-light m-t-10" data-bs-toggle="modal" data-bs-target="#detailPengeluaran">Detail</a></td></td>
                                        <td style="font-size: 12px; text-align:right">Diposting : {!! $data->created_at !!}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <!-- Modal -->
                             <div class="modal fade" id="detailPengeluaran" tabindex="-1" role="dialog" aria-labelledby="detailPengeluaranTitle" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="detailPengeluaranTitle">Detail Pengeluaran</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            @foreach ($pengeluaran as $data)
                                            <div class="card-body bg-light mb-2"> 
                                            <table class="table table-striped">
                                            <tr align="center">
                                                <th>Nama Barang</th>
                                                <th>Jumlah</th>
                                                <th>Harga Satuan</th>
                                                <th>Total</th>
                                            </tr>
                                         
                                            <tr align="center">
                                                <td>{{$data->nama_barang}}</td>
                                                <td>{{$data->jmlh_barang}}</td>
                                                <td>Rp {{number_format ($data->satuan_harga) }}</td>
                                                <td>Rp {{number_format ($data->jmlh_barang*$data->satuan_harga)}}</td>
                                            </tr>
                                        </table>
                                <br>
                                        <table>
                                            <tr>
                                                <td style="width: 120px">Subtotal</td>
                                                <td style="width: 10px; ">:</td>
                                                <td>Rp {{number_format($data->total)}}</td>
                                            </tr>
                                            <tr>
                                                <td>Sumber Dana</td>
                                                <td>:</td>
                                                <td>{{$data->sumber_dana}}</td>
                                            </tr>
                                            <tr>
                                                <td>Jenis Organisasi</td>
                                                <td>:</td>
                                                <td>{{$data->organisasi->jenis}}</td>
                                            </tr>
                                            <tr>
                                                <td>Keterangan</td>
                                                <td>:</td>
                                                <td>{{$data->keterangan}}</td>
                                            </tr>
                                        </table>
                                            </div>
                                            @endforeach
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="card-body"  style="font-weight: 500; text-align:center; font-size:15px; background-color: lightblue">Tidak Ada Data</div>
        @endforelse
    </div>  
</div>       
  
@endsection