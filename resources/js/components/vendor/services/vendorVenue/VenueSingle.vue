<template>
    <div>
        <section class="container">
            <div class="wed-ven-single-head">
                <div style="flex: 1">
                    <p>
                        {{ venueDetails.name }}
                    </p>
                    <p>
                        {{ venueDetails.district }},
                        {{ venueDetails.state }}
                        {{ venueDetails.zipcode }} (<a>view on map</a>)
                    </p>
                </div>
                <div style="flex: 1">
                    <div
                        style="
                            display: flex;
                            margin-bottom: 10px;
                            justify-content: flex-end;
                        "
                    >
                        <button @click="showForm = true" type="button">
                            Finalize
                        </button>
                        <button type="button">Follow</button>
                        <button type="button">Shortlist</button>
                    </div>
                </div>
            </div>
            <div class="wed-ven-single-mainImg">
                <img
                    v-if="venueDetails.images != null"
                    :src="'/assets/vendors/uploads/' + venueDetails.images[0]"
                    alt=""
                />
                <img
                    v-else
                    src="/assets/vendors/venues/defaultvenue.png"
                    alt=""
                />
                <div>
                    <button type="button" style="margin-rght: 10px">
                        <img
                            src="/assets/vendors/accomodations/save.svg"
                            alt=""
                        />
                    </button>
                    <button type="button" style="margin-rght: 10px">
                        <img src="/assets/vendors/venues/share.svg" alt="" />
                    </button>
                    <button type="button">
                        <img src="/assets/vendors/venues/heart.svg" alt="" />
                    </button>
                </div>
                <div>
                    <a :href="venueDetails.facebook_link">
                        <img
                            src="/assets/single-venue-page/facebook.svg"
                            alt=""
                        />
                    </a>
                    <a :href="venueDetails.instagram_link">
                        <img
                            src="/assets/single-venue-page/instagram.svg"
                            alt=""
                        />
                    </a>
                    <a :href="venueDetails.snapchat_link">
                        <img
                            src="/assets/single-venue-page/snapchat.svg"
                            alt=""
                        />
                    </a>
                    <a :href="venueDetails.twitter_link">
                        <img
                            src="/assets/single-venue-page/twitter.svg"
                            alt=""
                        />
                    </a>
                </div>
            </div>
            <div
                class="wed-ven-single-aboutcontent"
                style="
                    margin-bottom: 2em;
                    display: flex;
                    flex-wrap: wrap;
                    justify-content: center;
                "
            >
                <div style="width: 60%">
                    <div>
                        <span style="font-weight: 400">About </span
                        >{{ venueDetails.name }} - {{ venueDetails.state }}
                        {{ venueDetails.zipcode }}
                    </div>
                    <div>
                        {{ venueDetails.description }}
                    </div>
                </div>
                <div class="wed-ven-single-about-info">
                    <div>
                        <p>Starting price</p>
                        <p>
                            <img
                                src="/assets/vendors/venues/veg.svg"
                                alt=""
                            />₹{{ venueDetails.veg_plate }} per plate
                        </p>
                        <p>
                            <img
                                src="/assets/vendors/venues/nonveg.svg"
                                alt=""
                            />₹{{ venueDetails.non_veg_plate }} per plate
                        </p>
                        <div style="text-align: center">
                            <button @click="hidden = true" type="button">
                                <img
                                    src="/assets/vendors/venues/msg.svg"
                                    alt=""
                                />
                                Send message
                            </button>
                        </div>
                    </div>
                    <div>
                        <img
                            src="/assets/vendors/venues/partAreaIcon.svg"
                            alt=""
                        />
                        <h3>Party area and capacity</h3>
                        <div
                            v-for="(
                                item, name, index
                            ) in venueDetails.party_area"
                            :key="index"
                        >
                            <h4>{{ item.name }}</h4>
                            <p>Seating : {{ item.Seating }}</p>
                            <p>Max capacity : {{ item["Maximum capacity"] }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div
                v-show="hidden"
                style="
                    z-index: 9999999;
                    width: 100%;
                    height: 100vh;
                    position: fixed;
                    top: 0;
                    left: 0;
                    background: rgba(0, 0, 0, 0.7);
                "
            >
                <form
                    @submit.prevent="submitlead($event)"
                    class="vendor-add-room-form-popup"
                >
                    <div>
                        <span>Send message</span>
                        <button type="button">
                            <i
                                style="color: #afafaf"
                                class="fas fa-times-circle"
                                @click="hidden = false"
                            ></i>
                        </button>
                    </div>
                    <div style="overflow-y: auto">
                        <input
                            type="text"
                            name="cust_name"
                            placeholder="Name"
                            id="cust_name"
                            required
                            v-model="submitLead.name"
                        />
                        <input
                            type="text"
                            name="PhoneNum"
                            placeholder="Phone number"
                            id="PhoneNum"
                            required
                            v-model="submitLead.phone_num"
                        />
                        <input
                            type="text"
                            name="custEmail"
                            placeholder="E-mail address"
                            id="custEmail"
                            required
                            v-model="submitLead.email"
                        />

                        <date-picker v-model="date">
                            <template v-slot="{ inputValue, inputEvents }">
                                <input
                                    class="dte"
                                    type="text"
                                    :value="inputValue"
                                    v-on="inputEvents"
                                    required
                                    placeholder="Function Date"
                                />
                            </template>
                        </date-picker>
                        <input
                            type="text"
                            name="noOfGuests"
                            placeholder="No. of Guests"
                            id="noOfGuests"
                            required
                            v-model="submitLead.no_of_guests"
                        />
                        <div>
                            <div id="areaHead" @click="show = !show">Areas</div>
                            <div v-if="show" class="radioboxcont">
                                <div
                                    v-for="(
                                        item, name, index
                                    ) in venueDetails.party_area"
                                    :key="index"
                                    @click="selectArea($event)"
                                >
                                    <label :for="item.name">
                                        <input
                                            type="radio"
                                            name="areaType"
                                            :id="item.name"
                                            required
                                            :value="item.name"
                                            v-model="submitLead.party_area"
                                        />
                                        <div>
                                            {{ item.name }} Seating :
                                            {{ item.Seating }} Max capacity :
                                            {{ item["Maximum capacity"] }}
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="vendor-venue-query-daytime">
                        <label @click="checkDayTime($event)" for="timeday1">
                            <input
                                type="radio"
                                name="timeday"
                                id="timeday1"
                                value="Morning"
                                v-model="submitLead.event_time"
                                required
                            />
                            <span></span>
                            <span>Morning</span>
                        </label>
                        <label @click="checkDayTime($event)" for="timeday2">
                            <input
                                type="radio"
                                name="timeday"
                                id="timeday2"
                                value="Afternoon"
                                required
                                v-model="submitLead.event_time"
                            />
                            <span></span>
                            <span>Afternoon</span>
                        </label>
                        <label @click="checkDayTime($event)" for="timeday3">
                            <input
                                type="radio"
                                name="timeday"
                                id="timeday3"
                                value="Evening"
                                required
                                v-model="submitLead.event_time"
                            />
                            <span></span>
                            <span>Evening</span>
                        </label>
                        <label @click="checkDayTime($event)" for="timeday4">
                            <input
                                type="radio"
                                name="timeday"
                                id="timeday4"
                                value="Night"
                                required
                                v-model="submitLead.event_time"
                            />
                            <span></span>
                            <span>Night</span>
                        </label>
                    </div>
                    <div>
                        <button type="submit">
                            Check availability and prices
                        </button>
                    </div>
                </form>
                <flashMessage :message="leadMessage"></flashMessage>
            </div>
        </section>
        <section class="wed-venue-port">
            <div class="jsNav wed-venue-port-head">
                <div
                    @click="tooglePortfolio($event)"
                    data-id="acc-single-albums"
                    class="wed-venue-port-head-active"
                >
                    Albums
                </div>
                <div
                    @click="tooglePortfolio($event)"
                    data-id="acc-single-videos"
                >
                    Videos
                </div>
            </div>
            <div class="jsTab wed-venue-port-items">
                <div id="acc-single-albums">
                    <div
                        v-for="(ele, index) in venueDetails.images"
                        :key="index"
                    >
                        <img :src="'/assets/vendors/uploads/' + ele" alt="" />
                    </div>
                </div>
                <div id="acc-single-videos" class="jsTabHide">
                    <div
                        v-for="(ele, index) in venueDetails.videos"
                        :key="index"
                    >
                        <video controls>
                            <source :src="'/assets/vendors/uploads/' + ele" />
                        </video>
                    </div>
                </div>
            </div>
            <button class="wed-venue-port-all">View all</button>
        </section>
        <section class="acc-features-cont container">
            <h3>Features of {{ venueDetails.name }}</h3>
            <ul>
                <li v-for="(item, index) in venueDetails.features" :key="index">
                    {{ item }}
                </li>
            </ul>
        </section>
        <section
            v-if="venueDetails?.services && venueDetails.services.length > 0"
            class="acc-features-cont container"
        >
            <h3>Services offfered by {{ venueDetails.name }}</h3>
            <div
                v-for="(item, name, index) in venueDetails.services"
                :key="index"
                class="item"
            >
                <div class="content">
                    <div><img :src="'/assets/defaults/services/images/'+item.imageOne" alt="" /></div>
                    <div>{{ item.name }}</div>
                </div>
            </div>
            <!-- <ul>

                <li v-for="(item, index) in venueDetails.services" :key="index">
                    {{ item.name }}
                </li>
            </ul> -->
        </section>
        <section class="acc-facilites-cont container">
            <h3>Policies of {{ venueDetails.name }}</h3>
            <div
                v-for="(item, name, index) in venueDetails.venue_policies"
                :key="index"
                class="item"
            >
                <div class="content">
                    <div><img :src="item.img" alt="" /></div>
                    <div>{{ name }}</div>
                    <ul v-for="(ele, index) in item.facilities" :key="index">
                        <li>{{ ele }}</li>
                    </ul>
                </div>
            </div>
        </section>
        <section class="acc-facilites-cont container">
            <h3>Ameneties of {{ venueDetails.name }}</h3>
            <div
                v-for="(item, name, index) in venueDetails.venue_facilities"
                :key="index"
                class="item"
            >
                <div class="content">
                    <div><img :src="item.img" alt="" /></div>
                    <div>{{ name }}</div>
                    <ul v-for="(ele, index) in item.facilities" :key="index">
                        <li>{{ ele }}</li>
                    </ul>
                </div>
            </div>
        </section>
        <section class="container wed-acc-google-map">
            <h3>Venue address</h3>
            <p>
                {{ venueDetails.address }},{{ venueDetails.district }},
                {{ venueDetails.state }}
                <a
                    :href="
                        `http://maps.google.com?q=` +
                        position.lat +
                        `,` +
                        position.lng
                    "
                    >Get Directions</a
                >
            </p>
            <gmap-map
                ref="mapRef"
                :center="position"
                :zoom="12"
                style="width: 100%; height: 400px"
                :options="options"
            >
                <gmap-marker
                    :position="position"
                    @click="center = helo()"
                ></gmap-marker
            ></gmap-map>
        </section>
        <section ref="reviewCont" class="wed-venue-splide container">
            <div>What customers say about us</div>
            <div>We do our best to provide you the best experience ever</div>

            <div class="splide" id="testimonial-splide">
                <div class="splide__track">
                    <ul class="splide__list d-flex">
                        <li
                            v-for="(item, index) in reviews"
                            :key="index"
                            class="splide__slide"
                        >
                            <div
                                class="wed-venue-testi"
                                style="margin-right: 3em"
                            >
                                <div>
                                    <img
                                        src="/assets/single-venue-page/oi_double-quote-serif-left.svg"
                                        alt=""
                                    />
                                </div>
                                <div>{{ item.title }}</div>
                                <div>
                                    <img
                                        v-for="index in item.rating"
                                        :key="index"
                                        src="/assets/single-venue-page/Shape.svg"
                                        alt=""
                                    />
                                    <span>2 days ago</span>
                                </div>
                                <div>
                                    {{ item.description }}
                                </div>
                                <hr
                                    style="
                                        background-color: #c4c4c4;
                                        width: 50px;
                                    "
                                />
                                <div style="margin-top: auto">
                                    {{ item.given_by }}
                                </div>
                            </div>
                        </li>
                        <li
                            v-for="item in defaultReviews"
                            :key="item.id"
                            class="splide__slide"
                        >
                            <div
                                class="wed-venue-testi"
                                style="margin-right: 3em"
                            >
                                <div>
                                    <img
                                        src="/assets/single-venue-page/oi_double-quote-serif-left.svg"
                                        alt=""
                                    />
                                </div>
                                <div>{{ item.title }}</div>
                                <div>
                                    <img
                                        v-for="index in 5"
                                        :key="index"
                                        src="/assets/single-venue-page/Shape.svg"
                                        alt=""
                                    />
                                    <span>{{ item.time }}</span>
                                </div>
                                <div>
                                    {{ item.description }}
                                </div>
                                <hr
                                    style="
                                        background-color: #c4c4c4;
                                        width: 50px;
                                    "
                                />
                                <div style="margin-top: auto">
                                    {{ item.name }}
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <section class="wed-venue-rating container">
            <div class="rating-distribution">
                <div>
                    <div>Rating Distribution</div>
                    <div>
                        5
                        <img
                            src="/assets/single-venue-page/Rating Star.svg"
                            alt=""
                        />
                    </div>
                </div>
                <div>
                    <div class="rating-bar-box">
                        <div>
                            5&nbsp<img
                                src="/assets/single-venue-page/Rating Star small.svg"
                                alt=""
                                style="margin-top: -4px"
                            />
                        </div>
                        <div>
                            <div class="rating-percent"></div>
                        </div>
                        <div>20 ratings</div>
                    </div>
                    <div class="rating-bar-box">
                        <div>
                            4&nbsp<img
                                src="assets/single-venue-page/Rating Star small.svg"
                                alt=""
                                style="margin-top: -4px"
                            />
                        </div>
                        <div>
                            <div class="rating-percent"></div>
                        </div>
                        <div>16 ratings</div>
                    </div>
                    <div class="rating-bar-box">
                        <div>
                            3&nbsp<img
                                src="assets/single-venue-page/Rating Star small.svg"
                                alt=""
                                style="margin-top: -4px"
                            />
                        </div>
                        <div>
                            <div class="rating-percent"></div>
                        </div>
                        <div>0 ratings</div>
                    </div>
                    <div class="rating-bar-box">
                        <div>
                            2&nbsp<img
                                src="assets/single-venue-page/Rating Star small.svg"
                                alt=""
                                style="margin-top: -4px"
                            />
                        </div>
                        <div>
                            <div class="rating-percent"></div>
                        </div>
                        <div>0 ratings</div>
                    </div>
                    <div class="rating-bar-box">
                        <div>
                            1&nbsp<img
                                src="assets/single-venue-page/Rating Star small.svg"
                                alt=""
                                style="margin-top: -4px"
                            />
                        </div>
                        <div>
                            <div class="rating-percent"></div>
                        </div>
                        <div>0 ratings</div>
                    </div>
                </div>
            </div>
            <div>
                <div>Rate your experience</div>
                <form @submit.prevent="submitreview($event)">
                    <div class="form-rating">
                        <span class="custom-rate"
                            ><i
                                @click="toggleRating($event)"
                                class="fas fa-star"
                            ></i
                        ></span>
                        <span class="custom-rate"
                            ><i
                                @click="toggleRating($event)"
                                class="fas fa-star"
                            ></i
                        ></span>
                        <span class="custom-rate"
                            ><i
                                @click="toggleRating($event)"
                                class="fas fa-star"
                            ></i
                        ></span>
                        <span class="custom-rate"
                            ><i
                                @click="toggleRating($event)"
                                class="fas fa-star"
                            ></i
                        ></span>
                        <span class="custom-rate"
                            ><i
                                @click="toggleRating($event)"
                                class="fas fa-star"
                            ></i
                        ></span>
                    </div>
                    <div class="rating-form">
                        <label for="">Review title</label>
                        <input
                            type="text"
                            name=""
                            id=""
                            placeholder="Example ; Marvellous"
                            maxlength="100"
                            required
                            v-model="submitReview.title"
                            @keydown.enter.prevent
                        />
                        <span style="position: absolute">1/100</span>
                    </div>
                    <div class="rating-form">
                        <label for="">Write a review</label>
                        <input
                            type="text"
                            name=""
                            id=""
                            placeholder="Example ; Marvellous"
                            maxlength="100"
                            required
                            v-model="submitReview.description"
                            @keydown.enter.prevent
                        />
                        <span style="position: absolute">1/100</span>
                    </div>
                    <div class="rating-form">
                        <label for="">Add keywords</label>
                        <input
                            type="text"
                            name=""
                            id=""
                            placeholder="Example ; Marvellous"
                            maxlength="100"
                            required
                            v-model="submitReview.keywords"
                            @keydown.enter.prevent
                        />
                        <span style="position: absolute">1/100</span>
                    </div>
                    <button type="submit">submit</button>
                    <div v-if="logginFirst">{{ logginFirst }}</div>
                </form>
            </div>
        </section>
        <section v-if="vendor == null" class="wed-ven-featured container">
            <h1 style="margin-bottom: 2em">Popular venues in chennai</h1>
            <div class="wed-venue-items">
                <a
                    href=""
                    v-for="(item, index) in popluarSearches"
                    :key="index"
                >
                    <div>
                        <img
                            src="/assets/venues/venueDefault.png"
                            alt=""
                            width="100px"
                            height="auto"
                        />
                        <div class="wed-venue-items-desc">
                            <div>
                                <div>{{ item.name }}</div>
                                <div class="d-flex">
                                    <div>{{ item.rating }}</div>
                                    <div>
                                        <img
                                            src="/assets/icon-SVG/Star.svg"
                                            alt=""
                                            style="margin-top: -5px"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>{{ item.descp }}</p>
                                <p>{{ item.reviews }} reviews</p>
                            </div>
                        </div>
                    </div>
                    <div class="wed-venue-items-price">
                        <div style="width: 55%">
                            <div>Banquet hall</div>
                            <div>
                                <span>400-600 pax</span>
                                <span>Indoor</span>
                                <span>Outdoor</span>
                            </div>
                        </div>
                        <div style="width: 35%">
                            <div class="priceperplatetype">Veg</div>
                            <div class="priceperplate">
                                ₹800 <span>per plate</span>
                            </div>
                            <div class="priceperplatetype">Non-veg</div>
                            <div class="priceperplate">
                                ₹1200 <span>per plate</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </section>
        <div v-if="showForm" class="overlay-form">
            <form
                @submit.prevent="finalizeVendor($event)"
                class="task-form-emp"
            >
                <div class="d-flex justify-content-end">
                    <i
                        @click="showForm = false"
                        style="font-size: 20px; cursor: pointer"
                        class="fas fa-times-circle"
                    ></i>
                </div>
                <p>Your Invitaion's</p>
                <div v-if="invites == null">No invitations</div>
                <div v-else v-for="(item, index) in invites" :key="index">
                    <label :for="item.slug + item.id">
                        {{ item.brideName }} weds {{ item.groomName }}
                        <input
                            type="checkbox"
                            :id="item.slug + item.id"
                            :value="item.id"
                            v-model="finalInvi"
                        />
                    </label>
                </div>
                <button type="submit" class="btn btn-primary mb-2 btn-custm">
                    Finalize
                </button>
            </form>
        </div>
        <flashMessage :message="message"></flashMessage>
    </div>
