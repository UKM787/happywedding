@extends('layouts.app')

@section('content')
<landing-manger-tools></landing-manger-tools>
<section class="slider">

    <nav class="top_nav">
        <div class="nav_innner">
            <div class="left_links" style="display: flex; justify-content: start;">
                <ul style="display: flex; list-style-type: none; padding-left:0">
                    <li class="l_links" style="color: #FF8BA1; margin-left: 39.11px;"><a href="wedding-venues" class="link-css">WEDDING VENUES</a></li>
                    <li class="l_links"><a href="manager-tools" class="link-css">MANAGER TOOLS</a></li>
                    <li class="l_links"> <a href="directory" class="link-css">DIRECTORY</a></li>
                    <li class="l_links"><a href="ideas-and-inspiration" class="link-css">IDEAS AND INSPIRATION</a></li>
                </ul>
            </div>
            <div class="right_links d-none d-lg-block" style="display: flex; justify-content: end;">
                <ul style="display: flex; list-style-type: none;">
                    @unless(auth()->guard('host')->user() )
                    <li class="r_links" style="background: #CE6487; display: flex; justify-content: center;box-shadow: 0px 0px 1px rgba(0, 0, 0, 0.25);
                        "><a href="{{route('hostRegister')}}" class="link-css">Sign Up</a></li>
                    <li class="r_links" style="margin-right: 31.11px; background: #9B3154;display: flex; justify-content: center;
                        "><a href="{{route('hostLogin')}}" class="link-css">Log In</a></li>

                    @else
                </ul>
                <a style="margin-right:10px;" href="{{route('hostwelcome')}}" class="btn btn-sm btn-info">Host Dashboard</a>
                @endunless
            </div>
        </div>
    </nav>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            @foreach ($sliders as $slider)
            <div class="carousel-item {{$loop->index == 0 ? 'active' : ''}}">
                <img class="d-block w-100" src="{{asset('storage').$slider->img}}" alt="First slide">
            </div>
            @endforeach
            <div class="carousel-indicators" style="margin-bottom:1rem;">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
        </div>
    </div>

</section>

<section>
    <div class="inner_3" style="width: 100%; height: 133px; background-color:#9B3154; overflow:hidden;">
        <div class="section_3a">GOOD PLANNING FOR GOOD MOMENTS</div>
        <div class="section_3b"><a href="{{route('hostRegister')}}" class="link-css">start now <i class="fas fa-arrow-right"></i></a>
        </div>
    </div>
</section>

<section class="wed-landingpage-section2">
    <div>
        <!--    <div style="background-color: white; z-index: 11; width:27%;padding: 10px 0;">
            <div class="section4-txt1">HAPPY WEDDING</div>
            <div class="text-center" style="padding-top: 6px; padding-bottom: 16px;">
                <img src="assets/Frame 88.png" alt="" style="width: auto;">
            </div>
            <div class="section4-txt2" style="padding-bottom: 15px;">
                A Stylish Wedding Begins with Us
            </div>
            <a href="" class="link-css">
                <div class="m-auto" style="background: #CC9F6A; box-shadow: 0px 0px 4.65778px 1px rgba(0, 0, 0, 0.25);border-radius: 5.82222px; width: max-content; padding:8px 30px;">
                    <div class="section4-txt3">
                        Explore vendors
                    </div>
                </div>
            </a>
        </div>-->
    </div>

</section>


<section class="section4" style="background-image:url('assets/back.png')">
    <div class="container-lg">
        <div class="row" style="position: relative;">
            <div class="sec-4img col-lg-5" style="z-index: 10;">
                <img src="assets/Frame 79.png" alt="" width="100%" style="position: relative; top: 54%;left:28%">
            </div>
            <div class="sec4img2 col-lg-7 frame" style="z-index: 1;">
                <img src="assets/Frame 78.png" alt="">
            </div>
        </div>
        <div class="row">
            <div class="sec4img3 offset-lg-2 col-lg-4">
                <div class="pt-sm-5 pb-sm-5" style="background-color: white; z-index: 11; position: relative;">
                    <div class="section4-txt1">HAPPY WEDDING</div>
                    <div class="section4-img text-center" style="padding-top: 6px; padding-bottom: 16px;">
                        <img src="assets/Frame 88.png" alt="">
                    </div>
                    <div class="section4-txt2" style="padding-bottom: 15px;">
                        A Stylish Wedding Begins with Us
                    </div>
                    <div class="m-auto" style="background: #CC9F6A; box-shadow: 0px 0px 4.65778px 1px rgba(0, 0, 0, 0.25);border-radius: 5.82222px; width: max-content; padding:8px 30px;">
                        <a href="directory" class="link-css">
                            <div class="section4-txt3">
                                Explore vendors
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="sec4img4 col-lg-6">
                <img src="assets/Frame 80.png" alt="" width="100%" style="z-index: 2; position: relative; top:-12%; left: -16%;">
            </div>
        </div>
    </div>
