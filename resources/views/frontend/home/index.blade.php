@extends('layouts.frontend.main')

@section('content')
<!-- Hero Start -->
<section class="home-slider position-relative">
    <div id="carouselExampleInterval" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleInterval" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleInterval" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleInterval" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>

        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="3000">
                <div class="bg-home slider-rtl-2 d-flex align-items-center" style="background:url('{{ asset('frontend') }}/images/shop/bg2.jpg') center center;">
                    <div class="bg-overlay bg-overlay-white opacity-5"></div>
                    <div class="container">
                        <div class="row align-items-center mt-5">
                            <div class="col-lg-7 col-md-7">
                                <div class="title-heading mt-4">
                                    <h1 class="display-4 fw-bold mb-3 text-black">New Accessories <br> Collections</h1>
                                    <p class="para-desc text-black">Launch your campaign and benefit from our expertise on designing and managing conversion centered bootstrap v5 html page.</p>
                                    <div class="mt-4">
                                        <a href="javascript:void(0)" class="btn btn-soft-primary">Shop Now</a>
                                    </div>
                                </div>
                            </div><!--end col-->
                        </div><!--end row-->
                    </div><!--end container-->
                </div>
            </div>

            <div class="carousel-item" data-bs-interval="3000">
                <div class="bg-home slider-rtl-1 d-flex align-items-center" style="background:url('{{ asset('frontend') }}/images/shop/bg1.jpg') center center;">
                    <div class="bg-overlay bg-overlay-white opacity-5"></div>
                    <div class="container">
                        <div class="row align-items-center mt-5">
                            <div class="col-lg-7 col-md-7">
                                <div class="title-heading mt-4">
                                    <h1 class="display-4 fw-bold mb-3 text-black">Headphones <br> Speaker</h1>
                                    <p class="para-desc text-black">Launch your campaign and benefit from our expertise on designing and managing conversion centered bootstrap v5 html page.</p>
                                    <div class="mt-4">
                                        <a href="javascript:void(0)" class="btn btn-soft-primary">Shop Now</a>
                                    </div>
                                </div>
                            </div><!--end col-->
                        </div><!--end row-->
                    </div><!--end container-->
                </div>
            </div>

            <div class="carousel-item" data-bs-interval="3000">
                <div class="bg-home slider-rtl-3 d-flex align-items-center" style="background:url('{{ asset('frontend') }}/images/shop/bg3.jpg') center center;">
                    <div class="bg-overlay bg-overlay-white opacity-5"></div>
                    <div class="container">
                        <div class="row align-items-center mt-5">
                            <div class="col-lg-7 col-md-7">
                                <div class="title-heading mt-4">
                                    <h1 class="display-4 fw-bold mb-3 text-black">Modern Furniture, <br> Armchair</h1>
                                    <p class="para-desc text-black">Launch your campaign and benefit from our expertise on designing and managing conversion centered bootstrap v5 html page.</p>
                                    <div class="mt-4">
                                        <a href="javascript:void(0)" class="btn btn-soft-primary">Shop Now</a>
                                    </div>
                                </div>
                            </div><!--end col-->
                        </div><!--end row-->
                    </div><!--end container-->
                </div>
            </div>
        </div>
    </div>
</section><!--end section-->
<!-- Hero End -->

<!-- Features Start -->
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-md-4 mt-4 pt-2">
            <div class="card shop-features border-0 rounded overflow-hidden">
                <img src="{{ asset('frontend') }}/images/shop/fea1.jpg" class="img-fluid" alt="">
                <div class="category-title ms-md-4 ms-2">
                    <h4>Summer <br> Collection</h4>
                    <a href="javascript:void(0)" class="btn btn-sm btn-soft-primary mt-2">Shop Now</a>
                </div>
            </div>
        </div><!--end col-->

        <div class="col-md-4 mt-4 pt-2">
            <div class="card shop-features border-0 rounded overflow-hidden">
                <img src="{{ asset('frontend') }}/images/shop/fea2.jpg" class="img-fluid" alt="">
                <div class="category-title ms-md-4 ms-2">
                    <h4>Summer <br> Collection</h4>
                    <a href="javascript:void(0)" class="btn btn-sm btn-soft-primary mt-2">Shop Now</a>
                </div>
            </div>
        </div><!--end col-->

        <div class="col-md-4 mt-4 pt-2">
            <div class="card shop-features border-0 rounded overflow-hidden">
                <img src="{{ asset('frontend') }}/images/shop/fea3.jpg" class="img-fluid" alt="">
                <div class="category-title ms-md-4 ms-2">
                    <h4>Summer <br> Collection</h4>
                    <a href="javascript:void(0)" class="btn btn-sm btn-soft-primary mt-2">Shop Now</a>
                </div>
            </div>
        </div><!--end col-->
    </div><!--end row-->
</div><!--end container-->
<!-- Features End -->

