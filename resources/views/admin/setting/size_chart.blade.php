@extends('layouts.application_admin')
@section('pagetitle', 'Setting Size Chart')
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
            
            <th data-field="image" data-sortable="true">Image</th>
            <th data-field="order" data-sortable="true">Order</th>  
            <th data-formatter="TableActions">Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($data['setting_size_chart'] as $key=>$value)
                <tr>
                    <td>{{$value->id}}</td>
                    <td>
                        @if($value->image_file)
                            <a href="#" data-toggle="modal" data-target="#image-{{$value->id}}"><img src="{{asset('/storage/settings/size_charts/'.$value->image_file)}}" width="100px"></a>
                        @endif
                    </td>
                    <td>
                        {{$value->order}}

                        @if($value->order==0)
                            <a class="text-info" href="#" data-toggle="modal" data-target="#increasing-{{$value->id}}">
                                <i class="fas fa-arrow-up"></i>
                            </a>
                        @else
                            <a class="text-info" href="#" data-toggle="modal" data-target="#increasing-{{$value->id}}">
                                <i class="fas fa-arrow-up"></i>
                            </a>
                            <a class="text-info" href="#" data-toggle="modal" data-target="#decreasing-{{$value->id}}">
                                <i class="fas fa-arrow-down"></i>
                            </a>
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

            $(document).ready(function() {
                // $("input[type=file]").change(function(){
                //     var oImg=new Image();
                //     var avail = false;
                //     for( i=0; i < this.files.length; i++ ){
                        
                //         oImg.src=URL.createObjectURL( this.files[i] );
                //         oImg.onload=function(){
                //             var width=oImg.naturalWidth;
                //             var height=oImg.naturalHeight;
                //             var ratio = oImg.width/oImg.height;
                            
                //             if(Math.round(ratio * 100) / 100 >= 0.60 && Math.round(ratio * 100) / 100 <= 0.80){
                                
                //             }else{
                //                 alert('Image ratio must be 2 (width) : 3 (height) or 3 (width) : 4 (height)');  
                //                 $("input[type=file]").val(''); 
                //                 return;
                //             }
                           
                //         };
                //     }
                // });
            });
            
            function TableActions (value, row, index) {
                return [
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
            <form class="form" action="{{route('setting.size_chart.add')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Setting Size Chart</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Image</label><br>
                        <input type="file" accept="image/*" name="image" required>
                    </div>
                </div>
                <div class="modal-footer">
                <button class="btn btn-primary btn-block" type="submit">Add New Setting Size Chart</button>
                </div>
            </form>
        </div>
        </div>
    </div>

    <!-- Modal Edit-->
    @foreach ($data['setting_size_chart'] as $key=>$value)

    <div class="modal fade" id="image-{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <img src="{{asset('/storage/setting_size_charts/'.$value->image)}}" width="100%">
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
                <form class="form" action="{{route('setting.size_chart.increasing.edit', $value->id)}}" method="post">
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
                <form class="form" action="{{route('setting.size_chart.decreasing.edit', $value->id)}}" method="post">
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
    @foreach ($data['setting_size_chart'] as $key=>$value)
    <div class="modal fade" id="delete-{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete {{$value->setting_size_chart_name}}?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form class="form" action="{{route('setting.size_chart.delete', $value->id)}}" method="post">
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

