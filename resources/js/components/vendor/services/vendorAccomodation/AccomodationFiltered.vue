<template>
    <div>
        <section class="wed-venue-main">
            <div class="wed-venue-search">
                <div>Vendors / Wedding Venues</div>
                <div class="row">
                    <div class="col">Accomodation In Chennai</div>
                </div>
                <div class="wed-ven-main-search">
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
                                    @change="getDistricts($event, true)"
                                    v-model="search.state"
                                >
                                    <option disabled selected>
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
            </div>
            <div>
                <img
                    src="/assets/vendors/accomodations/accBackDiagonal.png"
                    alt=""
                    style="width: 100%; height: 100%"
                />
            </div>
        </section>
        <section class="wed-venue-content">
            <div class="wed-venue-sidebar">
                <div class="wed-venue-sidebar-menu">
                    <div @click="toggleFilterMenu($event)">
                        <span> Your budget (per night)</span>
                        <span>
                            <img src="/assets/icon-SVG/sidebararrow.svg" alt=""
                        /></span>
                    </div>
                    <form action="">
                        <div>
                            <input
                                type="radio"
                                id="₹50,000"
                                name="price"
                                value="₹50,000"
                            />
                            <label for="₹50,000"> >₹50,000</label>
                        </div>
                        <div>
                            <input
                                type="radio"
                                id="₹1,00,000-₹1,50,000"
                                name="price"
                                value="₹1,00,000-₹1,50,000"
                            />
                            <label for="₹1,00,000-₹1,50,000"
                                >₹1,00,000-₹1,50,000</label
                            >
                        </div>
                        <div>
                            <input
                                type="radio"
                                id="₹1,50,000-₹2,00,000"
                                name="price"
                                value="₹1,50,000-₹2,00,000"
                            />
                            <label for="₹1,50,000-₹2,00,000"
                                >₹1,50,000-₹2,00,000</label
                            >
                        </div>
                        <div>
                            <input
                                type="radio"
                                id="₹2,00,000-₹2,50,000"
                                name="price"
                                value="₹2,00,000-₹2,50,000"
                            />
                            <label for="₹2,00,000-₹2,50,000"
                                >₹2,00,000-₹2,50,000</label
                            >
                        </div>
                        <div>
                            <input
                                type="radio"
                                id="₹3,00,000"
                                name="price"
                                value="₹3,00,000"
                            />
                            <label for="₹3,00,000"> {{ `<` }}₹3,00,000</label>
                        </div>
                    </form>
                </div>
                <div class="wed-venue-sidebar-menu">
                    <div @click="toggleFilterMenu($event)">
                        <span> Popular Filters</span>
                        <span>
                            <img src="/assets/icon-SVG/sidebararrow.svg" alt=""
                        /></span>
                    </div>
                    <form action="">
                        <div>
                            <input
                                type="checkbox"
                                id="name"
                                name="name"
                                value=""
                            />
                            <label for="name"></label>
                        </div>
                    </form>
                </div>
                <div class="wed-venue-sidebar-menu">
                    <div @click="toggleFilterMenu($event)">
                        <span> Meals</span>
                        <span>
                            <img src="/assets/icon-SVG/sidebararrow.svg" alt=""
                        /></span>
                    </div>
                    <form action="">
                        <div>
                            <input
                                type="radio"
                                id="1_day"
                                name="day"
                                value="1 day"
                            />
                            <label for="1_day">1 day</label>
                        </div>
                        <div>
                            <input
                                type="radio"
                                id="2_day"
                                name="day"
                                value="2 day"
                            />
                            <label for="2_day">2 day</label>
                        </div>
                        <div>
                            <input
                                type="radio"
                                id="3_day"
                                name="day"
                                value="3 day"
                            />
                            <label for="3_day">3 day</label>
                        </div>
                    </form>
                </div>
                <div class="wed-venue-sidebar-menu">
                    <div @click="toggleFilterMenu($event)">
                        <span> Property type</span>
                        <span>
                            <img src="/assets/icon-SVG/sidebararrow.svg" alt=""
                        /></span>
                    </div>
                    <form action="">
                        <div>
                            <input
                                type="checkbox"
                                id="option"
                                name="option"
                                value="option"
                            />
                            <label for="option">option 1</label>
                        </div>
                        <div>
                            <input
                                type="checkbox"
                                id="option2"
                                name="option2"
                                value="option2"
                            />
                            <label for="option2">option 2</label>
                        </div>
                        <div>
                            <input
                                type="checkbox"
                                id="option3"
                                name="option3"
                                value="option3"
                            />
                            <label for="option3">option 2</label>
                        </div>
                    </form>
                </div>
                <div class="wed-venue-sidebar-menu">
                    <div @click="toggleFilterMenu($event)">
                        <span> Bed preference</span>
                        <span>
                            <img src="/assets/icon-SVG/sidebararrow.svg" alt=""
                        /></span>
                    </div>
                    <form action="">
                        <div>
                            <input
                                type="checkbox"
                                id="option"
                                name="option"
                                value="option"
                            />
                            <label for="option">option 1</label>
                        </div>
                        <div>
                            <input
                                type="checkbox"
                                id="option2"
                                name="option2"
                                value="option2"
                            />
                            <label for="option2">option 2</label>
                        </div>
                        <div>
                            <input
                                type="checkbox"
                                id="option3"
                                name="option3"
                                value="option3"
                            />
                            <label for="option3">option 2</label>
                        </div>
                    </form>
                </div>
                <div class="wed-venue-sidebar-menu">
                    <div @click="toggleFilterMenu($event)">
                        <span> Facilities</span>
                        <span>
                            <img src="/assets/icon-SVG/sidebararrow.svg" alt=""
                        /></span>
                    </div>
                    <form action="">
                        <div>
                            <input
                                type="checkbox"
                                id="option"
                                name="option"
                                value="option"
                            />
                            <label for="option">option 1</label>
                        </div>
                        <div>
                            <input
                                type="checkbox"
                                id="option2"
                                name="option2"
                                value="option2"
                            />
                            <label for="option2">option 2</label>
                        </div>
                        <div>
                            <input
                                type="checkbox"
                                id="option3"
                                name="option3"
                                value="option3"
                            />
                            <label for="option3">option 2</label>
                        </div>
                    </form>
                </div>
                <div class="wed-venue-sidebar-menu">
                    <div @click="toggleFilterMenu($event)">
                        <span> Ratings</span>
                        <span>
                            <img src="/assets/icon-SVG/sidebararrow.svg" alt=""
                        /></span>
                    </div>
                    <form action="">
                        <div>
                            <input
                                type="checkbox"
                                id="option"
                                name="option"
                                value="option"
                            />
                            <label for="option">option 1</label>
                        </div>
                        <div>
                            <input
                                type="checkbox"
                                id="option2"
                                name="option2"
                                value="option2"
                            />
                            <label for="option2">option 2</label>
                        </div>
                        <div>
                            <input
                                type="checkbox"
                                id="option3"
                                name="option3"
                                value="option3"
                            />
                            <label for="option3">option 2</label>
                        </div>
                    </form>
                </div>
                <div class="wed-venue-sidebar-menu">
                    <div @click="toggleFilterMenu($event)">
                        <span> Neighbourhood</span>
                        <span>
                            <img src="/assets/icon-SVG/sidebararrow.svg" alt=""
                        /></span>
                    </div>
                    <form action="">
                        <div>
                            <input
                                type="checkbox"
                                id="option"
                                name="option"
                                value="option"
                            />
                            <label for="option">option 1</label>
                        </div>
                        <div>
                            <input
                                type="checkbox"
                                id="option2"
                                name="option2"
                                value="option2"
                            />
                            <label for="option2">option 2</label>
                        </div>
                        <div>
                            <input
                                type="checkbox"
                                id="option3"
                                name="option3"
                                value="option3"
                            />
                            <label for="option3">option 2</label>
                        </div>
                    </form>
                </div>
                <div class="wed-venue-sidebar-menu">
                    <div @click="toggleFilterMenu($event)">
                        <span> Room Facilities</span>
                        <span>
                            <img src="/assets/icon-SVG/sidebararrow.svg" alt=""
                        /></span>
                    </div>
                    <form action="">
                        <div>
                            <input
                                type="checkbox"
                                id="option"
                                name="option"
                                value="option"
                            />
                            <label for="option">option 1</label>
                        </div>
                        <div>
                            <input
                                type="checkbox"
                                id="option2"
                                name="option2"
                                value="option2"
                            />
                            <label for="option2">option 2</label>
                        </div>
                        <div>
                            <input
                                type="checkbox"
                                id="option3"
                                name="option3"
                                value="option3"
                            />
                            <label for="option3">option 2</label>
                        </div>
                    </form>
                </div>
            </div>
            <div class="wed-venue-items-container">
                <div>
                    <span id="sidebar-open"><i class="fas fa-bars"></i></span>
                    {{ hotelsList.length }} Results
                </div>
                <div class="wed-venue-items">
                    <a
                        :href="
                            '/directory/vendors/accommodation/' +
                            item.slug +
                            `?start=${search.startDate}&end=${search.endDate}&city=${search.city}&state=${search.state}&adults=${search.adult}&children=${search.children}&rooms=${search.rooms}`
                        "
                        v-for="(item, index) in hotelsList"
                        :key="index"
                    >
                        <div>
                            <div>
                                <div>
                                    <img
                                        v-if="
                                            item.images != null &&
                                            item.images.length != 0
                                        "
                                        :src="
                                            '/assets/vendors/uploads/' +
                                            item.images[0]
                                        "
                                        alt=""
                                    />
                                    <img
                                        v-else
                                        src="/assets/venues/venueDefault.png"
                                        alt=""
                                        width="100px"
                                        height="auto"
                                    />
                                    <div class="wed-venue-items-desc">
                                        <div>
                                            <div>{{ item.name }}</div>
                                            <div class="d-flex">
                                                <div>4.5</div>
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
                                            <p>{{ item.about }}</p>
                                            <p>20 reviews</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="wed-venue-items-price">
                                <div>Starting from</div>
                                <div v-if="item.rooms">
                                    {{ item.rooms[0].price_per_room }}
                                    <span>per day</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
