@extends('layouts.admin')
@section('content')
<div class="content-wrapper" >
    <div class="container-xxl flex-grow-1 container-p-y" >
        <div class="row">
            <div class="card h-100">
                <div class="card-header mb-3 d-flex align-items-center justify-content-between pb-0">
                    <h3 class="m-2 me-2">Daftar Riwayat Transaksi</h3>
                </div>
                <div class="card-body">
                    <table id="riwayat-datatable" class="datatable row-border hover" style="width: 100%;" cellspacing="0">
                        <thead style="text-align: center; width: 100%;">
                            <tr>
                                <th>No</th>
                                <th>Nomor Transaksi</th>
                                <th>Pembuat Pengajuan</th>
                                <th>Pemroses</th>
                                <th>Status Telah Diproses</th>
                                <th>Tanggal Proses</th>
                                <th>Status Saat Ini</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

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
                url: "{{ route('riwayat-transaksi.index') }}",
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
                    data: 'pemroses',
                    name: 'pemroses'
                },
                {
                    data: 'status_telah_proses',
                    name: 'status_telah_proses'
                },
                {
                    data: 'waktu_proses',
                    name: 'waktu_proses'
                },
                {
                    data: 'status_saat_ini',
                    name: 'status_saat_ini'
                },
            ]
    });
</script>
@endsection