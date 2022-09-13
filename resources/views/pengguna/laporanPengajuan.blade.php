@extends('layouts.utama')
@section('content')
<!-- ======= Laporan Pengajuan Section ======= -->
<div class="container" >
    <div id="laporan-pengajuan" class="laporan-pengajuan">
        <div class="container mt-4" data-aos="fade-up">
            <div class="content">
                <h1 class="mb-5">Laporan Pengajuan {{Auth::user()->name}}</h1>
                <div class="content-keranjang">
                    <div class="row">
                        <!-- Feature Tabs -->
                        <div class="row laporan-pengajuan-tabs" data-aos="fade-up">
                                <!-- Tabs -->
                                <ul class="nav nav-pills mb-3 d-flex justify-content-center">
                                    <li>
                                        <a class="nav-link active" data-bs-toggle="pill" href="#pengajuan">Pengajuan</a>
                                    </li>
                                    <li>
                                        <a class="nav-link" data-bs-toggle="pill" href="#validasi">Proses Validasi</a>
                                    </li>
                                    <li>
                                        <a class="nav-link" data-bs-toggle="pill" href="#dokumen">Proses Dokumen</a>
                                    </li>
                                    <li>
                                        <a class="nav-link" data-bs-toggle="pill" href="#selesai">Selesai</a>
                                    </li>
                                    <li>
                                        <a class="nav-link" data-bs-toggle="pill" href="#ditolak">Ditolak</a>
                                    </li>
                                    <li>
                                        <a class="nav-link" data-bs-toggle="pill" href="#dibatalkan">Dibatalkan</a>
                                    </li>
                                    <li>
                                        <a class="nav-link" data-bs-toggle="pill" href="#semua">Semua</a>
                                    </li>
                                </ul><!-- End Tabs -->

                                <!-- Tab Content -->
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="pengajuan">
                                        <div class="table-responsive text-nowrap">
                                            <table id="pengajuan-datatable" class="datatable row-border hover" style="width: 100%;" cellspacing="0">
                                                <thead style="text-align: center; width: 100%;">
                                                    <tr>
                                                        <th>Nomor Transaksi</th>
                                                        <th>Pembuat Pengajuan</th>
                                                        <th>Tanggal Pengajuan</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div><!-- End Tab pengajuan Content -->
                                    <div class="tab-pane fade show" id="validasi">
                                        <div class="table-responsive text-nowrap">
                                            <table id="validasi-datatable" class="datatable row-border hover" style="width: 100%;" cellspacing="0">
                                                <thead style="text-align: center; width: 100%;">
                                                    <tr>
                                                        <th>Nomor Transaksi</th>
                                                        <th>Pembuat Pengajuan</th>
                                                        <th>Tanggal Pengajuan</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div><!-- End Tab validasi Content -->
                                    <div class="tab-pane fade show" id="dokumen">
                                        <div class="table-responsive text-nowrap">
                                            <table id="dokumen-datatable" class="datatable row-border hover" style="width: 100%;" cellspacing="0">
                                                <thead style="text-align: center; width: 100%;">
                                                    <tr>
                                                        <th>Nomor Transaksi</th>
                                                        <th>Pembuat Pengajuan</th>
                                                        <th>Tanggal Pengajuan</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div><!-- End Tab dokumen Content -->
                                    <div class="tab-pane fade show" id="selesai">
                                        <div class="table-responsive text-nowrap">
                                            <table id="selesai-datatable" class="datatable row-border hover" style="width: 100%;" cellspacing="0">
                                                <thead style="text-align: center; width: 100%;">
                                                    <tr>
                                                        <th>Nomor Transaksi</th>
                                                        <th>Pembuat Pengajuan</th>
                                                        <th>Tanggal Pengajuan</th>
                                                        <th>Unduh Dokumen Pengajuan</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div><!-- End Tab selesai Content -->
                                    <div class="tab-pane fade show" id="ditolak">
                                        <div class="table-responsive text-nowrap">
                                            <table id="ditolak-datatable" class="datatable row-border hover" style="width: 100%;" cellspacing="0">
                                                <thead style="text-align: center; width: 100%;">
                                                    <tr>
                                                        <th>Nomor Transaksi</th>
                                                        <th>Pembuat Pengajuan</th>
                                                        <th>Tanggal Pengajuan</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div><!-- End Tab ditolak Content -->
                                    <div class="tab-pane fade show" id="dibatalkan">
                                        <div class="table-responsive text-nowrap">
                                            <table id="dibatalkan-datatable" class="datatable row-border hover" style="width: 100%;" cellspacing="0">
                                                <thead style="text-align: center; width: 100%;">
                                                    <tr>
                                                        <th>Nomor Transaksi</th>
                                                        <th>Pembuat Pengajuan</th>
                                                        <th>Tanggal Pengajuan</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div><!-- End Tab dibatalkan Content -->
                                    <div class="tab-pane fade show" id="semua">
                                        <div class="table-responsive text-nowrap">
                                            <table id="semua-datatable" class="datatable row-border hover" style="width: 100%;" cellspacing="0">
                                                <thead style="text-align: center; width: 100%;">
                                                    <tr>
                                                        <th>Nomor Transaksi</th>
                                                        <th>Pembuat Pengajuan</th>
                                                        <th>Tanggal Pengajuan</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div><!-- End Tab semua  Content -->
                                </div>
                        </div><!-- End Feature Tabs -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
