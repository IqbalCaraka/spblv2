@extends('layouts.admin')
@section('content')

<div class="content-wrapper" >
    <div class="container-xxl flex-grow-1 container-p-y" >
        <div class="row">
            <div class="col-md-12">
                <div class="card h-100">
                    <div class="card-header mb-3 d-flex align-items-center justify-content-between pb-0">
                        <h3 class="m-2 me-2">List Satuan</h3>
                        <div class="demo-inline-spacing">
                            <div class="btn" role="">
                                <a href="javascript:void(0);" >
                                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="<i class='bx bx-bell bx-xs' ></i> <span>Download file excel</span>">
                                        <i class="tf-icons bx bxs-spreadsheet">  </i>
                                    </button>
                                </a> 
                                <a href="javascript:void(0);" target="_blank">
                                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="<i class='bx bx-bell bx-xs' ></i> <span>Download file PDF</span>">
                                    <i class="tf-icons bx bxs-file-pdf"></i>
                                    </button>
                                </a>
                            </div>
                            <button type="button" class="btn rounded-pill btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
                                <span class="tf-icons bx bx-plus-circle"></span>&nbsp; Tambah Satuan
                            </button> 
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="datatable" class="cell-border compact hover" style="width: 100%; text-align: left;" cellspacing="0">
                            <thead style="text-align: center;">
                                <tr>
                                    <th>Nama Satuan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Modal tambah satuan-->
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modalTambahJudul">Tambah Satuan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-tambah" name="ItemForm">
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nama_satuan" class="form-label">Nama Satuan</label>
                            <input type="text" id="nama_satuan" name="nama_satuan" class="form-control" placeholder="Masukan Nama Satuan"/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"> Batal </button>
                    <button type="button" class="btn btn-primary" onclick="createSatuan()"> Simpan </button>
                </div>
            </form>
        </div>
        </div>
    </div>
    <!--//Modal tambah satuan-->

    <!--Modal edit satuan-->
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modalEditJudul">Edit Satuan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-edit" name="ItemForm">
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nama_satuan_edit" class="form-label">Nama Satuan</label>
                            <input type="text" id="nama_satuan_edit" name="nama_satuan_edit" class="form-control" placeholder="Masukan Nama Satuan"/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"> Batal </button>
                    <button type="button" data-id="" class="btn btn-primary" id="update" onclick="updateSatuan(event.target)"> Simpan </button>
                </div>
            </form>
        </div>
        </div>
    </div>
    <!--//Modal edit satuan-->
</div>
@endsection

@push('scripts')
<script>

    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#datatable').DataTable({
        processing: true,
        serverSide: true, 
        ajax: {
            url: "{{ route('satuan.index') }}",
            type: 'GET'
        },
        columns: [{
            data: 'nama_satuan',
            name: 'nama_satuan'
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

    function createSatuan(){
        var nama_satuan = $('#nama_satuan').val();
        $.ajax({
            url:"{{route('satuan.store')}}",
            type:"POST",
            typeData:"JSON",
            data:{
                nama_satuan:nama_satuan
            },
            success: function(data){
                $('#modalTambah').modal('hide');
                $('#form-tambah').trigger("reset");
                $('#datatable').DataTable().ajax.reload();
                swal("Selamat!", "Data berhasil disimpan!", "success"); 
            },
            error: function (xhr) {
                toastr.error(xhr.responseJSON.text,'Gagal Menyimpan Data!')
            }
        })
    }

    function editSatuan(event){
        var id = $(event).attr('data-id');        
        var URL = "{{route('satuan.edit', ':id')}}";
        var newURL = URL.replace(':id', id);
        $('#update').attr('data-id', id);
        $.ajax({
            url: newURL,
            type:"GET",
            success: function(response){
                if(response){
                    $('#nama_satuan_edit').val(response.nama_satuan);
                }
            }
        })
    }

    function updateSatuan(event){
        var id = $(event).attr('data-id');     
        var URL = "{{route('satuan.update', ':id')}}";
        var newURL = URL.replace(':id', id);
        var nama_satuan = $('#nama_satuan_edit').val();
        $.ajax({
            url:newURL,
            type:"PUT",
            dataType:"JSON",
            data:{
                nama_satuan:nama_satuan
            },
            success: function(data){
                $('#modalEdit').modal('hide');
                $('#form-edit').trigger("reset");
                $('#datatable').DataTable().ajax.reload();
                swal("Selamat!", "Data berhasil diperbarui!", "success"); 
            },
            error: function (xhr) { //jika error tampilkan error pada console
                toastr.error(xhr.responseJSON.text,'Gagal Menyimpan Data!')
            }
        })  
    }
</script>
@endpush
