<template>
    <div>
        <div class="ven-land-main-cont">
            <section class="wed-ven-main">
                <div style="position: relative">
                    <img
                        src="/assets/vendors/accomodations/mainBack.png"
                        alt="main_img"
                    />
                    <div
                        style="
                            background: rgba(70, 25, 82, 0.6);
                            width: 100%;
                            height: 100%;
                            position: absolute;
                            top: 0%;
                        "
                    ></div>
                </div>
                <div class="wed-ven-main-search">
                    <p>For a unique love story</p>
                    <p>Find Beautiful & Affordable wedding Hotels In Town</p>
                    <div>
                        <form
                            action=""
                            style="
                                display: flex;
                                justify-content: space-around;
                                flex-wrap: wrap;
                            "
                            @submit.prevent="searchAcc($event)"
                        >
                            <!-- <select
                                id="states"
                                name="states"
                                required
                                v-model="search.city"
                            >
                                <option hidden disabled selected value></option>
                                <option
                                    v-for="(value, index) in district"
                                    :key="index"
                                    :value="value.id"
                                >
                                    {{ value.name }}
                                </option>
                            </select> -->

                            <label style="width: 50%" for="accstate">
                                <select
                                    name="accstate"
                                    id="accstate"
                                    required
                                    v-model="search.state"
                                    @change="getDistricts($event)"
                                >
                                    <option disabled selected value="">
                                        Select States
                                    </option>
                                    <option
                                        v-for="(item, index) in stateList"
                                        :key="index"
                                        :value="item"
                                    >
                                        {{ item }}
                                    </option>
                                </select>
                            </label>
                            <label style="width: 50%" for="accdistrict">
                                <select
                                    name="accdistrict"
                                    id="accdistrict"
                                    required
                                    v-model="search.city"
                                >
                                    <option
                                        v-if="hideDefaultOption"
                                        disabled
                                        selected
                                    >
                                        Select State First
                                    </option>
                                    <option v-else disabled selected>
                                        Select City
                                    </option>

                                    <option
                                        v-for="(item, index) in district"
                                        :key="index"
                                        :value="item.id"
                                    >
                                        {{ item.name }}
                                    </option>
                                </select>
                            </label>

                            <div>
                                <date-picker v-model="range" is-range>
                                    <template
                                        v-slot="{ inputValue, inputEvents }"
                                    >
                                        <div
                                            class="flex justify-center items-center date-pick-input"
                                        >
                                            <span>
                                                <img
                                                    src="/assets/vendors/accomodations/ant-design_calendar-outlined.svg"
                                                    alt=""
                                                    style="
                                                        width: 18px;
                                                        height: 18px;
                                                        background-color: white;
                                                        position: relative;
                                                        top: -2px;
                                                    "
                                                />
                                            </span>
                                            <input
                                                :value="inputValue.start"
                                                v-on="inputEvents.start"
                                                class="checkin-out"
                                                type="text"
                                                placeholder="Check in"
                                                required
                                            />
                                            <span style="margin-left: -18px"
                                                >-</span
                                            >
                                            <input
                                                :value="inputValue.end"
                                                v-on="inputEvents.start"
                                                class="checkin-out"
                                                type="text"
                                                required
                                                placeholder="Check out"
                                            />
                                        </div>
                                    </template>
                                </date-picker>
                            </div>

                            <div class="date-pick-input-dum">
                                <div
                                    style="cursor: pointer"
                                    @click.stop="roomMember = !roomMember"
                                >
                                    <span>
                                        <img
                                            src="/assets/vendors/accomodations/bi_person-fill.svg"
                                            alt=""
                                            style="
                                                width: 18px;
                                                height: 18px;
                                                background-color: white;
                                                position: relative;
                                                top: -2px;
                                            "
                                        />
                                    </span>
                                    <span style="width: 88%"
                                        >{{ search.adult }} Adults -
                                        {{ search.children }} Children -
                                        {{ search.rooms }} Rooms</span
                                    >
                                </div>
                                <div
                                    @click.stop
                                    v-if="roomMember"
                                    class="roomMembers-feilds"
                                >
                                    <div>
                                        <span> Adult </span>
                                        <span>
                                            <button
                                                @click="search.adult--"
                                                type="button"
                                            >
                                                -
                                            </button>
                                            <input
                                                type="number"
                                                v-model="search.adult"
                                            />
                                            <button
                                                @click="search.adult++"
                                                type="button"
                                            >
                                                +
                                            </button>
                                        </span>
                                    </div>
                                    <div>
                                        <span> Children </span>
                                        <span>
                                            <button
                                                @click="search.children--"
                                                type="button"
                                            >
                                                -
                                            </button>
                                            <input
                                                type="number"
                                                v-model="search.children"
                                            />
                                            <button
                                                @click="search.children++"
                                                type="button"
                                            >
                                                +
                                            </button>
                                        </span>
                                    </div>
                                    <div>
                                        <span> Rooms </span>
                                        <span>
                                            <button
                                                @click="search.rooms--"
                                                type="button"
                                            >
                                                -
                                            </button>
                                            <input
                                                type="number"
                                                v-model="search.rooms"
                                            />
                                            <button
                                                @click="search.rooms++"
                                                type="button"
                                            >
                                                +
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <button type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </section>

            <section class="wed-ven-featured container">
                <h1 style="margin-bottom: 2em">Search by type of Hotels</h1>
                <div>
                    <a
                        href=""
                        v-for="(item, index) in featuredCategory"
                        :key="index"
                    >
                        <div class="wed-ven-featured-items">
                            <img
                                src="/assets/vendors/landing/Frame911.png"
                                alt=""
                                width="100%"
                            />
                            <div>
                                <div class="wed-ven-subhead">
                                    {{ item.name }}
                                </div>

                                <div class="wed-ven-desc">
                                    <div>23 places found in chennai</div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </section>

            <section class="wed-ven-featured container">
                <h1 style="margin-bottom: 2em">Popular searches</h1>
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
                            <div>Starting from</div>
                            <div>
                                {{ item.priceStart }} <span>per day</span>
                            </div>
                        </div>
                    </a>
                </div>
            </section>

            <section class="wed-ven-testimonial">
                <div>
                    <div class="testimonial-1">Testimonials</div>
                </div>

                <div class="testimonials-cont">
                    <div>
                        <div
                            style="
                                display: flex;
                                justify-content: space-between;
                            "
                        >
                            <div style="flex: 1">
                                <div
                                    class="sec7-arrow"
                                    style="
                                        display: flex;
                                        justify-content: flex-end;
                                        height: 110px;
                                    "
                                >
                                    <div style="align-self: center">
                                        <button
                                            style="
                                                outline: none;
                                                border: none;
                                                background-color: inherit;
                                            "
                                            id="prev-btn"
                                            @click="prevTestimonial()"
                                        >
                                            <img
                                                src="/assets/vendors/landing/right.png"
                                                alt=""
                                            />
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div style="flex: 1">
                                <div
                                    style="
                                        display: flex;
                                        justify-content: center;
                                    "
                                >
                                    <img
                                        :src="
                                            '/assets/testimonials/' +
                                            showTestimonials().imageOne
                                        "
                                        alt=""
                                        id="person-img"
                                        style="
                                            width: 106px;
                                            height: 110px;
                                            border-radius: 50%;
                                        "
                                    />
                                </div>
                            </div>
                            <div style="flex: 1">
                                <div
                                    class="sec7-arrow"
                                    style="
                                        display: flex;
                                        justify-content: flex-start;
                                        height: 110px;
                                    "
                                >
                                    <div style="align-self: center">
                                        <button
                                            style="
                                                outline: none;
                                                border: none;
                                                background-color: inherit;
                                            "
                                            id="next-btn"
                                            @click="nextTestimonial()"
                                        >
                                            <img
                                                src="/assets/vendors/landing/left.png"
                                                alt=""
                                            />
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="testimonial-2">
                                    <span id="testimonial-name">{{
                                        showTestimonials().title
                                    }}</span>
                                    <!-- <span id="testimonial-prof">{{
                                        showTestimonials().profession
                                    }}</span> -->
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-10 col-md-5 m-auto">
                                <div
                                    class="testimonial-3"
                                    v-html="showTestimonials().body"
                                ></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- <footer id="main-foot" style="background: #461952">
                <div class="wed-host-footer">
                    <div>
                        <div class="wed-host-footer-sec-1">
                            <img
                                src="/assets/vendors/landing/logo.svg"
                                alt=""
                                srcset=""
                            />
                            <div>
                                Lorem ipsum dolor sit amet, consectetur
                                adipiscing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua. Ut
                                enim ad minim veniam, quis nostrud exercitation
                                ullamco laboris nisi ut aliquip ex ea commodo
                                consequat.
                            </div>
                        </div>
                        <div class="wed-host-footer-sec-2">
                            <div>
                                <h5>Services</h5>
                                <a href="">Terms of services</a>
                                <a href="">Custom field</a>
                                <a href="">Listing</a>
                                <a href="">Offline</a>
                            </div>
                            <div>
                                <h5>About</h5>
                                <a href="">Our Story</a>
                                <a href="">Benefits</a>
                                <a href="">Team</a>
                                <a href="">Sitemap</a>
                            </div>
                            <div>
                                <h5>Follow Us</h5>
                                <a href=""
                                    ><i class="fab fa-facebook-f"></i>
                                    Facebook</a
                                >
                                <a href=""
                                    ><i class="fab fa-twitter"></i> Twitter</a
                                >
                                <a href=""
                                    ><i class="fab fa-instagram"></i>
                                    Instagram</a
                                >
                            </div>
                        </div>
                    </div>
                    <div class="wed-host-footer-sec-3">
                        <div>
                            Copyright © 2021. Happywed. All rights reserved.
                        </div>
                        <div>
                            <div style="margin-right: 1em">
                                Terms & Conditions
                            </div>
                            <div>Privacy Policy</div>
                        </div>
                    </div>
                </div>
            </footer>

            <div
                id="mobile-foot"
                class="section11"
                style="
                    background-color: rgb(70, 25, 82);
                    display: none;
                    padding: 40px 0;
                "
            >
                <div class="row">
                    <div class="m-auto col-10">
                        <div class="foot-drop" @click="footer_open($event)">
                            <span
                                class="mobile-foot-heading"
                                style="margin: auto"
                            >
                                SERVICES
                            </span>
                            <i
                                class="fas fa-chevron-down"
                                style="position: absolute; right: 18px"
                            ></i>
                        </div>
                        <div class="mobile-foot1" id="footer-open">
                            <div>
                                <a href="" class="link-css"
                                    >Terms of services</a
                                >
                            </div>
                            <div>
                                <a href="" class="link-css">Custom feild</a>
                            </div>
                            <div><a href="" class="link-css">Listing</a></div>
                            <div><a href="" class="link-css">Offline</a></div>
                        </div>

                        <hr
                            style="
                                background: #ffffff;
                                mix-blend-mode: normal;
                                opacity: 0.1;
                                margin-top: 0 !important;
                                margin-bottom: 22px;
                            "
                        />
                    </div>
                </div>
                <div class="row">
                    <div class="m-auto col-10">
                        <div class="foot-drop" @click="footer_open($event)">
                            <span
                                class="mobile-foot-heading"
                                style="margin: auto"
                            >
                                ABOUT
                            </span>
                            <i
                                class="fas fa-chevron-down"
                                style="position: absolute; right: 18px"
                            ></i>
                        </div>
                        <div class="mobile-foot1" id="footer-open">
                            <div><a href="" class="link-css">Our Story</a></div>
                            <div><a href="" class="link-css">Benefits</a></div>
                            <div><a href="" class="link-css">Teams</a></div>
                            <div><a href="" class="link-css">Sitemap</a></div>
                        </div>
                        <hr
                            style="
                                background: #ffffff;
                                mix-blend-mode: normal;
                                opacity: 0.1;
                                margin-top: 0 !important;
                                margin-bottom: 22px;
                            "
                        />
                    </div>
                </div>
                <div class="row">
                    <div class="m-auto col-10">
                        <div class="foot-drop" @click="footer_open($event)">
                            <span
                                class="mobile-foot-heading"
                                style="margin: auto"
                            >
                                FOLLOW US
                            </span>
                            <i
                                class="fas fa-chevron-down"
                                style="position: absolute; right: 18px"
                            ></i>
                        </div>
                        <div class="mobile-foot1" id="footer-open">
                            <div>
                                <a href="" class="link-css"
                                    ><i class="fab fa-facebook-f"></i
                                    >Facebook</a
                                >
                            </div>
                            <div>
                                <a href="" class="link-css"
                                    ><i class="fab fa-twitter"></i>Twitter</a
                                >
                            </div>
                            <div>
                                <a href="" class="link-css"
                                    ><i class="fab fa-instagram"></i
                                    >Instagram</a
                                >
                            </div>
                        </div>
                        <hr
                            style="
                                background: #ffffff;
                                mix-blend-mode: normal;
                                opacity: 0.1;
                                margin-top: 0 !important;
                                margin-bottom: 22px;
                            "
                        />
                    </div>
                </div>
                <div class="row">
                    <div class="m-auto col-10 d-flex justify-content-center">
                        <img src="/assets/vendors/landing/logo.svg" alt="" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-10 text-center mobile-foot2">
                        Subscribe to Happywedding and stay updated with the
                        latest updates
                    </div>
                </div>
                <div class="row">
                    <div class="m-auto col-10">
                        <div
                            style="
                                display: flex;
                                justify-content: space-between;
                            "
                        >
                            <div
                                class="footer-last1"
                                style="margin-right: 34.67px"
                            >
                                <a class="link-css" href=""
                                    >Terms & Conditions</a
                                >
                            </div>
                            <div class="footer-last1">
                                <a class="link-css" href="">Privacy Policy</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-10 text-center mobile-foot2 mt-5 mb-0">
                        Copyright © 2021. Happywed. All rights reserved.
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</template>