import Calendar from "v-calendar/lib/components/calendar.umd";
import DatePicker from "v-calendar/lib/components/date-picker.umd";
export default {
    components: {
        // CircleProgress: CircleProgress,
        Calendar,
        "date-picker": DatePicker,
        // Splide
    },
    props: [
        "hotels",
        "city",
        "hotelstartdate",
        "hotelenddate",
        "rooms",
        "children",
        "adults",
        "states",
        "stateselected",
    ],
    // props: {
    //     hotels: Array,
    //     city: String,
    //     hotelstartdate: String,
    //     hotelenddate: String,
    //     rooms: Number,
    //     children: Number,
    //     adults: Number,
    //     states: Array,
    // },
    data() {
        return {
            range: {
                start: this.hotelstartdate,
                end: this.hotelenddate,
            },
            locationMaster: JSON.parse(this.states),
            hotelsList: JSON.parse(this.hotels),
            stateList: [],
            district: [],
            hideDefaultOption: true,
            search: {
                city: this.city,
                state: this.stateselected,
                startDate: this.hotelstartdate,
                endDate: this.hotelenddate,
                adult: this.adults,
                children: this.children,
                rooms: this.rooms,
            },
            popluarSearches: [
                {
                    id: 1,
                    name: "The palace house",
                    descp: "Frame871.png",
                    reviews: 30,
                    priceStart: "₹8000",
                    rating: 4.5,
                },
                {
                    id: 2,
                    name: "The palace house",
                    descp: "wedding-hall-20211222202036.jpg",
                    reviews: 30,
                    priceStart: "₹8000",
                    rating: 4.5,
                },
                {
                    id: 3,
                    name: "The palace house",
                    descp: "Frame874.png",
                    reviews: 30,
                    priceStart: "₹8000",
                    rating: 4.5,
                },
                {
                    id: 4,
                    name: "The palace house",
                    descp: "wedding-hall-20211222202047.jpg",
                    reviews: 30,
                    priceStart: "₹8000",
                    rating: 4.5,
                },
            ],
            roomMember: false,
        };
    },
    methods: {
        toggleFilterMenu(e) {
            let sideMenu = document.querySelectorAll(
                ".wed-venue-sidebar-menu > div:nth-child(1)"
            );
            if (e.currentTarget.parentNode.classList.contains("show-drop")) {
                e.currentTarget.parentNode.classList.remove("show-drop");
            } else {
                sideMenu.forEach(function (active) {
                    active.parentNode.classList.remove("show-drop");
                });
                e.currentTarget.parentNode.classList.add("show-drop");
            }
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
        getDistricts(e, bool) {
            let _this = this;
            let val = null;
            if (bool == true) {
                val = e.currentTarget.value;
            }
            if (bool == false) {
                val = e;
            }

            _this.district = [];
            this.locationMaster.map(function (el) {
                if ('"' + el.state + '"' == '"' + val + '"') {
                    _this.district.push({ id: el.id, name: el.name });
                }
            });
            _this.hideDefaultOption = false;
            if (bool == true) {
                _this.search.city = "Select City";
            }
        },
        windowClick() {
            this.roomMember = false;
        },
        searchAcc() {
            // let startDate = new Date(this.search.startDate)
            //     .toISOString()
            //     .split("T")[0];
            // let endDate = new Date(this.search.endDate)
            //     .toISOString()
            //     .split("T")[0];
            // console.log(
            //     typeof this.range.start,
            //     typeof this.range.start != string
            // );
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
            window.location.href = `/directory/vendors/accommodation/filtered?start=${this.search.startDate}&end=${this.search.endDate}&city=${this.search.city}&state=${this.search.state}&adults=${this.search.adult}&children=${this.search.children}&rooms=${this.search.rooms}`;
        },
    },
    created: function () {
        window.addEventListener("click", this.windowClick);
    },
    mounted() {
        this.$nextTick(function () {
            this.getStates();
            this.getDistricts(this.stateselected, false);
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
/* wedding Venues Page Css start */
.wed-ven-main-search {
    display: flex;
    flex-direction: column;
    width: 100%;
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

.wed-venue-sidebar-menu > div:nth-child(1) {
    display: flex;
    justify-content: space-between;
    margin-bottom: 1.75em;
    cursor: pointer;
}

.wed-venue-sidebar-menu > div:nth-child(1) > span {
    font-family: Sansation;
    font-style: normal;
    font-weight: normal;
    font-size: 18px;
    line-height: 20px;
    color: #313131;
    padding-left: 10px;
}

.wed-venue-sidebar-menu > form {
    padding-left: 20px;
    display: none;
    margin-bottom: 1.75em;
}

.wed-venue-sidebar-menu > form label {
    font-family: Segoe UI;
    font-style: normal;
    font-weight: normal;
    font-size: 16.4px;
    line-height: 22px;
    padding-left: 15px;
    color: #999999;
}

.show-drop > form {
    display: block !important;
}

/* Section-2(sidebar) CSS end */

/* Section-2(venues) CSS start */
.wed-venue-items-container > div:nth-child(1) {
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
    grid-template-columns: repeat(auto-fit, minmax(300px, 200px));
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
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.wed-venue-items > a > div > div > div > img {
    width: 100%;
    border-radius: 14.6552px;
    object-fit: cover;
    height: 328px;
}

.wed-venue-items-desc {
    background-color: #ffffff;
    background: #ffffff;
    border: 0.146552px solid #000000;
    border-radius: 14.6552px;
    padding: 10px;
    position: relative;
    bottom: 73px;
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
.wed-venue-items-desc > div:nth-child(2) > p:nth-child(1) {
    width: 70%;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.wed-venue-items-price {
    display: flex;
    justify-content: space-between;
    background-color: #ffffff;
    border-radius: 14.6552px;
    padding: 10px;
    border: 0.146552px solid #000000;
    margin-top: -74px;
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
/* Section-2(sidebar) CSS end */

/* wedding Venues Page Css end */
</style>
