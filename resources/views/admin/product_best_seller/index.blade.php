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
                    <i class="fas fa-table me-1 mt-2"></i><span>Produk Terlaris</span>
                </div>
                <div class="col-md-auto">
                    <a href="#editBestSeller" class="btn text-primary" data-toggle="modal" data-bs-target="#editBestSeller" role="dialog" aria-expanded="false">
                        <i class="fas fa-pencil"></i>
                    </a>
                </div>
            </div>
        </div>                
    </div>
    <div class="card card-body">
        <div class="row"> 
            <div class="col-sm-2 mb-4">
                <div class="bg-white rounded shadow-sm">
                    <a href="#editCarousel" class="link" data-toggle="modal" data-bs-target="#editCarousel" role="dialog" aria-expanded="false" >
                        <img src="{{ asset('storage/bestseller/bestseller_1.png') }}" alt="" class="img-fluid card-img-top col-sm-2">
                    </a>
                </div>
                <div class="card-title text-center">
                    <span>Produk 1</span>  
                </div>      
            </div>

            <div class="col-sm-2 mb-4">
                <div class="bg-white rounded shadow-sm">
                    <a href="#editCarousel" class="link" data-toggle="modal" data-bs-target="#editCarousel" role="dialog" aria-expanded="false" >
                        <img src="{{ asset('storage/bestseller/bestseller_2.png') }}" alt="" class="img-fluid card-img-top col-sm-2">
                    </a>
                </div>
                <div class="card-title text-center">
                    <span>Produk 2</span>  
                </div>      
            </div>

            <div class="col-sm-2 mb-4">
                <div class="bg-white rounded shadow-sm">
                    <a href="#editCarousel" class="link" data-toggle="modal" data-bs-target="#editCarousel" role="dialog" aria-expanded="false" >
                        <img src="{{ asset('storage/bestseller/bestseller_3.png') }}" alt="" class="img-fluid card-img-top col-sm-2">
                    </a>
                </div>
                <div class="card-title text-center">
                    <span>Produk 3</span>  
                </div>      
            </div>

            <div class="col-sm-2 mb-4">
                <div class="bg-white rounded shadow-sm">
                    <a href="#editCarousel" class="link" data-toggle="modal" data-bs-target="#editCarousel" role="dialog" aria-expanded="false" >
                        <img src="{{ asset('storage/bestseller/bestseller_4.png') }}" alt="" class="img-fluid card-img-top col-sm-2">
                    </a>
                </div>
                <div class="card-title text-center">
                    <span>Produk 4</span>  
                </div>      
            </div>

            <div class="col-sm-2 mb-4">
                <div class="bg-white rounded shadow-sm">
                    <a href="#editCarousel" class="link" data-toggle="modal" data-bs-target="#editCarousel" role="dialog" aria-expanded="false" >
                        <img src="{{ asset('storage/bestseller/bestseller_5.png') }}" alt="" class="img-fluid card-img-top col-sm-2">
                    </a>
                </div>
                <div class="card-title text-center">
                    <span>Produk 5</span>  
                </div>      
            </div>

            <div class="col-sm-2 mb-4">
                <div class="bg-white rounded shadow-sm">
                    <a href="#editCarousel" class="link" data-toggle="modal" data-bs-target="#editCarousel" role="dialog" aria-expanded="false" >
                        <img src="{{ asset('storage/bestseller/bestseller_6.png') }}" alt="" class="img-fluid card-img-top col-sm-2">
                    </a>
                </div>
                <div class="card-title text-center">
                    <span>Produk 6</span>  
                </div>      
            </div>

        </div>
    </div>
</div>



<!--Modal Edit carousel-->
<div class="modal fade" id="editBestSeller" tabindex="-1" role="dialog" aria-labelledby="modalEditBestSeller" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary text-light">
          <h5 class="modal-title" id="editCarousel">Edit Produk Terlaris</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close" aria-hidden="true"></button>
        </div>

        <!-- Modal Body-->
        <form method="POST" action="">
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        
                        <div class="card mb-2 p-3">
                            <div class="row mb-3">
                                <label for="exampleDataList" class="col-sm-3 col-form-label">Produk 1</label>
                                <div class="col-sm">
                                    <select name="product_id" id="product_id" class="form-control" aria-label="Default select example">
                                        <option selected disabled>Pilih Produk</option>
                                        <option value="1">Produk 1</option>
                                        <option value="2">Produk 2</option>
                                        <option value="3">Produk 3</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="exampleDataList" class="col-sm-3 col-form-label">Produk 2</label>
                                <div class="col-sm">
                                    <select name="product_id" id="product_id" class="form-control" aria-label="Default select example">
                                        <option selected disabled>Pilih Produk</option>
                                        <option value="1">Produk 1</option>
                                        <option value="2">Produk 2</option>
                                        <option value="3">Produk 3</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="exampleDataList" class="col-sm-3 col-form-label">Produk 3</label>
                                <div class="col-sm">
                                    <select name="product_id" id="product_id" class="form-control" aria-label="Default select example">
                                        <option selected disabled>Pilih Produk</option>
                                        <option value="1">Produk 1</option>
                                        <option value="2">Produk 2</option>
                                        <option value="3">Produk 3</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="exampleDataList" class="col-sm-3 col-form-label">Produk 4</label>
                                <div class="col-sm">
                                    <select name="product_id" id="product_id" class="form-control" aria-label="Default select example">
                                        <option selected disabled>Pilih Produk</option>
                                        <option value="1">Produk 1</option>
                                        <option value="2">Produk 2</option>
                                        <option value="3">Produk 3</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="exampleDataList" class="col-sm-3 col-form-label">Produk 5</label>
                                <div class="col-sm">
                                    <select name="product_id" id="product_id" class="form-control" aria-label="Default select example">
                                        <option selected disabled>Pilih Produk</option>
                                        <option value="1">Produk 1</option>
                                        <option value="2">Produk 2</option>
                                        <option value="3">Produk 3</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <label for="exampleDataList" class="col-sm-3 col-form-label">Produk 6</label>
                                <div class="col-sm">
                                    <select name="product_id" id="product_id" class="form-control" aria-label="Default select example">
                                        <option selected disabled>Pilih Produk</option>
                                        <option value="1">Produk 1</option>
                                        <option value="2">Produk 2</option>
                                        <option value="3">Produk 3</option>
                                    </select>
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