<script>
import Calendar from "v-calendar/lib/components/calendar.umd";
import DatePicker from "v-calendar/lib/components/date-picker.umd";
import vClickOutside from "v-click-outside";

export default {
    name: "App",
    directives: {
        clickOutside: vClickOutside.directive,
    },
    components: {
        // CircleProgress: CircleProgress,
        Calendar,
        "date-picker": DatePicker,
        // Splide
    },
    props: ["states", "testimonials"],
    data() {
        return {
            range: {
                start: "Check in -",
                end: " Check out",
            },
            search: {
                city: "Select State First",
                state: "Select State",
                startDate: null,
                endDate: null,
                adult: 2,
                children: 2,
                rooms: 1,
            },
            hideDefaultOption: true,
            roomMember: false,
            locationMaster: JSON.parse(this.states),
            stateList: [],
            district: [],
            categories: null,
            featuredCategory: [
                {
                    id: 1,
                    name: "Mehendi Artists",
                    mainImg: "Frame911.png",
                },
                {
                    id: 2,
                    name: "Photographer",
                    mainImg: "Frame871.png",
                },
                {
                    id: 3,
                    name: "Band baja",
                    mainImg: "Frame881.png",
                },
                {
                    id: 4,
                    name: "Bridal makeup",
                    mainImg: "Frame899.png",
                },
            ],
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
            testimonialsCounter: 0,
            testimonialList: JSON.parse(this.testimonials),
        };
    },
    methods: {
        searchAcc() {
            // let startDate = this.search.startDate.toISOString().split("T")[0];
            // let endDate = this.search.endDate.toISOString().split("T")[0];
            let _this = this;
            if (typeof this.range.start != "string") {
                this.search.startDate = this.range.start;
                this.search.startDate = this.search.startDate
                    .toISOString()
                    .split("T")[0];
                this.search.endDate = this.range.end;
                this.search.endDate = this.search.endDate
                    .toISOString()
                    .split("T")[0];
            }
            setTimeout(function () {
                window.location.href = `/directory/vendors/accommodation/filtered?start=${_this.search.startDate}&end=${_this.search.endDate}&city=${_this.search.city}&state=${_this.search.state}&adults=${_this.search.adult}&children=${_this.search.children}&rooms=${_this.search.rooms}`;
            }, 500);
        },
        showTestimonials() {
            return this.testimonialList[this.testimonialsCounter];
        },
        nextTestimonial() {
            if (this.testimonialsCounter == this.testimonialList.length - 1) {
                this.testimonialsCounter = 0;
            } else {
                this.testimonialsCounter++;
            }
        },
        prevTestimonial() {
            if (this.testimonialsCounter == 0) {
                this.testimonialsCounter = this.testimonialList.length - 1;
            } else {
                this.testimonialsCounter--;
            }
        },
        footer_open(e) {
            document.querySelectorAll("#footer-open").forEach(function (item) {
                item.classList.remove("show-mobile-foot");
            });
            e.currentTarget.nextElementSibling.classList.toggle(
                "show-mobile-foot"
            );
        },
        showDatePicker(e) {
            e.currentTarget.style.display = "none";
            document.querySelector(".date-pick-input").style.display = "block";
        },
        // getDistricts() {
        //     let _this = this;
        //     //console.log("e");
        //     this.locationMaster.map(function (el) {
        //         _this.district.push({ id: el.id, name: el.name });
        //     });
        // },
        getStates() {
            var _this = this;
            axios
                .get(`/api/vendor/addacc`)
                .then(function (response) {
                    console.log(response);
                    _this.locationMaster = response.data[0];
                    _this.stateList = [
                        ...new Set(
                            _this.locationMaster.map((item) => item.state)
                        ),
                    ];
                })
                .catch((errors) => {
                    console.log("Get All: " + errors);
                });
        },
        getDistricts(e) {
            let _this = this;
            let val = e.currentTarget.value;

            _this.district = [];
            this.locationMaster.map(function (el) {
                if ('"' + el.state + '"' == '"' + val + '"') {
                    _this.district.push({ id: el.id, name: el.name });
                }
                _this.hideDefaultOption = false;
                _this.search.city = "Select City";
            });
        },
        windowClick() {
            this.roomMember = false;
        },
    },
    created: function () {
        window.addEventListener("click", this.windowClick);
    },
    mounted() {
        this.$nextTick(function () {
            this.getStates();
            axios.get("/wedding/vendorMasterList").then((response) => {
                this.categories = response.data;
                //let test = document.querySelectorAll(".wed-ven-cat-items");
                //console.log(test);
                //console.log(response.data);
            });
        });
    },
    computed: {
        date() {
            //let endDate = this.search.endDate.toISOString().split("T")[0];
            this.search.startDate = this.range.start;
            this.search.startDate = this.search.startDate
                .toISOString()
                .split("T")[0];
            this.search.endDate = this.range.end;
            this.search.endDate = this.search.endDate
                .toISOString()
                .split("T")[0];
        },
    },
};
</script>

