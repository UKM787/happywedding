@extends('layouts.hostinvitation')

@section('styles')
<style>

</style>
@endsection

@section('content')

<invitation-our-story :logged-in="{{$host}}" :invitation="{{$invitation}}"
:story="{{$story ? $story : '{}'}}"></invitation-our-story>
{{--
@include('host.partials.views._story')
--}}

@endsection
