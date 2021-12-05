@extends('layouts.application_admin')
@section('pagetitle', 'Setting Order')
@section('content')

    <table data-toggle="table" data-pagination="true"
    data-search="true"
    data-toolbar="#toolbar">
        <thead>
        <tr>
            <th data-field="id" data-visible="false">ID</th>
            <th data-field="order_fee" data-sortable="true">Order Fee</th>
            <th data-field="active" data-sortable="true">Active</th>
            <th data-formatter="TableActions">Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($data['setting_order'] as $key=>$value)
                <tr>
                    <td>{{$value->id}}</td>
                    <td>{{$value->order_fee}}</td>
                    <td>
                        @if($value->active)
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

            function TableActions (value, row, index) {
                return [
                    '<a class="text-warning" href="#" data-toggle="modal" data-target="#edit-',row.id,'">',
                    '<i class="fas fa-edit"></i>',
                    '</a> ',
                    '</a>'
                ].join('');
            }
        </script>
   
@endsection

@section('modals')
    <!-- Modal Edit-->
    @foreach ($data['setting_order'] as $key=>$value)
    <div class="modal fade" id="edit-{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form" action="{{route('setting.order.edit', $value->id)}}" method="post">
                @csrf
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Promo {{$value->promo_name}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Order Fee</label>
                        <input type="number" class="form-control" name="order_fee" placeholder="Order Fee" min="0" value="{{$value->order_fee}}">
                    </div>
                    <div class="form-group">
                        <label>Active</label>
                        <select class="form-control" name="active" placeholder="Active" required>
                            @if($value->active)
                                <option value="1" selected>Enable</option>
                                <option value="0">Disable</option>
                            @else
                                <option value="1">Enable</option>
                                <option value="0" selected>Disable</option>
                            @endif
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

@endsection

