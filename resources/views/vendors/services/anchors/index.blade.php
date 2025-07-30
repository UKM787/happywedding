@extends('layouts.vendor')

@section('content')
@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
</div>
@endif
<div class="wed-host-section">
    <div class="wed-host-section-container">
        <div class="wed-host-section-container-title h2">
            <a class="btn btn-primary" href="{{route('weddinganchors.create', $vendor)}}">Add Anchor</a>
        </div>
        <div class="wed-host-section-container-form">
            @foreach($anchors as $anchor)
            <p>{{$anchor->name}} - {{$anchor->description}}- {{$anchor->address}}</p>
            <p>{{$anchor->location->name}},{{$anchor->location->state}}-{{$anchor->location->country}}</p>
            <p><img src="{{asset('assets/hotels\/').$anchor->imageOne}}" alt="anchorImage" width="200px" height="auto"></p>
            @endforeach
        </div>
    </div>
</div>
@endsection
