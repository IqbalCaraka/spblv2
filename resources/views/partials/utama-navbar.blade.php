<header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
        <a href="" class="logo d-flex align-items-center">
            <img src="{{asset ('utama/img/logo1.png')}}" alt="">
            <span>SIMC</span>
        </a>
        <nav id="navbar" class="navbar">
            <ul>
            <li><a class="nav-link scrollto active" href="">Home</a></li>
            <li><a class="nav-link scrollto" href="{{route('keranjang.index')}}">Keranjang</a></li>
            <li><a class="nav-link scrollto" href="">Rekap Data</a></li>
            <li><a class="nav-link scrollto" href="">Ubah Profil</a></li>
            <li><a class="nav-link scrollto" href="">Manajemen SIMC</a></li>
            <li class="dropdown"><a href="#"><span>Manajemen Akun</span> <i class="bi bi-chevron-down"></i></a>
                <ul>
                <li class="dropdown"><a href="#"><span>Admin</span> <i class="bi bi-chevron-right"></i></a>
                    <ul>
                    <li><a href="">Verifikasi Member</a></li>
                    <li><a href="">Manajemen Member</a></li>
                    </ul>
                </li>
                <li class="dropdown"><a href="#"><span>Super Admin</span> <i class="bi bi-chevron-right"></i></a>
                    <ul>
                    <li><a href="">Verifikasi Admin</a></li>
                    <li><a href="">Manajemen Admin</a></li>
                    </ul>
                </li>
                </ul>
            </li>
            <li><a class="nav-link scrollto" id="userId" data-id="{{ Auth::user()->id }}" >Hi {{ Auth::user()->name }}</a></li>
            <li>
                <button class="btn btn-primary float-left" style="margin-left: 20px;" onclick="notifLogout()">
                    Logout
                </button>
            </li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
</header><!-- End Header -->

<!-- ======= Header ======= -->
<header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
    <nav id="navbar" class="navbar">
        <i class="bi bi-list mobile-nav-toggle"></i>
    </nav><!-- .navbar -->
    </div>
</header><!-- End Header -->