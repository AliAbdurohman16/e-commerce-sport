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
                    <h4 class="title mb-0"> Riwayat Pembayaran </h4>
                </div>
            </div><!--end col-->
        </div><!--end row-->

        <div class="position-breadcrumb">
            <nav aria-label="breadcrumb" class="d-inline-block">
                <ul class="breadcrumb rounded shadow mb-0 px-4 py-2">
                    <li class="breadcrumb-item"><a href="{{ route('/') }}">Beranda</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Riwayat Pembayaran</li>
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
                                    @foreach ($transactions as $transaction)
                                        @if ($transaction->status == 'belum bayar')
                                            <th scope="col" class="border-bottom">Total</th>
                                        @endif
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $transaction)
                                <tr>
                                    <th scope="row">{{ $transaction->order_id }}</th>
                                    <td>
                                        @if ($transaction->order->orderDetails->count() > 0)
                                            @foreach ($transaction->order->orderDetails as $order)
                                                {{ $order->product->name }}
                                                @if ($order->size && $order->color != '')
                                                    ({{ $order->size }}, {{ $order->color }}, x{{ $order->quantity }})
                                                @elseif ($order->size != '')
                                                    ({{ $order->size }}, x{{ $order->quantity }})
                                                @elseif ($order->color != '')
                                                    ({{ $order->color }}, x{{ $order->quantity }})
                                                @endif
                                                <br>
                                            @endforeach
                                        @endif

                                    </td>
                                    <td>
                                        {{ $transaction->status == 'pending' ? date('d/m/Y H:i', strtotime($transaction->created_at)) : date('d/m/Y H:i', strtotime($transaction->updated_at)) }}
                                    </td>
                                    <td class="{{ $transaction->status == 'success' ? 'text-success' : ($transaction->status == 'rejected' ? 'text-danger' : ($transaction->status == 'expired' ? 'text-danger' : 'text-muted')) }}">
                                        {{ $transaction->status == 'success' ? 'Sukses' : ($transaction->status == 'rejected' ? 'Gagal' : ($transaction->status == 'expired' ? 'Expired' : ucfirst($transaction->status))) }}
                                    </td>
                                    <td>Rp {{ number_format($transaction->gross_amount, 0, ',', '.') }}</td>
                                    @foreach ($transactions as $transaction)
                                        @if ($transaction->status == 'belum bayar')
                                            <td><a href="{{ route('payment', $transaction->id) }}" class="btn btn-sm btn-primary">Bayar</a></td>
                                        @endif
                                    @endforeach
                                </tr>
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
@endsection

@section('javascript')
<!-- Sweat Alert -->
<script src="{{ asset('backend') }}/libs/sweetalert2/sweetalert2.min.js"></script>
<script type="text/javascript">
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
