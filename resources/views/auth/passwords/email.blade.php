@extends('layouts.auth.main')

@section('title', 'Lupa Kata Sandi')

@section('content')
<!-- Hero Start -->
<section class="bg-auth-home d-table w-100">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7 col-md-6 mb-4">
                <div class="me-lg-5">
                    <img src="{{ asset('frontend') }}/images/user/forgot.svg" class="img-fluid d-block mx-auto" width="75%" alt="">
                </div>
            </div>
            <div class="col-lg-5 col-md-6">
                <div class="card login-page shadow rounded border-0">
                    <div class="card-body">
                        <h4 class="card-title text-center">Lupa Kata Sandi</h4>

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form class="login-form mt-4" action="{{ route('password.email') }}" method="POST">
                            @csrf
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
                                <div class="col-lg-12 mb-0">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary">Kirim</button>
                                    </div>
                                </div><!--end col-->

                                <div class="col-12 text-center">
                                    <p class="mb-0 mt-3"><small class="text-dark me-2">Ingat kata sandi anda ?</small> <a href="{{ route('login') }}" class="text-dark fw-bold">Masuk</a></p>
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

