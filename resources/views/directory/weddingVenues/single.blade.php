@extends('layouts.app')
	@section('content')

    <landing-wedding-venue-single :venue="{{$venue}}" logged="{{$loggedIn}}" inivitations="{{$invi}}"></landing-wedding-venue-single>

    @endsection 