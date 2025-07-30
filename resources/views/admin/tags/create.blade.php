@extends('layouts.admin')
@section('title', 'Add Tag')

@section('content')
<a href="{{route('admintag.index')}}" class="btn wed-btn-main">back</a>
<h1 class="text-center">Create Tag</h1>
{!! Form::open(['route' => ['admintag.store'], 'files' => true]) !!}

@include('admin.partials._tag',['submitBtn' => 'Add Tags'])

{!! Form::close() !!}
@endsection