@extends('layouts.frontend.main')

@section('content')
<section class="bg-half-170 bg-light d-table w-100">
    <div class="container">
        <div class="row mt-5 justify-content-center">
            <div class="col-lg-12 text-center">
                <div class="pages-heading">
                    <h4 class="title mb-0"> Pembayaran </h4>
                </div>
            </div><!--end col-->
        </div><!--end row-->

        <div class="position-breadcrumb">
            <nav aria-label="breadcrumb" class="d-inline-block">
                <ul class="breadcrumb rounded shadow mb-0 px-4 py-2">
                    <li class="breadcrumb-item"><a href="{{ route('/') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('carts.index') }}">Keranjang</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('checkout.index') }}">Checkout</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pembayaran</li>
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

<!-- Start -->
<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-6 pt-2 pt-sm-0 order-2 order-md-1">
                <div class="card shadow rounded border-0">
                    <div class="card-body">
                        <div class="custom-form">
                            <form action="{{ route('pay', $transaction->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="mb-3">1. Selesaikan Pembayaran Sebelum</h5>
                                        <div class="container">
                                            <h6>Hari ini, <span id="jam-sekarang"></span></h6>
                                            <p>Selesaikan pembayaran dalam <span id="countdown"></span></p>
                                        </div>
                                        <h5 class="mb-3 mt-3">2. Mohon Transfer Ke</h5>
                                        <div class="container">
                                            <div class="row">
                                                <div class="h5 col-12 mb-3">
                                                    <span class="fw-bold">{{ $setting->name_bank }}</span>
                                                </div>
                                                <div class="col-6 mb-2">
                                                    <span>Nomor Rekening</span>
                                                </div>
                                                <div class="col-6 mb-2">
                                                    <span class="fw-bold">{{ $setting->no_rek }}</span>
                                                </div>
                                                <div class="col-6 mb-2">
                                                    <span>Nama Penerima</span>
                                                </div>
                                                <div class="col-6 mb-2">
                                                    <span class="fw-bold">Rania Sport</span>
                                                </div>
                                            </div>
                                            <div class="row mb-3 mt-4 pt-4 border-top">
                                                <div class="col-6">
                                                    <span>Jumlah Transfer</span>
                                                </div>
                                                <div class="col-6">
                                                    <span class="fw-bold">Rp {{ number_format($transaction->gross_amount, 0, ',', '.') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <h5 class="mb-3 mt-3">3. Anda Sudah Membayar?</h5>
                                        <div class="container">
                                            <p>Setelah pembayaran Anda konfirmasi dengan mengirimkan bukti pembayaran, kami akan validasi pembayaran anda.</p>
                                            <label class="form-label">Upload Bukti Pembayaran <span class="text-danger">*</span></label>
                                            <input name="receipt" id="receipt" type="file" class="form-control @error('receipt') is-invalid @enderror">
                                            <small class="text-muted">Ukuran file tidak boleh lebih dari 2MB.</small>
                                            @error('receipt')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div><!--end col-->
                                </div>
                                <div class="row mb-3 mt-4 pt-4 border-top">
                                    <div class="col-12 ">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary">Konfirmasi</button>
                                        </div>
                                    </div><!--end col-->
                                </div><!--end row-->
                            </form>
                            <div class="row">
                                <div class="col-12 ">
                                    <form action="{{ route('pay-cancel', $transaction->id) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-danger">Batalkan</button>
                                        </div>
                                    </form>
                                </div><!--end col-->
                            </div><!--end row-->
                        </div><!--end custom-form-->
                    </div>
                </div>
            </div><!--end col-->
            <div class="col-lg-4 col-md-6 pt-2 pt-sm-0 order-2 order-md-1">
                <div class="card rounded shadow p-4 border-0">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="h5 mb-0">Pesanan</span>
                        <span class="badge bg-primary rounded-pill">{{ $order_details->count() }}</span>
                    </div>
                    <ul class="list-group mb-3 border">
                        @foreach ($order_details as $order_detail)
                            <li class="d-flex justify-content-between lh-sm p-3 border-bottom">
                                <div>
                                    <h6 class="my-0">{{ $order_detail->product->name }}</h6>
                                    <small class="text-muted">
                                        @if ($order_detail->size && $order_detail->color != '')
                                            {{ $order_detail->size }}, {{ $order_detail->color }}, {{ $order_detail->quantity }}x
                                        @elseif ($order_detail->size != '')
                                            {{ $order_detail->size }}, {{ $order_detail->quantity }}x
                                        @elseif ( $order_detail->color != '')
                                            {{ $order_detail->color }}, {{ $order_detail->quantity }}x
                                        @endif
                                    </small>
                                </div>
                                <span class="text-muted">Rp {{ number_format($order_detail->total, 0, ',', '.') }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <ul class="list-group mb-3 border">
                        <li class="d-flex justify-content-between lh-sm p-3 border-bottom">
                            <div><h6 class="my-0">Subtotal</h6></div>
                            <span class="text-muted">Rp {{ number_format($order_detail->order->subtotal, 0, ',', '.') }}</span>
                        </li>
                        <li class="d-flex justify-content-between lh-sm p-3 border-bottom">

                            <div><h6 class="my-0">Ongkos Kirim</h6></div>
                            <span class="text-muted" id="shipping-cost">Rp {{ number_format($shipping->cost, 0, ',', '.') }}</span>
                        </li>
                        <li class="d-flex justify-content-between lh-sm p-3 border-bottom">
                            <div><h6 class="my-0">Total</h6></div>
                            <span class="text-muted">Rp {{ number_format($transaction->gross_amount, 0, ',', '.') }}</span>
                        </li>
                    </ul>
                </div>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
</section>
<!-- End -->
@endsection

@section('javascript')
<script>
    var serverTime = "{{ date('Y-m-d H:i:s') }}";

    var currentTime = new Date(serverTime).getTime();

    var intervalJam = setInterval(function() {
        currentTime += 1000;
        var jamSekarang = new Date(currentTime);
        document.getElementById("jam-sekarang").innerText = jamSekarang.toLocaleTimeString();
    }, 1000);

    var expiredTime = "{{ $transaction->expired }}";

    var expiredDateTime = new Date(expiredTime).getTime();

    var intervalCountdown = setInterval(function() {
        var now = new Date().getTime();
        var selisihWaktu = expiredDateTime - now;

        var jam = Math.floor(selisihWaktu / (1000 * 60 * 60));
        var menit = Math.floor((selisihWaktu % (1000 * 60 * 60)) / (1000 * 60));
        var detik = Math.floor((selisihWaktu % (1000 * 60)) / 1000);

        var countdownText = jam + " jam " + menit + " menit " + detik + " detik";
        document.getElementById("countdown").innerText = countdownText;

        if (selisihWaktu < 0) {
            clearInterval(intervalCountdown);
            document.getElementById("countdown").innerText = "Waktu telah habis";
        }
    }, 1000);
</script>
@endsection
