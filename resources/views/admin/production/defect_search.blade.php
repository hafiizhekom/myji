@extends('layouts.application_admin')
@section('pagetitle', 'Production Defect')
@section('content')

    <div class="card">
        <div class="card-body">
            <label>PO Code</label>: {{ $data['purchasing']->po_code}} ({{ $data['purchasing']->item}} {{ $data['purchasing']->unit}} Unit)<br>
            <label>Period</label>: {{$data['period']}}
        </div>
    </div>

    <table data-toggle="table" data-pagination="true"
    data-search="true"
    data-toolbar="#toolbar" 
    data-filter-control="true">
        <thead>
        <tr>
            <th data-field="id" data-visible="false">ID</th>
            <th data-field="product" data-sortable="true">Product</th>
            <th data-field="defect" data-sortable="true">Defect</th>
            <th data-field="reason_defect" data-sortable="true">Reason</th>
            <th data-formatter="TableActions">Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($data['production'] as $key=>$value)
                <tr>
                    <td>{{$value->id}}</td>
                    <td>{{$value->productDetail->product->product_name}} {{$value->productDetail->product->color->color_name}} {{$value->productDetail->product->category->category_name}} {{$value->productDetail->size->size_name}}</td>
                    <td>
                        @if($value->defect)    
                            {{$value->defect}}
                        @else
                            <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#edit-{{$value->id}}" type="submit">Set Defect</button>
                        @endif
                    </td>
                    <td>
                        @if(strlen($value->reason_defect)!=0)    
                            {{$value->reason_defect}}
                        @else
                            -
                        @endif
                    </td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
        </table>
@endsection

@section('additionalJs')
        <script>
            $(function() {
                $('input[name="defect_date"]').daterangepicker({
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
                    '<i class="fas fa-eraser"></i>',
                    '</a>'
                ].join('');
            }
        </script>

   
@endsection

@section('modals')
    
    <!-- Modal Edit-->
    @foreach ($data['production'] as $key=>$value)
    <div class="modal fade" id="edit-{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form" action="{{route('production.defect.edit', $value->id)}}" method="post">
                @csrf
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                @if($value->actual)
                Edit
                @else
                Set
                @endif
                 Production Defect {{$value->purchasing->po_code}} - {{$value->purchasing->item}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Defect</label>
                        <input type="number" class="form-control" min="0" name="defect" placeholder="Defect" value="{{$value->defect}}" required>
                    </div>
                    <div class="form-group">
                        <label>Defect Date</label>
                        <input type="text" class="form-control" name="defect_date"  placeholder="Defect Date" value="{{$value->defect_date}}" required>
                    </div>
                    <div class="form-group">
                        <label>Reason Defect</label>
                        <textarea class="form-control" name="reason_defect"  placeholder="Reason Defect" required>{{$value->reason_defect}}</textarea>
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
            <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to clear {{$value->production_name}}?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form class="form" action="{{route('production.defect.delete', $value->id)}}" method="post">
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

