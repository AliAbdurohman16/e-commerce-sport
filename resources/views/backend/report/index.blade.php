@extends('layouts.backend.main')

@section('title', 'Laporan')

@section('content')
<div class="container-fluid">
    <div class="layout-specing">
        <div class="d-md-flex justify-content-between align-items-center">
            <h5 class="mb-0">Laporan</h5>

            <nav aria-label="breadcrumb" class="d-inline-block">
                <ul class="breadcrumb bg-transparent rounded mb-0 p-0">
                    <li class="breadcrumb-item text-capitalize"><a href="#">Laporan</a></li>
                    <li class="breadcrumb-item text-capitalize active" aria-current="page">Filter Data</li>
                </ul>
            </nav>
        </div>

        <div class="row">
            <div class="col-6 mt-4">
                <div class="card border-0 rounded shadow p-4">
                    <form action="{{ route('reports.data') }}" method="GET" target="_blank">
                        {{-- @csrf --}}
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label">Mulai dari tanggal <span class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        <i data-feather="calendar" class="fea icon-sm icons"></i>
                                        <input type="date" class="form-control ps-5" name="start_date" value="{{ old('start_date') }}" required>
                                    </div>
                                </div>
                            </div><!--end col-->

                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label">Sampai ke tanggal <span class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        <i data-feather="calendar" class="fea icon-sm icons"></i>
                                        <input type="date" class="form-control ps-5" name="end_date" value="{{ old('end_date') }}" required>
                                    </div>
                                </div>
                            </div><!--end col-->

                            <div class="col-lg-12 mt-2 mb-0">
                                <button type="submit" class="btn btn-primary">Filter</button>
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
