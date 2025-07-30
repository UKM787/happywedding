<template>
    <div>
        <div class="work-details-tabs">
            <button
                v-for="(item, index) in workDetailTabs"
                :key="index"
                class="work-detail-tab-single"
                :data-id="item.id"
                @click="tabClick($event)"
            >
                <div class="work-detail-tab-icon">
                    <img
                        :src="'/assets/bride/bride-work-details/' + item.icon"
                        alt=""
                        class="show"
                    />
                    <img
                        :src="'/assets/bride/dark/' + item.icon"
                        alt=""
                        class="hide"
                    />
                </div>
                <div class="work-detail-tab-content">
                    <div>{{ item.name }}</div>
                    <div class="wed-ven-cat-profile">
                        <div>
                            <img
                                src="\assets\bride\bride-work-details\Ellipse77.svg"
                                alt=""
                            />
                            <img
                                src="\assets\bride\bride-work-details\Ellipse78.svg"
                                alt=""
                            />
                            <img
                                src="\assets\bride\bride-work-details\Ellipse79.svg"
                                alt=""
                            />
                            <img
                                src="\assets\bride\bride-work-details\Ellipse80.svg"
                                alt=""
                            />
                            <img
                                src="\assets\bride\bride-work-details\Ellipse81.svg"
                                alt=""
                            />
                            <img
                                src="\assets\bride\bride-work-details\Ellipse82.svg"
                                alt=""
                            />
                        </div>
                    </div>
                </div>
            </button>
        </div>
        <div>
            <div
                v-for="(item, index) in workDetailTabs"
                :key="index"
                :id="item.id"
                class="content wed-venue-content"
            >
                <div class="wed-venue-sidebar">
                    <div class="wed-venue-sidebar-menu">
                        <div @click="open($event)">
                            <span> Locality</span>
                            <span>
                                <img
                                    src="\assets\bride\bride-work-details\sidebararrow.svg"
                                    alt=""
                            /></span>
                        </div>
                        <form action="">
                            <div>
                                <label for="vehicle1">
                                    <input
                                        type="checkbox"
                                        id="vehicle1"
                                        name="Adambakkam"
                                        value="Adambakkam"
                                    />
                                    Adambakkam</label
                                >
                            </div>
                        </form>
                    </div>
                    <div class="wed-venue-sidebar-menu">
                        <div @click="open($event)">
                            <span> No. of days</span>
                            <span>
                                <img
                                    src="\assets\bride\bride-work-details\sidebararrow.svg"
                                    alt=""
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
                        <div @click="open($event)">
                            <span> Price per day</span>
                            <span>
                                <img
                                    src="\assets\bride\bride-work-details\sidebararrow.svg"
                                    alt=""
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
                                <label for="₹50,000"> ₹50,000</label>
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
                                <label for="₹3,00,000">₹3,00,000</label>
                            </div>
                        </form>
                    </div>
                    <div class="wed-venue-sidebar-menu">
                        <div @click="open($event)">
                            <span> Services</span>
                            <span>
                                <img
                                    src="\assets\bride\bride-work-details\sidebararrow.svg"
                                    alt=""
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
                        <div @click="open($event)">
                            <span> Rating</span>
                            <span>
                                <img
                                    src="\assets\bride\bride-work-details\sidebararrow.svg"
                                    alt=""
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
                    <button>Enquire</button>
                </div>
                <div class="wed-venue-items-container">
                    <div>
                        <span @click="openSidebar($event)" id="sidebar-open"
                            ><i class="fas fa-bars"></i
                        ></span>
                        55 Results
                    </div>
                    <div class="wed-venue-items">
                        <div v-for="(item, index) in item.content" :key="index">
                            <div>
                                <a href="">
                                    <img
                                        :src="
                                            '/assets/bride/bride-work-details/' +
                                            item.img
                                        "
                                        alt=""
                                    />
                                </a>
                                <div class="wed-venue-items-desc">
                                    <a href="">
                                        <div>Studio fx</div>
                                        <div class="d-flex">
                                            <div>4.5</div>
                                            <div>
                                                <img
                                                    src="\asset\bride\bride-work-details\Star.svg"
                                                    alt=""
                                                    style="margin-top: -5px"
                                                />
                                            </div>
                                        </div>
                                    </a>
                                    <div>
                                        <p>
                                            <a href=""
                                                ><i
                                                    class="fas fa-map-marker-alt"
                                                ></i
                                            ></a>
                                            Mylapore
                                        </p>
                                        <p>30 reviews</p>
                                    </div>
                                </div>
                            </div>
                            <a href="" class="wed-venue-items-price">
                                <div>Destination wedding</div>
                                <div>₹60,000</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import $ from "jquery";
