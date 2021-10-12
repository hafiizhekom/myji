@extends('layouts.application_admin')
@section('pagetitle', 'Production Defect')
@section('content')

<form class="form" method="get" action="{{route('production.defect.search')}}">
    <div class="form-group">
        <label>PO Code</label>
        <select class="form-control" name="id" placeholder="PO Code" required>
            @foreach($data['production'] as $key=>$value)
                <option value="{{$value->id}}">{{$value->purchasing->po_code}} - {{$value->purchasing->item}} {{$value->purchasing->unit}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <button class="btn btn-info btn-block" type="submit">Search</button>
    </div>

    <div class="form-group">
        <button class="btn btn-primary btn-block" type="button"  data-toggle="modal" data-target="#add">Add New Production Request</button>
    </div>
</form>
@endsection

@section('modals')
    <!-- Modal Add-->
    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form" action="{{route('production.defect.add')}}" method="post">
                @csrf
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Production Defect</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>PO Code Production Request</label>
                        <select class="form-control" name="production_id" placeholder="PO Code Production Request">
                            @foreach($data['production_request'] as $key=>$value)
                                <option value="{{$value->id}}">{{$value->purchasing->po_code}} - {{$value->purchasing->item}} {{$value->unit}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Defect</label>
                        <input type="number" class="form-control" min="0" name="defect" placeholder="Defect" value="0" required>
                    </div>
                </div>
                <div class="modal-footer">
                <button class="btn btn-primary btn-block" type="submit">Add New Production Defect</button>
                </div>
            </form>
        </div>
        </div>
    </div>
@endsection
