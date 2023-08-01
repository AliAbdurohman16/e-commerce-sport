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
                            <span class="text-muted" id="shipping-cost">Rp {{ number_format($total_shipping_cost, 0, ',', '.') }}</span>
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
                    <form action="{{ route('checkout.store') }}" method="POST" id="form">
                        @csrf
                        <div class="row g-3 mb-3">
                            <div class="col-12">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Nama Lengkap" value="{{ $user->name }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="telephone" class="form-label">Telepon</label>
                                <input type="number" class="form-control @error('telephone') is-invalid @enderror" id="telephone" name="telephone" value="{{ $user->telephone }}" placeholder="Telepon">
                                @error('telephone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" placeholder="you@example.com" readonly>
                            </div>

                            <div class="col-12">
                                <label for="address" class="form-label">Alamat</label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ $user->address }}" placeholder="Alamat">
                                @error('address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="province" class="form-label">Provinsi</label>
                                <input type="text" class="form-control @error('province') is-invalid @enderror" id="province" name="province" value="{{ $user->province }}" placeholder="Provinsi">
                                @error('province')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="city" class="form-label">Kabupaten/Kota</label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" value="{{ $user->city }}" placeholder="Kota">
                                @error('city')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="subdistrict" class="form-label">Kecamatan</label>
                                <input type="text" class="form-control @error('subdistrict') is-invalid @enderror" id="subdistrict" name="subdistrict" value="{{ $user->subdistrict }}" placeholder="Kecamatan">
                                @error('subdistrict')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="village" class="form-label">Desa/Kelurahan</label>
                                <input type="text" class="form-control @error('village') is-invalid @enderror" id="village" name="village" value="{{ $user->village }}" placeholder="Desa">
                                @error('village')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="postal_code" class="form-label">Kode Pos</label>
                                <input type="number" class="form-control @error('postal_code') is-invalid @enderror" id="postal_code" name="postal_code" value="{{ $user->postal_code }}" placeholder="Kode Pos">
                                @error('postal_code')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="receipt" class="form-label">Bukti Transfer</label>
                                <input type="hidden" name="order_id" value="{{ $order_detail->order_id }}">
                                <input type="hidden" name="gross_amount" value="{{ $amount }}">
                                <input type="hidden" name="shipping_cost" value="{{ $total_shipping_cost }}">
                            </div>
                        </div>
                        <button type="submit" class="w-100 btn btn-primary" id="checkout">Lanjutkan checkout</button>
                    </form>
                </div>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
</section><!--end section-->
<!-- End -->
@endsection
