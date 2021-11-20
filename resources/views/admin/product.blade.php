@extends('layouts.application_admin')
@section('pagetitle', 'Product')
@section('content')


    <div id="toolbar">
        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#add"><i class="fas fa-plus"></i></button>
    </div>

    <table data-toggle="table" data-pagination="true"
    data-search="true"
    data-toolbar="#toolbar"
    >
        <thead>
        <tr>
            <th data-field="id" data-visible="false">ID</th>
            <th data-field="product_name" data-sortable="true">Product Name</th>
            <th data-field="product_code" data-sortable="true">Product Code</th>
            <th data-field="product_color" data-sortable="true">Color</th>
            <th data-field="product_category" data-sortable="true">Category</th>
            <th data-field="image_production" data-sortable="true" data-visible="true">Image Production</th>
            <th data-formatter="TableActions">Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($data['product'] as $key=>$value)
                <tr>
                    <td>{{$value->id}}</td>
                    <td>{{$value->product_name}}</td>
                    <td>{{$value->product_code}}</td>
                    <td>
                        @if($value->color)
                            {{$value->color->color_name}}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if($value->category)
                            {{$value->category->category_name}}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if($value->image_file)
                            <a href="#" data-toggle="modal" data-target="#image-{{$value->id}}"><img src="{{asset('/storage/productions/'.$value->image_file)}}" width="100px"></a>
                        @endif
                    </td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
        </table>
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

            
            function TableActions (value, row, index) {
                return [
                    '<a class="text-info" href="/admin/product/detail/',row.id,'">',
                    '<i class="fas fa-tshirt"></i>',
                    '</a> ',
                    '<a class="text-warning" href="#" data-toggle="modal" data-target="#edit-',row.id,'">',
                    '<i class="fas fa-edit"></i>',
                    '</a> ',
                    '<a class="text-danger" href="#" data-toggle="modal" data-target="#delete-',row.id,'">' ,
                    '<i class="fas fa-trash"></i>',
                    '</a>'
                ].join('');
            }
        </script>
   
@endsection

@section('modals')
    <!-- Modal Add-->
    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form" action="{{route('product.add')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Product Name</label>
                        <input type="text" class="form-control" name="product_name" placeholder="Product Name" value="">
                    </div>

                    <div class="form-group">
                        <label>Product Code</label>
                        <input type="text" class="form-control" name="product_code" placeholder="Product Code" value="">
                    </div>

                    <div class="form-group">
                        <label>Color</label>
                        <select class="form-control" name="color" placeholder="Color" required>
                            @foreach($data['color'] as $key=>$value)
                                <option value="{{$value->id}}">{{$value->color_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-control" name="category" placeholder="Category" required>
                            @foreach($data['category'] as $key=>$value)
                                <option value="{{$value->id}}">{{$value->category_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Image for Production</label><br>
                        <input type="file" accept="image/*" name="image" required>
                    </div>

                </div>
                <div class="modal-footer">
                <button class="btn btn-primary btn-block" type="submit">Add New Product</button>
                </div>
            </form>
        </div>
        </div>
    </div>
 
    <!-- Modal Edit-->
    @foreach ($data['product'] as $key=>$value)
    <div class="modal fade" id="edit-{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form" action="{{route('product.edit', $value->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Product {{$value->product_name}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Product Name</label>
                        <input type="text" class="form-control" name="product_name" placeholder="Product Name" value="{{$value->product_name}}">
                    </div>

                    <div class="form-group">
                        <label>Product Code</label>
                        <input type="text" class="form-control" name="product_code" placeholder="Product Code" value="{{$value->product_code}}">
                    </div>

                    <div class="form-group">
                        <label>Color</label>
                        <select class="form-control" name="color" placeholder="Color" required>
                            @foreach($data['color'] as $keycolor=>$valuecolor)
                                @if($valuecolor->id == $value->color_id)
                                    <option value="{{$valuecolor->id}}" selected>{{$valuecolor->color_name}}</option>
                                @else
                                    <option value="{{$valuecolor->id}}">{{$valuecolor->color_name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-control" name="category" placeholder="Category" required>
                            @foreach($data['category'] as $keycategory=>$valuecategory)
                                @if($valuecategory->id == $value->category_id)
                                    <option value="{{$valuecategory->id}}" selected>{{$valuecategory->category_name}}</option>
                                @else
                                    <option value="{{$valuecategory->id}}">{{$valuecategory->category_name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    
                    <div class="form-group">
                        <label>Image for Production</label><br>
                        <input type="file" accept="image/*" name="image">
                    </div>
                    
                </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-block">Save changes</button>
                </div>
            </form>
        </div>
        </div>
    </div>

    <div class="modal fade" id="image-{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <img src="{{asset('/storage/productions/'.$value->image_file)}}" width="100%">
        </div>
    </div>
    @endforeach

    <!-- Modal Delete-->
    @foreach ($data['product'] as $key=>$value)
    <div class="modal fade" id="delete-{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete {{$value->product_name}}?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form class="form" action="{{route('product.delete', $value->id)}}" method="post">
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

