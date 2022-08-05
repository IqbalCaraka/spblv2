@extends('layouts.utama')
@push('styles')
    @livewireStyles
@endpush
@push('scripts')
    @livewireScripts
    <script>        
        function kurangBarang(event) {
            var barangId = $(event).data('id');
            var stok = $(event).val();
            var id = $(event).attr('id');
            var inputKeranjang = $('#input-keranjang-'+barangId).val()
            inputKeranjang = parseInt(inputKeranjang)
            if(inputKeranjang > 0){
                --inputKeranjang;
                $('#input-keranjang-' + barangId).val(inputKeranjang)
                $('#btn-plus-'+barangId).prop('disabled',false)
                if(inputKeranjang == 0){
                    $('#btn-minus-'+barangId).prop('disabled',true)
                }
            }
        }
    </script>

@endpush

@section('content')
<!-- ======= Barang Section ======= -->
<div class="container" >
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">
            <div class="content">
                <div class="row gx-0">
                    <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
                        
                        <h3>SI PERMATA</h3>
                        <h2>Selamat Datang {{ Auth::user()->name }} di Portal Sistem Persediaan Mandiri Terlayani!</h2>
                        <p>
                            Sistem Persediaan Mandiri Terlayani, digunakan untuk melakukan permintaan kebutuhan barang ke Sub Bagian Umum!
                        </p>
                        <div class="text-center text-lg-start">
                            <a href="#barang" class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                                <span>Yuk Cari Barang yang Kamu Cari! </span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                        
                    </div>
                    <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="zoom-out" data-aos-delay="200">
                            <img src="{{asset ('utama/img/office.jpg')}}" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    @livewire('menu-barang')
</div>
<!-- End About Section -->
@endsection