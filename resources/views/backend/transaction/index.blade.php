@extends('layouts.backend.main')

@section('title', 'Transaksi')

@section('css')
<!-- Datatables -->
<link rel="stylesheet" href="{{ asset('backend') }}/libs/data-tables/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="{{ asset('backend') }}/libs/data-tables/css/responsive.bootstrap5.min.css">
<!-- Sweat Alert -->
<link rel="stylesheet" href="{{ asset('backend') }}/libs/sweetalert2/sweetalert2.min.css"/>
@endsection

@section('content')
<div class="container-fluid">
    <div class="layout-specing">
        <div class="d-md-flex justify-content-between align-items-center">
            <h5 class="mb-0">Transaksi</h5>

            <nav aria-label="breadcrumb" class="d-inline-block">
                <ul class="breadcrumb bg-transparent rounded mb-0 p-0">
                    <li class="breadcrumb-item text-capitalize"><a href="#">Transaksi</a></li>
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
                                    <th class="border-bottom p-3">Bukti Transfer</th>
                                    <th class="border-bottom p-3">Kode Order</th>
                                    <th class="border-bottom p-3">Nama Pembeli</th>
                                    <th class="border-bottom p-3">Total</th>
                                    <th class="border-bottom p-3">Status</th>
                                    @foreach($transactions as $transaction)
                                    @if ($transaction->status == 'pending')
                                    <th class="border-bottom p-3">Aksi</th>
                                    @endif
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Start -->
                                @foreach($transactions as $transaction)
                                    <tr>
                                        <th class="text-center p-3" style="width: 5%;">{{ $loop->iteration }}</th>
                                        <td class="p-3">
                                            <a href="{{ asset('storage/checkout/' . $transaction->receipt) }}" target="_blank">
                                                <img src="{{ asset('storage/checkout/' . $transaction->receipt) }}" width="70px" class="img-fluid" alt="image-receipt">
                                              </a>
                                        </td>
                                        <td class="p-3">{{ $transaction->order_id }}</td>
                                        <td class="p-3">{{ $transaction->user->name }}</td>
                                        <td class="p-3">Rp {{ number_format($transaction->gross_amount, 0, ',', '.') }}</td>
                                        <td class="p-3">
                                            @if ($transaction->status == 'pending')
                                                <div class="badge bg-soft-secondary rounded px-3 py-1">
                                                    {{ strtoupper($transaction->status) }}
                                                </div>
                                            @elseif ($transaction->status == 'success')
                                                <div class="badge bg-soft-success rounded px-3 py-1">
                                                    {{ strtoupper($transaction->status) }}
                                                </div>
                                            @else
                                                <div class="badge bg-soft-danger rounded px-3 py-1">
                                                    {{ strtoupper($transaction->status) }}
                                                </div>
                                            @endif
                                        </td>
                                        @if ($transaction->status == 'pending')
                                        <td class="p-3">
                                            <form action="{{ route('transactions.validate') }}" method="POST" class="d-flex mb-2">
                                                @csrf
                                                <input type="hidden" name="order_id" value="{{ $transaction->order_id }}">
                                                <button type="submit" class="btn btn-success btn-sm">Validasi</button>
                                            </form>
                                            <form action="{{ route('transactions.rejected') }}" method="POST" class="d-flex">
                                                @csrf
                                                <input type="hidden" name="order_id" value="{{ $transaction->order_id }}">
                                                <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
                                            </form>
                                        </td>
                                        @endif
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
@endsection

@section('javascript')
<!-- Datatables -->
<script src="{{ asset('backend') }}/libs/data-tables/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('backend') }}/libs/data-tables/js/dataTables.bootstrap5.min.js"></script>
<script src="{{ asset('backend') }}/libs/data-tables/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('backend') }}/libs/data-tables/js/responsive.bootstrap5.min.js"></script>
<!-- Sweat Alert -->
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
