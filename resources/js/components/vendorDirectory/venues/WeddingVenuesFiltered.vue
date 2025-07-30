<template>
    <div style="margin-bottom: 100px; min-height: 70vh">
        <div class="venue-search-cont">
            <img src="/assets/venues/Frame540.png" alt="" />
            <div class="venue-search-cont-info container-lg">
                <div class="search-feilds">
                    <multiselect
                        style="width: 35%"
                        v-model="selectedCity"
                        placeholder="Select City"
                        :options="options"
                        :show-labels="false"
                        :allow-empty="false"
                        ref="citySelect"
                        ><span slot="noResult"
                            >No city exists.</span
                        ></multiselect
                    >
                    <multiselect
                        v-model="selectedVenue"
                        style="width: 35%"
                        :options="venueTypes"
                        placeholder="Venue Type"
                        :show-labels="false"
                        :allow-empty="false"
                        ref="venueSelect"
                        ><span slot="noResult"
                            >No venue type exists.</span
                        ></multiselect
                    >
                    <button @click="searchVenues()" type="button">
                        Search
                    </button>
                </div>
            </div>
        </div>
        <div class="venue-filter-cont">
            <div class="container-lg">
                <div
                    v-for="(item, index) in Object.keys(filters)"
                    :key="index"
                    class="venue-filter-single"
                >
                    <span @click.stop="closeAllFilters(item)"
                        >{{ filters[item].name }}
                        <img src="/assets/venues/chevron-down.svg" alt=""
                    /></span>
                    <div @click.stop v-if="filters[item].show">
                        <div
                            v-for="(ele, index) in filters[item].filterList"
                            :key="index"
                        >
                            <label :for="ele"
                                >{{ ele }}
                                <input
                                    type="checkbox"
                                    :id="ele"
                                    :value="ele"
                                    v-model="filters[item].selected"
                                />
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="venue-head-list container-lg">
            <a href="/">Home > </a
            ><a href="/directory/vendors/venues">Wedding venues > </a
            ><a
                v-if="type"
                :href="'/directory/vendors/venues/filtered?type=' + type"
                >{{ type }} >
            </a>
            <span v-if="city">{{ city }} </span>
        </div>
        <div class="container-lg">
            <div class="venue-list-head">
                <div class="venue-list-details">
                    <h3>Wedding Venues</h3>
                    <h6>
                        Showing {{ venues.length }} results as per your search
                        criteria
                    </h6>
                </div>
                <div class="venue-list-details-search">
                    <button>Select</button>
                    <input
                        type="text"
                        name=""
                        id=""
                        placeholder="Search for venue by name"
                    />
                </div>
            </div>
            <div class="venue-list-all">
                <div
                    v-for="(item, index) in pageOfItems"
                    :key="index"
                    class="venue-list-single"
                >
                    <div style="width: 40%">
                        <div
                            :id="'main-slider' + item.id"
                            class="splide main-splide"
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
                        <div :id="'thumbnail-slider' + item.id" class="splide">
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
                    <a
                        :href="'/directory/vendor/venues/' + item.slug"
                        class="venue-list-single-descp"
                    >
                        <h1>{{ item.name }}</h1>
                        <h2>Blue Bay Beach Resort, State Highway 49, ...</h2>
                        <div>
                            <div class="venue-feature-list">
                                <span>
                                    <img
                                        src="/assets/venues/fluent_people-community-28-regular.svg"
                                        alt=""
                                    />
                                    Hall capacity
                                </span>
                                <span>750</span>
                            </div>
                            <div class="venue-feature-list">
                                <span>
                                    <img
                                        src="/assets/venues/la_wine-glass-alt.svg"
                                        alt=""
                                    />
                                    Dining Capacity
                                </span>
                                <span>250</span>
                            </div>
                            <div class="venue-feature-list">
                                <span>
                                    <img
                                        src="/assets/venues/fluent_food-16-regular.svg"
                                        alt=""
                                    />
                                    Food type
                                </span>
                                <span>Veg</span>
                            </div>
                            <div class="venue-feature-list">
                                <span>
                                    <img
                                        src="/assets/venues/cil_room.svg"
                                        alt=""
                                    />
                                    Rooms
                                </span>
                                <span>10 Rooms A/C </span>
                            </div>
                            <div class="venue-feature-list">
                                <span>
                                    <img
                                        src="/assets/venues/cil_room.svg"
                                        alt=""
                                    />
                                    Areas Available
                                </span>
                                <span>Lawn, A/C Hall, Mandap</span>
                            </div>
                        </div>
                        <p>
                            Blue Bay Beach Resort is a beachfront resort. The
                            wedding venue is designed in a brilliant way that
                            would add value to the
                        </p>
                        <div class="venue-tags-cont">
                            <span>Wedding Hotels</span>
                            <span>Banquet Halls</span>
                            <span>Indoor</span>
                            <span>Outdoor</span>
                        </div>
                        <div class="venue-price-food">
                            <div class="venue-food">
                                <div>
                                    <!-- <div>
                                        <img
                                            src="/assets/venues/nonveg.svg"
                                            alt=""
                                        />
                                        Non- Vegeterian
                                    </div>
                                    <div>
                                        <img
                                            src="/assets/venues/veg.svg"
                                            alt=""
                                        />
                                        Vegeterian
                                    </div> -->
                                </div>
                                <div>
                                    <!-- <div><span>₹1200</span>/Plate</div>
                                    <div><span>₹950</span>/Plate</div> -->
                                </div>
                            </div>
                            <button>Check availability</button>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div style="display: flex; justify-content: center; margin-bottom: 1em">
            <jw-pagination
                :items="venues"
                :pageSize="3"
                @changePage="onChangePage"
            ></jw-pagination>
        </div>
    </div>
