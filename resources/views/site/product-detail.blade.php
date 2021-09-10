@extends('layouts.application')
{{-- @section('pagetitle', $data['title']) --}}
@section('content')
<div class="container content">
        <div class="row mb-5">
            <div class="col-lg-12 col-md-12">
                <div class="row">
                    <div class="col-lg-5 px-5">
                        <div class = "product-imgs">
                            <div class = "img-display">
                              <div id="img-container" class = "img-showcase">
                                {{-- @php
                                $images = json_decode($data['product']->images, true);
                                @endphp

                                @foreach($images as $i=>$img)
                                <img src = "{{Voyager::image($img)}}" alt = "{{$data['product']->slug}}-image-{{$i}}">
                                @endforeach --}}
                              
                              </div>
                            </div>
                            <div class = "img-select">
                            @foreach($images as $i=>$img)
                              <div class = "img-item">
                                <a href = "#" data-id = "{{$i+1}}">
                                  <img src = "{{Voyager::image($img)}}" alt = "shoe image">
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
                                {{-- <h3 class="product-detail-title">{{$data['product']->product_name}}</h3> --}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 d-flex">
                                <div class="mr-5 product-detail-price-container">
                                    <span class="product-detail-for-gender mr-2">MEN</span>
                                    {{-- <span class="product-detail-product-price">@currency($data['product']->men_price)</span> --}}
                                </div>
                                <div class="product-detail-price-container">
                                    <span class="product-detail-for-gender mr-2">WOMAN</span>
                                    {{-- <span class="product-detail-price">@currency($data['product']->woman_price)</span> --}}
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3 mb-3">
                            <div class="col-lg-12 d-flex product-detail-shop-buttons-container">
                                <div class="mb-3">
                                    <a href="{{$data['product']->shopee_link}}" target="_blank" class="btn button-primary button-shop">Shop at Shopee</a>
                                </div>
                                <div>
                                    <a href="https://wa.me/{{setting('front-site.whatsapp_number')
}}/?text={{urlencode(setting('front-site.whatsapp_template')
)}}{{urlencode($data['product']->product_name)}}" target="_blank" class="btn button-secondary button-shop">Shop Via Whatsapp</a>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3 mb-3 product-detail-description">
                            <div class="col-lg-12">
                                {!! $data['product']->description!!}
                            </div>
                        </div>
                        <div class="row mt-3 mb-3">
                            <div class="col-lg-12">
                                <span class="product-detail-sizechart-title">SIZE CHART</span>
                            </div>
                        </div>
                        <div class="row mt-3 mb-3">
                            <div class="col-lg-12">
                                <img class="product-detail-sizechart-image" src="{{Voyager::image($data['sizechart']->size_chart_image)}}" />
                            </div>
                        </div>

                       
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-6">
                <a class="pagination-product float-left" href="{{url('/site/catalogue')}}">
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
                    <div class="card mb-3 product-card-alt">
                        <img src="{{Voyager::image($image[0])}}" width="100px" class="card-img-top" alt="Story 1">
                        <div class="card-body">
                            <p class="card-text text-center product-card-product-title"><a href="{{url('site')}}/{{$relateItem->slug}}">{{$relateItem->product_name}}</a></p>
                            <p class="card-text text-center product-card-product-price">@currency($relateItem->men_price)</p>
                        
                        </div>
                    </div>
                </div>
                
                @endforeach
            </div>
        </div>

    </section>

@endsection

@section('additionalJs')
<script src="{{asset('/assets/javascripts/product-image.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/js-image-zoom/js-image-zoom.min.js"></script>
    

@endsection

@section('additionalCss')
<link rel="stylesheet" href="{{asset('/assets/css/product-image.css')}}">

@endsection