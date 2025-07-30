<template>
    <div id="app">
        <div class="vendor-multi-calander-cont">
            <div class="vendor-calander-cont">
                <Calendar
                    is-expanded
                    :attributes="attrs"
                    :masks="{ title: 'MMMM YYYY', weekdays: 'WWW' }"
                    title-position="left"
                >
                    <template #header-title="{ monthLabel, year }">
                        <div class="v-calander-custom-title">
                            <span>{{ monthLabel }}</span
                            ><span>{{ year }}</span>
                        </div>
                    </template>
                    <template #day-popover="{ dayTitle, attributes }">
                        <div
                            class="text-xs text-gray-300 font-semibold text-center"
                        >
                            {{ dayTitle }}
                        </div>
                        <div v-for="(item, index) in attributes" :key="index">
                            <div
                                v-for="(item, index) in item.customData.title"
                                :key="index"
                            >
                                <div>
                                    {{ item }}
                                </div>
                            </div>
                        </div>
                    </template>
                </Calendar>
                <div class="events-list-cont">
                    <div
                        v-for="(item, index) in weeklyEventsList"
                        :key="index"
                        class="single-event-list-item"
                    >
                        <div class="single-event-list-head">
                            <div>
                                <span
                                    style="color: #c4456f"
                                    v-if="item.checkToday"
                                    >TODAY</span
                                >
                                <span v-else-if="item.checkTommorrow"
                                    >TOMMORROW</span
                                >
                                <span v-else>{{
                                    weekDays[
                                        new Date(item.startDate).getDay()
                                    ].toUpperCase()
                                }}</span>
                                <span>{{ item.startDate }}</span>
                            </div>
                            <div>
                                <span>26 &deg</span>
                                <span
                                    ><img src="\assets\vendors\sun.svg" alt=""
                                /></span>
                            </div>
                        </div>
                        <div v-for="(ele, index) in item.title" :key="index">
                            <div class="single-event-list-timings">
                                <span></span>
                                <span
                                    >{{ tConvert(item.startTime[index]) }} –
                                    {{ tConvert(item.endTime[index]) }}</span
                                >
                                <span>
                                    <img
                                        src="\assets\vendors\vidcam.svg"
                                        alt=""
                                    />
                                </span>
                            </div>
                            <div class="single-event-list-title">
                                {{ ele }}
                            </div>
                        </div>
                    </div>
                </div>
                <div @click.stop="openForm" class="vendor-add-new-event-btn">
                    Add New Event
                </div>
            </div>
            <FullCalendar
                class="calandar"
                ref="fullCalendar"
                :options="calendarOptions"
            />
        </div>
        <div class="ven-calander-ovrlay">
            <div @click.stop class="m-auto vendor-add-new-event-form">
                <h1>
                    <span>Add To-Do</span>
                    <i
                        @click="closeForm"
                        style="color: #afafaf; font-size: 25px; cursor: pointer"
                        class="fas fa-times-circle"
                    ></i>
                </h1>
                <form @submit.prevent="sendEventData" action="" class="">
                    <label for="eventTitle">
                        <input
                            type="text"
                            name="eventTitle"
                            id="eventTitle"
                            placeholder="Title"
                            required
                        />
                    </label>
                    <div class="ven-event-time-details">
                        <label for="eventStartDateTime">
                            <input
                                type="text"
                                name="eventStartDateTime"
                                id="eventStartDateTime"
                                placeholder="Start Date"
                                @focus="changeType($event)"
                                required
                            />
                        </label>
                        <label for="eventEndDateTime">
                            <input
                                type="text"
                                name="eventEndDateTime"
                                id="eventEndDateTime"
                                placeholder="End Date"
                                @focus="changeType($event)"
                                required
                            />
                        </label>
                    </div>
                    <button>Save Event</button>
                </form>
            </div>
        </div>
        <div class="ven-calander-ovrlay-evt">
            <div class="m-auto ven-event-click-disp">
                <div class="ven-event-click-disp-cont">
                    <div>
                        TO-DO LIST-
                        <span></span>
                        <i @click="closeDisp" class="fas fa-times-circle"></i>
                    </div>
                    <div class="ven-event-click-disp-data"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import "@fullcalendar/core/vdom"; // solves problem with Vite
