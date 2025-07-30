@extends('layouts.hostinvitation')

@section('styles')
    <style>
        .guest-list-accord-form{
            width: 91%;
            margin-left: auto;
            margin-right: auto;
            background-color: white;
            position: relative;
            z-index: 1;
            max-height: 0;
            overflow: hidden;
            transition: all linear 300ms;
        }
        .guest-list-accord{
            cursor: pointer;
            box-shadow: 0px 0px 4px 5px rgb(0 0 0 / 25%);
        }
    </style>
@endsection

@section('content')
<invitation-guest-list :invitation="{{$invitation}}" :ceremony-list="{{$ceremonyList}}" :users="{{$users}}" :host="{{$host}}"></invitation-guest-list>





@endsection
