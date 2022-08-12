@extends('layouts.utama')
@section('content')
<!-- ======= Keranjang Section ======= -->
<div class="container" >
    <section id="keranjang" class="keranjang">
        <div class="container mt-4" data-aos="fade-up">
            <div class="content">
                <h1 class="mb-5">Keranjang {{Auth::user()->name}}</h1>
                <!-- Feature Tabs -->
                <div class="row keranjang-tabs" data-aos="fade-up">
                    <!-- Tabs -->
                    <ul class="nav nav-pills mb-3 d-flex justify-content-center">
                        <li>
                            <a class="nav-link active" data-bs-toggle="pill" href="#keranjang-barang-tresedia">Keranjang</a>
                        </li>
                        <li>
                            <a class="nav-link" data-bs-toggle="pill" href="#keranjang-barang-tidak-tersedia">Keranjang Barang Tidak Tersedia</a>
                        </li>
                    </ul><!-- End Tabs -->
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="keranjang-barang-tresedia">
                            <div class="table-responsive text-nowrap">
                                @if($keranjangs->count()==0)
                                <div id="empty-chart" class="empty-chart">
                                    <div class="container" data-aos="fade-up">
                                        <div class="content">
                                            <div class="row gx-0">
                                                <img src="{{asset('storage/addtochart.jpg')}}" class="" alt="">
                                                <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
                                                    <div class="text-center text-lg-start">
                                                        <h5>Keranjang Kamu Masih Kosong!</h5>
                                                        <a href="{{route('menu.index')}}" class="btn-isi-barang d-inline-flex align-items-center justify-content-center align-self-center">
                                                            <span>Yuk isi keranjangmu dahulu!</span>
                                                        </a>
                                                    </div>
                                                </div>  
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @else  
                                <div class="content-keranjang">
                                    @foreach($keranjangs as $keranjang)
                                    <div class="card mt-1">
                                        <div class="card-header">
                                            <h2>{{$keranjang[0]->barang->kategori->nama}}</h2>
                                            <hr> 
                                        </div>
                                        @foreach($keranjang as $item)
                                        <div id="card-{{$item->id}}" class="card-body row">
                                            <div class="col-2 d-inline-flex justify-content-start align-self-center">
                                                @if(empty($item->barang->gambar))
                                                    <img src="{{asset('storage/nopict.png')}}" class="img-fluid card-img-top mt-1" alt="" style="object-fit: cover;">
                                                @else
                                                    <img src="{{asset('storage/'.$item->barang->gambar)}}" class="img-fluid card-img-top mt-1" alt="" style="object-fit: cover;">
                                                @endif
                                            </div>
                                            <div class="col-4 justify-content-start align-self-center">
                                                <h3>{{$item->barang->nama_barang}}</h3>
                                                <p>
                                                    <small class="text-muted fw-semibold" id="stok">Jumlah stok saat ini {{$item->barang->stok}}</small>
                                                </p>
                                            </div>
                                            <div class="col-3 d-inline-flex justify-content-start align-self-center">
                                                <div class="align-self-center d-flex justify-content-end">
                                                    <button id="kurang-keranjang-{{$item->barang->id}}" data-id="{{$item->id}}" data-barang="{{$item->barang->id}}" data-toggle="tooltip" data-placement="top" title="Kurangi Barang" class="btn btn-xs rounded-pill btn-icon align-self-center btn-outline-primary d-inline-flex justify-content-center mx-1" onclick="kurangBarang(event.target)">
                                                        <span id="kurang-keranjang-{{$item->barang->id}}" data-id="{{$item->id}}" data-barang="{{$item->barang->id}}" class='bx bx-xs bx-minus align-self-center'></span>
                                                    </button>
                                                    <input disabled id="input-{{$item->barang->id}}" class="form-control align-middle d-flex justify-content-center" style="width: 35%; height: 10%;" type="text" value="{{$item->jumlah_barang}}"/>
                                                    <button id="tambah-keranjang-{{$item->barang->id}}" data-id="{{$item->id}}" data-barang="{{$item->barang->id}}" data-toggle="tooltip" data-placement="top" title="Tambah Barang" class="btn btn-xs rounded-pill btn-icon align-self-center align-middle btn-outline-primary d-inline-flex justify-content-center mx-1" onclick="tambahBarang(event.target)">
                                                        <span id="tambah-keranjang-{{$item->barang->id}}" data-id="{{$item->id}}" data-barang="{{$item->barang->id}}" class='bx bx-xs bx-plus align-self-center' value="{{$item->barang->id}}" ></span>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col-3 d-inline-flex justify-content-center align-self-center">
                                                <div class="align-self-center d-flex justify-content-end">
                                                    <button id="hapus-keranjang-{{$item->id}}" data-id="{{$item->id}}" data-toggle="tooltip" data-placement="top" title="Hapus Barang dari Keranjang" class="btn btn-xs rounded-pill btn-icon align-self-center align-middle btn-outline-danger d-inline-flex justify-content-center mx-1" onclick="hapusKeranjang(event.target)">
                                                        <span id="hapus-keranjang-{{$item->id}}" data-id="{{$item->id}}" class='bx bx-xs bx-trash align-self-center'></span>
                                                    </button>
                                                </div>
                                            </div>
                                            <hr style="width: 100%; margin-top: 10px;">
                                        </div>
                                        @endforeach
                                    </div>
                                    @endforeach
                                </div>
                                <div class="check-out">
                                    <button class="btn btn-danger btn-check-out" onclick="checkOut()">
                                    Check Out Sekarang!
                                    </button>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="keranjang-barang-tidak-tersedia">
                            <div class="table-responsive text-nowrap">
                                @if($keranjang_barang_tidak_tersedia->count()==0)
                                <div id="empty-chart" class="empty-chart">
                                    <div class="container" data-aos="fade-up">
                                        <div class="content">
                                            <div class="row gx-0">
                                                <img src="{{asset('storage/addtochart2.jpg')}}" class="" alt="">
                                                <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
                                                    <div class="text-center text-lg-start">
                                                        <h5>Keranjang Kamu Masih Kosong!</h5>
                                                        <a href="{{route('menu.index')}}" class="btn-isi-barang d-inline-flex align-items-center justify-content-center align-self-center">
                                                            <span>Yuk isi keranjangmu dahulu!</span>
                                                        </a>
                                                    </div>
                                                </div>  
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @else 
                                    <table id="keranjang-barang-tidak-tersedia-datatable" class="datatable row-border hover" style="width: 100%;" cellspacing="0">
                                        <thead style="text-align: center; width: 100%;">
                                            <tr>
                                                <th>Nama Barang</th>
                                                <th>Jumlah Barang</th>
                                                <th>Satuan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <!--Modal show pengajuan barang tidak tersedia-->
                                    <div class="modal fade bd-example-modal-lg" id="modalKeranjang" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="pengajuan-barang-tidak-tersedia-title">Pengajuan Barang Tidak Tersedia</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="form-edit" name="ItemForm">
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col mb-3">
                                                                    <label for="nama_barang" class="form-label">Nama Barang Yang Diajukan</label>
                                                                    <input disabled style="text-align: left; " type="text" id="nama_barang" name="nama_barang" class="form-control" placeholder="Masukan Nama Barang"/>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col mb-3">
                                                                    <label for="jumlah_barang" class="form-label">Jumlah Pengajuan</label>
                                                                    <input style="text-align: left;" type="number" id="jumlah_barang" name="jumlah_barang" class="form-control" placeholder="Masukan Jumlah Pengajuan"/>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col mb-3">
                                                                    <label for="satuan_id" class="form-label" >Satuan</label>
                                                                    <br>
                                                                    <select name="satuan_id" id="satuan_id" style="width: 100% ;" class="js-example-basic-single select2 form-control" name="states" id="satuan_id">
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"> Batal </button>
                                                            <button type="button" id="simpan" data-id="" class="btn btn-outline-primary" onclick="updateKeranjangBarangTidakTersedia()"> Simpan </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Modal show pengajuan barang tidak tersedia-->  
                                    <div class="check-out">
                                        <button class="btn btn-danger btn-check-out" onclick="checkOut()">
                                        Check Out Sekarang!
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </section>
</div>
<!-- End keranjang Section -->
@endsection

