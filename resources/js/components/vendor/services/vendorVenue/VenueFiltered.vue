<template>
    <div>
        <section class="wed-venue-main">
            <div class="wed-venue-search">
                <div>Venues/ Wedding venue/ {{ defaultState }}</div>
                <div class="row">
                    <div class="col">Wedding Venues In {{ defaultState }}</div>
                    <div
                        v-if="host != null"
                        class="col"
                        style="justify-content: space-around"
                    >
                        <div class="text-center">
                            <a
                                href="/host/venues/create"
                                class="btn btn-sm bg-danger mx-5"
                                title="add new Venue"
                                ><i
                                    class="material-icons"
                                    title="Add Another Ceramony"
                                    >add</i
                                ></a
                            >
                        </div>
                    </div>
                </div>
                <div class="wed-ven-main-search">
                    <div>
                        <form
                            @submit.prevent="searchVenues($event)"
                            style="
                                display: flex;
                                justify-content: space-around;
                                flex-wrap: wrap;
                            "
                        >
                            <!-- <select
                                id="states"
                                name="states"
                                v-model="search.city"
                                required
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
                            <div
                                v-click-outside="windowClick"
                                class="venue-sarch-cont"
                            >
                                <input
                                    type="text"
                                    placeholder="Banquet Halls,Lawns / Farmhouses,Resorts,Small Function Halls........"
                                    name="venueSearch"
                                    id="venueSearch"
                                    autocomplete="off"
                                    :value="search.venueType"
                                    :v-model="search.venueType"
                                    @click.stop="searchVenue = !searchVenue"
                                    @change="enterValue($event)"
                                    required
                                />
                                <div
                                    @click="enterSarch($event)"
                                    v-if="searchVenue"
                                >
                                    <div
                                        v-for="item in subCategories"
                                        :key="item.id"
                                        :data-value="item.name"
                                    >
                                        {{ item.name }}
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
                    src="/assets/vendors/venues/venuediagonalback.png"
                    alt=""
                    style="width: 100%; height: 100%"
                />
            </div>
        </section>
        <section class="wed-venue-content">
            <div class="wed-venue-sidebar">
                <div class="wed-venue-sidebar-menu">
                    <div @click="toggleFilterMenu($event)">
                        <span> Price per plate</span>
                        <span>
                            <img src="/assets/icon-SVG/sidebararrow.svg" alt=""
                        /></span>
                    </div>
                    <form action="">
                        <div>
                            <input
                                type="radio"
                                id="₹500"
                                name="price"
                                value="<500"
                                v-model="filterMenu.price_per_plate"
                            />
                            <label for="₹500"> {{ `<` }}₹500</label>
                        </div>
                        <div>
                            <input
                                type="radio"
                                id="₹500-₹1000"
                                name="price"
                                value="500-1000"
                                v-model="filterMenu.price_per_plate"
                            />
                            <label for="₹500-₹1000">₹500-₹1,000</label>
                        </div>
                        <div>
                            <input
                                type="radio"
                                id="₹1000-₹1500"
                                name="price"
                                value="1000-1500"
                                v-model="filterMenu.price_per_plate"
                            />
                            <label for="₹1000-₹1500">₹1,000-₹1,500</label>
                        </div>
                        <div>
                            <input
                                type="radio"
                                id="₹1500-₹2000"
                                name="price"
                                value="1500-2000"
                                v-model="filterMenu.price_per_plate"
                            />
                            <label for="₹1500-₹2000">₹1,500-₹2,000</label>
                        </div>
                        <div>
                            <input
                                type="radio"
                                id="₹2000"
                                name="price"
                                value=">2000"
                                v-model="filterMenu.price_per_plate"
                            />
                            <label for="₹2000"> {{ `>` }}₹2,000</label>
                        </div>
                    </form>
                </div>
                <div class="wed-venue-sidebar-menu">
                    <div @click="toggleFilterMenu($event)">
                        <span> Locality</span>
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
                        <span> No. of guests</span>
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
                        <span> Venue type</span>
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
                        <span> Space preference</span>
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
                                type="radio"
                                id="5rating"
                                name="rating"
                                value="5"
                                v-model="filterMenu.stars"
                            />
                            <label for="5rating">5 stars</label>
                        </div>
                        <div>
                            <input
                                type="radio"
                                id="4rating"
                                name="rating"
                                value="4"
                                v-model="filterMenu.stars"
                            />
                            <label for="4rating">4 stars</label>
                        </div>
                        <div>
                            <input
                                type="radio"
                                id="3rating"
                                name="rating"
                                value="3"
                                v-model="filterMenu.stars"
                            />
                            <label for="3rating">3 stars</label>
                        </div>
                    </form>
                </div>
                <div>
                    <button
                        class="filter-btns"
                        type="button"
                        @click="applyFliter()"
                    >
                        Apply
                    </button>
                    <button
                        class="filter-btns"
                        type="button"
                        @click="clearFiler()"
                    >
                        Clear
                    </button>
                </div>
            </div>
            <div class="wed-venue-items-container">
                <div>
                    <span id="sidebar-open"><i class="fas fa-bars"></i></span>
                    {{ venueList.length }} Results
                </div>
                <div class="wed-venue-items">
                    <a
                        :href="'/directory/vendors/venues/' + item.slug"
                        v-for="(item, index) in pageOfItems"
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
                                                <div>{{ item.stars }}</div>
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
                                            <p>20 reviews</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="wed-venue-items-price">
                                <div style="width: 55%">
                                    <div>{{ item.type }}</div>
                                    <div>
                                        <span>400-600 pax</span>
                                        <span>Indoor</span>
                                        <span>Outdoor</span>
                                    </div>
                                </div>
                                <div style="width: 35%">
                                    <div class="priceperplatetype">Veg</div>
                                    <div class="priceperplate">
                                        ₹{{ item.veg_plate }}
                                        <span>per plate</span>
                                    </div>
                                    <div class="priceperplatetype">Non-veg</div>
                                    <div class="priceperplate">
                                        ₹{{ item.non_veg_plate }}
                                        <span>per plate</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </section>
        <div style="display: flex; justify-content: center; margin-bottom: 1em">
            <jw-pagination
                :items="venueList"
                :pageSize="12"
                @changePage="onChangePage"
            ></jw-pagination>
        </div>
    </div>
