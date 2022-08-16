@extends('layouts.admin')
@section('content')
<div class="content-wrapper" >
    <div class="container-xxl flex-grow-1 container-p-y" >
        <div class="row">
            <div class="col-md-12">
                <div class="card h-100">
                    <div class="card-header mb-3 d-flex align-items-center justify-content-between pb-0">
                        <h3 class="m-2 me-2">Proses Validasi</h3>
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
            <div class="modal-footer"> 
                <button type="button" class="update-status btn btn-outline-danger" data-transaksi="" data-notransaksi="" data-update="4" onclick="updateTransaksi(event.target)"> Tolak Pengajuan </button>
                <button type="button" class="update-status btn btn-outline-primary" data-transaksi="" data-notransaksi="" data-update="3" onclick="updateTransaksi(event.target)"> Terima Pengajuan </button>
            </div>
        </div>
    </div>
</div>
<!--Modal show laporan-pengajuan-->

<!--Modal revisi laporan-pengajuan-->
<div class="modal fade" id="revisiPengajuan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="laporan-pengajuan-title">Revisi Pengajuan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-revisi" name="ItemForm">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="stok" class="form-label">Stok Saat Ini</label>
                                <input disabled type="text" id="stok" name="stok" class="form-control" value=""/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="jumlah_barang" class="form-label">Jumlah Barang yang Diajukan</label>
                                <input disabled type="number" id="jumlah_barang" name="jumlah_barang" class="form-control" value=""/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="revisi_jumlah_barang" class="form-label">Revisi Jumlah Barang yang Diajukan</label>
                                <input type="number" id="revisi_jumlah_barang" name="revisi_jumlah_barang" class="form-control" placeholder="Masukan Revisi"/>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer"> 
                        <button type="button" id="revisi-laporan" class="revisi-laporan btn btn-outline-danger" data-transaksi="" data-laporan="" data-notransaksi="" data-bs-toggle="modal" data-bs-target="#exLargeModal" onclick="detailLaporanPengajuan(event.target)"> Kembali </button>
                        <button type="button" id="revisi-laporan" class="revisi-laporan btn btn-outline-primary" data-transaksi="" data-laporan="" data-notransaksi="" onclick="createRevisiLaporan(event.target)"> Proses Revisi </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Modal revisi laporan-pengajuan-->

<!--Modal sesuaikan permintaan-->
<div class="modal fade" id="sesuaikanPermintaan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="laporan-pengajuan-title">Sesuaikan Pengajuan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-sesuai" name="ItemForm">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nama_barang_permintaan" class="form-label">Nama Barang Pengajuan</label>
                                <input disabled type="text" id="nama_barang_permintaan" name="nama_barang_permintaan" class="form-control" value=""/>
                            </div>
                            <div class="col mb-3">
                                <label for="barang_id" class="form-label" >Nama Barang Pada Persediaan</label>
                                <select type="select" name="barang_id" id="barang_id" style="width: 100% ;" class="js-example-basic-single select2 form-control" name="states">
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="jumlah_barang_permintaan" class="form-label">Jumlah Pengajuan Barang</label>
                                <input disabled type="text" id="jumlah_barang_permintaan" name="jumlah_barang_permintaan" class="form-control" value=""/>
                            </div>
                            <div class="col mb-3">
                                <label for="revisi_jumlah_barang_penyesuaian" class="form-label">Jumlah Barang Disetujui</label>
                                <input type="number" id="revisi_jumlah_barang_penyesuaian" name="revisi_jumlah_barang_penyesuaian" class="form-control" value=""/>
                                <label for="stok_persediaan" class="form-label">Stok</label>
                                <input disabled type="number" id="stok_persediaan" name="stok_persediaan" class="form-control" value=""/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="satuan_permintaan" class="form-label">Satuan Pengajuan</label>
                                <input disabled type="text" id="satuan_permintaan" name="satuan_permintaan" class="form-control" value=""/>
                            </div>
                            <div class="col mb-3">
                                <label for="satuan_persediaan" class="form-label">Satuan Persediaan</label>
                                <input disabled type="text" id="satuan_persediaan" name="satuan_persediaan" class="form-control" value=""/>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer"> 
                        <button type="button" id="sesuaikan-permintaan" class="sesuaikan-permintaan btn btn-outline-danger" data-transaksi="" data-laporan="" data-notransaksi="" data-bs-toggle="modal" data-bs-target="#exLargeModal" onclick="detailLaporanPengajuan(event.target)"> Kembali </button>
                        <button type="button" id="sesuaikan-permintaan" class="sesuaikan-permintaan btn btn-outline-primary" data-transaksi="" data-laporan="" data-notransaksi="" onclick="createSesuaikanPermintaan(event.target)"> Proses Penyesuaian </button>
                    </div>
                </form>
        </div>
    </div>