<style scoped>
body {
    background-color: #efdee4ff;
}
/* Section-1(image and search) CSS start */
.wed-ven-main {
    position: relative;
    margin-bottom: 2em;
}
.wed-ven-main img {
    width: 100%;
}
.wed-ven-main > div:nth-child(2) {
    position: absolute;
    top: 50%;
}
.wed-ven-main-search {
    display: flex;
    flex-direction: column;
    width: 100%;
}
.wed-ven-main-search > p:nth-child(1) {
    font-family: "Rage Italic";
    font-style: italic;
    font-weight: normal;
    font-size: 18.1818px;
    line-height: 23px;
    color: #ffffff;
    text-align: center;
}
.wed-ven-main-search > p:nth-child(2) {
    font-family: Segoe UI;
    font-style: normal;
    font-weight: normal;
    font-size: 21.8182px;
    line-height: 29px;
    color: #ffffff;
    text-align: center;
    margin-bottom: 2em;
}
.wed-ven-main-search > div {
    background: rgba(255, 255, 255, 0.5);
    padding: 28px 23px;
    width: 58%;
    margin: auto;
}
.wed-ven-main-search > div > form > label > select {
    padding: 11px 0;
    padding-left: 22px;
    border: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    background: #ffffff;
    border-radius: 5px;
    border: none;
    background-color: white !important;
    background-image: url("/assets/vendors/landing/dropdown.svg");
    background-repeat: no-repeat;
    background-position: 98%;
    background-size: 20px;
    cursor: pointer;
    width: 80%;
    margin-bottom: 1em;
}
.wed-ven-main-search > div > form > label > select > option {
    font-family: Segoe UI;
    font-style: normal;
    font-weight: normal;
    font-size: 10px;
    line-height: 13px;
    color: #3d3838;
    background-color: white !important;
    cursor: pointer;
}

