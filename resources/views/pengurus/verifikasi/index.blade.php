@extends('layouts.main-pengurus')

@section('title', 'Verifikasi Anggota')

@section('content')
    <div class="page-wrapper">

        <div class="page-breadcrumb bg-white">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Daftar Verifikasi</h4>
                </div>
            </div>
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

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="white-box">

                        <div class="table-responsive mt-3">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th class="border-top-0">NO</th>
                                    <th class="border-top-0">NIK</th>
                                    <th class="border-top-0">NAMA</th>
                                    <th class="border-top-0">JABATAN</th>
                                    <th class="border-top-0">JENIS ORGANISASI</th>
                                    <th class="border-top-0">AKSI</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i=1?>
                                @forelse($user as $result => $users)
                                    <tr>
                                        <th scope="row">{{$i++}}</th>
                                        <td>{{$users->nik}}</td>
                                        <td>{{$users->nama}}</td>
                                        <td>{{$users->level}}</td>
                                        <td>{{$auth}}</td>
                                        <td><a href="\proses-verif\{{ $users->id }}" class="btn btn-primary"><i class="bi bi-check2"></i> Accept</a></td>
                                    </tr>
                                @empty
                                    <td colspan="8" class="table-active text-center">Tidak Ada Data</td>
                                @endforelse

                                </tbody>
                            </table>

{{--                            <div class="d-flex justify-content-start">--}}
{{--                                {{$user->links()}}--}}
{{--                            </div>--}}


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
