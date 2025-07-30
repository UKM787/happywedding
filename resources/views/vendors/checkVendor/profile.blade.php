	@extends('layouts.vendor')
	@section('content')

    <vendor-check-profile vendor-id="{{ $vendorID }}" exists="{{$exists}}" cexists="{{$cexists}}" :profile="{{$profile}}" :company="{{$company}}" :cats="{{$cats}}" :cities="{{$cities}}" :services="{{$services}}"></vendor-check-profile>

    @endsection