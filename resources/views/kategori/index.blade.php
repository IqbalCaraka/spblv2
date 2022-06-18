@extends('layouts.admin')
@section('content')
<div class="content-wrapper" >
    <div class="container-xxl flex-grow-1 container-p-y" >
        <div class="row">
            <div class="card h-100">
                <div class="card-header mb-3 d-flex align-items-center justify-content-between pb-0">
                    <h3 class="m-2 me-2">List Kategori</h3>
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
                            <span class="tf-icons bx bx-plus-circle"></span>&nbsp; Tambah Kategori
                        </button>   
                    </div>
                </div>
                <div class="card-body">
                    <table id="datatable" class="cell-border compact hover" style="width: 100%; text-align: left;" cellspacing="0">
                        <thead style="text-align: center;">
                            <tr>
                                <th>Nomor Kategori</th>
                                <th>Nama</th>
                                <th>Jenis</th>
                                <th>Jumlah Barang</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!--Modal tambah jenis-->
    <div class="modal fade" id="modalTambah" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="modalTambahJudul">Tambah Kategori</h5>
                
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-tambah" name="ItemForm">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nomor_jenis" class="form-label">Nomor Kategori</label>
                                <input type="number" id="nomor_kategori" name="nomor_kategori" class="form-control" placeholder="Masukan Nomor Jenis"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nama" class="form-label">Nama Kategori</label>
                                <input type="text" id="nama" name="nama" class="form-control" placeholder="Masukan Nama Kategori"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="jenis_id" class="form-label" >Jenis</label>
                                <select type="select" name="jenis_id" id="jenis_id" style="width: 100% ;" class="js-example-basic-single select2 form-control" name="states" id="select-jenis">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"> Batal </button>
                        <button type="button" class="btn btn-primary" onclick="createKategori()"> Simpan </button>
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
            <h5 class="modal-title" id="modalEditJudul">Edit Kategori</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-edit" name="ItemForm">
                <div class="modal-body">
                    <div class="row">
                    <div class="col mb-3">
                        <label for="nomor_kategori_edit" class="form-label">Nomor Kategori</label>
                        <input type="number" id="nomor_kategori_edit" name="nomor_kategori_edit" class="form-control" placeholder="Masukan Nomor Kategori"/>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nama" class="form-label">Nama Kategori</label>
                            <input type="text" id="nama_edit" name="nama_edit" class="form-control" placeholder="Masukan Nama Kategori"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="jenis_id" class="form-label" >Jenis</label>
                            <select name="jenis_id_edit" id="jenis_id_edit" style="width: 100% ;" class="js-example-basic-single-edit select2 form-control" name="states" id="select-jenis">
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"> Batal </button>
                    <button type="button" class="btn btn-primary" onclick="updateKategori()"> Simpan </button>
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

    $(document).ready(function() {
        //select untuk create
        $('.js-example-basic-single').select2({
            placeholder: 'Pilih Jenis...',
            dropdownParent: $('#modalTambah'),
            allowClear: true,
            ajax:{
                url: "{{route('get-jenis.index')}}",
                dataType: 'json',
                delay: 250,
                dropdownCssClass: "bigdrop",
                processResults: function (data) {
                    return {
                        results:  $.map(data, function (item) {
                            return {
                                text: item.nama,
                                id: item.id
                            }   
                        })
                    };
                }
            }
        })
        //select untuk edit
        $('.js-example-basic-single-edit').select2({
            dropdownParent: $('#modalEdit'),
            ajax:{
                url: "{{route('get-jenis.index')}}",
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results:  $.map(data, function (item) {
                            return {
                                text: item.nama,
                                id: item.id
                            }   
                        })
                    };
                }
            },
        })
    });

    $('#datatable').DataTable({
        processing: true,
        serverSide: true, //aktifkan server-side 
        ajax: {
            url: "{{ route('kategori.index') }}",
            type: 'GET'
        },
        columns: [{
            data: 'nomor_kategori',
            name: 'nomor_kategori'
            },
            {
            data: 'nama',
            name: 'nama'
            },
            {
            data: 'jenis',
            name: 'jenis'
            },
            {
            data: 'jumlah_barang',
            name: 'jumlah_barang'
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

    //Membuat Kategori
    function createKategori(){
        var nomor_kategori = $('#nomor_kategori').val();
        var nama = $('#nama').val();
        var jenis_id = $('#jenis_id').val();
        $.ajax({
            url:"{{route('kategori.store')}}",
            type:"POST",
            typeData:"JSON",
            data:{
                nomor_kategori:nomor_kategori,
                nama:nama,
                jenis_id : jenis_id
            },
            success: function(data){
                $('#modalTambah').modal('hide');
                $('#form-tambah').trigger("reset");
                $('#datatable').DataTable().ajax.reload();
                $('.js-example-basic-single').html("");
                swal("Selamat!", "Data berhasil disimpan!", "success"); 
            },
            error: function (xhr) { //jika error tampilkan error pada console
                toastr.error(xhr.responseJSON.text,'Gagal Menyimpan Data!')
            }
        })
    };

    //Untuk mendapatkan data yang diedit
    function editKategori(event){
        data_id = $(event).data('id');        
        var URL = "{{route('kategori.edit', 'id')}}";
        var newURL = URL.replace('id', data_id);
        $.ajax({
            url: newURL,
            type:"GET",
            dataType:"JSON",
            success: function(kategori){
                if(kategori){
                    $('#nomor_kategori_edit').val(kategori.nomor_kategori);
                    $('#nama_edit').val(kategori.nama);
                    $("#jenis_id_edit").html('<option value = "'+kategori.jenis.id+'" selected >'+kategori.jenis.nama+'</option>');
                }
            }
        })
    };

    //Untuk update data
    function updateKategori(){
        var URL = "{{route('kategori.update', 'id')}}";
        var newURL = URL.replace('id', data_id);
        var nomor_kategori = $('#nomor_kategori_edit').val();
        var nama = $('#nama_edit').val();
        var jenis_id = $('#jenis_id_edit').val();
        $.ajax({
            url:newURL,
            type:"PUT",
            dataType:"JSON",
            data:{
                nomor_kategori:nomor_kategori,
                nama:nama,
                jenis_id:jenis_id
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
    //Untuk hapus data
    function deleteKetegori(event){
        data_id = $(event).data('id');
        var URL = "{{route('kategori.destroy', 'id')}}";
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
                    // error: function (xhr) { //jika error tampilkan error pada console
                    //     swal({
                    //         title: 'Gagal Menghapus Data!',
                    //         icon: 'warning',
                    //         text : xhr.responseJSON.text,
                    //         buttons: "Kembali"
                    //     })
                    // }
                })
            };
        });
    }
</script>

@endsection