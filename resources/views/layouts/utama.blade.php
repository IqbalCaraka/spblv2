<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SIPBL | Sistem Informasi Permmintaan Barang Lancar</title>
  <meta content="" name="description">

  <meta content="" name="keywords">

  <!-- Icons. Uncomment required icon fonts -->
  <link rel="stylesheet" href="{{asset('admin/css/boxicons.css')}}" />

  <!-- Favicons -->
  <link href="{{asset('/utama/img/logo2.png')}}" rel="icon">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('/utama/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />

  <!-- Template Main CSS File -->
  <link href="{{asset('/utama/css/style.css')}}" rel="stylesheet">

    <!-- Datatable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css"/>
    <link type="text/css" href="https://cdn.datatables.net/buttons/1.1.2/css/buttons.dataTables.min.css" rel="stylesheet">

    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

    <!-- Toastr -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>

    <!-- Select -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @stack('styles')
    
  </head>
<body>
    <header id="header" class="header fixed-top">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

            <a href="" class="logo d-flex align-items-center">
                <img src="{{asset ('utama/img/logo1.png')}}" alt="">
                <span>SIMC</span>
            </a>

            <nav id="navbar" class="navbar">
                <ul>
                <li><a class="nav-link scrollto active" href="">Home</a></li>
                <li><a class="nav-link scrollto" href="">Monitoring CAT</a></li>
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
                <li><a class="nav-link scrollto" >Hi Iqbal</a></li>
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

    <main id='main'>
        <div class="container" >
            <!-- Content wrapper -->
            @yield('content')
              <!-- / Content -->
        </div>      
    </main>
    <!-- Vendor JS Files -->
  <script src="{{asset('/utama/vendor/bootstrap/js/bootstrap.bundle.js')}}"></script>
  <script src="{{asset('/utama/vendor/aos/aos.js')}}"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{asset('/utama/js/scripts.js')}}"></script>

    <!-- Template Main JS File -->
    <script src="{{asset('/utama/js/main.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    @stack('scripts')
</body>
</html>
