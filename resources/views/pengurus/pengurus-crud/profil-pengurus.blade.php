@extends('layouts.main-pengurus')

@section('title', 'Profil')

@section('content')

<div class="page-wrapper">
    <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Profil</h4>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        
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

        <table class="table table-light table-borderless">
        @foreach($user as $user)
            <tr>
                <th style="width:200px">ID</th>
                <th>:</th>
                <td>{{ $user->id}}</td>
                    <th style="width:200px">Pekerjaan</th>
                <th>:</th>
                <td>{{ $user->pekerjaan}}</td>
            </tr>

            <tr>
                <th>Nama</th>
                <th>:</th>
                <td>{{ $user->nama}}</td>
                <th>Jenis Kelamin</th>
                <th>:</th>
                <td>{{ $user->jenis_kelamin}}</td>
            </tr>

            <tr>
                <th>NIK</th>
                <th>:</th>
                <td>{{ $user->nik}}</td>
                <th>Alamat</th>
                <th>:</th>
                <td>{{ $user->alamat}}</td>
            </tr>

            <tr>
                <th>Jabatan</th>
                <th>:</th>
                <td>{{ $user->level}}</td>
                <th>Tempat, Tanggal Lahir</th>
                <th>:</th>
                <td>{{ $user->tempat_lahir}}, {{ $user->tgl_lahir}}</td>
            </tr>
            
            <tr>
                <th>Email</th>
                <th>:</th>
                <td>{{ $user->email}}</td>
                <th>Jenis Organisasi</th>
                <th>:</th>
                <td>  
                @foreach( $jenis as $organisasi)
                    {{ $organisasi->organisasi->jenis }}
                @endforeach
                </td>
            </tr>
            
            <tr>
                <th>Telp</th>
                <th>:</th>
                <td>{{ $user->no_telp}}</td>
                <th>Status</th>
                <th>:</th>
                <td>{{ $user->status}}</td>
            </tr>
            @endforeach
        </table>
        <div>
            <a href="{{$user->id}}/edit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfil">Edit Profil</a>
            <a href="{{$user->id}}/edit-password" class="btn btn-danger text-light" data-bs-toggle="modal" data-bs-target="#editPassword">Edit Password</a>
            <span class="btn btn-success"><a href="/pengurus-crud/pengurus" class="card-link text-light">Kembali</a></span>
        </div>
    </div>

        <!-- Edit Profil -->
        <!-- Modal -->
        <div class="modal fade" id="editProfil" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editProfilLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProfilLabel">Form Edit Profil</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <form method="post" action="/pengurus-crud/profil-pengurus/{{ $user->id }}" style="width:100%">
                    @method('patch')
                    @csrf
                        <div class="form-group">
                            <label for="nama">Nama</label> 
                            <input type="text" name="nama" value="{{ $user->nama }}" class="form-control @error('nama') is-invalid @enderror" 
                            id="nama" placeholder="Masukkan Nama">
                            @error ('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label form="nik">NIK</label>
                            <input type="text" name="nik" value="{{ $user->nik }}" class="form-control @error('nik') is-invalid @enderror"
                            id="nik" readonly>
                            @error('nik')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" value="{{ $user->tempat_lahir }}" class="form-control @error('tempat_lahir') is-invalid @enderror" 
                            id="tempat_lahir" placeholder="Masukkan Tempat Lahir">
                            @error ('tempat_lahir')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" name="tgl_lahir" value="{{ $user->tgl_lahir }}" class="form-control @error('tgl_lahir') is-invalid @enderror" 
                            id="tgl_lahir" placeholder="Tanggal Lahir">
                            @error ('tgl_lahir')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlSelect">Jabatan</label>
                            <select name="level" class="form-control @error('level') is-invalid @enderror" id="exampleFormControlSelect">
                                <option value="Ketua" @if($user->level == "Ketua") selected @endif>Ketua</option>
                                <option value="Wakil Ketua" @if($user->level == "Wakil Ketua") selected @endif>Wakil Ketua</option>
                                <option value="Sekretaris"  @if($user->level == "Sekretaris") selected @endif>Sekretaris</option>
                                <option value="Bendahara"  @if($user->level == "Bendahara") selected @endif>Bendahara</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" name="email" value="{{ $user->email }}" class="form-control @error('email') is-invalid @enderror" 
                            id="email" placeholder="Masukkan Email">
                            @error ('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="no_telp" class="form-label">No Telp</label>
                            <input type="no_telp" name="no_telp" value="{{ $user->no_telp }}" class="form-control @error('no_telp') is-invalid @enderror" 
                            id="no_telp" placeholder="Masukkan No Telp">
                            @error ('no_telp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlSelect">Jenis Kelamin</label>
                            <select name="jenis_kelamin" value="{{ $user->jenis_kelamin }}" class="form-control @error('jenis_kelamin') is-invalid @enderror" 
                            id="exampleFormControlSelect">
                                <option value="Laki-Laki" @if($user->jenis_kelamin == "Laki-Laki") selected @endif>Laki-Laki</option>
                                <option valie="Perempuan" @if($user->jenis_kelamin == "Perempuan") selected @endif>Perempuan</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="pekerjaan" class="form-label">Pekerjaan</label>
                            <input type="text" name="pekerjaan" value="{{ $user->pekerjaan }}" class="form-control @error('pekerjaan') is-invalid @enderror" 
                            id="pekerjaan" placeholder="Masukkan Pekerjaan">
                            @error ('pekerjaan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="textarea" name="alamat" value="{{ $user->alamat }}" class="form-control @error('alamat') is-invalid @enderror" 
                            id="alamat" placeholder="Masukkan Alamat">
                            @error ('alamat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlSelect">Jenis Organisasi</label> <br>
                            <input type="checkbox" class="check_all" name="organisasi_id[]" id="sekaateruna" value="1" @if($user->organisasi_id == "1") checked @endif> Sekaa Teruna<br>
                            <input type="checkbox" class="check_all" name="organisasi_id[]" id="sekaagong" value="2" @if($user->organisasi_id == "2") checked @endif> Sekaa Gong<br>
                            <input type="checkbox" class="check_all" name="organisasi_id[]" id="sekaasanti" value="3" @if($user->organisasi_id == "3") checked @endif> Sekaa Santi<br>
                            <input type="checkbox" class="check_all" name="organisasi_id[]" id="pkk" value="4" @if($user->organisasi_id == "4") checked @endif> PKK<br>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlSelect">Status</label>
                            <select name="status" value="{{ $user->status }}" class="form-control @error('status') is-invalid @enderror" 
                            id="exampleFormControlSelect">
                                <option value="Aktif" @if($user->status == "Aktif") selected @endif>Aktif</option>
                                <option value="Tidak Aktif" @if($user->status == "Tidak Aktif") selected @endif>Tidak Aktif</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-danger text-light" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Password -->
        <!-- Modal -->
        <div class="modal fade" id="editPassword" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="editPasswordLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editPasswordLabel">Edit Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    
                    <div class="modal-body">

                    <form method="POST" action="{{ route ('update_password_pengurus') }}">
                    @method('patch')
                    @csrf

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">Password Saat Ini</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">Password Baru</label>
                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">Konfirmasi Password</label>
                        <div class="col-md-6">
                            <input id="konfirmpassword" type="password" class="form-control" name="konfirmpassword" required>
                            @error('konfirmpassword')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="button" class="btn btn-danger text-light" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Update Password</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>            



@endsection