<template>
    <div>
        <!-- <navBar @menuchange="changeMenu" :user="user" :link="active"></navBar> -->

        <div  class="container-lg main-cont">
            <div class="guest-dash-left-cont">
                <div class="guest-left-invi-cont">
                    <h1>Welcome {{ user.name }}..</h1>
                    <!-- <p
                        class="wed-btn wed-btn-main"
                        style="width: max-content; padding: 10px 15px"
                    >
                        <a
                            style="text-decoration: none; color: white"
                            :href="route('guesttestify', user)"
                            >Testify</a
                        >
                    </p> -->
                    <h2 v-if="screenWidth > 768">You are invited</h2>
                    <div class="guest-left-invi-count">
                        <div style="display: flex;">
                            <div
                            @click="changeMenu('all')"
                            class="guest-left-invi-single"
                            :class="{'active' : active == 'all'}"
                            >
                                <span>
                                    <img class="purple-filter" src="/assets/guestDash/going.svg" alt="" />
                                </span>
                                <span>
                                    <span>New Invitations</span>
                                    <span>{{ newInvites.length }}</span>
                                </span>
                            </div>
                            <div
                                @click="changeMenu('accepted') "
                                class="guest-left-invi-single"
                                :class="{'active' : active == 'accepted'}"
                            >
                                <span>
                                    <img class="purple-filter" src="/assets/guestDash/going.svg" alt="" />
                                </span>
                                <span>
                                    <span>Going Invitations</span>
                                    <span>{{ acceptedInvites.length }}</span>
                                </span>
                            </div>
                        </div>
                        <div style="display: flex;">
                            <div
                            @click="changeMenu('pending')"
                            class="guest-left-invi-single"
                            :class="{'active' : active == 'pending'}"
                        >
                            <span>
                                <img
                                    src="/assets/guestDash/pending.svg"
                                    alt=""
                                />
                            </span>
                            <span>
                                <span>Pending Invitations</span>
                                <span>{{ pendingInvites.length }}</span>
                            </span>
                        </div>
                        <div
                            @click="changeMenu('declined')"
                            class="guest-left-invi-single"
                            :class="{'active' : active == 'declined'}"
                        >
                            <span>
                                <img
                                    src="/assets/guestDash/decline.svg"
                                    alt=""
                                />
                            </span>
                            <span>
                                <span>Declined Invitations</span>
                                <span>{{ rejectedInvites.length }}</span>
                            </span>
                        </div>
                        </div>
                    </div>
                    <div
                        v-if="screenWidth < 576 && todaySchedule.length > 0"
                        class="today-schedule-events-cont"
                    >
                        <h1>Today's Schedule</h1>
                        <div class="today-schedule-events-all">
                            <div
                                v-for="item in todaySchedule"
                                :key="item.id"
                                class="today-schedule-events-single"
                            >
                                <div class="today-event-head">
                                    <img
                                        src="/assets/guestDash/Ellipse.svg"
                                        alt=""
                                    />
                                    <span
                                        >{{ item.name }}
                                        <span
                                            >- {{ item.invitation.brideName }} &
                                            {{
                                                item.invitation.groomName
                                            }}</span
                                        ></span
                                    >
                                </div>
                                <div class="today-event-mid">
                                    <img
                                        src="/assets/guestDash/map-pin.svg"
                                        alt=""
                                    />
                                    {{ item.venues[0]?.name }}
                                    <template v-if="item.venues[0]?.address">, {{ item.venues[0]?.address }}</template>
                                    <template v-if="item.venues[0]?.pincode">, {{ item.venues[0]?.pincode }}</template>
                                    <template v-if="item.venues[0]?.city">, {{ item.venues[0]?.city }}</template>
                                    <template v-if="item.venues[0]?.state">, {{ item.venues[0]?.state }}</template>
                                    <template v-if="item.venues[0]?.location && item.venues[0]?.location.name">, {{ item.venues[0]?.location.name }}</template>
                                    <template v-if="item.venues[0]?.location && item.venues[0]?.location.state && item.venues[0]?.location.state.name">, {{ item.venues[0]?.location.state.name }}</template>
                                </div>
                                <div class="today-event-mid">
                                    <img
                                        src="/assets/guestDash/clock.svg"
                                        alt=""
                                    />
                                    {{
                                        item.startDate | moment("Do dddd, YYYY")
                                    }}
                                    {{
                                        new Date(
                                            "1970-01-01T" + item.startTime + "Z"
                                        ) | moment("h:mm a")
                                    }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="noti-mobile-cont"
                        :class="{ 'noti-mobile': screenWidth <= 576 }"
                    >
                        <h3
                            @click="
                                show == 'invitations'
                                    ? (show = 'null')
                                    : (show = 'invitations')
                            "
                        >
                            {{dynamicHeading}}
                            <img
                                v-if="
                                    screenWidth <= 576 && show != 'invitations'
                                "
                                src="/assets/guestDash/chevron-down.svg"
                                alt=""
                            />
                            <img
                                v-if="
                                    screenWidth <= 576 && show == 'invitations'
                                "
                                src="/assets/guestDash/chevron-up.svg"
                                alt=""
                            />
                        </h3>
                        <div 
                            v-if="
                                dynamicInvites.length == 0 &&
                                (show == 'invitations' || screenWidth >= 576)
                            "
                        >
                            <div
                                class="no-invi-cont"
                            >
                                <img src="/assets/guestDash/Rectangle.png" alt="" />
                                <div>
                                    <img
                                        src="/assets/guestDash/noInvite.png"
                                        alt=""
                                    />
                                    <span>No {{dynamicHeading}}</span>
                                </div>
                            </div>
                            <!-- <div
                                v-if="active == 'pending'"
                            >
                                <img src="/assets/guestDash/Frame100.png" alt="" />
                                <div v-if="active == 'new'">
                                    <p>No new Invitation</p>
                                    <p>You have no new invitations.</p>
                                </div>
                            </div> -->
                        </div>
                        <div
                            v-show="
                                dynamicInvites.length > 0 &&
                                (show == 'invitations' || screenWidth >= 576)
                            "
                            class="splide"
                            id="invi-splide"
                        >
                            <div class="splide__track">
                                <ul
                                    class="splide__list all-invi-cont"
                                    v-show="
                                        show == 'invitations' ||
                                        screenWidth >= 576
                                    "
                                >
                                    <li
                                        class="splide__slide"
                                        :class="{ blur: submit }"
                                        v-for="item in dynamicInvites"
                                        :key="item.id"
                                    >
                                        <cardCommonVue
                                            :invi="item"
                                            :user="user"
                                            style="height: 100%"
                                            @view="inviControl(item, 'view')"
                                            @accept="
                                                inviControl(item, 'accept')
                                            "
                                            @decline="
                                                inviControl(item, 'decline')
                                            "
                                        ></cardCommonVue>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- <div
                            class="all-invi-cont"
                            v-show="show == 'invitations' || screenWidth >= 576"
                        >
                            <cardCommonVue
                                :class="{ blur: submit }"
                                v-for="item in newInvites"
                                :key="item.id"
                                :invi="item"
                                :user="user"
                                @view="inviControl(item, 'view')"
                                @accept="inviControl(item, 'accept')"
                                @decline="inviControl(item, 'decline')"
                            ></cardCommonVue>
                        </div> -->
                    </div>
                </div>
                <div class="width-mod">
                    <div class="guest-left-noti-cont" style="width:100%">
                        <div>
                            <h1
                                @click="
                                    show == 'notifications'
                                        ? (show = 'null')
                                        : (show = 'notifications')
                                "
                            >
                                notifications
                                <img
                                    v-if="
                                        screenWidth <= 576 &&
                                        show != 'notifications'
                                    "
                                    src="/assets/guestDash/chevron-down.svg"
                                    alt=""
                                />
                                <img
                                    v-if="
                                        screenWidth <= 576 &&
                                        show == 'notifications'
                                    "
                                    src="/assets/guestDash/chevron-up.svg"
                                    alt=""
                                />
                            </h1>
                            <div
                                v-show="
                                    show == 'notifications' || screenWidth >= 576
                                "
                                class="noti-all-cont"
                                :class="{ 'increase-height': increaseHeight }"
                            >
                                <div
                                    v-for="item in notifications"
                                    :key="item.id"
                                    class="noti-all-single"
                                >
                                    <img
                                        src="/assets/guestDash/Ellipse.svg"
                                        alt=""
                                    />
                                    <span
                                        >{{ item.data.host.name }}
                                        {{ item.data.status }}</span
                                    >
                                </div>
                            </div>
                        </div>
                        <div
                            v-if="
                                increaseHeight == false &&
                                (show == 'notifications' || screenWidth >= 576)
                            "
                            @click="increaseHeight = true"
                            class="guest-noti-view-more"
                        >
                            View More
                        </div>
                        <div
                            v-if="
                                increaseHeight == true &&
                                (show == 'notifications' || screenWidth >= 576)
                            "
                            @click="increaseHeight = false"
                            class="guest-noti-view-more"
                        >
                            View Less
                        </div>
                    </div>
                    <div v-if="screenWidth > 576" class="host-testi-cont">
                        <img src="/assets/testi.png" alt="" />
                        <div>
                            <h3>Share Your Story with us:</h3>
                            <h3>Review Us Now!</h3>
                            <button @click="showTestimonialForm = true">Testimony</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="guest-dash-right-cont">
                <div
                    v-if="screenWidth > 576 && todaySchedule.length > 0"
                    class="today-schedule-events-cont"
                >
                    <h1>Today's Schedule</h1>
                    <div class="today-schedule-events-all">
                        <div
                            v-for="item in todaySchedule"
                            :key="item.id"
                            class="today-schedule-events-single"
                        >
                            <div class="today-event-head">
                                <img
                                    src="/assets/guestDash/Ellipse.svg"
                                    alt=""
                                />
                                <span
                                    >{{ item.name }}
                                    <span
                                        >- {{ item.invitation.brideName }} &
                                        {{ item.invitation.groomName }}</span
                                    ></span
                                >
                            </div>
                            <div class="today-event-mid">
                                <img
                                    src="/assets/guestDash/map-pin.svg"
                                    alt=""
                                />
                                {{ item.venues[0]?.name }}
                                <template v-if="item.venues[0]?.address">, {{ item.venues[0]?.address }}</template>
                                <template v-if="item.venues[0]?.pincode">, {{ item.venues[0]?.pincode }}</template>
                                <template v-if="item.venues[0]?.city">, {{ item.venues[0]?.city }}</template>
                                <template v-if="item.venues[0]?.state">, {{ item.venues[0]?.state }}</template>
                                <template v-if="item.venues[0]?.location && item.venues[0]?.location.name">, {{ item.venues[0]?.location.name }}</template>
                                <template v-if="item.venues[0]?.location && item.venues[0]?.location.state && item.venues[0]?.location.state.name">, {{ item.venues[0]?.location.state.name }}</template>
                            </div>
                            <div class="today-event-mid">
                                <img src="/assets/guestDash/clock.svg" alt="" />
                                {{ item.startDate | moment("Do dddd, YYYY") }}
                                {{
                                    new Date("1970-01-01T" + item.startTime)
                                        | moment("h:mm a")
                                }}
                            </div>
                        </div>
                    </div>
                </div>
                <h1
                    @click="
                        show == 'events' ? (show = 'null') : (show = 'events')
                    "
                >
                    Upcoming Events
                    <img
                        v-if="screenWidth <= 576 && show != 'events'"
                        src="/assets/guestDash/chevron-down.svg"
                        alt=""
                    />
                    <img
                        v-if="screenWidth <= 576 && show == 'events'"
                        src="/assets/guestDash/chevron-up.svg"
                        alt=""
                    />
                </h1>
                <h2 v-if="screenWidth >= 576">
                    Don't miss the scheduled events
                </h2>
                <div v-show="show == 'events' || screenWidth >= 576">
                    <div class="cal-cont">
                        <Calendar
                            :attributes="attr"
                            :masks="{ title: 'MMMM' }"
                            @dayclick="dayclicked"
                        >
                            <template #day-popover="{ dayTitle }">
                                <div
                                    class="text-xs text-gray-300 font-semibold text-center"
                                >
                                    {{ dayTitle }}
                                </div>
                                <div
                                    v-for="(item, index) in todos"
                                    :key="index"
                                >
                                    <div
                                        v-if="
                                            `'` +
                                                new Date(item.startDate) +
                                                `'` ==
                                            `'` + new Date(date.id) + `'`
                                        "
                                    >
                                        <!-- <div
                                            v-for="(
                                                item, index
                                            ) in item.description"
                                            :key="index"
                                        >
                                            {{ item }}
                                        </div> -->
                                        <div>
                                            {{ item.name }}
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </Calendar>
                    </div>
                    <div class="guest-event-all">
                        <div
                            v-for="item in events"
                            :key="item.id"
                            class="guest-event-single"
                        >
                            <div class="guest-event-top">
                                <span></span>
                                <span
                                    >{{
                                        item.startDate | moment("Do dddd, YYYY")
                                    }}
                                    {{
                                        new Date(
                                            "1970-01-01T" + item.startTime + "Z"
                                        ) | moment("h:mm a")
                                    }}</span
                                >
                            </div>
                            <div class="guest-event-mid">
                                {{ item.name }} of
                                {{ item.invitation.groomName }} weds
                                {{ item.invitation.brideName }}
                            </div>
                            <!-- <div class="guest-event-bottom">
                                <img
                                    src="/assets/guestDash/dresscode.svg"
                                    alt=""
                                />
                                <span>Dress code - Red colour</span>
                            </div> -->
                            <div
                                v-if="item.venues.length > 0"
                                class="guest-event-bottom"
                            >
                                <img
                                    src="/assets/guestDash/eventLoc.svg"
                                    alt=""
                                />
                                <span v-for="e in item.venues" :key="e.name">
                                    {{ e.name }}
                                    <template v-if="e.address">, {{ e.address }}</template>
                                    <template v-if="e.pincode">, {{ e.pincode }}</template>
                                    <template v-if="e.city">, {{ e.city }}</template>
                                    <template v-if="e.state">, {{ e.state }}</template>
                                    <template v-if="e.location && e.location.name">, {{ e.location.name }}</template>
                                    <template v-if="e.location && e.location.state && e.location.state.name">, {{ e.location.state.name }}</template>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div style="width:100%" v-if="screenWidth < 576" class="host-testi-cont">
                <img src="/assets/testi.png" alt="" />
                <div>
                    <h3>Share Your Story with us:</h3>
                    <h3>Review Us Now!</h3>
                    <a :href="route('guesttestify', user)">Testimony</a>
                </div>
            </div>
            <flashMessage :message="message"></flashMessage>
        </div>
        <!-- <inviteList
            v-if="
                active == 'new' ||
                active == 'accepted' ||
                active == 'pending' ||
                active == 'declined'
            "
            :user="user"
            :invitations="showCommonInvites"
            :active="active"
            @invitechange="updateInvitation"
        ></inviteList> -->
        <div v-if="showTestimonialForm == true" class="testi-popup-cont">
            <div class="testi-form-cont">
                <div class="testi-form-head">
                    <div>
                        <span>Overall Rating</span>
                        <span></span>
                    </div>
                    <img style="cursor: pointer;" @click="showTestimonialForm = false" src="/assets/clarity_window-close-line.svg" alt="">
                </div>
                <div class="testi-form-stars-cont">
                    <span v-for="(item, index) in Number(testiFeilds.stars)" @click="testiFeilds.stars = index+1">
                        <img src="/assets/ph_star-light.svg" alt="">
                    </span>
                    <span v-for="(item, index) in (5- Number(testiFeilds.stars))" @click="testiFeilds.stars = testiFeilds.stars +index+1">
                        <img src="/assets/ph_star-light-2.svg" alt="">
                    </span>
                    <p>Click to rate</p>
                </div>
                <p class="testi-form-que">How do feel about <span>Happywed?</span></p>
                <form>
                    <textarea v-model="testiFeilds.body" name="body" id="body" cols="30" rows="5" placeholder="Example: 'Overall, Happywed did an excellent job. They were organized and kept everything running smoothly on our big day. My only minor complaint was that communication could have been a bit more frequent. Nonetheless, they delivered a beautiful wedding.'"></textarea>
                    <span
                        v-if="errorsSubmit && errorsSubmit.body"
                        class="errMsg"
                        >{{ errorsSubmit.body[0] }}</span
                    >
                    <div class="d-flex justify-end"><button type="button" @click="sendTesti()" :disabled="disableSubmit">Submit</button></div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import flashMessage from "../FlashMessage.vue";
