@extends('layouts.application')
@section('pagetitle', 'Home')
@section('content')
<section id="jumbotron" class="section-scrollify">
    <div id="banner" class="carousel slide h-100" data-ride="carousel">            
        <!-- Indicators -->
        <ul class="carousel-indicators">
        @foreach($data['slider'] as $i=> $slider) 
            <li data-target="#banner" data-slide-to="{{$i}}" class="active"></li>
        @endforeach
        </ul>

        <!-- The slideshow -->
        <div class="carousel-inner h-100">          
        @foreach($data['slider'] as $i=>$slider)
            @if($i == 0)
            <div class="carousel-item active h-100">
            @else
            <div class="carousel-item h-100">
            @endif
            <img class="h-100 object-cover" src="{{asset('storage/sliders/'.$slider->image)}}" alt="{{$slider->title}}">
            </div>
        @endforeach
        </div>

        <!-- Left and right controls -->
        <a class="carousel-control-prev" href="#banner" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#banner" data-slide="next">
            <span class="carousel-control-next-icon"></span>
        </a>
    </div>
</section>

<section id="our-story" class="section-scrollify">
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <h1 class="text-center">Our Story</h1>
            </div>
        </div>

        <!-- Carousel Mobile -->
        <div class="d-md-none">
            <div id="myCarousel-our-story-card" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="col-md carousel-item carousel-item--padding active">
                        <div class="card mb-3 our-story-card">
                            <img src="{{asset('/assets/images/stories/story_1.png')}}" width="100px" class="card-img-top" alt="Story 1">
                            <div class="card-body d-flex align-content-center flex-wrap">
                                <p class="card-text text-center">Started from our interest in finding outstanding shirt</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md carousel-item carousel-item--padding">
                        <div class="card mb-3 our-story-card">
                            <img src="{{asset('/assets/images/stories/story_2.png')}}" width="100px" class="card-img-top" alt="Story 2">  
                            <div class="card-body d-flex align-content-center flex-wrap">
                                <p class="card-text text-center">Then we created our own shirt from a mixture of trend + festive wild ideas + fashion</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md carousel-item carousel-item--padding">
                        <div class="card mb-3 our-story-card">
                            <img src="{{asset('/assets/images/stories/story_3.png')}}" width="100px" class="card-img-top" alt="Story 3">  
                            <div class="card-body d-flex align-content-center flex-wrap">
                                <p class="card-text text-center">Woohoo! Our creation finaly made it into life, call it, Myji!</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md carousel-item carousel-item--padding">
                        <div class="card mb-3 our-story-card">
                            <img src="{{asset('/assets/images/stories/story_4.png')}}" width="100px" class="card-img-top" alt="Story 4">  
                            <div class="card-body d-flex align-content-center flex-wrap">
                                <p class="card-text text-center">Finally we created a shirt that we really love, and people love it too!</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>                

        <div class="row d-none d-md-flex">
            <div class="col-md  ">
                <div class="card mb-3 our-story-card">
                    <img src="{{asset('/assets/images/stories/story_1.png')}}" width="100px" class="card-img-top" alt="Story 1">
                    <div class="card-body d-flex align-content-center flex-wrap">
                        <p class="card-text text-center">Started from our interest in finding outstanding shirt</p>
                        
                    </div>
                </div>
            </div>
            <div class="col-md  ">
                <div class="card mb-3 our-story-card">
                    <img src="{{asset('/assets/images/stories/story_2.png')}}" width="100px" class="card-img-top" alt="Story 1">
                    <div class="card-body d-flex align-content-center flex-wrap">
                        <p class="card-text text-center">Then we created our own shirt from a mixture of trend + festive wild ideas + fashion</p>
                        
                    </div>
                </div>
            </div>
            <div class="col-md  ">
                <div class="card mb-3 our-story-card">
                    <img src="{{asset('/assets/images/stories/story_3.png')}}" width="100px" class="card-img-top" alt="Story 1">
                    <div class="card-body d-flex align-content-center flex-wrap">
                        <p class="card-text text-center">Woohoo! Our creation finaly made it into life, call it, Myji!</p>
                        
                    </div>
                </div>
            </div>
            <div class="col-md  ">
                <div class="card mb-3 our-story-card">
                    <img src="{{asset('/assets/images/stories/story_4.png')}}" width="100px" class="card-img-top" alt="Story 1">
                    <div class="card-body d-flex align-content-center flex-wrap">
                        <p class="card-text text-center">Finally we created a shirt that we really love, and people love it too!</p>
                        
                    </div>
                </div>
            </div>
        </div>

        <div class="row our-story-sub-heading justify-content-center">
            <div class="col-lg-5">
                <h3 class="text-center">“we don’t stop <span class="black">there</span>, the story still goes on and we are very excited to <span class="black">invade our shirt everywhere!”</span></h3>
            </div>
        </div>

    </div>  
</section>

<!-- Our Most Wanted -->

<section id="our-most-wanted" class="section-scrollify">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="text-center">Our Most Wanted</h1>
            </div>
        </div>

        <div> 
            <!-- Slick --> 
            <div class="carousel-slick row justify-content-center ">
                @foreach($data['mostWanted'] as $i=>$item)
                <div class="col">
                    <div class="card mb-3 product-card-alt"> 
                        @if(isset($item->detail[0]->image_file))
                            <img src="{{asset('storage/products/'.$item->detail[0]->image_file)}}" width="100px" class="card-img-top mx-auto product-image-350" style='max-width:350px' alt="{{$item->product_name}}">
                        @endif
                        <div class="card-body">
                            <p class="card-text text-center product-card-product-title">{{$item->product_name}}</p>
                            <p class="card-text text-center product-card-product-price">{{rupiah($item->detail[0]->price)}}</p>
                        
                        </div>
                        <div class="card-footer d-flex justify-content-center">
                            <a href="#" class="btn button-primary">Shop Now</a>
                        </div>
                    </div>
                </div>                        
                @endforeach
            </div>    
            <!-- Slick -->
        </div>

    </div>  
</section>

<!-- End Our Most Wanted -->

<!-- Testimony -->
<section id="testimony" class="section-scrollify">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 testimony-left">
                <div class="row">
                    <div class="col">
                        <h1 id="propose-design" class="testimony-title text-center">WHAT THEY SAY</h1>
                    </div>
                </div>
                <div class="row testimony-left-image" style="display:none;">
                    <div class="col">
                        <img src="{{asset('/assets/images/review-bubble.png')}}" alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 testimony-right">
                <div class="testimony-right-slider-container">
                    <div class="card-testimony">
                        <div class="card-testimony__scrollbar">
                            @foreach($data['testimonies'] as $i=> $testi)
                                <img src="{{asset('/storage/testimonies/'.$testi->image)}}" alt="{{$slider->title}}">
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</section>

<!-- End Testimony -->

<!-- back to top link -->
<div id="backToTopLink-wrapper">
    <a class="backtotop" href="javascript:;" onclick="scrollToTop()" >
        <span class="backtotop-text">back to top</span>
        <img class="backtotop-image" src="{{asset('assets/images/arrowup.svg')}}"/>
    </a>
</div>
<!-- end back to top link -->
@endsection

@section('additionalJs')
    <script type="text/javascript" src="{{asset('/assets/javascripts/jquery.scrollify.min.js')}}"></script>
    <script>
        $( ".card-testimony__scrollbar" )
        .mouseover(function() {
            // $( this ).find( "span" ).text( "mouse over x " + i );
            $.scrollify.disable();
        })
        .mouseout(function() {
            // console.log("mouse out");
            $.scrollify.enable();
        });
    </script>
@endsection