</section>

<!-- <section class="category">
    <category-component></category-component>
</section> -->

<section>
    <div class="icons-heading">
        <span>THINGS YOU CAN FIND HERE</span>
    </div>
    <div class="sec5-2" style="margin-top: 50px; margin-bottom: 82px; display: flex; justify-content: space-evenly;">
        <div style="display: flex; justify-content: space-around; flex:1;">
            <a href="wedding-venues" class="link-css">
                <div style="display: flex; justify-content: space-evenly;">
                    <div>
                        <img src="assets/Frame 96.png" alt="">
                        <div class="iconlink" style="margin-top: 30.36px; width: 109px;display: flex; justify-content: center;">
                            <div class="sec5menu" style="text-align: center; width: 50px;">Wedding
                                Venues</div>
                        </div>
                    </div>
                </div>
            </a>
            <div>
                <a href="directory" class="link-css">
                    <div style="display: flex; justify-content: space-evenly;">
                        <div>
                            <img src="assets/Frame 76.png" alt="">
                            <div class="iconlink" style="margin-top: 30.36px; width: 109px; display: flex; justify-content: center;">
                                <div class="sec5menu" style="text-align: center; width: 50px;">Wedding
                                    Vendors
                                </div>
                            </div>
                        </div>
                </a>
            </div>
        </div>
    </div>
    <div style="display: flex; justify-content: space-around; flex:1;">
        <div>
            <a href="manager-tools" class="link-css">
                <div style="display: flex; justify-content: space-evenly;">
                    <div>
                        <img src="assets/Frame 95.png" alt="">
                        <div class="iconlink" style="margin-top: 30.36px; width: 109px; display: flex; justify-content: center;">
                            <div class="sec5menu" style="text-align: center; width: 50px;">Manager
                                Tools </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div>
            <a href="ideas-and-inspiration" class="link-css">
                <div style="display: flex; justify-content: space-evenly;">
                    <div>
                        <img src="assets/Frame 94.png" alt="">
                        <div class="iconlink" style="margin-top: 30.36px; width: 109px; display: flex; justify-content: space-around;">
                            <div class="sec5menu" style="text-align: center;">Ideas &
                                inspiration
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    </div>
</section>

<!-- <section>
    <div class="innercontainer pt-lg-5 pb-lg-5 p-sm-2 pb " style="background-color: #9B3154; padding:8px;">
        <div class="img-cluster" style="display: flex; justify-content: space-evenly;">
            <div>
                <img src="assets/Frame 81.png" alt="" style="width: 100%;">
            </div>
            <div>
                <img src="assets/Frame 82.png" alt="" style="width: 100%;">
            </div>
            <div>
                <img src="assets/Frame 83.png" alt="" style="width: 100%;">
            </div>
            <div>
                <img src="assets/Frame 84.png" alt="" style="width: 100%;">
            </div>
            <div>
                <img src="assets/Frame 85.png" alt="" style="width: 100%;">
            </div>
            <div>
                <img src="assets/Frame 86.png" alt="" style="width: 100%;">
            </div>
        </div>
    </div>
</section> -->

