@extends('layouts.main-pengurus')

@section('title', 'Detail Data Laporan Kegiatan')

@section('content')

<div class="page-wrapper">

    <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Detail Laporan Keuangan</h4>
            </div>
        </div>
    </div>
    
    <div class="container-fluid">
        <table class="table table-light table-borderless">
            <tr>
                <th>Nama Pengurus</th>
                <td>{{$laporan->user->nama}}</td>
            </tr>

            <tr>
                <th width ="200px ">Jumlah Pemasukan</th>
                <td>Rp {{ number_format ($laporan->jmlh_pemasukan)}}</td>
            </tr>

            <tr>
                <th> Tanggal</th>
                <td>{{$laporan->tanggal}}</td>
            </tr>

            <tr>
                <th> Sumber Dana</th>
                <td>{{$laporan->sumber_dana}}</td>
            </tr>
            @isset($laporan->nama_barang)
            <tr>
                <th> Nama Barang</th>
                <td>{{$laporan->nama_barang}}</td>
            </tr>

            <tr>
                <th> Jumlah</th>
                <td>{{$laporan->jumlah}}</td>
            
            </tr>
            <tr>
                <th> Harga Satuan</th>
                <td>Rp {{ number_format ($laporan->harga_satuan)}}</td>
            </tr>

            <tr>
                <th>Jumlah Pengeluaran</th>
                <td>Rp {{ number_format ($laporan->jmlh_pengeluaran)}}</td>
            </tr>
            @endisset

            <tr>
                <th> Jenis Organisasi</th>
                <td>{{$laporan->organisasi->jenis}}</td>
            </tr>

            <tr>
                <th>Keterangan</th>
                <td>{{$laporan->keterangan}}</td>
            </tr>
        </table>
        <a href ="{{ $laporan->id }}/edit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editData">Edit</a>

        <form action="{{ $laporan->id }}" method="post" class="d-inline">
            @method('delete')
            @csrf
            <button type="submit" class="btn btn-danger text-light">Delete</button>
        </form>
        <a href="/laporan-keuangan/laporan_keuangan_pdf/{{$laporan->id}}" target="_blank" class="btn btn-warning text-light"> Download</a>

    <span class="btn btn-success"><a href="/laporan/laporan-keuangan" class="card-link text-light">Kembali</a></span>
    </div>
    
    <!-- Edit Data -->
    <!-- Modal -->
    <div class="modal fade" id="editData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editDataLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editDataLabel">Form Edit Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form method="post" action="{{ route ('editLaporan', $laporan->id) }}" style="width:100%">
                @method('put')
                @csrf
                    <div class="form-group">
                        <label for="nama">Nama Pengurus</label> 
                        <input type="text" readonly name="nama" value="{{ $laporan->user->nama }}" class="form-control @error('nama') is-invalid @enderror" 
                        id="nama" placeholder="Masukkan Nama">
                        @error ('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="jmlh_pemasukan">Jumlah Pemasukkan</label> 
                        <input type="text" name="jmlh_pemasukan" value="{{ $laporan->jmlh_pemasukan}}" class="form-control @error('jmlh_pemasukan') is-invalid @enderror" 
                        id="jmlh_pemasukan" placeholder="Masukkan Jumlah Pemasukan">
                        @error ('jmlh_pemasukan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="jmlh_pengeluaran">Jumlah Pengeluaran</label> 
                        <input type="text" name="jmlh_pengeluaran" value="{{ $laporan->jmlh_pengeluaran}}" class="form-control @error('jmlh_pengeluaran') is-invalid @enderror" 
                        id="jmlh_pengeluaran" placeholder="Masukkan Jumlah Pengeluaran">
                        @error ('jmlh_pengeluaran')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nama_barang">Nama Barang</label> 
                        <input type="text" name="nama_barang" value="{{ $laporan->nama_barang }}"  class="form-control @error('nama_barang') is-invalid @enderror" 
                        id="nama_barang" placeholder="Masukkan Nama Barang">
                        @error ('nama_barang')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah Barang</label> 
                        <input type="number" name="jumlah" value="{{ $laporan->jumlah }}" class="form-control @error('jumlah') is-invalid @enderror" 
                        id="jumlah" placeholder="Masukkan Jumlah Barang">
                        @error ('jumlah')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="harga_satuan">Harga Satuan Barang</label> 
                        <input type="text" name="harga_satuan" value="{{ $laporan->harga_satuan }}"  class="form-control @error('harga_satuan') is-invalid @enderror" 
                        id="harga_satuan" placeholder="Masukkan Harga Satuan Barang">
                        @error ('harga_satuan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="tanggal">Tanggal</label> 
                        <input type="date" name="tanggal" value="{{ $laporan->tanggal }}" class="form-control @error('tanggal') is-invalid @enderror" 
                        id="tanggal">
                        @error ('tanggal')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlSelect">Jenis Organisasi</label>
                        <select name="organisasi_id" value="{{ $laporan->organisasi_id }}" class="form-control @error('organisasi_id') is-invalid @enderror" 
                        id="exampleFormControlSelect">
                            <option value="1" @if($laporan->organisasi_id == "1") selected @endif>Sekaa Teruna</option>
                            <option value="2" @if($laporan->organisasi_id == "2") selected @endif>Sekaa Gong</option>
                            <option value="3" @if($laporan->organisasi_id == "3") selected @endif>Sekaa Santi</option>
                            <option value="4" @if($laporan->organisasi_id == "4") selected @endif>PKK</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="sumber_dana">Sumber Dana</label> 
                        <input type="text" name="sumber_dana" value="{{ $laporan->sumber_dana }}" class="form-control @error('sumber_dana') is-invalid @enderror" 
                        id="sumber_dana" placeholder="Masukkan Sumber Dana">
                        @error ('sumber_dana')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="keterangan">Keterangan</label> 
                        <input type="text" name="keterangan" value="{{ $laporan->keterangan }}" class="form-control @error('keterangan') is-invalid @enderror" 
                        id="keterangan" placeholder="Masukkan Keterangan">
                        @error ('keterangan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-end">
</div>

@endsection
            
           
    