@extends('layouts.frontend.main')

@section('content')
<!-- Hero Start -->
<section class="bg-half-170 bg-light d-table w-100">
    <div class="container">
        <div class="row mt-5 justify-content-center">
            <div class="col-lg-12 text-center">
                <div class="pages-heading">
                    <h4 class="title mb-0"> Pencarian produk berdasarkan {{ $search }} </h4>
                </div>
            </div><!--end col-->
        </div><!--end row-->

        <div class="position-breadcrumb">
            <nav aria-label="breadcrumb" class="d-inline-block">
                <ul class="breadcrumb rounded shadow mb-0 px-4 py-2">
                    <li class="breadcrumb-item"><a href="{{ route('/') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('products.all')}}">Produk</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pencarian</li>
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
<section class="section">
    <div class="container">
        <div class="row">
            @if(count($products) > 0)
            @foreach ($products as $product)
            <div class="col-lg-3 col-md-6 col-12 mt-4 pt-2">
                <div class="card shop-list border-0 position-relative">
                    @if ($product->discounts->count() > 0)
                    <ul class="label list-unstyled mb-0">
                        <li><a href="javascript:void(0)" class="badge badge-link rounded-pill bg-warning">Diskon {{ $product->discounts->first()->discount_percentage }}%</a></li>
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

            <!-- PAGINATION START -->
            <div class="col-12 mt-4 pt-2">
                <ul class="pagination justify-content-center mb-0">
                    @if ($products->lastPage() > 1)
                        <li class="page-item {{ ($products->currentPage() == 1) ? ' disabled' : '' }}">
                            <a class="page-link" href="{{ $products->url(1) }}" aria-label="Previous"><i class="mdi mdi-arrow-left"></i> Prev</a>
                        </li>
                        @for ($i = 1; $i <= $products->lastPage(); $i++)
                        <li class="page-item {{ ($products->currentPage() == $i) ? ' active' : '' }}">
                            <a class="page-link" href="{{ $products->url($i) }}">{{ $i }}</a>
                        </li>
                        @endfor
                        <li class="page-item {{ ($products->currentPage() == $products->lastPage()) ? ' disabled' : '' }}">
                            <a class="page-link" href="{{ $products->url($products->currentPage()+1) }}" aria-label="Next">Next <i class="mdi mdi-arrow-right"></i></a>
                        </li>
                    @endif
                </ul>
            </div><!--end col-->
            <!-- PAGINATION END -->
            @else
                <h3 class="text-center">Tidak ada produk yang ditemukan.</h3>
            @endif
        </div><!--end row-->
    </div><!--end container-->
</section><!--end section-->
<!-- End Products -->
@endsection
