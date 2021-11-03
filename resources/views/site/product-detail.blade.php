@extends('layouts.application')
@section('pagetitle', $data['title'])
@section('content')
<div class="container content">
        <div class="row mb-5">
            <div class="col-lg-12 col-md-12"> 
                <div class="row">
                    <div class="col-lg-5 px-5">
                        <div class = "productDetail-imgs">
                            <div class = "img-display">
                              <div id="img-container" class = "img-showcase">
                                <img src = "{{asset('storage/products/'.$data['productDetail']->design_image_path)}}" alt = "" width="100%">
                              
                              </div>
                            </div>
                            <div class = "img-select">
                            @foreach($data['anotherProductSize'] as $i=>$product)
                              <div class = "img-item">
                                <a href = "#" data-id = "{{$i+1}}">
                                  <img src = "{{asset('storage/products/'.$product->design_image_path)}}" alt = "shoe image" width="100%">
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
                                {{-- <h3 class="productDetail-detail-title">{{$data['productDetail']->productDetail_name}}</h3> --}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 d-flex">
                                <div class="mr-5 productDetail-detail-price-container">
                                    <span class="productDetail-detail-for-gender mr-2">MEN</span>
                                    {{-- <span class="productDetail-detail-productDetail-price">@currency($data['productDetail']->men_price)</span> --}}
                                </div>
                                <div class="productDetail-detail-price-container">
                                    <span class="productDetail-detail-for-gender mr-2">WOMAN</span>
                                    {{-- <span class="productDetail-detail-price">@currency($data['productDetail']->woman_price)</span> --}}
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3 mb-3">
                            <div class="col-lg-12 d-flex productDetail-detail-shop-buttons-container">
                                <div class="mb-3">
                                    <a href="{{$data['productDetail']->shopee_link}}" target="_blank" class="btn button-primary button-shop">Shop at Shopee</a>
                                </div>
                                <div>
                                    <a href="" target="_blank" class="btn button-secondary button-shop">Shop Via Whatsapp</a>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3 mb-3 productDetail-detail-description">
                            <div class="col-lg-12">
                                {!! $data['productDetail']->description!!}
                            </div>
                        </div>
                        <div class="row mt-3 mb-3">
                            <div class="col-lg-12">
                                <span class="productDetail-detail-sizechart-title">SIZE CHART</span>
                            </div>
                        </div>
                        <div class="row mt-3 mb-3">
                            <div class="col-lg-12">
                                <img class="productDetail-detail-sizechart-image" src="" />
                            </div>
                        </div>

                       
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
                    @php
                    $image = json_decode($relateItem->images, true);
                    @endphp
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card mb-3 productDetail-card-alt">
                        <img src="{{Voyager::image($image[0])}}" width="100px" class="card-img-top" alt="Story 1">
                        <div class="card-body">
                            <p class="card-text text-center productDetail-card-productDetail-title"><a href="{{url('site')}}/{{$relateItem->slug}}">{{$relateItem->productDetail_name}}</a></p>
                            <p class="card-text text-center productDetail-card-productDetail-price">@currency($relateItem->men_price)</p>
                        
                        </div>
                    </div>
                </div>
                
                @endforeach
            </div>
        </div>

    </section>

@endsection

@section('additionalJs')
<script src="{{asset('/assets/javascripts/productDetail-image.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/js-image-zoom/js-image-zoom.min.js"></script>
    

@endsection

@section('additionalCss')
<link rel="stylesheet" href="{{asset('/assets/css/productDetail-image.css')}}">

@endsection