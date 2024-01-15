@extends('layouts.admin')
@section('content')
<div class="container-fluid px-4">
    <div class="container-fluid px-4">
            <div class="row">
                <div class="col mt-4">
                    <h3>Detail User</h3>
                </div>
                <div class="col text-end mt-4">
                    <a href="master-user.html" type="button" class="btn bg-success text-light"><i class="fas fa-reply me-1"></i>Kembali</a>
                </div>
            </div>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="dashboard.html">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="master-customer.html">User</a></li>
            <li class="breadcrumb-item active">Detail User</li>
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
                        <i class="fas fa-table me-1 mt-2"></i><span>Detail User</span>                                            
                    </div>
                    <div class="col-md-auto">
                        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#editUser">
                            <i class="fas fa-edit me-"></i>
                        </button>
                    </div>
                </div>

                <!-- Detail kontent-->
                <form method="POST" action="">
                    <div class="row mt-2">
                        <div class="col-lg-4">
                        <div class="card mb-4">
                            <div class="card-body text-center">
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar"
                                    class="rounded-circle img-fluid" style="width: 160px;">
                                    <h5 class="my-3">{{$user->fullname}}</h5>
                                    <button type="button" class="btn" style="background-color: rgb(212, 212, 212);" data-toggle="modal" data-target="#uploadPict">Ubah Gambar</button>
                            </div>
                        </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="inputName">Nama Lengkap</label>
                                        <input type="text" id="inputName" class="form-control" value="{{$user->fullname}}" name="fullname" readonly>
                                    </div>
                                    <div class="col">
                                        <div class="form-group mt-1">
                                            <label for="inputEmail">Email</label>
                                            <input type="email" id="inputEmail" class="form-control" value="{{$user->email}}" readonly>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group mt-1">
                                            <label for="inputPassword">Password</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" id="inputPassword" value="{{12313123}}" disabled>
                                                <button class="btn btn-success" type="button" id="btnUbhPassword" data-toggle="modal" data-target="#UbahPassword">Ubah Password</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group mt-1">
                                                <label for="inputBday">Tanggal Lahir</label>
                                                <input type="date" name="birth_date" id="inputBday" class="form-control" value="{{$user->birth_date}}" readonly>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group mt-1">
                                                <label for="inputphone">No Tlp</label>
                                                <input type="text" id="inputphone" class="form-control" value="{{$user->phone_number}}" readonly>
                                            </div>
                                        </div>
                                    </div>                                                
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!--End Detail Kontent-->
            </div>    
        </div>
        
        <!--Detail Alamat-->
        <div class="card mb-4">
            <div class="card-body" style="background-color: rgb(250, 249, 249);">
                <div class="row">
                    <div class="col">
                        <i class="fas fa-table me-1 mt-2"></i><span>Data Alamat User</span>                                            
                    </div>
                    <div class="col-md-auto">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddAddress">
                            <i class="fas fa-plus-square me-2"></i><span>Tambah Alamat</span>
                        </button>
                    </div>                                       
                </div>
                @foreach ($address as $value)  
                    <div class="card mt-2 p-2">
                        <div class="row ms-md-1">
                            <div class="col">
                                <span class="text text-secondary fw-bold" >Rumah</span>
                                <span class="text text-dark m-2 fw-bold">|</span>
                                <span class="text text-light px-2" style="background-color: rgb(105, 105, 103);">Utama</span>
                            </div>
                        </div>
                        <div class="row ms-md-1">
                            <div class="col">
                                <span class="text text-dark fw-bold" >{{$value->fullname}}</span> 
                            </div>
                        </div>
                        <div class="row ms-md-1">
                            <div class="col">
                                <span class="text text-dark" >{{$value->phone_number}}</span> 
                            </div>
                        </div>
                        <div class="row ms-md-1">
                            <div class="col">
                                <span class="text text-dark" >{{$value->address}}</span> 
                            </div>
                        </div>
                        <div class="row ms-md-1">
                            <form method="POST" action="{{route('address.destroy',$value->id)}}">
                            <div class="col">
                                <a href="#" class="link-success link-underline-opacity-0" data-toggle="modal" data-target="#editAddress"><span class="text fw-bold">Ubah</span></a>
                                <span class="text text-success m-2 fw-bold">|</span>
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button style="padding: 0;border: none;background: none;" class="link-success link-underline-opacity-0" type="submit" onclick="confirm('Apakah Anda Yakin ingin menghapus data ini?')"><span class="text fw-bold">Hapus</span></button>
                                    {{-- <a href="#" class="link-success link-underline-opacity-0" data-toggle="modal" data-target="#delAddress"><span class="text fw-bold">Hapus</span></a> --}}
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach                                      
            </div>                               
        </div>
        <!--End Detail Alamat-->
    </div>
