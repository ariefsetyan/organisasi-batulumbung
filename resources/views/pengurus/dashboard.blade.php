@extends ('layouts.main-pengurus')

@section('title', 'Dashboard')

@push('script1')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
@endpush

@push('style')
    <style>
        .highcharts-figure,
        .highcharts-data-table table {
            min-width: 310px;
            max-width: 800px;
            margin: 1em auto;
        }

        #container {
            height: 400px;
        }

        .highcharts-data-table table {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #ebebeb;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
        }

        .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
        }

        .highcharts-data-table td,
        .highcharts-data-table th,
        .highcharts-data-table caption {
            padding: 0.5em;
        }

        .highcharts-data-table thead tr,
        .highcharts-data-table tr:nth-child(even) {
            background: #f8f8f8;
        }

        .highcharts-data-table tr:hover {
            background: #f1f7ff;
        }
    </style>
@endpush

@section('content')
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Dashboard</h4>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Three charts -->
                <!-- ============================================================== -->
                <div class="row justify-content-center">
                    <div class="col-lg-3 col-md-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">JUMLAH ANGGOTA</h3>
                            <ul class="list-inline two-part d-flex align-items-center mb-0">
                                <li>
                                    <span class="counter text-primary"><i class="bi bi-people-fill"></i> {{ $hitunganggota }}</span>
                                </li>
                                <li class="ms-auto">
                                    <button class="btn btn-primary"> <a href="/anggota/anggota" style="color:white"> Detail </a></button>
                                <li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">JUMLAH EVENT</h3>
                            <ul class="list-inline two-part d-flex align-items-center mb-0">
                                <li>
                                    <span class="counter text-success"><i class="bi bi-calendar2-week-fill"></i> {{ $hitungevent}}</span>
                                </li>
                                <li class="ms-auto">
                                    <button class="btn btn-success"> <a href="/event/event" style="color:white"> Detail </a></button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">JUMLAH KEGIATAN</h3>
                            <ul class="list-inline two-part d-flex align-items-center mb-0">
                                <li>
                                    <span class="counter text-warning"><i class="bi bi-calendar2-check-fill"></i> {{ $hitungkegiatan }}</span>
                                </li>
                                <li class="ms-auto">
                                    <button class="btn btn-warning"><a href="/kegiatan/kegiatan" style="color:white"> Detail </a></button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">JUMLAH PENGUMUMAN</h3>
                            <ul class="list-inline two-part d-flex align-items-center mb-0">
                                <li>
                                    <span class="counter text-danger"> <i class="bi bi-megaphone-fill"></i> {{ $hitungpengumuman }}</span>
                                </li>
                                <li class="ms-auto">
                                    <button class="btn btn-danger"><a href="/pengumuman/pengumuman" style="color:white"> Detail </a></button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- ============================================================== -->
                <!-- GRAFIK-->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                        <div class="white-box">
{{--                            <h3 class="box-title">Grafik Absensi Kegiatan</h3>--}}
{{--                            <div class="d-md-flex">--}}
{{--                                <ul class="list-inline d-flex ms-auto">--}}
{{--                                    <li class="ps-3">--}}
{{--                                        <h5><i class="fa fa-circle me-1 text-info"></i>Sekaa Teruna</h5>--}}
{{--                                    </li>--}}
{{--                                    <li class="ps-3">--}}
{{--                                        <h5><i class="fa fa-circle me-1 text-inverse"></i>Seka Gong</h5>--}}
{{--                                    </li>--}}
{{--                                    <li class="ps-3">--}}
{{--                                        <h5><i class="fa fa-circle me-1 text-success"></i>Seka Santi</h5>--}}
{{--                                    </li>--}}
{{--                                    <li class="ps-3">--}}
{{--                                        <h5><i class="fa fa-circle me-1 text-danger"></i>PKK</h5>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
                            <figure class="highcharts-figure">
                                <div id="container"></div>

                            </figure>
{{--                            <div id="ct-visits" style="height: 405px;">--}}
{{--                                <div class="chartist-tooltip" style="top: -17px; left: -12px;"><span--}}
{{--                                        class="chartist-tooltip-value">6</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </div>

                <!-- ============================================================== -->
                <!-- KEGIATAN TERBRU -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="white-box">
                            <div class="d-md-flex mb-3">
                                <h3 class="box-title mb-0">Kegiatan Terbaru</h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-info table-striped">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">NO</th>
                                            <th class="border-top-0">NAMA KEGIATAN</th>
                                            <th class="border-top-0">TANGGAL</th>
                                            <th class="border-top-0">JENIS ORGANISASI</th>
                                            <th class="border-top-0">DETAIL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($kegiatan as $kegiatans)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration}}</th>
                                            <td>{{$kegiatans->nama_kegiatan}}</td>
                                            <td>{{$kegiatans->tanggal}}</td>
                                            <td>{{$kegiatans->organisasi->jenis}}</td>
                                            <td><a href="\kegiatan\kegiatan\{{ $kegiatans->id }}" class="btn btn-primary"><i class="bi bi-eye-fill m-r-5"></i>Detail</a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ============================================================== -->
                <!-- Pengumuman Terbaru -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- .col -->
                    <div class="col-md-12 col-lg-8 col-sm-12">
                        <div class="card white-box p-0">
                            <div class="card-heading">
                                <h3 class="box-title mb-0">Pengumuman Terbaru</h3>
                            </div>
                            <div class="card-body">
                                @foreach ($pengumuman as $pengumuman)
                                <div class="card-body bg-primary mb-2">
                                    <h4 class="card-title" style="font-weight:800">{{$pengumuman->judul}}</h4>
                                    <ul class="list-inline two-part d-flex align-items-center mb-0">
                                        <li>
                                            <span class="card-text ms-auto">{{$pengumuman->isi}}</span>
                                        </li>
                                        <li class="ms-auto">
                                            <a href="{{route('file.download', $pengumuman->id)}}" class="btn btn-danger text-light"><i class="bi bi-download"></i> Download</a>
                                        </li>
                                    </ul>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="card white-box p-0">
                            <div class="card-heading">
                                <h3 class="box-title mb-0">Event</h3>
                            </div>
                            <div class="card-body">
                                @foreach ($event as $events)
                                    <div class="card-body bg-success mb-2">
                                        <h4 class="card-title text-dark" style="font-weight:800" >{{$events->nama_event}}</h4>
                                        <ul class="list-inline two-part d-flex align-items-center mb-0">
                                            <li>
                                                <span  class="card-text text-dark">Tanggal : {{$events->tanggal}}</span>
                                            </li>
                                            <li class="ms-auto">
                                                <a href="\event\event\{{ $events->id }}" class="btn btn-danger text-light"><i class="bi bi-eye-fill m-r-5"></i>Detail</a>
                                            </li>
                                        </ul>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
            </div>

            </div>

@endsection

@push('script')
    <script>
        // Create the chart
        Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                align: 'left',
                text: 'Grafik Absensi Kegiatan'
            },
            subtitle: {
                align: 'left',
                // text: 'Click the columns to view versions. Source: <a href="http://statcounter.com" target="_blank">statcounter.com</a>'
            },
            accessibility: {
                announceNewData: {
                    enabled: true
                }
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'Total'
                }

            },
            legend: {
                enabled: false
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        format: '{point.y:.1f}'
                    }
                }
            },

            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b> of total<br/>'
            },

            series: [
                {
                    name: "Absensi",
                    colorByPoint: true,
                    data: [@foreach($grafik1 as $row)
                            {
                                name: "{{$row->nama_kegiatan}}",
                                y: {{$row->jumlah}},
                                drilldown: "{{$row->nama_kegiatan}}"
                            },

                        @endforeach]
                    //     [
                    //     {
                    //         name: "Chrome",
                    //         y: 62.74,
                    //         drilldown: "Chrome"
                    //     },
                    //     {
                    //         name: "Firefox",
                    //         y: 10.57,
                    //         drilldown: "Firefox"
                    //     },
                    //
                    // ]
                }
            ],
            drilldown: {
                breadcrumbs: {
                    position: {
                        align: 'right'
                    }
                },
                series: [
                        @foreach($grafik1 as $x)
                    {
                        name: "{{$x->nama_kegiatan}}",
                        id: "{{$x->nama_kegiatan}}",
                        data: [
                                @foreach($grafik as $row)
                            [
                                "{{$row->jenis}}",
                                {{$row->jumlah}}
                            ],
                            @endforeach
                        ]
                    },
                    @endforeach
                    /*{
                        name: "Chrome",
                        id: "Chrome",
                        data: [
                            [
                                "v65.0",
                                0.1
                            ],
                            [
                                "v64.0",
                                1.3
                            ],
                            [
                                "v63.0",
                                53.02
                            ],
                            [
                                "v62.0",
                                1.4
                            ],
                            [
                                "v61.0",
                                0.88
                            ],
                            [
                                "v60.0",
                                0.56
                            ],
                            [
                                "v59.0",
                                0.45
                            ],
                            [
                                "v58.0",
                                0.49
                            ],
                            [
                                "v57.0",
                                0.32
                            ],
                            [
                                "v56.0",
                                0.29
                            ],
                            [
                                "v55.0",
                                0.79
                            ],
                            [
                                "v54.0",
                                0.18
                            ],
                            [
                                "v51.0",
                                0.13
                            ],
                            [
                                "v49.0",
                                2.16
                            ],
                            [
                                "v48.0",
                                0.13
                            ],
                            [
                                "v47.0",
                                0.11
                            ],
                            [
                                "v43.0",
                                0.17
                            ],
                            [
                                "v29.0",
                                0.26
                            ]
                        ]
                    },*/
                    {
                        name: "Firefox",
                        id: "Firefox",
                        data: [
                            [
                                "v58.0",
                                1.02
                            ],
                            [
                                "v57.0",
                                7.36
                            ],
                            [
                                "v56.0",
                                0.35
                            ],
                            [
                                "v55.0",
                                0.11
                            ],
                            [
                                "v54.0",
                                0.1
                            ],
                            [
                                "v52.0",
                                0.95
                            ],
                            [
                                "v51.0",
                                0.15
                            ],
                            [
                                "v50.0",
                                0.1
                            ],
                            [
                                "v48.0",
                                0.31
                            ],
                            [
                                "v47.0",
                                0.12
                            ]
                        ]
                    },

                ]
            }
        });
    </script>
@endpush
