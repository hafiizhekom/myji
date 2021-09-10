@extends('layouts.application')
@section('pagetitle', 'FAQ')
@section('content')

 
<div class="container content">
        <div class="row">
            <div class="col-lg-3 col-md-12">
                <h1 class="faq-title">FREQUENTLY
                    ASKED
                    QUESTION</h1>
            </div>
            <div class="col-lg-9 col-md-12 pl-100 pr-200">
              @foreach($data as $i=>$faq)
                <div id="faq-accordion-{{$i}}" class="accordion">
                    <div class="card">
                      <div class="card-header" id="faq-heading-{{$i}}">
                        <h5 class="mb-0">
                          <button class="btn btn-link" data-toggle="collapse" data-target="#faq-collapse-{{$i}}" aria-expanded="false" aria-controls="faq-collapse-{{$i}}">
                            {{$faq->title}}<span class="accordion-collapse-button ml-3">+</span>
                          </button>
                        </h5>
                      </div>
                  
                      <div id="faq-collapse-{{$i}}" class="collapse multi-colapse" aria-labelledby="faq-heading-{{$i}}" data-parent="#faq-accordion-{{$i}}">
                        <div class="card-body">
                            {!! $faq->content !!}
                        </div>
                      </div>
                    </div>
                </div>

              @endforeach

               
                
            </div>
        </div>
        
    </div>
   
@endsection

@section('js')
            const elements = $(".btn[data-toggle='collapse']");
            elements.on("click", function(){
                let isExpanded = $(this).attr("aria-expanded");
                console.log(isExpanded);
                if(isExpanded != "true"){
                    $(this).find("span").html("-");
                }else{
                    $(this).find("span").html("+");
                }
            });
               

@endsection