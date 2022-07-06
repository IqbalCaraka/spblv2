@extends('layouts.utama')
@push('styles')
    @livewireStyles
@endpush
@push('styles')
    @livewireScripts
    <script>
        function tambahBarang(event) {
            var barangId = $(event).data('id');
            var stok = $(event).val();
            var id = $(event).attr('id');
            var inputKeranjang = $('#input-keranjang-'+barangId).val()
            inputKeranjang = parseInt(inputKeranjang)
            if(inputKeranjang < stok){
                inputKeranjang++;
                $('#input-keranjang-' + barangId).val(inputKeranjang)
                $('#btn-minus-'+barangId).prop('disabled',false)
                if(inputKeranjang==stok){
                    $('#btn-plus-'+barangId).prop('disabled',true)
                }
            }
        }

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
    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">
            <div class="row gx-0">

            <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
                <div class="content">
                <h3>SIMC</h3>
                <h2>Selamat Datang Iqbal di Portal Sistem Informasi Monitoring CAT!</h2>
                <p>
                    Sistem Informasi Monitoring CAT difungsikan untuk melihat penggunaan CAT aktif dan melakukan rekap data ujian.
                </p>
                <div class="text-center text-lg-start">
                    <a href="#values" class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                    <span>Lihat Lebih Lanjut</span>
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