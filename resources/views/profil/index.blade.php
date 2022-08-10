@extends('layouts.admin')
@section('content')
<div class="content-wrapper" >
    <div class="container-xxl flex-grow-1 container-p-y" >
        <div class="row">
            <div class="col-md-12">
                <div class="card h-100">
                    <div class="card-header mb-3 d-flex align-items-center justify-content-between pb-0">
                        <h3 class="m-2 me-2">List Pengguna</h3>
                        <div class="demo-inline-spacing">
                            <button type="button" class="btn rounded-pill btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
                                <span class="tf-icons bx bx-plus-circle"></span>&nbsp; Tambah Pengguna
                            </button> 
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="profil-datatable" class="cell-border compact hover" style="width: 100%; text-align: left;" cellspacing="0">
                            <thead style="text-align: center;">
                                <tr>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>Bidang</th>
                                    <th>Peran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Modal tambah pengguna-->
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modalTambahJudul">Tambah Pengguna</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-tambah" name="ItemForm">
                <div class="modal-body">
                    <div class="row">
                    <div class="col mb-3">
                        <label for="id" class="form-label">NIP</label>
                        <input type="number" id="nip" name="nip" class="form-control" placeholder="Masukan NIP"/>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Masukan Nama"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="jabatan" class="form-label" >Jabatan</label>
                            <select type="select" name="jabatan_id" id="jabatan_id" style="width: 100% ;" class="js-example-basic-single select2 form-control select-jabatan" name="states" id="select-jabatan">
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="bidang" class="form-label" >Bidang</label>
                            <select type="select" name="bidang_id" id="bidang_id" style="width: 100% ;" class="js-example-basic-single select2 form-control select-bidang" name="states" id="select-bidang">
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="peran" class="form-label" >Peran</label>
                            <select type="select" name="peran_id" id="peran_id" style="width: 100% ;" class="js-example-basic-single select2 form-control select-peran" name="states" id="select-peran">
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"> Batal </button>
                    <button type="submit" class="btn btn-primary"> Daftarkan </button>
                </div>
            </form>
        </div>
        </div>
    </div>
    <!--//Modal tambah pengguna-->

    <!--Modal edit pengguna-->
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modalEditJudul">Edit Pengguna</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-edit" name="ItemForm">
                <div class="modal-body">
                    <div class="row">
                    <div class="col mb-3">
                        <label for="id" class="form-label">NIP</label>
                        <input type="number" id="nip_edit" name="nip" class="form-control" placeholder="Masukan NIP" value=""/>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" id="name_edit" name="name" class="form-control" placeholder="Masukan Nama" value=""/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="jabatan" class="form-label" >Jabatan</label>
                            <select type="select" name="jabatan" id="jabatan_edit" style="width: 100% ;" class="js-example-basic-single select2 form-control select-jabatan-edit" name="states" id="select-jabatan" value="">
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="bidang" class="form-label" >Bidang</label>
                            <select type="select" name="bidang" id="bidang_edtit" style="width: 100% ;" class="js-example-basic-single select2 form-control select-bidang-edit" name="states" id="select-bidang" value="">
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="peran" class="form-label" >Peran</label>
                            <select type="select" name="peran" id="peran_edit" style="width: 100% ;" class="js-example-basic-single select2 form-control select-peran-edit" name="states" id="select-peran" value="">
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"> Batal </button>
                    <button type="button" id="simpan" data-id="" class="btn btn-primary" onclick="updatePengguna(event.target)"> Simpan </button>
                </div>
            </form>
        </div>
        </div>
    </div>
    <!--//Modal edit pengguna-->
</div>

