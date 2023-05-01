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
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Website <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nama Website" name="name" value="{{ $setting->name }}" autocomplete="name">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div><!--end col-->
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <div class="row">
                                            <label class="form-label">Logo <span class="text-danger">*</span></label>
                                            <div class="col-sm-3 mb-3">
                                                @if ($setting->logo == 'default/image.png')
                                                    <img src="{{ $setting->logo }}" class="logo-preview img-fluid shadow me-md-4" width="70px" alt="logo" />
                                                @else
                                                    <img src="{{ asset('storage/settings/' . $setting->logo ) }}" class="logo-preview img-fluid shadow me-md-4" width="70px" alt="avatar">
                                                @endif
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="file" class="form-control @error('logo') is-invalid @enderror" name="logo" id="logo" accept="image/*" onchange="previewLogo()"/>
                                                @error('logo')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div><!--end col-->
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <div class="row">
                                            <label class="form-label">Favicon <span class="text-danger">*</span></label>
                                            <div class="col-sm-3 mb-3">
                                                @if ($setting->favicon == 'default/image.png')
                                                    <img src="{{ $setting->favicon }}" class="favicon-preview img-fluid shadow me-md-4" width="70px" alt="favicon" />
                                                @else
                                                    <img src="{{ asset('storage/settings/' . $setting->favicon ) }}" class="favicon-preview img-fluid shadow me-md-4" width="70px" alt="avatar">
                                                @endif
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="file" class="form-control @error('favicon') is-invalid @enderror" name="favicon" id="favicon" accept="image/*" onchange="previewFavicon()"/>
                                                @error('favicon')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div><!--end col-->
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <div class="row">
                                            <label class="form-label">Foto Slider 1 <span class="text-danger">*</span></label>
                                            <div class="col-sm-3 mb-3">
                                                @if ($setting->photo_slider_1 == 'default/image.png')
                                                    <img src="{{ $setting->photo_slider_1 }}" class="photo-slider-1-preview img-fluid shadow me-md-4" width="70px" alt="photo_slider_1" />
                                                @else
                                                    <img src="{{ asset('storage/settings/' . $setting->photo_slider_1 ) }}" class="photo-slider-1-preview img-fluid shadow me-md-4" width="70px" alt="avatar">
                                                @endif
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="file" class="form-control @error('photo_slider_1') is-invalid @enderror" name="photo_slider_1" id="photo-slider-1" accept="image/*" onchange="previewPhotoSlider1()"/>
                                                @error('photo_slider_1')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div><!--end col-->
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Judul Slider 1 <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('title_slider_1') is-invalid @enderror" placeholder="Judul Slider 1" name="title_slider_1" value="{{ $setting->title_slider_1 }}" autocomplete="title_slider_1">
                                        @error('title_slider_1')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div><!--end col-->
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Deskripsi Slider 1 <span class="text-danger">*</span></label>
                                        <textarea class="form-control @error('desc_slider_1') is-invalid @enderror" placeholder="Deskripsi Slider 1" name="desc_slider_1" autocomplete="desc_slider_1">{{ $setting->desc_slider_1 }}</textarea>
                                        @error('desc_slider_1')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div><!--end col-->
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <div class="row">
                                            <label class="form-label">Foto Slider 2 <span class="text-danger">*</span></label>
                                            <div class="col-sm-3 mb-3">
                                                @if ($setting->photo_slider_2 == 'default/image.png')
                                                    <img src="{{ $setting->photo_slider_2 }}" class="photo-slider-2-preview img-fluid shadow me-md-4" width="70px" alt="photo_slider_2" />
                                                @else
                                                    <img src="{{ asset('storage/settings/' . $setting->photo_slider_2 ) }}" class="photo-slider-2-preview shadow me-md-4" width="70px" alt="avatar">
                                                @endif
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="file" class="form-control @error('photo_slider_2') is-invalid @enderror" name="photo_slider_2" id="photo-slider-2" accept="image/*" onchange="previewPhotoSlider2()"/>
                                                @error('photo_slider_2')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div><!--end col-->
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Judul Slider 2 <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('title_slider_2') is-invalid @enderror" placeholder="Judul Slider 2" name="title_slider_2" value="{{ $setting->title_slider_2 }}" autocomplete="title_slider_2">
                                        @error('title_slider_2')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div><!--end col-->
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Deskripsi Slider 2 <span class="text-danger">*</span></label>
                                        <textarea class="form-control @error('desc_slider_2') is-invalid @enderror" placeholder="Deskripsi Slider 2" name="desc_slider_2" autocomplete="desc_slider_2">{{ $setting->desc_slider_2 }}</textarea>
                                        @error('desc_slider_2')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div><!--end col-->
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <div class="row">
                                            <label class="form-label">Foto Slider 3 <span class="text-danger">*</span></label>
                                            <div class="col-sm-3 mb-3">
                                                @if ($setting->photo_slider_3 == 'default/image.png')
                                                    <img src="{{ $setting->photo_slider_3 }}" class="photo-slider-3-preview img-fluid shadow me-md-4" width="70px" alt="photo_slider_3" />
                                                @else
                                                    <img src="{{ asset('storage/settings/' . $setting->photo_slider_3 ) }}" class="photo-slider-3-preview img-fluid shadow me-md-4" width="70px" alt="avatar">
                                                @endif
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="file" class="form-control @error('photo_slider_3') is-invalid @enderror" name="photo_slider_3" id="photo-slider-3" accept="image/*" onchange="previewPhotoSlider3()"/>
                                                @error('photo_slider_3')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div><!--end col-->
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Judul Slider 3 <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('title_slider_3') is-invalid @enderror" placeholder="Judul Slider 3" name="title_slider_3" value="{{ $setting->title_slider_3 }}" autocomplete="title_slider_3">
                                        @error('title_slider_3')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div><!--end col-->
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Deskripsi Slider 3 <span class="text-danger">*</span></label>
                                        <textarea class="form-control @error('desc_slider_3') is-invalid @enderror" placeholder="Deskripsi Slider 3" name="desc_slider_3" autocomplete="desc_slider_3">{{ $setting->desc_slider_3 }}</textarea>
                                        @error('desc_slider_3')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div><!--end col-->
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <div class="row">
                                            <label class="form-label">Iklan 1 <span class="text-danger">*</span></label>
                                            <div class="col-sm-3 mb-3">
                                                @if ($setting->advertisement_1 == 'default/image.png')
                                                    <img src="{{ $setting->advertisement_1 }}" class="advertisement-1-preview img-fluid shadow me-md-4" width="70px" alt="advertisement_1" />
                                                @else
                                                    <img src="{{ asset('storage/settings/' . $setting->advertisement_1 ) }}" class="advertisement-1-preview img-fluid shadow me-md-4" width="70px" alt="avatar">
                                                @endif
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="file" class="form-control @error('advertisement_1') is-invalid @enderror" name="advertisement_1" id="advertisement-1" accept="image/*" onchange="previewAdvertisement1()"/>
                                                @error('advertisement_1')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div><!--end col-->
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <div class="row">
                                            <label class="form-label">Iklan 2 <span class="text-danger">*</span></label>
                                            <div class="col-sm-3 mb-3">
                                                @if ($setting->advertisement_2 == 'default/image.png')
                                                    <img src="{{ $setting->advertisement_2 }}" class="advertisement-2-preview img-fluid shadow me-md-4" width="70px" alt="advertisement_2" />
                                                @else
                                                    <img src="{{ asset('storage/settings/' . $setting->advertisement_2 ) }}" class="advertisement-2-preview img-fluid shadow me-md-4" width="70px" alt="avatar">
                                                @endif
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="file" class="form-control @error('advertisement_2') is-invalid @enderror" name="advertisement_2" id="advertisement-2" accept="image/*" onchange="previewAdvertisement2()"/>
                                                @error('advertisement_2')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div><!--end col-->
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <div class="row">
                                            <label class="form-label">Iklan 3 <span class="text-danger">*</span></label>
                                            <div class="col-sm-3 mb-3">
                                                @if ($setting->advertisement_3 == 'default/image.png')
                                                    <img src="{{ $setting->advertisement_3 }}" class="advertisement-3-preview img-fluid shadow me-md-4" width="70px" alt="advertisement_3" />
                                                @else
                                                    <img src="{{ asset('storage/settings/' . $setting->advertisement_3 ) }}" class="advertisement-3-preview img-fluid shadow me-md-4" width="70px" alt="avatar">
                                                @endif
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="file" class="form-control @error('advertisement_3') is-invalid @enderror" name="advertisement_3" id="advertisement-3" accept="image/*" onchange="previewAdvertisement3()"/>
                                                @error('advertisement_3')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div><!--end col-->
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <div class="row">
                                            <label class="form-label">Foto CTA <span class="text-danger">*</span></label>
                                            <div class="col-sm-3 mb-3">
                                                @if ($setting->photo_cta == 'default/image.png')
                                                    <img src="{{ $setting->photo_cta }}" class="photo-cta-preview img-fluid shadow me-md-4" width="70px" alt="photo_cta" />
                                                @else
                                                    <img src="{{ asset('storage/settings/' . $setting->photo_cta ) }}" class="photo-cta-preview img-fluid shadow me-md-4" width="70px" alt="avatar">
                                                @endif
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="file" class="form-control @error('photo_cta') is-invalid @enderror" name="photo_cta" id="photo-cta" accept="image/*" onchange="previewPhotoCta()"/>
                                                @error('photo_cta')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div><!--end col-->
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Judul CTA</label>
                                        <input type="text" class="form-control @error('title_cta') is-invalid @enderror" placeholder="Judul CTA" name="title_cta" value="{{ $setting->title_cta }}" autocomplete="title_cta">
                                        @error('title_cta')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div><!--end col-->
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Deskripsi CTA <span class="text-danger">*</span></label>
                                        <textarea class="form-control @error('desc_cta') is-invalid @enderror" placeholder="Deskripsi CTA" name="desc_cta" autocomplete="desc_cta">{{ $setting->desc_cta }}</textarea>
                                        @error('desc_cta')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div><!--end col-->
                                <div class="col-md-4">
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
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Facebook</label>
                                        <input type="text" class="form-control" placeholder="Facebook" name="facebook" value="{{ $setting->facebook }}" autocomplete="facebook">
                                    </div>
                                </div><!--end col-->
                                <div class="col-md-4">
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

    // function preview logo
    function previewLogo() {
        const logo = document.querySelector('#logo');
        const logoPreview = document.querySelector('.logo-preview');
        const fileLogo = new FileReader();
        fileLogo.readAsDataURL(logo.files[0]);
        fileLogo.onload = function(e) {
            logoPreview.src = e.target.result;
        }
    }

    // function preview favicon
    function previewFavicon() {
        const favicon = document.querySelector('#favicon');
        const faviconPreview = document.querySelector('.favicon-preview');
        const fileFavicon = new FileReader();
        fileFavicon.readAsDataURL(favicon.files[0]);
        fileFavicon.onload = function(e) {
            faviconPreview.src = e.target.result;
        }
    }

    // function preview slider 1
    function previewPhotoSlider1() {
        const photoSlider1 = document.querySelector('#photo-slider-1');
        const photoSliderPreview = document.querySelector('.photo-slider-1-preview');
        const filePhotoSlider1 = new FileReader();
        filePhotoSlider1.readAsDataURL(photoSlider1.files[0]);
        filePhotoSlider1.onload = function(e) {
            photoSliderPreview.src = e.target.result;
        }
    }

    // function preview slider 2
    function previewPhotoSlider2() {
        const photoSlider2 = document.querySelector('#photo-slider-2');
        const photoSliderPreview = document.querySelector('.photo-slider-2-preview');
        const filePhotoSlider2 = new FileReader();
        filePhotoSlider2.readAsDataURL(photoSlider2.files[0]);
        filePhotoSlider2.onload = function(e) {
            photoSliderPreview.src = e.target.result;
        }
    }

    // function preview slider 3
    function previewPhotoSlider3() {
        const photoSlider3 = document.querySelector('#photo-slider-3');
        const photoSliderPreview = document.querySelector('.photo-slider-3-preview');
        const filePhotoSlider3 = new FileReader();
        filePhotoSlider3.readAsDataURL(photoSlider3.files[0]);
        filePhotoSlider3.onload = function(e) {
            photoSliderPreview.src = e.target.result;
        }
    }

    // function preview advertisement 1
    function previewAdvertisement1() {
        const advertisement1 = document.querySelector('#advertisement-1');
        const advertisementPreview = document.querySelector('.advertisement-1-preview');
        const fileAdvertisement1 = new FileReader();
        fileAdvertisement1.readAsDataURL(advertisement1.files[0]);
        fileAdvertisement1.onload = function(e) {
            advertisementPreview.src = e.target.result;
        }
    }

    // function preview advertisement 2
    function previewAdvertisement2() {
        const advertisement2 = document.querySelector('#advertisement-2');
        const advertisementPreview = document.querySelector('.advertisement-2-preview');
        const fileAdvertisement2 = new FileReader();
        fileAdvertisement2.readAsDataURL(advertisement2.files[0]);
        fileAdvertisement2.onload = function(e) {
            advertisementPreview.src = e.target.result;
        }
    }

    // function preview advertisement 3
    function previewAdvertisement3() {
        const advertisement3 = document.querySelector('#advertisement-3');
        const advertisementPreview = document.querySelector('.advertisement-3-preview');
        const fileAdvertisement3 = new FileReader();
        fileAdvertisement3.readAsDataURL(advertisement3.files[0]);
        fileAdvertisement3.onload = function(e) {
            advertisementPreview.src = e.target.result;
        }
    }

    // function preview advertisement 3
    function previewPhotoCta() {
        const photoCta = document.querySelector('#photo-cta');
        const photoCtaPreview = document.querySelector('.photo-cta-preview');
        const filePhotoCta = new FileReader();
        filePhotoCta.readAsDataURL(photoCta.files[0]);
        filePhotoCta.onload = function(e) {
            photoCtaPreview.src = e.target.result;
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
