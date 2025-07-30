@extends('layouts.admin')

@section('content')
<p><a href="{{route('admintestimonials.index')}}" class="btn wed-btn-main">back</a></p>
<div class="row">
    <div class="col text-center">
        <h2> Testimonials</h2>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Title:</strong>
            {{ $testimonial->title }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Description:</strong>
            {{ $testimonial->body }}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Image:</strong>
            <img src="{{ App\Wed\Happy::TSTIMGPATH. $testimonial->imageOne }}" width="300px" height="auto">
        </div>
    </div>

    <div>
        <strong>Tags:</strong>
        @foreach($testimonial->tags as $tag)
        <ul>
            <li>{{$tag->name}}{{$tag->created_at}}</li>
        </ul>
        @endforeach
    </div>
</div>
@endsection