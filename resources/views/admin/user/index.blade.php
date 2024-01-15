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
                                        <a href="{{url('user/'.$user->id.'/edit')}}" class="dropdown-item">Detail</a>
                                        <form method="POST" action="{{route('user.destroy',$user->id)}}">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button class="dropdown-item" type="submit" onclick="confirm('Apakah Anda Yakin ingin menghapus data ini?')">Hapus</button>
                                        </form>
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
        <form method="POST" action="{{ route('user.store')}}">
        <div class="modal-body">
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
                                <input type="text" id="inputName" class="form-control" placeholder="Nama Lengkap" id="fullname" name="fullname">
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="inputEmail">Email</label>
                                    <input type="email" id="email" name="email" class="form-control" placeholder="xxnx@xxx.xx">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="inputBday">Tanggal Lahir</label>
                                    <input type="date" id="inputBday" class="form-control" name="birth_date">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="inputUsr">Username</label>
                                    <input type="username" id="inputUsr" class="form-control" placeholder="Username" name="username">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="inputPassword">Password</label>
                                    <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="inputphone">No. Telepon</label>
                                    <input type="text" class="form-control" id="inputphone" placeholder="Telepon" name="phone_number">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="inputRole">Role User</label>
                                    <select id="inputRole" name="roles_id" class="form-select">
                                        <option selected>--Pilih Role--</option>
                                        <option value="2">User</option>
                                        <option value="1">Admin</option>
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
                            <textarea class="form-control" id="inputAddress" rows="7" placeholder="Alamat RT/RW" name="address"></textarea>
                        </div>
                    </div>                                                    
                    <div class="col-lg-4">
                        <div class="form-group mt-1">
                            <label for="inputState">Provinsi</label>
                            <select id="inputState" class="form-select" name="provinces_id">
                                <option selected>--Pilih Provinsi--</option>
                                @foreach ($provinces as $province)
                                    <option value="{{$province->id}}">{{$province->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mt-1">
                            <label for="inputCity">Kota / Kabupaten</label>
                            <select id="inputCity" name="cities_id" class="form-select" required>
                                <option selected>--Pilih Kota--</option>
                                @foreach ($cities as $city)
                                    <option value="{{$city->id}}">{{$city->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mt-1">
                            <label for="inputDistrict" >Kecamatan</label>
                            <select id="inputDistrict" class="form-control" placeholder="Pilih Kecamatan" name="districts_id" required>
                                <option value="" disabled selected>Pilih Kecamatan</option>
                                @foreach ($district as $districts)
                                    <option value="{{$districts->id}}">{{$districts->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mt-1">
                            <label for="inputVill">Kelurahan/ Desa</label>
                            {{-- <input type="text" class="form-control" id="inputVill" placeholder="Kelurahan" name="villages_id" required> --}}
                            <select id="inputDistrict" class="form-control" placeholder="Pilih Desa" name="villages_id" required>
                                <option value="" disabled selected>Pilih Desa</option>
                                @foreach ($villages as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="form-group mt-1">
                            <label for="inputPos">Kode Pos</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="inputPos" placeholder="" required>
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
        </div>
        </form>
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
