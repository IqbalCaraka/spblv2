<div>
    <div>
        <input type="text" class="form-control my-3" wire:model="search" placeholder="Search">
    </div>
    <div id="searchResult" class="row d-flex justify-content-center mt-4 p-1">
        @foreach($barangs as $barang)
            <div class="card h-100 col-sm-6 m-1" style="width: 16rem;">
                <img src="{{asset('storage/'.$barang->gambar)}}" class="card-img-top mt-3" style="height:170px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">{{$barang->nama_barang}}</h5>
                    <p class="card-text">Ini adalah barang-barang dari kategori pilihan</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                    <p class="card-text">
                        <small class="text-muted">-Jumlah Stok saat ini ({{$barang->stok}})</small>
                    </p>
                    <button type="button" class="btn btn-outline-primary"  data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true">
                        <i class="tf-icons bx bxs-"></i>
                    </button>
                </div>
            </div>
        @endforeach
        <div class="d-flex justify-content-start mt-4">
            {{$barangs->onEachSide(1)->links()}}
        </div>
    </div>
</div>

