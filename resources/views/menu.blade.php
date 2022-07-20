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
    @livewireStyles
  </head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand">Navbar</a>
        </div>
    </nav>
    <div class="container">
        @livewire('menu-barang')
    </div>      
    @livewireScripts
</body>
</html>

<!-- <script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // Live Search Ajax V.3
    $(document).ready(function(){
        function search (page, query) {
            $.ajax({
                url:"/menu/search?page="+page+"&query="+query,
                success:function(data){
                    $('#searchResult').html('');
                    $('#searchResult').html(data);

                },
                error:function(){
                    console.log('eror')
                }
            })
        }
        $(document).on('keyup', '#inputSearch', function(){
            var query = $('#inputSearch').val();
            var page = $('#hidden_page').val();
            search(page, query);
        })

        $(document).on('click', '.pagination a', function(event){
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            var query = $('#inputSearch').val();
            $('#hidden_page').val(page);
            $('li').removeClass('active');
            $(this).parent().addClass('active');
            search(page, query);
        });
    })


    // var url;
    // Live Seacrh Ajax V.2

        //Load first time or when the search is empty
        // $.ajax({
        //     method:"get",
        //     url:"{{route('menu.index')}}",
        //     success:function(response){
        //         console.log(response)
        //     }
            
        // })

        // $(function() {
        //     $('body').on('click', '.pagination a', function(e) {
        //         e.preventDefault();

        //         $('#load a').css('color', '#dfecf6');
        //         $('#load').append('<img style="position: absolute; left: 0; top: 0; z-index: 100000;" src="/images/loading.gif" />');

        //         var url = $(this).attr('href');  
        //         getBarang(url);
        //         window.history.pushState("", "", url);
        //     });

        //     function getBarang(url) {
        //         $.ajax({
        //             url : url  
        //         }).done(function (data) {
        //             $('#searchResult').html(data);  
        //         }).fail(function () {
        //             //alert('List Barang Tidak Ditemukan!');
        //         });
        //     }
        // });
        

        //Versi 2.1
        // $(document).ready(function() {
        //     $('body').on('click', '.pagination a', function(e) {
        //         e.preventDefault();
        //         $('#load a').css('color', '#dfecf6');
        //         $('#load').append('<img style="position: absolute; left: 0; top: 0; z-index: 100000;" src="/images/loading.gif" />');
        //         url = $(this).attr('href');
        //         getBarang(url);
        //         window.history.pushState("", "", url);
        //     });

        //     function getBarang(url) {
        //         $.ajax({
        //             url : url
        //         }).done(function (data) {
        //             $('#searchResult').html(data);  
        //         }).fail(function () {
        //             //alert('List Barang Tidak Ditemukan!');
        //         });
        //     }

        //     $('#inputSearch').on('keyup', function(){
        //         $inputSearch = $(this).val();
        //         $.ajax({
        //             method:"POST",
        //             url:"search",
        //             data:JSON.stringify ({
        //                 inputSearch:$inputSearch
        //             }),
        //             headers:{
        //                 'Accept' : 'applicaion/json',
        //                 'Content-Type': 'applicaion/json'
        //             }, 
        //             success: function(barangs){
        //                 $('#searchResult').html(barangs)
        //             }
        //         })
               
                

        //         // function getBarang(url) {
        //         //     $.ajax({
        //         //         url : url
        //         //     }).done(function (data) {
        //         //         $('#searchResult').html(data);  
        //         //     }).fail(function () {
        //         //         //alert('List Barang Tidak Ditemukan!');
        //         //     });
        //         // }
                   
        //     })
        // })


        // $(document).ready(function() {
        //     $('#inputSearch').on('keyup', function(){
        //         $inputSearch = $(this).val();
        //         //alert($inputSearch)
        //         $.ajax({
        //             method:"post",
        //             url:"search",
        //             data:JSON.stringify ({
        //                 inputSearch:$inputSearch
        //             }),
        //             headers:{
        //                 'Accept' : 'applicaion/json',
        //                 'Content-Type': 'applicaion/json'
        //             },
        //             success: function(response){
        //                 $('#searchResult').html(response);
        //             }
        //         })
        //     })
        // })



    //Live Search Ajax V.1
    // $(document).ready(function() {
    //     //Load first time or when the search is empty
    //     $.ajax({
    //         method:"get",
    //         url:"{{route('menu.index')}}",
    //         headers:{
    //             'Accept' : 'applicaion/json',
    //             'Content-Type': 'applicaion/json'
    //         },
    //         success:function(response){
    //             console.log(response.barang.data);
    //             console.log(response.pagination);
    //             var searchResultAjax='';
    //             $('#searchResult').show();
    //             for(let i=0; i<response.barang.data.length; i++){
    //                 searchResultAjax +=
    //                 `<div class="card col-3 m-1" style="width: 16rem;">
    //                     <img src="" class="card-img-top  mt-3" style="height:150px; object-fit: contain;">
    //                     <div class="card-body">
    //                         <h5 class="card-title">`+response.barang.data[i].nama_barang+`</h5>
    //                         <p class="card-text"></p>
    //                         <a href="#" class="btn btn-primary">Go somewhere</a>
    //                     </div>
    //                 </div>`
    //             }
    //             $('#searchResult').html(searchResultAjax);
    //         }
    //     })
    //     //Load for search item
    //     $('#inputSearch').on('keyup', function(){
    //         $inputSearch = $(this).val();
            
    //             $.ajax({
    //                 method:"post",
    //                 url:"search",
    //                 data:JSON.stringify ({
    //                     inputSearch:$inputSearch
    //                 }),
    //                 headers:{
    //                     'Accept' : 'applicaion/json',
    //                     'Content-Type': 'applicaion/json'
    //                 },
    //                 success: function(data){
    //                     var searchResultAjax='';
    //                     data = JSON.parse(data);
    //                     $('#searchResult').show();
    //                     for(let i=0; i<data.length; i++){
    //                         searchResultAjax +=
    //                         `<div class="card col-3 m-1" style="width: 16rem;">
    //                             <img src="" class="card-img-top  mt-3" style="height:150px; object-fit: contain;">
    //                             <div class="card-body">
    //                                 <h5 class="card-title">`+data[i].nama_barang+`</h5>
    //                                 <p class="card-text"></p>
    //                                 <a href="#" class="btn btn-primary">Go somewhere</a>
    //                             </div>
    //                         </div>`
    //                     }
    //                     $('#searchResult').html(searchResultAjax);
    //                 }
    //             })
    //     })
    // })
</script> -->