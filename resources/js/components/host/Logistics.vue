<template>
    <div class="wed-host-section">
        <div class="wed-host-section-container">
            <div class="wed-main-head">
                <div class="wed-main-head-details">
                    <h3>Logistics</h3>
                    <h3 v-if="invitation.side == 'bride'">{{invitation.brideName}} Weds {{invitation.groomName}}</h3>
                    <h3 v-if="invitation.side == 'groom'">{{invitation.groomName}} Weds {{invitation.brideName}}</h3>
                </div>
                <div
                    v-if="
                        showSendLogistics == false && selectGuestClick == false
                    "
                    class="wed-main-select-sort"
                >
                    <button @click="selectGuestClick = true" type="button">
                        FOR GROUP-Select
                    </button>
                    <span style="position: relative">
                        <button @click="showSort = !showSort" type="button">
                            <img src="/assets/filter.svg" alt="" />
                            Sort by
                        </button>
                        <div v-if="showSort" class="sort-cont">
                            <div class="btn-container">
                                <button
                                    type="button"
                                    class="tab-btn sort-btns active"
                                    data-id="sort-location"
                                    title="Location"
                                    @click="toggleForm($event, true)"
                                >
                                    Location
                                </button>
                                <button
                                    type="button"
                                    class="tab-btn sort-btns"
                                    data-id="sort-relation"
                                    title="Relation"
                                    @click="toggleForm($event, true)"
                                >
                                    Relation
                                </button>
                            </div>
                            <div class="about-content">
                                <div class="content active sort-location">
                                    <label for="all-location">
                                        <input
                                            type="radio"
                                            name="location-sort"
                                            id="all-location"
                                        />
                                        All
                                    </label>
                                    <input
                                        type="text"
                                        name=""
                                        id=""
                                        placeholder="Search location"
                                        class="sort-location-search"
                                    />
                                    <div
                                        style="
                                            height: 123px;
                                            overflow-y: auto;
                                            overflow-x: hidden;
                                        "
                                    >
                                        <label for="delhi">
                                            <input
                                                type="radio"
                                                name="location-sort"
                                                id="delhi"
                                            />
                                            Delhi
                                        </label>
                                        <label for="punjab">
                                            <input
                                                type="radio"
                                                name="location-sort"
                                                id="punjab"
                                            />
                                            Pubjab
                                        </label>
                                        <label for="chennai">
                                            <input
                                                type="radio"
                                                name="location-sort"
                                                id="chennai"
                                            />
                                            Chennai
                                        </label>
                                    </div>
                                </div>
                                <div class="content sort-relation">
                                    <label for="all-relation">
                                        <input
                                            type="radio"
                                            name="relation-sort"
                                            id="all-relation"
                                        />
                                        All
                                    </label>
                                    <input
                                        type="text"
                                        name=""
                                        id=""
                                        placeholder="Search relation"
                                        class="sort-relation-search"
                                    />
                                    <div
                                        style="
                                            height: 123px;
                                            overflow-y: auto;
                                            overflow-x: hidden;
                                        "
                                    >
                                        <label for="bride">
                                            <input
                                                type="radio"
                                                name="relation-sort"
                                                id="bride"
                                            />
                                            Bride
                                        </label>
                                        <label for="groom">
                                            <input
                                                type="radio"
                                                name="relation-sort"
                                                id="groom"
                                            />
                                            Groom
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </span>
                </div>
                <div
                    v-if="showSendLogistics == true"
                    class="wed-main-select-sort"
                >
                    <button @click="showSendLogistics = false" type="button">
                        Logistics List
                    </button>
                </div>
            </div>
            <div v-if="showSendLogistics == false">
                <div class="acord-toggle">
                    <div
                        @click="
                            type = 'arrival';
                            emptyForm(true);
                        "
                        :class="type == 'arrival' ? 'active' : ''"
                    >
                        Arrival
                    </div>
                    <div
                        @click="
                            type = 'departure';
                            emptyForm(true);
                        "
                        :class="type == 'departure' ? 'active' : ''"
                    >
                        Departure
                    </div>
                </div>
                <div class="custom-accordion">
                    <div
                        v-for="(item, index) in listAll"
                        :key="index"
                        class="custom-accord-item"
                    >
                        <div
                            @click="closeAccord($event)"
                            class="custom-accord-head log-guest-accord-head"
                            :class="{
                                'select-on': selectGuestClick,
                            }"
                        >
                            <span style="width: max-content"
                                ><input
                                    type="checkbox"
                                    v-model="selectedGuests"
                                    :value="index"
                                    @click.stop="changeColor($event)"
                                    class="select-guest-checkbox"
                                    v-if="selectGuestClick"
                            /></span>
                            <span style="width: 15%">{{
                                item.guest.name
                            }}</span>
                            <span style="width: 15%">{{
                                item.guest.mobile
                            }}</span>
                            <span style="width: 30%">{{ item.location }}</span>
                            <span style="width: 20%">
                                {{
                                    new Date("1970-01-01T" + item.time + "Z")
                                        | moment("h:mm a")
                                }}
                                {{ item.date | moment("dddd, D MMMM YYYY") }}
                            </span>
                            <span>
                                <span
                                    v-if="type == 'arrival'"
                                    style="width: 10%; text-align: right"
                                    >{{
                                        item.guest.invitations[0]
                                            .guest_invitation
                                            .logisticsArrivalStatus == 4
                                            ? item.memberCount.length + 1
                                            : item.memberCount.length
                                    }}
                                    <img
                                        src="/assets/logistics/carbon_user.svg"
                                        alt=""
                                    />
                                </span>
                                <span
                                    v-if="type == 'departure'"
                                    style="width: 10%; text-align: right"
                                    >{{
                                        item.guest.invitations[0]
                                            .guest_invitation
                                            .logisticsDepartureStatus == 4
                                            ? item.memberCount.length + 1
                                            : item.memberCount.length
                                    }}
                                    <img
                                        src="/assets/logistics/carbon_user.svg"
                                        alt=""
                                    />
                                </span>
                            </span>
                            <span style="width: 10%; text-align: right"
                                ><img
                                    src="/assets/logistics/arrow_down.svg"
                                    alt=""
                            /></span>
                        </div>
                        <form
                            @submit.prevent="singleLog(item)"
                            class="custom-accord-content log-guest-accord-content"
                        >
                            <div class="form-group-custom-mode">
                                <span>Mode of transportation</span>
                                <span>
                                    <label :for="'van' + item.id">
                                        <input
                                            type="radio"
                                            name="mode_of_transport"
                                            :id="'van' + item.id"
                                            value="van"
                                            v-model="item.transport"
                                        />
                                        Van
                                    </label>
                                    <label :for="'car' + item.id">
                                        <input
                                            type="radio"
                                            name="mode_of_transport"
                                            :id="'car' + item.id"
                                            value="car"
                                            v-model="item.transport"
                                        />
                                        Car
                                    </label>
                                    <label :for="'bus' + item.id">
                                        <input
                                            type="radio"
                                            name="mode_of_transport"
                                            :id="'bus' + item.id"
                                            value="bus"
                                            v-model="item.transport"
                                        />
                                        Bus
                                    </label>
                                </span>
                                <span
                                    v-if="
                                        errorsSubmit && errorsSubmit.transport
                                    "
                                    class="errMsg"
                                    >{{ errorsSubmit.transport[0] }}</span
                                >
                            </div>
                            <div class="form-group-custom">
                                <label for="Vehice_no">
                                    Vehicle Number
                                    <input
                                        type="text"
                                        name="Vehice_no"
                                        id="Vehice_no"
                                        v-model="item.vehicleNo"
                                        placeholder="Enter Vehicle Number"
                                    />
                                </label>
                                <span
                                    v-if="
                                        errorsSubmit && errorsSubmit.vehicleNo
                                    "
                                    class="errMsg"
                                    >{{ errorsSubmit.vehicleNo[0] }}</span
                                >
                            </div>
                            <div class="form-group-custom">
                                <label for="Vehice_incharge_name">
                                    Vehicle incharge name
                                    <input
                                        type="text"
                                        name="Vehice_incharge_name"
                                        id="Vehice_incharge_name"
                                        v-model="item.driverName"
                                        placeholder="Enter Vehicle Incharge Name"
                                    />
                                </label>
                                <span
                                    v-if="
                                        errorsSubmit && errorsSubmit.driverName
                                    "
                                    class="errMsg"
                                    >{{ errorsSubmit.driverName[0] }}</span
                                >
                            </div>
                            <div class="form-group-custom">
                                <label for="Vehice_incharge_number">
                                    Vehicle incharge phone no
                                    <input
                                        type="text"
                                        name="Vehice_incharge_number"
                                        id="Vehice_incharge_number"
                                        v-model="item.driverMobile"
                                        placeholder="Enter Vehicle Number"
                                    />
                                </label>
                                <span
                                    v-if="
                                        errorsSubmit &&
                                        errorsSubmit.driverMobile
                                    "
                                    class="errMsg"
                                    >{{ errorsSubmit.driverMobile[0] }}</span
                                >
                            </div>
                            <div class="form-group-custom">
                                <label for="log_incharge_name">
                                    Logistics incharge name
                                    <input
                                        type="text"
                                        name="log_incharge_name"
                                        id="log_incharge_name"
                                        v-model="item.inchargeName"
                                        placeholder="Enter Logistics incharge Name"
                                    />
                                </label>
                                <span
                                    v-if="
                                        errorsSubmit &&
                                        errorsSubmit.inchargeName
                                    "
                                    class="errMsg"
                                    >{{ errorsSubmit.inchargeName[0] }}</span
                                >
                            </div>
                            <div class="form-group-custom">
                                <label for="log_incharge_no">
                                    Logistics incharge phone no
                                    <input
                                        type="text"
                                        name="log_incharge_no"
                                        id="log_incharge_no"
                                        v-model="item.inchargeMobile"
                                        placeholder="Enter Logistics incharge Number"
                                    />
                                </label>
                                <span
                                    v-if="
                                        errorsSubmit &&
                                        errorsSubmit.inchargeMobile
                                    "
                                    class="errMsg"
                                    >{{ errorsSubmit.inchargeMobile[0] }}</span
                                >
                            </div>
                            <div class="form-group-custom-btn">
                                <button :disabled="submitDisable" type="submit">
                                    Submit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="send-log-all-cont" v-if="showSendLogistics == true">
                <div class="send-log-all-guest">
                    <div>
                        <span>Guests</span>
                        <img
                            v-if="type == 'arrival'"
                            src="/assets/guestInvi/carbon_arrival.svg"
                            alt=""
                        />
                        <img
                            v-if="type == 'departure'"
                            src="/assets/guestInvi/carbon_departure.svg"
                            alt=""
                        />
                    </div>
                    <div class="send-log-all-guest-list">
                        <div v-for="item in selectedGuestAll" :key="item.id">
                            <span>{{ item.guest.name }}</span>
                            <span>{{ item.location }}</span>
                        </div>
                    </div>
                </div>
                <form @submit.prevent="sendAll" class="send-log-all-form">
                    <div class="form-group-custom-mode">
                        <span>Mode of transportation</span>
                        <span>
                            <label for="van">
                                <input
                                    type="radio"
                                    name="mode_of_transport"
                                    id="van"
                                    value="van"
                                    v-model="singleData.transport"
                                />
                                Van
                            </label>
                            <label for="car">
                                <input
                                    type="radio"
                                    name="mode_of_transport"
                                    id="car"
                                    value="car"
                                    v-model="singleData.transport"
                                />
                                Car
                            </label>
                            <label for="bus">
                                <input
                                    type="radio"
                                    name="mode_of_transport"
                                    id="bus"
                                    value="bus"
                                    v-model="singleData.transport"
                                />
                                Bus
                            </label>
                        </span>
                    </div>
                    <div class="form-group-custom">
                        <label for="Vehice_no">
                            Vehicle Number
                            <input
                                type="text"
                                name="Vehice_no"
                                id="Vehice_no"
                                v-model="singleData.vehicleNo"
                                placeholder="Enter Vehicle Number"
                            />
                        </label>
                    </div>
                    <div class="form-group-custom">
                        <label for="Vehice_incharge_name">
                            Vehicle incharge name
                            <input
                                type="text"
                                name="Vehice_incharge_name"
                                id="Vehice_incharge_name"
                                v-model="singleData.driverName"
                                placeholder="Enter Vehicle Incharge Name"
                            />
                        </label>
                    </div>
                    <div class="form-group-custom">
                        <label for="Vehice_incharge_number">
                            Vehicle incharge phone no
                            <input
                                type="text"
                                name="Vehice_incharge_number"
                                id="Vehice_incharge_number"
                                v-model="singleData.driverMobile"
                                placeholder="Enter Vehicle Number"
                            />
                        </label>
                    </div>
                    <div class="form-group-custom">
                        <label for="log_incharge_name">
                            Logistics incharge name
                            <input
                                type="text"
                                name="log_incharge_name"
                                id="log_incharge_name"
                                v-model="singleData.inchargeName"
                                placeholder="Enter Logistics incharge Name"
                            />
                        </label>
                    </div>
                    <div class="form-group-custom">
                        <label for="log_incharge_no">
                            Logistics incharge phone no
                            <input
                                type="text"
                                name="log_incharge_no"
                                id="log_incharge_no"
                                v-model="singleData.inchargeMobile"
                                placeholder="Enter Logistics incharge Number"
                            />
                        </label>
                    </div>
                    <div class="form-group-custom-btn">
                        <button :disabled="submitAllDisable" type="submit">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div
            v-if="selectGuestClick == true && showSendLogistics == false"
            class="guest-select-summary"
        >
            <div>
                <span>{{ selectedGuests.length }} Selected</span>
                <button @click="selectGuestClick = false" type="button">
                    Deselect
                </button>
            </div>
            <div>
                <button
                    @click="
                        emptyForm(false);
                        showSendLogistics = true;
                    "
                    type="button"
                >
                    <img src="/assets/send.svg" alt="" />
                    Shortlist
                </button>
            </div>
        </div>
        <div v-if="sendLogPressed" class="send-invi-popup-wrapper">
            <div class="send-invi-popup">
                <div>
                    <img
                        @click="sendLogPressed = false"
                        src="/assets/send-invi-cross.svg"
                        alt=""
                    />
                </div>
                <div><img src="/assets/send-invi-icon.png" alt="" /></div>
                <h4>Logistics Sent</h4>
                <p>
                    Logistics sent to 3 Guest. Track the status of invitation in
                    Reports
                </p>
                <div>
                    <button
                        @click="
                            selectGuestClick = false;
                            showSendLogistics = false;
                            selectedGuests = [];
                            sendLogPressed = false;
                        "
                        type="button"
                    >
                        Send More Logistics
                    </button>
                </div>
                <div><a href="/host/reports">Status</a></div>
            </div>
        </div>
        <flashMessage :message="message"></flashMessage>
    </div>
