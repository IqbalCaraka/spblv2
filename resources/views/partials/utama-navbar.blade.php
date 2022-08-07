<header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
        <a href="{{route('menu.index')}}" class="logo d-flex align-items-center">
            <img src="{{asset ('admin/img/SIPERMATA BIRU.jpg')}}">
            <span>Si Permata</span>
        </a>
        <nav id="navbar" class="navbar">
            <ul>
            <li><a class="nav-link scrollto {{( $title === 'Menu')? 'active': ''}}" href="{{route('menu.index')}}">Home</a></li>
            <li><a class="nav-link scrollto {{( $title === 'Keranjang')? 'active': ''}}" href="{{route('keranjang.index')}}">Keranjang</a></li>
            <li><a class="nav-link scrollto {{( $title === 'Laporan Pengajuan')? 'active': ''}}" href="{{route('laporan-pengajuan.index')}}">Laporan Pengajuan</a></li>
            <li><a class="nav-link scrollto" id="userId" data-id="{{ Auth::user()->id }}" >Hi {{ Auth::user()->name }}</a></li>
            <li>
                <button class="btn btn-primary float-left" style="margin-left: 20px;" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                    Logout
                </button>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
</header><!-- End Header -->

<!-- ======= Header ======= -->
<!-- <header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
    <nav id="navbar" class="navbar">
        <i class="bi bi-list mobile-nav-toggle"></i>
    </nav> .navbar
    </div>
</header> -->
<!-- End Header -->