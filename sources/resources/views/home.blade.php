@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-12 mb-2 mt-1">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb p-0 mb-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <div class="row justify-content-center">
            <div class="col-sm-3 col-12 dashboard-users-primary">
                <div class="card text-center">
                    <div class="card-content">
                        <div class="card-body py-1">
                            <div class="badge-circle badge-circle-lg badge-circle-light-primary mx-auto mb-50">
                                <i class="bx bx-user font-medium-5"></i>
                            </div>
                            <div class="text-muted line-ellipsis">Total Petugas</div>
                            <h3 class="mb-0">{{ $total_user }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-12 dashboard-users-danger">
                <div class="card text-center">
                    <div class="card-content">
                        <div class="card-body py-1">
                            <div class="badge-circle badge-circle-lg badge-circle-light-danger mx-auto mb-50">
                                <i class="bx bx-task font-medium-5"></i>
                            </div>
                            <div class="text-muted line-ellipsis">Total Laporan</div>
                            <h3 class="mb-0">{{ $total_laporan }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-12 dashboard-users-warning">
                <div class="card text-center">
                    <div class="card-content">
                        <div class="card-body py-1">
                            <div class="badge-circle badge-circle-lg badge-circle-light-warning mx-auto mb-50">
                                <i class="bx bx-handicap font-medium-5"></i>
                            </div>
                            <div class="text-muted line-ellipsis">Lap. Pasien</div>
                            <h3 class="mb-0">{{ $total_laporan_pasien }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-12 dashboard-users-info">
                <div class="card text-center">
                    <div class="card-content">
                        <div class="card-body py-1">
                            <div class="badge-circle badge-circle-lg badge-circle-light-info mx-auto mb-50">
                                <i class="bx bx-error font-medium-5"></i>
                            </div>
                            <div class="text-muted line-ellipsis">Lap. Pelanggaran Prokes</div>
                            <h3 class="mb-0">{{ $total_laporan_prokes }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Statistics Line Chart Starts -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Grafik Laporan Tahun {{ date("Y") }}</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div id="statistics-line-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Statistics Line Chart End -->
            <!-- Statistics Donut Chart Starts -->
            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center border-bottom">
                        <h4 class="card-title">Statistik</h4>
                        <i class="bx bx-dots-vertical-rounded font-medium-3 cursor-pointer"></i>
                    </div>
                    <div class="card-content">
                        @php
                        $total = array_sum(array_column($statistik_status_laporan,'jumlah'));
                        @endphp
                        <div class="card-body">
                            <div class="pb-1 pt-3" id="donut-chart-statistics"></div>
                            <div class="chart-info d-flex justify-content-between mb-1">
                                <div class="d-flex align-items-center">
                                    <i class="bullet bullet-xs bullet-primary mr-50"></i>
                                    <span class="text-muted text-bold-600 ml-50">{{ ucwords($statistik_status_laporan[0]['status']) }}</span>
                                </div>
                                <div class="text-muted">{{ round(($statistik_status_laporan[0]['jumlah']/$total)*100) }}%</div>
                            </div>
                            <div class="chart-info d-flex justify-content-between mb-1">
                                <div class="d-flex align-items-center">
                                    <i class="bullet bullet-xs bullet-warning mr-50"></i>
                                    <span class="text-muted text-bold-600 ml-50">{{ ucwords($statistik_status_laporan[1]['status']) }}</span>
                                </div>
                                <div class="text-muted">{{ round(($statistik_status_laporan[1]['jumlah']/$total)*100) }}%</div>
                            </div>
                            <div class="chart-info d-flex justify-content-between mb-1">
                                <div class="d-flex align-items-center">
                                    <i class="bullet bullet-xs bullet-danger mr-50"></i>
                                    <span class="text-muted text-bold-600 ml-50">{{ ucwords($statistik_status_laporan[2]['status']) }}</span>
                                </div>
                                <div class="text-muted">{{ round(($statistik_status_laporan[2]['jumlah']/$total)*100) }}%</div>
                            </div>
                            <div class="chart-info d-flex justify-content-between">
                                <div class="d-flex align-items-center">
                                    <i class="bullet bullet-xs bullet-success mr-50"></i>
                                    <span class="text-muted text-bold-600 ml-50">{{ ucwords($statistik_status_laporan[3]['status']) }}</span>
                                </div>
                                <div class="text-muted">{{ round(($statistik_status_laporan[3]['jumlah']/$total)*100) }}%</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Statistics Donut Chart Ends -->
            
        </div>
    </div>
</div>

@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/charts/apexcharts.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/widgets.css') }}">
@endpush

@push('js')
<script type="text/javascript">
$(document).ready(function () {

  var $primary = '#5A8DEE';
  var $success = '#39DA8A';
  var $danger = '#FF5B5C';
  var $warning = '#FDAC41';
  var $info = '#00CFDD';
  var $label_color = '#304156';
  var $danger_light = '#FFDEDE';
  var $gray_light = '#828D99';
  var $bg_light = "#f2f4f4";

  // Donut Chart Statistics
  // -----------------------

  var donustChartStatistics = {
    chart: {
      width: 280,
      type: 'donut'
    },
    dataLabels: {
      enabled: false
    },
    series: {{ json_encode(array_column($statistik_status_laporan, 'jumlah')) }},
    labels: {!! json_encode(array_column($statistik_status_laporan, 'status')) !!},
    stroke: {
      width: 0
    },
    colors: [$primary, $warning, $danger, $success],
    plotOptions: {
      pie: {
        donut: {
          size: '95%',
          labels: {
            show: true,
            name: {
              show: true,
              fontSize: '22px',
              fontFamily: 'Rubik',
              color: $gray_light,
              offsetY: 20
            },
            value: {
              show: true,
              fontSize: '32px',
              fontFamily: 'Rubik',
              color: undefined,
              offsetY: -30,
              formatter: function (val) {
                return val
              }
            },
            total: {
              show: true,
              label: 'Status Laporan',
              color: $gray_light,
              formatter: function (w) {
                return w.globals.seriesTotals.reduce(function (a, b) {
                  return a + b
                }, 0)
              }
            }
          }
        }
      }
    },
    legend: {
      show: false
    }
  }

  var donustChartStatistics = new ApexCharts(
    document.querySelector("#donut-chart-statistics"),
    donustChartStatistics
  );
  donustChartStatistics.render();

  // Line Chart
  // ----------

  var lineChartoptions = {
    chart: {
      height: 400,
      type: 'line',
      zoom: {
        enabled: false
      },
      toolbar: {
        show: false
      },
    },
    dataLabels: {
      enabled: false
    },
    stroke: {
      curve: 'straight',
      width: 3,
    },
    legend: {
      horizontalAlign: 'right',
      position: 'top',
      markers: {
        radius: 50,
        height: 8,
        width: 8
      },
      itemMargin: {
        horizontal: 20,
      }
    },
    colors: [$primary, $success, $danger, $warning, $info],
    series: [
    @foreach($statistik_wilayah_laporan as $stat)
    {
      name: "{{ $stat['kabupaten'] }}",
      data: [
      {{ $stat['bulan_1']}},
      {{ $stat['bulan_2']}},
      {{ $stat['bulan_3']}},
      {{ $stat['bulan_4']}},
      {{ $stat['bulan_5']}},
      {{ $stat['bulan_6']}},
      {{ $stat['bulan_7']}},
      {{ $stat['bulan_8']}},
      {{ $stat['bulan_9']}},
      {{ $stat['bulan_10']}},
      {{ $stat['bulan_11']}},
      {{ $stat['bulan_12']}},
      ]
    },
    @endforeach
    ],
    tooltip: {
      x: {
        show: false,
      }
    },
    xaxis: {
      categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Des'],
      axisBorder: {
        show: false,
      },
      axisTicks: {
        show: false,
      },
      labels: {
        style: {
          colors: $gray_light
        }
      }
    },
    yaxis: {
      labels: {
        style: {
          color: $gray_light
        }
      }
    },
    legend: {
      show: false
    }
  }

  var lineChart = new ApexCharts(
    document.querySelector("#statistics-line-chart"),
    lineChartoptions
  );

  lineChart.render();
});
</script>
@endpush