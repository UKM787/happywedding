	@extends('layouts.app')
	@section('content')

    <vendor-accomodation-single vendor-cat="{{ $vendorCat }}" owner ="{{$owner}}"  hotels="{{$hotels}}" logged="{{$loggedIn}}" rooms="{{json_encode($rooms)}}" city = "{{$city}}" hotelstartdate = "{{$startDate}}" hotelenddate = "{{$endDate}}" children = "{{$children}}" adults = "{{$adults}}" totalrooms = "{{$totalrooms}}" states= "{{$states}}" stateselected= "{{$stateSelected}}" inivitations="{{$invi}}"></vendor-accomodation-single>

    @endsection 