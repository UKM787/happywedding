@extends('layouts.app')
	@section('content')

    <landing-wedding-venue-filtered :cities="{{$states}}" city = "{{$city}}" type = "{{$type}}" :venues = "{{$venues}}"></landing-wedding-venue-filtered>

    @endsection 