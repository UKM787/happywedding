@extends('layouts.hostinvitation')

@section('content')
    <div class="row text-center my-5">
        <!-- <div class="col">
            <a href="{{route('invitedguests.create',[$host,$invitation])}}" class="btn  btn-sm wed-btn-main"><span class="material-icons">
                    person_add
                </span>
            </a>
        </div> -->
        <div class="col" style="margin-top: 2px;">
            <a href="{{route('guestupload',[$invitation])}}" class="btn  btn-sm wed-btn-main"><span class="material-icons">
                    group_add
                </span></a>
        </div>
        <div class="col" style="margin-top: 2px;">
            <a href="{{route('invitedguests.index',[$invitation])}}" class="btn  btn-sm wed-btn-main">Guests Details</a>
        </div>
        <div class="col" style="margin-top: 2px;">
            <a href="{{route('invitedguestlist',[$invitation])}}" class="btn  btn-sm wed-btn-main">Send Invitations</a>
        </div>
    </div>
    <div class="wed-host-section">
        <div class="wed-host-section-container">

            <div class="wed-host-section-container-title h2">{{$invitation->brideName}} weds {{$invitation->groomName}}</div>


            <guest-component :host-id="{{$host->id}}"></guest-component>
        </div>
    </div>

@endsection
