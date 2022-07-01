<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard - Analytics | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset ('admin/img/favicon.ico')}}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{asset('admin/css/boxicons.css')}}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{asset('admin/css/core.css')}}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{asset('admin/css/theme-default.css')}}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{asset('admin/css/demo.css')}}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{asset('admin/css/perfect-scrollbar.css')}}" />

    <link rel="stylesheet" href="{{asset('admin/css/apex-charts.css')}}" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{asset('admin/js/helpers.js')}}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{asset('admin/js/config.js')}}"></script>

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
  </head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand">Navbar</a>
            <form class="d-flex" role="search">
                <input class="form-control me-2" id="inputSearch" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-info" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <div class="container">
        <div id="searchResult" class="d-flex justify-content-center row mt-4 p-2">
          
        </div>
    </div>      

</body>
</html>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function() {
        //Load first time or when the search is empty
        $.ajax({
            method:"get",
            url:"{{route('menu.index')}}",
            headers:{
                'Accept' : 'applicaion/json',
                'Content-Type': 'applicaion/json'
            },
            success:function(data){
                var searchResultAjax='';
                console.log(data);
                $('#searchResult').show();
                for(let i=0; i<data.length; i++){
                    searchResultAjax +=
                    `<div class="card col-3 m-1" style="width: 16rem;">
                        <img src="" class="card-img-top  mt-3" style="height:150px; object-fit: contain;">
                        <div class="card-body">
                            <h5 class="card-title">`+data[i].nama_barang+`</h5>
                            <p class="card-text"></p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>`
                }
                $('#searchResult').html(searchResultAjax);
            }
        })
        //Load for search item
        $('#inputSearch').on('keyup', function(){
            $inputSearch = $(this).val();
            
                $.ajax({
                    method:"post",
                    url:"search",
                    data:JSON.stringify ({
                        inputSearch:$inputSearch
                    }),
                    headers:{
                        'Accept' : 'applicaion/json',
                        'Content-Type': 'applicaion/json'
                    },
                    success: function(data){
                        var searchResultAjax='';
                        data = JSON.parse(data);
                        console.log(data);
                        $('#searchResult').show();
                        for(let i=0; i<data.length; i++){
                            searchResultAjax +=
                            `<div class="card col-3 m-1" style="width: 16rem;">
                                <img src="" class="card-img-top  mt-3" style="height:150px; object-fit: contain;">
                                <div class="card-body">
                                    <h5 class="card-title">`+data[i].nama_barang+`</h5>
                                    <p class="card-text"></p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>`
                        }
                        $('#searchResult').html(searchResultAjax);
                    }
                })
        })
    })
</script>