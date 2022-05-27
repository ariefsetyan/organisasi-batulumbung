<!DOCTYPE html>
<html lang="en">
<head>
    <title>Halaman Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<!--===============================================================================================-->  
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('template')}}/plugins/images/logo-batulumbung.jpg"> 
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('template')}}/fonts/icon-font.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('template')}}/css/util.css">
    <link rel="stylesheet" type="text/css" href="{{asset('template')}}/css/login.css">
<!--===============================================================================================-->
</head>
<body>
    
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-form-title" style="background-image: url({{asset('template')}}/plugins/images/img.jpeg)">
                    <span class="login100-form-title-1"> Sistem Informasi Organisasi Batulumbung </span>
                </div>
              
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

                <form class="login-form validate-form" method="post" action="{{ route ('loginPost')}}">
                @csrf
                    <div class="wrap-input100 validate-input m-b-24" data-validate="Username is required">
                        <span class="label-input100">Email</span>
                        <input class="input100 @error('email') is-invalid @enderror" type="email" name="email" 
                        id="email" placeholder="Masukkan email" autofocus required value="{{ old ('email')}}">
                        <span class="focus-input100"></span>
                        @error ('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="wrap-input100 validate-input m-b-16" data-validate = "Password is required">
                        <span class="label-input100">Password</span>
                        <input class="input100" type="password" name="password"  id="password" placeholder="Masukkan password" required>
                        <span class="focus-input100"></span>
                    </div>
        
                    <div class="container-login100-form-btn m-b-26 m-l-71">
                        <button class="login100-form-btn">
                            MASUK
                        </button>
                    </div>
                    <div class="txt1">
                        <p>Belum punya akun?
                            <a href="/register">Daftar Sekarang</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
<script src="{{asset('template')}}/js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

</body>
</html>
 
