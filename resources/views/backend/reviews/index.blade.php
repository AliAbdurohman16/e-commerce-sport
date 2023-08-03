@extends('layouts.backend.main')

@section('title', 'Data Review')

@section('css')
<!-- Datatables -->
<link rel="stylesheet" href="{{ asset('backend') }}/libs/data-tables/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="{{ asset('backend') }}/libs/data-tables/css/responsive.bootstrap5.min.css">
@endsection

@section('content')
<div class="container-fluid">
    <div class="layout-specing">
        <div class="d-md-flex justify-content-between align-items-center">
            <h5 class="mb-0">Data Review</h5>

            <nav aria-label="breadcrumb" class="d-inline-block">
                <ul class="breadcrumb bg-transparent rounded mb-0 p-0">
                    <li class="breadcrumb-item text-capitalize"><a href="#">Data Review</a></li>
                    <li class="breadcrumb-item text-capitalize active" aria-current="page">list</li>
                </ul>
            </nav>
        </div>

        <div class="row">
            <div class="col-12 mt-4">
                <div class="table-responsive shadow rounded">
                    <div class="card-body">
                        <table class="table table-center bg-white mb-0" id="table">
                            <thead>
                                <tr>
                                    <th class="text-center border-bottom p-3" width="4px">No</th>
                                    <th class="border-bottom p-3">Produk</th>
                                    <th class="border-bottom p-3">Pengguna</th>
                                    <th class="border-bottom p-3">Rating</th>
                                    <th class="border-bottom p-3">Komentar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Start -->
                                @foreach($reviews as $review)
                                    <tr>
                                        <th class="text-center">{{ $loop->iteration }}</th>
                                        <td class="p-3">{{ $review->product->name }}</td>
                                        <td class="p-3">{{ $review->user->name }}</td>
                                        <td class="p-3">
                                            @php
                                                $ratingValue = 5;
                                                $currentRating = $review->rating ?? 0;
                                            @endphp

                                            <ul class="list-unstyled mb-0">
                                                @for ($i = 1; $i <= $ratingValue; $i++)
                                                    <li class="list-inline-item">
                                                        <i class="mdi mdi-star icon-large {{ $i <= $currentRating ? 'text-warning' : 'text-muted' }}"></i>
                                                    </li>
                                                @endfor
                                            </ul>
                                        </td>
                                        <td class="p-3">{{ $review->comment }}</td>
                                    </tr>
                                @endforeach
                                <!-- End -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>
</div><!--end container-->
@endsection

@section('javascript')
<!-- Datatables -->
<script src="{{ asset('backend') }}/libs/data-tables/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('backend') }}/libs/data-tables/js/dataTables.bootstrap5.min.js"></script>
<script src="{{ asset('backend') }}/libs/data-tables/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('backend') }}/libs/data-tables/js/responsive.bootstrap5.min.js"></script>
@endsection
