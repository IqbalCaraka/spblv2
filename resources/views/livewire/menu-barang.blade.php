<div class="mt-4">
    <section id="barang" class="barang">
        <div class="container">
            <header class="section-header">
                <h2>List Barang</h2>
                <p>Cek List Seluruh Barang</p>
                <input type="text" name="" id="coba" value="34">
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
                            <img src="{{asset('storage/'.$barang->gambar)}}" class="img-fluid card-img-top mt-1" alt="" style="height:200px; object-fit: cover;">
                            <p class="card-text">Kategori</p>
                            <div class="d-flex justify-content-center">
                                <button disabled id="btn-minus-{{$barang->id}}" data-id="{{$barang->id}}" value="{{$barang->stok}}" class="btn btn-xs rounded-pill btn-icon align-self-center btn-outline-primary d-inline-flex justify-content-center mx-1" onclick="kurangBarang(this)">
                                    <span class='bx bx-xs bx-minus align-self-center'></span>
                                </button>
                                <input disabled id="input-keranjang-{{$barang->id}}" class="form-control align-middle d-flex justify-content-center" style="width: 20%; height: 10%;" type="text" value="0"/>
                                <button id="btn-plus-{{$barang->id}}" data-id="{{$barang->id}}" value="{{$barang->stok}}" class="btn btn-xs rounded-pill btn-icon align-self-center align-middle btn-outline-primary d-inline-flex justify-content-center mx-1" onclick="tambahBarang(this)">
                                    <span class='bx bx-xs bx-plus align-self-center'></span>
                                </button>
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


