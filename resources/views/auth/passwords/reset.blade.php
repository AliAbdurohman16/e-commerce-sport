@extends('layouts.auth.main')

@section('title', 'Setel Ulang Kata Sandi')

@section('content')
<div class="back-to-home">
    <a href="{{ route('/') }}" class="back-button btn btn-icon btn-primary"><i data-feather="arrow-left" class="icons"></i></a>
</div>

<!-- Hero Start -->
<section class="bg-auth-home d-table w-100">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7 col-md-6 mb-4">
                <div class="me-lg-5">
                    <img src="{{ asset('frontend') }}/images/user/reset.svg" class="img-fluid d-block mx-auto" width="55%" alt="">
                </div>
            </div>
            <div class="col-lg-5 col-md-6">
                <div class="card login-page shadow rounded border-0">
                    <div class="card-body">
                        <h4 class="card-title text-center">Masuk</h4>
                        <form class="login-form mt-4" action="{{ route('password.update') }}" method="POST">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label">Email <span class="text-danger">*</span></label>
                                        <div class="form-icon position-relative">
                                            <i data-feather="user" class="fea icon-sm icons"></i>
                                            <input type="email" class="form-control ps-5 @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div><!--end col-->

                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label">Kata Sandi <span class="text-danger">*</span></label>
                                        <div class="form-icon position-relative">
                                            <i data-feather="key" class="fea icon-sm icons"></i>
                                            <input type="password" class="form-control ps-5 @error('password') is-invalid @enderror" name="password" placeholder="Kata Sandi" required autocomplete="current-password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div><!--end col-->

                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label">Konfirmasi Kata Sandi <span class="text-danger">*</span></label>
                                        <div class="form-icon position-relative">
                                            <i data-feather="key" class="fea icon-sm icons"></i>
                                            <input type="password" class="form-control ps-5" name="password_confirmation" placeholder="Konfirmasi Kata Sandi" required autocomplete="new-password">
                                        </div>
                                    </div>
                                </div><!--end col-->

                                <div class="col-lg-12 mb-0">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary">Setel Ulang</button>
                                    </div>
                                </div><!--end col-->
                            </div><!--end row-->
                        </form>
                    </div>
                </div><!---->
            </div> <!--end col-->
        </div><!--end row-->
    </div> <!--end container-->
</section><!--end section-->
<!-- Hero End -->
@endsection
