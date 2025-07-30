@extends('layouts.vendor')

@section('styles')
    <style>
        .wed-category {
            display: flex;
        }
    </style>
@endsection

@section('content')

<div class="wed-category">
    @foreach($categories as $category)
    {{$category->name}}<br>
    @endforeach
</div>


@endsection