import navBar from "./commonGuestComponents/navCommon.vue";
import inviteList from "./InviteList.vue";

import Calendar from "v-calendar/lib/components/calendar.umd";
import cardCommonVue from "./commonGuestComponents/cardCommon.vue";

export default {
    props: [
        "user",
        "invitations",
        "inviteNew",
        "inviteAccepted",
        "inviteRejected",
        "invitePending",
        "notifications",
        "events",
    ],
    components: {
        Calendar,
        cardCommonVue,
        flashMessage,
        navBar,
        inviteList,
    },
    data() {
        return {
            todos: this.events,
            weekDays: [
                "Sunday",
                "Monday",
                "Tuesday",
                "Wednesday",
                "Thursday",
                "Friday",
                "Saturday",
            ],
            months: [
                "January",
                "February",
                "March",
                "April",
                "May",
                "June",
                "July",
                "August",
                "September",
                "October",
                "November",
                "December",
            ],
            date: {
                name: "",
                id: "",
                day: new Date().getDate(),
                week: new Date().getDay(),
                year: new Date().getFullYear(),
                month: new Date().getMonth(),
            },
            screenWidth: window.screen.width,
            increaseHeight: false,
            show: null,
            message: null,
            allInvites: this.invitations,
            newInvites: this.inviteNew,
            acceptedInvites: this.inviteAccepted,
            rejectedInvites: this.inviteRejected,
            pendingInvites: this.invitePending,
            active: "all",
            submit: false,
            invitationSplide: null,
            dynamicInvites: this.inviteNew,
            dynamicHeading: 'New Invitations',
            showTestimonialForm: false,
            disableSubmit:false,
            errorsSubmit:null,
            testiFeilds: {
                body: null,
                stars: 0,
            },
        };
    },
    methods: {
        sendTesti() {
            let _this = this;
            _this.disableSubmit = true;
            _this.errorsSubmit = null;
            let formData = new FormData();
            let code = _this.invi?.location_id?.code;
            for (var key in _this.testiFeilds) {
                formData.append(key, _this.testiFeilds[key]);
            }
            let link = route("admintestimonials.store");
            let meth = "POST";
            axios({
                method: meth,
                url: link,
                data: formData,
                headers: { "content-type": "multipart/form-data" },
            })
                .then((response) => {
                    _this.showTestimonialForm = false;
                    _this.disableSubmit = false;
                    _this.message = response.data["message"];
                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                })
                .catch((error) => {
                    _this.errorsSubmit = error.response.data?.errors;
                    _this.disableSubmit = false;
                    if (error.response.data["message"]) {
                        _this.message = error.response.data["message"];
                        setTimeout(function () {
                            _this.message = null;
                        }, 3000);
                    }
                });
        },
        dayclicked(day) {
            this.date.id = day.id;
            this.date.day = day.day;
            this.date.month = day.month - 1;
            this.date.year = day.year;
            this.date.week = day.weekday - 1;
            this.date.name =
                this.weekDays[day.weekday - 1] +
                " " +
                this.date.day +
                ", " +
                this.months[day.month - 1] +
                " " +
                this.date.year;
        },
        inviControl(item, type) {
            let _this = this;
            _this.submit = true;
            let link = null;
            if (type == "view") {
                link = route("guestnoted", [_this.user, item]);
            }
            if (type == "accept") {
                link = route("guestaccepted", [_this.user, item]);
            }
            if (type == "decline") {
                link = route("guestdeclined", [_this.user, item]);
            }
            axios({
                url: link,
                method: "POST",
            })
                .then((response) => {
                    let index = _this.newInvites.findIndex(
                        (x) => x.id == item.id
                    );
                    if (index > -1) {
                        _this.newInvites.splice(index, 1);
                    }
                    if (type == "view") {
                        _this.pendingInvites = response.data;
                        _this.message = "Invitation Seen";
                    }
                    if (type == "accept") {
                        _this.acceptedInvites = response.data;
                        _this.message = "Invitation accepted";
                    }
                    if (type == "decline") {
                        _this.rejectedInvites = response.data;
                        _this.message = "Invitation rejected";
                    }
                    if (_this.active == "pending") {
                        let index = _this.pendingInvites.findIndex(
                            (x) => x.id == item.id
                        );
                        if (index > -1) {
                            _this.pendingInvites.splice(index, 1);
                        }
                    }
                    if (_this.active == "accepted") {
                        let index = _this.acceptedInvites.findIndex(
                            (x) => x.id == item.id
                        );
                        if (index > -1) {
                            _this.acceptedInvites.splice(index, 1);
                        }
                    }
                    if (this.active == "declined") {
                        let index = _this.rejectedInvites.findIndex(
                            (x) => x.id == item.id
                        );
                        if (index > -1) {
                            _this.rejectedInvites.splice(index, 1);
                        }
                    }

                    _this.submit = false;
                    setTimeout(() => {
                        _this.message = null;
                    }, 3000);
                })
                .catch((error) => {
                    _this.submit = false;
                    console.log(error);
                });
        },
        // updateInvitation(e, ele, all) {
        //     if (this.active == "pending") {
        //         this.pendingInvites = all;
        //     }
        //     if (this.active == "accepted") {
        //         this.acceptedInvites = all;
        //     }
        //     if (this.active == "declined") {
        //         this.rejectedInvites = all;
        //     }
        //     if (e == "pending") {
        //         this.pendingInvites.push(ele);
        //         return;
        //     }
        //     if (e == "accepted") {
        //         this.acceptedInvites.push(ele);
        //         return;
        //     }
        //     if (e == "declined") {
        //         this.rejectedInvites.push(ele);
        //         return;
        //     }
        // },
        changeMenu(e) {
            this.active = e;
            if (e == "all") {
                this.dynamicInvites = this.newInvites;
                this.dynamicHeading = 'New Invitations';
                return;
            }
            if (e == "pending") {
                this.dynamicInvites = this.pendingInvites;
                this.dynamicHeading = 'Pending Invitations';
                return;
            }
            if (e == "accepted") {
                this.dynamicInvites = this.acceptedInvites;
                this.dynamicHeading = 'Accepted Invitations';
                return;
            }
            if (e == "declined") {
                this.dynamicInvites = this.rejectedInvites;
                this.dynamicHeading = 'Declined Invitations';
                return;
            }
            //window.scrollTo(0, 0);
        },
        setWidth() {
            this.screenWidth = window.screen.width;
        },
        setSplider() {
            let _this = this;
            console.log(Splide);
            _this.invitationSplide = new Splide("#invi-splide", {
                type: "slide",
                perMove: 0,
                arrows: true,
                isNavigation: true,
                pagination: false,
                autoWidth: true,
                height: "100%",
            });
            _this.invitationSplide.mount();
        },
    },
    computed: {
        attr() {
            return [
                // Attributes for todos
                ...this.todos.map((todo) => ({
                    dates: todo.startDate,
                    highlight: {
                        style: {
                            backgroundColor: "#C4456F",
                        },
                        contentStyle: {
                            color: "#FFFFFF",
                        },
                    },
                    // popover: true,
                    popover: {
                        isInteractive: true,
                        visibility: "click",
                    },
                    customData: todo,
                })),
                // {
                //     key: "today",
                //     highlight: {
                //         style: {
                //             backgroundColor: "#EB5757",
                //         },
                //     },
                //     dates: new Date(),
                // },
            ];
        },
        showCommonInvites() {
            if (this.active == "new") {
                return this.newInvites;
            }
            if (this.active == "accepted") {
                return this.acceptedInvites;
            }
            if (this.active == "declined") {
                return this.rejectedInvites;
            }
            if (this.active == "pending") {
                return this.pendingInvites;
            }
        },
        todaySchedule() {
            let todayevents = [];
            let today = new Date().toDateString();
            this.events.forEach((item) => {
                if (
                    '"' + new Date(item.startDate).toDateString() + '"' ==
                    '"' + today + '"'
                ) {
                    todayevents.push(item);
                }
            });
            return todayevents;
        },
    },
    mounted() {
        //console.log("sss", Splide);
        this.$nextTick(() => {
            window.addEventListener("resize", this.setWidth);
        });
        document.onreadystatechange = () => {
            if (document.readyState == "complete") {
                this.setSplider();
            }
        };
    },
};
</script>

