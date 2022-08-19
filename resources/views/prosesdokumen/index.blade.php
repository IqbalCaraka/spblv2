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
                        <table id="pengajuan-datatable" class="datatable row-border hover" style="width: 100%;" cellspacing="0">
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


<!--Modal show aksi-->
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
                                                    <a href="#" class="btn btn-primary btn-sm">Tanda Tangan</a>
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
                                                    <a href="#" class="btn btn-primary btn-sm">Tanda Tangan</a>
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
                                                    <a href="#" class="btn btn-primary btn-sm">Tanda Tangan</a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-inline-item event-list">
                                            <div class="px-4">
                                                <h5 class="font-size-16">Yang Menyerahkan</h5>
                                                <p class="text-muted" id="nama_penyerah">{{Auth::user()->name}}</p>
                                                <div class="check_penyerah mb-3">
                                                </div>
                                                <div>
                                                    <a href="#" class="btn btn-primary btn-sm">Tanda Tangan</a>
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
                <button type="button" class="update-status btn btn-outline-danger" data-transaksi="" data-notransaksi="" data-bs-dismiss="modal"> Kembali </button>
                <a href="" id="unduhDokumen" target=”_blank”>
                    <button type="button" class="update-status btn btn-outline-primary"> Lihat Dokumen </button>
                </a>
            </div>
        </div>
    </div>
</div>
<!--Modal show laporan-pengajuan-->\
    
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

        var urlGetDokumen = "{{route('get-dokumen',':id')}}";
        var newUrlGetDokumen= urlGetDokumen.replace(':id', id)
        // alert(newUrlGetDokumen)
        $.ajax({
            url: newUrlGetDokumen,
            method:"GET",
            dataType: 'json',
            success:function(dokumenPenyerahan){
                $('#nama_kasubag_umum').html(dokumenPenyerahan.kasubumum_user.name);
                $('#nama_administrator').html(dokumenPenyerahan.administrator_user.name);
                $('#nama_penerima').html(dokumenPenyerahan.penerima_user.name);
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
                // <i class="bx bx-md bx-x-circle" style="color: #ff3e1d;"></i>
                console.log(dokumenPenyerahan.kasubumum_user.name)
                console.log(dokumenPenyerahan.administrator_user.jabatan.jabatan)
                console.log(dokumenPenyerahan.penerima_user.name)
                // if(dokumenPenyerahan.kasubagUmumUser=="0"){
                //     alert('kosong')
                // }
            }
        })

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
            ],
                order: [
                    [0, 'desc']
            ]
        });
    };
    
</script>
@endsection