</div>

<!--Modal Edit User-->
<div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="modalUser" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary text-light">
          <h5 class="modal-title" id="modalUser">Edit User</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close" aria-hidden="true"></button>
        </div>
        <!-- Modal Body-->
        <form method="POST" action="{{route('user.update',$user->id)}}">
            {{ csrf_field() }}
            @method('PUT')
        <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <div class="row">
                            <div class="form-group">
                                <label for="inputName">Nama Lengkap</label>
                                <input type="text" id="inputName" class="form-control" value="{{$user->fullname}}" name="fullname">
                            </div>
                            <div class="form-group">
                                <div class="form-group mt-1">
                                    <label for="inputUser">Username</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="addon-wrapping">@</span>
                                        <input type="username" class="form-control" id="inputUser" value="{{$user->username}}" name="username">
                                        <button class="btn btn-success" type="button" id="btnCekUser">Cek Username</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="inputEmail">Email</label>
                                    <input type="email" id="inputEmail" class="form-control" value="{{$user->email}}" name="email">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="inputBday">Tanggal Lahir</label>
                                    <input type="date" id="inputBday" class="form-control" value="{{$user->birth_date}}" name="birth_date">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="inputphone">No. Telepon</label>
                                    <input type="text" class="form-control" id="inputphone" value="{{$user->phone_number}}" name="phone_number">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="inputRole">Role User</label>
                                    <select id="inputRole" class="form-select" name="roles_id">
                                        <option value="2" {{$user->roles_id == 2 ?'selected' : ''}}>User</option>
                                        <option value="1" {{$user->roles_id == 1 ?'selected' : ''}}>Admin</option>
                                    </select>
                              </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="cekboxActive" checked>
                                    <label class="form-check-label" for="cekboxActive">Aktif</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                                                                                                      
           
        </div>
        <!--Modal Footer-->
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
            <button type="submit" class="btn btn-danger">Simpan</button>
        </div>
    </form>
      </div>
    </div>
  </div>
<!--End Modal Edit User-->

<!--Modal Ubah Password-->
<div class="modal fade" id="UbahPassword" tabindex="-1" role="dialog" aria-labelledby="modalUser" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary text-light">
          <h5 class="modal-title" id="modalUser">Ubah Password</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close" aria-hidden="true"></button>
        </div>
        <!-- Modal Body-->
        <div class="modal-body">
            <form method="POST" method="#">
                <div class="row">
                    <div class="col">
                        <div class="row">
                            <div class="form-group">
                                <label for="inputPassOld">Password Lama</label>
                                <input type="password" id="inputPassOld" class="form-control"">
                            </div>
                            <div class="form-group">
                                <label for="inputPassNew">Password Baru</label>
                                <input type="password" id="inputPassNew" class="form-control"">
                            </div>
                            <div class="form-group">
                                <label for="inputPassNewRe">Input Ulang Password Baru</label>
                                <input type="text" id="inputPassNewRe" class="form-control">
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
<!--End Modal Ubah Password-->

