<template>
    <section>
        <div class="welcome">Hello, {{ vendorDetails.name }}</div>
        <div class="main-cont">
            <div>
                <div class="order-and-calander-cont">
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
                    </div>
                    <div class="bride-calander-cont">
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
                                            `'` + item.dates + `'` ===
                                            `'` +
                                                new Date(
                                                    date.year,
                                                    date.month,
                                                    date.day
                                                ) +
                                                `'`
                                        "
                                    >
                                        <div
                                            v-for="(
                                                item, index
                                            ) in item.description"
                                            :key="index"
                                        >
                                            {{ item }}
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </Calendar>
                        <div class="calander-add-schedule">
                            <div
                                v-if="date.name"
                                class="calander-add-schedule-date"
                            >
                                {{ date.name }}
                            </div>
                            <div v-else class="calander-add-schedule-date">
                                {{ current }}
                            </div>
                            <div class="calander-add-schedule-form">
                                <button @click="showForm">Add Schedule</button>
                                <form @submit.prevent="addTodo" action="">
                                    <input
                                        type="text"
                                        name=""
                                        id=""
                                        v-model="todoValue"
                                    />
                                    <button type="submit">Submit</button>
                                </form>
                                <div>
                                    <div
                                        v-for="(item, index) in todos"
                                        :key="index"
                                    >
                                        <div
                                            v-if="
                                                `'` + item.dates + `'` ===
                                                `'` +
                                                    new Date(
                                                        date.year,
                                                        date.month,
                                                        date.day
                                                    ) +
                                                    `'`
                                            "
                                        >
                                            <div
                                                v-for="(
                                                    item, index
                                                ) in item.description"
                                                :key="index"
                                                style="word-break: break-word"
                                            >
                                                {{ item }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="leads-and-schedule-cont">
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
                                        New Leads
                                    </div>
                                    <div class="new-leads">
                                        <div class="new-lead-content">
                                            <div>
                                                <img
                                                    src="\assets\vendors\dashboard\Ellipse-81.png"
                                                    alt=""
                                                />
                                                <div>
                                                    <div class="new-lead-name">
                                                        {{ item.name }}
                                                    </div>
                                                    <div class="new-lead-info">
                                                        {{ item.location }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div>
                                                <div class="new-lead-info">
                                                    {{ item.date }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="new-leads-single-details">
                                            <div>
                                                <span>{{ item.date }}</span>
                                                <i
                                                    class="far fa-calendar-check"
                                                ></i>
                                            </div>
                                            <div>
                                                <span>{{ item.time }}</span>
                                                <i class="far fa-clock"></i>
                                            </div>
                                            <div>
                                                <span>{{ item.loc }}</span>
                                                <i
                                                    class="fas fa-map-marker-alt"
                                                ></i>
                                            </div>
                                        </div>
                                        <div class="new-lead-buttons">
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
                    <div style="position: relative; margin-left: 10px">
                        <div class="back-blur">
                            <img
                                src="\assets\bride\the_wedding_conteurs3.jpg"
                                alt=""
                            />
                            <div class="over-lay"></div>
                        </div>
                        <div class="today-sched-schedule">
                            <div>Today’s schedule</div>
                            <div class="today-sched-list-cont">
                                <div
                                    v-for="(item, index) in todaySchedule"
                                    :key="index"
                                    class="today-sched-single"
                                >
                                    <div style="display: flex">
                                        <img
                                            src="\assets\vendors\dashboard\Ellipse-81.png"
                                            alt=""
                                        />
                                        <div>
                                            <div class="schedule-name">
                                                {{ item.name }}
                                            </div>
                                            <div class="schedule-info">
                                                {{ item.location }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="today-sched-single-details">
                                        <div>
                                            <span>{{ item.date }}</span>
                                            <i
                                                class="far fa-calendar-check"
                                            ></i>
                                        </div>
                                        <div>
                                            <span>{{ item.time }}</span>
                                            <i class="far fa-clock"></i>
                                        </div>
                                        <div>
                                            <span>{{ item.loc }}</span>
                                            <i
                                                class="fas fa-map-marker-alt"
                                            ></i>
                                        </div>
                                    </div>
                                    <div class="today-sched-btn">
                                        <button>Completed</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
    props: ["vendor"],
    components: {
        // CircleProgress: CircleProgress,
        Calendar,
        DatePicker,
        // Splide
    },

    data() {
        return {
            vendorDetails: JSON.parse(this.vendor),
            todoValue: "",
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
            todaySchedule: [
                {
                    id: 1,
                    name: "Viddhant Gautam",
                    location: "Chandigarh",
                    date: "17-Feb-2021",
                    time: "4 hour ago",
                    loc: "Egmore, Channai",
                },
                {
                    id: 2,
                    name: "Rajesh Sharma",
                    location: "Mohali",
                    date: "20-Oct-2021",
                    time: "7 hour ago",
                    loc: "Egmore, Channai",
                },
                {
                    id: 3,
                    name: "Siddhant Gautam",
                    location: "Shimla",
                    date: "20-Jun-2021",
                    time: "half hour ago",
                    loc: "Egmore, Channai",
                },
                {
                    id: 4,
                    name: "Anu Sharma",
                    location: "Panchkula",
                    date: "22-Jan-2021",
                    time: "two hour ago",
                    loc: "Egmore, Channai",
                },
            ],
            upcomingOrders: [
                {
                    seen: 0,
                    id: 1,
                    name: "Viddhant Gautam",
                    location: "Chandigarh",
                    date: "17-Feb-2021",
                    time: "4 hour ago",
                    loc: "Egmore, Channai",
                },
                {
                    seen: 0,
                    id: 2,
                    name: "Rajesh Sharma",
                    location: "Mohali",
                    date: "20-Oct-2021",
                    time: "7 hour ago",
                    loc: "Egmore, Channai",
                },
                {
                    seen: 1,
                    id: 3,
                    name: "Siddhant Gautam",
                    location: "Shimla",
                    date: "20-Jun-2021",
                    time: "half hour ago",
                    loc: "Egmore, Channai",
                },
                {
                    seen: 1,
                    id: 4,
                    name: "Anu Sharma",
                    location: "Panchkula",
                    date: "22-Jan-2021",
                    time: "two hour ago",
                    loc: "Egmore, Channai",
                },
                {
                    seen: 1,
                    id: 5,
                    name: "Viddhant Gautam",
                    location: "Chandigarh",
                    date: "20-Mar-2021",
                    time: "an hour ago",
                    loc: "Egmore, Channai",
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
            splide: null,
        };
    },
    methods: {
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
        addTodo() {
            let copy = Array.from(this.todos);
            let copyDate = new Date(
                this.date.year,
                this.date.month,
                this.date.day
            );
            let exists = copy.findIndex(function (item, index) {
                if ('"' + item.dates + '"' === '"' + copyDate + '"') {
                    return index + 1;
                }
            });

            if (exists === -1) {
                this.todos.push({
                    description: [this.todoValue],
                    isComplete: false,
                    dates: new Date(
                        this.date.year,
                        this.date.month,
                        this.date.day
                    ),
                });
            } else {
                console.log(this.todos[exists]);
                this.todos[exists].description.push(this.todoValue);
            }
            this.todoValue = "";
            $(".calander-add-schedule-form form").hide();
        },
        showForm() {
            $(".calander-add-schedule-form form").toggle();
        },
        setSplider() {
            this.splider = new Splide("#order-splide", {
                type: "slide",
                perPage: 2,
                perMove: 0,
                arrows: false,
                gap: "10px",
                isNavigation: true,
                pagination: false,

                fixedWidth: "80%",
                breakpoints: {
                    768: {
                        fixedWidth: "80%",
                    },
                },
            });
            this.splider.mount();
        },
    },
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
        current() {
            return (
                this.weekDays[this.date.week] +
                " " +
                this.date.day +
                ", " +
                this.months[this.date.month] +
                " " +
                this.date.year
            );
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

<style scoped>
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
    grid-template-columns: 70% 30%;
    row-gap: 2em;
    column-gap: 1em;
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

/* Calander css start */
.order-and-calander-cont {
    display: grid;
    grid-template-columns: 40% 60%;
    column-gap: 1em;
    overflow: hidden;
}
.calander-add-schedule-form > button {
    font-family: Roboto;
    font-style: normal;
    font-weight: normal;
    font-size: 10.9275px;
    line-height: 13px;
    color: #ffffff;
    background-color: #c4456f;
    box-shadow: 0px 0px 1px 1px rgba(0, 0, 0, 0.25);
    border-radius: 15.7895px;
    border: none;
    outline: 0;
    padding: 10px 15px;
    margin-bottom: 1em;
}
.calander-add-schedule-form > form {
    display: none;
}
.calander-add-schedule-form > form > input {
    background: #ffffff;
    border-radius: 11.9146px;
    margin-bottom: 7px;
    width: 100%;
}
.calander-add-schedule-form > form > button {
    font-family: Roboto;
    font-style: normal;
    font-weight: normal;
    font-size: 10.9275px;
    line-height: 13px;
    color: #ffffff;
    background-color: #c4456f;
    box-shadow: 0px 0px 1px 1px rgba(0, 0, 0, 0.25);
    border-radius: 15.7895px;
    border: none;
    outline: 0;
    padding: 10px 15px;
}
.calander-add-schedule-form > div {
    font-family: Segoe UI;
    font-style: normal;
    font-weight: bold;
    font-size: 13.0325px;
    line-height: 17px;
    text-transform: capitalize;
    color: #461952;
    margin-top: 1px;
    overflow-y: auto;
    height: 162px;
}
.calander-add-schedule-date {
    font-family: Segoe UI;
    font-style: normal;
    font-weight: 800;
    font-size: 13.821px;
    line-height: 17px;
    margin-bottom: 1em;
    display: flex;
    align-items: center;
    color: #000000;
}
.calander-add-schedule {
    background: rgba(255, 255, 255, 0.2);
    border-radius: 14.86px;
    width: 100%;
    padding: 1em;
}
.calander-add-schedule-form {
    height: 90%;
}
.bride-calander-cont {
    display: flex;
    margin-bottom: 2em;
    justify-content: space-around;
}

/* New Leads  */

.new-leads-single-details {
    display: flex;
    background: rgba(196, 69, 111, 0.1);
    border: 0.467672px solid rgba(196, 69, 111, 0.1);
    box-sizing: border-box;
    border-radius: 5.61206px;
    margin: 10px 0;
}
.new-leads-single-details > div {
    font-family: Roboto;
    font-style: normal;
    font-weight: 900;
    font-size: 12.0581px;
    line-height: 12px;
    text-transform: capitalize;
    flex: 1;
    color: #c4456f;
    padding: 10px;
    display: flex;
    justify-content: space-between;
}
.new-leads-single-details > div > span {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    width: 90%;
    display: inline-block;
}
.new-order {
    font-family: Roboto Slab;
    font-style: normal;
    font-weight: 500;
    font-size: 12.7352px;
    line-height: 17px;
    color: #ffffff;
    background: #461952;
    border-radius: 15.1678px 15.1678px 0px 0px;
    width: 130px;
    padding: 10px 20px;
    margin-top: 2em;
    text-align: center;
}
.new-leads {
    background: #ffffff;
    border-radius: 11.4511px;
}
.new-lead-content {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    border-bottom: 0.5px solid #a7a3a3;
    padding: 1em;
}
.new-lead-content > div:nth-child(1) {
    display: flex;
}
.new-lead-content > div:nth-child(1) > img {
    width: 38px;
    height: 38px;
    margin-right: 10px;
}
.new-lead-info {
    font-family: Roboto;
    font-style: normal;
    font-weight: 300;
    font-size: 12px;
    line-height: 14px;
    color: #000000;
    margin-bottom: 0.5em;
}
.new-lead-name {
    font-family: Roboto;
    font-style: normal;
    font-weight: 500;
    font-size: 16px;
    line-height: 19px;
    color: #000000;
    margin-bottom: 0.5em;
}
.new-lead-time {
    font-family: Roboto;
    font-style: normal;
    font-weight: normal;
    font-size: 5px;
    line-height: 6px;
    color: #000000;
}
.custom-btn {
    outline: none;
    border: 0;
    background-color: inherit;
}
.new-lead-buttons {
    padding: 0.5em 1em;
}
.new-lead-buttons > div:nth-child(1) {
    font-family: Roboto;
    font-style: normal;
    font-weight: 300;
    font-size: 10px;
    line-height: 9px;
    color: #565252;
    margin-bottom: 1em;
}
.new-lead-buttons > div:nth-child(2) {
    display: flex;
    justify-content: space-between;
}
.new-lead-buttons button {
    font-family: Roboto;
    font-style: normal;
    font-weight: normal;
    font-size: 12px;
    line-height: 9px;
    color: #ffffff;
    border-radius: 6px;
    padding: 10px 30px;
}

/* Todays Schedule css starts */
.leads-and-schedule-cont {
    display: grid;
    grid-template-columns: 60% 40%;
    overflow: hidden;
}
.back-blur {
    position: relative;
    padding-top: 100%;
    overflow: hidden;
    border-radius: 14.8558px;
    width: 100%;
}
.over-lay {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(131, 122, 122, 0.513);
    z-index: 2;
}
.back-blur > img {
    z-index: 1;
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    object-fit: cover;
    height: 100%;
    filter: blur(8px);
}
.today-sched-schedule {
    z-index: 9999;
    position: absolute;
    top: 0;
    left: 0;
    padding: 10px;
    width: 100%;
    height: 100%;
}
.today-sched-schedule > div:nth-child(1) {
    font-family: Rubik;
    font-style: normal;
    font-weight: 500;
    font-size: 19.0042px;
    line-height: 23px;
    text-transform: uppercase;
    color: #461952;
    text-align: center;
    margin-bottom: 10px;
}
.today-sched-list-cont {
    overflow-y: auto;
    height: 80%;
    scrollbar-width: thin;
}
.today-sched-single {
    background: rgba(255, 255, 255, 0.4);
    padding: 10px;
    margin-bottom: 10px;
}
.today-sched-single > div {
    display: flex;
}
.today-sched-single > div > img {
    width: 38px;
    height: 38px;
    margin-right: 10px;
}
.schedule-name {
    font-family: Sarala;
    font-style: normal;
    font-weight: bold;
    font-size: 13.347px;
    line-height: 22px;
    text-transform: uppercase;
    color: #461952;
}
.schedule-info {
    font-family: Roboto;
    font-style: normal;
    font-weight: normal;
    font-size: 8.36269px;
    line-height: 10px;
    color: #ffffff;
}
.today-sched-single-details {
    display: flex;
    background: rgba(255, 255, 255, 0.1);
    border: 0.349068px solid rgba(255, 255, 255, 0.1);
    box-sizing: border-box;
    border-radius: 4.18881px;
    margin: 10px 0;
}
.today-sched-single-details > div {
    font-family: Roboto;
    font-style: normal;
    font-weight: 500;
    font-size: 7.50731px;
    line-height: 9px;
    text-transform: capitalize;
    color: #ffffff;
    flex: 1;
    padding: 10px;
    display: flex;
    justify-content: space-between;
}
.today-sched-single-details > div > span {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    width: 90%;
    display: inline-block;
}
.today-sched-btn {
    display: flex;
    justify-content: flex-end;
}
.today-sched-btn > button {
    background: #138808;
    border-radius: 4.34843px;
    padding: 8px 18px;
    font-family: Roboto;
    font-style: normal;
    font-weight: 500;
    font-size: 5.79791px;
    line-height: 7px;
    color: #ffffff;
    outline: none;
    border: 0;
}

/* scroobar css */
.today-sched-list-cont::-webkit-scrollbar {
    background-color: #fff;
    width: 7px;
}
.today-sched-list-cont::-webkit-scrollbar-track {
    background-color: #ebebf5;
}
.today-sched-list-cont::-webkit-scrollbar-track:hover {
    background-color: #f4f4f4;
}
.today-sched-list-cont::-webkit-scrollbar-thumb {
    background-color: #babac0;
    border-radius: 16px;
    border: 1px solid #fff;
}

@media only screen and (max-width: 992px) {
    .main-cont {
        grid-template-columns: 100%;
    }
}
@media only screen and (max-width: 1200px) {
    .order-and-calander-cont {
        grid-template-columns: 100%;
        row-gap: 1.5em;
    }
    .leads-and-schedule-cont {
        grid-template-columns: 100%;
        row-gap: 1.5em;
    }
}

/* Section 6 review  start*/
</style>
