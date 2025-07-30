@extends('layouts.host')

@section('content')


    <host-subscribed :host="{{$host}}" :plan="{{$plan}}" :current="{{$latestOrder}}"></host-subscribed>


@endsection



