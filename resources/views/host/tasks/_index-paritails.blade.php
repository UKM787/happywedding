<!--
    @if(($members->isNotEmpty()) && (isset() $tasksCreated->isNotEmpty()))
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
                <h2>To Do <span class="pull-right"><span class="add">+</span> <span class="info"><i
                                class="fa fa-ellipsis-v" aria-hidden="true"></i></span></span></h2>
                @foreach($tasksCreated as $task)
                <div class="event-box">
                    <span class="event-state"><img src="/img/gray-tic.svg"></span>
                    <p> <b>{{ucwords($task->member->name)}}</b></p>
                    <p>{{$task->title}} - <b>{{ucwords($task->category->name)}}</b> - {{ucwords($task->taskPriority)}} -
                        {{$task-> taskStatus}}</p>
                    <p class="date-text">{{$task->dueDate}} - {{$task->completionDate}}</p>
                    <span class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></span>
                </div>
                @endforeach
                <div class="event-box">
                    <span class="event-state"><img src="/img/gray-tic.svg"></span>
                    <p>Book band baja</p>
                    <p class="date-text">Today - april 2</p>
                    <span class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></span>
                </div>
                <div class="event-box">
                    <span class="event-state"><img src="/img/gray-tic.svg"></span>
                    <p>Book appointment with wedding planner</p>
                    <p class="date-text">Today - april 2</p>
                    <span class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-4">
            <div class="box">
                <h2>Doing<span class="pull-right"><span class="add">+</span> <span class="info"><i
                                class="fa fa-ellipsis-v" aria-hidden="true"></i></span></span></h2>
                @foreach($tasksInProgress as $task)
                <div class="event-box">
                    <span class="event-state"><img src="/img/gray-tic.svg"></span>
                    <p>{{$task->title}} - {{$task->taskPriority}} - {{$task-> taskStatus}}</p>
                    <p class="date-text">{{$task->dueDate}} - {{$task->completionDate}}</p>
                    <span class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></span>
                </div>
                @endforeach
                <div class="event-box">
                    <span class="event-state"><img src="/img/gray-tic.svg"></span>
                    <p>Book appointment with make up artist</p>
                    <p class="date-text">Today - april 2</p>
                    <span class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></span>
                </div>
                <div class="event-box">
                    <span class="event-state"><img src="/img/gray-tic.svg"></span>
                    <p>Book band baja</p>
                    <p class="date-text">Today - april 2</p>
                    <span class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-4">
            <div class="box">
                <h2>Done<span class="pull-right"><span class="add">+</span> <span class="info"><i
                                class="fa fa-ellipsis-v" aria-hidden="true"></i></span></span></h2>
                @foreach($tasksCompleted as $task)
                <div class="event-box">
                    <span class="event-state"><img src="/img/gray-tic.svg"></span>
                    <p>{{$task->title}} - {{$task->taskPriority}} - {{$task-> taskStatus}}</p>
                    <p class="date-text">{{$task->dueDate}} - {{$task->completionDate}}</p>
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
    @endif -->
