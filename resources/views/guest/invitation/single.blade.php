@extends('layouts.guestinvitation')

@section('content')

<div class="container invitation-form guest-form">
    @if($invitation != null)
    <!--cover box start-->
    <div class="row">
        <div class="col-sm-4 venue-box">
            <div class="v-box">
                <?php $pic = asset('storage') . '/' . $invitation->imageOne; ?>
                <img src="{{ $pic}}" />
                <i class="date text-muted">{{$invitation->startDate}} ~ {{$invitation->endDate}}</i>
                <h3 class="v-title"><a href="">{{$invitation->brideName}} weds {{$invitation->groomName}}</a></h3>
                <p><span class="h4 text-muted">{{$invitation->brideMotherName}} & {{$invitation->brideFatherName}}</span> cordially invites you on the occasion of marriage of their daughter <span class="text-muted h3">{{$invitation->brideName}} </span> </p>
                <p>Ceremonies to be held from {{$invitation->startDate}} to {{$invitation->startDate}}</p>
                <p>Ceremonies will be held at {{$invitation->location->name}}, {{$invitation->location->state}}</p>
            </div>
        </div>

        <!-- @if($invitation->has('savedate')->get()->count()) -->
        <div class="col-sm-4 venue-box">
            <?php $pic = asset('storage') . '/' . $invitation->imageOne; ?>
            <div class="text-center" style="background-image: url({{$pic}}); background-color: #cccccc; ; height: 500px;  background-position: center;  background-repeat: no-repeat; background-size: cover; padding:5em">
                <span class="h1 text-danger"> Startdate : {{$invitation->savedate->startDate}}</span><br>
                <span class="h1 text-danger"> StartTime : {{{$invitation->savedate->startTime}}}</span><br>
                <div><span id="time" class="h1 text-danger"></span> minutes to Go!</div>
            </div>
        </div>
        <!-- @endif -->
        <div class="col-sm-4 venue-box">

        </div>
    </div>
    <!-- marriage invitationcover ends -->
    @else
    <div class="h1 text-muted">No Invitation yet</div>
    @endif
</div>




@endsection