</div>
<!--Modal revisi laporan-pengajuan-->


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
                url: "{{ route('proses-validasi.index') }}",
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
        if(status == 3){
            var text = 'Yakin menerima proses transaksi ini? Pastikan semua Pengajuan Barang Tidak Tersedia telah disesuaikan!'
            var dangerMode = false;
            var icon = "info";
            var swall_success = "Transaksi berhasil diterima!"
            var error_title = "Gagal menerima transaksi!"
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

    function revisiItemPengajuan (event){
        var laporan_pengajuan_id = $(event).attr('data-laporan');
        var transaksi_id = $(event).attr('data-transaksi');
        var nomor_transaksi = $(event).attr('data-notransaksi');
        var jumlah_barang = $(event).attr('data-jumlahbarang');
        var stok = $(event).attr('data-stok');
        $('.revisi-laporan').attr("data-laporan",laporan_pengajuan_id);
        $('.revisi-laporan').attr("data-transaksi",transaksi_id);
        $('.revisi-laporan').attr("data-notransaksi",nomor_transaksi);
        $('#jumlah_barang').val(jumlah_barang);
        $('#stok').val(stok);
    };

    function updateStatusItemPengajuan (event){
        var laporan_pengajuan_id = $(event).attr('data-laporan');
        var data = $(event).attr('data-update');
        var nama_barang = $(event).attr('data-barang');
        var URL = "{{route('laporan-pengajuan.update', ':id')}}";
        var newURL = URL.replace(':id', laporan_pengajuan_id);
        if(data == 1){
            var text = "Apakah Anda yakin menyetujui item pengajuan ini?";
            var icon = 'info';
            var dangerMode =false;
            var msg = 'Item pengajuan berhasil disetujui!';
        }else{
            var text = "Apakah Anda yakin menolak item pengajuan ini?";
            var icon = 'warning';
            var dangerMode =true;
            var msg = 'Item pengajuan berhasil ditolak!';
        }
        swal({
            title: nama_barang,
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
                        detailLaporanPengajuan(event)
                        swal("Selamat!", msg, "success");
                    },
                    error: function (xhr) {
                        swal({
                            title: 'Gagal merubah status persetujuan barang!',
                            icon: 'warning',
                            buttons: "Kembali"
                        })
                    }
                })
            };
        });

    };

    function createRevisiLaporan (event){
        var revisi_jumlah_barang = $('#revisi_jumlah_barang').val();
        var stok = $('#stok').val();
        var laporan_pengajuan_id = $(event).attr('data-laporan');
        var transaksi_id = $(event).attr('data-transaksi');
        $.ajax({
            url:"{{route('proses-validasi.store')}}",
            type:"POST",
            typeData:"JSON",
            data:{
                revisi_jumlah_barang:revisi_jumlah_barang,
                stok:stok,
                laporan_pengajuan_id:laporan_pengajuan_id,
                transaksi_id:transaksi_id
            }, 
            success: function(data){
                detailLaporanPengajuan(event)
                $('#exLargeModal').modal('show')
                $('#form-revisi').trigger("reset");
                $('#revisiPengajuan').modal('hide')
            },
            error: function (xhr) {
                toastr.error(xhr.responseJSON.text,'Gagal Memproses Data!')
            }
        })
    };

    function sesuaikanPermintaan (event){
        var laporan_pengajuan_tidak_tersedia_id = $(event).attr('data-laporan');
        var transaksi_id = $(event).attr('data-transaksi');
        var nomor_transaksi = $(event).attr('data-notransaksi');
        var nama_barang_permintaan = $(event).attr('data-barang');
        var jumlah_barang_permintaan= $(event).attr('data-jumlahbarang');
        var satuan_permintaan = $(event).attr('data-satuan');
        $('.sesuaikan-permintaan').attr("data-laporan",laporan_pengajuan_tidak_tersedia_id);
        $('.sesuaikan-permintaan').attr("data-transaksi",transaksi_id);
        $('.sesuaikan-permintaan').attr("data-notransaksi",nomor_transaksi);
        $('#nama_barang_permintaan').val(nama_barang_permintaan);
        $('#jumlah_barang_permintaan').val(jumlah_barang_permintaan);
        $('#satuan_permintaan').val(satuan_permintaan);
        triggerSelect2();
        $('.js-example-basic-single').select2({
            placeholder: 'Pilih Barang...',
            dropdownParent: $('#sesuaikanPermintaan'),
            allowClear: true,
            ajax:{
                url: "{{route('get-barang')}}",
                dataType: 'json',
                delay: 250,
                dropdownCssClass: "bigdrop",
                processResults: function (data) {
                    return {
                        results:  $.map(data, function (item) {
                            return {
                                text: item.nama_barang,
                                id: item.id
                            } 
                        })
                    };
                }
            }
        })
        
        
    };

    function triggerSelect2(){
        $('.js-example-basic-single').on("select2:select", function(e) { 
            var id = $("#barang_id").val();
            var URL = "{{route('barang.show', ':id')}}";
            var newURL = URL.replace(':id', id);
            $.ajax({
                url:newURL,
                method:"GET",
                dataType:'JSON',
                success: function(barang){
                    $('#stok_persediaan').val(barang.stok);
                    $('#satuan_persediaan').val(barang.satuan.nama_satuan);
                }
            })
        });
    };

    function createSesuaikanPermintaan(event){
        var laporan_pengajuan_tidak_tersedia_id = $(event).attr('data-laporan');
        var transaksi_id = $(event).attr('data-transaksi');
        var barang_id = $('#barang_id').val();
        var jumlah_barang = $('#revisi_jumlah_barang_penyesuaian').val();
        var status_item_pengajuan_id = '6';
        swal({
            title: 'Yakin menyesuaikan permintaan pada persediaan ini?',
            text: 'Data yang sudah disesuaikan tidak dapat dirubah!',
            icon: 'warning',
            dangerMode:true,
            buttons: true,
        }).then((willstore)=>{
            if(willstore){
                $.ajax({
                    url: "{{route('sesuaikan-permintaan')}}",
                    type: "POST",
                    typeData:"JSON",
                    data:{
                        id : laporan_pengajuan_tidak_tersedia_id,
                        transaksi_id : transaksi_id,
                        barang_id : barang_id,
                        jumlah_barang:jumlah_barang,
                        status_item_pengajuan_id: status_item_pengajuan_id
                    }, 
                    success: function(){
                        detailLaporanPengajuan(event)
                        $('#exLargeModal').modal('show')
                        $('#form-sesuai').trigger("reset");
                        $('.js-example-basic-single').html("");
                        $('#sesuaikanPermintaan').modal('hide')
                    },
                    error: function (xhr) {
                        toastr.error(xhr.responseJSON.text,'Gagal Memproses Data!')
                    }
                })
            }
        })
    };
</script>
@endsection