</template>

<script>
import Multiselect from "vue-multiselect";

export default {
    components: {
        Multiselect,
    },
    props: ["venues", "cities", "type", "city"],
    data() {
        return {
            selectedVenue: this.type ?? null,
            selectedCity: this.city ?? null,
            options: this.cities,
            venueTypes: [
                "Resorts",
                "Destination",
                "Beach",
                "Hotels",
                "Banquet Halls",
                "Lawns",
                "Community Center",
            ],
            filters: {
                price: {
                    name: "Price per plate",
                    show: false,
                    selected: [],
                    filterList: ["1000", "2000", "3000"],
                },
                locality: {
                    name: "Locality",
                    show: false,
                    selected: [],
                    filterList: ["Chandigarh", "Panchkula", "Mohali"],
                },
                guests: {
                    name: "No. of guests",
                    show: false,
                    selected: [],
                    filterList: ["200", "400", "600"],
                },
                space: {
                    name: "Space preference",
                    show: false,
                    selected: [],
                    filterList: ["Outdoor", "Indoor", "Poolisde"],
                },
                ratings: {
                    name: "Ratings",
                    show: false,
                    selected: [],
                    filterList: ["5 stars", "4 stars", "3 stars"],
                },
            },
            pageOfItems: [],
            splider: {},
            mainSplider: {},
        };
    },
    methods: {
        onChangePage(pageOfItems) {
            // update page of items
            this.pageOfItems = pageOfItems;
            this.setSplider();
        },
        searchVenues() {
            if (this.selectedCity == null) {
                this.$refs.citySelect.activate();
                return;
            }
            if (this.selectedVenue == null) {
                this.$refs.venueSelect.activate();
                return;
            }
            window.location.href = `/directory/vendors/venues/filtered?type=${this.selectedVenue}&city=${this.selectedCity}`;
        },
        closeAllFilters(item) {
            for (let keys in this.filters) {
                if (keys == item) {
                    continue;
                }
                this.filters[keys].show = false;
            }
            this.filters[item].show = !this.filters[item].show;
        },
        closeFilters() {
            for (let keys in this.filters) {
                this.filters[keys].show = false;
            }
        },
        setSplider() {
            let _this = this;
            this.$nextTick(function () {
                this.pageOfItems.forEach(function (item, index) {
                    if (
                        document.getElementById(`main-slider${item.id}`) ==
                            null ||
                        !document.getElementById(
                            `thumbnail-slider${item.id}`
                        ) == null
                    ) {
                        return;
                    }
                    _this.mainSplider[item.id] = new Splide(
                        `#main-slider${item.id}`,
                        {
                            type: "fade",
                            rewind: true,
                            pagination: false,
                            arrows: false,
                        }
                    );
                    _this.splider[item.id] = new Splide(
                        `#thumbnail-slider${item.id}`,
                        {
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
                        }
                    );
                    _this.mainSplider[item.id].sync(_this.splider[item.id]);
                    _this.mainSplider[item.id].mount();
                    _this.splider[item.id].mount();
                });
            });
        },
    },
    created: function () {
        window.addEventListener("click", this.closeFilters);
    },
    mounted() {
        document.onreadystatechange = () => {
            if (document.readyState == "complete") {
                this.setSplider();
            }
        };
    },
};
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style>
.splide__slide {
    opacity: 0.3;
}