<script>
    var data_id;

    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#profil-datatable').DataTable({
        processing: true,
        serverSide: true, //aktifkan server-side 
        ajax: {
            url: "{{ route('profil.index') }}",
            type: 'GET',
            typeData:'JSON'
        },
        columns: [{
            data: 'nip',
            name: 'nip',
            // render : function (data){
            //     return Number.isInteger(data);
            // }
            },
            {
            data: 'name',
            name: 'name'
            },
            {
            data: 'jabatan',
            name: 'jabatan'
            },
            {
            data: 'bidang',
            name: 'bidang'
            },
            {
            data: 'peran',
            name: 'peran'
            },
            {
            data: 'action',
            name: 'action'
            },
        ], 
    });

    $(document).ready(function() {
        //select tambah
        //select untuk jabatan
        $('.select-jabatan').select2({
            placeholder: 'Pilih Jabatan...',
            dropdownParent: $('#modalTambah'),
            allowClear: true,
            ajax:{
                url: "{{route('get-jabatan')}}",
                dataType: 'json',
                delay: 250,
                dropdownCssClass: "bigdrop",
                processResults: function (data) {
                    return {
                        results:  $.map(data, function (item) {
                            return {
                                text: item.jabatan,
                                id: item.id
                            }   
                        })
                    };
                }
            }
        })

        //select untuk bidang
        $('.select-bidang').select2({
            placeholder: 'Pilih Bidang...',
            dropdownParent: $('#modalTambah'),
            allowClear: true,
            ajax:{
                url: "{{route('get-bidang')}}",
                dataType: 'json',
                delay: 250,
                dropdownCssClass: "bigdrop",
                processResults: function (data) {
                    return {
                        results:  $.map(data, function (item) {
                            return {
                                text: item.bidang,
                                id: item.id
                            }   
                        })
                    };
                }
            }
        })

        //select untuk peran
        $('.select-peran').select2({
            placeholder: 'Pilih Peran...',
            dropdownParent: $('#modalTambah'),
            allowClear: true,
            ajax:{
                url: "{{route('get-peran')}}",
                dataType: 'json',
                delay: 250,
                dropdownCssClass: "bigdrop",
                processResults: function (data) {
                    return {
                        results:  $.map(data, function (item) {
                            return {
                                text: item.peran,
                                id: item.id
                            }   
                        })
                    };
                }
            }
        })

        //select edit
        //select untuk jabatan
        $('.select-jabatan-edit').select2({
            placeholder: 'Pilih Jabatan...',
            dropdownParent: $('#modalEdit'),
            allowClear: true,
            ajax:{
                url: "{{route('get-jabatan')}}",
                dataType: 'json',
                delay: 250,
                dropdownCssClass: "bigdrop",
                processResults: function (data) {
                    return {
                        results:  $.map(data, function (item) {
                            return {
                                text: item.jabatan,
                                id: item.id
                            }   
                        })
                    };
                }
            }
        })

        //select untuk bidang
        $('.select-bidang-edit').select2({
            placeholder: 'Pilih Bidang...',
            dropdownParent: $('#modalEdit'),
            allowClear: true,
            ajax:{
                url: "{{route('get-bidang')}}",
                dataType: 'json',
                delay: 250,
                dropdownCssClass: "bigdrop",
                processResults: function (data) {
                    return {
                        results:  $.map(data, function (item) {
                            return {
                                text: item.bidang,
                                id: item.id
                            }   
                        })
                    };
                }
            }
        })

        //select untuk peran
        $('.select-peran-edit').select2({
            placeholder: 'Pilih Peran...',
            dropdownParent: $('#modalEdit'),
            allowClear: true,
            ajax:{
                url: "{{route('get-peran')}}",
                dataType: 'json',
                delay: 250,
                dropdownCssClass: "bigdrop",
                processResults: function (data) {
                    return {
                        results:  $.map(data, function (item) {
                            return {
                                text: item.peran,
                                id: item.id
                            }   
                        })
                    };
                }
            }
        })
    });

    $(document).on('submit', '#form-tambah', function (e) {
        //Membuat pengguna
        e.preventDefault();
        var formData = new FormData($('#form-tambah')[0]);
        $.ajax({
            url:"{{ route('profil.store') }}",
            type:"post",
            typeData:"JSON",
            data:formData,
            contentType:false,
            processData:false,
            success: function(data){
                $('#modalTambah').modal('hide');
                $('#form-tambah').trigger("reset");
                $('#profil-datatable').DataTable().ajax.reload();
                swal("Selamat!", "Data berhasil disimpan!", "success"); 
            },
            error: function (xhr) { //jika error tampilkan error pada console
                toastr.error(xhr.responseJSON.text,'Gagal Menyimpan Data!')
            }
        })        
    });


    //Untuk mendapatkan data yang diedit
    function editProfil(event){
        var id = $(event).attr('data-id');        
        var URL = "{{route('profil.edit', ':id')}}";
        var newURL = URL.replace(':id', id);
        $('#simpan').attr('data-id',id);
        $.ajax({
            url: newURL,
            type:"GET",
            success: function(user){
                if(user){
                    $('#nip_edit').val(user.nip);
                    $('#name_edit').val(user.name);
                    $('#jabatan_edit').html('<option value = "'+user.jabatan.id+'" selected >'+user.jabatan.jabatan+'</option>');
                    $('#bidang_edtit').html('<option value = "'+user.bidang.id+'" selected >'+user.bidang.bidang+'</option>');
                    $('#peran_edit').html('<option value = "'+user.peran.id+'" selected >'+user.peran.peran+'</option>');
                }
            }
        })
    }

    //Update pengguna
    function updatePengguna(event){
        var id = $(event).attr('data-id');
        var URL = "{{route('profil.update', ':id')}}";
        var newURL = URL.replace(':id', id);
        var nip = $('#nip_edit').val();
        var name = $('#name_edit').val();
        var jabatan = $('#jabatan_edit').val();
        var bidang = $('#bidang_edtit').val();
        var peran = $('#peran_edit').val();
        $.ajax({
            url:newURL,
            type:"PUT",
            data:{
                nip: nip,
                name: name,
                jabatan_id: jabatan,
                bidang_id: bidang,
                peran_id: peran
            },
            success: function(data){
                $('#modalEdit').modal('hide');
                $('#form-edit').trigger("reset");
                $('#profil-datatable').DataTable().ajax.reload();
                swal("Selamat!", "Data berhasil diperbarui!", "success"); 
            },
            error: function (xhr) { //jika error tampilkan error pada console
                toastr.error(xhr.responseJSON.text,'Gagal Menyimpan Data!')
            }
        })  
    }

    //Hapus pengguna
    function hapusProfil(event){
        var id = $(event).attr('data-id');
        var URL = "{{route('profil.destroy', ':id')}}";
        var newURL = URL.replace(':id', id);
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
                        $('#profil-datatable').DataTable().ajax.reload();
                        swal("Selamat!", "Data berhasil diperbarui!", "success"); 
                    },
                    error: function (xhr) { 
                        toastr.error(xhr.responseJSON.text,'Gagal Menyimpan Data!')
                    }
                })
            };
        });
    };

    function resetPassword(event){
        var id = $(event).attr('data-id');
        swal({
            title: 'Apakah Anda yakin?',
            text: 'Data ini mereset password akun ini!',
            icon: 'warning',
            dangerMode: true,
            buttons: true,
        }).then((willdelete)=>{
            if(willdelete){
                $.ajax({
                    url:"{{route('reset-password')}}",
                    type:"POST",
                    data:{
                        id:id
                    },
                    success: function($data){
                        $('#profil-datatable').DataTable().ajax.reload();
                        swal("Selamat!", "Data berhasil diperbarui!", "success"); 
                    },
                    error: function (xhr) { 
                        toastr.error(xhr.responseJSON.text,'Gagal Menyimpan Data!')
                    }
                })
            };
        });
    }
</script>

@endsection