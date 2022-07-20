@extends('layouts.utama')
@section('content')
<!-- ======= Keranjang Section ======= -->
<div class="container" >
    <div id="keranjang" class="keranjang">
       <div class="container mt-4" data-aos="fade-up">
           <div class="content">
               <h1>Keranjang {{Auth::user()->name}}</h1>
               <div class="content-keranjang">
                   @foreach($keranjangs as $keranjang)
                       <div class="card mt-2">
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
                               <div class="col-3 d-inline-flex justify-content-start align-self-center">
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
           </div>
       </div>
   </div>
</div>


<div class="check-out">
    <button class="btn btn-danger btn-check-out">
       Check Out Sekarang!
    </button>
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

    function updateInputBarang(barangId){
        var inputBarang = $('#input-'+barangId).val();
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

</script>
@endpush