@extends('layouts.main-pengurus')

@section('title', 'Pemasukan')

@push('link')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css">
    {{--    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.css">--}}


@endpush

@push('script1')
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="hhttps://cdn.datatables.net/fixedheader/3.2.3/js/dataTables.fixedHeader.min.js"></script>


@endpush
{{-- @endpush --}}



@section('content')
    <div class="page-wrapper">

        <div class="page-breadcrumb bg-white">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Form Pemasukan</h4>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="white-box">
                        <form method="post" action="simpan-pemasukan">
                            <div class="modal-content">

                                <div class="modal-body">
                                    {{ csrf_field() }}

                                    <div class="form-group">
                                    <label for="organisasi_id" class="form-label" required>Jenis Organisasi</label> <br>
                                            <input type="text"  value="{{$auth}}" class="form-control" readonly 
                                            id="organisasi_id">
                                            <input type="hidden" value="{{$auth_id}}" name="organisasi_id">
                                    </div>
                                    <div class="form-group">
                                        <label>Jumlah Pemasukan</label>
                                        <input type="number" name="jumlah_pemasukan" class="form-control"
                                               id="jumlah_pemasukkan" placeholder="Masukkan Jumlah Pemasukan" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal">Tanggal</label>
                                        <input type="date" name="tanggal" class="form-control"
                                               id="tanggal" placeholder="Masukkan Tanggal" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Sumber Dana</label>
                                        <input type="text" name="sumber_dana" class="form-control"
                                               id="jumlah_pemasukkan" placeholder="Masukkan Sumber Dana" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <input type="text" name="keterangan" class="form-control"
                                               id="keterangan" placeholder="Masukkan Keterangan" required>
                                    </div>

                                    <div class="modal-footer">
                                        <a href="/pemasukan" type="button" class="btn btn-secondary" data-dismiss="modal">Close</a>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>

                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')

@endpush
