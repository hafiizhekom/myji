@extends('layouts.application_admin')
@section('pagetitle', 'Order')
@section('content')

    <div id="toolbar">
        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#add"><i class="fas fa-plus"></i></button>
    </div>

    <table data-toggle="table" data-pagination="true"
    data-search="true"
    data-toolbar="#toolbar">
        <thead>
        <tr>
            <th data-field="id" data-visible="false">Order ID</th>
            <th data-field="order_id" data-visible="true">Order ID</th>
            <th data-field="channel" data-sortable="true">Channel</th>
            <th data-field="customer" data-sortable="true">Customer</th>
            <th data-field="discount_amount" data-sortable="true">Discount Amount</th>
            <th data-field="address_shipping" data-sortable="true">Address Shipping</th>
            <th data-field="total_price" data-sortable="true">Total Price</th>
            <th data-field="order_date" data-sortable="true">Order Date</th>
            <th data-formatter="TableActions">Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach($data['order'] as $key=>$value)
                <tr>
                    <td>{{$value->id}}</td>
                    <td>
                        #{{$value->id}} 
                        @if($value->type_order == "return")
                            (Return Order #{{$value->return_order}})
                        @endif
                    </td>
                    <td>{{$value->channel->channel_name}}</td>
                    <td>{{$value->customer->first_name}} {{$value->customer->last_name}}</td>
                    <td>{{$value->discount_amount}}</td>
                    <td>{{$value->address_shipping}}</td>
                    <td>{{number_format($value->total_price,0,',','.')}}</td>
                    <td>{{$value->order_date}}</td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
        </table>
@endsection

@section('additionalJs')
        <script>


            
            $(function() {
                $('input[name="order_date"]').daterangepicker({
                    singleDatePicker: true,
                    locale: {
                        format: 'YYYY/MM/DD'
                    }
                });

                $("#return_checkbox").change(function() {
                    if(this.checked) {
                        
                        //Do stuff
                        $("#return_order_group").show();
                    }else{
                        $("#return_order_group").hide();
                    }
                });

                
                $(".text-address-shipping-customer").hide();
                $('.address-customer').change(function() {
                    
                    if(this.checked) {
                        
                        $(".text-address-shipping").val($(".text-address-shipping-customer").val());
                    } else {
                        $(".text-address-shipping").val("");
                    }
                });
            });

           

            $('#customer-selectpicker').selectpicker({
                liveSearch: true
            });

            $('#return-order-selectpicker').selectpicker({
                liveSearch: true
            });

            $('#customer-selectpicker-edit').selectpicker({
                liveSearch: true
            });

            function TableActions (value, row, index) {
                return [
                    '<a class="text-info" href="/admin/order/detail/',row.id,'">',
                    '<i class="fas fa-info-circle"></i>',
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
            <form class="form" action="{{route('order.add')}}" method="post">
                @csrf
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Channel</label>
                        <select class="form-control" name="channel_id" placeholder="Channel" required>
                            @foreach($data['channel'] as $key=>$value)
                                <option value="{{$value->id}}">{{$value->channel_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Customer</label>
                        <select class="form-control" id="customer-selectpicker" name="customer_id" placeholder="Customer" required>
                            @foreach($data['customer'] as $key=>$value)
                                <option value="{{$value->id}}">{{$value->first_name}} {{$value->last_name}} ({{$value->phone}})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Discount Amount</label>
                        <input type="number" min="0" class="form-control" name="discount_amount" placeholder="Discount Amount" value="" required>
                    </div>

                    <div class="form-group">
                        <label>Address Shipping</label>
                        <textarea name="address_shipping" placeholder="Address Shipping" class="form-control text-address-shipping" required></textarea>
                        <textarea name="address_shipping_customer" class="form-control text-address-shipping-customer">{{$value->address}}</textarea>
                        <input type="checkbox" class="address-customer"> Same as Customer Address
                    </div>

                    <div class="form-group">
                        <label>Order Date</label>
                        <input type="text" class="form-control" name="order_date"  placeholder="Order Date" value="">
                    </div>

                    <div class="form-group">
                        <label>Return?</label><br>
                        <input type="checkbox" name="return" id="return_checkbox"> Set this Order as Return Order
                    </div>

                    <div class="form-group" id="return_order_group" style="display:none;">
                        <label>Return Order</label>
                        <select class="form-control" id="return-order-selectpicker" name="return_order" placeholder="Return Order">
                            @foreach($data['orderAll'] as $key=>$value)
                                <option value="{{$value->id}}">#{{$value->id}} {{$value->channel->channel_name}} {{$value->customer->first_name}} {{$value->customer->last_name}} {{$value->total_price}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                <button class="btn btn-primary btn-block" type="submit">Add New Order</button>
                </div>
            </form>
        </div>
        </div>
    </div>

    <!-- Modal Edit-->
    @foreach ($data['order'] as $key=>$value)
    <div class="modal fade" id="edit-{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form" action="{{route('order.edit', $value->id)}}" method="post">
                @csrf
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Order {{$value->order_name}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Channel</label>
                        <select class="form-control" name="channel_id" placeholder="Channel" required>
                            @foreach($data['channel'] as $keysize=>$valuechannel)
                                @if($valuechannel->id == $value->channel_id)
                                    <option value="{{$valuechannel->id}}" selected>{{$valuechannel->channel_name}}</option>
                                @else
                                    <option value="{{$valuechannel->id}}">{{$valuechannel->channel_name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Customer</label>
                        <select class="form-control" id="customer-selectpicker-edit" name="customer_id" placeholder="Customer" required>
                            @foreach($data['customer'] as $keysize=>$valuecustomer)
                                @if($valuecustomer->id == $value->customer_id)
                                    <option value="{{$valuecustomer->id}}" selected>{{$valuecustomer->first_name}} {{$valuecustomer->last_name}} ({{$valuecustomer->phone}})</option>
                                @else
                                    <option value="{{$valuecustomer->id}}">{{$valuecustomer->first_name}} {{$valuecustomer->last_name}} ({{$valuecustomer->phone}})</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Discount Amount</label>
                        <input type="number" min="0" class="form-control" name="discount_amount" placeholder="Discount Amount" value="{{$value->discount_amount}}" required>
                    </div>

                    <div class="form-group">
                        <label>Address Shipping</label>
                        <textarea name="address_shipping" placeholder="Address Shipping" class="form-control" required>{{$value->address_shipping}}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Order Date</label>
                        <input type="text" class="form-control" name="order_date"  placeholder="Order Date" value="{{$value->order_date}}">
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
    @foreach ($data['order'] as $key=>$value)
    <div class="modal fade" id="delete-{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete {{$value->order_name}}?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form class="form" action="{{route('order.delete', $value->id)}}" method="post">
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

