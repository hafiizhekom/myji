@extends('layouts.application_admin')
@section('pagetitle', 'Order Detail')
@section('breadcrumb')
    <a class="btn btn-sm btn-link float-right" href="{{route('order')}}"><i class="fas fa-arrow-left"></i> Back</button></a>
@endsection
@section('content')


    <div class="card">
        <div class="card-body">
            <label>Order ID</label>: #{{$data['order']->id}}<br>
            <label>Channel</label>: {{$data['order']->channel->channel_name}}<br>
            <label>Customer</label>: {{$data['order']->customer->first_name}} {{$data['order']->customer->last_name}} ({{$data['order']->customer->email}})<br>
            <label>Discount Amount</label>: {{number_format($data['order']->discount_amount,0,',','.')}}<br>
            <label>Address Shipping</label>: {{$data['order']->address_shipping}}<br>
            <label>Total Price</label>: {{number_format($data['order']->total_price,0,',','.')}}<br>
            <label>Order Date</label>: {{$data['order']->order_date}}<br>
            <label>Order Type</label>: {{$data['order']->type_order}}<br>
            @if($data['order']->type_order == "return")
                <label>Return Order</label>: #{{$data['order']->return_order}}<br>
            @endif
        </div>
    </div>


    <div id="toolbar">
        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#add"><i class="fas fa-plus"></i></button>
    </div>

    <table data-toggle="table" data-pagination="true"
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
            <th data-field="price" data-sortable="true">Price</th>
            <th data-field="total_price" data-sortable="true">Total Price</th>
            <th data-field="status" data-sortable="true">Status</th>
            <th data-formatter="TableActions">Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach($data['orderDetail'] as $key=>$value)
                <tr>
                    <td>{{$value->id}}</td>
                    <td>{{$value->productDetail->product->product_name}}</td>
                    <td>{{$value->productDetail->size->size_name}}</td>
                    <td>{{$value->productDetail->product->color->color_name}}</td>
                    <td>{{$value->productDetail->product->category->category_name}}</td>
                    <td>{{$value->quantity}}</td>
                    <td>{{number_format($value->price,0,',','.')}}</td>
                    <td>{{number_format($value->total_price,0,',','.')}}</td>
                    <td>{{ucfirst($value->status)}}</td>
                    <td></td>
                </tr>
            @endforeach 
        </tbody>
        </table>
@endsection

