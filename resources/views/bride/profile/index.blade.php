	@extends('layouts.bride')
	@section('content')

    <bride-profile bride-id="{{ $brideID }}" exists="{{$exists}}" cexists="{{$cexists}}" oexists="{{$oexists}}"></bride-profile>


    @endsection