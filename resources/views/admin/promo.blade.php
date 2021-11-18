@extends('layouts.application_admin')
@section('pagetitle', 'Promo')
@section('content')

    <div id="toolbar">
        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#add"><i class="fas fa-plus"></i></button>
    </div>

    <table data-toggle="table" data-pagination="true"
    data-search="true"
    data-toolbar="#toolbar">
        <thead>
        <tr>
            <th data-field="id" data-visible="false">ID</th>
            <th data-field="promo_name" data-sortable="true">Promo Name</th>
            <th data-field="fixed_amount" data-sortable="true">Fixed Amount</th>
            <th data-field="start_time" data-sortable="true">Start Time</th>
            <th data-field="end_time" data-sortable="true">End Time</th>
            <th data-field="active" data-sortable="true">Active</th>
            <th data-formatter="TableActions">Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($data['promo'] as $key=>$value)
                <tr>
                    <td>{{$value->id}}</td>
                    <td>{{$value->promo_name}}</td>
                    <td>{{$value->fixed_amount}}</td>
                    <td>{{$value->start_time}}</td>
                    <td>{{$value->end_time}}</td>
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

            $(function() {
                $('input[name="promo_date"]').daterangepicker({
                    locale: {
                        format: 'YYYY/MM/DD'
                    }
                });
            });

            function TableActions (value, row, index) {
                return [
                    '<a class="text-info" href="/admin/promo/detail/',row.id,'">',
                    '<i class="fas fa-info-circle"></i>',
                    '</a> ',
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
            <form class="form" action="{{route('promo.add')}}" method="post">
                @csrf
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Promo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Promo Name</label>
                        <input type="text" class="form-control" name="promo_name" placeholder="Promo Name" value="">
                    </div>

                    <div class="form-group">
                        <label>Fixed Amount</label>
                        <input type="number" class="form-control" name="fixed_amount" placeholder="Fixed Amount" min="0" value="">
                    </div>

                    <div class="form-group">
                        <label>Promo Date</label>
                        <input type="text" class="form-control" name="promo_date"  placeholder="Promo Date" value="">
                    </div>

                    <div class="form-group">
                        <label>Active</label>
                        <select class="form-control" name="active" placeholder="Active" required>
                            <option value="1">Enable</option>
                            <option value="0">Disable</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                <button class="btn btn-primary btn-block" type="submit">Add New Promo</button>
                </div>
            </form>
        </div>
        </div>
    </div>

    <!-- Modal Edit-->
    @foreach ($data['promo'] as $key=>$value)
    <div class="modal fade" id="edit-{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form" action="{{route('promo.edit', $value->id)}}" method="post">
                @csrf
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Promo {{$value->promo_name}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Promo Name</label>
                        <input type="text" class="form-control" name="promo_name" placeholder="Promo Name" value="{{$value->promo_name}}">
                    </div>

                    <div class="form-group">
                        <label>Fixed Amount</label>
                        <input type="number" class="form-control" name="fixed_amount" placeholder="Fixed Amount" min="0" value="{{$value->fixed_amount}}">
                    </div>

                    <div class="form-group">
                        <label>Promo Date</label>
                        <input type="text" class="form-control" name="promo_date"  placeholder="Promo Date" value="{{$value->promo_date}}">
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

    <!-- Modal Delete-->
    @foreach ($data['promo'] as $key=>$value)
    <div class="modal fade" id="delete-{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete {{$value->promo_name}}?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form class="form" action="{{route('promo.delete', $value->id)}}" method="post">
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

