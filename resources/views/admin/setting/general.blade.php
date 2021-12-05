@extends('layouts.application_admin')
@section('pagetitle', 'Setting General')
@section('content')
    <ul class="list-group">
        <li class="list-group-item">
            <div class="row justify-content-between">
                <div class="d-flex col-6">
                    <label class="mr-2">Size Recommendation Image :</label> 
                    <form class="form" action="{{route('setting.general.size_recommendation')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="d-flex">
                            <div class="form-group">
                                <input type="file" accept=".jpg" name="image"><br>
                                <small>Only accept .jpg image</small>
                            </div>
                            <div class="form-group">
                                
                                <input type="submit" class="btn btn-primary" value="Upload">
                            </div>
                        </div>
                        
                    </form>
                </div>
                <div class="col-6">
                    <div class="row justify-content-end">
                    <img src="{{asset('/storage/settings/size_recommendation/image.jpg')}}" width="30%" class="pull-right">
                    </div>
                </div>
            </div>
        </li>
    </ul>
@endsection