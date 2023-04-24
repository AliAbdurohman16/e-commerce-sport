@extends('layouts.frontend.main')

@section('content')
<!-- Hero Start -->
<section class="bg-half-170 bg-light d-table w-100">
    <div class="container">
        <div class="row mt-5 justify-content-center">
            <div class="col-lg-12 text-center">
                <div class="pages-heading">
                    <h4 class="title mb-0"> Detail Produk {{ $product->name }} </h4>
                </div>
            </div><!--end col-->
        </div><!--end row-->

        <div class="position-breadcrumb">
            <nav aria-label="breadcrumb" class="d-inline-block">
                <ul class="breadcrumb rounded shadow mb-0 px-4 py-2">
                    <li class="breadcrumb-item"><a href="{{ route('/') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('products.all')}}">Produk</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail</li>
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

<!-- Start Products -->
<section class="section pb-0">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-5">
                <div class="tiny-single-item">
                    @if ($product->images->count() > 0)
                        @foreach ($product->images as $image)
                            <div class="tiny-slide"><img src="{{ asset('storage/products/' . $image->path) }}" class="img-fluid rounded" width="500px" height="800px" alt="img-product"></div>
                        @endforeach
                    @endif
                </div>
            </div><!--end col-->

            <div class="col-md-7 mt-4 mt-sm-0 pt-2 pt-sm-0">
                <div class="section-title ms-md-4">
                    <h4 class="title">{{ $product->name }}</h4>
                    @if($product->discounts->count() > 0)
                        @php
                            $discount = $product->discounts->first()->discount_percentage; // get discount percentage
                            $discountedPrice = $product->price - ($product->price * ($discount / 100)); // calculate the price after the discount
                        @endphp
                        <h5 class="text-muted">Rp {{ number_format($discountedPrice, 0, ',', '.') }}
                            <del class="text-danger ms-2">Rp {{ number_format($product->price, 0, ',', '.') }}</del>
                        </h5>
                    @else
                        <h5 class="text-muted">Rp {{ number_format($product->price, 0, ',', '.') }}</h5>
                    @endif

                    <form method="POST" action="{{ route('cart.addToCart', $product->id) }}">
                        @csrf
                        <div class="row mt-4 pt-2">
                            <div class="col-12 mt-4">
                                <div class="d-flex align-items-center">
                                    <h6 class="mb-0">Ukuran:</h6>
                                    <ul class="list-unstyled mb-0 ms-3">
                                        @foreach ($product->sizes as $size)
                                            <li class="list-inline-item">
                                                <input type="button" class="btn btn-size btn-soft-primary" name="size" value="{{ $size->name }}">
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div><!--end col-->

                            <div class="col-12 mt-4">
                                <div class="d-flex align-items-center">
                                    <h6 class="mb-0">Warna:</h6>
                                    <ul class="list-unstyled mb-0 ms-3">
                                        @foreach ($product->colors as $color)
                                            <li class="list-inline-item">
                                                <input type="button" class="btn btn-size btn-soft-primary"  name="color" value="{{ $color->name }}">
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div><!--end col-->

                            <div class="col-12 mt-4">
                                <div class="d-flex shop-list align-items-center">
                                    <h6 class="mb-0">Quantity:</h6>
                                    <div class="qty-icons ms-3">
                                        <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()" class="btn btn-icon btn-soft-primary minus">-</button>
                                        <input min="0" max="{{ $product->stock }}" name="quantity" value="0" type="number" class="btn btn-icon btn-soft-primary qty-btn quantity">
                                        <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="btn btn-icon btn-soft-primary plus">+</button>
                                    </div>
                                </div>
                            </div><!--end col-->
                        </div><!--end row-->

                        <div class="mt-2 pt-2">
                            <button type="submit" class="btn btn--primary mt-2">Tambah Keranjang</button>
                            <a href="javascript:void(0)" class="btn btn-soft-primary mt-2">Beli Sekarang</a>
                        </div>
                    </form>
                </div>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->

    <div class="container mt-100 mt-60 mb-5">
        <div class="row">
            <div class="col-12 mt-4">
                <ul class="nav nav-pills shadow flex-column flex-sm-row d-md-inline-flex mb-0 p-1 bg-white-color rounded position-relative overflow-hidden" id="pills-tab" role="tablist">
                    <li class="nav-item m-1">
                        <a class="nav-link py-2 px-5 active rounded" id="description-data" data-bs-toggle="pill" href="#description" role="tab" aria-controls="description" aria-selected="false">
                            <div class="text-center">
                                <h6 class="mb-0">Deskripsi</h6>
                            </div>
                        </a><!--end nav link-->
                    </li><!--end nav item-->

                    <li class="nav-item m-1">
                        <a class="nav-link py-2 px-5 rounded" id="additional-info" data-bs-toggle="pill" href="#additional" role="tab" aria-controls="additional" aria-selected="false">
                            <div class="text-center">
                                <h6 class="mb-0">Informasi</h6>
                            </div>
                        </a><!--end nav link-->
                    </li><!--end nav item-->
                </ul>

                <div class="tab-content mt-4" id="pills-tabContent">
                    <div class="card border-0 tab-pane fade show active p-4 rounded shadow" id="description" role="tabpanel" aria-labelledby="description-data">
                        <p class="text-muted mb-0">{{ $product->description }}</p>
                    </div>

                    <div class="card border-0 tab-pane fade" id="additional" role="tabpanel" aria-labelledby="additional-info">
                        <table class="table p-4 rounded shadow">
                            <tbody>
                                <tr>
                                    <td style="width: 100px;">Warna</td>
                                    <td class="text-muted">
                                        @foreach ($product->colors as $color)
                                            {{ $color->name }},
                                        @endforeach
                                    </td>
                                </tr>

                                <tr>
                                    <td>Stok</td>
                                    <td class="text-muted">{{ $product->stock }}</td>
                                </tr>

                                <tr>
                                    <td>Berat</td>
                                    <td class="text-muted">{{ $product->weight }} {{ $product->unit }}</td>
                                </tr>

                                <tr>
                                    <td>Size</td>
                                    <td class="text-muted">
                                        @foreach ($product->sizes as $size)
                                            {{ $size->name }},
                                        @endforeach
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!--end container-->

    @if(count($relatedProducts) > 0)
    <div class="container mt-95 mt-55 mb-5">
        <div class="row">
            <div class="col-12">
                <h5 class="mb-0">Related Products</h5>
            </div><!--end col-->

            <div class="col-12 mt-4">
                <div class="tiny-four-item">
                    @foreach ($relatedProducts as $related)
                    <div class="tiny-slide">
                        <div class="card shop-list border-0 position-relative m-2">
                            @if ($related->discounts->count() > 0)
                            <ul class="label list-unstyled mb-0">
                                <li><a href="javascript:void(0)" class="badge badge-link rounded-pill bg-warning">Diskon {{ $related->discounts->first()->discount_percentage }}%</a></li>
                            </ul>
                            @endif
                            <div class="shop-image position-relative overflow-hidden rounded shadow">
                                <a href="{{ route('products.detail', $related->slug) }}">
                                    @if ($related->images->count() > 0)
                                        @foreach ($related->images as $image)
                                            <img src="{{ asset('storage/products/' . $image->path ) }}" class="img-fluid" alt="product">
                                            @break
                                        @endforeach
                                    @endif
                                </a>
                                <ul class="list-unstyled shop-icons">
                                    <li class="mt-2"><a href="{{ route('products.detail', $related->slug) }}" class="btn btn-icon btn-pills btn-soft-primary"><i data-feather="eye" class="icons"></i></a></li>
                                    <li class="mt-2"><a href="shop-cart.html" class="btn btn-icon btn-pills btn-soft-warning"><i data-feather="shopping-cart" class="icons"></i></a></li>
                                </ul>
                            </div>
                            <div class="card-body content pt-4 p-2">
                                <a href="{{ route('products.detail', $related->slug) }}" class="text-dark product-name h6">{{ $related->name }}</a>
                                <div class="d-flex justify-content-between mt-1">
                                    @if($related->discounts->count() > 0)
                                    @php
                                        $discount = $related->discounts->first()->discount_percentage; // get discount percentage
                                        $discountedPrice = $related->price - ($related->price * ($discount / 100)); // calculate the price after the discount
                                    @endphp
                                        <h6 class="text-dark small fst-italic mb-0 mt-1">Rp {{ number_format($discountedPrice, 0, ',', '.') }}
                                            <del class="text-danger ms-2">Rp {{ number_format($related->price, 0, ',', '.') }}</del>
                                        </h6>
                                    @else
                                        <h6 class="text-dark small fst-italic mb-0 mt-1">Rp {{ number_format($related->price, 0, ',', '.') }}</h6>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
    @endif
</section><!--end section-->
<!-- End Products -->
@endsection

@section('javascript')
<script>
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
