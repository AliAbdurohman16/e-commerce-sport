<!doctype html>
<html lang="en" dir="ltr">

    <head>
        <meta charset="utf-8" />
        <title>Data Laporan - Rania Sport</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- favicon -->
        <link rel="shortcut icon" href="{{ asset('backend') }}/images/favicon.ico" />
        <!-- Bootstrap Css -->
        <link href="{{ asset('backend') }}/css/bootstrap.min.css" class="theme-opt" rel="stylesheet" type="text/css" />
        <!-- Fontawesome -->
        <link rel="stylesheet" href="{{ asset('backend') }}/libs/fontawesome/css/all.min.css"/>
        <!-- Style Css-->
        <link href="{{ asset('backend') }}/css/style.min.css" class="theme-opt" rel="stylesheet" type="text/css" />

    </head>

    <body>

        <h3 class="text-center mt-5">Laporan Transaksi Orderan</h3>
        <h5 class="text-center">Berdasarkan Tanggal {{ date('d-m-Y', strtotime($start_date)) }} - {{ date('d-m-Y', strtotime($end_date)) }}</h5>

        <div class="m-3 mt-4">
            <div class="table-responsive shadow rounded">
                <div class="card-body">
                    <table class="table table-center bg-white mb-0" id="table">
                        <thead>
                            <tr>
                                <th class="text-center border-bottom p-3" width="4px">No</th>
                                <th class="border-bottom p-3">Kode Order</th>
                                <th class="border-bottom p-3">Nama Pembeli</th>
                                <th class="border-bottom p-3">Tanggal</th>
                                <th class="border-bottom p-3">Metode</th>
                                <th class="border-bottom p-3">Bank</th>
                                <th class="border-bottom p-3">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Start -->
                            @foreach($transactions as $transaction)
                                <tr>
                                    <th class="text-center">{{ $loop->iteration }}</th>
                                    <td class="p-3">{{ $transaction->order_id }}</td>
                                    <td class="p-3">{{ $transaction->order->user->name }}</td>
                                    <td class="p-3">{{ date('d-m-Y', strtotime($start_date)) }}</td>
                                    <td class="p-3">Transfer Bank</td>
                                    <td class="p-3">{{ strtoupper($transaction->bank) }}</td>
                                    <td class="p-3">Rp {{ number_format($transaction->gross_amount, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                            <!-- End -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-4 text-end">
                <a href="javascript:window.print()" class="btn btn-icon btn-soft-primary d-print-none"><i class="fa-solid fa-print"></i></a>
            </div>
        </div>

        <!-- Javascript -->
        <script src="{{ asset('backend') }}/js/jquery.min.js"></script>
        <script src="{{ asset('backend') }}/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- Fontawesome -->
        <script src="{{ asset('backend') }}/libs/fontawesome/js/all.min.css"></script>
        <!-- Main Js -->
        <script src="{{ asset('backend') }}/js/app.js"></script>

    </body>

</html>
