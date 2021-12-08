@extends('layouts.application_admin')
@section('pagetitle', 'FAQ')
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
            <th data-field="title" data-sortable="true">Title</th>
            <th data-formatter="TableActionsContent">Content</th>
            <th data-field="order" data-sortable="true">Order</th>
            <th data-formatter="TableActions">Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($data['faq'] as $key=>$value)
                <tr>
                    <td>{{$value->id}}</td>
                    <td>{{$value->title}}</td>
                    <td></td>
                    <td>
                        {{$value->order}}
                        <a class="text-info" href="#" data-toggle="modal" data-target="#increasing-{{$value->id}}">
                            <i class="fas fa-arrow-up"></i>
                        </a>
                        <a class="text-info" href="#" data-toggle="modal" data-target="#decreasing-{{$value->id}}">
                            <i class="fas fa-arrow-down"></i>
                        </a>
                    </td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
        </table>
@endsection

@section('additionalJs')
        <script>
            $(document).ready(function() {
               $('.summernote').summernote();
            });
            
            function TableActionsContent (value, row, index) {
                return [
                    '<a class="text-info" href="#" data-toggle="modal" data-target="#content-',row.id,'">',
                    '<i class="fas fa-eye"></i>',
                    '</a> '
                ].join('');
            }

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
            <form class="form" action="{{route('faq.add')}}" method="post">
                @csrf
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Faq</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Title" value="">
                    </div>

                    <div class="form-group">
                        <label>Content</label>
                        <textarea class="summernote" name="content" placeholder="Content"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                <button class="btn btn-primary btn-block" type="submit">Add New Faq</button>
                </div>
            </form>
        </div>
        </div>
    </div>

    <!-- Modal Content-->
    @foreach ($data['faq'] as $key=>$value)
    <div class="modal fade" id="content-{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{$value->title}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php echo $value->content; ?>
                    </div>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Modal Edit-->
    @foreach ($data['faq'] as $key=>$value)
    <div class="modal fade" id="edit-{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form" action="{{route('faq.edit', $value->id)}}" method="post">
                @csrf
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Faq {{$value->faq_name}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Title" value="{{$value->title}}">
                    </div>

                    <div class="form-group">
                        <label>Content</label>
                        <textarea class="summernote" name="content" placeholder="Content">{{$value->content}}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-block">Save changes</button>
                </div>
            </form>
        </div>
        </div>
    </div>

    <!-- Modal Incereasing-->
    <div class="modal fade" id="increasing-{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to increasing order?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form class="form" action="{{route('faq.increasing.edit', $value->id)}}" method="post">
                    @csrf
                    <div class="btn-group" style="width: 100%;">
                        <button type="submit" class="btn btn-default">Increase</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>

    <!-- Modal Decreasing-->
    <div class="modal fade" id="decreasing-{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to decreasing order?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form class="form" action="{{route('faq.decreasing.edit', $value->id)}}" method="post">
                    @csrf
                    <div class="btn-group" style="width: 100%;">
                        <button type="submit" class="btn btn-default">Decrease</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>
    @endforeach

    <!-- Modal Delete-->
    @foreach ($data['faq'] as $key=>$value)
    <div class="modal fade" id="delete-{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete {{$value->title}}?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form class="form" action="{{route('faq.delete', $value->id)}}" method="post">
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

