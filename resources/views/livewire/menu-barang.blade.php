<div class="mt-4">
    <section id="barang" class="barang">
        <div class="container">
            <header class="section-header">
                <h2>List Barang</h2>
                <p>Cek List Seluruh Barang</p>
            </header>
            <div class="d-flex justify-content-center">
                <input type="text" class="form-control mb-4 " wire:model="search" placeholder="Search" style="width:50% ;">
            </div> 
            <div class="row gy-4">
                @foreach($barangs as $barang)
                    <div class="col-lg-3 col-md-6" data-aos-delay="100">
                        <div class="box">
                            <input type="hidden" id="id" value="{{$barang->id}}"></input>
                            <h3 class="mt-3" style="color: #012970;">{{$barang->nama_barang}}</h3>
                            @if(empty($barang->gambar))
                                <img src="{{asset('storage/nopict.png')}}" class="img-fluid card-img-top mt-1" alt="" style="height:200px; object-fit: cover;">
                            @else
                                <img src="{{asset('storage/'.$barang->gambar)}}" class="img-fluid card-img-top mt-1" alt="" style="height:200px; object-fit: cover;">
                            @endif
                            <p class="card-text">{{$barang->kategori->nama}}</p>
                            <div class="d-flex justify-content-center mb-2">
                                <!-- <button disabled id="btn-minus-{{$barang->id}}" data-id="{{$barang->id}}" value="{{$barang->stok}}" class="btn btn-xs rounded-pill btn-icon align-self-center btn-outline-primary d-inline-flex justify-content-center mx-1" onclick="kurangBarang(this)">
                                    <span class='bx bx-xs bx-minus align-self-center'></span>
                                </button>
                                <input disabled id="input-keranjang-{{$barang->id}}" class="form-control align-middle d-flex justify-content-center" style="width: 20%; height: 10%;" type="text" value="0"/>
                                <button id="btn-plus-{{$barang->id}}" data-id="{{$barang->id}}" value="{{$barang->stok}}" class="btn btn-xs rounded-pill btn-icon align-self-center align-middle btn-outline-primary d-inline-flex justify-content-center mx-1" onclick="tambahBarang(this)">
                                    <span class='bx bx-xs bx-plus align-self-center'></span>
                                </button> -->
                                <button id="tambah-keranjang-{{$barang->id}}" data-id="{{$barang->id}}" class="btn-tambah-keranjang" onclick="tambahBarang(event.target)">Tambahkan ke Keranjang!</button>
                            </div>
                            <p>
                                <small class="text-muted fw-semibold" id="stok">Jumlah stok saat ini {{$barang->stok}}</small>
                            </p>
                        </div>
                    </div>         
                @endforeach
            </div>
        </div>
        
    </section><!-- End Pricing Section -->
    <div class="d-flex justify-content-start mt-4">
        {{$barangs->onEachSide(1)->links()}}
    </div>     
    
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
        var stok = $(event).val();
        var userId = $('#userId').data('id')
        var inputKeranjang = 1;
        $.ajax({
            url:"{{route('keranjang.store')}}",
            type:"POST",
            data:{
                user_id : userId,
                barang_id:barangId,
                jumlah_barang:inputKeranjang
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
</script>
@endpush