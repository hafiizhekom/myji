@extends('layouts.application_admin')
@section('pagetitle', 'Channel')
@section('content')

    <div id="toolbar">
        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#add"><i class="fas fa-plus"></i></button>
    </div>

    <table data-toggle="table"
    data-search="true"
    data-toolbar="#toolbar">
        <thead>
        <tr>
            <th data-field="id" data-visible="false">ID</th>
            <th data-field="channel_name" data-sortable="true">Channel Name</th>
            <th data-field="fixed_fee" data-sortable="true">Fixed Fee</th>
            <th data-field="percentage_fee" data-sortable="true">Percentage Fee</th>
            <th data-field="active" data-sortable="true">Active</th>
            <th data-formatter="TableActions">Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($data['channel'] as $key=>$value)
                <tr>
                    <td>{{$value->id}}</td>
                    <td>{{$value->channel_name}}</td>
                    <td>{{$value->fixed_fee}}</td>
                    <td>{{$value->percentage_fee}}</td>
                    <td>
                        @if($value->active == 1)
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
            <form class="form" action="{{route('channel.add')}}" method="post">
                @csrf
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Channel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Channel Name</label>
                        <input type="text" class="form-control" name="channel_name" placeholder="Channel Name" value="">
                    </div>

                    <div class="form-group">
                        <label>Fixed Fee</label>
                        <input type="number" class="form-control" name="fixed_fee" placeholder="Fixed Fee" value="">
                    </div>

                    <div class="form-group">
                        <label>Percentage Fee</label>
                        <input type="number" class="form-control" name="percentage_fee" placeholder="Percentage Fee" value="">
                    </div>

                    <div class="form-group">
                        <label>Active</label>
                        <select class="form-control" name="active" placeholder="Active">
                            <option value="1">Active</option>
                            <option value="0">Not Active</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                <button class="btn btn-primary btn-block" type="submit">Add New Channel</button>
                </div>
            </form>
        </div>
        </div>
    </div>

    <!-- Modal Edit-->
    @foreach ($data['channel'] as $key=>$value)
    <div class="modal fade" id="edit-{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form" action="{{route('channel.edit', $value->id)}}" method="post">
                @csrf
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Channel {{$value->channel_name}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Channel Name</label>
                        <input type="text" class="form-control" name="channel_name" placeholder="Channel Name" value="{{$value->channel_name}}">
                    </div>

                    <div class="form-group">
                        <label>Fixed Fee</label>
                        <input type="number" class="form-control" name="fixed_fee" placeholder="Fixed Fee" value="{{$value->fixed_fee}}">
                    </div>

                    <div class="form-group">
                        <label>Percentage Fee</label>
                        <input type="number" class="form-control" name="percentage_fee" placeholder="Percentage Fee" value="{{$value->percentage_fee}}">
                    </div>

                    <div class="form-group">
                        <label>Active</label>
                        <select class="form-control" name="active" placeholder="Active">
                            @if($value->active == 1)
                                <option value="1" selected>Active</option>
                                <option value="0">Not Active</option>
                            @else
                                <option value="1">Active</option>
                                <option value="0" selected>Not Active</option>
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
    @foreach ($data['channel'] as $key=>$value)
    <div class="modal fade" id="delete-{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete {{$value->channel_name}}?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form class="form" action="{{route('channel.delete', $value->id)}}" method="post">
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

