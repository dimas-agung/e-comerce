@extends('layouts.admin')
@section('content')
<div class="container-fluid px-4">
    <div class="container-fluid px-4">
        <h3 class="mt-4">Data Produk</h3>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Master Produk</li>
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
                        <i class="fas fa-table me-1 mt-2"></i><span>Produk List</span>
                    </div>
                    <div class="col-md-auto">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" disable>
                            <i class="fas fa-folder-open me-2"></i><span>Export Produk</span>
                        </button>
                        <a href="{{route('product.create')}}" type="button" class="btn btn-primary">
                            <i class="fas fa-plus-square me-2"></i><span>Tambah Produk</span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Tabel-->
            <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <input type="text" id="myInput" class="form-control" onkeyup="myFunction()" placeholder="Cari Produk" title="Type in a name">
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th><span class="text text-center text-secondary">Info Produk</span></th>
                                    <th class="text-center">Statistik</th>
                                    <th class="text-center">Harga</th>
                                    <th class="text-center">Stok</th>
                                    <th class="text-center">Aktif</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <!--Contoh data table-->
                                @foreach ($products as $product)
                                    
                                <tr>
                                    <td class="col col-8" style="min-width: 400px;">
                                        <a href="#Variant1" class="link" style="text-decoration: none;" data-toggle="modal" data-bs-target="#Variant1" role="dialog" aria-expanded="false" onclick="lihatVarian('{{$product->id}}','{{$product->name}}')">
                                            <div class="content">
                                                <div class="card me-2" style="width: 80px;float: left;">
                                                    <img src="{{ asset('storage/'.$product->picture_default) }}" alt="" title=""  alt="Cinque Terre" class="img-thumbnail rounded-2" style="width: 80px; height:80px;">
                                                </div>
                                                <div class="content ms-4 mb-4">
                                                    <span class="text text-secondary fw-bold">{{$product->name}}</span>
                                                    <p><span class="text">Lihat varian</span></p>
                                                </div>
                                            </div>
                                        </a>
                                    </td>
                                    <td class="col col-1">
                                        <div class="justify-content-center">
                                            <p class="text text-secondary"><i class="fas fa-shopping-bag me-2" style="color: rgb(117, 115, 115);"></i>0</p>
                                            <p class="text text-secondary"><i class="fas fa-cart-shopping me-2" style="color: rgb(117, 115, 115);"></i>0</p>
                                        </div>
                                    </td>
                                    <td class="col col-4 text-center">
                                        <div class="justify-content-center">
                                            <a href="#Variant1" class="link" style="text-decoration: none;" data-toggle="modal" data-bs-target="#Variant1" role="dialog" aria-expanded="false" onclick="lihatVarian('{{$product->id}}','{{$product->name}}')">
                                                <span class="text text-primary">{{ $product->product_varian->min('price') }} - {{$product->product_varian->max('price')}}</span>
                                            </a>
                                        </div>
                                        
                                    </td>
                                    <td class="col col-sm-1 text-center">
                                        <div class="justify-content-center">
                                            <a href="#Variant1" class="link" style="text-decoration: none;" data-toggle="modal" data-bs-target="#Variant1" role="dialog" aria-expanded="false" onclick="lihatVarian('{{$product->id}}','{{$product->name}}')">
                                                <span class="text text-primary">{{$product->product_varian->sum('stock')}}</span>
                                            </a>
                                        </div>
                                    </td>
                                    <td class="col col-sm-auto text-center">
                                        <div class="justify-content-center">
                                            <a href="#Variant1" class="link" style="text-decoration: none;" data-toggle="modal" data-bs-target="#Variant1" role="dialog" aria-expanded="false" onclick="lihatVarian('{{$product->id}}','{{$product->name}}')">
                                                <span class="text"><i class="fas fa-sliders"></i></span>
                                            </a> 
                                        </div>                                                           
                                    </td>
                                    <td class="col col-sm-2 text-center">
                                        <div class="justify-content-center">
                                            <a href="{{route('product.edit',$product->id)}}">
                                                <span class="text text-danger"><i class="fas fa-pencil"></i></span>
                                            </a> 
                                        </div>  
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <script>
                            function myFunction() {
                            var input, filter, table, tr, td, i, txtValue;
                            input = document.getElementById("myInput");
                            filter = input.value.toUpperCase();
                            table = document.getElementById("myTable");
                            tr = table.getElementsByTagName("tr");
                            for (i = 0; i < tr.length; i++) {
                                td = tr[i].getElementsByTagName("td")[0];
                                if (td) {
                                txtValue = td.textContent || td.innerText;
                                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                    tr[i].style.display = "";
                                } else {
                                    tr[i].style.display = "none";
                                }
                                }       
                            }
                            }
                        </script>
                    </div>
            </div>

            <!--Modal Lihat Variant All-->
            <div class="modal fade" id="modalVarian" tabindex="-1" role="dialog" aria-labelledby="modalVarian" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-light">
                    <h5 class="modal-title" id="modalUser">Detail Variant</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" aria-hidden="true"></button>
                    </div>
                    <!-- Modal Body-->
                    <form method="POST" action="{{route('product_varian.update_batch')}}">
                        <div class="modal-body">
                            <div class="col">
                                <div class="card card-header">
                                    <input type="hidden" name="product_id">
                                    <div class="fw-bold" style="color: rgb(104, 100, 100);">
                                        <span class="title" id="span_product"></span>
                                    </div>
                                </div>
                                
                                <div class="">
                                    <div class="card card-body">
                                        <table class="table" id="tableProductVarian">
                                            <thead class="text-center">
                                                <th class="col col-sm-4 text-start"><span>Varian</span></th>
                                                <th class="col col-sm text-start"><span>Harga</span></th>
                                                <th class="col col-sm-2 text-start"><span>Stok</span></th>
                                                <th class="col col-sm text-start"><span>Aktif</span></th>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>                                                                                                     
                        </div>
                        <!--Modal Footer-->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                            <button type="submit" class="btn btn-danger">Simpan</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function lihatVarian(id,name) {
    // alert(name)
    $('#span_product').html(name)
    $('#product_id').val(id)
    $.ajax({
        url: `{{route('product_varian.index')}}`,
        method:"GET",  
        data:{
            "_token": "{{ csrf_token() }}",
            products_id : id,
            // qty: qty
        },                              
        success: function( data ) {
            // console.log(data);
            $('#tableProductVarian tbody').html('')
            data.forEach(value => {
                // console.log(value.varian_detail2.name);
                let nama_varian = '';
                nama_varian += value.varian_detail1.name
                if (value.varian_detail_id_2) {
                    console.log(123);
                    nama_varian +=  ', '+ value.varian_detail2.name
                }
                
                $('#tableProductVarian tbody').append(`
                    <tr>
                        <td><span>${nama_varian}</span></td>
                        <td>
                            <div class="input-group">
                                <span class="input-group-text">Rp.</span>
                                <input type="hidden" class="form-control"  name="id[]" value="${value.id}">
                                <input class="form-group text-center form-control" type="number" id="inputStok" min="0" name="price[]" value="${value.price}">
                            </div>
                        </td>
                        <td>
                            <input type="number" class="form-control" min="0" aria-label="Amount" name="stock[]" value="${value.stock}">
                        </td>
                        <td class="fixed">
                            <div class="center">
                                <div class="form-check form-switch align-items-center mt-2">
                                    <input type="hidden" class="form-control" aria-label="Amount" id="is_active-${value.id}" name="is_active[]" value="${value.is_active}">
                                    <input class="form-check-input" type="checkbox" role="switch" id="checkActive-${value.id}" ${value.is_active ==1? 'checked' : ''} onclick="updateStatusActiveVarian('${value.id}')">
                                </div>
                            </div>
                        </td>
                    </tr>`
                );
            });
            
        }
    });
    // alert(id);
    $('#modalVarian').modal('show');
}
function updateStatusActiveVarian(id) {
    $('#is_active-'+id).val()
    var $checkbox = $('#checkActive-'+id);
    if ($checkbox.prop('checked')) {
        $('#is_active-'+id).val(1)
    }else{
        $('#is_active-'+id).val(0)
    }
}
</script>
@endsection