.wed-ven-main-search > div > form > button {
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
    color: #ffffff;
}

.checkin-out {
    background-color: #ffffff;
    border-radius: 5px;
    padding: 11px 0;
    padding-left: 11px;
    border: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: 5px;
    border: none;
    background-color: white !important;
    width: 100px;
    border: none;
    outline: 0;
}
.checkin-out::placeholder {
    color: black;
}

.date-pick-input-dum {
    width: 40%;
    position: relative;
}
.date-pick-input-dum > div:nth-child(1) > span {
    display: inline-block;
    background-color: white;
    padding: 11px;
    border-radius: 5px;
    margin-right: -10px;
}
.date-pick-input > span {
    display: inline-block;
    background-color: white;
    padding: 11px;
    border-radius: 5px;
    margin-right: -10px;
}

.roomMembers-feilds {
    background-color: white;
    padding: 18px 20px;
    border: 1px solid #cccccc;
    box-sizing: border-box;
    border-radius: 0px 0px 5px 5px;
    width: 96%;
    position: absolute;
}
.roomMembers-feilds > div {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
}

.roomMembers-feilds > div > span {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 12px;
    line-height: 20px;
    color: #262626;
    display: inline-block;
}
.roomMembers-feilds > div > span > button {
    outline: 0;
    border: 0.390625px solid #138ab3;
    color: #138ab3;
    background-color: transparent;
    width: 30px;
    height: 30px;
    font-size: 17px;
}
.roomMembers-feilds > div > span > input {
    background-color: white !important;
    border: none;
    outline: 0;
    width: 50px;
    text-align: center;
}
/* Section-1(image and search) CSS end */
/* wedding Venues Page Css start */

