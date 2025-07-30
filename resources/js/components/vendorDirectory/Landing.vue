<template>
    <div>
        <!-- <carousel-3d :border="0" :perspective="0" class="cards">
            <slide
                v-for="(item, index) in priceCards"
                :key="index"
                :index="index"
            >
                <div class="price-card-container">
                    <div>
                        <div :style="item.color" class="plan">
                            {{ item.type }}
                        </div>
                    </div>
                    <div class="details-cont">
                        <div>/Per Month</div>
                        <div style="text-align: center">
                            <span>₹</span><span>{{ item.price }}</span>
                        </div>
                        <div>
                            "Lorem ipsum dolor sit hjbsdc jsnznxk
                            amet,consectetur adipiscing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua.
                            Ut enim ad minim veniam, quis nostru exercitation.
                        </div>
                        <div class="pros">
                            <img src="/assets/Vector3.svg" alt="" />
                            <span
                                >illo inventore veritatis et quasi architecto
                                beatae vitae</span
                            >
                        </div>
                        <div class="pros">
                            <img src="/assets/Vector3.svg" alt="" />
                            <span
                                >quis nostrum exercitationem ullam corporis
                                suscipit laboriosam, nisi ut aliquid ex ea
                                commodi consequatur? Quis autem vel</span
                            >
                        </div>
                        <div class="pros">
                            <img src="/assets/Vector4.svg" alt="" />
                            <span
                                >Duis aute irure dolor in reprehenderit in
                                voluptate velit esse cillum dolore eu
                            </span>
                        </div>
                        <div class="pros">
                            <img src="/assets/Vector4.svg" alt="" />
                            <span
                                >eius modi tempora incidunt ut labore et dolore
                                magnam aliquam quaerat voluptatem.</span
                            >
                        </div>
                        <div style="text-align: center; margin: 1em 0">
                            <button class="buy">Buy Now</button>
                        </div>
                    </div>
                </div>
            </slide>
        </carousel-3d> -->
        <div class="ven-land-main-cont">
            <section class="wed-ven-main">
                <div style="position: relative">
                    <img
                        src="/assets/vendors/landing/Frame91.png"
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
                    <p>Find Professional Wedding Vendors In Town</p>
                    <div>
                        <form
                            action=""
                            style="
                                display: flex;
                                justify-content: space-between;
                            "
                        >
                            <select
                                id="states"
                                name="states"
                                v-model="states.userSelected"
                            >
                                <option hidden disabled selected value></option>
                                <option
                                    v-for="(value, index) in states.default"
                                    :key="index"
                                >
                                    {{ value.name }}
                                </option>
                            </select>

                            <div id="search">
                                <input
                                    type="text"
                                    placeholder="Wedding venues, wedding photographers, makeup artists, Mehendi artists......"
                                />
                            </div>
                            <button type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </section>

            <section class="wed-ven-cat container">
                <h1 style="margin-bottom: 2em">Vendors listing category</h1>
                <div>
                    <a
                        :href="'/directory/vendors/' + category.path"
                        v-for="(category, index) in categories"
                        :key="index"
                    >
                        <div class="wed-ven-cat-items">
                            <div>
                                <img
                                    :src="
                                        '/assets/defaults/vendors/icons/' +
                                        category.icon
                                    "
                                    alt=""
                                />
                                <div>{{ category.name }}</div>
                            </div>
                            <div class="wed-ven-cat-profile">
                                <div>
                                    <img
                                        src="/assets/vendors/landing/Ellipse77.svg"
                                        alt=""
                                    />
                                    <img
                                        src="/assets/vendors/landing/Ellipse78.svg"
                                        alt=""
                                    />
                                    <img
                                        src="/assets/vendors/landing/Ellipse79.svg"
                                        alt=""
                                    />
                                    <img
                                        src="/assets/vendors/landing/Ellipse80.svg"
                                        alt=""
                                    />
                                    <img
                                        src="/assets/vendors/landing/Ellipse81.svg"
                                        alt=""
                                    />
                                    <img
                                        src="/assets/vendors/landing/Ellipse82.svg"
                                        alt=""
                                    />
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </section>

            <section class="wed-ven-featured container">
                <h1 style="margin-bottom: 2em">Featured</h1>
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
                                    <div class="wed-ven-cat-profile">
                                        <img
                                            src="/assets/vendors/landing/Ellipse77.svg"
                                            alt=""
                                        />
                                        <img
                                            src="/assets/vendors/landing/Ellipse78.svg"
                                            alt=""
                                        />
                                        <img
                                            src="/assets/vendors/landing/Ellipse79.svg"
                                            alt=""
                                        />
                                        <img
                                            src="/assets/vendors/landing/Ellipse80.svg"
                                            alt=""
                                        />
                                        <img
                                            src="/assets/vendors/landing/Ellipse81.svg"
                                            alt=""
                                        />
                                        <img
                                            src="/assets/vendors/landing/Ellipse82.svg"
                                            alt=""
                                        />
                                    </div>
                                    <div>23 People</div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </section>

            <section class="wed-ven-featured container">
                <h1 style="margin-bottom: 2em">Popular searches</h1>
                <div>
                    <a
                        href=""
                        v-for="(item, index) in popluarSearches"
                        :key="index"
                    >
                        <div class="wed-ven-featured-items">
                            <img
                                src="/assets/vendors/landing/Frame870.png"
                                alt=""
                                width="100%"
                            />
                            <div>
                                <div class="wed-ven-subhead">
                                    {{ item.name }}
                                </div>

                                <div class="wed-ven-desc">
                                    <div class="wed-ven-cat-profile">
                                        <img
                                            src="/assets/vendors/landing/Ellipse77.svg"
                                            alt=""
                                        />
                                        <img
                                            src="/assets/vendors/landing/Ellipse78.svg"
                                            alt=""
                                        />
                                        <img
                                            src="/assets/vendors/landing/Ellipse79.svg"
                                            alt=""
                                        />
                                        <img
                                            src="/assets/vendors/landing/Ellipse80.svg"
                                            alt=""
                                        />
                                        <img
                                            src="/assets/vendors/landing/Ellipse81.svg"
                                            alt=""
                                        />
                                        <img
                                            src="/assets/vendors/landing/Ellipse82.svg"
                                            alt=""
                                        />
                                    </div>
                                    <div>23 People</div>
                                </div>
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
import { Carousel3d, Slide } from "vue-carousel-3d";

