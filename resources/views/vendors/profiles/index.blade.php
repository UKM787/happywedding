@extends('layouts.vendor')

@section('content')
    <vendor-check-profile :logged-in="{{$vendor}}" vendor-id="{{ $vendorID }}" exists="{{$exists}}" cexists="{{$cexists}}" :profile="{{$profile ? $profile : 'null'}}" :company="{{$company ? $company : 'null'}}" :cats="{{$cats}}" :services="{{$services}}" :cities="{{$cities}}" :categories="{{count($categories) > 0 ? $categories : '[]'}}" :services-selected="{{count($servicesSelected) > 0 ? $servicesSelected : '[]'}}"></vendor-check-profile>

@endsection
