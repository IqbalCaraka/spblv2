<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{route('dashboard')}}" class="app-brand-link">
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
        <a href="{{route('dashboard')}}" class="menu-link">
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
            <div data-i18n="Account Settings">Stok Opname</div>
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
                <a href="{{route('satuan.index')}}" class="menu-link">
                <div data-i18n="Notifications">Satuan Barang</div>
                </a>
            </li>
        </ul>
    </li>
    <li class="menu-item {{( $title === 'Laporan Barang')? 'active': ''}}">
        <a href="{{route('laporan-barang.index')}}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-transfer-alt"></i>
            <div data-i18n="Basic">Laporan Barang</div>
        </a>
    </li>
    
    <!-- Pengajuan -->
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Pengajuan</span></li>
    <!-- To Do List -->
    <li class="menu-item {{( $title === 'To Do List')? 'active': ''}}">
        <a href="{{route('to-do-list.index')}}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-task"></i>
            <div data-i18n="Basic">To Do List</div>
            @if($data[0]=="0")
            @else
            <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-label-danger">{{$data[0]}}</span>
            @endif
        </a>
    </li>

    <!-- Proses Validasi -->
    <li class="menu-item {{( $title === 'Proses Validasi')? 'active': ''}}">
        <a href="{{route('proses-validasi.index')}}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-cube-alt"></i>
            <div data-i18n="Basic">Proses Validasi</div>
            @if($data[1]=="0")
            @else
            <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-label-danger">{{$data[1]}}</span>
            @endif
        </a>
    </li>

    <!-- Proses Dokumen -->
    <li class="menu-item {{( $title === 'Proses Dokumen')? 'active': ''}}">
        <a href="{{route('proses-dokumen.index')}}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-file-blank"></i>
            <div data-i18n="Basic">Proses Dokumen</div>
            @if($data[2]=="0")
            @else
            <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-label-danger">{{$data[2]}}</span>
            @endif
        </a>
    </li>

    <!-- Transaksi Selesai -->
    <li class="menu-item {{( $title === 'Transaksi Selesai')? 'active': ''}}">
        <a href="{{route('transaksi-selesai.index')}}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-check-double"></i>
            <div data-i18n="Basic">Transaksi Selesai</div>
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
    <li class="menu-item {{( $title === 'Kebutuhan Permintaan')? 'open': ''}}
                            {{( $title === 'Permintaan Tidak Tersedia')? 'open': ''}}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx bx-package"></i>
            <div data-i18n="Account Settings">Kebutuhan Barang</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{( $title === 'Kebutuhan Permintaan')? 'active': ''}}">
                <a href="{{route('kebutuhan-permintaan.index')}}" class="menu-link">
                    <div data-i18n="Account">Permintaan Tersedia</div>
                </a>
            </li>
            <li class="menu-item {{( $title === 'Permintaan Tidak Tersedia')? 'active': ''}}">
                <a href="{{route ('permintaan-tidak-tersedia')}}" class="menu-link">
                    <div data-i18n="Account">Permintaan Tidak Tersedia</div>
                </a>
            </li>
        </ul>
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
    <li class="menu-item {{( $title === 'Riwayat Mutasi')? 'active': ''}}">
        <a href="{{route('mutasi-barang.index')}}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-history"></i>
            <div data-i18n="Basic">Riwayat Mutasi</div>
        </a>
    </li>

    <!-- Setting -->
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Setting</span></li>

    <!-- Tambah Profil -->
    <li class="menu-item {{( $title === 'Atur Profil')? 'active': ''}}">
        <a href="{{route('profil.index')}}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-user-plus"></i>
            <div data-i18n="Basic">Atur Profil</div>
        </a>
    </li>

    <!-- Profil
    <li class="menu-item">
        <a href="" class="menu-link">
            <i class="menu-icon tf-icons bx bxs-user-rectangle"></i>
            <div data-i18n="Basic">Pengguna</div>
        </a>
    </li> -->
</aside>
