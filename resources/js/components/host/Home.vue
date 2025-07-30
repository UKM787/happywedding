<template>
    <div>
        <div class="host-home-main-cont">
            <div class="host-home-left-cont">
                <h1>Welcome <span v-if="invitation && invitation.side">{{ invitation.side == 'bride' ?
                                `${invitation.brideMotherName} & ${invitation.brideFatherName}` :
                                `${invitation.groomMotherName} & ${invitation.groomFatherName}`
                            }}</span></h1>
                <!-- <p
                    class="wed-btn wed-btn-main"
                    style="width: max-content; padding: 10px 15px"
                    v-if="invitation"
                >
                    <a
                        style="text-decoration: none; color: white"
                        :href="route('testify')"
                        >Testify</a>
                    >
                </p> -->
                <div v-if="invitation" class="host-banner-cont">
                    <img src="/assets/hosthome/host_home.png" alt="" />
                    <div class="overlay"></div>
                    <div class="host-banner-timer-cont">
                        <!-- <div class="img-cont">
                            <img src="/assets/hosthome/Frame5647.png" alt="" />
                            <img src="/assets/hosthome/Frame5647.png" alt="" />
                        </div> -->
                        <div class="name-cont">
                            <span>{{ invitation.side == 'bride' ? invitation.brideName : invitation.groomName }}</span>
                            <span>weds</span>
                            <span>{{ invitation.side == 'groom' ? invitation.brideName : invitation.groomName }}</span>
                        </div>
                        <div class="date-cont">
                            <img src="/assets/guestInvi/18.png" alt="" />
                            <span>{{
                                invitation.startDate | moment("DD.MM.YYYY")
                            }}</span>
                            <img src="/assets/guestInvi/17.png" alt="" />
                        </div>
                        <div class="guest-banner-timer">
                            <div class="guest-banner-timer-single">
                                <span></span>
                                <span>days</span>
                            </div>
                            <div class="guest-banner-timer-single">
                                <span></span>
                                <span>hours</span>
                            </div>
                            <div class="guest-banner-timer-single">
                                <span></span>
                                <span>minutes</span>
                            </div>
                            <div class="guest-banner-timer-single">
                                <span></span>
                                <span>seconds</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-else class="no-invi-banner-cont">
                    <div class="no-invi-content">
                        <!-- <h3>Welcome {{ loggedIn.name }}..</h3> -->
                        <p>
                            Plan and organize your wedding systematically, Make it
                            memorable with friends and relatives For a unique love
                            story
                        </p>
                        <a :href="route('hostinvitations.index')"
                            >Create your invitation</a
                        >
                    </div>
                    <img src="/assets/hosthome/noinvi.svg" alt="" />
                </div>
                <div
                    v-if="screenWidth < 631 && todaySchedule.length > 0"
                    class="host-today-task"
                >
                    <h1>Today's Task</h1>
                    <div>
                        <div
                            v-for="item in todaySchedule"
                            :key="item.id"
                            class="host-today-task-single"
                        >
                            <div class="host-today-task-single-head">
                                <span>
                                    <span></span>
                                    {{ item.taskStatus }}
                                </span>
                                <span>{{ item.category.name.charAt(0).toUpperCase() + item.category.name.slice(1).toLowerCase() }}</span>
                            </div>
                            <div class="host-today-task-assign">
                                Assigned to
                                <span>: {{ item.assignable.name }}</span>
                            </div>
                            <p>
                                {{ item.title }}
                            </p>
                            <div class="host-today-schedule">
                                <span
                                    ><img
                                        src="/assets/icon-calendar.svg"
                                        alt=""
                                    />{{ item.startDate | moment("Do MMMM, YYYY") }}
                                    -
                                    {{
                                        item.completionDate
                                            | moment("Do MMMM, YYYY")
                                    }}</span
                                >
                                <span>
                                    <img src="/assets/icon-clock.svg" alt="" />{{
                                        new Date("1970-01-01T" + item.startTime)
                                            | moment("h:mm a")
                                    }}
                                    -
                                    {{
                                        new Date(
                                            "1970-01-01T" + item.completionTime
                                        ) | moment("h:mm a")
                                    }}</span
                                >
                                <span
                                    ><img src="/assets/tag.svg" alt="" />{{
                                        item.taskPriority
                                    }}
                                    Priority</span
                                >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="host-left-second-cont">
                    <div class="host-invi-noti-cont">
                        <div v-if="invitation" class="host-invi-status-cont">
                            <h1
                                @click="
                                    show == 'inviStatus'
                                        ? (show = 'null')
                                        : (show = 'inviStatus')
                                "
                            >
                                Invitation Status
                                <img
                                    v-if="
                                        screenWidth <= 631 && show != 'inviStatus'
                                    "
                                    src="/assets/guestDash/chevron-down.svg"
                                    alt=""
                                />
                                <img
                                    v-if="
                                        screenWidth <= 631 && show == 'inviStatus'
                                    "
                                    src="/assets/guestDash/chevron-up.svg"
                                    alt=""
                                />
                            </h1>
                            <div
                                v-show="show == 'inviStatus' || screenWidth >= 631"
                            >
                                <div class="invi-status-single">
                                    <span>
                                        <img
                                            src="/assets/hosthome/ic_baseline-card-giftcard.svg"
                                            alt=""
                                        />
                                        Total Sent
                                    </span>
                                    <span>{{ invitationcount }}</span>
                                </div>
                                <div class="invi-status-single">
                                    <span>
                                        <img
                                            src="/assets/hosthome/carbon_pending.svg"
                                            alt=""
                                        />
                                        Not Seen
                                    </span>
                                    <span>{{
                                        invitationcount -
                                        (invitationsaccepted +
                                            invitationspending +
                                            invitationsdeclined)
                                    }}</span>
                                </div>
                                <div class="invi-status-single">
                                    <span>
                                        <img
                                            src="/assets/hosthome/mdi_clipboard-tick-outline.svg"
                                            alt=""
                                        />
                                        Accepted
                                    </span>
                                    <span>{{ invitationsaccepted }}</span>
                                </div>
                                <div class="invi-status-single">
                                    <span>
                                        <img
                                            src="/assets/hosthome/carbon_pending.svg"
                                            alt=""
                                        />
                                        Pending
                                    </span>
                                    <span>{{ invitationspending }}</span>
                                </div>
                                <div class="invi-status-single">
                                    <span>
                                        <img
                                            src="/assets/hosthome/mdi_cancel-circle-multiple-outline.svg"
                                            alt=""
                                        />
                                        Declined
                                    </span>
                                    <span>{{ invitationsdeclined }}</span>
                                </div>
                            </div>
                        </div>
                        <div v-else class="host-invi-status-cont">
                            <h1
                                @click="
                                    show == 'inviStatus'
                                        ? (show = 'null')
                                        : (show = 'inviStatus')
                                "
                            >
                                Invitation Status
                                <img
                                    v-if="
                                        screenWidth <= 631 && show != 'inviStatus'
                                    "
                                    src="/assets/guestDash/chevron-down.svg"
                                    alt=""
                                />
                                <img
                                    v-if="
                                        screenWidth <= 631 && show == 'inviStatus'
                                    "
                                    src="/assets/guestDash/chevron-up.svg"
                                    alt=""
                                />
                            </h1>
                            <div
                                v-show="show == 'inviStatus' || screenWidth >= 631"
                            >
                                <p class="no-invi-msg">
                                    Create invitation and send invitation to guests
                                    to track status
                                </p>
                                <div class="no-invi-img">
                                    <img
                                        src="/assets/hosthome/no-invi-img.png"
                                        alt=""
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="host-dash-reports-cont">
                            <h1
                                @click="
                                    show == 'reports'
                                        ? (show = 'null')
                                        : (show = 'reports')
                                "
                            >
                                Guests Facilities
                                <img
                                    v-if="screenWidth <= 631 && show != 'reports'"
                                    src="/assets/guestDash/chevron-down.svg"
                                    alt=""
                                />
                                <img
                                    v-if="screenWidth <= 631 && show == 'reports'"
                                    src="/assets/guestDash/chevron-up.svg"
                                    alt=""
                                />
                            </h1>
                            <div
                                v-show="show == 'reports' || screenWidth >= 631"
                                class="host-reports-cont"
                            >
                                <div class="host-reports-head">
                                    <span style="width: 50%; padding-left: 46px"
                                        >Progress</span
                                    >
                                    <span
                                        style="
                                            width: 25%;
                                            min-width: 95px;
                                            text-align: center;
                                        "
                                        >Accomodation</span
                                    >
                                    <span
                                        style="
                                            width: 25%;
                                            min-width: 65px;
                                            text-align: center;
                                        "
                                        >Logisitcs</span
                                    >
                                </div>
                                <div class="host-reports-single">
                                    <span style="width: 50%; display: flex">
                                        <img
                                            src="/assets/hosthome/Frame5668.svg"
                                            alt=""
                                        />
                                        <span>Accepted</span></span
                                    >
                                    <span
                                        style="
                                            width: 25%;
                                            min-width: 95px;
                                            text-align: center;
                                        "
                                        >{{ accaccomodation }}</span
                                    >
                                    <span
                                        style="
                                            width: 25%;
                                            min-width: 65px;
                                            text-align: center;
                                        "
                                        >{{ acclogisitcs }}</span
                                    >
                                </div>
                                <div class="host-reports-single">
                                    <span style="width: 50%; display: flex">
                                        <img
                                            src="/assets/hosthome/Frame5670.svg"
                                            alt=""
                                        />
                                        <span>Pending</span></span
                                    >
                                    <span
                                        style="
                                            width: 25%;
                                            min-width: 95px;
                                            text-align: center;
                                        "
                                        >{{
                                            sentaccomodation -
                                            (accaccomodation + decaccomodation)
                                        }}</span
                                    >
                                    <span
                                        style="
                                            width: 25%;
                                            min-width: 65px;
                                            text-align: center;
                                        "
                                        >{{
                                            sentlogistics -
                                            (acclogisitcs + declogisitcs)
                                        }}</span
                                    >
                                </div>
                                <div class="host-reports-single">
                                    <span style="width: 50%; display: flex">
                                        <img
                                            src="/assets/hosthome/Frame5669.svg"
                                            alt=""
                                        />
                                        <span>Declined</span></span
                                    >
                                    <span
                                        style="
                                            width: 25%;
                                            min-width: 95px;
                                            text-align: center;
                                        "
                                        >{{ decaccomodation }}</span
                                    >
                                    <span
                                        style="
                                            width: 25%;
                                            min-width: 65px;
                                            text-align: center;
                                        "
                                        >{{ declogisitcs }}</span
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="guest-left-not-vendor-cont">
                        <div class="host-guest-member-cont">
                            <div
                                class="host-guest-member-cont-single"
                                style="margin-bottom: 10px"
                            >
                                <div>
                                    <span></span>
                                    <span>
                                        <span>{{ guestcount }}</span>
                                        <span>Total Guests</span>
                                    </span>
                                </div>
                                <a
                                    :href="
                                        route(
                                            'invitedguests.custom',
                                            invitation?.slug ?? ''
                                        )
                                    "
                                >
                                    <img
                                        src="/assets/miscellenous/user-plus.svg"
                                        alt=""
                                    />
                                </a>
                            </div>
                            <!-- <div class="host-guest-member-cont-single">
                                <div>
                                    <span></span>
                                    <span>
                                        <span>{{ members }}</span>
                                        <span>Total Members</span>
                                    </span>
                                </div>
                                <a :href="route('hostmembers.index')">
                                    <img
                                        src="/assets/miscellenous/user-plus.svg"
                                        alt=""
                                    />
                                </a>
                            </div> -->
                        </div>
                        <div class="guest-left-noti-cont">
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
                                            screenWidth <= 631 &&
                                            show != 'notifications'
                                        "
                                        src="/assets/guestDash/chevron-down.svg"
                                        alt=""
                                    />
                                    <img
                                        v-if="
                                            screenWidth <= 631 &&
                                            show == 'notifications'
                                        "
                                        src="/assets/guestDash/chevron-up.svg"
                                        alt=""
                                    />
                                </h1>
                                <div
                                    v-show="
                                        (show == 'notifications' ||
                                            screenWidth >= 631) &&
                                        notifications.length > 0
                                    "
                                    class="noti-all-cont"
                                    :class="{ 'increase-height': increaseHeight }"
                                >
                                    <div
                                        v-for="(item, index) in notifications"
                                        :key="index"
                                        class="noti-all-single"
                                    >
                                        <img
                                            src="/assets/guestDash/Ellipse.svg"
                                            alt=""
                                        />
                                        <span>{{ item.data.status }}</span>
                                    </div>
                                </div>
                                <div
                                    v-show="
                                        (show == 'notifications' ||
                                            screenWidth >= 631) &&
                                        notifications.length == 0
                                    "
                                    class="no-noti-cont"
                                >
                                    <img
                                        src="/assets/hosthome/Frame5672.svg"
                                        alt=""
                                    />
                                    <h4>No Notifications</h4>
                                </div>
                            </div>
                            <div
                                v-if="
                                    increaseHeight == false &&
                                    notifications.length > 0 &&
                                    (show == 'notifications' || screenWidth >= 631)
                                "
                                @click="increaseHeight = true"
                                class="guest-noti-view-more"
                            >
                                View More
                            </div>
                            <div
                                v-if="
                                    increaseHeight == true &&
                                    notifications.length > 0 &&
                                    (show == 'notifications' || screenWidth >= 631)
                                "
                                @click="increaseHeight = false"
                                class="guest-noti-view-more"
                            >
                                View Less
                            </div>
                        </div>
                        <div v-if="screenWidth > 631 && invitation" class="host-testi-cont">
                            <img src="/assets/testi.png" alt="" />
                            <div>
                                <h3>Share Your Story with us:</h3>
                                <h3>Review Us Now!</h3>
                                <button @click="showTestimonialForm = true">Testimony</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="host-home-right-cont">
                <div
                    v-if="screenWidth > 631 && todaySchedule.length > 0"
                    class="host-today-task"
                >
                    <h1>Today's Events</h1>
                    <div>
                        <div
                            v-for="item in todaySchedule"
                            :key="item.id"
                            class="host-today-task-single"
                        >
                            <div class="host-today-task-single-head">
                                <span class="event-cal">
                                    <span
                                        :style="{ background: item.type === 'ceremony' ? '#912955' : '#f4a545' }"
                                    ></span>
                                    {{
                                        item.startDate | moment("Do MMMM, YYYY")
                                    }}
                                </span>
                                <span class="event-time">{{
                                    new Date("1970-01-01T" + item.startTime)
                                        | moment("h:mm A")
                                }}</span>
                                <span v-if="item.type !== 'ceremony'">{{ item.category.name.charAt(0).toUpperCase() + item.category.name.slice(1).toLowerCase() }}</span>
                            </div>
                            <p style="font-size: 20px;">
                                {{ item.title.charAt(0).toUpperCase() + item.title.slice(1).toLowerCase() }}
                            </p>
                            <div class="host-today-schedule">
                                <span
                                    ><img
                                        src="/assets/icon-calendar.svg"
                                        alt=""
                                    />{{ item.startDate | moment("Do MMMM, YYYY") }}
                                    -
                                    {{
                                        item.completionDate
                                            | moment("Do MMMM, YYYY")
                                    }}</span
                                >
                                <span>
                                    <img src="/assets/icon-clock.svg" alt="" />{{
                                        new Date("1970-01-01T" + item.startTime)
                                            | moment("h:mm a")
                                    }}
                                    -
                                    {{
                                        new Date(
                                            "1970-01-01T" + item.completionTime
                                        ) | moment("h:mm a")
                                    }}</span
                                >
                                <span
                                    ><img src="/assets/tag.svg" alt="" />{{
                                        item.taskPriority
                                    }}
                                    Priority</span
                                >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="host-cal-events-cont">
                    <div
                        @click="
                            show == 'upcomingEvents'
                                ? (show = 'null')
                                : (show = 'upcomingEvents')
                        "
                        class="host-cal-head"
                    >
                        <div>
                            <div>Upcoming Events</div>
                            <div>Don't miss the upcoming Events</div>
                        </div>
                        <!-- <a
                            v-if="screenWidth > 631"
                            :href="route('hosttasks.index')"
                        >
                            +
                        </a> -->
                        <img
                            v-if="screenWidth <= 631 && show != 'inviStatus'"
                            src="/assets/guestDash/chevron-down.svg"
                            alt=""
                        />
                        <img
                            v-if="screenWidth <= 631 && show == 'inviStatus'"
                            src="/assets/guestDash/chevron-up.svg"
                            alt=""
                        />
                    </div>
                    <div v-show="show == 'upcomingEvents' || screenWidth >= 631">
                        <div class="cal-cont">
                            <Calendar
                                ref="calendar"
                                :value="initialCalendarDate"
                                :attributes="attr"
                                :masks="{ title: 'MMMM YYYY' }"
                                @dayclick="dayclicked"
                                @input="updateYear"

                            >
                                <template #day-popover="{ day, dayTitle }">
                                    <div class="text-xs text-gray-300 font-semibold text-center">
                                        {{ dayTitle }}
                                    </div>
                                    <div v-for="(item, index) in filteredTodosForCalendar" :key="index">
                                        <div v-if="item.startDate === day.date.toISOString().split('T')[0]" class="popover-content">
                                            <div class="host-today-task-single">
                                                <div class="host-today-task-single-head">
                                                    <span class="event-cal">
                                                        <span :style="{ background: item.type === 'ceremony' ? '#912955' : '#f4a545' }"></span>
                                                        {{ item.startDate | moment("Do MMMM, YYYY") }}
                                                    </span>
                                                    <span class="event-time">
                                                        {{ new Date("1970-01-01T" + item.startTime) | moment("h:mm A") }}
                                                    </span>
                                                </div>
                                                <p style="font-size: 20px;">
                                                    {{ item.title.charAt(0).toUpperCase() + item.title.slice(1).toLowerCase() }}
                                                </p>
                                                <div v-if="item.type === 'ceremony'" style="color: #912955; font-weight: 500; margin-top: 5px;">
                                                    {{ item.category.name.charAt(0).toUpperCase() + item.category.name.slice(1).toLowerCase() }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </Calendar>
                        </div>
                        <div v-if="tasks.length > 0" class="host-all-events">
                            <div
                                v-for="(item, index) in sortedTasks"
                                :key="index"
                                class="host-today-task-single"
                            >
                                <div class="host-today-task-single-head">
                                    <span class="event-cal">
                                        <span
                                            :style="{ background: item.type === 'ceremony' ? '#912955' : '#f4a545' }"
                                        ></span>
                                        {{
                                            item.startDate | moment("Do MMMM, YYYY")
                                        }}
                                    </span>
                                    <span class="event-time">{{
                                        new Date("1970-01-01T" + item.startTime)
                                            | moment("h:mm A")
                                    }}</span>
                                </div>
                                <p style="font-size: 20px;">
                                    {{ item.title.charAt(0).toUpperCase() + item.title.slice(1).toLowerCase() }}
                                </p>
                                <div v-if="item.type === 'ceremony'" style="color: #912955; font-weight: 500; margin-top: 5px;">
                                    {{ item.category.name.charAt(0).toUpperCase() + item.category.name.slice(1).toLowerCase() }}
                                </div>
                            </div>
                        </div>
                        <div class="no-tasks" v-else>No Tasks Added yet!</div>
                    </div>
                </div>

                <div v-if="date.name" class="date-name-cont">
                    {{date.name}}
                </div>
                <div v-if="screenWidth < 631 && invitation" class="host-testi-cont">
                            <img src="/assets/testi.png" alt="" />
                            <div>
                                <h3>Share Your Story with us:</h3>
                                <h3>Review Us Now!</h3>
                                <a :href="route('testify')">Testimony</a>
                            </div>
                        </div>
            </div>
            <!-- <div
                v-if="screenWidth < 631"
                class="host-explore-vendor"
                style="margin: auto"
            >
                <img src="/assets/hosthome/vendor.svg" alt="" />
                <h3>Explore vendors near you</h3>
                <p>starting from ₹2000 for couple plan book now</p>
                <a href="/directory">Explore Vendors</a>
            </div> -->
        </div>
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
        <FlashMessage :message="message"></FlashMessage>
    </div>
</template>

<script>
import Calendar from "v-calendar/lib/components/calendar.umd";
import FlashMessage from "../FlashMessage.vue";


export default {
    components: {
        Calendar,
        FlashMessage
    },
    props: [
        "loggedIn",
        "invitation",
        "invitationsaccepted",
        "invitationsdeclined",
        "invitationspending",
        "notifications",
        "invitationcount",
        "accaccomodation",
        "allaccomodation",
        "sentaccomodation",
        "sentlogistics",
        "acclogisitcs",
        "alllogisitcs",
        "decaccomodation",
        "declogisitcs",
        "guestcount",
        "members",
        "tasks",
    ],
    data() {
        return {
            todos: this.tasks,
            screenWidth: window.screen.width,
            increaseHeight: false,
            show: null,
            showTestimonialForm: false,
            disableSubmit:false,
            errorsSubmit:null,
            message: null,
            testiFeilds: {
                body: null,
                stars: 0,
            },
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
            latestCeremonyDate: null,
        };
    },
     watch: {
        todos: {
            handler(newTodos, oldTodos) {
                // Find the most recently added ceremony
                const newCeremonies = newTodos.filter(todo => todo.type === 'ceremony' && !oldTodos.some(oldTodo => oldTodo.id === todo.id));
                if (newCeremonies.length > 0) {
                    this.latestCeremonyDate = new Date(newCeremonies[0].startDate);
                }
            },
            deep: true
        },
        latestCeremonyDate(newDate) {
            if (newDate) {
              this.$nextTick(() => {
                if (this.$refs.calendar && this.$refs.calendar.move) {
                  this.$refs.calendar.move(this.initialCalendarDate);
                }
              });
            }
        }
    },
    computed: {
        initialCalendarDate() {
            return this.getInitialCalendarDate();
        },
        attr() {
            return [
                ...this.todos.map((todo) => ({
                    dates: todo.startDate,
                    highlight: {
                        style: {
                            backgroundColor:
                                todo.type === "ceremony" ? "#912955" : "#C4456F",
                            borderRadius: "5px",
                        },
                        contentStyle: {
                            color: "#FFFFFF",
                        },
                    },
                    popover: {
                        isInteractive: true,
                        visibility: "click",
                        placement: "bottom",
                        hideIndicator: true,
                    },
                    customData: todo,
                })),
            ];
        },
        filteredTodosForCalendar() {
            return this.todos
                .filter((item) => {
                    const eventYear = new Date(item.startDate).getFullYear();
                    return eventYear === this.date.year;
                })
                .sort((a, b) => {
                    // Sort ceremonies in reverse chronological order (newest first)
                    if (a.type === "ceremony" && b.type === "ceremony") {
                        return new Date(b.startDate) - new Date(a.startDate);
                    }
                    // Keep ceremonies at the top
                    if (a.type === "ceremony" && b.type !== "ceremony") {
                        return -1;
                    }
                    if (a.type !== "ceremony" && b.type === "ceremony") {
                        return 1;
                    }
                    // Sort non-ceremony items by date
                    return new Date(a.startDate) - new Date(b.startDate);
                });
        },
        todaySchedule() {
            let todayevents = [];
            let today = new Date().toDateString();
            this.todos.forEach((item) => {
                if (
                    '"' + new Date(item.startDate).toDateString() + '"' ==
                    '"' + today + '"'
                ) {
                    todayevents.push(item);
                }
            });
            return todayevents;
        },
        sortedTasks() {
            return [...this.tasks].sort((a, b) => {
                // Sort ceremonies in reverse chronological order (newest first)
                if (a.type === "ceremony" && b.type === "ceremony") {
                    // Use created_at for sorting ceremonies (newest first)
                    return new Date(b.created_at) - new Date(a.created_at);
                }
                // Keep ceremonies at the top
                if (a.type === "ceremony" && b.type !== "ceremony") {
                    return -1;
                }
                if (a.type !== "ceremony" && b.type === "ceremony") {
                    return 1;
                }
                // Sort non-ceremony items by date
                return new Date(a.startDate) - new Date(b.startDate);
            });
        },
    },
    mounted() {
        this.$nextTick(() => {
            window.addEventListener("resize", this.setWidth);
            if (this.invitation) {
                this.countDown();
            }
            this.$nextTick(() => {
                if (this.$refs.calendar && this.$refs.calendar.move) {
                  this.$refs.calendar.move(this.initialCalendarDate);
                }
            });
        });

    },
    methods: {
        getInitialCalendarDate() {
            if (this.latestCeremonyDate) {
                return this.latestCeremonyDate;
            }

            if (this.todos && this.todos.length > 0) {
                const ceremonies = this.todos.filter(todo => todo.type === 'ceremony');
                if (ceremonies.length > 0) {
                    // Find the earliest ceremony date
                    const earliestCeremony = ceremonies.reduce((earliest, current) => {
                        return new Date(current.startDate) < new Date(earliest.startDate) ? current : earliest;
                    });
                    return new Date(earliestCeremony.startDate);
                }
            }
            return this.invitation?.startDate ? new Date(this.invitation.startDate) : new Date();
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
        setWidth() {
            this.screenWidth = window.screen.width;
        },
        countDown() {
            const fixedDate = this.invitation.startDate;
            const deadlineTimer = document.querySelectorAll(
                ".guest-banner-timer-single > span:nth-child(1)"
            );

            const futureDate = new Date(fixedDate);
            const futureTime = futureDate.getTime();

            function getRemainingTime() {
                let today = new Date().getTime();

                let totalRemainingMS = futureTime - today;
                if (totalRemainingMS < 0) {
                    clearInterval(countdown);
                    return;
                }

                //values in ms
                const Oneday = 24 * 60 * 60 * 1000;
                const Onehour = 60 * 60 * 1000;
                const Oneminutes = 60 * 1000;

                //remaining time calulation
                let Day = Math.floor(totalRemainingMS / Oneday);
                let Hour = Math.floor((totalRemainingMS % Oneday) / Onehour);
                let Minutes = Math.floor(
                    (totalRemainingMS % Onehour) / Oneminutes
                );
                let Seconds = Math.floor(
                    (totalRemainingMS % Oneminutes) / 1000
                );

                const value = [Day, Hour, Minutes, Seconds];

                function format(item) {
                    if (item < 10) {
                        return (item = `0${item}`);
                    } else {
                        return item;
                    }
                }
                deadlineTimer.forEach(function (item, index) {
                    item.innerHTML = format(value[index]);
                });
            }
            let countdown = setInterval(getRemainingTime, 1000);
            getRemainingTime();
        },
        updateYear(date) {
            this.date.year = new Date(date).getFullYear();
        },
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
        }
    },
};
</script>

<style scoped>
.popover-content {
    padding: 5px;
}
.popover-title {
    font-weight: bold;
    margin-bottom: 3px;
}
.popover-time {
    font-size: 0.8em;
    color: #666;
}
.host-home-main-cont {
    display: flex;
    flex-wrap: nowrap;
    background: #ffffff;
}
.host-home-left-cont {
    width: 70%;
    background: #f4f3fa;
    padding: 12px;
}
.host-home-left-cont > h1 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 18.8093px;
    line-height: 28px;
    color: #000000;
    padding-left: 15px;
    margin-bottom: 15px;
}
.host-banner-cont {
    position: relative;
    padding-top: 210px;
    margin-bottom: 15px;
}
.no-invi-banner-cont {
    position: relative;
    margin-bottom: 15px;
    background: #ffffff;
    border-radius: 10px;
    padding-top: 210px;
}
.no-invi-banner-cont > img {
    top: 30px;
    right: 30px;
    position: absolute;
    width: 25%;
}
.no-invi-content {
    top: 30px;
    left: 30px;
    position: absolute;
    width: 60%;
}
.no-invi-content > h3 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 22px;
    line-height: 33px;
    color: #b52f6f;
    margin-bottom: 10px;
}
.no-invi-content > p {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 16px;
    line-height: 24px;
    color: #000000;
    margin-bottom: 7px;
}
.no-invi-content > a {
    border: none;
    outline: none;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 15px;
    line-height: 22px;
    background: #b52f6f;
    border-radius: 5px;
    color: #ffffff;
    padding: 11px 30px;
    display: block;
    width: max-content;
    text-decoration: none;
}
.host-banner-cont > img {
    position: absolute;
    top: 0;
    right: 0;
    object-fit: cover;
    z-index: 9;
    width: 100%;
    height: 100%;
    border-radius: 13px;
}
.host-banner-cont > .overlay {
    background: rgba(0, 0, 0, 0.5);
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    z-index: 99;
    border-radius: 13px;
}
.host-banner-timer-cont {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    position: absolute;
    top: 0;
    left: 0;
    z-index: 999;
    padding: 26px;
    max-width: 300px;
    width: 100%;
}
.host-banner-timer-cont > .img-cont {
    text-align: center;
}
.host-banner-timer-cont > .img-cont > img {
    width: 32px;
    height: 32px;
    border-radius: 50%;
}
.host-banner-timer-cont > .name-cont {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 10px;
}
.host-banner-timer-cont > .name-cont > span {
    font-family: "STSong";
    font-style: normal;
    font-weight: 400;
    font-size: 15.0633px;
    line-height: 20px;
    text-transform: uppercase;
    color: #ffffff;
}
.host-banner-timer-cont > .name-cont > span:nth-child(2) {
    font-family: "Stalemate";
    font-style: normal;
    font-weight: 400;
    font-size: 27.3879px;
    line-height: 40px;
    color: #ffffff;
    text-transform: none;
    padding: 0 10px;
}
.date-cont {
    margin-top: -18px;
}
.date-cont > span {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 12px;
    line-height: 18px;
    color: #ffffff;
}
.date-cont > img {
    height: 55px;
}
.guest-banner-timer {
    display: flex;
}
.guest-banner-timer-single {
    background: rgba(255, 255, 255, 0.3);
    box-shadow: 0px 0px 4px 1px rgba(0, 0, 0, 0.25);
    display: flex;
    flex-direction: column;
    justify-content: center;
    margin-right: 12px;
    width: 52px;
    height: 48px;
}
.guest-banner-timer:last-child {
    margin-right: 0;
}
.guest-banner-timer-single > span:nth-child(1) {
    font-family: "Perpetua";
    font-style: normal;
    font-weight: 400;
    font-size: 30.2548px;
    line-height: 35px;
    text-align: center;
    display: block;
    color: #ffffff;
}
.guest-banner-timer-single > span:nth-child(2) {
    font-family: "Segoe UI";
    font-style: normal;
    font-weight: 400;
    font-size: 5.23069px;
    line-height: 7px;
    display: block;
    text-align: center;
    color: #ffffff;
}
.host-left-second-cont {
    display: flex;
    flex-wrap: nowrap;
    align-items: flex-start;
}
.host-invi-noti-cont {
    width: 70%;
    display: flex;
    justify-content: space-between;
    /* flex-wrap: wrap; */
}
.host-invi-status-cont {
    background: rgba(255, 255, 255, 0.7);
    backdrop-filter: blur(5px);
    padding: 10px 20px;
    border-radius: 5px;
    width: 100%;
    /* max-width: 250px; */
}
.host-invi-status-cont > h1 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 18px;
    line-height: 47px;
    margin-bottom: 0px !important;
    align-items: center;
    color: #000000;
    display: flex;
    justify-content: space-between;
}
.host-invi-status-cont .no-invi-msg {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 14px;
    line-height: 21px;
    color: #000000;
}
.host-invi-status-cont .no-invi-img {
    display: flex;
    justify-content: flex-end;
}
.invi-status-single {
    display: flex;
    justify-content: space-between;
    margin-bottom: 7px;
}
.invi-status-single > span:nth-child(1) > img {
    margin-right: 10px;
}
.invi-status-single > span:nth-child(1) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 300;
    font-size: 16px;
    line-height: 24px;
    color: #6b6b6b;
}
.invi-status-single > span:nth-child(2) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 17.3622px;
    line-height: 26px;
    text-align: right;
    color: #000000;
}
.host-guest-member-cont {
    background: #ffffff;
    border-radius: 10px;
    padding: 10px;
    /* width: 48%; */
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: stretch;
    margin-bottom: 12px;
}
.host-guest-member-cont-single {
    background: linear-gradient(90deg, #dcafe8 0%, #eda4bc 98.61%);
    border-radius: 5px;
    padding: 9px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: 78px;
}
.host-guest-member-cont-single > div {
    display: flex;
    align-items: center;
}
.host-guest-member-cont-single > div > span:nth-child(1) {
    background: #ffffff;
    width: 10px;
    height: 10px;
    display: inline-block;
    border-radius: 50%;
    margin-right: 10px;
}
.host-guest-member-cont-single > div > span:nth-child(2) {
    display: flex;
    flex-direction: column;
}
.host-guest-member-cont-single > a {
    background: rgba(248, 248, 248, 0.2);
    border-radius: 6.51994px;
    display: block;
    padding: 14px;
}
.host-guest-member-cont-single > a > img {
    width: 24px;
    height: 24px;
}
.host-guest-member-cont-single > div > span:nth-child(2) > span:nth-child(1) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 26.8452px;
    line-height: 22px;
    color: #ffffff;
}
.host-guest-member-cont-single > div > span:nth-child(2) > span:nth-child(2) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 12px;
    line-height: 18px;
    text-align: center;
    color: #ffffff;
}
.host-dash-reports-cont {
    width: 100%;
    background: #ffffff;
    border-radius: 10px;
    padding: 10px 20px;
    margin-left: 15px;
    /* margin-top: 15px; */
}
.host-dash-reports-cont > h1 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 18px;
    line-height: 47px;
    margin-bottom: 0px !important;
    align-items: center;
    color: #000000;
    display: flex;
    justify-content: space-between;
}
.host-reports-head,
.host-reports-single {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}
.host-reports-head > span {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 10px;
    line-height: 15px;
    color: #a7a7a7;
}
.host-reports-single > span {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 17px;
    line-height: 26px;
    color: #595b5b;
}
.host-reports-single > span > img {
    margin-right: 10px;
}
.guest-left-not-vendor-cont {
    width: 30%;
    background: #f4f3fa;
    height: max-content;
    margin-left: 15px;
}
.guest-left-noti-cont {
    background-color: #ffffff;
}
.guest-left-noti-cont > div:nth-child(1) {
    padding: 10px 20px;
}
.no-noti-cont {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 180px;
    max-height: 130px;
    flex-direction: column;
}
.no-noti-cont > h4 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 12.8889px;
    line-height: 19px;
    text-align: center;
    color: #000000;
}
.noti-all-cont {
    min-height: 130px;
    max-height: 130px;
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
    font-size: 18px;
    line-height: 47px;
    margin-bottom: 0px !important;
    align-items: center;
    margin-bottom: 10px;
    color: #000000;
    display: flex;
    justify-content: space-between;
    border-bottom: 0.5px solid #d6d6d6;
    text-transform: capitalize;
    margin-bottom: 10px;
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
.host-home-right-cont {
    width: 30%;
    padding: 12px;
    background: #ffffff;
}
.cal-cont {
    margin-top: 10px;
}
.host-today-task > h1 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 18px;
    line-height: 47px;
    margin-bottom: 0px !important;
    align-items: center;
    text-transform: capitalize;
    color: #000000;
}
.host-today-task-single {
    background: #ffffff;
    border: 1.91317px solid #ededf0;
    border-radius: 6.37724px;
    padding: 13px;
    margin-bottom: 7px;
}
.host-today-task-single-head {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.host-today-task-single-head > span:nth-child(1) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 11.202px;
    line-height: 17px;
    color: #2fa706;
}

