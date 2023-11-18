@extends('layouts.admin')
@section('content')

<div class="container-fluid px-4">
    <div class="container-fluid px-4">
        <h3 class="mt-4">Master Kategori Produk</h3>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Data Kategori Produk</li>
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
                        <i class="fas fa-table me-1 mt-2"></i><span>List Kategori Produk</span>
                    </div>
                    <div class="col-md-auto">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" disable>
                            <i class="fas fa-folder-open me-2"></i><span>Export Kategori</span>
                        </button>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAddCatProduct">
                            <i class="fas fa-plus-square me-2"></i><span>Tambah Kategori</span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Tabel-->
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th class="">Nama Kategori Produk</th>
                            <th>Keterangan</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama Kategori Produk</th>
                            <th>Keterangan</th>
                            <th>Edit</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($productCategory as $value)
   
                        <tr>
                            <td>{{$value->name}}</td>
                            <td><span></span></td>
                            <td class="text-end">
                                <a href="#" class="btn" data-toggle="modal" onclick="modalEdit('{{$value->id}}','{{$value->name}}')">
                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                </a>                                                  
                                {{-- <a href="#" class="btn" data-toggle="modal" data-target="#modalEditCatProduct">
                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                </a>                                                   --}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
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
        <form method="POST" action="{{ route('product_category.store')}}">
            <div class="modal-body">
                <div class="col">
                    <div class="form-group">
                        <div class="form-floating mb-3 text-secondary">
                            <input class="form-control" type="text" id="name" name="name" placeholder="Nama Kategori Produk"> 
                            <label for="nameCatProduct">Nama Kategori Produk</label>
                        </div>                                    
                    </div>
                </div>                                                                                                      
            </div>
            <!--Modal Footer-->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                <button type="button" class="btn btn-danger">Simpan</button>
            </div>
        </form>
    </div>
    </div>
</div>
<!--End Modal add kategory-->

<!--Modal Edit kategory-->
<div class="modal fade" id="modalEditCatProduct" tabindex="-1" role="dialog" aria-labelledby="modalAddCatProduct" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header bg-primary text-light">
        <h5 class="modal-title" id="modalAddCatProduct">Edit Kategori Produk</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close" aria-hidden="true"></button>
        </div>
        <!-- Modal Body-->
        <div class="modal-body">
            {{-- <form method="POST" method="#"> --}}
                <div class="col">
                    <div class="form-group">
                        <div class="form-floating mb-3 text-secondary">
                            <input class="form-control" type="hidden" name="id" id="id_edit" placeholder="Nama Kategori Produk" value=""> 
                            <input class="form-control" type="text" name="name" id="name_edit" placeholder="Nama Kategori Produk" value=""> 
                            <label for="name_edit">Nama Kategori Produk</label>
                        </div>                                    
                    </div>
                </div>                                                                                                      
            {{-- </form> --}}
        </div>
        <!--Modal Footer-->
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
            <button type="button" class="btn btn-danger" onclick="update()">Simpan</button>
        </div>
    </div>
    </div>
</div>
<script>
function modalEdit(id,name) {
    // alert(name)
    $('#name_edit').val(name)
    $('#id_edit').val(id)
    
    // alert(id);
    $('#modalEditCatProduct').modal('show');
}
function update() {
    // alert(name)
    let name = $('#name_edit').val()
    let id = $('#id_edit').val()
    let token   = $("meta[name='csrf-token']").attr("content")
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: `/product_category/${id}`,
        method:"PUT",  
        data:{
            "_token": "{{ csrf_token() }}",
            name : name,
            // qty: qty
        },                              
        success: function( data ) {
            // console.log(data);
            
        }
    });
    location.reload()
    $('#modalEditCatProduct').modal('hide');
}
    
</script>
<!--End Modal edit kategory-->
@endsection