</template>

<script>
import flashMessage from "../FlashMessage.vue";

export default {
    components: {
        flashMessage,
    },
    props: ["loggedIn", "invitation", "arrivals", "departures"],
    data() {
        return {
            showSort: false,
            selectGuestClick: false,
            showSendLogistics: false,
            selectedGuests: [],
            arrivalList: this.arrivals,
            departureList: this.departures,
            type: "arrival",
            singleData: {
                transport: null,
                vehicleNo: null,
                driverName: null,
                driverMobile: null,
                inchargeName: null,
                inchargeMobile: null,
                guest_id: null,
                invitation_id: null,
            },
            message: null,
            submitDisable: false,
            submitAllDisable: false,
            sendLogPressed: false,
            errorsSubmit: null,
        };
    },
    methods: {
        toggleForm(e, bool) {
            //console.log(bool);
            let _this = this;
            for (let single in _this.singleData) {
                _this.singleData[single] = null;
            }
            let id = null;
            if (bool == true) {
                id = e.currentTarget.dataset.id;
            }
            if (bool == false) {
                id = e;
            }
            //console.log(e.currentTarget.parentElement.children);
            const btns = [...e.currentTarget.parentElement.children];
            const articles = [
                ...e.currentTarget.parentElement.nextElementSibling.children,
            ];
            const articlesCont =
                e.currentTarget.parentElement.nextElementSibling;

            //console.log(btns, articles);
            btns.forEach(function (btn) {
                btn.classList.remove("active");
            });
            btns.forEach(function (btn) {
                if (btn.dataset.id == id) {
                    btn.classList.add("active");
                }
            });
            articles.forEach(function (article) {
                article.classList.remove("active");
            });
            //console.log(document.getElementById(e.currentTarget.dataset.id));
            $(articlesCont)
                .find(`.${e.currentTarget.dataset.id}`)
                .addClass("active");
            //document.getElementById(id).classList.add("active");
        },
        closeAccord(e) {
            let item = e.currentTarget;
            var drop = item.nextElementSibling;
            var accordian = document.querySelectorAll(".custom-accord-head");
            if (drop.style.maxHeight) {
                drop.style.maxHeight = null;
                drop.style.padding = null;
                item.style.paddingBottom = null;
            } else {
                accordian.forEach(function (element) {
                    if (element !== item) {
                        element.nextElementSibling.style.maxHeight = null;
                        element.nextElementSibling.style.padding = null;
                        element.style.paddingBottom = null;
                    } else {
                        drop.style.maxHeight = drop.scrollHeight + 500 + "px";
                        drop.style.padding = "20px";
                        if (item.style.paddingBottom) {
                            item.style.paddingBottom = null;
                        }
                    }
                });
            }
        },
        changeColor(e) {
            let item = e.currentTarget.parentElement.parentElement;
            //console.log(e.currentTarget.checked);
            if (e.currentTarget.checked == true) {
                item.classList.remove("select-on");
            } else {
                item.classList.add("select-on");
            }
        },
        singleLog(item) {
            let _this = this;
            _this.submitDisable = true;
            _this.errorsSubmit = null;
            //let data = this.listAll.find((x) => x.id == item.id);
            for (let single in _this.singleData) {
                _this.singleData[single] = item[single];
            }
            let formData = new FormData();
            for (var key in _this.singleData) {
                formData.append(key, _this.singleData[key]);
            }
            formData.append("type", _this.type);
            axios({
                method: "POST",
                url: route("hostlogistics.store"),
                data: formData,
            })
                .then(function (response) {
                    _this.arrivalList = response.data[0];
                    _this.departureList = response.data[1];
                    for (let single in _this.singleData) {
                        _this.singleData[single] = null;
                    }
                    _this.submitDisable = false;
                    _this.message = "Details Updated!";
                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                    console.log("submitted", response);
                })
                .catch((error) => {
                    console.log(error);
                    _this.submitDisable = false;
                    _this.errorsSubmit = error.response.data.errors;
                });
        },
        sendAll() {
            let _this = this;
            _this.submitAllDisable = true;
            let ids = [];
            if (_this.selectedGuestAll.length == 0) {
                _this.message = "Add guests to assign logistics";
                setTimeout(function () {
                    _this.message = null;
                }, 3000);
                return;
            }
            //let data = this.listAll.find((x) => x.id == item.id);
            let formData = new FormData();
            for (var key in _this.singleData) {
                console.log(_this.singleData[key]);
                if (_this.singleData[key] != null) {
                    formData.append(key, _this.singleData[key]);
                }
            }
            _this.selectedGuestAll.forEach((item) => {
                ids.push(item.guest_id);
            });
            formData.append("type", _this.type);
            formData.append("list", JSON.stringify(ids));
            formData.append("invitation_id", _this.invitation.id);
            axios({
                method: "POST",
                url: route("hostlogistics.store"),
                data: formData,
            })
                .then(function (response) {
                    _this.arrivalList = response.data[0];
                    _this.departureList = response.data[1];
                    _this.submitAllDisable = false;
                    _this.sendLogPressed = true;
                    _this.message = "Details Updated!";
                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                    console.log("submitted", response);
                })
                .catch((error) => {
                    console.log(error.response.data.errors);
                    _this.submitAllDisable = false;
                });
        },
        emptyForm(bool) {
            let _this = this;
            for (let single in _this.singleData) {
                _this.singleData[single] = null;
            }
            _this.selectGuestClick = false;
            _this.showSendLogistics = false;
            _this.sendLogPressed = false;
            if (bool == true) {
                _this.selectedGuests = [];
            }
        },
    },
    computed: {
        listAll() {
            if (this.type == "arrival") {
                return this.arrivalList;
            }
            if (this.type == "departure") {
                return this.departureList;
            }
        },
        selectedGuestAll() {
            let _this = this;
            let all = [];
            if (_this.selectedGuests.length == 0) {
                return all;
            } else {
                _this.selectedGuests.forEach((item) => {
                    all.push(_this.listAll[item]);
                });
                return all;
                //let data = _this.listAll.find((x) => x.id == item.id);
            }
        },
    },
};
</script>

