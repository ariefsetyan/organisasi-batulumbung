<!DOCTYPE html>
<html>
<head>
	<title>Cetak Laporan Kegiatan</title>
</head> 
<body>    
<div class="page-wrapper">

    <div class="page-breadcrumb bg-white">
        <h2 style="text-align:center">LAPORAN KEGIATAN</h2>
        
        <table class="table table-borderless" style="text-align:justify">
            <tr>
                <th style="width:200px"> Nama Kegiatan</th>
                <td> {{$data->nama_kegiatan}}</td>
            </tr>
            <tr>
                <th> Tanggal, Waktu</th>
                <td>{{$data->tanggal}}, {{$data->waktu}}</td>
            </tr>
            <tr>
                <th> Tempat</th>
                <td>{{$data->tempat}}</td>
            </tr>
            <tr>
                <th> Deskripsi</th>
                <td>{!! $data->deskripsi !!}</td>
            </tr>         
            <th></th>
                <td>  
                    @if(!empty($data->image))
                        <div style="overflow:hidden; width:300px">
                        <img src="{{ public_path('images/'. $data->image) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block" style="width:100%, align-center">
                        </div>
                    @endif
                </td>
            </tr>
               
        </table>
        
    </div>
</div>
            
</body>
</html>
            
           
    