</template>

<script>
import Calendar from "v-calendar/lib/components/calendar.umd";
import flashMessage from "../../../FlashMessage.vue";
import DatePicker from "v-calendar/lib/components/date-picker.umd";

export default {
    components: {
        Calendar,
        "date-picker": DatePicker,
        flashMessage,
    },
    range: {
        start: "Function Date",
        end: "",
    },
    props: ["vendorCat", "owner", "venues", "logged", "vendor", "inivitations"],
    data() {
        return {
            venueDetails: JSON.parse(this.venues),
            vendorCategory: JSON.parse(this.vendorCat),
            hidden: false,
            show: false,
            finalInvi: [],
            date: "Function Date",
            center: { lat: 20.7333, lng: 76.7794 },
            position: { lat: 30.7333, lng: 76.7794 },
            options: {
                zoomControl: true,
                mapTypeControl: false,
                scaleControl: false,
                streetViewControl: false,
                rotateControl: false,
                fullscreenControl: true,
                disableDefaultUi: false,
                gestureHandling: "greedy",
            },
            // search: {
            //     state: null,
            //     startDate: null,
            //     endDate: null,
            //     adult: 0,
            //     children: 0,
            //     rooms: 0,
            // },
            // hotelSingleFaciclites: [
            //     {
            //         id: 1,
            //         name: "Business facilities",
            //         img: "/assets/vendors/accomodations/iconoir_yoga.svg",
            //         facilities: ["Fax/photocopying"],
            //     },
            //     {
            //         id: 2,
            //         name: "Food & Drink",
            //         img: "/assets/vendors/accomodations/iconoir_yoga.svg",
            //         facilities: ["Fax/photocopying"],
            //     },
            //     {
            //         id: 3,
            //         name: "Safety & security",
            //         img: "/assets/vendors/accomodations/iconoir_yoga.svg",
            //         facilities: [
            //             "Fire extinguishers",
            //             "CCTV outside property",
            //             "CCTV in common areas",
            //             "24-hour security",
            //         ],
            //     },
            //     {
            //         id: 4,
            //         name: "Safety & security",
            //         img: "/assets/vendors/accomodations/iconoir_yoga.svg",
            //         facilities: [
            //             "Fire extinguishers",
            //             "CCTV outside property",
            //             "CCTV in common areas",
            //             "24-hour security",
            //         ],
            //     },
            //     {
            //         id: 5,
            //         name: "Safety & security",
            //         img: "/assets/vendors/accomodations/iconoir_yoga.svg",
            //         facilities: [
            //             "Fire extinguishers",
            //             "CCTV outside property",
            //             "CCTV in common areas",
            //             "24-hour security",
            //             "Fire extinguishers",
            //             "CCTV outside property",
            //             "CCTV in common areas",
            //             "24-hour security",
            //         ],
            //     },
            //     {
            //         id: 6,
            //         name: "Safety & security",
            //         img: "/assets/vendors/accomodations/iconoir_yoga.svg",
            //         facilities: [
            //             "Fire extinguishers",
            //             "CCTV outside property",
            //             "CCTV in common areas",
            //             "24-hour security",
            //             "Fire extinguishers",
            //             "CCTV outside property",
            //             "CCTV in common areas",
            //             "24-hour security",
            //         ],
            //     },
            //     {
            //         id: 7,
            //         name: "Safety & security",
            //         img: "/assets/vendors/accomodations/iconoir_yoga.svg",
            //         facilities: ["Fire extinguishers", "CCTV outside property"],
            //     },
            //     {
            //         id: 8,
            //         name: "Safety & security",
            //         img: "/assets/vendors/accomodations/iconoir_yoga.svg",
            //         facilities: [
            //             "Fire extinguishers",
            //             "CCTV outside property",
            //             "CCTV in common areas",
            //             "24-hour security",
            //             "Fire extinguishers",
            //             "CCTV outside property",
            //         ],
            //     },
            // ],
            // hotelSinglePolicies: [
            //     {
            //         id: 1,
            //         name: "Business facilities",
            //         img: "/assets/vendors/accomodations/iconoir_yoga.svg",
            //         facilities: ["Fax/photocopying"],
            //     },
            //     {
            //         id: 2,
            //         name: "Food & Drink",
            //         img: "/assets/vendors/accomodations/iconoir_yoga.svg",
            //         facilities: ["Fax/photocopying"],
            //     },
            //     {
            //         id: 3,
            //         name: "Safety & security",
            //         img: "/assets/vendors/accomodations/iconoir_yoga.svg",
            //         facilities: [
            //             "Fire extinguishers",
            //             "CCTV outside property",
            //             "CCTV in common areas",
            //             "24-hour security",
            //         ],
            //     },
            //     {
            //         id: 4,
            //         name: "Safety & security",
            //         img: "/assets/vendors/accomodations/iconoir_yoga.svg",
            //         facilities: [
            //             "Fire extinguishers",
            //             "CCTV outside property",
            //             "CCTV in common areas",
            //             "24-hour security",
            //             "Fire extinguishers",
            //             "CCTV outside property",
            //             "CCTV in common areas",
            //             "24-hour security",
            //         ],
            //     },
            // ],
            popluarSearches: [
                {
                    id: 1,
                    name: "The palace house",
                    descp: "Frame970.png",
                    reviews: 30,
                    priceStart: "₹8000",
                    rating: 4.5,
                },
                {
                    id: 2,
                    name: "The palace house",
                    descp: "Frame970.png",
                    reviews: 30,
                    priceStart: "₹8000",
                    rating: 4.5,
                },
                {
                    id: 3,
                    name: "The palace house",
                    descp: "Frame970.png",
                    reviews: 30,
                    priceStart: "₹8000",
                    rating: 4.5,
                },
                {
                    id: 4,
                    name: "The palace house",
                    descp: "Frame970.png",
                    reviews: 30,
                    priceStart: "₹8000",
                    rating: 4.5,
                },
            ],
            submitReview: {
                rating: 5,
                title: null,
                description: null,
                keywords: null,
            },
            submitLead: {
                name: null,
                phone_num: null,
                email: null,
                date: null,
                no_of_guests: null,
                party_area: null,
                event_time: null,
            },
            defaultReviews: [
                {
                    id: "a",
                    name: "Aman",
                    title: "Best in the Market",
                    rating: 5,
                    discription: "Very goof venue.",
                    time: "2 days ago",
                },
                {
                    id: "b",
                    name: "Aman",
                    title: "Best in the Market",
                    rating: 5,
                    discription: "Very goof venue.",
                    time: "2 days ago",
                },
                {
                    id: "c",
                    name: "Aman",
                    title: "Best in the Market",
                    rating: 5,
                    discription: "Very goof venue.",
                    time: "2 days ago",
                },
                {
                    id: "d",
                    name: "Aman",
                    title: "Best in the Market",
                    rating: 5,
                    discription: "Very goof venue.",
                    time: "2 days ago",
                },
                {
                    id: "e",
                    name: "Aman",
                    title: "Best in the Market",
                    rating: 5,
                    discription: "Very goof venue.",
                    time: "2 days ago",
                },
                {
                    id: "f",
                    name: "Aman",
                    title: "Best in the Market",
                    rating: 5,
                    discription: "Very goof venue.",
                    time: "2 days ago",
                },
            ],
            reviews: null,
            logginFirst: null,
            cont: null,
            message: null,
            leadMessage: null,
            showForm: null,
            invites: null,
        };
    },
    methods: {
        finalizeVendor(e) {
            let _this = this;
            let formData = new FormData();
            let data = JSON.stringify(this.finalInvi);
            let venueId = this.venueDetails.id;
            formData.append("type", "finalize");
            formData.append("vendor", "venue");
            formData.append("title", "Venues");
            formData.append("data", data);
            formData.append("venue", venueId);
            axios
                .post("/api/vendor/addvenue", formData)
                .then(function (response) {
                    console.log(response);
                    _this.showForm = false;
                    _this.message = "Vendor Finalized";
                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                    console.log(_this.message);
                })
                .catch((errors) => {
                    console.log(errors);
                });
        },
        submitreview(e) {
            var _this = this;
            if (this.logged == "") {
                this.message = "Log in  as host First";
                setTimeout(function () {
                    _this.message = null;
                }, 3000);
                return;
            }
            let ownerId = JSON.parse(_this.owner).id;
            this.logginFirst = null;
            let user = JSON.parse(this.logged);

            axios
                .post(`/api/vendor/review`, [
                    _this.submitReview,
                    _this.vendorCategory.id,
                    _this.venueDetails.id,
                    ownerId,
                    "Venue",
                    user,
                ])
                .then(function (response) {
                    //_this.getReviews();
                    _this.reviews.unshift(response.data);
                    _this.submitReview.title = null;
                    _this.submitReview.description = null;
                    _this.submitReview.keywords = null;
                    _this.message = "Review Submitted";
                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                    const customRate =
                        document.querySelectorAll(".custom-rate > i");
                    customRate.forEach(function (item) {
                        console.log(item);
                        if (item.classList.contains("far")) {
                            item.classList.remove("far");
                            item.classList.add("fas");
                        }
                    });
                    $("");
                    _this.cont.destroy();

                    var element = _this.$refs["reviewCont"];
                    setTimeout(function () {
                        element.scrollIntoView(true);
                        _this.cont.mount();
                    }, 100);
                })
                .catch((error) => {
                    console.log(error.response.data.errors);
                });
        },
        submitlead(e) {
            var _this = this;
            if (this.logged == "") {
                this.leadMessage = "Log in  as host First";
                setTimeout(function () {
                    _this.leadMessage = null;
                }, 3000);
                return;
            }
            let ownerId = JSON.parse(_this.owner).id;
            this.logginFirst = null;
            let user = JSON.parse(this.logged);
            _this.submitLead.date = _this.date;

            axios
                .post(`/api/vendor/lead`, [
                    _this.submitLead,
                    _this.vendorCategory.id,
                    _this.venueDetails.id,
                    ownerId,
                    "Venue",
                    user,
                ])
                .then(function (response) {
                    //_this.getReviews();
                    for (const key in _this.submitLead) {
                        _this.submitLead[key] = null;
                    }
                    _this.hidden = false;
                    _this.message = "Lead Submitted";
                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                    // var element = _this.$refs["reviewCont"];
                    // setTimeout(function () {
                    //     element.scrollIntoView(true);
                    //     _this.cont.mount();
                    // }, 100);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        toggleRating(e) {
            const customRate = document.querySelectorAll(".custom-rate > i");
            // console.log(indexOf(item));
            let stars = e.currentTarget;
            var clicked = Array.from(customRate).indexOf(stars);
            // console.log(clicked)
            if (stars.classList.contains("fas")) {
                for (let i = clicked + 1; i <= 4; i++) {
                    customRate.item(i).classList.remove("fas");
                    customRate.item(i).classList.add("far");
                }
            } else {
                for (let j = 0; j <= clicked; j++) {
                    customRate.item(j).classList.remove("far");
                    customRate.item(j).classList.add("fas");
                }
            }
            this.submitReview.rating = clicked + 1;
            // console.log(rate.item(clicked));
        },
        tooglePortfolio(e) {
            let jsTab = document.querySelector(".jsTab").children;
            let jsNav = document.querySelector(".jsNav").children;

            let clicked = e.currentTarget.dataset.id;
            for (let i = 0; i < jsTab.length; i++) {
                jsTab[i].classList.add("jsTabHide");
            }
            // jsTab.forEach(function (index, item) {
            //     index.classList.add("jsTabHide");
            // });
            for (let j = 0; j < jsTab.length; j++) {
                jsNav[j].classList.remove("wed-venue-port-head-active");
            }
            // jsNav.forEach(function (index, item) {
            //     index.classList.remove("wed-venue-port-head-active");
            // });
            document.querySelector("#" + clicked).classList.remove("jsTabHide");
            e.currentTarget.classList.add("wed-venue-port-head-active");
        },
        // resizeGridItem(item) {
        //     let grid = document.getElementsByClassName("grid")[0];
        //     let rowHeight = parseInt("20px");
        //     let rowGap = parseInt(
        //         window.getComputedStyle(grid).getPropertyValue("grid-row-gap")
        //     );
        //     let rowSpan = Math.ceil(
        //         (item.querySelector(".content").getBoundingClientRect().height +
        //             rowGap) /
        //             (rowHeight + rowGap)
        //     );
        //     item.style.gridRowEnd = "span " + rowSpan;
        // },
        // resizeAllGridItems() {
        //     let allItems = document.getElementsByClassName("item");
        //     let x = null;
        //     for (x = 0; x < allItems.length; x++) {
        //         this.resizeGridItem(allItems[x]);
        //     }
        // },

        recenterButton() {
            // Set CSS for the control border.
            const controlUI = document.createElement("div");
            const controlDiv = document.createElement("div");
            controlUI.style.backgroundColor = "#fff";
            controlUI.style.border = "2px solid #fff";
            controlUI.style.borderRadius = "3px";
            controlUI.style.boxShadow = "0 2px 6px rgba(0,0,0,.3)";
            controlUI.style.cursor = "pointer";
            controlUI.style.marginTop = "8px";
            controlUI.style.marginBottom = "22px";
            controlUI.style.textAlign = "center";
            controlUI.title = "Click to recenter the map";
            controlDiv.appendChild(controlUI);

            // Set CSS for the control interior.
            const controlText = document.createElement("div");

            controlText.style.color = "rgb(25,25,25)";
            controlText.style.fontFamily = "Roboto,Arial,sans-serif";
            controlText.style.fontSize = "16px";
            controlText.style.lineHeight = "38px";
            controlText.style.paddingLeft = "5px";
            controlText.style.paddingRight = "5px";
            controlText.innerHTML = "Center Map";
            controlUI.appendChild(controlText);
            // Setup the click event listeners: simply set the map to Chicago.
            let map = this.$refs.mapRef.$mapObject;
            let _this = this;
            controlUI.addEventListener("click", () => {
                map.setCenter(_this.position);
            });

            map.controls[google.maps.ControlPosition.TOP_CENTER].push(
                controlDiv
            );
        },
        selectArea(e) {
            e.currentTarget.firstElementChild.firstElementChild.setAttribute(
                "selected",
                true
            );
            let txt = e.currentTarget.firstElementChild.children[1].textContent;
            document.querySelector("#areaHead").textContent = txt;
        },
        checkDayTime(e) {
            let _this = this;
            let to = $(
                ".vendor-venue-query-daytime > label >span:nth-child(2)"
            );
            to.each(function (item, index) {
                index.style.backgroundColor = "";
                index.style.border = "";
                // index.previousElementSibling.setAttribute("checked", false);
                //console.log(this.submitLead.event_time);
            });
            //e.currentTarget.firstElementChild.setAttribute("checked", true);

            e.currentTarget.children[1].style.backgroundColor = " #C4456F";
            e.currentTarget.children[1].style.border = "1px solid #EEBFCE";
            //e.currentTarget.children[0].checked = true;
        },
        getReviews() {
            var _this = this;
            axios
                .get(`/api/vendor/review/${_this.venueDetails.id}?cat=Venue`)
                .then(function (response) {
                    _this.reviews = response.data.reverse();
                    setTimeout(function () {
                        _this.showReviews();
                    }, 300);
                })
                .catch((errors) => {});
        },
        showReviews() {
            this.cont = new Splide("#testimonial-splide", {
                type: "slide",
                fixedWidth: "255px",
                perMove: 1,
                gap: "3em",
                drag: true,
                arrows: true,
                trimSpace: true,
                pagination: false,
                isNavigation: true,
            });
            this.cont.mount();
        },
        hideSections() {
            let location = window.location.pathname.substring(1);
            let path = location.substring(0, location.indexOf("/"));
            if (this.vendor != null) {
                //$("#hideVen :submit").attr("disabled", true);
                // $("#hideVen :input").attr("disabled", true);
                $(".wed-venue-rating :input").attr("disabled", true);
                // console.log($(".vendor-add-room-form-popup"));
                $(".vendor-add-room-form-popup :input").attr("disabled", true);
            }
            if (path == "directory") {
                if (this.logged == "") {
                    $(".wed-venue-rating")
                        .children()
                        .eq(1)
                        .css("display", "none");
                }
            }
        },
        getFinalInvites() {
            var _this = this;
            let id = null;
            if (this.logged != "" && this.logged != null) {
                id = JSON.parse(_this.logged).id;
            } else {
                return;
            }
            axios
                .get(
                    `/api/vendor/addvenue/${id}?venueid=${_this.venueDetails.id}`
                )
                .then(function (response) {
                    _this.finalInvi = response.data;
                })
                .catch((errors) => {});
        },
    },
    mounted() {
        document.onreadystatechange = () => {
            if (document.readyState == "complete") {
                this.recenterButton();
                this.getFinalInvites();
                this.showReviews();
                this.getReviews();
                this.hideSections();
                if (this.inivitations != "" || this.inivitations != null) {
                    this.invites = JSON.parse(this.inivitations);
                }
                // if (this.finalInvite != "" || this.finalInvite != null) {
                //     this.finalInvi = JSON.parse(this.finalInvite);
                // }
            }
        };
        //this.showReviews();

        // this.$nextTick(function () {
        //     window.addEventListener("resize", this.resizeAllGridItems);
        // });
    },
};
// document.addEventListener("DOMContentLoaded", function () {
//     let cont = new Splide("#testimonial-splide", {
//         type: "slide",
//         fixedWidth: "255px",
//         perMove: 1,
//         gap: "3em",
//         drag: true,
//         arrows: true,
//         trimSpace: true,
//         pagination: "false",
//         isNavigation: true,
//     });
//     cont.mount();
// });
</script>

<style scoped>
/* overlay form */

.overlay-form {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow-y: auto;
    background-color: rgba(0, 0, 0, 0.4);
    z-index: 999;
}
.task-form-emp {
    width: max-content;
    background-color: #fafafa;
    margin: 12% auto;
    padding: 3em;
    border-radius: 15px;
    box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
}
.task-form-emp label {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 600;
    font-size: 17px;
    line-height: 49px;
    color: #000000;
}

/* overlay form */
.wed-ven-single-head {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
    align-items: center;
}
.wed-ven-single-head > div:nth-child(1) > p:nth-child(1) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 600;
    font-size: 25.3238px;
    line-height: 38px;
    margin-bottom: 0;
    color: #461952;
}
.wed-ven-single-head > div:nth-child(1) > p:nth-child(2) {
    font-family: "Segoe UI";
    font-style: normal;
    font-weight: 400;
    font-size: 12.3637px;
    line-height: 16px;
    color: #461952;
}
.wed-ven-single-head > div:nth-child(2) button {
    outline: none;
    border: none;
    font-family: "Roboto";
    font-style: normal;
    font-weight: 500;
    font-size: 14.0958px;
    line-height: 17px;
    display: flex;
    align-items: center;
    text-align: center;
    color: #ffffff;
    background: #461952;
    border-radius: 4.69859px;
    margin: 0px 4.69859px;
    padding: 10px 27px;
}
.wed-ven-single-head > div:nth-child(2) button:nth-child(2) {
    background: #ffffff;
    color: #461952;
    padding: 10px 30px;
}
.wed-ven-single-mainImg {
    position: relative;
    padding-top: 40%;
}
.wed-ven-single-mainImg > img {
    border-radius: 15px;
    width: 100%;
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    object-fit: cover;
}
.wed-ven-single-mainImg > div:nth-child(2) {
    position: absolute;
    top: 30px;
    right: 30px;
}
.wed-ven-single-mainImg > div:nth-child(3) {
    position: absolute;
    top: 30px;
    left: 30px;
    z-index: 999;
}
.wed-ven-single-mainImg > div:nth-child(3) img {
    margin-right: 10px;
}
.wed-ven-single-mainImg button {
    border: none;
    outline: none;
    background-color: transparent;
}
.wed-ven-single-aboutcontent > div:nth-child(1) > div:nth-child(1) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 800;
    font-size: 23.4321px;
    line-height: 35px;
    color: #000000;
    margin: 15px 0;
}
.wed-ven-single-aboutcontent > div:nth-child(1) > div:nth-child(2) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 13.6796px;
    line-height: 21px;
    color: #525252;
}
.wed-ven-single-about-info {
    width: 40%;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
}
.wed-ven-single-about-info > div {
    background: rgba(248, 248, 248, 0.6);
    backdrop-filter: blur(10px);
    padding: 28px 35px;
    width: 80%;
    margin-bottom: 1em;
    text-align: center;
}
.wed-ven-single-about-info > div:nth-child(1) > p {
    font-family: "Segoe UI";
    font-style: normal;
    font-weight: 600;
    font-size: 17.7054px;
    line-height: 24px;
    color: #6b6b6b;
    text-align: center;
    margin-bottom: 10px;
}
.wed-ven-single-about-info > div:nth-child(1) img {
    margin-right: 10px;
}
.wed-ven-single-about-info > div:nth-child(1) > p:nth-child(1) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 12.587px;
    line-height: 19px;
    text-align: center;
    color: #461952;
}
.wed-ven-single-about-info > div:nth-child(1) > div > button {
    outline: none;
    border: none;
    background: #c4456f;
    border-radius: 5px;
    font-family: "Segoe UI";
    font-style: normal;
    font-weight: 600;
    font-size: 14.4874px;
    line-height: 19px;
    color: #ffffff;
    padding: 14px 60px;
    margin: auto;
}