<style scoped>
.blur {
    filter: blur(2px);
    pointer-events: none;
}
.main-cont {
    display: flex;
    position: relative;
    top: 60px;
    margin-bottom: 145px;
}
.guest-dash-left-cont {
    width: 70%;
    background: #f6f5fb;
    display: flex;
    padding: 12px;
}
.guest-left-invi-cont {
    width: 70%;
    margin-right: 12px;
}
.guest-left-invi-cont > h1 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 18.8093px;
    line-height: 28px;
    margin-bottom: 15px;
    color: #000000;
    padding-left: 15px;
}
.guest-left-invi-cont > h2 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 13px;
    line-height: 20px;
    margin-bottom: 7px;
    color: #000000;
    padding-left: 15px;
}
.guest-left-invi-count {
    display: flex;
    justify-content: space-between;
}

.guest-left-invi-single {
    display: flex;
    align-items: center;
    background: #ffffff;
    border-radius: 5.90155px;
    max-width: 186px;
    width: 100%;
    margin-right: 10px;
    padding: 11px 15px;
    cursor: pointer;
}
.guest-left-invi-single.active {
    background: #461952;
    border-radius: 5.90155px;
}
.guest-left-invi-single.active > span:nth-child(1) {
    background: rgba(255, 255, 255, 0.3);
    border-radius: 5.90155px;
}
.guest-left-invi-single > span:nth-child(1) {
    background: #f8f8f8;
    border-radius: 5.90155px;
    padding: 9px;
    display: block;
    margin-right: 10px;
}

