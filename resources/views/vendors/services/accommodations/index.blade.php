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
            <a class="btn btn-primary" href="{{route('vendoraccommodation.create', $vendor)}}">Add Accommodation</a>
        </div>
        <div class="wed-host-section-container-form">
            @foreach($accommodations as $accommodation)
            <p>{{$accommodation->name}} - {{$accommodation->description}}- {{$accommodation->address}}</p>
            <p>{{$accommodation->location->name}},{{$accommodation->location->state}}-{{$accommodation->location->country}}</p>
            <p><img src="{{asset('assets/hotels\/').$accommodation->imageOne}}" alt="accommodationImage" width="200px" height="auto"></p>
            @endforeach
        </div>
    </div>
</div>
@endsection
