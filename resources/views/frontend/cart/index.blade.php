@extends('layouts.frontend.main')

@section('css')
<!-- Sweat Alert -->
<link rel="stylesheet" href="{{ asset('backend') }}/libs/sweetalert2/sweetalert2.min.css"/>
@endsection

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
                                <th class="border-bottom text-end py-3 pe-4" style="min-width: 160px;">Total</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($order_details as $order)
                                <tr class="shop-list">
                                    <td class="h6 text-center"><span data-id="{{ $order->id }}" class="text-danger delete"><i class="uil uil-times"></i></span></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if ($order->product->images->count() > 0)
                                                @foreach ($order->product->images as $image)
                                                    <div class="tiny-slide"><img src="{{ asset('storage/products/' . $image->path) }}" class="img-fluid avatar avatar-small rounded shadow" style="height:auto;"  alt="img-product"></div>
                                                    @break
                                                @endforeach
                                            @endif
                                            <h6 class="mb-0 ms-3">{{ $order->product->name }}
                                                @if ($order->size && $order->color != '')
                                                ({{ $order->size }}, {{ $order->color }})
                                                @elseif ($order->size != '')
                                                ({{ $order->size }})
                                                @elseif ($order->color != '')
                                                ({{ $order->color }})
                                                @endif
                                            </h6>
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
                                        <input min="0" max="{{ $order->product->stock }}" name="quantity" value="{{ $order->product->stock == 0 ? 0 : $order->quantity }}" id="quantity-{{ $order->id }}" type="number" class="btn btn-icon btn-soft-primary qty-btn quantity" onchange="updateTotal({{ $order->id }})">
                                        <button onclick="increaseQuantity({{ $order->id }})" class="btn btn-icon btn-soft-primary plus">+</button>
                                        @if($order->product->stock == 0)
                                        <br><small class="text-danger mt-2">Stok habis!</small>
                                        @endif
                                    </td>
                                    @if($order->product->discounts->count() > 0)
                                        @php
                                            $discount = $order->product->discounts->first()->discount_percentage; // get discount percentage
                                            $discountedPrice = $order->product->price - ($order->product->price * ($discount / 100)); // calculate the price after the discount
                                        @endphp
                                        <td class="text-end fw-bold pe-4 total" id="total-{{ $order->id }}">Rp {{ $order->product->stock == 0 ? 0 : number_format($order->quantity * $discountedPrice, 0, ',', '.') }}</td>
                                    @else
                                        <td class="text-end fw-bold pe-4 total" id="total-{{ $order->id }}">Rp {{ $order->product->stock == 0 ? 0 : number_format($order->quantity * $order->product->price, 0, ',', '.') }}</td>
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
                                <td class="text-end fw-bold pe-4" id="subtotal">Rp 0</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="mt-4 pt-2 text-end">
                    <a href="{{ route('checkout.index') }}" class="btn btn-primary">Checkout</a>
                </div>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
</section><!--end section-->
<!-- End -->
@endsection

@section('javascript')
<script src="{{ asset('backend') }}/libs/sweetalert2/sweetalert2.min.js"></script>
<script>
    function calculateSubtotal() {
        const totalCells = document.querySelectorAll('.total');
        let subtotal = 0;
        totalCells.forEach(cell => {
            subtotal += parseInt(cell.innerText.replace(/\D/g, ''));
        });
        const subtotalCell = document.getElementById('subtotal');
        subtotalCell.innerText = `Rp ${numberWithCommas(subtotal)}`;
    }

    calculateSubtotal();

    function updateTotal(orderId) {
        const quantityInput = document.getElementById(`quantity-${orderId}`);
        const totalCell = document.getElementById(`total-${orderId}`);
        const priceCell = document.getElementById(`price-${orderId}`);
        const price = parseInt(priceCell.innerText.replace(/\D/g, ''));
        const quantity = parseInt(quantityInput.value);
        const total = price * quantity;
        totalCell.innerText = `Rp ${numberWithCommas(total)}`;
        calculateSubtotal();
    }

    function decreaseQuantity(orderId) {
        const quantityInput = document.getElementById(`quantity-${orderId}`);
        quantityInput.stepDown();
        updateTotal(orderId);
    }

    function increaseQuantity(orderId) {
        const quantityInput = document.getElementById(`quantity-${orderId}`);
        quantityInput.stepUp();
        updateTotal(orderId);
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

    // show dialog success
    @if (Session::has('success'))
        swal.fire({
            icon: "success",
            title: "Berhasil",
            text: "{{ Session::get('success') }}",
        }).then((result) => {
            if (result.isConfirmed) {
                location.reload();
            }
        });
    @elseif (Session::has('error'))
        swal.fire({
            icon: "error",
            title: "Gagal",
            text: "{{ Session::get('error') }}",
        }).then((result) => {
            if (result.isConfirmed) {
                location.reload();
            }
        });
    @endif

    // function delete
    $(".delete").click(function() {
        var id = $(this).data("id");
        Swal.fire({
            title: 'Hapus',
            text: "Apakah anda yakin ingin menghapus?",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "carts/" + id,
                    type: 'DELETE',
                    data: {
                        "id": id,
                        "_token": $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function(response) {
                        swal.fire({
                            icon: "success",
                            title: "Berhasil",
                            text: response.message,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    },
                });
            }
        })
    });
</script>
@endsection
