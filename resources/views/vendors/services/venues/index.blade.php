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
            <a class="btn btn-primary" href="{{route('vendorvenues.create',$vendor)}}">Add Venue</a>
        </div>
        <div class="wed-host-section-container-form">
            @foreach($venues as $venue)
            <p>{{$venue->name}} - {{$venue->description}}- {{$venue->address}}</p>
            <p>{{$venue->location->name}},{{$venue->location->state}}-{{$venue->location->country}}</p>
            <p><img src="{{asset('assets/venues\/').$venue->imageOne}}" alt="VenueImage" width="200px" height="auto"></p>
            @endforeach
        </div>
    </div>
</div>

@endsection
