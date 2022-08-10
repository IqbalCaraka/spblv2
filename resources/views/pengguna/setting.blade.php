@extends('layouts.utama')
@section('content')
<!-- ======= Setting Section ======= -->
<div class="container" >
    <section id="setting" class="setting">
        <div class="container mt-4" data-aos="fade-up">
            <div class="content">
                <h1 class="mb-5">Profil {{Auth::user()->name}}</h1>

                <div class="row gx-0">
                    <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
                        
                        <h3>NIP        :</h3>
                        <h2>{{ Auth::user()->nip }}</h2>
                        <h3>Nama        :</h3>
                        <h2>{{ Auth::user()->name }}</h2>
                        <h3>Jabatan        :</h3>
                        <h2>{{ Auth::user()->jabatan->jabatan }}</h2>
                        <h3>Bidang        :</h3>
                        <h2>{{ Auth::user()->bidang->bidang }}</h2>
                        <p>
                            Terima kasih telah menjadi bagian dari Si Permata!
                        </p>
                        <div class="text-center text-lg-start">
                            <a href="javascript:void(0);" class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center" data-bs-toggle="modal" data-bs-target="#modalProfil">
                                <span>Yuk atur ulang password kamu</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                        
                    </div>
                    <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="zoom-out" data-aos-delay="200">
                            <img src="{{asset ('utama/img/me.jpg')}}" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!--Modal ganti password-->
<div class="modal fade bd-example-modal-lg" id="modalProfil" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-edit" name="ItemForm">
                    <div class="form-group row mb-3">
                        <label for="password_lama" class="col-md-4 col-form-label text-md-right">Password Lama</label>
                        <div class="col-md-8">
                            <input id="password_lama" type="password" class="form-control" name="password_lama">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-right">Password Baru</label>
                        <div class="col-md-8">
                            <input id="password" type="password" class="form-control" name="password" required>
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">Konfirmasi Password</label>
                        <div class="col-md-8">
                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="button" id="simpan" data-id="{{Auth::user()->id}}" class="btn btn-sm btn-outline-primary" onclick="updatePassword()" >
                                Simpan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Modal ganti password-->

<!-- End Setting Section -->
@endsection

@push('scripts')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
        }
    });

    function updatePassword (){
        var id = $('#simpan').attr('data-id');
        var URL = "{{route('setting.update', ':id')}}";
        var newURL = URL.replace(':id', id); 
        var password_lama = $('#password_lama').val();
        var password = $('#password').val();
        var password_confirmation = $('#password_confirmation').val();
        $.ajax({
            url: newURL,
            type:"PUT",
            dataType:"JSON",
            data:{
                password_lama:password_lama,
                password:password,
                password_confirmation:password_confirmation,
            },
            success: function(data){
                $('#modalProfil').modal('hide');
                $('#form-edit').trigger("reset");
                swal("Selamat!", "Password berhasil diperbarui!", "success"); 
            },
            error: function (xhr) { 
                toastr.error(xhr.responseJSON.text,'Gagal Menyimpan Data!')
            }

        })
    }
    

</script>
@endpush