<style>
    .card {
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    }
    table, td, th {
        border: 1px solid;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    }
</style>
<div class="card">
    <div class="card-body">
        <h4 align="center"><strong> Laporan Pengeluaran </strong></h4>
@foreach($data1 as $x)
        <p>ID Pengeluaran: {{$x->id}}</p>
        <table>
            <tr align="center">
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Total</th>
            </tr>
            @foreach($data as $y)
            <tr align="center">
                <td>{{$y->nama_barang}}</td>
                <td>{{$y->jmlh_barang}}</td>
                <td>Rp {{number_format ($y->satuan_harga) }}</td>
                <td>Rp {{number_format ($y->jmlh_barang*$y->satuan_harga)}}</td>
            </tr>
            @endforeach
        </table>
<br>
        <p>Subtotal : Rp {{number_format($x->total)}}</p>
        <p>Sumber Dana :  {{$x->sumber_dana}}</p>
        <p>Jenis Organisasi :  {{$auth_id}}</p>
        <p>Keterangan : {{$x->keterangan}}</p>
        

        </table>
        @endforeach
    </div>
</div>
