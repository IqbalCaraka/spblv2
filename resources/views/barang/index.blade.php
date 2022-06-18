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
                            <span class="tf-icons bx bx-plus-circle"></span>&nbsp; Tambah BArang
                        </button>                            
                        
                        
                    </div>
                </div>
                <div class="card-body">
                    <table id="datatable" class="cell-border compact hover" style="width: 100%; text-align: left;" cellspacing="0">
                        <thead style="text-align: center;">
                            <tr>
                                <th>Nama Barang</th>
                                <th>Gambar</th>
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
                        <label for="nama_barang" class="form-label">Nama Barang</label>
                        <input type="text" id="nama_barang" name="nama_barang" class="form-control" placeholder="Masukan Nama Barang"/>
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
            data: 'nama_barang',
            name: 'nama_barang'
            },
            {
            data: 'gambar',
            name: 'gambar'
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
   $(document).on('submit', '#form-tambah', function (e) { 
        e.preventDefault();
        var formData = new FormData($('#form-tambah')[0])
        // console.log(formData);
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
            }
        });
    })
    
</script>

@endsection