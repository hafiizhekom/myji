@extends('layouts.application_admin')
@section('pagetitle', 'Customer')
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
            <th data-field="first_name" data-sortable="true">First Name</th>
            <th data-field="last_name" data-sortable="true">Last Name</th>
            <th data-field="gender" data-sortable="true">Gender</th>
            <th data-field="email" data-sortable="true">Email</th>
            <th data-field="phone" data-sortable="true">Phone</th>
            <th data-field="address" data-sortable="true">Address</th>
            <th data-formatter="TableActions">Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($data['customer'] as $key=>$value)
                <tr>
                    <td>{{$value->id}}</td>
                    <td>{{$value->first_name}}</td>
                    <td>{{$value->last_name}}</td>
                    <td>{{$value->gender}}</td>
                    <td>{{$value->email}}</td>
                    <td>{{$value->phone}}</td>
                    <td>{{$value->address}}</td>
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
            <form class="form" action="{{route('customer.add')}}" method="post">
                @csrf
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control" name="first_name" placeholder="First Name" value="" required>
                    </div>

                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control" name="last_name" placeholder="Last Name" value="" required>
                    </div>

                    <div class="form-group">
                        <label>Gender</label>
                        <select name="gender" class="form-control" placeholder="Gender" required>
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Email" value="" required>
                    </div>

                    <div class="form-group">
                        <label>Phone</label>
                        <input type="tel" class="form-control" name="phone" placeholder="Phone" value="" required>
                    </div>

                    <div class="form-group">
                        <label>Address</label>
                        <textarea name="address" class="form-control" placeholder="Address" required></textarea>
                    </div>
                   
                </div>
                <div class="modal-footer">
                <button class="btn btn-primary btn-block" type="submit">Add New Customer</button>
                </div>
            </form>
        </div>
        </div>
    </div>

    <!-- Modal Edit-->
    @foreach ($data['customer'] as $key=>$value)
    <div class="modal fade" id="edit-{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form" action="{{route('customer.edit', $value->id)}}" method="post">
                @csrf
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Customer {{$value->customer_name}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control" name="first_name" placeholder="First Name" value="{{$value->first_name}}" required>
                    </div>

                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control" name="last_name" placeholder="Last Name" value="{{$value->last_name}}" required>
                    </div>

                    <div class="form-group">
                        <label>Gender</label>
                        <select name="gender" class="form-control" placeholder="Gender" required>
                            @if($value->gender=="M")
                                <option value="M" selected>Male</option>
                            @else
                                <option value="M">Male</option>
                            @endif

                            @if($value->gender=="F")
                                <option value="F" selected>Female</option>
                            @else
                                <option value="F">Female</option>
                            @endif
                            
                            
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Email" value="{{$value->email}}" required>
                    </div>

                    <div class="form-group">
                        <label>Phone</label>
                        <input type="tel" class="form-control" name="phone" placeholder="Phone" value="{{$value->phone}}" required>
                    </div>

                    <div class="form-group">
                        <label>Address</label>
                        <textarea name="address" class="form-control" placeholder="Address" required>{{$value->address}}</textarea>
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
    @foreach ($data['customer'] as $key=>$value)
    <div class="modal fade" id="delete-{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete {{$value->customer_name}}?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form class="form" action="{{route('customer.delete', $value->id)}}" method="post">
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

