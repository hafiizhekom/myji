@extends('layouts.application')
@section('pagetitle', $data['productDetail']->product->product_name."-".$data['productDetail']->product->color->color_name."-".$data['productDetail']->product->category->category_name)
@section('content')
<div class="container content">
        <div class="row mb-5">
            <div class="col-lg-12 col-md-12"> 
                <div class="row">
                    <div class="col-lg-5 px-5">
                        <div class = "productDetail-imgs">
                            <div class = "img-display">
                              <div id="img-container" class = "img-showcase">
                                    <a href="#" data-toggle="modal" data-target="#image-{{$data['productDetail']->id}}" >
                                        <img src = "{{asset('storage/products/'.$data['productDetail']->image_file)}}"  class="product-image-showcase" alt = "" width="100%">
                                    </a>
                              </div>
                            </div>
                            <div class = "img-select">
                            @foreach($data['anotherProductSize'] as $i=>$product)
                              <div class = "img-item">
                                <!-- <a href = "#" data-id = "{{$i+1}}" data-toggle="modal" data-target="#image-{{$product->id}}"> -->
                                <a href = "{{url('/site')}}/product/{{$product->id}}" data-id = "{{$i+1}}" >
                                  <img src = "{{asset('storage/products/'.$product->image_file)}}" class="product-image-gallery" width="100%">
                                </a>
                              </div>
                            @endforeach
                              
                            </div>
                        </div>
                        <div id="zoomedImg">

                        </div>
                    </div>

                    <div class="col-lg-7 px-5">
                        <div class="row">
                            <div class="col-lg-12">
                                <h3 class="productDetail-detail-title">{{$data['productDetail']->product->product_name}} - {{$data['productDetail']->product->color->color_name}} - {{$data['productDetail']->product->category->category_name}} </h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 mb-2 d-flex">
                                <div class="mr-5 productDetail-detail-price-container" style="font-weight:bold;font-size:20px;">
                                    @php
                                        $promoTotal = 0;
                                    @endphp
                                    @foreach($data['promoDetail'] as $promoDetail)
                                        @php
                                            if($promoDetail->promo->fixed_amount){
                                                $promoTotal = $promoTotal + $promoDetail->promo->fixed_amount;
                                            }
                                            
                                            $promoTotal = $promoTotal + ( $data['productDetail']->price * $promoDetail->promo->percentage_amount /100 );
                                        @endphp
                                    @endforeach
                                    @if($promoTotal != 0 )
                                        <strike>{{rupiah($data['productDetail']->price)}}</strike> {{rupiah($data['productDetail']->price - $promoTotal)}} 
                                    @else
                                        {{rupiah($data['productDetail']->price)}}
                                    @endif
                                    <!-- <span class="productDetail-detail-for-gender mr-2">MEN</span>
                                    <span class="productDetail-detail-productDetail-price"></span> -->
                                </div>
                                <!-- <div class="productDetail-detail-price-container">
                                     <span class="productDetail-detail-for-gender mr-2">WOMEN</span>
                                    <span class="productDetail-detail-productDetail-price"></span>
                                </div> -->
                            </div>
                            <div class="col-lg-12 mb-2 d-flex">
                                <div class="mr-5 productDetail-detail-price-container">
                                    <span class="label-bold mr-2">Size</span>
                                    <span class="productDetail-detail-productDetail-price">{{$data['productDetail']->size->size_name}}</span>
                                </div>
                                <!-- <div class="productDetail-detail-price-container">
                                     <span class="productDetail-detail-for-gender mr-2">WOMEN</span>
                                    <span class="productDetail-detail-productDetail-price"></span>
                                </div> -->
                            </div>
                            <div class="col-lg-12 mb-2 d-flex">
                                <div class="mr-5 productDetail-detail-price-container">
                                    <span class="label-bold mr-2">Stock</span>
                                    <span class="productDetail-detail-productDetail-price">{{$data['stock']}} 
                                    @if(!$data['stock'])
                                        <span class="badge badge-secondary">Out of Stock</span>
                                    @else
                                        @if($data['stock']<= 10)
                                            <span class="badge badge-warning">Low Stock</span>
                                        @endif
                                    @endif
                                        
                                    
                                    </span>
                                    </h1>
                                    
                                    
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mt-3 mb-3">
                            <div class="col-lg-12">
                                <div class="productDetail-detail-price-container">
                                    <span class="label-bold mr-2">Description</span>
                                    <span class="productDetail-detail-productDetail-price">
                                        {!!$data['productDetail']->product->description!!}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3 mb-3">
                            <div class="col-lg-12 d-flex productDetail-detail-shop-buttons-container">
                                <div class="mb-3">
                                    <a href="{{url(env('SHOPEE_LINK')).$data['productDetail']->shopee_link}}" target="_blank" class="btn button-primary button-shop">Shop at Shopee</a>
                                </div>
                                <div>
                                    <a href="{{url(env('WHATSAPP_LINK')).$data['productDetail']->shopee_link}}" target="_blank" class="btn button-secondary button-shop">Shop Via Whatsapp</a>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3 mb-3 productDetail-detail-description">
                            <div class="col-lg-12">
                                {!! $data['productDetail']->description!!}
                            </div>
                        </div>

                        <div class="row mt-3 mb-3 productDetail-detail-description">
                            <div class="col-lg-12 mb-2">
                                <div class="d-flex">
                                    @foreach($data['anotherProductSize'] as $detail)
                                    
                                        
                                        @if($detail->stock)
                                            <div>
                                            <a class="btn btn-info btn-xs ml-1 mr-1" href="{{url('/site')}}/product/{{$detail->id}}">{{$detail->size->size_name}}</a>
                                            
                                            @if($detail->stock<=10)
                                                <span class="badge badge-warning">Low Stock</span>
                                            @endif
                                            </div>
                                        @else
                                            <div>
                                            <a class="btn btn-secondary btn-xs ml-1 mr-1" disabled>{{$detail->size->size_name}}</a>
                                            </div>
                                        @endif
                                        
                                    
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @if($data['productDetail']->product->chart_size_image)
                            <div class="row mt-3 mb-3">
                                <div class="col-lg-12">
                                    <span class="productDetail-detail-sizechart-title">SIZE CHART</span>
                                </div>
                            </div>
                            <div class="row mt-3 mb-3">
                                <div class="col-lg-12">
                                    <img class="productDetail-detail-sizechart-image" src="{{asset('storage/charts/'. $data['productDetail']->product->chart_size_image)}}" />
                                </div>
                            </div>
                        @endif
                       
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-6">
                <a class="pagination-productDetail float-left" href="{{url('/site/catalogue')}}">
                    <img class="" src="{{asset('assets/images/arrow-l.svg')}}"/>
                    All Product
                </a>
            </div>
            
        </div>
        
    </div>

    <section id="may-also-like" class="">
        <div class="container border-top-orange may-also-like-body">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="text-center">You May Also Like</h1>
                </div>
            </div>
            <div class="row">

                @foreach($data['relateProducts'] as $i=>$relateItem)
                <div class="col-md-3 col-sm-6 mb-4">
                    <!-- <div class="card mb-3 productDetail-card-alt"> -->
                    <a href="{{url('site')}}/{{$relateItem->slug}}" class="link-non-underline">
                    <div class="card mb-3 product-card-alt">
                        <img src="{{asset('storage/products/'.$relateItem->detail->image_file)}}" width="100px" class="card-img-top product-image-250" alt="Story 1">
                        <div class="card-body">
                            <p class="card-text text-center productDetail-card-productDetail-title">{{$relateItem->product_name}}</a></p>
                            <p class="card-text text-center productDetail-card-productDetail-price">{{rupiah($relateItem->price)}}</p>
                        
                        </div>
                    </div>
                    </a>
                </div>
                
                @endforeach
            </div>
        </div>

    </section>

    <!-- @foreach($data['anotherProductSize'] as $i=>$product)
        <div class="modal fade" id="image-{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <img src="{{asset('storage/products/'.$product->image_file)}}" width="100%">
            </div>
        </div>
    @endforeach -->

    <div class="modal fade" id="image-{{$data['productDetail']->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <img src="{{asset('storage/products/'.$data['productDetail']->image_file)}}" width="100%">
        </div>
    </div>

@endsection

@section('additionalJs')
<script src="{{asset('/assets/javascripts/productDetail-image.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/js-image-zoom/js-image-zoom.min.js"></script>
    
<script>
    $( document ).ready(function() {
        var showcase =  $('.product-image-showcase').attr('src');
        $( ".product-image-gallery" ).hover(
            function(e) {
                if(e.type == "mouseenter") {
                    console.log("over");
                    $('.product-image-showcase').attr('src', $(this).attr('src'));
                }
                else if (e.type == "mouseleave") {
                    console.log(showcase);
                    $('.product-image-showcase').attr('src', showcase);
                }
            }
        );
    });
</script>
@endsection

@section('additionalCss')
<link rel="stylesheet" href="{{asset('/assets/css/productDetail-image.css')}}">

@endsection