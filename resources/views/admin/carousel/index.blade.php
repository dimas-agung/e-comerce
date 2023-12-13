@extends('landing_page')

@section('carousel')

<div class="container-fluid px-4">
    <div class="row">
        <div class="col mt-4">
            <h3>Carousel</h3>
        </div>
    </div>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Carousel</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            <div class="row">
                <div class="col">
                    <i class="fas fa-table me-1 mt-2"></i><span>Carousel List</span>
                </div>
                {{-- <div class="col-md-auto">
                    <a href="{{route('carousel.create')}}" type="button" class="btn btn-primary">
                        <i class="fas fa-plus-square me-2"></i><span>Tambah Carousel</span>
                    </a>
                </div> --}}
            </div>                
        </div>
        <div class="card card-body">
            <div class="row"> 
                <div class="col-xl-4 col-lg-4 col-md-6 mb-4">
                    <div class="bg-white rounded shadow-sm">
                        <a href="#editCarousel" class="link" data-toggle="modal" data-bs-target="#editCarousel" role="dialog" aria-expanded="false" >
                            <img src="{{ asset('storage/carousel/carousel_1.jpg') }}" alt="" class="img-fluid card-img-top">
                        </a>
                    </div>
                    <div class="card-title mt-2 text-center">
                        <a href="#editCarousel" class="link text-decoration-none" data-toggle="modal" data-bs-target="#editCarousel" role="dialog" aria-expanded="false" >
                            <h4>Temukan Kecantikan Solehamu</h4>
                        </a>
                        <span class="text-secondary">Warna yang anggun dan corek motif yang mempesona, pancarkan aura cantikmu</span>
                    </div>                     
                </div>

                <div class="col-xl-4 col-lg-4 col-md-6 mb-4">
                    <div class="bg-white rounded shadow-sm">
                        <a href="#editCarousel" class="link" data-toggle="modal" data-bs-target="#editCarousel" role="dialog" aria-expanded="false" >
                            <img src="{{ asset('storage/carousel/carousel_2.jpg') }}" alt="" class="img-fluid card-img-top">
                        </a>
                    </div>
                    <div class="card-title mt-2 text-center">
                        <a href="#editCarousel" class="link text-decoration-none" data-toggle="modal" data-bs-target="#editCarousel" role="dialog" aria-expanded="false" >
                            <h4>Pesona Cantik Seperti Bidadari</h4>
                        </a>
                        <span class="text-secondary">Gaun cantik nan indah, memperindah penampilanmu</span>
                    </div>                     
                </div>

                <div class="col-xl-4 col-lg-4 col-md-6 mb-4">
                    <div class="bg-white rounded shadow-sm">
                        <a href="#editCarousel" class="link" data-toggle="modal" data-bs-target="#editCarousel" role="dialog" aria-expanded="false" >
                            <img src="{{ asset('storage/carousel/carousel_3.jpg') }}" alt="" class="img-fluid card-img-top">
                        </a>
                    </div>
                    <div class="card-title mt-2 text-center">
                        <a href="#editCarousel" class="link text-decoration-none" data-toggle="modal" data-bs-target="#editCarousel" role="dialog" aria-expanded="false" >
                            <h4>Ini Adalah Sepatu</h4>
                        </a>
                        <span class="text-secondary">Iya iyalah masa' sandal</span>
                    </div>                     
                </div>

            </div>
        </div>
    </div>

</div>


<!--Modal Edit carousel-->
<div class="modal fade" id="editCarousel" tabindex="-1" role="dialog" aria-labelledby="modalCarousel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary text-light">
          <h5 class="modal-title" id="editCarousel">Edit Carousel</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close" aria-hidden="true"></button>
        </div>

        <!-- Modal Body-->
        <form method="POST" action="">
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <div class="card mb-2">
                            <div class="card-body text-center">
                                <div class="form-group">
                                    <input type="file" id="imgCarousel" name="imgCarousel" style="display: none;" />
                                    <img class="img img-fluid" src="{{ asset('storage/carousel/carousel_1.jpg') }}" id="imgPreview">
                                    
                                </div>
                            </div>
                            <div class="text-center mb-2">
                                <label class="button text-center" for="imgCarousel">Ganti Foto</label>
                            </div>
                        </div>
                        <div class="card mb-2 p-3">
                            <div class="row mb-3">
                                <label for="inputTitle" class="col-sm-2 col-form-label">Judul</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputTitle">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputDesc" class="col-sm-2 col-form-label">Diskripsi</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputDesc">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="exampleDataList" class="col-sm-2 col-form-label">Pilih Produk</label>
                                <div class="col-sm-10">
                                    <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Pilih Produk">
                                    <datalist id="datalistOptions">
                                        <option value="Produk 1">
                                        <option value="Produk 2">
                                        <option value="Produk 3">
                                        <option value="Produk 4">
                                        <option value="Produk 5">
                                    </datalist>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                                                                                                      
            </div>

            <!--Modal Footer-->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                <button type="submit"  class="btn btn-danger">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(() => {
        $("#imgCarousel").change(function () {
            const file = this.files[0];
            let reader = new FileReader();
                reader.onload = function (event) {
                    $("#imgPreview")
                      .attr("src", event.target.result);
                };
                reader.readAsDataURL(file);
        });
    });
</script>

@endsection