.wed-ven-single-about-info > div:nth-child(2) > h3 {
    text-align: center;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 15.5948px;
    line-height: 23px;

    color: #461952;
}
.wed-ven-single-about-info > div:nth-child(2) > div > h4 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 15.078px;
    line-height: 23px;
    padding-bottom: 0;
    margin-bottom: 12px;
    margin-top: 12px;
    color: #c4456f;
}
.wed-ven-single-about-info > div:nth-child(2) > div > p {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 11.6932px;
    line-height: 18px;
    padding-bottom: 0;
    margin-bottom: 5px;
    color: #6b6b6b;
}

/* section-3 (gallery) CSS starts */

.wed-venue-port {
    background-image: url("/assets/vendors/accomodations/Rectangle148.png");
    background-color: white;
    background-repeat: no-repeat;
    background-size: cover;
    padding: 2em 0;
}

.wed-venue-port-head {
    font-family: Segoe UI;
    font-style: normal;
    font-weight: normal;
    font-size: 16.1994px;
    line-height: 22px;
    color: #6f747d;
    display: flex;
    width: 30%;
    margin: auto;
    justify-content: space-between;
    padding: 3em 0;
}

.wed-venue-port-head-active {
    padding-bottom: 4px;
    font-family: Segoe UI;
    font-style: normal;
    font-weight: 600;
    font-size: 16.1994px;
    line-height: 22px;
    color: #ffffff;
    border-bottom: 2px solid white;
}