.guest-left-invi-single > span:nth-child(2) {
    display: flex;
    flex-direction: column;
}
.guest-left-invi-single.active > span:nth-child(2) > span:nth-child(1),
.guest-left-invi-single.active > span:nth-child(2) > span:nth-child(2) {
    color: #ffffff !important;
}
.guest-left-invi-single > span:nth-child(2) > span:nth-child(1) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 7.40266px;
    line-height: 11px;
    color: #000000;
}
.guest-left-invi-single > span:nth-child(2) > span:nth-child(2) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 17.1794px;
    line-height: 26px;
    color: #c4c4c4;
}
.noti-mobile-cont > h3 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 13px;
    line-height: 20px;
    text-transform: capitalize;
    color: #000000;
    margin: 10px 0;
    padding-left: 15px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.width-mod{
    width: 30%;
}
.guest-left-noti-cont {
    background-color: #ffffff;
    height: max-content;
}
.guest-left-noti-cont > div:nth-child(1) {
    padding: 10px 20px;
}
.noti-all-cont {
    min-height: 230px;
    max-height: 230px;
    transition: all linear 300ms;
    overflow-y: auto;
    scrollbar-width: thin;
}
.all-invi-cont {
    /* display: flex;
    flex-wrap: nowrap; */
    align-items: unset !important;
    padding-bottom: 5px;
}
.all-invi-cont > li {
    display: block;
    height: auto !important;
}
.noti-all-cont::-webkit-scrollbar-track {
    background-color: #ebebf5;
}
.noti-all-cont::-webkit-scrollbar-track:hover {
    background-color: #f4f4f4;
}
.noti-all-cont::-webkit-scrollbar-thumb {
    background-color: #babac0;
    border-radius: 16px;
    border: 5px solid #fff;
}
.noti-all-cont::-webkit-scrollbar-thumb:hover {
    background-color: #a0a0a5;
    border: 4px solid #f4f4f4;
}
.noti-all-cont.increase-height {
    min-height: 450px;
    max-height: 500px;
}
.guest-left-noti-cont > div:nth-child(1) > h1 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 12.8889px;
    line-height: 19px;
    text-align: center;
    border-bottom: 0.5px solid #d6d6d6;
    color: #000000;
    padding-bottom: 12px;
    margin-bottom: 10px;
    text-transform: uppercase;
}
.noti-all-single {
    display: flex;
    margin-bottom: 10px;
    align-items: center;
}
.noti-all-single > img {
    widows: 25px;
    height: 25px;
    border-radius: 50%;
    margin-right: 12px;
}
.noti-all-single > span {
    font-family: "Roboto";
    font-style: normal;
    font-weight: 400;
    font-size: 11.6667px;
    line-height: 14px;
    color: #000000;
}
.guest-noti-view-more {
    background: #ffffff;
    box-shadow: 0px -2px 4px rgba(185, 185, 185, 0.25);
    margin-top: 5px;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 15px;
    width: 100%;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 11.6667px;
    line-height: 17px;
    color: #c4456f;
}
.guest-dash-right-cont {
    width: 30%;
    background-color: #ffffff;
    padding-left: 15px;
}
.guest-dash-right-cont > h1 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 18px;
    line-height: 27px;
    text-transform: capitalize;
    color: #000000;
}
.guest-dash-right-cont > h2 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 12.6916px;
    line-height: 19px;
    color: #858585;
}
.guest-event-all {
    margin-top: 15px;
    max-height: 350px;
    overflow-y: auto;
}
.guest-event-all::-webkit-scrollbar {
    display: none;
}
.guest-event-all {
    -ms-overflow-style: none; /* IE and Edge */
    scrollbar-width: none; /* Firefox */
}
.guest-event-single {
    background: #ffffff;
    border: 0.5px solid #e4e4e4;
    border-radius: 5px;
    padding: 16px;
    margin-bottom: 10px;
    max-width: 289px;
    width: 100%;
}
.guest-event-top > span:nth-child(1) {
    display: inline-block;
    background: #64c96e;
    width: 7px;
    height: 7px;
    margin-right: 15px;
}
.guest-event-top > span:nth-child(2) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 8.63758px;
    line-height: 13px;
    color: #a9a9a9;
}
.guest-event-mid {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 12.6916px;
    line-height: 19px;
    color: #000000;
    margin-bottom: 7px;
}
.guest-event-bottom {
    display: flex;
    align-items: center;
}
.guest-event-bottom > span {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 7.8066px;
    line-height: 12px;
    margin-left: 10px;
    color: #a9a9a9;
}
.noti-mobile {
    background: #ffffff;
    border-radius: 5px;
    padding: 11px 15px !important;
}
.no-invi-cont {
    position: relative;
}
.no-invi-cont > img {
    width: 100%;
    height: auto;
    object-fit: cover;
}
.no-invi-cont > div {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 600;
    font-size: 17.3927px;
    line-height: 26px;
    text-align: center;
    text-transform: uppercase;
    color: #000000;
    position: absolute;
    top: 0;
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
.today-schedule-events-cont > h1 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 18px;
    line-height: 27px;
    color: #000000;
}
.today-schedule-events-single {
    background: #ffffff;
    border: 1.91317px solid #ededf0;
    border-radius: 6.37724px;
    padding: 16px;
    margin-bottom: 10px;
    max-width: 289px;
    width: 100%;
}
.today-event-head {
    display: flex;
}
.today-event-head > img {
    width: 25px;
    height: 25px;
    border-radius: 50%;
    margin-right: 5px;
}
.today-event-head > span:nth-child(2) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 600;
    font-size: 20px;
    line-height: 30px;
    color: #c4456f;
}
.today-event-head > span:nth-child(2) > span {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 20px;
    line-height: 30px;
    color: #000000;
}
.today-event-mid {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 300;
    font-size: 12px;
    line-height: 18px;
    color: #000000;
    display: flex;
}
.today-event-mid > img {
    margin-right: 5px;
}
.host-testi-cont {
    border-radius: 5px;
background: #FFF;
display: flex;
padding: 15px;
margin-top: 15px;
}
.host-testi-cont > div {
    display: flex;
    flex-direction: column;
    justify-items: flex-end;
    width:100%;
}
.host-testi-cont h3{
    margin-bottom: 5px;
    color: #000;
text-align: right;
font-family: Poppins;
font-size: 13px;
font-style: normal;
font-weight: 500;
line-height: normal;
}
.host-testi-cont button{
    border: none;
    outline: none;
    border-radius: 5px;
    text-decoration: none;
    display: inline-block;
    margin-top: 15px;
    margin-left: auto;
background: #B52F6F;
padding: 11px;
color: #FFF;
text-align: center;
font-family: Poppins;
font-size: 10px;
font-style: normal;
font-weight: 400;
line-height: normal;
}

