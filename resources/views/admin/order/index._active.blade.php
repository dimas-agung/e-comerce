@extends('layouts.admin')
@section('content')

<main>
    <div class="container-fluid px-4">
        <div class="container-fluid px-4">
            <div class="row">
                <div class="col mt-4">
                    <h3>Daftar Pesanan</h3>
                </div>
                <div class="col text-end mt-4">
                    <a href="input-pesanan.html" type="button" class="btn bg-danger text-light rounded-4"><i class="fas fa-plus me-1"></i>Buat Pesanan</a>
                    <a href="master-produk.html" type="button" class="btn btn-outline-success rounded-4" data-toggle="modal" data-target="#modalReportSales"><i class="fas fa-file me-1"></i>Lap. Pesanan</a>
                </div>
            </div>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="dashboard.html">Dashboard</a></li>
                <li class="breadcrumb-item active">Daftar Pesanan</li>
            </ol>
            <div class="card mb-2">
                <div class="row">
                <!-- Nav pills -->
                    <div class="col">
                        <ul class="nav nav-pills" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="pill" href="#NewOrder">Pesanan Baru</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="pill" href="#OrderProcess">Pesanan Diproses</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="pill" href="#ReadyToShip">Siap Dikirim</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="pill" href="#OrderShipping">Dikirim</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="pill" href="#OrderFinish">Selesai</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="pill" href="#OrderCancel">Pesanan Batal</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <span class="text-secondary">Pesanan Belum dibayar</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    
                </div>

                <form method="" action="">
                    <div class="row mt-2 mb-2">
                        <div class="col-sm-3">
                            <input type="date" class="form-control" placeholder="Tanggal Transaksi" aria-label="Tanggal Transaksi" value="2023-10-28">
                        </div>
                        <div class="col">
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" placeholder="Cari Pesanan" aria-label="Cari Pesanan" aria-describedby="button-addon2">
                                <button class="btn btn-outline-success rounded-2 col-2 auto" type="button" id="SearchOrder">Cari</button>
                            </div>
                        </div>
                    </div>
                </form> 
            </div>


            <!-- Tab panes -->
            <div class="row">
                <div class="tab-content">

                    <!--Panel New Order-->
                    <div id="NewOrder" class="card tab-pane active" role="tabpanel">
                        @foreach ($new_orders as $key=>$order)
                        <div class="card">
                            <div class="card mb-2 bg-light">
                                <div class="row">
                                    <div class="col-sm m-1">
                                        <span class="text text-secondary fw-bold me-2">Pesanan Baru</span>
                                        <span class="text text-secondary me-1">No. Order :</span>
                                            <a href="" class="text-decoration-none me-2">
                                                <span class="text-success">{{$order->order_no}}</span> 
                                            </a>
                                        <span class="text-secondary me-2"><i class="fas fa-user me-2"></i>{{$order->user->fullname}}</span>
                                        <span class="text-secondary"><i class="fas fa-clock me-2"></i>{{date('Y-M-d')}}</span>
                                    </div>
                                    <div class="col-sm-2 mt-1 me-2 text-end">
                                        <a href="" class="text-decoration-none text-secondary">
                                            {{-- <i class="fas fa-print me-1"></i><span class="text me-2">Cetak</span> --}}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row flex-nowrap overflow-auto mb-2 ms-1 me-1">
                                <div class="col" style="min-width: 500px;">
                                    <div class="text">
                                        <P class="text-secondary fw-bold">Item Pesanan</P>
                                    </div>
                                   
                                    <div class="content">
                                        <div class="card me-2" style="width: 80px;float: left;">
                                            <img src="assets/img/produk/gamis_1.jpg" alt="Cinque Terre" class="img-thumbnail rounded-2" >
                                        </div>
                                        <div class="content ms-4 mb-4">
                                            <span class="text text-secondary">{{$order->detail[0]->product->name}}</span>
                                            <span class="text-secondary ms-2 me-2">-</span>
                                            <span class="text text-secondary fw-bold">{{$order->detail[0]->product_varian_name}}</span></br>
                                            <span class="text mb-2">{{$order->detail[0]->qty}} x 
                                            @if ($order->detail[0]->discount>0)
                                                    
                                            <span class="text-decoration-line-through">{{Rupiah($order->detail[0]->price)}}</span></span>
                                            @endif
                                            <span class="text text-secondary">{{Rupiah($order->detail[0]->price-$order->detail[0]->discount)}}</span>
                                        </div>
                                    </div>
                                    
                                    <div class="collapse" id="MoreItemNewOrder{{$key}}">
                                        @foreach ($order->detail as $key=>$item)
                                            @if ($key==0)
                                                @php
                                                    continue;
                                                @endphp
                                            @endif
                                            <div class="content">
                                                <div class="card me-2" style="width: 80px;float: left;">
                                                    <img src="assets/img/produk/gamis_1.jpg" alt="Cinque Terre" class="img-thumbnail rounded-2" >
                                                </div>
                                                <div class="content ms-4 mb-4">
                                                    <span class="text text-secondary">{{$item->product->name}}</span>
                                                    <span class="text-secondary ms-2 me-2">-</span>
                                                    <span class="text text-secondary fw-bold">{{$item->product_varian_name}}</span></br>
                                                    <span class="text mb-2">{{$item->qty}} x 
                                                    @if ($item->discount>0)
                                                            
                                                    <span class="text-decoration-line-through">{{Rupiah($item->price)}}</span></span>
                                                    @endif
                                                    <span class="text text-secondary">{{Rupiah($item->price-$item->discount)}}</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="content text-center rounded-4 mt-2 ms-2 me-2">
                                        @if (count($order->detail)> 1)
                                        <a href="#MoreItemNewOrder{{$key}}" class="text-decoration-none" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseExample">{{count($order->detail)}} Produk lainnya</a>
                                        @endif
                                    </div>
                                </div>
                                <div class="col" style="min-width: 300px ;">
                                    <div class="text mb-2">
                                        <P class="text-secondary fw-bold">Alamat</P>
                                        <span>{{$order->user->fullname}} ( <a href="" class="text-decoration-none fw-bold">{{$order->user->phone_number}}</a> )</span></br>
                                        <span>
                                            {{$order->address}}
                                        </span>
                                    </div>
                                    <div>
                                        <span class="text-secondary fw-bold">Status</span>
                                        <span class="content bg-secondary text-light ms-2 me-2">Pre Order - 10 Hari</span>
                                    </div>
                                </div>
                            </div>

                            <div class="content rounded-2 ms-4 me-4" style="background-color: rgb(206, 201, 250);">
                                <div class="row mt-2">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col col-sm text-end">
                                                <span class="text text-secondary fs.6 me-2">Total </span>
                                            </div>
                                            <div class="col me-2 text-end">
                                                <h5 class="text text-secondary fs.6 fw-bold me-2">{{rupiah($order->price_total)}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col col-sm ms-3 text-end">
                                                <span class="text text-secondary fs.6 me-2">Pembayaran</span>
                                            </div>
                                            <div class="col me-2 text-end">
                                                <h5 class="text text-secondary fs.6 fw-bold me-2">{{rupiah($order->total_payment)}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="content bg-light mt-2 me-3">
                                <div class="row">
                                    <div class="col text-end me-2">
                                        <a href=""  data-toggle="modal" data-target="#modalEvidenceTrf" class="btn btn-outline-primary col col-sm-auto">
                                            <span class="text">Bukti Transfer</span>
                                        </a>
                                        <a href="" data-toggle="modal" data-target="#modalReject" class="btn btn-danger col col-sm-2">
                                            <span class="text">Tolak</span>
                                        </a>
                                        <a href="" data-toggle="modal" data-target="#modalOrderConfirm" onclick="confirmOrder('{{$order->order_no}}','{{$order->total_payment}}')" class="btn btn-success col col-sm-2">
                                            <span class="text">Terima</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div> 
                    <!--End Panel New Order-->

                    <!-- Panel Order Proses-->
                    <div id="OrderProcess" class="card tab-pane fade" role="tabpanel">
                        @foreach ($new_orders as $key=>$order)
                        <div class="card">
                            <div class="card mb-2 bg-light">
                                <div class="row">
                                    <div class="col-sm m-1">
                                        <span class="text text-secondary fw-bold me-2">Pesanan Diproses</span>
                                        <span class="text text-secondary me-1">No. Order :</span>
                                            <a href="" class="text-decoration-none me-2">
                                                <span class="text-success">{{$order->order_no}}</span> 
                                            </a>
                                        <span class="text-secondary me-2"><i class="fas fa-user me-2"></i>{{$order->user->fullname}}</span>
                                        <span class="text-secondary"><i class="fas fa-clock me-2"></i>{{date('Y-M-d')}}</span>
                                    </div>
                                    <div class="col-sm-2 mt-1 me-2 text-end">
                                        <a href="" class="text-decoration-none text-secondary">
                                            {{-- <i class="fas fa-print me-1"></i><span class="text me-2">Cetak</span> --}}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row flex-nowrap overflow-auto mb-2 ms-1 me-1">
                                <div class="col" style="min-width: 500px;">
                                    <div class="text">
                                        <P class="text-secondary fw-bold">Item Pesanan</P>
                                    </div>
                                   
                                    <div class="content">
                                        <div class="card me-2" style="width: 80px;float: left;">
                                            <img src="assets/img/produk/gamis_1.jpg" alt="Cinque Terre" class="img-thumbnail rounded-2" >
                                        </div>
                                        <div class="content ms-4 mb-4">
                                            <span class="text text-secondary">{{$order->detail[0]->product->name}}</span>
                                            <span class="text-secondary ms-2 me-2">-</span>
                                            <span class="text text-secondary fw-bold">{{$order->detail[0]->product_varian_name}}</span></br>
                                            <span class="text mb-2">{{$order->detail[0]->qty}} x 
                                            @if ($order->detail[0]->discount>0)
                                                    
                                            <span class="text-decoration-line-through">{{Rupiah($order->detail[0]->price)}}</span></span>
                                            @endif
                                            <span class="text text-secondary">{{Rupiah($order->detail[0]->price-$order->detail[0]->discount)}}</span>
                                        </div>
                                    </div>
                                    
                                    <div class="collapse" id="MoreItemNewOrder{{$key}}">
                                        @foreach ($order->detail as $key=>$item)
                                            @if ($key==0)
                                                @php
                                                    continue;
                                                @endphp
                                            @endif
                                            <div class="content">
                                                <div class="card me-2" style="width: 80px;float: left;">
                                                    <img src="assets/img/produk/gamis_1.jpg" alt="Cinque Terre" class="img-thumbnail rounded-2" >
                                                </div>
                                                <div class="content ms-4 mb-4">
                                                    <span class="text text-secondary">{{$item->product->name}}</span>
                                                    <span class="text-secondary ms-2 me-2">-</span>
                                                    <span class="text text-secondary fw-bold">{{$item->product_varian_name}}</span></br>
                                                    <span class="text mb-2">{{$item->qty}} x 
                                                    @if ($item->discount>0)
                                                            
                                                    <span class="text-decoration-line-through">{{Rupiah($item->price)}}</span></span>
                                                    @endif
                                                    <span class="text text-secondary">{{Rupiah($item->price-$item->discount)}}</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="content text-center rounded-4 mt-2 ms-2 me-2">
                                        @if (count($order->detail)> 1)
                                        <a href="#MoreItemNewOrder{{$key}}" class="text-decoration-none" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseExample">{{count($order->detail)}} Produk lainnya</a>
                                        @endif
                                    </div>
                                </div>
                                <div class="col" style="min-width: 300px ;">
                                    <div class="text mb-2">
                                        <P class="text-secondary fw-bold">Alamat</P>
                                        <span>{{$order->user->fullname}} ( <a href="" class="text-decoration-none fw-bold">{{$order->user->phone_number}}</a> )</span></br>
                                        <span>
                                            {{$order->address}}
                                        </span>
                                    </div>
                                    <div>
                                        <span class="text-secondary fw-bold">Status</span>
                                        <span class="content bg-secondary text-light ms-2 me-2">Pre Order - 10 Hari</span>
                                    </div>
                                </div>
                            </div>

                            <div class="content rounded-2 ms-4 me-4" style="background-color: rgb(206, 201, 250);">
                                <div class="row mt-2">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col col-sm text-end">
                                                <span class="text text-secondary fs.6 me-2">Total </span>
                                            </div>
                                            <div class="col me-2 text-end">
                                                <h5 class="text text-secondary fs.6 fw-bold me-2">{{rupiah($order->price_total)}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col col-sm ms-3 text-end">
                                                <span class="text text-secondary fs.6 me-2">Pembayaran</span>
                                            </div>
                                            <div class="col me-2 text-end">
                                                <h5 class="text text-secondary fs.6 fw-bold me-2">{{rupiah($order->total_payment)}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="content bg-light mt-2 me-3">
                                <div class="row">
                                    <div class="col text-end me-2">
                                        <div class="col text-end me-2">
                                            <a  href="" data-toggle="modal" data-target="#modalReject" class="btn btn-danger col col-sm-2">
                                                <span class="text">Batal</span>
                                            </a>
                                            <a href="" data-toggle="modal" data-target="#Konfirm" class="btn btn-success col col-sm-2">
                                                <span class="text">Siap Dikirim</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!--End Panel Order Proses-->

                    <!--Panel Order Siap Dikirim-->
                    <div id="ReadyToShip" class="card tab-pane fade" role="tabpanel">
                        @foreach ($new_orders as $key=>$order)
                        <div class="card">
                            <div class="card mb-2 bg-light">
                                <div class="row">
                                    <div class="col-sm m-1">
                                        <span class="text text-secondary fw-bold me-2">Pesanan Siap Kirim</span>
                                        <span class="text text-secondary me-1">No. Order :</span>
                                            <a href="" class="text-decoration-none me-2">
                                                <span class="text-success">{{$order->order_no}}</span> 
                                            </a>
                                        <span class="text-secondary me-2"><i class="fas fa-user me-2"></i>{{$order->user->fullname}}</span>
                                        <span class="text-secondary"><i class="fas fa-clock me-2"></i>{{date('Y-M-d')}}</span>
                                    </div>
                                    <div class="col-sm-2 mt-1 me-2 text-end">
                                        <a href="" class="text-decoration-none text-secondary">
                                            {{-- <i class="fas fa-print me-1"></i><span class="text me-2">Cetak</span> --}}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row flex-nowrap overflow-auto mb-2 ms-1 me-1">
                                <div class="col" style="min-width: 500px;">
                                    <div class="text">
                                        <P class="text-secondary fw-bold">Item Pesanan</P>
                                    </div>
                                   
                                    <div class="content">
                                        <div class="card me-2" style="width: 80px;float: left;">
                                            <img src="assets/img/produk/gamis_1.jpg" alt="Cinque Terre" class="img-thumbnail rounded-2" >
                                        </div>
                                        <div class="content ms-4 mb-4">
                                            <span class="text text-secondary">{{$order->detail[0]->product->name}}</span>
                                            <span class="text-secondary ms-2 me-2">-</span>
                                            <span class="text text-secondary fw-bold">{{$order->detail[0]->product_varian_name}}</span></br>
                                            <span class="text mb-2">{{$order->detail[0]->qty}} x 
                                            @if ($order->detail[0]->discount>0)
                                                    
                                            <span class="text-decoration-line-through">{{Rupiah($order->detail[0]->price)}}</span></span>
                                            @endif
                                            <span class="text text-secondary">{{Rupiah($order->detail[0]->price-$order->detail[0]->discount)}}</span>
                                        </div>
                                    </div>
                                    
                                    <div class="collapse" id="MoreItemNewOrder{{$key}}">
                                        @foreach ($order->detail as $key=>$item)
                                            @if ($key==0)
                                                @php
                                                    continue;
                                                @endphp
                                            @endif
                                            <div class="content">
                                                <div class="card me-2" style="width: 80px;float: left;">
                                                    <img src="assets/img/produk/gamis_1.jpg" alt="Cinque Terre" class="img-thumbnail rounded-2" >
                                                </div>
                                                <div class="content ms-4 mb-4">
                                                    <span class="text text-secondary">{{$item->product->name}}</span>
                                                    <span class="text-secondary ms-2 me-2">-</span>
                                                    <span class="text text-secondary fw-bold">{{$item->product_varian_name}}</span></br>
                                                    <span class="text mb-2">{{$item->qty}} x 
                                                    @if ($item->discount>0)
                                                            
                                                    <span class="text-decoration-line-through">{{Rupiah($item->price)}}</span></span>
                                                    @endif
                                                    <span class="text text-secondary">{{Rupiah($item->price-$item->discount)}}</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="content text-center rounded-4 mt-2 ms-2 me-2">
                                        @if (count($order->detail)> 1)
                                        <a href="#MoreItemNewOrder{{$key}}" class="text-decoration-none" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseExample">{{count($order->detail)}} Produk lainnya</a>
                                        @endif
                                    </div>
                                </div>
                                <div class="col" style="min-width: 300px ;">
                                    <div class="text mb-2">
                                        <P class="text-secondary fw-bold">Alamat</P>
                                        <span>{{$order->user->fullname}} ( <a href="" class="text-decoration-none fw-bold">{{$order->user->phone_number}}</a> )</span></br>
                                        <span>
                                            {{$order->address}}
                                        </span>
                                    </div>
                                    <div>
                                        <span class="text-secondary fw-bold">Status</span>
                                        <span class="content bg-secondary text-light ms-2 me-2">Pre Order - 10 Hari</span>
                                    </div>
                                </div>
                            </div>

                            <div class="content rounded-2 ms-4 me-4" style="background-color: rgb(206, 201, 250);">
                                <div class="row mt-2">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col col-sm text-end">
                                                <span class="text text-secondary fs.6 me-2">Total </span>
                                            </div>
                                            <div class="col me-2 text-end">
                                                <h5 class="text text-secondary fs.6 fw-bold me-2">{{rupiah($order->price_total)}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col col-sm ms-3 text-end">
                                                <span class="text text-secondary fs.6 me-2">Pembayaran</span>
                                            </div>
                                            <div class="col me-2 text-end">
                                                <h5 class="text text-secondary fs.6 fw-bold me-2">{{rupiah($order->total_payment)}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="content bg-light mt-2 me-3">
                                <div class="row">
                                    <div class="col text-end me-2">
                                        <div class="col text-end me-2">
                                            <a  href="" data-toggle="modal" data-target="#modalReject" class="btn btn-danger col col-sm-2">
                                                <span class="text">Batal</span>
                                            </a>
                                            <a href="" data-toggle="modal" data-target="#modalToShipping" class="btn btn-success col col-sm-2">
                                                <span class="text">Dikirim</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        
                    </div>
                    <!--End Panel Order Siap Dikirim-->

                    <!--Panel Order dalam pengiriman-->
                    <div id="OrderShipping" class="card tab-pane fade" role="tabpanel">
                        @foreach ($new_orders as $key=>$order)
                        <div class="card">
                            <div class="card mb-2 bg-light">
                                <div class="row">
                                    <div class="col-sm m-1">
                                        <span class="text text-secondary fw-bold me-2">Pesanan Dalam Pengiriman</span>
                                        <span class="text text-secondary me-1">No. Order :</span>
                                            <a href="" class="text-decoration-none me-2">
                                                <span class="text-success">{{$order->order_no}}</span> 
                                            </a>
                                        <span class="text-secondary me-2"><i class="fas fa-user me-2"></i>{{$order->user->fullname}}</span>
                                        <span class="text-secondary"><i class="fas fa-clock me-2"></i>{{date('Y-M-d')}}</span>
                                    </div>
                                    <div class="col-sm-2 mt-1 me-2 text-end">
                                        <a href="" class="text-decoration-none text-secondary">
                                            {{-- <i class="fas fa-print me-1"></i><span class="text me-2">Cetak</span> --}}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row flex-nowrap overflow-auto mb-2 ms-1 me-1">
                                <div class="col" style="min-width: 500px;">
                                    <div class="text">
                                        <P class="text-secondary fw-bold">Item Pesanan</P>
                                    </div>
                                   
                                    <div class="content">
                                        <div class="card me-2" style="width: 80px;float: left;">
                                            <img src="assets/img/produk/gamis_1.jpg" alt="Cinque Terre" class="img-thumbnail rounded-2" >
                                        </div>
                                        <div class="content ms-4 mb-4">
                                            <span class="text text-secondary">{{$order->detail[0]->product->name}}</span>
                                            <span class="text-secondary ms-2 me-2">-</span>
                                            <span class="text text-secondary fw-bold">{{$order->detail[0]->product_varian_name}}</span></br>
                                            <span class="text mb-2">{{$order->detail[0]->qty}} x 
                                            @if ($order->detail[0]->discount>0)
                                                    
                                            <span class="text-decoration-line-through">{{Rupiah($order->detail[0]->price)}}</span></span>
                                            @endif
                                            <span class="text text-secondary">{{Rupiah($order->detail[0]->price-$order->detail[0]->discount)}}</span>
                                        </div>
                                    </div>
                                    
                                    <div class="collapse" id="MoreItemNewOrder{{$key}}">
                                        @foreach ($order->detail as $key=>$item)
                                            @if ($key==0)
                                                @php
                                                    continue;
                                                @endphp
                                            @endif
                                            <div class="content">
                                                <div class="card me-2" style="width: 80px;float: left;">
                                                    <img src="assets/img/produk/gamis_1.jpg" alt="Cinque Terre" class="img-thumbnail rounded-2" >
                                                </div>
                                                <div class="content ms-4 mb-4">
                                                    <span class="text text-secondary">{{$item->product->name}}</span>
                                                    <span class="text-secondary ms-2 me-2">-</span>
                                                    <span class="text text-secondary fw-bold">{{$item->product_varian_name}}</span></br>
                                                    <span class="text mb-2">{{$item->qty}} x 
                                                    @if ($item->discount>0)
                                                            
                                                    <span class="text-decoration-line-through">{{Rupiah($item->price)}}</span></span>
                                                    @endif
                                                    <span class="text text-secondary">{{Rupiah($item->price-$item->discount)}}</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="content text-center rounded-4 mt-2 ms-2 me-2">
                                        @if (count($order->detail)> 1)
                                        <a href="#MoreItemNewOrder{{$key}}" class="text-decoration-none" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseExample">{{count($order->detail)}} Produk lainnya</a>
                                        @endif
                                    </div>
                                </div>
                                <div class="col" style="min-width: 300px ;">
                                    <div class="text mb-2">
                                        <P class="text-secondary fw-bold">Alamat</P>
                                        <span>{{$order->user->fullname}} ( <a href="" class="text-decoration-none fw-bold">{{$order->user->phone_number}}</a> )</span></br>
                                        <span>
                                            {{$order->address}}
                                        </span>
                                    </div>
                                    <div>
                                        <span class="text-secondary fw-bold">Status</span>
                                        <span class="content bg-secondary text-light ms-2 me-2">Pre Order - 10 Hari</span>
                                    </div>
                                </div>
                            </div>

                            <div class="content rounded-2 ms-4 me-4" style="background-color: rgb(206, 201, 250);">
                                <div class="row mt-2">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col col-sm text-end">
                                                <span class="text text-secondary fs.6 me-2">Total </span>
                                            </div>
                                            <div class="col me-2 text-end">
                                                <h5 class="text text-secondary fs.6 fw-bold me-2">{{rupiah($order->price_total)}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col col-sm ms-3 text-end">
                                                <span class="text text-secondary fs.6 me-2">Pembayaran</span>
                                            </div>
                                            <div class="col me-2 text-end">
                                                <h5 class="text text-secondary fs.6 fw-bold me-2">{{rupiah($order->total_payment)}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="content bg-light mt-2 me-3">
                                <div class="row">
                                    <div class="col text-end me-2">
                                        <div class="col text-end me-2">
                                            <a href="" class="btn btn-danger col col-sm-2">
                                                <span class="text">Selesai</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!--End Panel Order dalam Pengiriman-->

                    <!--Panel Pesanan Selesai-->
                    <div id="OrderFinish" class="card tab-pane fade" role="tabpanel">
                        @foreach ($new_orders as $key=>$order)
                        <div class="card">
                            <div class="card mb-2 bg-light">
                                <div class="row">
                                    <div class="col-sm m-1">
                                        <span class="text text-secondary fw-bold me-2">Pesanan Selesai</span>
                                        <span class="text text-secondary me-1">No. Order :</span>
                                            <a href="" class="text-decoration-none me-2">
                                                <span class="text-success">{{$order->order_no}}</span> 
                                            </a>
                                        <span class="text-secondary me-2"><i class="fas fa-user me-2"></i>{{$order->user->fullname}}</span>
                                        <span class="text-secondary"><i class="fas fa-clock me-2"></i>{{date('Y-M-d')}}</span>
                                    </div>
                                    <div class="col-sm-2 mt-1 me-2 text-end">
                                        <a href="" class="text-decoration-none text-secondary">
                                            {{-- <i class="fas fa-print me-1"></i><span class="text me-2">Cetak</span> --}}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row flex-nowrap overflow-auto mb-2 ms-1 me-1">
                                <div class="col" style="min-width: 500px;">
                                    <div class="text">
                                        <P class="text-secondary fw-bold">Item Pesanan</P>
                                    </div>
                                   
                                    <div class="content">
                                        <div class="card me-2" style="width: 80px;float: left;">
                                            <img src="assets/img/produk/gamis_1.jpg" alt="Cinque Terre" class="img-thumbnail rounded-2" >
                                        </div>
                                        <div class="content ms-4 mb-4">
                                            <span class="text text-secondary">{{$order->detail[0]->product->name}}</span>
                                            <span class="text-secondary ms-2 me-2">-</span>
                                            <span class="text text-secondary fw-bold">{{$order->detail[0]->product_varian_name}}</span></br>
                                            <span class="text mb-2">{{$order->detail[0]->qty}} x 
                                            @if ($order->detail[0]->discount>0)
                                                    
                                            <span class="text-decoration-line-through">{{Rupiah($order->detail[0]->price)}}</span></span>
                                            @endif
                                            <span class="text text-secondary">{{Rupiah($order->detail[0]->price-$order->detail[0]->discount)}}</span>
                                        </div>
                                    </div>
                                    
                                    <div class="collapse" id="MoreItemNewOrder{{$key}}">
                                        @foreach ($order->detail as $key=>$item)
                                            @if ($key==0)
                                                @php
                                                    continue;
                                                @endphp
                                            @endif
                                            <div class="content">
                                                <div class="card me-2" style="width: 80px;float: left;">
                                                    <img src="assets/img/produk/gamis_1.jpg" alt="Cinque Terre" class="img-thumbnail rounded-2" >
                                                </div>
                                                <div class="content ms-4 mb-4">
                                                    <span class="text text-secondary">{{$item->product->name}}</span>
                                                    <span class="text-secondary ms-2 me-2">-</span>
                                                    <span class="text text-secondary fw-bold">{{$item->product_varian_name}}</span></br>
                                                    <span class="text mb-2">{{$item->qty}} x 
                                                    @if ($item->discount>0)
                                                            
                                                    <span class="text-decoration-line-through">{{Rupiah($item->price)}}</span></span>
                                                    @endif
                                                    <span class="text text-secondary">{{Rupiah($item->price-$item->discount)}}</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="content text-center rounded-4 mt-2 ms-2 me-2">
                                        @if (count($order->detail)> 1)
                                        <a href="#MoreItemNewOrder{{$key}}" class="text-decoration-none" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseExample">{{count($order->detail)}} Produk lainnya</a>
                                        @endif
                                    </div>
                                </div>
                                <div class="col" style="min-width: 300px ;">
                                    <div class="text mb-2">
                                        <P class="text-secondary fw-bold">Alamat</P>
                                        <span>{{$order->user->fullname}} ( <a href="" class="text-decoration-none fw-bold">{{$order->user->phone_number}}</a> )</span></br>
                                        <span>
                                            {{$order->address}}
                                        </span>
                                    </div>
                                    <div>
                                        <span class="text-secondary fw-bold">Status</span>
                                        <span class="content bg-secondary text-light ms-2 me-2">Pre Order - 10 Hari</span>
                                    </div>
                                </div>
                            </div>

                            <div class="content rounded-2 ms-4 me-4" style="background-color: rgb(206, 201, 250);">
                                <div class="row mt-2">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col col-sm text-end">
                                                <span class="text text-secondary fs.6 me-2">Total </span>
                                            </div>
                                            <div class="col me-2 text-end">
                                                <h5 class="text text-secondary fs.6 fw-bold me-2">{{rupiah($order->price_total)}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col col-sm ms-3 text-end">
                                                <span class="text text-secondary fs.6 me-2">Pembayaran</span>
                                            </div>
                                            <div class="col me-2 text-end">
                                                <h5 class="text text-secondary fs.6 fw-bold me-2">{{rupiah($order->total_payment)}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="content bg-light mt-2 me-3">
                                <div class="row">
                                    <div class="col text-end me-2">
                                        <div class="col text-end me-2">
                                            <a href="" class="btn btn-outline-danger col col-sm-2">
                                                <span class="text">Lihat Riwayat</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                    <!--End Panel Pesanan Selesai-->

                    <!--Panel Pesanan Batal-->
                    <div id="OrderCancel" class="card tab-pane fade" role="tabpanel">
                        <div class="card">
                            <div class="card mb-2 bg-light">
                                <div class="row">
                                    <div class="col m-1">
                                        <span class="text text-secondary fw-bold me-2">Pesanan Batal</span>
                                        <span class="text text-secondary me-1">No. Order :</span>
                                            <a href="" class="text-decoration-none me-2">
                                                <span class="text-success">SO2023100004</span> 
                                            </a>
                                        <span class="text-secondary me-2"><i class="fas fa-user me-2"></i>Dimas Mahakarya</span>
                                        <span class="text-secondary"><i class="fas fa-clock me-2"></i>13 Okt 2023 08:23</span>
                                    </div>
                                    <div class="col-sm-2 mt-1 me-2 text-end">
                                        <a href="" class="text-decoration-none text-secondary">
                                            <i class="fas fa-print me-1"></i><span class="text me-2">Cetak</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row flex-nowrap overflow-auto mb-2 ms-1 me-1">
                                <div class="col" style="min-width: 500px;">
                                    <div class="text">
                                        <P class="text-secondary fw-bold">Item Pesanan</P>
                                    </div>
                                    
                                    <div class="content">
                                        <div class="card me-2" style="width: 80px;float: left;">
                                            <img src="assets/img/produk/gamis_1.jpg" alt="Cinque Terre" class="img-thumbnail rounded-2" >
                                        </div>
                                        <div class="content ms-4 mb-4">
                                            <span class="text text-secondary">GAMIS AURORA MAXMARA LUX ARMANY SILK MOTIF KEKINIAN TERBARU 2023</span>
                                            <span class="text-secondary ms-2 me-2">-</span>
                                            <span class="text text-secondary fw-bold">Biru XL</span></br>
                                            <span class="text mb-2 bg-light">1 x Rp 299.000</span>
                                        </div>
                                    </div>
                                    
                                    <div class="collapse" id="MoreOrderItem2">
                                        <div class="content">
                                            <div class="card me-2" style="width: 80px;float: left;">
                                                <img src="assets/img/produk/gamis_1.jpg" alt="Cinque Terre" class="img-thumbnail rounded-2" >
                                            </div>
                                            <div class="content ms-4 mb-4">
                                                <span class="text text-secondary">GAMIS AURORA MAXMARA LUX ARMANY SILK MOTIF KEKINIAN TERBARU 2023</span>
                                                <span class="text-secondary ms-2 me-2">-</span>
                                                <span class="text text-secondary fw-bold">Biru XL</span></br>
                                                <span class="text mb-2 bg-light">1 x Rp 299.000</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="content text-center rounded-4 mt-2 ms-2 me-2" style="background-color: rgb(206, 201, 250);">
                                        <a href="#MoreOrderItem2" class="text-decoration-none" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseExample">1 Produk lainnya</a>
                                    </div>
                                </div>
                                <div class="col" style="min-width: 300px ;">
                                    <div class="text mb-2">
                                        <P class="text-secondary fw-bold">Alamat</P>
                                        <span>Dimas Mahakarya ( <a href="" class="text-decoration-none fw-bold">0876766665656</a> )</span></br>
                                        <span>
                                            Jl Raya Tropodo RT 03 RW 04, Tropodo, Waru, Sidoarjo, Jawa TImur, 61256
                                        </span>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <span class="text-secondary fw-bold">Status</span>
                                            <span class="content bg-secondary text-light ms-2 me-2">Pre Order - 10 Hari</span>
                                        </div>
                                        <div class="col">
                                            <span class="text-secondary fw-bold">Alasan Batal</span>
                                            <p class="content text-secondary">
                                                Bukti transfer tidak valid
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="content rounded-2 ms-4 me-4" style="background-color: rgb(206, 201, 250);">
                                <div class="row mt-2">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col col-sm text-end">
                                                <span class="text text-secondary fs.6 me-2">Total Rp</span>
                                            </div>
                                            <div class="col me-2 text-end">
                                                <h5 class="text text-secondary fs.6 fw-bold me-2">1.345.000</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col col-sm ms-3 text-end">
                                                <span class="text text-secondary fs.6 me-2">Pembayaran</span>
                                            </div>
                                            <div class="col me-2 text-end">
                                                <h5 class="text text-secondary fs.6 fw-bold me-2">1.345.000</h5>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="content bg-light mt-2 me-3">
                                <div class="row">
                                    <div class="col text-end me-2">
                                        <a href="" class="btn btn-outline-danger col col-sm-2">
                                            <span class="text">Lihat Riwayat</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Panel Pesanan Batal-->

                    <!--Modal View Bukti Transfer-->
                    <div class="modal fade" id="modalEvidenceTrf" tabindex="-1" role="dialog" aria-labelledby="modalEvidenceTrf" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                          <div class="modal-content">
                            <div class="modal-header bg-primary text-light">
                              <h5 class="modal-title" id="modalUser">No Order 20231000012</h5>
                              <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close" aria-hidden="true"></button>
                            </div>
                            <!-- Modal Body-->
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="container mt-3">
                                            <img src="assets/img/transfer/buktiTrf.jpg" alt="bukti transfer" class="img-fluid rounded-2" >
                                        </div> 
                                    </div>
                                    <div class="col-sm-auto mt-2">
                                        <div class="span">
                                            <span class="text">Total Pembelian</span>
                                            <h5 class="headingOne text-secondary">Rp 1.250.000</h5>
                                        </div>
                                        <div class="span">
                                            <span class="text">Minimal Bayar</span>
                                            <h5 class="headingOne text-secondary">Rp 625.000</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Modal Footer-->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                                <button type="button" class="btn btn-danger">Simpan</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    <!--End Modal View Bukti Transfer-->
                    
                    <!--Modal Tolak Order-->
                    <div class="modal fade" id="modalReject" tabindex="-1" role="dialog" aria-labelledby="modalReject" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                          <div class="modal-content">
                            <div class="modal-header bg-primary text-light">
                              <h5 class="modal-title" id="modalUser">No Order 20231000012</h5>
                              <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close" aria-hidden="true"></button>
                            </div>
                            <!-- Modal Body-->
                            <div class="modal-body">
                                <form method="POST" method="#">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="inputName">Alasan dibatalkan</label>
                                                <input type="text" id="inputReasonReject" class="form-control" placeholder="Alasan Pesanan dibatalkan">
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
                    <!--End Modal Tolak Order-->

                    <!--Modal Confirm Order-->
                    <div class="modal fade" id="modalOrderConfirm" tabindex="-1" role="dialog" aria-labelledby="modalOrderConfirm" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                          <div class="modal-content">
                            <div class="modal-header bg-primary text-light">
                              <h5 class="modal-title" id="modalUser">No Order <span id="no_order_confirm"></span></h5>
                              <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close" aria-hidden="true"></button>
                            </div>
                            <!-- Modal Body-->
                            <div class="modal-body">
                                <form>
                                    <div class="row">
                                        <div class="col-sm justify-content-center">
                                            <div class="container mt-3">
                                                <img src="assets/img/transfer/buktiTrf.jpg" alt="bukti transfer" class="img-fluid rounded-2" width="250px">
                                            </div> 
                                        </div>
                                        <div class="col-sm-6 mt-2">
                                            <div class="span">
                                                <span class="text">Total Pembelian</span>
                                                <h5 class="headingOne text-secondary"><span id="total_pembelian"></span></h5>
                                            </div>
                                            <div class="span">
                                                <span class="text">Minimal Bayar</span>
                                                <h5 class="headingOne text-secondary"><span id="min_bayar_confirm"></span></h5>
                                            </div>
                                            <div class="form-group mt-2">
                                                <label for="inputPayment">Input Pembayaran</label>
                                                <div class="input-group mt-1">
                                                    <span class="input-group-text">Rp</span>
                                                    <input type="number" class="form-control" id="inputPaymentConfirm" placeholder="Input Pembayaran">
                                                </div>
                                            </div>
                                            <div class="text mt-4">
                                                <span class="text-secondary">
                                                    Note :
                                                    <p>
                                                        Pastikan bukti transfer asli dan dana transfer sudah masuk ke rekening
                                                    </p>
                                                </span>
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
                    <!--End Modal Confirm Order-->

                    <!--Modal Pesanan Dikirim-->
                    <div class="modal fade" id="modalToShipping" tabindex="-1" role="dialog" aria-labelledby="modalToShipping" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                          <div class="modal-content">
                            <div class="modal-header bg-primary text-light">
                              <h5 class="modal-title" id="modalUser">No Order 20231000012</h5>
                              <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close" aria-hidden="true"></button>
                            </div>
                            <!-- Modal Body-->
                            <div class="modal-body">
                                <form>
                                    <div class="row">
                                        <div class="col-sm justify-content-center">
                                            <div class="container mt-3">
                                                <img src="assets/img/transfer/buktiTrf.jpg" alt="bukti transfer" class="img-fluid rounded-2" width="250px">
                                            </div> 
                                        </div>
                                        <div class="col-sm-6 mt-2">
                                            <div class="span">
                                                <span class="text">Total Pembelian</span>
                                                <h5 class="headingOne text-secondary">Rp 1.250.000</h5>
                                            </div>
                                            <div class="span">
                                                <span class="text">Pembayaran Sebelumnya</span>
                                                <h5 class="headingOne text-secondary">Rp 700.000</h5>
                                            </div>
                                            <div class="form-group mt-2">
                                                <label for="inputPayment">Input Pembayaran</label>
                                                <div class="input-group mt-1">
                                                    <span class="input-group-text">Rp</span>
                                                    <input type="number" class="form-control" id="inputPayment" placeholder="Input Pembayaran">
                                                </div>
                                            </div>
                                            <div class="text mt-4">
                                                <span class="text-secondary">
                                                    Note :
                                                    <p>
                                                        Pastikan bukti transfer asli dan dana transfer sudah masuk ke rekening
                                                    </p>
                                                </span>
                                            </div>
                                            <div class="form-group mt-2">
                                                <label for="inputDelService">Jasa Pengiriman</label>
                                                <div class="input-group mt-1">
                                                    <select type="select" class="form-select" id="inputDelService">
                                                        <option value="JNE">JNE</option>
                                                        <option value="JNT">JNT</option>
                                                        <option value="SI CEPAT">SI Cepat</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group mt-2">
                                                <label for="inputResi">No Resi</label>
                                                <div class="input-group mt-1">
                                                    <input type="text" class="form-control" id="inputResi" placeholder="No Resi">
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
                    <!--End Modal Dikirim-->

                    <!--Modal Laporan Penjualan-->
                    <div class="modal fade" id="modalReportSales" tabindex="-1" role="dialog" aria-labelledby="modalReportSales" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                          <div class="modal-content">
                            <div class="modal-header bg-primary text-light">
                              <h5 class="modal-title" id="modalUser">Buat Data Penjualan</h5>
                              <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close" aria-hidden="true"></button>
                            </div>
                            <!-- Modal Body-->
                            <div class="modal-body">
                                <form method="POST" method="#">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="inputName">Tanggal Awal</label>
                                                <input type="date" id="inputDateStart" class="form-control col-2" value="2023-11-08">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="inputName">Tanggal Akhir</label>
                                                <input type="date" id="inputDateEnd" class="form-control col-2" value="2023-11-08">
                                            </div>
                                        </div>
                                    </div>                                                                                                      
                                </form>
                            </div>
                            <!--Modal Footer-->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                                <button type="button" class="btn btn-danger">Buat Laporan</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    <!--End Modal Laporan Penjualan-->


                </div>
            </div>
        </div>
    </div>
    
    <script type="text/javascript">
        function confirmOrder(no_order,total_pembelian) {
            console.log(no_order);
            console.log(total_pembelian);
            $('#no_order_confirm').html(no_order)
            // $('#modalOrderConfirm').modal('show')
            $('#total_pembelian').html(formatRupiah(total_pembelian))
            let min_bayar = parseInt(total_pembelian)*30/100;
            console.log(min_bayar);
            $('#min_bayar_confirm').html(formatRupiah(String(min_bayar),'Rp'))
        }
        
    </script>
</main>
@endsection
