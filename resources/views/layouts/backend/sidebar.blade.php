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
            <li><a href="{{ route('dashboard') }}"><i class="ti ti-home me-2"></i>Dashboard</a></li>
            <li><a href="{{ route('categories.index') }}"><i class="ti ti-apps me-2"></i>Kategori</a></li>
            <li><a href=""><i class="ti ti-list me-2"></i>Data Gunung</a></li>
            <li><a href=""><i class="ti ti-ticket me-2"></i>Booking</a></li>
            <li><a href=""><i class="ti ti-shopping-cart me-2"></i>Transaksi</a></li>
            <li><a href=""><i class="ti ti-file-invoice me-2"></i>Invoice</a></li>
            <li><a href=""><i class="ti ti-star me-2"></i>Testimoni</a></li>
            <li><a href=""><i class="ti ti-user me-2"></i>Pengguna</a></li>
            <li><a href=""><i class="ti ti-folder me-2"></i>Laporan</a></li>
            <li><a href=""><i class="ti ti-settings me-2"></i>Pengaturan</a></li>
        </ul>
        <!-- sidebar-menu  -->
    </div>
</nav>
<!-- sidebar-wrapper  -->
