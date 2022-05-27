<style>
    table, td, th {
        border: 1px solid;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }
</style>
<div class="card">
    <div class="card-body">
@foreach($data1 as $x)
        <p>ID : {{$x->id}}</p>
        <table>
            <tr>
                <td>nama barang</td>
                <td>jumlah</td>
                <td>harga satuan</td>
                <td>total</td>
            </tr>
            @foreach($data as $y)
            <tr>
                <td>{{$y->nama_barang}}</td>
                <td>{{$y->jmlh_barang}}</td>
                <td>{{$y->satuan_harga}}</td>
                <td>{{$y->jmlh_barang*$y->satuan_harga}}</td>
            </tr>
            @endforeach
        </table>
<br>
        <p>subtotal : {{$x->total}}</p>
        <p>sumber dana :  {{$x->sumber_dana}}</p>
        <p>organisasi :  {{$x->jenis}}</p>
        <p>keterangan : {{$x->keterangan}}</p>
        <p>petugas :  1</p>

        </table>
        @endforeach
    </div>
</div>
