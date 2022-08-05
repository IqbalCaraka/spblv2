@extends('layouts.admin')
@section('content')
<div class="content-wrapper" >
    <div class="container-xxl flex-grow-1 container-p-y" >
        <div class="row">
            <div class="card h-100">
                <div class="card-header mb-3 d-flex align-items-center justify-content-between pb-0">
                    <h3 class="m-2 me-2">List Barang</h3>
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
                            <span class="tf-icons bx bx-plus-circle"></span>&nbsp; Tambah Barang
                        </button>                            
                        
                        
                    </div>
                </div>
                <div class="card-body">
                    <table id="datatable" class="cell-border compact hover" style="width: 100%; text-align: left;" cellspacing="0">
                        <thead style="text-align: center;">
                            <tr>
                                <th>Gambar</th>
                                <th>Nomor Barang</th>
                                <th>Nama Barang</th>
                                <th>Stok</th>
                                <th>Kategori</th>
                                <th>Harga Satuan</th>
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
            <h5 class="modal-title" id="modalTambahJudul">Tambah Barang</h5>
            <button  type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form enctype="multipart/form-data" id="form-tambah" name="ItemForm">
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nomor_barang" class="form-label">Nomor Barang</label>
                            <input type="number" id="nomor_barang" name="nomor_barang" class="form-control" placeholder="Masukan Nomor Barang"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nama_barang" class="form-label">Nama Barang</label>
                            <input type="text" id="nama_barang" name="nama_barang" class="form-control" placeholder="Masukan Nama Barang"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="stok" class="form-label">Stok</label>
                            <input type="number" id="stok" name="stok" class="form-control" placeholder="Masukan Stok"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="kategori_id" class="form-label" >Kategori</label>
                            <select name="kategori_id" id="kategori_id" style="width: 100% ;" class="js-example-basic-single select2 form-control" name="states">
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="harga_satuan" class="form-label">Harga Satuan</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp.</span>
                                <input type="number" id="harga_satuan" name="harga_satuan" class="form-control"/>
                                <span class="input-group-text">,00</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="gambar" class="form-label">Gambar</label>
                            <input type="file" id="gambar" name="gambar" class="form-control"/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"> Batal </button>
                    <button type="submit" class="btn btn-primary" id="submit-form"> Simpan </button>
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
            <h5 class="modal-title" id="modalEditJudul">Edit Barang</h5>
            <button  type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form enctype="multipart/form-data" id="form-edit" name="ItemForm">
                <!-- <input type="hidden" name="_method" value="PUT"> -->
                <input type="hidden" id="id_edit" name="id" class="form-control"/>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nomor_barang" class="form-label">Nomor Barang</label>
                            <input type="number" id="nomor_barang_edit" name="nomor_barang" class="form-control" placeholder="Masukan Nomor Barang"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nama_barang_edit" class="form-label">Nama Barang</label>
                            <input type="text" id="nama_barang_edit" name="nama_barang" class="form-control" placeholder="Masukan Nama Barang"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="stok_edit" class="form-label">Stok</label>
                            <input type="number" id="stok_edit" name="stok" class="form-control" placeholder="Masukan Stok"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="kategori_id_edit" class="form-label" >Kategori</label>
                            <select name="kategori_id" id="kategori_id_edit" style="width: 100% ;" class="js-example-basic-single-edit select2 form-control" name="states">
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="harga_satuan" class="form-label">Harga Satuan</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp.</span>
                                <input type="number" id="harga_satuan_edit" name="harga_satuan" class="form-control"/>
                                <span class="input-group-text">,00</span>
                            </div>
                        </div>
                    </div>
                    <div class="row position-relative">
                        <div class="col mb-3">
                            <label for="gambar" class="form-label">Gambar</label>
                            <br>
                            <img id="gambar-edit" src="" style="width: 40%;" class="mb-3">
                            <input type="file" id="gambar_edit" name="gambar" class="form-control"/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"> Batal </button>
                    <button type="submit" class="btn btn-primary" id="submit-form"> Simpan </button>
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
            url: "{{ route('barang.index') }}",
            type: 'GET'
        },
        columns: [{
            data: 'gambar',
            name: 'gambar'
            },
            {
            data: 'nomor_barang',
            name: 'nomor_barang'
            },
            {
            data: 'nama_barang',
            name: 'nama_barang'
            },
            {
            data: 'stok',
            name: 'stok'
            },
            {
            data: 'kategori',
            name: 'kategori'
            },
            {
            data: 'harga_satuan',
            name: 'harga_satuan'
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

    //select
    $(document).ready(function() {
        //select untuk create
        $('.js-example-basic-single').select2({
            placeholder: 'Pilih Kategori...',
            dropdownParent: $('#modalTambah'),
            allowClear: true,
            ajax:{
                url: "{{route('get-kategori.index')}}",
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
                url: "{{route('get-kategori.index')}}",
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

    //Membuat barang
    $(document).on('submit', '#form-tambah', function (e) { 
        e.preventDefault();
        var formData = new FormData($('#form-tambah')[0])
        console.log(formData);
        $.ajax({
            type:"POST",
            url:"{{route('barang.store')}}",
            data:formData,
            contentType:false,
            processData:false,
            success: function(response){
                $('#modalTambah').modal('hide');
                $('#form-tambah').trigger("reset");
                $('#datatable').DataTable().ajax.reload();
                $('.js-example-basic-single').html("");
                swal("Selamat!", "Data berhasil disimpan!", "success"); 
            },
            error: function (xhr) { //jika error tampilkan error pada console
                toastr.error(xhr.responseJSON.text,'Gagal Menyimpan Data!')
            }
        });
    })
    //Untuk mendapatkan data yang diedit
    function editBarang(event){
        var gambar;
        data_id = $(event).data('id');        
        var URL = "{{route('barang.edit', 'id')}}";
        var newURL = URL.replace('id', data_id);
        $.ajax({
            url: newURL,
            type:"GET",
            dataType:"JSON",
            success: function(barang){
                if(barang){
                    if(!barang.gambar){
                        gambar = "storage/nopict.png"
                    }else{
                        gambar = "storage/"+barang.gambar;
                    }
                    $('#id_edit').val(barang.id);
                    $('#nomor_barang_edit').val(barang.nomor_barang);
                    $('#nama_barang_edit').val(barang.nama_barang);
                    $('#stok_edit').val(barang.stok);
                    $("#kategori_id_edit").html('<option value = "'+barang.kategori.id+'" selected >'+barang.kategori.nama+'</option>');
                    $('#harga_satuan_edit').val(barang.harga_satuan);
                    $("#gambar-edit").attr("src", gambar);
                }
            }
        })
    };

    //Update data
    $(document).on('submit', '#form-edit', function (e) { 
        e.preventDefault();
        var url = "{{route('barang.update')}}";
        var formData = new FormData($('#form-edit')[0]);
        console.log(formData);
        $.ajax({
            type:"POST",
            url:url,
            data:formData,
            contentType:false,
            processData:false,
            success: function(response){
                $('#modalEdit').modal('hide');
                $('#form-edit').trigger("reset");
                $('#datatable').DataTable().ajax.reload();
                $('.js-example-basic-single-edit').html("");
                swal("Selamat!", "Data berhasil disimpan!", "success"); 
            },
            error: function (xhr) { //jika error tampilkan error pada console
                toastr.error(xhr.responseJSON.text,'Gagal Menyimpan Data!')
            }
        });
    // }
    })

    //Untuk hapus data
    function deleteBarang(event){
        data_id = $(event).data('id');
        var URL = "{{route('barang.destroy', 'id')}}";
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
                })
            };
        });
    }
   
</script>

@endsection