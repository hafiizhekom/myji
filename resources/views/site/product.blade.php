@extends('layouts.application')
@section('pagetitle', $data['product']->product_name."-".$data['product']->color->color_name."-".$data['product']->category->category_name)
@section('content')
<div class="container content">
        <div class="row mb-5">
            <div class="col-lg-12 col-md-12"> 
                <div class="row">
                    <div class="col-lg-5 col-12 px-5">
                        <div class = "productDetail-imgs">
                            <div class = "img-display">
                              <div id="img-container" class = "img-showcase">
                                    <a href="#" data-toggle="modal" data-target="#image-{{$data['product']->detail[0]->id}}" >
                                        <img src = "{{asset('storage/products/'.$data['product']->detail[0]->image_file)}}"  class="product-image-showcase" alt = "" width="100%">
                                    </a>
                              </div>
                            </div>
                            <div class = "img-select">
                            @foreach($data['product']->detail as $i=>$productDetail)
                              <div class = "img-item">
                                <a href = "#" data-id = "{{$i+1}}" >
                                  <img src = "{{asset('storage/products/'.$productDetail->image_file)}}" class="product-image-gallery btn-size-image" id="image-{{$productDetail->size->size_code}}" width="100%" data-code="{{$productDetail->size->size_code}}">
                                </a>
                              </div>
                            @endforeach
                              
                            </div>
                        </div>
                        <div id="zoomedImg">

                        </div>
                    </div>

                    <div class="col-lg-7 col-12 px-5">
                        <div class="row">
                            <div class="col-lg-12">
                                <h3 class="productDetail-detail-title">{{$data['product']->product_name}} - {{$data['product']->color->color_name}} - {{$data['product']->category->category_name}} </h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 mb-2 d-flex">
                                <div class="mr-5 productDetail-detail-price-container" style="font-weight:bold;font-size:20px;">
                                    @foreach($data['product']->detail as $key=>$value)
                                        <span id="price-{{$value->size->size_code}}" class="dinamic-element" style="display:none;">
                                        @php
                                            $promoTotal = 0;
                                        @endphp
                                        
                                        @foreach($data['promoDetail'] as $promoDetail)
                                            @php
                                                if($promoDetail->promo->fixed_amount){
                                                    $promoTotal = $promoTotal + $promoDetail->promo->fixed_amount;
                                                }
                                                
                                                $promoTotal = $promoTotal + ( $value->price * $promoDetail->promo->percentage_amount /100 );
                                            @endphp
                                        @endforeach

                                        @if($promoTotal != 0 )
                                            <strike>{{rupiah($value->price)}}</strike> {{rupiah($value->price - $promoTotal)}} 
                                        @else
                                            {{rupiah($value->price)}}
                                        @endif
                                        </span>
                                    @endforeach
                                   
                                    <!-- <span class="productDetail-detail-for-gender mr-2">MEN</span>
                                    <span class="productDetail-detail-productDetail-price"></span> -->
                                </div>
                                <!-- <div class="productDetail-detail-price-container">
                                     <span class="productDetail-detail-for-gender mr-2">WOMEN</span>
                                    <span class="productDetail-detail-productDetail-price"></span>
                                </div> -->
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 mb-2 d-flex">
                                <div class="mr-5 productDetail-detail-price-container">
                                    <span class="label-bold mr-2">Size</span>
                                    @foreach($data['product']->detail as $key=>$value)
                                        <span class="productDetail-detail productDetail-price dinamic-element" id="size-{{$value->size->size_code}}" style="display:none;">{{$value->size->size_name}}</span>
                                    @endforeach
                                </div>
                                <!-- <div class="productDetail-detail-price-container">
                                     <span class="productDetail-detail-for-gender mr-2">WOMEN</span>
                                    <span class="productDetail-detail-productDetail-price"></span>
                                </div> -->
                            </div>
                            <div class="col-lg-12 mb-2 d-flex">
                                <div class="mr-5 productDetail-detail-price-container d-flex">
                                    <div class="label">
                                        <span class="label-bold mr-2">Stock</span>
                                    </div>
                                    @foreach($data['product']->detail as $key=>$value)
                                        <div class="productDetail-detail productDetail-stock dinamic-element" id="stock-{{$value->size->size_code}}" style="display:none;">
                                            @if($value->stock<=0)
                                                <span class="badge badge-secondary">Out of Stock</span>
                                            @else
                                                <span class="productDetail-detail-productDetail-price">{{$value->stock}} 
                                                @if($value->stock<= 10)
                                                    <span class="badge badge-warning">Low Stock</span>
                                                @endif
                                            @endif
                                        </div>
                                    @endforeach
                                        
                                    
                                    </span>
                                    </h1>
                                    
                                    
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3 mb-3 productDetail-detail-btn-size">
                            <div class="col-lg-12 mb-2">
                                <div class="d-flex flex-size-container">
                                    @foreach($data['product']->detail as $detail)
                                    
                                            <div>
                                        @if($detail->stock>0)
                                            
                                                <a class="btn btn-info btn-xs ml-2 mr-2 btn-size" id="btn-size-{{$detail->size->size_code}}" data-code="{{$detail->size->size_code}}" href="#">
                                                    @if($detail->stock<=10)
                                                        <span class="badge badge-warning bad-" style="position:absolute;margin-top:35px;margin-left:-30px;">Low Stock</span>
                                                    @endif
                                                    {{$detail->size->size_name}}
                                                </a>
                                            
                                            
                                        @else
                                            
                                            <a class="btn btn-secondary btn-xs ml-2 mr-2" disabled> <span class="badge badge-light" style="position:absolute;margin-top:35px;margin-left:-30px;">Out of Stock</span> {{$detail->size->size_name}} </a>

                                        @endif
                                            </div>
                                    
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        
                        @foreach($data['product']->detail as $key=>$value)
                            <div class="row mt-3 mb-3 dinamic-element" id="shop-{{$value->size->size_code}}" style="display:none;">
                                <div class="col-lg-12 d-flex productDetail-detail-shop-buttons-container">
                                    <div class="mb-3">
                                        <a href="{{url(env('SHOPEE_LINK')).$value->shopee_link}}" target="_blank" class="btn button-primary button-shop">Shop at Shopee</a>
                                    </div>
                                    <div>
                                        <a href="{{url(env('WHATSAPP_LINK')).$value->shopee_link}}" target="_blank" class="btn button-secondary button-shop">Shop Via Whatsapp</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="row mt-3 mb-3">
                            <div class="col-lg-12">
                                <div class="productDetail-detail-price-container">
                                    <span class="productDetail-detail-productDetail-price">
                                        {!!$data['product']->description!!}
                                    </span>
                                </div>
                            </div>
                        </div>

                        @if($data['product']->chart_size_image)
                            <div class="row mt-5 mb-3">
                                <div class="col-lg-12">
                                    <span class="productDetail-detail-sizechart-title">SIZE CHART</span>
                                </div>
                            </div>
                            <div class="row mt-3 mb-3">
                                <div class="col-lg-12">
                                    <img class="productDetail-detail-sizechart-image" src="{{asset('storage/charts/'. $data['product']->chart_size_image)}}" />
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
                        <img src="{{asset('storage/products/'.$relateItem->detail[0]->image_file)}}" width="100px" class="card-img-top product-image-250" alt="Story 1">
                        <div class="card-body">
                            <p class="card-text text-center productDetail-card-productDetail-title">{{$relateItem->product_name}}</a></p>
                            <p class="card-text text-center productDetail-card-productDetail-price">{{rupiah($relateItem->detail[0]->price)}}</p>
                        
                        </div>
                    </div>
                    </a>
                </div>
                
                @endforeach
            </div>
        </div>

    </section>


    <div class="modal fade" id="image-{{$data['product']->detail[0]->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <img src="{{asset('storage/products/'.$data['product']->detail[0]->image_file)}}" width="100%">
        </div>
    </div>

