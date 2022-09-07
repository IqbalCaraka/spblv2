@extends('layouts.admin')
@section('content')
<div class="content-wrapper" >
    <div class="container-xxl flex-grow-1 container-p-y" >
        <div class="row">
            <div class="col-md-12">
                <div class="card h-100">
                    <div class="card-header mb-3 d-flex align-items-center justify-content-between pb-0">
                        <!-- <button type="button" class="btn rounded-pill btn-primary" data-bs-toggle="modal" data-bs-target="#modalLoading">
                            <span class="tf-icons bx bx-plus-circle"></span>&nbsp; Load
                        </button>  -->
                        <h3 class="m-2 me-2">Laporan Barang</h3>
                        @if(isset($periodeLaporanBarang))

                        @else
                        <button type="button" class="btn rounded-pill btn-warning"  onclick="createPeriodeLaporanBarang(event.target)">
                            @if(isset($periodeLaporanBarangSebelumnya))
                            <span class="tf-icons bx bx-minus-circle"></span>&nbsp; Tutup Buku {{$periodeBulanSebelumnya}}
                            @else
                            <span class="tf-icons bx bx-plus-circle"></span>&nbsp; Buka Buku {{$periodeBulanSekarang}}
                            @endif
                        </button> 
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3 m-2 mb-3">
                                <Label for="mutasi_bulanan">Laporan Barang</Label>
                                <input class="form-control" type="month" value="{{now()->format('Y-m')}}" id="mutasi_bulanan">
                            </div>
                        </div>
                        <hr>
                        @if(isset($periodeLaporanBarang))
                        <h4 id="judul_laporan_barang" class="m-2 mb-3 me-2">Laporan Barang Periode  {{$judul_periode_laporan_barang}}</h4>
                        <table id="laporan_barang_datatable" class="cell-border compact hover" style="width: 100%; text-align: left;" cellspacing="0">
                            <thead style="text-align: center;">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Saldo Awal</th>
                                    <th>Mutasi Masuk</th>
                                    <th>Mutasi Keluar</th>
                                    <th>Saldo Akhir</th>
                                </tr>
                            </thead>
                        </table>
                        @else
                        @endif
                    </div>
                </div>
            </div>
        </div>  
    </div>
</div>
<div class="modal fade" id="modalLoading" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content justify-content-center align-items-center" style="background: none; box-shadow: none;">
            <div class="spinner-border spinner-border-lg-laporan-barang text-warning" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    var data_id;

    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function(){
        $('#laporan_barang_datatable').DataTable({
                processing: true,
                serverSide: true, //aktifkan server-side 
                bDestroy: true,
                ajax: {
                    url:"{{route('laporan-barang.index')}}",
                    type:"GET",
                    typeData:"JSON",
                },
                columns: [
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
                    data: 'saldo_awal',
                    name: 'saldo_awal'
                    },
                    {
                    data: 'mutasi_masuk',
                    name: 'mutasi_masuk'
                    },
                    {
                    data: 'mutasi_keluar',
                    name: 'mutasi_keluar'
                    },
                    {
                    data: 'saldo_akhir',
                    name: 'saldo_akhir'
                    },
                ], 
                order: [
                    [0, 'desc']
                ],
    
        });
    })

    $('#mutasi_bulanan').on('change', function(){
        var periode = new Date (this.value)
        $.ajax({
            url:"{{route('get-laporan-barang')}}",
            type:"GET",
            dataType:"JSON",
            data:{
                bulan: periode.getMonth()+1,
                tahun : periode.getFullYear()
            },
            success: function(xhr){
                $('#judul_laporan_barang').html('Laporan Barang Periode '+ Intl.DateTimeFormat('id', {month: 'long', year: "numeric"}).format(periode))
                $('#laporan_barang_datatable').DataTable({
                    processing: true,
                    serverSide: true, //aktifkan server-side 
                    bDestroy: true,
                    ajax: {
                        url:"{{route('get-laporan-barang')}}",
                        type:"GET",
                        typeData:"JSON",
                        data:{
                            bulan: periode.getMonth()+1,
                            tahun : periode.getFullYear()
                        },
                    },
                    columns: [
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
                        data: 'saldo_awal',
                        name: 'saldo_awal'
                        },
                        {
                        data: 'mutasi_masuk',
                        name: 'mutasi_masuk'
                        },
                        {
                        data: 'mutasi_keluar',
                        name: 'mutasi_keluar'
                        },
                        {
                        data: 'saldo_akhir',
                        name: 'saldo_akhir'
                        },
                    ], 
                    order: [
                        [0, 'desc']
                    ]
                });
            },
            error: function (xhr) { //jika error tampilkan error pada console
                toastr.error(xhr.responseJSON.text,'Data Tidak Ditemukan!')
            }
        })
    })
    

    //Update Periode Laporan Barang
    function createPeriodeLaporanBarang(){
        $(document).on({
            ajaxStart: function(){
                $('#modalLoading').modal('show');
            },
            ajaxStop: function(){ 
                $('#modalLoading').modal('hide');
            }    
        });
        swal({
            title: 'Yakin tutup buku pada periode ini?',
            icon: "info",
            dangerMode:false,
            buttons: true,
        }).then((willtutupbuku)=>{
            $.ajax({
                url:"{{route('periode-laporan-barang.store')}}",
                type:"POST",
                typeData:"JSON",
                success: function(data){
                    swal("Selamat!", "Proses tutup buku berhasil dilakukan!", "success"); 
                    location.reload()
                },
                error: function (xhr) { //jika error tampilkan error pada console
                    toastr.error(xhr.responseJSON.text,'Gagal Menutup Buku!')
                }
            })
        })
    }    
</script>
@endpush

