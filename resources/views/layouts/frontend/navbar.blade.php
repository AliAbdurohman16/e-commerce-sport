<!-- Navbar Start -->
<header id="topnav" class="defaultscroll sticky">
    <div class="container">
        <!-- Logo container-->
        <a class="logo" href="index.html">
            <img src="{{ asset('frontend') }}/images/logo-dark.png" height="24" class="logo-light-mode" alt="">
            <img src="{{ asset('frontend') }}/images/logo-light.png" height="24" class="logo-dark-mode" alt="">
        </a>
        <!-- End Logo container-->

        <div class="menu-extras">
            <div class="menu-item">
                <!-- Mobile menu toggle-->
                <a class="navbar-toggle" id="isToggle" onclick="toggleMenu()">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
                <!-- End mobile menu toggle-->
            </div>
        </div>

        <ul class="buy-button list-inline mb-0">
            <li class="list-inline-item mb-0">
                <div class="dropdown">
                    <button type="button" class="btn dropdown-toggle p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="uil uil-search text-dark fs-5 align-middle"></i>
                    </button>
                    <div class="dropdown-menu dd-menu dropdown-menu-end bg-white shadow rounded border-0 mt-3 p-0" style="width: 300px;">
                        <div class="search-bar">
                            <div id="itemSearch" class="menu-search mb-0">
                                <form action="{{ route('products.search') }}" method="get" id="searchItemform" class="searchform">
                                    <input type="text" class="form-control border rounded" name="key" id="searchItem" placeholder="Search...">
                                    <input type="submit" id="searchItemsubmit" value="Search">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </li>

            @guest
                @if (Route::has('login'))
                <li class="list-inline-item mb-0">
                    <a href="{{ route('login') }}" class="btn btn-primary">Masuk</a>
                </li>
                @endif
            @else
                <li class="list-inline-item mb-0 pe-1 position-relative">
                    <div class="dropdown">
                        <button type="button" class="btn btn-icon btn-pills btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i data-feather="shopping-cart" class="icons"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">3</span>
                        </button>
                        <div class="dropdown-menu dd-menu dropdown-menu-end bg-white shadow rounded border-0 mt-3 p-4" style="width: 300px;">
                            <div class="pb-4">
                                <a href="javascript:void(0)" class="d-flex align-items-center">
                                    <img src="{{ asset('frontend') }}/images/shop/product/s-1.jpg" class="shadow rounded" style="max-height: 64px;" alt="">
                                    <div class="flex-1 text-start ms-3">
                                        <h6 class="text-dark mb-0">T-shirt (M)</h6>
                                        <p class="text-muted mb-0">$320 X 2</p>
                                    </div>
                                    <h6 class="text-dark mb-0">$640</h6>
                                </a>

                                <a href="javascript:void(0)" class="d-flex align-items-center mt-4">
                                    <img src="{{ asset('frontend') }}/images/shop/product/s-2.jpg" class="shadow rounded" style="max-height: 64px;" alt="">
                                    <div class="flex-1 text-start ms-3">
                                        <h6 class="text-dark mb-0">Bag</h6>
                                        <p class="text-muted mb-0">$50 X 5</p>
                                    </div>
                                    <h6 class="text-dark mb-0">$250</h6>
                                </a>

                                <a href="javascript:void(0)" class="d-flex align-items-center mt-4">
                                    <img src="{{ asset('frontend') }}/images/shop/product/s-3.jpg" class="shadow rounded" style="max-height: 64px;" alt="">
                                    <div class="flex-1 text-start ms-3">
                                        <h6 class="text-dark mb-0">Watch (Men)</h6>
                                        <p class="text-muted mb-0">$800 X 1</p>
                                    </div>
                                    <h6 class="text-dark mb-0">$800</h6>
                                </a>
                            </div>

                            <div class="d-flex align-items-center justify-content-between pt-4 border-top">
                                <h6 class="text-dark mb-0">Total($):</h6>
                                <h6 class="text-dark mb-0">$1690</h6>
                            </div>

                            <div class="mt-3 text-center">
                                <a href="{{ route('carts.index') }}" class="btn btn-primary me-2">View Cart</a>
                                <a href="javascript:void(0)" class="btn btn-primary">Checkout</a>
                            </div>
                            <p class="text-muted text-start mt-1 mb-0">*T&C Apply</p>
                        </div>
                    </div>
                </li>

                <li class="list-inline-item mb-0 pe-1 position-relative">
                    <div class="dropdown">
                        <button type="button" class="btn btn-icon btn-pills btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i data-feather="message-square" class="icons"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">3</span>
                        </button>
                        <div class="dropdown-menu dd-menu dropdown-menu-end bg-white shadow rounded border-0 mt-3 p-4" style="width: 300px;">
                            <div class="pb-4">
                                <a href="javascript:void(0)" class="d-flex align-items-center">
                                    <img src="{{ asset('frontend') }}/images/shop/product/s-1.jpg" class="shadow rounded" style="max-height: 64px;" alt="">
                                    <div class="flex-1 text-start ms-3">
                                        <h6 class="text-dark mb-0">T-shirt (M)</h6>
                                        <p class="text-muted mb-0">$320 X 2</p>
                                    </div>
                                    <h6 class="text-dark mb-0">$640</h6>
                                </a>

                                <a href="javascript:void(0)" class="d-flex align-items-center mt-4">
                                    <img src="{{ asset('frontend') }}/images/shop/product/s-2.jpg" class="shadow rounded" style="max-height: 64px;" alt="">
                                    <div class="flex-1 text-start ms-3">
                                        <h6 class="text-dark mb-0">Bag</h6>
                                        <p class="text-muted mb-0">$50 X 5</p>
                                    </div>
                                    <h6 class="text-dark mb-0">$250</h6>
                                </a>

                                <a href="javascript:void(0)" class="d-flex align-items-center mt-4">
                                    <img src="{{ asset('frontend') }}/images/shop/product/s-3.jpg" class="shadow rounded" style="max-height: 64px;" alt="">
                                    <div class="flex-1 text-start ms-3">
                                        <h6 class="text-dark mb-0">Watch (Men)</h6>
                                        <p class="text-muted mb-0">$800 X 1</p>
                                    </div>
                                    <h6 class="text-dark mb-0">$800</h6>
                                </a>
                            </div>

                            <div class="d-flex align-items-center justify-content-between pt-4 border-top">
                                <h6 class="text-dark mb-0">Total($):</h6>
                                <h6 class="text-dark mb-0">$1690</h6>
                            </div>

                            <div class="mt-3 text-center">
                                <a href="javascript:void(0)" class="btn btn-primary me-2">View Cart</a>
                                <a href="javascript:void(0)" class="btn btn-primary">Checkout</a>
                            </div>
                            <p class="text-muted text-start mt-1 mb-0">*T&C Apply</p>
                        </div>
                    </div>
                </li>

                <li class="list-inline-item mb-0">
                    <div class="dropdown dropdown-primary">
                        <button type="button" class="btn btn-icon btn-pills btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="user" class="icons"></i></button>
                        <div class="dropdown-menu dd-menu dropdown-menu-end bg-white shadow rounded border-0 mt-3 py-3" style="width: 200px;">
                            @if (Auth::user()->hasRole('admin'))
                                <a class="dropdown-item text-dark" href="{{ route('dashboard') }}"><i class="uil uil-estate align-middle me-1"></i> Dashboard</a>
                            @else
                                <a class="dropdown-item text-dark" href="#"><i class="uil uil-user align-middle me-1"></i> Akun Anda</a>
                                <a class="dropdown-item text-dark" href="#"><i class="uil uil-clipboard-notes align-middle me-1"></i> Riwayat Pesanan</a>
                            @endif
                            <div class="dropdown-divider my-3 border-top"></div>
                            <a class="dropdown-item text-dark" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"><i class="uil uil-sign-out-alt align-middle me-1"></i> Keluar</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </li>
            @endguest
        </ul><!--end login button-->

        <div id="navigation">
            <!-- Navigation Menu-->
            <ul class="navigation-menu">
                <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="{{ route('/') }}" class="sub-menu-item">Beranda</a></li>
                <li><a href="shop-aboutus.html" class="sub-menu-item">Tentang Kami</a></li>
                <li class="{{ Request::is('products.all') ? 'active' : '' }}"><a href="{{ route('products.all') }}" class="sub-menu-item">Produk</a></li>
                <li class="{{ Request::is('products.discount') ? 'active' : '' }}"><a href="{{ route('products.discount') }}" class="sub-menu-item">Diskon</a></li>
            </ul>
            <!--end navigation menu-->
        </div>
        <!--end navigation-->
    </div><!--end container-->
</header><!--end header-->
<!-- Navbar End -->
