@extends('layouts.admin')
@section('content')

<main>
    <div class="container-fluid px-4">
        <div class="container-fluid px-4">
            <div class="row">
                <div class="col mt-4">
                    <h3>Buat Pesanan</h3>
                </div>
                <div class="col text-end mt-4">
                    <a href="daftar-pesanan.html" type="button" class="btn bg-success text-light"><i class="fas fa-reply me-1"></i>Ke Daftar Pesanan</a>
                </div>
            </div>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="dashboard.html">Dashboard</a></li>
                <li class="breadcrumb-item active">Buat Pesanan</li>
            </ol>
            <div class="card mb-2">
                <div class="card-header">
                    <div class="row">
                        <div class="col mb-2">
                            <i class="fas fa-table me-1 mt-2"></i><span>Pesanan</span>
                        </div>
                    </div>
                    <form action="" method="">
                        <div class="card card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="row">
                                        <label for="OrderNo" class="col-sm-3 col-form-label">No. Order</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="OrderNo" value="20231100003" disabled>
                                        </div>
                                        <label for="OrderDate" class="col-sm-3 col-form-label">Tanggal</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control" id="OrderDate" value="2023-11-28">
                                        </div>
                                        <label for="CustOrder" class="col-sm-3 col-form-label">Customer</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" list="datalistCustomer" id="exampleDataList" placeholder="Pilih Customer">
                                            <datalist id="datalistCustomer">
                                                <option value="Customer 1">
                                                <option value="Customer 2">
                                                <option value="Customer 3">
                                                <option value="Customer 4">
                                                <option value="Customer 5">
                                            </datalist>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mt-2">
                                        <textarea class="form-control" id="CustAddOrder" rows="4" placeholder="Alamat" value="Alamat RT/RW" disabled></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="table-responsive">
                                        <table class="table" id="myTable">
                                            <thead>
                                                <tr>
                                                    <th class="col col-1 text-center">No</th>
                                                    <th class="col col-4 text-center" style="min-width: 200px;">Item</th>
                                                    <th class="col col-3 text-center" style="min-width: 100px;">Varian</th>
                                                    <th class="col col-1 text-center">Qty (Pcs)</th>
                                                    <th class="col col-sm-2 text-center">Harga (Rp)</th>
                                                    <th class="col col-sm-auto text-center">Diskon</th>
                                                    <th class="col col-sm-auto text-center">Hapus</th>
                                                </tr>
                                            </thead>
                                            
                                            <!--Add row table-->    
                                            <tbody id="newData"></tbody>
                                            <!--End Add row table-->
                                        </table>
                                    </div>
                                    <div class="row justify-content-center mb-3">
                                        <div class="col col-2">
                                            <a onclick="addData()" class="btn btn-danger" id="addData"><i class="fas fa-plus"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>  
                        <div class="card bg-light">
                            <div class="row mt-2 mb-2">
                                <div class="col-lg-6 mb-2">
                                    <div class="row">
                                        <div class="col text-center mt-2">
                                            <span class="text text-center">Total Pembelian</span>
                                        </div>
                                        <div class="col text-end mt-2 me-2">
                                            <span class="text fw-bold">Rp. 258.000</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col text-center mt-2">
                                            <span class="text text-center">Total Bayar</span>
                                        </div>
                                        <div class="col text-end me-2">
                                            <input type="number" id="Payment" min="0" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-header mt-2">
                            <div class="row text-end">
                                <div class="col">
                                    <button class="btn btn-secondary" href="master-produk.html" style="width: 100px;">Batal</button>
                                    <button class="btn btn-primary" href="#" style="width: 100px;">Simpan</button>
                                </div>   
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<script type="text/javascript">

    //add row data    
    function addData(){
        var html = '';
        html += '<tr id="inputFormData">';
        html += '<td class="col" style="width: 30px;">';
        html += '<div class="text text-center mt-2">';
        html += '<span class="text text-secondary">1</span>';
        html += '</div>';
        html += '</td>';
        html += '<td class="col col-4" style="min-width: 200px;">';
        html += '<input class="form-control" list="datalistProduct" id="exampleDataList2" placeholder="Pilih Produk">';
        html += '<datalist id="datalistProduct">';
        html += '<option value="Produk 1">';
        html += '<option value="Produk 2">';
        html += '<option value="Produk 3">';
        html += '<option value="Produk 4">';
        html += '</datalist';
        html += '</td>';
        html += '<td class="col col-2">';
        html += '<input class="form-control" list="datalistVariant" id="exampleDataList3" placeholder="Pilih Varian">';
        html += '<datalist id="datalistVariant">';
        html += '<option value="Variant 1">';
        html += '<option value="Variant 2">';
        html += '</datalist>';
        html += '</td>';
        html += '<td class="col col-1 text-center" style="min-width: 70px;">';
        html += '<input type="number" min="0" class="form-control" id="OrderQty"/>';
        html += '</td>';
        html += '<td class="col col-sm-2 text-center" style="min-width: 100px;">';
        html += '<input type="number" min="0" class="form-control" id="OrderPrice"/>';
        html += '</td>';
        html += '<td class="col col-sm-auto text-center">';
        html += '<input type="number" min="0" class="form-control" id="OrderDisc"/>';                                                        
        html += '</td>';
        html += '<td class="col col-sm-auto text-center">';
        html += '<div class="justify-content-center">';
        html += '<a onclick="removeData()" id="removeData" class="btn">';
        html += '<span class="text text-danger"><i class="fas fa-close"></i></span>';
        html += '</a>';
        html += '</div>'; 
        html += '</td>';
        html += '</tr>';
        $('#newData').append(html);
    }
    // remove row
    function removeData(){
        $(document).on('click', '#removeData', function () {
            $(this).closest('#inputFormData').remove();
        });
    }



    //Select Product
    // $(function() {
    //     $("#selectProduct").customselect();
    // });
                                                   
    </script>

@endsection
