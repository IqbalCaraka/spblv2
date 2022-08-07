@extends('layouts.admin')
@section('content')
<div class="content-wrapper" >
    <div class="container-xxl flex-grow-1 container-p-y" >
        <div class="row">
            <div class="col-md-12">
                <div class="card h-100">
                    <div class="card-header mb-3 d-flex align-items-center justify-content-between pb-0">
                        <h3 class="m-2 me-2">Daftar Pengajuan</h3>
                    </div>
                    <div class="card-body">
                        <table id="pengajuan-datatable" class="datatable row-border hover" style="width: 100%;" cellspacing="0">
                            <thead style="text-align: center; width: 100%;">
                                <tr>
                                    <th>No</th>
                                    <th>Nomor Transaksi</th>
                                    <th>Pembuat Pengajuan</th>
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

<!--Modal show laporan-pengajuan-->
<div class="modal fade bd-example-modal-lg" id="laporan" data-id="" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="laporan-pengajuan-title">Detail Pengajuan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table id="detail-laporan-datatable" class="datatable row-border hover" style="width: 100%;" cellspacing="0">
                    <thead style="text-align: center; width: 100%;">
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Jumlah Barang</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="modal-footer"> 
                <button type="button" class="update-status btn btn-outline-danger" data-transaksi="" data-notransaksi="" data-update="4" onclick="updateTransaksi(event.target)"> Tolak </button>
                <button type="button" class="update-status btn btn-outline-primary" data-transaksi="" data-notransaksi="" data-update="2" onclick="updateTransaksi(event.target)"> Proses Validasi </button>
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
                url: "{{ route('to-do-list.index') }}",
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
        
    function detailLaporanPengajuan (event){
        var transaksi_id = $(event).attr('data-transaksi');
        var nomor_transaksi = $(event).attr('data-notransaksi');
        var URL = "{{route('laporan-pengajuan.show', 'id')}}";
        var newURL = URL.replace('id', transaksi_id);
        $('.update-status').attr("data-transaksi",transaksi_id);
        $('.update-status').attr("data-notransaksi",nomor_transaksi);
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
                },{
                    data: 'nama_barang',
                    name: 'nama_barang'
                },
                {
                    data: 'jumlah_barang',
                    name: 'jumlah_barang'
                },
            ],
                order: [
                    [0, 'desc']
            ]
        });
    };

    function updateTransaksi (event){
        var data = $(event).attr('data-update')
        var nomor_transaksi = $(event).attr('data-notransaksi')
        var transaksi_id = $(event).attr('data-transaksi')
        var URL = "{{route('transaksi.update', 'id')}}";
        var newURL = URL.replace('id', transaksi_id);
        if(data == 2){
            var text = 'Yakin melakukan proses validasi pada transaksi ini?'
            var dangerMode = false;
            var icon = "info";
            var swall_success = "Transaksi berhasil divalidasi!"
            var error_title = "Gagal mevalidasi transaksi!"
        }else if(data == 4){
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
                        data:data
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
    }
</script>
@endsection