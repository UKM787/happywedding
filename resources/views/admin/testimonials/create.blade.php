@extends('layouts.admin')
@section('title', 'Add Testimonial')

@section('content')
<a href="{{route('admintestimonials.index')}}" class="btn wed-btn-main">back</a>
<h1 class="text-center">Create Testimonial</h1>
{!! Form::open(['route' => ['admintestimonials.store'], 'files' => true]) !!}

@include('admin.partials._testimonial',['submitBtn' => 'Add Testimonial'])

{!! Form::close() !!}
@endsection