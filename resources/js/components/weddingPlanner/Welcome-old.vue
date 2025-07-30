<template>
    <section>
        <div class="welcome">Hello, Viddhant Gautam</div>
        <div class="main-cont">
            <div class="orders">
                <div class="orders-head">
                    <img
                        src="\assets\vendors\dashboard\clarity_shopping_cart_line.svg"
                        alt=""
                        style="margin-right: 5px"
                    />
                    Recent orders
                </div>
                <div class="orders-content">
                    <div class="order-list">
                        <div
                            class="d-flex justify-content-between py-2 px-1"
                            :style="item.style"
                            v-for="(item, index) in orders"
                            :key="index"
                        >
                            <span>{{ item.status }}</span>
                            <span>{{ item.value }}</span>
                        </div>
                    </div>
                    <div class="order-percent">
                        <!-- <CircleProgress
                        :percent="60"
                        :fill-color="`#A6D997`"
                        :empty-color="`#DFEEDB`"
                        :size="160"
                        :viewport="true"
                        :show-percent="true"
                        style="align-self: center"
                    /> -->
                    </div>
                </div>
                <div class="upcoming-orders-cont">
                    <div
                        class="splide"
                        id="order-splide"
                        style="padding-bottom: 10px"
                    >
                        <div class="splide__track">
                            <ul class="splide__list">
                                <li
                                    class="splide__slide"
                                    style="
                                        border: none;
                                        align-self: end;
                                        cursor: default;
                                    "
                                    v-for="(item, index) in upcomingOrders"
                                    :key="index"
                                >
                                    <div
                                        class="new-order"
                                        v-if="item.seen == 0"
                                    >
                                        New
                                    </div>
                                    <div class="upcoming-orders">
                                        <div class="upcoming-order-content">
                                            <div>
                                                <div
                                                    class="upcoming-order-name"
                                                >
                                                    {{ item.name }}
                                                </div>
                                                <div
                                                    class="upcoming-order-info"
                                                >
                                                    {{ item.location }}
                                                </div>
                                                <div
                                                    class="upcoming-order-info"
                                                >
                                                    {{ item.date }}
                                                </div>
                                            </div>
                                            <div>
                                                <button class="custom-btn">
                                                    <img
                                                        src="/assets\vendors\dashboard\dashicons_arrow-right-alt2.svg"
                                                        alt=""
                                                    />
                                                </button>
                                                <div
                                                    class="upcoming-order-time"
                                                >
                                                    {{ item.time }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="upcoming-order-buttons">
                                            <div>
                                                To contact this customer accept
                                                the lead
                                            </div>
                                            <div>
                                                <button
                                                    class="custom-btn"
                                                    style="
                                                        background-color: #c4c4c4;
                                                    "
                                                >
                                                    Reject lead
                                                </button>
                                                <button
                                                    class="custom-btn"
                                                    style="
                                                        background-color: #138808;
                                                    "
                                                >
                                                    Accept lead
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="transaction-history-cont">
                        <div class="transaction-history-head">
                            Transaction history
                        </div>
                        <div class="transaction-history-content">
                            <div class="d-flex">
                                <h3 style="width: 40%">Reciever</h3>
                                <h3 style="width: 20%">Type</h3>
                                <h3 style="width: 20%">Date</h3>
                                <h3 style="width: 20%; text-align: right">
                                    Amount
                                </h3>
                            </div>
                            <div>
                                <div
                                    class="d-flex mt-2"
                                    v-for="(item, index) in transactionHistory"
                                    :key="index"
                                >
                                    <div
                                        class="transaction-history-name"
                                        style="width: 40%"
                                    >
                                        <div>
                                            <span
                                                ><img
                                                    src="\assets\vendors\dashboard\Group-132.svg"
                                                    alt=""
                                                    style="
                                                        margin-left: 7px;
                                                        margin-top: -3px;
                                                    "
                                            /></span>
                                            <span>{{ item.name }}</span>
                                        </div>
                                    </div>
                                    <div
                                        class="transaction-history-type"
                                        style="width: 20%"
                                    >
                                        <div>{{ item.type }}</div>
                                    </div>
                                    <div
                                        class="transaction-history-date"
                                        style="width: 20%"
                                    >
                                        <div>{{ item.date }}</div>
                                    </div>
                                    <div
                                        class="transaction-history-amount"
                                        style="width: 20%"
                                    >
                                        <div>{{ item.amount }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="today-schedule-cont">
                    <h3>Today’s schedule</h3>
                    <div class="splide" id="schedule-splide">
                        <div class="splide__track">
                            <ul class="splide__list">
                                <li
                                    class="splide__slide"
                                    style="border: none; cursor: default"
                                    v-for="(item, index) in todaySchedule"
                                    :key="index"
                                >
                                    <div>
                                        <div class="schedule-info">
                                            <div class="d-flex">
                                                <div>
                                                    <img
                                                        src="\assets\vendors\dashboard\el_phone-alt.svg"
                                                        alt=""
                                                    />
                                                </div>
                                                <div class="schedule-details">
                                                    <div>
                                                        {{ item.name }}
                                                    </div>
                                                    <div>Meeting</div>
                                                    <div>
                                                        call time
                                                        {{ item.time }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <button class="custom-btn">
                                                    <img
                                                        src="\assets\vendors\dashboard\dashicons_arrow-right-dark.svg"
                                                        alt=""
                                                    />
                                                </button>
                                                <div
                                                    class="upcoming-order-time"
                                                    style="color: black"
                                                >
                                                    {{ item.ago }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="schedule-buttons">
                                            <div>
                                                <p>{{ item.location }}</p>
                                                <p>{{ item.date }}</p>
                                            </div>
                                            <div
                                                class="d-flex justify-content-between mt-2"
                                            >
                                                <button class="custom-btn">
                                                    Set next call time
                                                </button>
                                                <button class="custom-btn">
                                                    Update status
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div style="margin-top: 2em; text-align: center">
                    <Calendar
                        :attributes="attr"
                        :masks="{ title: 'MMMM' }"
                        @dayclick="clicked"
                    >
                        <template #day-popover="{ dayTitle, attributes }">
                            <div
                                class="text-xs text-gray-300 font-semibold text-center"
                            >
                                {{ dayTitle }}
                            </div>
                            <div
                                v-for="{ key, customData } in attributes"
                                :key="key"
                            >
                                <div
                                    v-for="(
                                        items, index
                                    ) in customData.description"
                                    :key="index"
                                >
                                    <div>
                                        {{ items }}
                                    </div>
                                </div>
                            </div>
                        </template>
                    </Calendar>
                </div>
            </div>
            <div>
                <div class="review-container">
                    <div class="review-head">
                        <img
                            src="\assets\vendors\dashboard\carbon_star_review.svg"
                            alt=""
                            style="margin-right: 5px"
                        />
                        Reviews
                    </div>
                    <div class="review-content">
                        <div v-for="(item, index) in reviews" :key="index">
                            <div class="review-details">
                                <div>
                                    <img
                                        src="\assets\vendors\dashboard\Ellipse-80.png"
                                        alt=""
                                    />
                                </div>
                                <div>
                                    <div>{{ item.name }}</div>
                                    <div>
                                        <img
                                            src="\assets\vendors\dashboard\Group-585.svg"
                                            alt=""
                                        />
                                    </div>
                                    <div>{{ item.date }}</div>
                                    <div>
                                        {{ item.message }}
                                    </div>
                                </div>
                            </div>
                            <div class="review-buttons">
                                <button class="custom-btn">
                                    <span>
                                        <img
                                            src="\assets\vendors\dashboard\entypo_reply.svg"
                                            alt=""
                                        />
                                        Reply
                                    </span>
                                </button>
                                <button class="custom-btn">
                                    <img
                                        src="\assets\vendors\dashboard\bi_pin_angle_fill.svg"
                                        alt=""
                                    />
                                    Pin
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
// import CircleProgress from "vue3-circle-progress";
// import "vue3-circle-progress/dist/circle-progress.css";
//
// import "@splidejs/splide/dist/css/splide.min.css";
import Calendar from "v-calendar/lib/components/calendar.umd";
import DatePicker from "v-calendar/lib/components/date-picker.umd";

export default {
    components: {
        // CircleProgress: CircleProgress,
        Calendar,
        DatePicker,
        // Splide
    },

    data() {
        return {
            todos: [
                {
                    description: ["Meet Aman", "Meet Viddhant"],
                    isComplete: false,
                    dates: new Date(2022, 0, 10),
                },
                {
                    description: [
                        "Meet groom family and discuss about budget.",
                    ],
                    isComplete: false,
                    dates: new Date(2022, 0, 13),
                },
                {
                    description: [
                        "Book band banja and venue for the marrriage of aman and Ishika.",
                    ],
                    isComplete: false,
                    dates: new Date(2022, 0, 19),
                },
            ],
            date: new Date(),

            orders: [
                {
                    status: "Total",
                    value: 4,
                    style: "font-weight: bold; color:#FF0000",
                },
                { status: "Completed", value: 4, style: "color:#138808" },
                { status: "Pending", value: 4, style: "color:#7D4D8A" },
                { status: "Processing", value: 4, style: "color:#3299D2" },
                { status: "Cancelled", value: 4, style: "color:#FF0000" },
                { status: "Refunded", value: 4, style: "color:#DAB227" },
            ],
            upcomingOrders: [
                {
                    seen: 0,
                    id: 1,
                    name: "Viddhant Gautam",
                    location: "Chandigarh",
                    date: "17-Feb-2021",
                    time: "4 hour ago",
                },
                {
                    seen: 0,
                    id: 2,
                    name: "Rajesh Sharma",
                    location: "Mohali",
                    date: "20-Oct-2021",
                    time: "7 hour ago",
                },
                {
                    seen: 1,
                    id: 1,
                    name: "Siddhant Gautam",
                    location: "Shimla",
                    date: "20-Jun-2021",
                    time: "half hour ago",
                },
                {
                    seen: 1,
                    id: 1,
                    name: "Anu Sharma",
                    location: "Panchkula",
                    date: "22-Jan-2021",
                    time: "two hour ago",
                },
                {
                    seen: 1,
                    id: 1,
                    name: "Viddhant Gautam",
                    location: "Chandigarh",
                    date: "20-Mar-2021",
                    time: "an hour ago",
                },
            ],
            transactionHistory: [
                {
                    id: 1,
                    name: "Tesco Market",
                    type: "",
                    date: "13 Dec 2020",
                    amount: "Rs.5000",
                },
                {
                    id: 1,
                    name: "ElectroMen Market",
                    type: "",
                    date: "18 Dec 2020",
                    amount: "Rs.50000",
                },
                {
                    id: 1,
                    name: "Fiorgio Restaurant",
                    type: "",
                    date: "1 Nov 2020",
                    amount: "Rs.60000",
                },
                {
                    id: 1,
                    name: "John Mathew Kayne",
                    type: "",
                    date: "17 Oct 2020",
                    amount: "Rs.100000",
                },
                {
                    id: 1,
                    name: "Ann Marlin",
                    type: "",
                    date: "12 Oct 2020",
                    amount: "Rs.20000",
                },
            ],
            todaySchedule: [
                {
                    id: 1,
                    name: "Aman",
                    time: "3:30 pm",
                    location: "Chennai",
                    date: "20-Mar-2021",
                    ago: "an hour ago",
                },
                {
                    id: 2,
                    name: "Anu",
                    time: "8:30 pm",
                    location: "Banglore",
                    date: "27-Mar-2021",
                    ago: "5 hour ago",
                },
                {
                    id: 3,
                    name: "Varun",
                    time: "1:20 pm",
                    location: "Delhi",
                    date: "20-Jan-2021",
                    ago: "one day ago",
                },
            ],
            reviews: [
                {
                    id: 1,
                    name: "Sharmila apte",
                    date: "Mar5, 2020",
                    message:
                        "Thank You   :-)))) You were so quick in taking decisions , we love that about you ...our checklist bride :-))) See you soon ",
                },
                {
                    id: 2,
                    name: "Aman Sharma",
                    date: "Mar10, 2020",
                    message:
                        "Thank You   :-)))) You were so quick in taking decisions , we love that about you ...our checklist bride :-))) See you soon ",
                },
                {
                    id: 3,
                    name: "Rahul",
                    date: "Jan2, 2020",
                    message:
                        "Thank You   :-)))) You were so quick in taking decisions , we love that about you ...our checklist bride :-))) See you soon ",
                },
                {
                    id: 4,
                    name: "Karan",
                    date: "Oct10, 2020",
                    message:
                        "Thank You   :-)))) You were so quick in taking decisions , we love that about you ...our checklist bride :-))) See you soon ",
                },
                {
                    id: 5,
                    name: "Salaman",
                    date: "Mar19, 2020",
                    message:
                        "Thank You   :-)))) You were so quick in taking decisions , we love that about you ...our checklist bride :-))) See you soon ",
                },
                {
                    id: 6,
                    name: "Umar",
                    date: "Feb2, 2020",
                    message:
                        "Thank You   :-)))) You were so quick in taking decisions , we love that about you ...our checklist bride :-))) See you soon ",
                },
                {
                    id: 7,
                    name: "Nishant",
                    date: "Dec10, 2020",
                    message:
                        "Thank You   :-)))) You were so quick in taking decisions , we love that about you ...our checklist bride :-))) See you soon ",
                },
            ],
        };
    },
    methods: {},
    computed: {
        attr() {
            return [
                // Attributes for todos
                ...this.todos.map((todo) => ({
                    dates: todo.dates,
                    highlight: {
                        style: {
                            backgroundColor: "#461952",
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
                {
                    key: "today",
                    highlight: {
                        style: {
                            backgroundColor: "#EB5757",
                        },
                    },
                    dates: new Date(),
                },
            ];
        },
    },
};
document.addEventListener("DOMContentLoaded", function () {
    new Splide("#order-splide", {
        type: "slide",
        perPage: 2,
        perMove: 0,
        arrows: false,
        gap: "10px",
        isNavigation: true,
        fixedWidth: "45%",
        breakpoints: {
            768: {
                fixedWidth: "80%",
            },
        },
    }).mount();
    new Splide("#schedule-splide", {
        type: "slide",
        direction: "ttb",
        height: "210px",
        autoHeight: true,
        arrows: false,
        gap: "10px",
        isNavigation: true,
    }).mount();
});
</script>

<style>
/* Bride Dashboard css starts
   **********      WELCOME PAGE     **********
*/
/* Section 1 Welcome  starts*/
.welcome {
    font-family: Questrial;
    font-style: normal;
    font-weight: normal;
    font-size: 22px;
    line-height: 23px;
    color: #000000;
    margin-bottom: 2em;
}
/* Section 1 Welcome  ends*/
.main-cont {
    width: 100%;
    display: grid;
    grid-template-columns: 43% 26% 28%;
    row-gap: 2em;
    justify-content: space-between;
}
/* Section 2 Orders  starts*/
.orders-head {
    font-family: Roboto;
    font-style: normal;
    font-weight: normal;
    font-size: 15.1385px;
    line-height: 18px;
    color: #ffffff;
    padding: 5px 10px;
    background: #000000;
    border-radius: 12.4756px 12.4756px 0px 0px;
}
.orders-content {
    background: #ffffff;
    box-shadow: 0px 0px 3.93823px 3.74267px rgba(0, 0, 0, 0.25);
    border-bottom-left-radius: 12.4756px;
    border-bottom-right-radius: 12.4756px;
    display: flex;
    flex-direction: row;
    padding-bottom: 10px;
}
.order-list {
    font-family: Roboto;
    font-style: normal;
    font-weight: normal;
    font-size: 15.1385px;
    line-height: 18px;
    color: black;
    width: 60%;
}
.order-percent {
    width: 40%;
    display: flex;
    justify-content: center;
}
/* Section 2 Orders  ends*/

/* Section 3 upcoming-orders  starts*/
.new-order {
    font-family: Roboto;
    font-style: normal;
    font-weight: 500;
    font-size: 20px;
    line-height: 23px;
    background: #7f004b;
    border-radius: 15px 15px 0px 0px;
    color: #ffffff;
    width: 130px;
    padding: 10px 43px;
    margin-top: 2em;
}
.upcoming-orders {
    background-color: #461952;
}
.upcoming-order-content {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    border-bottom: 0.5px solid #a7a3a3;
    padding: 1em;
}
.upcoming-order-info {
    font-family: Roboto;
    font-style: normal;
    font-weight: 300;
    font-size: 12px;
    line-height: 14px;
    color: #ffffff;
    margin-bottom: 0.5em;
}
.upcoming-order-name {
    font-family: Roboto;
    font-style: normal;
    font-weight: 500;
    font-size: 16px;
    line-height: 19px;
    color: #ffffff;
    margin-bottom: 0.5em;
}
.upcoming-order-time {
    font-family: Roboto;
    font-style: normal;
    font-weight: normal;
    font-size: 5px;
    line-height: 6px;
    color: #ffffff;
}
.custom-btn {
    outline: none;
    border: 0;
    background-color: inherit;
}
.upcoming-order-buttons {
    padding: 1em;
}
.upcoming-order-buttons > div:nth-child(1) {
    font-family: Roboto;
    font-style: normal;
    font-weight: 300;
    font-size: 8px;
    line-height: 9px;
    color: #565252;
}
.upcoming-order-buttons > div:nth-child(2) {
    display: flex;
    justify-content: space-between;
}
.upcoming-order-buttons button {
    font-family: Roboto;
    font-style: normal;
    font-weight: normal;
    font-size: 8px;
    line-height: 9px;
    color: #ffffff;
    border-radius: 6px;
    padding: 10px 20px;
    width: 90px;
}
/* Section 3 upcoming-orders  end*/

/* Section 4 transaction-history  start*/
.transaction-history-cont {
    background: #ffffff;
    box-shadow: 0px 16px 24px rgba(0, 0, 0, 0.06),
        0px 2px 6px rgba(0, 0, 0, 0.04), 0px 0px 1px rgba(0, 0, 0, 0.04);
    border-radius: 19.0044px;
    margin-top: 2em;
    padding: 5px 15px;
}
.transaction-history-head {
    font-family: Suprema;
    font-style: normal;
    font-weight: 600;
    font-size: 20.1118px;
    line-height: 25px;
    color: #404040;
    padding: 10px 0;
}
.transaction-history-content {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}
.transaction-history-content > div:nth-child(2) > div {
    border-bottom: 0.5px solid #ececec;
}
.transaction-history-cont h3 {
    font-family: Suprema;
    font-style: normal;
    font-weight: normal;
    font-size: 14px;
    line-height: 17px;
    color: #aeaeae;
}
.transaction-history-name > div > span:nth-child(1) {
    background: #efefef;
    border-radius: 6.00032px;
    display: inline-block;
    width: 24px;
    height: 24px;
    margin-right: 10px;
}
.transaction-history-name > div > span:nth-child(2) {
    font-family: Suprema;
    font-style: normal;
    font-weight: normal;
    font-size: 14px;
    line-height: 17px;
    color: #404040;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    width: 80%;
    display: inline-block;
}
.transaction-history-date > div {
    font-family: Suprema;
    font-style: normal;
    font-weight: normal;
    font-size: 14px;
    line-height: 17px;
    color: #c7c7c7;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    margin-bottom: 14px;
}
.transaction-history-amount > div {
    font-family: Lato;
    font-style: normal;
    font-weight: bold;
    font-size: 14px;
    line-height: 17px;
    text-align: right;
    color: #404040;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    margin-bottom: 14px;
}
/* Section 4 transaction-history  end*/

/* Section 5 schedule  start*/

.today-schedule-cont {
    background: #461952;
    padding: 15px 10px 0;
}
.today-schedule-cont > h3 {
    font-family: Roboto;
    font-style: normal;
    font-weight: 500;
    font-size: 12.1345px;
    line-height: 14px;
    color: #ffffff;
    margin-bottom: 10px;
}
.schedule-info {
    background-color: #ffffff;
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    border-bottom: 0.5px solid #a7a3a3;
    padding: 7px 15px 4px;
}
.schedule-details {
    margin-left: 7px;
}
.schedule-details > div:nth-child(1) {
    font-family: Roboto;
    font-style: normal;
    font-weight: 500;
    font-size: 12px;
    line-height: 14px;
    color: #000000;
    margin-bottom: 7px;
}
.schedule-details > div:nth-child(2) {
    font-family: Roboto;
    font-style: normal;
    font-weight: 300;
    font-size: 8px;
    line-height: 9px;
    color: #dab227;
}
.schedule-details > div:nth-child(3) {
    font-family: Roboto;
    font-style: normal;
    font-weight: 300;
    font-size: 8px;
    line-height: 9px;
    color: #000000;
}
.schedule-buttons {
    padding: 15px 19px;
    background-color: #ffffff;
}
.schedule-buttons p {
    font-family: Roboto;
    font-style: normal;
    font-weight: normal;
    font-size: 8px;
    line-height: 9px;
    color: #000000;
    margin-bottom: 0 !important;
}
.schedule-buttons button {
    font-family: Roboto;
    font-style: normal;
    font-weight: normal;
    font-size: 8px;
    line-height: 9px;
    color: #000000;
    border-radius: 6px;
    padding: 10px 20px;
    background-color: #c4c4c4;
    width: 100px;
}
/* Section 5 schedule  end*/

/* Section 6 review  start*/

.review-head {
    font-family: Lato;
    font-style: normal;
    font-weight: bold;
    font-size: 14px;
    line-height: 17px;
    color: #ffffff;
    padding: 5px 10px;
    background: #000000;
    border-radius: 12.4756px 12.4756px 0px 0px;
}
.review-content {
    background: linear-gradient(180deg, #ffffff 0%, rgba(255, 255, 255, 0) 100%),
        linear-gradient(180deg, #ffffff 0%, rgba(255, 255, 255, 0) 100%),
        #ffffff;
    border-radius: 10px;
    height: 70vh;
    overflow-y: scroll;
    scrollbar-width: thin;
}
.review-content::-webkit-scrollbar {
    background-color: #fff;
    width: 16px;
}
.review-content::-webkit-scrollbar-track {
    background-color: #fff;
}
.review-content::-webkit-scrollbar-track:hover {
    background-color: #f4f4f4;
}
.review-content::-webkit-scrollbar-thumb {
    background-color: #babac0;
    border-radius: 16px;
    border: 5px solid #fff;
}
.review-content::-webkit-scrollbar-thumb:hover {
    background-color: #a0a0a5;
    border: 4px solid #f4f4f4;
}
.review-details {
    display: flex;
    flex-direction: row;
    padding: 10px 15px;
}
.review-details > div:nth-child(1) {
    margin-right: 10px;
}
.review-details > div:nth-child(2) > div:nth-child(1) {
    font-family: Lato;
    font-style: normal;
    font-weight: normal;
    font-size: 14px;
    line-height: 17px;
    color: #000000;
}
.review-details > div:nth-child(2) > div:nth-child(3) {
    font-family: Lato;
    font-style: normal;
    font-weight: 300;
    font-size: 5px;
    line-height: 6px;
    color: #000000;
}
.review-details > div:nth-child(2) > div:nth-child(4) {
    font-family: Lato;
    font-style: normal;
    font-weight: 300;
    font-size: 8px;
    line-height: 10px;
    color: #000000;
}
.review-buttons {
    display: flex;
}
.review-buttons > button {
    width: 50%;
    border: 0.5px solid #000000;
}
@media only screen and (max-width: 992px) {
    .main-cont {
        grid-template-columns: 100%;
    }
}

/* Section 6 review  start*/
</style>
