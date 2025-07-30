@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Show Accommodation</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('adminaccommodation.index') }}"> Back</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Accommodation:</strong>
            {{ $accommodation->name }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Venue Description:</strong>
            {{ $accommodation->description }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Image:</strong>
            <img src="{{ asset('assets/accommodations\/').$accommodation->imageOne }}" width="300px" height="auto">
        </div>
    </div>
</div>
@endsection
