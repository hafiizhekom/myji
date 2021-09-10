@extends('layouts.application')
@section('pagetitle', 'How To Order')
@section('content')
<section id="how-to-order" class="content">
        <div class="container ">
            <div class="row pb-3">
                <div class="col-lg-12 text-center">
                    <h1 class="text-center pb-2">How To Order</h1>
                    <p class="how-to-order-sub-heading">As easy as 1 - 2 - 3, MYJI shirt will be ready with worry-free!</p>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-5ths col-xs-6 mb-4 mx-auto">
                    <div class="card mb-3 how-to-order-card">
                        <img src="{{asset('/assets/images/howtoorder/how-to-order_1.svg')}}"  class="card-img-top mx-auto" alt="How To Order 1">
                        <div class="card-body">
                            <p class="card-text text-center how-to-order-card-text">Choose your design</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-5ths col-xs-6 mb-4 mx-auto">
                    <div class="card mb-3 how-to-order-card">
                        <img src="{{asset('/assets/images/howtoorder/how-to-order_2.svg')}}"  class="card-img-top mx-auto" alt="How To Order 1">
                        <div class="card-body">
                            <p class="card-text text-center how-to-order-card-text">Check size availability and measurement</p>
                        
                        </div>
                    </div>
                    
                </div>
                <div class="col-md-5ths col-xs-6 mb-4 mx-auto">
                    <div class="card mb-3 how-to-order-card">
                        <img src="{{asset('/assets/images/howtoorder/how-to-order_3.svg')}}"  class="card-img-top mx-auto" alt="How To Order 1">
                        <div class="card-body">
                            
                            <p class="card-text text-center how-to-order-card-text">Choose your 
                                platform to buy </p>
                        
                        </div>
                    </div>
                </div>
                <div class="col-md-5ths col-xs-6 mb-4 mx-auto">
                    <div class="card mb-3 how-to-order-card">
                        <img src="{{asset('/assets/images/howtoorder/how-to-order_4.svg')}}"  class="card-img-top mx-auto" alt="How To Order 1">
                        <div class="card-body">
                            
                            <p class="card-text text-center how-to-order-card-text">Sit tight and wait for your products will be delivered to your home</p>
                        
                        </div>
                    </div>
                </div>
                <div class="col-md-5ths col-xs-6 mb-4 mx-auto">
                    <div class="card mb-3 how-to-order-card">
                        <img src="{{asset('/assets/images/howtoorder/how-to-order_5.svg')}}"  class="card-img-top mx-auto" alt="How To Order 1">
                        <div class="card-body">
                            
                            <p class="card-text text-center how-to-order-card-text">Ready to impress/Tik-Tok/ travel with MYJI!</p>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection