	@extends('layouts.member')
	@section('content')
	<div class="wed-host-section">
	    <div class="wed-host-section-container">
	        <div class="wed-host-section-container-title"> {{$member->name }} Dashboard</div>
	        @if(($tasks->isNotEmpty()))
	        <div class="card">
	            <div class="card-body text-danger">

	                <nav>
	                    <ul class="nav nav-pills nav-fill">
	                        <li class="nav-item">
	                            <a class="nav-link " aria-current="page" href="#">Welcome</a>
	                        </li>
	                        <li class="nav-item">
	                            <a class="nav-link" href="#">Work details</a>
	                        </li>
	                        <li class="nav-item">
	                            <a class="nav-link" href="#">To-do list</a>
	                        </li>

	                        <li class="nav-item">
	                            <a class="nav-link" href="#">Shortlisted</a>
	                        </li>
	                        <li class="nav-item">
	                            <a class="nav-link" href="#">Saved posts</a>
	                        </li>
	                    </ul>
	                </nav>
	                <div class="row">
	                    <div class="col-12 col-sm-12 col-md-4">
	                        <div class="box">
	                            <h2>To Do <span class="pull-right"><span class="add">+</span> <span class="info"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></span></span></h2>
	                            @foreach($tasks as $task)
	                            <div class="event-box">
	                                <form action="#" method="post">
	                                    @csrf
	                                    @method('PATCH')
	                                    <span class="event-state"><input type="checkbox" name="taskstatus" title="select if taskcompleted" onclick="alert('changetaskstatus')"></span>
	                                </form>
	                                <p> <b>{{ucwords($task->member->name)}}</b></p>
	                                <p>{{$task->title}} - <b>{{ucwords($task->category->name)}}</b> - {{ucwords($task->taskPriority)}} -
	                                    {{$task-> taskStatus}}
	                                </p>
	                                <p class="date-text">{{\Carbon\Carbon::parse($task->dueDate)->format('M d, Y')}} - {{$task->completionDate}}</p>
	                                <span class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></span>
	                            </div>
	                            @endforeach
	                        </div>
	                    </div>
	                    <div class="col-12 col-sm-12 col-md-4">
	                        <div class="box">
	                            <h2>Doing<span class="pull-right"><span class="add">+</span> <span class="info"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></span></span></h2>
	                            @foreach($tasks as $task)
	                            <div class="event-box">
	                                <form action="/updatetask/{{$task->id}}" method="post">@csrf @method('patch') <span class="event-state"><input type="checkbox" name="taskstatus" title="select if taskcompleted" onclick="alert('changetaskstatus')"></span></form>
	                                <p>{{$task->title}} - {{$task->taskPriority}} - {{$task-> taskStatus}}</p>
	                                <p class="date-text">{{\Carbon\Carbon::parse($task->dueDate)->format('M d, Y')}} - {{$task->completionDate}}</p>
	                                <span class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></span>
	                            </div>
	                            @endforeach
	                            <div class="event-box">
	                                <form action="#" method="post">@csrf ; @method('patch'); <span class="event-state"><input type="checkbox" name="taskstatus" title="select if taskcompleted"></span></form>
	                                <p>Book appointment with make up artist</p>
	                                <p class="date-text">Today - april 2</p>
	                                <span class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></span>
	                            </div>
	                            <div class="event-box">
	                                <form action="#" method="post">@csrf ; @method('patch'); <span class="event-state"><input type="checkbox" name="taskstatus" title="select if taskcompleted"></span></form>
	                                <p>Book band baja</p>
	                                <p class="date-text">Today - april 2</p>
	                                <span class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></span>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="col-12 col-sm-12 col-md-4">
	                        <div class="box">
	                            <h2>Done<span class="pull-right"><span class="add">+</span> <span class="info"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></span></span></h2>
	                            @foreach($tasks as $task)
	                            <div class="event-box">
	                                <form action="#" method="post">@csrf ; @method('patch'); <span class="event-state"><input type="checkbox" name="taskstatus" title="select if taskcompleted"></span></form>
	                                <p>{{$task->title}} - {{$task->taskPriority}} - {{$task-> taskStatus}}</p>
	                                <p class="date-text">{{\Carbon\Carbon::parse($task->dueDate)->format('M d, Y')}} - {{$task->completionDate}}</p>
	                                <span class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></span>
	                            </div>
	                            @endforeach
	                            <div class="event-box">
	                                <span class="event-state"><img src="/img/green-tic.svg"></span>
	                                <p>Book appointment with henna artist</p>
	                                <p class="date-text">Today - april 2</p>
	                                <span class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></span>
	                            </div>
	                        </div>
	                    </div>
	                </div>

	            </div>
	        </div>
	        @endif
	    </div>
	</div>
	@endsection