export default {
    name: "App",
    components: {
        "carousel-3d": Carousel3d,
        slide: Slide,
    },
    props: ["testimonials", 'categories'],

    data() {
        return {
            priceCards: [
                {
                    id: 1,
                    type: "Gold",
                    price: 3500,
                    color: "background-color:#ffb300;",
                },
                {
                    id: 2,
                    type: "Bronze",
                    price: 1500,
                    color: "background-color:#cd7f32;",
                },
                {
                    id: 3,
                    type: "Silver",
                    price: 3500,
                    color: "background-color:#c0c0c0;",
                },
                {
                    id: 4,
                    type: "Platinum",
                    price: 5500,
                    color: "background-color:#a663cc;",
                },
                {
                    id: 5,
                    type: "Diamond",
                    price: 4500,
                    color: "background-color:#6f2dbd;",
                },
            ],
            slides: 7,
            states: {
                default: [
                    { id: 1, name: "Delhi" },
                    { id: 2, name: "Mumbai" },
                    { id: 3, name: "Chennai" },
                    { id: 4, name: "Pune" },
                ],
                userSelected: "",
            },
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
                    name: "Lightening",
                    mainImg: "Frame970.png",
                },
                {
                    id: 2,
                    name: "Venues",
                    mainImg: "Frame873.png",
                },
                {
                    id: 3,
                    name: "Invitations",
                    mainImg: "Frame892.png",
                },
                {
                    id: 4,
                    name: "Catering",
                    mainImg: "Frame880.png",
                },
            ],
            testimonialsCounter: 0,
            testimonialList: JSON.parse(this.testimonials),
        };
    },
    methods: {
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
    },
    mounted() {
        // this.$nextTick(function () {
        //     axios.get("/wedding/vendorMasterList").then((response) => {
        //         this.categories = response.data.filter(function (el) {
        //             return el.parent_id == null;
        //         });
        //         //let test = document.querySelectorAll(".wed-ven-cat-items");
        //         //console.log(test);
        //         //console.log(response.data);
        //     });
        // });
    },
    computed: {},
};
</script>