</template>

<script>
import vClickOutside from "v-click-outside";

export default {
    directives: {
        clickOutside: vClickOutside.directive,
    },
    props: [
        "venues",
        "city",
        "type",
        "states",
        "host",
        "stateselected",
        "subcat",
    ],

    data() {
        return {
            filterMenu: {
                price_per_plate: null,
                stars: null,
            },
            search: {
                city: this.city,
                venueType: this.type,
                state: this.stateselected,
            },
            searchVenue: false,
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
            defaultState: "India",
            subCategories: JSON.parse(this.subcat),
            locationMaster: JSON.parse(this.states),
            venueList: JSON.parse(this.venues),
            pageOfItems: [],
            selectedCity: this.city,
            selectedType: this.type,
            stateList: [],
            district: [],
            hideDefaultOption: true,
        };
    },
    methods: {
        onChangePage(pageOfItems) {
            // update page of items
            this.pageOfItems = pageOfItems;
        },
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
        enterValue(e) {
            this.search.venueType = e.currentTarget.value.trim();
        },
        enterSarch(e) {
            let txt = e.target.textContent.trim();
            document.querySelector("#venueSearch").value = txt;
            this.search.venueType = e.target.dataset.value;
            this.searchVenue = false;
        },
        searchVenues(e) {
            if (this.host != null) {
                window.location.href = `/host/venues?type=${this.search.venueType}&city=${this.search.city}&state=${this.search.state}`;
                return;
            }
            window.location.href = `/directory/vendors/venues/filtered?type=${this.search.venueType}&city=${this.search.city}&state=${this.search.state}`;
        },
        windowClick() {
            this.searchVenue = false;
        },
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
        applyFliter() {
            let _this = this;
            let searchSend = {
                city: _this.search.city,
                venueType: null,
            };
            searchSend.venueType = _this.subCategories.find(
                (x) => x.name === _this.search.venueType
            ).id;
            axios
                .get(`/api/vendor/addvenue/filter`, {
                    params: {
                        filters: _this.filterMenu,
                        search: searchSend,
                    },
                })
                .then(function (response) {
                    _this.venueList = response.data;
                    // _this.finalInvi = response.data;
                })
                .catch((errors) => {});
        },
        clearFiler() {
            let _this = this;
            let searchSend = {
                city: _this.search.city,
                venueType: null,
            };
            searchSend.venueType = _this.subCategories.find(
                (x) => x.name === _this.search.venueType
            ).id;

            for (const key in _this.filterMenu) {
                _this.filterMenu[key] = null;
            }
            axios
                .get(`/api/vendor/addvenue/filter`, {
                    params: {
                        filters: _this.filterMenu,
                        search: searchSend,
                    },
                })
                .then(function (response) {
                    _this.venueList = response.data;
                    // _this.finalInvi = response.data;
                })
                .catch((errors) => {});
        },
    },
    mounted() {
        this.$nextTick(function () {
            this.getStates();
            this.getDistricts(this.stateselected, false);
            if (this.host != null) {
                $(".wed-venue-main")
                    .parent()
                    .parent()
                    .parent()
                    .removeClass("container");
            }
            if (this.stateselected != "") {
                this.defaultState = this.stateselected;
            }
        });
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

.wed-ven-main-search > div > form > button,
.filter-btns {
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
.venue-sarch-cont {
    width: 60%;
    position: relative;
}
.venue-sarch-cont > input {
    width: 100%;
    padding: 11px;
    background-color: #ffffff !important;
    border-radius: 5px;
    border-bottom-right-radius: 0px;
    border: none;
    background-image: url("/assets/single-venue-page/Group.svg");
    background-repeat: no-repeat;
    background-position: 1.5% 49%;
    background-size: 20px;
    padding-left: 40px;
}
.venue-sarch-cont > input::placeholder {
    font-family: Segoe UI;
    font-style: normal;
    font-weight: normal;
    font-size: 10px;
    line-height: 13px;
    color: rgba(0, 0, 0, 0.3);
}
.venue-sarch-cont > div {
    font-family: "Segoe UI";
    font-style: normal;
    font-weight: 400;
    font-size: 10px;
    line-height: 20px;
    background: #ffffff;
    border-radius: 0px 0px 5px 5px;
    position: absolute;
    z-index: 999;
    color: #5e5e5e;
    padding: 19px;
    width: 94%;
    left: 38px;
    pointer-events: none;
}
.venue-sarch-cont > div > div {
    cursor: pointer;
    margin-bottom: 5px;
    pointer-events: all;
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
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
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
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    width: 70%;
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
    margin-top: -74px;
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

/* Section-2(sidebar) CSS end */

/* wedding Venues Page Css end */
</style>