<section style="overflow:hidden">
    <div class="innercontainer pt-lg-5 p-sm-2" style="background-color: #9B3154; padding:8px;">
        <div class="img-cluster" style="display: flex; justify-content: space-evenly;">
            <div class="order-sm-3 zoomed-img1">
                <img src="assets/Frame 83.png" alt="" style="width: 100%;">
            </div>
            <div class="order-sm-1 zoomed-img2">
                <img src="assets/Frame 81.png" alt="" style="width: 100%;">
            </div>
            <div class="order-sm-2 zoomed-img3">
                <img src="assets/Frame 82.png" alt="" style="width: 100%;">
            </div>
            <div class="d-sm-block order-sm-4" style="display:none;">
                <img src="assets/Frame 84.png" alt="" style="width: 100%;">
            </div>
            <div class="d-md-block order-sm-5" style="display:none;">
                <img src="assets/Frame 85.png" alt="" style="width: 100%;">
            </div>
            <div class="d-xl-block order-sm-6" style="display:none;">
                <img src="assets/Frame 86.png" alt="" style="width: 100%;">
            </div>
        </div>
        <div class="img-cluster-text">
            <a href="ideas-and-inspiration">
                Explore Ideas and inspiration
            </a>
        </div>
    </div>
</section>

<section>
    <div>
        <div class="testimonial-1">
            Testimonials
        </div>
    </div>

    <div style="display: flex; justify-content: space-between;">
        <div style="flex: 1;">
            <div class="sec7-arrow" style="display: flex; justify-content: flex-end;height: 110px;">
                <div style="align-self: center;">
                    <img src="assets/right.png" alt="">
                </div>
            </div>
        </div>
        <div style="flex: 1;">
            <div style="display: flex; justify-content: center;">
                <img src="assets/Ellipse 83.png" alt="">
            </div>
        </div>
        <div style="flex: 1;">
            <div class="sec7-arrow" style="display: flex; justify-content: flex-start;height: 110px;">
                <div style="align-self: center;">
                    <img src="assets/left.png" alt="">
                </div>
            </div>
        </div>
    </div>

    <div>
        <div class="col">
            <div class="testimonial-2">
                Bette brenan ~ Founder of JD web publishing
            </div>
        </div>
    </div>

    <div>
        <div class="col-10 col-md-5 m-auto ">
            <div class="testimonial-3">
                Positive: Professionalism, Quality, Responsiveness, Value
                Commendable decoration and efforts by the team. Thank you so much for making our day much
                special and memorable 💕 Your planning and efforts made us enjoy every moment fully without any
                worries🙂 <br><br>

                Looking forward for more events with you 😁

            </div>
        </div>
    </div>
</section>

<!-- <section class="section8 container-fluid" style="padding:0;">
    <div class="row" style="margin-right: 0">

        <div class="col-md-3 order-md-3 ml-auto col-sm-4 col-5">
            <div style="display: flex; justify-content: flex-end;">
                <div style="align-self: flex-start">
                    <img src="assets/rb.png" alt="" style="width: 100%;">
                </div>
            </div>
        </div>

        <div class="col-md-6 order-md-2 col-10 m-auto">
            <div>
                <div class="last-heading">
                    Making the best moments extra special
                </div>
                <div class="last-content">
                    Happy wedding is a wedding planning company based in the city of Chennai. The one event in your life
                    which has to be celebrated with grandiosity and be truly glorious is a wedding. <br><br>

                    Breaking the monotony to plan a chic and elegant wedding is what this company can help you achieve.
                    They believe that as weddings happen once in a lifetime, it should be a grand event that can be
                    etched in the memories of all those who attend it. <br><br>


                    Happy wedding can help you plan your wedding and its other related events in an innovative and
                    creative way, that will surely make your wedding truly special.
                </div>
            </div>
        </div>

        <div class="col-md-3 order-md-1 col-sm-4 col-5">
            <div style="display: flex; height:100%">
                <div style="align-self: flex-end">
                    <img src="assets/lb.png" alt="" style="width: 100%;">
                </div>
            </div>
        </div>


    </div>
</section>

