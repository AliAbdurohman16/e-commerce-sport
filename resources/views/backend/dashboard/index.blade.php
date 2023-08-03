@extends('layouts.backend.main')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <div class="layout-specing">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h6 class="text-muted mb-1">Welcome back, {{ Auth::user()->name }}!</h6>
                <h5 class="mb-0">Dashboard</h5>
            </div>
        </div>

        <div class="row row-cols-xl-4 row-cols-md-2 row-cols-1">
            <div class="col mt-4">
                <a href="#!" class="features feature-primary d-flex justify-content-between align-items-center rounded shadow p-3">
                    <div class="d-flex align-items-center">
                        <div class="icon text-center rounded-pill">
                            <i class="uil uil-usd-circle fs-4 mb-0"></i>
                        </div>
                        <div class="flex-1 ms-3">
                            <h6 class="mb-0 text-muted">Pendapatan</h6>
                            <p class="fs-5 text-dark fw-bold mb-0">Rp {{ number_format($income, 0, ',', '.') }}</span></p>
                        </div>
                    </div>
                </a>
            </div><!--end col-->

            <div class="col mt-4">
                <a href="#!" class="features feature-primary d-flex justify-content-between align-items-center rounded shadow p-3">
                    <div class="d-flex align-items-center">
                        <div class="icon text-center rounded-pill">
                            <i class="uil uil-shopping-bag fs-4 mb-0"></i>
                        </div>
                        <div class="flex-1 ms-3">
                            <h6 class="mb-0 text-muted">Produk</h6>
                            <p class="fs-5 text-dark fw-bold mb-0"><span class="counter-value" data-target="{{ $productCount }}"></span></p>
                        </div>
                    </div>
                </a>
            </div><!--end col-->

            <div class="col mt-4">
                <a href="#!" class="features feature-primary d-flex justify-content-between align-items-center rounded shadow p-3">
                    <div class="d-flex align-items-center">
                        <div class="icon text-center rounded-pill">
                            <i class="uil uil-invoice fs-4 mb-0"></i>
                        </div>
                        <div class="flex-1 ms-3">
                            <h6 class="mb-0 text-muted">Orderan</h6>
                            <p class="fs-5 text-dark fw-bold mb-0"><span class="counter-value" data-target="{{ $orderCount }}"></span></p>
                        </div>
                    </div>
                </a>
            </div><!--end col-->

            <div class="col mt-4">
                <a href="#!" class="features feature-primary d-flex justify-content-between align-items-center rounded shadow p-3">
                    <div class="d-flex align-items-center">
                        <div class="icon text-center rounded-pill">
                            <i class="uil uil-users-alt fs-4 mb-0"></i>
                        </div>
                        <div class="flex-1 ms-3">
                            <h6 class="mb-0 text-muted">Pelanggan</h6>
                            <p class="fs-5 text-dark fw-bold mb-0"><span class="counter-value" data-target="{{ $customerCount }}"></span></p>
                        </div>
                    </div>
                </a>
            </div><!--end col-->

            <div class="col mt-4">
                <a href="#!" class="features feature-primary d-flex justify-content-between align-items-center rounded shadow p-3">
                    <div class="d-flex align-items-center">
                        <div class="icon text-center rounded-pill">
                            <i class="uil uil-usd-circle fs-4 mb-0"></i>
                        </div>
                        <div class="flex-1 ms-3">
                            <h6 class="mb-0 text-muted">Pendapatan Pertahun</h6>
                            <p class="fs-5 text-dark fw-bold mb-0">Rp {{ number_format($incomeByYear, 0, ',', '.') }}</span></p>
                        </div>
                    </div>
                </a>
            </div><!--end col-->

            <div class="col mt-4">
                <a href="#!" class="features feature-primary d-flex justify-content-between align-items-center rounded shadow p-3">
                    <div class="d-flex align-items-center">
                        <div class="icon text-center rounded-pill">
                            <i class="uil uil-usd-circle fs-4 mb-0"></i>
                        </div>
                        <div class="flex-1 ms-3">
                            <h6 class="mb-0 text-muted">Pendapatan Perbulan</h6>
                            <p class="fs-5 text-dark fw-bold mb-0">Rp {{ number_format($incomeByMonth, 0, ',', '.') }}</span></p>
                        </div>
                    </div>
                </a>
            </div><!--end col-->

            <div class="col mt-4">
                <a href="#!" class="features feature-primary d-flex justify-content-between align-items-center rounded shadow p-3">
                    <div class="d-flex align-items-center">
                        <div class="icon text-center rounded-pill">
                            <i class="uil uil-usd-circle fs-4 mb-0"></i>
                        </div>
                        <div class="flex-1 ms-3">
                            <h6 class="mb-0 text-muted">Pendapatan Perminggu</h6>
                            <p class="fs-5 text-dark fw-bold mb-0">Rp {{ number_format($incomeByWeek, 0, ',', '.') }}</span></p>
                        </div>
                    </div>
                </a>
            </div><!--end col-->

            <div class="col mt-4">
                <a href="#!" class="features feature-primary d-flex justify-content-between align-items-center rounded shadow p-3">
                    <div class="d-flex align-items-center">
                        <div class="icon text-center rounded-pill">
                            <i class="uil uil-usd-circle fs-4 mb-0"></i>
                        </div>
                        <div class="flex-1 ms-3">
                            <h6 class="mb-0 text-muted">Pendapatan Perhari</h6>
                            <p class="fs-5 text-dark fw-bold mb-0">Rp {{ number_format($incomeByDay, 0, ',', '.') }}</span></p>
                        </div>
                    </div>
                </a>
            </div><!--end col-->
        </div><!--end row-->

        <div class="row">
            <div class="col-xl-12 col-lg-7 mt-4">
                <div class="card shadow border-0 p-4 pb-0 rounded">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-0 fw-bold">Grafik Bar Pendapatan</h6>

                        <div class="mb-0 position-relative">
                            <select class="form-select form-control" id="yearchart">
                                @foreach(range(date('Y'), $lastYear) as $year)
                                    <option value="{{ $year }}" {{ $year == date('Y') ? 'selected' : '' }}>{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div id="revenue" class="apex-chart"></div>
                </div>
            </div><!--end col-->

            <div class="col-xl-6 col-lg-5 mt-4">
                <div class="card rounded shadow border-0 p-4">
                    <div class="d-flex justify-content-between mb-4">
                        <h6 class="mb-0">Top Produk Terlaris</h6>
                    </div>
                    <div id="top-product"></div>
                </div>
            </div><!--end col-->

            <div class="col-xl-6 col-lg-5 mt-4">
                <div class="card rounded shadow border-0 p-4">
                    <div class="d-flex justify-content-between mb-4">
                        <h6 class="mb-0">Produk Kurang Laris</h6>
                    </div>
                    <div id="lowest-product"></div>
                </div>
            </div><!--end col-->

            <div class="col-xl-12 col-lg-7 mt-4">
                <div class="card shadow border-0 p-4 pb-0 rounded">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-0 fw-bold">Grafik Penjualan Diskon Produk Kurang Laris</h6>
                    </div>
                    <div id="discount" class="apex-chart"></div>
                </div>
            </div><!--end col-->
        </div><!--end row-->
    </div>
</div>
@endsection

@section('javascript')
<script src="{{ asset('backend') }}/libs/apexcharts/apexcharts.min.js"></script>
<script>
    $(document).ready(function() {
        // Ambil data penghasilan berdasarkan bulan dari model Transaction
        $.ajax({
            url: '/get-revenue-by-month/' + $('#yearchart').val(),
            type: 'GET',
            success: function(response) {
                // Data format for ApexCharts charts
                var chartData = {
                    series: [{
                        name: 'Penghasilan',
                        data: response.revenue
                    }],
                    chart: {
                        height: 350,
                        type: 'bar'
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: '55%',
                            endingShape: 'rounded'
                        },
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        show: true,
                        width: 2,
                        colors: ['transparent']
                    },
                    xaxis: {
                        categories: response.labels,
                        labels: {
                            position: 'bottom'
                        }
                    },
                    yaxis: {
                        title: {
                            text: 'Penghasilan (IDR)',
                            offsetX: -10
                        },
                        labels: {
                            formatter: function(val) {
                                return "IDR " + val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            },
                            offsetX: -10,
                            position: 'left'
                        }
                    },
                    fill: {
                        opacity: 1
                    },
                    tooltip: {
                        y: {
                            formatter: function(val) {
                                return "IDR " + val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            }
                        }
                    }
                };

                // Display the ApexCharts chart on a web page
                var chart = new ApexCharts(document.querySelector("#revenue"), chartData);
                chart.render();

                // Update the ApexCharts chart when the year is changed
                $('#yearchart').on('change', function() {
                    $.ajax({
                        url: '/get-revenue-by-month/' + $('#yearchart').val(),
                        type: 'GET',
                        success: function(response) {
                            chart.updateSeries([{
                                name: 'Penghasilan',
                                data: response.revenue
                            }]);
                            chart.updateOptions({
                                xaxis: {
                                    categories: response.labels
                                }
                            });
                        }
                    });
                });
            }
        });

        // Chart for top products
        var data = {!! $topProductsData !!};
        data = data.map(function(x) {
            return parseInt(x, 10);
        });

        var options = {
            chart: {
                width: 380,
                type: 'pie',
            },
            labels: {!! $topProductsLabels !!},
            series: data,
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        }

        var chart = new ApexCharts(document.querySelector("#top-product"), options);
        chart.render();

        // Chart for lowest products
        var data = {!! $lowestProductsData !!};
        data = data.map(function(x) {
            return parseInt(x, 10);
        });

        var options = {
            chart: {
                width: 380,
                type: 'pie',
            },
            labels: {!! $lowestProductsLabels !!},
            series: data,
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        }

        var chart = new ApexCharts(document.querySelector("#lowest-product"), options);
        chart.render();

        // Chart for sale discount product lowest
        var options = {
            series: [{
                name: 'Total',
                data: {!! $saleDiscountLowestProductsData !!},
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
            bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
            },
                dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: {!! $saleDiscountLowestProductsLabels !!},
            },
            yaxis: {
                title: {
                    text: 'Jumlah yang dibeli'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return  val + " Jumlah yang dibeli"
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#discount"), options);
        chart.render();
    });


</script>

@endsection
