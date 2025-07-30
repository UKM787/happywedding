@extends('layouts.host')

@section('content')


    <host-reccuring-subscribed :host="{{$host}}" :plans="{{$plans}}" :current="{{$plan}}" :currentdetails="{{$subPlan}}"></host-reccuring-subscribed>


@endsection



