@extends('layouts.application_admin')
@section('pagetitle', $data['product'][0]->product_name)
@section('breadcrumb')
    <a class="btn btn-sm btn-link float-right" href="{{route('product')}}"><i class="fas fa-arrow-left"></i> Back</button></a>
@endsection
@section('content')

    <div id="toolbar">
        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#add"><i class="fas fa-plus"></i></button>
    </div>

    <table data-toggle="table" data-pagination="true"
    data-search="true"
    data-toolbar="#toolbar">
        <thead>
        <tr>
            <th data-field="id" data-visible="false">ID</th>       
            <th data-field="product_id" data-visible="false">Product ID</th>
            <th data-field="product_size" data-sortable="true">Size</th>
            <th data-field="product_price" data-sortable="true">Price</th>
            <th data-field="product_yard" data-sortable="true">Yard/Piece</th>
            <th data-field="image" data-sortable="true">Image</th>
            <th data-field="whatsapp_link" data-sortable="true">Whatsapp Link</th>
            <th data-field="shopee_link" data-sortable="true">Shopee Link</th>
            <th data-formatter="TableActions">Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($data['productDetail'] as $key=>$value)
                <tr>
                    <td>{{$value->id}}</td>
                    <td>{{$value->product_id}}</td>
                    <td>
                        @if($value->size->id)
                            {{$value->size->size_name}}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        {{$value->price}}
                    </td>
                    <td>
                        {{$value->yard_per_piece}}
                    </td>
                    <td>
                        @if($value->image_file)
                            <a href="#" data-toggle="modal" data-target="#image-{{$value->id}}"><img src="{{asset('/storage/products/'.$value->image_file)}}" width="100px"></a>
                        @endif
                    </td>
                    <td>
                        @if($value->whatsapp_link)
                            {{$value->whatsapp_link}}
                            <a href="{{$value->whatsapp_link}}"><i class="fas fa-link"></i></a>
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if($value->whatsapp_link)
                            {{$value->shopee_link}}
                            <a href="{{$value->shopee_link}}"><i class="fas fa-link"></i></a>
                        @else
                            -
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
            
            function TableActions (value, row, index) {
                return [
                    '<a class="text-warning" href="#" data-toggle="modal" data-target="#edit-',row.id,'">',
                    '<i class="fas fa-edit"></i>',
                    '</a> ',
                    '<a class="text-danger" href="#" data-toggle="modal" data-target="#delete-',row.id,'">' ,
                    '<i class="fas fa-trash"></i>',
                    '</a>'
                ].join('');
            }            

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
            <form class="form" action="{{route('product_detail.add', $data['id'])}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <div class="form-group">
                        <label>Size</label>
                        <select class="form-control" name="size" placeholder="Size" required>
                            @foreach($data['size'] as $key=>$value)
                                <option value="{{$value->id}}">{{$value->size_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Price</label>
                        <input type="number" min="0" class="form-control" name="price" placeholder="Price" value="" required>
                    </div>

                    <div class="form-group">
                        <label>Yard / Piece</label>
                        <input type="number" min="0" class="form-control" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" name="yard_per_piece" placeholder="Price per Yard" value="" required>
                    </div>

                    <div class="form-group">
                        <label>Whatsapp Link</label>
                        <input type="text" class="form-control" name="whatsapp_link" placeholder="Whatsapp Link" value="" required>
                    </div>

                    <div class="form-group">
                        <label>Shopee Link</label>
                        <input type="text" class="form-control" name="shopee_link" placeholder="Shopee Link" value="" required>
                    </div>

                    <div class="form-group">
                        <label>Image</label><br>
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
    @foreach ($data['productDetail'] as $key=>$value)
    <div class="modal fade" id="edit-{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form" action="{{route('product_detail.edit', ['id'=>$data['id'], 'iddetail'=>$value->id])}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Product {{$value->product_name}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>Size</label>
                        <select class="form-control" name="size" placeholder="Size" required>
                            @foreach($data['size'] as $keysize=>$valuesize)
                                @if($valuesize->id == $value->size_id)
                                    <option value="{{$valuesize->id}}" selected>{{$valuesize->size_name}}</option>
                                @else
                                    <option value="{{$valuesize->id}}">{{$valuesize->size_name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Price</label>
                        <input type="number" min="0" class="form-control" name="price" placeholder="Price" value="{{$value->price}}" required>
                    </div>

                    <div class="form-group">
                        <label>Yard / Piece</label>
                        <input type="number" min="0" class="form-control" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" name="yard_per_piece" placeholder="Yard per Piece" value="{{$value->yard_per_piece}}" required>
                    </div>

                    <div class="form-group">
                        <label>Whatsapp Link</label>
                        <input type="text" class="form-control" name="whatsapp_link" placeholder="Whatsapp Link" value="{{$value->whatsapp_link}}" required>
                    </div>

                    <div class="form-group">
                        <label>Shopee Link</label>
                        <input type="text" class="form-control" name="shopee_link" placeholder="Shopee Link" value="{{$value->shopee_link}}" required>
                    </div>

                    <div class="form-group">
                        <label>Image</label><br>
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
    @endforeach

    <!-- Modal Delete-->
    @foreach ($data['productDetail'] as $key=>$value)
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
                <form class="form" action="{{route('product_detail.delete', ['id'=>$data['id'], 'iddetail'=>$value->id])}}" method="post">
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