/* Section-1(search) CSS start */
.wed-venue-main {
    display: flex;
}
.wed-venue-main > div:nth-child(2) {
    width: 30%;
}
.wed-venue-search {
    padding: 20px 0 45px 25px;
    width: 70%;
    border-bottom: 1px solid #e1cfd6;
    transform: rotate(-0.03deg);
    position: relative;
}
.wed-venue-search > div:nth-child(1) {
    font-family: Segoe UI;
    font-style: normal;
    font-weight: normal;
    font-size: 13.6563px;
    line-height: 18px;
    color: #929090;
}
.wed-venue-search > div:nth-child(2) {
    font-family: Perpetua;
    font-style: normal;
    font-weight: bold;
    font-size: 25.7763px;
    line-height: 30px;
    color: #461952;
    padding: 10px 0;
}
.wed-venue-search .wed-ven-main-search > div {
    margin: 0;
    width: 100%;
}
/* Section-1(search) CSS end */

.wed-venue-items {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 200px));
    grid-template-rows: max-content;
    grid-column-gap: 10px;
    grid-row-gap: 20px;
    padding: 20px;
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

.wed-venue-items-price > div:nth-child(1) {
    font-family: "Segoe UI";
    font-style: normal;
    font-weight: 350;
    font-size: 10.9914px;
    line-height: 15px;
    color: #a79c9c;
}

