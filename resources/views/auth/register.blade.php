@extends('layouts.app')

@section('content')
<register-page :error-submit="{{$errors}}" :oldvalues="{{json_encode(old(), true)}}" :locations="{{$locations}}" url="{{$url}}" :cities="{{$cities}}" :categories="{{$categories}}"></register-page>



@endsection