<style scoped>
/* price card css start */
.price-card-container {
    padding-left: 19px;
    width: max-content;
    align-self: center;
}
.price-card-container > div:nth-child(1) {
    padding-bottom: 20px;
    position: absolute;
}
.price-card-container > div:nth-child(1)::before {
    content: "";
    display: block;
    clip-path: polygon(0 62%, 28% 62%, 28% 100%, 28% 100%);
    width: 65px;
    height: 50px;
    background: #04262e;
    z-index: 99999;
    top: 26px;
    position: absolute;
    margin-left: -17px;
}
.plan {
    font-family: Josefin Sans;
    font-style: normal;
    font-weight: 600;
    font-size: 18.4072px;
    line-height: 18px;
    color: #ffffff;
    /* background: linear-gradient(90.27deg, #9b3154 1.62%, #6d223b 95.36%); */
    width: 111px;
    height: 37px;
    clip-path: polygon(0 0, 69% 0, 100% 100%, 0 100%);
    margin-left: -17px;
    position: absolute;
    top: 20px;
}
.details-cont {
    background: #ffffff;
    border-radius: 20px;
    padding: 1.5em 2em;
    padding-top: 5em;
    width: 266px;
}
.details-cont > div:nth-child(1) {
    font-family: Inter;
    font-style: normal;
    font-weight: normal;
    font-size: 11.1324px;
    line-height: 13px;
    color: #464646;
    text-align: right;
    padding-right: 6em;
}
.details-cont > div:nth-child(2) > span:nth-child(1) {
    font-family: Inter;
    font-style: normal;
    font-weight: bold;
    font-size: 33.6722px;
    line-height: 41px;
    color: #000000;
    padding-right: 10px;
}

.details-cont > div:nth-child(2) > span:nth-child(2) {
    font-family: Inter;
    font-style: normal;
    font-weight: bold;
    font-size: 49.4522px;
    line-height: 60px;
    color: #000000;
}
.details-cont > div:nth-child(3) {
    font-family: Josefin Sans;
    font-style: normal;
    font-weight: normal;
    font-size: 12px;
    line-height: 12px;
    color: #000000;
    margin-top: 1em;
    margin-bottom: 1.5em;
}
.pros {
    font-family: Josefin Sans;
    font-style: normal;
    font-weight: normal;
    font-size: 9px;
    line-height: 9px;
    color: #5e5e5e;
    display: flex;
    margin-bottom: 10px;
}
.pros > img {
    margin-right: 12px;
    width: 16px;
    height: 16px;
}
.pros > span {
    vertical-align: middle;
}
.buy {
    font-family: Josefin Sans;
    font-style: normal;
    font-weight: 600;
    font-size: 11.3478px;
    line-height: 11px;
    color: #ffffff;
    border: none;
    outline: 0;
    background: linear-gradient(90deg, #9b3154 0%, #6d223b 100%);
    border-radius: 20px;
    padding: 12px 28px;
}
/* price card css end */
body {
    margin: 0;
    padding: 0;
    width: 100%;
    height: 100%;
    box-sizing: border-box;
}
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
    font-family: Rage Italic;
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
.wed-ven-main-search > div > form > select {
    padding: 11px 0;
    padding-left: 22px;
    border: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    background: #ffffff;
    border-radius: 5px;
    background-image: url("/assets/vendors/landing/twemoji_flag-for-flag-india.svg"),
        url("/assets/vendors/landing/dropdown.svg");
    background-repeat: no-repeat, no-repeat;
    background-position: 2%, 98%;
    background-size: 20px, 20px;
    width: 25%;
    border: none;
}
.wed-ven-main-search > div > form > select > option {
    font-family: Segoe UI;
    font-style: normal;
    font-weight: normal;
    font-size: 10px;
    line-height: 13px;
    color: #3d3838;
}
#search {
    width: 55%;
}
#search > input {
    width: 100%;
    padding: 11px;
    background-color: #ffffff;
    border-radius: 5px;
    border: none;
    background-image: url("/assets/vendors/landing/Group.svg");
    background-repeat: no-repeat;
    background-position: 1.5% 49%;
    background-size: 20px;
    padding-left: 40px;
}
#search > input::placeholder {
    font-family: Segoe UI;
    font-style: normal;
    font-weight: normal;
    font-size: 10px;
    line-height: 13px;
    color: rgba(0, 0, 0, 0.3);
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