.splide__slide.is-active {
    opacity: 1;
    border: none !important;
}
/* #thumbnail-slider-list {
    //justify-content: space-around;
} */
</style>
<style scoped>
.main-splide img {
    width: 100%;
    height: 100%;
    border-radius: 5px;
}
.main-splide {
    margin-bottom: 10px;
}

.venue-search-cont {
    position: relative;
    width: 100%;
    min-height: 80px;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}
.venue-search-cont > img {
    position: absolute;
    top: 0;
    left: 0;
    object-fit: cover;
    width: 100%;
    z-index: 99;
    height: 100%;
}
.venue-search-cont-info {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    position: relative;
    z-index: 999;
    width: 100%;
}
.search-feilds {
    display: flex;
    justify-content: flex-start;
    width: 100%;
    margin-left: 30px;
}
.search-feilds > div {
    max-width: 300px;
    margin-right: 30px;
}
.search-feilds > button {
    background: #461952;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 13.0054px;
    line-height: 20px;
    padding: 7px 43px;
    color: #ffffff;
    border: none;
    outline: none;
    height: 44px;
}
.venue-filter-cont {
    background: #ffffff;
    box-shadow: 0px 1px 4px rgba(0, 0, 0, 0.25);
    padding: 16px 52px;
}
.venue-filter-cont > div {
    display: flex;
    justify-content: space-between;
}
.venue-filter-single {
    position: relative;
    width: max-content;
    display: flex;
    flex-direction: column;
}
.venue-filter-single > span {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 300;
    font-size: 12px;
    line-height: 18px;
    color: #000000;
}
.venue-filter-single > span > img {
    margin-left: 12px;
    width: 15px;
    height: 15px;
}
.venue-filter-single > div {
    display: flex;
    flex-direction: column;
    position: absolute;
    top: 100%;
    background-color: white;
    box-shadow: 0px 1px 4px rgba(0, 0, 0, 0.25);
    min-width: 200px;
}
.venue-filter-single:last-child > div {
    right: 0;
}
.venue-filter-single > div > div > label {
    display: flex;
    justify-content: space-between;
}
.venue-head-list > a,
.venue-head-list > span {
    text-decoration: none;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 300;
    font-size: 12px;
    line-height: 18px;
    color: #138ab3;
}
.venue-list-head {
    display: flex;
    justify-content: space-between;
}
.venue-list-details > h3 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 22px;
    line-height: 33px;
    color: #000000;
    margin-bottom: 10px;
}
.venue-list-details > h6 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 300;
    font-size: 12px;
    line-height: 18px;
    color: #898484;
}
.venue-list-details-search > button {
    background: #c4456f;
    border: 1px solid #c4456f;
    border-radius: 5px;
    padding: 10px 21px;
    font-family: "Inter";
    font-style: normal;
    font-weight: 500;
    font-size: 14px;
    line-height: 17px;
    text-align: center;
    color: #ffffff;
}
.venue-list-details-search > input {
    background-image: url("/assets/venues/search.svg");
    background-repeat: no-repeat;
    background-position-x: 10px;
    background-position-y: center;
    padding: 10px;
    padding-left: 30px;
    border: 0.5px solid #d7d7d7;
    border-radius: 5px;
    background-color: #ffffff !important;
}
.venue-list-details-search > input::placeholder {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 300;
    font-size: 12px;
    line-height: 18px;
    color: #7b7b7b;
}
.venue-list-single {
    width: 80%;
    display: flex;
    padding: 10px;
    background: #ffffff;
    border: 0.5px solid #d1d1d1;
    box-shadow: 0px 0px 0.5px rgba(0, 0, 0, 0.25);
    margin-bottom: 13px;
}
.venue-list-single-descp {
    width: 60%;
    padding: 18px;
    padding-top: 30px;
    text-decoration: none;
}
.venue-list-single-descp > h1 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 19px;
    line-height: 28px;
    color: #000000;
}
.venue-list-single-descp > h2 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 300;
    font-size: 13px;
    line-height: 20px;
    color: #828282;
    margin-bottom: 10px;
}
.venue-feature-list {
    display: flex;
}
.venue-feature-list > span:nth-child(1) {
    width: 130px;
}
.venue-feature-list > span:nth-child(1) > img {
    margin-right: 10px;
    width: 11px;
    height: 9px;
}
.venue-feature-list > span {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 300;
    font-size: 10.439px;
    line-height: 16px;
    color: #636363;
}
.venue-feature-list > span:last-child {
    color: #000000;
}
.venue-list-single-descp > p {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 300;
    font-size: 9.77876px;
    line-height: 15px;
    color: #000000;
}
.venue-tags-cont {
    display: flex;
    flex-wrap: wrap;
}
.venue-tags-cont > span {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 9.77876px;
    line-height: 15px;
    color: #353232;
    padding: 4px 6px;
    background: #f1f5fa;
    border-radius: 5px;
    margin-right: 7px;
    margin-bottom: 7px;
}
.venue-price-food {
    display: flex;
    justify-content: space-between;
}
.venue-food {
    display: flex;
}
.venue-food > div:nth-child(1) {
    margin-right: 30px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}