.wed-venue-items-price > div:nth-child(2) {
    font-family: "Segoe UI";
    font-style: normal;
    font-weight: 700;
    font-size: 14.2888px;
    line-height: 19px;
    color: #461952;
}
.wed-venue-items-price > div:nth-child(2) > span {
    font-family: "Segoe UI";
    font-style: normal;
    font-weight: 350;
    font-size: 10.9914px;
    line-height: 15px;
    color: #a79c9c;
}
/* Section-3&4(vendor feaured and popular search) CSS start */
.wed-ven-featured {
    margin-bottom: 4em;
}
.wed-ven-featured > h1 {
    font-family: Segoe UI;
    font-style: normal;
    font-weight: 600;
    font-size: 25px;
    line-height: 33px;
    color: #461952;
}
.wed-ven-featured > div {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    grid-column-gap: 20px;
    grid-row-gap: 20px;
    justify-content: center;
}
.wed-ven-featured-items {
    border-radius: 16.737px;
    /* margin: 10px; */
    position: relative;
}
.wed-ven-featured-items > img {
    width: 100%;
    border-radius: 16px;
}
.wed-ven-featured-items > div {
    background: #ffffff;
    box-sizing: border-box;
    border-radius: 15px;
    position: absolute;
    padding: 10px;
    bottom: 0;
    width: 100%;
}
.wed-ven-subhead {
    font-family: Segoe UI;
    font-style: normal;
    font-weight: normal;
    font-size: 16.737px;
    line-height: 22px;
    color: #000000;
}
.wed-ven-desc {
    display: flex;
    justify-content: space-between;
    font-family: Segoe UI;
    font-style: normal;
    font-weight: normal;
    font-size: 9.99174px;
    line-height: 13px;
    text-align: center;
    color: #6c6c6c;
    margin-top: 10px;
}
.wed-ven-desc .wed-ven-cat-profile {
    margin: 0;
}
/* Section-3&4(vendor feaured and popular search) CSS end */