/* Section-2(vendor category listing) CSS start */
.wed-ven-cat {
    margin-bottom: 2em;
}
.wed-ven-cat > h1 {
    font-family: Segoe UI;
    font-style: normal;
    font-weight: 600;
    font-size: 25px;
    line-height: 33px;
    color: #000000;
}
.wed-ven-cat > div {
    padding: 2.4em 3em;
    /* display: grid;
        grid-template-columns: repeat(auto-fill,minmax(150px, 1fr)); */
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    background: #ffffff;
    box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.25);
    border-radius: 4.99587px;
    overflow-y: auto;
    height: 300px;
}
.wed-ven-cat > div > a {
    display: block;
    text-decoration: none;
    flex: 150px 0 1;
    margin: 0 10px;
    margin-bottom: 10px;
}
.wed-ven-cat-items {
    font-family: Segoe UI;
    font-style: normal;
    font-weight: normal;
    font-size: 9.99174px;
    line-height: 13px;
    text-align: center;
    color: #6c6c6c;
    text-align: center;
    margin: 15px 0;
    position: relative;
    height: 100%;
    display: flex;
    flex-direction: column;
}
.wed-ven-cat-items > div:nth-child(1) {
    padding: 0 34px;
}
.wed-ven-cat-items > div:nth-child(1) > img {
    margin-bottom: 30px;
    width: 30px;
    height: 30px;
}
.wed-ven-cat-items > div:nth-child(1) > div {
    padding-bottom: 11px;
}
.wed-ven-cat-profile {
    margin: auto auto 0px auto;
    bottom: 0;
    left: 19px;
}
.wed-ven-cat-profile > div {
    display: flex;
    width: 50%;
    margin: auto;
}
.wed-ven-cat-profile img:nth-child(2) {
    /* transform: translate(-74%); */
    position: relative;
    /* top: 8%; */
    left: -10px;
}
.wed-ven-cat-profile img:nth-child(3) {
    /* transform: tran  slate(-136%); */
    position: relative;
    /* top: 8%; */
    left: -20px;
}
.wed-ven-cat-profile img:nth-child(4) {
    /* transform: translate(-200%); */
    position: relative;
    /* top: 8%; */
    left: -30px;
}
.wed-ven-cat-profile img:nth-child(5) {
    /* transform: translate(-274%); */
    position: relative;
    left: -40px;
}
.wed-ven-cat-profile img:nth-child(6) {
    position: relative;
    left: -50px;
}
/* Section-2(vendor category listing) CSS end */

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

<style>
.cards {
    height: 500px !important;
    position: absolute !important;
    z-index: 99999 !important;
}
.cards > div {
    height: 100% !important;
    width: 360px !important;
}
.cards > div > div {
    background-color: transparent;
    width: auto !important;
    height: 100% !important;
}
</style>