import FullCalendar from "@fullcalendar/vue";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import interactionPlugin from "@fullcalendar/interaction";
import Calendar from "v-calendar/lib/components/calendar.umd";
import DatePicker from "v-calendar/lib/components/date-picker.umd";
export default {
    name: "App",
    components: {
        FullCalendar,
        Calendar,
        DatePicker, // make the <FullCalendar> tag available
    },
    data() {
        return {
            calendarOptions: {
                plugins: [dayGridPlugin, interactionPlugin, timeGridPlugin],
                businessHours: [
                    // specify an array instead
                    {
                        daysOfWeek: [1, 2, 3, 4, 5], // Monday, Tuesday, Wednesday
                        startTime: "08:00", // 8am
                        endTime: "18:00", // 6pm
                    },
                ],
                allDaySlot: false,
                dayHeaderClassNames: "dayheader",
                slotDuration: "00:60:00",
                slotMinTime: "07:00:00",
                slotMaxTime: "19:00:00",
                initialView: "timeGridWeek",
                dateClick: function (addInfo) {
                    console.log(addInfo);
                },
                eventMaxStack: 2,
                dayMaxEventRows: 3,
                //eventAdd: this.styling(),
                //viewDidMount: this.styling(),
                headerToolbar: {
                    left: "dayGridMonth,timeGridWeek,timeGridDay",
                    center: "title",
                    right: "today prev,next",
                },
                buttonText: {
                    today: "Today",
                    month: "Month",
                    week: "Week",
                    day: "Day",
                    list: "List",
                },
                customButtons: {
                    // custom1: {
                    //     text: "custom!",
                    //     click: function () {
                    //         let calendarApi = this.$refs.fullCalendar.getApi();
                    //         calendarApi.prev();
                    //     },
                    // },
                },
                eventClick: function (info) {
                    let date = info.event._instance.range.start;
                    var options = {
                        weekday: "long",
                        year: "numeric",
                        month: "long",
                        day: "numeric",
                    };
                    date = date.toLocaleDateString("en-US", options);
                    let mainCont = document.querySelector(
                        ".ven-event-click-disp"
                    );
                    let cont = document.querySelector(
                        ".ven-event-click-disp-data"
                    );
                    let dateCont =
                        cont.previousElementSibling.firstElementChild;
                    dateCont.innerHTML = date;
                    mainCont.style.display = "block";
                    document.querySelector(
                        ".ven-calander-ovrlay-evt"
                    ).style.display = "block";
                    cont.innerHTML = " ";
                    //console.log(info.el);
                    let clone = info.el.cloneNode(true);
                    // let div = document.createElement("div");
                    // div.innerHTML = date;
                    // cont.appendChild(div);
                    cont.appendChild(clone);
                },
                events: [
                    {
                        title: "Meeting with Alok sharma",
                        start: "2022-02-28T12:00:00",
                        end: "2022-02-28T12:30:00",
                        className: "fullCalanderEvents",
                    },
                    {
                        title: "Meeting with Aishwarya",
                        start: "2022-02-28T12:00:00",
                        end: "2022-02-28T12:30:00",
                        className: "fullCalanderEvents",
                    },
                    {
                        title: "Meeting with Aishwarya",
                        start: "2022-02-28T12:00:00",
                        end: "2022-02-28T12:30:00",
                        className: "fullCalanderEvents",
                    },
                    {
                        title: "Meeting with Aishwarya",
                        start: "2022-02-28T12:30:00",
                        end: "2022-02-28T13:00:00",
                        className: "fullCalanderEvents",
                    },
                    {
                        title: "Meeting with Alia",
                        start: "2022-03-01T12:00:00",
                        end: "2022-03-01T12:30:00",
                        className: "fullCalanderEvents",
                    },
                    {
                        title: "Meeting with Vidhant Gautam",
                        start: "2022-03-02T15:00:00",
                        end: "2022-03-02T16:30:00",
                        className: "fullCalanderEvents",
                    },
                    {
                        title: "Meeting with Aman Sharma",
                        start: "2022-03-02T12:00:00",
                        end: "2022-03-02T12:30:00",
                        className: "fullCalanderEvents",
                    },
                    {
                        title: "Meeting with Siddhant",
                        start: "2022-03-03T12:00:00",
                        end: "2022-03-03T12:30:00",
                        className: "fullCalanderEvents",
                    },
                    {
                        title: "Meeting with Rajesh",
                        start: "2022-03-04T16:00:00",
                        end: "2022-03-04T16:30:00",
                        className: "fullCalanderEvents",
                    },
                    {
                        title: "Meeting with Rajesh",
                        start: "2022-03-05T10:00:00",
                        end: "2022-03-05T11:30:00",
                        className: "fullCalanderEvents",
                    },
                    {
                        title: "Meeting with Alok sharma",
                        start: "2022-03-07T12:00:00",
                        end: "2022-03-07T12:30:00",
                        className: "fullCalanderEvents",
                    },
                    {
                        title: "Meeting with Aishwarya",
                        start: "2022-03-07T12:00:00",
                        end: "2022-03-07T12:30:00",
                        className: "fullCalanderEvents",
                    },
                    {
                        title: "Meeting with Aishwarya",
                        start: "2022-03-07T12:00:00",
                        end: "2022-03-07T12:30:00",
                        className: "fullCalanderEvents",
                    },
                    {
                        title: "Meeting with Aishwarya",
                        start: "2022-03-07T12:30:00",
                        end: "2022-03-07T13:00:00",
                        className: "fullCalanderEvents",
                    },
                    {
                        title: "Meeting with Alia",
                        start: "2022-03-08T12:00:00",
                        end: "2022-03-08T12:30:00",
                        className: "fullCalanderEvents",
                    },
                    {
                        title: "Meeting with Vidhant Gautam",
                        start: "2022-03-09T15:00:00",
                        end: "2022-03-09T16:30:00",
                        className: "fullCalanderEvents",
                    },
                    {
                        title: "Meeting with Aman Sharma",
                        start: "2022-03-09T12:00:00",
                        end: "2022-03-09T12:30:00",
                        className: "fullCalanderEvents",
                    },
                    {
                        title: "Meeting with Siddhant",
                        start: "2022-03-10T12:00:00",
                        end: "2022-03-10T12:30:00",
                        className: "fullCalanderEvents",
                    },
                    {
                        title: "Meeting with Rajesh",
                        start: "2022-03-11T16:00:00",
                        end: "2022-03-11T16:30:00",
                        className: "fullCalanderEvents",
                    },
                    {
                        title: "Meeting with Rajesh",
                        start: "2022-03-12T10:00:00",
                        end: "2022-03-12T11:30:00",
                        className: "fullCalanderEvents",
                    },
                ],
                views: {
                    dayGridMonth: {
                        // name of view
                        titleFormat: { year: "numeric", month: "long" },
                        showNonCurrentDates: false,
                        fixedWeekCount: false,
                        dayHeaderFormat: { weekday: "short" },
                        // other view-specific options here
                    },
                    timeGridWeek: {
                        // name of view
                        titleFormat: {
                            year: "numeric",
                            month: "short",
                            day: "numeric",
                        },
                        dayHeaderFormat: {
                            weekday: "short",
                            day: "numeric",
                            omitCommas: true,
                        },
                        dayHeaderContent: function (arg) {
                            let headerContent = arg.text.split(" ");
                            let dayHeaderCont = document.createElement("div");
                            let week = document.createElement("div");
                            week.innerHTML = headerContent[1];
                            let day = document.createElement("div");
                            day.innerHTML = headerContent[0];
                            dayHeaderCont.appendChild(week);
                            dayHeaderCont.appendChild(day);
                            dayHeaderCont.classList.add("dayHeaderCont");
                            let arrayOfDomNodes = [dayHeaderCont];
                            return { domNodes: arrayOfDomNodes };
                        },
                        eventTimeFormat: {
                            hour: "numeric",
                            minute: "2-digit",
                            meridiem: "short",
                        },
                        // other view-specific options here
                    },
                    timeGridDay: {
                        // name of view
                        titleFormat: {
                            year: "numeric",
                            month: "long",
                            day: "numeric",
                        },
                        dayHeaderFormat: { weekday: "long" },
                        // other view-specific options here
                    },
                },
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
            // todos: [
            //     {
            //         description: "Meeting with Alok sharma",

            //         dates: new Date("2022-02-28"),
            //     },
            //     {
            //         description: "Meeting with Aishwarya",

            //         dates: new Date("2022-02-28"),
            //     },
            //     {
            //         description: "Meeting with Aishwarya",

            //         dates: new Date("2022-02-28"),
            //     },
            //     {
            //         description: "Meeting with Alia",

            //         dates: "2022-03-01",
            //     },
            //     {
            //         description: "Meeting with Vidhant Gautam",

            //         dates: new Date("2022-03-02"),
            //     },
            //     {
            //         description: "Meeting with Aman Sharma",

            //         dates: new Date("2022-03-02"),
            //     },

            //     {
            //         description: "Meeting with Rajesh",

            //         dates: new Date("2022-03-03"),
            //     },
            //     {
            //         description: "Meeting with Siddhant",

            //         dates: new Date("2022-03-04"),
            //     },
            //     {
            //         description: "Meeting with Rajesh",

            //         dates: new Date("2022-03-05"),
            //     },
            // ],
            AllEvents: [
                {
                    title: ["Meeting with Alok sharma", "Take Payment"],
                    startDate: "2022-02-28",
                    startTime: ["12:00:00", "14:00:00"],
                    endDate: ["2022-02-28"],
                    endTime: ["12:30:00", "15:00:00"],
                },
                {
                    title: ["Meeting with Alia"],
                    startDate: "2022-03-01",
                    startTime: ["12:00:00"],
                    endDate: ["2022-03-01"],
                    endTime: ["12:30:00"],
                },
                {
                    title: ["Meeting with Vidhant Gautam"],
                    startDate: "2022-03-02",
                    startTime: ["15:00:00"],
                    endDate: ["2022-03-02"],
                    endTime: ["16:30:00"],
                },
                {
                    title: [
                        "Meeting with Siddhant",
                        "Meeting with Vidhant Gautam",
                    ],
                    startDate: "2022-03-03",
                    startTime: ["12:00:00", "13:00:00"],
                    endDate: ["2022-03-03"],
                    endTime: ["12:30:00", "14:00:00"],
                },
                {
                    title: ["Meeting with Rajesh"],
                    startDate: "2022-03-04",
                    startTime: ["16:00:00"],
                    endDate: ["2022-03-04"],
                    endTime: ["16:30:00"],
                },
                {
                    title: ["Meeting with Rajesh"],
                    startDate: "2022-03-05",
                    startTime: ["10:00:00"],
                    endDate: ["2022-03-05"],
                    endTime: ["11:30:00"],
                },
                {
                    title: ["Meeting with Alok sharma", "Take Payment"],
                    startDate: "2022-03-07",
                    startTime: ["12:00:00", "14:00:00"],
                    endDate: ["2022-03-07"],
                    endTime: ["12:30:00", "15:00:00"],
                },
                {
                    title: ["Meeting with Alia"],
                    startDate: "2022-03-08",
                    startTime: ["12:00:00"],
                    endDate: ["2022-03-08"],
                    endTime: ["12:30:00"],
                },
                {
                    title: ["Meeting with Vidhant Gautam"],
                    startDate: "2022-03-09",
                    startTime: ["15:00:00"],
                    endDate: ["2022-03-09"],
                    endTime: ["16:30:00"],
                },
                {
                    title: [
                        "Meeting with Siddhant",
                        "Meeting with Vidhant Gautam",
                    ],
                    startDate: "2022-03-10",
                    startTime: ["12:00:00", "13:00:00"],
                    endDate: ["2022-03-10"],
                    endTime: ["12:30:00", "14:00:00"],
                },
                {
                    title: ["Meeting with Rajesh"],
                    startDate: "2022-03-11",
                    startTime: ["16:00:00"],
                    endDate: ["2022-03-11"],
                    endTime: ["16:30:00"],
                },
                {
                    title: ["Meeting with Rajesh"],
                    startDate: "2022-03-12",
                    startTime: ["10:00:00"],
                    endDate: ["2022-03-12"],
                    endTime: ["11:30:00"],
                },
            ],

            weeklyEventsList: [],
        };
    },
    methods: {
        // handleDateClick: function (arg) {
        //     console.log(arg);
        // },
        tConvert(time) {
            // Check correct time format and split into components
            let str = time.substring(0, time.length - 3);
            time = str
                .toString()
                .match(/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [time];

            if (time.length > 1) {
                // If time format correct
                time = time.slice(1); // Remove full string match value
                time[5] = +time[0] < 12 ? " AM" : " PM"; // Set AM/PM
                time[0] = +time[0] % 12 || 12; // Adjust hours
            }
            return time.join(""); // return adjusted time or original string
        },
        closeDisp() {
            document.querySelector(".ven-event-click-disp").style.display = "";
            $(".ven-calander-ovrlay-evt").css("display", "");
        },
        clicked() {
            let clicked = document.querySelectorAll(".calandar button");
            let _this = this;
            clicked.forEach(function (item) {
                item.addEventListener("click", function () {
                    _this.styling();
                });
            });
        },
        styling() {
            function getColor() {
                const colors = [
                    "rgba(139, 92, 246, 0.1)",
                    "rgba(14, 165, 233, 0.1)",
                    "rgba(16, 185, 129, 0.1)",
                    "rgba(244,63,94, 0.1)",
                    "rgba(245, 158, 11, 0.1)",
                ];
                let num = Math.floor(Math.random() * colors.length);
                return colors[num];
            }

            let eventCont = document.querySelectorAll(".fullCalanderEvents");
            eventCont.forEach(function (item) {
                let back = getColor();
                let clr = back.substring(0, back.length - 4);
                let opacity = "1)";
                let color = clr.concat(opacity);
                item.style.backgroundColor = back;
                item.style.color = color;
                item.style.borderLeft = `thick solid ${color}`;
            });

            let eventListDot = document.querySelectorAll(
                ".single-event-list-timings > span:nth-child(1)"
            );
            eventListDot.forEach(function (item) {
                let listDotClr = getColor();
                let clr = listDotClr.substring(0, listDotClr.length - 4);
                let opacity = "1)";
                let color = clr.concat(opacity);
                item.style.backgroundColor = color;
            });
        },
        // dayclicked(day) {
        //     console.log(this.AllEvents[0].startDate);
        //     this.date.id = day.id;
        //     this.date.day = day.day;
        //     this.date.month = day.month - 1;
        //     this.date.year = day.year;
        //     this.date.week = day.weekday - 1;
        //     this.date.name =
        //         this.weekDays[day.weekday - 1] +
        //         " " +
        //         this.date.day +
        //         ", " +
        //         this.months[day.month - 1] +
        //         " " +
        //         this.date.year;
        // },
        openForm(e) {
            e.stopPropagation();
            $(".vendor-add-new-event-form").toggle();
            $(".ven-calander-ovrlay").toggle();
        },
        closeForm(e) {
            e.stopPropagation();
            $(".vendor-add-new-event-form").css("display", "");
            $(".ven-calander-ovrlay").css("display", "");
            document.querySelector(".vendor-add-new-event-form form").reset();
        },
        sendEventData(e) {
            let eventTitle = e.target.elements.eventTitle.value;
            let eventStart = e.target.elements.eventStartDateTime.value;
            let eventEnd = e.target.elements.eventEndDateTime.value;
            this.setEvents(eventTitle, eventStart, eventEnd);
            this.closeForm(e);
        },
        setEvents(name, start, end) {
            let eventStartDate = start.substring(0, start.indexOf("T"));
            let eventStartTime = start.substring(
                start.indexOf("T") + 1,
                start.length
            );
            let eventEndDate = end.substring(0, end.indexOf("T"));
            let eventEndTime = end.substring(end.indexOf("T") + 1, end.length);
            let today = new Date().toISOString();
            // let tomorrow = new Date();
            // tomorrow.setDate(tomorrow.getDate() + 1);
            // tomorrow = tomorrow.toISOString();
            // let checkToday = null;
            // let checkTommorow = null;
            // if (eventStartDate === today.substring(0, today.indexOf("T"))) {
            //     checkToday = true;
            // }
            // if (
            //     eventStartDate === tomorrow.substring(0, tomorrow.indexOf("T"))
            // ) {
            //     checkTommorow = true;
            // }

            let exists = this.AllEvents.findIndex(function (item, index) {
                if ('"' + item.startDate + '"' === '"' + eventStartDate + '"') {
                    return index + 1;
                }
            });

            if (exists === -1) {
                this.AllEvents.push({
                    title: [name],
                    startDate: eventStartDate,
                    endDate: [eventEndDate],
                    startTime: [eventStartTime],
                    endTime: [eventEndTime],
                });
            } else {
                this.AllEvents[exists].title.push(name);
                this.AllEvents[exists].endDate.push(eventEndDate);
                this.AllEvents[exists].startTime.push(eventStartTime);
                this.AllEvents[exists].endTime.push(eventEndTime);
            }
            this.calendarOptions.events.push({
                title: name,
                start: start,
                end: end,
                className: "fullCalanderEvents",
            });
        },
        setWeekEventsAsc() {
            let date = new Date();
            let week = [];
            for (let i = 0; i < 7; i++) {
                let curr = date;
                let today = null;
                let tommorrow = null;
                let dayAfterToday = new Date();
                dayAfterToday.setDate(dayAfterToday.getDate() + 1);
                dayAfterToday = dayAfterToday.toISOString();
                let dayToday = new Date();
                dayToday = dayToday.toISOString();
                curr = curr.toISOString();
                curr = curr.substring(0, curr.indexOf("T"));
                if (
                    "'" + curr + "'" ==
                    "'" +
                        dayAfterToday.substring(0, dayAfterToday.indexOf("T")) +
                        "'"
                ) {
                    tommorrow = true;
                }
                if (
                    "'" + curr + "'" ==
                    "'" + dayToday.substring(0, dayToday.indexOf("T")) + "'"
                ) {
                    today = true;
                }

                let exists = this.AllEvents.findIndex(function (item, index) {
                    if ('"' + item.startDate + '"' === '"' + curr + '"') {
                        return index + 1;
                    }
                });
                if (exists === -1) {
                    week.push({
                        title: [],
                        startDate: curr,
                        startTime: [],
                        endDate: [],
                        endTime: [],
                        checkToday: today,
                        checkTommorrow: tommorrow,
                    });
                } else {
                    let toPush = this.AllEvents[exists];
                    toPush.checkToday = today;
                    toPush.checkTommorrow = tommorrow;
                    week.push(toPush);
                    //console.log(this.AllEvents[exists]);
                }
                date.setDate(date.getDate() + 1);
            }
            this.weeklyEventsList = week;
            // get current week according to the date provided
            // for (let i = 0; i < 7; i++) {
            //     let first = curr.getDate() - curr.getDay() + i;
            //     let day = new Date(curr.setDate(first))
            //         .toISOString()
            //         .slice(0, 10);
            //     week.push(day);
            // }
        },
        changeType(e) {
            e.target.type = "datetime-local";
        },
    },
    mounted() {
        this.setWeekEventsAsc();
        this.clicked();
        this.styling();
    },
    updated: function () {
        this.$nextTick(function () {
            this.styling();
        });
    },
    created: function () {
        window.addEventListener("click", this.closeForm);
    },
    computed: {
        attrs() {
            return [
                // Attributes for todos
                ...this.AllEvents.map((todo) => ({
                    dates: todo.startDate,
                    dot: true,
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
                            backgroundColor: "#9B3154",
                        },
                        contentStyle: {
                            color: "#FFFFFF",
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
};
</script>

<style scoped>
/* events list css start */
.events-list-cont {
    padding: 10px;
    margin-top: 1em;
}
.single-event-list-head {
    display: flex;
    justify-content: space-between;
    margin-bottom: 3px;
    margin-top: 10px;
}
.single-event-list-head > div:nth-child(1) > span:nth-child(1) {
    font-family: Inter;
    font-style: normal;
    font-weight: bold;
    font-size: 13px;
    line-height: 20px;
    color: #959595;
    margin-right: 5px;
}
.single-event-list-head > div:nth-child(1) > span:nth-child(2) {
    font-family: Inter;
    font-style: normal;
    font-weight: normal;
    font-size: 13px;
    line-height: 20px;
    color: #c4456f;
}
.single-event-list-head > div:nth-child(2) > span:nth-child(1) {
    font-family: Inter;
    font-style: normal;
    font-weight: 900;
    font-size: 13px;
    line-height: 20px;
    color: #959595;
    margin-right: 5px;
}
.single-event-list-timings > span:nth-child(1) {
    background: #c4456f;
    display: inline-block;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    margin-right: 5px;
}
.single-event-list-timings > span:nth-child(2) {
    font-family: Inter;
    font-style: normal;
    font-weight: 600;
    font-size: 11px;
    line-height: 16px;
    color: #a1a1aa;
    margin-right: 5px;
}
.single-event-list-timings > span:nth-child(3) > img {
    width: 14px;
    height: 14px;
}
.single-event-list-title {
    font-family: Inter;
    font-style: normal;
    font-weight: 500;
    font-size: 12px;
    line-height: 16px;
    color: #a7a7a7;
    margin-left: 22px;
}
.vendor-add-new-event-btn {
    background: #461952;
    border-radius: 10.1379px;
    padding: 10px 15px;
    width: max-content;
    font-family: Roboto;
    font-style: normal;
    font-weight: normal;
    font-size: 13.5172px;
    line-height: 16px;
    color: #ffffff;
    margin-left: auto;
    margin-right: 12px;
    cursor: pointer;
}
.vendor-add-new-event-form {
    width: max-content;
    display: none;
    background: white;
    border-radius: 15px;
    position: absolute;
    z-index: 99999;
    top: 35%;
    left: 35%;
}
.vendor-add-new-event-form > h1 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 600;
    font-size: 15.8559px;
    line-height: 24px;
    color: #333333;
    display: flex;
    justify-content: space-between;
    padding: 15px 22px;
    border-bottom: 0.5px solid #c9c9c9;
}
.vendor-add-new-event-form form {
    padding: 15px 22px;
}
.vendor-add-new-event-form form input {
    border: 0.2px solid #959595;
    box-sizing: border-box;
    border-radius: 10px;
    padding: 10px 15px;
    background-color: white !important;
}
.vendor-add-new-event-form form input::placeholder {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 12.652px;
    line-height: 19px;

    color: #8b8b8b;
}
.vendor-add-new-event-form > div:nth-child(1) {
    padding: 5em;
}
.vendor-add-new-event-form form > label:nth-child(1) {
    display: flex;
    flex-direction: column;
}
.ven-event-time-details {
    width: 100%;
}
.ven-event-time-details label > input {
    width: 100% !important;
    padding: 10px 15px !important;
}
.vendor-add-new-event-form button {
    background: #461952;
    outline: none;
    border: none;
    border-radius: 10.1379px;
    padding: 10px 15px;
    width: max-content;
    font-family: Roboto;
    font-style: normal;
    font-weight: normal;
    font-size: 13.5172px;
    line-height: 16px;
    color: #ffffff;
    margin-left: auto;
    margin-right: 12px;
    margin-top: 12px;
    cursor: pointer;
}
.ven-calander-ovrlay {
    z-index: 9999999;
    width: 100%;
    height: 100vh;
    position: fixed;
    display: none;
    top: 0;
    left: 0;
    background: rgba(0, 0, 0, 0.7);
}
.ven-calander-ovrlay-evt {
    z-index: 9999999;
    width: 100%;
    height: 100vh;
    position: fixed;
    display: none;
    top: 0;
    left: 0;
    background: rgba(0, 0, 0, 0.7);
}

.ven-event-click-disp {
    width: 600px;
    border-radius: 15px;
    position: relative;
    background-color: white;
    position: absolute;
    z-index: 99999;
    display: none;
    top: 50%;
    left: 39%;
}

.ven-event-click-disp-cont > div:nth-child(1) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 600;
    font-size: 15.8559px;
    line-height: 24px;
    /* identical to box height */
    color: #333333;
    padding: 10px 20px;
    border-bottom: 0.5px solid #c9c9c9;
}
.ven-event-click-disp-cont > div:nth-child(1) > i {
    position: absolute;
    top: 5px;
    right: 10px;
    color: #afafaf;
    font-size: 25px;
    cursor: pointer;
}
.ven-event-click-disp-data {
    padding: 10px 20px;
}
.ven-event-click-disp-data > .fullCalanderEvents {
    width: 100% !important;
    padding: 10px;
    display: block;
}
.ven-event-click-disp-data .fc-event-title {
    white-space: normal !important;
}
.ven-event-click-disp-data > div:nth-child(1) {
    font-family: Inter;
    font-style: normal;
    font-weight: 500;
    font-size: 30px;
    line-height: 40px;
    color: #c4456f;
}

.ven-event-click-disp-data .fc-v-event {
    background-color: rgba(70, 25, 82, 0.2);
    margin-bottom: 3px;
    padding: 5px;
    color: #000000;
}
/* events list css end */

.vendor-multi-calander-cont {
    display: grid;
    width: 100% !important;
    max-width: 100% !important;
    grid-template-columns: 25% 75%;
    justify-content: space-around;
    margin: auto;
}
.vendor-multi-calander-cont > div:nth-child(1) {
    background-color: rgba(255, 255, 255, 0.6);
}
.vendor-calander-cont > div:nth-child(1) {
    background-color: transparent;
    border: none;
}
.v-calander-custom-title > span:nth-child(1) {
    font-family: Inter;
    font-style: normal;
    font-weight: 700;
    font-size: 30px;
    line-height: 40px;
    color: #868686;
    margin-right: 5px;
}
.v-calander-custom-title > span:nth-child(2) {
    font-family: Inter;
    font-style: normal;
    font-weight: normal;
    font-size: 30px;
    line-height: 40px;
    color: #c4456f;
}
.is-today .vc-dots {
    display: none;
}
.vc-dots {
    width: 30px;
    justify-content: space-around !important;
}
.vc-dots > span {
    display: none;
}
.vc-dots > span:nth-child(1) {
    display: block;
    margin-right: 0 !important;
    background-color: #9b3154 !important;
}
.vc-dots > span:nth-child(2) {
    display: block;
    margin-right: 0 !important;
    background-color: #c3456f !important;
}
.vc-dots > span:nth-child(3) {
    display: block;
    margin-right: 0 !important;
    background-color: #461952 !important;
}
.calandar {
    padding: 1em;
}
.fc-view-harness {
    background-color: white;
}
.calandar a {
    text-decoration: none;
    color: #000000;
}
.fc-timegrid-slots tr {
    height: 5em;
}
.fc-dayGridMonth-button,
.fc-timeGridWeek-button,
.fc-timeGridDay-button {
    background-color: #461952 !important;
    margin-right: 10px !important;
    border-radius: 0.25em !important;
}
.fc-today-button,
.fc-prev-button,
.fc-next-button {
    background-color: #461952 !important;
    border-radius: 0.25em !important;
    border: none !important;
}
.fc-day-today {
    background-color: #eff6ff !important;
}
.fc-prev-button {
    margin-right: 5px !important;
}
/* .dayheader > div:nth-child(1) {
    background-color: white;
} */
.fc-daygrid-day-frame {
    height: 1px;
}
.fc-timeGridWeek-view .fc-scrollgrid-sync-inner {
    text-align: left;
}
.dayHeaderCont > div:nth-child(1) {
    font-family: Inter;
    font-style: normal;
    font-weight: bold;
    font-size: 10px;
    line-height: 12px;
    display: flex;
    align-items: center;
    color: #71717a;
    text-decoration-line: none;
}
.dayHeaderCont > div:nth-child(2) {
    font-family: Inter;
    font-style: normal;
    font-weight: 500;
    font-size: 22px;
    line-height: 32px;
    display: flex;
    align-items: center;

    color: #000000;
    margin-bottom: 12px;
}
.weekDaysTimeGrid {
    text-align: left;
}
.fc-timegrid-axis {
    background-color: #efdee4ff;
    border: 0 !important;
}
.fc-scrollgrid-shrink,
.fc-scrollgrid {
    border: 0 !important;
    vertical-align: top !important;
}
.fc-scrollgrid-shrink-cushion {
    font-family: Inter;
    font-style: normal;
    font-weight: 500;
    font-size: 12px;
    line-height: 16px;
    display: flex;
    align-items: center;
    color: #71717a;
    margin-right: 7px;
}
.fc-timegrid-col-events {
    margin: 0 !important;
}
.fc-event-main {
    color: inherit !important;
}
.fullCalanderEvents {
    border: none;
    box-shadow: none !important;
    width: 100% !important;
}

.fullCalanderEvents .fc-event-time {
    font-family: Inter;
    font-style: normal;
    font-weight: 500;
    font-size: 12px;
    line-height: 16px;
    display: flex;
    align-items: center;
}
.fullCalanderEvents .fc-event-title {
    font-family: Inter;
    font-style: normal;
    font-weight: 600;
    font-size: 12px;
    line-height: 16px;
    display: flex;
    width: 90%;
    align-items: center;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.fc-timegrid-event-harness-inset {
    background-color: white !important;
}
.fc-popover .fc-v-event {
    background-color: rgba(70, 25, 82, 0.2) !important;
    margin-bottom: 3px;
    padding: 5px;
}

/* V-calander -small css */

.vendor-calander-cont {
    display: flex;
    margin-bottom: 2em;
    flex-direction: column;
}
/* Scrollbar Css Start */
/* .fc-scroller {
    overflow: auto !important;
} */
.fc-scroller::-webkit-scrollbar {
    background-color: #f9ecf0;
    width: 7px;
}
.fc-scroller::-webkit-scrollbar-track {
    background-color: #ffffff;
}
.fc-scroller::-webkit-scrollbar-track:hover {
    background-color: #f4f4f4;
}
.fc-scroller::-webkit-scrollbar-thumb {
    background-color: #babac0;
    border-radius: 16px;
    border: 1px solid #f9ecf0;
}
.fc-scroller::-webkit-scrollbar-thumb:hover {
    background-color: #a0a0a5;
    border: 4px solid #f4f4f4;
}
</style>
