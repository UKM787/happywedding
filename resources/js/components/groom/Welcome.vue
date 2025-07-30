<template>
    <div class="wed-host-section">
        <div class="wed-host-section-container">
            <div class="bride-welcome-main-cont">
                <div class="bride-count-cont">
                    <div class="bride-count-name">
                        <div class="wed-host-section-container-title">
                            <span>Sandee p</span>
                            <span>&</span>
                            <span>Lakshmi</span>
                        </div>
                    </div>
                    <div class="bride-count-loc">
                        <img src="\assets\bride\l-bird.png" alt="" />
                        <div class="line"></div>
                        <div class="bride-count-loc-info">
                            DECEMBER 22, 2021 HAYATT REGENCY, CHENNAI
                        </div>
                        <div class="line"></div>
                        <img src="\assets\bride\r-bird.png" alt="" />
                    </div>
                    <div class="bride-count-timer">
                        <div class="bride-count-timer-single">
                            <span>7</span>
                            <span>Days</span>
                        </div>
                        <div class="bride-count-timer-single">
                            <span>70</span>
                            <span>Hours</span>
                        </div>
                        <div class="bride-count-timer-single">
                            <span>42</span>
                            <span>Minutes</span>
                        </div>
                        <div class="bride-count-timer-single">
                            <span>13</span>
                            <span>Seconds</span>
                        </div>
                    </div>
                </div>
                <div class="bride-main-cont">
                    <div>
                        <div style="position: relative">
                            <div class="back-blur">
                                <img
                                    src="\assets\bride\the_wedding_conteurs3.jpg"
                                    alt=""
                                />
                                <div class="over-lay"></div>
                            </div>
                            <div class="bride-today-schedule">
                                <div>Today’s schedule</div>
                                <div class="bride-today-list-cont">
                                    <div
                                        v-for="(item, index) in todaySchedule"
                                        :key="index"
                                        class="bride-today-single"
                                    >
                                        <div>{{ item.name }}</div>
                                        <div>
                                            <i class="far fa-calendar-alt"></i>
                                            {{ item.time }}
                                        </div>
                                        <div>
                                            <i
                                                class="fas fa-map-marker-alt"
                                            ></i>
                                            {{ item.location }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bride-groom-img">
                            <img
                                src="\assets\bride\the_wedding_conteurs3.jpg"
                                alt=""
                            />
                        </div>
                    </div>
                    <div>
                        <div class="bride-calander-cont">
                            <div>
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
                            </div>
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
                                    <button @click="showForm">
                                        Add Schedule
                                    </button>
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
                                                >
                                                    {{ item }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="splide" id="finalvendors">
                            <div class="splide__track">
                                <ul class="splide__list">
                                    <li
                                        v-for="(item, index) in finalizedVendor"
                                        :key="index"
                                        class="splide__slide"
                                        style="cursor: default"
                                    >
                                        <div class="final-vendor-single">
                                            <div
                                                class="final-vendor-single-head"
                                            >
                                                <img
                                                    src="\assets\bride\the_wedding_conteurs3.jpg"
                                                    alt=""
                                                />
                                                <div>
                                                    <span>{{ item.type }}</span>
                                                    <span
                                                        ><i
                                                            v-for="index in item.rating"
                                                            :key="index"
                                                            class="fas fa-star"
                                                            style="
                                                                color: #fed21e;
                                                            "
                                                        ></i
                                                    ></span>
                                                </div>
                                            </div>
                                            <div
                                                class="final-vendor-single-content"
                                            >
                                                <div>{{ item.name }}</div>
                                                <div>
                                                    <i
                                                        class="fas fa-map-marker-alt"
                                                    ></i
                                                    >{{ item.location }}
                                                </div>
                                                <div
                                                    class="final-vendor-single-details"
                                                >
                                                    <div>
                                                        <span>{{
                                                            item.date
                                                        }}</span>
                                                        <i
                                                            class="far fa-calendar-check"
                                                        ></i>
                                                    </div>
                                                    <div>
                                                        <span>{{
                                                            item.time
                                                        }}</span>
                                                        <i
                                                            class="far fa-clock"
                                                        ></i>
                                                    </div>
                                                    <div>
                                                        <span>{{
                                                            item.loc
                                                        }}</span>
                                                        <i
                                                            class="fas fa-map-marker-alt"
                                                        ></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="d-flex justify-content-end"
                                            >
                                                <button
                                                    class="final-vendor-single-view"
                                                >
                                                    View
                                                </button>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="bride-notifi-head">Notifications</div>
                        <div class="bride-notifi-content-cont">
                            <div
                                v-for="(item, index) in brideNotifications"
                                :key="index"
                                class="bride-notifi-single"
                            >
                                <img
                                    src="\assets\bride\the_wedding_conteurs3.jpg"
                                    alt=""
                                />
                                <div>{{ item.info }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
//
//import "@splidejs/splide/dist/css/splide.min.css";
import Calendar from "v-calendar/lib/components/calendar.umd";
import DatePicker from "v-calendar/lib/components/date-picker.umd";

export default {
    components: {
        Calendar,
        DatePicker,
    },

    data() {
        return {
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
            todaySchedule: [
                {
                    id: 1,
                    name: "MEET WEDDING PLANNER",
                    time: "12:00pm - 5:00pm",
                    location: "Lacabana",
                },
                {
                    id: 2,
                    name: "MEET MAKE UP ARTIST",
                    time: "12:00pm - 5:00pm",
                    location: "Lacabana",
                },
                {
                    id: 3,
                    name: "MEET WEDDING SINGER",
                    time: "12:00pm - 5:00pm",
                    location: "Lacabana",
                },
                {
                    id: 4,
                    name: "MEET WEDDING PLANNER",
                    time: "12:00pm - 5:00pm",
                    location: "Lacabana",
                },
            ],
            finalizedVendor: [
                {
                    id: 1,
                    type: "Makeup Artist",
                    name: "Aisha Makeover and studio",
                    location: "Aisha Makeover and studio",
                    date: "28/10/2021",
                    time: "09:00 AM",
                    loc: "Hayatt Regen",
                    rating: 5,
                },
                {
                    id: 2,
                    type: "Mehndi Artist",
                    name: "Nisha Makeover and studio",
                    location: "Aisha Makeover and studio",
                    date: "28/10/2021",
                    time: "09:00 AM",
                    loc: "Hotel Taj",
                    rating: 3,
                },
                {
                    id: 3,
                    type: "Mehndi Artist",
                    name: "Nisha Makeover and studio",
                    location: "Aisha Makeover and studio",
                    date: "28/10/2021",
                    time: "09:00 AM",
                    loc: "Hotel Taj",
                    rating: 4,
                },
            ],
            brideNotifications: [
                { id: 1, info: "Checkout Mehendi artists around you" },
                { id: 2, info: "New Venues around you" },
                { id: 3, info: "Checkout Mehendi artists around you" },
                { id: 4, info: "New Venues around you" },
                { id: 5, info: "Checkout Mehendi artists around you" },
                { id: 6, info: "Checkout Mehendi artists around you" },
                { id: 7, info: "New Venues around you" },
                { id: 8, info: "Checkout Mehendi artists around you" },
                { id: 9, info: "Checkout Mehendi artists around you" },
                { id: 10, info: "New Venues around you" },
                { id: 11, info: "Checkout Mehendi artists around you" },
                { id: 12, info: "Checkout Mehendi artists around you" },
                { id: 13, info: "New Venues around you" },
            ],
            splider: null,
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
            this.splider = new Splide("#finalvendors", {
                type: "slide",
                perPage: 2,
                perMove: 0,
                arrows: false,
                gap: "10px",
                isNavigation: true,
                fixedWidth: "90%",
                breakpoints: {
                    768: {
                        arrows: true,
                        fixedWidth: "100%",
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
        this.$nextTick(function () {
            //const fixedDate = document.querySelector(".date-decided").innerHTML;
            const deadlineTimer = document.querySelectorAll(
                ".bride-count-timer-single span:nth-child(1)"
            );
            // var help = {{ \Carbon\Carbon::parse($invitation->savedate->startDate)->format('Y, m, d, H, i, s'); }};

            const futureDate = new Date(2022, 0, 29, 21, 21, 0);

            const futureTime = futureDate.getTime();

            function getRemainingTime() {
                var today = new Date().getTime();

                var totalRemainingMS = futureTime - today;
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
        });
    },
};
</script>

<style scoped>
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
/* bride notification css start */
.bride-welcome-main-cont {
    display: flex;
    flex-direction: column;
    height: 100%;
}
.bride-notifi-head {
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;
    background: #461952;
    text-align: center;
    font-family: Rosarivo;
    font-style: normal;
    font-weight: normal;
    font-size: 15px;
    line-height: 21px;
    color: #ffffff;
}
.bride-notifi-content-cont {
    background: #ffffff;
    padding: 15px;
    border-bottom-left-radius: 15px;
    border-bottom-right-radius: 15px;
    max-height: 70vh;
    overflow-y: auto;
    scrollbar-width: thin;
}
.bride-notifi-single {
    display: flex;
    margin-bottom: 10px;
}

.bride-notifi-single > img {
    width: 25px;
    height: 25px;
    margin-right: 10px;
    border-radius: 50%;
}
.bride-notifi-single > div {
    font-family: Roboto;
    font-style: normal;
    font-weight: normal;
    font-size: 11.6667px;
    line-height: 14px;
    color: #000000;
    padding-top: 5px;
}
/* final vendor css start */
.final-vendor-single {
    background: #ffffff;
    border-radius: 11.4511px;
    padding: 12px 19px;
}
.final-vendor-single-head {
    display: flex;
}
.final-vendor-single-head img {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    margin-right: 10px;
}
.final-vendor-single-head div {
    display: flex;
    justify-content: space-between;
    width: 100%;
    align-items: center;
}
.final-vendor-single-head span:nth-child(1) {
    font-family: Roboto;
    font-style: normal;
    font-weight: normal;
    font-size: 9.92747px;
    line-height: 12px;
    text-transform: capitalize;
    color: #4e4e4e;
}
.final-vendor-single-content > div:nth-child(1) {
    font-family: Roboto;
    font-style: normal;
    font-weight: 900;
    font-size: 18.2442px;
    line-height: 14px;
    color: #000000;
    margin: 10px 0;
}
.final-vendor-single-content > div:nth-child(2) {
    font-family: Roboto;
    font-style: normal;
    font-weight: normal;
    font-size: 10.36269px;
    line-height: 10px;
    color: #000000;
}
.final-vendor-single-details {
    display: flex;
    background: rgba(196, 69, 111, 0.1);
    border: 0.467672px solid rgba(196, 69, 111, 0.1);
    box-sizing: border-box;
    border-radius: 5.61206px;
    margin: 10px 0;
}
.final-vendor-single-details > div {
    font-family: Roboto;
    font-style: normal;
    font-weight: 900;
    font-size: 14.0581px;
    line-height: 12px;
    text-transform: capitalize;
    flex: 1;
    color: #c4456f;
    padding: 10px;
    display: flex;
    justify-content: space-between;
}
.final-vendor-single-view {
    background: #17a24e;
    border-radius: 4.16404px;
    font-family: Segoe UI;
    font-style: normal;
    font-weight: normal;
    font-size: 10.7388px;
    line-height: 14px;
    color: #ffffff;
    outline: 0;
    border: none;
    padding: 10px 15px;
    margin-left: auto;
    display: inline-block;
    text-align: right;
}
/* bride groom img css start */
.bride-groom-img {
    padding-top: 75%;
    filter: drop-shadow(0px 4px 4px rgba(0, 0, 0, 0.25));
    position: relative;
    margin-top: 2em;
}
.bride-groom-img > img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    object-fit: cover;
    height: 100%;
    border-radius: 20px;
}
/* today schedule css starts */
.back-blur {
    position: relative;
    padding-top: 100%;
    overflow: hidden;
    border-radius: 14.8558px;
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
.bride-today-schedule {
    z-index: 9999;
    position: absolute;
    top: 0;
    left: 0;
    padding: 10px;
    width: 100%;
    height: 100%;
}
.bride-today-schedule > div:nth-child(1) {
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
.bride-today-list-cont {
    overflow: auto;
    height: 80%;
    scrollbar-width: thin;
}
.bride-today-single {
    background: rgba(255, 255, 255, 0.4);
    padding: 10px;
    margin-bottom: 10px;
}
.bride-today-single > div {
    font-family: Arial;
    font-style: normal;
    font-weight: bold;
    font-size: 8.83237px;
    line-height: 10px;
    color: #ffffff;
    margin-bottom: 7px;
}
.bride-today-single > div:nth-child(1) {
    font-family: Sarala;
    font-style: normal;
    font-weight: bold;
    font-size: 12.8669px;
    line-height: 21px;
    text-transform: uppercase;
    color: #461952;
}

/* countdown css starts */
.bride-main-cont {
    display: grid;
    grid-template-columns: repeat(12, 1fr);
    row-gap: 2em;
    flex-grow: 1;
    margin-top: 2em;
}
.bride-main-cont > div:nth-child(1) {
    grid-column: 1/4;
}
.bride-main-cont > div:nth-child(2) {
    grid-column: 4/10;
    overflow: hidden;
}
.bride-main-cont > div:nth-child(3) {
    grid-column: 10/13;
}
.bride-main-cont > div {
    padding: 0 10px;
}
.bride-count-cont {
    margin-top: 3em;
    flex-grow: 1;
}
.bride-count-name {
    margin: auto;
    margin-bottom: 3em;
    width: max-content;
}
.bride-count-name > span {
    font-family: Rage Italic;
    font-style: italic;
    font-weight: normal;
    font-size: 47.605px;
    line-height: 60px;
    text-transform: capitalize;
    color: #461952;
}
.bride-count-name > span:nth-child(2) {
    font-family: STZhongsong;
    font-style: normal;
    font-weight: normal;
    font-size: 34.3274px;
    line-height: 45px;
    text-transform: uppercase;
    color: #461952;
    margin: 0 12px;
}
.bride-count-loc {
    display: flex;
    align-items: center;
    margin: auto;
    margin-bottom: 2em;
    width: max-content;
}
.line {
    border: 0.431919px solid #461952;
    width: 80px;
    margin: 0 5px;
}
.bride-count-loc-info {
    font-family: Segoe UI;
    font-style: normal;
    font-weight: bold;
    font-size: 13.0325px;
    line-height: 17px;
    text-transform: capitalize;
    color: #461952;
}
.bride-count-timer {
    display: flex;
    margin: auto;
    width: max-content;
    flex-wrap: wrap;
    width: 100%;
    justify-content: center;
}
.bride-count-timer-single {
    background: #c4456f;
    box-shadow: 0px 0px 3.42857px 0.857143px rgba(0, 0, 0, 0.25);
    border-radius: 85.7143px;
    margin: 0 5px;
    width: 120px;
    height: 120px;
    display: flex;
    flex-direction: column;
}
.bride-count-timer-single > span:nth-child(1) {
    font-family: Perpetua;
    font-style: normal;
    font-weight: normal;
    font-size: 70.4257px;
    line-height: 81px;
    text-align: center;
    color: #ffffff;
    margin-bottom: -14px;
    padding-top: 12px;
}
.bride-count-timer-single > span:nth-child(2) {
    font-family: Segoe UI;
    font-style: normal;
    font-weight: normal;
    font-size: 12.1758px;
    line-height: 16px;
    text-align: center;
    color: #ffffff;
}

/* scroobar css */
.bride-today-list-cont::-webkit-scrollbar {
    background-color: #fff;
    width: 7px;
}
.bride-today-list-cont::-webkit-scrollbar-track {
    background-color: #ebebf5;
}
.bride-today-list-cont::-webkit-scrollbar-track:hover {
    background-color: #f4f4f4;
}
.bride-today-list-cont::-webkit-scrollbar-thumb {
    background-color: #babac0;
    border-radius: 16px;
    border: 1px solid #fff;
}
.bride-notifi-content-cont::-webkit-scrollbar {
    background-color: #fff;
    width: 7px;
}
.bride-notifi-content-cont::-webkit-scrollbar-track {
    background-color: #ebebf5;
}
.bride-notifi-content-cont::-webkit-scrollbar-track:hover {
    background-color: #f4f4f4;
}
.bride-notifi-content-cont::-webkit-scrollbar-thumb {
    background-color: #babac0;
    border-radius: 16px;
    border: 1px solid #fff;
}
@media only screen and (max-width: 1200px) {
    .bride-today-list-cont {
        height: 60%;
    }
    .bride-main-cont > div:nth-child(1) {
        grid-column: 1/5;
    }
    .bride-main-cont > div:nth-child(2) {
        grid-column: 5/13;
    }
    .bride-main-cont > div:nth-child(3) {
        grid-column: 1/13;
    }
}
@media only screen and (max-width: 992px) {
    .main-cont {
        grid-template-columns: 100%;
    }
    .bride-main-cont > div:nth-child(1) {
        grid-column: 1/13;
    }
    .bride-main-cont > div:nth-child(2) {
        grid-column: 1/13;
    }
    .bride-main-cont > div:nth-child(3) {
        grid-column: 1/13;
    }
}
@media only screen and (max-width: 768px) {
    .bride-calander-cont {
        flex-wrap: wrap;
    }
    .line {
        width: 5px;
    }
    .bride-count-loc-info {
        font-size: 10px;
    }
}
</style>