/* Section-5(testimonial) CSS start */
.wed-ven-testimonial {
    background-color: white;
    overflow-x: hidden;
}
.testimonial-1 {
    margin: 57px 0;
    font-family: Segoe UI;
    font-style: normal;
    font-weight: 600;
    font-size: 22.2222px;
    line-height: 30px;
    text-align: center;
    padding-top: 2em;
    color: #461952;
}
.testimonial-2 {
    margin-top: 14.86px;
    margin-bottom: 29.72px;
    font-family: Roboto;
    font-style: normal;
    font-weight: 300;
    font-size: 10.6667px;
    line-height: 13px;
    text-align: center;
    color: #000000;
}
.testimonial-3 {
    font-family: Segoe UI;
    font-style: italic;
    font-weight: 300;
    font-size: 17.7778px;
    line-height: 24px;
    text-align: center;
    margin-bottom: 48.94px;
    color: #000000;
}
/* Section-5(testimonial) CSS end */

/* footer css starts */
footer {
    margin-top: 3em;
    background: #000;
    color: #fff;
    /* padding: 140px 0 80px; */
    font-size: 15px;
    line-height: 20px;
}
footer a {
    color: #fff;
    text-decoration: none;
    font-size: 15px;
    line-height: 20px;
}
.wed-host-footer {
    width: 70%;
    display: flex;
    flex-direction: column;
    padding: 4em 0;
    margin: auto;
}

.wed-host-footer > div {
    display: flex;
}

.wed-host-footer-sec-1 {
    width: 30%;
}
.wed-host-footer-sec-2 {
    width: 70%;
    display: flex;
    justify-content: space-around;
}
.wed-host-footer-sec-2 > div {
    flex: 1;
}
.wed-host-footer-sec-1 > img {
    width: 103px;
    height: 41px;
    margin-bottom: 1em;
}
.wed-host-footer-sec-1 > div {
    font-family: DM Sans;
    font-style: normal;
    font-weight: normal;
    font-size: 13.3333px;
    line-height: 17px;
    letter-spacing: -0.181818px;
    color: #ffffff;
}

.wed-host-footer-sec-2 > div {
    display: flex;
    flex-direction: column;
    padding-left: 3.8em;
}