.venue-food > div:nth-child(2) {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}
.venue-food > div:nth-child(1) > div > img {
    margin-right: 7px;
}
.venue-food > div:nth-child(1) > div {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 9.90941px;
    line-height: 15px;
    color: #898484;
}
.venue-food > div:nth-child(2) > div {
    color: #898484;
}
.venue-food > div:nth-child(2) > div > span {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 12.8455px;
    line-height: 19px;
    color: #000000;
}
.venue-price-food > button {
    border: none;
    outline: none;
    background: #461952;
    border-radius: 4px;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 9.36504px;
    line-height: 14px;
    padding: 10px;
    color: #ffffff;
}
@media only screen and (max-width: 992px) {
    .venue-filter-cont > div {
        overflow-x: auto;
    }
    .venue-filter-single {
        min-width: 137px;
        margin-bottom: 10px;
        display: none;
    }
}
@media only screen and (max-width: 768px) {
    .venue-list-single {
        width: 100%;
    }
    .venue-list-head {
        flex-wrap: wrap;
        justify-content: center;
    }
    .venue-list-head > div {
        width: 100%;
    }
}
@media only screen and (max-width: 655px) {
    .venue-list-single {
        width: 100%;
    }
    .venue-list-single {
        flex-wrap: wrap;
    }
    .venue-list-single > a {
        width: 100% !important;
    }
    .venue-list-single > div {
        width: 60% !important;
        margin: auto;
    }
}
@media only screen and (max-width: 576px) {
    /* .venue-search-cont {
        min-height: 300px;
    } */
    .venue-list-single > div {
        width: 90% !important;
        margin: auto;
    }
    .venue-search-cont-info > h4 {
        font-size: 20.1456px;
        line-height: 30px;
    }
    .venue-search-cont-info > p {
        font-size: 12px;
        line-height: 18px;
    }
    .search-feilds > div {
        width: 95% !important;
        margin-bottom: 10px;
    }
    .search-feilds {
        flex-wrap: wrap;
        justify-content: center;
    }
}
</style>