.wed-venue-port-items {
    background-color: #ffffff;
    width: 70%;
    margin: auto;
    padding: 19px 23px;
    min-height: 700px;
}

.wed-venue-port-items > div {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 300px));
    grid-row-gap: 25px;
    grid-column-gap: 25px;
    overflow: hidden;
    /* opacity: 1;
    height: 100%;
    transition: height 0s ,opacity 0.5s linear; */
    visibility: visible;
    opacity: 1;
    transition: all 0.5s linear;
}
.wed-venue-port-items > div > div {
    position: relative;
    padding-top: 100%;
}
.wed-venue-port-items > div > div > img {
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
}
.wed-venue-port-items > div > div > video {
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
}
.wed-venue-port-all {
    outline: none;
    background-color: inherit;
    border: 1.5px solid #c4456f;
    width: max-content;
    display: block;
    margin: 2em auto;
    border-radius: 50px;
    padding: 5px 32px;
}
.jsTabHide {
    /* height: 0 !important;
    opacity: 0 !important;
    display: none !important; */
    visibility: hidden !important;
    opacity: 0 !important;
    max-height: 0 !important;
}

/* section-3 (gallery) CSS end */

.acc-facilites-cont {
    margin: 1em auto;
    display: grid;
    grid-template-columns: repeat(4, 25%);
    grid-gap: 10px;
}

