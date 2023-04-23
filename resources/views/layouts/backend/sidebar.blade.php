<!-- sidebar-wrapper -->
<nav id="sidebar" class="sidebar-wrapper sidebar-dark">
    <div class="sidebar-content" data-simplebar style="height: calc(100% - 60px);">
        <div class="sidebar-brand">
            <a href="index.html">
                <img src="{{ asset('backend') }}/images/logo-dark.png" height="24" class="logo-light-mode" alt="">
                <img src="{{ asset('backend') }}/images/logo-light.png" height="24" class="logo-dark-mode" alt="">
                <span class="sidebar-colored">
                    <img src="{{ asset('backend') }}/images/logo-light.png" height="24" alt="">
                </span>
            </a>
        </div>

        <ul class="sidebar-menu">
            <li><a href="{{ route('dashboard') }}"><i class="uil uil-estate me-2"></i>Dashboard</a></li>
            <li><a href="{{ route('categories.index') }}"><i class="uil uil-apps me-2"></i>Kategori</a></li>
            <li><a href="{{ route('products.index') }}"><i class="uil uil-shopping-bag me-2"></i>Produk</a></li>
            <li><a href="{{ route('discounts.index') }}"><i class="uil uil-percentage me-2"></i>Diskon</a></li>
            <li><a href=""><i class="uil uil-chat me-2"></i>Pesan</a></li>
            <li><a href=""><i class="uil uil-shopping-cart me-2"></i>Transaksi</a></li>
            <li><a href=""><i class="uil uil-invoice me-2"></i>Invoice</a></li>
            <li><a href=""><i class="uil uil-truck me-2"></i>Pengiriman</a></li>
            <li><a href=""><i class="uil uil-star me-2"></i>Penilaian</a></li>
            <li><a href="{{ route('customers.index') }}"><i class="uil uil-users-alt me-2"></i>Pelanggan</a></li>
            <li><a href=""><i class="uil uil-folder me-2"></i>Laporan</a></li>
            <li><a href=""><i class="uil uil-setting me-2"></i>Pengaturan</a></li>
        </ul>
        <!-- sidebar-menu  -->
    </div>
</nav>
<!-- sidebar-wrapper  -->
