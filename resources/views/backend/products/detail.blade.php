@extends('layouts.backend.main')

@section('title', 'Produk')

@section('css')
<!-- Datatables -->
<link rel="stylesheet" href="{{ asset('backend') }}/libs/data-tables/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="{{ asset('backend') }}/libs/data-tables/css/responsive.bootstrap5.min.css">
<link rel="stylesheet" href="{{ asset('backend') }}/libs/sweetalert2/sweetalert2.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" integrity="sha512-xmGTNt20S0t62wHLmQec2DauG9T+owP9e6VU8GigI0anN7OXLip9i7IwEhelasml2osdxX71XcYm6BQunTQeQg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="{{ asset('backend') }}/css/tag-input.css"/>
<link rel="stylesheet" href="{{ asset('backend') }}/libs/tiny-slider/tiny-slider.css">
@endsection

@section('content')
<div class="container-fluid">
    <div class="layout-specing">
        <div class="d-md-flex justify-content-between align-items-center">
            <h5 class="mb-0">Produk</h5>

            <nav aria-label="breadcrumb" class="d-inline-block">
                <ul class="breadcrumb bg-transparent rounded mb-0 p-0">
                    <li class="breadcrumb-item text-capitalize"><a href="{{ route('products.index') }}">Produk</a></li>
                    <li class="breadcrumb-item text-capitalize active" aria-current="page">Detail Data</li>
                </ul>
            </nav>
        </div>

        <a href="{{ route('products.index') }}" class="btn btn-warning btn-sm mt-4"><i class="fa-solid fa-arrow-left"></i> Kembali</a>

        <div class="card border-0 rounded p-4 shadow mt-4">
            <div class="row align-items-center">
                <div class="col-lg-4 col-md-5">
                    <div class="tiny-single-item">
                        @if ($products->images->count() > 0)
                            @foreach ($products->images as $image)
                                <div class="tiny-slide"><img src="{{ asset('storage/products/' . $image->path) }}" class="img-fluid rounded" width="500px" height="800px" alt="img-product"></div>
                            @endforeach
                        @endif
                    </div>
                </div><!--end col-->

                <div class="col-lg-8 col-md-7 mt-4 mt-sm-0">
                    <div class="section-title ms-md-4">
                        <h5>{{ $products->name }}</h5>
                        <div class="align-items-center">
                            <h6 class="text-muted mb-0">Rp {{ number_format($products->price, 0, ',', '.') }}</h6>

                            <ul class="list-unstyled text-warning h6 mb-0 mt-2 mt-sm-0">
                                <li class="list-inline-item"><i class="mdi mdi-star-outline mdi-star"></i></li>
                                <li class="list-inline-item"><i class="mdi mdi-star-outline mdi-star"></i></li>
                                <li class="list-inline-item"><i class="mdi mdi-star-outline mdi-star"></i></li>
                                <li class="list-inline-item"><i class="mdi mdi-star-outline mdi-star"></i></li>
                                <li class="list-inline-item"><i class="mdi mdi-star-outline mdi-star"></i></li>
                            </ul>
                        </div>

                        <div class="col-12 mt-4">
                            <div class="d-flex align-items-center">
                                <h6 class="mb-0">Ukuran:</h6>
                                <ul class="list-unstyled mb-0 ms-3">
                                    @foreach ($products->sizes as $size)
                                        <li class="list-inline-item"><a href="javascript:void(0)" class="btn btn-size btn-soft-primary">{{ $size->name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div><!--end col-->

                        <div class="col-12 mt-4">
                            <div class="d-flex align-items-center">
                                <h6 class="mb-0">Warna:</h6>
                                <ul class="list-unstyled mb-0 ms-3">
                                    @foreach ($products->colors as $color)
                                        <li class="list-inline-item"><a href="javascript:void(0)" class="btn btn-color btn-soft-primary">{{ $color->name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div><!--end col-->

                        <div class="col-12 mt-4">
                            <div class="d-flex shop-list align-items-center">
                                <h6 class="mb-0">Quantity:</h6>
                                <div class="qty-icons ms-3">
                                    <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()" class="btn btn-icon btn-soft-primary minus">-</button>
                                    <input min="0" max="10" name="quantity" value="0" type="number" class="btn btn-icon btn-soft-primary qty-btn quantity">
                                    <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="btn btn-icon btn-soft-primary plus">+</button>
                                </div>
                            </div>
                        </div><!--end col-->
                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div>

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

                    <li class="nav-item m-1">
                        <a class="nav-link py-2 px-5 rounded" id="review-comments" data-bs-toggle="pill" href="#review" role="tab" aria-controls="review" aria-selected="false">
                            <div class="text-center">
                                <h6 class="mb-0">Penilaian</h6>
                            </div>
                        </a><!--end nav link-->
                    </li><!--end nav item-->
                </ul>

                <div class="tab-content mt-4" id="pills-tabContent">
                    <div class="card border-0 tab-pane fade show active p-4 rounded shadow" id="description" role="tabpanel" aria-labelledby="description-data">
                        <p class="text-muted mb-0">{{ $products->description }}</p>
                    </div>

                    <div class="card border-0 tab-pane fade" id="additional" role="tabpanel" aria-labelledby="additional-info">
                        <table class="table p-4 rounded shadow">
                            <tbody>
                                <tr>
                                    <td style="width: 100px;">Warna</td>
                                    <td class="text-muted">{{ $products->colors }}</td>
                                </tr>

                                <tr>
                                    <td>Stok</td>
                                    <td class="text-muted">{{ $products->stock }}</td>
                                </tr>

                                <tr>
                                    <td>Size</td>
                                    <td class="text-muted">{{ $products->sizes }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="card border-0 tab-pane fade p-4 rounded shadow" id="review" role="tabpanel" aria-labelledby="review-comments">
                        <div class="row">
                            <div class="col-lg-6">
                                <ul class="media-list list-unstyled mb-0">
                                    <li>
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <a class="pe-3" href="#">
                                                    <img src="assets/images/client/01.jpg" class="img-fluid avatar avatar-md-sm rounded-circle shadow" alt="img">
                                                </a>
                                                <div class="flex-1 commentor-detail">
                                                    <h6 class="mb-0"><a href="javascript:void(0)" class="text-dark media-heading">Lorenzo Peterson</a></h6>
                                                    <small class="text-muted">15th August, 2019 at 01:25 pm</small>
                                                </div>
                                            </div>
                                            <ul class="list-unstyled mb-0">
                                                <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                                <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                                <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                                <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                                <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                            </ul>
                                        </div>
                                        <div class="mt-3">
                                            <p class="text-muted fst-italic p-3 bg-light rounded">" Awesome product "</p>
                                        </div>
                                    </li>

                                    <li class="mt-4">
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <a class="pe-3" href="#">
                                                    <img src="assets/images/client/02.jpg" class="img-fluid avatar avatar-md-sm rounded-circle shadow" alt="img">
                                                </a>
                                                <div class="flex-1 commentor-detail">
                                                    <h6 class="mb-0"><a href="javascript:void(0)" class="media-heading text-dark">Tammy Camacho</a></h6>
                                                    <small class="text-muted">15th August, 2019 at 05:44 pm</small>
                                                </div>
                                            </div>
                                            <ul class="list-unstyled mb-0">
                                                <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                                <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                                <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                                <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                                <li class="list-inline-item"><i class="mdi mdi-star-outline text-warning"></i></li>
                                            </ul>
                                        </div>
                                        <div class="mt-3">
                                            <p class="text-muted fst-italic p-3 bg-light rounded mb-0">" Good "</p>
                                        </div>
                                    </li>
                                </ul>
                            </div><!--end col-->

                            <div class="col-lg-6 mt-4 mt-lg-0 pt-2 pt-lg-0">
                                <form class="ms-lg-4">
                                    <div class="row">
                                        <div class="col-12">
                                            <h5>Add your review:</h5>
                                        </div>
                                        <div class="col-12 mt-4">
                                            <h6 class="small fw-bold">Your Rating:</h6>
                                            <a href="javascript:void(0)" class="d-inline-block me-3">
                                                <ul class="list-unstyled mb-0 small">
                                                    <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                                    <li class="list-inline-item"><i class="mdi mdi-star-outline text-warning"></i></li>
                                                    <li class="list-inline-item"><i class="mdi mdi-star-outline text-warning"></i></li>
                                                    <li class="list-inline-item"><i class="mdi mdi-star-outline text-warning"></i></li>
                                                    <li class="list-inline-item"><i class="mdi mdi-star-outline text-warning"></i></li>
                                                </ul>
                                            </a>

                                            <a href="javascript:void(0)" class="d-inline-block me-3">
                                                <ul class="list-unstyled mb-0 small">
                                                    <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                                    <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                                    <li class="list-inline-item"><i class="mdi mdi-star-outline text-warning"></i></li>
                                                    <li class="list-inline-item"><i class="mdi mdi-star-outline text-warning"></i></li>
                                                    <li class="list-inline-item"><i class="mdi mdi-star-outline text-warning"></i></li>
                                                </ul>
                                            </a>

                                            <a href="javascript:void(0)" class="d-inline-block me-3">
                                                <ul class="list-unstyled mb-0 small">
                                                    <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                                    <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                                    <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                                    <li class="list-inline-item"><i class="mdi mdi-star-outline text-warning"></i></li>
                                                    <li class="list-inline-item"><i class="mdi mdi-star-outline text-warning"></i></li>
                                                </ul>
                                            </a>

                                            <a href="javascript:void(0)" class="d-inline-block me-3">
                                                <ul class="list-unstyled mb-0 small">
                                                    <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                                    <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                                    <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                                    <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                                    <li class="list-inline-item"><i class="mdi mdi-star-outline text-warning"></i></li>
                                                </ul>
                                            </a>

                                            <a href="javascript:void(0)" class="d-inline-block">
                                                <ul class="list-unstyled mb-0 small">
                                                    <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                                    <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                                    <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                                    <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                                    <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                                </ul>
                                            </a>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <div class="mb-3">
                                                <label class="form-label">Your Review:</label>
                                                <div class="form-icon position-relative">
                                                    <i data-feather="message-circle" class="fea icon-sm icons"></i>
                                                    <textarea id="message" placeholder="Your Comment" rows="5" name="message" class="form-control ps-5" required=""></textarea>
                                                </div>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Name <span class="text-danger">*</span></label>
                                                <div class="form-icon position-relative">
                                                    <i data-feather="user" class="fea icon-sm icons"></i>
                                                    <input id="name" name="name" type="text" placeholder="Name" class="form-control ps-5" required="">
                                                </div>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Your Email <span class="text-danger">*</span></label>
                                                <div class="form-icon position-relative">
                                                    <i data-feather="mail" class="fea icon-sm icons"></i>
                                                    <input id="email" type="email" placeholder="Email" name="email" class="form-control ps-5" required="">
                                                </div>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-md-12">
                                            <div class="send d-grid">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div><!--end col-->
                                    </div><!--end row-->
                                </form><!--end form-->
                            </div><!--end col-->
                        </div><!--end row-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!--end container-->
@endsection

@section('javascript')
<!-- Datatables -->
<script src="{{ asset('backend') }}/libs/data-tables/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('backend') }}/libs/data-tables/js/dataTables.bootstrap5.min.js"></script>
<script src="{{ asset('backend') }}/libs/data-tables/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('backend') }}/libs/data-tables/js/responsive.bootstrap5.min.js"></script>
<script src="{{ asset('backend') }}/libs/sweetalert2/sweetalert2.min.js"></script>
<script src="{{ asset('backend') }}/libs/tiny-slider/min/tiny-slider.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js" integrity="sha512-9UR1ynHntZdqHnwXKTaOm1s6V9fExqejKvg5XMawEMToW4sSw+3jtLrYfZPijvnwnnE8Uol1O9BcAskoxgec+g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