/* .guest-left-invi-single > span:nth-child(1) > img {
    filter: invert(11%) sepia(80%) saturate(1725%) hue-rotate(267deg) brightness(91%) contrast(96%);
}
.guest-left-invi-single.active > span:nth-child(1) > img {
    filter: invert(100%) sepia(100%) saturate(0%) hue-rotate(294deg) brightness(105%) contrast(101%);
} */
/* .white-filter {
    filter: invert(100%) sepia(100%) saturate(0%) hue-rotate(294deg) brightness(105%) contrast(101%);
} */
.guest-left-invi-single.active > span:nth-child(1) > img {
    filter: invert(100%) sepia(100%) saturate(0%) hue-rotate(294deg) brightness(105%) contrast(101%);
}
.guest-left-invi-single.active .purple-filter {
    filter: invert(0%) sepia(68%) saturate(0%) hue-rotate(156deg) brightness(172%) contrast(213%) !important;
}
.purple-filter {
    filter: invert(11%) sepia(20%) saturate(1657%) hue-rotate(262deg) brightness(44%) contrast(123%);
}
.testi-popup-cont{
    width: 100%;
    height: 100%;
    position: fixed;
    background: rgba(0, 0, 0, 0.50);
    z-index: 999999999999999;
    top: 0;
    left: 0;
    display: flex;
    justify-content: center;
    align-items: center;
}
.testi-form-cont{
    border-radius: 8.388px;
    background: #FFF;
    box-shadow: 0px 3.35501px 50.3252px 0px rgba(0, 0, 0, 0.25);
    width: 100%;
    padding: 30px;
    max-width: 620px;
}
.testi-form-head {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.testi-form-head  > div {
    color: #000;
    font-family: Poppins;
    font-size: 20px;
    font-style: normal;
    font-weight: 600;
    line-height: normal;
    display: flex;
    flex-direction: column;
}
.testi-form-head  > div > span:nth-child(2){
    margin-top: 5px;
    display: block;
    width: 45px;
    height: 6px;
    background: #C4456F;
}
.testi-form-stars-cont{
    margin-top: 35px;
}
.testi-form-stars-cont > span {
    margin-right: 10px;
    border-radius: 3.326px;
    border: 0.554px solid #C9C9C9;
    padding: 15px 10px;
}
.testi-form-stars-cont > p{
    color: #636363;
    font-family: Poppins;
    font-size: 15px;
    font-style: normal;
    font-weight: 500;
    line-height: normal;
    text-decoration-line: underline;
    margin-top: 15px;
}
.testi-form-que{
    color: #000;
    font-family: Poppins;
    font-size: 18px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
}
.testi-form-que > span{
    font-weight: 600;
}
.testi-form-cont textarea {
    border-radius: 7px;
    border: 0.8px solid #A4A4A4;
    padding: 24px 28px 24px 29px;
    background-color: white !important;
    width: 100%;
    color: #898989;
    font-family: Poppins;
    font-size: 15px;
    font-style: normal;
    font-weight: 400;
    line-height: 165%;
}
.testi-form-cont textarea:hover{
    background-color: white !important;
}
.testi-form-cont > form  button{
    border-radius: 11px;
    background: #461952;
    padding: 18px 33px;
    color: #FFF;
    font-family: Mulish;
    font-size: 12.581px;
    font-style: normal;
    font-weight: 800;
    line-height: normal;
    display: inline-block;
    margin-left: auto;
}
@media screen and (max-width: 1200px){
    .guest-left-invi-count{
        flex-wrap: wrap;
    }
    .guest-left-invi-count > div {
        justify-content: space-between;
        width:100%;
        margin-top: 5px;
    }
}
@media screen and (max-width: 992px) {
    .guest-left-invi-single {
        flex-wrap: wrap;
        justify-content: center;
        background-color: transparent !important;
    }
    .guest-left-invi-single > span:nth-child(2) {
        width: 100%;
    }
    .guest-left-invi-single > span:nth-child(1) {
        margin-right: 0 !important;
        margin-bottom: 7px;
    }
    .guest-left-invi-single.active > span:nth-child(1) {
        background-color: #461952 !important ;
    }
    .guest-left-invi-single.active > span:nth-child(2) > span:nth-child(1),
    .guest-left-invi-single.active > span:nth-child(2) > span:nth-child(2) {
        color: #461952 !important;
        text-align: center;
    }
    .guest-left-invi-single > span:nth-child(2) > span:nth-child(1),
    .guest-left-invi-single > span:nth-child(2) > span:nth-child(2) {
        color: #828282 !important;
        text-align: center;
    }
    .guest-dash-left-cont {
        width: 64% !important;
    }
    .guest-dash-right-cont {
        width: 36% !important;
    }
    .guest-left-invi-cont {
        width: 100% !important;
    }
    .width-mod{
    width: 48% !important;
}
    /* .guest-left-noti-cont {
        width: 48% !important;
    } */
}
@media screen and (max-width: 768px) {
    .guest-dash-left-cont {
        flex-wrap: wrap;
        width: 50% !important;
        flex-direction: column;
    }
    /* .guest-left-invi-cont {
        width: 100% !important;
    } */
    .width-mod{
    width: 100% !important;
}
    .guest-left-noti-cont {
        width: 100% !important;
        margin-top: 15px;
    }
    .guest-dash-right-cont {
        width: 50% !important;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .main-cont {
        top: 115px !important;
        margin-bottom: 115px !important;
    }
}
@media screen and (max-width: 576px) {
    .guest-left-invi-cont{
        width:100% !important;
    }
    .guest-left-noti-cont > div:nth-child(1) > h1 {
        display: flex;
        justify-content: space-between;
        border-bottom: none !important ;
        margin-bottom: 0 !important;
        align-items: center;
        text-transform: capitalize !important;
        padding-bottom: 0 !important;
    }
    .guest-left-noti-cont > div:nth-child(1) {
        padding: 0 !important;
    }
    .noti-mobile-cont > h3 {
        padding-left: 0 !important;
        padding-bottom: 0 !important;
        margin: 0 !important;
    }
    .guest-left-noti-cont {
        padding: 11px 15px !important;
    }
    .guest-dash-left-cont,
    .guest-dash-right-cont {
        width: 100% !important;
    }
    .main-cont {
        flex-wrap: wrap;
        background-color: #f6f5fb;
    }
    .guest-dash-right-cont {
        margin: 12px !important;
    }
    .guest-dash-right-cont > h1 {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0 !important;
        align-items: center;
        text-transform: capitalize !important;
        width: 100%;
        font-style: normal;
        font-weight: 500;
        font-size: 12.8889px;
        line-height: 19px;
    }
    .guest-dash-right-cont {
        padding: 11px 15px !important;
    }
    .cal-cont,
    .noti-all-cont,
    .all-invi-cont {
        margin-top: 15px;
    }
    .today-schedule-events-single {
        max-width: none;
        width: 100%;
    }
}
</style>
<style>
.splide__slide.is-active {
    border: none !important;
}
</style>
