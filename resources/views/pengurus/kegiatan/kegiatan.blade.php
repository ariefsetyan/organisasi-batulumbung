@extends('layouts.main-pengurus')

@section('title', 'Kegiatan')

@section('content')
<div class="page-wrapper">

    <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Daftar Kegiatan</h4>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                <form action="{{ route ('filterTanggalKegiatan') }}" method="get">
                @csrf
                    <div class="col-md-6">
                        <div class="input-group mb-3" style="width:570px">
                            <input type="text" class="form-control" name="dari" value="{{ isset($dari) ? $dari : old('dari')}}" onfocusin="(this.type='date')" outfocusin="(this.type='text)" placeholder="Tanggal Awal">
                            <input type="text" class="form-control" name="sampai" value="{{ isset($sampai) ? $sampai : old('sampai')}}"  onfocusin="(this.type='date')" outfocusin="(this.type='text)" placeholder="Tanggal Akhir">
                            <button class="btn btn-primary" type="submit" style="width:80px"> Filter</button>
                        </div>
                    </div>
                </form>
                <form class="form" method="get" action="{{route('cariKegiatan')}}">
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
                                <input type="text" name="cariKegiatan" class="form-control w-75 d-inline" id="cariKegiatan" value="{{ request('cariKegiatan')}}" placeholder="Cari ...">
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

                <!-- Modal -->
                <div class="modal fade" id="tambahData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="tambahDataLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="tambahDataLabel">Form Tambah Data</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="/pengurus/kegiatan/kegiatan" enctype="multipart/form-data" style="width:100%">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nama_kegiatan">Nama Kegiatan</label> 
                                        <input type="text" name="nama_kegiatan" value="{{ old ('nama_kegiatan') }}" class="form-control @error('nama_kegiatan') is-invalid @enderror" 
                                        id="nama_kegiatan" placeholder="Masukkan Nama Kegiatan">
                                        @error ('nama_kegiatan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="tanggal">Tanggal</label> 
                                        <input type="date" name="tanggal" value="{{ old ('tanggal') }}" class="form-control @error('tanggal') is-invalid @enderror" 
                                        id="tanggal" placeholder="Masukkan Tanggal">
                                        @error ('tanggal')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="waktu" class="form-label">Waktu</label>
                                        <input type="time" name="waktu" value="{{ old ('waktu') }}" class="form-control @error('waktu') is-invalid @enderror" 
                                        id="waktu" placeholder="Masukkan Waktu">
                                        @error ('waktu')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="tempat" class="form-label">Tempat</label>
                                        <input type="textarea" name="tempat" value="{{ old ('tempat') }}" class="form-control @error('tempat') is-invalid @enderror" 
                                        id="tempat" placeholder="Tempat">
                                        @error ('tempat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="deskripsi" class="form-label">Deskripsi</label>
                                        <textarea name="deskripsi" value="{{ old ('deskripsi') }}" class="form-control @error('deskripsi') is-invalid @enderror" 
                                        id="mytextarea" placeholder="Masukkan Deskripsi Kegiatan"></textarea>
                                        @error ('deskripsi')
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
                                        <label for="image" class="form-label">Image</label>
                                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" 
                                        id="image">
                                        @error ('image')
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


                <div class="table-responsive mt-3">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="border-top-0">NO</th>
                                <th class="border-top-0">ID KEGIATAN</th>
                                <th class="border-top-0">NAMA KEGIATAN</th>
                                <th class="border-top-0">TANGGAL</th>
                                <th class="border-top-0">JENIS ORGANISASI</th>
                                <th class="border-top-0">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($kegiatan as $result => $kegiatans)
                            <tr>
                                <th scope="row">{{ $result + $kegiatan->firstitem() }}</th>
                                <td>{{$kegiatans->id}}</td>
                                <td>{{$kegiatans->nama_kegiatan}}</td>
                                <td>{{$kegiatans->tanggal}}</td>
                                <td>{{$kegiatans->organisasi->jenis}}</td>
                                <td><a href="\kegiatan\kegiatan\{{ $kegiatans->id }}" class="btn btn-primary"><i class="bi bi-eye-fill m-r-5"></i>Detail</a></td>
                            </tr>
                            @empty
                            <td colspan="6" class="table-active text-center">Tidak Ada Data</td>
                        @endforelse
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-start">
                            {{$kegiatan->links()}}
                    </div>
                   
                    </div>
                </div>
            </div>
        </div>  
    </div>
</div>
@endsection

@push('script')
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script type="text/javascript">
tinymce.init({
    selector: '#mytextarea'
});
</script>
@endpush