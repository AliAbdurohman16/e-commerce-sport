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
            <li><a href="{{ route('chats.index') }}"><i class="uil uil-chat me-2"></i>Pesan</a></li>
            <li class="sidebar-dropdown">
                <a href="javascript:void(0)"><i class="uil uil-invoice me-2"></i>Orderan</a>
                <div class="sidebar-submenu">
                    <ul>
                        <li><a href="{{ route('orders.processed') }}">Orderan Diproses</a></li>
                        <li><a href="{{ route('orders.sent') }}">Orderan Dikirim</a></li>
                        <li><a href="{{ route('orders.received') }}">Orderan Diterima</a></li>
                    </ul>
                </div>
            </li>
            <li><a href="{{ route('transactions.index') }}"><i class="uil uil-shopping-cart me-2"></i>Transaksi</a></li>
            <li><a href="{{ route('customers.index') }}"><i class="uil uil-users-alt me-2"></i>Pelanggan</a></li>
            <li><a href="{{ route('reports.index') }}"><i class="uil uil-folder me-2"></i>Laporan</a></li>
            <li><a href="{{ route('setting.index') }}"><i class="uil uil-setting me-2"></i>Pengaturan</a></li>
        </ul>
        <!-- sidebar-menu  -->
    </div>
</nav>
<!-- sidebar-wrapper  -->
