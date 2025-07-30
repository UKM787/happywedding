@extends('layouts.host')

@section('styles')

{{--<style>
    :root {
        /* dark shades of primary color*/
        --clr-primary-1: hsl(205, 86%, 17%);
        --clr-primary-2: hsl(205, 77%, 27%);
        --clr-primary-3: hsl(205, 72%, 37%);
        --clr-primary-4: hsl(205, 63%, 48%);
        /* primary/main color */
        --clr-primary-5: #49a6e9;
        /* lighter shades of primary color */
        --clr-primary-6: hsl(205, 89%, 70%);
        --clr-primary-7: hsl(205, 90%, 76%);
        --clr-primary-8: hsl(205, 86%, 81%);
        --clr-primary-9: hsl(205, 90%, 88%);
        --clr-primary-10: hsl(205, 100%, 96%);
        /* darkest grey - used for headings */
        --clr-grey-1: hsl(209, 61%, 16%);
        --clr-grey-2: hsl(211, 39%, 23%);
        --clr-grey-3: hsl(209, 34%, 30%);
        --clr-grey-4: hsl(209, 28%, 39%);
        /* grey used for paragraphs */
        --clr-grey-5: hsl(210, 22%, 49%);
        --clr-grey-6: hsl(209, 23%, 60%);
        --clr-grey-7: hsl(211, 27%, 70%);
        --clr-grey-8: hsl(210, 31%, 80%);
        --clr-grey-9: hsl(212, 33%, 89%);
        --clr-grey-10: hsl(210, 36%, 96%);
        --clr-white: #fff;
        --clr-red-dark: hsl(360, 67%, 44%);
        --clr-red-light: hsl(360, 71%, 66%);
        --clr-green-dark: hsl(125, 67%, 44%);
        --clr-green-light: hsl(125, 71%, 66%);
        --clr-black: #222;
        --ff-primary: "Roboto", sans-serif;
        --ff-secondary: "Open Sans", sans-serif;
        --transition: all 0.3s linear;
        --spacing: 0.25rem;
        --radius: 0.5rem;
        --light-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        --dark-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        --max-width: 1170px;

    }

    /*
        ===============
        Global Styles
        ===============
        */

    h4 {
        letter-spacing: var(--spacing);
        text-transform: capitalize;
        line-height: 1.25;
        margin-bottom: 0.75rem;
        font-family: var(--ff-primary);
    }

    @media screen and (min-width: 800px) {
        h1 {
            font-size: 4rem;
        }

        h2 {
            font-size: 2.5rem;
        }

        h3 {
            font-size: 1.75rem;
        }

        h4 {
            font-size: 1rem;
        }

        body {
            font-size: 1rem;
        }

        h1,
        h2,
        h3,
        h4 {
            line-height: 1;
        }
    }

    /*  global classes */

    .btn {
        text-transform: uppercase;
        background: transparent;
        color: var(--clr-black);
        padding: 0.375rem 0.75rem;
        letter-spacing: var(--spacing);
        display: inline-block;
        transition: var(--transition);
        font-size: 0.875rem;
        border: 2px solid var(--clr-black);
        cursor: pointer;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
        border-radius: var(--radius);
    }

    .btn:hover {
        color: var(--clr-white);
        background: var(--clr-black);
    }

    /* section */



    /*
        ===============
        About
        ===============
        */


    @media screen and (min-width: 992px) {
        .about-img {
            margin-bottom: 0;
        }

        .about-center {
            display: grid;
            grid-template-columns: 1fr 1fr;
            column-gap: 2rem;
        }
    }

    .about {
        background: var(--clr-white);
        border-radius: var(--radius);
        display: grid;
        grid-template-rows: auto 1fr;
    }

    .btn-container {
        border-top-left-radius: var(--radius);
        border-top-right-radius: var(--radius);
        display: grid;
        grid-template-columns: 1fr 1fr;
    }

    .tab-btn:nth-child(1) {
        border-top-left-radius: var(--radius);
    }

    .tab-btn:nth-child(3) {
        border-top-right-radius: var(--radius);
    }

    .tab-btn {
        padding: 1rem 0;
        border: none;
        text-transform: capitalize;
        font-size: 1rem;
        display: block;
        background: white;
        cursor: pointer;
        transition: var(--transition);
        letter-spacing: var(--spacing);
        color: black;
    }

    .tab-btn:hover:not(.active) {
        background: var(--clr-primary-10);
        color: var(--clr-primary-5);
    }

    .about-content {
        border-bottom-left-radius: var(--radius);
        border-bottom-right-radius: var(--radius);
        padding: 2rem 1.5rem;
    }

    /* hide content */
    .content {
        display: none;
    }

    .tab-btn.active {
        background: #461952;
        color: white !important;
    }

    .content.active {
        display: block;
    }
</style>--}}

