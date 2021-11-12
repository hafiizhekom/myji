@extends('layouts.application_admin')
@section('pagetitle', $data['productDetail'][0]->product->product_name.' '.$data['productDetail'][0]->size->size_name)
@section('breadcrumb')
    <a class="btn btn-sm btn-link float-right" href="{{route('product_detail', ['id'=>$data['productDetail'][0]->product_id])}}"><i class="fas fa-arrow-left"></i> Back</button></a>
@endsection
@section('content')
    
    <div id="toolbar" class="mb-5 pb-1">
        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#add"><i class="fas fa-plus"></i></button>
        
    </div>
            

            <!-- Gallery -->
            <div class="row">
                @foreach ($data['productDetailImage'] as $key=>$value)
                    <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                        <div class="hovereffect">
                            <img class="img-responsive" src="{{asset('/storage/products/'.$value->file)}}" style="width:100%;height:100%;object-fit: cover;" alt="">
                            <div class="overlay">
                                @if($value->main_image)
                                    <h2>Default</h2>
                                    <a class="btn btn-sm btn-primary mt-5" href="#" data-toggle="modal" data-target="#preview-{{$value->id}}">Preview</a>
                                    <a class="btn btn-sm btn-danger mt-5" href="#" data-toggle="modal" data-target="#delete-{{$value->id}}">Delete</a>
                                @else

                                <a class="btn btn-sm btn-primary mt-5" href="#" data-toggle="modal" data-target="#preview-{{$value->id}}">Preview</a><br>
                                <a class="btn btn-sm btn-primary mt-5" href="#" data-toggle="modal" data-target="#edit-{{$value->id}}">Set Default</a><br>
                                <a class="btn btn-sm btn-danger mt-5" href="#" data-toggle="modal" data-target="#delete-{{$value->id}}">Delete</a>
                                @endif
                            
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            
@endsection

@section('additionalJs')
        <script>
            

            $(document).ready(function() {
                $("input[type=file]").change(function(){
                    var oImg=new Image();
                    var avail = false;
                    for( i=0; i < this.files.length; i++ ){
                        
                        oImg.src=URL.createObjectURL( this.files[i] );
                        oImg.onload=function(){
                            var width=oImg.naturalWidth;
                            var height=oImg.naturalHeight;
                            var ratio = oImg.width/oImg.height;
                            
                            if(Math.round(ratio * 100) / 100 >= 0.60 && Math.round(ratio * 100) / 100 <= 0.80){
                                
                            }else{
                                alert('Image ratio must be 2 (width) : 3 (height) or 3 (width) : 4 (height)');  
                                $("input[type=file]").val(''); 
                                return;
                            }
                           
                        };
                    }
                });
            });
        </script>
   
@endsection


@section('modals')
    <!-- Modal Add-->
    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form" action="{{route('product_detail_image.add', $data['id'])}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Image Product</label><br>
                        <input type="file" accept="image/*" name="image[]" multiple="multiple" required>
                    </div>
                </div>
                <div class="modal-footer">
                <button class="btn btn-primary btn-block" type="submit">Add New Image</button>
                </div>
            </form>
        </div>
        </div>
    </div>

    @foreach ($data['productDetailImage'] as $key=>$value)
    <div class="modal fade" id="preview-{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <img src="{{asset('/storage/products/'.$value->file)}}" style="width:100%;height:100%;" alt="">
        </div>
        </div>
    </div>
    @endforeach
    
    <!-- Modal Edit-->
    @foreach ($data['productDetailImage'] as $key=>$value)
    <div class="modal fade" id="edit-{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to set default?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form class="form" action="{{route('product_detail_image.edit', ['id'=>$data['id'], 'iddetail'=>$value->id])}}" method="post">
                    @csrf
                    <div class="btn-group" style="width: 100%;">
                        <button type="submit" class="btn btn-primary">Set Default</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>
    @endforeach

    <!-- Modal Delete-->
    @foreach ($data['productDetailImage'] as $key=>$value)
    <div class="modal fade" id="delete-{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form class="form" action="{{route('product_detail_image.delete', ['id'=>$data['id'], 'iddetail'=>$value->id])}}" method="post">
                    @csrf
                    {{ method_field ('DELETE') }}
                    <div class="btn-group" style="width: 100%;">
                        <button type="submit" class="btn btn-danger">Delete</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>
    @endforeach
@endsection