.acc-facilites-cont > div > div {
    margin-bottom: 3em;
    height: max-content;
}

.acc-facilites-cont > h3 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 900;
    font-size: 21px;
    line-height: 32px;
    margin-bottom: 1em;
    padding-bottom: 0;
    color: #000000;
    width: 100%;
    grid-column-start: 1;
    grid-column-end: -1;
}
.acc-facilites-cont > div > div > div:nth-child(1) {
    margin-bottom: 1em;
}
.acc-facilites-cont > div > div > div:nth-child(2) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 15.078px;
    line-height: 23px;
    color: #000000;
}
.acc-facilites-cont > div > div > ul {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 15.078px;
    line-height: 23px;
    padding-left: 1ypx;

    color: #6b6b6b;
}
.acc-features-cont {
    margin: 1em auto;
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
    grid-template-rows: max-content;
    grid-column-gap: 10px;
    grid-row-gap: 20px;
    align-items: flex-start;
}
.acc-features-cont  img {
    width: 100%;
    height: 56px;
}
.acc-features-cont > ul {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 15.078px;
    line-height: 30px;
    padding-left: 17px;
    color: #525252;
    margin-bottom: 1em;
}
.acc-features-cont > h3 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 900;
    font-size: 21px;
    line-height: 32px;
    margin-bottom: 1em;
    padding-bottom: 0;
    color: #000000;
    width: 100%;
    margin-top: 1.5em;
    grid-column-start: 1;
    grid-column-end: -1;
}
.wed-acc-google-map > h3 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 900;
    font-size: 21px;
    line-height: 32px;
    margin-bottom: 1em;
    padding-bottom: 0;
    color: #000000;
    width: 100%;
}
.wed-acc-google-map > h3 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 21px;
    line-height: 32px;

    color: #000000;
}

