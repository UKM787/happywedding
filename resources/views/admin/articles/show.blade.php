@extends('layouts.admin')

@section('content')
<p><a href="{{route('adminarticles.index')}}" class="btn wed-btn-main">back</a></p>
<div class="row">
    <div class="col text-center">
        <h2> Articles</h2>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Title:</strong>
            {{ $article->title }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Description:</strong>
            {{ $article->body }}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Image:</strong>
            <img src="{{ App\Wed\Happy::ARTIMGPATH. $article->imageOne }}" width="300px" height="auto">
        </div>
    </div>

    <div>
        <strong>Tags:</strong>
        @foreach($article->tags as $tag)
        <ul>
            <li>{{$tag->name}} --- {{$tag->created_at}}</li>
        </ul>
        @endforeach
    </div>
    <div>
         @foreach($article->imageGallery as $img)
                        <img src="{{App\Wed\Happy::ARTIMGPATH. $img}}" alt="{{$img.'Image'}}" width="100px" height="100px" class="px-1">
                        @endforeach
    </div>
</div>
@endsection