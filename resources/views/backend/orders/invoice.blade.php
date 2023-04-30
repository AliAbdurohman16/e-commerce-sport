@extends('layouts.backend.main')

@section('title', 'Orderan Diproses')

@section('content')
<div class="container-fluid">
    <div class="layout-specing">
        <div class="d-md-flex justify-content-between align-items-center">
            <h5 class="mb-0">Orderan Diproses</h5>

            <nav aria-label="breadcrumb" class="d-inline-block">
                <ul class="breadcrumb bg-transparent rounded mb-0 p-0">
                    <li class="breadcrumb-item text-capitalize"><a href="#">Orderan</a></li>
                    <li class="breadcrumb-item text-capitalize"><a href="#">Diproses</a></li>
                    <li class="breadcrumb-item text-capitalize active" aria-current="page">Invoice</li>
                </ul>
            </nav>
        </div>

        <div class="row mt-4">
            <div class="col">
                <div class="card shadow rounded border-0" id="print-section">
                    <div class="card-body">
                        <div class="invoice-top pb-4 border-bottom">
                            <div class="row">
                                <div class="col-xl-9 col-md-8">
                                    <div class="logo-invoice mb-2"><img src="{{ asset('backend') }}/images/logo-dark.png" height="24" alt=""></div>
                                </div><!--end col-->
                            </div><!--end row-->
                        </div>

                        <div class="invoice-middle py-4">
                            <h5>Invoice Detail :</h5>
                            <div class="row mb-0">
                                <div class="col-xl-7 col-md-8 order-2 order-md-1">
                                    <dl class="row">
                                        <dt class="col-md-3 col-5 fw-normal">Invoice No. :</dt>
                                        <dd class="col-md-9 col-7 text-muted">{{ $orderDetail->order_id }}</dd>

                                        <dt class="col-md-3 col-5 fw-normal">Nama :</dt>
                                        <dd class="col-md-9 col-7 text-muted">{{ $orderDetail->order->user->name }}</dd>

                                        <dt class="col-md-3 col-5 fw-normal">Alamat :</dt>
                                        <dd class="col-md-9 col-7 text-muted">
                                            <p class="mb-0">{{ $orderDetail->order->user->address }},</p>
                                            <p class="mb-0">{{ $orderDetail->order->user->postal_code }}</p>
                                        </dd>

                                        <dt class="col-md-3 col-5 fw-normal">No.Telp :</dt>
                                        <dd class="col-md-9 col-7 text-muted">{{ $orderDetail->order->user->telephone }}</dd>
                                    </dl>
                                </div>

                                <div class="col-xl-5 col-md-4 order-md-2 order-1 mt-2 mt-sm-0">
                                    <dl class="row mb-0">
                                        <dt class="col-md-6 col-5 fw-normal">Tanggal Pesanan :</dt>
                                        <dd class="col-md-6 col-7 text-muted">{{ date('d M Y, H:i', strtotime($orderDetail->created_at)) }}</dd>
                                        <dt class="col-md-6 col-5 fw-normal">Tanggal Pembayaran :</dt>
                                        <dd class="col-md-6 col-7 text-muted">{{ date('d M Y, H:i', strtotime($orderDetail->order->transactions->first()->updated_at)) }}</dd>
                                        <dt class="col-md-6 col-5 fw-normal">Metode Pembayaran :</dt>
                                        <dd class="col-md-6 col-7 text-muted">Transfer Bank</dd>
                                        <dt class="col-md-6 col-5 fw-normal">Nama Bank :</dt>
                                        <dd class="col-md-6 col-7 text-muted">{{ strtoupper($orderDetail->order->transactions->first()->bank) }}</dd>
                                        <dt class="col-md-6 col-5 fw-normal">Status:</dt>
                                        <dd class="col-md-6 col-7 text-muted">Sudah dibayar</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>

                        <div class="invoice-table pb-4">
                            <div class="table-responsive bg-white shadow rounded">
                                <table class="table mb-0 table-center invoice-tb">
                                    <thead class="bg-light">
                                        <tr>
                                            <th scope="col" class="border-bottom text-start">No.</th>
                                            <th scope="col" class="border-bottom text-start">Produk</th>
                                            <th scope="col" class="border-bottom">Qty</th>
                                            <th scope="col" class="border-bottom">Harga</th>
                                            <th scope="col" class="border-bottom">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($orderDetail->order->orderDetails->count() > 0)
                                            @foreach ($orderDetail->order->orderDetails as $order)
                                                <tr>
                                                    <th scope="row" class="text-start">{{ $loop->iteration }}</th>
                                                    <td class="text-start">
                                                        {{ $order->product->name }}
                                                        @if ($order->size && $order->color != '')
                                                            ({{ $order->size }}, {{ $order->color }})
                                                        @elseif ($order->size != '')
                                                            ({{ $order->size }})
                                                        @elseif ($order->color != '')
                                                            ({{ $order->color }})
                                                        @endif
                                                    </td>
                                                    <td>{{ $order->quantity }}</td>
                                                    @if($orderDetail->product->discounts->count() > 0)
                                                        @php
                                                            $discount = $orderDetail->product->discounts->first()->discount_percentage; // get discount percentage
                                                            $discountedPrice = $orderDetail->product->price - ($orderDetail->product->price * ($discount / 100)); // calculate the price after the discount
                                                        @endphp
                                                        <td>Rp {{ number_format($discountedPrice, 0, ',', '.') }}</td>
                                                    @else
                                                        <td>Rp {{ number_format($orderDetail->product->price, 0, ',', '.') }}</td>
                                                    @endif
                                                    <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-md-5 ms-auto">
                                    <ul class="list-unstyled h6 fw-normal mt-4 mb-0 ms-md-5 ms-lg-4">
                                        <li class="text-muted d-flex justify-content-between">Subtotal :<span>Rp {{ number_format($orderDetail->order->subtotal, 0, ',', '.') }}</span></li>
                                        <li class="text-muted d-flex justify-content-between">Ongkir :<span> Rp {{ number_format($orderDetail->order->shippings->first()->cost, 0, ',', '.') }}</span></li>
                                        <li class="d-flex justify-content-between">Total :<span>Rp {{ number_format($orderDetail->order->transactions->first()->gross_amount, 0, ',', '.') }}</span></li>
                                    </ul>
                                </div><!--end col-->
                            </div><!--end row-->
                        </div>

                        <div class="invoice-footer border-top pt-4">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="text-sm-start text-muted text-center">
                                        <h6 class="mb-0">Customer Services : <a href="{{ auth()->user()->telephone }}" class="text-warning">{{ auth()->user()->telephone }}</a></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-4 text-end">
                    <button class="btn btn-icon btn-soft-primary d-print-none" onclick="printSection('print-section')">
                        <i class="ti ti-printer"></i>
                    </button>
                </div>
            </div><!--end col-->
        </div><!--end row-->
    </div>
</div><!--end container-->
@endsection

@section('javascript')
<script>
function printSection(sectionId) {
    var printContents = document.getElementById(sectionId).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}
</script>
@endsection
