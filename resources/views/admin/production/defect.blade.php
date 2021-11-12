@extends('layouts.application_admin')
@section('pagetitle', 'Production Defect')
@section('content')

<form class="form" method="get" action="{{route('production.defect.search')}}">
    <div class="form-group">
        <label>PO Code</label>
        <select class="form-control" name="po_code" placeholder="PO Code" required>
            @foreach($data['production'] as $key=>$value)
                <option value="{{$value->purchasing->po_code}}">{{$value->purchasing->po_code}} - {{$value->purchasing->item}} {{$value->purchasing->unit}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <button class="btn btn-info btn-block" type="submit">Detail</button>
    </div>
</form>
@endsection

