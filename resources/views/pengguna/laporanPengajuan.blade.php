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
                                        <a class="nav-link" data-bs-toggle="pill" href="#selesai">Diterima</a>
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
                                                        <th>Tanggal Pengajuan</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div><!-- End Tab valdasi Content -->
                                    <div class="tab-pane fade show" id="selesai">
                                        <div class="table-responsive text-nowrap">
                                            <table id="selesai-datatable" class="datatable row-border hover" style="width: 100%;" cellspacing="0">
                                                <thead style="text-align: center; width: 100%;">
                                                    <tr>
                                                        <th>Nomor Transaksi</th>
                                                        <th>Tanggal Pengajuan</th>
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
                                                        <th>Tanggal Pengajuan</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div><!-- End Tab dibatalkan Content -->
                                </div>
                        </div><!-- End Feature Tabs -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
<!--Modal show laporan-pengajuan-->
<div class="modal fade bd-example-modal-lg" id="laporan" tabindex="-1" role="dialog" aria-hidden="true">
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
                            <th>Nama Barang</th>
                            <th>Jumlah Pengajuan</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<!--Modal show laporan-pengajuan-->
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
        // $('#laporan-pengajuan').modal('show')
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
                    data: 'tanggal_pengajuan',
                    name: 'tanggal_pengajuan'
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
                    data: 'tanggal_pengajuan',
                    name: 'tanggal_pengajuan'
                },
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

        
    });

    function detailLaporanPengajuan (event){
        var id = $(event).data('id');
        var URL = "{{route('laporan-pengajuan.show', 'id')}}";
        var newURL = URL.replace('id', id);
        $('#detail-laporan-datatable').DataTable({
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
            ],
                order: [
                    [0, 'desc']
            ]
        });
    }

    function batalTransaksi(event){
        var data = 6;
        var data_id = $(event).data('id')
        var URL = "{{route('transaksi.update', 'id')}}";
        var newURL = URL.replace('id', data_id);
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
                        data:data
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
</script>
@endpush