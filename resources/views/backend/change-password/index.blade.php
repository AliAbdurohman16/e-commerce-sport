@extends('layouts.backend.main')

@section('title', 'Ganti Kata Sandi')

@section('css')
<!-- Datatables -->
<link rel="stylesheet" href="{{ asset('backend') }}/libs/sweetalert2/sweetalert2.min.css"/>
@endsection

@section('content')
<div class="container-fluid">
    <div class="layout-specing">
        <div class="d-md-flex justify-content-between align-items-center">
            <h5 class="mb-0">Ganti Kata Sandi</h5>

            <nav aria-label="breadcrumb" class="d-inline-block">
                <ul class="breadcrumb bg-transparent rounded mb-0 p-0">
                    <li class="breadcrumb-item text-capitalize"><a href="#">Ganti Kata Sandi</a></li>
                    <li class="breadcrumb-item text-capitalize active" aria-current="page">Ubah Data</li>
                </ul>
            </nav>
        </div>

        <div class="row">
            <div class="col-6 mt-4">
                <div class="card border-0 rounded shadow p-4">
                    <form action="{{ route('change-password.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label">Email <span class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        <i data-feather="mail" class="fea icon-sm icons"></i>
                                        <input type="email" class="form-control ps-5 @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email">
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
                                    <label class="form-label">Kata sandi baru <span class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        <i data-feather="key" class="fea icon-sm icons"></i>
                                        <input type="password" class="form-control ps-5 @error('password') is-invalid @enderror" placeholder="Kata sandi baru" name="password" value="{{ old('password') }}" required autocomplete="new-password">
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
                                    <label class="form-label">Konfirmasi kata sandi <span class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        <i data-feather="key" class="fea icon-sm icons"></i>
                                        <input type="password" class="form-control ps-5" placeholder="Konfirmasi kata sandi" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>
                            </div><!--end col-->

                            <div class="col-lg-12 mt-2 mb-0">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div><!--end col-->
                        </div><!--end row-->
                    </form>
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
<script src="{{ asset('backend') }}/libs/sweetalert2/sweetalert2.min.js"></script>
<script>
    // show dialog success
    @if (Session::has('message'))
        swal.fire({
            icon: "success",
            title: "Berhasil",
            text: "{{ Session::get('message') }}",
        }).then((result) => {
            if (result.isConfirmed) {
                location.reload();
            }
        });
    @elseif (Session::has('error'))
        swal.fire({
            icon: "error",
            title: "Gagal",
            text: "{{ Session::get('message') }}",
        }).then((result) => {
            if (result.isConfirmed) {
                location.reload();
            }
        });
    @endif
</script>
@endsection
