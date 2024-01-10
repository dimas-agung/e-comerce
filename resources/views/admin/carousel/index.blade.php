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
            @foreach ($carousel as $item )
                
            <div class="col-xl-4 col-lg-4 col-md-6 mb-4">
                <div class="bg-white rounded shadow-sm">
                    <a onclick="editCarousel({{$item->id}})" >
                        <img src="{{ asset('storage/'.$item->picture) }}" alt="" class="img-fluid card-img-top">
                    </a>
                </div>
                <div class="card-title mt-2 text-center">
                    <a onclick="editCarousel({{$item->id}})">
                        <h4>{{$item->title}}</h4>
                    </a>
                    <span class="text-secondary">{{$item->description}}</span>
                </div>                     
            </div>
            @endforeach


        </div>
    </div>
</div>



<!--Modal Edit carousel-->
<div class="modal fade" id="editCarousel" role="dialog" aria-labelledby="modalCarousel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary text-light">
          <h5 class="modal-title">Edit Carousel</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" aria-hidden="true"></button>
        </div>

        <!-- Modal Body-->
        <form method="POST" action="{{route('carousel.update')}}">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <input type="hidden" name="carousel_id" id="carousel_id">
                <div class="row">
                    <div class="col">
                        <div class="card mb-2">
                            <div class="card-body text-center">
                                <div class="form-group">
                                    <input type="file" id="picture" name="picture" style="display: none;" />
                                    <img class="img img-fluid" src="{{ asset('storage/carousel/carousel_1.jpg') }}" id="imgPreview">
                                    
                                </div>
                            </div>
                            <div class="text-center mb-2">
                                <label class="button text-center" for="picture">Ganti Foto</label>
                            </div>
                        </div>
                        <div class="card mb-2 p-3">
                            <div class="row mb-3">
                                <label for="title" class="col-sm-2 col-form-label">Judul</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="title" name="title">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="description" class="col-sm-2 col-form-label">Diskripsi</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="description" name="description">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="exampleDataList" class="col-sm-2 col-form-label">Pilih Produk</label>
                                <div class="col-sm-10">
                                    <select name="product_id" id="product_id" class="form-control" aria-label="Default select example">
                                        <option selected disabled>Pilih Produk</option>
                                        @foreach ($products as $item)
                                            
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                      
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                                                                                                      
            </div>

            <!--Modal Footer-->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="closeModal()">Keluar</button>
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
    function editCarousel(id) {
        $.ajax({
            url: "{{route('api.product')}}",
            method: "GET",
            dataType: "json",
            success: function (data) {
                console.log(data);
                $('#product_id').empty().append('<option selected="selected" value="">Pilih Product</option>')
                data.forEach(val => {

                    $('#product_id').append($("<option></option>")
                        .attr("value",val.id )
                        .text(val.name)); 
                });
            //    $('#address').val(data[0].address)
            },
        });
        $.ajax({
            url: "{{route('api.landing_page.carousel')}}",
            method: "GET",
            dataType: "json",
            data : {
                carousel_id : id
            },
            success: function (data) {
               $('#carousel_id').val(data.id);
               $('#title').val(data.title);
               $('#description').val(data.description);
               $('#product_id').val(data.product_id);
               let src = 'storage/'+data.picture;
               $("#imgPreview").attr("src", src);
            //    $('#description').val(data.description);
               
            },
        })
       
        renderSelect2();
        $('#editCarousel').modal('show')
        
    }
    function closeModal() {
        $('#editCarousel').modal('hide')
    }
    function renderSelect2() {
                $('.select2').select2();
            }
</script>
