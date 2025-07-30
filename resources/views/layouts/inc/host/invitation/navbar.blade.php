<header style="overflow-x: hidden; position:fixed; top:0; z-index:9999999; width:100%">
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
            <div class="col-8">
                <div class="profile">
                    <ul>
                        <li>
                            <a href="#">
                                <span class="h-icon"> <i class="fa fa-video-camera" aria-hidden="true" title="livestream"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="h-icon"><i class="fa fa-bell" aria-hidden="true" title="notifications"></i>
                                </span>
                            </a>
                        </li>
                        @unless(auth()->guard('host')->user())
                        <li>
                            <a href="{{ route('login') }}" title="GuestSign In">
                                <span class="h-icon"><i class="fa fa-user-plus" aria-hidden="true" title="guest signin"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('hostRegister') }}" title="HostSign up">
                                <span class="h-icon"><i class="fa fa-pencil-square-o" aria-hidden="true" title="host signup"></i>
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="{{route('hostLogin')}}" title="HostSign In"> <span class="h-icon"><i class="fa fa-sign-in" aria-hidden="true" title="hostlogin"></i></span>
                            </a>
                        </li>

                        @else

                        @unless(auth()->guard('host')->user() )
                        <li>
                            <a href="{{ route('profile.index') }}" title="Profile">
                                <span>
                                    <img src="{{asset('storage/hosts'.$hostprofile->host_photo)}}" alt="avtar"></span> </a>
                        </li>
                        @else
                        <li>
                            <a href="{{ route('profile.index') }}" title="Profile">
                                <span class="h-icon"><img src="{{asset('storage/defaultsv1').'/avatar.png'}}" alt="avtar"></span>
                            </a>
                        </li>
                        @endunless
                        <li>
                            <a href="{{ route('logout') }}" id="signout" title="sorry! to you go" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <span class="h-icon"><i class="fas fa-sign-out-alt"></i></span>
                            </a>
                            <form id="logout-form" action="{{ route('logoutHost') }}" method="POST" class="d-none">
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


{{--
<div class="container-fluid mt-3">
    <!-- <h1 class="text-center"> <a href="{{route('hostwelcome')}}" class="btn wed-btn-invitation">Home</a></h1> -->


    <div class="vendor-dash-main-nav splide">
        <div class="splide__track">
            <ul class="splide__list text-center wed-host-invitation-nav-items">
                <li class="splide__slide">
                    <a href="{{route('hostwelcome')}}">Home</a>
                </li>
                <li class="splide__slide">
                    <a href="{{route('hostinvitations.index', $invitation ?? '')}}">InvitationCover</a>
                </li>
                <li class="splide__slide">
                    <a href="{{route('hostsavedate.custom', $invitation ?? '')}}">SaveTheDate</a>
                </li>
                
                <li class=" splide__slide">
                    <a href="{{route('hoststory.custom', $invitation ?? '')}}">OurStory</a>
                </li>
                
                <li class="splide__slide">
                    <a href="{{route('hostceremony.custom', $invitation ?? '')}}">Ceramonies</a>
                </li>
                
                <li class="splide__slide">
                    <a href="{{route('invitedguests.custom', $invitation ?? '')}}">Guests</a>
                </li>
                <li class="splide__slide">
                    <a href="{{route('hostinvitationcontact.custom', $invitation ?? '')}}">Help Line</a>
                </li>
                <!-- <li class="splide__slide">
                    <a href="{{route('hostecard.index', [$invitation])}}">E-Card</a>
                </li>
                <li class="splide__slide">
                    <a href="{{route('hostwebsite.index', [$invitation])}}">Website</a>
                </li>
                <li class="splide__slide">
                    <a href="{{route('hostfoodmenu.index',  [$invitation])}}">Food Menu</a> 
                </li>-->
            </ul>
        </div>
    </div>
</div>
--}}
