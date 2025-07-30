@extends('layouts.vendor')

@section('content')

<div class="wed-host-section">
    <div class="wed-host-section-container">

        <div class="wed-host-section-container-title h2">
            @if (isset($service))
            <a class="btn btn-primary" href="{{route('vendorwservices.create', [$vendor,$service])}}">Add {{ucwords($service)}}</a>
            @else
            <p>Services offered by {{$vendor->name}}</p>
            @endif
        </div>

        <div class="wed-host-section-container-form">
            @foreach($wvservices as $accommodation)

            <p>{{$accommodation->name}} - {{$accommodation->description}}- {{$accommodation->address}}</p>

            <p>{{$accommodation->location->name}},{{$accommodation->location->state}}-{{$accommodation->location->country}}</p>
            <p><img src="{{asset('assets/hotels\/').$accommodation->imageOne}}" alt="accommodationImage" width="200px" height="auto"></p>
            @endforeach

        </div>
    </div>
</div>
@endsection
