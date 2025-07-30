@extends('layouts.host')

@section('content')
{!! Form::open(['route' => ['admintestimonials.store'], 'files' => true]) !!}

@include('admin.partials._testimonial',['submitBtn' => 'Add Testimonial'])

{!! Form::close() !!}
@endsection