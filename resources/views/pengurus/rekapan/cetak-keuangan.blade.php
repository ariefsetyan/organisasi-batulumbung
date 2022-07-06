<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Ample lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Ample admin lite dashboard bootstrap 5 dashboard template">
    <meta name="description"
        content="Ample Admin Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">

    <title>Cetak Laporan Keuangan</title>

    <link rel="canonical" href="https://www.wrappixel.com/templates/ample-admin-lite/" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('template')}}/plugins/images/logo-batulumbung.jpg">
    <!-- Custom CSS -->
    <link href="{{asset('template')}}/plugins/bower_components/chartist/dist/chartist.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('template')}}/plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css">
    <!-- Custom CSS -->
    <link href="{{asset('template')}}/css/style.min.css" rel="stylesheet">
    <link href="{{asset('template')}}/css/main.css" rel="stylesheet">
    <script src="{{asset('template')}}/plugins/bower_components/jquery/dist/jquery.min.js"></script>
    @stack('link')
    @stack('style')
    @stack('script1')
</head>
<body>    
<div class="page-wrapper">

<div class="table-responsive mt-3">
<h2 style="text-align:center">LAPORAN KEUANGAN</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th class="border-top-0">NO</th>
                <th class="border-top-0">TANGGAL</th>
                <th class="border-top-0">JUMLAH (RP)</th>
                <th class="border-top-0">JENIS TRANSAKSI</th>
                <th class="border-top-0">JENIS ORGANISASI</th>
                <th class="border-top-0">SUMBER DANA</th>
            </tr>
        </thead>
        <tbody>
        @forelse($rekapan as $row)
        <tr>
            <th scope="row">{{ $loop->iteration}}</th>
            <td>{{$row->tanggal}}</td>
            @if(!$row->jmlh_pemasukan)
            <td>Rp {{ number_format($row->total) }}</td>
            <td>Pengeluaran</td>
            @else
            <td>Rp {{ number_format($row->jmlh_pemasukan) }}</td>
            <td>Pemasukan</td>
            @endif
            <td>{{$auth}}</td>
            <td>{{$row->sumber_dana}}</td>
        </tr>
        @empty
        <td colspan="9" class="table-active text-center">Tidak Ada Data</td>
        @endforelse
        <tbody>
        <tfoot>
            <tr>
                <th colspan="3"></th>
                <th>Pemasukan</th>
                <th>Pengeluaran</th>
                <th>Sisa</th>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td>Rp {{number_format($total_pemasukan,0)}}</td>
                <td>Rp {{number_format($total_pengeluaran,0)}}</td>
                @php
                $total = $total_pemasukan - $total_pengeluaran;
                @endphp
                <td>Rp {{number_format($total,0)}}</td>
            </tr>
        </tfoot>
    </table> 
</div>

</body>
</html>
<script type="text/javascript">
window.print();
</script>   
           
    