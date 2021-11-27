@extends('layouts.application')
@section('pagetitle', 'Feedback')
@section('navId', 'navFeedback')
@section('content')

 
<div class="container content">
        <div class="row">
            <div class="col-12 col-lg-12 col-md-12 mb-lg-5 text-center pt-5">
                <h1 class="feedback-title">YOUR FEEDBACK SUBMITTED!</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-12 col-md-12 mb-lg-5 text-center pt-5">
                <a href="{{url('site/feedback')}}" class="btn button-primary button-feedback">Send Another One</a>
            </div>
        </div>
        
    </div>
@endsection

@section('additionalJs')
    <script>
        
            $("#ideas-textarea").focus();
            $("#ideas-textarea").keyup(function(e) {
                while($(this).outerHeight() < this.scrollHeight + parseFloat($(this).css("borderTopWidth")) + parseFloat($(this).css("borderBottomWidth"))) {
                    $(this).height($(this).height()+1);
                };
               
            });
    </script>
@endsection