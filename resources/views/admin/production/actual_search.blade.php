@extends('layouts.application_admin')
@section('pagetitle', 'Production Actual')
@section('subpagetitle', $data["purchasing"]->po_code.' '.$data["purchasing"]->item.''.$data["purchasing"]->unit)
@section('content')

    

    <table data-toggle="table"
    data-search="true"
    data-toolbar="#toolbar"
    data-filter-control="true">
        <thead>
        <tr>
            <th data-field="id" data-visible="false">ID</th>
            <th data-field="product" data-sortable="true">Product</th>
            <th data-field="request" data-sortable="true">Actual</th>
            <th data-formatter="TableActions">Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($data['production'] as $key=>$value)
                <tr>
                    <td>{{$value->id}}</td>
                    <td>{{$value->productDetail->product->product_name}} {{$value->productDetail->size->size_name}} {{$value->productDetail->color->color_name}}</td>
                    <td>
                        @if($value->actual)    
                            {{$value->actual}}
                        @else
                            <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#edit-{{$value->id}}" type="submit">Set Actual</button>
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
                <form class="form" action="{{route('production.actual.delete', $value->id)}}" method="post">
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

