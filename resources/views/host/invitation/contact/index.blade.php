@extends('layouts.hostinvitation')

@section('content')

            <invitation-help-line :host="{{$host}}" :invitation="{{$invitation}}" :members="{{$members}}" :contact-list="{{$contactList}}"></invitation-help-line>
            <!-- <contact-form :host-id="{{auth()->guard('host')->user()->id}}" :host="{{$host}}" :invitation="{{$invitation}}"></contact-form> -->
@endsection