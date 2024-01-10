<div class="card mb-4">
    <div class="card-header">
        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        <div class="row">
            <div class="d-flex justify-content-sm-between">
                <div class="col">
                    <i class="fas fa-table me-1 mt-2"></i><span>Series List</span>
                </div>
                <div class="col-md-auto">
                    <a href="#editBestSeller" class="btn text-primary" data-toggle="modal" data-target="#editSeries" role="dialog" aria-expanded="false">
                        <i class="fas fa-pencil"></i>
                    </a>
                </div>
            </div>
        </div>                
    </div>
    <div class="card card-body">
        <div class="row"> 
            
            <div class="col-xl-4 col-lg-4 col-md-6 mb-4">
                <div class="bg-white rounded shadow-sm">
                    <a href="#editSeries" class="link" data-toggle="modal" data-target="#editSeries" role="dialog" aria-expanded="false" >
                        <img src="{{ asset('storage/series/series_1.jpeg') }}" alt="" class="img-fluid card-img-top">
                    </a>
                </div>
                <div class="card-title mt-2 text-center">
                    <a href="" class="text-decoration-none" onclick="editSeries()">
                        <h4>Judul Series</h4>
                    </a>
                    <span class="text-secondary">Diskripsi Series</span>
                </div>                     
            </div>

        </div>
    </div>
</div>



<!--Modal Edit carousel-->
<div class="modal fade" id="editSeries" role="dialog" aria-labelledby="editSeries" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary text-light">
          <h5 class="modal-title">Edit Series</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close" aria-hidden="true"></button>
        </div>

        <!-- Modal Body-->
        <form method="POST" action="{{route('series.update')}}">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <input type="hidden" name="series_id" id="series_id">
                <div class="row">
                    <div class="col">
                        <div class="card mb-2">
                            <div class="card-body text-center">
                                <div class="form-group">
                                    <input type="file" id="picture" name="picture" style="display: none;" />
                                    <img class="img img-fluid" src="{{ asset('storage/series/series_1.jpeg') }}" id="imgPreview">
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
                                <label for="exampleDataList" class="col-sm-2 col-form-label">Pilih Series</label>
                                <div class="col-sm-10">
                                    <select name="product_category_id" id="product_category_id" class="form-control" aria-label="Default select example">
                                        <option selected disabled>Pilih Series</option>
                                        <option value="product_category_id">Series 1</option>
                                        <option value="product_category_id">Series 2</option>
                                        <option value="product_category_id">Series 3</option>
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

</script>