<style scoped>
.errMsg {
    color: red;
    font-size: 10px;
}
/* wed-main-head css start */
.wed-main-head {
    display: flex;
    justify-content: center;
    margin-bottom: 15px;
    align-items: center;
    position: relative;
}
.wed-main-head-details > h3 {
    margin-bottom: 10px;
    text-align: center;
}
.wed-main-head-details > h3:nth-child(1) {
    font-family: "Perpetua";
    font-style: normal;
    font-weight: 700;
    font-size: 24.4444px;
    line-height: 28px;
    color: #333333;
}
.wed-main-head-details > h3:nth-child(2) {
    font-family: Niconne;
    font-style: normal;
    font-weight: normal;
    font-weight: 400;
    font-size: 19.9799px;
    line-height: 25px;
    color: #461952;
}
.wed-main-select-sort {
    position: absolute;
    top: 0;
    right: 0;
}
.wed-main-select-sort button {
    border: 1px solid #e3e8ee;
    border-radius: 5px;
    padding: 13px 22px;
    background-color: #ffffff;
    font-family: "Inter";
    font-style: normal;
    font-weight: 400;
    font-size: 12px;
    line-height: 15px;
    color: #c4456f;
}
.sort-cont {
    position: absolute;
    background: #ffffff;
    right: 0;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.25);
    z-index: 99999;
}
.sort-location,
.sort-relation {
    padding: 13px;
}
.sort-location input,
.sort-relation input {
    margin-right: 10px;
}
.sort-location label,
.sort-relation label {
    font-family: "Inter";
    font-style: normal;
    font-weight: 600;
    font-size: 9.84112px;
    line-height: 12px;
    text-transform: capitalize;
    margin: 10px;
    padding-bottom: 5px;
    color: #6b6b6b;
    width: 90%;
    border-bottom: 0.328037px solid #cdcdcd;
}
.sort-location-search,
.sort-relation-search {
    font-family: "Inter";
    font-style: normal;
    font-weight: 600;
    font-size: 9.84112px;
    line-height: 12px;
    width: 97%;
    border: 0.546729px solid #b4b4b4;
    border-radius: 5.46729px;
    padding: 5px;
    text-transform: capitalize;

    color: #6b6b6b;
}
.btn-container {
    overflow-y: auto;
    /* min-width: 500px; */
    display: flex;
    flex-wrap: nowrap;
}
.tab-btn {
    font-family: "Poppins", sans-serif;
    font-style: normal;
    font-weight: 300;
    font-size: 13px;
    line-height: 20px;
    color: #6b6b6b;
    background-color: inherit;
    outline: none;
    border: none;
    padding: 10px;
    min-width: fit-content;
}
.tab-btn.active {
    border-bottom: 4px solid #c4456f;
    font-weight: 500;
    color: #c4456f;
}
.sort-btns {
    border: none !important;
    border-bottom: 0.3px solid #cdcdcd !important;
    border-radius: 0 !important;
}
.sort-btns.active {
    border-bottom: 4px solid #461952 !important;
    font-weight: 900;
    color: #461952;
}
.content {
    display: none;
}
.content.active {
    display: block;
}
/* wed-main-head css end */