@endsection

@section('additionalJs')
<script src="{{asset('/assets/javascripts/productDetail-image.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/js-image-zoom/js-image-zoom.min.js"></script>
    
<script>
    $( document ).ready(function() {
        var sizeDefault = "{{$data['product']->detail[0]->size->size_code}}";
        $(".dinamic-element").hide();
        $("#price-"+sizeDefault).show();
        $("#stock-"+sizeDefault).show();
        $("#shop-"+sizeDefault).show();
        $("#size-"+sizeDefault).show();

        $( ".btn-size" ).removeClass('btn-secondary');
        $( ".btn-size" ).addClass('btn-info');
        $("#btn-size-"+sizeDefault).removeClass('btn-info');
        $("#btn-size-"+sizeDefault).addClass('btn-secondary');

        var showcase =  $('.product-image-showcase').attr('src');
        
        $( ".product-image-gallery" ).click(
            function(e) {
                $('.product-image-showcase').attr('src', $(this).attr('src'));
                // if(e.type == "mouseenter") {
                //     console.log("over");
                //     $('.product-image-showcase').attr('src', $(this).attr('src'));
                // }
                // else if (e.type == "mouseleave") {
                //     console.log(showcase);
                //     $('.product-image-showcase').attr('src', showcase);
                // }
            }
        );
    });

    $( ".btn-size" ).click(function() {
        $(".dinamic-element").hide();
        $("#price-"+$(this).data("code")).show();
        $("#stock-"+$(this).data("code")).show();
        $("#shop-"+$(this).data("code")).show();
        $("#size-"+$(this).data("code")).show();

        $( ".btn-size" ).removeClass('btn-secondary');
        $( ".btn-size" ).addClass('btn-info');
        $("#btn-size-"+$(this).data("code")).removeClass('btn-info');
        $("#btn-size-"+$(this).data("code")).addClass('btn-secondary');

        var imageSrc = $("#image-"+$(this).data("code")).attr('src');
        console.log(imageSrc);
        $('.product-image-showcase').attr('src', imageSrc);
    });
    
    $( ".btn-size-image" ).click(function() {
        $(".dinamic-element").hide();
        $("#price-"+$(this).data("code")).show();
        $("#stock-"+$(this).data("code")).show();
        $("#shop-"+$(this).data("code")).show();
        $("#size-"+$(this).data("code")).show();

        $( ".btn-size" ).removeClass('btn-secondary');
        $( ".btn-size" ).addClass('btn-info');
        $("#btn-size-"+$(this).data("code")).removeClass('btn-info');
        $("#btn-size-"+$(this).data("code")).addClass('btn-secondary');
        
    });
</script>
@endsection

@section('additionalCss')
<link rel="stylesheet" href="{{asset('/assets/css/productDetail-image.css')}}">

@endsection