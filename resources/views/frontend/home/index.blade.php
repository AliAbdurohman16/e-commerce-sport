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
                <div class="bg-home slider-rtl-2 d-flex align-items-center" style="background:url('{{ asset('storage/settings/' . $setting->photo_slider_1 ) }}') center center;">
                    <div class="bg-overlay bg-overlay-white opacity-5"></div>
                    <div class="container">
                        <div class="row align-items-center mt-5">
                            <div class="col-lg-7 col-md-7">
                                <div class="title-heading mt-4">
                                    <h1 class="display-4 fw-bold mb-3 text-black">{{ $setting->title_slider_1 }}</h1>
                                    <p class="para-desc text-black">{{ $setting->desc_slider_1 }}</p>
                                    <div class="mt-4">
                                        <a href="#shop-now" class="btn btn-soft-primary">Belanja Sekarang</a>
                                    </div>
                                </div>
                            </div><!--end col-->
                        </div><!--end row-->
                    </div><!--end container-->
                </div>
            </div>

            <div class="carousel-item" data-bs-interval="3000">
                <div class="bg-home slider-rtl-1 d-flex align-items-center" style="background:url('{{ asset('storage/settings/' . $setting->photo_slider_2 ) }}') center center;">
                    <div class="bg-overlay bg-overlay-white opacity-5"></div>
                    <div class="container">
                        <div class="row align-items-center mt-5">
                            <div class="col-lg-7 col-md-7">
                                <div class="title-heading mt-4">
                                    <h1 class="display-4 fw-bold mb-3 text-black">{{ $setting->title_slider_2 }}</h1>
                                    <p class="para-desc text-black">{{ $setting->desc_slider_2 }}</p>
                                    <div class="mt-4">
                                        <a href="#shop-now" class="btn btn-soft-primary">Belanja Sekarang</a>
                                    </div>
                                </div>
                            </div><!--end col-->
                        </div><!--end row-->
                    </div><!--end container-->
                </div>
            </div>

            <div class="carousel-item" data-bs-interval="3000">
                <div class="bg-home slider-rtl-3 d-flex align-items-center" style="background:url('{{ asset('storage/settings/' . $setting->photo_slider_3 ) }}') center center;">
                    <div class="bg-overlay bg-overlay-white opacity-5"></div>
                    <div class="container">
                        <div class="row align-items-center mt-5">
                            <div class="col-lg-7 col-md-7">
                                <div class="title-heading mt-4">
                                    <h1 class="display-4 fw-bold mb-3 text-black">{{ $setting->title_slider_3 }}</h1>
                                    <p class="para-desc text-black">{{ $setting->desc_slider_3 }}</p>
                                    <div class="mt-4">
                                        <a href="#shop-now" class="btn btn-soft-primary">Belanja Sekarang</a>
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
                <img src="{{ asset('storage/settings/' . $setting->advertisement_1 ) }}" class="img-fluid" alt="">
                <div class="category-title ms-md-4 ms-2">
                    <a href="#shop-now" class="btn btn-sm btn-soft-primary mt-2">Belanja Sekarang</a>
                </div>
            </div>
        </div><!--end col-->

        <div class="col-md-4 mt-4 pt-2">
            <div class="card shop-features border-0 rounded overflow-hidden">
                <img src="{{ asset('storage/settings/' . $setting->advertisement_2 ) }}" class="img-fluid" alt="">
                <div class="category-title ms-md-4 ms-2">
                    <a href="#shop-now" class="btn btn-sm btn-soft-primary mt-2">Belanja Sekarang</a>
                </div>
            </div>
        </div><!--end col-->

        <div class="col-md-4 mt-4 pt-2">
            <div class="card shop-features border-0 rounded overflow-hidden">
                <img src="{{ asset('storage/settings/' . $setting->advertisement_3 ) }}" class="img-fluid" alt="">
                <div class="category-title ms-md-4 ms-2">
                    <a href="#shop-now" class="btn btn-sm btn-soft-primary mt-2">Belanja Sekarang</a>
                </div>
            </div>
        </div><!--end col-->
    </div><!--end row-->
</div><!--end container-->
<!-- Features End -->

