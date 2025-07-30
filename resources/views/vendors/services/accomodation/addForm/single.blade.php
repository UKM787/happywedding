	@extends('layouts.vendor')
	@section('content')


    <vendor-accomodation-single vendor-cat="{{ $vendorCat }}" vendor ="{{$vendor}}" hotels="{{$hotels}}" rooms="{{json_encode($rooms)}}" states="{{$states}}"></vendor-accomodation-single>

    @endsection 