@extends('layouts.main-pengurus')

@section('title', 'Pengeluaran')

@push('link')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css">
    {{--    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.css">--}}


@endpush

@push('script1')
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="hhttps://cdn.datatables.net/fixedheader/3.2.3/js/dataTables.fixedHeader.min.js"></script>


@endpush

@section('content')
    <div class="page-wrapper">

        <div class="page-breadcrumb bg-white">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Form Pengeluaran</h4>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="white-box">
                        <form method="POST" action="simpan-pengeluaran">
                            <div class="modal-content">
                                <div class="modal-body">
                                    {{ csrf_field() }}

                                    <div class="form-group">
                                        <label for="nama_kegiatan">organisasi</label>
                                        <select name="nama_kegiatan" id="nama_kegiatan" class="form-control" required>
                                            <option value="" selected>Pilih organisasi</option>
                                            @foreach($organisasi as $row)
                                                <option value="{{$row->id}}">{{$row->jenis}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="tanggal">Tanggal</label>
                                        <input type="date" name="tanggal" class="form-control" required
                                               id="tanggal" placeholder="Masukkan Tanggal">
                                    </div>

                                    <table class="table table-bordered table-striped" id="table_barang">
                                        <thead>
                                        <tr>
                                            <th width="35%">Nama Barang</th>
                                            <th width="20%">jumlah</th>
                                            <th width="20%">Harga Satuan</th>
                                            <th width="20%">total</th>
                                            <th width="20%">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td colspan="3" align="right">&nbsp jumlah</td>
                                            <td>
                                                <input type="number" name="sum" id="sum" class="form-control sum" required readonly/>
                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                    <div class="form-group">
                                        <label>Sumber Dana</label>
                                        <select name="sumber_dana" id="sumber_dana" class="form-control" required>
                                            <option value="" selected>Pilih Sumber Dana</option>
                                            @foreach($sumber_dana as $row)
                                                <option value="{{$row->id}}">{{$row->sumber_dana}}</option>
                                            @endforeach
                                        </select>

                                    </div>

                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <input type="text" name="keterangan" class="form-control"
                                               id="keterangan" placeholder="Masukkan Keterangan">
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-simpan"><i class="fa fa-save"></i> Submit</button>

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
<script>
    $(document).ready(function(){

        var count = 1;

        dynamic_field(count);

        function dynamic_field(number)
        {
            html = '<tr>';
            html += '<td><input type="text" name="nama_barang[]" class="form-control" required/></td>';
            html += '<td><input type="text" name="jumlah_barang[]" class="form-control jumlah_barang" onchange="jumlah()" required/></td>';
            html += '<td><input type="text" name="harga_barang[]" class="form-control harga_barang" onchange="jumlah()" required/></td>';
            html += '<td><input type="text" name="total[]" class="form-control total" required/></td>';
            if(number > 1)
            {
                html += '<td><button type="button" name="remove" id="" class="btn btn-danger remove">Remove</button></td></tr>';
                $('tbody').append(html);
            }
            else
            {
                html += '<td><button type="button" name="add" id="add" class="btn btn-success">Add</button></td></tr>';
                $('tbody').html(html);
            }
        }

        $(document).on('click', '#add', function(){
            count++;
            dynamic_field(count);
        });

        $(document).on('click', '.remove', function(){
            count--;
            $(this).closest("tr").remove();
        });



    });


    function jumlah() {

        let sum = 0;
        $('#table_barang > tbody  > tr').each(function() {
            //$(this).closest("#user_table > tbody  > tr").find(".total").each(function() {
            console.log("aa");
            var jumlah_barang = $(this).find(".jumlah_barang").val();
            var harga_satuan = $(this).find(".harga_barang").val();
            var total_item = jumlah_barang * harga_satuan;
            $(this).find('.total').val(total_item);
            sum+=total_item;
        })
        $("#sum").val(sum);
    }



</script>
@endpush
