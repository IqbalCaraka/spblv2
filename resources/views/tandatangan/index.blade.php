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

    <!-- Helpers -->
    <script src="{{asset('admin/js/helpers.js')}}"></script>
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

    <script type="text/javascript" src="{{asset('js/jquery.qrcode.min.js')}}"></script>

    <link rel="stylesheet" href="{{asset('css/signaturepad.css')}}" />

  </head>

  <body>
    <div class="row d-flex align-items-center justify-content-center" style="margin: auto; position: relative; height: 100vh;">
      <div class="col-md-8">
        <div class="card">
          <h5 class="card-header d-flex align-items-center justify-content-center">Tanda Tangan Dokumen</h5>
          <div class="card-body">
            <form enctype="multipart/form-data" id="form-tambah" name="ItemForm">
                  <div class="row">
                    <div class="col mb-3" id="aksi">
                      <!-- <label for="gambar" class="form-label">Tanda tangan pada area yang t</label> -->
                      <!-- <p>hi</p> -->
                       <!-- canvas tanda tangan  -->
                      <canvas id="signature-pad" class="signature-pad align-items-center justify-content-center"></canvas>
                      <br/>
                      
                      <!-- tombol submit  -->
                      <!-- <div style="float: left;">
                          <button id="btn-submit" class="btn btn-primary">
                              Simpan
                          </button>
                      </div> -->

                      <div style="justify-content: center; display: flex; align-items: center; margin: auto;">
                          <!-- tombol ganti warna  -->
                          <!-- <button type="button" class="btn btn-success" id="change-color">
                              Change Color
                          </button> -->

                          <!-- tombol undo  -->
                          <button type="button" class="btn btn-md btn-outline-dark m-1" id="undo">
                              <span class="fas fa-undo"></span>
                              Undo
                          </button>
                          <!-- tombol hapus tanda tangan  -->
                          <button type="button" class="btn btn-md btn-outline-danger m-1" id="clear">
                              <span class="fas fa-eraser"></span>
                              Hapus
                          </button>
                          <button type="button" onclick="simpanTtd(event.target)" data-id="{{$dokumenPenyerahan->id}}" data-peran="{{$peran}}" class="btn btn-md btn-outline-success" id="submit-form"> Simpan </button>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <a href="{{route('proses-dokumen.index')}}">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"> Kembali </button>
                  </a>
                  <button disabled type="button" onclick="simpanTtd(event.target)" data-id="{{$dokumenPenyerahan->id}}" data-peran="{{$peran}}" class="btn btn-primary" id="submit-form"> Upload Scan Tanda Tangan </button>
                  <button type="button" onclick="gunakanTTDSebelumnya(event.target)" data-id="{{$dokumenPenyerahan->id}}" data-peran="{{$peran}}" class="btn btn-primary" id="submit-form"> Gunakan Tanda Tangan Sebelumnya </button>
                  <a href="{{route('proses-dokumen.show', $dokumenPenyerahan->transaksi_id)}}" id="unduhDokumen" target=”_blank”>
                    <button type="button" onclick="lihatDokumen(event.target)" data-id="{{$dokumenPenyerahan->transaksi_id}}" data-peran="{{$peran}}" class="btn btn-primary" id="submit-form"> Lihat Dokumen </button>
                  </a>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{asset('admin/js/popper.js')}}"></script>
    <script src="{{asset('admin/js/bootstrap.js')}}"></script>
    <script src="{{asset('admin/js/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('admin/js/menu.js')}}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{asset('admin/js/apexcharts.js')}}"></script>

    <!-- Main JS -->
    <script src="{{asset('admin/js/main.js')}}"></script>

    <!-- Page JS -->
    <script src="{{asset('admin/js/dashboards-analytics.js')}}"></script>
    
    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <!-- Sweet Alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
  </body>

      <script>
        //fungsi untuk menyimpan tanda tangan dengan metode ajax
        function simpanTtd(event){
            var signature = signaturePad.toDataURL();
            var id = $(event).attr('data-id');
            var peran = $(event).attr('data-peran');
            $.ajax({
                url: "{{route('tanda-tangan.store')}}",
                type: "POST",
                data: {
                    ttd: signature,
                    id: id,
                    peran: peran

                },
                success: function () {
                    // alert('Berhasil menyimpan tanda tangan');
                    toastr.options = {
                                    "debug": false,
                                    "positionClass": "toast-top-left",
                                    "onclick": null,
                                    "fadeIn": 300,
                                    "fadeOut": 1000,
                                    "timeOut": 5000,
                                    "extendedTimeOut": 1000
                                }
                    toastr.success('Dokumen berhasil ditandatangani!','Lihat Dokumen Sekarang!')
                    signaturePad.clear();
                }
            })
        }

        //fungsi untuk menyimpan tanda tangan sebelumnya dengan metode ajax
        function gunakanTTDSebelumnya(event){
            var id = $(event).attr('data-id');
            var peran = $(event).attr('data-peran');
            var URL = "{{route('tanda-tangan.update', ':id')}}";
            var newURL = URL.replace(':id', id);
            $.ajax({
                url: newURL,
                type: "PUT",
                data: {
                    id: id,
                    peran: peran
                },
                success: function () {
                    toastr.options = {
                                    "debug": false,
                                    "positionClass": "toast-top-left",
                                    "onclick": null,
                                    "fadeIn": 300,
                                    "fadeOut": 1000,
                                    "timeOut": 5000,
                                    "extendedTimeOut": 1000
                                }
                    toastr.success('Dokumen berhasil ditandatangani!','Lihat Dokumen Sekarang!')
                    signaturePad.clear();
                },
                error: function (xhr) { //jika error tampilkan error pada console
                      toastr.options = {
                                    "debug": false,
                                    "positionClass": "toast-top-left",
                                    "onclick": null,
                                    "fadeIn": 300,
                                    "fadeOut": 1000,
                                    "timeOut": 5000,
                                    "extendedTimeOut": 1000
                                }
                    toastr.error(xhr.responseJSON.text,'Gagal Menyimpan Tanda Tangan!')
                }
            })
        }
      </script>
      <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
      <script src="{{asset('js/signaturepad.js')}}"></script>
</html>
