@extends('layouts.host')

@section('content')


    <host-subscribe :host="{{$host}}" :plans="{{$plans}}"></host-subscribe>




@endsection

@section('payment')
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
@endsection

