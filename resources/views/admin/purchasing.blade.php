@extends('layouts.application_admin')
@section('pagetitle', 'Purchasing')
@section('content')

    <div id="toolbar">
        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#add"><i class="fas fa-plus"></i></button>
    </div>

    <table data-toggle="table"
    data-search="true"
    data-toolbar="#toolbar">
        <thead>
        <tr>
            <th data-field="id" data-visible="false">ID</th>
            <th data-field="po_code" data-sortable="true">PO Code</th>
            <th data-field="supplier_name" data-sortable="true">Supplier Name</th>
            <th data-field="item" data-sortable="true">Item</th>
            <th data-field="unit" data-sortable="true">Unit</th>
            <th data-field="unit_price" data-sortable="true">Unit Price</th>
            <th data-field="discount_amount" data-sortable="true">Discount Amount</th>
            <th data-field="discount_percentage" data-sortable="true">Discount Percentage</th>
            <th data-field="total_price" data-sortable="true">Total Price</th>
            <th data-field="shipping_cost" data-sortable="true">Shipping Cost</th>
            <th data-field="total_price_with_shipping" data-sortable="true">Total Price with Shipping Cost</th>
            <th data-field="order_date" data-sortable="true">Order Date</th>
            <th data-field="estimation_date" data-sortable="true">Estimation Date</th>
            <th data-formatter="TableActions">Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($data['purchasing'] as $key=>$value)
                <tr>
                    <td>{{$value->id}}</td>
                    <td>{{$value->po_code}}</td>
                    <td>{{$value->supplier_name}}</td>
                    <td>{{$value->item}}</td>
                    <td>{{number_format($value->unit,2,',','.')}}</td>
                    <td>{{number_format($value->unit_price,0,',','.')}}</td>
                    <td>{{$value->discount_amount}}</td>
                    <td>{{$value->discount_percentage}}</td>
                    <td>{{number_format($value->total_price,0,',','.')}}</td>
                    <td>{{number_format($value->shipping_cost,0,',','.')}}</td>
                    <td>{{number_format($value->total_price_with_shipping,0,',','.')}}</td>
                    <td>{{$value->order_date}}</td>
                    <td>{{$value->estimation_date}}</td>
                    
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
        </script>


        <script>

            function calculate_totalprice_add(){
                var unit = parseFloat($('#addunit').val());
                var price = parseInt($('#addprice').val());
                var total_price = unit * price;

                var discount_amount = parseInt($('#adddiscountamount').val());
                var discount_percentage = parseInt($('#adddiscountpercentage').val());
                
                var discount_percentage_val = discount_percentage * total_price / 100;

                total_price = total_price - discount_amount - discount_percentage_val;

                $('#addtotalprice').val(total_price);

                var shipping = parseInt($('#addshippingcost').val());
                var total_price_shipping = total_price + shipping;

                $('#addtotalpriceshipping').val(total_price_shipping);
            }
            function calculate_totalprice_edit(id){
                
                var unit = parseInt($('#editunit-'+id).val());
                var price = parseInt($('#editprice-'+id).val());
                var total_price = unit * price;

                var discount_amount = parseInt($('#editdiscountamount-'+id).val());
                var discount_percentage = parseInt($('#editdiscountpercentage-'+id).val());
                
                var discount_percentage_val = discount_percentage * total_price / 100;

                total_price = total_price - discount_amount - discount_percentage_val;
                
                $('#edittotalprice-'+id).val(total_price);

                var shipping = parseInt($('#editshippingcost-'+id).val());
                var total_price_shipping = total_price + shipping;

                $('#edittotalpriceshipping-'+id).val(total_price_shipping);
            }

            

            $(document).ready(function () {

                $('input[name="order_date"]').daterangepicker({
                    singleDatePicker: true,
                    locale: {
                        format: 'YYYY/MM/DD'
                    }
                });

                $('input[name="estimation_date"]').daterangepicker({
                    singleDatePicker: true,
                    locale: {
                        format: 'YYYY/MM/DD'
                    }
                });


                $('#addunit').keyup(function() {
                    calculate_totalprice_add();
                });

                $("#addunit").bind('click', function () {
                    calculate_totalprice_add();         
                });

                $('#addprice').keyup(function() {
                    calculate_totalprice_add();
                });

                $("#addprice").bind('click', function () {
                    calculate_totalprice_add();         
                });

                $('#adddiscountamount').keyup(function() {
                    calculate_totalprice_add();
                });

                $("#adddiscountamount").bind('click', function () {
                    calculate_totalprice_add();         
                });

                $('#adddiscountpercentage').keyup(function() {
                    calculate_totalprice_add();
                });

                $("#adddiscountpercentage").bind('click', function () {
                    calculate_totalprice_add();         
                });

                $('#addshippingcost').keyup(function() {
                    calculate_totalprice_add();
                });

                $("#addshippingcost").bind('click', function () {
                    calculate_totalprice_add();         
                });
               
            });

        </script>
   
@endsection

