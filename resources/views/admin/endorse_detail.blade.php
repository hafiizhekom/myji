@extends('layouts.application_admin')
@section('pagetitle', 'Endorse Detail')
@section('breadcrumb')
    <a class="btn btn-sm btn-link float-right" href="{{route('endorse')}}"><i class="fas fa-arrow-left"></i> Back</button></a>
@endsection
@section('content')


    <div class="card">
        <div class="card-body">
            <label>Endorse ID</label>: #{{$data['endorse']->id}}<br>
            <label>Channel</label>: {{$data['endorse']->channel->channel_name}}<br>
            <label>Customer</label>: {{$data['endorse']->customer->first_name}} {{$data['endorse']->customer->last_name}} ({{$data['endorse']->customer->email}})<br>
            <label>Address Shipping</label>: {{$data['endorse']->address_shipping}}<br>
            <label>Endorse Date</label>: {{$data['endorse']->endorse_date}}<br>
        </div>
    </div>


    <div id="toolbar">
        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#add"><i class="fas fa-plus"></i></button>
    </div>

    <table data-toggle="table"
    data-search="true"
    data-toolbar="#toolbar">
        <thead>
        <tr>
            <th data-field="id" data-visible="false">ID</th>
            <th data-field="product" data-sortable="true">Product</th>
            <th data-field="product_size" data-sortable="true">Product Size</th>
            <th data-field="product_color" data-sortable="true">Product Color</th>
            <th data-field="product_category" data-sortable="true">Product Category</th>
            <th data-field="quantity" data-sortable="true">Quantity</th>
            <th data-formatter="TableActions">Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach($data['endorseDetail'] as $key=>$value)
                <tr>
                    <td>{{$value->id}}</td>
                    <td>{{$value->productDetail->product->product_name}}</td>
                    <td>{{$value->productDetail->size->size_name}}</td>
                    <td>{{$value->productDetail->product->color->color_name}}</td>
                    <td>{{$value->productDetail->product->category->category_name}}</td>
                    <td>{{$value->quantity}}</td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
        </table>
@endsection

@section('additionalJs')
        <script>

            $(function() {
                $('input[name="endorse_date"]').daterangepicker({
                    singleDatePicker: true,
                    locale: {
                        format: 'YYYY/MM/DD'
                    }
                });

            });

            

            function TableActions (value, row, index) {
                var statusAction = '';
                
                return [
                    statusAction,
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
            <form class="form" action="{{route('endorse_detail.add', $data['endorse']->id)}}" method="post">
                @csrf
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Endorse Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Product</label>
                        <select class="form-control" name="product_detail_id" placeholder="Product" required>
                            @foreach($data['productDetail'] as $key=>$value)
                                <option value="{{$value->id}}">{{$value->product->product_name}} {{$value->size->size_name}} {{$value->product->color->color_name}} {{$value->product->category->category_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="number" min="0" class="form-control addquantity" name="quantity" placeholder="Quantity" value="0" required>
                    </div>

                </div>
                <div class="modal-footer">
                <button class="btn btn-primary btn-block" type="submit">Add New Endorse Detail</button>
                </div>
            </form>
        </div>
        </div>
    </div>

    <!-- Modal Edit-->
    @foreach ($data['endorseDetail'] as $key=>$value)
    <div class="modal fade" id="edit-{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form" action="{{route('endorse_detail.edit', ['id'=>$data['endorse']->id, 'iddetail'=>$value->id])}}" method="post">
                @csrf
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Endorse {{$value->endorse_name}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    
                    <div class="form-group">
                        <label>Product</label>
                        <select class="form-control" name="product_detail_id" placeholder="Product" required>
                            @foreach($data['productDetail'] as $key=>$valueproductdetail)
                                @if($valueproductdetail->id == $value->productDetail->id)
                                    <option value="{{$valueproductdetail->id}}" selected>{{$valueproductdetail->product->product_name}} {{$valueproductdetail->size->size_name}} {{$valueproductdetail->product->color->color_name}} {{$valueproductdetail->product->category->category_name}}</option>
                                @else
                                    <option value="{{$valueproductdetail->id}}">{{$valueproductdetail->product->product_name}} {{$valueproductdetail->size->size_name}} {{$valueproductdetail->product->color->color_name}} {{$valueproductdetail->product->category->category_name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="number" min="0" class="form-control editquantity" name="quantity" placeholder="Quantity" value="{{$value->quantity}}" required>
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
    @foreach ($data['endorseDetail'] as $key=>$value)
    <div class="modal fade" id="delete-{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete {{$value->endorse_name}}?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form class="form" action="{{route('endorse_detail.delete', ['id'=>$data['endorse']->id, 'iddetail'=>$value->id])}}" method="post">
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

