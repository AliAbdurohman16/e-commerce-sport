@extends('layouts.frontend.main')

@section('content')
<!-- Hero Start -->
<section class="bg-half-170 bg-light d-table w-100">
    <div class="container">
        <div class="row mt-5 justify-content-center">
            <div class="col-lg-12 text-center">
                <div class="pages-heading">
                    <h4 class="title mb-0"> Belum Bayar </h4>
                </div>
            </div><!--end col-->
        </div><!--end row-->

        <div class="position-breadcrumb">
            <nav aria-label="breadcrumb" class="d-inline-block">
                <ul class="breadcrumb rounded shadow mb-0 px-4 py-2">
                    <li class="breadcrumb-item"><a href="{{ route('/') }}">Beranda</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Belum Bayar</li>
                </ul>
            </nav>
        </div>
    </div> <!--end container-->
</section><!--end section-->
<div class="position-relative">
    <div class="shape overflow-hidden text-color-white">
        <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 48H1437.5H2880V0H2160C1442.5 52 720 0 720 0H0V48Z" fill="currentColor"></path>
        </svg>
    </div>
</div>
<!-- Hero End -->

<!-- Start -->
<section class="section">
    <div class="container">
        <div class="row align-items-end">

            <div class="col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                <div class="shadow rounded p-4">
                    <div class="table-responsive bg-white shadow rounded">
                        <table class="table mb-0 table-center table-nowrap">
                            <thead>
                                <tr>
                                    <th scope="col" class="border-bottom">Order no.</th>
                                    <th scope="col" class="border-bottom">Nama Produk</th>
                                    <th scope="col" class="border-bottom">Tanggal</th>
                                    <th scope="col" class="border-bottom">Status</th>
                                    <th scope="col" class="border-bottom">Total</th>
                                    <th scope="col" class="border-bottom">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $transaction)
                                <tr>
                                    <th scope="row">{{ $transaction->order_id }}</th>
                                    <td>
                                        @if ($transaction->order->orderDetails->count() > 0)
                                            @foreach ($transaction->order->orderDetails as $order)
                                                {{ $order->product->name }}
                                                @if ($order->size && $order->color != '')
                                                    ({{ $order->size }}, {{ $order->color }}, x{{ $order->quantity }})
                                                @elseif ($order->size != '')
                                                    ({{ $order->size }}, x{{ $order->quantity }})
                                                @elseif ($order->color != '')
                                                    ({{ $order->color }}, x{{ $order->quantity }})
                                                @endif
                                                <br>
                                            @endforeach
                                        @endif

                                    </td>
                                    <td>{{ date('d-m-Y', strtotime($transaction->created_at)) }}</td>
                                    <td class="text-muted">Belum Bayar</td>
                                    <td>Rp {{ number_format($transaction->gross_amount, 0, ',', '.') }}</td>
                                    <td><a href="javascript:void(0)" class="text-primary" data-bs-toggle="modal" data-bs-target="#pay{{ $transaction->id }}">Bayar <i class="uil uil-money-bill"></i></a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div><!--end teb pane-->
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
</section><!--end section-->
<!-- End -->
<!-- Modal Edit -->
@foreach ($transactions as $transaction)
<div class="modal fade" id="pay{{ $transaction->id }}" tabindex="-1" aria-labelledby="LoginForm-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded shadow border-0">
            <div class="modal-header border-bottom">
                <h5 class="modal-title" id="LoginForm-title">Data Pesanan</h5>
                <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal" id="close-modal"><i class="uil uil-times fs-4 text-dark"></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-primary">
                            Lakukan pembayar pesanan ke VA Number yang tertera!.
                        </div>

                        <div class="container">
                            <div class="row">
                                <div class="col-4">
                                    <label for="">Produk</label>
                                </div>
                                <div class="col-1">:</div>
                                <div class="col-7">
                                    @if ($transaction->order->orderDetails->count() > 0)
                                        @foreach ($transaction->order->orderDetails as $order)
                                            {{ $order->product->name }}
                                            @if ($order->size && $order->color != '')
                                                ({{ $order->size }}, {{ $order->color }}, x{{ $order->quantity }})
                                            @elseif ($order->size != '')
                                                ({{ $order->size }}, x{{ $order->quantity }})
                                            @elseif ($order->color != '')
                                                ({{ $order->color }}, x{{ $order->quantity }})
                                            @endif
                                            <br>
                                        @endforeach
                                    @endif
                                </div>

                                <div class="col-4">
                                    <label for="">Tanggal Pesan</label>
                                </div>
                                <div class="col-1">:</div>
                                <div class="col-7">
                                    {{ date('H:i, d-m-Y', strtotime($transaction->created_at)) }}
                                </div>

                                <div class="col-4">
                                    <label for="">Waktu Kadaluarsa</label>
                                </div>
                                <div class="col-1">:</div>
                                <div class="col-7">
                                    {{ date('H:i, d-m-Y', strtotime($transaction->expired)) }}
                                </div>

                                <div class="col-4">
                                    <label for="">Metode Pembayaran</label>
                                </div>
                                <div class="col-1">:</div>
                                <div class="col-7">
                                    Transfer Bank
                                </div>

                                <div class="col-4">
                                    <label for="">Nama Bank</label>
                                </div>
                                <div class="col-1">:</div>
                                <div class="col-7">
                                    {{ strtoupper($transaction->bank) }}
                                </div>

                                <div class="col-4">
                                    <label for="">VA Number</label>
                                </div>
                                <div class="col-1">:</div>
                                <div class="col-7">
                                    {{ $transaction->va_number }}
                                </div>

                                <div class="col-4">
                                    <label for="">Total</label>
                                </div>
                                <div class="col-1">:</div>
                                <div class="col-7">
                                    Rp {{ number_format($transaction->gross_amount, 0, ',', '.') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- Modal Edit End -->
@endsection
