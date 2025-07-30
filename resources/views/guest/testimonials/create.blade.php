@extends('layouts.guest')

@section('title', 'Add Testimonial')

@section('content')

<section style="position: relative;
    top: 80px;">
    {!! Form::open(['route' => ['admintestimonials.store'], 'files' => true]) !!}

    @include('admin.partials._testimonial',['submitBtn' => 'Add Testimonial'])

    {!! Form::close() !!}
</section>

@endsection