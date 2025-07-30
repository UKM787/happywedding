	@extends('layouts.app')
	@section('content')
    <vendor-accomodation-filtered hotels = "{{$hotels}}" city = "{{$city}}" hotelstartdate = "{{$startDate}}" hotelenddate = "{{$endDate}}" children = "{{$children}}" adults = "{{$adults}}" rooms = "{{$rooms}}" states= "{{$states}}" stateselected= "{{$stateSelected}}"></vendor-accomodation-filtered>

    @endsection 