<template>
    <section>
        <div class="main-tab-cont container">
            <div
                @click="change($event)"
                class="main-tab-single active"
                data-id="bookings"
            >
                <div class="main-tab-head">
                    Bokkings
                    <img
                        src="\assets\vendors\leads\bx_bxs-book-heart.svg"
                        alt=""
                    />
                </div>
                <div class="main-tab-buttons">
                    <button class="main-tab-btn-1">
                        <span>3</span>
                        <span>New request</span>
                    </button>
                    <button class="main-tab-btn-2">
                        <span>42</span>
                        <span>Total request</span>
                    </button>
                </div>
            </div>
            <div
                @click="change($event)"
                class="main-tab-single"
                data-id="enquiries"
            >
                <div class="main-tab-head">
                    Enquiries
                    <img
                        src="\assets\vendors\leads\bx_bxs-book-heart.svg"
                        alt=""
                    />
                </div>
                <div class="main-tab-buttons">
                    <button class="main-tab-btn-1">
                        <span>3</span>
                        <span>New message</span>
                    </button>
                    <button class="main-tab-btn-2">
                        <span>42</span>
                        <span>Total request</span>
                    </button>
                </div>
            </div>
            <div
                @click="change($event)"
                class="main-tab-single"
                data-id="contact-clicks"
            >
                <div class="main-tab-head">
                    Contact clicks
                    <img
                        src="\assets\vendors\leads\bx_bxs-book-heart.svg"
                        alt=""
                    />
                </div>
                <div class="main-tab-buttons">
                    <button class="main-tab-btn-1">
                        <span>3</span>
                        <span>New clicks</span>
                    </button>
                    <button class="main-tab-btn-2">
                        <span>42</span>
                        <span>Total request</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="main-content-cont">
            <div class="content active" id="bookings">
                <div class="main-content-sidebar">
                    <div class="main-content-head">
                        <button
                            @click="change($event)"
                            data-id="new"
                            class="tab-btn active"
                        >
                            New
                        </button>
                        <button
                            @click="change($event)"
                            data-id="accepted"
                            class="tab-btn"
                        >
                            Accepted
                        </button>
                        <button
                            @click="change($event)"
                            data-id="pending"
                            class="tab-btn"
                        >
                            Pending
                        </button>
                    </div>
                    <div class="main-content-data">
                        <div id="new" class="content active">
                            <div
                                class="new-leads"
                                v-for="(item, index) in newBookings"
                                :key="index"
                                style="margin-bottom: 1em"
                            >
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
                                        <i class="far fa-calendar-check"></i>
                                    </div>
                                    <div>
                                        <span>{{ item.time }}</span>
                                        <i class="far fa-clock"></i>
                                    </div>
                                    <div>
                                        <span>{{ item.loc }}</span>
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                </div>
                                <div class="new-lead-buttons">
                                    <div>
                                        To contact this customer accept the lead
                                    </div>
                                    <div>
                                        <button
                                            class="custom-btn"
                                            style="background-color: #c4c4c4"
                                        >
                                            Reject lead
                                        </button>
                                        <button
                                            class="custom-btn"
                                            style="background-color: #138808"
                                        >
                                            Accept lead
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="accepted" class="content">
                            <div
                                class="new-leads"
                                v-for="(item, index) in acceptedBookings"
                                :key="index"
                                style="margin-bottom: 1em"
                            >
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
                                        <i class="far fa-calendar-check"></i>
                                    </div>
                                    <div>
                                        <span>{{ item.time }}</span>
                                        <i class="far fa-clock"></i>
                                    </div>
                                    <div>
                                        <span>{{ item.loc }}</span>
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                </div>
                                <div class="accepted-booking-buttons">
                                    <div>
                                        <button
                                            class="custom-btn"
                                            style="
                                                background-color: #9b3154;
                                                margin-right: 10px;
                                            "
                                        >
                                            <img
                                                src="\assets\vendors\leads\ic_outline-message.svg"
                                                alt=""
                                            />
                                        </button>
                                        <button
                                            class="custom-btn"
                                            style="background-color: #2fa706"
                                        >
                                            <img
                                                src="\assets\vendors\leads\carbon_phone-filled.svg"
                                                alt=""
                                            />
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="pending" class="content">
                            <div
                                class="new-leads"
                                v-for="(item, index) in pendingBookings"
                                :key="index"
                                style="margin-bottom: 1em"
                            >
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
                                        <i class="far fa-calendar-check"></i>
                                    </div>
                                    <div>
                                        <span>{{ item.time }}</span>
                                        <i class="far fa-clock"></i>
                                    </div>
                                    <div>
                                        <span>{{ item.loc }}</span>
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                </div>
                                <div class="new-lead-buttons">
                                    <div>
                                        To contact this customer accept the lead
                                    </div>
                                    <div>
                                        <button
                                            class="custom-btn"
                                            style="background-color: #c4c4c4"
                                        >
                                            Reject lead
                                        </button>
                                        <button
                                            class="custom-btn"
                                            style="background-color: #138808"
                                        >
                                            Accept lead
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="main-content-section">
                    <div class="booking-content">
                        <div class="booking-content-info">
                            <div class="mb-3">
                                <p>Sesh agarwal</p>
                                <p class="booking-content-info-content">
                                    Chennai
                                </p>
                                <p class="booking-content-info-content">
                                    20-Mar-2021
                                </p>
                            </div>
                            <div class="booking-content-info-head mb-4 mt-2">
                                SERVICE DETAILS (CATERING SERVICES)
                            </div>
                            <div>
                                <div>
                                    <h4 class="booking-content-info-head mb-0">
                                        Food Type
                                    </h4>
                                    <p class="booking-content-info-content">
                                        Vegetarian
                                    </p>
                                </div>
                                <div>
                                    <h4 class="booking-content-info-head mb-0">
                                        Cuisines provided
                                    </h4>
                                    <p class="booking-content-info-content">
                                        North Indian, Continental, South Indian,
                                        Jain
                                    </p>
                                </div>
                                <div>
                                    <h4 class="booking-content-info-head mb-0">
                                        PRESENT IN
                                    </h4>
                                    <p class="booking-content-info-content">
                                        Chennai
                                    </p>
                                </div>
                                <div>
                                    <h4 class="booking-content-info-head mb-0">
                                        DATE
                                    </h4>
                                    <p class="booking-content-info-content">
                                        14/09/2021
                                    </p>
                                </div>
                                <div>
                                    <h4 class="booking-content-info-head mb-0">
                                        VENUE
                                    </h4>
                                    <p class="booking-content-info-content">
                                        HOTEL PARK
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div
                            class="booking-content-buttons"
                            style="text-align: right"
                        >
                            <button style="background: #c4c4c4">
                                Reject lead
                            </button>
                            <button
                                style="background: #138808; margin-left: 2.5em"
                            >
                                Accept lead
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content" id="enquiries">
                <div class="main-content-sidebar">
                    <div class="main-content-head">
                        <button
                            @click="change($event)"
                            data-id="new"
                            class="tab-btn active"
                        >
                            New
                        </button>
                        <button
                            @click="change($event)"
                            data-id="accepted"
                            class="tab-btn"
                        >
                            Accepted
                        </button>
                        <button
                            @click="change($event)"
                            data-id="pending"
                            class="tab-btn"
                        >
                            Pending
                        </button>
                    </div>
                    <div
                        class="main-content-data"
                        style="padding: 0; border: 0.2px solid #000000"
                    >
                        <div id="new" class="content active">
                            <div class="chat">
                                <div
                                    v-for="(item, index) in newChat"
                                    :key="index"
                                >
                                    {{ item.name }}
                                </div>
                            </div>
                        </div>
                        <div id="accepted" class="content">
                            <div class="chat">
                                <div
                                    v-for="(item, index) in acceptedChat"
                                    :key="index"
                                >
                                    {{ item.name }}
                                </div>
                            </div>
                        </div>
                        <div id="pending" class="content">
                            <div class="chat">
                                <div
                                    v-for="(item, index) in pendingChat"
                                    :key="index"
                                >
                                    {{ item.name }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="main-content-section">
                    <div>
                        <div class="single-chat">
                            <img
                                src="\assets\vendors\leads\chat-icon.png"
                                alt=""
                            />
                            <div>
                                Hello Vendor, let me know the prirce for 100
                                Vegetarian plate.
                            </div>
                        </div>
                    </div>
                    <form
                        action=""
                        enctype="multipart/form-data"
                        class="chat-form"
                    >
                        <div>
                            <label for="imgupload">
                                <input type="file" id="imgupload" />
                                <img
                                    src="\assets\vendors\leads\Attach.svg"
                                    alt=""
                                />
                            </label>
                            <span></span>
                        </div>
                        <div>
                            <input type="text" placeholder="Message..." />
                            <button type="button">
                                <img
                                    src="\assets\vendors\leads\Emoticon.svg"
                                    alt=""
                                />
                            </button>
                            <button type="button">
                                <img
                                    src="\assets\vendors\leads\Send.svg"
                                    alt=""
                                />
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="content" id="contact-clicks">
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Name</th>
                            <th>E-mail</th>
                            <th>Phone number</th>
                            <th>Locality</th>
                            <th>Service offered</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in contactClick" :key="index">
                            <td>{{ item.date }}</td>
                            <td>{{ item.name }}</td>
                            <td>{{ item.email }}</td>
                            <td>{{ item.number }}</td>
                            <td>{{ item.locality }}</td>
                            <td>{{ item.services }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</template>

<script>
import $ from "jquery";
export default {
    name: "App",
    data() {
        return {
            newBookings: [
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
                {
                    id: 5,
                    name: "Viddhant Gautam",
                    location: "Chandigarh",
                    date: "20-Mar-2021",
                    time: "an hour ago",
                    loc: "Egmore, Channai",
                },
            ],
            acceptedBookings: [
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
                {
                    id: 5,
                    name: "Viddhant Gautam",
                    location: "Chandigarh",
                    date: "20-Mar-2021",
                    time: "an hour ago",
                    loc: "Egmore, Channai",
                },
            ],
            pendingBookings: [
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
                {
                    id: 5,
                    name: "Viddhant Gautam",
                    location: "Chandigarh",
                    date: "20-Mar-2021",
                    time: "an hour ago",
                    loc: "Egmore, Channai",
                },
            ],
            newChat: [
                { id: 1, name: "Aman" },
                { id: 2, name: "Nishant" },
                { id: 3, name: "Salaman" },
                { id: 4, name: "Teja" },
                { id: 5, name: "Umar" },
                { id: 6, name: "Karan" },
                { id: 7, name: "Prateek" },
                { id: 8, name: "Rashmi" },
                { id: 9, name: "Anshul" },
                { id: 10, name: "anil" },
                { id: 11, name: "Sunil" },
                { id: 12, name: "anil" },
                { id: 13, name: "Sunil" },
                { id: 14, name: "anil" },
                { id: 15, name: "Sunil" },
                { id: 16, name: "anil" },
                { id: 17, name: "Sunil" },
            ],
            acceptedChat: [
                { id: 1, name: "Rashmi" },
                { id: 2, name: "Prateek" },
                { id: 3, name: "Umar" },
                { id: 4, name: "Teja" },
                { id: 5, name: "Karan" },
            ],
            pendingChat: [
                { id: 1, name: "Sunil" },
                { id: 2, name: "anil" },
                { id: 3, name: "Salaman" },
            ],
            contactClick: [
                {
                    id: 1,
                    date: "12/01/2022",
                    name: "Nehal",
                    email: "client@gmail.com",
                    number: "9898765478",
                    locality: "9898765478",
                    services: "Bridal hair do",
                },
                {
                    id: 2,
                    date: "12/01/2022",
                    name: "Nehal",
                    email: "client@gmail.com",
                    number: "9898765478",
                    locality: "9898765478",
                    services: "Bridal hair do",
                },
                {
                    id: 3,
                    date: "12/01/2022",
                    name: "Nehal",
                    email: "client@gmail.com",
                    number: "9898765478",
                    locality: "9898765478",
                    services: "Bridal hair do",
                },
                {
                    id: 4,
                    date: "12/01/2022",
                    name: "Nehal",
                    email: "client@gmail.com",
                    number: "9898765478",
                    locality: "9898765478",
                    services: "Bridal hair do",
                },
                {
                    id: 5,
                    date: "12/01/2022",
                    name: "Nehal",
                    email: "client@gmail.com",
                    number: "9898765478",
                    locality: "9898765478",
                    services: "Bridal hair do",
                },
                {
                    id: 6,
                    date: "12/01/2022",
                    name: "Nehal",
                    email: "client@gmail.com",
                    number: "9898765478",
                    locality: "9898765478",
                    services: "Bridal hair do",
                },
            ],
        };
    },
    methods: {
        change(e) {
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
};
</script>

<style scoped>
/*

 ********* Vendor Dashboard Leads Page *************

 */

/* section-1 main tab css starts */

.main-tab-cont {
    margin: 3em auto;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    column-gap: 1em;
    row-gap: 1em;
    justify-content: space-between;
}
.main-tab-single {
    width: 100%;
}
.active > .main-tab-head {
    background-color: #461952;
}
.main-tab-head {
    background-color: #ffc700;
    border-radius: 10px;
    font-family: Segoe UI;
    font-style: normal;
    font-weight: normal;
    font-size: 12px;
    line-height: 16px;
    color: #ffffff;
    display: flex;
    justify-content: space-between;
    padding: 16px 32px 16px 16px;
}
.main-tab-buttons {
    display: flex;
    justify-content: space-between;
    margin-top: 6px;
}
.main-tab-buttons > button {
    outline: 0;
    border: none;
    background: #ffffff;
    border: 1px solid #461952;
    border-radius: 10px;
    width: 48%;
    padding: 5px 10px;
}
.main-tab-btn-1 > span:nth-child(1) {
    font-family: Segoe UI;
    font-style: normal;
    font-weight: normal;
    font-size: 8px;
    line-height: 11px;
    background: #138808;
    color: #ffffff;
    border-radius: 50%;
    width: 12px;
    height: 12px;
    display: inline-block;
    margin-right: 6px;
}
.main-tab-btn-1 > span:nth-child(2) {
    font-family: Segoe UI;
    font-style: normal;
    font-weight: normal;
    font-size: 10px;
    line-height: 13px;
    color: #000000;
}
.main-tab-btn-2 > span:nth-child(1) {
    font-family: Segoe UI;
    font-style: normal;
    font-weight: 600;
    font-size: 10px;
    line-height: 13px;
    color: #000000;
    display: inline-block;
    margin-right: 6px;
}
.main-tab-btn-2 > span:nth-child(2) {
    font-family: Segoe UI;
    font-style: normal;
    font-weight: 350;
    font-size: 10px;
    line-height: 13px;

    color: #534e4e;
}
/* section-1 main tab css end */

.main-content-cont {
    background-color: #f9ecf0;
}
.main-content-cont > div:nth-child(1) {
    display: grid;
    grid-template-columns: minmax(300px, 400px) auto;
}
.main-content-cont > div:nth-child(2) {
    display: grid;
    grid-template-columns: minmax(300px, 400px) auto;
}
.main-content-head {
    display: flex;
    flex-direction: row;
}
.main-content-sidebar {
    background-color: #f9ecf0;
}
.main-content-head > button {
    outline: 0;
    border: none;
    font-family: Roboto;
    font-style: normal;
    font-weight: 500;
    font-size: 15px;
    line-height: 18px;
    color: #000000;
    background-color: inherit;
    flex: 1;
    padding: 15px 0;
}

/* section-2 main content css end */

/* Section 3 upcoming-orders  starts*/
.main-content-data {
    padding: 1.5em 10px 1em;
}
/* .main-content-data > div {
  overflow-y: scroll;
  height: 100%;
} */
.main-content-sidebar {
    margin: 4px;
    margin-right: 0;
    height: 70vh;
    overflow-y: scroll;
    scrollbar-width: thin;
}

/* Section 3 upcoming-orders  end*/
/* Section 4 booking  start*/

.main-content-section {
    background: rgba(255, 255, 255, 0.8);
    margin: 4px;
    padding: 3.5em 2em;
    height: 70vh;
    overflow-y: scroll;
    scrollbar-width: thin;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}
.booking-content-info > div:nth-child(1) > p:nth-child(1) {
    font-family: Roboto;
    font-style: normal;
    font-weight: 500;
    font-size: 26px;
    line-height: 30px;
    text-transform: uppercase;
    color: #461952;
    margin-bottom: 7px;
}
.booking-content-info-head {
    font-family: Roboto;
    font-style: normal;
    font-weight: 800;
    font-size: 15px;
    line-height: 18px;
    color: #000000;
}
.booking-content-info-content {
    font-family: Roboto;
    font-style: normal;
    font-weight: 300;
    font-size: 13.7872px;
    line-height: 16px;
    color: #461952;
    margin: 3px 0;
    margin-bottom: 2em;
}
.booking-content-buttons > button {
    font-family: Roboto;
    font-style: normal;
    font-weight: normal;
    font-size: 13.5172px;
    line-height: 16px;
    color: #461952;
    padding: 16px 3em;
    border-radius: 10.1379px;
    outline: none;
    border: 0;
}
/* Section 4 booking  end*/

/* Section 4 enquiries start*/
.chat > div {
    font-family: Roboto;
    font-style: normal;
    font-weight: 300;
    font-size: 15px;
    line-height: 18px;
    color: #000000;
    padding: 15px 22px;
    border: 0.2px solid rgb(0, 0, 0);
}
.chat > div:nth-child(1) {
    background: #ffc700;
    border: 0.2px solid #ffffff;
}
.single-chat {
    display: flex;
    width: 50%;
}
.single-chat > img {
    width: 32px;
    height: 32px;
    margin-right: 5px;
}
.single-chat > div {
    font-family: Roboto;
    font-style: normal;
    font-weight: normal;
    font-size: 14px;
    line-height: 20px;
    color: #ffffff;
    background: #1868fb;
    box-shadow: 0px 0px 1px rgba(0, 0, 0, 0.24), 0px 2px 4px rgba(0, 0, 0, 0.16),
        0px -1px 1px rgba(0, 0, 0, 0.08);
    border-radius: 0px 24px 24px 24px;
    padding: 12px 20px;
}
.chat-form {
    background: #ffffff;
    box-shadow: 0px -0.5px 0px rgba(0, 0, 0, 0.1);
    display: flex;
    justify-content: space-between;
    padding: 10px 20px;
}
.chat-form button {
    border: none;
    outline: 0;
    background-color: inherit;
}
#imgupload {
    display: none;
}

/* Section 4 enquiries end*/

/* scrollbar starts */
.main-content-sidebar::-webkit-scrollbar {
    background-color: #f9ecf0;
    width: 16px;
}
.main-content-sidebar::-webkit-scrollbar-track {
    background-color: #f9ecf0;
}
.main-content-sidebar::-webkit-scrollbar-track:hover {
    background-color: #f4f4f4;
}
.main-content-sidebar::-webkit-scrollbar-thumb {
    background-color: #babac0;
    border-radius: 16px;
    border: 5px solid #f9ecf0;
}
.main-content-sidebar::-webkit-scrollbar-thumb:hover {
    background-color: #a0a0a5;
    border: 4px solid #f4f4f4;
}
/* scrollbar ends */

/* New Leads  */

.new-leads-single-details {
    display: flex;
    background: rgba(196, 69, 111, 0.1);
    border: 0.467672px solid rgba(196, 69, 111, 0.1);
    box-sizing: border-box;
    border-radius: 5.61206px;
    margin: 10px 1em;
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
.accepted-booking-buttons > div {
    display: flex;
    justify-content: flex-end;
    padding: 0 1em 2em 1em;
}
.accepted-booking-buttons > div > button {
    width: 34px;
    height: 34px;
    border-radius: 50%;
}
.accepted-booking-buttons > div > button > img {
    height: 14px;
    widows: 14px;
}

/*  contact click csss */

#contact-clicks {
    display: block;
    padding: 2em;
}
#contact-clicks > table {
    width: 100%;
    font-family: Segoe UI;
    font-style: normal;
    font-weight: 600;
    font-size: 18.41px;
    line-height: 24px;
    color: #706f6f;
    table-layout: fixed;
}
#contact-clicks > table tr:nth-of-type(odd) {
    background: #eee;
}
#contact-clicks th {
    padding-bottom: 1.5em;
    padding-top: 1em;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
#contact-clicks td {
    padding-bottom: 1em;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

/* navtab css start */

.content {
    display: none !important;
}
.tab-btn.active {
    background: #7f004b;
    color: white;
}
.content.active {
    display: grid !important;
}

@media only screen and (max-width: 992px) {
    .main-content-cont > div {
        grid-template-columns: 100% !important;
    }
}
@media only screen and (max-width: 760px),
    (min-device-width: 768px) and (max-device-width: 1024px) {
    /* Force table to not be like tables anymore */
    table,
    thead,
    tbody,
    th,
    td,
    tr {
        display: block;
    }

    /* Hide table headers (but not display: none;, for accessibility) */
    thead tr {
        display: none;
    }

    tr {
        border: 1px solid #ccc;
    }

    td {
        /* Behave  like a "row" */
        border: none;
        border-bottom: 1px solid #eee;
        position: relative;
        padding-left: 50%;
    }

    td:before {
        /* Now like a table header */
        position: absolute;
        /* Top/left values mimic padding */
        top: 6px;
        left: 6px;
        width: 45%;
        padding-right: 10px;
        white-space: nowrap;
    }

    /*
	Label the data
	*/
    td:nth-of-type(1):before {
        content: "Date";
    }
    td:nth-of-type(2):before {
        content: "Name";
    }
    td:nth-of-type(3):before {
        content: "E-mail";
    }
    td:nth-of-type(4):before {
        content: "Phone Number";
    }
    td:nth-of-type(5):before {
        content: "Locality";
    }
    td:nth-of-type(6):before {
        content: "Service Offered";
    }
}
</style>
