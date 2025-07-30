@extends('layouts.company')

@section('content')

    <weddingplanner-profile vendor-id="{{ $companyID }}" exists="{{$exists}}" cexists="{{$cexists}}"></weddingplanner-profile>
@endsection