<footer class="section11" style="background-color:rgb(70, 25, 82); display:none; padding:40px 0">
    <div class="row">
        <div class="m-auto col-10">
            <div style="display:flex; justify-content:space-between">
                <span class="mobile-foot-heading" style="margin:auto;">
                    SERVICES
                </span>
                <a href="javascript:void(0);">
                    <i class="fas fa-chevron-down" style="position:absolute; right:10px;"></i>
                </a>
            </div>
            <div class="mobile-foot1" id="footer-open">
                <div> <a href="{{route('termsofservice')}}" class="link-css">Terms of services</a> </div>
                <div> <a href="{{route('customfield')}}" class="link-css">Custom feild</a> </div>
                <div> <a href="{{route('listing')}}" class="link-css">Listing</a> </div>
                <div> <a href="{{route('offline')}}" class="link-css">Offline</a> </div>
            </div>

            <hr style="background: #FFFFFF;
            mix-blend-mode: normal;
            opacity: 0.1;
            margin-top: 17px;
            margin-bottom: 22px;">
        </div>
    </div>
    <div class="row">
        <div class="m-auto col-10">
            <div style="display:flex; justify-content:space-between">
                <span class="mobile-foot-heading" style="margin:auto;">
                    ABOUT
                </span>
                <a href="javascript:void(0);">
                    <i class="fas fa-chevron-down" style="position:absolute; right:10px"></i>
                </a>
            </div>
            <div class="mobile-foot1" id="footer-open1">
                <div> <a href="{{route('ourstory')}}" class="link-css">Our Story</a> </div>
                <div> <a href="{{route('benefits')}}" class="link-css">Benefits</a> </div>
                <div> <a href="{{route('teams')}}" class="link-css">Teams</a> </div>
                <div> <a href="#" class="link-css">Sitemap</a> </div>
            </div>
            <hr style="background: #FFFFFF;
            mix-blend-mode: normal;
            opacity: 0.1;
            margin-top: 17px;
            margin-bottom: 22px;">
        </div>
    </div>
    <div class="row">
        <div class="m-auto col-10">
            <div style="display:flex; justify-content:space-between">
                <span class="mobile-foot-heading" style="margin:auto;">
                    HELP
                </span>
                <a href="javascript:void(0);">
                    <i class="fas fa-chevron-down" style="position:absolute; right:10px"></i>
                </a>
            </div>
            <div class="mobile-foot1" id="footer-open2">
                <div> <a href="{{route('faqs')}}" class="link-css">FAQs</a> </div>
                <div> <a href="{{route('contactus')}}" class="link-css">Contact Us</a> </div>
            </div>
            <hr style="background: #FFFFFF;
                    mix-blend-mode: normal;
                    opacity: 0.1;
                    margin-top: 17px;
                    margin-bottom: 22px;">
        </div>
    </div>
    <div class="row">
        <div class="m-auto col-10 d-flex justify-content-center">
            <img src="assets/logo.svg" alt="">
        </div>
    </div>
    <div class="row">
        <div class="col-10 text-center mobile-foot2">
            Subscribe to latest updates
        </div>
    </div>
    <div class="row">
        <div class="m-auto col-10">
            <div style="display: flex; justify-content:center;">
                <form action="{{route('news.store')}}" method="POST" style="display: flex; width:250px;">
                    @csrf
                    <input type="email" name="subscriptions" id="subscriptions" placeholder="Email address" style="outline:0; border: 0; border-bottom: 2px solid rgb(255, 255, 255, 0.1); background-color:#461952; height:44.44px; width:83%;">
                    <div style="background: #F1EAE2;border-radius: 7.11111px 7.11111px 0px 0px; width: 44.44px; height: 44.44px; display: flex; justify-content: center;">
                        <button style="outline:none; border:none;"> <i class="fas fa-chevron-right" style="color: #461952; align-self: center;"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row" style="margin-top:33px; margin-bottom:36px">
        <div class="m-auto col-10">
            <div class="m-auto" style="display: flex; width:50%; justify-content: space-around;">
                <div><a href=""><img src="assets/fb.png" alt=""></a></div>
                <div style="padding-left:10px"><a href=""><img src="assets/twitter.png" alt=""></a></div>
                <div style="padding-left:10px"><a href=""><img src="assets/insta.png" alt=""></a></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="m-auto col-10">
            <div style="display: flex; justify-content:space-between;">
                <div class="footer-last1" style="margin-right: 34.67px;">
                    <a class="link-css" href="{{route('termsofservice')}}">Terms & Conditions</a>
                </div>
                <div class="footer-last1">
                    <a class="link-css" href="{{route('privacypolicy')}}">Privacy Policy</a>
                </div>
            </div>
        </div>
    </div>
</footer> -->

@endsection