@endsection

@section('content')
<host-logistics :logged-in="{{$host}}" :invitation="{{$invitation ? $invitation : 'null'}}" :arrivals="{{$arrivals}}" :departures="{{$departures}}"></host-logistics>

{{--<section class="wed-host-section">
    <div class="wed-host-section-container">
        <p class="wed-logistics-title">
        <div class="row">
            <div class="offset-md-1 col-12 col-md-7 d-flex justify-content-center justify-content-md-end">
                <span id="wed-log-title">{{$invitation->brideName}} & {{ $invitation->groomName}}</span>
            </div>
        </div>
        </p>
        @if($arrivals->isNotEmpty() || $departures->isNotEmpty())
        <article class="about">
            <!-- btn container -->
            <div class="btn-container">
                <button class="tab-btn active" data-id="arrival">Arrival</button>
                <button class="tab-btn" data-id="departure">Departure</button>
            </div>

            <div class="about-content">
                <div class="row justify-content-end">
                    <div class="col-12 col-md-3 ml-auto justify-content-center wed-log-buttons flex-column position-relative">
                        <div class="d-flex">
                            <button class="wed-btn-main mr-3" id="select-multiple">Select multiple</button>
                            <button class="wed-btn-main" onclick="display_sort(event)">
                                Sort by
                            </button>
                        </div>

                        <div class="wed-log-sort" style="display:none;">
                            <div class="wed-log-sort-heading jsNav">
                                <div class="wed-log-sort-heading-active" style="padding:14px 36px 6px 30px">Location</div>
                                <div style="padding:14px 30px 6px 36px">Time/Date</div>
                            </div>
                            <div class="d-flex flex-column wed-log-sort-menu jsTab">
                                <div class="d-flex flex-column">
                                    <div>
                                        <input type="radio" name="loc" id="All" value="all">
                                        <label for="All"> All </label>
                                    </div>
                                    <input type="text" placeholder="search location">
                                    <div>
                                        <input type="radio" name="loc" id="loc-1" value="Chennai Central railway station">
                                        <label for="loc-1">Chennai Central railway station</label>
                                    </div>
                                    <div>
                                        <input type="radio" name="loc" id="loc-2" value="Chennai International Airport">
                                        <label for="loc-2">Chennai International Airport</label>
                                    </div>
                                    <div>
                                        <input type="radio" name="loc" id="loc-3" value="Chennai Puratchi Thalaivar Dr MGR Central railway station">
                                        <label for="loc-3">Chennai Puratchi Thalaivar Dr MGR Central railway station</label>
                                    </div>
                                </div>
                                <div class="d-flex flex-column jsTabHide">
                                    <div class="search-sort-date">
                                        <i class="fas fa-search"></i>
                                        <input type="text" placeholder="Search By date/ time">
                                        <i class="far fa-calendar"></i>
                                        <i class="far fa-clock"></i>
                                    </div>
                                    <div>
                                        <input type="radio" name="date" id="date-1" value="12/03/2022 Thursday 14:32 PM">
                                        <label for="date-1">12/03/2022 Thursday 14:32 PM</label>
                                    </div>
                                    <div>
                                        <input type="radio" name="date" id="date-2" value="13/03/2022 friday 05:30 PM">
                                        <label for="date-2">13/03/2022 friday 05:30 PM</label>
                                    </div>
                                    <div>
                                        <input type="radio" name="date" id="date-3" value="13/03/2022 Friday 06:30 PM">
                                        <label for="date-3">13/03/2022 Friday 06:30 PM</label>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- arrival -->
                <div class="content active" id="arrival">
                    <section class="wed-logistics-accordion">

                        @foreach($arrivals as $arrival)

                        <div class="wed-log-accord-item" style="padding-bottom: 11px;">
                            <div class="row wed-log-accord">
                                <div class="col-4 d-flex justify-content-between pl-0">
                                    <div class="d-flex">
                                        <img src="/assets/log-add.png" alt="" style="margin-left:10px">
                                        <div class="wed-log-accord-text ml-3">
                                            {{ucwords($arrival->guest->name)}}
                                        </div>
                                    </div>
                                    <div class="wed-log-accord-number">
                                        {{$arrival->guest->mobile}}
                                    </div>
                                </div>
                                <div class="col-4 d-flex justify-content-around">
                                    <div class="wed-log-accord-text">
                                        {{ucwords($arrival->travelMode)}}
                                    </div>
                                    <div class="wed-log-accord-text">
                                        {{ucwords($arrival->location)}}
                                    </div>
                                </div>
                                <div class="col-4 d-flex justify-content-between">
                                    <div class="wed-log-accord-text">
                                        {{Carbon\Carbon::parse($arrival->date)->format('d F, Y H:i:s')}}
                                    </div>
                                    <div class="wed-log-accord-text">
                                        {{count($arrival->memberCount)}}
                                    </div>
                                    <div class="wed-log-accord-text">
                                        <div class="wed-log-accord-online"></div>
                                        <div class="wed-log-accord-text">Active</div>
                                    </div>
                                </div>
                            </div>

                            <form class="row wed-log-accord-form" method="POST" action="{{route('hostlogistics.store',[ $host ])}}">
                                @csrf

                                <div class="offset-1 col-4 mt-5">
                                    <div class="wed-log-accord-form-title">
                                        Mode of transportation?
                                    </div>
                                    <div>
                                        <div class="wed-log-accord-form-fields">
                                            <input hidden type="text" name="guest_id" value="{{$arrival->guest->id}}">
                                            <input hidden type="text" name="invitation_id" value="{{$invitation->id}}">
                                            <input hidden type="text" name="type" value="arrival">

                                            <label for="vehicleNo">Vehicle Number</label>
                                            <input type="text" name="vehicleNo" id="vehicleNo" value="{{isset($arrival->vehicleNo) ? $arrival->vehicleNo: ''}}" placeholder="Vehicle Number">
                                        </div>
                                        <div class="wed-log-accord-form-fields">
                                            <label for="driverName">Vehicle Incharge Name</label>
                                            <input type="text" name="driverName" id="driverName" value="{{isset($arrival->driverName) ? $arrival->driverName: ''}}" placeholder="enter inchargeName">
                                        </div>
                                        <div class="wed-log-accord-form-fields">
                                            <label for="driverMobile">Vehicle Incharge Mobile Number</label>
                                            <input type="text" name="driverMobile" id="driverMobile" value="{{isset($arrival->driverMobile) ? $arrival->driverMobile: ''}}" placeholder="enter inchargeMobile">
                                        </div>
                                    </div>
                                </div>
                                <div class="offset-1 col-5 mr-auto ml-auto mt-5">
                                    <div class="col-7 wed-log-form-radio">
                                        <input type="radio" id="bus" name="transport" value="bus">
                                        <label for="bus"> Bus</label>
                                        <input type="radio" id="van" name="transport" value="van">
                                        <label for="van">Van</label>
                                        <input type="radio" id="car" name="transport" value="car" checked>
                                        <label for="car">Car</label>
                                    </div>

                                    <div class="wed-log-accord-form-fields">
                                        <input hidden type="text" name="guest_id" value="{{$arrival->guest->id}}">
                                        <label for="vehicleNo">inchargeName</label>
                                        <input type="text" name="inchargeName" id="inchargeName" value="{{isset($arrival->inchargeName) ? $arrival->inchargeName: ''}}" placeholder="logisticsIncharge Name">
                                    </div>
                                    <div class="wed-log-accord-form-fields">
                                        <label for="driverName">inchargeNumber</label>
                                        <input type="text" name="inchargeMobile" id="inchargeMobile" value="{{isset($arrival->inchargeMobile) ? $arrival->inchargeMobile: ''}}" placeholder="logisticsIncharge Mobile">
                                    </div>
                                    <div class="wed-log-accord-form-fields">
                                        <label for="driverMobile">inchargeLocation</label>
                                        <input type="text" name="inchargeLocation" id="inchargeLocation" value="{{isset($arrival->inchargeLocation) ? $arrival->inchargeLocation: ''}}" placeholder="logisticsIncharge Location">
                                    </div>
                                    <div class="wed-log-accord-form-submit">
                                        <button class="btn btn-sm wed-btn-main" type="submit"><i class="material-icons">save</i> </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @endforeach


                    </section>

                </div>
                <!-- end of arrival -->
                <!-- departure -->
                <div class="content" id="departure">
                    <section class="wed-logistics-accordion">

                        @foreach($departures as $departure)

                        <div class="wed-log-accord-item" style="padding-bottom: 11px;">
                            <div class="row wed-log-accord">
                                <div class="col-4 d-flex justify-content-between pl-0">
                                    <div class="d-flex">
                                        <img src="/assets/log-add.png" alt="" style="margin-left:10px">
                                        <div class="wed-log-accord-text ml-3">
                                            {{ucwords($departure->guest->name)}}
                                        </div>
                                    </div>
                                    <div class="wed-log-accord-number">
                                        {{$departure->guest->mobile}}
                                    </div>
                                </div>
                                <div class="col-4 d-flex justify-content-around">
                                    <div class="wed-log-accord-text">
                                        {{ucwords($departure->travelMode)}}
                                    </div>
                                    <div class="wed-log-accord-text">
                                        {{ucwords($departure->location)}}
                                    </div>
                                </div>
                                <div class="col-4 d-flex justify-content-between">
                                    <div class="wed-log-accord-text">
                                        {{Carbon\Carbon::parse($departure->date)->format('d F, Y H:i:s')}}
                                    </div>
                                    <div class="wed-log-accord-text">
                                        {{count($departure->memberCount)}}
                                    </div>
                                    <div class="wed-log-accord-text">
                                        <div class="wed-log-accord-online"></div>
                                        <div class="wed-log-accord-text">Active</div>
                                    </div>
                                </div>
                            </div>

                            <form class="row wed-log-accord-form" method="post" action="{{route('hostlogistics.store',[ $host ])}}">
                                @csrf

                                <div class="offset-1 col-4 mt-5">
                                    <div class="wed-log-accord-form-title">
                                        Mode of transportation?
                                    </div>
                                    <div>
                                        <div class="wed-log-accord-form-fields">
                                            <input hidden type="text" name="guest_id" value="{{$departure->guest->id}}">
                                            <input hidden type="text" name="invitation_id" value="{{$invitation->id}}">
                                            <input hidden type="text" name="type" value="departure">

                                            <label for="vehicleNo">Vehicle Number</label>
                                            <input type="text" name="vehicleNo" id="vehicleNo" value="{{isset($departure->vehicleNo) ? $departure->vehicleNo: ''}}" placeholder="Vehicle Number">
                                        </div>
                                        <div class="wed-log-accord-form-fields">
                                            <label for="driverName">Vehicle Incharge Name</label>
                                            <input type="text" name="driverName" id="driverName" value="{{isset($departure->driverName) ? $departure->driverName: ''}}" placeholder="enter inchargeName">
                                        </div>
                                        <div class="wed-log-accord-form-fields">
                                            <label for="driverMobile">Vehicle Incharge Mobile Number</label>
                                            <input type="text" name="driverMobile" id="driverMobile" value="{{isset($departure->driverMobile) ? $departure->driverMobile: ''}}" placeholder="enter inchargeMobile">
                                        </div>
                                    </div>
                                </div>
                                <div class="offset-1 col-5 mr-auto ml-auto mt-5">
                                    <div class="col-7 wed-log-form-radio">
                                        <input type="radio" id="bus" name="transport" value="bus">
                                        <label for="bus"> Bus</label>
                                        <input type="radio" id="van" name="transport" value="van">
                                        <label for="van">Van</label>
                                        <input type="radio" id="car" name="transport" value="car" checked>
                                        <label for="car">Car</label>
                                    </div>

                                    <div class="wed-log-accord-form-fields">
                                        <label for="inchargeName">inchargeName</label>
                                        <input type="text" name="inchargeName" id="inchargeName" value="{{isset($departure->inchargeName) ? $departure->inchargeName: ''}}" placeholder="logisticsIncharge Name">
                                    </div>
                                    <div class="wed-log-accord-form-fields">
                                        <label for="inchargeMobile">inchargeNumber</label>
                                        <input type="text" name="inchargeMobile" id="inchargeMobile" value="{{isset($departure->driverName) ? $departure->driverName: ''}}" placeholder="logisticsIncharge Mobile">
                                    </div>
                                    <div class="wed-log-accord-form-fields">
                                        <label for="inchargeLocation">inchargeLocation</label>
                                        <input type="text" name="inchargeLocation" id="inchargeLocation" value="{{isset($departure->inchargeLocation) ? $departure->inchargeLocation: ''}}" placeholder="logisticsIncharge Location">
                                    </div>
                                    <div class="wed-log-accord-form-submit">
                                        <button class="btn btn-sm wed-btn-main" type="submit"><i class="material-icons">save</i> </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @endforeach


                    </section>

                </div>
                <!-- end of departure -->
            </div>
        </article>
        @else
        <div class="text-center" style="background-color:thistle; border-radius: 50%;">
            <h3 style="padding: 1em 0; margin: 0 7em;">Guests are yet to provide the Arrival and Departures details to book vehicles for them. <br><br>!! Wait please</h3>
        </div>
        @endif
    </div>

</section>--}}


@endsection

@section('wed-host-script')

{{--<script>
    const about = document.querySelector(".about");
    const btns = document.querySelectorAll(".tab-btn");
    const articles = document.querySelectorAll(".content");
    about.addEventListener("click", function(e) {
        const id = e.target.dataset.id;
        if (id) {
            // remove selected from other buttons
            btns.forEach(function(btn) {
                btn.classList.remove("active");
            });
            e.target.classList.add("active");
            // hide other articles
            articles.forEach(function(article) {
                article.classList.remove("active");
            });
            const element = document.getElementById(id);
            element.classList.add("active");
        }
    });

    window.addEventListener('click', function(e){
        e.stopPropagation();
        //console.log(e);
        var sortBtn = document.querySelector('.wed-log-sort');
        sortBtn.style.display = "none";
    })
    document.getElementsByClassName('wed-log-sort')[0].addEventListener('click', function(e){
        e.stopPropagation();
    })
</script>--}}


@endsection
