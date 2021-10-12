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
        <button class="btn btn-info btn-block" type="submit">Search</button>
    </div>

    <div class="form-group">
        <button class="btn btn-primary btn-block" type="button"  data-toggle="modal" data-target="#add">Add New Production Request</button>
    </div>
</form>
@endsection

@section('additionalJs')
        <script>
            $(document).on('change', '#productionDetail', function(e){
                e.preventDefault();
                window.location = 'actual/detail/'+$(this).find('option:selected').val();
            });
        </script>

   
@endsection

@section('modals')
    <!-- Modal Add-->
    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form" action="{{route('production.actual.add')}}" method="post">
                @csrf
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Production Actual</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>PO Code Production Request</label>
                        <select class="form-control" id="productionDetail" name="production_id" placeholder="PO Code Production Request">
                            <option value="PO Code Production Request" disabled selected>PO Code Production Request</option>
                            @foreach($data['production_request'] as $key=>$value)
                                <option value="{{$value->purchasing_id}}">{{$value->purchasing->po_code}} - {{$value->purchasing->item}} {{$value->unit}}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- <div class="form-group">
                        <label>Actual</label>
                        <input type="number" class="form-control" min="0" name="actual" placeholder="Actual" value="0" required>
                    </div> --}}
                </div>
                {{-- <div class="modal-footer"> --}}
                {{-- <button class="btn btn-primary btn-block" type="submit">Add New Production Actual</button> --}}
                {{-- </div> --}}
            </form>
        </div>
        </div>
    </div>
@endsection
