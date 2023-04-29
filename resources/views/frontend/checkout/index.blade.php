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
                    <h4 class="title mb-0"> Checkout </h4>
                </div>
            </div><!--end col-->
        </div><!--end row-->

        <div class="position-breadcrumb">
            <nav aria-label="breadcrumb" class="d-inline-block">
                <ul class="breadcrumb rounded shadow mb-0 px-4 py-2">
                    <li class="breadcrumb-item"><a href="{{ route('/') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('carts.index') }}">Keranjang</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
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
<!-- Start -->
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-lg-4 order-md-last">
                <div class="card rounded shadow p-4 border-0">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="h5 mb-0">Pesanan</span>
                        <span class="badge bg-primary rounded-pill">{{ $order_details->count() }}</span>
                    </div>
                    <ul class="list-group mb-3 border">
                        @foreach ($order_details as $order_detail)
                            <li class="d-flex justify-content-between lh-sm p-3 border-bottom">
                                <div>
                                    <h6 class="my-0">{{ $order_detail->product->name }}</h6>
                                    <small class="text-muted">
                                        @if ($order_detail->size && $order_detail->color != '')
                                            {{ $order_detail->size }}, {{ $order_detail->color }}, {{ $order_detail->quantity }}x
                                        @elseif ($order_detail->size != '')
                                            {{ $order_detail->size }}, {{ $order_detail->quantity }}x
                                        @elseif ( $order_detail->color != '')
                                            {{ $order_detail->color }}, {{ $order_detail->quantity }}x
                                        @endif
                                    </small>
                                </div>
                                <span class="text-muted">Rp {{ number_format($order_detail->total, 0, ',', '.') }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <ul class="list-group mb-3 border">
                        <li class="d-flex justify-content-between lh-sm p-3 border-bottom">
                            <div><h6 class="my-0">Subtotal</h6></div>
                            <span class="text-muted">Rp {{ number_format($order_detail->order->subtotal, 0, ',', '.') }}</span>
                        </li>
                        <li class="d-flex justify-content-between lh-sm p-3 border-bottom">

                            <div><h6 class="my-0">Ongkos Kirim</h6></div>
                            <span class="text-muted">Rp {{ number_format($total_shipping_cost, 0, ',', '.') }}</span>
                        </li>
                        <li class="d-flex justify-content-between lh-sm p-3 border-bottom">
                            <div><h6 class="my-0">Total</h6></div>
                            <span class="text-muted">Rp {{ number_format($amount, 0, ',', '.') }}</span>
                        </li>
                    </ul>
                </div>
            </div><!--end col-->

            <div class="col-md-7 col-lg-8">
                <div class="card rounded shadow p-4 border-0">
                    <h4 class="mb-3">Alamat saya</h4>
                    <form action="{{ route('checkout.payment') }}" method="POST" id="form">
                        @csrf
                        <div class="row g-3 mb-3">
                            <div class="col-12">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Nama Lengkap" value="{{ $user->name }}">
                                <span class="invalid-feedback"></span>
                            </div>

                            <div class="col-12">
                                <label for="telephone" class="form-label">Telepon</label>
                                <input type="number" class="form-control" id="telephone" name="telephone" value="{{ $user->telephone }}" placeholder="Telepon">
                                <span class="invalid-feedback"></span>
                            </div>

                            <div class="col-12">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" placeholder="you@example.com" readonly>
                                <span class="invalid-feedback"></span>
                            </div>

                            <div class="col-12">
                                <label for="address" class="form-label">Alamat</label>
                                <input type="text" class="form-control" id="address" name="address" value="{{ $user->address }}" placeholder="Alamat">
                                <span class="invalid-feedback"></span>
                            </div>

                            <div class="col-md-6">
                                <label for="province" class="form-label">Provinsi</label>
                                <input type="text" class="form-control" id="province" name="province" value="{{ $user->province }}" placeholder="Provinsi">
                                <span class="invalid-feedback"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="city" class="form-label">Kabupaten/Kota</label>
                                <input type="text" class="form-control" id="city" name="city" value="{{ $user->city }}" placeholder="Kota">
                                <span class="invalid-feedback"></span>
                            </div>

                            <div class="col-md-6">
                                <label for="subdistrict" class="form-label">Kecamatan</label>
                                <input type="text" class="form-control" id="subdistrict" name="subdistrict" value="{{ $user->subdistrict }}" placeholder="Kecamatan">
                                <span class="invalid-feedback"></span>
                            </div>

                            <div class="col-md-6">
                                <label for="village" class="form-label">Desa/Kelurahan</label>
                                <input type="text" class="form-control" id="village" name="village" value="{{ $user->village }}" placeholder="Desa">
                                <span class="invalid-feedback"></span>
                            </div>

                            <div class="col-md-6">
                                <label for="postal_code" class="form-label">Kode Pos</label>
                                <input type="number" class="form-control" id="postal_code" name="postal_code" value="{{ $user->postal_code }}" placeholder="Kode Pos">
                                <span class="invalid-feedback"></span>
                            </div>
                        </div>
                    </form>
                    <button class="w-100 btn btn-primary" id="checkout">Lanjutkan checkout</button>
                </div>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
</section><!--end section-->
<!-- End -->
@endsection

@section('javascript')
<!-- Sweat Alert -->
<script src="{{ asset('backend') }}/libs/sweetalert2/sweetalert2.min.js"></script>
<!-- TODO: Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.server_key') }}"></script>
<script type="text/javascript">

    document.getElementById('checkout').addEventListener('click', function(event){
        // prevent form from submitting
        event.preventDefault();

        // get input values
        var nameInput = document.getElementById('name');
        var telephoneInput = document.getElementById('telephone');
        var addressInput = document.getElementById('address');
        var provinceInput = document.getElementById('province');
        var cityInput = document.getElementById('city');
        var subdistrictInput = document.getElementById('subdistrict');
        var villageInput = document.getElementById('village');
        var postalCodeInput = document.getElementById('postal_code');

        // validation
        if (nameInput.value.trim() == '') {
            errorMessage = "Nama Lengkap is required. ";
            nameInput.classList.add('is-invalid');
            nameInput.nextElementSibling.innerHTML = errorMessage;
            nameInput.nextElementSibling.classList.add('invalid-feedback');
        } else {
            nameInput.classList.remove('is-invalid');
        }
        if (telephoneInput.value.trim() == '') {
            errorMessage = "Telepon is required. ";
            telephoneInput.classList.add('is-invalid');
            telephoneInput.nextElementSibling.innerHTML = errorMessage;
            telephoneInput.nextElementSibling.classList.add('invalid-feedback');
        } else {
            telephoneInput.classList.remove('is-invalid');
        }
        if (addressInput.value.trim() == '') {
            errorMessage = "Alamat is required. ";
            addressInput.classList.add('is-invalid');
            addressInput.nextElementSibling.innerHTML = errorMessage;
            addressInput.nextElementSibling.classList.add('invalid-feedback');
        } else {
            addressInput.classList.remove('is-invalid');
        }
        if (provinceInput.value.trim() == '') {
            errorMessage = "Provinsi is required. ";
            provinceInput.classList.add('is-invalid');
            provinceInput.nextElementSibling.innerHTML = errorMessage;
            provinceInput.nextElementSibling.classList.add('invalid-feedback');
        } else {
            provinceInput.classList.remove('is-invalid');
        }
        if (cityInput.value.trim() == '') {
            errorMessage = "Kabupaten/Kota is required. ";
            cityInput.classList.add('is-invalid');
            cityInput.nextElementSibling.innerHTML = errorMessage;
            cityInput.nextElementSibling.classList.add('invalid-feedback');
        } else {
            cityInput.classList.remove('is-invalid');
        }
        if (subdistrictInput.value.trim() == '') {
            errorMessage = "Kecamatan is required. ";
            subdistrictInput.classList.add('is-invalid');
            subdistrictInput.nextElementSibling.innerHTML = errorMessage;
            subdistrictInput.nextElementSibling.classList.add('invalid-feedback');
        } else {
            subdistrictInput.classList.remove('is-invalid');
        }
        if (villageInput.value.trim() == '') {
            errorMessage = "Desa/Kelurahan is required. ";
            villageInput.classList.add('is-invalid');
            villageInput.nextElementSibling.innerHTML = errorMessage;
            villageInput.nextElementSibling.classList.add('invalid-feedback');
        } else {
            villageInput.classList.remove('is-invalid');
        }
        if (postalCodeInput.value.trim() == '') {
            errorMessage = "Kode Pos is required. ";
            postalCodeInput.classList.add('is-invalid');
            postalCodeInput.nextElementSibling.innerHTML = errorMessage;
                postalCodeInput.nextElementSibling.classList.add('invalid-feedback');
        } else {
            postalCodeInput.classList.remove('is-invalid');
        }

        // check if all fields are valid
        var isFormValid = !document.querySelector('.is-invalid');

        // insert data to server if form is valid
        if (isFormValid) {
            $.ajax({
                type: "post",
                url: "checkout",
                data: {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    "name": nameInput.value,
                    "telephone": telephoneInput.value,
                    "address": addressInput.value,
                    "province": provinceInput.value,
                    "city": cityInput.value,
                    "subdistrict": subdistrictInput.value,
                    "village": villageInput.value,
                    "postal_code": postalCodeInput.value,
                },
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        // SnapToken acquired from previous step
                        snap.pay('{{ $snap_token }}', {
                            // Optional
                            onSuccess: function(result){
                                $.ajax({
                                    url: 'payment',
                                    type: 'POST',
                                    data: {
                                        "_token": $('meta[name="csrf-token"]').attr('content'),
                                        "status": 'success',
                                        "order_id": result.order_id,
                                        "payment_type": result.payment_type,
                                        "bank": result.va_numbers[0].bank,
                                        "va_number": result.va_numbers[0].va_number,
                                        "gross_amount": result.gross_amount,
                                        "transaction_status": result.transaction_status,
                                        "expired": result.transaction_time,
                                    },
                                    success: function(response) {
                                        swal.fire({
                                            icon: "success",
                                            title: "Berhasil",
                                            text: response.message,
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                location.reload();
                                            }
                                        });
                                    },
                                    error: function(xhr, status, error) {
                                        swal.fire({
                                            icon: "error",
                                            title: "Gagal",
                                            text: "Terjadi kesalahan! " + error,
                                        });
                                    }
                                });
                            },
                            // Optional
                            onPending: function(result){
                                // console.log(result);
                                $.ajax({
                                    url: 'payment',
                                    type: 'POST',
                                    data: {
                                        "_token": $('meta[name="csrf-token"]').attr('content'),
                                        "status": 'pending',
                                        "order_id": result.order_id,
                                        "payment_type": result.payment_type,
                                        "bank": result.va_numbers[0].bank,
                                        "va_number": result.va_numbers[0].va_number,
                                        "gross_amount": result.gross_amount,
                                        "transaction_status": result.transaction_status,
                                        "expired": result.transaction_time,
                                    },
                                    success: function(response) {
                                        swal.fire({
                                            icon: "success",
                                            title: "Berhasil",
                                            text: response.message + " Silahkan lakukan pembayaran",
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                window.location.href = "{{ route('history.not-yet-paid') }}";
                                            }
                                        });
                                    },
                                    error: function(xhr, status, error) {
                                        swal.fire({
                                            icon: "error",
                                            title: "Gagal",
                                            text: "Terjadi kesalahan! " + error,
                                        });
                                    }
                                });
                            },
                            // Optional
                            onError: function(result){
                                $.ajax({
                                    url: 'payment',
                                    type: 'POST',
                                    data: {
                                        "_token": $('meta[name="csrf-token"]').attr('content'),
                                        "status": 'error',
                                        "order_id": result.order_id,
                                        "payment_type": result.payment_type,
                                        "bank": result.va_numbers[0].bank,
                                        "va_number": result.va_numbers[0].va_number,
                                        "gross_amount": result.gross_amount,
                                        "transaction_status": result.transaction_status,
                                        "expired": result.transaction_time,
                                    },
                                    success: function(response) {
                                        swal.fire({
                                            icon: "success",
                                            title: "Berhasil",
                                            text: response.message,
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                location.reload();
                                            }
                                        });
                                    },
                                    error: function(xhr, status, error) {
                                        swal.fire({
                                            icon: "error",
                                            title: "Gagal",
                                            text: "Terjadi kesalahan! " + error,
                                        });
                                    }
                                });
                            },
                            onClose: function(){
                                swal.fire({
                                    icon: "warning",
                                    title: "Peringatan!",
                                    text: "Anda menutup popup tanpa menyelesaikan pembayaran",
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        location.reload();
                                    }
                                });
                            }
                        });
                    }
                },
                error: function(xhr, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        }
    });
</script>
@endsection
