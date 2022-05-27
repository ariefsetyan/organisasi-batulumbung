<!DOCTYPE html>
<html lang="en">
<head>
	<title>Register</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="icon" type="image/png" sizes="16x16" href="{{asset('template')}}/plugins/images/logo-batulumbung.jpg"> 
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('template')}}/fonts/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('template')}}/css/util.css">
	<link rel="stylesheet" type="text/css" href="{{asset('template')}}/css/register.css">
	<link rel="stylesheet" type="text/css" href="{{asset('template')}}/css/style.css">
<!--===============================================================================================-->
</head>
<body>
	
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-regist100">
            <div class="login100-form-title" style="background-image: url({{asset('template')}}/plugins/images/img.jpeg)">
                <span class="login100-form-title-1">
                    Form Registrasi
                </span>
                <span class="login100 text-white">
                    Sistem Informasi Organisasi Batulumbung
                </span>
            </div>

            <form method="post" action="{{ route('register') }}">
            @csrf
            <div class="login100-form m-t-36">
                <label for="nama">Nama</label> 
                <input type="text" name="nama" value="{{ old ('nama') }}" class="form-control @error('nama') is-invalid @enderror" 
                id="nama" placeholder="Masukkan Nama Lengkap">
                @error ('nama')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="login100-form">
                <label for="nik">NIK</label> 
                <input type="text" name="nik" value="{{ old ('nik') }}" class="form-control @error('nik') is-invalid @enderror" 
                id="nik" placeholder="Masukkan NIK">
                @error ('nik')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="login100-form">
                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" value="{{ old ('tempat_lahir') }}" class="form-control @error('tempat_lahir') is-invalid @enderror" 
                id="tempat_lahir" placeholder="Masukkan Tempat Lahir">
                @error ('tempat_lahir')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="login100-form">
                <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" name="tgl_lahir" value="{{ old ('tgl_lahir') }}" class="form-control @error('tgl_lahir') is-invalid @enderror" 
                id="tgl_lahir" placeholder="Tanggal Lahir">
                @error ('tgl_lahir')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="login100-form">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" value="{{ old ('email') }}" class="form-control @error('email') is-invalid @enderror" 
                id="email" placeholder="Masukkan Email">
                @error ('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="login100-form">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" value="{{ old ('password') }}" class="form-control @error('password') is-invalid @enderror" 
                id="password" placeholder="Masukkan Password">
                @error ('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="login100-form">
                <label for="password" class="form-label">Konfirmasi Password</label>
                <input type="password" name="konfirmpassword" value="{{ old ('konfirmpassword') }}" class="form-control @error('konfirmpassword') is-invalid @enderror" 
                id="konfirmpassword" placeholder="Masukkan Password">
                @error ('konfirmpassword')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="login100-form">
                <label for="no_telp" class="form-label">Telp</label>
                <input type="text" name="no_telp" value="{{ old ('no_telp') }}" class="form-control @error('no_telp') is-invalid @enderror" 
                id="no_telp" placeholder="Masukkan Nomor Telp">
                @error ('no_telp')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="login100-form">
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

            <div class="login100-form">
                <label for="pekerjaan" class="form-label">Pekerjaan</label>
                <input type="text" name="pekerjaan" value="{{ old ('pekerjaan') }}" class="form-control @error('pekerjaan') is-invalid @enderror" 
                id="pekerjaan" placeholder="Masukkan Pekerjaan">
                @error ('pekerjaan')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="login100-form">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="textarea" name="alamat" value="{{ old ('alamat') }}" class="form-control @error('alamat') is-invalid @enderror" 
                id="alamat" placeholder="Masukkan Alamat">
                @error ('alamat')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="login100-form">
                <label for="organisasi_id" class="form-label">Jenis Organisasi</label> <br/>
                <input type="checkbox" class="check_all" name="organisasi_id[]" id="sekaagong" value="1"> Sekaa Teruna <br/>
                <input type="checkbox" class="check_all" name="organisasi_id[]" id="sekaagong" value="2"> Sekaa Gong  <br/>
                <input type="checkbox" class="check_all" name="organisasi_id[]" id="sekaasanti" value="3"> Sekaa Santi <br/>
                <input type="checkbox" class="check_all" name="organisasi_id[]" id="pkk" value="4"> PKK <br/>
                @error ('organisasi_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror  
            </div>

            <div class="login100-form">
            <label for="level" class="form-label">Jabatan</label> <br/>
            <input type="checkbox" class="check_all" name="level" id="anggota" value="Anggota" checked> Anggota<br/>
               
            </div>`

            <div class="login100-form">
                <label for="exampleFormControlSelect">Status</label>
                <select name="status" value="{{ old ('status') }}" class="form-control" id="exampleFormControlSelect">
                    <option value="">--Pilih--</option>
                    <option value="Aktif">Aktif</option>
                    <option value="Tidak Aktif">Tidak Aktif</option>
                </select>
            </div>

            <div class="container-login100-form-btn m-t-26 m-b-26 m-l-225">
                <button class="login100-form-btn">
                    DAFTAR
                </button>
            </div>

            <!-- <button type="submit" class="btn btn-primary">DAFTAR</button> -->
        
          <div class="txt1">
            <p>Sudah punya akun?
            <a href="/pengurus/login">Masuk</a>
          </p>
          </div>
				</form>
			</div>
		</div>
	</div>

</body>
</html>