.host-today-task-single-head > span:nth-child(1) > span {
    width: 9px;
    height: 9px;
    display: inline-block;
    margin-right: 5px;
    background: #2fa706;
    border-radius: 50%;
}
.host-today-task-single-head > span:last-child {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 7.74194px;
    line-height: 12px;
    color: #ffffff;
    background: #c4456f;
    border-radius: 10px;
    padding: 5px 8px;
}
.host-today-task-assign {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 300;
    font-size: 16px;
    line-height: 24px;
    color: #000000;
}
.host-today-task-assign > span {
    font-weight: 500;
}
.host-today-task-single > p {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 10.9386px;
    line-height: 16px;
    color: #000000;
}
.host-today-schedule {
    display: flex;
    justify-content: space-between;
}
.host-today-schedule > span > img {
    margin-right: 5px;
}
.host-today-schedule > span {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 300;
    font-size: 7.95282px;
    line-height: 12px;
    color: #000000;
    margin-right: 3px;
}
.host-today-schedule > span:nth-child(3) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 7.95282px;
    line-height: 12px;
    color: #2fa706;
}
.host-cal-events-cont {
    margin: 15px 0;
    background: #ffffff;
}
.host-cal-head {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
}
.host-cal-head > div > div:nth-child(1) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 18px;
    line-height: 27px;
    text-transform: capitalize;
    color: #000000;
}
.host-cal-head > div > div:nth-child(2),
.no-tasks {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 12.6916px;
    line-height: 19px;
    color: #858585;
}
.host-cal-head > a {
    text-decoration: none;
    color: white;
    font-size: 15px;
    display: inline-block;
    background: #c4456f;
    border-radius: 3.42857px;
    padding: 7px 14px;
}
.host-all-events {
    margin-top: 15px;
}
.cal-cont {
    background: #ffffff;
    border: 0.5px solid #e9e9e9;
    box-shadow: 1px 1px 5px 1px rgba(150, 150, 150, 0.11);
    border-radius: 14.5047px;
    width: max-content;
}
.event-cal {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 8.63758px;
    line-height: 13px;
    color: #000000;
}
.event-time {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 9.63758px;
    line-height: 13px;
    color: green;
}
.host-explore-vendor {
    display: flex;
    justify-content: center;
    flex-direction: column;
    align-items: center;
    background: linear-gradient(120.16deg, #ddafe7 -4.88%, #eda5bd 99.89%);
    border-radius: 4.1px;
    margin-top: 30px;
    padding: 10px;
}
.host-explore-vendor > img {
    position: relative;
    top: -30px;
}
.host-explore-vendor > h3 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 600;
    font-size: 16px;
    line-height: 24px;
    text-align: center;
    color: #ffffff;
    margin-bottom: 4px;
}
.host-explore-vendor > p {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 16px;
    line-height: 24px;
    text-align: center;
    margin-bottom: 4px;
    color: #ffffff;
}
.host-explore-vendor > a {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 15px;
    line-height: 22px;
    text-align: center;
    color: #ffffff;
    background: #461952;
    border-radius: 4.57183px;
    padding: 10px;
    width: 100%;
    text-decoration: none;
    display: block;
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
    border-radius: 5px;
    border: none;
    outline: none;
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
@media screen and (max-width: 1400px) {
    .host-invi-noti-cont {
        flex-wrap: wrap;
    }
    .host-dash-reports-cont {
        margin-top: 15px;
        margin-left: 0;
    }
}
@media screen and (max-width: 998px) {
    .host-invi-status-cont {
        margin-bottom: 10px;
    }
    .host-guest-member-cont {
        margin: auto;
    }
    .host-invi-noti-cont {
        width: 100%;
    }
    .guest-left-not-vendor-cont {
        width: 70%;
        margin: auto;
        margin-top: 15px;
    }
    .host-left-second-cont {
        flex-wrap: wrap;
    }
    .host-home-left-cont {
        width: 65 !important;
    }
    .host-home-right-cont {
        width: 35% !important;
    }
    .no-invi-banner-cont > img {
        display: none;
    }
    .no-invi-content {
        width: 90%;
    }
}
@media screen and (max-width: 768px) {
    .host-invi-status-cont {
        order: 2;
        width: 100%;
    }
    .host-guest-member-cont {
        order: 1;
        width: 100%;
    }
    .host-dash-reports-cont {
        order: 3;
        width: 100%;
    }
    .host-home-left-cont {
        width: 57%;
    }
    .host-home-right-cont {
        width: 43% !important;
    }
}
@media screen and (max-width: 631px) {
    .host-guest-member-cont {
        margin-bottom: 25px;
    }
    .host-home-main-cont {
        flex-wrap: wrap;
    }
    .host-home-left-cont {
        width: 100% !important;
    }
    .host-home-right-cont {
        width: 100% !important;
    }
    .cal-cont {
        margin: auto;
    }
    .guest-left-not-vendor-cont {
        width: 100%;
    }
    .guest-left-noti-cont > div:nth-child(1) > h1 {
        border-bottom: none !important;
    }
    .host-home-main-cont {
        background: #f4f3fa;
    }
    /* .host-home-right-cont {
        background: #f4f3fa;
    } */
    .host-cal-events-cont {
        padding: 10px 20px;
        margin-top: 0 !important;
    }
    .host-home-right-cont {
        background: #f4f3fa;
    }
    .host-cal-head {
        align-items: center;
    }
    .cal-cont {
        margin-top: 10px;
    }
    /* .host-dash-reports-cont > h1 {
        margin-bottom: 10px !important;
    } */
    .no-invi-banner-cont {
        background-image: url("/assets/hosthome/host_home.png");
        background-repeat: no-repeat;
    }
    .no-invi-content {
        background: rgba(0, 0, 0, 0.6);
        top: 0;
        left: 0;
        padding: 30px;
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .no-invi-content > p {
        font-weight: 400;
        font-size: 15px;
        line-height: 22px;
        text-align: center;
        width: 100%;
        color: #ffffff;
    }
    .no-invi-content > a {
        font-size: 15px;
        line-height: 22px;
        padding: 11px 39px;
        margin: auto;
        margin-top: 15px;
    }
}
@media screen and (max-width: 567px) {
    /* .no-invi-content {
        padding-top: 0px;
    } */
}
</style>
<style>
body {
    background: #ffffff !important;
}
#app {
    background: #ffffff !important;
}
</style>
