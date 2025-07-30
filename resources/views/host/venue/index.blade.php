@extends('layouts.host')

@section('styles')
<!-- <style>
    /* wedding Venues Page Css start */
    .wed-ven-main-search {
        display: flex;
        flex-direction: column;
        width: 100%;
    }

    .wed-ven-main-search>p:nth-child(1) {
        font-family: Rage Italic;
        font-style: italic;
        font-weight: normal;
        font-size: 18.1818px;
        line-height: 23px;
        color: #FFFFFF;
        text-align: center;
    }

    .wed-ven-main-search>p:nth-child(2) {
        font-family: Segoe UI;
        font-style: normal;
        font-weight: normal;
        font-size: 21.8182px;
        line-height: 29px;
        color: #FFFFFF;
        text-align: center;
        margin-bottom: 2em;
    }

    .wed-ven-main-search>div {
        background: rgba(255, 255, 255, 0.5);
        padding: 28px 23px;
        width: 58%;
        margin: auto;
    }

    .wed-ven-main-search>div>form>select {
        padding: 11px 0;
        padding-left: 22px;
        border: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        background: #FFFFFF;
        border-radius: 5px;
        background-image: url("/assets/icon-SVG/twemoji_flag-for-flag-india.svg"), url("/assets/mySVG/dropdown.svg");
        background-repeat: no-repeat, no-repeat;
        background-position: 2%, 98%;
        background-size: 20px, 20px;
        width: 25%;
        border: none;
    }

    .wed-ven-main-search>div>form>select>option {
        font-family: Segoe UI;
        font-style: normal;
        font-weight: normal;
        font-size: 10px;
        line-height: 13px;
        color: #3D3838;
    }

    #search {
        width: 55%;
    }

    #search>input {
        width: 100%;
        padding: 11px;
        background-color: #FFFFFF;
        border-radius: 5px;
        border: none;
        background-image: url("/assets/icon-SVG/Group.svg");
        background-repeat: no-repeat;
        background-position: 1.5% 49%;
        background-size: 20px;
        padding-left: 40px;
    }

    #search>input::placeholder {
        font-family: Segoe UI;
        font-style: normal;
        font-weight: normal;
        font-size: 10px;
        line-height: 13px;
        color: rgba(0, 0, 0, 0.3);
    }

    .wed-ven-main-search>div>form>button {
        border: none;
        outline: 0;
        padding: 13px 35px;
        background: #461952;
        box-shadow: 0px 0px 4px 3px rgba(0, 0, 0, 0.25);
        border-radius: 5px;
        font-family: Segoe UI;
        font-style: normal;
        font-weight: normal;
        font-size: 10px;
        line-height: 13px;
        color: #FFFFFF;
    }

    /* Section-1(search) CSS start */
    .wed-venue-main {
        display: flex;
    }

    .wed-venue-main>div:nth-child(2) {
        width: 30%;
    }

    .wed-venue-search {
        padding: 20px 0 45px 25px;
        width: 70%;
        border-bottom: 1px solid #E1CFD6;
        transform: rotate(-0.03deg);
        position: relative;
    }

    .wed-venue-search>div:nth-child(1) {
        font-family: Segoe UI;
        font-style: normal;
        font-weight: normal;
        font-size: 13.6563px;
        line-height: 18px;
        color: #929090;
    }

    .wed-venue-search>div:nth-child(2) {
        font-family: Perpetua;
        font-style: normal;
        font-weight: bold;
        font-size: 25.7763px;
        line-height: 30px;
        color: #461952;
        padding: 10px 0;
    }

    .wed-venue-search .wed-ven-main-search>div {
        margin: 0;
        width: 100%;
    }

    /* Section-1(search) CSS end */


    /* Section-2(sidebar) CSS start */
    .wed-venue-content {
        display: grid;
        grid-template-columns: minmax(200px, 400px) minmax(70%, auto);
    }

    .wed-venue-sidebar {
        height: 100vh;
        background-color: white;
        padding: 23px;
    }

    .wed-venue-sidebar-menu>div:nth-child(1) {
        display: flex;
        justify-content: space-between;
        margin-bottom: 1.75em;

    }

    .wed-venue-sidebar-menu>div:nth-child(1)>span {
        font-family: Sansation;
        font-style: normal;
        font-weight: normal;
        font-size: 18px;
        line-height: 20px;
        color: #313131;
        padding-left: 10px;
    }

    .wed-venue-sidebar-menu>form {
        padding-left: 20px;
        display: none;
        margin-bottom: 1.75em;
    }

    .wed-venue-sidebar-menu>form label {
        font-family: Segoe UI;
        font-style: normal;
        font-weight: normal;
        font-size: 16.4px;
        line-height: 22px;
        padding-left: 15px;
        color: #999999;
    }

    .show-drop>form {
        display: block !important;
    }

    /* Section-2(sidebar) CSS end */


    /* Section-2(venues) CSS start */
    .wed-venue-items-container>div:nth-child(1) {
        font-family: Segoe UI;
        font-style: normal;
        font-weight: normal;
        font-size: 16px;
        line-height: 21px;
        color: #929090;
        padding: 20px 20px 0;
    }

    #sidebar-open {
        font-family: Segoe UI;
        font-style: normal;
        font-weight: normal;
        font-size: 16px;
        line-height: 21px;
        color: #929090;
        padding: 20px 15px 0 0;
        display: none;
    }

    .wed-venue-items {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 200px));
        grid-template-rows: max-content;
        grid-column-gap: 10px;
        grid-row-gap: 20px;
        padding: 20px;
    }

    .wed-venue-items>a {
        text-decoration: none;
        color: inherit;
    }

    .wed-venue-items>a>div {
        position: relative;
    }

    .wed-venue-items>a>div>img {
        width: 100%;
        border-radius: 14.6552px;
    }

    .wed-venue-items-desc {
        background-color: #FFFFFF;
        background: #FFFFFF;
        border: 0.146552px solid #000000;
        border-radius: 14.6552px;
        padding: 10px;
        position: absolute;
        bottom: 0;
        width: 100%;

    }

    .wed-venue-items-desc>div {
        display: flex;
        justify-content: space-between;
        margin: 4px 0;
    }

    .wed-venue-items-desc>div>div:nth-child(1) {
        font-family: Segoe UI;
        font-style: normal;
        font-weight: normal;
        font-size: 14.6552px;
        line-height: 19px;
        color: #000000;
        align-self: center;
    }

    .wed-venue-items-desc>div>div:nth-child(2)>div:nth-child(1) {
        font-family: Inter;
        font-style: normal;
        font-weight: 600;
        font-size: 6.74138px;
        line-height: 8px;
        text-align: center;
        color: #FFFFFF;
        background: #461952;
        padding: 8px 13px;
    }

    .wed-venue-items-desc>div>div:nth-child(2)>div:nth-child(2) {
        background: #7FD926;
        height: inherit;
        padding: 0 8px;
    }

    .wed-venue-items-desc>div:nth-child(2)>p {
        font-family: Segoe UI;
        font-style: normal;
        font-weight: 350;
        font-size: 10.9914px;
        line-height: 15px;
        color: #A79C9C;
        margin: 0;
    }

    .wed-venue-items-price {
        display: flex;
        justify-content: space-between;
        background-color: #FFFFFF;
        border-radius: 14.6552px;
        padding: 10px;
        border: 0.146552px solid #000000;
    }

    .wed-venue-items-price>div:nth-child(1) {
        font-family: Segoe UI;
        font-style: normal;
        font-weight: 350;
        font-size: 10.9914px;
        line-height: 15px;
        color: #A79C9C;
    }

    .wed-venue-items-price>div:nth-child(1) {
        font-family: Segoe UI;
        font-style: normal;
        font-weight: bold;
        font-size: 14.2888px;
        line-height: 19px;
        color: #7F004B;
    }

    /* Section-2(sidebar) CSS end */


    /* wedding Venues Page Css end */
