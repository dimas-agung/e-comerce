
@extends('layouts.admin')

@section('content')

    <div class="container-fluid px-4">
        <div class="row">
            <div class="col mt-4">
                <h3>Landing Page</h3>
            </div>
        </div>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Landing Page</li>
        </ol>

        <div>
            <!--Carousel-->
            @include('admin.carousel.index',['carousel'=>$carousel,'products'=>$products])
        </div>
        
        <div>
             <!--Best Seller-->

            @include('admin.product_best_seller.index',['product_best_seller' =>$product_best_seller,'products'=>$products])
        </div>

        <div>
            <!--Promo Series / Kategory-->
            @include('admin.series.index',['series'=>$series,'products'=>$products])
           
       </div>
       
        
    </div>

@endsection

