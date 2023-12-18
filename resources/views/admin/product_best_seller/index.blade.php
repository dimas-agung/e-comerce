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
            @foreach ($product_best_seller as $item)
                
                <div class="col-sm-2 mb-4">
                    <div class="bg-white rounded shadow-sm">
                        <a href="#editCarousel" class="link" data-toggle="modal" data-bs-target="#editCarousel" role="dialog" aria-expanded="false" >
                            <img src="{{ asset('storage/'.$item->product->picture_default) }}" alt="" class="img-fluid card-img-top col-sm-2">
                        </a>
                    </div>
                    <div class="card-title text-center">
                        <span>{{$item->product->name}}</span>  
                    </div>      
                </div>
            @endforeach

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
        <form method="POST" action="{{route('product_best_seller.update')}}">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        
                        <div class="card mb-2 p-3">
                            @for ($i = 0; $i < 6; $i++)
                                
                            <div class="row mb-3">
                                <label for="exampleDataList" class="col-sm-3 col-form-label">Produk {{$i+1}}</label>
                                <div class="col-sm">
                                    <select name="product_id[]" id="product_id[]" class="form-control ">
                                        <option selected disabled>Pilih Produk</option>
                                        @foreach ($products as $item)
                                            
                                            <option value="{{$item->id}}" {{$product_best_seller[$i]->product_id == $item->id ? 'selected':''}}>{{$item->name}}</option>
                                        @endforeach
                                      
                                    </select>
                                </div>
                            </div>
                            @endfor

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

</script>
