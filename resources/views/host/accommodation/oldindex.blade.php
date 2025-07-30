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
        flex-direction: column;
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
        border-right: 1.59px solid #e3e8ee;
        border-bottom: 1.59px solid #e3e8ee;
        padding: 5px 10px;
        text-align: center;
        margin: 0;
        height: 98px;
    }

    .wed-accom2-cont>div>div {
        display: flex;
        flex-direction: column;
        border-right: 1.59px solid #e3e8ee;
        height: 100%;
    }

    .wed-accom2-cont>div>div {
        font-family: Segoe UI;
        font-style: normal;
        font-weight: normal;
        font-size: 15px;
        line-height: 20px;
        color: #461952;
        margin-bottom: 0 !important;
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

    .wed-accom2-cont>div>div>label>span {
        width: 80%;
        overflow-x: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
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
</style>

@endsection

@section('content')

<section class="wed-host-section">
    <div class="wed-host-section-container">
        <article class="wed-logistics-title">
            <div class="row">
                <div class="offset-md-1 col-12 col-md-7 d-flex justify-content-center justify-content-md-end">
                    <span id="wed-log-title">{{$invitation->brideName}} & {{ $invitation->groomName}}</span>
                </div>
            </div>
            @if($guestlists->isNotEmpty())

            <article class="about">
                <!-- btn container -->
                <div class="btn-container">
                    <button class="tab-btn active" data-id="selec-hotels">Select Hotels</button>
                    <button class="tab-btn " data-id="selected-summary">Accommodation Booked</button>
                    <button class="tab-btn" data-id="allocate-hotels">Allocate Accommodation</button>
                </div>

                <div class="about-content">

                    <div class="content active" id="selec-hotels">
                        <section class="wed-host-accommodation-cont">
                            <div class="wed-host-accom-hotel">
                                <p>Hotel (Venue list)</p>
                                <form method="" action="">
                                    <div class="multipleSelect" style="width: 65%">
                                        <div class="single-select-cont">
                                            <select name="hotels" id="">
                                                <option value="Taj Hotel">
                                                    Taj Hotel 12.B Montieth road, Egmore, chennai
                                                </option>
                                                <option value="Taj Hotel">
                                                    Taj Hotel 12.B Montieth road, Egmore, chennai
                                                </option>
                                                <option value="Taj Hotsdcsel">
                                                    Coromandal, 67 Teynampet, Chennai 60098
                                                </option>
                                                <option value="Taj Hosadtel">
                                                    Hayatt regency, Mount road , Chennai 600
                                                </option>
                                                <option value="Taj Hosadtel">
                                                    Park Venue, dock street, Nungambakkam
                                                </option>
                                                <option value="Taj Hasotel">
                                                    JW Mariot 12.B Montieth road, Egmore, chennai
                                                </option>
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
                                <form action="" method="">
                                    <div class="multipleSelect" style="width: 65%">
                                        <div class="single-select-cont">
                                            <select name="selected Hotels" id="">
                                                <option value="Taj Hotel">
                                                    Taj Hotel 12.B Montieth road, Egmore, chennai
                                                </option>
                                                <option value="Taj Hotsdcsel">
                                                    Coromandal, 67 Teynampet, Chennai 60098
                                                </option>
                                                <option value="Taj Hosadtel">
                                                    Hayatt regency, Mount road , Chennai 600
                                                </option>
                                            </select>
                                            <div>
                                                <div class="custom-select-head unique wed-host-accom-floor-head">
                                                    Block
                                                    <span></span>
                                                    <img src="/assets/accommodation/Chevron.svg" alt="" />
                                                </div>
                                                <div class="custom-select-options wed-host-accom-hotel-options"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="wed-host-accom-input-text">
                                        <div>
                                            <input type="text" value="" name="block-1" placeholder="Add Block"></input>
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
                                <form action="" method="">
                                    <div class="multipleSelect" style="width: 65%">
                                        <div class="single-select-cont">
                                            <select name="Block" id="">
                                                <option value="Taj Hotel">
                                                    Lotus Block
                                                </option>
                                                <option value="Taj Hotsdcsel">
                                                    Rose Block
                                                </option>
                                                <option value="Taj Hosadtel">
                                                    Lavender Block
                                                </option>
                                            </select>
                                            <div>
                                                <div class="custom-select-head unique wed-host-accom-floor-head">
                                                    Floor<span></span>
                                                    <img src="/assets/accommodation/Chevron.svg" alt="" />
                                                </div>
                                                <div class="custom-select-options wed-host-accom-hotel-options"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="wed-host-accom-input-text">
                                        <div>
                                            <input type="text" value="" name="floor-1" placeholder="Add Floor"></input>
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
                                <form action="" method="">
                                    <div class="multipleSelect" style="width: 65%">
                                        <div class="single-select-cont">
                                            <select name="Floor" id="">
                                                <option value="Taj Hotel">
                                                    6th Floor
                                                </option>
                                                <option value="Taj Hotsdcsel">
                                                    7th Floor
                                                </option>
                                                <option value="Taj Hosadtel">
                                                    8th Floor
                                                </option>
                                            </select>
                                            <div>
                                                <div class="custom-select-head unique wed-host-accom-floor-head">
                                                    Room & Members
                                                    <span></span>
                                                    <img src="/assets/accommodation/Chevron.svg" alt="" />
                                                </div>
                                                <div class="custom-select-options wed-host-accom-hotel-options"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="wed-host-accom-input-text">
                                        <div>
                                            <div class="wed-host-accom-room-mem">
                                                <input type="text" value="" name="room-1" style="width: 66%;" placeholder="Add Room number"></input>
                                                <input type="text" value="" name="members-1" style="width: 29%;" placeholder="Members"></input>
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
                                    <label for="hotel1">
                                        <span>Hayatt Regency 152, Teynampet</span>
                                        <i class="fas fa-ellipsis-v"></i>
                                        <input type="radio" name="hotel_name" id="hotel1" value="Hayatt Regencyk" />
                                    </label>

                                    <label for="hotel2">
                                        <span>Park Venue, 12</span>
                                        <i class="fas fa-ellipsis-v"></i>
                                        <input type="radio" name="hotel_name" id="hotel2" value="Park Venue" />
                                    </label>

                                    <label for="hotel3">
                                        <span>La cabana chenaa, 12</span>
                                        <i class="fas fa-ellipsis-v"></i>
                                        <input type="radio" name="hotel_name" id="hotel3" value="La cabana" />
                                    </label>

                                    <label for="hotel4">
                                        <span>Lower Deck kilpa</span>
                                        <i class="fas fa-ellipsis-v"></i>
                                        <input type="radio" name="hotel_name" id="hotel4" value="Lower Deck" />
                                    </label>
                                </div>
                                <div style="height: max-content; padding: 10px">
                                    <button class="wed-host-add-accomo">
                                        <img src="/assets/accommodation/Group (1).svg" alt="" />
                                    </button>
                                </div>
                            </div>
                            <div>
                                <h4>Block</h4>
                                <div id="blocks">
                                    <label for="block1">
                                        <span>Lotus Block</span>
                                        <i class="fas fa-ellipsis-v"></i>
                                        <input type="radio" name="block_name" id="block1" value="Lotus Block" />
                                    </label>
                                    <label for="block2">
                                        <span>Rose Block</span>
                                        <i class="fas fa-ellipsis-v"></i>
                                        <input type="radio" name="block_name" id="block2" value="Rose Block" />
                                    </label>
                                    <label for="block3">
                                        <span>Sun Block</span>
                                        <i class="fas fa-ellipsis-v"></i>
                                        <input type="radio" name="block_name" id="block3" value="Sun Block" />
                                    </label>
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
                                    <label for="floor1">
                                        <span>6th Floor</span>
                                        <i class="fas fa-ellipsis-v"></i>
                                        <input type="radio" name="floor_num" id="floor1" value="6th Floor" />
                                    </label>
                                    <label for="floor2">
                                        <span>7th Floor</span>
                                        <i class="fas fa-ellipsis-v"></i>
                                        <input type="radio" name="floor_num" id="floor2" value="7th Floor" />
                                    </label>
                                    <label for="floor3">
                                        <span>10th Floor</span>
                                        <i class="fas fa-ellipsis-v"></i>
                                        <input type="radio" name="floor_num" id="floor3" value="10th Floor" />
                                    </label>
                                    <label for="floor4">
                                        <span>12th Floor</span>
                                        <i class="fas fa-ellipsis-v"></i>
                                        <input type="radio" name="floor_num" id="floor4" value="12th Floor" />
                                    </label>
                                    <label for="floor5">
                                        <span>14th Floor</span>
                                        <i class="fas fa-ellipsis-v"></i>
                                        <input type="radio" name="floor_num" id="floor5" value="14th Floor" />
                                    </label>
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
                                    <label for="room1">
                                        <span>201</span>
                                        <i class="fas fa-ellipsis-v"></i>
                                        <input type="radio" name="room_num" id="room1" value="201" />
                                    </label>
                                    <label for="room2">
                                        <span>202</span>
                                        <i class="fas fa-ellipsis-v"></i>
                                        <input type="radio" name="room_num" id="room2" value="202" />
                                    </label>
                                    <label for="room3">
                                        <span>203</span>
                                        <i class="fas fa-ellipsis-v"></i>
                                        <input type="radio" name="room_num" id="room3" value="203" />
                                    </label>
                                    <label for="room4">
                                        <span>207</span>
                                        <i class="fas fa-ellipsis-v"></i>
                                        <input type="radio" name="room_num" id="room4" value="207" />
                                    </label>
                                    <label for="room5">
                                        <span>209</span>
                                        <i class="fas fa-ellipsis-v"></i>
                                        <input type="radio" name="room_num" id="room5" value="209" />
                                    </label>
                                    <label for="room6">
                                        <span>210</span>
                                        <i class="fas fa-ellipsis-v"></i>
                                        <input type="radio" name="room_num" id="room6" value="210" />
                                    </label>
                                    <label for="room7">
                                        <span>212</span>
                                        <i class="fas fa-ellipsis-v"></i>
                                        <input type="radio" name="room_num" id="room7" value="212" />
                                    </label>
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
                                    <label for="mem">
                                        <span>5</span>
                                        <i class="fas fa-ellipsis-v"></i>
                                        <input type="radio" name="mem" id="mem" value="5" />
                                    </label>
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
                    </div>

                    <div class="content" id="allocate-hotels">
                        <section class="wed-logistics-accordion">
                            <div class="row justify-content-end">
                                <div class="col-12 col-md-3 ml-auto justify-content-center wed-log-buttons flex-column position-relative">
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
                                </div>
                            </div>
                            @foreach($guestlists as $guest)

                            <div class="wed-log-accord-item" style="padding: 1em 0 1em 0">
                                <div class="row wed-log-accord">
                                    <div class="col-12 col-md-4 d-flex justify-content-md-between justify-content-between pl-0">
                                        <div class="d-flex">
                                            <img src="//assets/log-add.png" alt="" style="margin-left:10px">
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
                                            {{$arr->memberCount}}
                                            @endif
                                            @endforeach
                                        </div>
                                        <div class="wed-log-accord-text">
                                            <div class="wed-log-accord-online"></div>
                                            <div class="wed-log-accord-text">Active</div>
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

                                        @foreach($guest->family as $member)

                                        <tr>
                                            <input hidden name="family_id[]" type="text" value="{{$member->id}}">
                                            <td>{{$member->name}}</td>
                                            <td>{{$member->mobile}}</td>
                                            <td><input name="hotelName[]" type="text" placeholder="hotelName" value="{{$member->privileges->first()->hotelName ?? ''}}"></td>
                                            <td><input name="block[]" type="text" placeholder="hotelBlock" value="{{$member->privileges->first()->block ?? ''}}"></td>
                                            <td><input name="floor[]" type="text" placeholder="floor no." value="{{$member->privileges->first()->floor ?? ''}}"></td>
                                            <td><input name="roomno[]" type="text" placeholder="Room no." value="{{$member->privileges->first()->roomno ?? ''}}"></td>
                                        </tr>
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
            <div class="text-center" style="background-color:thistle; border-radius: 50%;">
                <h3 style="padding: 1em 0; margin: 0 7em;">SendInvitations First </h3>
            </div>
            @endif
    </div>
</section>

@endsection


@section('wed-host-script')

<script>
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
        });

        if (e.currentTarget.checked == true) {
            e.currentTarget.parentElement.style.backgroundColor = "#B1415E";
            e.currentTarget.parentElement.style.color = "#FFFFFF";
        }
    });
</script>

<!-- Select hotels script  -->
<script>
    var multipleSelect = $(".multipleSelect");

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
            let attr = `${name.slice(0,-2)} ${Number(name.slice(-1))+1}`;
            var input = `<input type="text" value="" name="${attr}" placeholder="Add ${name.slice(0,-2)}"></input>`;
            $(input).appendTo(targ.previousElementSibling.parentElement.firstElementChild);
        }
    });

    // Toggle dropdown
    $(".multipleSelect").on("click", ".custom-select-head", function(e) {
        e.stopPropagation();
        console.log(e);
        e.currentTarget.nextElementSibling.classList.toggle("show");
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
                $(`<div> ${item.textContent} </div>`).appendTo(ele);
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
</script>

@endsection
