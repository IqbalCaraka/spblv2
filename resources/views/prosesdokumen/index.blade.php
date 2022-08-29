@extends('layouts.admin')
@section('content')
<div class="content-wrapper" >
    <div class="container-xxl flex-grow-1 container-p-y" >
        <div class="row">
            <div class="col-md-12">
                <div class="card h-100">
                    <div class="card-header mb-3 d-flex align-items-center justify-content-between pb-0">
                        <h3 class="m-2 me-2">Daftar Transaksi Sedang Proses Dokumen</h3>
                    </div>
                    <div class="card-body">
                        <table id="pengajuan-datatable" class="datatable table row-border hover" style="width: 100%;" cellspacing="0">
                            <thead style="text-align: center; width: 100%;">
                                <tr>
                                    <th>No</th>
                                    <th>Nomor Transaksi</th>
                                    <th>Pembuat Pengajuan</th>
                                    <th>Bidang</th>
                                    <th>Jumlah Item Barang</th>
                                    <th>Total Barang</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!--Modal show tanda tangan-->
<div class="modal fade" id="modalAksi" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="laporan-pengajuan-title">Status Dokumen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card-body">
                                <div class="hori-timeline" dir="ltr">
                                    <ul class="list-inline events">
                                        <li class="list-inline-item event-list">
                                            <div class="px-4">                                           
                                                <h5 class="font-size-16">Kasubag Umum</h5>
                                                <p class="text-muted" id="nama_kasubag_umum"></p>
                                                <div class="check_kasub_umum mb-3">
                                                </div> 
                                                <div>
                                                    <a href="#">
                                                        <button class="btn btn-outline-primary btn-md tanda_tangan" id="tanda_tangan_kasubag_umum" data-peran="kasub_umum" data-transaksi="" data-bs-toggle="modal" data-bs-target="#modalHalamanTandaTangan" onclick="halamanTandaTangan(event.target)">Tanda Tangan</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-inline-item event-list">
                                            <div class="px-4">
                                                <h5 class="font-size-16" id="jabatan_administrator"></h5>
                                                <p class="text-muted" id="nama_administrator"></p>
                                                <div class="check_administrator mb-3">
                                                </div>
                                                <div>
                                                    <a href="#">
                                                        <button class="btn btn-outline-primary btn-md tanda_tangan" id="tanda_tangan_administrator" data-peran="administrator" data-transaksi="" data-bs-toggle="modal" data-bs-target="#modalHalamanTandaTangan" onclick="halamanTandaTangan(event.target)">Tanda Tangan</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-inline-item event-list">
                                            <div class="px-4">
                                                <h5 class="font-size-16">Yang Menerima</h5>
                                                <p class="text-muted" id="nama_penerima"></p>
                                                <div class="check_penerima mb-3">
                                                </div>
                                                <div>
                                                    <a href="#">
                                                        <button class="btn btn-outline-primary btn-md tanda_tangan" id="tanda_tangan_penerima" data-peran="penerima" data-transaksi="" data-bs-toggle="modal" data-bs-target="#modalHalamanTandaTangan" onclick="halamanTandaTangan(event.target)">Tanda Tangan</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-inline-item event-list">
                                            <div class="px-4">
                                                <h5 class="font-size-16">Yang Menyerahkan</h5>
                                                <p class="text-muted" id="nama_penyerah"></p>
                                                <div class="check_penyerah mb-3">
                                                </div>
                                                <div>
                                                    <a href="#">
                                                        <button class="btn btn-outline-primary btn-md tanda_tangan" id="tanda_tangan_penyerah" data-peran="penyerah" data-id="{{Auth::user()->id}}" data-transaksi="" data-bs-toggle="modal" data-bs-target="#modalHalamanTandaTangan" onclick="halamanTandaTangan(event.target)">Tanda Tangan</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
            <div class="modal-footer"> 
                <button type="button" class="btn btn-outline-danger" data-transaksi="" data-notransaksi="" data-bs-dismiss="modal"> Kembali </button>
                <a href="" id="unduhDokumen" target=”_blank”>
                    <button type="button" class="btn btn-outline-primary"> Lihat Dokumen </button>
                </a>
            </div>
        </div>
    </div>
