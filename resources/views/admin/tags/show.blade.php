@extends('layouts.admin')

@section('content')
<p><a href="{{route('admintag.index')}}" class="btn wed-btn-main">back</a></p>
<div class="row">
    <div class="col-lg-12 margin-tb">
        <h2> Idea and Ceramony</h2>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {{ $tag->name }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Priority:</strong>
            {{ $tag->priority }}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Image:</strong>
            <img src="{{ App\Wed\Happy::TAGIMGPATH. $tag->imageOne }}" width="300px" height="auto">
        </div>
    </div>
</div>
@endsection