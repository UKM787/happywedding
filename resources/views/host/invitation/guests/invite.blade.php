@extends('layouts.hostinvitation')

@section('content')

<div class="row text-center mt-5">
    <!-- <div class="col">
        <a href="{{route('invitedguests.create',[$invitation])}}" class="btn  btn-sm wed-btn-main" disabled><span class="material-icons">
                person_add
            </span>
        </a>
    </div> -->
    <div class="col" style="margin-top: 2px;">
        <a href="{{route('guestupload', $invitation)}}" class="btn  btn-sm wed-btn-main"><span class="material-icons">
                group_add
            </span></a>
    </div>
    <div class="col" style="margin-top: 2px;">
        <a href="{{route('invitedguests.index', $invitation )}}" class="btn  btn-sm wed-btn-main">Guests Details</a>
    </div>
    <div class="col" style="margin-top: 2px;">
        <a href="{{route('invitedguestlist', $invitation)}}" class="btn  btn-sm wed-btn-main">Send Invitations</a>
    </div>
</div>

<div class="wed-host-section">
    <div class="wed-host-section-container">

        <div class="wed-host-section-container-title h2">{{$invitation->brideName }} & {{$invitation->groomName}} <i class="small">sendInvitations</i></div>


        <div class="host-wed-section-container-form">
            @if($guestlist->isNotEmpty())
            <div class="row h5 text-primary">
                <div class="col-sm-2">Guest Name</div>
                <div class="col-sm-2">Mobile</div>
                <div class="col-sm-3 text-center">Invite</div>
                <div class="col-sm-1" title="Accomodation"><i class="material-icons" style="font-size: 2em;">local_hotel</i></div>
                <div class="col-sm-1" title="Logistics"><i class="material-icons" style="font-size: 2em;">electric_car</i></div>
                <div class="col-sm-1">SMS</div>
                <div class="col-sm-1">EMAIL</div>
                <div class="col-sm-1">POST</div>
            </div>

            <form class="form-loader form-row align-items-center" action=" {{route('sendinvite',[$invitation])}}" method="POST" enctype="multipart/form-data">
                @csrf
                @foreach($guestlist as $guest)

                <div class="row">
                    <div class="col-sm-2">
                        <input class="form-control-sm" type="text" name="name[{{$loop->index}}]" value="{{$guest->name}}">
                    </div>
                    <input hidden type="text" name="mail[{{$loop->index}}]" value="{{$guest->email}}">
                    <div class="col-sm-2">
                        <input class="form-control-sm" type="text" name="mobile[{{$loop->index}}]" value="{{$guest->mobile}}">
                    </div>
                    <div class="col-sm-3 text-right">
                        <input name="invite[{{$loop->index}}]" type="radio" class="form-radio" value="0" {{$guest->pivot->invite == 0 ? 'checked' : ''}}>No Invite
                        <input name="invite[{{$loop->index}}]" type="radio" class="form-radio" value="1" {{$guest->pivot->invite == 1 ? 'checked' : ''}}>Single
                        <input name="invite[{{$loop->index}}]" type="radio" class="form-radio" value="2" {{$guest->pivot->invite == 2 ? 'checked' : ''}}>Spouse
                        <input name="invite[{{$loop->index}}]" type="radio" class="form-radio" value="3" {{$guest->pivot->invite == 3 ? 'checked' : ''}}>Family
                    </div>
                    <div class="col-sm-1">
                        <input name="accommodation[{{$loop->index}}]" type="checkbox" class="form-checkbox" {{$guest->pivot->accommodation != 0 ? 'checked' : ''}}>
                    </div>
                    <div class="col-sm-1">
                        <input name="logistics[{{$loop->index}}]" type="checkbox" class="form-checkbox" {{$guest->pivot->logistics != 0 ? 'checked' : ''}}>
                    </div>
                    <div class="col-sm-1">
                        <input name="email[{{$loop->index}}]" type="checkbox" class="form-checkbox" value="1" checked>
                    </div>
                    <div class="col-sm-1">
                        <input name="sms[{{$loop->index}}]" type="checkbox" class="form-checkbox" value="1" checked>
                    </div>
                    <div class="col-sm-1">
                        <input name="post[{{$loop->index}}]" type="checkbox" class="form-checkbox" value="1" checked>
                    </div>
                </div>
                @endforeach

                <div class="row text-cente my-2">
                    <div class="col">
                        <button class="btn btn-sm wed-btn-main" type="submit">send</button>
                    </div>
                </div>
            </form>
            @endif
        </div>
    </div>
</div>


@endsection