.wed-host-footer-sec-2 > div > h5 {
    font-family: DM Sans;
    font-style: normal;
    font-weight: normal;
    font-size: 15.1111px;
    line-height: 20px;
    letter-spacing: -0.206061px;
    color: #ffd2dd;
    margin-bottom: 1.2em;
}
.wed-host-footer-sec-2 > div > a {
    font-family: DM Sans;
    font-style: normal;
    font-weight: normal;
    font-size: 13.3333px;
    line-height: 17px;
    letter-spacing: -0.181818px;
    color: #ffffff;
    margin-bottom: 1em;
    text-decoration: none;
}
.wed-host-footer-sec-3 {
    margin-top: 4em;
    display: flex;
    justify-content: space-between;
    color: #ffffff;
    font-size: 15px;
    line-height: 20px;
}
.wed-host-footer-sec-3 > div:nth-child(2) {
    display: flex;
}
.section11 > div {
    margin-right: 18px !important;
}
/* host footer css star */
.foot-drop {
    padding-bottom: 1.5em;
    display: flex;
    justify-content: space-between;
    cursor: pointer;
}
.mobile-foot-heading {
    font-family: Segoe UI;
    font-style: normal;
    font-weight: normal;
    font-size: 12px;
    line-height: 16px;
    /* identical to box height */
    color: #ffffff;
}
.mobile-foot1 {
    margin: 28px auto 7px auto;
    display: none;
    align-items: center;
    flex-direction: column;
}

.show-mobile-foot {
    display: flex !important;
}

.mobile-foot1 > div {
    padding-bottom: 16px;
}
.mobile-foot1 > div > a {
    font-family: DM Sans;
    font-style: normal;
    font-weight: 500;
    font-size: 12.3175px;
    line-height: 16px;
    /* identical to box height */

    letter-spacing: -0.167965px;

    color: #ffffff;
}
.mobile-foot2 {
    font-family: DM Sans;
    font-style: normal;
    font-weight: normal;
    font-size: 15px;
    line-height: 20px;
    text-align: center;
    letter-spacing: -0.487197px;
    color: #ffffff;
    margin: 14px auto 55px auto;
}

@media only screen and (max-width: 992px) {
    .wed-venue-contact-info-desc > div:nth-child(2) {
        font-size: 23px !important;
    }
    .wed-venue-port {
        background-size: 200%;
    }
    .wed-venue-prod {
        padding: 3em 2em;
    }
    .wed-venue-prod-items {
        width: 90%;
    }
    .wed-venue-rating {
        grid-column-gap: 4em;
    }
}
@media only screen and (max-width: 768px) {
    #main-foot {
        display: none !important;
    }
    #mobile-foot {
        display: block !important;
    }
    .wed-venue-sidebar {
        display: none;
    }
    .wed-venue-content {
        display: block;
    }
    #sidebar-open {
        display: inline-block;
    }

    .wed-venue-contact {
        display: block;
    }
    .wed-venue-contact-info {
        padding: 0;
        margin: 2em 1.5em;
    }
    .wed-venue-contact-info-desc {
        padding: 1em;
    }
    .wed-venue-contact-info-details {
        width: max-content;
        margin: auto;
        padding-top: 0;
        margin-bottom: 3em;
    }

    .wed-venue-port-head {
        width: 70%;
    }
    .wed-venue-prod-items > div {
        /* grid-template-columns: minmax(120px , 500px) minmax(120px , 500px); */
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }
    .wed-venue-prod-items > div > div {
        flex: 150px 1 1;
        max-width: 250px;
    }

    .wed-venue-rating {
        display: block;
        width: 70%;
        margin: auto;
    }
}

@media only screen and (max-width: 576px) {
    .wed-venue-contact-info-desc > div:nth-child(2) {
        font-size: 15px !important;
    }
    .wed-venue-port-items > div {
        grid-template-columns: repeat(2, minmax(100px, 500px));
    }
    .wed-venue-port-items {
        width: 80%;
    }
    .wed-venue-rating {
        display: block;
        width: 90%;
        margin: auto;
    }
}

/* host footer css end */
</style>
