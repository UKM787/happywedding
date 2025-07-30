<template>
    <div style="margin-bottom: 100px">
        <div class="venue-head-list">
            <div>
                <a href="/">Home > </a>
                <a href="/wedding-venues">Wedding venues > </a>
                <a
                    v-if="type"
                    :href="'/directory/vendors/venues/filtered?type=' + type"
                    >{{ type }} >
                </a>
                <span v-if="city">{{ city }} > </span>
                <span style="color: #898484" v-if="venue"
                    >{{ venue?.name }}
                </span>
            </div>
            <span @click="goBack()">Go back to you search!!</span>
        </div>
        <div class="venue-signle-main-details container-md">
            <h1>{{ venue.name }}</h1>
            <p>
                <img src="/assets/venues/map-pin.svg" alt="" />
                98/99, Vanagaram-Ambattur Rd Rajankuppam, Vanagaram Near Sky
                City Apartments, Vanagaram, Chennai, 600095
            </p>
            <a class="venue-loc" href="https://www.google.com/maps"
                >View on map</a
            >
            <div class="rate-social">
                <div>
                    <span>
                        <img src="/assets/venues/ic_outline-star.svg" alt="" />
                        <img src="/assets/venues/ic_outline-star.svg" alt="" />
                        <img src="/assets/venues/ic_outline-star.svg" alt="" />
                        <img src="/assets/venues/ic_outline-star.svg" alt="" />
                        <img src="/assets/venues/ic_outline-star.svg" alt="" />
                    </span>
                    <span>Rated & reviewed by 27 guests</span>
                    <a href="#">Read all reviews</a>
                </div>
                <div>
                    <img src="/assets/venues/insta.svg" alt="" />
                    <img src="/assets/venues/twitter.svg" alt="" />
                    <img src="/assets/venues/snapchat.svg" alt="" />
                    <img src="/assets/venues/facebook.svg" alt="" />
                    <img src="/assets/venues/share.svg" alt="" />
                </div>
            </div>
            <div class="venue-img-cont">
                <img src="/assets/venues/FrameMain.png" alt="" />
                <div>
                    <button>Follow</button>
                    <button>Shortlist</button>
                </div>
            </div>
            <div class="plate-contact">
                <div>
                    <!-- <div class="plate-price">
                        <span>
                            <img src="/assets/venues/nonveg.svg" alt="" />
                            Non- Vegeterian
                        </span>
                        <span> <b>₹1200</b>/Plate </span>
                    </div>
                    <div class="plate-price">
                        <span>
                            <img src="/assets/venues/veg.svg" alt="" />
                            Vegeterian
                        </span>
                        <span> <b>₹800</b>/Plate </span>
                    </div> -->
                </div>
                <div class="contact-check">
                    <div>
                        <img src="/assets/venues/phone.svg" alt="" />
                        <img src="/assets/venues/email.svg" alt="" />
                    </div>
                    <button @click="showCheckAvailability = true">
                        Check Availability
                    </button>
                </div>
            </div>
            <div class="venue-about">
                <h2>About Hyath Mahal 1</h2>
                <p>
                    Our Hyath Mahal 1 in Broadway is an air-conditioned hall
                    with a seating capacity of 500 and a floating capacity of
                    750. Hyath Mahal 1 in Broadway provides a good number of
                    facilities to organize an event. Generator backup is
                    available wh...
                </p>
            </div>
        </div>
        <div class="venue-area-available container-md">
            <h1>Areas Available</h1>
            <div>
                <div class="venue-area-single">
                    <div>
                        <p>500 Seating 700 Max</p>
                        <p>Lawn</p>
                    </div>
                    <div @click="showGallary = true">
                        <img src="/assets/venues/Rectangle5320.png" alt="" />
                        <span>(View All)</span>
                        <div class="overlay"></div>
                    </div>
                </div>
                <div class="venue-area-single">
                    <div>
                        <p>300 Seating 500 Max</p>
                        <p>A/C Hall</p>
                    </div>
                    <div>
                        <img src="/assets/venues/Rectangle5320.png" alt="" />
                        <span>(View All)</span>
                        <div class="overlay"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="venue-single-gallary container-md">
            <h1>Gallery</h1>
            <div>
                <img src="/assets/venues/Rectangle5320.png" alt="" />
                <img src="/assets/venues/Rectangle5320.png" alt="" />
                <img src="/assets/venues/Rectangle5320.png" alt="" />
                <img src="/assets/venues/Rectangle5320.png" alt="" />
                <img src="/assets/venues/Rectangle5320.png" alt="" />
            </div>
        </div>
        <div class="venue-single-details container-md">
            <h1>Details</h1>
            <div>
                <div
                    v-for="(item, index) in venueDetals"
                    :key="index"
                    class="venue-details-single"
                >
                    <h1>
                        <img src="/assets/venues/hall-capacity.svg" alt="" />
                        {{ item.name }}
                    </h1>
                    <div
                        v-for="(ele, num) in item.features"
                        :key="'feature' + num"
                    >
                        <span>{{ ele.name }}</span>
                        <span
                            ><img
                                v-if="ele.img"
                                src="/assets/venues/yes.svg"
                                alt=""
                            />{{ ele.value }}</span
                        >
                    </div>
                    <!-- <div>
                        <span>No Of Air Conditioned Rooms</span>
                        <span
                            ><img src="/assets/venues/yes.svg" alt="" />6</span
                        >
                    </div> -->
                </div>
            </div>
        </div>
        <div class="venue-pricing-policies container-md">
            <h1>Pricing and Policies</h1>
            <ul>
                <li><span>Timing and Slots : </span>Mornings, Afternoons</li>
                <li>
                    <span>Advance Amount : </span>Booking is confirmed against
                    50% payment of the total estimated amount.
                </li>
                <li>
                    <span>Tax : </span>Service Tax is applicable. For more
                    details check with venue manager
                </li>
                <li><span>Cancellation : </span>Cancellation charges 2%</li>
            </ul>
        </div>
        <div class="venue-pricing-policies container-md">
            <h1>Terms & Conditions</h1>
            <ul>
                <li>Outside food/caterer not allowed</li>
                <li>Non vegetarian food not allowed</li>
                <li>50% payment at the time of booking</li>
                <li>Non cancellable</li>
            </ul>
        </div>
        <div
            @click="showCheckAvailability = false"
            v-if="showCheckAvailability"
            class="check-availabilty-form-cont"
        >
            <form @click.stop class="check-availability-form">
                <img
                    @click="showCheckAvailability = false"
                    src="/assets/venues/cross.svg"
                    alt=""
                />
                <h1>Check availability</h1>
                <label for="event-type">
                    Event Type <span>*</span>
                    <input
                        type="text"
                        id="event-type"
                        placeholder="Select Event Type"
                    />
                </label>
                <label for="event-date">
                    Event Date <span>*</span>
                    <input
                        type="date"
                        id="event-date"
                        placeholder="Select Event Date"
                    />
                </label>
                <label for="event-session">
                    Event Session <span>*</span>
                    <input
                        type="text"
                        id="event-session"
                        placeholder="Select Event Session"
                    />
                </label>
                <label for="event-name">
                    Full Name <span>*</span>
                    <input
                        type="text"
                        id="event-name"
                        placeholder="Enter Name"
                    />
                </label>
                <label for="event-number">
                    Mobile Number <span>*</span>
                    <input
                        type="text"
                        id="event-number"
                        placeholder="Enter Number"
                    />
                </label>
                <div>
                    <button type="button">Check Availability</button>
                </div>
            </form>
        </div>
        <div @click.stop v-show="showGallary" class="venue-image-gallery">
            <div @click.stop class="container-md position-relative">
                <img
                    @click="showGallary = false"
                    src="/assets/venues/cross.svg"
                    alt=""
                />
                <div>
                    <div
                        id="main-slider"
                        class="splide"
                        style="margin-bottom: 15px"
                    >
                        <div class="splide__track">
                            <ul class="splide__list">
                                <li class="splide__slide">
                                    <img
                                        src="/assets/venues/Rectangle5320.png"
                                    />
                                </li>
                                <li class="splide__slide">
                                    <img
                                        src="/assets/venues/Rectangle5319.png"
                                    />
                                </li>
                                <li class="splide__slide">
                                    <img
                                        src="/assets/venues/Rectangle5321.png"
                                    />
                                </li>
                                <li class="splide__slide">
                                    <img
                                        src="/assets/venues/Rectangle5322.png"
                                    />
                                </li>
                                <li class="splide__slide">
                                    <img
                                        src="/assets/venues/Rectangle5319.png"
                                    />
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div
                    style="margin-top: 15px"
                    id="thumbnail-slider"
                    class="splide"
                >
                    <div class="splide__track">
                        <ul class="splide__list">
                            <li class="splide__slide">
                                <img src="/assets/venues/Rectangle5320.png" />
                            </li>
                            <li class="splide__slide">
                                <img src="/assets/venues/Rectangle5319.png" />
                            </li>
                            <li class="splide__slide">
                                <img src="/assets/venues/Rectangle5321.png" />
                            </li>
                            <li class="splide__slide">
                                <img src="/assets/venues/Rectangle5322.png" />
                            </li>
                            <li class="splide__slide">
                                <img src="/assets/venues/Rectangle5319.png" />
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["cities", "type", "city", "venue"],
    data() {
        return {
            venueDetals: [
                {
                    name: "Hall Capacity",
                    features: [
                        { name: "No Of Rooms", value: 6, img: false },
                        {
                            name: "No Of Air Conditioned Rooms",
                            value: 6,
                            img: false,
                        },
                    ],
                },
                {
                    name: "Changing Rooms",
                    features: [
                        { name: "No Of Rooms", value: 6, img: false },
                        {
                            name: "No Of Air Conditioned Rooms",
                            value: 6,
                            img: false,
                        },
                    ],
                },
                {
                    name: "Food & Service",
                    features: [
                        {
                            name: "Outdoor Catering Allowed",
                            value: "Yes",
                            img: true,
                        },
                        {
                            name: "Non-veg Cooking Allowed",
                            value: "Yes",
                            img: true,
                        },
                        {
                            name: "Non-veg Service Allowed",
                            value: "Yes",
                            img: true,
                        },
                    ],
                },
                {
                    name: "Food & Service",
                    features: [
                        {
                            name: "Outdoor Catering Allowed",
                            value: "Yes",
                            img: true,
                        },
                        {
                            name: "Non-veg Cooking Allowed",
                            value: "Yes",
                            img: true,
                        },
                        {
                            name: "Non-veg Service Allowed",
                            value: "Yes",
                            img: true,
                        },
                    ],
                },
                {
                    name: "Parking",
                    features: [
                        { name: "Car Parking", value: 30, img: false },
                        {
                            name: "Bike Parking",
                            value: 20,
                            img: false,
                        },
                        {
                            name: "Valet Parking Available",
                            value: "Yes",
                            img: true,
                        },
                    ],
                },
                {
                    name: "Alcohol",
                    features: [
                        { name: "Alcohol Allowed", value: "Yes", img: true },
                    ],
                },
                {
                    name: "Decor Policy",
                    features: [
                        { name: "Outside Vendor Allowed" },
                        {
                            name: "Outside Entertainment Allowed",
                        },
                    ],
                },
                {
                    name: "Lodging",
                    features: [
                        { name: "In-House Lodging", value: "Yes", img: true },
                    ],
                },
            ],
            showCheckAvailability: false,
            showGallary: false,
            splider: {},
            mainSplider: {},
        };
    },
    methods: {
        setSplider() {
            let _this = this;
            console.log("asv");
            this.$nextTick(function () {
                _this.mainSplider = new Splide(`#main-slider`, {
                    type: "fade",
                    rewind: true,
                    pagination: false,
                    arrows: true,
                });
                _this.splider = new Splide(`#thumbnail-slider`, {
                    fixedWidth: 100,
                    fixedHeight: 60,
                    gap: 5,
                    rewind: true,
                    pagination: false,
                    cover: true,
                    isNavigation: true,
                    breakpoints: {
                        600: {
                            fixedWidth: 60,
                            fixedHeight: 44,
                        },
                    },
                });
                _this.mainSplider.sync(_this.splider);
                _this.mainSplider.mount();
                _this.splider.mount();
            });
        },
        goBack() {
            window.location.href = document.referrer;
        },
    },
    mounted() {
        console.log("gergerg");
        document.onreadystatechange = () => {
            if (document.readyState == "complete") {
                this.setSplider();
            }
        };
    },
};
</script>