</style> -->
@endsection
@section('content')

<vendor-venue-filtered venues = "{{$venues}}" city = "{{$city}}" type = "{{$type}}" states= "{{$states}}" host= "{{$host}}" stateselected= "{{$state}}" subcat ="{{$subCat}}"></vendor-venue-filtered>

{{-- <section class="wed-venue-main">
    <div class="wed-venue-search">
        <div>
            Vendors / Wedding Venues
        </div>
        <div class="row">
            <div class="col"> Wedding Venues</div>
            <div class="col" style="justify-content:space-around;">
                <div class="text-center"> <a href="{{route('hostvenues.create')}}" class="btn btn-sm bg-danger mx-5" title="add new Venue"><i class="material-icons" title="Add Another Ceramony">add</i></a>
                </div>
            </div>

        </div>
        <div class="wed-ven-main-search">
            <div>
                <form action="" style="display: flex; justify-content: space-between;">
                    <select id="states" name="states">
                        <option hidden disabled selected value></option>
                        <option>Option 1</option>
                        <option>Option 2</option>
                        <option>Option 3</option>
                    </select>

                    <div id="search">
                        <input type="text" placeholder="Wedding venues, wedding photographers, makeup artists, Mehendi artists......">
                    </div>
                    <button type="submit">
                        Search
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div>
        <img src="/assets/venues/Rectangle 149.png" alt="" style="width: 100%;height: 100%;">
    </div>
</section>

<section class="wed-venue-content">
    <div class="wed-venue-sidebar">
        <div class="wed-venue-sidebar-menu">
            <div>
                <span> Locality</span>
                <span> <img src="/assets/icon-SVG/sidebararrow.svg" alt=""></span>
            </div>
            <form action="">
                @foreach($venues as $venue)
                <div>
                    <input type="checkbox" id="name" name="name" value="{{$venue->id}}">
                    <label for="name">{{$venue->address}}</label>
                </div>
                @endforeach
            </form>
        </div>
        <div class="wed-venue-sidebar-menu">
            <div>
                <span> No. of days</span>
                <span> <img src="/assets/icon-SVG/sidebararrow.svg" alt=""></span>
            </div>
            <form action="">
                <div>
                    <input type="radio" id="1_day" name="day" value="1 day">
                    <label for="1_day">1 day</label>
                </div>
                <div>
                    <input type="radio" id="2_day" name="day" value="2 day">
                    <label for="2_day">2 day</label>
                </div>
                <div>
                    <input type="radio" id="3_day" name="day" value="3 day">
                    <label for="3_day">3 day</label>
                </div>
            </form>
        </div>
        <div class="wed-venue-sidebar-menu">
            <div>
                <span> Price per day</span>
                <span> <img src="/assets/icon-SVG/sidebararrow.svg" alt=""></span>
            </div>
            <form action="">
                <div>
                    <input type="radio" id="₹50,000" name="price" value="₹50,000">
                    <label for="₹50,000">&lt₹50,000</label>
                </div>
                <div>
                    <input type="radio" id="₹1,00,000-₹1,50,000" name="price" value="₹1,00,000-₹1,50,000">
                    <label for="₹1,00,000-₹1,50,000">₹1,00,000-₹1,50,000</label>
                </div>
                <div>
                    <input type="radio" id="₹1,50,000-₹2,00,000" name="price" value="₹1,50,000-₹2,00,000">
                    <label for="₹1,50,000-₹2,00,000">₹1,50,000-₹2,00,000</label>
                </div>
                <div>
                    <input type="radio" id="₹2,00,000-₹2,50,000" name="price" value="₹2,00,000-₹2,50,000">
                    <label for="₹2,00,000-₹2,50,000">₹2,00,000-₹2,50,000</label>
                </div>
                <div>
                    <input type="radio" id="₹3,00,000" name="price" value="₹3,00,000">
                    <label for="₹3,00,000">&lt₹3,00,000</label>
                </div>
            </form>
        </div>
        <div class="wed-venue-sidebar-menu">
            <div>
                <span> Services</span>
                <span> <img src="/assets/icon-SVG/sidebararrow.svg" alt=""></span>
            </div>
            <form action="">
                <div>
                    <input type="checkbox" id="option" name="option" value="option">
                    <label for="option">option 1</label>
                </div>
                <div>
                    <input type="checkbox" id="option2" name="option2" value="option2">
                    <label for="option2">option 2</label>
                </div>
                <div>
                    <input type="checkbox" id="option3" name="option3" value="option3">
                    <label for="option3">option 2</label>
                </div>
            </form>
        </div>
        <div class="wed-venue-sidebar-menu">
            <div>
                <span> Rating</span>
                <span> <img src="/assets/icon-SVG/sidebararrow.svg" alt=""></span>
            </div>
            <form action="">
                <div>
                    <input type="checkbox" id="option" name="option" value="option">
                    <label for="option">option 1</label>
                </div>
                <div>
                    <input type="checkbox" id="option2" name="option2" value="option2">
                    <label for="option2">option 2</label>
                </div>
                <div>
                    <input type="checkbox" id="option3" name="option3" value="option3">
                    <label for="option3">option 2</label>
                </div>
            </form>
        </div>
    </div>
    <div class="wed-venue-items-container">
        <div>
            <span id="sidebar-open"><i class="fas fa-bars"></i></span>
            {{$venues->count()}} Results
        </div>
        <div class="wed-venue-items">
            @foreach($venues as $venue)
            <a href="{{route('hostvenues.show', $venue)}}">
                <div>
                    <img src="/assets/venues/venueDefault.png" alt="" width="100px" height="auto">
                    <div class="wed-venue-items-desc">
                        <div>
                            <div>
                                {{$venue->name}}
                            </div>
                            <div class="d-flex">
                                <div>4.5</div>
                                <div><img src="/assets/icon-SVG/Star.svg" alt="" style="margin-top: -5px;"></div>
                            </div>
                        </div>
                        <div>

                            <p> {{$venue->address}} </p>
                            <p>30 reviews</p>
                        </div>
                    </div>
                </div>
                <div class="wed-venue-items-price">
                    <div>
                        {{$venue->description}}
                    </div>
                    <div>
                        ₹60,000
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        <div class="d-flex justify-content-center">
            <span style="font-size: 1.5em; color:blue;">{!! $venues->links() !!}</span>
        </div>
    </div>
</section> --}}


