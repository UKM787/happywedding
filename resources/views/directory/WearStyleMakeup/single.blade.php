@extends('layouts.app')
@section('content')

<wear-style-makeup-single  :vendorcat ="{{$vendorCat}}" :venue="{{$venue}}" owner ="{{$owner}}" logged="{{$loggedIn}}"></vendor-venue-all>

@endsection 