/* guest logistics cont css start */
.log-guest-accord-head {
    background: #c4456f;
    border: 0.5px solid #ffffff;
    border-radius: 6px;
    padding: 12px 30px;
    display: flex;
    flex-wrap: nowrap;
}
.log-guest-accord-head > span {
    margin-right: 7px;
    display: inline-block;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 16px;
    line-height: 24px;
    color: #ffffff;
    white-space: nowrap;
    text-overflow: ellipsis;
    overflow: hidden;
}
.select-on {
    background: #f7f7f7 !important;
}
.select-on > span {
    color: #9c9797 !important;
}
.select-guest-checkbox {
    margin-right: 10px;
    padding: 10px;
}
.custom-accord-content {
    max-height: 0;
    overflow: hidden;
    transition: all linear 500ms;
    padding: 0;
}
.custom-accord-head {
    cursor: pointer;
}
.log-guest-accord-content {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    grid-auto-rows: max-content;
    -moz-column-gap: 12px;
    column-gap: 12px;
    row-gap: 4px;
    /* padding-top: 15px; */
}
.form-group-custom {
    background: rgba(255, 255, 255, 0.4);
    border: 0.528708px solid #f7dae4;
    border-radius: 5.28708px;
    padding: 15px;
}
.form-group-custom > label {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 12px;
    line-height: 18px;
    color: #000000;
}
.form-group-custom > label > input {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 16px;
    line-height: 24px;
    color: #333333;
    outline: none;
    border: 0;
    margin: 5px 0;
    background-color: transparent !important;
    width: 100%;
}
.form-group-custom-mode {
    background: rgba(255, 255, 255, 0.4);
    border: 0.528708px solid #f7dae4;
    border-radius: 5.28708px;
    padding: 15px;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 16px;
    line-height: 24px;
    color: #000000;
    display: flex;
    grid-column: span 2;
    justify-content: space-between;
    align-items: center;
}
.form-group-custom-mode > span > label {
    font-family: "Inter";
    font-style: normal;
    font-weight: 600;
    font-size: 12px;
    line-height: 19px;
    letter-spacing: -0.0873766px;
    color: #969696;
    display: flex;
    align-items: center;
    display: inline-block;
}
.form-group-custom-mode > span > label > input {
    margin-left: 15px;
}
.form-group-custom-btn {
    display: flex;
    justify-content: center;
    align-items: center;
}
.form-group-custom-btn > button {
    outline: none;
    border: none;
    background: #c4456f;
    border-radius: 7.72px;
    padding: 15px 38px;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 16px;
    line-height: 24px;
    text-align: center;
    color: #ffffff;
}
.acord-toggle {
    display: flex;
    position: relative;
}

