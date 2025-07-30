@extends('layouts.admin')

@section('content')
<div class="wed-host-section">
    <div class="wed-host-section-container">
        <p><a href="{{route('admintask.index')}}" class="btn wed-btn-main">back</a></p>
        <div class="wed-host-section-container-title h2">
            {{$task ? 'Edit '.$task->name : 'Add New Task' ;}}
        </div>
        <div class="wed-host-section-container-form">
            <form method="post" action="{{route('admintask.update', [$task])}}" class="admin-form" id="admin-form" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                @include('admin.partials._task', ['task' => $task, 'categories' => $categories])
            </form>
        </div>
    </div>
</div>


@endsection