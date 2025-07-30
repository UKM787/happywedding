	@extends('layouts.vendor')
	@section('content')


    <vendor-select-dashboard  vendor-id="{{ $vendorID }}"  :vendor="{{ $loggedIn }}" :categories="{{ $categories }}"></vendor-select-dashboard>

    @endsection