</div>
<!--Modal show tanda tangan-->

<!--Modal show halaman tanda tangan-->
<div class="modal fade" id="modalHalamanTandaTangan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="laporan-pengajuan-title">Link Halaman Tanda Tangan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="url_halaman_tanda_tangan" style="text-align: center;" data-id="">
                    
                </div>
                <div style="text-align: center;">
                    <p>Dapat Juga Diakses Melalui : </p>
                    <h5 class="alamat_link"></h5>
                </div>
            </div>
            <div class="modal-footer"> 
                <button type="button" id="kembali_lihat_dokumen" class="update-status btn btn-outline-danger" data-transaksi="" data-notransaksi="" data-bs-toggle="modal" data-bs-target="#modalAksi" onclick="lihatDokumen(event.target)" > Kembali </button>
            </div>
        </div>
    </div>
</div>
<!--Modal show halaman tanda tangan-->

<!--Modal show laporan-pengajuan-->
<div class="modal fade" id="exLargeModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="laporan-pengajuan-title">Detail Pengajuan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    <div class="nav-align-top">
                        <ul class="nav nav-pills" role="tablist">
                            <li class="nav-item">
                                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#tersedia" aria-controls="tersedia" aria-selected="true">
                                    Pengajuan Barang Tersedia
                                </button>
                            </li>
                            <li class="nav-item">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#tidak-tersedia" aria-controls="tidak-tersedia" aria-selected="false">
                                    Pengajuan Barang Tidak Tersedia
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tersedia" role="tabpanel">
                                <table id="detail-laporan-datatable" class="datatable row-border hover" style="width: 100%;" cellspacing="0">
                                    <thead style="text-align: center; width: 100%;">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah Pengajuan Barang</th>
                                            <th>Revisi Jumlah Pengajuan Barang</th>
                                            <th>Jumlah Stok</th>
                                            <!-- <th>Harga Satuan</th>
                                            <th>Total Harga Diajukan</th> -->
                                            <th>Persetujuan Barang</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="tab-pane fade show" id="tidak-tersedia" role="tabpanel">
                                <table id="detail-laporan-tidak-tersedia-datatable" class="datatable row-border hover" style="width: 100%;" cellspacing="0">
                                    <thead style="text-align: center; width: 100%;">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah Barang</th>
                                            <th>Satuan</th>
                                            <th>Status Barang</th>
                                            <th>Disesuaikan Dengan</th>
                                            <th>Jumlah Disesuaikan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
