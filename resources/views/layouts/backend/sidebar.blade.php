<!-- sidebar-wrapper -->
<nav id="sidebar" class="sidebar-wrapper sidebar-dark">
    <div class="sidebar-content" data-simplebar style="height: calc(100% - 60px);">
        <div class="sidebar-brand">
            <a href="index.html">
                <span class="sidebar-colored">
                    <img src="{{ asset('frontend/images/logo.png' ) }}" height="50" alt="logo">
                </span>
                Rania Sport
            </a>
        </div>

        <ul class="sidebar-menu">
            <li><a href="{{ route('dashboard') }}"><i class="uil uil-estate me-2"></i>Dashboard</a></li>
            @if (Auth::user()->hasRole('admin'))
            <li><a href="{{ route('categories.index') }}"><i class="uil uil-apps me-2"></i>Kategori</a></li>
            @endif
            <li><a href="{{ route('products.index') }}"><i class="uil uil-shopping-bag me-2"></i>Produk</a></li>
            <li class="sidebar-dropdown">
                <a href="javascript:void(0)"><i class="uil uil-percentage me-2"></i>Diskon</a>
                <div class="sidebar-submenu">
                    <ul>
                        <li><a href="{{ route('discounts-all-product.index') }}">Diskon Semua Produk</a></li>
                        <li><a href="{{ route('discounts-lowest-product.index') }}">Diskon Produk Kurang Laris</a></li>
                    </ul>
                </div>
            </li>
            <li><a href="{{ route('chats.index') }}"><i class="uil uil-chat me-2"></i>Pesan</a></li>
            @if (Auth::user()->hasRole('admin'))
            <li class="sidebar-dropdown">
                <a href="javascript:void(0)"><i class="uil uil-invoice me-2"></i>Orderan</a>
                <div class="sidebar-submenu">
                    <ul>
                        <li><a href="{{ route('orders.processed') }}">Orderan Diproses</a></li>
                        <li><a href="{{ route('orders.sent') }}">Orderan Dikirim</a></li>
                        <li><a href="{{ route('orders.received') }}">Orderan Diterima</a></li>
                        <li><a href="{{ route('orders.rejected') }}">Orderan Gagal</a></li>
                    </ul>
                </div>
            </li>
            <li><a href="{{ route('transactions.index') }}"><i class="uil uil-shopping-cart me-2"></i>Transaksi</a></li>
            <li><a href="{{ route('customers.index') }}"><i class="uil uil-users-alt me-2"></i>Pelanggan</a></li>
            <li><a href="{{ route('sales.index') }}"><i class="uil uil-folder me-2"></i>Data Penjualan</a></li>
            <li class="sidebar-dropdown">
                <a href="javascript:void(0)"><i class="uil uil-star me-2"></i>Review</a>
                <div class="sidebar-submenu">
                    <ul>
                        <li><a href="{{ route('reviews-data') }}">Data Review</a></li>
                        <li><a href="{{ route('reviews-chart') }}">Chart Review</a></li>
                    </ul>
                </div>
            </li>
            @endif
            {{-- <li><a href="{{ route('reports.index') }}"><i class="uil uil-folder me-2"></i>Laporan</a></li> --}}
            <li><a href="{{ route('profile.index') }}"><i class="uil uil-user me-2"></i>Profil</a></li>
            <li><a href="{{ route('setting.index') }}"><i class="uil uil-setting me-2"></i>Pengaturan</a></li>
        </ul>
        <!-- sidebar-menu  -->
    </div>
</nav>
<!-- sidebar-wrapper  -->
