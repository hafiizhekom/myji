@extends('layouts.application_admin')
@section('pagetitle', 'Refund')
@section('content')

    <table data-toggle="table"
    data-search="true"
    data-toolbar="#toolbar">
        <thead>
        <tr>
            <th data-field="id" data-visible="false">ID</th>
            <th data-field="customer" data-sortable="true">Customer</th>
            <th data-field="order" data-sortable="true">Order</th>
            <th data-field="orderdetail" data-sortable="true">Order Detail</th>
            <th data-field="type" data-sortable="true">Type</th>
            <th data-field="quantity" data-sortable="true">Quantity</th>
            <th data-field="stock_flow" data-sortable="true">Stock Flow</th>
            <th data-field="reason" data-sortable="true">Reason</th>
            <th data-formatter="TableActions">Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach($data['refund'] as $key=>$value)
                <tr>
                    <td>{{$value->id}}</td>
                    <td>{{$value->orderDetail->order->customer->first_name}} {{$value->orderDetail->order->customer->last_name}}</td>
                    <td>#{{$value->orderDetail->order->id}} {{$value->orderDetail->order->channel->channel_name}}: {{$value->orderDetail->order->total_price}}</td>
                    <td>{{$value->orderDetail->productDetail->product->product_name}} {{$value->orderDetail->productDetail->size->size_name}} {{$value->orderDetail->productDetail->product->color->color_name}} {{$value->orderDetail->productDetail->product->category->category_name}} ({{$value->orderDetail->quantity}}x{{$value->orderDetail->price}})</td>
                    <td>{{$value->type}}</td>
                    <td>{{$value->quantity}}</td>
                    <td>{{$value->stock_flow}}</td>
                    <td>{{$value->reason}}</td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
        </table>
@endsection

@section('additionalJs')
        <script>

            $(function() {
                $('input[name="refund_date"]').daterangepicker({
                    singleDatePicker: true,
                    locale: {
                        format: 'YYYY/MM/DD'
                    }
                });
            });

            function TableActions (value, row, index) {
                return [
                    '<a class="text-warning" href="#" data-toggle="modal" data-target="#edit-',row.id,'">',
                    '<i class="fas fa-edit"></i>',
                    '</a> '
                ].join('');
            }
        </script>
   
@endsection

@section('modals')
    

    <!-- Modal Edit-->
    @foreach ($data['refund'] as $key=>$value)
    <div class="modal fade" id="edit-{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form" action="{{route('refund.edit', $value->id)}}" method="post">
                @csrf
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Refund {{$value->refund_name}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Reason</label>
                        <textarea class="form-control" name="reason" placeholder="Reason">{{$value->reason}}</textarea>
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
    @foreach ($data['refund'] as $key=>$value)
    <div class="modal fade" id="delete-{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete {{$value->refund_name}}?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form class="form" action="{{route('refund.delete', $value->id)}}" method="post">
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