/* section-6 (testimonials) CSS start */
.wed-venue-splide {
    margin-left: 3em;
    margin: 2em auto;
}
.wed-venue-splide > div:nth-child(1) {
    font-family: Roboto;
    font-style: normal;
    font-weight: bold;
    font-size: 24px;
    line-height: 26px;
    color: #c4456f;
}
.wed-venue-splide > div:nth-child(2) {
    font-family: Roboto;
    font-style: normal;
    font-weight: normal;
    font-size: 16px;
    line-height: 20px;
    color: #364667;
}
.wed-venue-splide > div:nth-child(3) {
    margin-top: 2em;
    padding-bottom: 2.5em;
    margin-bottom: 4em;
}
.wed-venue-testi {
    display: flex;
    flex-direction: column;
    padding: 1.5em;
    background-color: #ffffff;
    width: 255px;
    height: 100%;
}
.wed-venue-testi > div:nth-child(2) {
    font-family: Roboto;
    font-style: normal;
    font-weight: 500;
    font-size: 18px;
    line-height: 26px;
    color: #000000;
    margin-bottom: 0.3em;
}
.wed-venue-testi > div:nth-child(3) > img {
    margin: 2px;
    background: #c4456f;
}
.wed-venue-testi > div:nth-child(3) > span {
    font-family: Roboto;
    font-style: normal;
    font-weight: 300;
    font-size: 12px;
    line-height: 26px;
    color: #000000;
    padding-left: 5px;
}
.wed-venue-testi > div:nth-child(4) {
    font-family: Roboto;
    font-style: normal;
    font-weight: 300;
    font-size: 14px;
    line-height: 22px;
    color: #000000;
}
.wed-venue-testi > div:nth-child(5) {
    font-family: Roboto;
    font-style: normal;
    font-weight: bold;
    font-size: 14px;
    line-height: 22px;
    color: #000000;
}
/* section-6 (testimonials) CSS end */

