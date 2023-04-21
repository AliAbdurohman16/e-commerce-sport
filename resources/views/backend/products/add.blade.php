@extends('layouts.backend.main')

@section('title', 'Produk')

@section('css')
<!-- Datatables -->
<link rel="stylesheet" href="{{ asset('backend') }}/libs/data-tables/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="{{ asset('backend') }}/libs/data-tables/css/responsive.bootstrap5.min.css">
<link rel="stylesheet" href="{{ asset('backend') }}/libs/sweetalert2/sweetalert2.min.css"/>
<link rel="stylesheet" href="{{ asset('backend') }}/libs/tagsinput/tagsinput.css"/>
<link rel="stylesheet" href="{{ asset('backend') }}/css/tag-input.css"/>
<link rel="stylesheet" href="{{ asset('backend') }}/libs/select2/select2.min.css"/>
<link rel="stylesheet" href="{{ asset('backend') }}/css/select2.css"/>
@endsection

@section('content')
<div class="container-fluid">
    <div class="layout-specing">
        <div class="d-md-flex justify-content-between align-items-center">
            <h5 class="mb-0">Produk</h5>

            <nav aria-label="breadcrumb" class="d-inline-block">
                <ul class="breadcrumb bg-transparent rounded mb-0 p-0">
                    <li class="breadcrumb-item text-capitalize"><a href="{{ route('products.index') }}">Produk</a></li>
                    <li class="breadcrumb-item text-capitalize active" aria-current="page">Tambah Data</li>
                </ul>
            </nav>
        </div>

        <a href="{{ route('products.index') }}" class="btn btn-warning btn-sm mt-4"><i class="fa-solid fa-arrow-left"></i> Kembali</a>

        <div class="col-lg-12 mt-4">
            <div class="card">
                <div class="container">
                    <div class="card-body">
                        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Foto <span class="text-danger">*</span></label>
                                        <input name="image[]" id="image" type="file" class="form-control @error('image') is-invalid @enderror" multiple>
                                        @error('image')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div><!--end col-->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Produk <span class="text-danger">*</span></label>
                                        <input name="name" id="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nama Produk" value="{{ old('name') }}">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div><!--end col-->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Kategori <span class="text-danger">*</span></label>
                                        <select name="category" id="category" class="form-control select2 @error('category') is-invalid @enderror">
                                            <option value="">Pilih Kategori</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('category') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div><!--end col-->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Berat Barang <span class="text-danger">*</span></label>
                                        <div class="row">
                                            <div class="col-7 col-sm-8 mb-2">
                                                <input name="weight" id="weight" type="number" class="form-control @error('weight') is-invalid @enderror" placeholder="Berat Barang" value="{{ old('weight') }}">
                                                @error('weight')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-5 col-sm-4">
                                                <select name="unit" id="unit" class="form-control @error('unit') is-invalid @enderror">
                                                    <option value="">Pilih Satuan</option>
                                                    <option value="g" {{ old('unit') == 'g' ? 'selected' : '' }}>g</option>
                                                    <option value="kg" {{ old('unit') == 'kg' ? 'selected' : '' }}>kg</option>
                                                    <option value="ons" {{ old('unit') == 'ons' ? 'selected' : '' }}>ons</option>
                                                    <option value="pon" {{ old('unit') == 'pon' ? 'selected' : '' }}>pon</option>
                                                    <option value="lb" {{ old('unit') == 'lb' ? 'selected' : '' }}>lb</option>
                                                    <option value="oz" {{ old('unit') == 'oz' ? 'selected' : '' }}>oz</option>
                                                </select>
                                            </div>
                                            @error('unit')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div><!--end col-->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Harga <span class="text-danger">*</span></label>
                                        <input name="price" id="price" type="text" class="form-control @error('price') is-invalid @enderror" placeholder="Harga" value="{{ old('price') }}">
                                        @error('price')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div><!--end col-->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Stok <span class="text-danger">*</span></label>
                                        <input name="stock" id="stock" type="number" class="form-control @error('stock') is-invalid @enderror" placeholder="Stok" value="{{ old('stock') }}">
                                        @error('stock')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div><!--end col-->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Ukuran (Opsional)</label>
                                        <input name="sizes" id="sizes" type="text" class="form-control" value="{{ old('sizes') }}" data-role="tagsinput">
                                    </div>
                                </div><!--end col-->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Warna (Opsional)</label>
                                        <input name="colors" id="colors" type="text" class="form-control" value="{{ old('colors') }}" data-role="tagsinput">
                                    </div>
                                </div><!--end col-->
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Deskripsi Produk</label>
                                        <textarea name="description" id="description" rows="4" class="form-control @error('description') is-invalid @enderror" placeholder="Deskripsi Produk">{{ old('description') }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div><!--end row-->
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
<!-- Datatables -->
<script src="{{ asset('backend') }}/libs/data-tables/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('backend') }}/libs/data-tables/js/dataTables.bootstrap5.min.js"></script>
<script src="{{ asset('backend') }}/libs/data-tables/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('backend') }}/libs/data-tables/js/responsive.bootstrap5.min.js"></script>
<script src="{{ asset('backend') }}/libs/sweetalert2/sweetalert2.min.js"></script>
<script src="{{ asset('backend') }}/libs/tagsinput/tagsinput.min.js"></script>
<script src="{{ asset('backend') }}/libs/autoNumeric/autoNumeric.min.js"></script>
<script src="{{ asset('backend') }}/libs/select2/select2.min.js"></script>
<script>
    // show select2
    $(document).ready(function() {
        $('.select2').select2();
    });

    // show price to IDR
    new AutoNumeric('#price', {
        currencySymbol : 'Rp ',
        decimalCharacter : ',',
        digitGroupSeparator : '.',
        decimalPlaces: 0,
    });
</script>
@endsection