@endsection

@section('wed-host-script')

<!-- <script>
    var sideMenu = document.querySelectorAll(".wed-venue-sidebar-menu > div:nth-child(1)");
    sideMenu.forEach(function(item) {
        item.addEventListener('click', function() {
            if (item.parentNode.classList.contains('show-drop')) {
                item.parentNode.classList.remove('show-drop');
            } else {
                sideMenu.forEach(function(active) {
                    active.parentNode.classList.remove('show-drop');
                });
                item.parentNode.classList.add('show-drop');
            }
        });
    });
</script>

<script>
    var sideOpen = document.getElementById("sidebar-open");
    var sideBar = document.querySelector(".wed-venue-sidebar");
    var layout = document.querySelector(".wed-venue-content");
    var items = document.querySelector(".wed-venue-items-container");


    console.log(sideBar);
    sideOpen.addEventListener('click', function() {
        var screenWidth = window.innerWidth;
        var hide = screenWidth - 200;
        if (sideBar.style.display === "block") {
            sideBar.style.display = null;
            layout.style.display = null;
            items.style.width = null;
            items.style.overflow = null;
        } else {
            sideBar.style.display = "block";
            layout.style.display = "grid";
            items.style.width = hide + "px";
            items.style.overflow = "hidden";

        }

    });

    window.addEventListener('resize', function() {
        sideBar.style.display = null;
        layout.style.display = null;
        items.style.width = null;
        items.style.overflow = null;
    });
</script> -->
@endsection
