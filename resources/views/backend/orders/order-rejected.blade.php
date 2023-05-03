@extends('layouts.backend.main')

@section('title', 'Orderan Diterima')

@section('css')
<!-- Datatables -->
<link rel="stylesheet" href="{{ asset('backend') }}/libs/data-tables/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="{{ asset('backend') }}/libs/data-tables/css/responsive.bootstrap5.min.css">
@endsection

@section('content')
<div class="container-fluid">
    <div class="layout-specing">
        <div class="d-md-flex justify-content-between align-items-center">
            <h5 class="mb-0">Orderan Diterima</h5>

            <nav aria-label="breadcrumb" class="d-inline-block">
                <ul class="breadcrumb bg-transparent rounded mb-0 p-0">
                    <li class="breadcrumb-item text-capitalize"><a href="#">Orderan</a></li>
                    <li class="breadcrumb-item text-capitalize"><a href="#">Diterima</a></li>
                    <li class="breadcrumb-item text-capitalize active" aria-current="page">list</li>
                </ul>
            </nav>
        </div>

        <div class="row">
            <div class="col-12 mt-4">
                <div class="table-responsive shadow rounded">
                    <div class="card-body">
                        <table class="table table-center bg-white mb-0" id="table">
                            <thead>
                                <tr>
                                    <th class="text-center border-bottom p-3">No</th>
                                    <th class="border-bottom p-3">Kode Order</th>
                                    <th class="border-bottom p-3">Nama Pembeli</th>
                                    <th class="border-bottom p-3">Foto</th>
                                    <th class="border-bottom p-3">Produk</th>
                                    <th class="border-bottom p-3">Ukuran</th>
                                    <th class="border-bottom p-3">Warna</th>
                                    <th class="border-bottom p-3">Qty</th>
                                    <th class="border-bottom p-3">Harga</th>
                                    <th class="border-bottom p-3">Total</th>
                                    <th class="border-bottom p-3">Status</th>
                                    <th class="border-bottom p-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Start -->
                                @foreach($orderDetails as $detail)
                                    <tr>
                                        <th class="text-center p-3" style="width: 5%;">{{ $loop->iteration }}</th>
                                        <td class="p-3">{{ $detail->order_id }}</td>
                                        <td class="p-3">{{ $detail->order->user->name }}</td>
                                        <td class="p-3">
                                            @if ($detail->product->images->count() > 0)
                                                @foreach ($detail->product->images as $image)
                                                    <div class="tiny-slide"><img src="{{ asset('storage/products/' . $image->path) }}" width="70px" class="img-fluid" alt="img-product"></div>
                                                    @break
                                                @endforeach
                                            @endif
                                        </td>
                                        <td class="p-3">{{ $detail->product->name }}</td>
                                        <td class="p-3">{{ $detail->size }}</td>
                                        <td class="p-3">{{ $detail->color }}</td>
                                        <td class="p-3">{{ $detail->quantity }}</td>
                                        <td class="p-3">Rp {{ number_format($detail->product->price, 0, ',', '.') }}</td>
                                        <td class="p-3">Rp {{ number_format($detail->total, 0, ',', '.') }}</td>
                                        <td class="p-3">
                                            <div class="badge bg-soft-danger rounded px-3 py-1">
                                                {{ $detail->order->status }}
                                            </div>
                                        </td>
                                        <td class="p-3">
                                            <button type="button" class="btn btn-info btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#detail{{ $detail->id }}"><i class="fa-solid fa-info"></i> Detail</button>
                                        </td>
                                    </tr>
                                @endforeach
                                <!-- End -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>
</div><!--end container-->

<!-- Modal Detail -->
@foreach ($orderDetails as $detail)
<div class="modal fade" id="detail{{ $detail->id }}" tabindex="-1" aria-labelledby="LoginForm-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded shadow border-0">
            <div class="modal-header border-bottom">
                <h5 class="modal-title" id="LoginForm-title">Data Pesanan</h5>
                <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal" id="close-modal"><i class="uil uil-times fs-4 text-dark"></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="container">
                            <div class="row">
                                <div class="col-4">
                                    <label for="">Produk</label>
                                </div>
                                <div class="col-1">:</div>
                                <div class="col-7">
                                    @if ($detail->order->orderDetails->count() > 0)
                                        @foreach ($detail->order->orderDetails as $order)
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
                                </div>

                                <div class="col-4">
                                    <label for="">Tanggal Pesanan</label>
                                </div>
                                <div class="col-1">:</div>
                                <div class="col-7">
                                    {{ date('H:i, d-m-Y', strtotime($detail->created_at)) }}
                                </div>

                                <div class="col-4">
                                    <label for="">Tanggal Gagal</label>
                                </div>
                                <div class="col-1">:</div>
                                <div class="col-7">
                                    {{ date('H:i, d-m-Y', strtotime($detail->order->updated_at)) }}
                                </div>

                                <div class="col-4">
                                    <label for="">Jumlah</label>
                                </div>
                                <div class="col-1">:</div>
                                <div class="col-7">
                                    Rp {{ number_format($detail->order->transactions->first()->gross_amount, 0, ',', '.') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- Modal Detail End -->
@endsection

@section('javascript')
<!-- Datatables -->
<script src="{{ asset('backend') }}/libs/data-tables/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('backend') }}/libs/data-tables/js/dataTables.bootstrap5.min.js"></script>
<script src="{{ asset('backend') }}/libs/data-tables/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('backend') }}/libs/data-tables/js/responsive.bootstrap5.min.js"></script>

<script>
    // show datatable with search and pagination
    $(document).ready(function() {
        $('#table').DataTable();
    });
</script>
@endsection
