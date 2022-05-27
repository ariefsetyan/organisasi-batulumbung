@extends('layouts.main-pengurus')

@section('title', 'Absensi')

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
                    <h4 class="page-title">Daftar Pemasukan</h4>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="white-box">

                        <a href="{{url('form-pemasukan')}}" class="btn btn-primary mr-5">
                            TAMBAH DATA PEMASUKAN
                        </a>

                        <div class="table-responsive mt-3">
                            <table class="table table-striped" id="myTable" style="width:100%">
                                <thead>
                                <tr>
                                    <th class="border-top-0">NO</th>
                                    <th class="border-top-0">Jumlah Pemasukan</th>
                                    <th class="border-top-0">Tanggal</th>
                                    <th class="border-top-0">Sumber Dana</th>
                                    <th class="border-top-0">Jenis Organisasi</th>
                                    <th class="border-top-0">Keterangan</th>
                                    <th class="border-top-0">ACTION</th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php $no=1 ?>
                                @foreach($data as $row)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$row->jmlh_pemasukan}}</td>
                                    <td>{{$row->tanggal}}</td>
                                    <td>{{$row->sumber_dana}}</td>
                                    <td>{{$row->jenis}}</td>
                                    <td>{{$row->keterangan}}</td>
                                    <td>
                                        <a href="form-edit-pemasukan/{{$row->id}}" value="{{$row->id}}" id="btn-update" class="btn btn-primary"><i class="bi bi-pencil m-r-5"></i>Edit</a> |
                                        <a href="hapus-pemasukan/{{$row->id}}" class="btn btn-primary"><i class="bi bi-archive m-r-5"></i>Delete</a></td>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
<script>
    $(document).ready( function () {
        $('#myTable thead tr')
            .clone(true)
            .addClass('filters')
            .appendTo('#myTable thead');
        var table = $('#myTable').DataTable({
            orderCellsTop: true,
            fixedHeader: true,
            initComplete: function () {
                var api = this.api();

                // For each column
                api
                    .columns()
                    .eq(0)
                    .each(function (colIdx) {
                        // Set the header cell to contain the input element
                        var cell = $('.filters th').eq(
                            $(api.column(colIdx).header()).index()
                        );
                        var title = $(cell).text();
                        $(cell).html('<input type="text"  style="width: 70%" />');

                        // On every keypress in this input
                        $(
                            'input',
                            $('.filters th').eq($(api.column(colIdx).header()).index())
                        )
                            .off('keyup change')
                            .on('keyup change', function (e) {
                                e.stopPropagation();

                                // Get the search value
                                $(this).attr('title', $(this).val());
                                var regexr = '({search})'; //$(this).parents('th').find('select').val();

                                var cursorPosition = this.selectionStart;
                                // Search the column for that value
                                api
                                    .column(colIdx)
                                    .search(
                                        this.value != ''
                                            ? regexr.replace('{search}', '(((' + this.value + ')))')
                                            : '',
                                        this.value != '',
                                        this.value == ''
                                    )
                                    .draw();

                                $(this)
                                    .focus()[0]
                                    .setSelectionRange(cursorPosition, cursorPosition);
                            });
                    });
            },

        });

    } );
</script>
@endpush
