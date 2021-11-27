@extends('layouts.application_admin')
@section('pagetitle', 'Estimation Stock Report')
@section('content')

    <div id="toolbar">
        
    </div>

    <table data-toggle="table" data-pagination="true"
    data-search="true"
    data-toolbar="#toolbar"
    data-search-highlight="true"
    data-filter-control="true"
    >
        <thead>
        <tr>
            <th data-field="id" data-visible="false">ID</th>
            <th data-field="product" data-sortable="true" data-filter-control="select">Product</th>
            <th data-field="stock" data-sortable="true" data-filter-control="input">Stock</th>
            <th data-field="request" data-sortable="true" data-filter-control="input">Request (Ongoing PO)</th>
            <th data-field="estimation" data-sortable="true" data-filter-control="input">Estimation</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($data['stock'] as $key=>$value)
                <tr>
                    <td>{{$key}}</td>
                    <td>{{$value['product_detail']->product->product_name}} {{$value['product_detail']->product->color->color_name}} {{$value['product_detail']->product->category->category_name}} {{$value['product_detail']->size->size_name}}</td>
                    <td>{{$value['stock']}}</td>
                    <td>{{$value['production_request']}}</td>
                    <td>{{$value['estimation_stock']}}</td>
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