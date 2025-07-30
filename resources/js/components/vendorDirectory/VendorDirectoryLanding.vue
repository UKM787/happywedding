<template>
    <div>
        <searchHeader :title="'Wedding Vendors'" :description="'Browse, shortlist and get best prices and packages from venues available to host your upcoming wedding reception,pre-wedding and post-wedding functions.'" :cities="cities" :categories="subcat"></searchHeader>
        <div class="vendor-cats-cont">
            <h1 class="container">Search By: <b>Category</b></h1>
            <div id="categories-slider" class="container splide">
                <div class="splide__arrows">
                        <button class="splide__arrow splide__arrow--prev">
                            <img src="/assets/chevron-left.svg" alt="">
                        </button>
                        <button class="splide__arrow splide__arrow--next">
                            <img src="/assets/chevron-right.svg" alt="">
                        </button>
                </div>
                <div class="splide__track">
                    <ul class="splide__list">
                        <li
                            v-for="(item, index) in subcat"
                            :key="index"
                            style="
                                margin-right: 12px;
                                border: none !important;
                            "
                            class="splide__slide"
                        >
                            <a
                                @click="startLink(item)"
                                class="single-venue-cat"
                            >
                                <img
                                    :src="
                                        '/assets/directory/icons/' +
                                        item.icon
                                    "
                                    alt=""
                                />
                                <span>{{ item.name }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container vendor-common-cont">
            <div>
                <h1>Top Vendors</h1>
                <a href="">View all</a>
            </div>
            <div id="top-vendors" class="splide">
                <div class="splide__track">
                    <ul class="splide__list single-card-outer">
                        <li
                            v-for="(item, index) in subcat"
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
                            <makeupCard :item="item"></makeupCard>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container vendor-common-cont">
            <div>
                <h1>Featured Vendors</h1>
                <a href="">View all</a>
            </div>
            <div id="featured-vendors" class="splide">
                <div class="splide__track">
                    <ul class="splide__list single-card-outer">
                        <li
                            v-for="(item, index) in subcat"
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
                            <makeupCard :item="item"></makeupCard>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container vendor-common-cont">
            <div>
                <h1>Popular Searches</h1>
                <a href="">View all</a>
            </div>
            <div id="popular-vendors" class="splide">
                <div class="splide__track">
                    <ul class="splide__list single-card-outer">
                        <li
                            v-for="(item, index) in subcat"
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
                            <makeupCard :item="item"></makeupCard>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Multiselect from "vue-multiselect";
import makeupCard from "./commonComponents/makeupCard.vue";
import searchHeader from "./commonComponents/searchHeader.vue";
export default {
    components: {
        Multiselect,
        makeupCard,
        searchHeader
    },
    props: ["cities", "subcat"],
    data(){
        return {
            selectedVenue: null,
            selectedCity: null,
            cont: {},
            ids: [
                "categories-slider",
                "top-vendors",
                'popular-vendors',
                "featured-vendors"

            ],
        }
    },
    methods:{
        setSplider() {
            let _this = this;
            this.$nextTick(function () {
                this.ids.forEach(function (item, index) {
                    _this.cont[item] = new Splide(`#${item}`, {
                        gap: 5,
                        rewind: true,
                        pagination: false,
                        cover: true,
                        // isNavigation: true,
                        arrows: true,
                        autoWidth: true,
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
        startLink(item){
            if(item.path != null && item.path != ''){
                if(item.parent_id == null){
                    window.location.href = `/directory/vendors/${item.path}`;
                }else{
                    const filteredObject = this.subcat.filter(object => object.id == item?.parent_id); 
                    //console.log(filteredObject);
                    window.location.href = `/directory/vendors/${filteredObject[0].path}/filtered?type=${item.slug}`;

                }
            }else{
                window.location.href = `/directory/vendors/venues/filtered?type=${item.name}`;
            } 
        }
    },
    mounted() {
        document.onreadystatechange = () => {
            if (document.readyState == "complete") {
                this.setSplider();
            }
        };
    },

}
</script>

<style scoped>

.vendor-cats-cont{
    background: #F4F4F4;
    padding: 54px 0;
    position: relative;
}
.vendor-cats-cont > h1 {
    color: #000;
font-family: Poppins;
font-size: 18px;
font-style: normal;
font-weight: 500;
line-height: normal;
margin-bottom: 15px;
}
#categories-slider a {
    text-decoration: none;
    height: 100%;
    display: flex;
    width: 114.128px;
    padding: 14.106px;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;
    gap: 8.153px;
    border-radius: 7.694px;
    background: #FFF;
    cursor: pointer;
}

#categories-slider span {
    color: #000;
    text-align: center;
    font-family: Poppins;
    font-size: 16.62px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
}
.vendor-common-cont {
    padding: 54px 0;
}
.vendor-common-cont > div:nth-child(1) {
    display: flex;
    justify-content: space-between;
}
.vendor-common-cont > div:nth-child(1) > h1 {
    color: #000;
    font-family: Poppins;
    font-size: 18px;
    font-style: normal;
    font-weight: 500;
    line-height: normal;
    margin-bottom: 15px;
}
.vendor-common-cont > div:nth-child(1) > a {
    display: block;
    color: #461952;
    font-family: Poppins;
    font-size: 14.088px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
    text-decoration-line: underline;
    margin-bottom: 15px;
}

</style>
<style>
.categories-slider .splide__arrow{
    background:none !important;
}
.categories-slider .splide__arrow--prev {
    position: absolute;
    top: -28px;
    right: 45px;
    left: unset;
}
.categories-slider .splide__arrow--next {
    position: absolute;
    top: -28px;
    right: 10px;
    left: unset;
}
</style>