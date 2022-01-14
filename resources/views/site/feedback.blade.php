@extends('layouts.application')
@section('pagetitle', 'Feedback')
@section('content')

@if(Session::has('message'))
    <div class="fixed-top alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible fade show" auto-close="2000" role="alert">
        {{ Session::get('message') }}
    </div>
@endif
<div class="container content">
        <div class="row">
            <div class="col-lg-5 col-md-12 mb-lg-5">
                <h1 class="feedback-title">DROP YOUR IDEAS!</h1>
            </div>
            <div class="col-lg-7 col-md-12 pl-lg-5  pt-4 ">
                
                <div class="row mb-4">
                    <div class="col-lg-12">
                        <form action="{{route('shop.feedback.add')}}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12 feedback-content-head">
                                    <h5>Got something to say? Drop down here!</h5>
                                    <p>We’d love to hear anything for you. Any feedback, recommendation, pattern ideas or anything!</p>
                                </div>
                            </div>
                        
                            <div id="propose-design" class="row my-3">
                                <div class="col-lg-12">
                                    <textarea id="ideas-textarea" class="feedback-input" name="feedback"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mt-3">
                                    <input type="submit" value="SUBMIT" class="btn button-primary button-feedback float-right">
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 mt-5">
                        <form action="{{route('shop.feedback_idea.add')}}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12 feedback-content-head">
                                    <h5>Propose Design</h5>
                                    <p>Take your chance to make your dream pattern comes alive. Drop your design pattern recommendation!</p>
                                </div>
                            </div>
                        
                            <div class="row my-3">
                                <div class="col-lg-8 col-md-12 mb-3">
                                    <input type="text" class="feedback-input" id="" name="url" placeholder="https://www.yoursite.com/yourdesign" />
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <input type="submit" value="Submit" class="btn button-primary float-right">
                                </div>
                            </div>
                            <div class="row">
                                
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
@endsection

@section('additionalJs')
    <script>
        $(function() {
            var alert = $('div.alert[auto-close]');
            alert.each(function() {
                var that = $(this);
                var time_period = that.attr('auto-close');
                setTimeout(function() {
                that.alert('close');
                }, time_period);
            });
        });
        $( document ).ready(function() {
            $("#ideas-textarea").focus();
            $("#ideas-textarea").keyup(function(e) {
                while($(this).outerHeight() < this.scrollHeight + parseFloat($(this).css("borderTopWidth")) + parseFloat($(this).css("borderBottomWidth"))) {
                    $(this).height($(this).height()+1);
                };
               
            });
        });
    </script>
@endsection