<!-- Start -->
<section class="section">
    <!-- Start Most Viewed Products -->
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h5 class="mb-0">Semua Produk</h5>
            </div><!--end col-->
        </div><!--end row-->

        <div class="row">
            @foreach ($products as $product)
            <div class="col-lg-3 col-md-6 col-12 mt-4 pt-2">
                <div class="card shop-list border-0 position-relative">
                    @if ($product->discounts->count() > 0)
                    <ul class="label list-unstyled mb-0">
                        <li><a href="javascript:void(0)" class="badge badge-link rounded-pill bg-warning">Diskon {{ $product->discounts->first()->discount_percentage }}%</a></li>
                    </ul>
                    @endif
                    <div class="shop-image position-relative overflow-hidden rounded shadow">
                        <a href="shop-product-detail.html">
                            @if ($product->images->count() > 0)
                                @foreach ($product->images as $image)
                                    <img src="{{ asset('storage/products/' . $image->path ) }}" class="img-fluid" alt="product">
                                    @break
                                @endforeach
                            @endif
                        </a>
                        <ul class="list-unstyled shop-icons">
                            <li class="mt-2"><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#productview" class="btn btn-icon btn-pills btn-soft-primary"><i data-feather="eye" class="icons"></i></a></li>
                            <li class="mt-2"><a href="shop-cart.html" class="btn btn-icon btn-pills btn-soft-warning"><i data-feather="shopping-cart" class="icons"></i></a></li>
                        </ul>
                    </div>
                    <div class="card-body content pt-4 p-2">
                        <a href="shop-product-detail.html" class="text-dark product-name h6">{{ $product->name }}</a>
                        <div class="d-flex justify-content-between mt-1">
                            @if($product->discounts->count() > 0)
                            @php
                                $discount = $product->discounts->first()->discount_percentage; // get discount percentage
                                $discountedPrice = $product->price - ($product->price * ($discount / 100)); // calculate the price after the discount
                            @endphp
                                <h6 class="text-dark small fst-italic mb-0 mt-1">Rp {{ number_format($discountedPrice, 0, ',', '.') }}
                                    <del class="text-danger ms-2">Rp {{ number_format($product->price, 0, ',', '.') }}</del>
                                </h6>
                            @else
                                <h6 class="text-dark small fst-italic mb-0 mt-1">Rp {{ number_format($product->price, 0, ',', '.') }}</h6>
                            @endif
                        </div>
                    </div>
                </div>
            </div><!--end col-->
            @endforeach
        </div><!--end row-->
    </div><!--end container-->
    <!-- End Most Viewed Product -->

    <!-- Start Categories -->
    <div class="container mt-100 mt-60">
        <div class="row">
            <div class="col-12">
                <h5 class="mb-0">Kategori</h5>
            </div><!--end col-->
        </div><!--end row-->
        <div class="row">
            @foreach ($categories as $category)
            <div class="col-lg-2 col-md-4 col-6 mt-4 pt-2">
                <div class="card features feature-primary explore-feature border-0 rounded text-center">
                    <div class="card-body">
                        <img src="{{ asset('storage/categories/' . $category->image) }}" class="avatar avatar-small rounded-circle shadow-md" alt="category">
                        <div class="content mt-3">
                            <h6 class="mb-0"><a href="javascript:void(0)" class="title text-dark">{{ $category->name }}</a></h6>
                        </div>
                    </div>
                </div>
            </div><!--end col-->
            @endforeach
        </div><!--end row-->
    </div><!--end container-->
    <!-- Start Categories -->

    <!-- Start Popular -->
    <div class="container mt-100 mt-60">
        <div class="row">
            <div class="col-12">
                <h5 class="mb-0">Produk Populer</h5>
            </div><!--end col-->
        </div><!--end row-->

        <div class="row">
            @foreach ($popularProducts as $popular)
            <div class="col-lg-3 col-md-6 col-12 mt-4 pt-2">
                <div class="card shop-list border-0 position-relative">
                    <ul class="label list-unstyled mb-0">
                        <li><a href="javascript:void(0)" class="badge badge-link rounded-pill bg-info">Popular</a></li>
                        @if ($popular->discounts->count() > 0)
                            <li><a href="javascript:void(0)" class="badge badge-link rounded-pill bg-warning">Diskon {{ $popular->discounts->first()->discount_percentage }}%</a></li>
                        @endif
                    </ul>
                    <div class="shop-image position-relative overflow-hidden rounded shadow">
                        <a href="shop-product-detail.html">
                            @if ($popular->images->count() > 0)
                                @foreach ($popular->images as $image)
                                    <img src="{{ asset('storage/products/' . $image->path ) }}" class="img-fluid" alt="product">
                                    @break
                                @endforeach
                            @endif
                        </a>
                        <ul class="list-unstyled shop-icons">
                            <li><a href="javascript:void(0)" class="btn btn-icon btn-pills btn-soft-danger"><i data-feather="heart" class="icons"></i></a></li>
                            <li class="mt-2"><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#productview" class="btn btn-icon btn-pills btn-soft-primary"><i data-feather="eye" class="icons"></i></a></li>
                            <li class="mt-2"><a href="shop-cart.html" class="btn btn-icon btn-pills btn-soft-warning"><i data-feather="shopping-cart" class="icons"></i></a></li>
                        </ul>
                    </div>
                    <div class="card-body content pt-4 p-2">
                        <a href="shop-product-detail.html" class="text-dark product-name h6">{{ $popular->name }}</a>
                        <div class="d-flex justify-content-between mt-1">
                            @if($popular->discounts->count() > 0)
                            @php
                                $discount = $popular->discounts->first()->discount_percentage; // get discount percentage
                                $discountedPrice = $popular->price - ($popular->price * ($discount / 100)); // calculate the price after the discount
                            @endphp
                                <h6 class="text-dark small fst-italic mb-0 mt-1">Rp {{ number_format($discountedPrice, 0, ',', '.') }}
                                    <del class="text-danger ms-2">Rp {{ number_format($popular->price, 0, ',', '.') }}</del>
                                </h6>
                            @else
                                <h6 class="text-dark small fst-italic mb-0 mt-1">Rp {{ number_format($popular->price, 0, ',', '.') }}</h6>
                            @endif
                        </div>
                    </div>
                </div>
            </div><!--end col-->
            @endforeach
        </div><!--end row-->
    </div><!--end container-->
    <!-- End Popular -->

    <!-- Start CTA -->
    <div class="container-fluid mt-100 mt-60">
        <div class="rounded py-5" style="background: url('{{ asset('frontend') }}/images/shop/cta.jpg') fixed;">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title">
                            <h2 class="fw-bold text-black mb-4">End of Season Clearance <br> Sale upto 30%</h2>
                            <p class="para-desc text-black mb-0">Launch your campaign and benefit from our expertise on designing and managing conversion centered bootstrap v5 html page.</p>
                            <div class="mt-4">
                                <a href="javascript:void(0)" class="btn btn-primary">Shop Now</a>
                            </div>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end container-->
        </div>
    </div><!--end container-->
    <!-- End CTA -->

    <!-- Start Recent -->
    <div class="container mt-100 mt-60">
        <div class="row">
            <div class="col-12">
                <h5 class="mb-0">Produk Terbaru</h5>
            </div><!--end col-->
        </div><!--end row-->

        <div class="row">
            @foreach ($recentProducts as $recent)
            <div class="col-lg-3 col-md-6 col-12 mt-4 pt-2">
                <div class="card shop-list border-0 position-relative">
                    <ul class="label list-unstyled mb-0">
                        <li><a href="javascript:void(0)" class="badge badge-link rounded-pill bg-primary">New</a></li>
                        @if ($recent->discounts->count() > 0)
                            <li><a href="javascript:void(0)" class="badge badge-link rounded-pill bg-warning">Diskon {{ $recent->discounts->first()->discount_percentage }}%</a></li>
                        @endif
                    </ul>
                    <div class="shop-image position-relative overflow-hidden rounded shadow">
                        <a href="shop-product-detail.html">
                            @if ($recent->images->count() > 0)
                                @foreach ($recent->images as $image)
                                    <img src="{{ asset('storage/products/' . $image->path ) }}" class="img-fluid" alt="product">
                                    @break
                                @endforeach
                            @endif
                        </a>
                        <ul class="list-unstyled shop-icons">
                            <li><a href="javascript:void(0)" class="btn btn-icon btn-pills btn-soft-danger"><i data-feather="heart" class="icons"></i></a></li>
                            <li class="mt-2"><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#productview" class="btn btn-icon btn-pills btn-soft-primary"><i data-feather="eye" class="icons"></i></a></li>
                            <li class="mt-2"><a href="shop-cart.html" class="btn btn-icon btn-pills btn-soft-warning"><i data-feather="shopping-cart" class="icons"></i></a></li>
                        </ul>
                    </div>
                    <div class="card-body content pt-4 p-2">
                        <a href="shop-product-detail.html" class="text-dark product-name h6">{{ $recent->name }}</a>
                        <div class="d-flex justify-content-between mt-1">
                            @if($recent->discounts->count() > 0)
                            @php
                                $discount = $recent->discounts->first()->discount_percentage; // get discount percentage
                                $discountedPrice = $recent->price - ($recent->price * ($discount / 100)); // calculate the price after the discount
                            @endphp
                                <h6 class="text-dark small fst-italic mb-0 mt-1">Rp {{ number_format($discountedPrice, 0, ',', '.') }}
                                    <del class="text-danger ms-2">Rp {{ number_format($recent->price, 0, ',', '.') }}</del>
                                </h6>
                            @else
                                <h6 class="text-dark small fst-italic mb-0 mt-1">Rp {{ number_format($recent->price, 0, ',', '.') }}</h6>
                            @endif
                        </div>
                    </div>
                </div>
            </div><!--end col-->
            @endforeach
        </div><!--end row-->
    </div><!--end container-->
    <!-- End Recent -->
</section><!--end section-->
<!-- End -->
@endsection