<!--Modal show laporan-pengajuan-->
    
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }   
    });

    $('#pengajuan-datatable').DataTable({
            processing: true,
            serverSide: true, 
            responsive: true,
            ajax: {
                url: "{{ route('proses-dokumen.index') }}",
                type: 'GET'
            }, columns: [
                { "data": null,"sortable": false, 
                    render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                            }  
                },
                {
                    data: 'nomor_transaksi',
                    name: 'nomor_transaksi'
                },
                {
                    data: 'pembuat_pengajuan',
                    name: 'pembuat_pengajuan'
                },
                {
                    data: 'bidang',
                    name: 'bidang'
                },
                {
                    data: 'jumlah_barang',
                    name: 'jumlah_barang'
                },
                {
                    data: 'total_barang',
                    name: 'total_barang'
                },
                {
                    data: 'tanggal_pengajuan',
                    name: 'tanggal_pengajuan'
                },
                {
                    data: 'action',
                    name: 'action'
                },
            ]
    });

    function lihatDokumen(event){
        var id = $(event).attr('data-transaksi');
        var URL = "{{route('proses-dokumen.show', ':id')}}";
        var newURL = URL.replace(':id', id);
        $('#unduhDokumen').attr("href", newURL);
        $('#unduhDokumen').attr("data-id", id);
        $('.tanda_tangan').attr("data-transaksi", id);
        $('.url_halaman_tanda_tangan').html("");

        var urlGetDokumen = "{{route('get-dokumen',':id')}}";
        var newUrlGetDokumen= urlGetDokumen.replace(':id', id)
        $.ajax({
            url: newUrlGetDokumen,
            method:"GET",
            dataType: 'json',
            success:function(dokumenPenyerahan){
                $('#nama_kasubag_umum').html(dokumenPenyerahan.kasubumum_user.name);
                $('#tanda_tangan_kasubag_umum').attr('data-id',dokumenPenyerahan.kasubumum_user.id);
                $('#nama_administrator').html(dokumenPenyerahan.administrator_user.name);
                $('#tanda_tangan_administrator').attr('data-id',dokumenPenyerahan.administrator_user.id);
                $('#nama_penerima').html(dokumenPenyerahan.penerima_user.name);
                $('#tanda_tangan_penerima').attr('data-id',dokumenPenyerahan.penerima_user.id);
                
                if(dokumenPenyerahan.penyerah_user == null){
                    $('#nama_penyerah').html(`-`);
                    $('#tanda_tangan_penyerah').attr('data-id',"{{Auth::user()->id}}");
                }else{
                    $('#nama_penyerah').html(dokumenPenyerahan.penyerah_user.name);
                    $('#tanda_tangan_penyerah').attr('data-id',dokumenPenyerahan.penyerah_user.id);
                }

                $('#jabatan_administrator').html(dokumenPenyerahan.administrator_user.jabatan.jabatan)
                if(dokumenPenyerahan.ttd_kasub_umum =="0"){
                    $('.check_kasub_umum').html(
                        `<i class="event-date text-danger bx bx-md bx-x-circle"></i>`
                    )
                }else{
                    $('.check_kasub_umum').html(
                       ` <i class="event-date text-success bx bx-md bx-check-circle"></i>`
                    )
                }

                if(dokumenPenyerahan.ttd_administrator =="0"){
                    $('.check_administrator').html(
                        `<i class="event-date text-danger bx bx-md bx-x-circle"></i>`
                    )
                }else{
                    $('.check_administrator').html(
                       ` <i class="event-date text-success bx bx-md bx-check-circle"></i>`
                    )
                }

                if(dokumenPenyerahan.ttd_penerima =="0"){
                    $('.check_penerima').html(
                        `<i class="event-date text-danger bx bx-md bx-x-circle"></i>`
                    )
                }else{
                    $('.check_penerima').html(
                       ` <i class="event-date text-success bx bx-md bx-check-circle"></i>`
                    )
                }

                if(dokumenPenyerahan.ttd_penyerah =="0"){
                    $('.check_penyerah').html(
                        `<i class="event-date text-danger bx bx-md bx-x-circle"></i>`
                    )
                }else{
                    $('.check_penyerah').html(
                       ` <i class="event-date text-success bx bx-md bx-check-circle"></i>`
                    )
                }
            }
        })

    }

    function halamanTandaTangan(event){
        var id = $(event).attr('data-transaksi');
        var user_id = $(event).attr('data-id');
        var peran = $(event).attr('data-peran');
        var urlQRCode = "{{route('tandatangan.index',[':id',':peran',':user'])}}";
        var newUrlQRCode= urlQRCode.replace(':id', id);
        var newUrlQRCode= newUrlQRCode.replace(':user', user_id);
        var newUrlQRCode= newUrlQRCode.replace(':peran', peran);
        jQuery('.url_halaman_tanda_tangan').qrcode(newUrlQRCode)
        $('.alamat_link').html(newUrlQRCode);
        $('#kembali_lihat_dokumen').attr('data-transaksi',id);
    }

    function detailLaporanPengajuan (event){
        var transaksi_id = $(event).attr('data-transaksi')
        var nomor_transaksi = $(event).attr('data-notransaksi');
        var URL = "{{route('laporan-pengajuan.show', ':id')}}";
        var newURL = URL.replace(':id', transaksi_id);
        $('.update-status').attr("data-transaksi",transaksi_id);
        $('.update-status').attr("data-notransaksi",nomor_transaksi);
        $('#revisi_jumlah_barang').val("")
        detailLaporanPengajuanTidakTersedia(transaksi_id); 
        $('#detail-laporan-datatable').DataTable({
            processing: true,
            serverSide: true, 
            responsive: true,
            searching :false,
            bDestroy: true,
            ajax: {
                url:newURL,
                type: 'GET'
            }, columns: [
                { "data": null,"sortable": false, 
                    render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                            }  
                },
                {
                    data: 'nama_barang',
                    name: 'nama_barang'
                },
                {
                    data: 'jumlah_barang',
                    name: 'jumlah_barang'
                },
                {
                    data: 'revisi_jumlah_barang',
                    name: 'revisi_jumlah_barang'
                },
                {
                    data: 'stok',
                    name: 'stok'
                },
                // {
                //     data: 'harga_satuan',
                //     name: 'harga_satuan'
                // },
                // {
                //     data: 'total_harga',
                //     name: 'total_harga'
                // },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action'
                }
            ],
                order: [
                    [0, 'desc']
            ]
        });
    };

    function detailLaporanPengajuanTidakTersedia (id){
        var URL = "{{route('laporan-barang-tidak-tersedia.show', ':id')}}";
        var newURL = URL.replace(':id', id);
        $('#detail-laporan-tidak-tersedia-datatable').DataTable({
            processing: true,
            serverSide: true, 
            responsive: true,
            searching :false,
            bDestroy: true,
            ajax: {
                url:newURL,
                type: 'GET'
            }, columns: [
                { "data": null,"sortable": false, 
                    render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                            }  
                },{
                    data: 'nama_barang',
                    name: 'nama_barang'
                },
                {
                    data: 'jumlah_barang',
                    name: 'jumlah_barang'
                },
                {
                    data: 'satuan',
                    name: 'satuan'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'laporan_pengajuan',
                    name: 'laporan_pengajuan'
                },
                {
                    data: 'jumlah_disesuaikan',
                    name: 'jumlah_disesuaikan'
                },
                {
                    data: 'action',
                    name: 'action'
                },
            ],
                order: [
                    [0, 'desc']
            ]
        });
    };

    function updateTransaksi (event){
        var status = $(event).attr('data-update');
        var nomor_transaksi = $(event).attr('data-notransaksi');
        var transaksi_id = $(event).attr('data-transaksi');
        var URL = "{{route('transaksi.update', 'id')}}";
        var newURL = URL.replace('id', transaksi_id);
        if(status == 5){
            var text = 'Yakin menyelesaikan proses transaksi ini? Pastikan semua kolom tanda tangan telah di isi!'
            var dangerMode = false;
            var icon = "info";
            var swall_success = "Transaksi berhasil diselesaikan!"
            var error_title = "Gagal menyelesaikan transaksi!"
        }else if(status == 4){
            var text = 'Yakin melakukan penolakan pada transaksi ini?'
            var dangerMode = true;
            var icon = "warning";
            var swall_success = "Transaksi berhasil ditolak"
            var error_title = "Gagal menolak transaksi!"
        }
        swal({
            title: 'Transaksi Nomor '+nomor_transaksi,
            text: text,
            icon: icon,
            dangerMode:dangerMode,
            buttons: true,
        }).then((willupdate)=>{
            if(willupdate){
                $.ajax({
                    url:newURL,
                    type:"PUT",
                    data:{
                        status:status
                    },
                    success: function($data){
                        $('.modal').modal('hide');
                        $('#pengajuan-datatable').DataTable().ajax.reload();
                        swal("Selamat!", swall_success, "success");
                    },
                    error: function (xhr) {
                        swal({
                            title: error_title,
                            icon: 'warning',
                            buttons: "Kembali"
                        })
                    }
                })
            };
        });
    };

    
</script>
@endsection