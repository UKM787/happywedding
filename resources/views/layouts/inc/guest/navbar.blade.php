<!-- .wed-top-nav starts -->
<header style="overflow-x: hidden; position:fixed; top:0; z-index:9999999; width:100%">
    <div class="container-fluid">
        <div class="row" style="margin-right:0;">
            <div class="col-4 pl-5">
                <a href="{{route('guestwelcome.index', $user)}}">
                    <img 
                        src="{{asset('assets/theme/logo.png')}}" 
                        class="main-logo" 
                        onerror="this.onerror=null; this.src='{{asset('storage/theme/logo.svg')}}'; if(this.src.includes('storage/theme/logo.svg')) this.onerror=function(){this.src='{{asset('assets/login/logo.png')}}';}"
                    />
                </a>
            </div>
            <div class="col-8" style="display:flex; justify-content:end;">
                <div class="profile" style="align-self: center; padding-top:0;">
                    <ul>
                        {{--
                        <li>
                            <a href="">
                                <span class="h-icon"> <i class="fa fa-video-camera" aria-hidden="true" title="LiveStreaming"></i>
                                </span>
                            </a>
                        </li>
                        <li class="wed-host-notif-btn">
                            <a>
                                <span class="h-icon"><i class="fa fa-bell " aria-hidden="true" title="notifications"></i>
                                    <span class="wed-host-notif-alert"></span>
                                </span>
                            </a>

                            <div class="wed-host-notif-cont">
                                @if(isset($notifications) && $notifications->isNotEmpty())
                                @foreach($notifications as $notification)
                                <ul class="notify_item">
                                    @switch($notification->type)
                                    @case ("App\Notifications\Host\AccommodationNotifications")
                                    <li>
                                        @if(isset($notification->data['profile']['imageOne']) )
                                        <img src="{{asset('storage').$notification->data['profile']['imageOne']}}" alt="profilePhoto" id="imageOneTag" width="6em" height="auto">
                                        <div>
                                            <p>
                                                {{$notification->data['host']['name']}} {{$notification->data['status']}}
                                            </p>
                                            <p>@ {{ $notification->created_at}}</p>
                                        </div>
                                        @else
                                        <img src="{{asset('storage/defaultsv1').'/avatar.png'}}" alt="profilePhoto" id="imageOneTag" width="6em" height="auto">
                                        <div>
                                            <p>
                                                {{$notification->data['host']['name']}} {{$notification->data['status']}}
                                            </p>
                                            <p>@ {{ $notification->created_at}}</p>
                                        </div>
                                        @endif
                                    </li>
                                    @break;
                                    @case ("App\Notifications\Host\InvitationNotifications")
                                    <li>
                                        @if(isset($notification->data['profile']['imageOne']) )
                                        <img src="{{asset('storage').$notification->data['profile']['imageOne']}}" alt="profilePhoto" id="imageOneTag" width="6em" height="auto">
                                        <div>
                                            <p>
                                                {{$notification->data['invitation']['brideName']}} & {{$notification->data['invitation']['groomName']}} on {{\Carbon\Carbon::parse($notification->data['invitation']['startDate'])->format('d m, Y')}} {{$notification->data['status']}}
                                                {{$notification->data['host']['name']}}
                                            </p>
                                            <p>@ {{ $notification->created_at}}</p>
                                        </div>
                                        @else
                                        <img src="{{asset('storage/defaultsv1').'/avatar.png'}}" alt="profilePhoto" id="imageOneTag" width="6em" height="auto">
                                        <div>
                                            <p>{{$notification->data['invitation']['brideName']}} & {{$notification->data['invitation']['groomName']}} on {{\Carbon\Carbon::parse($notification->data['invitation']['startDate'])->format('d m, Y')}} {{$notification->data['status']}}
                                                {{$notification->data['host']['name']}}
                                            </p>
                                            <p>@ {{ $notification->created_at}}</p>
                                        </div>
                                        @endif
                                    </li>
                                    @break;

                                    @case("App\Notifications\Host\ArrivalNotifications")
                                    <li>
                                        @if(isset($notification->data['profile']['imageOne']) )
                                        <img src="{{asset('storage').$notification->data['profile']['imageOne']}}" alt="profilePhoto" id="imageOneTag" width="6em" height="auto">
                                        <div>
                                            <p>
                                                {{$notification->data['host']['name']}} {{$notification->data['status']}}
                                            </p>
                                            <p>@ {{ $notification->created_at}}</p>
                                        </div>
                                        @else
                                        <img src="{{asset('storage/defaultsv1').'/avatar.png'}}" alt="profilePhoto" id="imageOneTag" width="6em" height="auto">
                                        <div>
                                            <p>
                                                {{$notification->data['host']['name']}} {{$notification->data['status']}}
                                            </p>
                                            <p>@ {{ $notification->created_at}}</p>
                                        </div>
                                        @endif
                                    </li>
                                    @break

                                    @case("App\Notifications\Host\DepartureNotifications")
                                    <li>
                                        @if(isset($notification->data['profile']['imageOne']) )
                                        <img src="{{asset('storage').$notification->data['profile']['imageOne']}}" alt="profilePhoto" id="imageOneTag" width="6em" height="auto">
                                        <div>
                                            <p>
                                                {{$notification->data['host']['name']}} {{$notification->data['status']}}
                                            </p>
                                            <p>@ {{ $notification->created_at}}</p>
                                        </div>
                                        @else
                                        <img src="{{asset('storage/defaultsv1').'/avatar.png'}}" alt="profilePhoto" id="imageOneTag" width="6em" height="auto">
                                        <div>
                                            <p>
                                                {{$notification->data['host']['name']}} {{$notification->data['status']}}
                                            </p>
                                            <p>@ {{ $notification->created_at}}</p>
                                        </div>
                                        @endif
                                    </li>
                                    @break
                                    @endswitch
                                </ul>
                                @endforeach
                                @endif
                            </div>
                        </li>
                        --}} 
                        @unless(auth()->user() )
                        <li>
                            <span class="h-icon">
                                <a href="{{ route('login') }}" id="signin" title="Sign In"><i class="fa fa-sign-in" aria-hidden="true"></i></a>
                            </span>
                        </li>
                        <li>
                            <spN class="h-icon">
                                <a href="/login/host" class="wed-top-nav-item" id="hostsignin" title="HostSign In"><i class="fa fa-sign-in" aria-hidden="true"></i>
                                </a>
                            </spN>
                        </li>
                        @else
                        <li>
                            <span class="h-icon" style="margin-right: 10px;">
                                <a href="{{route('guestprofile.index', $user)}}" id="guestprofile" title="GuestProfile">
                                    @if(isset($user->profile->imageOne) && $user->profile->imageOne == '/guests/guestDefault.png')
                                    <span><img src="{{asset('storage').$user->profile->imageOne}}" alt="avatar"></span>

                                    @elseif(isset($user->profile->imageOne))
                                    <span><img src="{{asset('assets/guests/uploads').'/'.$user->profile->imageOne}}" alt="avatar"></span>
                                    @else
                                    <span><img src="{{asset('storage/defaultsv1/avatar.png')}}" alt="avatar"></span>
                                    @endif
                                </a>
                            </span>
                        </li>
                        <li>
                            <span class="h-icon">
                                <a href="{{ route('logout') }}" class="h-icon" id="signout" title="Logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt"></i>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </span>
                        </li>
                        @endunless
                    </ul>
                </div>
                <!-- .profile ends -->
            </div>
        </div>
    </div>
    <!--.row ends -->
</header>

{{--
<!-- wed-main-nav -->
<div class="container-fluid">
    <div class="vendor-dash-main-nav splide">
        <div class="splide__track">
            <ul class="splide__list text-center wed-guest-main-nav-items">
                <li class="splide__slide">
                    <h5><a href="{{route('guestwelcome.index', $user)}}">Welcome</a></h5>
                </li>
               <li class="splide__slide">
                    <h5><a href="{{route('guestnew-invitations',$user)}}">{{__("newInvitations")}}</a></h5>
                </li>
                <li class="splide__slide">
                    <h5><a href="{{route('guestaccepted-invitations',$user)}}">Accepted</a></h5>
                </li>
                <li class="splide__slide">
                    <h5><a href="{{route('guestdeclined-invitations',$user)}}">Declined</a></h5>
                </li>
                <li class="splide__slide">
                    <h5><a href="{{route('guestpending-invitations',$user)}}">Pending</a></h5>
                </li> 
            </ul>
        </div>
    </div>
</div>
<!-- wed-main-nav ends--> --}}


