@extends('layouts.host')

@section('content')



    <host-reccuring-subscription :host="{{$host}}" :plans="{{$plans}}"></host-reccuring-subscription>


@endsection

@section('payment')
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
@endsection

