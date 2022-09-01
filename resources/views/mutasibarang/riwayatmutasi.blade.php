@extends('layouts.admin')
@section('content')
<div class="content-wrapper" >
    <div class="container-xxl flex-grow-1 container-p-y" >
        <div class="row">
            <div class="col-md-12">
                <div class="card h-100">
                    <div class="card-header mb-3 d-flex align-items-center justify-content-between pb-0">
                        <h3 class="m-2 me-2">Daftar Riwayat Mutasi Barang</h3>
                    </div>
                    <div class="card-body">
                        <table id="riwayat-datatable" class="datatable row-border hover" style="width: 100%;" cellspacing="0">
                            <thead style="text-align: center; width: 100%;">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Stok Sebelumnya</th>
                                    <th>Mutasi Masuk</th>
                                    <th>Mutasi Keluar</th>
                                    <th>Waktu Proses</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }   
    });

    $('#riwayat-datatable').DataTable({
            processing: true,
            serverSide: true, 
            responsive: true,
            ajax: {
                url: "{{ route('riwayat-mutasi') }}",
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
                    data: 'stok_sebelumnya',
                    name: 'stok_sebelumnya'
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
                    data: 'waktu_proses',
                    name: 'waktu_proses'
                },
            ]
    });
</script>
@endpush