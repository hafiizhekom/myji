@extends('layouts.application_admin')
@section('pagetitle', 'Production Request')
@section('content')

<form class="form" method="get" action="{{route('production.request.search')}}">
    <div class="form-group">
        <label>PO Code</label>
        <select class="form-control" name="po_code" placeholder="PO Code" required>
            @foreach($data['production'] as $key=>$value)
                <option value="{{$value->purchasing->po_code}}">{{$value->purchasing->po_code}} - {{$value->purchasing->item}} {{$value->purchasing->unit}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <button class="btn btn-info btn-block" type="submit">Search</button>
    </div>
</form>
    <div class="form-group">
        <button class="btn btn-primary btn-block" type="button"  data-toggle="modal" data-target="#add">Add New Production Request</button>
    </div>

@endsection


@section('additionalJs')
        <script>
            $('.selectpicker').selectpicker();
        </script>

        <script>
            function selectproduct(){
                var product = $('#productrequest').val();
                var productDescElement = $('#productrequest option:selected');
                var productDescList = [];

                $.each(productDescElement, function() {
                    productDescList.push($(this).text());
                });

                console.log(productDescList);

                
                $('.requst_amount_area').empty();
                $.each(product, function( index, value ) {
                    
                    $('.requst_amount_area').append(' <div class="form-group"><label>Request '+productDescList[index]+'</label><input type="number" class="form-control" min="0" name="request-'+value+'" placeholder="Request" value="0" required></div>');
                });
            }
        </script>
@endsection


@section('modals')
    <!-- Modal Add-->
    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form" action="{{route('production.request.add')}}" method="post">
                @csrf
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Production Request</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>PO Code</label>
                        <select class="form-control" name="purchasing_id" placeholder="PO Code" required>
                            @foreach($data['purchasing'] as $key=>$value)
                                <option value="{{$value->id}}">{{$value->po_code}} - {{$value->item}} {{$value->unit}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Product</label>
                        <select class="form-control selectpicker" multiple data-live-search="true" id="productrequest" onchange="selectproduct()" name="product_detail_id[]" placeholder="Product" required>
                            @foreach($data['product_detail'] as $key=>$value)
                                <option value="{{$value->id}}">{{$value->product->product_name}} {{$value->size->size_name}}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="requst_amount_area">

                    </div>
                    
                </div>
                <div class="modal-footer">
                <button class="btn btn-primary btn-block" type="submit">Add New Production</button>
                </div>
            </form>
        </div>
        </div>
    </div>
@endsection
