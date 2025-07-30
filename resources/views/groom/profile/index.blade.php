	@extends('layouts.groom')
	@section('content')

    <groom-profile groom-id="{{ $groomID }}" exists="{{$exists}}" cexists="{{$cexists}}" oexists="{{$oexists}}"></groom-profile>



    @endsection