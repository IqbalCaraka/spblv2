<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{route('home')}}" class="app-brand-link">
            <img src="{{asset ('admin/img/SIPERMATA V10.jpg')}}" style="width:100% ;" alt="">
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li class="menu-item {{( $title === 'Dashboard')? 'active': ''}}">
        <a href="{{route ('home')}}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="Analytics">Dashboard</div>
        </a>
    </li>
    <!--Master Barang-->
    <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Master Barang</span>
    </li>
    <li class="menu-item {{( $title === 'Jenis')? 'open': ''}}
                            {{( $title === 'Kategori')? 'open': ''}}
                            {{( $title === 'Barang')? 'open': ''}}
                            {{( $title === 'Satuan')? 'open': ''}}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-dock-top"></i>
        <div data-i18n="Account Settings">Pendataan Barang</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{( $title === 'Jenis')? 'active': ''}}">
                <a href="{{route ('jenis.index')}}" class="menu-link">
                <div data-i18n="Account">Jenis Barang</div>
                </a>
            </li>
            <li class="menu-item {{( $title === 'Kategori')? 'active': ''}}">
                <a href="{{route ('kategori.index')}}" class="menu-link">
                <div data-i18n="Account">Kategori Barang</div>
                </a>
            </li>
            <li class="menu-item {{( $title === 'Barang')? 'active': ''}}">
                <a href="{{route('barang.index')}}" class="menu-link">
                <div data-i18n="Notifications">List Barang</div>
                </a>
            </li>
            <li class="menu-item {{( $title === 'Satuan')? 'active': ''}}">
                <a href="{{route('barang.index')}}" class="menu-link">
                <div data-i18n="Notifications">Satuan Barang</div>
                </a>
            </li>
        </ul>
        <li class="menu-item">
            <a href="{{route('to-do-list.index')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-transfer-alt"></i>
                <div data-i18n="Basic">Mutasi Barang</div>
            </a>
        </li>
    </li>
    
    <!-- Pengajuan -->
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Pengajuan</span></li>
    <!-- To Do List -->
    <li class="menu-item {{( $title === 'To Do List')? 'active': ''}}">
        <a href="{{route('to-do-list.index')}}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-task"></i>
            <div data-i18n="Basic">To Do List</div>
        </a>
    </li>

    <!-- Proses Validasi -->
    <li class="menu-item {{( $title === 'Proses Validasi')? 'active': ''}}">
        <a href="{{route('proses-validasi.index')}}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-cube-alt"></i>
            <div data-i18n="Basic">Proses Validasi</div>
        </a>
    </li>
    
    <!-- Semua Status -->
    <li class="menu-item {{( $title === 'Semua Status')? 'active': ''}}">
        <a href="{{route('semua-status.index')}}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-collection"></i>
            <div data-i18n="Basic">Semua Status</div>
        </a>
    </li>

    <!-- Kebutuhan Permintaan -->
    <li class="menu-item {{( $title === 'Kebutuhan Permintaan')? 'active': ''}}">
        <a href="{{route('kebutuhan-permintaan.index')}}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-package"></i>
            <div data-i18n="Basic">Kebutuhan Permintaan</div>
        </a>
    </li>


    <!-- Aktivitas -->
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Aktivitas &amp; Transaksi</span></li>

    <!-- Riwayat -->
    <li class="menu-item {{( $title === 'Riwayat Transaksi')? 'active': ''}}">
        <a href="{{route('riwayat-transaksi.index')}}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-copy"></i>
            <div data-i18n="Basic">Riwayat Transaksi</div>
        </a>
    </li>
</aside>
