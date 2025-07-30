@extends('layouts.host')

@section('content')

@if($members->isNotEmpty() && isset($invitation))
<task-list :host-id="{{auth()->guard('host')->user()->id}}" :invitation="{{ $invitation }}" :tasksall="{{$tasks}}" :task-cat="{{$taskCat}}" :task-list="{{$taskList}}" :memberlist="{{$members}}" :memberlistonly="{{$newMembers}}"></task-list>
@else
<div class="wed-host-section">
    <div class="wed-host-section-container">
        <div class="wed-host-section-container-title animate__animated animate__bounce animate__delay-2s">
            <a href="{{route('hostmembers.index', $host)}}" class="btn btn-sm wed-btn-main">Add Members</a>
        </div>
    </div>
</div>
@endif




@endsection