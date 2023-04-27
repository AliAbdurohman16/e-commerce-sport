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
                    <h4 class="title mb-0"> Akun </h4>
                </div>
            </div><!--end col-->
        </div><!--end row-->

        <div class="position-breadcrumb">
            <nav aria-label="breadcrumb" class="d-inline-block">
                <ul class="breadcrumb rounded shadow mb-0 px-4 py-2">
                    <li class="breadcrumb-item"><a href="{{ route('/') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('account.index') }}">Akun</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profil</li>
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
        <div class="row align-items-end">

            <div class="col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                <div class="d-flex align-items-center mb-5 mt-2">
                    @if ($user->image == 'default/user.png')
                        <img src="{{ $user->image }}" class="img-preview avatar avatar-md-md rounded-circle" alt="avatar">
                    @else
                        <img src="{{ asset('storage/users/' . $user->image ) }}" class="img-preview avatar avatar-md-md rounded-circle" alt="avatar">
                    @endif
                    <div class="ms-3">
                        <h6 class="text-muted mb-0">Halo,</h6>
                        <h5 class="mb-0">{{ $user->name }}</h5>
                    </div>
                </div>
                <div class="shadow rounded p-4" role="tabpanel" aria-labelledby="account-details">
                    <form action="{{ route('account.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Foto</label>
                                    <div class="form-icon position-relative">
                                        <input name="image" id="image" type="file" class="form-control @error('image') is-invalid @enderror" accept="image/*" onchange="previewImg()">
                                        @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div><!--end col-->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nama Lengkap</label>
                                    <div class="form-icon position-relative">
                                        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ $user->name }}">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div><!--end col-->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Telepon</label>
                                    <div class="form-icon position-relative">
                                        <input name="telephone" type="number" class="form-control @error('telephone') is-invalid @enderror" value="{{ $user->telephone }}">
                                        @error('telephone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div><!--end col-->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <div class="form-icon position-relative">
                                        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ $user->email }}">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div><!--end col-->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Provinsi</label>
                                    <div class="form-icon position-relative">
                                        <input name="province" type="text" class="form-control @error('province') is-invalid @enderror" value="{{ $user->province }}">
                                        @error('province')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div><!--end col-->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Kabupaten/Kota</label>
                                    <div class="form-icon position-relative">
                                        <input name="city" type="text" class="form-control @error('city') is-invalid @enderror" value="{{ $user->city }}">
                                        @error('city')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div><!--end col-->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Kecamatan</label>
                                    <div class="form-icon position-relative">
                                        <input name="subdistrict" type="text" class="form-control @error('subdistrict') is-invalid @enderror" value="{{ $user->subdistrict }}">
                                        @error('subdistrict')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div><!--end col-->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Desa/Kelurahan</label>
                                    <div class="form-icon position-relative">
                                        <input name="village" type="text" class="form-control @error('village') is-invalid @enderror" value="{{ $user->village }}">
                                        @error('village')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div><!--end col-->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Kode Pos</label>
                                    <div class="form-icon position-relative">
                                        <input name="postal_code" type="number" class="form-control @error('postal_code') is-invalid @enderror" value="{{ $user->postal_code }}">
                                        @error('postal_code')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div><!--end col-->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Alamat</label>
                                    <div class="form-icon position-relative">
                                        <input name="address" type="text" class="form-control @error('address') is-invalid @enderror" value="{{ $user->address }}">
                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div><!--end col-->

                            <div class="col-lg-12 mt-2 mb-0">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div><!--end col-->
                        </div><!--end row-->
                    </form>

                </div><!--end teb pane-->
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
</section><!--end section-->
<!-- End -->
@endsection

@section('javascript')
<!-- Sweat Alert -->
<script src="{{ asset('backend') }}/libs/sweetalert2/sweetalert2.min.js"></script>
<script>

    // function preview image
    function previewImg() {
        const logo = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');
        const fileImg = new FileReader();
        fileImg.readAsDataURL(logo.files[0]);
        fileImg.onload = function(e) {
            imgPreview.src = e.target.result;
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
    @endif
</script>
@endsection
