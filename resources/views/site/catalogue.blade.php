@extends('layouts.application')
@section('pagetitle', 'Catalogue')
@section('content')
<div class="container content">
        <div class="row">

            <div class="col-lg-3 d-lg-block sidebar">
                <div class="row">
                <div class="col-6 col-md-6 col-lg-12 col-sm-6 col-xs-6">
                <div class="sidebar-item mb-4">
                    <div class="row mb-3">
                        <div class="col-12">
                            <h3 class="sidebar-content-title">Category</h3>
                        </div>
                        <div class="col-12">
                            <ul class="sidebar-content-list">
                                <li>
                                    <input type="checkbox" class="checkbox-category-all">
                                    <a href="#">All</a>
                                </li>

                                @foreach($data['category'] as $i=>$c)
                                    <li>
                                        @if(in_array($c->category_code, $data['categoryParam']))
                                            <input type="checkbox" class="checkbox-category" value="{{$c->category_code}}" checked>
                                        @else
                                            <input type="checkbox" class="checkbox-category" value="{{$c->category_code}}">
                                        @endif
                                        <a href="#">{{$c->category_name}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                </div>
                <div class="col-6 col-md-6 col-lg-12 col-sm-6 col-xs-6">
                <div class="sidebar-item mb-4">
                    <div class="row mb-3">
                        <div class="col-12">
                            <h3 class="sidebar-content-title">Color</h3>
                        </div>
                        <div class="col-12">
                            <ul class="sidebar-content-list">
                            
                                <li>
                                    <input type="checkbox" class="checkbox-color-all">
                                    <a href="#}">All</a>
                                </li>

                            @foreach($data['color'] as $i=>$c)
                                <li>
                                    @if(in_array($c->color_code, $data['colorParam']))
                                        <input type="checkbox" class="checkbox-color" value="{{$c->color_code}}" checked>
                                    @else
                                        <input type="checkbox" class="checkbox-color" value="{{$c->color_code}}">
                                    @endif
                                    <i class="nav-icon fas fa-square-full" style="color:{{$c->color_hex}};"></i>
                                    <a href="#">{{$c->color_name}}</a>
                                </li>
                            @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                </div>
                </div>

                <button class="btn btn-xs btn-block btn-secondary close-filter-button">Close</button>
            </div>

            <div class="col-12 filter-section" >
                <button class="btn btn-block btn-secondary filter-button">Filter</button>
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


@section('additionalJs')
    <script>
        

        function generateUrl(color, category) {
            var paramsColor = "";
            var paramsCategory = "";
            var params = "";
            $.each(color, function( index, value ) {
                  
                if(!index){
                    paramsColor = paramsColor + "" + value;
                }else{
                    paramsColor = paramsColor + "," + value;
                }
                
            });

            $.each(category, function( index, value ) {
                  
                  if(!index){
                    paramsCategory = paramsCategory + "" + value;
                  }else{
                    paramsCategory = paramsCategory + "," + value;
                  }
                  
              });
            params = "?color=" + paramsColor + "&category=" + paramsCategory;
            console.log(params);
            return params;

        }

        function letsGo(url, params){
            // console.log(url+""+params);
            window.location.replace(url+params);
        }
        
        
        $( document ).ready(function() {
            var color = [];
            var category = [];
            var urlHome = "{{route('shop.catalogue')}}";

            $(".filter-button").click(function() {
                $(".sidebar").show();
            });

            $(".close-filter-button").click(function() {
                $(".sidebar").hide();
            });

            $( ".checkbox-color" ).each(function( index, el ) {
                if(this.checked) {
                    //Do stuff
                    if (!color.includes($(this).val()))
                        color.push($(this).val());
                }else{
                    var index = color.indexOf($(this).val());
                    if (index !== -1) {
                        color.splice(index, 1);
                    }
                }
            });

            $( ".checkbox-category" ).each(function( index, el ) {
                if(this.checked) {
                    //Do stuff
                    if (!category.includes($(this).val()))
                    category.push($(this).val());
                }else{
                    var index = category.indexOf($(this).val());
                    if (index !== -1) {
                        category.splice(index, 1);
                    }
                }
            });

            console.log(color);

            $(".checkbox-color-all").change(function() {
                if(this.checked) {
                    //Do stuff
                    $( ".checkbox-color" ).each(function( index, el ) {
                        if (!color.includes(el.value))
                            color.push(el.value);
                        $(el).prop('checked', true);
                    });
                }else{
                    $( ".checkbox-color" ).each(function( index, el ) {
                        var index = color.indexOf($(this).val());
                        if (index !== -1) {
                            color.splice(index, 1);
                        }
                        $(el).prop('checked', false);
                    });
                }
                letsGo(urlHome, generateUrl(color, category));
                console.log(color);
            });

            $(".checkbox-category-all").change(function() {
                if(this.checked) {
                    //Do stuff
                    $( ".checkbox-category" ).each(function( index, el ) {
                        if (!category.includes(el.value))
                        category.push(el.value);
                        $(el).prop('checked', true);
                    });
                }else{
                    $( ".checkbox-category" ).each(function( index, el ) {
                        var index = category.indexOf($(this).val());
                        if (index !== -1) {
                            category.splice(index, 1);
                        }
                        $(el).prop('checked', false);
                    });
                }
                letsGo(urlHome, generateUrl(color, category));
                console.log(category);
            });

            $(".checkbox-color").change(function() {
                console.log(color);
                console.log($(this).val());
                if(this.checked) {
                    //Do stuff
                    if (!color.includes($(this).val()))
                        color.push($(this).val());
                }else{
                    
                    var index = color.indexOf($(this).val());
                    if (index !== -1) {
                        color.splice(index, 1);
                    }
                }

                letsGo(urlHome, generateUrl(color, category));
                console.log(color);
            });

            $(".checkbox-category").change(function() {
                
                if(this.checked) {
                    //Do stuff
                    if (!category.includes($(this).val()))
                    category.push($(this).val());
                }else{
                    var index = category.indexOf($(this).val());
                    if (index !== -1) {
                        category.splice(index, 1);
                    }
                }
                letsGo(urlHome, generateUrl(color, category));
                console.log(category);
            });
        });
    </script>
@endsection 