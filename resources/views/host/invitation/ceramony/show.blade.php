@extends('layouts.hostinvitation')

@section('content')

<!-- <div class="text-right">
    <a href="{{route('hostceramony.create',[$host,$invitation])}}" class="btn btn-sm bg-danger mr-2"><i class="material-icons" title="add new Ceramony">add</i>
    </a>
</div> -->


<div class="h3 text-danger text-center">{{ucwords($ceramony->name)}}<a href="{{route('hostceramony.edit',[$invitation,$ceramony])}}" title="Edit Ceramony">
        <i class="material-icons text-success" title="Edit Invitation">edit</i>
    </a> </div>

<div class="card mt-3" style="width: 18rem;">
    <img src="{{asset('storage').$ceramony->imageOne}}" class="card-img-top" alt="...">
    <div class="card-body">
        <ul class="list-group list-group-flush">
            <li class="list-group-item text-muted">{{\Carbon\Carbon::parse($ceramony->startDate)->format('j F, Y h:i' )}}
                <!-- -
                {{\Carbon\Carbon::parse($ceramony->startTime)->format('h:i s')}} -->
            </li>
            <li class="list-group-item text-muted">{{\Carbon\Carbon::parse($ceramony->endDate)->format('j F, Y h:i')}}
                <!-- -
                {{\Carbon\Carbon::parse($ceramony->endTime)->format('h:i s')}} -->
            </li>
            <li class="list-group-item text-muted">@foreach ($ceramony->venues as $venue)
                {{$venue->name}}
                {{$venue->description}}
                {{$venue->address}}
                @endforeach
            </li>
            <li class="list-group-item text-muted">
                <div class="row">
                    <div class="col">
                        <h5>Ladies Dress Code</h5><img src="{{asset('storage').$ceramony->imageTwo}}" alt="" class="img-thumbnail">
                    </div>
                    <div class="col">
                        <h5>Gents Dress Code</h5><img src="{{asset('storage').$ceramony->imageThree}}" alt="" class="img-thumbnail">
            </li>
    </div>
</div>

</ul>
</div>
</div>

@endsection
