@extends('layouts.auth.main')

@section('title', 'Verifikasi')

@section('content')
<!-- Hero Start -->
<section class="bg-home bg-primary d-flex align-items-center">
    <div class="bg-overlay bg-overlay-white"></div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card form-signin p-4 rounded shadow">
                    <div class="card-header">{{ __('Verifikasi alamat email anda') }}</div>

                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('Tautan verifikasi baru telah dikirim ke alamat email Anda.') }}
                            </div>
                        @endif

                        {{ __('Sebelum melanjutkan, periksa email Anda untuk tautan verifikasi.') }}
                        {{ __('Jika Anda tidak menerima email') }},
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('klik di sini untuk mengirim ulang') }}</button>.
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> <!--end container-->
</section><!--end section-->
<!-- Hero End -->
@endsection
