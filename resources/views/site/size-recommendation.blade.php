@extends('layouts.application')
@section('pagetitle', 'Feedback')
@section('content')

<div class="container content">
        <div class="row">
            <div class="col-lg-6 col-md-12 mb-lg-5 size-rec-left-container">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="size-rec-title">Size Recomendation!</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-7 col-md-12 mt-3">
                        <p>Insert the  size of your weight and your height also your gender. 
                            Worry not, it will be our little secret! 
                            It’s safe to share. 
                            (P.s. every size number is awesome!) 
                        </p>
                        <p>
                            After you clicked Submit, our MYJI
                            mini troops behind the screen is going
                            to look for the perfect size for you!
                        </p>
                        <p>
                            And voila! the matched size will pop up 
                            into your screen.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 size-rec-right-container pt-4 ">
                
                <div class="row mb-5 justify-content-end">
                    @foreach ($size as $item)
                        <div class="col-lg-9 col-md-12 mb-2">
                            <img src="{{asset('/storage/settings/size_charts/'.$item->image_file)}}" width="100%" class="pull-right">
                        
                        </div>
                    @endforeach
                    
                </div>

                
            </div>
        </div>
        
    </div>

@endsection

@section('additionalJs')
@endsection

@section('modals')
@endsection