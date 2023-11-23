@extends('layouts.admin')
@section('content')
<div class="container-fluid px-4">
    <div class="container-fluid px-4">
        <div class="row">
            <div class="col mt-4">
                <h3>Tambah Produk</h3>
            </div>
            <div class="col text-end mt-4">
                <a href="{{ route('product.index')}}" class="btn bg-success text-light"><i class="fas fa-reply me-1"></i>Kembali</a>
            </div>
        </div>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('product.index')}}">Master Produk</a></li>
                <li class="breadcrumb-item active">Tambah Produk</li>
            </ol>
        <form method="POST" action="{{ route('product.store')}}" enctype="multipart/form-data">
            <div class="card mb-4">
                @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                <div class="card-header">
                    <div class="row">
                        <div class="col mb-2">
                            <i class="fas fa-box me-1 mt-2"></i>
                            <span class="title fw-bold">Informasi Produk</span>
                        </div>   
                    </div>
                    <div class="card card-body">
                        <div class="row">                                        
                            <div class="col-sm-3 m-2 px-2">
                                <span class="title fw-bold ">Nama Produk</span>
                                <p class="text text-secondary text-responsive me-2">
                                    Gunakan nama produk sesuai dengan karakteristik produk
                                    cantumkan juga detail seperti brand, merk dan ukurannya
                                </p>
                            </div>
                            <div class="col m-2 px-2">
                                <div class="form-group">
                                    <input type="text" id="inputNameProduk" name="name" class="form-control" placeholder="Nama Produk" required>
                                </div>
                            </div>                                        
                        </div>
                        <div class="row">                                        
                            <div class="col-sm-3 m-2 px-2">
                                <span class="title fw-bold ">Kategori Produk</span>
                                <p class="text text-secondary text-responsive me-2">
                                    Isi kategori produk sesuai dengan jenis barang, contoh :
                                    Tas, sepatu, Gamis dan lain-lain, jika kategori tidak ditemukan
                                    klik tombol icon plus (<span class="text fw-bold">+</span>)
                                </p>
                            </div>
                            <div class="col m-2 px-2">
                                <div class="form-group">
                                    <div class ="input-group mb-3">
                                        <select id="inputCategory" name="product_categories_id" class="form-select" required>
                                            <option selected><span class="text-secondary">--Pilih Kategori--</span></option>
                                            @foreach ($product_categories as $prodCat )
                                                <option value="{{$prodCat->id}}">{{$prodCat->name}}</option>
                                            @endforeach
                                        </select>
                                        <button class="btn btn-success" type="button" data-toggle="modal" data-target="#modalAddCatProduct">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>                                        
                        </div>
                        <div class="row">                                        
                            <div class="col-sm-3 m-2 px-2">
                                <span class="title fw-bold ">Status Order Barang</span>
                            </div>
                            <div class="col m-2 px-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="order_type" id="Order" value="Order" checked>
                                    <label class="form-check-label" for="radioOrderStatus">
                                      Order
                                    </label>
                                </div>
                                <div class="form-check">
                                    <div class="row">
                                        <div class="col col-sm-auto mt-2">
                                            <input class="form-check-input" type="radio" name="order_type" id="PreOrder" value="Pre Order">
                                            <label class="form-check-label" for="radioOrderStatus">Pre Order</label>
                                        </div>
                                        <div class="col col-sm-auto">
                                            <select id="inputDayOrder" class="form-select" name="order_period">
                                                <option value="0" selected><span class="text-secondary">0 Hari</span></option>
                                                <option value="7" ><span class="text-secondary">7 Hari</span></option>
                                                <option value="14"><span class="text-secondary">14 Hari</span></option></option>
                                                <option value="30"><span class="text-secondary">30 Hari</span></option></option>
                                                <option value="60"><span class="text-secondary">60 Hari</span></option></option>
                                                <option value="90"><span class="text-secondary">90 Hari</span></option></option>
                                            </select>
                                            <script>
                                                $('#inputDayOrder').hide();

                                                $('#Order').click(function() {
                                                $('#inputDayOrder').hide();
                                            });

                                            $('#PreOrder').click(function() {
                                                $('#inputDayOrder').show();
                                                $('#inputDayOrder').removeAttr('disabled');
                                            });
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>                                        
                        </div>
                    </div>
                </div>
                <div class="card-header" id="foto">
                    <div class="row">
                        <div class="col mb-2">
                            <i class="fas fa-image me-1 mt-2"></i>
                            <span class="title fw-bold ">Upload Produk</span>
                        </div>   
                    </div>
                    <div class="card card-body">
                        <div class="row">                                        
                            <div class="col-sm-3 m-2 px-2">
                                <span class="title fw-bold ">Foto Produk</span>
                                <p class="text text-secondary text-responsive me-2">
                                    Foto produk disarankan dengan resolusi yang sesuai
                                    dengan ukuran 1:1 atau persegi dengan max 700px x 700px
                                </p>
                            </div>
                            <div class="col m-2">
                                <div class="row">
                                    <div class="col px-2 ps-2 mt-2">
                                        <div class="card card-body" style="width: 150px; height: 150px;">
                                            <div class="form-group">
                                                <input type="file" id="picture_default" name="picture_default" style="display: none;" />
                                                <img class="img" src="assets/img/img_logo.jpg" id="imgPreview" style="width: 120px; height: 120px;">
                                                <script>
                                                    $(document).ready(() => {
                                                        $("#picture_default").change(function () {
                                                            const file = this.files[0];
                                                            if(this.files[0].size > 5097152){
                                                                alert("Ukuran gambar max 5MB!");
                                                                this.value = "";
                                                                return;
                                                            }
                                                            if (file) {
                                                                let reader = new FileReader();
                                                                reader.onload = function (event) {
                                                                    $("#imgPreview")
                                                                      .attr("src", event.target.result);
                                                                };
                                                                reader.readAsDataURL(file);
                                                            }
                                                        });
                                                    });
                                                </script>
                                            </div>
                                        </div>
                                        <div class="text">
                                            <label class="button text-center" for="picture_default">Foto Utama</label>
                                        </div>
                                    </div>
                                    <div class="col px-2 ps-2 mt-2">
                                        <div class="card card-body" style="width: 150px; height: 150px;">
                                            <div class="form-group">
                                                <input type="file" id="imgUpload1"  name="picture_1" style="display: none;" />
                                                <img class="img" src="assets/img/img_logo.jpg" id="picture_1" style="width: 120px; height: 120px;" max-size="1048">
                                            </div>
                                            <script>
                                                $(document).ready(() => {
                                                    $("#imgUpload1").change(function () {
                                                        const file = this.files[0];
                                                        if(this.files[0].size > 5097152){
                                                                alert("Ukuran gambar max 5MB!");
                                                                this.value = "";
                                                                return;
                                                            }
                                                        if (file) {
                                                            let reader = new FileReader();
                                                            reader.onload = function (event) {
                                                                $("#picture_1")
                                                                  .attr("src", event.target.result);
                                                            };
                                                            reader.readAsDataURL(file);
                                                        }
                                                    });
                                                });
                                            </script>
                                        </div>
                                        <div class="text">
                                            <label class="button text-center" for="imgUpload1">Upload File</label>
                                        </div>
                                    </div>
                                    <div class="col px-2 ps-2 mt-2">
                                        <div class="card card-body" style="width: 150px; height: 150px;">
                                            <div class="form-group">
                                                <input type="file" id="imgUpload2" style="display: none;" name="picture_2"/>
                                                <img class="img" for="imgUpload2" src="assets/img/img_logo.jpg" id="picture_2"  style="width: 120px; height: 120px;">
                                            </div>
                                            <script>
                                                $(document).ready(() => {
                                                    $("#imgUpload2").change(function () {
                                                        const file = this.files[0];
                                                        if(this.files[0].size > 5097152){
                                                                alert("Ukuran gambar max 5MB!");
                                                                this.value = "";
                                                                return;
                                                            }
                                                        if (file) {
                                                            let reader = new FileReader();
                                                            reader.onload = function (event) {
                                                                $("#picture_2")
                                                                  .attr("src", event.target.result);
                                                            };
                                                            reader.readAsDataURL(file);
                                                        }
                                                    });
                                                });
                                            </script>
                                        </div>
                                        <div class="text">
                                            <label class="button text-center" for="imgUpload2">Upload File</label>
                                        </div>
                                    </div>
                                    <div class="col px-2 ps-2 mt-2">
                                        <div class="card card-body" style="width: 150px; height: 150px;">
                                            <div class="form-group">
                                                <input type="file" id="imgUpload3" style="display: none;" name="picture_3"/>
                                                <img class="img" src="assets/img/img_logo.jpg" id="picture_3"  style="width: 120px; height: 120px;">
                                            </div>
                                            <script>
                                                $(document).ready(() => {
                                                    $("#imgUpload3").change(function () {
                                                        const file = this.files[0];
                                                        if(this.files[0].size > 5097152){
                                                                alert("Ukuran gambar max 5MB!");
                                                                this.value = "";
                                                                return;
                                                            }
                                                        if (file) {
                                                            let reader = new FileReader();
                                                            reader.onload = function (event) {
                                                                $("#picture_3")
                                                                  .attr("src", event.target.result);
                                                            };
                                                            reader.readAsDataURL(file);
                                                        }
                                                    });
                                                });
                                            </script>
                                        </div>
                                        <div class="text">
                                            <label class="button text-center" for="imgUpload3">Upload File</label>
                                        </div>
                                    </div>
                                    <div class="col px-2 ps-2 mt-2">
                                        <div class="card card-body" style="width: 150px; height: 150px;">
                                            <div class="form-group">
                                                <input type="file" id="imgUpload4" style="display: none;"  name="picture_4"/>
                                                <img class="img" src="assets/img/img_logo.jpg" id="picture_4" style="width: 120px; height: 120px;">
                                            </div>
                                            <script>
                                                $(document).ready(() => {
                                                    $("#imgUpload4").change(function () {
                                                        const file = this.files[0];
                                                        if(this.files[0].size > 5097152){
                                                                alert("Ukuran gambar max 5MB!");
                                                                this.value = "";
                                                                return;
                                                            }
                                                        if (file) {
                                                            let reader = new FileReader();
                                                            reader.onload = function (event) {
                                                                $("#picture_4")
                                                                  .attr("src", event.target.result);
                                                            };
                                                            reader.readAsDataURL(file);
                                                        }
                                                    });
                                                });
                                            </script>
                                        </div>
                                        <div class="text">
                                            <label class="button text-center" for="imgUpload4">Upload File</label>
                                        </div>
                                    </div>
                                </div>
                            </div>                                        
                        </div>
                        <div class="row">
                            <div class="col-sm-3 m-2 px-2">
                                <span class="title fw-bold ">Deskripsi Produk</span>
                                <p class="text text-secondary text-responsive me-2">
                                    Gunakan diskripsi yang sesuai dengan value produk, sertakan juga
                                    Pilihan varian, seperti Warna, Model, Ukuran dll
                                </p>
                            </div>
                            <div class="col m-2">
                                <div class="form-group">
                                    <textarea required class="form-control" id="inputDescProduct" rows="12" name="description" placeholder="Diskripsi Produk"></textarea>
                                </div>
                            </div>   
                        </div>
                    </div>
                </div>

                <div class="card-header" id="varianMenu">
                    <div class="row">
                        <div class="col mb-2">
                            <i class="fas fa-box me-1 mt-2"></i>
                            <span class="title fw-bold">Varian Produk</span>
                        </div>   
                    </div>
                    <div class = "card card-body">
                        <div class="row">
                            <div class="col-sm-3 m-2 px-2">
                                <span class="title fw-bold ">Informasi Varian Produk</span>
                                <p class="text text-secondary text-responsive">
                                    Tentukan jenis varian produk
                                    Contoh : Warna, Ukuran, Corak dll
                                </p>
                            </div>
                            <div class="col">
                                <div class="row">
                                    <div class="col-sm-4 m-2">
                                        <div class="form-group">
                                            <div class ="input-group mb-3">
                                                <input type="text" class="form-control" id="inputVarianType" name="varian_name[]" placeholder="Jenis Varian" required/>
                                            </div>
                                        </div>
                                    </div>
                                   
                                    <div class="col col-sm m-2">
                                        <div class="form-group">
                                            <input type="text" class="form-control tagInput" name="varian_detail_1_name" row="2" value=""/>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group ms-2 mb-2">
                                        <input type="checkbox" class="form-check-input" id="cekVariant2" />
                                        <label class="form-check-label" for="cekVariant2">Aktifkan Varian kedua</label>
                                    </div>
                                </div>
                                <div id="collapseVar2" class="collapse">
                                    <div class="row">
                                        <div class="col-sm-4 m-2">
                                            <div class="form-group">
                                                <div class ="input-group mb-3">
                                                    <input type="text" class="form-control" id="inputVarianType2" name="varian_name[]" placeholder="Jenis Varian"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col col-sm m-2">
                                            <div class="form-group">
                                                <input type="text" class="form-control tagInput" name="varian_detail_2_name"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    var $collapseContainer = $('#collapseVar2');
                                    var $checkbox = $('#cekVariant2');
                                    
                                    $checkbox.change(function() { 
                                        $collapseContainer.collapse('toggle');
                                        if ($checkbox.prop('checked')) {
                                            console.log(123);
                                            $('#inputVarianType2').prop('disabled',false);
                                            // $('#inputVarianType2').val(null);
                                        }else{
                                            $('#inputVarianType2').prop('disabled',true);
                                        }

                                    }); 

                                    $(document).ready(function() {
                                    $collapseContainer.collapse($checkbox.prop('checked') ? "show" : "hide");
                                    });

                                </script>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-header">
                    <div class="row">
                        <div class="col mb-2">
                            <i class="fas fa-box me-1 mt-2"></i>
                            <span class="title fw-bold">Pengiriman Produk</span>
                        </div>   
                    </div>
                    <div class = "card card-body">
                        <div class="row">
                            <div class="col-sm-3 m-2 px-2">
                                <span class="title fw-bold ">Dimensi Produk</span>
                                <p class="text text-secondary text-responsive me-2">
                                    Pastikan dimensi produk sesuai dengan dimensi produk 
                                    ditambah dengan dimensi packing
                                    <span class="text text-secondary fw-bold">Panjang x Lebar x Tinggi</span>
                                </p>
                            </div>
                            <div class="col-sm m-2 p-2">
                                <div class="input-group">
                                    <div class="form-floating">
                                        <input type="number" min="0" class="form-control" id="inputWidth" name="length">
                                        <label for="inputWidth">Panjang</label>
                                    </div>
                                    <span class="input-group-text">Cm</span>
                                </div>
                            </div>
                            <div class="col-sm m-2 p-2">
                                <div class="input-group">
                                    <div class="form-floating">
                                            <input type="number" min="0" class="form-control" id="inputHeight" name="width">
                                      <label for="inputHeight">Lebar</label>
                                    </div>
                                    <span class="input-group-text">Cm</span>
                                </div>
                            </div>
                            <div class="col-sm m-2 p-2">
                                <div class="input-group">
                                    <div class="form-floating">
                                        <input type="number" min="0" class="form-control" id="inputTinggi" name="height">
                                        <label for="inputTinggi">Tinggi</label>
                                    </div>
                                    <span class="input-group-text">Cm</span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3 m-2 px-2">
                                <span class="title fw-bold ">Berat Produk</span>
                                <p class="text text-secondary text-responsive me-2">
                                    Pastikan berat produk sesuai dengan berat produk 
                                    ditambah dengan berat packing dalam
                                    <span class="text text-secondary fw-bold">Gram</span>
                                </p>
                            </div>
                            <div class="col-sm-3 m-2 p-2">
                                <div class="input-group">
                                    <div class="form-floating">
                                        <input type="number" min="0" class="form-control" id="inputWidth" name="weight">
                                        <label for="inputBerat">Berat</label>
                                    </div>
                                    <span class="input-group-text">Gram</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-header">
                    <div class="row text-end">
                        <div class="col mb-2">
                            <a class="btn btn-secondary" href="{{ route('product.index')}}" style="width: 100px;">Batal</a>
                            <button class="btn btn-primary" type="submit" style="width: 100px;">Simpan</button>
                        </div>   
                    </div>
                </div>
            </div>
        </form >
    </div>
</div>

<!--Modal add kategory-->
<div class="modal fade" id="modalAddCatProduct" tabindex="-1" role="dialog" aria-labelledby="modalAddCatProduct" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary text-light">
          <h5 class="modal-title" id="modalAddCatProduct">Tambah Kategori Produk</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close" aria-hidden="true"></button>
        </div>
        <!-- Modal Body-->
        <div class="modal-body">
            <form method="POST" method="#">
                <div class="col">
                    <div class="form-group">
                        <div class="form-floating mb-3 text-secondary">
                            <input class="form-control" type="text" id="nameCatProduct" placeholder="Nama Kategori Produk"> 
                            <label for="nameCatProduct">Nama Kategori Produk</label>
                        </div>                                    
                    </div>
                </div>                                                                                                      
            </form>
        </div>
        <!--Modal Footer-->
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
            <button type="button" class="btn btn-danger">Simpan</button>
        </div>
      </div>
    </div>
</div>

@endsection