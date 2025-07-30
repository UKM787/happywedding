<header>
    <div class="container-fluid">
        <div class="row">
            <!-- <div class="col-4">
                <span id="mob-ham-btn" class="hamb-icon d-block  d-lg-none">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                </span>
            </div> -->
            <div class="col-4 text-left pl-5">
                <a href="{{route('welcome')}}"><img src="{{asset('storage/theme/logo.svg')}}" class="main-logo" /></a>
            </div>
            <div class="col-8" style="display:flex; justify-content:end;">
                <div class="profile" style="align-self: center; padding-top:0;">
                    <ul>
                        <li>
                            <a href="#">
                                <span class="h-icon"> <i class="fa fa-video-camera" aria-hidden="true" title="livestream"></i>
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
                        </li>
                        @unless(auth()->guard('company')->user())
                        <li>
                            <a href="{{ route('login') }}" title="GuestSign In">
                                <span class="h-icon"><i class="fa fa-user-plus" aria-hidden="true" title="guest signin"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('hostRegister') }}" title="VendorSign up">
                                <span class="h-icon"><i class="fa fa-pencil-square-o" aria-hidden="true" title="vendor signup"></i>
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="{{route('companyLogin')}}" title="CompanySign In"> <span class="h-icon"><i class="fa fa-sign-in" aria-hidden="true" title="companylogin"></i></span>
                            </a>
                        </li>

                        @else
                        <li>
                            <a href="{{route('companyprofile.index', $company)}}"  title="Profile">
                                @if($company->profile != null)
                                <span class="h-icon"><img src="{{asset('assets/wedding_planner/uploads/').'/'.$company->profile->imageOne}}" alt="avtar" style="width:28px ;height:28px"></span>
                                @else
                                <span class="h-icon"><img src="{{asset('storage/defaultsv1').'/avatar.png'}}" alt="avtar" style="width:28px ;height:28px"></span>
                                @endif
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}" id="signout" title="sorry! to you go" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <span class="h-icon"><i class="fas fa-sign-out-alt"></i></span>
                            </a>
                            <form id="logout-form" action="{{ route('logoutCompany') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                        @endunless
                    </ul>
                </div>
                <!-- .profile ends -->
            </div>
        </div>
    </div>
</header>

<div class="container-fluid">
    <div class="splide vendor-dash-main-nav">
        <div class="splide__track">
            <ul class="splide__list text-center wed-host-main-nav-items">
                <li class="splide__slide">
                    <a href="{{route('companywelcome')}}">Welcome</a>
                </li>
                <!-- <li class="splide__slide">
                    <a href="#"><i class="fa fa-paperclip me-2"></i>About</a>
                </li> -->
                <!-- <li class="splide__slide">
                    <a href="#"><i class="fa fa-paperclip me-2"></i>{{__('Services')}}</a>
                </li> -->
                <li class="splide__slide">
                    <a href="{{route('companyleads.index', $company)}}"><i class="fa fa-gift me-2"></i>{{__('Leads')}}</a>
                </li>
                <li class="splide__slide">
                    <a href="{{route('companyprojects.index', $company)}}"><i class="fa fa-gift me-2"></i>Projects</a>
                </li>
                <li class="splide__slide">
                    <a href="{{route('companycalendar.index', $company)}}"><i class="fa fa-gift me-2"></i>Calendar</a>
                </li>
                <li class="splide__slide">
                    <a href="{{route('companyreviews.index', $company)}}"><i class="fa fa-gift me-2"></i>{{__('Reviews')}}</a>
                </li>
                <!-- <li class="splide__slide">
                    <a href="#"><i class="fa fa-map-marker me-2"></i>Tasks</a>
                </li> -->
                <!-- <li class="splide__slide">
                    <a href="#"><i class="fa fa-comment me-2"></i>{{__('Chat')}}</a>
                </li> -->
                <!-- <li class="splide__slide">
                    <a href="#"><i class="fa fa-paperclip me-2"></i>Contact</a>
                </li> -->
            </ul>
        </div>
    </div>
</div>