@push('scripts')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
        }   
    });

    $(document).ready(function () {     
        $('.js-example-basic-single').select2({
            placeholder: 'Pilih Satuan...',
            dropdownParent: $('#modalKeranjang'),
            allowClear: true,
            ajax:{
                url: "{{route('get-satuan')}}",
                dataType: 'json',
                type:'get',
                delay: 250,
                dropdownCssClass: "bigdrop",
                processResults: function (data) {
                    return {
                        results:  $.map(data, function (item) {
                            return {
                                text: item.nama_satuan,
                                id: item.id
                            }   
                        })
                    };
                }
            }
           
        })

        $('a[data-bs-toggle="pill"]').on('shown.bs.tab', function (e) {
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });

        $('#keranjang-barang-tidak-tersedia-datatable').DataTable({
            processing: true,
            serverSide: true, 
            responsive: true,
            ajax: {
                url: "{{ route('keranjang-barang-tidak-tersedia.index') }}",
                type: 'GET'
            }, columns: [{
                    data: 'nama_barang',
                    name: 'nama_barang'
                },
                {
                    data: 'jumlah_barang',
                    name: 'jumlah_barang'
                },
                {
                    data: 'satuan',
                    name: 'satuan'
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
    });

    function updateContentKeranjang () {
        $.ajax({
            method:"get",
            url:"{{route('keranjang.index')}}",
            dataType:'JSON',
            headers:{
                'Accept' : 'applicaion/json',
                'Content-Type': 'applicaion/json'
            },
            success:function(response){
                var getDataKeranjang='';
                var getGambar ='';
                if(response.keranjangs == ''){
                    location.reload()
                } else {
                    $.each(response.keranjangs, function(index,keranjangsAjax){
                        getDataKeranjang +=
                        `<div class="card mt-2">
                            <div class="card-header">
                                <h2>`+keranjangsAjax[0].barang.kategori.nama+`</h2>
                                <hr> 
                            </div>`
                            $.each(keranjangsAjax, function(index,keranjangAjax){
                                if (keranjangAjax.barang.gambar === ''){
                                    getGambar =   
                                        `<img src="{{asset('storage/nopict.png')}}" class="img-fluid card-img-top mt-1" alt="" style="object-fit: cover;">`
                                } else{
                                    getGambar =
                                        `<img src="{{asset('storage/`+keranjangAjax.barang.gambar+`')}}" class="img-fluid card-img-top mt-1" alt="" style="object-fit: cover;">`
                                }
                                getDataKeranjang +=
                                    `<div class="card-body row">
                                        <div class="col-2 d-inline-flex justify-content-start align-self-center">
                                           `+getGambar+` 
                                        </div>
                                        <div class="col-4 justify-content-start align-self-center">
                                            <h3>`+keranjangAjax.barang.nama_barang+`</h3>
                                            <p>
                                                <small class="text-muted fw-semibold" id="stok">Jumlah stok saat ini `+keranjangAjax.barang.stok+`</small>
                                            </p>
                                        </div>
                                        <div class="col-3 d-inline-flex justify-content-start align-self-center">
                                            <div class="align-self-center d-flex justify-content-end">
                                                <button id="kurang-keranjang-`+keranjangAjax.barang.id+`" data-id="`+keranjangAjax.id+`" data-barang="`+keranjangAjax.barang.id+`" data-toggle="tooltip" data-placement="top" title="Kurangi Barang dari Keranjang" class="btn btn-xs rounded-pill btn-icon align-self-center btn-outline-primary d-inline-flex justify-content-center mx-1" onclick="kurangBarang(this)">
                                                    <i id="kurang-keranjang-`+keranjangAjax.barang.id+`" data-id="`+keranjangAjax.id+`" data-barang="`+keranjangAjax.barang.id+`" data-toggle="tooltip" data-placement="top" title="Kurangi Barang dari Keranjang" class='bx bx-xs bx-minus align-self-center'></i>
                                                </button>
                                                <input disabled id="input-`+keranjangAjax.barang.id+`" class="form-control align-middle d-flex justify-content-center" style="width: 35%; height: 10%;" type="text" value="`+keranjangAjax.jumlah_barang+`"/>
                                                <button id="tambah-keranjang-`+keranjangAjax.barang.id+`" data-id="`+keranjangAjax.id+`" data-barang="`+keranjangAjax.barang.id+`" data-toggle="tooltip" data-placement="top" title="Tambah Barang ke Keranjang" class="btn btn-xs rounded-pill btn-icon align-self-center align-middle btn-outline-primary d-inline-flex justify-content-center mx-1" onclick="tambahBarang(event.target)">
                                                    <span id="tambah-keranjang-`+keranjangAjax.barang.id+`" data-id="`+keranjangAjax.id+`" data-barang="`+keranjangAjax.barang.id+`" data-toggle="tooltip" data-placement="top" title="Tambah Barang ke Keranjang" class='bx bx-xs bx-plus align-self-center'></span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-3 d-inline-flex justify-content-start align-self-center">
                                            <div class="align-self-center d-flex justify-content-end">
                                                <button id="hapus-keranjang-`+keranjangAjax.id+`" data-id="`+keranjangAjax.id+`" data-toggle="tooltip" data-placement="top" title="Hapus Barang dari Keranjang" class="btn btn-xs rounded-pill btn-icon align-self-center align-middle btn-outline-danger d-inline-flex justify-content-center mx-1" onclick="hapusKeranjang(event.target)">
                                                    <span id="hapus-keranjang-`+keranjangAjax.id+`" data-id="`+keranjangAjax.id+`" class='bx bx-xs bx-trash align-self-center'></span>
                                                </button>
                                            </div>
                                        </div>
                                        <hr style="width: 100%; margin-top: 10px;">
                                    </div>`
                            });
                        getDataKeranjang +=
                        `</div>`
                    })
                    $('.content-keranjang').html(getDataKeranjang);
                }
            }
        });
    }

    function tambahBarang(event) {
        var inputKeranjang;
        var barangId = $(event).data('barang');
        var userId = $('#userId').data('id');
        $.ajax({
            url:"{{route('keranjang.store')}}",
            type:"POST",
            data:{
                user_id : userId,
                barang_id:barangId,
                jumlah_barang:1
            },
            success: function(){
                inputKeranjang = parseInt($('#input-'+barangId).val());
                inputKeranjang++
                $('#input-'+barangId).val(inputKeranjang);
            },
            error: function () { //jika error tampilkan error pada console
                toastr.options = {
                                    "debug": false,
                                    "positionClass": "toast-top-left",
                                    "onclick": null,
                                    "fadeIn": 300,
                                    "fadeOut": 1000,
                                    "timeOut": 5000,
                                    "extendedTimeOut": 1000
                                }
                toastr.error('Jumlah permintaan sudah melebihi stok!','Gagal Menambahkan!');
            }
        })
    }

    function kurangBarang(event){
        var barangId = $(event).data('barang');
        var userId = $('#userId').data('id'); 
        $.ajax({
            url:"{{route('keranjang.store')}}",
            type:"POST",
            data:{
                user_id : userId,
                barang_id:barangId,
                jumlah_barang:-1
            },
            success: function(){
                inputKeranjang = parseInt($('#input-'+barangId).val());
                inputKeranjang--
                $('#input-'+barangId).val(inputKeranjang);
            },
            error: function () { //jika error tampilkan error pada console
                var dataHapus = $('#hapus-keranjang-')
                hapusKeranjang(event);
            }
        });
    }

    function hapusKeranjang(event){
        var data_id = $(event).data('id')
        var URL = "{{route('keranjang.destroy', 'id')}}";
        var newURL = URL.replace('id', data_id);
        swal({
            title: 'Apakah Anda yakin?',
            text: 'Menghapus data ini pada keranjang?',
            icon: 'warning',
            dangerMode: true,
            buttons: true,
        }).then((willdelete)=>{
            if(willdelete){
                $.ajax({
                    url:newURL,
                    type:"DELETE",
                    success: function($data){
                        swal("Selamat!", "Data berhasil dihapus!", "success");
                        updateContentKeranjang()
                    },
                    error: function (xhr) { //jika error tampilkan error pada console
                        swal({
                            title: 'Gagal Menghapus Data!',
                            icon: 'warning',
                            buttons: "Kembali"
                        })
                    }
                })
            };
        });
    }

    function checkOut(){
        $.ajax({
            url:"{{route('transaksi.store')}}",
            type:"POST",
            success:function(response){
                swal({
                    title: 'Check Out Berhasil!',
                    text: 'Nomor transaksi Anda adalah '+response.text,
                    icon:'success',
                    confirmButtonText: 'Ok'
                }).then((updatePage)=>{
                    updateContentKeranjang();
                })                
            }
        })
    }
    
    function updateContentKeranjangBarangTidakTersedia() {
        $.ajax({
            method:"get",
            url:"{{route('keranjang.index')}}",
            dataType:'JSON',
            headers:{
                'Accept' : 'applicaion/json',
                'Content-Type': 'applicaion/json'
            },
            success:function(response){
                if(response.keranjang_barang_tidak_tersedia == ''){
                    location.reload()
                }
            },
        })
    }

    function updateKeranjangBarangTidakTersedia (){
        var id = $('#simpan').attr('data-id');
        var URL = "{{route('keranjang-barang-tidak-tersedia.update', ':id')}}";
        var newURL = URL.replace(':id', id);
        var jumlah_barang = $('#jumlah_barang').val();
        var satuan_id = $('#satuan_id').val();
        $.ajax({
            url:newURL,
            type:"PUT",
            dataType:"JSON",
            data:{
                jumlah_barang:jumlah_barang,
                satuan_id:satuan_id
            },
            success: function(data){
                $('#modalKeranjang').modal('hide');
                $('#form-edit').trigger("reset");
                $('#keranjang-barang-tidak-tersedia-datatable').DataTable().ajax.reload();
                swal("Selamat!", "Data berhasil diperbarui!", "success"); 
            },
            error: function (xhr) { //jika error tampilkan error pada console
                toastr.error(xhr.responseJSON.text,'Gagal Menyimpan Data!')
            }
        })
    }

    function editKeranjangBarangTidakTersedia(event){
        var id = $(event).attr('data-id');
        var URL = "{{route('keranjang-barang-tidak-tersedia.edit', ':id')}}";
        var newURL = URL.replace(':id', id);
        $('#simpan').attr('data-id', id) 
        $.ajax({
            url: newURL,
            type:"GET",
            success: function(response){
                if(response){
                    $('#nama_barang').val(response.nama_barang);
                    $('#jumlah_barang').val(response.jumlah_barang);
                    $("#satuan_id").html('<option value = "'+response.satuan.id+'" selected >'+response.satuan.nama_satuan+'</option>');
                }
            }
        })
    }

    function hapusKeranjangBarangTidakTersedia(event){
        var id = $(event).attr('data-id');
        var URL = "{{route('keranjang-barang-tidak-tersedia.destroy', ':id')}}";
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
                        $('#keranjang-barang-tidak-tersedia-datatable').DataTable().ajax.reload();
                        swal("Selamat!", "Data berhasil dihapus!", "success");
                        updateContentKeranjangBarangTidakTersedia();
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
    }

</script>
@endpush