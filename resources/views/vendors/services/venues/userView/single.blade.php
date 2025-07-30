	@extends('layouts.app')
	@section('content')
    {{--<vendor-venue-single vendor-cat="{{ $vendorCat }}" owner ="{{$owner}}" venues="{{$venues}}" logged="{{$loggedIn}}" inivitations="{{$invi}}" ></vendor-venue-single>--}}

    <landing-wedding-venue-single :venue="{{$venue}}" logged="{{$loggedIn}}" inivitations="{{$invi}}"></landing-wedding-venue-single>

    @endsection 