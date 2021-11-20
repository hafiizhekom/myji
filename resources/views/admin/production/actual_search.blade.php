@extends('layouts.application_admin')
@section('pagetitle', 'Production Actual')
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

    <table data-toggle="table" data-pagination="true"
    data-search="true"
    data-toolbar="#toolbar"
    data-filter-control="true">
        <thead>
        <tr>
            <th data-field="id" data-visible="false">ID</th>
            <th data-field="product" data-sortable="true">Product</th>
            <th data-field="actual" data-sortable="true">Actual</th>
            <th data-field="complete" data-sortable="true" data-visible="false">Complete</th>
            <th data-field="complete_flag" data-sortable="true">Complete Flag</th>
            <th data-formatter="TableActions">Action</th>
        </tr>
        </thead>
        <tbody> 
            @foreach ($data['production'] as $key=>$value)
                <tr>
                    <td>{{$value->id}}</td>
                    <td>{{$value->productDetail->product->product_name}} {{$value->productDetail->product->color->color_name}} {{$value->productDetail->product->category->category_name}} {{$value->productDetail->size->size_name}}</td>
                    <td>
                        @if($value->actual)    
                            {{$value->actual}}
                        @else
                            <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#edit-{{$value->id}}" type="submit">Set Actual</button>
                        @endif
                    </td>
                    <td>{{$value->actual_complete}}</td>
                    <td>
                        @if($value->actual_complete)    
                            <i class="fas fa-check"></i>
                        @else
                            <i class="fas fa-times"></i>
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
                $('input[name="actual_date"]').daterangepicker({
                    singleDatePicker: true,
                    locale: {
                        format: 'YYYY/MM/DD'
                    }
                });
            });

            function TableActions (value, row, index) {
                var complete ="";
                if(row.complete==0){
                    var complete = ['<a class="text-success" href="#" data-toggle="modal" data-target="#complete-',row.id,'">' ,
                    '<i class="fas fa-check"></i>',
                    '</a>'].join('');
                }
                 
                return [
                    '<a class="text-warning" href="#" data-toggle="modal" data-target="#edit-',row.id,'">',
                    '<i class="fas fa-edit"></i>',
                    '</a> ',
                    '<a class="text-danger" href="#" data-toggle="modal" data-target="#delete-',row.id,'">' ,
                    '<i class="fas fa-eraser"></i>',
                    '</a> ',
                    complete
                ].join('');
            }
        </script>

   
@endsection

@section('modals')

    <!-- Modal Edit/Append-->
    @foreach($data['production'] as $key=>$value)
    
    <div class="modal fade" id="edit-{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form" action="{{route('production.actual.edit', $value->id)}}" method="post">
                @csrf
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                @if($value->actual)
                Edit
                @else
                Set
                @endif
                 Production Actual {{$value->purchasing->po_code}} - {{$value->purchasing->item}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Actual</label>
                        <input type="number" class="form-control" min="0" name="actual" placeholder="Request" value="{{$value->actual}}" required>
                    </div>

                    <div class="form-group">
                        <label>Actual Date</label>
                        <input type="text" class="form-control" name="actual_date"  placeholder="Request Date" value="{{$value->actual_date}}" required>
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
                <form class="form" action="{{route('production.actual.delete', $value->id)}}" method="post">
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

    <!-- Modal Complete-->
    @foreach ($data['production'] as $key=>$value)
    <div class="modal fade" id="complete-{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to complete {{$value->production_name}}?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form class="form" action="{{route('production.actual.complete', $value->id)}}" method="post">
                    @csrf
                    <input type="hidden" name="month" value="{{$data['month']}}">
                    <input type="hidden" name="year" value="{{$data['year']}}">
                    <div class="btn-group" style="width: 100%;">
                        <button type="submit" class="btn btn-success">Yes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                    
                </form>
            </div>
        </div>
        </div>
    </div>
    @endforeach
@endsection