/* section-6 (rating) CSS start */

.wed-venue-rating {
    width: 90%;
    margin: auto;
    display: grid;
    grid-template-columns: minmax(300px, 500px) minmax(350px, 700px);
    grid-column-gap: 7em;
    justify-content: space-between;
}

.rating-distribution > div {
    display: flex;
    justify-content: space-between;
}

.rating-distribution > div:nth-child(1) > div:nth-child(1) {
    font-family: Roboto;
    font-style: normal;
    font-weight: bold;
    font-size: 24px;
    line-height: 28px;
    color: #c4456f;
}
.rating-distribution > div:nth-child(1) > div:nth-child(2) {
    background: #2fa706;
    border-radius: 2.10938px;
    font-family: Roboto;
    font-style: normal;
    font-weight: 500;
    font-size: 18.683px;
    line-height: 22px;
    color: #ffffff;
    padding: 5px 7px;
}

.rating-distribution > div:nth-child(2) {
    margin-top: 1.5em;
    display: flex;
    flex-direction: column;
}
.rating-bar-box {
    display: flex;
    margin-bottom: 2.1em;
}
.rating-bar-box > div:nth-child(1) {
    font-family: Roboto;
    font-style: normal;
    font-weight: 500;
    font-size: 18.683px;
    line-height: 22px;
    color: #868686;
    align-self: center;
    width: 2em;
}

.rating-bar-box > div:nth-child(2) {
    background: linear-gradient(0deg, #ffffff, #ffffff),
        linear-gradient(0deg, #ffffff, #ffffff), #ffffff;
    border-radius: 100px;
    margin: auto 1em;
    height: 1em;
    width: 75%;
}
.rating-bar-box > div:nth-child(3) {
    font-family: Roboto;
    font-style: normal;
    font-weight: 500;
    font-size: 11.412px;
    line-height: 13px;
    color: #868686;
    align-self: center;
    width: 5em;
}
.rating-percent {
    width: 70%;
    background-color: #2fa706;
    border-radius: 100px;
    height: 100%;
}
.form-rating {
    position: relative;
}
.rate {
    display: none;
}
.custom-rate {
    color: #fed21e;
    font-size: 30px;
}
.rating-form {
    display: flex;
    flex-direction: column;
    position: relative;
}
.rating-form label {
    font-family: Roboto;
    font-style: normal;
    font-weight: 500;
    font-size: 20.4931px;
    line-height: 24px;
    color: #000000;
    padding: 0.7em 0;
}
.rating-form input {
    outline: none;
    background-color: inherit;
    border: none;
    border-bottom: 1.62771px solid #b5b5b5;
    padding-right: 4em;
}
.rating-form input::placeholder {
    font-family: Roboto;
    font-style: normal;
    font-weight: 500;
    font-size: 12.4666px;
    line-height: 15px;
    color: #b5b5b5;
}
.rating-form > span {
    position: absolute;
    bottom: 0;
    right: 0;
    padding: 0 10px 5px 0;
    font-family: Roboto;
    font-style: normal;
    font-weight: 500;
    font-size: 12.4666px;
    line-height: 15px;
    color: #b5b5b5;
}

.wed-venue-rating form > button {
    font-family: Roboto;
    font-style: normal;
    font-weight: 500;
    font-size: 13.6996px;
    line-height: 16px;
    color: #ffffff;
    background: #c4456f;
    border: 1.15196px solid #c4456f;
    border-radius: 38.3986px;
    padding: 0.7em 2.5em;
    margin-top: 3em;
}

/* section-6 (rating) CSS start */
.wed-ven-featured > h1 {
    font-family: "Segoe UI";
    font-style: normal;
    font-weight: 600;
    font-size: 25px;
    line-height: 33px;

    color: #000000;
}
.wed-venue-items {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 200px));
    grid-template-rows: max-content;
    grid-column-gap: 10px;
    grid-row-gap: 20px;
    padding: 20px;
    justify-content: space-between;
}

