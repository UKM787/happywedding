@extends('layouts.hostinvitation')
@section('styles')
<style>

</style>
@endsection

@section('content')
<invitation-cover-new :logged-in="{{$host}}" :invitation="{{$invitation ? $invitation : 'null'}}" :venues="{{$venues}}" :locations="{{$locations}}" :hostvenues="{{$hostvenues}}"></invitation-cover-new>

<!-- invitation-cover view  -->
{{--@include('host.partials.views._invitation')--}}
<!-- invitation-cover view ends -->

@endsection
