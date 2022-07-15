@extends('layouts.utama')
@section('content')
 <!-- ======= Keranjang Section ======= -->
 <div id="keranjang" class="keranjang">
    <div class="container mt-4" data-aos="fade-up">
        <div class="content">
            <h1>Keranjang {{Auth::user()->name}}</h1>
            @foreach($keranjangs as $keranjang)
                <div class="card mt-2">
                    <div class="card-header">
                        <h2>{{$keranjang[0]->barang->kategori->nama}}</h2>
                        <hr> 
                    </div>
                    @foreach($keranjang as $item)
                    <div class="card-body row">
                        <div class="col-2 d-inline-flex justify-content-start align-self-center">
                            @if(empty($item->barang->gambar))
                                <img src="{{asset('storage/nopict.png')}}" class="img-fluid card-img-top mt-1" alt="" style="object-fit: cover;">
                            @else
                                <img src="{{asset('storage/'.$item->barang->gambar)}}" class="img-fluid card-img-top mt-1" alt="" style="object-fit: cover;">
                            @endif
                        </div>
                        <div class="col-5 justify-content-start align-self-center">
                            <h3>{{$item->barang->nama_barang}}</h3>
                            <p>
                                <small class="text-muted fw-semibold" id="stok">Jumlah stok saat ini {{$item->barang->stok}}</small>
                            </p>
                        </div>
                        <div class="col-5 d-inline-flex justify-content-start align-self-center">
                            <div class="align-self-center d-flex justify-content-end">
                                <button disabled id="" data-id="" value="" class="btn btn-xs rounded-pill btn-icon align-self-center btn-outline-primary d-inline-flex justify-content-center mx-1" onclick="kurangBarang(this)">
                                    <span class='bx bx-xs bx-minus align-self-center'></span>
                                </button>
                                <input disabled id="" class="form-control align-middle d-flex justify-content-center" style="width: 20%; height: 10%;" type="text" value="{{$item->jumlah_barang}}"/>
                                <button id="" data-id="" value="" class="btn btn-xs rounded-pill btn-icon align-self-center align-middle btn-outline-primary d-inline-flex justify-content-center mx-1" onclick="tambahBarang(this)">
                                    <span class='bx bx-xs bx-plus align-self-center'></span>
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
    <!-- End keranjang Section -->
@endsection