.wed-venue-items > a {
    text-decoration: none;
    color: inherit;
}

.wed-venue-items > a > div {
    position: relative;
}

.wed-venue-items > a > div > img {
    width: 100%;
    border-radius: 14.6552px;
}

.wed-venue-items-desc {
    background-color: #ffffff;
    background: #ffffff;
    border: 0.146552px solid #000000;
    border-radius: 14.6552px;
    padding: 10px;
    position: absolute;
    bottom: 0;
    width: 100%;
}

.wed-venue-items-desc > div {
    display: flex;
    justify-content: space-between;
    margin: 4px 0;
}

.wed-venue-items-desc > div > div:nth-child(1) {
    font-family: Segoe UI;
    font-style: normal;
    font-weight: normal;
    font-size: 14.6552px;
    line-height: 19px;
    color: #000000;
    align-self: center;
}

.wed-venue-items-desc > div > div:nth-child(2) > div:nth-child(1) {
    font-family: Inter;
    font-style: normal;
    font-weight: 600;
    font-size: 6.74138px;
    line-height: 8px;
    text-align: center;
    color: #ffffff;
    background: #461952;
    padding: 8px 13px;
}

.wed-venue-items-desc > div > div:nth-child(2) > div:nth-child(2) {
    background: #7fd926;
    height: inherit;
    padding: 0 8px;
}

.wed-venue-items-desc > div:nth-child(2) > p {
    font-family: Segoe UI;
    font-style: normal;
    font-weight: 350;
    font-size: 10.9914px;
    line-height: 15px;
    color: #a79c9c;
    margin: 0;
}

.wed-venue-items-price {
    display: flex;
    justify-content: space-between;
    background-color: #ffffff;
    border-radius: 14.6552px;
    padding: 10px;
    border: 0.146552px solid #000000;
}
.wed-venue-items-price > div:nth-child(1) > div {
    font-family: "Segoe UI";
    font-style: normal;
    font-weight: 350;
    font-size: 10.9914px;
    line-height: 15px;
    color: #a79c9c;
    display: flex;
    flex-wrap: wrap;
}
.wed-venue-items-price > div:nth-child(1) span {
    background: #f8f8f8;
    border-radius: 2px;
    font-family: "Segoe UI";
    font-style: normal;
    font-weight: 400;
    font-size: 7.50205px;
    line-height: 10px;
    color: #404040;
    padding: 10px 5px;
    margin: 5px 0;
    margin-right: 10px;
}
.priceperplatetype {
    font-family: "Segoe UI";
    font-style: normal;
    font-weight: 350;
    font-size: 9px;
    line-height: 12px;
    color: #a79c9c;
    margin-bottom: 5px;
}
.priceperplate {
    font-family: "Segoe UI";
    font-style: normal;
    font-weight: 700;
    font-size: 14.2888px;
    line-height: 19px;
    color: #461952;
    margin-bottom: 5px;
}
.priceperplate > span {
    font-size: 10.9914px;
}

/* add room form css start */
.vendor-add-room-form-popup {
    padding: 15px 27px;
    background: #ffffff;
    border-radius: 6px;
    position: fixed;
    top: 10%;
    left: 30%;
    width: 40%;
    overflow-y: scroll;
    height: 70vh;
}
.vendor-add-room-form-popup > div:nth-child(1) {
    display: flex;
    justify-content: space-between;
    border-bottom: 0.5px solid #c9c9c9;
}
.vendor-add-room-form-popup > div:nth-child(1) > span {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 600;
    font-size: 15.8559px;
    line-height: 24px;
    text-transform: uppercase;
    color: #333333;
}
.vendor-add-room-form-popup > div:nth-child(1) > button {
    outline: none;
    border: none;
    background-color: inherit;
}
.vendor-add-room-form-popup > div:nth-child(2) > input,
.dte {
    border: 0.2px solid #959595;
    box-sizing: border-box;
    border-radius: 5px;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 12.652px;
    line-height: 19px;
    color: #8b8b8b;
    margin: 5px 0;
    padding: 17px 5px;
    padding-left: 25px;
    background-color: transparent !important;
    width: 100%;
}
.vendor-add-room-form-popup > div:nth-child(2) > div > div:nth-child(1) {
    border: 0.2px solid #959595;
    box-sizing: border-box;
    border-radius: 5px;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 12.652px;
    line-height: 19px;
    color: #8b8b8b;
    margin: 5px 0;
    padding: 17px 5px;
    padding-left: 25px;
    background-color: transparent !important;
    width: 100%;
}
.radioboxcont {
    display: flex;
    background: #f8f8f8;
    border: 0.2px solid #959595;
    box-sizing: border-box;
    border-radius: 0px 0px 10px 10px;
    flex-direction: column;
    margin-top: -8px;
}
.radioboxcont > div {
    width: 100%;
}
.radioboxcont > div > label {
    width: 100%;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 300;
    font-size: 12px;
    line-height: 18px;
    border-bottom: 0.2px solid #959595;
    color: #959595;
    display: flex;
    padding: 12px;
    width: 100%;
    cursor: pointer;
}
.radioboxcont > div > label > input {
    width: 40px;
}
.vendor-add-room-form-popup > div:nth-child(2) input::placeholder {
    color: black;
}

.vendor-add-room-form-popup > div:nth-child(4) > button:nth-child(1) {
    background: #c4456f;
    border-radius: 6px;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 12px;
    line-height: 18px;
    text-align: center;
    color: #ffffff;
    outline: none;
    padding: 15px 15px;
    border: none;
    width: 100%;
    margin-top: 1em;
}
.vendor-venue-query-daytime {
    display: flex;
    margin: 1em 0;
}
.vendor-venue-query-daytime > label {
    flex: 1;
    text-align: center;
}
.vendor-venue-query-daytime > label > input {
    opacity: 0;
}
.vendor-venue-query-daytime > label > span:nth-child(2) {
    border: 0.617089px solid #848484;
    box-sizing: border-box;
    width: 10px;
    height: 10px;
    margin-right: 10px;
    display: inline-block;
    border-radius: 50%;
}
.vendor-venue-query-daytime > label > span:nth-child(3) {
    font-family: "Inter";
    font-style: normal;
    font-weight: 800;
    font-size: 12.3418px;
    line-height: 10px;
    color: #000000;
}
</style>
