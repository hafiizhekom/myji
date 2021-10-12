@extends('layouts.application_admin')
@section('pagetitle', 'Production Actual')
@section('content')

<form class="form" method="post" action="{{route('production.actual.add')}}">
    @csrf

    @foreach($data['production'] as $key => $value)
        <input type="hidden" name="purchasing_id" value="{{$value->purchasing_id}}">
        <input type="hidden" name="production_id[]" value="{{$value->id}}">
        <div class="form-group">
            <label>Actual {{$value->productDetail->product->product_name}} {{$value->productDetail->category->category_name}} {{$value->productDetail->size->size_name}} {{$value->productDetail->color->color_name}}</label>
            <input type="number" class="form-control" min="0" name="actual-{{$value->id}}" placeholder="Actual" value="0" required>
        </div>
    @endforeach


    <div class="form-group">
        <button class="btn btn-primary btn-block" type="submit">Save</button>
    </div>
</form>
@endsection
