@extends('layouts.admin')

@section('content')
<div class="wed-host-section">
    <div class="wed-host-section-container">
        <p> <a href="{{route('adminarticles.index')}}" class="btn wed-btn-main">back</a></p>
        <div class="wed-host-section-container-title h2">
            {{$article ? 'Edit '.$article->name : 'Add New Article' ;}}
        </div>
        <div class="wed-host-section-container-form">
            <form method="post" action="{{route('adminarticles.update', $article )}}" class="admin-form" id="admin-form" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                @include('admin.partials._article', ['submitBtn' => 'Update Article' , 'article' => $article, 'tags' => $tags])
            </form>
        </div>
    </div>
</div>


@endsection
