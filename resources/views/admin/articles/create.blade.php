@extends('layouts.admin')
@section('title', 'Add Article')

@section('content')
<a href="{{route('adminarticles.index')}}" class="btn wed-btn-main">back</a>
<h1 class="text-center">Create Idea and Inspiration</h1>
{!! Form::open(['route' => ['adminarticles.store'], 'files' => true]) !!}

@include('admin.partials._article',['submitBtn' => 'Add Article'])

{!! Form::close() !!}
@endsection
