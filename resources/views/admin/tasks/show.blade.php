@extends('layouts.admin')

@section('content')
<p><a href="{{route('admintask.index')}}" class="btn wed-btn-main">back</a></p>
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Show Task</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('admintask.index') }}"> Back</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Task:</strong>
            {{ $task->name }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Task Category:</strong>
            {{ $task->description }}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Image:</strong>
            <img src="{{App\Wed\Happy::TASKIMGPATH.$task->imageOne }}" width="200px" height="auto">
        </div>
    </div>
</div>
@endsection