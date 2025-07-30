@extends('layouts.app')

@section('content')

@if($url == 'company')
<form method="POST" action="{{ route('companyLogin') }}">
    @csrf
    @include('components.company')
</form>
@else
<login-page url="{{$url}}" :error-submit="{{$errors}}" :oldvalues="{{json_encode(old(), true)}}"></login-page>
@endif

<!-- @if($url == 'vendor')
<login-vendor-page url="{{$url}}" :error-submit="{{$errors}}" :oldvalues="{{json_encode(old(), true)}}"></login-vendor-page>
@elseif($url == 'host')
<login-page url="{{$url}}" :error-submit="{{$errors}}" :oldvalues="{{json_encode(old(), true)}}"></login-page>
@elseif($url == 'admin')
<login-page url="{{$url}}" :error-submit="{{$errors}}" :oldvalues="{{json_encode(old(), true)}}"></login-page>
@else
<login-guest-page url="{{$url}}" :error-submit="{{$errors}}" :oldvalues="{{json_encode(old(), true)}}"></login-guest-page>
@endif -->
<!-- .container-fluid .signup ends -->

@endsection
