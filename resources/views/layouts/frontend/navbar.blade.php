<!-- Navbar Start -->
<header id="topnav" class="defaultscroll sticky">
    <div class="container">
        <!-- Logo container-->
        <a class="logo" href="index.html">
            <img src="{{ asset('frontend/images/logo.png' ) }}" height="50" class="logo-light-mode" alt="logo">
            Rania Sport
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
                        @php
                        // get order data for the logged in user
                            $order = App\Models\Order::where('user_id', auth()->user()->id)->get();

                            // get order details data for the logged in user
                            $order_details = App\Models\OrderDetail::whereHas('order', function ($query) {
                                $query->where('user_id', Auth::user()->id)
                                ->where('status', 'Belum Checkout');
                            })->get();

                            $total = 0;
                        @endphp
                        <button type="button" class="btn btn-icon btn-pills btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i data-feather="shopping-cart" class="icons"></i>
                            @if ($order_details->count() > 0)
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{ $order_details->count() }}</span>
                            @endif
                        </button>
                        <div class="dropdown-menu dd-menu dropdown-menu-end bg-white shadow rounded border-0 mt-3 p-4" style="width: 400px;">
                            <form action="{{ route('carts.store') }}" method="post">
                            @csrf
                            <div class="pb-4">
                                @foreach ($order_details as $order)
                                <input type="hidden" name="id[]" value="{{ $order->id }}">
                                <input type="hidden" name="quantity[]" value="{{ $order->quantity }}">
                                    <a href="{{ route('products.detail', $order->product->slug) }}" class="d-flex align-items-center mb-3">
                                        @if ($order->product->images->count() > 0)
                                            @foreach ($order->product->images as $image)
                                                <img src="{{ asset('storage/products/' . $image->path) }}" class="shadow rounded" style="max-height: 64px;" alt="product-cart">
                                                @break
                                            @endforeach
                                        @endif
                                        <div class="flex-1 text-start ms-3">
                                            <h6 class="text-dark mb-0">{{ $order->product->name }}
                                                @if ($order->size && $order->color != '')
                                                    ({{ $order->size }}, {{ $order->color }})
                                                @elseif ($order->size != '')
                                                    ({{ $order->size }})
                                                @elseif ($order->color != '')
                                                    ({{ $order->color }})
                                                @endif
                                            </h6>
                                            @if($order->product->discounts->count() > 0)
                                                @php
                                                    $discount = $order->product->discounts->first()->discount_percentage; // get discount percentage
                                                    $discountedPrice = $order->product->price - ($order->product->price * ($discount / 100)); // calculate the price after the discount
                                                @endphp
                                                <p class="text-muted mb-0">Rp {{ number_format($discountedPrice, 0, ',', '.') }} X {{ $order->quantity }}</p>
                                            @else
                                                <p class="text-muted mb-0">Rp {{ number_format($order->product->price, 0, ',', '.') }} X {{ $order->quantity }}</p>
                                            @endif
                                        </div>
                                        @if($order->product->discounts->count() > 0)
                                            @php
                                                $discount = $order->product->discounts->first()->discount_percentage; // get discount percentage
                                                $discountedPrice = $order->product->price - ($order->product->price * ($discount / 100)); // calculate the price after the discount
                                                $subtotal = $discountedPrice * $order->quantity
                                            @endphp
                                            <h6 class="text-dark mb-0 total-price">Rp {{ number_format($subtotal, 0, ',', '.') }}</h6>
                                        @else
                                            @php $subtotal = $order->product->price * $order->quantity @endphp
                                            <h6 class="text-dark mb-0 total-price">Rp {{ number_format($subtotal, 0, ',', '.') }}</h6>
                                        @endif
                                    </a>
                                    @php
                                        $total += $subtotal;
                                    @endphp
                                @endforeach
                            </div>

                            <div class="d-flex align-items-center justify-content-between pt-4 border-top">
                                <h6 class="text-dark mb-0">Total(Rp):</h6>
                                <h6 class="text-dark mb-0" id="subtotal-price">Rp {{ number_format($total, 0, ',', '.') }}</h6>
                            </div>

                            <div class="mt-3 text-center">
                                <a href="{{ route('carts.index') }}" class="btn btn-primary me-2">Keranjang</a>
                                @if ($order_details->count() > 0)
                                    <button type="submit" class="btn btn-primary">Checkout</button>
                                @endif
                            </div>
                            </form>
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
                                <a class="dropdown-item text-dark" href="{{ route('account.index') }}"><i class="uil uil-user align-middle me-1"></i> Akun Anda</a>
                                <a class="dropdown-item text-dark" href="{{ route('history.payment') }}"><i class="uil uil-money-bill align-middle me-1"></i> Riwayat Pembayaran</a>
                                <a class="dropdown-item text-dark" href="{{ route('history.index') }}"><i class="uil uil-clipboard-notes align-middle me-1"></i> Riwayat Pesanan</a>
                                <a class="dropdown-item text-dark" href="{{ route('changepassword.index') }}"><i class="uil uil-key-skeleton align-middle me-1"></i> Ganti Kata Sandi</a>
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
                <li class="{{ Request::is('products.all') ? 'active' : '' }}"><a href="{{ route('products.all') }}" class="sub-menu-item">Produk</a></li>
                <li class="{{ Request::is('products.discount') ? 'active' : '' }}"><a href="{{ route('products.discount') }}" class="sub-menu-item">Diskon</a></li>
            </ul>
            <!--end navigation menu-->
        </div>
        <!--end navigation-->
    </div><!--end container-->
</header><!--end header-->
<!-- Navbar End -->