<!--Modal show laporan-pengajuan-->
<div class="modal fade" id="laporan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="laporan-pengajuan-title">Detail Pengajuan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Feature Tabs -->
                <div class="row keranjang-tabs" data-aos="fade-up">
                    <!-- Tabs -->
                    <ul class="nav nav-pills mb-3 d-flex justify-content-center">
                        <li>
                            <a class="nav-link active" data-bs-toggle="pill" href="#laporan-barang-tresedia">Laporan Barang Tersedia</a>
                        </li>
                        <li>
                            <a class="nav-link" data-bs-toggle="pill" href="#laporan-barang-tidak-tersedia">Laporan Barang Tidak Tersedia</a>
                        </li>
                    </ul><!-- End Tabs -->
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="laporan-barang-tresedia">
                            <div class="table-responsive text-nowrap">
                                <table id="detail-laporan-pengajuan-barang-tersedia-datatable" class="datatable row-border hover" style="width: 100%;" cellspacing="0">
                                    <thead style="text-align: center; width: 100%;">
                                        <tr>
                                            <th>Nama Barang</th>
                                            <th>Jumlah Pengajuan</th>
                                            <th>Revisi Jumlah Pengajuan</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane fade show" id="laporan-barang-tidak-tersedia">
                            <div class="table-responsive text-nowrap">
                                <table id="detail-laporan-pengajuan-barang-tidak-tersedia-datatable" class="datatable row-border hover" style="width: 100%;" cellspacing="0">
                                    <thead style="text-align: center; width: 100%;">
                                        <tr>
                                            <th>Nama Barang</th>
                                            <th>Jumlah Pengajuan</th>
                                            <th>Jumlah Disesuaikan</th>
                                            <th>Satuan</th>
                                            <th>Status</th>
                                            <th>Disesuaikan Dengan</th>
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
<!--Modal show laporan-pengajuan-->
<!--Modal show halaman tanda tangan-->
<div class="modal fade" id="modalHalamanTandaTangan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="laporan-pengajuan-title">Link Halaman Tanda Tangan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex flex-row justify-content-around mx-5">
                    <div class="tanda-tangan-administrator">
                        <p style="text-align: center; font-weight: 500;">Link Administrator</p>
                        <div class="url_halaman_tanda_tangan_administrator" style="text-align: center;" data-id="">     
                        </div>
                        <div style="text-align: center;">
                            <p>Dapat Juga Diakses Melalui : </p>
                            <h5 class="alamat_link_administrator"></h5>
                        </div>
                    </div>
                    <div class="tanda-tangan-penerima">
                        <p style="text-align: center; font-weight: 500;">Link Penerima</p>
                        <div class="url_halaman_tanda_tangan_penerima" style="text-align: center;" data-id="">     
                        </div>
                        <div style="text-align: center;">
                            <p>Dapat Juga Diakses Melalui : </p>
                            <h5 class="alamat_link_penerima"></h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-dismiss="modal">Keluar</button>
                <a href="" id="unduhDokumen" target=”_blank”>
                    <button type="button" class="btn btn-sm btn-outline-primary" style="width: max-content ;">Lihat Dokumen</button>
                </a>
            </div>
        </div>
    </div>