<style scoped>
.venue-head-list > div > a,
.venue-head-list > div > span {
    text-decoration: none;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 300;
    font-size: 12px;
    line-height: 18px;
    color: #138ab3;
}
.venue-head-list {
    display: flex;
    justify-content: space-between;
    background: #ffffff;
    box-shadow: 0px 1px 4px rgba(0, 0, 0, 0.25);
    padding: 16px 52px;
}
.venue-head-list > span {
    text-decoration: none;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 12.8451px;
    line-height: 19px;
    color: #000000;
    cursor: pointer;
}
.venue-signle-main-details > h1 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 25.8531px;
    line-height: 39px;
    color: #000000;
}
.venue-signle-main-details > p > img {
    margin-right: 10px;
}
.venue-signle-main-details > p {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 14px;
    line-height: 21px;
    color: #000000;
}
.venue-signle-main-details > .venue-loc {
    text-decoration: none;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 12px;
    line-height: 18px;
    text-decoration-line: underline;
    color: #c4456f;
}
.rate-social {
    display: flex;
    justify-content: space-between;
}
.rate-social > div:nth-child(1) > span:nth-child(2) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 12px;
    line-height: 18px;
    color: #828282;
    margin-left: 5px;
}
.rate-social > div:nth-child(1) {
    display: flex;
    align-items: center;
}
.rate-social > div:nth-child(1) > a {
    display: inline-block;
    margin-left: 5px;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 12px;
    line-height: 18px;

    text-decoration-line: underline;
    color: #c4456f;
}
.venue-img-cont {
    position: relative;
    padding-top: 35%;
    margin-top: 15px;
}
.venue-img-cont > img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 6px;
}
.venue-img-cont > div {
    position: absolute;
    top: 30px;
    right: 30px;
    display: flex;
}
.venue-img-cont > div > button {
    border: none;
    outline: none;
    width: 117px;
    height: 31.1px;
    background: #461952;
    border-radius: 4.69859px;
    font-family: "Roboto";
    font-style: normal;
    font-weight: 500;
    font-size: 14.0958px;
    line-height: 17px;

    color: #ffffff;
}
.venue-img-cont > div > button:last-child {
    color: #000000;
    background-color: #ffffff;
    margin-left: 10px;
}
.plate-contact {
    display: flex;
    justify-content: space-between;
    margin-top: 15px;
}
.plate-price > span:nth-child(1) {
    display: inline-block;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 13.9173px;
    line-height: 21px;
    width: 150px;
    color: #898484;
}
.plate-price > span:nth-child(2) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 15.041px;
    line-height: 25px;
    color: #000000;
}
.contact-check > div {
    display: inline-block;
    margin-right: 15px;
}
.contact-check > div > img:nth-child(1) {
    margin-right: 10px;
}
.contact-check > button {
    border: none;
    outline: none;
    background: #c4456f;
    border-radius: 3.93246px;
    padding: 9px 22px;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 11.346px;
    line-height: 17px;
    text-align: center;
    color: #ffffff;
}
.venue-about {
    margin: 15px 0;
}
.venue-about > h2 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 17.6485px;
    line-height: 26px;
    color: #000000;
    margin-bottom: 7px;
}
.venue-about > p {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 16px;
    line-height: 24px;
    color: #000000;
    margin: 0;
}
.venue-area-available {
    margin-bottom: 15px;
}
.venue-area-available > h1 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 17.6485px;
    line-height: 26px;
    color: #000000;
    margin-bottom: 15px;
}
.venue-area-available > div {
    display: flex;
    flex-wrap: wrap;
}
.venue-area-single {
    display: flex;
    background: #ffffff;
    border: 0.5px solid #b4acac;
    border-radius: 7px;
    padding: 10px;
    margin-right: 20px;
}
.venue-area-single > div:nth-child(1) {
    display: flex;
    flex-direction: column;
    justify-content: center;
}
.venue-area-single > div:nth-child(1) > p {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 17.6485px;
    line-height: 26px;
    color: #000000;
    margin-bottom: 3px;
}
.venue-area-single > div:nth-child(1) > p:nth-child(2) {
    font-weight: 300;
    font-size: 17.6485px;
    line-height: 26px;
}
.venue-area-single > div:nth-child(2) {
    width: 133px;
    height: 91px;
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-left: 20px;
}
.venue-area-single > div:nth-child(2) > span {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 12.6372px;
    line-height: 19px;
    position: absolute;
    color: #ffffff;
    z-index: 9999;
}
.venue-area-single > div:nth-child(2) > img {
    position: absolute;
    z-index: 99;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.venue-area-single > div:nth-child(2) > .overlay {
    position: absolute;
    z-index: 999;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6);
}
.venue-single-gallary > h1 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 17.6485px;
    line-height: 26px;
    color: #000000;
}
.venue-single-gallary > div {
    display: flex;
    flex-wrap: wrap;
}
.venue-single-gallary > div > img {
    width: 137px;
    height: 107px;
    object-fit: cover;
    margin-right: 5px;
    border-radius: 4.2976px;
}
.venue-single-details {
    margin: 15px auto;
}
.venue-single-details > h1 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 17.6485px;
    line-height: 26px;
    color: #000000;
}
.venue-single-details > div {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(332px, 1fr));
    grid-row-gap: 10px;
    grid-column-gap: 10px;
}
.venue-details-single {
    border: 0.5px solid #c8c8c8;
    border-radius: 5px;
    padding: 14px;
    width: 100%;
}
.venue-details-single > h1 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 15px;
    line-height: 22px;
    color: #000000;
}
.venue-details-single > h1 > img {
    margin-right: 5px;
    height: 19px;
    width: 19px;
}
.venue-details-single > div {
    display: flex;
    justify-content: space-between;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 300;
    font-size: 15px;
    line-height: 22px;
    margin-bottom: 4px;
    color: #000000;
}
.venue-details-single > div > span {
    display: flex;
    align-items: center;
}
.venue-details-single > div img {
    margin-right: 5px;
}
.venue-pricing-policies > h1 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 17.6485px;
    line-height: 26px;
    color: #000000;
}
.venue-pricing-policies span {
    font-weight: 500;
}
.venue-pricing-policies li {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 16px;
    line-height: 166.5%;
    color: #000000;
}
.check-availabilty-form-cont,
.venue-image-gallery {
    background: rgba(0, 0, 0, 0.8);
    position: fixed;
    z-index: 999999;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}
