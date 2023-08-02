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
                    <h4 class="title mb-0"> Riwayat Pesanan </h4>
                </div>
            </div><!--end col-->
        </div><!--end row-->

        <div class="position-breadcrumb">
            <nav aria-label="breadcrumb" class="d-inline-block">
                <ul class="breadcrumb rounded shadow mb-0 px-4 py-2">
                    <li class="breadcrumb-item"><a href="{{ route('/') }}">Beranda</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Riwayat Pesanan</li>
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
                <div class="shadow rounded p-4">
                    <div class="table-responsive bg-white shadow rounded">
                        <table class="table mb-0 table-center table-nowrap">
                            <thead>
                                <tr>
                                    <th scope="col" class="border-bottom">Order no.</th>
                                    <th scope="col" class="border-bottom">Nama Produk</th>
                                    <th scope="col" class="border-bottom">Tanggal</th>
                                    <th scope="col" class="border-bottom">Status</th>
                                    <th scope="col" class="border-bottom">Total</th>
                                    <th scope="col" class="border-bottom">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $transaction)
                                    @if ($transaction->order->orderDetails)
                                        @foreach ($transaction->order->orderDetails as $order)
                                            <tr>
                                                <th scope="row">{{ $transaction->order_id }}</th>
                                                <td>
                                                    {{ $order->product->name }}
                                                        @if ($order->size && $order->color != '')
                                                        ({{ $order->size }}, {{ $order->color }}, x{{ $order->quantity }})
                                                    @elseif ($order->size != '')
                                                        ({{ $order->size }}, x{{ $order->quantity }})
                                                    @elseif ($order->color != '')
                                                        ({{ $order->color }}, x{{ $order->quantity }})
                                                    @endif

                                                </td>
                                                <td>{{ date('d-m-Y', strtotime($transaction->created_at)) }}</td>
                                                <td class="{{ $transaction->order->status == 'Dalam Pengiriman' ? 'text-success' : ($transaction->order->status == 'Pesanan Diterima' ? 'text-primary' : ($transaction->order->status == 'Pesanan Gagal' ? 'text-danger' : 'text-muted')) }}">
                                                    {{ $transaction->order->status }}
                                                </td>
                                                <td>Rp {{ number_format($transaction->gross_amount, 0, ',', '.') }}</td>
                                                <td>
                                                    <a href="javascript:void(0)" class="text-primary" data-bs-toggle="modal" data-bs-target="#detail{{ $order->product_id }}">Detail <i class="uil uil-arrow-right"></i></a><br>
                                                    @if ($transaction->order->status == 'Pesanan Diterima')
                                                        @if ($order->review == null)
                                                            <a href="javascript:void(0)" class="text-primary" data-bs-toggle="modal" data-bs-target="#review{{ $order->product_id }}">Review <i class="uil uil-arrow-right"></i></a>
                                                        @endif
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div><!--end teb pane-->
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
</section><!--end section-->
<!-- End -->
<!-- Modal Detail -->
@foreach ($transactions as $transaction)
    @if ($transaction->order->orderDetails)
        @foreach ($transaction->order->orderDetails as $order)
        <div class="modal fade" id="detail{{ $order->product_id }}" tabindex="-1" aria-labelledby="LoginForm-title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded shadow border-0">
                    <div class="modal-header border-bottom">
                        <h5 class="modal-title" id="LoginForm-title">Data Pesanan</h5>
                        <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal" id="close-modal"><i class="uil uil-times fs-4 text-dark"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                @if ($transaction->order->status == 'Dalam Pengiriman')
                                    <div class="alert alert-primary">
                                        Estimasi pengiriman paket anda akan sampai pada tanggal {{ date('d-m-Y, H:i', strtotime($transaction->order->shippings->first()->estimation)) }}.
                                    </div>
                                @endif

                                <div class="container">
                                    <div class="row">
                                        <div class="col-4">
                                            <label for="">Produk</label>
                                        </div>
                                        <div class="col-1">:</div>
                                        <div class="col-7">
                                            {{ $order->product->name }}
                                            @if ($order->size && $order->color != '')
                                                ({{ $order->size }}, {{ $order->color }}, x{{ $order->quantity }})
                                            @elseif ($order->size != '')
                                                ({{ $order->size }}, x{{ $order->quantity }})
                                            @elseif ($order->color != '')
                                                ({{ $order->color }}, x{{ $order->quantity }})
                                            @endif
                                        </div>

                                        <div class="col-4">
                                            <label for="">Tanggal Pesanan</label>
                                        </div>
                                        <div class="col-1">:</div>
                                        <div class="col-7">
                                            {{ date('H:i, d-m-Y', strtotime($transaction->created_at)) }}
                                        </div>

                                        @if ($transaction->order->status != 'Dalam Proses' && $transaction->order->status != 'Pesanan Gagal' && $transaction->order->status != 'Dibatalkan')
                                            <div class="col-4">
                                                <label for="">No Resi</label>
                                            </div>
                                            <div class="col-1">:</div>
                                            <div class="col-7">
                                                {{ $transaction->order->shippings->first()->resi }}
                                            </div>

                                            <div class="col-4">
                                                <label for="">Jasa Pengiriman</label>
                                            </div>
                                            <div class="col-1">:</div>
                                            <div class="col-7">
                                                {{ $transaction->order->shippings->first()->provider }}
                                            </div>

                                            <div class="col-4">
                                                <label for="">Tanggal Dikirim</label>
                                            </div>
                                            <div class="col-1">:</div>
                                            <div class="col-7">
                                                {{ date('H:i, d-m-Y', strtotime($transaction->order->updated_at)) }}
                                            </div>
                                        @endif

                                        @if ($transaction->order->status == 'Pesanan Gagal')
                                            <div class="col-4">
                                                <label for="">Tanggal Gagal</label>
                                            </div>
                                            <div class="col-1">:</div>
                                            <div class="col-7">
                                                {{ date('H:i, d-m-Y', strtotime($transaction->updated_at)) }}
                                            </div>
                                        @endif

                                        @if ($transaction->order->status == 'Pesanan Diterima')
                                            <div class="col-4">
                                                <label for="">Tanggal Diterima</label>
                                            </div>
                                            <div class="col-1">:</div>
                                            <div class="col-7">
                                                {{ date('H:i, d-m-Y', strtotime($transaction->order->updated_at)) }}
                                            </div>
                                        @endif

                                        <div class="col-4">
                                            <label for="">Total</label>
                                        </div>
                                        <div class="col-1">:</div>
                                        <div class="col-7">
                                            Rp {{ number_format($transaction->gross_amount, 0, ',', '.') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        @if ($transaction->order->status == 'Dalam Pengiriman')
                            <form action="{{ route('received') }}" method="post">
                                @csrf
                                <input type="hidden" name="order_id" value="{{ $transaction->order_id }}">
                                <button type="submit" class="btn btn-primary">Diterima</button>
                            </form>
                        @endif
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    @endif
@endforeach
<!-- Modal Detail End -->

<!-- Modal Review -->
@foreach ($transactions as $transaction)
    @if ($transaction->order->orderDetails)
        @foreach ($transaction->order->orderDetails as $order)
            <div class="modal fade" id="review{{ $order->product_id }}" tabindex="-1" aria-labelledby="LoginForm-title" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded shadow border-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="LoginForm-title">Review</h5>
                            <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal" id="close-modal"><i class="uil uil-times fs-4 text-dark"></i></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <input type="hidden" id="order_id" name="order_id" value="{{ $order->order_id }}">
                                        <div class="col-12">
                                            <div class="text-center">
                                                <ul class="list-unstyled mb-0">
                                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(1, {{ $order->product_id }})"></i></li>
                                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(2, {{ $order->product_id }})"></i></li>
                                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(3, {{ $order->product_id }})"></i></li>
                                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(4, {{ $order->product_id }})"></i></li>
                                                    <li class="list-inline-item"><i class="mdi mdi-star icon-large text-muted" onclick="setRating(5, {{ $order->product_id }})"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <div class="mb-3">
                                                <div class="form-icon position-relative">
                                                    <i data-feather="message-circle" class="fea icon-sm icons"></i>
                                                    <textarea id="comment_{{ $order->product_id }}" placeholder="Komentar" rows="5" name="comment" class="form-control ps-5"></textarea>
                                                </div>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-md-12">
                                            <div class="send d-grid">
                                                <button type="button" class="btn btn-primary btn-submit" data-id="{{ $order->product_id }}">Submit</button>
                                            </div>
                                        </div><!--end col-->
                                    </div><!--end row-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
@endforeach
<!-- Modal Review End -->
@endsection

@section('javascript')
<script src="{{ asset('backend') }}/libs/sweetalert2/sweetalert2.min.js"></script>
<script>
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

    let currentRating = 0;

    function setRating(rating, productId) {
        const stars = document.querySelectorAll(`#review${productId} .icon-large`);

        // Highlight the selected stars
        for (let i = 0; i < rating; i++) {
            stars[i].classList.remove("text-muted");
            stars[i].classList.add("text-warning");
        }

        // Dim the stars after the selected ones
        for (let i = rating; i < stars.length; i++) {
            stars[i].classList.remove("text-warning");
            stars[i].classList.add("text-muted");
        }

        // Update the current rating
        currentRating = rating;
    }

    function resetRating() {
        const stars = document.querySelectorAll(".icon-large");
        for (let i = 0; i < stars.length; i++) {
            if (i < currentRating) {
                stars[i].classList.remove("text-muted");
                stars[i].classList.add("text-warning");
            } else {
                stars[i].classList.remove("text-warning");
                stars[i].classList.add("text-muted");
            }
        }
        currentRating = 0;
    }

    $(".btn-submit").click(function() {
        if (currentRating !== 0) {
            let id = $(this).data("id");
            const orderId = $("#order_id").val();
            const comment = $("#comment_" + id).val();
            // Assuming you have an AJAX call to save the rating for the current question
            $.ajax({
                url: 'review/' + id,
                type: 'PUT',
                data: {
                    "id": id,
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    rating: currentRating,
                    order_id: orderId,
                    comment: comment,
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.message,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error saving rating:', error);
                    console.log('Status:', xhr.status);
                    console.log('Status Text:', xhr.statusText);
                    console.log('Response Text:', xhr.responseText);
                }
            });
        }
    });

    // Handle modal 'hidden' event to reset the rating when modal is closed
    $('.modal').on('hidden.bs.modal', function () {
        resetRating();
    });
</script>
@endsection