@section('additionalJs')
        <script type='text/javascript'>
            @php
                $price_json = json_encode($data['price']);
                echo "var price = ". $price_json . ";\n";
            @endphp
        </script>
        <script>

            $(function() {
                

                $(".product-detail-add-selectpicker").change(function(){
                    $(".addprice").val(price[$(this).val()]);
                });

                $(".product-detail-edit-selectpicker").change(function(){
                    console.log($(this).data("id"));
                    $("#editprice-"+$(this).data("id")).val(price[$(this).val()]);
                });

                $('input[name="order_date"]').daterangepicker({
                    singleDatePicker: true,
                    locale: {
                        format: 'YYYY/MM/DD'
                    }
                });

                $(".addprice").keyup(function(){
                    var total_price = $(this).val() * $(".addquantity").val();
                    $(".addtotalprice").val(total_price);
                });

                $(".addquantity").keyup(function(){
                    var total_price = $(this).val() * $(".addprice").val();
                    $(".addtotalprice").val(total_price);
                });

                $(".editprice").keyup(function(){
                    var total_price = $(this).val() * $(".editquantity").val();
                    $(".edittotalprice").val(total_price);
                });

                $(".editquantity").keyup(function(){
                    var total_price = $(this).val() * $(".editprice").val();
                    $(".edittotalprice").val(total_price);
                });

                $('.custom-add-totalprice').change(function() {
                    if(this.checked) {
                        $(".addtotalprice").attr("readonly", false); 
                    }else{
                        $(".addtotalprice").attr("readonly", true); 
                    }
                });

                $('.custom-edit-totalprice').change(function() {
                    if(this.checked) {
                        $(".edittotalprice").attr("readonly", false); 
                    }else{
                        $(".edittotalprice").attr("readonly", true); 
                    }
                });



            });

            

            function TableActions (value, row, index) {
                var statusAction = '';
                    
                if(row.status=='Success'){
                    statusAction = ['<a class="text-success" href="#" data-toggle="modal" data-target="#re-',row.id,'">',
                    '<i class="fas fa-exchange-alt"></i>',
                    '</a> '].join('');
                }
                     
                
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
            <form class="form" action="{{route('order_detail.add', $data['order']->id)}}" method="post">
                @csrf
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Order Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Product</label>
                        <select class="form-control product-detail-add-selectpicker" name="product_detail_id" placeholder="Product" required>
                            @foreach($data['productDetail'] as $key=>$value)
                                <option value="{{$value->id}}">{{$value->product->product_name}} {{$value->size->size_name}} {{$value->product->color->color_name}} {{$value->product->category->category_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="number" min="0" class="form-control addquantity" name="quantity" placeholder="Quantity" value="0" required>
                    </div>

                    <div class="form-group">
                        <label>Price</label>
                        <input type="number" min="0" class="form-control addprice" name="price" placeholder="Price" value="{{$data['productDetail'][0]->price}}" readonly required>
                    </div>

                    <div class="form-group">
                        <label>Total Price</label>
                        <input type="number" min="0" class="form-control addtotalprice" name="total_price" placeholder="Total Price" value="0" readonly required>
                        <input type="checkbox" class="custom-add-totalprice"> Custom Total Price
                    </div>
                </div>
                <div class="modal-footer">
                <button class="btn btn-primary btn-block" type="submit">Add New Order Detail</button>
                </div>
            </form>
        </div>
        </div>
    </div>

    <!-- Modal Refund-->
    @foreach ($data['orderDetail'] as $key=>$value)
    <div class="modal fade" id="re-{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form" action="{{route('refund.add')}}" method="post">
                @csrf
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Refund/Return Order {{$value->order_name}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">

                    <input type="hidden" name="order_detail_id" value="{{$value->id}}">

                    <div class="form-group">
                        <label>Reason</label>
                        <textarea placeholder="Reason" name="reason" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="number" placeholder="Quantity" name="quantity" class="form-control" min="1" max="2" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Type</label>
                        <select class="form-control" name="type" placeholder="Type" required>
                            <option value="refund">Amount (Refund)</option>
                            <option value="return">Item (Return)</option>
                        </select>
                        <p><small>Untuk barang yang diganti, silahkan untuk membuat order baru kembali</small></p>
                    </div>

                    <div class="form-group">
                        <label>Stock Flow</label>
                        <select class="form-control" name="stock_flow" placeholder="Type" required>
                            <option value="actual">Actual</option>
                            <option value="defect">Defect</option>
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

    <!-- Modal Edit-->
    @foreach ($data['orderDetail'] as $key=>$value)
    <div class="modal fade" id="edit-{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form" action="{{route('order_detail.edit', ['id'=>$data['order']->id, 'iddetail'=>$value->id])}}" method="post">
                @csrf
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Order {{$value->order_name}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    
                    <div class="form-group">
                        <label>Product</label>
                        <select class="form-control product-detail-edit-selectpicker" name="product_detail_id" placeholder="Product" data-id="{{$value->id}}" required>
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

                    <div class="form-group">
                        <label>Price</label>
                        <input type="number" min="0" class="form-control editprice" id="editprice-{{$value->id}}" name="price" placeholder="Price" value="{{$value->price}}" readonly required>
                    </div>

                    <div class="form-group">
                        <label>Total Price</label>
                        <input type="number" min="0" class="form-control edittotalprice" name="total_price" placeholder="Total Price" value="{{$value->total_price}}" readonly required>
                        <input type="checkbox" class="custom-edit-totalprice"> Custom Total Price
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
    @foreach ($data['orderDetail'] as $key=>$value)
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
                <form class="form" action="{{route('order_detail.delete', ['id'=>$data['order']->id, 'iddetail'=>$value->id])}}" method="post">
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