.check-availability-form {
    background-color: #ffffff;
}
.check-availability-form,
.venue-image-gallery > div {
    padding: 18px;
    position: relative;
    width: 100%;
}
.check-availability-form > img {
    position: absolute;
    top: 18px;
    right: 18px;
    cursor: pointer;
}
.check-availability-form > h1 {
    font-family: "Perpetua";
    font-style: normal;
    font-weight: 700;
    font-size: 24.4444px;
    line-height: 28px;
    text-align: center;
    color: #333333;
}
.check-availability-form > label {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 11.2889px;
    line-height: 17px;
    color: #000000;
    width: 100%;
}
.check-availability-form > label > span {
    color: red;
}
.check-availability-form > label > input::placeholder,
.check-availability-form > label > input {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 300;
    font-size: 13.098px;
    line-height: 20px;
    color: #000000;
}
.check-availability-form > label > input {
    border: none;
    outline: none;
    background-color: #ffffff !important;
    border-bottom: 0.5px solid #d0d0d0;
    width: 100%;
    padding: 5px;
    margin-bottom: 18px;
}
.check-availability-form > div {
    display: flex;
    justify-content: flex-end;
}
.check-availability-form button {
    border: none;
    outline: none;
    padding: 6px;
    background: #c4456f;
    border-radius: 6px;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 12px;
    line-height: 18px;
    text-align: center;
    color: #ffffff;
}
.venue-image-gallery > .container-md {
    position: relative;
    height: 60vh;
}
.venue-image-gallery > .container-md > img {
    position: absolute;
    top: -20px;
    right: 30px;
    z-index: 999;
}
.venue-image-gallery > .container-md > div,
.venue-image-gallery > .container-md #main-slider,
.venue-image-gallery > .container-md #main-slider > * {
    width: 100%;
    height: 100%;
}
.venue-image-gallery > .container-md #main-slider img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
#thumbnail-slider .splide__list {
    justify-content: center;
}
@media only screen and (max-width: 768px) {
    .venue-list-single {
        width: 100%;
    }
}
@media only screen and (max-width: 576px) {
    .rate-social {
        flex-wrap: wrap;
    }
    .rate-social > div {
        width: 100%;
        margin: auto;
        margin-bottom: 5px;
    }
    .rate-social > div:nth-child(1) > span:nth-child(2) {
        display: none;
    }
    .rate-social > div:nth-child(1) {
        justify-content: space-between;
    }
    .rate-social > div:nth-child(2) {
        display: flex;
        justify-content: flex-end;
    }
    .venue-img-cont {
        padding-top: 90%;
    }
    .plate-contact {
        flex-wrap: wrap;
        /* justify-content: space-between; */
    }
    .plate-contact > div {
        width: 100%;
        margin-bottom: 5px;
    }
    .contact-check,
    .plate-price {
        display: flex;
        justify-content: space-between;
    }
    .venue-head-list {
        display: none;
    }
}
</style>
<style>
.splide__slide {
    opacity: 0.6;
}

.splide__slide.is-active {
    opacity: 1;
    border: none !important;
}
/* #thumbnail-slider-list {
    //justify-content: space-around;
} */
</style>
