@extends('layouts.host')

@section('content')
<host-profile host-id="{{ $hostID }}" exists="{{$exists}}" cexists="{{$cexists}}" oexists="{{$oexists}}" :subscription="{{$subscription ? $subscription : 'null'}}"></host-profile>
@endsection
