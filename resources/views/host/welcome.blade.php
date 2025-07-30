@extends('layouts.host')

@section('content')
<!-- host landing html start-->
<host-home :logged-in="{{$host}}" :invitation="{{$invitation ? $invitation : 'null'}}" :invitationsaccepted="{{$invitationsaccepted ? $invitationsaccepted : '0'}}" :invitationsdeclined="{{$invitationsdeclined ? $invitationsdeclined : '0'}}" :invitationspending="{{$invitationspending ? $invitationspending : '0'}}" :notifications="{{$notifications ? $notifications : '[]'}}" :invitationcount="{{$invitationCount ? $invitationCount : '0'}}" :accaccomodation="{{$accAccomodation ? $accAccomodation : '0'}}" :decaccomodation="{{$decAccomodation ? $decAccomodation : 0}}" :allaccomodation="{{$allAccomodation ? $allAccomodation : '0'}}" :sentaccomodation="{{$sentAccomodation ? $sentAccomodation : '0'}}" :sentlogistics="{{$sentLogistics ? $sentLogistics : '0'}}" :acclogisitcs="{{$accLogisitcs ? $accLogisitcs : '0'}}" :declogisitcs="{{$decLogisitcs ? $decLogisitcs :'0'}}" :alllogisitcs="{{$allLogisitcs ? $allLogisitcs : '0'}}" :guestcount="{{$guestCount ? $guestCount : '0'}}" :members="{{$members}}" :tasks="{{$tasks ? $tasks : '[]'}}" @venue-updated="handleVenueUpdate"></host-home>

