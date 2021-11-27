@extends('layouts.application_admin')
@section('pagetitle', 'Production Report')
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
            <th data-field="po_code" data-sortable="true" data-filter-control="select">PO</th>
            <th data-field="request" data-sortable="true" data-filter-control="input">Request</th>
            <th data-field="actual" data-sortable="true" data-filter-control="input">Actual</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($data as $key=>$value)
                <tr>
                    <td>{{$key}}</td>
                    <td>{{$value['po_code']}}</td>
                    <td>{{$value['request_stock']}}</td>
                    <td>{{$value['actual_stock']}}</td>
                    <td><a class="text-info" href="{{route('export.excel.production', ['id'=>$key])}}"><i class="fas fa-file-export"></i></a></td>
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