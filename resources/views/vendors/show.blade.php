@extends('layouts.vendor')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Show Location</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('admin.location.index') }}"> Back</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>City:</strong>
            {{ $location->city }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>State:</strong>
            {{ $location->state }}
        </div>
    </div>
    
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Image:</strong>
            <img src="{{ asset('storage/location').$location->imageOne }}" width="300px" height="auto">
        </div>
    </div>
</div>
@endsection
