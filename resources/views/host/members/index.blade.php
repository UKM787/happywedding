@extends('layouts.host')
@section('content')

    <member-list :host-id="{{$host->id}}" :members-list="{{$members}}" :invitation="{{$invitation}}" :departments="{{$departments}}" :leaders="{{$leaders}}"></member-list>


@endsection