.acord-toggle > div:nth-child(1) {
    margin-left: 4em;
}
.acord-toggle > div {
    border-radius: 9px 9px 0px 0px;
    background: #ffedf2;
    padding: 14px 34px;
    width: max-content;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 16px;
    line-height: 24px;
    color: #333333;
    cursor: pointer;
}
.acord-toggle > div.active {
    background: #c4456f;
    color: #ffffff;
}
/* guest logistics cont css end */

/* select guest count start */
.guest-select-summary {
    padding: 9px 50px;
    background: #461952;
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.guest-select-summary span {
    font-family: "Inter";
    font-style: normal;
    font-weight: 600;
    font-size: 14px;
    line-height: 17px;
    color: #ffffff;
    margin-right: 10px;
}
.guest-select-summary button {
    font-family: "Inter";
    font-style: normal;
    font-weight: 400;
    font-size: 12px;
    line-height: 15px;
    color: #ffffff;
    outline: none;
    border: none;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 5px;
    padding: 13px 24px;
}
/* select guest count end */
/* select guest send all start */

.send-log-all-cont {
    width: 60%;
    margin: auto;
}
.send-log-all-guest {
    background: rgba(255, 255, 255, 0.4);
    border: 0.528708px solid #f7dae4;
    border-radius: 5.28708px;
    padding: 15px;
}
.send-log-all-guest > div:nth-child(1) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 12px;
    line-height: 18px;
    display: flex;
    justify-content: space-between;
    color: #000000;
    margin-bottom: 10px;
}
.send-log-all-guest-list {
    display: flex;
    flex-wrap: wrap;
}
.send-log-all-guest-list > div {
    background: #ffe9ee;
    border: 0.5px solid #c4456f;
    border-radius: 5px;
    max-width: 178px;
    width: 100%;
    padding: 8px 12px;
}
.send-log-all-guest-list > div > span {
    display: block;
    width: 100%;
}
.send-log-all-guest-list > div > span:nth-child(1) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 16px;
    line-height: 24px;
    color: #c4456f;
}
.send-log-all-guest-list > div > span:nth-child(2) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 12px;
    line-height: 18px;
    color: #333333;
}
.send-log-all-form {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-auto-rows: max-content;
    -moz-column-gap: 12px;
    column-gap: 12px;
    row-gap: 4px;
    margin-top: 7px;
}
.send-log-all-form > .form-group-custom-btn {
    grid-column-start: 1;
    grid-column-end: -1;
    margin-top: 7px;
}
.send-log-all-form > .form-group-custom-btn > button {
    display: block;
    width: 100%;
}
/* select guest send all end */
.send-invi-popup-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100%;
    overflow-y: auto;
    background-color: rgba(0, 0, 0, 0.4);
    z-index: 999;
    top: 0;
    position: fixed;
    right: 0;
}
.send-invi-popup {
    background: #ffffff;
    box-shadow: 0px 3.35501px 50.3252px rgba(0, 0, 0, 0.25);
    border-radius: 8.38753px;
    padding: 24px;
    max-width: 620px;
    margin: auto;
}
.send-invi-popup > div:nth-child(1) {
    display: flex;
    justify-content: flex-end;
    align-items: center;
}
.send-invi-popup > div:nth-child(2),
.send-invi-popup > div:nth-child(5),
.send-invi-popup > div:nth-child(6) {
    display: flex;
    justify-content: center;
}
.send-invi-popup > h4 {
    font-family: "Poppins", sans-serif;
    font-style: normal;
    font-weight: 500;
    font-size: 22.2467px;
    line-height: 33px;
    text-align: center;
    color: #000000;
    margin-bottom: 10px;
}
.send-invi-popup > p {
    font-family: "Poppins", sans-serif;
    font-style: normal;
    font-weight: 500;
    font-size: 11.8626px;
    line-height: 18px;
    text-align: center;
    max-width: 300px;
    width: 100%;
    color: #898484;
    margin: auto;
    margin-bottom: 1.5em;
}
.send-invi-popup button {
    display: block;
    background: #461952;
    border-radius: 33.5501px;
    border: none;
    outline: none;
    font-family: "Mulish";
    font-style: normal;
    font-weight: 800;
    font-size: 12.5813px;
    line-height: 16px;
    width: 100%;
    max-width: 300px;
    color: #ffffff;
    padding: 16px;
    margin-bottom: 10px;
}
.send-invi-popup a {
    text-decoration: none;
    border: 0.419377px solid #c6c6c6;
    border-radius: 33.5501px;
    filter: drop-shadow(0px 0px 0.838753px rgba(0, 0, 0, 0.25));
    font-family: "Mulish";
    font-style: normal;
    font-weight: 500;
    font-size: 12.5813px;
    line-height: 16px;
    padding: 16px;
    width: 100%;
    max-width: 300px;
    display: block;
    color: #6d6666;
    text-align: center;
    margin-bottom: 2em;
}
</style>
