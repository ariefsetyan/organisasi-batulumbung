@extends('layouts.main-pengurus')

@section('title', 'Laporan Keuangan')

@section('content')
<div class="page-wrapper">

    <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Daftar Laporan Keuangan</h4>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                <form action="{{ route ('filterTanggalKeuangan') }}" method="get">
                @csrf
                    <div class="input-group mb-3" style="width:570px">
                        <input type="text" class="form-control" name="dari" onfocusin="(this.type='date')" value="{{ isset($dari) ? $dari : old('dari')}}" outfocusin="(this.type='text)" placeholder="Tanggal Awal">
                        <input type="text" class="form-control" name="sampai" onfocusin="(this.type='date')" value="{{ isset($sampai) ? $sampai : old('sampai')}}" outfocusin="(this.type='text)" placeholder="Tanggal Akhir">
                        <button class="btn btn-primary" type="submit" style="width:80px">Filter</button>
                    </div>
                </form>

                <form class="form mb-3" method="get" action="{{ route ('cariLaporan') }}">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <select name="jenis" id="jenis" class="form-control" onchange="this.form.submit()" >
                                    <option value="" selected>Filter Organisasi</option>
                                    @foreach($organisasi as $organisasis)
                                    <option value="{{$organisasis->jenis}}">{{$organisasis->jenis}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">    
                            <div class="form-group">
                                <input type="text" name="cariLaporan" class="form-control w-75 d-inline" id="cariLaporan" value="{{ request('cariLaporan')}}" placeholder="Cari ...">
                                <button type="submit" class="btn btn-primary mb-1 d-inline"><i class="fa fa-search"></i> Cari</button>
                            </div>  
                        </div>
                    </div>                    
                </form>
               
                    <!-- Tambah Data -->
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahData">
                    Tambah Data
                    </button>
                    <a href="{{ route ('export_laporan-keuangan') }}" class="btn btn-success my-3 text-light" target="_blank">Download Data</a>

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

                    <div class="table-responsive mt-3">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="border-top-0">NO</th>
                                    <th class="border-top-0">TANGGAL</th>
                                    <th class="border-top-0">PEMASUKAN</th>
                                    <th class="border-top-0">PENGELUARAN</th>
                                    <th class="border-top-0">NAMA BARANG</th>
                                    <th class="border-top-0">RINCIAN</th>
                                    <th class="border-top-0">JENIS ORGANISASI</th>
                                    <th class="border-top-0">SUMBER DANA</th>
                                    <th class="border-top-0">AKSI</th>
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
                                    <td>{{$laporans->jumlah}} * Rp {{ number_format($laporans->harga_satuan) }}</td>
                                    <td>{{$laporans->organisasi->jenis}}</td>
                                    <td>{{$laporans->sumber_dana}}</td>
                                    <td><a href="\laporan\laporan-keuangan\{{ $laporans->id }}" class="btn btn-primary"><i class="bi bi-eye-fill m-r-5"></i>Detail</a></td>
                                    
                                </tr>
                                @empty
                                <td colspan="9" class="table-active text-center">Tidak Ada Data</td>
                            @endforelse
                            <tbody>
                        </table> 
                    </div>

                    <!-- Tambah Data -->
                    <!-- Modal -->
                    <div class="modal fade" id="tambahData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="tambahDataLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="tambahDataLabel">Form Tambah Data</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                <form method="post" action="{{ route ('tambahLaporan') }}" style="width:100%">
                                @csrf
                                    <div class="form-group">
                                        <label for="jmlh_pemasukan">Jumlah Pemasukkan</label> 
                                        <input type="text" name="jmlh_pemasukan" value="{{ old ('jmlh_pemasukan') }}" class="form-control @error('jmlh_pemasukan') is-invalid @enderror" 
                                        id="jmlh_pemasukan" placeholder="Masukkan Jumlah Pemasukan">
                                        @error ('jmlh_pemasukan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="jmlh_pengeluaran">Jumlah Pengeluaran</label> 
                                        <input type="text" name="jmlh_pengeluaran" value="{{ old ('jmlh_pengeluaran') }}" class="form-control @error('jmlh_pengeluaran') is-invalid @enderror" 
                                        id="jmlh_pengeluaran" placeholder="Masukkan Jumlah Pengeluaran">
                                        @error ('jmlh_pengeluaran')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_barang">Nama Barang</label> 
                                        <input type="text" name="nama_barang" value="{{ old ('nama_barang') }}" class="form-control" 
                                        id="nama_barang" placeholder="Masukkan Nama Barang">
                                        @error ('nama_barang')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="jumlah">Jumlah Barang</label> 
                                        <input type="number" name="jumlah" value="{{ old ('jumlah') }}" class="form-control" 
                                        id="jumlah" placeholder="Masukkan Jumlah Barang">
                                        @error ('jumlah')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="harga_satuan">Harga Satuan Barang</label> 
                                        <input type="text" name="harga_satuan" value="{{ old ('harga_satuan') }}" class="form-control" 
                                        id="harga_satuan" placeholder="Masukkan Harga Satuan Barang">
                                        @error ('harga_satuan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="tanggal">Tanggal</label> 
                                        <input type="date" name="tanggal" value="{{ old ('tanggal') }}" class="form-control @error('tanggal') is-invalid @enderror" 
                                        id="tanggal">
                                        @error ('tanggal')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleFormControlSelect">Jenis Organisasi</label>
                                        <select name="organisasi_id" class="form-control" id="exampleFormControlSelect">
                                            <option value="">--Pilih--</option>
                                            <option value="1">Sekaa Teruna</option>
                                            <option value="2">Sekaa Gong</option>
                                            <option value="3">Sekaa Santi</option>
                                            <option value="4">PKK</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="sumber_dana">Sumber Dana</label> 
                                        <input type="text" name="sumber_dana" value="{{ old ('sumber_dana') }}" class="form-control @error('sumber_dana') is-invalid @enderror" 
                                        id="sumber_dana" placeholder="Masukkan Sumber Dana">
                                        @error ('sumber_dana')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="keterangan">Keterangan</label> 
                                        <input type="text" name="keterangan" value="{{ old ('keterangan') }}" class="form-control @error('keterangan') is-invalid @enderror" 
                                        id="keterangan" placeholder="Masukkan Keterangan">
                                        @error ('keterangan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="pengurus_id" class="form-label">ID Pengurus</label>
                                        <input type="text" name="pengurus_id" readonly value="{{ Auth::guard('web')->user()->id }} " class="form-control @error('pengurus_id') is-invalid @enderror" 
                                        id="pengurus_id" >
                                        @error ('pengurus_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Tambah</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                       
                    </div>
  
                </div>
            </div>
        </div>  
    </div>
</div>
@endsection