@extends('layouts.application_admin')
@section('pagetitle', 'Production Request')
@section('breadcrumb') 
    <a class="btn btn-sm btn-link float-right" href="{{route('production.request')}}"><i class="fas fa-arrow-left"></i> Back</button></a>
@endsection
@section('content')

    
    <div class="card">
        <div class="card-body">
            <label>PO Code</label>: {{ $data['purchasing']->po_code}} ({{ $data['purchasing']->item}} {{ $data['purchasing']->unit}} Unit)<br>
            <label>Period</label>: {{$data['period']}}
        </div>
    </div>

    <div id="toolbar">
        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#add"><i class="fas fa-plus"></i></button>
    </div>

    <table data-toggle="table" data-pagination="true"
    data-search="true"
    data-toolbar="#toolbar"
    data-filter-control="true">
        <thead>
        <tr>
            <th data-field="id" data-visible="false">ID</th>
            <th data-field="product" data-sortable="true" data-filter-control="select">Product</th>
            <th data-field="request" data-sortable="true">Request</th>
            <th data-field="request_date" data-sortable="true">Date</th>
            <th data-formatter="TableActions">Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($data['production'] as $key=>$value)
                <tr>
                    <td>{{$value->id}}</td>
                    <td>{{$value->productDetail->product->product_name}} {{$value->productDetail->product->color->color_name}} {{$value->productDetail->product->category->category_name}} {{$value->productDetail->size->size_name}}</td>
                    <td>{{$value->request}}</td>
                    <td>{{ date_beautify($value->request_date) }}</td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
        </table>
@endsection

@section('additionalJs')
        <script>

            $(function() {
                $('input[name="request_date"]').daterangepicker({
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
            <form class="form" action="{{route('production.request.append')}}" method="post">
                @csrf
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Append New Production Request</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>PO Code</label>
                        <select class="form-control" name="purchasing_id" placeholder="PO Code" readonly required>
                            <option value="{{$data['purchasing']->id}}" selected>{{$data['purchasing']->po_code}} - {{$data['purchasing']->item}} {{$data['purchasing']->unit}}</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Product</label>
                        <select class="form-control" name="product_detail_id" placeholder="Product" required>
                            @foreach($data['product_detail'] as $key=>$value)
                                <option value="{{$value->id}}">{{$value->product->product_name}} {{$value->size->size_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Request</label>
                        <input type="number" class="form-control" min="0" name="request" placeholder="Request" value="0" required>
                    </div>

                    <div class="form-group">
                        <label>Request Date</label>
                        <input type="text" class="form-control" name="request_date"  placeholder="Request Date" value="" required>
                    </div>

                    <input type="hidden" name="month" value="{{$data['month']}}">
                    <input type="hidden" name="year" value="{{$data['year']}}">
                </div>
                <div class="modal-footer">
                <button class="btn btn-primary btn-block" type="submit">Append New Production</button>
                </div>
            </form>
        </div>
        </div>
    </div>

    <!-- Modal Edit-->
    @foreach ($data['production'] as $key=>$value)
    <div class="modal fade" id="edit-{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form" action="{{route('production.request.edit', $value->id)}}" method="post">
                @csrf
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Production Request {{$value->purchasing->po_code}} - {{$value->purchasing->item}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Request</label>
                        <input type="number" class="form-control" min="0" name="request" placeholder="Request" value="{{$value->request}}" required>
                    </div>
                    <div class="form-group">
                        <label>Request Date</label>
                        <input type="text" class="form-control" name="request_date"  placeholder="Request Date" value="{{$value->request_date}}" required>
                    </div>
                    <input type="hidden" name="month" value="{{$data['month']}}">
                    <input type="hidden" name="year" value="{{$data['year']}}">
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
    @foreach ($data['production'] as $key=>$value)
    <div class="modal fade" id="delete-{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete {{$value->production_name}}?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form class="form" action="{{route('production.request.delete', $value->id)}}" method="post">
                    @csrf
                    {{ method_field ('DELETE') }}
                    <input type="hidden" name="month" value="{{$data['month']}}">
                    <input type="hidden" name="year" value="{{$data['year']}}">
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