<!-- Start -->
<section class="section" id="shop-now">
    <!-- Start Recent -->
    <div class="container">
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
                        <li><a class="badge badge-link rounded-pill bg-primary">New</a></li>
                        @if ($recent->discounts->count() > 0 && $recent->discounts->first()->end_date >= now())
                            <li><a href="{{ route('products.discount') }}" class="badge badge-link rounded-pill bg-warning">Diskon {{ $recent->discounts->first()->discount_percentage }}%</a></li>
                        @endif
                    </ul>
                    <div class="shop-image position-relative overflow-hidden rounded shadow">
                        <a href="{{ route('products.detail', $recent->slug) }}">
                            @if ($recent->images->count() > 0)
                                @foreach ($recent->images as $image)
                                    <img src="{{ asset('storage/products/' . $image->path ) }}" class="img-fluid" alt="product">
                                    @break
                                @endforeach
                            @endif
                        </a>
                    </div>
                    <div class="card-body content pt-4 p-2">
                        <a href="{{ route('products.detail', $recent->slug) }}" class="text-dark product-name h6">{{ $recent->name }}</a>
                        <div class="d-flex justify-content-between mt-1">
                            @if($recent->discounts->count() > 0 && $recent->discounts->first()->end_date >= now())
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
                        <li><a class="badge badge-link rounded-pill bg-info">Popular</a></li>
                        @if ($popular->discounts->count() > 0 && $popular->discounts->first()->end_date >= now())
                            <li><a href="{{ route('products.discount') }}" class="badge badge-link rounded-pill bg-warning">Diskon {{ $popular->discounts->first()->discount_percentage }}%</a></li>
                        @endif
                    </ul>
                    <div class="shop-image position-relative overflow-hidden rounded shadow">
                        <a href="{{ route('products.detail', $popular->slug) }}">
                            @if ($popular->images->count() > 0)
                                @foreach ($popular->images as $image)
                                    <img src="{{ asset('storage/products/' . $image->path ) }}" class="img-fluid" alt="product">
                                    @break
                                @endforeach
                            @endif
                        </a>
                    </div>
                    <div class="card-body content pt-4 p-2">
                        <a href="{{ route('products.detail', $popular->slug) }}" class="text-dark product-name h6">{{ $popular->name }}</a>
                        <div class="d-flex justify-content-between mt-1">
                            @if($popular->discounts->count() > 0 && $popular->discounts->first()->end_date >= now())
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
        <div class="rounded py-5" style="background: url('{{ asset('storage/settings/' . $setting->photo_cta ) }}') fixed;">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title">
                            <h2 class="fw-bold text-black mb-4">{{ $setting->title_cta }}</h2>
                            <p class="para-desc text-black mb-0">{{ $setting->desc_cta }}</p>
                            <div class="mt-4">
                                <a href="#shop" class="btn btn-primary">Belanja Sekarang</a>
                            </div>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end container-->
        </div>
    </div><!--end container-->
    <!-- End CTA -->

    <!-- All Products -->
    <div class="container mt-100 mt-60" id="shop">
        <div class="row">
            <div class="col-12">
                <h5 class="mb-0">Semua Produk</h5>
            </div><!--end col-->
        </div><!--end row-->

        <div class="row">
            @foreach ($products as $product)
            <div class="col-lg-3 col-md-6 col-12 mt-4 pt-2">
                <div class="card shop-list border-0 position-relative">
                    @if ($product->discounts->count() > 0 && $product->discounts->first()->end_date >= now())
                    <ul class="label list-unstyled mb-0">
                        <li><a href="{{ route('products.discount') }}" class="badge badge-link rounded-pill bg-warning">Diskon {{ $product->discounts->first()->discount_percentage }}%</a></li>
                    </ul>
                    @endif
                    <div class="shop-image position-relative overflow-hidden rounded shadow">
                        <a href="{{ route('products.detail', $product->slug) }}">
                            @if ($product->images->count() > 0)
                                @foreach ($product->images as $image)
                                    <img src="{{ asset('storage/products/' . $image->path ) }}" class="img-fluid" alt="product">
                                    @break
                                @endforeach
                            @endif
                        </a>
                    </div>
                    <div class="card-body content pt-4 p-2">
                        <a href="{{ route('products.detail', $product->slug) }}" class="text-dark product-name h6">{{ $product->name }}</a>
                        <div class="d-flex justify-content-between mt-1">
                            @if($product->discounts->count() > 0 && $product->discounts->first()->end_date >= now())
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
    <!-- End All Products -->

</section><!--end section-->
<!-- End -->
@endsection
