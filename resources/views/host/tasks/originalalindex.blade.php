@extends('layouts.host')

@section('content')



<nav>
    <ul class="nav nav-pills nav-fill">
        <li class="nav-item">
            <a class="nav-link " aria-current="page" href="#">Welcome</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Work details</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="{{route('hosttasks.create',$host)}}">To-do list</a>
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
            <h2>Doing<span class="pull-right"><span class="add">+</span> <span class="info"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></span></span></h2>
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
            <h2>Done<span class="pull-right"><span class="add">+</span> <span class="info"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></span></span></h2>
            <div class="event-box">
                <span class="event-state"><img src="/img/green-tic.svg"></span>
                <p>Book appointment with henna artist</p>
                <p class="date-text">Today - april 2</p>
                <span class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></span>
            </div>
        </div>
    </div>

    <div class="row invitation-form">
        <div class="col-md-12">
            <div class="guest-form">
                <div class="card-header text-center h4">Add Venue <a href="{{route('hosttasks.index', $host)}}" class="btn btn-sm"><span class="px-3 text-danger">Event Planner</span></a></div>
                <div class="card-body">
                    <form method="POST" action="{{route('hosttasks.store', $host)}}" enctype="multipart/form-data">
                        @csrf
                        @include('host.partials._eventplanner', ['submitBtn' => 'Create', 'wedform' => ''])

                    </form>
                </div>
            </div>
        </div>
    </div>

    @endsection
