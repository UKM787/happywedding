@extends('layouts.app')

@section('styles')


@endsection

@section('content')
<ideas-and-inspiration :categories="{{$categories}}" :articles="{{$articles}}" :maincats="{{$maincats}}"></ideas-and-inspiration>


@endsection

@section('ideas')

@endsection