export default {
    name: "App",
    data() {
        return {
            workDetailTabs: [
                {
                    id: 1,
                    name: "Anchor/Host",
                    icon: "entypo_modern-mic.svg",
                    content: [
                        {
                            id: 1,
                            name: "Shah Henna Studio",
                            location: "Mylapore",
                            rating: "4.5",
                            title: "Heena artist",
                            price: "₹20,000",
                            img: "police_band_4929706_835x547-m.jpg",
                        },
                        {
                            id: 2,
                            name: "Shah Henna Studio",
                            location: "Mylapore",
                            rating: "4.5",
                            title: "Heena artist",
                            price: "₹20,000",
                            img: "product-500x500.jpeg",
                        },
                        {
                            id: 3,
                            name: "Shah Henna Studio",
                            location: "Mylapore",
                            rating: "4.5",
                            title: "Heena artist",
                            price: "₹20,000",
                            img: "istock-458941077-1604043825.jpg",
                        },
                        {
                            id: 4,
                            name: "Shah Henna Studio",
                            location: "Mylapore",
                            rating: "4.5",
                            title: "Heena artist",
                            price: "₹20,000",
                            img: "Best-Bridal-Henna-designs-2021-2.jpg",
                        },
                        {
                            id: 5,
                            name: "Shah Henna Studio",
                            location: "Mylapore",
                            rating: "4.5",
                            title: "Heena artist",
                            price: "₹20,000",
                            img: "Best-Bridal-Henna-designs-2021-2.jpg",
                        },
                        {
                            id: 6,
                            name: "Shah Henna Studio",
                            location: "Mylapore",
                            rating: "4.5",
                            title: "Heena artist",
                            price: "₹20,000",
                            img: "Best-Bridal-Henna-designs-2021-2.jpg",
                        },
                    ],
                },
                {
                    id: 2,
                    name: "BandBaja",
                    icon: "fa-solid_drum.svg",
                    content: [
                        {
                            id: 1,
                            name: "Shah Henna Studio",
                            location: "Mylapore",
                            rating: "4.5",
                            title: "Heena artist",
                            price: "₹20,000",
                            img: "police_band_4929706_835x547-m.jpg",
                        },
                        {
                            id: 2,
                            name: "Shah Henna Studio",
                            location: "Mylapore",
                            rating: "4.5",
                            title: "Heena artist",
                            price: "₹20,000",
                            img: "product-500x500.jpeg",
                        },
                        {
                            id: 3,
                            name: "Shah Henna Studio",
                            location: "Mylapore",
                            rating: "4.5",
                            title: "Heena artist",
                            price: "₹20,000",
                            img: "istock-458941077-1604043825.jpg",
                        },
                        {
                            id: 4,
                            name: "Shah Henna Studio",
                            location: "Mylapore",
                            rating: "4.5",
                            title: "Heena artist",
                            price: "₹20,000",
                            img: "Best-Bridal-Henna-designs-2021-2.jpg",
                        },
                        {
                            id: 5,
                            name: "Shah Henna Studio",
                            location: "Mylapore",
                            rating: "4.5",
                            title: "Heena artist",
                            price: "₹20,000",
                            img: "Best-Bridal-Henna-designs-2021-2.jpg",
                        },
                        {
                            id: 6,
                            name: "Shah Henna Studio",
                            location: "Mylapore",
                            rating: "4.5",
                            title: "Heena artist",
                            price: "₹20,000",
                            img: "Best-Bridal-Henna-designs-2021-2.jpg",
                        },
                    ],
                },
                {
                    id: 3,
                    name: "Mehendi Artist",
                    icon: "bx_bxs-donate-heart.svg",
                    content: [
                        {
                            id: 1,
                            name: "Shah Henna Studio",
                            location: "Mylapore",
                            rating: "4.5",
                            title: "Heena artist",
                            price: "₹20,000",
                            img: "Best-Bridal-Henna-designs-2021-2.jpg",
                        },
                        {
                            id: 2,
                            name: "Shah Henna Studio",
                            location: "Mylapore",
                            rating: "4.5",
                            title: "Heena artist",
                            price: "₹20,000",
                            img: "1.png",
                        },
                        {
                            id: 3,
                            name: "Shah Henna Studio",
                            location: "Mylapore",
                            rating: "4.5",
                            title: "Heena artist",
                            price: "₹20,000",
                            img: "Best-Bridal-Henna-designs-2021-2.jpg",
                        },
                        {
                            id: 4,
                            name: "Shah Henna Studio",
                            location: "Mylapore",
                            rating: "4.5",
                            title: "Heena artist",
                            price: "₹20,000",
                            img: "Best-Bridal-Henna-designs-2021-2.jpg",
                        },
                        {
                            id: 5,
                            name: "Shah Henna Studio",
                            location: "Mylapore",
                            rating: "4.5",
                            title: "Heena artist",
                            price: "₹20,000",
                            img: "Best-Bridal-Henna-designs-2021-2.jpg",
                        },
                        {
                            id: 6,
                            name: "Shah Henna Studio",
                            location: "Mylapore",
                            rating: "4.5",
                            title: "Heena artist",
                            price: "₹20,000",
                            img: "Best-Bridal-Henna-designs-2021-2.jpg",
                        },
                    ],
                },
                {
                    id: 4,
                    name: "Bridal designers",
                    icon: "entypo_modern-mic.svg",
                    content: [
                        {
                            id: 1,
                            name: "Shah Henna Studio",
                            location: "Mylapore",
                            rating: "4.5",
                            title: "Heena artist",
                            price: "₹20,000",
                            img: "police_band_4929706_835x547-m.jpg",
                        },
                        {
                            id: 2,
                            name: "Shah Henna Studio",
                            location: "Mylapore",
                            rating: "4.5",
                            title: "Heena artist",
                            price: "₹20,000",
                            img: "product-500x500.jpeg",
                        },
                        {
                            id: 3,
                            name: "Shah Henna Studio",
                            location: "Mylapore",
                            rating: "4.5",
                            title: "Heena artist",
                            price: "₹20,000",
                            img: "istock-458941077-1604043825.jpg",
                        },
                        {
                            id: 4,
                            name: "Shah Henna Studio",
                            location: "Mylapore",
                            rating: "4.5",
                            title: "Heena artist",
                            price: "₹20,000",
                            img: "Best-Bridal-Henna-designs-2021-2.jpg",
                        },
                        {
                            id: 5,
                            name: "Shah Henna Studio",
                            location: "Mylapore",
                            rating: "4.5",
                            title: "Heena artist",
                            price: "₹20,000",
                            img: "Best-Bridal-Henna-designs-2021-2.jpg",
                        },
                        {
                            id: 6,
                            name: "Shah Henna Studio",
                            location: "Mylapore",
                            rating: "4.5",
                            title: "Heena artist",
                            price: "₹20,000",
                            img: "Best-Bridal-Henna-designs-2021-2.jpg",
                        },
                    ],
                },
                {
                    id: 5,
                    name: "Food Catering ",
                    icon: "ic_baseline-food-bank.svg",
                    content: [
                        {
                            id: 1,
                            name: "Shah Henna Studio",
                            location: "Mylapore",
                            rating: "4.5",
                            title: "Heena artist",
                            price: "₹20,000",
                            img: "Best-Bridal-Henna-designs-2021-2.jpg",
                        },
                        {
                            id: 2,
                            name: "Shah Henna Studio",
                            location: "Mylapore",
                            rating: "4.5",
                            title: "Heena artist",
                            price: "₹20,000",
                            img: "1.png",
                        },
                        {
                            id: 3,
                            name: "Shah Henna Studio",
                            location: "Mylapore",
                            rating: "4.5",
                            title: "Heena artist",
                            price: "₹20,000",
                            img: "Best-Bridal-Henna-designs-2021-2.jpg",
                        },
                        {
                            id: 4,
                            name: "Shah Henna Studio",
                            location: "Mylapore",
                            rating: "4.5",
                            title: "Heena artist",
                            price: "₹20,000",
                            img: "Best-Bridal-Henna-designs-2021-2.jpg",
                        },
                        {
                            id: 5,
                            name: "Shah Henna Studio",
                            location: "Mylapore",
                            rating: "4.5",
                            title: "Heena artist",
                            price: "₹20,000",
                            img: "Best-Bridal-Henna-designs-2021-2.jpg",
                        },
                        {
                            id: 6,
                            name: "Shah Henna Studio",
                            location: "Mylapore",
                            rating: "4.5",
                            title: "Heena artist",
                            price: "₹20,000",
                            img: "Best-Bridal-Henna-designs-2021-2.jpg",
                        },
                    ],
                },
                {
                    id: 6,
                    name: "Dj/ music arist",
                    icon: "bi_music_note_beamed.svg",
                    content: [
                        {
                            id: 1,
                            name: "Shah Henna Studio",
                            location: "Mylapore",
                            rating: "4.5",
                            title: "Heena artist",
                            price: "₹20,000",
                            img: "Best-Bridal-Henna-designs-2021-2.jpg",
                        },
                        {
                            id: 2,
                            name: "Shah Henna Studio",
                            location: "Mylapore",
                            rating: "4.5",
                            title: "Heena artist",
                            price: "₹20,000",
                            img: "1.png",
                        },
                        {
                            id: 3,
                            name: "Shah Henna Studio",
                            location: "Mylapore",
                            rating: "4.5",
                            title: "Heena artist",
                            price: "₹20,000",
                            img: "Best-Bridal-Henna-designs-2021-2.jpg",
                        },
                        {
                            id: 4,
                            name: "Shah Henna Studio",
                            location: "Mylapore",
                            rating: "4.5",
                            title: "Heena artist",
                            price: "₹20,000",
                            img: "Best-Bridal-Henna-designs-2021-2.jpg",
                        },
                        {
                            id: 5,
                            name: "Shah Henna Studio",
                            location: "Mylapore",
                            rating: "4.5",
                            title: "Heena artist",
                            price: "₹20,000",
                            img: "Best-Bridal-Henna-designs-2021-2.jpg",
                        },
                        {
                            id: 6,
                            name: "Shah Henna Studio",
                            location: "Mylapore",
                            rating: "4.5",
                            title: "Heena artist",
                            price: "₹20,000",
                            img: "Best-Bridal-Henna-designs-2021-2.jpg",
                        },
                    ],
                },
                {
                    id: 7,
                    name: "Anchor/Host",
                    icon: "entypo_modern-mic.svg",
                    content: [
                        {
                            id: 1,
                            name: "Shah Henna Studio",
                            location: "Mylapore",
                            rating: "4.5",
                            title: "Heena artist",
                            price: "₹20,000",
                            img: "Best-Bridal-Henna-designs-2021-2.jpg",
                        },
                        {
                            id: 2,
                            name: "Shah Henna Studio",
                            location: "Mylapore",
                            rating: "4.5",
                            title: "Heena artist",
                            price: "₹20,000",
                            img: "1.png",
                        },
                        {
                            id: 3,
                            name: "Shah Henna Studio",
                            location: "Mylapore",
                            rating: "4.5",
                            title: "Heena artist",
                            price: "₹20,000",
                            img: "Best-Bridal-Henna-designs-2021-2.jpg",
                        },
                        {
                            id: 4,
                            name: "Shah Henna Studio",
                            location: "Mylapore",
                            rating: "4.5",
                            title: "Heena artist",
                            price: "₹20,000",
                            img: "Best-Bridal-Henna-designs-2021-2.jpg",
                        },
                        {
                            id: 5,
                            name: "Shah Henna Studio",
                            location: "Mylapore",
                            rating: "4.5",
                            title: "Heena artist",
                            price: "₹20,000",
                            img: "Best-Bridal-Henna-designs-2021-2.jpg",
                        },
                        {
                            id: 6,
                            name: "Shah Henna Studio",
                            location: "Mylapore",
                            rating: "4.5",
                            title: "Heena artist",
                            price: "₹20,000",
                            img: "Best-Bridal-Henna-designs-2021-2.jpg",
                        },
                    ],
                },
                {
                    id: 8,
                    name: "Ghoriwala",
                    icon: "maki_horse-riding-11.svg",
                    content: [
                        {
                            id: 1,
                            name: "Shah Henna Studio",
                            location: "Mylapore",
                            rating: "4.5",
                            title: "Heena artist",
                            price: "₹20,000",
                            img: "Best-Bridal-Henna-designs-2021-2.jpg",
                        },
                        {
                            id: 2,
                            name: "Shah Henna Studio",
                            location: "Mylapore",
                            rating: "4.5",
                            title: "Heena artist",
                            price: "₹20,000",
                            img: "1.png",
                        },
                        {
                            id: 3,
                            name: "Shah Henna Studio",
                            location: "Mylapore",
                            rating: "4.5",
                            title: "Heena artist",
                            price: "₹20,000",
                            img: "Best-Bridal-Henna-designs-2021-2.jpg",
                        },
                        {
                            id: 4,
                            name: "Shah Henna Studio",
                            location: "Mylapore",
                            rating: "4.5",
                            title: "Heena artist",
                            price: "₹20,000",
                            img: "Best-Bridal-Henna-designs-2021-2.jpg",
                        },
                        {
                            id: 5,
                            name: "Shah Henna Studio",
                            location: "Mylapore",
                            rating: "4.5",
                            title: "Heena artist",
                            price: "₹20,000",
                            img: "Best-Bridal-Henna-designs-2021-2.jpg",
                        },
                        {
                            id: 6,
                            name: "Shah Henna Studio",
                            location: "Mylapore",
                            rating: "4.5",
                            title: "Heena artist",
                            price: "₹20,000",
                            img: "Best-Bridal-Henna-designs-2021-2.jpg",
                        },
                    ],
                },
                {
                    id: 9,
                    name: "Bridal jewellery",
                    icon: "maki_jewelry-store-15.svg",
                    content: [
                        {
                            id: 1,
                            name: "Shah Henna Studio",
                            location: "Mylapore",
                            rating: "4.5",
                            title: "Heena artist",
                            price: "₹20,000",
                            img: "Best-Bridal-Henna-designs-2021-2.jpg",
                        },
                        {
                            id: 2,
                            name: "Shah Henna Studio",
                            location: "Mylapore",
                            rating: "4.5",
                            title: "Heena artist",
                            price: "₹20,000",
                            img: "1.png",
                        },
                        {
                            id: 3,
                            name: "Shah Henna Studio",
                            location: "Mylapore",
                            rating: "4.5",
                            title: "Heena artist",
                            price: "₹20,000",
                            img: "Best-Bridal-Henna-designs-2021-2.jpg",
                        },
                        {
                            id: 4,
                            name: "Shah Henna Studio",
                            location: "Mylapore",
                            rating: "4.5",
                            title: "Heena artist",
                            price: "₹20,000",
                            img: "Best-Bridal-Henna-designs-2021-2.jpg",
                        },
                        {
                            id: 5,
                            name: "Shah Henna Studio",
                            location: "Mylapore",
                            rating: "4.5",
                            title: "Heena artist",
                            price: "₹20,000",
                            img: "Best-Bridal-Henna-designs-2021-2.jpg",
                        },
                        {
                            id: 6,
                            name: "Shah Henna Studio",
                            location: "Mylapore",
                            rating: "4.5",
                            title: "Heena artist",
                            price: "₹20,000",
                            img: "Best-Bridal-Henna-designs-2021-2.jpg",
                        },
                    ],
                },
                {
                    id: 10,
                    name: "Lightening",
                    icon: "teenyicons_bulb-on-solid.svg",
                    content: [
                        {
                            id: 1,
                            name: "Shah Henna Studio",
                            location: "Mylapore",
                            rating: "4.5",
                            title: "Heena artist",
                            price: "₹20,000",
                            img: "Best-Bridal-Henna-designs-2021-2.jpg",
                        },
                        {
                            id: 2,
                            name: "Shah Henna Studio",
                            location: "Mylapore",
                            rating: "4.5",
                            title: "Heena artist",
                            price: "₹20,000",
                            img: "1.png",
                        },
                        {
                            id: 3,
                            name: "Shah Henna Studio",
                            location: "Mylapore",
                            rating: "4.5",
                            title: "Heena artist",
                            price: "₹20,000",
                            img: "Best-Bridal-Henna-designs-2021-2.jpg",
                        },
                        {
                            id: 4,
                            name: "Shah Henna Studio",
                            location: "Mylapore",
                            rating: "4.5",
                            title: "Heena artist",
                            price: "₹20,000",
                            img: "Best-Bridal-Henna-designs-2021-2.jpg",
                        },
                        {
                            id: 5,
                            name: "Shah Henna Studio",
                            location: "Mylapore",
                            rating: "4.5",
                            title: "Heena artist",
                            price: "₹20,000",
                            img: "Best-Bridal-Henna-designs-2021-2.jpg",
                        },
                        {
                            id: 6,
                            name: "Shah Henna Studio",
                            location: "Mylapore",
                            rating: "4.5",
                            title: "Heena artist",
                            price: "₹20,000",
                            img: "Best-Bridal-Henna-designs-2021-2.jpg",
                        },
                    ],
                },
            ],
        };
    },
    methods: {
        openSidebar(e) {
            let sideBar = $(e.target)
                .parents(".wed-venue-items-container")
                .prev();
            let items = $(e.target).parents(".wed-venue-items-container");
            let layout = items.parent();

            var screenWidth = layout.innerWidth();
            var hide = screenWidth - 220;
            if (sideBar.css("display") === "block") {
                console.log("help");
                sideBar.css("display", "");
                layout.css("display", "");
                items.css("width", "");
                items.css("overflow", "");
            } else {
                sideBar.css("display", "block");
                layout.css("display", "grid");
                items.css("width", hide + "px");
                items.css("overflow", "hidden");
            }
        },
        open(e) {
            let item = e.currentTarget.parentNode;
            if (item.classList.contains("show-drop")) {
                item.classList.remove("show-drop");
            } else {
                $(".wed-venue-sidebar-menu").removeClass("show-drop");
                item.classList.add("show-drop");
            }
        },
        tabClick(e) {
            let icon = $(e.currentTarget).children(".work-detail-tab-icon");
            let text = $(e.currentTarget).children(".work-detail-tab-content");
            $(".work-detail-tab-content").removeClass("active");
            $(".work-detail-tab-icon").removeClass("active");

            text.addClass("active");
            icon.addClass("active");

            let id = e.currentTarget.dataset.id;
            let btns = e.currentTarget.parentElement.children;
            let content = e.currentTarget.parentElement.nextElementSibling;
            console.log(id);
            if (id) {
                $(btns).removeClass("active");
                e.currentTarget.classList.add("active");
                $(content).children().removeClass("active");
                $(content).find(`#${id}`).addClass("active");
            }
        },
    },
    mounted: function () {
        this.$nextTick(function () {
            $(".work-detail-tab-single").eq(0).addClass("active");
            $(".work-detail-tab-single").children().eq(0).addClass("active");
            $(".work-detail-tab-single").children().eq(1).addClass("active");
            $(".wed-venue-content").eq(0).addClass("active");
            console.log();
        });
    },
    created: function () {
        window.addEventListener("resize", function () {
            var sideOpen = document.getElementById("sidebar-open");
            var sideBar = document.querySelector(".wed-venue-sidebar");
            var layout = document.querySelector(".wed-venue-content");
            var items = document.querySelector(".wed-venue-items-container");

            sideBar.style.display = null;
            layout.style.display = null;
            items.style.width = null;
            items.style.overflow = null;
        });
    },
};
</script>

