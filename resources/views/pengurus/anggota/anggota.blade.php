@extends('layouts.main-pengurus')

@section('title', 'Anggota')

@section('content')
<div class="page-wrapper">

    <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Daftar Anggota</h4>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                <form class="form mb-3" method="get" action="{{ route ('cariAnggota') }}">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <select name="jenis" id="jenis" class="form-control" onchange="this.form.submit()" >
                                    <option value="" selected>Filter Organisasi</option>
                                    @foreach($organisasi as $organisasis)
                                    <option value="{{$organisasis->id}}">{{$organisasis->jenis}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 ms-auto">
                            <div class="form-group">
                                <input type="text" name="cariAnggota" class="form-control w-75 d-inline" value="{{ request('cariAnggota')}}" id="cariAnggota" placeholder="Cari ...">
                                <button type="submit" class="btn btn-primary mb-1"><i class="fa fa-search"></i> Cari</button>  
                            </div>
                        </div>
                    </div>                    
                </form>

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahAnggota">
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
                <div class="modal fade" id="tambahAnggota" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="tambahAnggotaLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tambahAnggotaLabel">Form Tambah Data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                            <div class="modal-body">
                            <form method="post" name="formTambahData" action="{{ route ('tambahUser') }}" style="width:100%">
                                @csrf
                                    <div class="form-group">
                                        <label for="nama">Nama</label> 
                                        <input type="text" name="nama" value="{{ old ('nama') }}" class="form-control @error('nama') is-invalid @enderror" 
                                        id="nama" placeholder="Masukkan Nama Lengkap">
                                        @error ('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="nik">NIK</label> 
                                        <input type="text" name="nik" value="{{ old ('nik') }}" class="form-control @error('nik') is-invalid @enderror" 
                                        id="nik" placeholder="Masukkan NIK">
                                        @error ('nik')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                        <input type="text" name="tempat_lahir" value="{{ old ('tempat_lahir') }}" class="form-control @error('tempat_lahir') is-invalid @enderror" 
                                        id="tempat_lahir" placeholder="Masukkan Tempat Lahir">
                                        @error ('tempat_lahir')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                        <input type="date" name="tgl_lahir" value="{{ old ('tgl_lahir') }}" class="form-control @error('tgl_lahir') is-invalid @enderror" 
                                        id="tgl_lahir" placeholder="Tanggal Lahir">
                                        @error ('tgl_lahir')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" name="email" value="{{ old ('email') }}" class="form-control @error('email') is-invalid @enderror" 
                                        id="email" placeholder="Masukkan Email">
                                        @error ('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" name="password" value="{{ old ('password') }}" class="form-control @error('password') is-invalid @enderror" 
                                        id="password" placeholder="Masukkan Password">
                                        @error ('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password" class="form-label">Konfirmasi Password</label>
                                        <input type="password" name="konfirmpassword" value="{{ old ('konfirmpassword') }}" class="form-control @error('konfirmpassword') is-invalid @enderror" 
                                        id="konfirmpassword" placeholder="Masukkan Password">
                                        @error ('konfirmpassword')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="no_telp" class="form-label">Telp</label>
                                        <input type="text" name="no_telp" value="{{ old ('no_telp') }}" class="form-control @error('no_telp') is-invalid @enderror" 
                                        id="no_telp" placeholder="Masukkan Nomor Telp">
                                        @error ('no_telp')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleFormControlSelect">Jenis Kelamin</label>
                                        <select name="jenis_kelamin" value="{{ old ('jenis_kelamin') }}" class="form-control @error('jenis_kelamin') is-invalid @enderror" id="exampleFormControlSelect">
                                            <option value="">--Pilih--</option>
                                            <option value="Laki-Laki">Laki-Laki</option>
                                            <option valie="Perempuan">Perempuan</option>
                                        </select>
                                        @error ('jenis_kelamin')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="pekerjaan" class="form-label">Pekerjaan</label>
                                        <input type="text" name="pekerjaan" value="{{ old ('pekerjaan') }}" class="form-control @error('pekerjaan') is-invalid @enderror" 
                                        id="pekerjaan" placeholder="Masukkan Pekerjaan">
                                        @error ('pekerjaan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="alamat" class="form-label">Alamat</label>
                                        <input type="textarea" name="alamat" value="{{ old ('alamat') }}" class="form-control @error('alamat') is-invalid @enderror" 
                                        id="alamat" placeholder="Masukkan Alamat">
                                        @error ('alamat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="organisasi_id" class="form-label">Jenis Organisasi</label> <br>
                                        <input type="checkbox" class="check_all" name="organisasi_id[]" id="sekaagong" value="1"> Sekaa Teruna<br>
                                        <input type="checkbox" class="check_all" name="organisasi_id[]" id="sekaagong" value="2"> Sekaa Gong <br>
                                        <input type="checkbox" class="check_all" name="organisasi_id[]" id="sekaasanti" value="3"> Sekaa Santi <br>
                                        <input type="checkbox" class="check_all" name="organisasi_id[]" id="pkk" value="4"> PKK <br>
                                        @error ('organisasi_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleFormControlSelect">Jabatan</label>
                                        <select name="level" value="{{ old ('level') }}" class="form-control @error ('level') is-invalid @enderror" id="exampleFormControlSelect">
                                            <option value="">--Pilih--</option>
                                            <option value="Ketua">Ketua</option>
                                            <option value="Wakil Ketua">Wakil Ketua</option>
                                            <option value="Sekretaris">Sekretaris</option>
                                            <option value="Bendahara">Bendahara</option>
                                            <option value="Anggota">Anggota</option>
                                        </select>
                                        @error ('level')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleFormControlSelect">Status</label>
                                        <select name="status" value="{{ old ('status') }}" class="form-control @error ('status') is-invalid @enderror" id="exampleFormControlSelect">
                                            <option value="">--Pilih--</option>
                                            <option value="Aktif">Aktif</option>
                                            <option value="Tidak Aktif">Tidak Aktif</option>
                                        </select>
                                        @error ('status')
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
                                    <th class="border-top-0">ID ANGGOTA</th>
                                    <th class="border-top-0">NIK</th>
                                    <th class="border-top-0">NAMA</th>
                                    <th class="border-top-0">JABATAN</th>
                                    <th class="border-top-0">JENIS ORGANISASI</th>
                                    <th class="border-top-0">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($user as $result => $users)
                                <tr>
                                    <th scope="row">{{ $result + $user->firstItem() }}</th>
                                    <td> 
                                        {{$users->kode_orga}}
                                    </td>
                                    <td>{{$users->nik}}</td>
                                    <td>{{$users->nama}}</td>
                                    <td>{{$users->level}}</td>
                                    <td>{{$users->jenis}}</td>
                                    <td><a href="\anggota\anggota\{{ $users->id }}" class="btn btn-primary"><i class="bi bi-eye-fill m-r-5"></i>Detail</a></td>
                                </tr>
                                @empty
                                <td colspan="8" class="table-active text-center">Tidak Ada Data</td>
                            @endforelse
                            
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-start">
                            {{$user->links()}}
                        </div>
                      
                          
                    </div>
                </div>
            </div>
        </div>  
    </div>
</div>

@endsection

<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
<script>
    $(".check_all").on("click", function(){
        $(".custom_name").each(function(){
            $(this).attr("checked", true);
        });
    });
</script>