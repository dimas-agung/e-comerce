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
                                <a  class="nav-link"  data-bs-toggle="pill" href="#OrderNotPaid">Pesanan Belum dibayar</a>
                            </li>
                        </ul>
                    </div>
                    
                </div>
            </div>


            <!-- Tab panes -->
            <div class="row">
                <div class="tab-content">

                    <!--Panel New Order-->
                    <div id="NewOrder" class="tab-pane active" role="tabpanel">
                        @foreach ($new_orders as $key=>$order)
                            @if (count($order->payment) === 0)
                                @php
                                    continue;
                                @endphp
                            @endif
                            <div class="border border-top-0 rounded-2 mb-2 pb-2">
                                <!--Detail Order-->
                                <div class="card mb-2 bg-light">
                                    <div class="row">
                                        <div class="col-sm m-1">
                                            <span class="text text-secondary fw-bold me-2">Pesanan Baru </span>
                                            <span class="text text-secondary me-1">No. Order :</span>
                                                <a href="" class="text-decoration-none me-2">
                                                    <span class="text-success">{{$order->order_no}}</span> 
                                                </a>
                                            <span class="text-secondary me-2"><i class="fas fa-user me-2"></i>{{$order->name}}</span>
                                            <span class="text-secondary"><i class="fas fa-clock me-2"></i>{{date('d-M-Y H:i')}}</span>
                                        </div>
                                        <div class="col-sm-2 mt-1 me-2 text-end">
                                            <a href="" class="text-decoration-none text-secondary link-disable">
                                                <i class="fas fa-print me-1"></i><span class="text me-2">Cetak</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                
                                <!--Detail Item Order-->
                                <div class="row flex-nowrap overflow-auto mb-2 ms-1 me-1">
                                    <div class="col-6 border-end" style="min-width: 544px;">
                                        <div class="text">
                                            <P class="text-secondary fw-bold">Item Pesanan</P>
                                        </div>

                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <div class="align-self-start me-2" style="width: 76px; height: 76px;">
                                                    <img src="{{ asset('storage/'.$order->detail[0]->product->picture_default) }}" alt="Foto Produk" class="img-thumbnail rounded-2" style="width: 76px; height: 76px;" >
                                                </div>
                                            </div>
    
                                            <div class="flex-grow-1">
                                                <div class="content ms-2 mb-4">
                                                    <div class="mb-2">
                                                        <span class="text text-secondary">{{$order->detail[0]->product->name}}</span>
                                                        <span class="text-secondary ms-2 me-2">-</span>
                                                        <span class="text text-secondary fw-bold">{{$order->detail[0]->product_varian_name}}</span>
                                                        <span class="mx-2">x</span>
                                                        <span class="text mb-2">{{$order->detail[0]->qty}} <br>  
                                                        @if ($order->detail[0]->discount>0)
                                                                
                                                        <span class="text-decoration-line-through">{{Rupiah($order->detail[0]->price)}}</span></span>
                                                        @endif
                                                        <span class="text text-secondary">{{Rupiah($order->detail[0]->price-$order->detail[0]->discount)}}</span>
                                                    </div>
                                                </div>
                                            </div>
    
                                        </div>

                                        <div class="collapse" id="MoreItemNewOrder_0{{$key}}">
                                            @foreach ($order->detail as $key2=>$item)
                                                @if ($key2==0)
                                                    @php
                                                        continue;
                                                    @endphp
                                                @endif
    
                                                <div class="d-flex mb-1">
                                                    <div class="flex-shrink-0">
                                                        <div class="align-self-start me-2" style="width: 76px; height: 76px;">
                                                            <img src="{{ asset('storage/'.$item->product->picture_default) }}" alt="Foto Produk" class="img-thumbnail rounded-2" style="width: 76px; height: 76px;" >
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <div class="content ms-2 mb-4">
                                                            <div class="mb-2">
                                                                <span class="text text-secondary">{{$item->product->name}}</span>
                                                                <span class="text-secondary ms-2 me-2">-</span>
                                                                <span class="text text-secondary fw-bold">{{$item->product_varian_name}}</span>
                                                                <span class="mx-2">x</span>
                                                                <span class="text mb-2">{{$item->qty}}<br> 
                                                                @if ($item->discount>0)
                                                                    
                                                                        <span class="text-decoration-line-through text-secondary me-2">{{Rupiah($item->price)}}</span></span>
                                                                        <span class="text text-secondary">{{Rupiah($item->price_after_discount)}}</span>
                                                                    @else
                                                                        <span class="text text-secondary">{{Rupiah($item->price)}}</span></span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
    
                                                </div>
                                            @endforeach
                                        </div>

                                        <div class="content text-center rounded-4 mt-2 ms-2 me-2">
                                            @if (count($order->detail)> 1)
                                                <a href="#MoreItemNewOrder_0{{$key}}" class="text-decoration-none" id="btn-ch1" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseExample">{{count($order->detail)-1}} Produk lainnya </a>
                                            @endif
                                        </div>
                                        
                                        <!--Replace text button-->
                                        <script>

                                            const btn = document.getElementById('btn-ch');

                                            // ✅ Toggle button text on click
                                            btn.addEventListener('click', function handleClick() {
                                            const initialText = '{{count($order->detail)-1}} Produk lainnya';

                                            if (btn.textContent.toLowerCase().includes(initialText.toLowerCase())) {
                                                btn.textContent = 'Sembunyikan';
                                            } else {
                                                btn.textContent = initialText;
                                            }
                                            });

                                        </script>
    
                                    </div>

                                    <div class="col-4" style="min-width: 438px ;">
                                        <div class="text mb-2">
                                            <P class="text-secondary fw-bold">Alamat</P>
                                            <span>{{$order->name}} ( <a href="" class="text-decoration-none fw-bold">{{$order->phone}}</a> )</span></br>
                                            <span>
                                                {{$order->address}}
                                            </span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <div class="col">
                                                <span class="text-secondary fw-bold">Status</span><br>
                                                <span class="content bg-secondary text-light ms-2 me-2">{{$order->detail[0]->product->order_type}} {{$order->detail[0]->product->order_period}} Hari</span>
                                            </div>
                                            <div class="col mt-1">
                                                <span class="text-secondary"><strong>Catatan</strong></span>
                                                <p class="fst-italic">{{$order->note}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--Payment Recap-->
                                <div class="content bg-light rounded-2 ms-4 me-4">
                                    <div class="row py-1 mx-2">
                                        <div class="col-lg-3 col-sm-6">
                                            <span class="text text-secondary fs.6 me-2">Pembelian </span>
                                            <h6 class="text text-secondary fs.6 fw-bold me-2">{{rupiah($order->price_total)}}</h6>
                                        </div>
                                        <div class="col-lg-3 col-sm-6">
                                            <span class="text text-secondary fs.6 me-2">Minimal Bayar (DP) </span>
                                            <h6 class="text text-secondary fs.6 fw-bold me-2">{{rupiah(($order->price_total * 50) / 100)}}</h6>
                                        </div>
                                        <div class="col-lg-3 col-sm-6">
                                            <span class="text text-secondary fs.6 me-2">Ongkos Kirim </span>
                                            <h6 class="text text-secondary fs.6 fw-bold me-2">{{rupiah($order->shipping_price)}}</h6>
                                        </div>
                                        <div class="col-lg-3 col-sm-6">
                                            <span class="text text-secondary fs.6 me-2">Total </span>
                                            <h6 class="text text-secondary fs.6 fw-bold me-2">{{rupiah($order->price_total + $order->shipping_price)}}</h6>
                                        </div>
                                    </div>
                                </div>

                                <!--Button-->
                                <div class="content mt-2 me-3">
                                    <div class="row">
                                        <div class="col text-end me-2">
                                            
                                            <a href=""  data-toggle="modal" data-target="#modalEvidenceTrf" onclick="modalTransfer('{{$order->id}}','{{$order->order_no}}','{{$order->price_total}}','{{$order->total_payment}}','{{$order->payment[0]->img}}')" class="btn btn-outline-primary col col-sm-auto">
                                                <span class="text">Bukti Transfer</span>
                                            </a>
                                            <a href="" data-toggle="modal" data-target="#modalReject"   onclick="cancelOrder('{{$order->id}}','{{$order->order_no}}')" class="btn btn-danger col col-sm-2">
                                                <span class="text">Tolak</span>
                                            </a>
                                            <a href="" data-toggle="modal" data-target="#modalOrderConfirm" onclick="confirmOrder('{{$order->id}}','{{$order->order_no}}','{{$order->price_total}}','{{$order->total_payment}}','{{$order->payment[0]->img}}')" class="btn btn-success col col-sm-2">
                                                <span class="text">Terima </span>
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
                        @foreach ($orders_processed as $key=>$order)
                            <div class="border border-top-0 rounded-2 mb-2 pb-2">
                                
                                <!--Detail Order-->
                                <div class="card mb-2 bg-light">
                                    <div class="row">
                                        <div class="col-sm m-1">
                                            <span class="text text-secondary fw-bold me-2">Pesanan Diproses </span>
                                            <span class="text text-secondary me-1">No. Order :</span>
                                                <a href="" class="text-decoration-none me-2">
                                                    <span class="text-success">{{$order->order_no}}</span> 
                                                </a>
                                            <span class="text-secondary me-2"><i class="fas fa-user me-2"></i>{{$order->name}}</span>
                                            <span class="text-secondary"><i class="fas fa-clock me-2"></i>{{date('d-M-Y H:i')}}</span>
                                        </div>
                                        <div class="col-sm-2 mt-1 me-2 text-end">
                                            <a href="" class="text-decoration-none text-secondary link-disable">
                                                {{-- <i class="fas fa-print me-1"></i><span class="text me-2">Cetak</span> --}}
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!--Detail item Order-->
                                <div class="row flex-nowrap overflow-auto mb-2 ms-1 me-1">
                                    <div class="col-6 border-end" style="min-width: 544px;">
                                        <div class="text">
                                            <P class="text-secondary fw-bold">Item Pesanan</P>
                                        </div>

                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <div class="align-self-start me-2" style="width: 76px; height: 76px;">
                                                    <img src="{{ asset('storage/'.$order->detail[0]->product->picture_default) }}" alt="Foto Produk" class="img-thumbnail rounded-2" style="width: 76px; height: 76px;" >
                                                </div>
                                            </div>
    
                                            <div class="flex-grow-1">
                                                <div class="content ms-2 mb-4">
                                                    <div class="mb-2">
                                                        <span class="text text-secondary">{{$order->detail[0]->product->name}}</span>
                                                        <span class="text-secondary ms-2 me-2">-</span>
                                                        <span class="text text-secondary fw-bold">{{$order->detail[0]->product_varian_name}}</span>
                                                        <span class="mx-2">x</span>
                                                        <span class="text mb-2">{{$order->detail[0]->qty}} <br>  
                                                        @if ($order->detail[0]->discount>0)
                                                                
                                                        <span class="text-decoration-line-through">{{Rupiah($order->detail[0]->price)}}</span></span>
                                                        @endif
                                                        <span class="text text-secondary">{{Rupiah($order->detail[0]->price-$order->detail[0]->discount)}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="collapse" id="MoreItemNewOrder_0{{$key}}">
                                            @foreach ($order->detail as $key2=>$item)
                                                @if ($key2==0)
                                                    @php
                                                        continue;
                                                    @endphp
                                                @endif
    
                                                <div class="d-flex mb-1">
                                                    <div class="flex-shrink-0">
                                                        <div class="align-self-start me-2" style="width: 76px; height: 76px;">
                                                            <img src="{{ asset('storage/'.$item->product->picture_default) }}" alt="Foto Produk" class="img-thumbnail rounded-2" style="width: 76px; height: 76px;" >
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <div class="content ms-2 mb-4">
                                                            <div class="mb-2">
                                                                <span class="text text-secondary">{{$item->product->name}}</span>
                                                                <span class="text-secondary ms-2 me-2">-</span>
                                                                <span class="text text-secondary fw-bold">{{$item->product_varian_name}}</span>
                                                                <span class="mx-2">x</span>
                                                                <span class="text mb-2">{{$item->qty}}<br> 
                                                                @if ($item->discount>0)
                                                                    
                                                                        <span class="text-decoration-line-through text-secondary me-2">{{Rupiah($item->price)}}</span></span>
                                                                        <span class="text text-secondary">{{Rupiah($item->price_after_discount)}}</span>
                                                                    @else
                                                                        <span class="text text-secondary">{{Rupiah($item->price)}}</span></span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
    
                                                </div>
                                            @endforeach
                                        </div>

                                        <div class="content text-center rounded-4 mt-2 ms-2 me-2">
                                            @if (count($order->detail)> 1)
                                                <a href="#MoreItemNewOrder_0{{$key}}" class="text-decoration-none" id="btn-ch" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseExample">{{count($order->detail)-1}} Produk lainnya </a>
                                            @endif
                                        </div>

                                    </div>

                                    <div class="col-4" style="min-width: 438px ;">
                                        <div class="text mb-2">
                                            <P class="text-secondary fw-bold">Alamat</P>
                                            <span>{{$order->name}} ( <a href="" class="text-decoration-none fw-bold">{{$order->phone}}</a> )</span></br>
                                            <span>
                                                {{$order->address}}
                                            </span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <div class="col">
                                                <span class="text-secondary fw-bold">Status</span><br>
                                                <span class="content bg-secondary text-light ms-2 me-2">{{$order->detail[0]->product->order_type}} {{$order->detail[0]->product->order_period}} Hari</span>
                                            </div>
                                            <div class="col mt-1">
                                                <span class="text-secondary"><strong>Catatan</strong></span>
                                                <p class="fst-italic">{{$order->note}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--Amount Recap-->
                                <div class="content bg-light rounded-2 ms-4 me-4">
                                    <div class="row py-1 mx-2">
                                        <div class="col-lg-4 col-sm-6">
                                            <span class="text text-secondary fs.6 me-2">Total</span>
                                            <h6 class="text text-secondary fs.6 fw-bold me-2">{{rupiah($order->price_total + $order->shipping_price)}}</h6>
                                        </div>
                                        <div class="col-lg-4 col-sm-6">
                                            <span class="text text-secondary fs.6 me-2">Pembayaran</span>
                                            <h6 class="text text-secondary fs.6 fw-bold me-2">{{rupiah($order->total_payment)}}</h6>
                                        </div>
                                        <div class="col-lg-4 col-sm-6">
                                            <span class="text text-secondary fs.6 me-2">Kurang Bayar</span>
                                            <h6 class="text text-secondary fs.6 fw-bold me-2">{{rupiah(($order->price_total + $order->shipping_price) - $order->total_payment )}}</h6>
                                        </div>
                                    </div>
                                </div>
                                
                                <!--Button-->
                                <div class="content mt-2 me-3">
                                    <div class="row">
                                        <div class="col text-end me-2">
                                            <div class="col text-end me-2">
                                                <a  href="" data-toggle="modal" data-target="#modalReject" class="btn btn-danger col col-sm-2">
                                                    <span class="text">Batal</span>
                                                </a>
                                                <a href="#" onclick="confirmOrderReadyShipping('{{$order->id}}')" class="btn btn-success col col-sm-2">
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
                        @foreach ($orders_ready_shipping as $key=>$order)
                            @php
                                 $kurang_bayar = $order->price_total + $order->shipping_price - $order->total_payment;
                            @endphp
                            <div class="border border-top-0 rounded-2 mb-2 pb-2">
                                
                                <!--Detail Order-->
                                <div class="card mb-2 bg-light">
                                    <div class="row">
                                        <div class="col-sm m-1">
                                            <span class="text text-secondary fw-bold me-2">Siap Dikirim </span>
                                            <span class="text text-secondary me-1">No. Order :</span>
                                                <a href="" class="text-decoration-none me-2">
                                                    <span class="text-success">{{$order->order_no}}</span> 
                                                </a>
                                            <span class="text-secondary me-2"><i class="fas fa-user me-2"></i>{{$order->name}}</span>
                                            <span class="text-secondary"><i class="fas fa-clock me-2"></i>{{date('d-M-Y H:i')}}</span>
                                        </div>
                                        <div class="col-sm-2 mt-1 me-2 text-end">
                                            <a href="" class="text-decoration-none text-secondary link-disable">
                                                {{-- <i class="fas fa-print me-1"></i><span class="text me-2">Cetak</span> --}}
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!--Detail item Order-->
                                <div class="row flex-nowrap overflow-auto mb-2 ms-1 me-1">
                                    <div class="col-6 border-end" style="min-width: 544px;">
                                        <div class="text">
                                            <P class="text-secondary fw-bold">Item Pesanan</P>
                                        </div>

                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <div class="align-self-start me-2" style="width: 76px; height: 76px;">
                                                    <img src="{{ asset('storage/'.$order->detail[0]->product->picture_default) }}" alt="Foto Produk" class="img-thumbnail rounded-2" style="width: 76px; height: 76px;" >
                                                </div>
                                            </div>
    
                                            <div class="flex-grow-1">
                                                <div class="content ms-2 mb-4">
                                                    <div class="mb-2">
                                                        <span class="text text-secondary">{{$order->detail[0]->product->name}}</span>
                                                        <span class="text-secondary ms-2 me-2">-</span>
                                                        <span class="text text-secondary fw-bold">{{$order->detail[0]->product_varian_name}}</span>
                                                        <span class="mx-2">x</span>
                                                        <span class="text mb-2">{{$order->detail[0]->qty}} <br>  
                                                        @if ($order->detail[0]->discount>0)
                                                                
                                                        <span class="text-decoration-line-through">{{Rupiah($order->detail[0]->price)}}</span></span>
                                                        @endif
                                                        <span class="text text-secondary">{{Rupiah($order->detail[0]->price-$order->detail[0]->discount)}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="collapse" id="MoreItemNewOrder_0{{$key}}">
                                            @foreach ($order->detail as $key2=>$item)
                                                @if ($key2==0)
                                                    @php
                                                        continue;
                                                    @endphp
                                                @endif
                                                
    
                                                <div class="d-flex mb-1">
                                                    <div class="flex-shrink-0">
                                                        <div class="align-self-start me-2" style="width: 76px; height: 76px;">
                                                            <img src="{{ asset('storage/'.$item->product->picture_default) }}" alt="Foto Produk" class="img-thumbnail rounded-2" style="width: 76px; height: 76px;" >
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <div class="content ms-2 mb-4">
                                                            <div class="mb-2">
                                                                <span class="text text-secondary">{{$item->product->name}}</span>
                                                                <span class="text-secondary ms-2 me-2">-</span>
                                                                <span class="text text-secondary fw-bold">{{$item->product_varian_name}}</span>
                                                                <span class="mx-2">x</span>
                                                                <span class="text mb-2">{{$item->qty}}<br> 
                                                                @if ($item->discount>0)
                                                                    
                                                                        <span class="text-decoration-line-through text-secondary me-2">{{Rupiah($item->price)}}</span></span>
                                                                        <span class="text text-secondary">{{Rupiah($item->price_after_discount)}}</span>
                                                                    @else
                                                                        <span class="text text-secondary">{{Rupiah($item->price)}}</span></span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
    
                                                </div>
                                            @endforeach
                                        </div>

                                        <div class="content text-center rounded-4 mt-2 ms-2 me-2">
                                            @if (count($order->detail)> 1)
                                                <a href="#MoreItemNewOrder_0{{$key}}" class="text-decoration-none" id="btn-ch" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseExample">{{count($order->detail)-1}} Produk lainnya </a>
                                            @endif
                                        </div>

                                    </div>

                                    <div class="col-4" style="min-width: 438px ;">
                                        <div class="text mb-2">
                                            <P class="text-secondary fw-bold">Alamat</P>
                                            <span>{{$order->name}} ( <a href="" class="text-decoration-none fw-bold">{{$order->phone}}</a> )</span></br>
                                            <span>
                                                {{$order->address}}
                                            </span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <div class="col">
                                                <span class="text-secondary fw-bold">Status</span><br>
                                                <span class="content bg-secondary text-light ms-2 me-2">{{$order->detail[0]->product->order_type}} {{$order->detail[0]->product->order_period}} Hari</span>
                                            </div>
                                            <div class="col mt-1">
                                                <span class="text-secondary"><strong>Catatan</strong></span>
                                                <p class="fst-italic">{{$order->note}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--Amount Recap-->
                                
                                <div class="content bg-light rounded-2 ms-4 me-4">
                                    <div class="row py-1 mx-2">
                                        <div class="col-lg-4 col-sm-6">
                                            <span class="text text-secondary fs.6 me-2">Total</span>
                                            <h6 class="text text-secondary fs.6 fw-bold me-2">{{rupiah($order->price_total + $order->shipping_price)}}</h6>
                                        </div>
                                        <div class="col-lg-4 col-sm-6">
                                            <span class="text text-secondary fs.6 me-2">Pembayaran</span>
                                            <h6 class="text text-secondary fs.6 fw-bold me-2">{{rupiah($order->total_payment)}}</h6>
                                        </div>
                                        <div class="col-lg-4 col-sm-6">
                                            <span class="text text-secondary fs.6 me-2">Kurang Bayar</span>
                                            <h6 class="text text-secondary fs.6 fw-bold me-2">{{rupiah(($order->price_total + $order->shipping_price) - $order->total_payment )}} 
                                                <label for="status_pelunasan">{{($kurang_bayar <= 0 ? 'LUNAS' :'BELUM LUNAS') }}</label>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                                
                                <!--Button-->
                                <div class="content mt-2 me-3">
                                    <div class="row">
                                        <div class="col text-end me-2">
                                            <div class="col text-end me-2">
                                                <a  href="https://api.whatsapp.com/send/?phone={{$order->phone}}&text&type=phone_number&app_absent=0" target="_blank" class="btn btn-outline-info col col-sm-2">
                                                    <span class="text">Hubungi Pembeli</span>
                                                </a>
                                                {{-- @if ($kurang_bayar <= 0)  
                                                    <a href="#" onclick="confirmOrderToShip('{{$order->id}}','{{$order->order_no}}','{{$order->price_total  + $order->shipping_price}}','{{$order->total_payment}}')" class="btn btn-success col col-sm-2">
                                                        <span class="text">Dikirim</span>
                                                    </a>
                                                @else --}}
                                                    <a href="#" data-toggle="modal" data-target="#modalToShipping" onclick="modalPreOrderToShip('{{$order->id}}','{{$order->order_no}}','{{$order->price_total  + $order->shipping_price}}','{{$order->total_payment}}')" class="btn btn-success col col-sm-2">
                                                        <span class="text">Dikirim</span>
                                                    </a>
                                                {{-- @endif --}}
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
                        @foreach ($orders_shipping as $key=>$order)
                            <div class="border border-top-0 rounded-2 mb-2 pb-2">
                                
                                <!--Detail Order-->
                                <div class="card mb-2 bg-light">
                                    <div class="row">
                                        <div class="col-sm m-1">
                                            <span class="text text-secondary fw-bold me-2">Dalam Pengiriman</span>
                                            <span class="text text-secondary me-1">No. Order :</span>
                                                <a href="" class="text-decoration-none me-2">
                                                    <span class="text-success">{{$order->order_no}}</span> 
                                                </a>
                                            <span class="text-secondary me-2"><i class="fas fa-user me-2"></i>{{$order->name}}</span>
                                            <span class="text-secondary"><i class="fas fa-clock me-2"></i>{{date('d-M-Y H:i')}}</span>
                                        </div>
                                        <div class="col-sm-2 mt-1 me-2 text-end">
                                            <a href="" class="text-decoration-none text-secondary link-disable">
                                                {{-- <i class="fas fa-print me-1"></i><span class="text me-2">Cetak</span> --}}
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!--Detail item Order-->
                                <div class="row flex-nowrap overflow-auto mb-2 ms-1 me-1">
                                    <div class="col-6 border-end" style="min-width: 544px;">
                                        <div class="text">
                                            <P class="text-secondary fw-bold">Item Pesanan</P>
                                        </div>

                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <div class="align-self-start me-2" style="width: 76px; height: 76px;">
                                                    <img src="{{ asset('storage/'.$order->detail[0]->product->picture_default) }}" alt="Foto Produk" class="img-thumbnail rounded-2" style="width: 76px; height: 76px;" >
                                                </div>
                                            </div>
    
                                            <div class="flex-grow-1">
                                                <div class="content ms-2 mb-4">
                                                    <div class="mb-2">
                                                        <span class="text text-secondary">{{$order->detail[0]->product->name}}</span>
                                                        <span class="text-secondary ms-2 me-2">-</span>
                                                        <span class="text text-secondary fw-bold">{{$order->detail[0]->product_varian_name}}</span>
                                                        <span class="mx-2">x</span>
                                                        <span class="text mb-2">{{$order->detail[0]->qty}} <br>  
                                                        @if ($order->detail[0]->discount>0)
                                                                
                                                        <span class="text-decoration-line-through">{{Rupiah($order->detail[0]->price)}}</span></span>
                                                        @endif
                                                        <span class="text text-secondary">{{Rupiah($order->detail[0]->price-$order->detail[0]->discount)}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="collapse" id="MoreItemNewOrder_0{{$key}}">
                                            @foreach ($order->detail as $key2=>$item)
                                                @if ($key2==0)
                                                    @php
                                                        continue;
                                                    @endphp
                                                @endif
    
                                                <div class="d-flex mb-1">
                                                    <div class="flex-shrink-0">
                                                        <div class="align-self-start me-2" style="width: 76px; height: 76px;">
                                                            <img src="{{ asset('storage/'.$item->product->picture_default) }}" alt="Foto Produk" class="img-thumbnail rounded-2" style="width: 76px; height: 76px;" >
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <div class="content ms-2 mb-4">
                                                            <div class="mb-2">
                                                                <span class="text text-secondary">{{$item->product->name}}</span>
                                                                <span class="text-secondary ms-2 me-2">-</span>
                                                                <span class="text text-secondary fw-bold">{{$item->product_varian_name}}</span>
                                                                <span class="mx-2">x</span>
                                                                <span class="text mb-2">{{$item->qty}}<br> 
                                                                @if ($item->discount>0)
                                                                    
                                                                        <span class="text-decoration-line-through text-secondary me-2">{{Rupiah($item->price)}}</span></span>
                                                                        <span class="text text-secondary">{{Rupiah($item->price_after_discount)}}</span>
                                                                    @else
                                                                        <span class="text text-secondary">{{Rupiah($item->price)}}</span></span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
    
                                                </div>
                                            @endforeach
                                        </div>

                                        <div class="content text-center rounded-4 mt-2 ms-2 me-2">
                                            @if (count($order->detail)> 1)
                                                <a href="#MoreItemNewOrder_0{{$key}}" class="text-decoration-none" id="btn-ch" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseExample">{{count($order->detail)-1}} Produk lainnya </a>
                                            @endif
                                        </div>

                                    </div>

                                    <div class="col-4" style="min-width: 438px ;">
                                        <div class="text mb-2">
                                            <P class="text-secondary fw-bold">Alamat</P>
                                            <span>{{$order->name}} ( <a href="" class="text-decoration-none fw-bold">{{$order->phone}}</a> )</span></br>
                                            <span>
                                                {{$order->address}}
                                            </span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <div class="col">
                                                <span class="text-secondary fw-bold">Status</span><br>
                                                <span class="content bg-secondary text-light ms-2 me-2">{{$order->detail[0]->product->order_type}} {{$order->detail[0]->product->order_period}} Hari</span>
                                            </div>
                                            <div class="col mt-1">
                                                <span class="text-secondary"><strong>Catatan</strong></span>
                                                <p class="fst-italic">{{$order->note}}</p>
                                            </div>
                                        </div>

                                        @if (!empty($order->no_resi))
                                                
                                            <div class="d-flex justify-content-between mb-2">
                                                <div class="col mt-1">
                                                    <span class="text-secondary"><strong>No Resi</strong></span><br>
                                                    <span class="text me-2">{{$order->expedition->name}}</span>
                                                    <span class="text fw-bold">{{$order->no_resi}}</span>
                                                </div>
                                            </div>     
                                        @endif  

                                    </div>
                                </div>

                                <!--Amount Recap-->
                                <div class="content bg-light rounded-2 ms-4 me-4">
                                    <div class="row py-1 mx-2">
                                        <div class="col-lg-6 col-sm-6">
                                            <span class="text text-secondary fs.6 me-2">Total</span>
                                            <h6 class="text text-secondary fs.6 fw-bold me-2">{{rupiah($order->price_total + $order->shipping_price)}}</h6>
                                        </div>
                                        <div class="col-lg-6 col-sm-6">
                                            <span class="text text-secondary fs.6 me-2">Pembayaran</span>
                                            <h6 class="text text-secondary fs.6 fw-bold me-2">{{rupiah($order->total_payment)}}</h6>
                                        </div>
                                    </div>
                                </div>
                                
                                <!--Button-->
                                <div class="content mt-2 me-3">
                                    <div class="row">
                                        <div class="col text-end me-2">
                                            <div class="col text-end me-2">
                                                <a  href="https://api.whatsapp.com/send/?phone={{$order->phone}}&text&type=phone_number&app_absent=0" target="_blank" class="btn btn-outline-info col col-sm-2">
                                                    <span class="text">Hubungi Pembeli</span>
                                                </a>

                                                @if (empty($order->no_resi))
                                                
                                                    <a href="#" data-toggle="modal" data-target="#modalUpdateResi" onclick="modalUpdateResi('{{$order->id}}','{{$order->order_no}}','{{$order->no_resi}}')" class="btn btn-success col col-sm-2">
                                                        <span class="text">Update Resi</span>
                                                    </a>                                                     
                                                     
                                                @endif                                                        
                                                    
                                                    
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
                        @foreach ($orders_success as $key=>$order)
                            <div class="border border-top-0 rounded-2 mb-2 pb-2">
                                
                                <!--Detail Order-->
                                <div class="card mb-2 bg-light">
                                    <div class="row">
                                        <div class="col-sm m-1">
                                            <span class="text text-secondary fw-bold me-2">Dalam Pengiriman</span>
                                            <span class="text text-secondary me-1">No. Order :</span>
                                                <a href="" class="text-decoration-none me-2">
                                                    <span class="text-success">{{$order->order_no}}</span> 
                                                </a>
                                            <span class="text-secondary me-2"><i class="fas fa-user me-2"></i>{{$order->name}}</span>
                                            <span class="text-secondary"><i class="fas fa-clock me-2"></i>{{date('d-M-Y H:i')}}</span>
                                        </div>
                                        <div class="col-sm-2 mt-1 me-2 text-end">
                                            <a href="" class="text-decoration-none text-secondary link-disable">
                                                {{-- <i class="fas fa-print me-1"></i><span class="text me-2">Cetak</span> --}}
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!--Detail item Order-->
                                <div class="row flex-nowrap overflow-auto mb-2 ms-1 me-1">
                                    <div class="col-6 border-end" style="min-width: 544px;">
                                        <div class="text">
                                            <P class="text-secondary fw-bold">Item Pesanan</P>
                                        </div>

                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <div class="align-self-start me-2" style="width: 76px; height: 76px;">
                                                    <img src="{{ asset('storage/'.$order->detail[0]->product->picture_default) }}" alt="Foto Produk" class="img-thumbnail rounded-2" style="width: 76px; height: 76px;" >
                                                </div>
                                            </div>
    
                                            <div class="flex-grow-1">
                                                <div class="content ms-2 mb-4">
                                                    <div class="mb-2">
                                                        <span class="text text-secondary">{{$order->detail[0]->product->name}}</span>
                                                        <span class="text-secondary ms-2 me-2">-</span>
                                                        <span class="text text-secondary fw-bold">{{$order->detail[0]->product_varian_name}}</span>
                                                        <span class="mx-2">x</span>
                                                        <span class="text mb-2">{{$order->detail[0]->qty}} <br>  
                                                        @if ($order->detail[0]->discount>0)
                                                                
                                                        <span class="text-decoration-line-through">{{Rupiah($order->detail[0]->price)}}</span></span>
                                                        @endif
                                                        <span class="text text-secondary">{{Rupiah($order->detail[0]->price-$order->detail[0]->discount)}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="collapse" id="MoreItemNewOrder_0{{$key}}">
                                            @foreach ($order->detail as $key2=>$item)
                                                @if ($key2==0)
                                                    @php
                                                        continue;
                                                    @endphp
                                                @endif
    
                                                <div class="d-flex mb-1">
                                                    <div class="flex-shrink-0">
                                                        <div class="align-self-start me-2" style="width: 76px; height: 76px;">
                                                            <img src="{{ asset('storage/'.$item->product->picture_default) }}" alt="Foto Produk" class="img-thumbnail rounded-2" style="width: 76px; height: 76px;" >
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <div class="content ms-2 mb-4">
                                                            <div class="mb-2">
                                                                <span class="text text-secondary">{{$item->product->name}}</span>
                                                                <span class="text-secondary ms-2 me-2">-</span>
                                                                <span class="text text-secondary fw-bold">{{$item->product_varian_name}}</span>
                                                                <span class="mx-2">x</span>
                                                                <span class="text mb-2">{{$item->qty}}<br> 
                                                                @if ($item->discount>0)
                                                                    
                                                                        <span class="text-decoration-line-through text-secondary me-2">{{Rupiah($item->price)}}</span></span>
                                                                        <span class="text text-secondary">{{Rupiah($item->price_after_discount)}}</span>
                                                                    @else
                                                                        <span class="text text-secondary">{{Rupiah($item->price)}}</span></span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
    
                                                </div>
                                            @endforeach
                                        </div>

                                        <div class="content text-center rounded-4 mt-2 ms-2 me-2">
                                            @if (count($order->detail)> 1)
                                                <a href="#MoreItemNewOrder_0{{$key}}" class="text-decoration-none" id="btn-ch" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseExample">{{count($order->detail)-1}} Produk lainnya </a>
                                            @endif
                                        </div>

                                    </div>

                                    <div class="col-4" style="min-width: 438px ;">
                                        <div class="text mb-2">
                                            <P class="text-secondary fw-bold">Alamat</P>
                                            <span>{{$order->name}} ( <a href="" class="text-decoration-none fw-bold">{{$order->phone}}</a> )</span></br>
                                            <span>
                                                {{$order->address}}
                                            </span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <div class="col">
                                                <span class="text-secondary fw-bold">Status</span><br>
                                                <span class="content bg-secondary text-light ms-2 me-2">{{$order->detail[0]->product->order_type}} {{$order->detail[0]->product->order_period}} Hari</span>
                                            </div>
                                            <div class="col mt-1">
                                                <span class="text-secondary"><strong>Catatan</strong></span>
                                                <p class="fst-italic">{{$order->note}}</p>
                                            </div>
                                        </div>

                                        @if (!empty($order->no_resi))
                                                
                                            <div class="d-flex justify-content-between mb-2">
                                                <div class="col mt-1">
                                                    <span class="text-secondary"><strong>No Resi</strong></span><br>
                                                    <span class="text me-2">{{$order->expedition->name}}</span>
                                                    <span class="text fw-bold">{{$order->no_resi}}</span>
                                                </div>
                                            </div>     
                                        @endif  

                                    </div>
                                </div>

                                <!--Amount Recap-->
                                <div class="content bg-light rounded-2 ms-4 me-4">
                                    <div class="row py-1 mx-2">
                                        <div class="col-lg-6 col-sm-6">
                                            <span class="text text-secondary fs.6 me-2">Total</span>
                                            <h6 class="text text-secondary fs.6 fw-bold me-2">{{rupiah($order->price_total + $order->shipping_price)}}</h6>
                                        </div>
                                        <div class="col-lg-6 col-sm-6">
                                            <span class="text text-secondary fs.6 me-2">Pembayaran</span>
                                            <h6 class="text text-secondary fs.6 fw-bold me-2">{{rupiah($order->total_payment)}}</h6>
                                        </div>
                                    </div>
                                </div>
                                
                                <!--Button-->
                                <div class="content mt-2 me-3">
                                    <div class="row">
                                        <div class="col text-end me-2">
                                            <div class="col text-end me-2">
                                                
                                                <a href="#" data-toggle="modal" data-target="#modalFinishHistory" onclick="modalOrderFinishHis('{{$order->id}}','{{$order->order_no}}')" class="btn btn-outline-success col col-sm-2">
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
                        @foreach ($new_orders as $key=>$order)
                        @if (count($order->payment) === 0)
                            @php
                                continue;
                            @endphp
                        @endif
                        <div class="card">
                            <div class="card mb-2 bg-light">
                                <div class="row">
                                    <div class="col-sm m-1">
                                        <span class="text text-secondary fw-bold me-2">Pesanan Selesai</span>
                                        <span class="text text-secondary me-1">No. Order :</span>
                                            <a href="" class="text-decoration-none me-2">
                                                <span class="text-success">{{$order->order_no}}</span> 
                                            </a>
                                        <span class="text-secondary me-2"><i class="fas fa-user me-2"></i>{{$order->name}}</span>
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
                                            <img src="{{ asset('storage/'.$order->detail[0]->product->picture_default) }}" alt="Cinque Terre" class="img-thumbnail rounded-2" >
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
                                    
                                    <div class="collapse" id="MoreItemNewOrder_1{{$key}}">
                                        @foreach ($order->detail as $key=>$item)
                                            @if ($key==0)
                                                @php
                                                    continue;
                                                @endphp
                                            @endif
                                            <div class="content">
                                                <div class="card me-2" style="width: 80px;float: left;">
                                                    <img src="{{ asset('storage/'.$order->detail[0]->product->picture_default) }}" alt="Cinque Terre" class="img-thumbnail rounded-2" >
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
                                        <a href="#MoreItemNewOrder_1{{$key}}" class="text-decoration-none" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseExample">{{count($order->detail)}} Produk lainnya</a>
                                        @endif
                                    </div>
                                </div>
                                <div class="col" style="min-width: 300px ;">
                                    <div class="text mb-2">
                                        <P class="text-secondary fw-bold">Alamat</P>
                                        <span>{{$order->name}} ( <a href="" class="text-decoration-none fw-bold">{{$order->phone}}</a> )</span></br>
                                        <span>
                                            {{$order->address}}
                                        </span>
                                    </div>
                                    <div>
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
                    <!--End Panel Pesanan Batal-->

                    <!--Panel Pesanan belum bayar-->
                    <div id="OrderNotPaid" class="card tab-pane fade" role="tabpanel">
                        @foreach ($new_orders as $key=>$order)
                        {{-- {{$order->payment}} --}}
                        @if (count($order->payment) > 0)
                            @php
                                continue;
                            @endphp
                        @endif
                        <div class="border border-top-0 rounded-2 mb-2 pb-2">
                            <div class="card mb-2 bg-light">
                                <div class="row">
                                    <div class="col-sm m-1">
                                        <span class="text text-secondary fw-bold me-2">Pesanan Belum Dibayar</span>
                                        <span class="text text-secondary me-1">No. Order :</span>
                                            <a href="" class="text-decoration-none me-2">
                                                <span class="text-success">{{$order->order_no}}</span> 
                                            </a>
                                        <span class="text-secondary me-2"><i class="fas fa-user me-2"></i>{{$order->name}}</span>
                                        <span class="text-secondary"><i class="fas fa-clock me-2"></i>{{date('d-M-Y H:i')}}</span>
                                    </div>
                                    <div class="col-sm-2 mt-1 me-2 text-end">
                                        <a href="" class="text-decoration-none text-secondary">
                                            {{-- <i class="fas fa-print me-1"></i><span class="text me-2">Cetak</span> --}}
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!--Detail Item Order-->
                            <div class="row flex-nowrap overflow-auto mb-2 ms-1 me-1">
                                <div class="col-6 border-end" style="min-width: 544px;">
                                    <div class="text">
                                        <P class="text-secondary fw-bold">Item Pesanan</P>
                                    </div>
                                    
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <div class="align-self-start me-2" style="width: 76px; height: 76px;">
                                                <img src="{{ asset('storage/'.$order->detail[0]->product->picture_default) }}" alt="Foto Produk" class="img-thumbnail rounded-2" style="width: 76px; height: 76px;" >
                                            </div>
                                        </div>

                                        <div class="flex-grow-1">
                                            <div class="content ms-2 mb-4">
                                                <div class="mb-2">
                                                    <span class="text text-secondary">{{$order->detail[0]->product->name}}</span>
                                                    <span class="text-secondary ms-2 me-2">-</span>
                                                    <span class="text text-secondary fw-bold">{{$order->detail[0]->product_varian_name}}</span>
                                                    <span class="mx-2">x</span>
                                                    <span class="text mb-2">{{$item->qty}} <br>  
                                                    @if ($order->detail[0]->discount>0)
                                                            
                                                    <span class="text-decoration-line-through">{{Rupiah($order->detail[0]->price)}}</span></span>
                                                    @endif
                                                    <span class="text text-secondary">{{Rupiah($order->detail[0]->price-$order->detail[0]->discount)}}</span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    
                                    <div class="collapse" id="MoreItemNewOrder_0{{$key}}">
                                        @foreach ($order->detail as $key2=>$item)
                                            @if ($key2==0)
                                                @php
                                                    continue;
                                                @endphp
                                            @endif

                                            <div class="d-flex mb-1">
                                                <div class="flex-shrink-0">
                                                    <div class="align-self-start me-2" style="width: 76px; height: 76px;">
                                                        <img src="{{ asset('storage/'.$item->product->picture_default) }}" alt="Foto Produk" class="img-thumbnail rounded-2" style="width: 76px; height: 76px;" >
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="content ms-2 mb-4">
                                                        <div class="mb-2">
                                                            <span class="text text-secondary">{{$item->product->name}}</span>
                                                            <span class="text-secondary ms-2 me-2">-</span>
                                                            <span class="text text-secondary fw-bold">{{$item->product_varian_name}}</span>
                                                            <span class="mx-2">x</span>
                                                            <span class="text mb-2">{{$item->qty}}<br> 
                                                            @if ($item->discount>0)
                                                                
                                                                    <span class="text-decoration-line-through text-secondary me-2">{{Rupiah($item->price)}}</span></span>
                                                                    <span class="text text-secondary">{{Rupiah($item->price_after_discount)}}</span>
                                                                @else
                                                                    <span class="text text-secondary">{{Rupiah($item->price)}}</span></span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        @endforeach
                                    </div>
                                    
                                    <div class="content text-center rounded-4 mt-2 ms-2 me-2">
                                        @if (count($order->detail)> 1)
                                            <a href="#MoreItemNewOrder_0{{$key}}" class="text-decoration-none" id="btn-ch" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseExample">{{count($order->detail)-1}} Produk lainnya </a>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="col-4" style="min-width: 438px ;">
                                    <div class="text mb-2">
                                        <P class="text-secondary fw-bold">Alamat</P>
                                        <span>{{$order->name}} ( <a href="" class="text-decoration-none fw-bold">{{$order->phone}}</a> )</span><br>
                                        <span>
                                            {{$order->address}}
                                        </span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <div class="col">
                                            <span class="text-secondary fw-bold">Status</span><br>
                                            <span class="content bg-secondary text-light ms-2 me-2">{{$order->detail[0]->product->order_type}} {{$order->detail[0]->product->order_period}} Hari</span>
                                        </div>
                                        <div class="col mt-1">
                                            <span class="text-secondary"><strong>Catatan</strong></span>
                                            <p class="fst-italic">{{$order->note}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                            <!--Payment Recap-->
                            <div class="content bg-light rounded-2 ms-4 me-4">
                                <div class="row py-1 mx-2">
                                    <div class="col-lg-3 col-sm-6">
                                        <span class="text text-secondary fs.6 me-2">Pembelian </span>
                                        <h6 class="text text-secondary fs.6 fw-bold me-2">{{rupiah($order->price_total)}}</h6>
                                    </div>
                                    <div class="col-lg-3 col-sm-6">
                                        <span class="text text-secondary fs.6 me-2">Minimal Bayar (DP) </span>
                                        <h6 class="text text-secondary fs.6 fw-bold me-2">{{rupiah(($order->price_total * 50) / 100)}}</h6>
                                    </div>
                                    <div class="col-lg-3 col-sm-6">
                                        <span class="text text-secondary fs.6 me-2">Ongkos Kirim </span>
                                        <h6 class="text text-secondary fs.6 fw-bold me-2">{{rupiah($order->shipping_price)}}</h6>
                                    </div>
                                    <div class="col-lg-3 col-sm-6">
                                        <span class="text text-secondary fs.6 me-2">Total </span>
                                        <h6 class="text text-secondary fs.6 fw-bold me-2">{{rupiah($order->price_total + $order->shipping_price)}}</h6>
                                    </div>
                                </div>
                            </div>

                            <!--Button-->
                            <div class="content mt-2 me-3">
                                <div class="row">
                                    <div class="col text-end me-2">
                                        <a href="https://api.whatsapp.com/send/?phone={{$order->phone}}&text&type=phone_number&app_absent=0" target="_blank" class="btn btn-outline-success col-sm-auto">
                                            <span class="text">Hubungi Pembeli</span>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                        @endforeach
                    </div>
                    <!--End Panel Pesanan belum bayar-->

                    <!--Modal View Bukti Transfer-->
                    <div class="modal fade" id="modalEvidenceTrf" tabindex="-1" role="dialog" aria-labelledby="modalEvidenceTrf" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                          <div class="modal-content">
                            <div class="modal-header bg-primary text-light">
                              <h5 class="modal-title" id="modalUser">No Order <span class="span_order_no"></span></h5>
                              <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close" aria-hidden="true"></button>
                            </div>
                            <!-- Modal Body-->
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="container mt-3">
                                            <img src="assets/img/transfer/buktiTrf.jpg" alt="bukti transfer" id="img_bukti_transfer" class="img-fluid rounded-2 img" >
                                        </div> 
                                    </div>
                                    <div class="col-sm-auto mt-2">
                                        <div class="span">
                                            <span class="text">Total Pembelian</span>
                                            <h5 class="headingOne text-secondary"><span class="span_total_pembelian"></span></h5>
                                        </div>
                                        <div class="span">
                                            <span class="text">Minimal Bayar</span>
                                            <h5 class="headingOne text-secondary"><span class="span_total_minimal_bayar"></span></h5>
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
                                <input type="hidden" id="id_order_cancel" name="id_order_cancel">
                              <h5 class="modal-title" id="modalUser">No Order <span id="no_order_cancel"></span></h5>
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
                                <button type="button" class="btn btn-danger" onclick="cancelOrderSave()">Simpan</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    <!--End Modal Tolak Order-->

                    <!--Modal Confirm Order-->
                    <div class="modal fade" id="modalOrderConfirm" tabindex="-1" role="dialog" aria-labelledby="modalOrderConfirm" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                          <div class="modal-content">
                            <input type="hidden" id="id_order_confirm" name="id_order_confirm">
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
                                                <img src="#" id="img_bukti_transfer1" alt="bukti transfer" class="img-fluid rounded-2 " height="1000px">
                                            </div> 
                                        </div>
                                        <div class="col-sm-6 mt-2">
                                            <div class="span">
                                                <span class="text">Total Pembelian</span>
                                                <h5 class="headingOne text-secondary"><span id="total_pembelian"></span></h5>
                                            </div>
                                            <div class="span">
                                                <span class="text">Minimal Bayar</span>
                                                <h5 class="headingOne text-secondary"><input type="hidden" id="min_bayar_confirm_data"><span id="min_bayar_confirm"></span></h5>
                                            </div>
                                            <div class="form-group mt-2">
                                                <label for="inputPayment">Input Pembayaran</label>
                                                <div class="input-group mt-1">
                                                    <span class="input-group-text">Rp</span>
                                                    <input type="number" class="form-control" id="inputPaymentConfirm1" onchange="checkMinimumlPayment()" placeholder="Input Pembayaran">
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
                                <button type="button" class="btn btn-danger" onclick="confirmOrderSave()">Simpan</button>
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
                                <input type="hidden" id="id_order_to_ship" name="id_order_to_ship">
                              <h5 class="modal-title" id="modalToShipping">No Order <span class="span_order_no"></span></h5>
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
                                                <h5 class="headingOne text-secondary"><span class="span_total_pembelian"></span></h5>
                                            </div>
                                            <div class="span">
                                                <span class="text">Pembayaran Sebelumnya</span>
                                                <h5 class="headingOne text-secondary"><span class="span_total_bayar_sebelumnya"></span></h5>
                                            </div>
                                            <div class="form-group mt-2">
                                                <label for="inputPayment">Input Pembayaran</label>
                                                <div class="input-group mt-1">
                                                    <span class="input-group-text">Rp</span>
                                                    <input type="number" class="form-control" id="inputPayment2" placeholder="Input Pembayaran">
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
                                <button type="button" class="btn btn-danger" onclick="confirmToShipping()">Simpan</button>
                                {{-- <button type="button" class="btn btn-danger">Simpan</button> --}}
                            </div>
                          </div>
                        </div>
                    </div>
                    <!--End Modal Dikirim-->

                    <!--Modal Update Resi-->
                    <div class="modal fade" id="modalUpdateResi" tabindex="-1" role="dialog" aria-labelledby="modalUpdateResi" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                          <div class="modal-content">
                            <div class="modal-header bg-primary text-light">
                              <h5 class="modal-title" id="modalUpdateResi">No Order  <span class="span_order_no"></span></h5>
                              <input type="hidden" id="id_order_update_resi" name="id_order_update_resi">
                              <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close" aria-hidden="true"></button>
                            </div>
                            <!-- Modal Body-->
                            <div class="modal-body">
                                <form>
                                    <div class="row">
                                        <div class="col mt-2">
                                            <div class="form-group mt-2">
                                                <select name="expeditions_id" id="input_expedition_id" class="form-control col-12" placeholder='Pilih Kurir'>
                                                    <option value="" disabled selected>Pilih Kurir</option>
                                                    <option value="1">JNT</option>
                                                    <option value="2">JNE</option>
                                                </select>
                                            </div>
                                            <div class="form-group mt-2">
                                                <div class="mb-3">
                                                    <label for="inputResi" class="form-label">Nomor Resi</label>
                                                    <input type="text" class="form-control col-12" id="inputResi" placeholder="Nomor Resi">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!--Modal Footer-->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                                <button type="button" class="btn btn-danger" onclick="saveUpdateResi()">Simpan</button>
                            </div>
                          </div>
                        </div>
                    </div>
                    <!--End Modal Update Resi-->


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

                    <!--Modal Warning Min Payment-->
                    <div class="modal" id="modalNotMinPay">
                        <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            
                            <!--modal header-->
                            <div class="modal-header bg-danger text-light">
                                <h5 class="modal-title" id="modalNotifPict">Peringatan..!!</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" aria-hidden="true"></button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                            <h6>Nominal Minimal Pembayaran</h6>
                            <h6>Kurang dari Minimum Pembayaran</h6>
                            </div>
                            
                            <!-- Modal footer -->
                            <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Ok</button>
                            </div>
                            
                        </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <style>
        .img{
            cursor:zoom-in;
            cursor:-webkit-zoom-in;
            cursor:-moz-zoom-in;
            /* width:100px; */
        }
    </style>
    <script type="text/javascript">
            
        $('.img').click(function(){
            var s=$(this).attr('id');
            $('#'+s).animate({'width':'1000px'});
            $('#'+s).css({'cursor':'zoom-out'});
            if($('#'+previous).width()!=100)
            {
            $('#'+previous).animate({'width':'100px'});
            $('#'+previous).css({'cursor':'zoom-in'});
            }
            previous=s;
        });
        function modalTransfer(id,no_order,total_pembelian,total_payment,img) {
            // $('#id_order_confirm').val(id)
            $('.span_order_no').html(no_order)
            // $('#modalOrderConfirm').modal('show')
            $('.span_total_pembelian').html(formatRupiah(total_pembelian))
            $('.span_total_minimal_bayar').html(formatRupiah(total_payment))
            let min_bayar = parseInt(total_pembelian)*50/100;
            var src1 = 'storage/'+img;
            console.log(src1);
            $("#img_bukti_transfer").attr("src", src1);
            

            $('.span_total_minimal_bayar').html(formatRupiah(String(min_bayar),'Rp'))
        }
        function confirmOrder(id,no_order,total_pembelian,total_payment,img) {
            $('#id_order_confirm').val(id)
            $('#no_order_confirm').html(no_order)
            console.log(img);
            console.log(total_payment);
            // $('#modalOrderConfirm').modal('show')
            $('#total_pembelian').html(formatRupiah(total_pembelian))
            let min_bayar = parseInt(total_pembelian)*50/100;

            $('#min_bayar_confirm').html(formatRupiah(String(total_payment),'Rp'))
            $('#min_bayar_confirm_data').val(total_payment)

            var src1 = 'storage/'+img;
            // console.log(src1);
            $("#img_bukti_transfer1").attr("src", src1);
        }
        function confirmOrderReadyShipping(id) {
           
           $.ajax({
               url:`/order/${id}/push_status`,
               method: "POST",
               data : {
                   status : 5
               },
               success: function (data) {
                   // Swal.fire(
                   // 'Good Success!',
                   // 'Order has ben updated!!',
                   // 'success'
                   // )
                   swal({
                       title: "Success!",
                       text: "Order has ben updated!",
                       icon: "success",
                   });
                   setTimeout(() => {
                       
                       window.location.href = "/order";
                   }, 2000);
               },
           });
        }

        function confirmOrderToShip(id) {
            if (confirm('Apakah anda akan mengirim order ini?')) {
                
                $.ajax({
                   url:`/order/${id}/push_status`,
                   method: "POST",
                   data : {
                       status : 6
                   },
                   success: function (data) {
                       swal({
                           title: "Success!",
                           text: "Order has ben updated!",
                           icon: "success",
                       });
                       setTimeout(() => {
                           
                           window.location.href = "/order";
                       }, 2000);
                   },
               });
            }
           
        }
        function modalPreOrderToShip(id,no_order,total_pembelian,total_payment,img) {
            $('#id_order_to_ship').val(id)
            $('.span_order_no').html(no_order)
            // console.log(total_payment);
            // $('#modalOrderConfirm').modal('show')
            $('.span_total_pembelian').html(formatRupiah(total_pembelian))
            // $('.span_total_minimal_bayar').html(formatRupiah(total_payment))
            let min_bayar = parseInt(total_pembelian)*50/100;
            var src1 = 'storage/'+img;
            // console.log(src1);
            $("#img_bukti_transfer").attr("src", src1);
            

            $('.span_total_bayar_sebelumnya').html(formatRupiah(String(total_payment),'Rp'))
        }
        function modalUpdateResi(id,no_order,resi) {
            $('#id_order_update_resi').val(id)
            $('.span_order_no').html(no_order)
            $('#inputResi').val(resi)
        }
        function saveUpdateResi() {
                let id = $('#id_order_update_resi').val()
                let no_resi = $('#inputResi').val()
                let expedition_id = $('#input_expedition_id').val()
                $.ajax({
                   url:`/order/${id}/update_resi`,
                   method: "POST",
                   data : {
                    no_resi : no_resi,
                    expedition_id : expedition_id,
                   },
                   success: function (data) {
                       swal({
                           title: "Success!",
                           text: "Order has ben updated!",
                           icon: "success",
                       });
                       setTimeout(() => {
                           
                           window.location.href = "/order";
                       }, 2000);
                   },
               });
            
           
        }
        
        function checkMinimumlPayment() {
            // alert(123)
            let min_bayar = $('#min_bayar_confirm_data').val()
            let nominal_bayar = $('#inputPaymentConfirm1').val()
            if (parseInt(nominal_bayar) < parseInt(min_bayar)) {
                $('#modalNotMinPay').modal('show');
                // alert('Nominal Bayar kurang dari minimum bayar')
                $('#inputPaymentConfirm1').val(null)
                return;
                
            }
        }
        function confirmOrderSave() {
            let id = $('#id_order_confirm').val();
            let nominal_bayar = $('#inputPaymentConfirm1').val()
            $.ajax({
                url:`/order/${id}/push_status`,
                method: "POST",
                data : {
                    status : 2
                },
                success: function (data) {
                    // Swal.fire(
                    // 'Good Success!',
                    // 'Order has ben updated!!',
                    // 'success'
                    // )
                    updateTotalPayment(id,nominal_bayar)
                    swal({
                        title: "Success!",
                        text: "Order has ben updated!",
                        icon: "success",
                    });
                    setTimeout(() => {
                        
                        window.location.href = "/order";
                    }, 2000);
                },
            });
        }
        function confirmToShipping() {
            let id = $('#id_order_to_ship').val();
            let nominal_bayar = $('#inputPayment2').val()
            $.ajax({
                url:`/order/${id}/push_status`,
                method: "POST",
                data : {
                    status : 6
                },
                success: function (data) {
                    // Swal.fire(
                    // 'Good Success!',
                    // 'Order has ben updated!!',
                    // 'success'
                    // )
                    updateTotalPayment(id,nominal_bayar)
                    swal({
                        title: "Success!",
                        text: "Order has ben updated!",
                        icon: "success",
                    });
                    setTimeout(() => {
                        
                        window.location.href = "/order";
                    }, 2000);
                },
            });
        }
        
        function id_order_cancel(id,no_order) {
            $('#id_order_reject').val(id)
            $('#no_order_reject').html(no_order)
        }
        function cancelOrderSave() {
            let id = $('#id_order_cancel').val();
            let reason_cancel = $('#inputReasonReject').val();
           
            $.ajax({
               url:`/order/${id}/cancel`,
                method: "POST",
                data : {
                    reason_cancel : reason_cancel
                },
                success: function (data) {
                    // Swal.fire(
                    // 'Good Success!',
                    // 'Order has ben updated!!',
                    // 'success'
                    // )
                    swal({
                        title: "Success!",
                        text: "Order has ben cancel!",
                        icon: "success",
                    });
                    setTimeout(() => {
                        
                        window.location.href = "/order";
                    }, 2000);
                },
            });
        }
        function updateTotalPayment(id,total_payment) {
            $.ajax({
               url:`/order/${id}/update_payment`,
                method: "POST",
                data : {
                    total_payment : total_payment
                },
                success: function (data) {
                  
                    swal({
                        title: "Success!",
                        text: "Data Berhasil Disimpan",
                        icon: "success",
                    });
                    setTimeout(() => {
                        
                        window.location.href = "/order";
                    }, 2000);
                },
            });
        }
        function updateTotalPayment2(id,total_payment) {
            $.ajax({
               url:`/order/${id}/update_payment2`,
                method: "POST",
                data : {
                    total_payment : total_payment
                },
                success: function (data) {
                  
                    swal({
                        title: "Success!",
                        text: "Data Berhasil Disimpan",
                        icon: "success",
                    });
                    setTimeout(() => {
                        
                        window.location.href = "/order";
                    }, 2000);
                },
            });
        }

        
    </script>
</main>
@endsection
