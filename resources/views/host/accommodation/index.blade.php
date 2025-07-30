@extends('layouts.host')

@section('styles')
<style>
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
        grid-template-columns: repeat(3, 1fr);
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



    /*

    Selected Hotel Summary Section css Starts

    */


    .wed-accom2-cont {
        display: flex;
        flex-direction: row;
        max-width: 1280px;
        margin: 0 auto;
        margin-top: 3em;
        background-color: #ffffff;
        height: 90%;
        border: 1.59px solid #e3e8ee;
    }

    .wed-accom2-cont>div {
        width: 15%;
        display: flex;
        display: table;
        table-layout: fixed;
        flex-direction: column;
        position: relative;
        border: 1.59px solid #e3e8ee;
    }

    .wed-accom2-cont>div:last-child {
        width: 25%;
    }

    .wed-accom2-cont>div>h4 {
        font-family: Segoe UI;
        font-style: normal;
        font-weight: bold;
        font-size: 15px;
        line-height: 20px;
        color: #461952;
        border-bottom: 1.59px solid #e3e8ee;
        padding: 5px 10px;
        text-align: center;
        margin: 0;
        height: 98px;
    }

    .wed-accom2-cont>div>div {
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .wed-accom2-cont>div>div:last-child {
        height: max-content;
        padding: 10px;
        position: absolute;
        bottom: 0;
        right: 0;
    }

    .wed-accom2-cont>div>div {
        font-family: Segoe UI;
        font-style: normal;
        font-weight: normal;
        font-size: 15px;
        line-height: 20px;
        color: #461952;
        margin-bottom: 0 !important;
        padding-bottom: 5em;
    }

    .wed-accom2-cont>div>div>label {
        display: flex;
        justify-content: space-between;
        padding: 8px 0;
        padding-left: 1em;
        border-bottom: 1.59px solid #e3e8ee;
        margin-bottom: 0;
    }

    .wed-accom2-cont>div>div>label>i {
        align-self: center;
        padding-right: 7px;
    }

    .wed-accom2-cont>div>div>label>div {
        width: 80%;
        overflow-x: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        display: inline-block;
    }

    .wed-accom2-cont>div>div>label>input {
        display: none;
    }

    .wed-host-add-accomo {
        background: #b1415e;
        box-shadow: 0px 0px 0.599253px 0.599253px rgba(0, 0, 0, 0.25);
        border-radius: 40.7895px;
        border: none;
        outline: 0;
        width: 28px;
        height: 28px;
        margin-left: auto;
    }

    .wed-host-save-accomo {
        background: #b1415e;
        box-shadow: 0px 0px 0.599253px 0.599253px rgba(0, 0, 0, 0.25);
        border-radius: 40.7895px;
        border: none;
        outline: 0;
        margin-left: auto;
        font-family: Perpetua;
        font-style: normal;
        font-weight: bold;
        font-size: 14.6199px;
        line-height: 17px;
        color: #ffffff;
        padding: 5px 1em;
    }


    /*

    Selected Hotel Summary Section css end

    */


    /*

    Select Hotel css start

    */

    .wed-host-accommodation-cont {
        width: 500px;
        margin-top: 5em;
        margin-left: 2em;
    }

    .wed-host-accommodation-cont input::placeholder {
        font-family: Segoe UI;
        font-style: normal;
        font-weight: normal;
        font-size: 13.1629px;
        line-height: 18px;
        color: #757575;
    }

    .wed-host-accom-hotel>p:nth-child(1) {
        font-family: Segoe UI;
        font-style: normal;
        font-weight: normal;
        font-size: 15.4473px;
        line-height: 21px;
        color: #000000;
        margin-left: 12px;
        margin-bottom: 8px;
    }

    .wed-host-accom-hotel>form:nth-child(2) {
        display: flex;
        justify-content: space-between;
    }

    .single-select-cont {
        margin-bottom: 1em;
    }

    .single-select-cont>select {
        width: 100%;
        display: none;
    }

    .wed-host-accom-hotel-select {
        background: #ffffff;
        border-radius: 11.9146px;
        font-family: Segoe UI;
        font-style: normal;
        font-weight: normal;
        font-size: 13.1629px;
        line-height: 18px;
        padding: 12px 20px 14px 18px;
        padding-right: 20px;
        color: #757575;
        position: relative;
        cursor: pointer;
        background-color: #c4456f1a !important;
    }

    .wed-host-accom-hotel-select:hover {
        background-color: pink !important;
    }

    .wed-host-accom-hotel-select>span {
        width: 90%;
        display: block;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .wed-host-accom-hotel-select>img {
        position: absolute;
        right: 0;
        top: 0;
        padding: 20px;
    }

    .wed-host-accom-hotel-options {
        background: #eacfcf;
        border-radius: 8px;
        font-family: Montserrat;
        font-style: normal;
        font-weight: normal;
        font-size: 13.16px;
        line-height: 16px;
        color: #333333;
        margin-top: 10px;
        padding: 1em;
        display: none;
    }

    .custom-select-options {
        max-height: 200px;
        overflow-y: auto;
    }

    .custom-select-options>div:hover {

        background-color: pink;
    }

    .show {
        display: block;
    }

    .wed-host-accom-hotel-options>div {
        padding: 10px;
        cursor: pointer;
    }

    .wed-host-accom-actions {
        width: 30%;
        display: flex;
        justify-content: space-around;
    }

    .wed-host-accom-actions>button {
        background: #9b3154;
        box-shadow: 0px 0px 0.794304px 0.1px rgba(0, 0, 0, 0.25);
        border-radius: 54.0661px;
        width: 41.09px;
        height: 41.09px;
        border: none;
        outline: none;
        padding-bottom: 6px;
    }

    /* hotel part css end */

    .wed-host-accom-floor-head {
        font-family: Segoe UI;
        font-style: normal;
        font-weight: normal;
        font-size: 15.4473px;
        line-height: 21px;
        color: #000000;
        margin-left: 12px;
        margin-bottom: 8px;
        display: flex;
        justify-content: space-between;
        padding: 0 19px 0 0;
    }

    .wed-host-accom-floor-head>span {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        display: block;
        width: 100%;
        padding-left: 10px;
    }

    .wed-host-accom-input-text {
        display: flex;
        justify-content: space-between;
    }

    .wed-host-accom-input-text>div:nth-child(1) {
        width: 65%;
    }

    .wed-host-accom-input-text>div:nth-child(1)>input,
    .wed-host-accom-input-text>div:nth-child(1)>div>input {
        background: #ffffff;
        border-radius: 11.9146px;
        font-family: Segoe UI;
        font-style: normal;
        font-weight: normal;
        border: none;
        outline: 0;
        font-size: 13.1629px;
        line-height: 18px;
        color: #000000;
        width: 100%;
        padding: 12px 20px 14px 18px;
        margin-bottom: 1em;
    }

    .wed-host-accom-room-mem {
        display: flex;
        justify-content: space-between;
    }

    /*

    Select Hotel css start

    */
    .send-invi-first-cont{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    .send-invi-first-cont > h2{
        color: #000;
        text-align: center;
        font-family: Perpetua;
        font-size: 30px;
        font-style: normal;
        font-weight: 700;
        line-height: normal;
        margin-bottom: 12px;
    }
    .send-invi-first-cont > p{
        color: #000;
        text-align: center;
        font-family: Poppins;
        font-size: 16px;
        font-style: normal;
        font-weight: 400;
        line-height: normal;
    }
    .send-invi-first-cont > a{
        text-decoration: none;
        border-radius: 7.72px;
        background: #461952;
        padding: 11px 30px;
        color: #FFF;
        text-align: center;
        font-family: Poppins;
        font-size: 13px;
        font-style: normal;
        font-weight: 600;
        line-height: normal;
    }
</style>

@endsection

@section('content')
<section class="wed-host-section">
    <div class="wed-host-section-container">
        <article class="wed-logistics-title">
            @if($guestlists->isNotEmpty())
            <div class="row">
                <div class="offset-md-1 col-12 col-md-7 d-flex justify-content-center justify-content-md-end">
                    <span id="wed-log-title">{{$invitation->brideName}} & {{ $invitation->groomName}}</span>
                </div>
            </div>

            <article class="about">
                <!-- btn container -->
                {{--<div class="btn-container">
                    <button class="tab-btn active" data-id="selec-hotels">Select Hotels</button>
                    <button class="tab-btn " data-id="selected-summary">Accommodation Booked</button>
                    <button class="tab-btn" data-id="allocate-hotels">Allocate Accommodation</button>
                </div>--}}

                <div class="about-content">

                    {{--<div class="content active" id="selec-hotels">
                        <section class="wed-host-accommodation-cont">
                            <div class="wed-host-accom-hotel">
                                <p>Hotel (Venue list)</p>
                                <form method="POST" action="{{route('hoststoreAccomm',$host)}}">
                                    @csrf
                                    <div class="multipleSelect" style="width: 65%">
                                        <div class="single-select-cont">
                                            <select name="hotels[]" id="">
                                                @foreach($venues as $key => $val)
                                                <option value="{{$val}}">
                                                    {{$val}}
                                                </option>
                                                @endforeach
                                            </select>
                                            <div>
                                                <div class="custom-select-head wed-host-accom-hotel-select">
                                                    <span>Add Hotel ( Venue list )</span>
                                                    <img src="/assets/accommodation/Chevron.svg" alt="" />
                                                </div>
                                                <div class="custom-select-options wed-host-accom-hotel-options"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="wed-host-accom-actions unique">
                                        <button type="button" class="Add">
                                            <img src="/assets/accommodation/fluent_add-20-filled.svg" alt="" />
                                        </button>
                                        <button class="Save" type="submit">
                                            <img src="/assets/accommodation/ant-design_save-outlined.svg" alt="" />
                                        </button>
                                        <button type="button" class="Edit">
                                            <img src="/assets/accommodation/iconoir_edit.svg" alt="" />
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <div class="wed-host-accom-block">
                                <form action="{{route('hoststoreBlock',$host)}}" method="POST">
                                    @csrf
                                    <div class="multipleSelect" style="width: 65%">
                                        <div class="single-select-cont">
                                            <select class="form-select" name="selectedHotels" class="m-2">
                                                @foreach($accom as $acc)
                                                <option value="{{$acc->id}}">
                                                    {{$acc->name}}
                                                </option>
                                                @endforeach
                                            </select>
                                            <div>
                                                <div class="custom-select-head unique wed-host-accom-floor-head">
                                                    Block
                                                    <span></span>
                                                    <img src="/assets/accommodation/Chevron.svg" alt="" />
                                                </div>
                                                <div class="custom-select-options wed-host-accom-hotel-options" id="hotelSelect"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="wed-host-accom-input-text">
                                        <div>
                                            <input type="text" value="" name="block[]" placeholder="Add Block"></input>
                                        </div>
                                        <div class="wed-host-accom-actions">
                                            <button type="button" class="Add">
                                                <img src="/assets/accommodation/fluent_add-20-filled.svg" alt="" />
                                            </button>
                                            <button class="Save" type="submit">
                                                <img src="/assets/accommodation/ant-design_save-outlined.svg" alt="" />
                                            </button>
                                            <button type="button" class="Edit">
                                                <img src="/assets/accommodation/iconoir_edit.svg" alt="" />
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="wed-host-accom-block">
                                <form action="{{route('hoststoreFloor',$host)}}" method="POST">
                                    @csrf
                                    <div class="multipleSelect" style="width: 65%">
                                        <div class="single-select-cont">
                                            <select class="form-select" name="Block">
                                                @isset($accom[0])
                                                @foreach($accom[0]->blocksAll as $block)
                                                <option value="{{$block->id}}">
                                                    {{$block->name}}
                                                </option>
                                                @endforeach
                                                @endisset
                                            </select>
                                            <div>
                                                <div class="custom-select-head unique wed-host-accom-floor-head">
                                                    Floor<span></span>
                                                    <img src="/assets/accommodation/Chevron.svg" alt="" />
                                                </div>
                                                <div class="custom-select-options wed-host-accom-hotel-options" id="selectBlock"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="wed-host-accom-input-text">
                                        <div>
                                            <input type="text" value="" name="block[]" placeholder="Add Floor"></input>
                                        </div>
                                        <div class="wed-host-accom-actions">
                                            <button type="button" class="Add">
                                                <img src="/assets/accommodation/fluent_add-20-filled.svg" alt="" />
                                            </button>
                                            <button class="Save" type="submit">
                                                <img src="/assets/accommodation/ant-design_save-outlined.svg" alt="" />
                                            </button>
                                            <button type="button" class="Edit">
                                                <img src="/assets/accommodation/iconoir_edit.svg" alt="" />
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="wed-host-accom-block">
                                <form action="{{route('hoststoreRoom',$host)}}" method="POST">
                                    @csrf

                                    <div class="multipleSelect" style="width: 65%">
                                        <div class="single-select-cont">
                                            <select class="form-select" name="Floor" id="floor">
                                                @isset($accom[0]->floors)
                                                @foreach($accom[0]->floors as $floor)
                                                <option value="{{$floor->id}}">
                                                    {{$floor->name}}
                                                </option>
                                                @endforeach
                                                @endisset
                                            </select>
                                            <div>
                                                <div class="custom-select-head unique wed-host-accom-floor-head">
                                                    Room & Members
                                                    <span></span>
                                                    <img src="/assets/accommodation/Chevron.svg" alt="" />
                                                </div>
                                                <div class="custom-select-options wed-host-accom-hotel-options" id="selectFloor"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="wed-host-accom-input-text">
                                        <div>
                                            <div class="wed-host-accom-room-mem">
                                                <input type="text" value="" name="room[]" style="width: 66%;" placeholder="Add Room number"></input>
                                                <input type="text" value="" name="members[]" style="width: 29%;" placeholder="Members"></input>
                                            </div>
                                        </div>
                                        <div class="wed-host-accom-actions">
                                            <button type="button" class="Add">
                                                <img src="/assets/accommodation/fluent_add-20-filled.svg" alt="" />
                                            </button>
                                            <button class="Save" type="submit">
                                                <img src="/assets/accommodation/ant-design_save-outlined.svg" alt="" />
                                            </button>
                                            <button type="button" class="Edit">
                                                <img src="/assets/accommodation/iconoir_edit.svg" alt="" />
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </section>
                    </div>

                    <div class="content" id="selected-summary">
                        <form class="wed-accom2-cont">
                            <div>
                                <h4>
                                    Hotel name
                                    <span style="font-weight: normal; font-size: 12px">(Venue list)</span>
                                </h4>
                                <div class="hotels">
                                    @foreach($accom as $acc)
                                    <label for="hotel{{$acc->id}}">
                                        <div>{{$acc->name}}</div>
                                        <i class="fas fa-ellipsis-v"></i>
                                        <input type="radio" name="hotel_name" id="hotel{{$acc->id}}" value="{{$acc->name}}" />
                                    </label>
                                    @endforeach
                                </div>
                                <div>
                                    <button class="wed-host-add-accomo">
                                        <img src="/assets/accommodation/Group (1).svg" alt="" />
                                    </button>
                                </div>
                            </div>
                            <div>
                                <h4>Block</h4>
                                <div id="blocks">
                                    <!-- @isset($accom[0])
                                    @foreach($accom[0]->blocksAll as $block)
                                    <label for="block1">
                                        <span>{{$block->name}}</span>
                                        <i class="fas fa-ellipsis-v"></i>
                                        <input type="radio" name="block_name" id="block{{$block->id}}" value=" {{$block->name}}" />
                                    </label>
                                    @endforeach
                                    @endisset -->
                                </div>
                                <div style="height: max-content; padding: 10px">
                                    <button class="wed-host-add-accomo">
                                        <img src="/assets/accommodation/Group (1).svg" alt="" />
                                    </button>
                                </div>
                            </div>
                            <div>
                                <h4>Floor</h4>
                                <div id="floors">
                                    <!-- @isset($accom[0]->floors)
                                    @foreach($accom[0]->floors as $floor)
                                    <label for="floor">
                                        <span>{{$floor->name}}</span>
                                        <i class="fas fa-ellipsis-v"></i>
                                        <input type="radio" name="floor_name" id="floor" value="{{$floor->id}}" />
                                    </label>
                                    @endforeach
                                    @endisset -->
                                </div>
                                <div style="height: max-content; padding: 10px">
                                    <button class="wed-host-add-accomo">
                                        <img src="/assets/accommodation/Group (1).svg" alt="" />
                                    </button>
                                </div>
                            </div>
                            <div>
                                <h4>Room number</h4>
                                <div id="rooms">
                                    <!-- <label for="room1">
                                        <span>201</span>
                                        <i class="fas fa-ellipsis-v"></i>
                                        <input type="radio" name="room_num" id="room1" value="201" />
                                    </label> -->
                                </div>
                                <div style="height: max-content; padding: 10px">
                                    <button class="wed-host-add-accomo">
                                        <img src="/assets/accommodation/Group (1).svg" alt="" />
                                    </button>
                                </div>
                            </div>
                            <div>
                                <h4>Members</h4>
                                <div id="members">
                                    <!-- <label for="mem">
                                        <span>5</span>
                                        <i class="fas fa-ellipsis-v"></i>
                                        <input type="radio" name="mem" id="mem" value="5" />
                                    </label> -->
                                </div>
                                <div style="height: max-content; padding: 10px">
                                    <button class="wed-host-add-accomo">
                                        <img src="/assets/accommodation/Group (1).svg" alt="" />
                                    </button>
                                </div>
                            </div>
                            <div>
                                <h4>Details</h4>
                                <div></div>
                                <div style="height: max-content; padding: 10px">
                                    <button class="wed-host-save-accomo">Create</button>
                                </div>
                            </div>
                        </form>
                    </div>--}}

                    <div class="content active" id="allocate-hotels">
                        <section class="wed-logistics-accordion">
                            <div class="row justify-content-end">
                                {{--<div class="col-12 col-md-3 ml-auto justify-content-center wed-log-buttons flex-column position-relative">
                                    <div class="d-flex">
                                        <a href="{{route('hostaccommodation.create')}}" class="wed-btn-main mx-5 px-3" id="select-multiple" style="text-decoration: none">Add Hotels</a>
                                        <button class="wed-btn-main mr-3" id="select-multiple">Select multiple</button>
                                        <button class="wed-btn-main mr-3 px-2" onclick="display_sort()">
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
                                </div>--}}
                            </div>
                            @foreach($guestlists as $guest)

                            <div class="wed-log-accord-item" style="padding: 1em 0 1em 0">
                                <div class="row wed-log-accord">
                                    <div class="col-12 col-md-4 d-flex justify-content-md-between justify-content-between pl-0">
                                        <div class="d-flex">
                                            <!-- <img src="/assets/log-add.png" alt="" style="margin-left:10px"> -->
                                            <div class="wed-log-accord-text ml-3" style="width:100%">
                                                {{$guest->name}}
                                            </div>
                                        </div>
                                        <div class="wed-log-accord-number">
                                            {{$guest->mobile}}
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-4 d-flex justify-content-md-around justify-content-around">
                                        <div class="wed-log-accord-text">
                                            {{isset($guest->arrival) ? ucwords($guest->arrival->location) : ''}}
                                        </div>
                                        <div class="wed-log-accord-text">
                                            {{isset($guest->arrival) ? ucwords($guest->arrival->travelMode) : '' }}
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-4 d-flex justify-content-md-around justify-content-between">
                                        <div class="wed-log-accord-text">
                                            @foreach($guest->arrivals()->where('user_id', $guest->id)->get() as $arr)
                                            @if($arr->guest_id == $guest->id)
                                            {{Carbon\Carbon::parse($arr->date)->format('d F, Y H:i:s')}}
                                            @endif
                                            @endforeach
                                        </div>
                                        <div class="wed-log-accord-text">
                                            @foreach($guest->arrivals()->where('user_id', $guest->id)->get() as $arr)
                                            @if($arr->guest_id == $guest->id)
                                            {{count($arr->memberCount)}}
                                            @endif
                                            @endforeach
                                        </div>
                                        <div class="wed-log-accord-text">
                                            <div class="wed-log-accord-online"></div>
                                            <div class="wed-log-accord-text">Active</div>
                                            <img src="/assets/logistics/arrow_down.svg" alt="">
                                        </div>
                                    </div>
                                </div>

                                <form class="row wed-accomo-accord-form" action="{{route('hostaccommodation.store',$host)}}" method="POST">
                                    @csrf
                                    <table>
                                        <tr>
                                            <th>Name</th>
                                            <th>Phone number</th>
                                            <th>Hotel</th>
                                            <th>Block</th>
                                            <th>Floor</th>
                                            <th>Room number</th>
                                        </tr>
                                        @if($guest->pivot->accommodationStatus == 4)
                                        <tr>
                                            <input hidden name="guest_id" type="text" value="{{$guest->id}}">
                                            <input hidden name="invitation_id" type="text" value="{{$invitation->id}}">

                                            <td>{{$guest->name}}</td>
                                            <td>{{$guest->mobile}}</td>

                                            <td><input name="mhotelName" type="text" placeholder="hotelName" value="{{$guest->accommodations->where('guest_id', $guest->id)->first()->hotelName ?? ''}}"></td>
                                            <td><input name="mblock" type="text" placeholder="hotelBlock" value="{{$guest->accommodations->where('guest_id', $guest->id)->first()->block ?? ''}}"></td>
                                            <td><input name="mfloor" type="text" placeholder="floor no." value="{{$guest->accommodations->where('guest_id', $guest->id)->first()->floor ?? ''}}"></td>
                                            <td><input name="mroomno" type="text" placeholder="Room no." value="{{$guest->accommodations->where('guest_id', $guest->id)->first()->roomno ?? ''}}"></td>
                                        </tr>
                                        @endif
                                        @foreach($guest->family as $member)
                                        @if($member->privileges->first() !=  null)
                                        <tr>
                                            <input hidden name="family_id[]" type="text" value="{{$member->id}}">
                                            <td>{{$member->familyname}}</td>
                                            <td>{{$member->familymobile}}</td>
                                            <td><input name="hotelName[]" type="text" placeholder="hotelName" value="{{$member->privileges->first()->hotelName ?? ''}}"></td>
                                            <td><input name="block[]" type="text" placeholder="hotelBlock" value="{{$member->privileges->first()->block ?? ''}}"></td>
                                            <td><input name="floor[]" type="text" placeholder="floor no." value="{{$member->privileges->first()->floor ?? ''}}"></td>
                                            <td><input name="roomno[]" type="text" placeholder="Room no." value="{{$member->privileges->first()->roomno ?? ''}}"></td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    </table>
                                    <div class="row">
                                        <button class="btn btn-sm wed-btn-main col-sm-1 mx-auto"><i class="material-icons">save</i></button>
                                    </div>
                                </form>

                            </div>

                            @endforeach
                        </section>
                    </div>

                </div>
            </article>
            @else
            <div class="send-invi-first-cont">
                <img src="/assets/accommodation/send-invi-first.png" alt="">
                <h2>Send Invitation</h2>
                <p>Send your invitation to guests and let guests accept the invitation before adding accomodation details</p>
                <a href="{{route('invitedguests.custom', $invitation ?? '')}}">Guest Lists</a>
            </div>
            @endif
    </div>
</section>

@endsection


@section('wed-host-script')

<script>
    // var accordian = [...document.querySelectorAll(".wed-log-accord")];
    var accordian = $(".wed-log-accord");
    accordian.each(function(index, item) {
        item.addEventListener('click', function() {
            console.log(item);
            var drop = item.nextElementSibling;
            if (drop.style.maxHeight) {
                drop.style.maxHeight = null;
                item.style.paddingBottom = "5px";
            } else {
                accordian.each(function(index,  element) {
                    if (element !== item) {
                        element.nextElementSibling.style.maxHeight = null;
                        element.style.paddingBottom = "5px";
                    } else {
                        drop.style.maxHeight = drop.scrollHeight + "px";
                        if (item.style.paddingBottom) {
                            item.style.paddingBottom = null;
                        }
                    }
                });
            }
        });
    });
</script>

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
</script>

<script>

        $(".wed-accom2-cont").on("click", `input`, function(e) {
        Array.from(
            e.currentTarget.parentElement.parentElement.children
        ).forEach(function(item) {
            item.style.backgroundColor = "#FFFFFF";
            item.style.color = "black";
            //console.log(item);
            //item.checked = false;
        });

        if (e.currentTarget.checked == true) {
            e.currentTarget.parentElement.style.backgroundColor = "#B1415E";
            e.currentTarget.parentElement.style.color = "#FFFFFF";
        }
    });
    // $(document).ready(function(){
    //     $(".wed-accom2-cont > div").each(function(ind, ele){
    //        $(ele).find('input').first().prop("checked", true);
    //        if($(ele).find('input').first().prop('checked') == true){
    //            $(ele).find('label').first().css('background-color', '#B1415E');
    //             $(ele).find('label').first().css('color', '#FFFFFF');
    //        }
    //     });
    // });


    // Axios Calls for blocks when a specific hotel in clicked
    $(".hotels").on("click", 'input', function (e) {
        var accomid=$(this).attr('id');
        accomid=accomid.slice(5);
        //console.log(accomid);
        if(accomid){
        axios.get('/host/getBlock/'+accomid)
            .then((response)=>{
            console.log(response.data);
            $('#blocks').empty();
            $('#floors').empty();
                    $.each(response.data, function(key,value){
                    $('#blocks').append(
                    '<label for="block'+ value.id+'">\
                    <span>'+value.name+'</span>\
                    <i class="fas fa-ellipsis-v"></i>\
                    <input type="radio"  name="block_name"   id="block' + value.id + '" value="' + value.name + '" />\
                    </label>');
                    });

                })
                .catch(response => {
                    console.log('error');
                });
            // $.ajax({
            //         url: '/getBlock/'+accomid,
            //         type: "GET",
            //         dataType: "json",
            //         success:function(data) {
            //           $('#blocks').empty();
            //           $.each(data, function(key,value){
            //             $('#blocks').append(
            //             '<label for="block'+ value.id+'">\
            //             <span>'+value.name+'</span>\
            //             <i class="fas fa-ellipsis-v"></i>\
            //             <input type="radio"  name="block_name"   id="block'+value.id+'" value="'+value.name+'" />\
            //             </label>');
            //           });

            //         }
            //     });
        } else {
            $('#blocks').empty();
        }
    });

    // Axios Calls for floors when a specific blocks in clicked
    $("#blocks").on("click", 'input', function(e) {
        var accomid = $(this).attr('id');
        accomid = accomid.slice(5);
        //console.log(accomid);
        if (accomid) {
            axios.get('/host/getFloor/' + accomid)
                .then((response) => {
                    //console.log(response.data)
                    $('#floors').empty();
                    $.each(response.data, function(key, value) {
                        $('#floors').append(
                            '<label for="floor' + value.id + '">\
                        <span>' + value.name + '</span>\
                        <i class="fas fa-ellipsis-v"></i>\
                        <input type="radio"  name="floor_name"   id="floor' + value.id + '" value="' + value.name + '" />\
                        </label>');
                      });            
                })
                .catch(response => {
                    console.log('error');
                });
            // $.ajax({
            //         url: '/getFloor/'+accomid,
            //         type: "GET",
            //         dataType: "json",
            //         success:function(data) {
            //           $('#floors').empty();
            //           $.each(data, function(key,value){
            //             $('#floors').append(
            //             '<label for="floor'+ value.id+'">\
            //             <span>'+value.name+'</span>\
            //             <i class="fas fa-ellipsis-v"></i>\
            //             <input type="radio"  name="floor_name"   id="floor'+value.id+'" value="'+value.name+'" />\
            //             </label>');
            //           });

            //         }
            //     });
        } else {
            $('#floors').empty();
        }
    });

    // Axios Calls for rooms and members when a specific floor in clicked
    $("#floors").on("click", 'input', function (e) {
          var accomid=$(this).attr('id');
           accomid=accomid.slice(5);
           //console.log(accomid);
          if(accomid){
            axios.get('/host/getRoom/'+accomid)
                .then((response)=>{
                  //console.log(response.data)
                      $('#rooms').empty();
                      $('#members').empty();
                      $.each(response.data, function(key,value){
                        $('#rooms').append(
                            '<label for="room' + value.id + '">\
                        <span>' + value.room + '</span>\
                        <i class="fas fa-ellipsis-v"></i>\
                        <input type="radio"  name="room_name"   id="room' + value.id + '" value="' + value.room + '" />\
                        </label>');
                        $('#members').append(
                            '<label for="member' + value.id + '">\
                        <span>' + value.members + '</span>\
                        <i class="fas fa-ellipsis-v"></i>\
                        <input type="radio"  name="member"   id="member' + value.id + '" value="' + value.members + '" />\
                        </label>');
                    });

                })
                .catch(response => {
                    console.log('error');
                });

            // $.ajax({
            //         url: '/getRoom/'+accomid,
            //         type: "GET",
            //         dataType: "json",
            //         success:function(data) {
            //           $('#rooms').empty();
            //           $('#members').empty();
            //           $.each(data, function(key,value){
            //             $('#rooms').append(
            //             '<label for="room'+ value.id+'">\
            //             <span>'+value.room+'</span>\
            //             <i class="fas fa-ellipsis-v"></i>\
            //             <input type="radio"  name="room_name"   id="room'+value.id+'" value="'+value.room+'" />\
            //             </label>');
            //             $('#members').append(
            //             '<label for="member'+ value.id+'">\
            //             <span>'+value.members+'</span>\
            //             <i class="fas fa-ellipsis-v"></i>\
            //             <input type="radio"  name="member"   id="member'+value.id+'" value="'+value.members+'" />\
            //             </label>');
            //           });

            //         }
            //     });
        } else {
            $('#rooms').empty();
            $('#members').empty();
        }
    });
</script>

<!-- Select hotels script  -->
<script>
    var multipleSelect = $(".multipleSelect");
    var i = 0;

    // clone select container if user wants to add multiple venues
    $(".Add").click(function(e) {
        var targ = e.currentTarget.parentElement;
        var current = e.currentTarget.parentElement.previousElementSibling.firstElementChild;
        if (targ.classList.contains("unique")) {
            var test = $(current).clone();
            test.children().first().children().attr(
                "selected",
                false
            );
            test
                .children()
                .eq(1)
                .children()
                .first()
                .children()
                .eq(0)
                .text(`Add Hotel ( Venue list )`);
            test.appendTo(targ.previousElementSibling);
        } else if (current.classList.contains("wed-host-accom-room-mem")) {
            var test = $(current).clone();
            $(test).appendTo(targ.previousElementSibling.parentElement.firstElementChild);
        } else {
            var test = $(current).clone();
            let name = targ.previousElementSibling.lastElementChild.getAttribute('name');
            // let attr = `${name.slice(0,-2)} ${Number(name.slice(-1))+1}`;
            // var input = `<input type="text" value="" name="${attr}" placeholder="Add ${name.slice(0,-2)}"></input>`;
            // $(input).appendTo(targ.previousElementSibling.parentElement.firstElementChild);
            let attr = "block";
            i += 1;
            var input = '<input type="text" value="" name="block[]" placeholder="Add ' + name.slice(0, -2) + '"/>';
            $(input).appendTo(targ.previousElementSibling.parentElement.firstElementChild);
        }
    });

    // Toggle dropdown
    $(".multipleSelect").on("click", ".custom-select-head", function(e) {
        e.stopPropagation();
        if (e.currentTarget.nextElementSibling.classList.contains('show')) {
            $('.custom-select-head').each(function(ind, ele) {
                ele.nextElementSibling.classList.remove('show');
            });
        } else {
            $('.custom-select-head').each(function(ind, ele) {
                ele.nextElementSibling.classList.remove('show');
            });
            e.currentTarget.nextElementSibling.classList.add("show")
        }
    });

    // closes dropdown if clicked outside it
    $(document).click(function() {
        $(".custom-select-options").removeClass("show");
    });

    // dynamically creates custom dropdown and selct box from available slect options in HTML document.
    $(document).ready(function(e) {
        var customOptions = $(".custom-select-options");
        customOptions.each(function(index, ele) {
            let linkedOptions = $(ele).parent().prev().children();
            linkedOptions.each(function(i, item) {
                $(`<div class="custom-options"> ${item.textContent} </div>`).appendTo(ele);
            });
        });
    });


    // Links custom dropdown with default select and slects the options that is clicked on custom dropdown
    $(".multipleSelect").on("click", ".custom-select-options", function(e) {
        e.stopPropagation();
        if (!e.target.classList.contains("custom-select-options")) {
            $(e.currentTarget.parentElement.previousElementSibling.children).attr(
                "selected",
                false
            );


            let clicked = Array.from(e.currentTarget.children).indexOf(e.target);
            let selected = Array.from(
                e.currentTarget.parentElement.previousElementSibling.children
            )[clicked].setAttribute("selected", true);

            if (
                e.currentTarget.previousElementSibling.classList.contains("unique")
            ) {
                let brackets = Array.from(e.currentTarget.parentElement.previousElementSibling.children)[
                    clicked
                ].textContent;
                e.currentTarget.previousElementSibling.children[0].textContent = `(${brackets})`;
            } else {
                e.currentTarget.previousElementSibling.children[0].textContent =
                    Array.from(
                        e.currentTarget.parentElement.previousElementSibling.children
                    )[clicked].textContent;
            }
        }
        e.currentTarget.classList.remove("show");
        // e.currentTarget.nextElementSibling.classList.toggle("show");
    });

    // Selects First option by default in custom drop down
    $(document).ready(function() {
        let customSelected = $('.custom-select-head');
        //console.log(customSelected);
        customSelected.each(function(index, ele) {
            let select = ele.parentElement.previousElementSibling.firstElementChild.textContent;
            $(ele).find('span').text(`(${select})`);
        });
    });

    //Axios Calls
    $('#hotelSelect').on('click', '.custom-options', function(e) {
        let clicked = Array.from(e.currentTarget.parentElement.children).indexOf(e.currentTarget);
        var id = $(e.currentTarget).parent().parent().prev().children().eq(clicked).val();

        axios.get('/host/getBlock/' + id)
            .then((response) => {
                $('select[name="Block"]').empty();
                $.each(response.data, function(key, value) {
                    $('select[name="Block"]').append('<option value="' + value.id + '">' + value.name + '</option>');
                });
                var customOptions = $('#selectBlock');
                customOptions.empty();
                customOptions.prev().find('span').empty();
                let customselect = customOptions.parent().prev().children().first().text();
                customOptions.prev().find('span').text(`(${customselect})`);
                let linkedOptions = customOptions.parent().prev().children();
                linkedOptions.each(function(i, item) {
                    $(`<div class="custom-options"> ${item.textContent} </div>`).appendTo(customOptions);
                });
                let clicked_2 = $('select[name="Block"]').children().first().val();
                console.log(clicked_2);
                getroommsAxios(clicked_2);
            })
            .catch(response => {
                console.log('error');
            });

    });

    $(document).ready(function() {

        $('#selectBlock').on('click', '.custom-options', function(e) { //select[name="selectedHotels"]
            let clicked = Array.from(e.currentTarget.parentElement.children).indexOf(e.currentTarget);
            var id = $(e.currentTarget).parent().parent().prev().children().eq(clicked).val();
            getroommsAxios(id);
        });
    });

    function getroommsAxios(id) {
        if (id) {
            axios.get('/host/getFloor/' + id)
                .then((response) => {
                    //console.log(response.data);

                    $('#floor').empty();
                    $.each(response.data, function(key, value) {
                        $('#floor').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                    var customOptions = $('#selectFloor');
                    customOptions.empty();
                    customOptions.prev().find('span').empty();
                    let customselect = customOptions.parent().prev().children().first().text();
                    //console.log(customselect);
                    if (customselect) {
                        customOptions.prev().find('span').text(`(${customselect})`);
                    }
                    let linkedOptions = customOptions.parent().prev().children();
                    linkedOptions.each(function(i, item) {
                        $(`<div class="custom-options"> ${item.textContent} </div>`).appendTo(customOptions);
                    });

                })
                .catch(response => {
                    console.log('error');
                });
        } else {
            $('#floor').empty();
        }
    }
</script>--}}

@endsection
