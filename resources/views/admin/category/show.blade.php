@extends('layouts.admin')

@section('content')
<p> <a href="{{route('admincategory.index')}}" class="btn wed-btn-main">back</a></p>
<div class="d-flex justify-content-around">
    <div>
        <h2> Category</h2>
    </div>
</div>

<div class="text-center">
    {{ $category->name }}
    <div class="form-group">
        <img src="{{ App\Wed\Happy::CATIMGPATH.$category->imageOne }}" width="300px" height="auto">
    </div>
    {{ $category->description }}
</div>
@endsection