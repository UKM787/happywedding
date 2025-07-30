@extends('layouts.admin')

@section('content')
<p><a href="{{route('adminvenues.index')}}" class="btn wed-btn-main">back</a></p>
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Show Venue</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('adminvenues.index') }}"> Back</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Venue:</strong>
            {{ $venue->name }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Venue Description:</strong>
            {{ $venue->description }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Image:</strong>
            <img src="{{ asset('assets/venues\/').$venue->imageOne }}" width="300px" height="auto">
        </div>
    </div>
</div>
@endsection