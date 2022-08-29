<!DOCTYPE html>

<html
  lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-template="vertical-menu-template-free">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>SI PERMATA| Sistem Persediaan Mandiri Terlayani</title>

    <meta name="description" content="" />

    <!-- Icon -->
    <link rel="icon" type="image/x-icon" href="{{asset ('admin/img/SIPERMATA.jpg')}}" />


    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{asset('admin/css/boxicons.css')}}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{asset('admin/css/core.css')}}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{asset('admin/css/theme-default.css')}}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{asset('admin/css/demo.css')}}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{asset('admin/css/perfect-scrollbar.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/css/apex-charts.css')}}" />

    <!-- Helpers -->
    <script src="{{asset('admin/js/helpers.js')}}"></script>
    <script src="{{asset('admin/js/config.js')}}"></script>

    <script type="text/javascript" src="{{asset('js/jquery.qrcode.min.js')}}"></script>
  </head>

  <body style="background-color: #ffff;">
    <div class="row d-flex align-items-center justify-content-center" style="margin: auto; position: relative; height: 100vh;">
      <div class="col-md-10  d-flex align-items-center justify-content-center">
            <img src="{{asset('storage/denied.jpg')}}" alt="" style="width: 80%; height: 80%; object-fit: cover;">
      </div>
    </div>

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{asset('admin/js/popper.js')}}"></script>
    <script src="{{asset('admin/js/bootstrap.js')}}"></script>
    <script src="{{asset('admin/js/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('admin/js/menu.js')}}"></script>
    <!-- endbuild -->

    <!-- Main JS -->
    <script src="{{asset('admin/js/main.js')}}"></script>
    
  </body>
</html>
