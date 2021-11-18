@extends('layouts.application_admin')
@section('pagetitle', 'Production Actual')
@section('content')

<form class="form" method="get" action="{{route('production.actual.search')}}">
    <div class="form-group">
        <label>PO Code</label>
        <select class="form-control" name="po_code" placeholder="PO Code" required>
            @foreach($data['production'] as $key=>$value)
                <option value="{{$value->purchasing->po_code}}">{{$value->purchasing->po_code}} - {{$value->purchasing->item}} {{$value->purchasing->unit}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Month</label>
        <select class="form-control" name="month" placeholder="Month" required>
            <option value="0">All</option>
            @for ($i=1; $i <=12 ; $i++)
                <option value="{{$i}}">{{  date("F", mktime(0, 0, 0, $i, 10)) }}</option>
            @endfor
        </select>
    </div>

    <div class="form-group">
        <label>Year</label>
        <select class="form-control" name="year" placeholder="Year" required>
            <option value="0">All</option>
            @for ($i=2020; $i <=2040 ; $i++)
                <option value="{{$i}}">{{ $i }}</option>
            @endfor
        </select>
    </div>

    <div class="form-group">
        <button class="btn btn-info btn-block" type="submit">Detail</button>
    </div>
</form>
@endsection

 