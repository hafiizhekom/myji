@extends('layouts.application')
@section('pagetitle', 'Catalogue')
@section('content')
<div class="container content">
        <div class="row">

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
                                @if(app('request')->input('color'))
                                    <li><a href="{{route('shop.catalogue', ['color'=>app('request')->input('color')])}}">All</a></li>
                                @else
                                    <li><a href="{{route('shop.catalogue')}}">All</a></li>
                                @endif

                                @foreach($data['category'] as $i=>$v)
                                    @if(app('request')->input('color'))
                                        <li><a href="{{route('shop.catalogue', ['category'=>$v->category_code, 'color'=>app('request')->input('color')])}}">{{$v->category_name}}</a></li>
                                    @else
                                        <li><a href="{{route('shop.catalogue', ['category'=>$v->category_code])}}">{{$v->category_name}}</a></li>
                                    @endif
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
                            @if(app('request')->input('category'))
                                <li><a href="{{route('shop.catalogue', ['category'=>app('request')->input('category')])}}">All</a></li>
                            @else
                                <li><a href="{{route('shop.catalogue')}}">All</a></li>
                            @endif

                            @foreach($data['color'] as $i=>$c)
                                <li>
                                    <i class="nav-icon fas fa-square-full" style="color:{{$c->color_hex}};"></i>
                                    @if(app('request')->input('category'))
                                        <a href="{{route('shop.catalogue', ['color'=>$c->color_code, 'category'=>app('request')->input('category')])}}">{{$c->color_name}}</a>
                                    @else
                                        <a href="{{route('shop.catalogue', ['color'=>$c->color_code])}}">{{$c->color_name}}</a>
                                    @endif
                                </li>
                            @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-9 col-md-12">
                <div class="row">

                @foreach($data['product'] as $i=>$item)
                    @php
                        $promoTotal = 0;
                    @endphp
                    @if($item->detail)

                        @foreach($item->detail->promoDetail as $promoDetail)
                            @php
                                if($promoDetail->promo->fixed_amount){
                                    $promoTotal = $promoTotal + $promoDetail->promo->fixed_amount;
                                }
                                
                                $promoTotal = $promoTotal + ( $item->detail->price * $promoDetail->promo->percentage_amount /100 );
                            @endphp
                        @endforeach
                    @endif

                    <div class="col-sm-6 col-xs-12 col-md-4 col-lg-4 mb-4">
                        <a href="{{url('/site')}}/product/{{$item->detail->id}}" class="link-non-underline">
                        <div class="card mb-3 product-card-alt">
                            @if(isset($item->detail->productDetailImage[0]->file))
                                <img src="{{asset('storage/products/'.$item->detail->productDetailImage[0]->file)}}" width="100px" class="card-img-top product-image-250" alt="{{$item->product_name}}">
                            @endif
                            <div class="card-body">
                                
                                    <p class="card-text text-center product-card-product-title">{{$item->product_name}} {{$item->color->color_name}} {{$item->category->category_name}}</p>
                                
                            @if(isset($item->detail->price))
                                <p class="card-text text-center product-card-product-price">
                                    @if($promoTotal != 0 )
                                        <strike>{{rupiah($item->detail->price)}}</strike> {{rupiah($item->detail->price - $promoTotal)}} 
                                    @else
                                        {{rupiah($item->detail->price)}}
                                    @endif
                                </p>
                            @endif
                            </div>
                        </div>
                        </a>
                    </div>
                @endforeach
                    
                    
                </div>
                <!-- Pagination -->

        {{$data['product']->links()}}

                <!-- End Pagination -->
            </div>
        </div>
        
    </div>

@endsection