@section('modals')
    <!-- Modal Add-->
    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form" action="{{route('purchasing.add')}}" method="post">
                @csrf
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Purchasing</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>PO Code</label>
                        <input type="text" class="form-control" name="po_code" placeholder="PO Code" value="" required>
                    </div>

                    <div class="form-group">
                        <label>Supplier Name</label>
                        <input type="text" class="form-control" name="supplier_name" placeholder="Supplier Name" value="" required>
                    </div>

                    <div class="form-group">
                        <label>Item</label>
                        <input type="text" class="form-control" name="item" placeholder="Item" value="" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Unit</label>
                        <input type="number" class="form-control" id="addunit" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" min="0" name="unit" placeholder="Unit" value="0" required>
                    </div>

                    <div class="form-group">
                        <label>Unit Price</label>
                        <input type="number" class="form-control" id="addprice" min="0" name="unit_price" placeholder="Unit Price" value="0" required>
                    </div>

                    <div class="form-group">
                        <label>Discount Amount</label>
                        <input type="number" class="form-control" min="0" id="adddiscountamount" name="discount_amount" placeholder="Discount Amount" value="0" required>
                    </div>

                    <div class="form-group">
                        <label>Discount Percentage</label>
                        <input type="number" class="form-control" min="0" max="100" id="adddiscountpercentage" name="discount_percentage" placeholder="Discount Percentage" value="0" required>
                    </div>

                    <div class="form-group">
                        <label>Total Price</label>
                        <input type="text" class="form-control" min="0" id="addtotalprice" name="total_price" placeholder="Total Price" value="" readonly="readonly" required>
                    </div>

                    <div class="form-group">
                        <label>Shipping Cost</label>
                        <input type="number" class="form-control" id="addshippingcost" min="0" name="shipping_cost" placeholder="Shipping Cost" value="0" required>
                    </div>

                    <div class="form-group">
                        <label>Total Price With Shipping Cost</label>
                        <input type="text" class="form-control" min="0" id="addtotalpriceshipping" name="total_price_with_shipping" placeholder="Total Price With Shipping Cost" value="" readonly="readonly" required>
                    </div>

                    <div class="form-group">
                        <label>Order Date</label>
                        <input type="text" class="form-control" name="order_date"  placeholder="Order Date" value="">
                    </div>

                    <div class="form-group">
                        <label>Estimation Date</label>
                        <input type="text" class="form-control" name="estimation_date"  placeholder="Estimation Date" value="">
                    </div>
                </div>
                <div class="modal-footer">
                <button class="btn btn-primary btn-block" type="submit">Add New Purchasing</button>
                </div>
            </form>
        </div>
        </div>
    </div>

    <!-- Modal Edit-->
    @foreach ($data['purchasing'] as $key=>$value)
    <div class="modal fade" id="edit-{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form" action="{{route('purchasing.edit', $value->id)}}" method="post">
                @csrf
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Purchasing {{$value->purchasing_name}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>PO Code</label>
                        <input type="text" class="form-control" name="po_code" placeholder="PO Code" value="{{$value->po_code}}" required>
                    </div>

                    <div class="form-group">
                        <label>Supplier Name</label>
                        <input type="text" class="form-control" name="supplier_name" placeholder="Supplier Name" value="{{$value->supplier_name}}" required>
                    </div>

                    <div class="form-group">
                        <label>Item</label>
                        <input type="text" class="form-control" name="item" placeholder="Item" value="{{$value->item}}" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Unit</label>
                        <input type="number" class="form-control" id="editunit-{{$value->id}}" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" onkeyup="calculate_totalprice_edit({{$value->id}})" min="0" name="unit" placeholder="Unit" value="{{$value->unit}}" required>
                    </div>

                    <div class="form-group">
                        <label>Unit Price</label>
                        <input type="number" class="form-control" id="editprice-{{$value->id}}" onkeyup="calculate_totalprice_edit({{$value->id}})" min="0" name="unit_price" placeholder="Unit Price" value="{{$value->unit_price}}" required>
                    </div>

                    <div class="form-group">
                        <label>Discount Amount</label>
                        <input type="number" class="form-control" min="0" id="editdiscountamount-{{$value->id}}" onkeyup="calculate_totalprice_edit({{$value->id}})" name="discount_amount" placeholder="Discount Amount" value="{{$value->discount_amount}}" required>
                    </div>

                    <div class="form-group">
                        <label>Discount Percentage</label>
                        <input type="number" class="form-control" min="0" max="100" id="editdiscountpercentage-{{$value->id}}" onkeyup="calculate_totalprice_edit({{$value->id}})" name="discount_percentage" placeholder="Discount Percentage" value="{{$value->discount_percentage}}" required>
                    </div>

                    <div class="form-group">
                        <label>Total Price</label>
                        <input type="text" class="form-control" min="0" id="edittotalprice-{{$value->id}}" name="total_price" placeholder="Total Price" value="{{$value->total_price}}" readonly="readonly" required>
                    </div>

                    <div class="form-group">
                        <label>Shipping Cost</label>
                        <input type="number" class="form-control" id="editshippingcost-{{$value->id}}" onkeyup="calculate_totalprice_edit({{$value->id}})" min="0" name="shipping_cost" placeholder="Shipping Cost" value="{{$value->shipping_cost}}" required>
                    </div>

                    <div class="form-group">
                        <label>Total Price With Shipping Cost</label>
                        <input type="text" class="form-control" min="0" id="edittotalpriceshipping-{{$value->id}}" name="total_price_with_shipping" placeholder="Total Price With Shipping Cost" value="{{$value->total_price_with_shipping}}" readonly="readonly" required>
                    </div>

                    <div class="form-group">
                        <label>Order Date</label>
                        <input type="text" class="form-control" name="order_date"  placeholder="Order Date" value="{{$value->order_date}}">
                    </div>

                    <div class="form-group">
                        <label>Estimation Date</label>
                        <input type="text" class="form-control" name="estimation_date"  placeholder="Estimation Date" value="{{$value->estimation_date}}">
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
    @foreach ($data['purchasing'] as $key=>$value)
    <div class="modal fade" id="delete-{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete {{$value->purchasing_name}}?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form class="form" action="{{route('purchasing.delete', $value->id)}}" method="post">
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

