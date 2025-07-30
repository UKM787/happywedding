{{--     <header style="display:none">
        <div class="container-fluid">
            <div class="row">
                <!-- <div class="col-4">
            <span id="mob-ham-btn" class="hamb-icon d-block  d-lg-none">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </span>
          </div> -->
                <div class="col-3 d-lg-none d-flex">
                     <button style="border:0;outline:0; background-color:inherit" onclick="nav()"><i class="fa fa-bars" aria-hidden="true" style="color:white; font-size:24px; align-self:center;"></i></button>
                </div>
                <div class="col-lg-12 text-lg-center col-5 d-flex justify-content-center animate__animated animate__pulse animate__repeat-1 p-0">
                    <a class="d-flex" href="{{route('welcome')}}"><img src="{{asset('storage/theme/logo.svg')}}" class="main-logo w-auto align-self-center  " /></a>
                </div>
                <div class="col-4 d-lg-none d-block d-flex align-content-center justify-content-end p-1">
                    <div class="profile">
                        <ul>
                            @unless(auth()->guard('host')->user())
                            <li>
                                <a href="{{ route('login') }}" title="GuestSign In">
                                    <span class="before-login-icon"><img src="../assets/topicon1.png" alt="">
                                    </span>
                                </a>
                            </li>
                            <li class="animate__animated animate__pulse animate__repeat-2">
                                <a href="{{ route('hostRegister') }}" title="HostSign up">
                                    <span class="before-login-icon"><img src="../assets/topicon2.png" alt="">
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('hostLogin')}}" title="HostSign In"> <span class="before-login-icon"><img src="../assets/topicon3.png" alt=""></span>
                                </a>
                            </li>
                            @else
                            <li class="h-icon">
                                <a href="{{ route('hostwelcome', auth()->guard('host')->user()) }}" id="home" title="myDashboard">
                                    <i class="fas fa-clipboard-list text-danger"></i>
                                </a>
                            </li>
                            <li class="h-icon">
                                <a href="{{ route('logout') }}" id="signout" title="Sorry! to see you go" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out-alt text-danger" aria-hidden="true"></i>
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
            <div class="row" id="nav-header">
                <div class="col-4 text-center" style="padding:0;">
                  <a style="margin:auto" href="" class="link-css l_links">Wedding venues</a>
                </div>
                <div class="col-4 text-center">
                    <a style="margin:auto" href="" class="link-css l_links">Manager Tools</a>
                </div>
                <div class="col-4 text-center">
                    <a style="margin:auto" href="" class="link-css l_links">Directory</a>
                </div>
                <div class="col-12 text-center mt-4 mb-3">
                   <a style="margin:auto" href="" class="link-css l_links">Ideas and inspiration</a>
                </div>
            </div>
        </div>
</header> --}}


