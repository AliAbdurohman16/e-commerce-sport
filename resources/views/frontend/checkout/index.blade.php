@extends('layouts.frontend.main')

@section('content')
<!-- Hero Start -->
<section class="bg-half-170 bg-light d-table w-100">
    <div class="container">
        <div class="row mt-5 justify-content-center">
            <div class="col-lg-12 text-center">
                <div class="pages-heading">
                    <h4 class="title mb-0"> Checkout </h4>
                </div>
            </div><!--end col-->
        </div><!--end row-->

        <div class="position-breadcrumb">
            <nav aria-label="breadcrumb" class="d-inline-block">
                <ul class="breadcrumb rounded shadow mb-0 px-4 py-2">
                    <li class="breadcrumb-item"><a href="{{ route('/') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('carts.index') }}">Keranjang</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
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
<!-- Start -->
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-lg-4 order-md-last">
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
                            <span class="text-muted">Rp {{ number_format($total_shipping_cost, 0, ',', '.') }}</span>
                        </li>
                        <li class="d-flex justify-content-between lh-sm p-3 border-bottom">
                            <div><h6 class="my-0">Total</h6></div>
                            <span class="text-muted">Rp {{ number_format($amount, 0, ',', '.') }}</span>
                        </li>
                    </ul>
                </div>
            </div><!--end col-->

            <div class="col-md-7 col-lg-8">
                <div class="card rounded shadow p-4 border-0">
                    <h4 class="mb-3">Alamat saya</h4>
                    <form class="needs-validation" novalidate>
                        <div class="row g-3 mb-3">
                            <div class="col-12">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Nama Lengkap" value="{{ $user->name }}">
                                <div class="invalid-feedback">
                                    Valid first name is required.
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="telephone" class="form-label">Telepon</label>
                                <input type="telephone" class="form-control" id="telephone" name="telephone" value="{{ $user->telephone }}" placeholder="Telepon">
                                <div class="invalid-feedback">
                                    Please enter a valid email address for shipping updates.
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" placeholder="you@example.com">
                                <div class="invalid-feedback">
                                    Please enter a valid email address for shipping updates.
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="address" class="form-label">Alamat</label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="Alamat">
                                <div class="invalid-feedback">
                                    Please enter your shipping address.
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="province" class="form-label">Provinsi</label>
                                <input type="text" class="form-control" id="province" name="province" placeholder="Provinsi">
                            </div>

                            <div class="col-md-6">
                                <label for="subdistrict" class="form-label">Kecamatan</label>
                                <input type="text" class="form-control" id="subdistrict" name="subdistrict" placeholder="Kecamatan">
                            </div>

                            <div class="col-md-6">
                                <label for="village" class="form-label">Desa/Kelurahan</label>
                                <input type="text" class="form-control" id="village" name="village" placeholder="Desa">
                            </div>

                            <div class="col-md-6">
                                <label for="postal_code" class="form-label">Kode Pos</label>
                                <input type="text" class="form-control" id="postal_code" name="postal_code" placeholder="Kode Pos">
                            </div>
                        </div>
                    </form>
                    <button class="w-100 btn btn-primary" id="checkout">Lanjutkan checkout</button>
                </div>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
</section><!--end section-->
<!-- End -->
@endsection

@section('javascript')
<!-- TODO: Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-zTSmizcoVqlH4aZZ"></script>
<script type="text/javascript">
    document.getElementById('checkout').onclick = function(){
        // SnapToken acquired from previous step
        snap.pay('{{ $snap_token }}', {
            // Optional
            onSuccess: function(result){
                /* You may add your own js here, this is just example */
                document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
            },
            // Optional
            onPending: function(result){
                /* You may add your own js here, this is just example */
                 document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
            },
            // Optional
            onError: function(result){
                /* You may add your own js here, this is just example */
                document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
            }
        });
    };
</script>
@endsection
