<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>Home Page</title>

  <!-- slider stylesheet -->
  <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css" />

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="{{asset('template')}}/css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="{{asset('template')}}/css/style-index.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="{{asset('template')}}/css/responsive.css" rel="stylesheet" />
</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <div class="container" id="home">
        <nav class="navbar navbar-expand-lg custom_nav-container pt-3">
          <a class="navbar-brand" href="#">
            <img src="{{asset('template')}}/plugins/images/logo-batulumbung.jpg" alt="" /><span>
              ORGANISASI <br> BATULUMBUNG
            </span>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="d-flex ml-auto flex-column flex-lg-row align-items-center">
              <ul class="navbar-nav  ">
                <li class="nav-item active">
                  <a class="nav-link" href="#home">Home<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#pengumuman">Pengumuman</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#kegiatan">Kegiatan </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#event">Event</a>
                </li>
              </ul>
            </div>
          </nav>
        </div>
      </header>
    <!-- end header section -->
    <!-- slider section -->
    <section class=" slider_section position-relative">
      <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="slider_item-box">
              <div class="slider_item-container">
                <div class="container">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="slider_item-detail">
                        <div>
                          <h1>
                            Selamat Datang
                            Di Organisasi Batulumbung
                          </h1><br/>
                          <p>
                            Menampilkan informasi mengenai Organisasi yang terdapat di Banjar Batulumbung
                          </p>
                          <div class="d-flex">
                            <a href="pengurus/login" class="text-uppercase custom_orange-btn mr-3">
                              LOGIN
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="slider_img-box">
                        <div>
                            <img src="/template/plugins/images/img.jpeg" alt="" class="" /> 
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="slider_item-box">
              <div class="slider_item-container">
                <div class="container">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="slider_item-detail">
                        <div>
                          <h1>
                            Selamat Datang
                            Di Organisasi Batulumbung
                          </h1><br/>
                          <p>
                            Menampilkan informasi mengenai Organisasi yang terdapat di Banjar Batulumbung
                          </p>
                      
                          <div class="d-flex">
                            <a href="pengurus/login" class="text-uppercase custom_orange-btn mr-3">
                              LOGIN
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="slider_img-box">
                        <div>
                            <img src="/template/plugins/images/img1.jpeg" alt="" class="" /> 
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="slider_item-box">
              <div class="slider_item-container">
                <div class="container">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="slider_item-detail">
                        <div>
                          <h1>
                            Selamat Datang
                            Di Organisasi Batulumbung
                          </h1><br/>
                          <p>
                            Menampilkan informasi mengenai Organisasi yang terdapat di Banjar Batulumbung
                          </p>
                          <div class="d-flex">
                            <a href="pengurus/login" class="text-uppercase custom_orange-btn mr-3">
                              LOGIN
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="slider_img-box">
                        <div>
                          <img src="/template/plugins/images/img2.jpeg" alt="" class="" /> 
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="custom_carousel-control">
          <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </section>

    <!-- end slider section -->
  </div>

  <!-- pengumuman section -->

  <section class="service_section layout_padding ">
    <div class="container" id="pengumuman">
      <h2 class="custom_heading">Pengumuman</h2>
      <div class=" layout_padding2">
        <div class="card-deck">
          <div class="card">
            <div class="row">
              <div class="card-body">
              @forelse($pengumuman as $pengumumans)
              <h5  style="font-weight: 800; ">
                  {{$pengumumans->judul}} - {{$pengumumans->organisasi->jenis}}
              </h5>
              <h6>{{$pengumumans->tanggal}} | {{$pengumumans->waktu}}</h6>
                <h6>{{$pengumumans->tempat}}</h6>
                <h6>{{$pengumumans->isi}}</h6>
                <h6><a href="{{route('file.download', $pengumumans->id)}}">Download File</a></h6>
                <p align="right" style="font-size: 12px">Diposting : {!! $pengumumans->created_at !!}</p>
                <hr color="orange">
              @empty
              <span  style="font-weight: 800; ">Tidak Ada Data</span>
              @endforelse
              </div>
            </div>
          </div>
        </div>
    </div>
  </section>

  <!-- end pengumuman section -->

   <!-- kegiatan section -->

   <section class="service_section layout_padding ">
    <div class="container" id="kegiatan">
      <h2 class="custom_heading">Kegiatan</h2>
      <div class=" layout_padding2">
        <div class="card-deck">
          <div class="card">
            <div class="row">
              <div class="card-body">
                @forelse($kegiatan as $kegiatans)
                <h5  style="font-weight: 800; ">
                  {{$kegiatans->nama_kegiatan}} - {{$kegiatans->organisasi->jenis}}
                </h5>
                <h6>{{$kegiatans->tanggal}} | {{$kegiatans->waktu}}</h6>
                <h6>{{$kegiatans->tempat}}</h6>
                <h6>{!! $kegiatans->deskripsi !!}</h6>
                <p align="right" style="font-size: 12px">Diposting : {!! $kegiatans->created_at !!}</p>
                <hr color="orange">
                @empty
                  <span  style="font-weight: 800; ">Tidak Ada Data</span>
                @endforelse
              </div>
            </div>
          </div>
        </div>
    </div>
  </section>

  <!-- end kegiatan section -->

  <!-- event section -->

  <section class="service_section layout_padding ">
    <div class="container" id="event">
      <h2 class="custom_heading">Event</h2>
      <div class=" layout_padding2">
        <div class="card-deck">
          <div class="card">
            <div class="row">
              <div class="card-body">
                @forelse($event as $events)
                <h5  style="font-weight: 800; ">
                  {{$events->nama_event}}
                </h5>
                <h6 style="font-weight: 800; "  >{{$events->organisasi->jenis}} </h6>
                <h6>{{$events->tanggal}} | {{$events->waktu}}</h6>
                <h6>{{$events->tempat}}</h6>
                <h6>{{$events->keterangan}}</h6>
                <p align="right" style="font-size: 12px">Diposting : {!! $events->created_at !!}</p>
                <hr color="orange">
                @empty
                  <span  style="font-weight: 800; ">Tidak Ada Data</span>
                @endforelse
              </div>
            </div>
          </div>         
        </div>
      </div>
    </div>
  </section>

  <!-- end event section -->

  <!-- footer section -->
  <section class="container-fluid footer_section">
    <p>
      2021 &copy; Organisasi Banjar Batulumbung
    </p>
  </section>
  <!-- footer section -->

  <script type="text/javascript" src="template/js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="template/js/bootstrap.js"></script>

  <script>
    // This example adds a marker to indicate the position of Bondi Beach in Sydney,
    // Australia.
    function initMap() {
      var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 11,
        center: {
          lat: 40.645037,
          lng: -73.880224
        },
      });

      var image = 'images/maps-and-flags.png';
      var beachMarker = new google.maps.Marker({
        position: {
          lat: 40.645037,
          lng: -73.880224
        },
        map: map,
        icon: image
      });
    }
  </script>
  <!-- google map js -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8eaHt9Dh5H57Zh0xVTqxVdBFCvFMqFjQ&callback=initMap">
  </script>
  <!-- end google map js -->
</body>

</html>