<!--Modal Tambah Alamat-->
<div class="modal fade" id="AddAddress" tabindex="-1" role="dialog" aria-labelledby="modalUser" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary text-light">
          <h5 class="modal-title" id="modalUser">Tambah Alamat</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close" aria-hidden="true"></button>
        </div>
        <!-- Modal Body-->
        <form method="POST" action="{{route('address.store')}}" >
        <div class="modal-body">
                <input type="hidden" id="inputRecName" class="form-control" name="users_id" value="{{$user->id}}">
                <div class="row">
                    <div class="col-lg">
                        <div class="form-group mt-1">
                            <label for="inputLabel">Label Alamat</label>
                            <input type="text" id="inputLabel" class="form-control" placeholder="Rumah / Kantor / Toko" name="label" required>
                        </div>
                    </div>
                    <div class="col-lg p-4">
                        <div class="form-check form-switch">
                            <label class="form-check-label" for="cekboxDefaultAdd">Gunakan Sebagai Alamat Utama</label>
                            <input class="form-check-input" type="checkbox" role="switch" id="cekboxDefaultAdd" name="is_primary">
                        </div>
                    </div>      
                </div>
                <div class="row">                                              
                    <div class="col-lg">
                        <div class="form-group">
                            <label for="inputRecName">Nama Penerima</label>
                            <input type="text" id="inputRecName" class="form-control" placeholder="Nama Penerima" name="fullname">
                        </div>
                    </div>
                    <div class="col-lg">
                        <div class="form-group">
                            <label for="inputRecNoTlp">No Telepon</label>
                            <input type="text" id="inputRecNoTlp" class="form-control" placeholder="08xxxxxxxxxx" name="phone_number">
                        </div>
                    </div>                                                                                                             
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group mt-1">
                            <label for="inputAddress">Address</label>
                            <textarea class="form-control" id="inputAddress" rows="7" placeholder="Alamat RT/RW" name="address"></textarea>
                        </div>
                    </div>      
                </div>
                <div class="row">                                              
                    <div class="col-lg">
                        <div class="form-group mt-1">
                            <label for="inputState">Provinsi</label>
                            <select id="inputState" class="form-select" name="provinces_id" required>
                                <option selected>--Pilih Provinsi--</option>
                                @foreach ($provinces as $province)
                                <option value="{{$province->id}}">{{$province->name}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group mt-1">
                            <label for="inputCity">Kota / Kabupaten</label>
                            <select id="inputCity" class="form-select" name="cities_id" required>
                                <option selected>--Pilih Kota--</option>
                                @foreach ($cities as $city)
                                    <option value="{{$city->id}}">{{$city->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg">
                        <div class="form-group mt-1">
                            <label for="inputDestrict">Kecamatan</label>
                            <select id="inputDestrict" class="form-select" name="districts_id" required>
                                <option selected>--Pilih Kecamatan--</option>
                                @foreach ($districts as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                                
                            </select>
                        </div>
                        <div class="form-group mt-1">
                            <label for="inputVill">Kelurahan/ Desa</label>
                            <select id="inputVill" name="villages_id" class="form-select" required>
                                <option selected>--Pilih Kelurahan--</option>
                                <option value="1">Tropodo</option>
                                <option value="2">Sedati</option>
                                <option value="3">Damarsi</option>
                                <option value="4">Tunggal Pager</option>
                            </select>
                        </div>
                        <div class="form-group mt-1">
                            <label for="inputPos">Kode Pos</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="inputPos" placeholder="65332" required name="postal_code">
                            </div>
                        </div>
                    </div>                                                                                                                
                </div>                                                                                                        
            
        </div>
        <!--Modal Footer-->
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
            <button type="submit" class="btn btn-danger">Simpan</button>
        </div>
    </form>
      </div>
    </div>
</div>
<!--End Modal Tambah Alamat-->


<!--Modal ubah alamat-->
<div class="modal fade" id="editAddress" tabindex="-1" role="dialog" aria-labelledby="modalUser" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary text-light">
          <h5 class="modal-title" id="modalUser">Edit Alamat</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close" aria-hidden="true"></button>
        </div>
        <!-- Modal Body-->
        <form method="POST" action="{{url('/address')}}">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg">
                        <div class="form-group mt-1">
                            <label for="inputLabel">Label Alamat</label>
                            <input type="text" id="inputLabel" class="form-control" value="Rumah">
                        </div>
                    </div>
                    <div class="col-lg p-4">
                        <div class="form-check form-switch">
                            <label class="form-check-label" for="cekboxDefaultAdd">Gunakan Sebagai Alamat Utama</label>
                            <input class="form-check-input" type="checkbox" role="switch" id="cekboxDefaultAdd">
                        </div>
                    </div>      
                </div>
                <div class="row">                                              
                    <div class="col-lg">
                        <div class="form-group">
                            <label for="inputRecName">Nama Penerima</label>
                            <input type="text" id="inputRecName" class="form-control" value="Paijo">
                        </div>
                    </div>
                    <div class="col-lg">
                        <div class="form-group">
                            <label for="inputRecNoTlp">No Telepon</label>
                            <input type="text" id="inputRecNoTlp" class="form-control" value="089877665444">
                        </div>
                    </div>                                                                                                             
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group mt-1">
                            <label for="inputAddress">Address</label>
                            <textarea class="form-control" id="inputAddress" rows="7" value="">Jl Raya Pahlawan RT 03 RW 04</textarea>
                        </div>
                    </div>      
                </div>
                <div class="row">                                              
                    <div class="col-lg">
                        <div class="form-group mt-1">
                            <label for="inputState">Provinsi</label>
                            <select id="inputState" class="form-select">
                                <option selected>Jawa Timur</option>
                                <option>Jawa Tengah</option>
                                <option>Jawa Barat</option>
                                <option>Kalimantan Timur</option>
                            </select>
                        </div>
                        <div class="form-group mt-1">
                            <label for="inputCity">Kota / Kabupaten</label>
                            <select id="inputCity" class="form-select">
                                <option selected>Kabupaten Sidoarjo</option>
                                <option>Kabupaten Kepulauan Seribu</option>
                                <option>Kepulauan Siau Tagulandang Biaro</option>
                                <option>Kabupaten Niagara Selatan</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg">
                        <div class="form-group mt-1">
                            <label for="inputDestrict">Kecamatan</label>
                            <select id="inputDestrict" class="form-select">
                                <option selected>Kecamatan Waru--</option>
                                <option>Kecamatan Krian</option>
                                <option>Kecamatan Mojosari</option>
                                <option>Kecamatan </option>
                            </select>
                        </div>
                        <div class="form-group mt-1">
                            <label for="inputVill">Kelurahan/ Desa</label>
                            <select id="inputVill" class="form-select">
                                <option selected>Tropodo</option>
                                <option>Sedati</option>
                                <option>Damarsi</option>
                                <option>Tunggal Pager</option>
                            </select>
                        </div>
                        <div class="form-group mt-1">
                            <label for="inputPos">Kode Pos</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="inputPos" value="65332" disabled>
                            </div>
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
<!--End Modal ubah alamat-->

<!--Modal Konfirmasi hapus alamat-->
<div class="modal fade" id="delAddress" tabindex="-1" role="dialog" aria-labelledby="modalUser" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <!-- Modal Body-->
        <div class="modal-body">
            <p>Apakah Anda Yakin Menghapus Alamat ini ?</p>
        </div>
        <!--Modal Footer-->
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
            <button type="button" class="btn btn-danger ms-md-2">Ya</button>
        </div>
      </div>
    </div>
  </div>
<!--End Modal Konfirmasi hapus alamat-->

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
