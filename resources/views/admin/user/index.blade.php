@extends('layouts.admin')
@section('content')

<div class="container-fluid px-4">
    <div class="container-fluid px-4">
        <h3 class="mt-4">Data User</h3>
                            <ol class="breadcrumb mb-4">
                                <li class="breadcrumb-item"><a href="dashboard.html">Dashboard</a></li>
                                <li class="breadcrumb-item active">Data User</li>
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
                        <i class="fas fa-table me-1 mt-2"></i><span>List User</span>
                    </div>
                    <div class="col-md-auto">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" disable>
                            <i class="fas fa-folder-open me-2"></i><span>Export User</span>
                        </button>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddUser">
                            <i class="fas fa-plus-square me-2"></i><span>Tambah User</span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Tabel-->
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Nama Lengkap</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama Lengkap</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($users as $user)
   
                        <tr>
                            <td>{{$user->fullname}}</td>
                            <td>{{$user->username}}</td>
                            <td>{{$user->email}}</td>
                            <td class="text-end">
                                <div class="drodown">
                                    <a data-bs-toggle="dropdown" href="#" class="btn">
                                    <i class="fa fa-bars" aria-hidden="true"></i></a>
                                    <div class="dropdown-menu dropdown-menu-start">
                                        <a href="detail-user.html" class="dropdown-item">Detail</a>
                                        <a href="#!" class="dropdown-item">Hapus</a>
                                    </div>
                                </div>                                                
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Modal Add User-->
<div class="modal fade" id="AddUser" tabindex="-1" role="dialog" aria-labelledby="modalUser" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary text-light">
          <h5 class="modal-title" id="modalUser">Tambah User</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close" aria-hidden="true"></button>
        </div>
        <!-- Modal Body-->
        <div class="modal-body">
            <form method="POST" method="#">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card mb-2">
                            <div class="card-body text-center">
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar"
                                class="rounded-circle img-fluid" type="file" style="width: 170px;">
                                <input type="file" id="inputPict" class="form-control mt-2">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="form-group">
                                <label for="inputName">Nama Lengkap</label>
                                <input type="text" id="inputName" class="form-control" placeholder="Nama Lengkap">
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="inputEmail">Email</label>
                                    <input type="email" id="inputEmail" class="form-control" placeholder="xxnx@xxx.xx">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="inputBday">Tanggal Lahir</label>
                                    <input type="date" id="inputBday" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="inputUsr">Username</label>
                                    <input type="username" id="inputUsr" class="form-control" placeholder="Username">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="inputPassword">Password</label>
                                    <input type="password" id="inputPassword" class="form-control" placeholder="Password">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="inputphone">No. Telepon</label>
                                    <input type="text" class="form-control" id="inputphone" placeholder="Telepon">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="inputRole">Role User</label>
                                    <select id="inputRole" class="form-select">
                                        <option selected>--Pilih Role--</option>
                                        <option>User</option>
                                        <option>Admin</option>
                                    </select>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group mt-1">
                            <label for="inputAddress">Address</label>
                            <textarea class="form-control" id="inputAddress" rows="7" placeholder="Alamat RT/RW"></textarea>
                        </div>
                    </div>                                                    
                    <div class="col-lg-4">
                        <div class="form-group mt-1">
                            <label for="inputState">Provinsi</label>
                            <select id="inputState" class="form-select">
                                <option selected>--Pilih Provinsi--</option>
                                <option>Jawa Timur</option>
                                <option>Jawa Tengah</option>
                                <option>Jawa Barat</option>
                                <option>Kalimantan Timur</option>
                            </select>
                        </div>
                        <div class="form-group mt-1">
                            <label for="inputCity">Kota / Kabupaten</label>
                            <select id="inputCity" class="form-select">
                                <option selected>--Pilih Kota--</option>
                                <option>Kabupaten Kepulauan Seribu</option>
                                <option>Kabupaten Sidoarjo</option>
                                <option>Kepulauan Siau Tagulandang Biaro</option>
                                <option>Kabupaten Niagara Selatan</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mt-1">
                            <label for="inputDestrict">Kecamatan</label>
                            <select id="inputDestrict" class="form-select">
                                <option selected>--Pilih Kecamatan--</option>
                                <option>Kecamatan Waru</option>
                                <option>Kecamatan Krian</option>
                                <option>Kecamatan Mojosari</option>
                                <option>Kecamatan </option>
                            </select>
                        </div>
                        <div class="form-group mt-1">
                            <label for="inputVill">Kelurahan/ Desa</label>
                            <select id="inputVill" class="form-select">
                                <option selected>--Pilih Kelurahan--</option>
                                <option>Tropodo</option>
                                <option>Sedati</option>
                                <option>Damarsi</option>
                                <option>Tunggal Pager</option>
                            </select>
                        </div>
                        <div class="form-group mt-1">
                            <label for="inputPos">Kode Pos</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="inputPos" placeholder="65332" disabled>
                            </div>
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
<!--End Modal add User-->

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