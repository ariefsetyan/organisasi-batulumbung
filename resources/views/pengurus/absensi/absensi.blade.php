@extends('layouts.main-pengurus')

@section('title', 'Absensi')

@push('link')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

@endpush

@push('script1')

@endpush
{{-- @endpush --}}



@section('content')
<div class="page-wrapper">

    <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Daftar Absensi</h4>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">


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


                {{-- notifikasi form validasi --}}
                @if ($errors->has('file'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('file') }}</strong>
                </span>
                @endif

                {{-- notifikasi sukses --}}
                @if ($sukses = Session::get('sukses'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $sukses }}</strong>
                </div>
                @endif

                <button type="button" class="btn btn-primary mr-5" target="_blank" data-toggle="modal" data-target="#importExcel">
                    TAMBAH DATA ABSENSI
                </button>

                <!-- Import Excel -->
                <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form method="post" action="/pengurus/absensi/absensi" enctype="multipart/form-data">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                                </div>
                                <div class="modal-body">
                                    {{ csrf_field() }}

                                    <div class="form-group">
                                        <label for="nama_kegiatan">Nama Kegiatan</label>
                                        <select name="nama_kegiatan" id="nama_kegiatan" class="form-control @error('nama_kegiatan') is-invalid @enderror" onchange="getval(this);">
                                            <option value="" selected>Pilih Kegiatan</option>
                                            @foreach($kegiatan as $kegiatans)
                                            <option value="{{$kegiatans->nama_kegiatan}}">{{$kegiatans->nama_kegiatan}}</option>
                                            @endforeach
                                        </select>
                                        @error ('nama_kegiatan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal">Tanggal</label>
                                        <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror"
                                        id="tanggal" placeholder="Masukkan Tanggal">

                                        @error ('tanggal')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect">Jenis Organisasi</label>
                                        <select name="organisasi_id" class="form-control @error('organisasi_id') is-invalid @enderror" id="exampleFormControlSelect">
                                            <option value="">--Pilih--</option>
                                            <option value="1">Sekaa Teruna</option>
                                            <option value="2">Sekaa Gong</option>
                                            <option value="3">Sekaa Santi</option>
                                            <option value="4">PKK</option>
                                        </select>
                                        @error ('organisasi_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="file" class="form-label">Pilih File Excel</label>
                                        <input type="file" name="file" class="form-control @error('file') is-invalid @enderror"
                                        id="file">
                                        @error ('file')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Import</button>
                                    </div>

                                </div>

                            </div>
                        </form>
                    </div>
                </div>

                <a href="{{ route ('daftar_absensi') }}" class="btn btn-success my-3 text-light">LIHAT DAFTAR ABSENSI</a>

                    <div class="table-responsive mt-3">
                        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">
                        <table class="table table-striped" id="myTable">
                            <thead>
                                <tr>
                                    <th class="border-top-0">NO</th>
                                    <th class="border-top-0">ID ANGGOTA</th>
                                    <th class="border-top-0">NAMA ANGGOTA</th>
                                    <th class="border-top-0">NAMA KEGIATAN</th>
                                    <th class="border-top-0">TANGGAL</th>
                                    <th class="border-top-0">JENIS ORGANISASI</th>
                                    <th class="border-top-0">STATUS</th>
                                    <th class="border-top-0">ACTION</th>
                                </tr>
                            </thead>

                            <tbody>
                            @foreach ($absensi as $result => $absen)
                                <tr>
                                    <td scope="row">{{ $result + $absensi->firstitem() }}</td>
                                    <td>{{$absen->anggota_id}}</td>
                                    <td>{{$absen->nama}}</td>
                                    <td>{{$absen->nama_kegiatan}}</td>
                                    <td>{{ \Carbon\Carbon::parse($absen->tanggal)->format('Y-m-d')}}</td>
                                    <!-- carbon format (y-m-d) -->
                                    <td>{{$absen->organisasi->jenis}}</td>
                                    <td>{{$absen->status}}</td>
                                    <td>
                                        <button value="{{$absen->id}}" onclick="form_edit({{$absen->id}})" class="btn btn-primary" data-toggle="modal" data-target="#edit"><i class="bi bi-pencil m-r-5"></i>Edit</button> |
                                        <a href="hapus_absen/{{$absen->id}}" class="btn btn-primary"><i class="bi bi-archive m-r-5"></i>Delete</a></td>
                            @endforeach
                            </tbody>
                        </table>
                        {{-- modaledit --}}
                        <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <form method="post">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">update</h5>
                                        </div>
                                        <div class="modal-body">
                                            {{ csrf_field() }}
                                            <input type="text" hidden name="id_absen" class="form-control " id="id_absen">
                                            <div class="form-group">
                                                <label for="nama_angota">nama_anggota</label>
                                                <input type="text" name="nama_anggota" class="form-control " id="nama_anggota" placeholder="Masukkan nama angota">
                                                @error ('nama_angota')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="nama_kegiatan">nama_kegiatan</label>
                                                <select name="nama_kegiatan" id="nama_kegiataan" class="form-control @error('nama_kegiatan') is-invalid @enderror" onchange="getvalanggota(this);">
                                                    <option value="">Pilih kegiatan</option>
                                                    @foreach($kegiatan as $kegiatans)
                                                        <option value="{{$kegiatans->nama_kegiatan}}">{{$kegiatans->nama_kegiatan}}</option>
                                                    @endforeach
                                                </select>
                                                @error ('nama_kegiatan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="tanggal">Tanggal</label>
                                                <input type="date" name="tanggal_absen" class="form-control @error('tanggal') is-invalid @enderror"
                                                id="tanggal_absen" placeholder="Tanggal">

                                                @error ('tanggal')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect">Jenis Organisasi</label>
                                                <select name="organisasi_id" class="form-control @error('organisasi_id') is-invalid @enderror" id="jenis_absen">
                                                    <option value="">--Pilih--</option>
                                                    <option value="1">Sekaa Teruna</option>
                                                    <option value="2">Sekaa Gong</option>
                                                    <option value="3">Sekaa Santi</option>
                                                    <option value="4">PKK</option>
                                                </select>
                                                @error ('organisasi_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect">status</label>
                                                <select name="status" class="form-control @error('status') is-invalid @enderror" id="status">
                                                    <option value="">--Pilih--</option>
                                                    <option value="t">AKTIF</option>
                                                    <option value="F">TIDAK AKTIF</option>

                                                </select>
                                                @error ('status')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button onclick="update()" type="button" class="btn btn-primary" data-dismiss="modal">Save</button>
                                            </div>
                                            {{-- end modal edit --}}
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[2];
                if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
                }
            }
            }

        function getval(sel){
            kegiatan = sel.value;
            $.ajax({
                url:"get_kegiatan/"+kegiatan,
                type:"GET",
                dataType:'json',
                success:function (data) {
                    $.each(data, function (key,value) {
                        $("#exampleFormControlSelect").val(value.organisasi_id)
                        $("#tanggal").val(value.tanggal)

                    })
                }
            })
        }

        function form_edit(params) {
             $('#edit').modal('show');
            $.ajax({
                url:"get_absen/"+params,
                type:"GET",
                dataType:'json',
                success:function (data) {
                    $.each(data, function (key,value) {
                        $("#id_absen").val(value.id);
                        $("#nama_anggota").val(value.nama);
                        $("#nama_kegiataan").val(value.nama_kegiatan).change();
                        $("#jenis_absen").val(value.organisasi_id).change();
                        $("#tanggal_absen").val(value.tanggal)
                        $("#status").val(value.status)
                    })
                }
            })
        }

        function update() {

            $.ajax({
                url:"update_absen",
                type:"POST",
                data:{
                    _token: '{{csrf_token()}}',
                    id:$("#id_absen").val(),
                    nama_anggota:$("#nama_anggota").val(),
                    nama_kegiatan:$("#nama_kegiataan").val(),
                    jenis_absen:$("#jenis_absen").val(),
                    tanggal:$("#tanggal_absen").val(),
                    status:$("#status").val(),
                },
                dataType:'json',
                success:function (data) {
                    // window.location.href = "/absensi/absensi";
                },
                complete: function (data) {
                    $('#edit').modal('hide');
                }
            })
        }

    </script>
@endpush