</div>
<!--Modal show halaman tanda tangan-->

<!-- End laporan pengajuan Section -->
@endsection
@push('scripts')
<script>
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
        }   
    });

    $(document).ready(function () {
        $('a[data-bs-toggle="pill"]').on('shown.bs.tab', function (e) {
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });

        $('#pengajuan-datatable').DataTable({
            processing: true,
            serverSide: true, 
            responsive: true,
            ajax: {
                url: "{{ route('laporan-pengajuan.pengajuan') }}",
                type: 'GET'
            }, columns: [{
                    data: 'nomor_transaksi',
                    name: 'nomor_transaksi'
                },
                {
                    data: 'pembuat_pengajuan',
                    name: 'pembuat_pengajuan'
                },
                {
                    data: 'tanggal_pengajuan',
                    name: 'tanggal_pengajuan'
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
    
        $('#validasi-datatable').DataTable({
            processing: true,
            serverSide: true, 
            responsive: true,
            ajax: {
                url: "{{ route('laporan-pengajuan.validasi') }}",
                type: 'GET'
            }, columns: [{
                    data: 'nomor_transaksi',
                    name: 'nomor_transaksi'
                },
                {
                    data: 'pembuat_pengajuan',
                    name: 'pembuat_pengajuan'
                },
                {
                    data: 'tanggal_pengajuan',
                    name: 'tanggal_pengajuan'
                },
            ],
                order: [
                    [0, 'desc']
            ]
        });
    
        $('#dokumen-datatable').DataTable({
            processing: true,
            serverSide: true, 
            responsive: true,
            ajax: {
                url: "{{ route('laporan-pengajuan.dokumen') }}",
                type: 'GET'
            }, columns: [{
                    data: 'nomor_transaksi',
                    name: 'nomor_transaksi'
                },
                {
                    data: 'pembuat_pengajuan',
                    name: 'pembuat_pengajuan'
                },
                {
                    data: 'tanggal_pengajuan',
                    name: 'tanggal_pengajuan'
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

        $('#selesai-datatable').DataTable({
            processing: true,
            serverSide: true, 
            responsive: true,
            ajax: {
                url: "{{ route('laporan-pengajuan.selesai') }}",
                type: 'GET'
            }, columns: [{
                    data: 'nomor_transaksi',
                    name: 'nomor_transaksi'
                },
                {
                    data: 'pembuat_pengajuan',
                    name: 'pembuat_pengajuan'
                },
                {
                    data: 'tanggal_pengajuan',
                    name: 'tanggal_pengajuan'
                },
                {
                    data: 'cetak_dokumen',
                    name: 'cetak_dokumen'
                }
            ],
                order: [
                    [0, 'desc']
            ]
        });

        $('#ditolak-datatable').DataTable({
            processing: true,
            serverSide: true, 
            responsive: true,
            ajax: {
                url: "{{ route('laporan-pengajuan.ditolak') }}",
                type: 'GET'
            }, columns: [{
                    data: 'nomor_transaksi',
                    name: 'nomor_transaksi'
                },
                {
                    data: 'pembuat_pengajuan',
                    name: 'pembuat_pengajuan'
                },
                {
                    data: 'tanggal_pengajuan',
                    name: 'tanggal_pengajuan'
                },
            ],
                order: [
                    [0, 'desc']
            ]
        });

        $('#dibatalkan-datatable').DataTable({
            processing: true,
            serverSide: true, 
            responsive: true,
            ajax: {
                url: "{{ route('laporan-pengajuan.dibatalkan') }}",
                type: 'GET'
            }, columns: [{
                    data: 'nomor_transaksi',
                    name: 'nomor_transaksi'
                },
                {
                    data: 'pembuat_pengajuan',
                    name: 'pembuat_pengajuan'
                },
                {
                    data: 'tanggal_pengajuan',
                    name: 'tanggal_pengajuan'
                },
            ],
                order: [
                    [0, 'desc']
            ]
        });

        $('#semua-datatable').DataTable({
            processing: true,
            serverSide: true, 
            responsive: true,
            ajax: {
                url: "{{ route('laporan-pengajuan.index') }}",
                type: 'GET'
            }, columns: [{
                    data: 'nomor_transaksi',
                    name: 'nomor_transaksi'
                },
                {
                    data: 'pembuat_pengajuan',
                    name: 'pembuat_pengajuan'
                },
                {
                    data: 'tanggal_pengajuan',
                    name: 'tanggal_pengajuan'
                },
                {
                    data: 'status',
                    name: 'status'
                },
            ],
                order: [
                    [0, 'desc']
            ]
        });

        $("#modalHalamanTandaTangan").on("hidden.bs.modal", function(){
            $(".url_halaman_tanda_tangan_administrator").html("");
            $(".url_halaman_tanda_tangan_penerima").html("");
        });

        
    });

    function detailLaporanPengajuanBarangTersedia (event){
        var id = $(event).attr('data-id');
        var URL = "{{route('laporan-pengajuan.show', ':id')}}";
        var newURL = URL.replace(':id', id);
        detailLaporanPengajuanBarangTidakTersedia(id);
        $('#detail-laporan-pengajuan-barang-tersedia-datatable').DataTable({
            processing: true,
            serverSide: true, 
            responsive: true,
            searching :false,
            bDestroy: true,
            ajax: {
                url:newURL,
                type: 'GET'
            }, columns: [{
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
                    data: 'status',
                    name: 'status'
                },
            ],
                order: [
                    [0, 'desc']
            ]
        });

        
    }
    function detailLaporanPengajuanBarangTidakTersedia(id){
        var URL = "{{route('laporan-barang-tidak-tersedia.show', ':id')}}";
        var newURL = URL.replace(':id', id);
        $('#detail-laporan-pengajuan-barang-tidak-tersedia-datatable').DataTable({
            processing: true,
            serverSide: true, 
            responsive: true,
            searching :false,
            bDestroy: true,
            ajax: {
                url:newURL,
                type: 'GET'
            }, columns: [{
                    data: 'nama_barang',
                    name: 'nama_barang'
                },
                {
                    data: 'jumlah_barang',
                    name: 'jumlah_barang'
                },
                {
                    data: 'jumlah_disesuaikan',
                    name: 'jumlah_disesuaikan'
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
            ],
                order: [
                    [0, 'desc']
            ]
        });
    }
    function batalTransaksi(event){
        var status = 6;
        var id = $(event).attr('data-id')
        var URL = "{{route('transaksi.update', ':id')}}";
        var newURL = URL.replace(':id', id);
        swal({
            title: 'Apakah Anda yakin?',
            text: 'Membatalkan transaksi ini?',
            icon: 'warning',
            dangerMode: true,
            buttons: true,
        }).then((willdelete)=>{
            if(willdelete){
                $.ajax({
                    url:newURL,
                    type:"PUT",
                    data:{
                        status:status
                    },
                    success: function($data){
                        $('#pengajuan-datatable').DataTable().ajax.reload();
                        $('#dibatalkan-datatable').DataTable().ajax.reload();
                        swal("Selamat!", "Transaksi berhasil dibatalkan!", "success");
                    },
                    error: function (xhr) {
                        swal({
                            title: 'Gagal membatalkan transaksi!',
                            icon: 'warning',
                            buttons: "Kembali"
                        })
                    }
                })
            };
        });
    };
    function halamanTandaTangan(event){
        var id = $(event).attr('data-transaksi');
        var administratorId = $(event).attr('data-administratorId');
        var penerimaId = $(event).attr('data-penerimaId');
        var urlQRCode = "{{route('tandatangan.index',[':id',':peran',':user'])}}";
        var newUrlQRCode= urlQRCode.replace(':id', id);
        var administratorQrCode = newUrlQRCode.replace(':user', administratorId).replace(':peran', 'administrator')
        var penerimaQrCode = newUrlQRCode.replace(':user', penerimaId).replace(':peran', 'penerima')
        var unduhDokumen = "{{route('proses-dokumen.show', ':id')}}";
        var urlUnduhDokumen = unduhDokumen.replace(':id', id);
        jQuery('.url_halaman_tanda_tangan_administrator').qrcode(administratorQrCode)
        $('.alamat_link_administrator').html(administratorQrCode);
        jQuery('.url_halaman_tanda_tangan_penerima').qrcode(penerimaQrCode)
        $('.alamat_link_penerima').html(penerimaQrCode);
        $('#kembali_lihat_dokumen').attr('data-transaksi',id);
        $('#unduhDokumen').attr('href', urlUnduhDokumen);
    }
</script>
@endpush