<template>
    <div>
        <section class="container">
            <div class="wed-ven-single-head">
                <div style="flex: 1">
                    <p>
                        {{ accomodationDetails.name }}
                    </p>
                    <p>
                        {{ accomodationDetails.district }},
                        {{ accomodationDetails.state }}
                        {{ accomodationDetails.zipcode }} (<a>view on map</a>)
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
                    <div style="text-align: right">
                        <a href="">
                            <img
                                src="/assets/single-venue-page/facebook.svg"
                                alt=""
                            />
                        </a>
                        <a href="">
                            <img
                                src="/assets/single-venue-page/instagram.svg"
                                alt=""
                            />
                        </a>
                        <a href="">
                            <img
                                src="/assets/single-venue-page/snapchat.svg"
                                alt=""
                            />
                        </a>
                        <a href="">
                            <img
                                src="/assets/single-venue-page/twitter.svg"
                                alt=""
                            />
                        </a>
                    </div>
                </div>
            </div>
            <div class="wed-ven-single-mainImg">
                <img
                    v-if="accomodationDetails.images != null"
                    :src="
                        '/assets/vendors/uploads/' +
                        accomodationDetails.images[0]
                    "
                    alt=""
                />
                <img
                    v-else
                    src="
                        /assets/vendors/accomodations/hotelmainimg.png
                    "
                    alt=""
                />
                <div>
                    <button type="button" style="margin-rght: 10px">
                        <img
                            src="/assets/vendors/accomodations/save.svg"
                            alt=""
                        />
                    </button>
                    <button type="button">
                        <img
                            src="/assets/vendors/accomodations/share.svg"
                            alt=""
                        />
                    </button>
                </div>
            </div>
            <div class="wed-ven-single-aboutcontent" style="margin-bottom: 2em">
                <div>
                    <span style="font-weight: 400">About </span
                    >{{ accomodationDetails.name }} -
                    {{ accomodationDetails.state }}
                    {{ accomodationDetails.zipcode }}
                </div>
                <div>
                    {{ accomodationDetails.about }}
                    <!-- Conveniently located in the heart of Old Mahabalipuram Road,
                    Holiday Inn Express Chennai OMR Thoraipakkam, is the smart
                    choice for smart travellers looking for a comfortable and
                    hassle-free stay. The hotel is strategically located near
                    the IT Tech parks like Ascendas Tech Park 7.3 km, Tidel Park
                    7 km ,Elcot SEZ 5 km, Futura Tech Park 4 km, Apollo Hospital
                    7 km and Marina Mall are 7 km,ECR Beach 6 km, ISKON Temple 2
                    km, Mahabalipuram UNESCO World heritage site is 36 km away.
                    Gleneagles Global Health City 6 km, Chettinad Hospital 3 km
                    away. The hotel is a 35 minute drive from the Chennai
                    International Airport.<br /><br />
                    Holiday Inn Express Chennai OMR Thoraipakkam offers an
                    all-inclusive breakfast and shower facilities. Guests can
                    enjoy complimentary high-speed internet access while room
                    amenities include a 43'' LED TV, tea/coffee maker, minibar,
                    refrigerator and a multi-functional media unit which
                    combines the essential features and functions required by
                    guests when they travel such as Bluetooth, NFC, charging
                    station, radio, alarm clock and hotel phone in one.<br /><br />
                    Holiday Inn Express Chennai OMR Thoraipakkam offers a
                    fitness center, a self-service laundromat and a lounge to
                    relax with a refreshing tea/coffee or a tasty evening meal.
                    The property also offers on-site restaurant - Express Cafe,
                    that offers all-day dining with food and drinks available
                    24-hours a day and Grab & Go option, for guests in hurry. -->
                </div>
            </div>
        </section>
        <section class="container" id="hideVen">
            <div class="availability">Availability</div>
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
                                <option disabled selected>Select States</option>
                                <option
                                    v-for="(item, index) in stateList"
                                    :key="'m' + index"
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
                                    :key="'N' + index"
                                    :value="item.id"
                                >
                                    {{ item.name }}
                                </option>
                            </select>
                        </label>
                        <div>
                            <date-picker v-model="range" is-range>
                                <template v-slot="{ inputValue, inputEvents }">
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
        <section class="container">
            <table class="vendor-add-room-table">
                <tr>
                    <th style="width: 21%">Room type</th>
                    <th style="width: 9%">Sleeps</th>
                    <th style="width: 15%">
                        Price for {{ roomTableDetails.no_of_days }} days
                    </th>
                    <th style="width: 25%">Facilities</th>
                    <th style="width: 15%">Rooms</th>
                    <th style="width: 15%">
                        Price for {{ roomTableDetails.no_of_days }} days
                    </th>
                </tr>

                <tr
                    v-for="(item, index) in accomodationRomms"
                    :key="'O' + index"
                >
                    <td style="width: 21%">
                        <div class="vendor-add-room-table-type">
                            <div>
                                <u>{{ item.room_type }}</u>
                            </div>
                            <div>
                                Only {{ item.total_rooms }} rooms left on our
                                site
                            </div>
                            <div>
                                <img
                                    src="/assets/vendors/dashboard/ion_bed-sharp.svg"
                                    alt=""
                                />
                                <span> {{ item.beds_available }}</span>
                            </div>
                            <div>
                                <div
                                    v-for="(
                                        ele, index
                                    ) in item.room_specifications"
                                    :key="'P' + index"
                                >
                                    <img
                                        :src="
                                            '/assets/vendors/dashboard/' +
                                            ele.img
                                        "
                                        alt=""
                                    />
                                    <span>{{ ele.name }}</span>
                                </div>
                            </div>
                        </div>
                        <div
                            style="
                                display: flex;
                                overflow-x: auto;
                                max-width: 272px;
                                margin: 1em;
                            "
                        >
                            <img
                                v-for="(img, imgindex) in item.images"
                                :key="'Q' + imgindex"
                                width="180px"
                                height="180px"
                                :src="'/assets/vendors/uploads/' + img"
                                style="
                                    margin: 5px;
                                    object-fit: cover;
                                    border-radius: 15px;
                                "
                                alt=""
                            />
                            <video
                                v-for="(vid, vidindex) in item.videos"
                                :key="'R' + vidindex"
                                :src="'/assets/vendors/uploads/' + vid"
                                width="180px"
                                height="180px"
                                style="
                                    margin: 5px;
                                    object-fit: cover;
                                    border-radius: 15px;
                                "
                                controls
                            >
                                <source src="movie.mp4" type="video/mp4" />
                            </video>
                        </div>
                    </td>
                    <td style="width: 9%">
                        <div class="vendor-add-room-table-number">
                            <img
                                v-for="index in item.sleeps"
                                :key="'sleep' + index"
                                src="/assets/vendors/dashboard/sleep.svg"
                                alt=""
                            />
                        </div>
                    </td>
                    <td style="width: 15%">
                        <div class="vendor-add-room-table-price">
                            <div>
                                <i class="fa-solid fa-indian-rupee-sign"></i
                                >{{
                                    item.price_per_room *
                                    roomTableDetails.no_of_days
                                }}
                            </div>
                            <div>
                                +<i class="fa-solid fa-indian-rupee-sign"></i
                                >{{
                                    item.tax_per_room *
                                    roomTableDetails.no_of_days
                                }}
                                taxes and charges
                            </div>
                        </div>
                    </td>
                    <td style="width: 25%">
                        <div class="vendor-add-room-table-facilities">
                            <div>
                                <span
                                    v-for="(
                                        elee, index
                                    ) in item.room_facilities"
                                    :key="'A' + index"
                                >
                                    {{ elee.name }}/&nbsp
                                </span>
                            </div>
                            <!-- <div>
                                <button type="button">
                                    <img
                                        src="/assets/vendors/dashboard/iconoir_edit.svg"
                                        alt=""
                                    />
                                </button>
                                <button type="button">
                                    <img
                                        src="/assets/vendors/dashboard/ant-design_delete-outlined.svg"
                                        alt=""
                                    />
                                </button>
                                <button type="button">
                                    <img
                                        src="/assets/vendors/dashboard/ant-design_save-outlined.svg"
                                        alt=""
                                    />
                                </button>
                            </div> -->
                        </div>
                    </td>
                    <td style="width: 15%">
                        <div class="addRooms">
                            <div>
                                <span v-if="roomTableDetails.room[index]">
                                    <button
                                        @click="
                                            roomTableDetails.room[index]
                                                .roomRequired--;
                                            setRoomDetails(false);
                                        "
                                        type="button"
                                    >
                                        -
                                    </button>
                                    <input
                                        type="number"
                                        v-model="
                                            roomTableDetails.room[index]
                                                .roomRequired
                                        "
                                    />
                                    <button
                                        @click="
                                            roomTableDetails.room[index]
                                                .roomRequired++;
                                            setRoomDetails(false);
                                        "
                                        type="button"
                                    >
                                        +
                                    </button>
                                </span>
                            </div>
                        </div>
                    </td>
                    <td style="width: 15%">
                        <div class="vendor-add-room-table-enquiry">
                            <div>
                                <b>{{
                                    roomTableDetails.dispPrice.totalRooms
                                }}</b>
                                rooms for
                            </div>
                            <div>
                                ₹
                                {{
                                    roomTableDetails.dispPrice.price *
                                    roomTableDetails.no_of_days
                                }}
                            </div>
                            <div>
                                ₹
                                {{
                                    roomTableDetails.dispPrice.tax *
                                    roomTableDetails.no_of_days
                                }}
                                taxes and charges
                            </div>
                            <button @click="hidden = true" type="button">
                                Enquiry
                            </button>
                            <ul>
                                <li>Confirmation is immediate</li>
                                <li>No registration required</li>
                                <li>No booking or credit card fees!</li>
                            </ul>
                        </div>
                    </td>
                </tr>
            </table>
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
                    <div>
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
                    </div>
                    <div>
                        <button type="submit">Check availability</button>
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
                        v-for="(ele, index) in accomodationDetails.images"
                        :key="'B' + index"
                    >
                        <img :src="'/assets/vendors/uploads/' + ele" alt="" />
                    </div>
                </div>
                <div id="acc-single-videos" class="jsTabHide">
                    <div
                        v-for="(ele, index) in accomodationDetails.videos"
                        :key="'C' + index"
                    >
                        <video controls>
                            <source :src="'/assets/vendors/uploads/' + ele" />
                        </video>
                    </div>
                </div>
            </div>
            <button class="wed-venue-port-all">View all</button>
        </section>
        <section class="acc-facilites-cont grid container">
            <h3>Ameneties of {{ accomodationDetails.name }}</h3>
            <div
                v-for="(
                    item, name, index
                ) in accomodationDetails.accom_facilities"
                :key="'D' + index"
                class="item"
            >
                <div class="content">
                    <div><img :src="item.img" alt="" /></div>
                    <div>{{ name }}</div>
                    <ul
                        v-for="(ele, index) in item.facilities"
                        :key="'E' + index"
                    >
                        <li>{{ ele }}</li>
                    </ul>
                </div>
            </div>
        </section>
        <section class="container wed-acc-google-map">
            <h3>Venue address</h3>
            <p>
                Celebrations Sports Club, Lokhandwala Complex, Garden No 5,
                Lokhandwala Complex, Andheri (W), Mumbai, Maharashtra 400053 Get
                Directions
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
                            :key="'F' + index"
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
                                        :key="'G' + index"
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
                            :key="'H' + item.id"
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
                                        :key="'I' + index"
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
                            src="assets/single-venue-page/Rating Star.svg"
                            alt=""
                        />
                    </div>
                </div>
                <div>
                    <div class="rating-bar-box">
                        <div>
                            5&nbsp<img
                                src="assets/single-venue-page/Rating Star small.svg"
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
            <h1 style="margin-bottom: 2em">Similar accomodation in chennai</h1>
            <div class="wed-venue-items">
                <a
                    href=""
                    v-for="(item, index) in popluarSearches"
                    :key="'J' + index"
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
                        <div>{{ item.priceStart }} <span>per day</span></div>
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
    props: [
        "vendorCat",
        "owner",
        "hotels",
        "rooms",
        "logged",
        "city",
        "hotelstartdate",
        "hotelenddate",
        "totalrooms",
        "children",
        "adults",
        "states",
        "vendor",
        "stateselected",
        "inivitations",
    ],
    data() {
        return {
            accomodationDetails: JSON.parse(this.hotels),
            vendorCategory: JSON.parse(this.vendorCat),
            accomodationRomms: JSON.parse(this.rooms),
            roomTableDetails: {
                no_of_days: 1,
                room: [],
                dispPrice: {
                    totalRooms: 0,
                    price: 0,
                    tax: 0,
                },
            },
            submitLead: {
                name: null,
                phone_num: null,
                email: null,
            },
            hidden: false,
            message: null,
            leadMessage: null,
            finalInvi: [],
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
            range: {
                start: this.hotelstartdate,
                end: this.hotelenddate,
            },
            locationMaster: JSON.parse(this.states),
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
                rooms: this.totalrooms,
            },
            roomMember: false,
            hotelSingleFaciclites: [
                {
                    id: 1,
                    name: "Business Facilities",
                    img: "/assets/vendors/accomodations/iconoir_yoga.svg",
                    facilities: ["Fax/photocopying"],
                },
                {
                    id: 2,
                    name: "Food and Drink",
                    img: "/assets/vendors/accomodations/iconoir_yoga.svg",
                    facilities: ["Fax/photocopying"],
                },
                {
                    id: 3,
                    name: "Food and Drink",
                    img: "/assets/vendors/accomodations/iconoir_yoga.svg",
                    facilities: ["Fax/photocopying"],
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
            submitReview: {
                rating: 5,
                title: null,
                description: null,
                keywords: null,
            },
            reviews: null,
            logginFirst: null,
            cont: null,
            showForm: null,
            invites: null,
        };
    },
    methods: {
        finalizeVendor(e) {
            let _this = this;
            let formData = new FormData();
            let data = JSON.stringify(this.finalInvi);
            let accomodationId = this.accomodationDetails.id;
            formData.append("type", "finalize");
            formData.append("vendor", "accomodation");
            formData.append("title", "Accomodations");
            formData.append("data", data);
            formData.append("accomodation", accomodationId);
            axios
                .post("/api/vendor/addacc", formData)
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
        setRoomDetails(e) {
            let _this = this;

            if (e === true) {
                let start = new Date(this.search.startDate);
                let end = new Date(this.search.endDate);
                const diffTime = Math.abs(start - end);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                this.roomTableDetails.no_of_days = diffDays;
                let enqiryBox = $(".vendor-add-room-table-enquiry");
                enqiryBox.each(function (index, item) {
                    if (index == 0) {
                        return;
                    }
                    item.innerHTML = "";
                });
                this.accomodationRomms.forEach(function (item) {
                    _this.roomTableDetails.room.push({
                        roomType: item.room_type,
                        roomSlug: item.slug,
                        roomId: item.id,
                        roomPrice: item.price_per_room,
                        roomTax: item.tax_per_room,
                        roomRequired: 0,
                    });
                });
            } else {
                let totalRooms = 0;
                let totalPrice = 0;
                let tax = 0;
                for (const key in _this.roomTableDetails.room) {
                    totalRooms =
                        totalRooms +
                        _this.roomTableDetails.room[key].roomRequired;
                    console.log(
                        parseInt(_this.roomTableDetails.room[key].roomPrice),
                        totalPrice +
                            parseInt([
                                _this.roomTableDetails.room[key].roomRequired *
                                    parseInt(
                                        _this.roomTableDetails.room[key]
                                            .roomPrice
                                    ),
                            ])
                    );
                    totalPrice =
                        parseInt(totalPrice) +
                        parseInt([
                            _this.roomTableDetails.room[key].roomRequired *
                                parseInt(
                                    parseInt(
                                        _this.roomTableDetails.room[key]
                                            .roomPrice
                                    )
                                ),
                        ]);
                    tax =
                        parseInt(tax) +
                        parseInt([
                            _this.roomTableDetails.room[key].roomRequired *
                                parseInt(
                                    parseInt(
                                        _this.roomTableDetails.room[key].roomTax
                                    )
                                ),
                        ]);
                }
                _this.roomTableDetails.dispPrice.totalRooms = totalRooms;
                _this.roomTableDetails.dispPrice.price = totalPrice;
                _this.roomTableDetails.dispPrice.tax = tax;
            }
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
            let no_of_guests = {
                adults: _this.adults,
                children: _this.children,
            };
            let date =
                new Date(this.hotelstartdate) +
                " - " +
                new Date(this.hotelenddate);
            //_this.submitLead.rooms = _this.roomTableDetails.room;

            axios
                .post(`/api/vendor/lead`, [
                    _this.submitLead,
                    _this.vendorCategory.id,
                    _this.accomodationDetails.id,
                    ownerId,
                    "Accommodation",
                    user,
                    no_of_guests,
                    _this.roomTableDetails.room,
                    date,
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
                    _this.accomodationDetails.id,
                    ownerId,
                    "Accommodation",
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
        toggleRating(e) {
            if (this.vendor != null) {
                return;
            }
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
            jsTab.forEach(function (index, item) {
                index.classList.add("jsTabHide");
            });
            jsNav.forEach(function (index, item) {
                index.classList.remove("wed-venue-port-head-active");
            });
            document.querySelector("#" + clicked).classList.remove("jsTabHide");
            e.currentTarget.classList.add("wed-venue-port-head-active");
        },
        resizeGridItem(item) {
            let grid = document.getElementsByClassName("grid")[0];
            let rowHeight = parseInt("20px");
            let rowGap = parseInt(
                window.getComputedStyle(grid).getPropertyValue("grid-row-gap")
            );
            let rowSpan = Math.ceil(
                (item.querySelector(".content").getBoundingClientRect().height +
                    rowGap) /
                    (rowHeight + rowGap)
            );
            item.style.gridRowEnd = "span " + rowSpan;
        },
        resizeAllGridItems() {
            let allItems = document.getElementsByClassName("item");
            let x = null;
            for (x = 0; x < allItems.length; x++) {
                this.resizeGridItem(allItems[x]);
            }
        },
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
        searchAcc() {
            // let startDate = new Date(this.search.startDate)
            //     .toISOString()
            //     .split("T")[0];
            // let endDate = new Date(this.search.endDate)
            //     .toISOString()
            //     .split("T")[0];
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
        getDistricts() {
            let _this = this;
            if (this.states == null) {
                return;
            }
            let locationMaster = JSON.parse(this.states);
            //console.log("e");
            locationMaster.map(function (el) {
                _this.district.push({ id: el.id, name: el.name });
            });
        },
        getReviews() {
            var _this = this;
            axios
                .get(
                    `/api/vendor/review/${_this.accomodationDetails.id}?cat=Accommodation`
                )
                .then(function (response) {
                    _this.reviews = response.data.reverse();
                    setTimeout(function () {
                        _this.showReviews();
                    }, 1000);
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

        hideSections() {
            let location = window.location.pathname.substring(1);
            let path = location.substring(0, location.indexOf("/"));
            if (this.vendor != null) {
                $("#hideVen :submit").attr("disabled", true);
                //$("#hideVen").css("display", "none");
                $(".wed-venue-rating :input").attr("disabled", true);
                $(".vendor-add-room-form-popup :input").attr("disabled", true);
                this.search = {
                    city: this.accomodationDetails.district,
                    startDate: this.hotelstartdate,
                    endDate: this.hotelenddate,
                    adult: 0,
                    children: 0,
                    rooms: 0,
                };
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
            if (this.logged != "" || this.logged != null) {
                id = JSON.parse(_this.logged).id;
            } else {
                return;
            }
            axios
                .get(
                    `/api/vendor/addacc/${id}?accid=${_this.accomodationDetails.id}`
                )
                .then(function (response) {
                    _this.finalInvi = response.data;
                })
                .catch((errors) => {});
        },
    },

    created: function () {
        window.addEventListener("click", this.windowClick);
    },
    mounted() {
        document.onreadystatechange = () => {
            if (document.readyState == "complete") {
                window.addEventListener("load", this.resizeAllGridItems);
                this.recenterButton();
                this.getFinalInvites();
                this.showReviews();
                this.getReviews();
                if (this.inivitations != "" || this.inivitations != null) {
                    this.invites = JSON.parse(this.inivitations);
                }
            }
        };
        this.$nextTick(function () {
            this.getStates();
            this.getDistricts(this.stateselected, false);
            this.hideSections();
            this.setRoomDetails(true);
            window.addEventListener("resize", this.resizeAllGridItems);
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
.wed-ven-single-mainImg > div {
    position: absolute;
    top: 30px;
    right: 30px;
}
.wed-ven-single-mainImg button {
    border: none;
    outline: none;
    background-color: transparent;
}
.wed-ven-single-aboutcontent > div:nth-child(1) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 800;
    font-size: 23.4321px;
    line-height: 35px;
    color: #000000;
}
.wed-ven-single-aboutcontent > div:nth-child(2) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 13.6796px;
    line-height: 21px;
    color: #525252;
}

.availability {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 900;
    font-size: 21px;
    line-height: 32px;
    color: #000000;
    margin-bottom: 10px;
    margin-left: 10px;
}
.wed-ven-main-search {
    display: flex;
    flex-direction: column;
    width: 100%;
}
.wed-ven-main-search > div {
    background: rgba(255, 255, 255, 0.5);
    padding: 28px 23px;
    width: 100%;
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
.vendor-add-room-table {
    width: 100%;
    margin-top: 1em;
    background-color: white;
    margin-bottom: 2em;
}
.vendor-add-room-table th {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 13.6796px;
    line-height: 21px;
    color: #ffffff;
    background: #461952;
    border: 0 !important;
    padding: 18px 25px;
}
.vendor-add-room-table td {
    vertical-align: top;
    border: 0.5px solid #c4c4c4;
}
.vendor-add-room-table-type {
    padding: 16px 37px;
}
.vendor-add-room-table-type > div:nth-child(1) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 800;
    font-size: 17.6796px;
    line-height: 21px;
    text-decoration-line: underline;
    color: #000000;
    margin-bottom: 10px;
}
.vendor-add-room-table-type > div:nth-child(2) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 14.81205px;
    line-height: 15px;
    margin-bottom: 10px;
    color: #de2b2b;
}
.vendor-add-room-table-type > div:nth-child(3) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 11.81205px;
    line-height: 15px;
    color: #797979;
    margin-bottom: 10px;
}
.vendor-add-room-table-type > div:nth-child(3) > img {
    width: 25px;
    height: 23px;
}
.vendor-add-room-table-type > div:nth-child(4) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 9.16549px;
    line-height: 11px;
    color: #a8a8a8;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}
.vendor-add-room-table-type > div:nth-child(4) > div {
    margin-right: 5px;
}
.vendor-add-room-table-type > div:nth-child(4) > div > img {
    margin-right: 10px;
    width: 20px;
    height: 17px;
}

.vendor-add-room-table-number {
    padding: 16px 25px;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: flex-start;
}

.vendor-add-room-table-price {
    padding: 16px 25px;
}
.vendor-add-room-table-price > div:nth-child(1) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 700;
    font-size: 18px;
    line-height: 27px;
    color: #000000;
}
.vendor-add-room-table-price > div:nth-child(2) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 12px;
    line-height: 27px;
    color: #000000;
}

.vendor-add-room-table-facilities {
    display: flex;
    padding: 16px 25px;
}
.vendor-add-room-table-facilities > div:nth-child(1) {
    width: 85%;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 10px;
    line-height: 15px;
    color: #000000;
}

.vendor-add-room-table-facilities > div:nth-child(2) {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    width: 15%;
}
.vendor-add-room-table-facilities > div:nth-child(2) button {
    background: #c4456f;
    box-shadow: 0px 0px 0.52193px 0.52193px rgba(0, 0, 0, 0.25);
    border-radius: 35.5263px;
    width: 27px;
    height: 27px;
    margin-bottom: 15px;
    border: none;
    outline: 0;
}
.addRooms {
    background-color: white;
    padding: 18px 20px;
    box-sizing: border-box;
    display: flex;
    justify-content: center;
}

.addRooms > div > span {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 12px;
    line-height: 20px;
    color: #262626;
    display: flex;
}
.addRooms > div > span > button {
    outline: 0;
    border: 0.390625px solid #138ab3;
    color: #138ab3;
    background-color: transparent;
    width: 30px;
    height: 30px;
    font-size: 17px;
}
.addRooms > div > span > input {
    background-color: white !important;
    border: none;
    outline: 0;
    width: 50px;
    text-align: center;
}
.vendor-add-room-table-enquiry {
    padding: 16px 25px;
}
.vendor-add-room-table-enquiry > div:nth-child(1) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 600;
    font-size: 12.4853px;
    line-height: 16px;
    color: #000000;
    margin-bottom: 10px;
}
.vendor-add-room-table-enquiry > div:nth-child(2) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 600;
    font-size: 18.4853px;
    line-height: 16px;
    color: #000000;
    margin-bottom: 7px;
}
.vendor-add-room-table-enquiry > div:nth-child(3) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 600;
    font-size: 12.4853px;
    line-height: 16px;
    color: #000000;
    margin-bottom: 5px;
}
.vendor-add-room-table-enquiry > button {
    font-family: "Segoe UI";
    font-style: normal;
    font-weight: 400;
    font-size: 10px;
    line-height: 13px;
    width: 100%;
    padding: 9px;
    color: #ffffff;
    background: #461952;
    border-radius: 5px;
    outline: none;
    border: none;
    margin: 5px 0;
}
.vendor-add-room-table-enquiry > ul {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 8.01049px;
    line-height: 12px;
    padding-left: 13px;
    color: #000000;
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
    margin: 6em auto;
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
    grid-template-columns: repeat(auto-fit, minmax(250px, 200px));
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
/* add room form css start */
.vendor-add-room-form-popup {
    padding: 15px 27px;
    background: #ffffff;
    border-radius: 6px;
    position: fixed;
    top: 10%;
    left: 30%;
    width: 40%;
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
.vendor-add-room-form-popup > div:nth-child(2) input {
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
.vendor-add-room-form-popup > div:nth-child(2) input::placeholder {
    color: black;
}

.vendor-add-room-form-popup > div:nth-child(3) > button:nth-child(1) {
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
</style>
