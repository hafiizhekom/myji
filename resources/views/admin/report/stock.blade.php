@extends('layouts.application_admin')
@section('pagetitle', 'Stock Report')
@section('content')

    <div id="toolbar">
        
    </div>

    <table data-toggle="table"
    data-search="true"
    data-toolbar="#toolbar"
    data-search-highlight="true"
    data-filter-control="true"
    >
        <colgroup>
            <col></col>
            <col></col>
            <col></col>
            <col></col>
            <col class="bg-info"></col>
            <col class="bg-danger"></col>
            <col class="bg-warning"></col>
            <col class="bg-warning"></col>
            <col class="bg-info"></col>
            <col class="bg-info"></col>
            <col class="bg-danger"></col>
            <col class="bg-danger"></col>
            <col class="bg-danger"></col>
            <col class="bg-info"></col>
        </colgroup>
        <thead>
        <tr>
            <th data-field="id" data-visible="false">ID</th>
            <th data-field="product" data-sortable="true" data-filter-control="select">Product</th>
            <th data-field="size" data-sortable="true" data-filter-control="select">Size</th>
            <th data-field="color" data-sortable="true" data-filter-control="select">Color</th>
            <th data-field="category" data-sortable="true" data-filter-control="select">Category</th>
            <th data-field="actual" data-sortable="true" data-filter-control="input">Production Actual <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="Data Production Actual"></i></th>
            <th data-field="defect" data-sortable="true" data-filter-control="input">Production Defect <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="Data Produciton Defect"></i></th>
            <th data-field="sold" data-sortable="true" data-filter-control="input">Sold <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="Data Order Success"></i></th>
            <th data-field="return_actual_minus" data-sortable="true" data-filter-control="input">Return Outcoming <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="Data Order Return"></i></th>
            <th data-field="return_actual" data-sortable="true" data-filter-control="input">Return Incoming <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="Data Order Detail Return Item to Actual"></i></th>
            <th data-field="refund_actual" data-sortable="true" data-filter-control="input">Refund Incoming <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="Data Order Detail Refund Amount to Actual"></i></th>
            <th data-field="return_defect" data-sortable="true" data-filter-control="input">Return Defect <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="Data Order Detail Return Item to Defect"></i></th>
            <th data-field="refund_defect" data-sortable="true" data-filter-control="input">Refund Defect <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="Data Order Detail Refund Amount to Defect"></i></th>
            <th data-field="stockdefect" data-sortable="true" data-filter-control="input">Defect</th>
            <th data-field="stock" data-sortable="true" data-filter-control="input">Stock</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($data['stock'] as $key=>$value)
                <tr>
                    <td>{{$key}}</td>
                    <td>{{$value['product']->product->product_name}}</td>
                    <td>{{$value['product']->size->size_name}}</td>
                    <td>{{$value['product']->color->color_name}}</td>
                    <td>{{$value['product']->category->category_name}}</td>
                    <td>{{$value['actual']}}</td>
                    <td>{{$value['defect']}}</td>
                    <td>{{$value['sold']}}</td>
                    <td>{{$value['return_actual_minus']}}</td>
                    <td>{{$value['return_actual']}}</td>
                    <td>{{$value['refund_actual']}}</td>
                    <td>{{$value['return_defect']}}</td>
                    <td>{{$value['refund_defect']}}</td>
                    <td>{{$value['stockdefect']}}</td>
                    <td>{{$value['stock']}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection



@section('additionalJs')
        <script>
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })
        </script>
   
@endsection