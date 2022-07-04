<!DOCTYPE html>
<html>
<head>
	<title>Cetak Laporan Keuangan</title>
</head> 
<body>    
<div class="page-wrapper">

    <div class="page-breadcrumb bg-white">
        <h2 style="text-align:center">LAPORAN KEUANGAN</h2>
        
        <table class="table" style="text-align:justify">
            <tr>
                <th style="width:200px"> Nama Pengurus</th>
                <td> {{$data->pengurus->nama}}</td>
            </tr>
            <tr>
                <th> Jumlah Pemasukan</th>
                <td>Rp {{ number_format ($data->jmlh_pemasukan)}}</td>
            </tr>
            @isset($laporan->nama_barang)
            <tr>
                <th> Nama Barang</th>
                <td>{{$laporan->nama_barang}}</td>
            </tr>

            <tr>
                <th> Jumlah</th>
                <td>{{$laporan->jumlah}}</td>
            
            </tr>
            <tr>
                <th> Harga Satuan</th>
                <td>Rp {{ number_format ($laporan->harga_satuan)}}</td>
            </tr>

            <tr>
                <th>Jumlah Pengeluaran</th>
                <td>Rp {{ number_format ($laporan->jmlh_pengeluaran)}}</td>
            </tr>
            @endisset
            
            <tr>
                <th> Tanggal</th>
                <td>{{$data->tanggal}}</td>
            </tr>         
            <tr>
                <th> Jenis Organisasi</th>
                <td>{{$data->organisasi->jenis}}</td>
            </tr>         
            <tr>
                <th> Sumber Dana</th>
                <td>{{$data->sumber_dana}}</td>
            </tr>         
            <tr>
                <th> Keterangan</th>
                <td>{{$data->keterangan}}</td>
            </tr>         
           
               
        </table>
        
    </div>
</div>
            
</body>
</html>
            
           
    