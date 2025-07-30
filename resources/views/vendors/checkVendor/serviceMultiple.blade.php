	@extends('layouts.vendor')
	@section('content')


    <vendor-select-service-multiple  vendor-id="{{ $vendorID }}"  :vendor="{{ $loggedIn }}" :categories="{{ $categories }}"></vendor-select-service-multiple>

    @endsection