@extends('layouts.admin')

@section('content')
<div class="wed-host-section">
    <div class="wed-host-section-container">
        <p> <a href="{{route('admintag.index')}}" class="btn wed-btn-main">back</a></p>
        <div class="wed-host-section-container-title h2">
            {{$tag ? 'Edit '.$tag->name : 'Add New Tag' ;}}
        </div>
        <div class="wed-host-section-container-form">
            <form method="post" action="{{route('admintag.update', [ $tag])}}" class="admin-form" id="admin-form" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                @include('admin.partials._tag', ['submitBtn' => 'Update Tag' , 'tag' => $tag, 'tags' => $tags])
            </form>
        </div>
    </div>
</div>


@endsection