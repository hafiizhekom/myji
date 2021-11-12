@extends('layouts.application_admin')
@section('pagetitle', 'Promo Detail')
@section('breadcrumb')
    <a class="btn btn-sm btn-link float-right" href="{{route('promo')}}"><i class="fas fa-arrow-left"></i> Back</button></a>
@endsection
@section('content')


    <div class="card">
        <div class="card-body"> 
            <label>Promo Name</label>: {{$data['promo']->promo_name}}<br>
            <label>Start Time</label>: {{$data['promo']->start_time}}<br>
            <label>End Time</label>: {{$data['promo']->end_time}}<br>
            <label>Fixed Amount</label>: {{number_format($data['promo']->fixed_amount,0,',','.')}}<br>
            <label>Percentage Amount</label>: {{$data['promo']->percentage_amount}}<br>
            <label>Active</label>:
            @if($data['promo']->active)
                <i class="fas fa-check"></i>
            @else
                <i class="fas fa-times"></i>
            @endif
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
            <th data-field="final_price" data-sortable="true">Final Price</th>
            <th data-formatter="TableActions">Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach($data['promoDetail'] as $key=>$value)
                <tr>
                    <td>{{$value->id}}</td>
                    <td>{{$value->productDetail->product->product_name}} {{$value->productDetail->size->size_name}} {{$value->productDetail->product->color->color_name}} {{$value->productDetail->product->category->category_name}}</td>
                    <td>{{number_format($value->productDetail->price - $data['promo']->fixed_amount,0,',','.')}}</td>
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
                    '</a>',
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
            <form class="form" action="{{route('promo_detail.add', $data['promo']->id)}}" method="post">
                @csrf
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Promo Detail</h5>
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

                </div>
                <div class="modal-footer">
                <button class="btn btn-primary btn-block" type="submit">Add New Promo Detail</button>
                </div>
            </form>
        </div>
        </div>
    </div>

    <!-- Modal Edit-->
    @foreach ($data['promoDetail'] as $key=>$value)
    <div class="modal fade" id="edit-{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form" action="{{route('promo_detail.edit', ['id'=>$data['promo']->id, 'iddetail'=>$value->id])}}" method="post">
                @csrf
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Promo {{$value->promo_name}}</h5>
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
    @foreach ($data['promoDetail'] as $key=>$value)
    <div class="modal fade" id="delete-{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete {{$value->promo_name}}?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form class="form" action="{{route('promo_detail.delete', ['id'=>$data['promo']->id, 'iddetail'=>$value->id])}}" method="post">
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

