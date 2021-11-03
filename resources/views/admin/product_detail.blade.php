@extends('layouts.application_admin')
@section('pagetitle', 'Product '.$data['product'][0]->product_name)
@section('content')

    <div id="toolbar">
        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#add"><i class="fas fa-plus"></i></button>
    </div>

    <table data-toggle="table"
    data-search="true"
    data-toolbar="#toolbar"
    data-detail-view="true"
    data-detail-formatter="detailFormatter">
        <thead>
        <tr>
            <th data-field="id" data-visible="false">ID</th>          
            <th data-field="product_size" data-sortable="true">Size</th>
            <th data-field="product_color" data-sortable="true">Color</th>
            <th data-field="product_category" data-sortable="true">Category</th>
            <th data-field="product_price" data-sortable="true">Price</th>
            <th data-field="product_yard" data-sortable="true">Yard/Piece</th>
            <th data-field="product_image" data-sortable="true" data-visible="false">Image</th>
            <th data-field="whatsapp_link" data-sortable="true">Whatsapp Link</th>
            <th data-field="shopee_link" data-sortable="true">Shopee Link</th>
            <th data-formatter="TableActions">Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($data['productDetail'] as $key=>$value)
                <tr>
                    <td>{{$value->id}}</td>
                    <td>
                        @if($value->size->id)
                            {{$value->size->size_name}}
                        @else
                            -
                        @endif
                    </td>
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
                        {{$value->price}}
                    </td>
                    <td>
                        {{$value->yard_per_piece}}
                    </td>
                    <td>
                        {{asset('/storage/products/'.$value->design_image_path)}}
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
            function detailFormatter(index, row) {
                var html = []
                html.push('<div class="container-fluid">')
                    html.push('<div class="row">')
                        html.push('<div class="col-4 pr-2">')
                            html.push('<img width="100%" src="' + row.product_image + '">')
                        html.push('</div>')
                        html.push('<div class="col">')
                            html.push('<p><b>Size:</b> ' + row.product_size + '</p>')
                            html.push('<p><b>Color:</b> ' + row.product_color + '</p>')
                            html.push('<p><b>Category:</b> ' + row.product_category + '</p>')
                            html.push('<p><b>Price:</b> ' + row.product_price + '</p>')
                            html.push('<p><b>Yard per Piece:</b> ' + row.product_yard + '</p>')
                        html.push('</div>')
                    html.push('</div>')
                html.push('</div>')
                
                
                return html.join('')
            }
            
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
                        <label>Price</label>
                        <input type="number" min="0" class="form-control" name="price" placeholder="Price" value="" required>
                    </div>

                    <div class="form-group">
                        <label>Yard / Piece</label>
                        <input type="number" min="0" class="form-control" name="yard_per_piece" placeholder="Price per Yard" value="" required>
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
                        <label>Image Product</label><br>
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
                        <label>Price</label>
                        <input type="number" min="0" class="form-control" name="price" placeholder="Price" value="{{$value->price}}" required>
                    </div>

                    <div class="form-group">
                        <label>Yard / Piece</label>
                        <input type="number" min="0" class="form-control" name="yard_per_piece" placeholder="Yard per Piece" value="{{$value->yard_per_piece}}" required>
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
                        <label>Image Product</label><br>
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

