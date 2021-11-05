@extends('layouts.application')
@section('pagetitle', 'Catalogue')
@section('content')
<div class="container content">
        <div class="row">
{{-- 
            <div class="col-12 d-lg-none mb-3">
                <button class="btn" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    Filter
                </button>

                <div class="collapse" id="collapseExample">
                    <div class="card card-body bg-transparent border-0">
                        <div class="sidebar-item mb-4">
                            <div class="row mb-3">
                                <div class="col-12">
                                    <h3 class="sidebar-content-title">Category</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <ul class="sidebar-content-list">

                                    @foreach($data['category'] as $i=>$c)
                                        <li><a href="{{route('catalogue', ['vol'=>$v->category_code])}}">{{$c->category_name}}</a></li>
                                    @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-item mb-4">
                            <div class="row mb-3">
                                <div class="col-12">
                                    <h3 class="sidebar-content-title">Color</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <ul class="sidebar-content-list">
                                    @foreach($data['colors'] as $i=>$c)

                                        <li><a href="{{route('catalogue', ['color'=>$c->color_code])}}">{{$c->color_name}}</a></li>
                                    @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div> --}}

            <div class="col-lg-3 d-none d-lg-block sidebar">
                <div class="sidebar-item mb-4">
                    <div class="row mb-3">
                        <div class="col-12">
                            <h3 class="sidebar-content-title">Category</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <ul class="sidebar-content-list">

                                @foreach($data['category'] as $i=>$v)

                                    <li><a href="{{route('catalogue', ['vol'=>$v->category_code])}}">{{$v->category_name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="sidebar-item mb-4">
                    <div class="row mb-3">
                        <div class="col-12">
                            <h3 class="sidebar-content-title">Color</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <ul class="sidebar-content-list">
                            @foreach($data['color'] as $i=>$c)

                                <li><a href="{{route('catalogue', ['color'=>$c->color_code])}}">{{$c->color_name}}</a></li>
                            @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="sidebar-item mb-4">
                    <div class="row mb-3">
                        <div class="col-12">
                            <h3 class="sidebar-content-title">Size</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <ul class="sidebar-content-list">
                            @foreach($data['size'] as $i=>$s)

                                <li><a href="{{route('catalogue', ['size'=>$c->size_code])}}">{{$s->size_name}}</a></li>
                            @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-9 col-md-12">
                <div class="row">

                @foreach($data['product_detail'] as $i=>$item)
                    @php
                    $images = json_decode($item->images, true);
                    @endphp

                    <div class="col-6 col-md-3 mb-4">
                        <div class="card mb-3 product-card-alt">
                            <img src="{{asset('storage/products/'.$item->design_image_path)}}" width="100px" class="card-img-top" alt="{{$item->product_name}}">
                            <div class="card-body">
                                <a href="{{url('/site')}}/product/{{$item->id}}">
                                    <p class="card-text text-center product-card-product-title">{{$item->product->product_name}} {{$item->product->detail->color->color_name}} {{$item->product->detail->size->size_name}} {{$item->product->detail->category->category_name}}</p>
                                </a>
                                <p class="card-text text-center product-card-product-price">{{rupiah($item->price)}}</p>
                            
                            </div>
                        </div>
                    </div>
                @endforeach
                    
                    
                </div>
                <!-- Pagination -->

        {{$data['product_detail']->links()}}

                <!-- End Pagination -->
            </div>
        </div>
        
    </div>

@endsection