<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>SI PERMATA | Sistem Persediaan Mandiri Terlayani</title>

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{asset('admin/css/boxicons.css')}}" />

    <!-- Favicons -->
    <link href="{{asset ('admin/img/SIPERMATA.jpg')}}" rel="icon"/>
    <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    
    <!-- Vendor CSS Files -->
    <link href="{{asset('/utama/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('/utama/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    
    <!-- Template Main CSS File -->
    <link href="{{asset('/utama/css/style.css')}}" rel="stylesheet">
    
    <!-- DataTables -->
    <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

    <!-- Toastr -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>

    <!-- Select -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    @stack('styles')
    
</head>
<body class="flex-wrapper">
    <!-- Navbar -->
    @include('partials.utama-navbar')

    <main id='main'>
        <!-- Content wrapper -->
        @yield('content')
        <!-- / Content -->    
    </main>
    
    <!-- Footer -->
    @include('partials.utama-footer')


     <!-- JS BootStrap -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
     <!-- <script src="{{asset('/utama/js/scripts.js')}}"></script> -->

     <!-- Template Main JS File -->
     <script src="{{asset('/utama/js/main.js')}}"></script>
     <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->
     <!-- Sweet Alert -->
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

     
     <script>
         $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
     @stack('scripts')
     
     
</body>
</html>
