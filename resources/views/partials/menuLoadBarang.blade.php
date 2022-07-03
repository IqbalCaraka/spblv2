@foreach($barangs as $barang)
    <div class="card col-sm-6 m-1" style="width: 16rem;">
        <img src="" class="card-img-top  mt-3" style="height:150px; object-fit: contain;">
        <div class="card-body">
            <h5 class="card-title">{{$barang->nama_barang}}</h5>
            <p class="card-text">{{$barang->nomor_barang}}</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
    </div>
@endforeach
<div class="d-flex justify-content-start mt-4">
    {{$barangs->onEachSide(1)->links()}}
</div>