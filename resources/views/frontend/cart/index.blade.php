@extends('layouts.frontend.main')

@section('content')
<!-- Hero Start -->
<section class="bg-half-170 bg-light d-table w-100">
    <div class="container">
        <div class="row mt-5 justify-content-center">
            <div class="col-lg-12 text-center">
                <div class="pages-heading">
                    <h4 class="title mb-0"> Keranjang </h4>
                </div>
            </div><!--end col-->
        </div><!--end row-->

        <div class="position-breadcrumb">
            <nav aria-label="breadcrumb" class="d-inline-block">
                <ul class="breadcrumb rounded shadow mb-0 px-4 py-2">
                    <li class="breadcrumb-item"><a href="{{ route('/') }}">Beranda</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Keranjang</li>
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
        <div class="row">
            <div class="col-12">
                <div class="table-responsive bg-white shadow rounded">
                    <table class="table mb-0 table-center">
                        <thead>
                            <tr>
                                <th class="border-bottom py-3" style="min-width:20px "></th>
                                <th class="border-bottom text-start py-3" style="min-width: 300px;">Produk</th>
                                <th class="border-bottom text-center py-3" style="min-width: 160px;">Harga</th>
                                <th class="border-bottom text-center py-3" style="min-width: 160px;">Qty</th>
                                <th class="border-bottom text-end py-3 pe-4" style="min-width: 160px;">Jumlah</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($orders as $order)
                                <tr class="shop-list">
                                    <td class="h6 text-center"><a href="javascript:void(0)" class="text-danger"><i class="uil uil-times"></i></a></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if ($order->product->images->count() > 0)
                                                @foreach ($order->product->images as $image)
                                                    <div class="tiny-slide"><img src="{{ asset('storage/products/' . $image->path) }}" class="img-fluid avatar avatar-small rounded shadow" style="height:auto;"  alt="img-product"></div>
                                                    @break
                                                @endforeach
                                            @endif
                                            <h6 class="mb-0 ms-3">{{ $order->product->name }} ({{ $order->size }}, {{ $order->color }})</h6>
                                        </div>
                                    </td>
                                    @if($order->product->discounts->count() > 0)
                                        @php
                                            $discount = $order->product->discounts->first()->discount_percentage; // get discount percentage
                                            $discountedPrice = $order->product->price - ($order->product->price * ($discount / 100)); // calculate the price after the discount
                                        @endphp
                                        <td class="text-center" id="price-{{ $order->id }}">Rp {{ number_format($discountedPrice, 0, ',', '.') }}</td>
                                    @else
                                        <td class="text-center" id="price-{{ $order->id }}">Rp {{ number_format($order->product->price, 0, ',', '.') }}</td>
                                    @endif
                                    <td class="text-center qty-icons">
                                        <button onclick="decreaseQuantity({{ $order->id }})" class="btn btn-icon btn-soft-primary minus">-</button>
                                        <input min="0" max="{{ $order->product->stock }}" name="quantity" value="{{ $order->quantity }}" id="quantity-{{ $order->id }}" type="number" class="btn btn-icon btn-soft-primary qty-btn quantity" onchange="updateAmount({{ $order->id }})">
                                        <button onclick="increaseQuantity({{ $order->id }})" class="btn btn-icon btn-soft-primary plus">+</button>
                                    </td>
                                    @if($order->product->discounts->count() > 0)
                                        @php
                                            $discount = $order->product->discounts->first()->discount_percentage; // get discount percentage
                                            $discountedPrice = $order->product->price - ($order->product->price * ($discount / 100)); // calculate the price after the discount
                                        @endphp
                                        <td class="text-end fw-bold pe-4" id="amount-{{ $order->id }}">Rp {{ number_format($order->quantity * $discountedPrice, 0, ',', '.') }}</td>
                                    @else
                                        <td class="text-end fw-bold pe-4" id="amount-{{ $order->id }}">Rp {{ number_format($order->quantity * $order->product->price, 0, ',', '.') }}</td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!--end col-->
        </div><!--end row-->
        <div class="row">
            <div class="col-lg-4 col-md-6 ms-auto mt-4 pt-2">
                <div class="table-responsive bg-white rounded shadow">
                    <table class="table table-center table-padding mb-0">
                        <tbody>
                            <tr>
                                <td class="h6 ps-4 py-3">Subtotal</td>
                                <td class="text-end fw-bold pe-4">$ 2190</td>
                            </tr>
                            <tr>
                                <td class="h6 ps-4 py-3">Taxes</td>
                                <td class="text-end fw-bold pe-4">$ 219</td>
                            </tr>
                            <tr class="bg-light">
                                <td class="h6 ps-4 py-3">Total</td>
                                <td class="text-end fw-bold pe-4">$ 2409</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="mt-4 pt-2 text-end">
                    <a href="shop-checkouts.html" class="btn btn-primary">Checkout</a>
                </div>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
</section><!--end section-->
<!-- End -->
@endsection

@section('javascript')
<script>
    function updateAmount(orderId) {
        const quantityInput = document.getElementById(`quantity-${orderId}`);
        const amountCell = document.getElementById(`amount-${orderId}`);
        const priceCell = document.getElementById(`price-${orderId}`);
        const price = parseInt(priceCell.innerText.replace(/\D/g, ''));
        const quantity = parseInt(quantityInput.value);
        const amount = price * quantity;
        amountCell.innerText = `Rp ${numberWithCommas(amount)}`;
    }

    function decreaseQuantity(orderId) {
        const quantityInput = document.getElementById(`quantity-${orderId}`);
        quantityInput.stepDown();
        updateAmount(orderId);
    }

    function increaseQuantity(orderId) {
        const quantityInput = document.getElementById(`quantity-${orderId}`);
        quantityInput.stepUp();
        updateAmount(orderId);
    }

    function numberWithCommas(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    // Function to limit the maximum qty
    function incrementQty(element) {
        let input = element.parentNode.querySelector('input[type=number]');
        let max = input.getAttribute('max');
        let value = parseInt(input.value);

        if (value < max) {
            input.stepUp();
        }
    }
</script>
@endsection
