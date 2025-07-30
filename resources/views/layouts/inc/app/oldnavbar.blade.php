    <header>
        <div class="container-fluid">
            <div class="row">
                <!-- <div class="col-4">
            <span id="mob-ham-btn" class="hamb-icon d-block  d-lg-none">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </span>
        </div> -->
                <div class="col-4 text-left pl-5 animate__animated animate__pulse animate__repeat-1">
                    <a href="{{route('welcome')}}"><img src="{{asset('storage/theme/logo.svg')}}" class="main-logo" /></a>
                </div>
                <div class="col-8">
                    <div class="profile">
                        <ul>
                            @unless(auth()->guard('host')->user())
                            <li>
                                <a href="{{ route('login') }}" title="GuestSign In">
                                    <span class="h-icon"><i class="fa fa-user-plus" aria-hidden="true"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="animate__animated animate__pulse animate__repeat-2">
                                <a href="{{ route('hostRegister') }}" title="HostSign up">
                                    <span class="h-icon"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('hostLogin')}}" title="HostSign In"> <span class="h-icon"><i class="fa fa-sign-in" aria-hidden="true"></i></span>
                                </a>
                            </li>
                            @else
                            <li>
                                <a href="{{ route('hostwelcome', auth()->guard('host')->user()) }}" id="home" title="myDashboard">
                                    <i class="fa fa-dashboard" style="font-size:2em;color:white"></i>
                                </a>
                            </li>
                            <li class="h-icon">
                                <a href="{{ route('logout') }}" id="signout" title="Sorry! to see you go" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out text-danger" aria-hidden="true"></i>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                            @endunless
                        </ul>
                    </div>
                    <!-- .profile ends -->
                </div>
            </div>
            <!--.row ends -->
        </div>
    </header>
