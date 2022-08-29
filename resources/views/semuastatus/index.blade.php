@extends('layouts.admin')
@section('content')
<div class="content-wrapper" >
    <div class="container-xxl flex-grow-1 container-p-y" >
        <div class="row">
            <div class="col-md-12">
                <div class="card h-100">
                    <div class="card-header mb-3 d-flex align-items-center justify-content-between pb-0">
                        <h3 class="m-2 me-2">Daftar Transaksi Seluruh Status</h3>
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
                                    <th>Status</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="modal-footer"> 
                <button type="button" class="update-status btn btn-outline-danger" data-transaksi="" data-notransaksi="" data-bs-dismiss="modal"> Kembali </button>
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
                url: "{{ route('semua-status.index') }}",
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
                    data: 'status',
                    name: 'status'
                },
            ]
    });

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