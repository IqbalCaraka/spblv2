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
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">
            <div class="row gx-0">

            <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
                <div class="content">
                <h3>SIPBL</h3>
                <h2>Selamat Datang {{ Auth::user()->name }} di Portal Sistem Informasi Permintaan Barang Lancar!</h2>
                <p>
                    Sistem Informasi Monitoring CAT difungsikan untuk melakukan pengajuan permintaan Aset Barang Lancar, ke Sub Bagian Umum!
                </p>
                <div class="text-center text-lg-start">
                    <a href="#barang" class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                        <span>Yuk Cari Barang yang Kamu Cari! </span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                </div>
            </div>

            <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
                <img src="{{asset ('utama/img/office.jpg')}}" class="img-fluid" alt="">
            </div>

            </div>
        </div>

    </section>
    <!-- End About Section -->
    @livewire('menu-barang')
@endsection