{{--
<div class="host-land">
    <div class="h3 my-4"> <i class="text-primary">Hello {{ucwords($host->name)}}!</i> <small>Welcome to Happywed</small></div>
    <div class="row">
        <div class="col-sm-3">
            <div class="host-venue-box mb-4">
                @isset($ceramonies)
                <h2>CEREMONIES <sup class="small">{{count($ceramonies)}}</sup></h2>
                @else
                <h2>No Ceramonies</h2>
                @endisset
                <div>
                    @isset($invitation)
                    <a href="{{route('hostceramony.create', [$invitation])}}" class="btn btn-upload btn-red">Add Ceremony</a>
                    @else
                    <p class="text-center">No Invitation Created</p>
                    @endisset
                </div>
                <ul>
                    @if(!empty($ceramonies))
                    @foreach($ceramonies as $ceramony)
                    <li>{{$ceramony->name}} <a class="btn btn-xs pull-right" href="{{route('hostceramony.edit',[$invitation,$ceramony])}}"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> </a></li>
                    @endforeach
                    @endif
                </ul>
            </div>
            <div class="host-venue-box mb-4">
                <h2> Venues</h2>
                @if(!empty($ceramonies))
                @foreach($ceramonies as $ceramony)
                <div class="row">
                    <div class="col">
                        {{ucwords($ceramony->name)}}
                    </div>
                    <div class="col">
                        <p><i class="fa fa-map-marker" aria-hidden="true"></i>
                            @foreach ($ceramony->venues as $venue)
                            <small class="text-muted"> {{$venue->name}},
                                {{$venue->description}}</small>,
                            <b>{{$venue->location->name}}</b>
                            @endforeach
                        </p>
                    </div>
                </div>
                @endforeach
                @else
                <p class="text-center">no venues listed yet</p>
                @endif
            </div>
        </div>
        <div class="col-sm-6 mb-6">
            <div class="row">
                <div class="col-sm-8">
                    <div class="host-inv-card card mb-4">
                        <div class="card-header">
                            INVITATION
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="i-box i-burple">
                                        <h4>Total invitation</h4>
                                        <p>{{$invitationCount ?? ''}}</p>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="i-box i-green">
                                        <h4>Total accepted</h4>
                                        <p>{{$invitationsaccepted ?? ''}}</p>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="i-box i-orange">
                                        <h4>Total pending</h4>
                                        <p>{{$invitationspending ?? ''}}</p>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="i-box i-red">
                                        <h4>Total declained</h4>
                                        <p>{{$invitationsdeclined ?? ''}}</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="host-tot-box mb-3">
                        <div class="inner-box">
                            <h3>Total Invitations</h3>
                            <div class="pb-3"><span>{{isset($invitationCount) ?  $invitationCount : 0}}</span> <button class="btn btn-sm btn-orange"><i class="fa fa-user-plus" aria-hidden="true"></i></button></div>
                        </div>
                    </div>
                    <div class="host-tot-box mb-4">
                        <div class="inner-box">

                            <h3>Total Guests</h3>
                            <div class="pb-3"><span>{{isset($guestCount) ?  $guestCount : 0}}</span> <button class="btn btn-sm btn-orange"><i class="fa fa-user-plus" aria-hidden="true"></i></button></div>
                        </div>

                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="task-box mb-4">
                        <h4><i class="fa fa-file-text" aria-hidden="true"></i> Task</h4>
                        <div class="host-task-list">
                            <p>Book Mohandi artist</p>
                            <span><img src="/img/profile.png"></span>
                            <span><img src="/img/profile.png"></span>
                            <span><img src="/img/profile.png"></span>
                            <span><img src="/img/profile.png"></span>
                            <button class="btn btn-success btn-sm btn-task">Done</button>

                        </div>
                        <div class="host-task-list">
                            <p>Book Mohandi artist</p>
                            <span><img src="/img/profile.png"></span>
                            <span><img src="/img/profile.png"></span>
                            <span><img src="/img/profile.png"></span>
                            <span><img src="/img/profile.png"></span>
                            <button class="btn btn-success btn-sm btn-task">Done</button>

                        </div>
                        <div class="host-task-list">
                            <p>Book Mohandi artist</p>
                            <span><img src="/img/profile.png"></span>
                            <span><img src="/img/profile.png"></span>
                            <span><img src="/img/profile.png"></span>
                            <span><img src="/img/profile.png"></span>
                            <button class="btn btn-success btn-sm btn-task">Done</button>
                        </div>
                    </div>

                </div>
                <div class="col-sm-6">
                    <div class="todo-box">
                        <h4><i class="fa fa-file-text" aria-hidden="true"></i> To Do </h4>
                        <div class="host-todo-list">
                            <p>Book Mahandi artist</p>
                            <p><i class="fa fa-calendar" aria-hidden="true"></i> Time 5pm</p>
                            <span><img src="/img/profile.png"></span>
                            <span><img src="/img/profile.png"></span>
                            <span><img src="/img/profile.png"></span>
                            <span><img src="/img/profile.png"></span>
                            <button class="btn btn-info btn-sm btn-todo">Done</button>

                        </div>

                        <div class="host-todo-list">
                            <p>Book Mahandi artist</p>
                            <p><i class="fa fa-calendar" aria-hidden="true"></i> Time 5pm</p>
                            <span><img src="/img/profile.png"></span>
                            <span><img src="/img/profile.png"></span>
                            <span><img src="/img/profile.png"></span>
                            <span><img src="/img/profile.png"></span>
                            <button class="btn btn-info btn-sm btn-todo">Done</button>

                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="host-report mt-4 mb-4">
                        <h4>Report</h4>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Guest name</th>
                                    <th scope="col">Age</th>
                                    <th scope="col">Gender</th>
                                    <th scope="col" class="text-right">Online status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><img src="/img/profile.png" /> Sushmi</td>
                                    <td>21</td>
                                    <td>Female</td>
                                    <td class="text-right"><span class="online"></span>active</td>
                                </tr>
                                <tr>
                                    <td><img src="/img/profile.png" /> Sushmi</td>
                                    <td>21</td>
                                    <td>Female</td>
                                    <td class="text-right"><span class="online active"></span>active</td>
                                </tr>
                                <tr>
                                    <td><img src="/img/profile.png" /> Sushmi</td>
                                    <td>21</td>
                                    <td>Female</td>
                                    <td class="text-right"><span class="online"></span>active</td>
                                </tr>
                                <tr>
                                    <td><img src="/img/profile.png" /> Sushmi</td>
                                    <td>21</td>
                                    <td>Female</td>
                                    <td class="text-right"><span class="online"></span>active</td>
                                </tr>
                                <tr>
                                    <td><img src="/img/profile.png" /> Sushmi</td>
                                    <td>21</td>
                                    <td>Female</td>
                                    <td class="text-right"><span class="online"></span>active</td>
                                </tr>
                                <tr>
                                    <td><img src="/img/profile.png" /> Sushmi</td>
                                    <td>21</td>
                                    <td>Female</td>
                                    <td class="text-right"><span class="online"></span>active</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-sm-3">
            <div class="host-not-box mb-4">
                <h2>Notifications</h2>

                <div class="wed-host-notif-cont" style="position:unset; width:auto;display:block;background-color:transparent; box-shadow:none">

                    @if(isset($notifications) && $notifications->isNotEmpty())
                    @foreach($notifications as $notification)
                    <ul class="notify_item">
                        @switch($notification->type)

                        @case ("App\Notifications\Guest\AccommodationNotifications")
                        <li>
                            @if(isset($notification->data['profile']['imageOne']) )
                            <img src="{{asset('storage').$notification->data['profile']['imageOne']}}" alt="profilePhoto" id="imageOneTag" width="6em" height="auto">
                            <div>
                                <p>{{$notification->data['user']['name']}} {{$notification->data['status']}}</p>
                                <p>@ {{ $notification->created_at}}</p>
                            </div>
                            @else
                            <img src="{{asset('storage/defaultsv1').'/avatar.png'}}" alt="profilePhoto" id="imageOneTag" width="6em" height="auto">
                            <div>
                                <p>
                                    {{$notification->data['user']['name']}} {{$notification->data['status']}}
                                </p>
                                <p>@ {{ $notification->created_at}}</p>
                            </div>
                            @endif
                        </li>
                        @break;

                        @case ("App\Notifications\Guest\InvitationNotifications")
                        <li>
                            @if(isset($notification->data['profile']['imageOne']) )
                            <img src="{{asset('storage').$notification->data['profile']['imageOne']}}" alt="profilePhoto" id="imageOneTag" width="6em" height="auto">
                            <div>
                                <p>
                                    Marriage Invitation of {{$notification->data['invitation']['brideName']}} weds {{$notification->data['invitation']['groomName']}} on {{\Carbon\Carbon::parse($notification->data['invitation']['startDate'])->format('d m, Y')}} by {{$notification->data['user']['name']}} {{ $notification->data['status'] }}
                                </p>
                                <p>@ {{ $notification->created_at}}</p>
                            </div>
                            @else
                            <img src="{{asset('storage/defaultsv1').'/avatar.png'}}" alt="profilePhoto" id="imageOneTag" width="6em" height="auto">
                            <div>
                                <p>Marriage Invitation of {{$notification->data['invitation']['brideName']}} weds {{$notification->data['invitation']['groomName']}} on {{\Carbon\Carbon::parse($notification->data['invitation']['startDate'])->format('d m, Y')}} by {{$notification->data['user']['name']}} {{ $notification->data['status'] }}</p>
                                <p>@ {{ $notification->created_at}}</p>
                            </div>
                            @endif
                        </li>
                        @break;

                        @case("App\Notifications\Guest\ArrivalNotifications")
                        <li>
                            @if(isset($notification->data['profile']['imageOne']) )
                            <img src="{{asset('storage').$notification->data['profile']['imageOne']}}" alt="profilePhoto" id="imageOneTag" width="6em" height="auto">
                            <div>
                                <p>
                                    {{$notification->data['user']['name']}} {{ $notification->data['status'] }}
                                </p>
                                <p>@ {{ $notification->created_at}}</p>
                            </div>
                            @else
                            <img src="{{asset('storage/defaultsv1').'/avatar.png'}}" alt="profilePhoto" id="imageOneTag" width="6em" height="auto">
                            <div>
                                <p>
                                    {{$notification->data['user']['name']}} {{ $notification->data['status'] }}
                                </p>
                                <p>@ {{ $notification->created_at}}</p>
                            </div>
                            @endif
                        </li>
                        @break

                        @case("App\Notifications\Guest\DepartureNotifications")
                        <li>
                            @if(isset($notification->data['profile']['imageOne']) )
                            <img src="{{asset('storage').$notification->data['profile']['imageOne']}}" alt="profilePhoto" id="imageOneTag" width="6em" height="auto">
                            <div>
                                <p>
                                    {{$notification->data['user']['name']}}{{ $notification->data['status'] }}
                                </p>
                                <p>@ {{ $notification->created_at}}</p>
                            </div>
                            @else
                            <img src="{{asset('storage/defaultsv1').'/avatar.png'}}" alt="profilePhoto" id="imageOneTag" width="6em" height="auto">
                            <div>
                                <p>
                                    {{$notification->data['user']['name']}} {{ $notification->data['status'] }}
                                </p>
                                @endif
                                <p>@ {{ $notification->created_at}}</p>
                            </div>
                        </li>
                        @break

                        @default:
                        <h1> No Notifications found</h1>
                        @break;


                        @endswitch

                    </ul>
                    @endforeach
                    @endif
                </div>
                <div class="wed-host-notif-cont" style="position:unset; width:auto;display:block;background-color:transparent; box-shadow:none">

                                @if(isset($notifications) && $notifications->isNotEmpty())
                                    @foreach($notifications as $notification)
                                    <div class="notify_item">

                                        @switch($notification->type)

                                            @case ("App\Notifications\Guest\AccommodationNotifications")
                                            <span class="notify_item-span">
                                                @if(isset($notification->data['profile']['imageOne']) )
                                                <img src="{{asset('storage').$notification->data['profile']['imageOne']}}" alt="profilePhoto" id="imageOneTag" width="6em" height="auto">
                                                <div>
                                                    <p>{{$notification->data['user']['name']}} {{$notification->data['status']}}</p>
                                                    <p>@ {{ $notification->created_at}}</p>
                                                </div>
                                                @else
                                                <img src="{{asset('storage/defaultsv1').'/avatar.png'}}" alt="profilePhoto" id="imageOneTag" width="6em" height="auto">
                                                <div>
                                                    <p>
                                                        {{$notification->data['user']['name']}} {{$notification->data['status']}}
                                                    </p>
                                                    <p>@ {{ $notification->created_at}}</p>
                                                </div>
                                                @endif
                                            </span>
                                            @break;

                                            @case ("App\Notifications\Guest\InvitationNotifications")
                                            <span class="notify_item-span">
                                                @if(isset($notification->data['profile']['imageOne']) )
                                                <img src="{{asset('storage').$notification->data['profile']['imageOne']}}" alt="profilePhoto" id="imageOneTag" width="6em" height="auto">
                                                <div>
                                                    <p>
                                                        Marriage Invitation of {{$notification->data['invitation']['brideName']}} weds {{$notification->data['invitation']['groomName']}} on {{\Carbon\Carbon::parse($notification->data['invitation']['startDate'])->format('d m, Y')}} by {{$notification->data['user']['name']}} {{ $notification->data['status'] }}
                                                    </p>
                                                    <p>@ {{ $notification->created_at}}</p>
                                                </div>
                                                @else
                                                <img src="{{asset('storage/defaultsv1').'/avatar.png'}}" alt="profilePhoto" id="imageOneTag" width="6em" height="auto">
                                                <div>
                                                    <p>Marriage Invitation of {{$notification->data['invitation']['brideName']}} weds {{$notification->data['invitation']['groomName']}} on {{\Carbon\Carbon::parse($notification->data['invitation']['startDate'])->format('d m, Y')}} by {{$notification->data['user']['name']}} {{ $notification->data['status'] }}</p>
                                                    <p>@ {{ $notification->created_at}}</p>
                                                </div>
                                                @endif
                                            </span>
                                            @break;

                                            @case("App\Notifications\Guest\ArrivalNotifications")
                                            <span class="notify_item-span">
                                                @if(isset($notification->data['profile']['imageOne']) )
                                                <img src="{{asset('storage').$notification->data['profile']['imageOne']}}" alt="profilePhoto" id="imageOneTag" width="6em" height="auto">
                                                <div>
                                                    <p>
                                                        {{$notification->data['user']['name']}} {{ $notification->data['status'] }}
                                                    </p>
                                                    <p>@ {{ $notification->created_at}}</p>
                                                </div>
                                                @else
                                                <img src="{{asset('storage/defaultsv1').'/avatar.png'}}" alt="profilePhoto" id="imageOneTag" width="6em" height="auto">
                                                <div>
                                                    <p>
                                                        {{$notification->data['user']['name']}} {{ $notification->data['status'] }}
                                                    </p>
                                                    <p>@ {{ $notification->created_at}}</p>
                                                </div>
                                                @endif
                                            </span>
                                            @break

                                            @case("App\Notifications\Guest\DepartureNotifications")
                                            <span class="notify_item-span">
                                                @if(isset($notification->data['profile']['imageOne']) )
                                                <img src="{{asset('storage').$notification->data['profile']['imageOne']}}" alt="profilePhoto" id="imageOneTag" width="6em" height="auto">
                                                <div>
                                                    <p>
                                                        {{$notification->data['user']['name']}}{{ $notification->data['status'] }}
                                                    </p>
                                                    <p>@ {{ $notification->created_at}}</p>
                                                </div>
                                                @else
                                                <img src="{{asset('storage/defaultsv1').'/avatar.png'}}" alt="profilePhoto" id="imageOneTag" width="6em" height="auto">
                                                <div>
                                                    <p>
                                                        {{$notification->data['user']['name']}} {{ $notification->data['status'] }}
                                                    </p>
                                                    <p>@ {{ $notification->created_at}}</p>
                                                </div>
                                                @endif
                                            </span>
                                            @break

                                            @default:
                                            <h1> No Notifications found</h1>
                                            @break;


                                        @endswitch

                                    </div>
                                    @endforeach
                                @endif
                            </div>


            </div>
        </div>
    </div>


</div>--}}
<!-- host landin html end-->

@endsection

@section('wed-host-slider')
{{--<script>
    document.addEventListener('DOMContentLoaded', function() {
        new Splide('.wed-host-main-nav', {
            type: "slide",
            perPage: 6,
            perMove: 2,
            pagination: false,
            rewind: true,
            trimSpace: false,
            rewind: true
        }).mount();
    });
</script>--}}
@endsection
