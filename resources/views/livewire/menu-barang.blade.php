<div class="mt-4">
    <section id="barang" class="barang">
        <div class="container">
            <header class="section-header">
                <h2>List Barang</h2>
                <p>Cek List Seluruh Barang</p>
            </header>
            <div class="d-flex justify-content-center">
                <input type="text" class="form-control mb-4 search" wire:model="search" placeholder="Search" style="width:50% ;">
            </div> 
            <div class="spinner-load" wire:loading.inline >
                <div class="container" data-aos="fade-up">
                    <div class="content">
                        <div class="row gx-0">
                            <div class="spinner-border spinner-border-lg text-loading" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>   
            <div class="content" >     
                <div class="row gy-4" id="list-barang" >    
                    @if ($barangs->count() == 0)
                    <div id="empty-data" class="empty-data">
                        <div class="container" data-aos="fade-up">
                            <div class="content">
                                <div class="row gx-0">
                                    <img src="{{asset('storage/emptydata.jpg')}}" class="" alt="">
                                    <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
                                        <div class="text-center text-lg-start">
                                            <h3>Data tidak ditemukan!</h3>
                                            <a href="javascript:void(0)" class="btn-tidak-tersedia d-inline-flex align-items-center justify-content-center align-self-center" data-bs-toggle="modal" data-bs-target="#modalPengajuan" onclick="selectSatuan()">
                                                <span>Isi Pengajuan Barang Tidak Tersedia</span>
                                            </a>
                                        </div>
                                    </div>  
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @else
                    @foreach($barangs as $barang)
                    <div class="col-lg-3 col-md-6" data-aos-delay="100">
                        <div class="box" >
                            <input type="hidden" id="id" value="{{$barang->id}}"></input>
                            <h3 class="mt-3" style="color: #012970;">{{$barang->nama_barang}}</h3>
                            @if(empty($barang->gambar))
                                <img src="{{asset('storage/nopict.png')}}" class="img-fluid card-img-top mt-1" alt="" style="height:200px; object-fit: cover;">
                            @else
                                <img src="{{asset('storage/'.$barang->gambar)}}" class="img-fluid card-img-top mt-1" alt="" style="height:200px; object-fit: cover;">
                            @endif
                            <p class="card-text">{{$barang->kategori->nama}}</p>
                            <div class="d-flex justify-content-center mb-2">
                                <button id="tambah-keranjang-{{$barang->id}}" data-id="{{$barang->id}}" class="btn-tambah-keranjang" onclick="tambahBarang(event.target)">Tambahkan ke Keranjang!</button>
                            </div>
                            <p>
                                <small class="text-muted fw-semibold" id="stok">Jumlah stok saat ini {{$barang->stok}}</small>
                            </p>
                        </div>
                    </div>         
                    @endforeach
                    @endif
                </div>
            </div>
            <div class="d-flex justify-content-start mt-4">
                {{$barangs->onEachSide(1)->links()}}
            </div>     
        </div>
        <!--Modal show pengajuan barang tidak tersedia-->
        <div class="modal fade bd-example-modal-lg" id="modalPengajuan" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="pengajuan-barang-tidak-tersedia-title">Tambah Pengajuan Barang Tidak Tersedia</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="form-tambah" name="ItemForm">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="nama_barang" class="form-label">Nama Barang Yang Diajukan</label>
                                        <input style="text-align: left;" type="text" id="nama_barang" name="nama_barang" class="form-control" placeholder="Masukan Nama Barang"/>
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
                                        <select name="satuan_id" id="satuan_id" style="width: 100% ;" class="js-example-basic-single select2 form-control" name="states" id="satuan_id">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"> Batal </button>
                                <button type="button" class="btn btn-outline-primary" onclick="createKeranjang()"> Simpan </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--Modal show pengajuan barang tidak tersedia-->   
    </section><!-- End Pricing Section -->
    
</div>

@push('scripts')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
        }
    });
    function tambahBarang(event) {
        var barangId = $(event).data('id');
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
                toastr.options = {
                                    "debug": false,
                                    "positionClass": "toast-top-left",
                                    "onclick": null,
                                    "fadeIn": 300,
                                    "fadeOut": 1000,
                                    "timeOut": 5000,
                                    "extendedTimeOut": 1000
                                }
                toastr.success('Barang berhasil ditambahkan!','Cek Keranjang Anda!')
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
                toastr.error('Jumlah permintaan sudah melebihi stok, cek keranjang Anda!','Gagal Menambahkan!')
            }
        })

    }

    function selectSatuan(){
        $('.js-example-basic-single').select2({
            placeholder: 'Pilih Satuan...',
            dropdownParent: $('#modalPengajuan'),
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
    }

    function createKeranjang(){
        var nama_barang = $("#nama_barang").val();
        var jumlah_barang = $("#jumlah_barang").val();
        var satuan_id = $("#satuan_id").val();
        $.ajax({
            url:"{{route('keranjang-barang-tidak-tersedia.store')}}",
            type:"POST",
            typeData:"JSON",
            data:{
                nama_barang:nama_barang,
                jumlah_barang:jumlah_barang,
                satuan_id : satuan_id
            },
            success: function(data){
                $('#modalPengajuan').modal('hide');
                $('#form-tambah').trigger("reset");
                $('#barang').trigger("reset");
                $('.js-example-basic-single').html("");
                swal("Selamat!", "Data berhasil disimpan! Cek Keranjang Anda!", "success"); 
            },
            error: function (xhr) { //jika error tampilkan error pada console
                toastr.error(xhr.responseJSON.text,'Gagal Menyimpan Data!')
            }
        })
    }
</script>
@endpush