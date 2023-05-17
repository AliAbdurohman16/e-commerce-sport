@extends('layouts.backend.main')

@section('title', 'Pengaturan')

@section('css')
<!-- Datatables -->
<link rel="stylesheet" href="{{ asset('backend') }}/libs/sweetalert2/sweetalert2.min.css"/>
@endsection

@section('content')
<div class="container-fluid">
    <div class="layout-specing">
        <div class="d-md-flex justify-content-between align-items-center">
            <h5 class="mb-0">Pengaturan</h5>

            <nav aria-label="breadcrumb" class="d-inline-block">
                <ul class="breadcrumb bg-transparent rounded mb-0 p-0">
                    <li class="breadcrumb-item text-capitalize"><a href="#">Pengaturan</a></li>
                    <li class="breadcrumb-item text-capitalize active" aria-current="page">Ubah Data</li>
                </ul>
            </nav>
        </div>

        <div class="col-lg-12 mt-4">
            <div class="card">
                <div class="container">
                    <div class="card-body">

                        <form action="{{ route('setting.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mt-4">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <div class="row">
                                            <label class="form-label">Foto Slider <span class="text-danger">*</span></label>
                                            <div class="col-sm-3 mb-3">
                                                @if ($setting->photo_slider == 'frontend/images/slider.jpeg')
                                                    <img src="{{ $setting->photo_slider }}" class="photo-slider-preview img-fluid shadow me-md-4" width="70px" alt="photo_slider" />
                                                @else
                                                    <img src="{{ asset('storage/settings/' . $setting->photo_slider ) }}" class="photo-slider-preview img-fluid shadow me-md-4" width="70px" alt="avatar">
                                                @endif
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="file" class="form-control @error('photo_slider') is-invalid @enderror" name="photo_slider" id="photo-slider" accept="image/*" onchange="previewPhotoSlider()"/>
                                                @error('photo_slider')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div><!--end col-->
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Judul Slider <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('title_slider') is-invalid @enderror" placeholder="Judul Slider" name="title_slider" value="{{ $setting->title_slider }}" autocomplete="title_slider">
                                        @error('title_slider')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div><!--end col-->
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Deskripsi Slider <span class="text-danger">*</span></label>
                                        <textarea class="form-control @error('desc_slider') is-invalid @enderror" placeholder="Deskripsi Slider" name="desc_slider" autocomplete="desc_slider">{{ $setting->desc_slider }}</textarea>
                                        @error('desc_slider')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div><!--end col-->
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Bank <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name_bank') is-invalid @enderror" placeholder="Nama Bank" name="name_bank" value="{{ $setting->name_bank }}" autocomplete="name_bank">
                                        @error('name_bank')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div><!--end col-->
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label">No Rekening <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('no_rek') is-invalid @enderror" placeholder="No Rekening" name="no_rek" value="{{ $setting->no_rek }}" autocomplete="no_rek">
                                        @error('no_rek')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div><!--end col-->
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Tentang <span class="text-danger">*</span></label>
                                        <textarea class="form-control @error('about_footer') is-invalid @enderror" placeholder="Deskripsi tentang website" name="about_footer" autocomplete="about_footer">{{ $setting->about_footer }}</textarea>
                                        @error('about_footer')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div><!--end col-->
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Facebook</label>
                                        <input type="text" class="form-control" placeholder="Facebook" name="facebook" value="{{ $setting->facebook }}" autocomplete="facebook">
                                    </div>
                                </div><!--end col-->
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Instagram</label>
                                        <input type="text" class="form-control" placeholder="Instagram" name="instagram" value="{{ $setting->instagram }}" autocomplete="instagram">
                                    </div>
                                </div><!--end col-->
                                <div class="col-sm-12">
                                    <button type="submit" id="submit" name="send" class="w-100 btn btn-primary">Simpan</button>
                                </div><!--end col-->
                            </div><!--end row-->
                        </form><!--end form-->
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
</div><!--end container-->
@endsection

@section('javascript')
<!-- Datatables -->
<script src="{{ asset('backend') }}/libs/sweetalert2/sweetalert2.min.js"></script>
<script>
    // function preview slider
    function previewPhotoSlider() {
        const photoSlider = document.querySelector('#photo-slider');
        const photoSliderPreview = document.querySelector('.photo-slider-preview');
        const filePhotoSlider = new FileReader();
        filePhotoSlider.readAsDataURL(photoSlider.files[0]);
        filePhotoSlider.onload = function(e) {
            photoSliderPreview.src = e.target.result;
        }
    }

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
