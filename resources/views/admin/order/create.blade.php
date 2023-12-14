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
                                            <select name="users_id" id="users_id" class="form-control select2" placeholder='Pilih Customer' onchange="getAddress()">
                                                <option value="" disabled selected>Pilih Customer</option>
                                                @foreach ($customers as $customer)
                                                <option value="{{$customer->id}}">{{$customer->fullname}}</option>
                                             
                                                @endforeach
                                            </select>
                                          
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mt-2">
                                        <textarea class="form-control" id="address" rows="4" placeholder="Alamat" name="address" readonly></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="table-responsive">
                                        <table class="table" id="myTable" style="min-width: 700px;">
                                            <thead>
                                                <tr>
                                                    <th class="col col-1 text-center">No</th>
                                                    <th class="col col-4 text-center" style="min-width: 200px;">Item</th>
                                                    <th class="col col-3 text-center" style="min-width: 100px;">Varian</th>
                                                    <th class="col col-1 text-center">Qty (Pcs)</th>
                                                    <th class="col col-sm-2 text-center">Harga (Rp)</th>
                                                    <th class="col col-sm-2 text-center">Diskon</th>
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
                                            <span class="text fw-bold" id="span-total-pembelian">Rp 0</span>
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
        var rowCount = $('#myTable tr').length;
        var products = @json($products);
        var html = '';
        html += '<tr id="inputFormData">';
        html += '<td class="col" style="width: 30px;">';
        html += '<div class="text text-center mt-2">';
        html += `<span class="text text-secondary">${rowCount}</span>`;
        html += '</div>';
        html += '</td>';
        html += '<td class="col col-4" style="min-width: 200px;">';
        html += `<select name="product_ids[]" id="product_ids[]" class="form-control select2 slc_product" onchange="getVarian(this,${rowCount})">`;
        
        html += `<option value="" disabled selected>Pilih Produk</option>`;
        
        products.forEach(val => {
            html += `<option value="${val.id}">${val.name}</option>`;
        });
        html += '</select>';
        html += '</td>';
        html += '<td class="col col-2">';
        html += `<select name="product_varians[]" id="product_varian_${rowCount}" class="form-control select2 " onchange="getPrice(this,${rowCount})">`;
        
        html += `<option value="" disabled selected>Pilih Varian</option>`;
        html += '</select>';
        html += '</td>';
        html += '<td class="col col-1 text-center" style="min-width: 100px;">';
        html += `<input type="hidden" min="0" class="form-control" id="stock_${rowCount}" name="stock[]" readonly/>`;
        html += `<input type="number" min="0" value="0" class="form-control" id="qty_${rowCount}" name="qty[]"  onkeyup="checkStock(this,${rowCount})" />`;
        html += '</td>';
        html += '<td class="col col-sm-2 text-center" style="min-width: 80px;">';
        html += `<input type="number" min="0" class="form-control" id="price_${rowCount}" name="price[]" readonly/ >`;
        html += '</td>';
        html += '<td class="col col-sm-auto text-center" style="min-width: 100px;">';
        html += '<input type="number" min="0" class="form-control" id="discount[]" value="0" name="discount[]" onkeyup="calculateTotalPembelian()"/>';                                                        
        html += '</td>';
        html += '<td class="col col-sm-auto text-center">';
        html += '<div class="justify-content-center">';
        html += '<a onclick="removeData()" id="removeData" class="btn">';
        html += '<span class="text text-danger"><i class="fas fa-close"></i></span>';
        html += '</a>';
        html += '</div>'; 
        html += '</td>';
        html += '</tr>';
        $('#myTable tbody').append(html);
    }
    // remove row
    function removeData(){
        $(document).on('click', '#removeData', function () {
            $(this).closest('#inputFormData').remove();
        });
    }
    function getAddress() {
        let users_id = $('#users_id').val();
        $.ajax({
            url: "{{route('address.index')}}",
            method: "GET",
            dataType: "json",
            data : {
                users_id : users_id
            },
            success: function (data) {
               console.log(data);
               $('#address').val(data[0].address)
            },
        });
    }
   
    $('.slc_product').change(function(){
        console.log(123);
        var key = $(this).parent().parent().find('input').val();
        var v = $(this).val();
        // $('#MSG').html( key +'<BR>'+ v );
        console.log( key +'<BR>'+ v );
    });
    function getVarian(sel,index){
        let products_id = sel.value
        $.ajax({
            url: "{{route('api.product_varian')}}",
            method: "GET",
            dataType: "json",
            data : {
                products_id : products_id
            },
            success: function (data) {
                console.log(data);
                data.forEach(val => {
                    console.log(val);
                    let nama_varian = val.varian_detail1.name
                    if (val.varian_detail2) {
                    nama_varian = val.varian_detail1.name +' - ' +val.varian_detail2.name
                    }
                    $('#product_varian_'+index).append($("<option></option>")
                        .attr("value",val.id )
                        .text(nama_varian)); 
                });
            //    $('#address').val(data[0].address)
            },
        });
    }
    function getPrice(sel,index) {
        let product_varian_id = sel.value
        $.ajax({
            url: "{{route('api.product_varian')}}",
            method: "GET",
            dataType: "json",
            data : {
                product_varian_id : product_varian_id
            },
            success: function (data) {
                console.log(data);
                $('#price_'+index).val(data.price);
                $('#stock_'+index).val(data.stock);
            //    $('#address').val(data[0].address)
            },
        });
    }
    function checkStock(sel,index) {
        let qty = parseInt(sel.value)
        // alert(123)
        let stock =  parseInt($('#stock_'+index).val())
        console.log(qty);
        console.log(stock);
        if (qty > stock) {
            alert('Stok tidak mencukupi, stok tersedia '+stock)
            $('#qty_'+index).val(0);
            return;
        }
        calculateTotalPembelian()
    }
    function calculateTotalPembelian() {
        var price = $("input[name='price[]']").map(function(){
            return $(this).val();
        }).get();
        var qty = $("input[name='qty[]']").map(function(){
            return $(this).val();
        }).get();
        var diskon = $("input[name='discount[]']").map(function(){
            return $(this).val();
        }).get();
        let total_pembelian = 0;
        qty.forEach((val,i) => {
            // console.log(price[i]);
            total_pembelian += (parseInt(val)*parseInt(price[i])) - parseInt(diskon[0])
        });
        $('#span-total-pembelian').html(formatRupiah(total_pembelian.toString()))
    }
//     $('.clientType').change(function() {
//   $(this).closest('tr').find('.clientAmt').val($('option:selected', this).data('price'));
// });


    //Select Product
    // $(function() {
    //     $("#selectProduct").customselect();
    // });
                                                   
    </script>

@endsection
