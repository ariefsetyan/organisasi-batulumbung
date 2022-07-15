<div class="table-responsive mt-3">
    <table class="table text-nowrap">
        <thead>
            <tr>
                <th class="border-top-0">NO</th>
                <th class="border-top-0">ID ANGGOTA</th>
                <th class="border-top-0">NAMA ANGGOTA</th>
                <th class="border-top-0">NAMA KEGIATAN</th>
                <th class="border-top-0">TANGGAL KEGIATAN</th>
                <th class="border-top-0">JENIS ORGANISASI</th>
                <th class="border-top-0">STATUS</th>
                <th class="border-top-0">AKSI</th>
            </tr>
        </thead>
        
        <tbody>
        <!-- melakukan looping data -->
        @php
            $no = 0;
        @endphp

        @forelse ($absensi as $absen)
            <tr>
                <th scope="row">{{ ++$no }}</th>
                <td>{{$absen->anggota_id}}</td>
                <td>{{$absen->nama}}</td>
                <td>{{$absen->nama_kegiatan}}</td>
                <td>{{ \Carbon\Carbon::parse($absen->tanggal)->format('d/m/Y')}}</td> 
                <!-- carbon format (y-m-d) -->
                <td>{{$absen->jenis}}</td>
                <td>{{$absen->status}}</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>