@extends('layouts.backend.main')

@section('title', 'Produk Kurang Laris')

@section('css')
<link rel="stylesheet" href="{{ asset('backend') }}/libs/select2/select2.min.css"/>
<link rel="stylesheet" href="{{ asset('backend') }}/css/select2.css"/>
@endsection

@section('content')
<div class="container-fluid">
    <div class="layout-specing">
        <div class="d-md-flex justify-content-between align-items-center">
            <h5 class="mb-0">Produk Kurang Laris</h5>

            <nav aria-label="breadcrumb" class="d-inline-block">
                <ul class="breadcrumb bg-transparent rounded mb-0 p-0">
                    <li class="breadcrumb-item text-capitalize"><a href="{{ route('discounts-lowest-product.index') }}">Produk Kurang Laris</a></li>
                    <li class="breadcrumb-item text-capitalize active" aria-current="page">Tambah Data</li>
                </ul>
            </nav>
        </div>

        <a href="{{ route('discounts-lowest-product.index') }}" class="btn btn-warning btn-sm mt-4"><i class="fa-solid fa-arrow-left"></i> Kembali</a>

        <div class="col-lg-8 mt-4">
            <div class="card">
                <div class="container">
                    <div class="card-body">
                        <form action="{{ route('discounts-lowest-product.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Produk <span class="text-danger">*</span></label>
                                        <select name="product" id="product" class="form-control select2 @error('product') is-invalid @enderror">
                                            <option value="">Pilih Produk</option>
                                            @foreach ($orders as $order)
                                                <option value="{{ $order->product_id }}"
                                                    {{ old('product') == $order->product_id ? 'selected' : '' }}>
                                                    {{ $order->product->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('product')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div><!--end col-->
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Diskon<span class="text-danger">*</span></label>
                                        <div class="row">
                                            <div class="col-9 col-sm-10 mb-2">
                                                <input name="discount_percentage" id="discount_percentage" type="number" class="form-control @error('discount_percentage') is-invalid @enderror" placeholder="Contoh : 20" value="{{ old('discount_percentage') }}">
                                                @error('discount_percentage')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-3 col-sm-2">
                                                <input type="text" class="form-control" value="%" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div><!--end col-->
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Tanggal Mulai <span class="text-danger">*</span></label>
                                        <input name="start_date" id="start_date" type="date" class="form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date') }}">
                                        @error('start_date')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div><!--end col-->
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Tanggal Berakhir <span class="text-danger">*</span></label>
                                        <input name="end_date" id="end_date" type="date" class="form-control @error('end_date') is-invalid @enderror" value="{{ old('end_date') }}">
                                        @error('end_date')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div><!--end col-->
                            <div class="row">
                                <div class="col-sm-12">
                                    <input type="submit" id="submit" name="send" class="btn btn-primary" value="Simpan">
                                </div><!--end col-->
                            </div><!--end row-->
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
</div><!--end container-->
@endsection

@section('javascript')
<script src="{{ asset('backend') }}/libs/select2/select2.min.js"></script>
<script>
    // show select2
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@endsection
