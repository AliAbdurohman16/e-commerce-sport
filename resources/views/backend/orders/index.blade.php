@extends('layouts.backend.main')

@section('title', 'Orderan Diproses')

@section('css')
<!-- Datatables -->
<link rel="stylesheet" href="{{ asset('backend') }}/libs/data-tables/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="{{ asset('backend') }}/libs/data-tables/css/responsive.bootstrap5.min.css">
<link rel="stylesheet" href="{{ asset('backend') }}/libs/sweetalert2/sweetalert2.min.css"/>
@endsection

@section('content')
<div class="container-fluid">
    <div class="layout-specing">
        <div class="d-md-flex justify-content-between align-items-center">
            <h5 class="mb-0">Orderan Diproses</h5>

            <nav aria-label="breadcrumb" class="d-inline-block">
                <ul class="breadcrumb bg-transparent rounded mb-0 p-0">
                    <li class="breadcrumb-item text-capitalize"><a href="#">Orderan</a></li>
                    <li class="breadcrumb-item text-capitalize"><a href="#">Diproses</a></li>
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
                                    <th class="border-bottom p-3">Nama Pembeli</th>
                                    <th class="border-bottom p-3">Foto</th>
                                    <th class="border-bottom p-3">Produk</th>
                                    <th class="border-bottom p-3">Ukuran</th>
                                    <th class="border-bottom p-3">Warna</th>
                                    <th class="border-bottom p-3">Qty</th>
                                    <th class="border-bottom p-3">Harga</th>
                                    <th class="border-bottom p-3">Total</th>
                                    <th class="border-bottom p-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Start -->
                                @foreach($orderDetails as $detail)
                                    <tr>
                                        <th class="text-center p-3" style="width: 5%;">{{ $loop->iteration }}</th>
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
                                        @if($detail->product->discounts->count() > 0)
                                                @php
                                                    $discount = $detail->product->discounts->first()->discount_percentage; // get discount percentage
                                                    $discountedPrice = $detail->product->price - ($detail->product->price * ($discount / 100)); // calculate the price after the discount
                                                @endphp
                                                <td class="p-3">Rp {{ number_format($discountedPrice, 0, ',', '.') }}</td>
                                            @else
                                                <td class="p-3">Rp {{ number_format($detail->product->price, 0, ',', '.') }}</td>
                                            @endif
                                        <td class="p-3">Rp {{ number_format($detail->total, 0, ',', '.') }}</td>
                                        <td class="p-3">
                                            <button type="button" class="btn btn-info btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#detail{{ $detail->id }}"><i class="fa-solid fa-info"></i> Detail</button>
                                            <button type="button" class="btn btn-warning btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#sent{{ $detail->id }}"><i class="fa-solid fa-truck"></i> Kirim Paket</button>
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
                                    <label for="">Tanggal Pembayaran</label>
                                </div>
                                <div class="col-1">:</div>
                                <div class="col-7">
                                    {{ date('H:i, d-m-Y', strtotime($detail->order->transactions->first()->updated_at)) }}
                                </div>

                                <div class="col-4">
                                    <label for="">Metode Pembayaran</label>
                                </div>
                                <div class="col-1">:</div>
                                <div class="col-7">
                                    Transfer Bank
                                </div>

                                <div class="col-4">
                                    <label for="">Nama Bank</label>
                                </div>
                                <div class="col-1">:</div>
                                <div class="col-7">
                                    {{ strtoupper($detail->order->transactions->first()->bank) }}
                                </div>

                                <div class="col-4">
                                    <label for="">VA Number</label>
                                </div>
                                <div class="col-1">:</div>
                                <div class="col-7">
                                    {{ $detail->order->transactions->first()->va_number }}
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

<!-- Modal Sent -->
@foreach ($orderDetails as $detail)
<div class="modal fade" id="sent{{ $detail->id }}" tabindex="-1" aria-labelledby="LoginForm-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded shadow border-0">
            <div class="modal-header border-bottom">
                <h5 class="modal-title" id="LoginForm-title">Konfirmasi Pengiriman</h5>
                <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal" id="close-modal"><i class="uil uil-times fs-4 text-dark"></i></button>
            </div>
            <Form action="{{ route('orders.store', $detail->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="order_id" value="{{ $detail->order_id }}">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Kode Resi<span class="text-danger">*</span></label>
                                <input type="text" name="resi" id="resi" class="form-control @error('resi') is-invalid @enderror" value="{{ old('resi') }}" placeholder="Masukkan Kode Resi" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Jasa Pengirim<span class="text-danger">*</span></label>
                            <select name="provider" id="provider" class="form-control" required>
                                <option value="">-- Pilih Jasa Pengirim --</option>
                                <option value="JNE">JNE</option>
                                <option value="J&T Express">J&T Express</option>
                                <option value="POS Indonesia">POS Indonesia</option>
                                <option value="Ninja Xpress">Ninja Xpress</option>
                                <option value="SiCepat">SiCepat</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </Form>
        </div>
    </div>
</div>
@endforeach
<!-- Modal Sent End -->
@endsection

@section('javascript')
<!-- Datatables -->
<script src="{{ asset('backend') }}/libs/data-tables/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('backend') }}/libs/data-tables/js/dataTables.bootstrap5.min.js"></script>
<script src="{{ asset('backend') }}/libs/data-tables/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('backend') }}/libs/data-tables/js/responsive.bootstrap5.min.js"></script>
<script src="{{ asset('backend') }}/libs/sweetalert2/sweetalert2.min.js"></script>

<script>
    // show datatable with search and pagination
    $(document).ready(function() {
        $('#table').DataTable();
    });

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
    @endif

</script>
@endsection
