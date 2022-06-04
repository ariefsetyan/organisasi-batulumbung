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
                                    <td>
                                        <a href="form-edit-pemasukan/{{$row->id}}" value="{{$row->id}}" id="btn-update" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a> |
                                        <a href="hapus-pemasukan/{{$row->id}}" class="btn btn-danger text-light"><i class="bi bi-trash-fill"></i></a></td>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
@endsection