<style scoped>
/* category tab buttons css starts */
.hide {
    display: none;
}
.show {
    display: block;
}
.active .show {
    display: none;
}
.active .hide {
    display: block;
}
.work-details-tabs {
    padding: 2em 0;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(120px, 125px));
    column-gap: 10px;
    row-gap: 2.5em;
    justify-content: space-around;
}
.work-detail-tab-single {
    position: relative;
    width: 100%;
    border: none;
    outline: 0;
    background-color: inherit;
}
.work-detail-tab-icon {
    background: #461952;
    border-radius: 41px;
    width: 41px;
    height: 41px;
    position: absolute;
    left: 40px;
    top: -25px;
}
.work-detail-tab-icon > img {
    padding: 10px 11px;
}
.work-detail-tab-content {
    box-shadow: 0px 0px 0.5px 0.5px rgba(0, 0, 0, 0.25);
    border-radius: 16px;
    width: max-content;
    padding: 1em 0.3em;
    padding-top: 1.5em;
    width: 100%;
}
.work-detail-tab-content.active {
    color: #461952;
    background-color: #ffffff;
}
.work-detail-tab-icon.active {
    background-color: #ffffff;
}
.work-detail-tab-content > div:nth-child(1) {
    font-family: Segoe UI;
    font-style: normal;
    font-weight: 600;
    font-size: 10px;
    line-height: 13px;
    color: #000000;
    white-space: nowrap;
    text-overflow: ellipsis;
    overflow: hidden;
    text-align: center;
    width: 100%;
}
.wed-ven-cat-profile {
    margin: auto;
    padding: 10px 0;
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
/* category tab buttons css ends */

/* Section-2(sidebar) CSS start */
.wed-venue-content {
    display: grid;
    grid-template-columns: minmax(200px, 400px) minmax(70%, auto);
}
.wed-venue-sidebar {
    height: 100%;
    background-color: white;
    padding: 23px;
}
.wed-venue-sidebar-menu > div:nth-child(1) {
    display: flex;
    justify-content: space-between;
    margin-bottom: 1.75em;
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
    color: #999999;
}
.show-drop > form {
    display: block !important;
}
.wed-venue-sidebar > button {
    background: #461952;
    border-radius: 3px;
    font-style: normal;
    font-weight: normal;
    font-size: 14.0798px;
    line-height: 19px;
    text-align: center;
    color: #ffffff;
    outline: 0;
    border: none;
    padding: 0.7em 3.5em;
    margin-top: 1em;
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
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    grid-auto-rows: 1fr;
    grid-column-gap: 10px;
    grid-row-gap: 20px;
    padding: 20px;
    justify-content: space-between;
}
.wed-venue-items > div {
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
}
.wed-venue-items a {
    text-decoration: none;
    color: inherit;
}
.wed-venue-items > div > div {
    position: relative;
    height: 100%;
}
.wed-venue-items > div > div > a > img {
    width: 100%;
    border-radius: 14.6552px;
    cursor: pointer;
    height: 100%;
    object-fit: cover;
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
.wed-venue-items-desc > a {
    display: flex;
    justify-content: space-between;
    margin: 4px 0;
    cursor: pointer;
}
.wed-venue-items-desc > a > div:nth-child(1) {
    font-family: Segoe UI;
    font-style: normal;
    font-weight: normal;
    font-size: 14.6552px;
    line-height: 19px;
    color: #000000;
    align-self: center;
}
.wed-venue-items-desc > a > div:nth-child(2) > div:nth-child(1) {
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
.wed-venue-items-desc > a > div:nth-child(2) > div:nth-child(2) {
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
    cursor: pointer;
}
.wed-venue-items-price > div:nth-child(1) {
    font-family: Segoe UI;
    font-style: normal;
    font-weight: 350;
    font-size: 10.9914px;
    line-height: 15px;
    color: #a79c9c;
}
.wed-venue-items-price > div:nth-child(1) {
    font-family: Segoe UI;
    font-style: normal;
    font-weight: bold;
    font-size: 14.2888px;
    line-height: 19px;
    color: #7f004b;
}
/* Section-2(sidebar) CSS end */
/* navtab css start */

.content {
    display: none;
}
.tab-btn.active {
    background: #7f004b;
    color: white;
}
.content.active {
    display: grid;
}

@media only screen and (max-width: 768px) {
    .wed-venue-sidebar {
        display: none;
    }
    .wed-venue-content {
        display: block;
    }
    .content.active {
        display: block;
    }
    #sidebar-open {
        display: inline-block;
    }
}
</style>
