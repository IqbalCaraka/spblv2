@extends('layouts.admin')
@section('content')
<div class="content-wrapper" >
    <div class="container-xxl flex-grow-1 container-p-y" >
        <div class="row">
            <div class="card h-100">
                <div class="card-header mb-3 d-flex align-items-center justify-content-between pb-0">
                    <h3 class="m-2 me-2">List Jenis</h3>
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
                            <span class="tf-icons bx bx-plus-circle"></span>&nbsp; Tambah Jenis
                        </button> 
                    </div>
                </div>
                <div class="card-body">
                    <table id="datatable" class="cell-border compact hover" style="width: 100%; text-align: left;" cellspacing="0">
                        <thead style="text-align: center;">
                            <tr>
                                <th>Nomor Jenis</th>
                                <th>Nama</th>
                                <th>Jumlah Kategori</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!--Modal tambah jenis-->
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modalTambahJudul">Tambah Jenis</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-tambah" name="ItemForm">
                <div class="modal-body">
                    <div class="row">
                    <div class="col mb-3">
                        <label for="nomor_jenis" class="form-label">Nomor Jenis</label>
                        <input type="number" id="nomor_jenis" name="nomor_jenis" class="form-control" placeholder="Masukan Nomor Jenis"/>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nama" class="form-label">Nama Jenis</label>
                            <input type="text" id="nama" name="nama" class="form-control" placeholder="Masukan Nama Jenis"/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"> Batal </button>
                    <button type="button" class="btn btn-primary" onclick="createJenis()"> Simpan </button>
                </div>
            </form>
        </div>
        </div>
    </div>
    <!--//Modal tambah jenis-->

    <!--Modal edit jenis-->
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modalEditJudul">Edit Jenis</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-edit" name="ItemForm">
                <div class="modal-body">
                    <div class="row">
                    <div class="col mb-3">
                        <label for="nomor_jenis" class="form-label">Nomor Jenis</label>
                        <input type="number" id="nomor_jenis_edit" name="nomor_jenis_edit" class="form-control" placeholder="Masukan Nomor Jenis"/>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nama" class="form-label">Nama Jenis</label>
                            <input type="text" id="nama_edit" name="nama_edit" class="form-control" placeholder="Masukan Nama Jenis"/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"> Batal </button>
                    <button type="button" class="btn btn-primary" onclick="updateJenis()"> Simpan </button>
                </div>
            </form>
        </div>
        </div>
    </div>
    <!--//Modal edit jenis-->
</div>

<script>
    var data_id;

    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#datatable').DataTable({
        processing: true,
        serverSide: true, //aktifkan server-side 
        ajax: {
            url: "{{ route('jenis.index') }}",
            type: 'GET'
        },
        columns: [{
            data: 'nomor_jenis',
            name: 'nomor_jenis'
            },
            {
            data: 'nama',
            name: 'nama'
            },
            {
            data: 'jumlah_kategori',
            name: 'jumlah_kategori'
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

    //Membuat jenis
    function createJenis(){
        var nomor_jenis = $('#nomor_jenis').val();
        var nama = $('#nama').val();
        $.ajax({
            url:"{{route('jenis.store')}}",
            type:"POST",
            typeData:"JSON",
            data:{
                nomor_jenis:nomor_jenis,
                nama:nama,
            },
            success: function(data){
                $('#modalTambah').modal('hide');
                $('#form-tambah').trigger("reset");
                $('#datatable').DataTable().ajax.reload();
                swal("Selamat!", "Data berhasil disimpan!", "success"); 
            },
            error: function (xhr) { //jika error tampilkan error pada console
                toastr.error(xhr.responseJSON.text,'Gagal Menyimpan Data!')
            }
        })
    }

    //Untuk mendapatkan data yang diedit
    function editJenis(event){
        data_id = $(event).attr('data-id');        
        var URL = "{{route('jenis.edit', 'id')}}";
        var newURL = URL.replace('id', data_id);
        $.ajax({
            url: newURL,
            type:"GET",
            success: function(response){
                if(response){
                    $('#nomor_jenis_edit').val(response.nomor_jenis);
                    $('#nama_edit').val(response.nama);
                }
            }
        })
    }

    //Update jenis
    function updateJenis(){
        var URL = "{{route('jenis.update', 'id')}}";
        var newURL = URL.replace('id', data_id);
        var nomor_jenis = $('#nomor_jenis_edit').val();
        var nama = $('#nama_edit').val();
        $.ajax({
            url:newURL,
            type:"PUT",
            dataType:"JSON",
            data:{
                nomor_jenis:nomor_jenis,
                nama:nama,
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

    //Hapus jenis
    function deleteJenis(event){
        data_id = $(event).data('id');
        var URL = "{{route('jenis.destroy', 'id')}}";
        var newURL = URL.replace('id', data_id);
        swal({
            title: 'Apakah Anda yakin?',
            text: 'Data ini akan dihapus permanen!',
            icon: 'warning',
            dangerMode: true,
            buttons: true,
        }).then((willdelete)=>{
            if(willdelete){
                $.ajax({
                    url:newURL,
                    type:"DELETE",
                    success: function($data){
                        $('#datatable').DataTable().ajax.reload();
                        swal("Selamat!", "Data berhasil dihapus!", "success");
                    },
                    error: function (xhr) { //jika error tampilkan error pada console
                        swal({
                            title: 'Gagal Menghapus Data!',
                            icon: 'warning',
                            text : xhr.responseJSON.text,
                            buttons: "Kembali"
                        })
                    }
                })
            };
        });
    };
    
</script>

@endsection