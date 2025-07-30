@extends('layouts.app')
@section('styles')
<style>

</style>
@endsection
@section('content')


<section class="slider">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            @foreach ($sliders as $slider)
            <div class="carousel-item {{$loop->index == 0 ? 'active' : ''}}">
                <img class="d-block w-100" src="{{asset('storage').$slider->img}}" alt="First slide">
                <div class="carousel-caption d-md-block">
                    <p>Make any occasion unforgettable</p>
                    <h2>For online wedding planners and gift registry</h2>
                    <a href="#" class="btn btn-secondary btn-mob-full">Plan your wedding</a>
                </div>
            </div>
            @endforeach
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
        </div>
    </div>
    <div class="navigation" id="main-nav">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-7">
                    <div class="nav">
                        <!-- <span class="d-lg-none nav-close" id="m-nav-closebtn"><i class="fa fa-times" aria-hidden="true"></i></span> -->
                        <ul>
                            <li class="active"><a href="/venues">WEDDING VENUES</a></li>
                            <li><a href="#">MANAGER TOOLS</a></li>
                            <li><a href="#">DIRECTORY</a></li>
                            <li><a href="#">IDEAS AND INSPIRATION</a></li>
                        </ul>
                    </div>

                </div>
                <div class="col-12 col-sm-12 col-lg-5  d-none d-lg-block login-section">

                    @unless(auth()->guard('host')->user() )
                    <a href="{{route('login')}}" class="btn btn-sm btn-danger" title="Guest Signin">Guest login</a>
                    <a href="{{route('hostRegister')}}" class="btn btn-sm btn-info" title="Host Registeration">Sign up</a>
                    <a href="{{route('hostLogin')}}" class="btn btn-sm btn-success" title="Host Signin">Log in</a>
                    @else
                    <a href="{{route('hostwelcome', auth()->guard('host')->user())}}" class="btn btn-sm btn-info">Host Dashboard</a>
                    @endunless
                </div>
            </div>
        </div>
    </div>
</section>


<section class="invite">
    <!-- <div class="container-fluid"> -->

    <div class="row">
        <div class="col-sm-6 text-center">
            <img src="img/image2.png" />
        </div>
        <div class="col-sm-6">
            <h3>Make your invitations worth remembering </h3>
            <p>Design Exclusive invitations, priceless memories</p>
            <a href="_cover.html" class="btn btn-primary btn-mob-full">Create invite</a>
        </div>
    </div>
    <!-- </div> -->
</section>

<section class="category">
    <category-component></category-component>
</section>

<section class="planning">
    <div class="container-fluid">

        <div class="row f-reverse">
            <div class="col-12 col-sm-12 col-md-6 text-center">
                <img src="img/image3.png" />

            </div>

            <div class="col-12 col-sm-12 col-md-6  sm-text-left">
                <h3>Good Planning for Good <br />Moments. </h3>
                <p>Plan your occasions perfectly</p>
                <a href="#" class="btn btn-primary btn-mob-full">Start now</a>
            </div>
        </div>
    </div>
</section>

<section class="service">
    <div class="container-fluid">

        <h3 class="text-center">THINGS YOU CAN FIND HERE</h3>
        <div class="service-box">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-3 text-center">
                    <img src="img/venue.png" />
                    <p>Wedding
                        venues</p>
                </div>
                <div class="col-12 col-sm-12 col-md-3 text-center">
                    <img src="img/directory.png" />
                    <p>Directory</p>
                </div>
                <div class="col-12 col-sm-12 col-md-3 text-center">
                    <img src="img/manage-tool.png" />
                    <p>Manager
                        tools</p>
                </div>
                <div class="col-12 col-sm-12 col-md-3 text-center">
                    <img src="img/ideas.png" />
                    <p>Ideass&
                        inspiration</p>
                </div>
            </div>
        </div>
    </div>

</section>

<section class="book-appointment">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 text-center">
                <img src="img/image 1.png" />

            </div>
            <div class="col-12 col-sm-12 col-md-6">
                <h3>Magical hands on your face for a mesmerizing result.</h3>
                <p>Book a professional makeup artist to Get cheesy by look.</p>
                <a href="#" class="btn btn-primary btn-mob-full">Book appointment</a>
            </div>
        </div>
    </div>
</section>

<section class="testimonial text-center">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 offset-md-3">
                <h4>Testimonials</h4>
                <img src="img/Ellipse 83.png" />
                <p class="img-cap">Bette brenan ~ Founder of JD web publishing</p>
                <p><em>Positive: Professionalism, Quality, Responsiveness, Value
                        Commendable decoration and efforts by the team. Thank you so much for making our day much special and
                        memorable
                        💕 Your planning and efforts made us enjoy every moment fully without any worries🙂</em></p>

                <p> <em>Looking forward for more events with you 😁</em>
                </p>
            </div>
        </div>
    </div>
</section>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-3">
                <p>About</p>
                <p>
                    Directory Hub is a business directory and listing CMS, inspired by Yelp, provides features like
                    unlimited-level categories, custom fields, listing with multiple categories. It offers buyers the maximum
                    extensibility to make any type of business or niche directory.</p>
            </div>
            <div class="col-12 col-sm-12 col-md-3">
                <ul>
                    <li>
                        <a href="#">Navigations</a>
                    </li>
                    <li>
                        <a href="#">About Us</a>
                    </li>
                    <li>
                        <a href="#">Contact Us</a>
                    </li>
                    <li>
                        <a href="#">Terms of Service</a>
                    </li>
                    <li>
                        <a href="#">Privacy Policy</a>
                    </li>
                    <li><a href="#">Sitemap</a></li>
                </ul>
            </div>
            <div class="col-12 col-sm-12 col-md-3">
                <ul>
                    <li>
                        <a href="#">Follow us</a>
                    </li>
                </ul>

            </div>
            <div class="col-12 col-sm-12 col-md-3">
                <ul>
                    <li>
                        <a href="#">Posts</a>
                    </li>
                </ul>

            </div>
        </div>
        <p class="foot-lang">Language:</p>

        <p class="text-center">Copyright © happywed 2021 All rights reserved</p>
    </div>
</footer>

@endsection
