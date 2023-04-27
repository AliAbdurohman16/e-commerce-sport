<!-- Footer Start -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="footer-py-60">
                    <div class="row">
                        <div class="col-lg-4 col-12 mb-0 mb-md-4 pb-0 pb-md-2">
                            <a href="#" class="logo-footer">
                                <img src="{{ asset('frontend') }}/images/logo-light.png" height="24" alt="">
                            </a>
                            <p class="mt-4">Start working with Landrick that can provide everything you.</p>
                        </div><!--end col-->

                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-12 mb-4 pb-2">
                                    <h5 class="footer-head mb-0">Belanja & Pakaian</h5>
                                </div><!--end col-->

                                <div class="col-lg-4 col-md-4 col-12">
                                    <ul class="list-unstyled footer-list">
                                        <?php $categories = App\Models\Category::all(); ?>
                                        @foreach ($categories as $category)
                                            <li>
                                                <a href="{{ route('categories.all', $category->slug) }}" class="text-foot">
                                                    <i class="uil uil-angle-right-b me-1"></i> {{ $category->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div><!--end col-->

                                <div class="col-lg-4 col-md-4 col-12 mt-2 mt-sm-0">
                                    <ul class="list-unstyled footer-list">
                                        <li><a href="#" class="text-foot"><i class="uil uil-angle-right-b me-1"></i> Akun </a></li>
                                        <li><a href="#" class="text-foot"><i class="uil uil-angle-right-b me-1"></i> Riwayat Pesanan</a></li>
                                        <li><a href="#" class="text-foot"><i class="uil uil-angle-right-b me-1"></i> Keranjang </a></li>
                                    </ul>
                                </div><!--end col-->
                            </div><!--end row-->
                        </div><!--end col-->

                        <div class="col-lg-2">
                            <div class="row">
                                <div class="col-12 mb-4 pb-2">
                                    <h5 class="footer-head mb-0">Sosial Media</h5>
                                </div><!--end col-->

                                <ul class="list-unstyled social-icon foot-social-icon mb-0">
                                    <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i data-feather="facebook" class="fea icon-sm fea-social"></i></a></li>
                                    <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i data-feather="instagram" class="fea icon-sm fea-social"></i></a></li>
                                </ul><!--end icon-->
                            </div><!--end row-->
                        </div><!--end col-->
                    </div><!--end row-->
                </div>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="footer-py-30 footer-border">
                    <div class="container text-center">
                        <div class="row align-items-center">
                            <div class="col-sm-6">
                                <div class="text-sm-start">
                                    <p class="mb-0">© <script>document.write(new Date().getFullYear())</script> Rania Sport.
                                </div>
                            </div><!--end col-->
                        </div><!--end row-->
                    </div><!--end container-->
                </div>
            </div>
        </div>
    </div><!--end container-->
</footer><!--end footer-->
<!-- Footer End -->
