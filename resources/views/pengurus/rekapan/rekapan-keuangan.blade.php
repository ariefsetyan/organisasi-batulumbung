@extends('layouts.main-pengurus')

@section('title', 'Rekapan Keuangan')

@section('content')
<div class="page-wrapper">

    <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Daftar Rekapan Keuangan</h4>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                <form action="{{ route ('filterTanggalKeuangan') }}" method="get">
                @csrf
                    <div class="input-group mb-3" style="width:500px">
                        <input type="text" class="form-control" name="dari" onfocusin="(this.type='date')" value="{{ isset($dari) ? $dari : old('dari')}}" outfocusin="(this.type='text)" placeholder="Tanggal Awal">
                        <input type="text" class="form-control" name="sampai" onfocusin="(this.type='date')" value="{{ isset($sampai) ? $sampai : old('sampai')}}" outfocusin="(this.type='text)" placeholder="Tanggal Akhir">
                        <button class="btn btn-primary" type="submit" style="width:70px">Filter</button>
                    </div>
                </form>

                <form class="form mb-3" method="get" action="{{ route ('cariLaporan') }}">
                    <div class="row mb-3">
                        <div class="col-md-6">    
                            <div class="form-group">
                                <input type="text" name="cariLaporan" class="form-control w-75 d-inline" id="cariLaporan" value="{{ request('cariLaporan')}}" placeholder="Cari ...">
                                <button type="submit" class="btn btn-primary mb-1 d-inline"><i class="fa fa-search"></i> Cari</button>
                            </div>  
                        </div>
                    </div>                    
                </form>

                <a href="/rekapan/cetak-keuangan" target="_blank" class="btn btn-danger text-light"> CETAK</a>

                    <div class="table-responsive mt-3">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="border-top-0">NO</th>
                                    <th class="border-top-0">TANGGAL</th>
                                    <th class="border-top-0">JUMLAH (RP)</th>
                                    <th class="border-top-0">JENIS TRANSAKSI</th>
                                    <th class="border-top-0">JENIS ORGANISASI</th>
                                    <th class="border-top-0">SUMBER DANA</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($rekapan as $row)
                                <tr>
                                    <th scope="row">{{ $loop->iteration}}</th>
                                    <td>{{$row->tanggal}}</td>
                                    @if(!$row->jmlh_pemasukan)
                                    <td>Rp {{ number_format($row->total) }}</td>
                                    <td>Pengeluaran</td>
                                    @else
                                    <td>Rp {{ number_format($row->jmlh_pemasukan) }}</td>
                                    <td>Pemasukan</td>
                                    @endif
                                    <td>{{$auth}}</td>
                                    <td>{{$row->sumber_dana}}</td>
                                </tr>
                                @empty
                                <td colspan="6" class="table-active text-center">Tidak Ada Data</td>
                            @endforelse
                            <tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3"></th>
                                        <th>Pemasukan</th>
                                        <th>Pengeluaran</th>
                                        <th>Sisa</th>
                                    </tr>
                                    <tr>
                                        <td colspan="3"></td>
                                        <td>Rp {{number_format($total_pemasukan,0)}}</td>
                                        <td>Rp {{number_format($total_pengeluaran,0)}}</td>
                                        @php
                                        $total = $total_pemasukan - $total_pengeluaran;
                                        @endphp
                                        <td>Rp {{number_format($total,0)}}</td>
                                    </tr>
                                </tfoot>
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