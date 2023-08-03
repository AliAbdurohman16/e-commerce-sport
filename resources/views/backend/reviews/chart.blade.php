@extends('layouts.backend.main')

@section('title', 'Chart Review')

@section('content')
<div class="container-fluid">
    <div class="layout-specing">
        <div class="d-md-flex justify-content-between align-items-center">
            <h5 class="mb-0">Chart Review</h5>

            <nav aria-label="breadcrumb" class="d-inline-block">
                <ul class="breadcrumb bg-transparent rounded mb-0 p-0">
                    <li class="breadcrumb-item text-capitalize"><a href="#">Chart Review</a></li>
                    <li class="breadcrumb-item text-capitalize active" aria-current="page">list</li>
                </ul>
            </nav>
        </div>

        <div class="row">
            <div class="col-6 mt-4">
                <div class="card shadow border-0 p-4 pb-0 rounded">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-0 fw-bold">Grafik Review Bintang 5</h6>
                    </div>
                    <div id="ratingFive" class="apex-chart"></div>
                </div>
            </div>
            <!--end col-->
            <div class="col-6 mt-4">
                <div class="card shadow border-0 p-4 pb-0 rounded">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-0 fw-bold">Grafik Review Bintang 4</h6>
                    </div>
                    <div id="ratingFour" class="apex-chart"></div>
                </div>
            </div>
            <!--end col-->
            <div class="col-6 mt-4">
                <div class="card shadow border-0 p-4 pb-0 rounded">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-0 fw-bold">Grafik Review Bintang 3</h6>
                    </div>
                    <div id="ratingThree" class="apex-chart"></div>
                </div>
            </div>
            <!--end col-->
            <div class="col-6 mt-4">
                <div class="card shadow border-0 p-4 pb-0 rounded">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-0 fw-bold">Grafik Review Bintang 2</h6>
                    </div>
                    <div id="ratingTwo" class="apex-chart"></div>
                </div>
            </div>
            <!--end col-->
            <div class="col-6 mt-4">
                <div class="card shadow border-0 p-4 pb-0 rounded">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-0 fw-bold">Grafik Review Bintang 1</h6>
                    </div>
                    <div id="ratingOne" class="apex-chart"></div>
                </div>
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>
</div><!--end container-->
@endsection

@section('javascript')
<script src="{{ asset('backend') }}/libs/apexcharts/apexcharts.min.js"></script>
<script>
    $(document).ready(function() {
        // Chart for rating five
        var options = {
            series: [{
                data: {!! $ratingFiveData !!},
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
                categories: {!! $ratingFiveLabels !!},
            },
        };

        var chart = new ApexCharts(document.querySelector("#ratingFive"), options);
        chart.render();

        // Chart for rating four
        var options = {
            series: [{
                data: {!! $ratingFourData !!},
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
                categories: {!! $ratingFourLabels !!},
            },
        };

        var chart = new ApexCharts(document.querySelector("#ratingFour"), options);
        chart.render();

        // Chart for rating three
        var options = {
            series: [{
                data: {!! $ratingThreeData !!},
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
                categories: {!! $ratingThreeLabels !!},
            },
        };

        var chart = new ApexCharts(document.querySelector("#ratingThree"), options);
        chart.render();

        // Chart for rating two
        var options = {
            series: [{
                data: {!! $ratingTwoData !!},
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
                categories: {!! $ratingTwoLabels !!},
            },
        };

        var chart = new ApexCharts(document.querySelector("#ratingTwo"), options);
        chart.render();

        // Chart for rating one
        var options = {
            series: [{
                data: {!! $ratingOneData !!},
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
                categories: {!! $ratingOneLabels !!},
            },
        };

        var chart = new ApexCharts(document.querySelector("#ratingOne"), options);
        chart.render();
    });
</script>
@endsection
