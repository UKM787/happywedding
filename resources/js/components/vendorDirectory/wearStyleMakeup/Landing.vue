<template>
    <div>
        <SearchHeader :title="'Wedding Wear Styles and Makeups'" :description="'Browse, shortlist and get best prices and packages from venues available to host your upcoming wedding reception,pre-wedding and post-wedding functions.'" :cities="states" :categories="subcat" :maincat="vendorcat"></SearchHeader>
        <div style="background: #f4f4f4; padding: 37px 0">
            <div class="venue-cat-cont container">
                <h1>Search By: Venue</h1>
                <div id="venue-slider" class="splide">
                    <div class="splide__track">
                        <ul class="splide__list">
                            <li
                                v-for="(item, index) in venueCats"
                                :key="index"
                                style="
                                    max-width: 250px;
                                    width: 100%;
                                    min-width: 200px;
                                    margin-right: 12px;
                                    border: none !important;
                                "
                                class="splide__slide"
                            >
                                <a
                                    :href="`/directory/vendors/${vendorcat.path}/filtered?type=${item.slug}&city=Chennai`"
                                    class="single-venue-cat"
                                >
                                    <img
                                        :src="
                                            '/assets/defaults/categories/images/' +
                                            item.imageOne
                                        "
                                        alt=""
                                    />
                                    <span>{{ item.name }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- <div>
                    <div
                        v-for="(item, index) in venueCats"
                        :key="index"
                        style="
                            max-width: 300px;
                            width: 100%;
                            min-width: 250px;
                            margin-right: 12px;
                        "
                    >
                        <div class="single-venue-cat">
                            <img :src="item.image" alt="" />
                            <span>{{ item.name }}</span>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
        <div style="background: #ffffff; padding: 37px 0">
            <div class="container venue-cat-type">
                <h1>Top Banquet halls</h1>

                <div id="banquet-slider" class="splide">
                    <div class="splide__track">
                        <ul class="splide__list single-card-outer">
                            <li
                                v-for="(item, index) in banquetHalls"
                                :key="index"
                                style="
                                    max-width: 300px;
                                    width: 100%;
                                    min-width: 250px;
                                    margin-right: 12px;
                                    border: none !important;
                                "
                                class="splide__slide"
                            >
                                <MakeupCard :item="item" :dummyimage="true" :single="true"></MakeupCard>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- <div
                        v-for="(item, index) in banquetHalls"
                        :key="index"
                        style="
                            max-width: 300px;
                            width: 100%;
                            min-width: 250px;
                            margin-right: 12px;
                        "
                    >
                        <div class="single-card-inner">
                            <img :src="item.image" alt="" />
                            <div>
                                <p>{{ item.name }}</p>
                                <p>
                                    <img
                                        src="/assets/venues/map-pin.svg"
                                        alt=""
                                    />
                                    ECR
                                </p>
                            </div>
                            <a href="">Check availability</a>
                        </div>
                    </div> -->
            </div>
        </div>
        <div style="background: #f4f4f4; padding: 37px 0">
            <div class="container venue-cat-type">
                <h1>Top Open Lawns</h1>
                <div id="lawns-slider" class="splide">
                    <div class="splide__track">
                        <ul class="splide__list single-card-outer">
                            <li
                                v-for="(item, index) in openLawns"
                                :key="index"
                                style="
                                    max-width: 300px;
                                    width: 100%;
                                    min-width: 250px;
                                    margin-right: 12px;
                                    border: none !important;
                                "
                                class="splide__slide"
                            >
                                <MakeupCard :item="item" :dummyimage="true" :single="true"></MakeupCard>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- <div class="single-card-outer">
                    <div
                        v-for="(item, index) in openLawns"
                        :key="index"
                        style="
                            max-width: 300px;
                            width: 100%;
                            min-width: 250px;
                            margin-right: 12px;
                        "
                    >
                        <div class="single-card-inner">
                            <img :src="item.image" alt="" />
                            <div>
                                <p>{{ item.name }}</p>
                                <p>
                                    <img
                                        src="/assets/venues/map-pin.svg"
                                        alt=""
                                    />
                                    ECR
                                </p>
                            </div>
                            <a href="">Check availability</a>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
        <div style="background: #ffffff; padding: 37px 0">
            <div class="container venue-cat-type">
                <h1>Top Party Hall</h1>
                <div id="party-slider" class="splide">
                    <div class="splide__track">
                        <ul class="splide__list single-card-outer">
                            <li
                                v-for="(item, index) in partyHalls"
                                :key="index"
                                style="
                                    max-width: 300px;
                                    width: 100%;
                                    min-width: 250px;
                                    margin-right: 12px;
                                    border: none !important;
                                "
                                class="splide__slide"
                            >
                                <MakeupCard :item="item" :dummyimage="true" :single="true"></MakeupCard>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- <div class="single-card-outer">
                    <div
                        v-for="(item, index) in partyHalls"
                        :key="index"
                        style="
                            max-width: 300px;
                            width: 100%;
                            min-width: 250px;
                            margin-right: 12px;
                        "
                    >
                        <div class="single-card-inner">
                            <img :src="item.image" alt="" />
                            <div>
                                <p>{{ item.name }}</p>
                                <p>
                                    <img
                                        src="/assets/venues/map-pin.svg"
                                        alt=""
                                    />
                                    ECR
                                </p>
                            </div>
                            <a href="">Check availability</a>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
        <div style="background: #f4f4f4; padding: 37px 0; margin-bottom: 40px">
            <div class="container venue-cat-type">
                <h1>Featured</h1>
                <div id="featured-slider" class="splide">
                    <div class="splide__track">
                        <ul class="splide__list single-card-outer">
                            <li
                                v-for="(item, index) in featured"
                                :key="index"
                                style="
                                    max-width: 300px;
                                    width: 100%;
                                    min-width: 250px;
                                    margin-right: 12px;
                                    border: none !important;
                                "
                                class="splide__slide"
                            >
                                <MakeupCard :item="item" :dummyimage="true" :single="true"></MakeupCard>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- <div class="single-card-outer">
                    <div
                        v-for="(item, index) in featured"
                        :key="index"
                        style="
                            max-width: 300px;
                            width: 100%;
                            min-width: 250px;
                            margin-right: 12px;
                        "
                    >
                        <div class="single-card-inner">
                            <img :src="item.image" alt="" />
                            <div>
                                <p>{{ item.name }}</p>
                                <p>
                                    <img
                                        src="/assets/venues/map-pin.svg"
                                        alt=""
                                    />
                                    ECR
                                </p>
                            </div>
                            <a href="">Check availability</a>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</template>

<script>
import MakeupCard from '../commonComponents/makeupCard.vue';
import SearchHeader from '../commonComponents/searchHeader.vue';
export default {
    components: {
        MakeupCard,
        SearchHeader
    },
    props: ["states", "subcat", 'vendorcat'],
    data() {
        return {
            venueCats: this.subcat,
            banquetHalls: [
                {
                    name: "Maple Tree Hotels Silver Maple",
                    image: "/assets/venues/Banquet_Hall_1.png",
                },
                {
                    name: "Maple Tree Hotels Silver Maple",
                    image: "/assets/venues/Banquet_Hall_2.png",
                },
                {
                    name: "Maple Tree Hotels Silver Maple",
                    image: "/assets/venues/Banquet_Hall_3.png",
                },
                {
                    name: "Maple Tree Hotels Silver Maple",
                    image: "/assets/venues/Banquet_Hall_4.png",
                },
            ],
            openLawns: [
                {
                    name: "Maple Tree Hotels Silver Maple",
                    image: "/assets/venues/Open_Lawns_1.png",
                },
                {
                    name: "Maple Tree Hotels Silver Maple",
                    image: "/assets/venues/Open_Lawns_2.png",
                },
                {
                    name: "Maple Tree Hotels Silver Maple",
                    image: "/assets/venues/Open_Lawns_3.png",
                },
                {
                    name: "Maple Tree Hotels Silver Maple",
                    image: "/assets/venues/Open_Lawns_4.png",
                },
            ],
            partyHalls: [
                {
                    name: "Maple Tree Hotels Silver Maple",
                    image: "/assets/venues/Party_Halls_1.png",
                },
                {
                    name: "Maple Tree Hotels Silver Maple",
                    image: "/assets/venues/Party_Halls_2.png",
                },
                {
                    name: "Maple Tree Hotels Silver Maple",
                    image: "/assets/venues/Party_Halls_3.png",
                },
                {
                    name: "Maple Tree Hotels Silver Maple",
                    image: "/assets/venues/Party_Halls_4.png",
                },
            ],
            featured: [
                {
                    name: "Maple Tree Hotels Silver Maple",
                    image: "/assets/venues/Featured_1.png",
                },
                {
                    name: "Maple Tree Hotels Silver Maple",
                    image: "/assets/venues/Featured_2.png",
                },
                {
                    name: "Maple Tree Hotels Silver Maple",
                    image: "/assets/venues/Featured_3.png",
                },
                {
                    name: "Maple Tree Hotels Silver Maple",
                    image: "/assets/venues/Featured_4.png",
                },
            ],
            selectedVenue: null,
            selectedCity: null,
            options: this.cities,
            // venueTypes: [
            //     "Resorts",
            //     "Destination",
            //     "Beach",
            //     "Hotels",
            //     "Banquet Halls",
            //     "Lawns",
            //     "Community Center",
            // ],
            venueTypes: this.subcat,
            cont: {},
            ids: [
                "venue-slider",
                "banquet-slider",
                "lawns-slider",
                "party-slider",
                "featured-slider",
            ],
        };
    },
    methods: {
        searchVenues() {
            if (this.selectedCity == null) {
                this.$refs.citySelect.activate();
                return;
            }
            if (this.selectedVenue == null) {
                this.$refs.venueSelect.activate();
                return;
            }
            window.location.href = `/directory/vendors/venues/filtered?type=${this.selectedVenue.name}&city=${this.selectedCity}`;
        },
        setSplider() {
            let _this = this;
            this.$nextTick(function () {
                this.ids.forEach(function (item, index) {
                    _this.cont[item] = new Splide(`#${item}`, {
                        gap: 5,
                        rewind: true,
                        pagination: false,
                        cover: true,
                        isNavigation: true,
                        arrows: true,
                        breakpoints: {
                            567: {
                                arrows: false,
                                wheel: true,
                                direction: "ltr",
                                releaseWheel: false,
                            },
                        },
                    });
                    _this.cont[item].mount();
                });
            });
        },
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
<style scoped>
/* .venue-cat-cont {
    background: #f4f4f4;
    padding: 37px 0;
} */
.venue-cat-cont > h1 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 14.0881px;
    line-height: 21px;
    color: #000000;
}
/* .venue-cat-cont > div {
    display: flex;
    overflow-x: scroll;
    overflow-y: clip;
}
.venue-cat-cont > div::-webkit-scrollbar,
.single-card-outer::-webkit-scrollbar {
    display: none;
}

.venue-cat-cont > div,
.single-card-outer {
    -ms-overflow-style: none;
    scrollbar-width: none;
} */
.single-card-outer::-webkit-scrollbar {
    display: none;
}
.single-card-outer {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
.single-venue-cat {
    padding-top: 75%;
    width: 100%;
    border-radius: 9px;
    position: relative;
    display: block;
}
.single-venue-cat > img {
    position: absolute;
    top: 0;
    left: 0;
    object-fit: cover;
    width: 100%;
    height: 100%;
    z-index: 99;
    border-radius: 9px;
}
.single-venue-cat > span {
    background: #ffffff;
    border-bottom-left-radius: 9px;
    border-bottom-right-radius: 9px;
    display: block;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 16px;
    line-height: 24px;
    text-align: center;
    color: #000000;
    padding: 12px;
    width: 100%;
    position: absolute;
    z-index: 999;
    bottom: -1px;
    left: 0;
}
.venue-cat-type > h1 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 14.0881px;
    line-height: 21px;
    color: #000000;
}
/* .single-card-outer {
    display: flex;
    overflow-x: scroll;
    overflow-y: clip;
    justify-content: space-between;
} */
.single-card-inner {
    display: flex;
    flex-direction: column;
}
.single-card-inner > img {
    object-fit: cover;
    max-height: 161px;
    width: 100%;
    height: 100%;
    border-radius: 9px;
}
.single-card-inner > a {
    text-decoration: none;
    background: #461952;
    padding: 7px;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 10.2394px;
    line-height: 15px;
    color: #ffffff;
    text-align: center;
}
.single-card-inner > div > p:nth-child(1) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 11.2709px;
    line-height: 17px;
    color: #000000;
    margin-top: 15px;
    margin-bottom: 7px;
}
.single-card-inner > div > p:nth-child(2) > img {
    margin-right: 10px;
}
.single-card-inner > div > p:nth-child(2) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 300;
    font-size: 9.15762px;
    line-height: 14px;
    color: #000000;
    margin-bottom: 7px;
}
</style>
<style>
input:hover {
    background-color: #ffffff !important;
}
input {
    background-color: #ffffff !important;
}
</style>
