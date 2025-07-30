<template>
    <div
        class="guest-invi-acc-cont container-lg"
        v-if="
            privileges.guest_invitation.logistics != 0 &&
            (privileges.guest_invitation.logisticsArrivalStatus != 3 ||
                privileges.guest_invitation.logisticsDepartureStatus != 3)
        "
    >
        <div
            v-if="
                privileges.guest_invitation.logisticsArrivalStatus == 1 ||
                privileges.guest_invitation.logisticsDepartureStatus == 1
            "
            class="guest-acc-accept"
        >
            <h1 class="guest-invi-heading">Logistics</h1>
            <h6 class="guest-invi-sub-heading">
                Accept Invitation to Accept logictics
            </h6>
            <div>
                <button
                    @click="acceptLog('accept')"
                    :class="{
                        active: privileges.guest_invitation.inviteStatus == 6,
                    }"
                    type="button"
                    :disabled="disableAcceptLog"
                >
                    Accept
                </button>
                <button
                    @click="acceptLog('decline')"
                    :class="{
                        active: privileges.guest_invitation.inviteStatus == 6,
                    }"
                    type="button"
                    :disabled="disableAcceptLog"
                >
                    Decline
                </button>
            </div>
        </div>
        <div v-else style="width: 80%; margin: auto">
            <div>
                <div
                    v-if="
                        (active == 'arrival' &&
                            privileges.guest_invitation
                                .logisticsArrivalStatus == 2) ||
                        (active == 'departure' &&
                            privileges.guest_invitation
                                .logisticsDepartureStatus == 2)
                    "
                >
                    <div style="position: relative; width: 100%">
                        <h1 class="guest-invi-heading">Logistics</h1>
                        <a
                            class="guest-profile-link"
                            :href="route('guestprofile.index', user)"
                        >
                            <img
                                v-if="screenWidth > 768"
                                style="margin-right: 10px"
                                src="/assets/guestInvi/Group-1689.svg"
                                alt=""
                            />
                            <img v-else src="/assets/user-plus.svg" alt="" />
                            <span v-if="screenWidth > 768">Add Members</span>
                        </a>
                    </div>
                    <h6 class="guest-invi-sub-heading">
                        Add Members Detatils to provide logistics service
                    </h6>
                </div>
                <div
                    v-else-if="
                        ((privileges.guest_invitation.logisticsArrivalStatus ==
                            4 ||
                            privileges.guest_invitation
                                .logisticsArrivalStatus == 5) &&
                            privileges.guest_invitation
                                .hostLogisticsArrivalStatus == 0 &&
                            active == 'arrival') ||
                        ((privileges.guest_invitation
                            .logisticsDepartureStatus == 4 ||
                            privileges.guest_invitation
                                .logisticsDepartureStatus == 5) &&
                            privileges.guest_invitation
                                .hostLogisticsDepartureStatus == 0 &&
                            active == 'departure')
                    "
                >
                    <h1 class="guest-invi-heading">Logistics</h1>
                    <h6 class="guest-invi-sub-heading">
                        Add your
                        {{ active == "arrival" ? "Arrival" : "Departure" }}
                        details to provide you logistics service
                    </h6>
                </div>
                <div
                    v-else-if="
                        ((privileges.guest_invitation.logisticsArrivalStatus ==
                            4 ||
                            privileges.guest_invitation
                                .logisticsArrivalStatus == 5) &&
                            privileges.guest_invitation
                                .hostLogisticsArrivalStatus == 2 &&
                            active == 'arrival') ||
                        ((privileges.guest_invitation
                            .logisticsDepartureStatus == 4 ||
                            privileges.guest_invitation
                                .logisticsDepartureStatus == 5) &&
                            privileges.guest_invitation
                                .hostLogisticsDepartureStatus == 2 &&
                            active == 'departure')
                    "
                    class="guest-log-room-disp"
                >
                    <h1 class="guest-invi-heading">Logistics</h1>

                    <div style="position: absolute; right: 0; top: 0">
                        <button>
                            <img
                                class="filter-black"
                                src="/assets/guestInvi/Group-1702.svg"
                                alt=""
                            />
                        </button>
                        <button @click="$emit('help')" type="button">
                            <img
                                class="filter-black"
                                src="/assets/guestInvi/clarity_help-line.svg"
                                alt=""
                            />
                            <span>Help</span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="guest-log-form-head">
                <div
                    @click="toggle('arrival')"
                    :class="{ active: active == 'arrival' }"
                >
                    Arrival
                </div>
                <div
                    @click="toggle('departure')"
                    :class="{ active: active == 'departure' }"
                >
                    Departure
                </div>
            </div>
            <div style="width: 60%; margin: auto">
                <div
                    v-if="
                        (active == 'arrival' &&
                            privileges.guest_invitation
                                .logisticsArrivalStatus == 2) ||
                        (active == 'departure' &&
                            privileges.guest_invitation
                                .logisticsDepartureStatus == 2)
                    "
                    class="guest-acc-fam-add-cont"
                >
                    <div class="guest-acc-fam-input">
                        <div
                            v-if="hideUser == false"
                            class="guest-acc-fam-single"
                        >
                            <div>
                                <span>{{ user.name }}</span>
                                <img
                                    @click="hideUser = true"
                                    src="/storage/guestInvitation/Peach/acc-close.svg"
                                    alt=""
                                />
                            </div>
                            <div>Me</div>
                        </div>
                        <div
                            v-for="item in selectedFam"
                            :key="item.id"
                            class="guest-acc-fam-single"
                        >
                            <div>
                                <span>{{ item.familyname }}</span>
                                <img
                                    @click="addFamily(item, 'remove')"
                                    src="/storage/guestInvitation/Peach/acc-close.svg"
                                    alt=""
                                />
                            </div>
                            <div>{{ item.familyrelation }}</div>
                        </div>
                    </div>
                    <div class="guest-acc-fam-list">
                        <div
                            @click="addFamily(item, 'add')"
                            v-for="item in familyList"
                            :key="item.id"
                            class="guest-acc-fam-single"
                        >
                            <div>{{ item.familyname }}</div>
                            <div>{{ item.familyrelation }}</div>
                        </div>
                        <div
                            @click="hideUser = false"
                            v-if="hideUser"
                            class="guest-acc-fam-single"
                        >
                            <div>
                                <span>{{ user.name }}</span>
                            </div>
                            <div>Me</div>
                        </div>
                    </div>
                    <div class="guest-acc-submit">
                        <button
                            :disabled="disableLogFamily"
                            @click="sendLogFamily()"
                            type="button"
                        >
                            Send Details
                        </button>
                    </div>
                </div>
                <form
                    v-else-if="
                        ((privileges.guest_invitation.logisticsArrivalStatus ==
                            4 ||
                            privileges.guest_invitation
                                .logisticsArrivalStatus == 5) &&
                            privileges.guest_invitation
                                .hostLogisticsArrivalStatus == 0 &&
                            active == 'arrival') ||
                        ((privileges.guest_invitation
                            .logisticsDepartureStatus == 4 ||
                            privileges.guest_invitation
                                .logisticsDepartureStatus == 5) &&
                            privileges.guest_invitation
                                .hostLogisticsDepartureStatus == 0 &&
                            active == 'departure')
                    "
                    @submit.prevent="submitDetails"
                    class="log-form-cont"
                >
                    <div class="log-form">
                        <div class="form-group-custom">
                            <input
                                type="text"
                                onfocus="(this.type='date')"
                                class="form-date form-control"
                                :min="new Date().toISOString().split('T')[0]"
                                :placeholder="
                                    active == 'departure'
                                        ? 'Drop Date'
                                        : 'Pick up date'
                                "
                                v-model="formFeilds.date"
                            />
                        </div>
                        <div class="form-group-custom">
                            <input
                                type="text"
                                onfocus="(this.type='time')"
                                class="form-date form-control"
                                :placeholder="
                                    active == 'departure'
                                        ? 'Drop Time'
                                        : 'Pick up time'
                                "
                                v-model="formFeilds.time"
                            />
                        </div>
                        <div class="guest-log-total">
                            <span v-if="active == 'arrival'">
                                <span
                                    v-if="
                                        privileges.guest_invitation
                                            .logisticsArrivalStatus == 4
                                    "
                                >
                                    {{
                                        (typeof arrivalDetails?.memberCount ==
                                        "object"
                                            ? arrivalDetails?.memberCount.length
                                            : 0) + 1
                                    }}
                                </span>
                                <span
                                    v-if="
                                        privileges.guest_invitation
                                            .logisticsArrivalStatus == 5
                                    "
                                >
                                    {{
                                        typeof arrivalDetails?.memberCount ==
                                        "object"
                                            ? arrivalDetails?.memberCount.length
                                            : 0
                                    }}
                                </span>
                                <!-- {{
                                privileges.guest_invitation
                                    .logisticsArrivalStatus == 4
                                    ? arrivalDetails?.memberCount.length + 1
                                    : privileges.guest_invitation
                                          .logisticsArrivalStatus == 5
                                    ? arrivalDetails?.memberCount.length
                                    : 0
                            }}--></span
                            >
                            <span v-if="active == 'departure'">
                                <span
                                    v-if="
                                        privileges.guest_invitation
                                            .logisticsDepartureStatus == 4
                                    "
                                >
                                    {{
                                        (typeof departureDetails?.memberCount ==
                                        "object"
                                            ? departureDetails?.memberCount
                                                  .length
                                            : 0) + 1
                                    }}
                                </span>
                                <span
                                    v-if="
                                        privileges.guest_invitation
                                            .logisticsDepartureStatus == 5
                                    "
                                >
                                    {{
                                        typeof departureDetails?.memberCount ==
                                        "object"
                                            ? departureDetails?.memberCount
                                                  .length
                                            : 0
                                    }}
                                </span>
                                <!-- {{
                                privileges.guest_invitation
                                    .logisticsDepartureStatus == 4
                                    ? departureDetails?.memberCount.length + 1
                                    : privileges.guest_invitation
                                          .logisticsDepartureStatus == 5
                                    ? departureDetails?.memberCount.length
                                    : 0
                            }} -->
                            </span>
                            <img
                                src="/assets/guestInvi/et_profile-male.svg"
                                alt=""
                            />
                        </div>
                    </div>
                    <div class="form-group-custom">
                        <input
                            type="text"
                            class="form-date form-control"
                            :placeholder="
                                active == 'departure'
                                    ? 'Drop Location'
                                    : 'Pick Up Location'
                            "
                            v-model="formFeilds.location"
                        />
                    </div>
                    <div class="form-group-custom" style="margin-top: 10px">
                        <input
                            type="text"
                            class="form-date form-control"
                            placeholder="Any special request"
                            v-model="formFeilds.specialRequest"
                        />
                    </div>
                    <div class="form-group-custom" style="margin-top: 15px">
                        <button :disabled="disableDetailsForm" type="submit">
                            Next
                        </button>
                    </div>
                </form>
                <div
                    v-else-if="
                        ((privileges.guest_invitation.logisticsArrivalStatus ==
                            4 ||
                            privileges.guest_invitation
                                .logisticsArrivalStatus == 5) &&
                            privileges.guest_invitation
                                .hostLogisticsArrivalStatus == 1 &&
                            active == 'arrival') ||
                        ((privileges.guest_invitation
                            .logisticsDepartureStatus == 4 ||
                            privileges.guest_invitation
                                .logisticsDepartureStatus == 5) &&
                            privileges.guest_invitation
                                .hostLogisticsDepartureStatus == 1 &&
                            active == 'departure')
                    "
                    class="guest-acc-family-wait"
                >
                    <img src="/assets/guestInvi/log-circle.png" alt="" />
                    <h1 class="guest-invi-heading">Logistics</h1>
                    <h6 class="guest-invi-sub-heading">
                        Your Pick up and Drop details have been sent. You will
                        be notified when th logistics details were alotted to
                        you and your members
                    </h6>
                    <button @click="$emit('help')" type="button">
                        <img
                            class="filter-black"
                            src="/assets/guestInvi/clarity_help-line.svg"
                            alt=""
                        />
                        <span>Help</span>
                    </button>
                </div>
                <div
                    v-else-if="
                        ((privileges.guest_invitation.logisticsArrivalStatus ==
                            4 ||
                            privileges.guest_invitation
                                .logisticsArrivalStatus == 5) &&
                            privileges.guest_invitation
                                .hostLogisticsArrivalStatus == 2 &&
                            active == 'arrival') ||
                        ((privileges.guest_invitation
                            .logisticsDepartureStatus == 4 ||
                            privileges.guest_invitation
                                .logisticsDepartureStatus == 5) &&
                            privileges.guest_invitation
                                .hostLogisticsDepartureStatus == 2 &&
                            active == 'departure')
                    "
                    class="log-form-disp"
                >
                    <div class="log-form-disp-single">
                        <div>
                            <p
                                v-if="active == 'arrival'"
                                class="log-form-disp-single-head"
                            >
                                Arrival
                            </p>
                            <p
                                v-if="active == 'departure'"
                                class="log-form-disp-single-head"
                            >
                                Departure
                            </p>
                            <p
                                v-if="active == 'arrival'"
                                class="log-form-disp-single-content"
                            >
                                <span
                                    v-if="
                                        privileges.guest_invitation
                                            .logisticsArrivalStatus == 4
                                    "
                                >
                                    {{
                                        (typeof arrivalDetails?.memberCount ==
                                        "object"
                                            ? arrivalDetails?.memberCount.length
                                            : 0) + 1
                                    }}
                                </span>
                                <span
                                    v-if="
                                        privileges.guest_invitation
                                            .logisticsArrivalStatus == 5
                                    "
                                >
                                    {{
                                        typeof arrivalDetails?.memberCount ==
                                        "object"
                                            ? arrivalDetails?.memberCount.length
                                            : 0
                                    }} </span
                                >P,
                                {{
                                    new Date(
                                        arrivalDetails.date
                                    ).toLocaleDateString("en-us", {
                                        weekday: "long",
                                        day: "numeric",
                                        month: "long",
                                        year: "numeric",
                                    })
                                }}, {{ arrivalDetails.location }}
                            </p>
                            <p
                                v-if="active == 'departure'"
                                class="log-form-disp-single-content"
                            >
                                <span
                                    v-if="
                                        privileges.guest_invitation
                                            .logisticsDepartureStatus == 4
                                    "
                                >
                                    {{
                                        (typeof departureDetails?.memberCount ==
                                        "object"
                                            ? departureDetails?.memberCount
                                                  .length
                                            : 0) + 1
                                    }}
                                </span>
                                <span
                                    v-if="
                                        privileges.guest_invitation
                                            .logisticsDepartureStatus == 5
                                    "
                                >
                                    {{
                                        typeof departureDetails?.memberCount ==
                                        "object"
                                            ? departureDetails?.memberCount
                                                  .length
                                            : 0
                                    }} </span
                                >P,
                                {{
                                    new Date(
                                        departureDetails.date
                                    ).toLocaleDateString("en-us", {
                                        weekday: "long",
                                        day: "numeric",
                                        month: "long",
                                        year: "numeric",
                                    })
                                }}, {{ departureDetails.location }}
                            </p>
                        </div>
                        <img
                            v-if="active == 'arrival'"
                            class="filter-black"
                            src="/assets/guestInvi/carbon_arrival.svg"
                            alt=""
                        />
                        <img
                            v-if="active == 'departure'"
                            class="filter-black"
                            src="/assets/guestInvi/carbon_departure.svg"
                            alt=""
                        />
                    </div>
                    <div class="log-form-disp-double">
                        <div>
                            <p class="log-form-disp-single-head">
                                Mode of transportation
                            </p>
                            <p class="log-form-disp-single-content">
                                {{
                                    active == "arrival"
                                        ? arrivalDetails.transport
                                        : active == "departure"
                                        ? departureDetails.transport
                                        : ""
                                }}
                            </p>
                        </div>
                        <div>
                            <p class="log-form-disp-single-head">
                                Vehicle Number
                            </p>
                            <p class="log-form-disp-single-content">
                                {{
                                    active == "arrival"
                                        ? arrivalDetails.vehicleNo
                                        : active == "departure"
                                        ? departureDetails.vehicleNo
                                        : ""
                                }}
                            </p>
                        </div>
                    </div>
                    <div class="log-form-disp-double">
                        <div>
                            <p class="log-form-disp-single-head">
                                Vehicle incharge name
                            </p>
                            <p class="log-form-disp-single-content">
                                {{
                                    active == "arrival"
                                        ? arrivalDetails.driverName
                                        : active == "departure"
                                        ? departureDetails.driverName
                                        : ""
                                }}
                            </p>
                        </div>
                        <div>
                            <p class="log-form-disp-single-head">
                                Vehicle incharge phone number
                            </p>
                            <p class="log-form-disp-single-content">
                                {{
                                    active == "arrival"
                                        ? arrivalDetails.driverMobile
                                        : active == "departure"
                                        ? departureDetails.driverMobile
                                        : ""
                                }}
                            </p>
                        </div>
                    </div>
                    <div class="log-form-disp-double">
                        <div>
                            <p class="log-form-disp-single-head">
                                Logistics incharge name
                            </p>
                            <p class="log-form-disp-single-content">
                                {{
                                    active == "arrival"
                                        ? arrivalDetails.inchargeName
                                        : active == "departure"
                                        ? departureDetails.inchargeName
                                        : ""
                                }}
                            </p>
                        </div>
                        <div>
                            <p class="log-form-disp-single-head">
                                Logistics incharge phone number
                            </p>
                            <p class="log-form-disp-single-content">
                                {{
                                    active == "arrival"
                                        ? arrivalDetails.inchargeMobile
                                        : active == "departure"
                                        ? departureDetails.inchargeMobile
                                        : ""
                                }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <flashMessage :message="message"></flashMessage>
    </div>
</template>

<script>
import flashMessage from "../../../FlashMessage.vue";

export default {
    components: {
        flashMessage,
    },
    props: ["inviStatus", "familyLog", "user", "arrival", "departure"],
    data() {
        return {
            privileges: this.inviStatus,
            familyList: [...this.familyLog],
            selectedFam: [],
            disableAcceptLog: false,
            disableLogFamily: false,
            disableDetailsForm: false,
            hideUser: false,
            active: "arrival",
            formFeilds: {},
            arrivalDetails: this.arrival,
            departureDetails: this.departure,
            message: null,
            screenWidth: window.screen.width,
        };
    },
    methods: {
        toggle(type) {
            this.hideUser = false;
            this.selectedFam.forEach((item) => {
                this.familyList.push(item);
            });
            this.formFeilds = {};
            this.selectedFam = [];
            this.active = type;
        },
        addFamily(ele, type) {
            if (type == "add") {
                let index = this.familyList.findIndex((x) => x.id === ele.id);
                this.familyList.splice(index, 1);
                this.selectedFam.push(ele);
            }
            if (type == "remove") {
                let index = this.selectedFam.findIndex((x) => x.id === ele.id);
                this.selectedFam.splice(index, 1);
                this.familyList.push(ele);
            }
        },
        acceptLog(type) {
            let _this = this;
            if (this.privileges.guest_invitation.inviteStatus != 6) {
                return;
            }
            this.disableAcceptLog = true;
            let link = route("guestlogistics.privilege", [
                _this.user,
                _this.privileges,
            ]);
            let acc = 2;
            if (type == "decline") {
                acc = 3;
            }
            axios({
                method: "POST",
                url: link,
                data: { logistics: acc },
            })
                .then((response) => {
                    console.log(response);
                    _this.disableAcceptLog = false;
                    _this.$emit("log", response.data);
                    // _this.privileges = response.data;
                    if (type == "accept") {
                        _this.message = "Logistics Accepted!!";
                    }
                    if (type == "decline") {
                        _this.message = "Logistics Declined!!";
                    }

                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                })
                .catch((error) => {
                    console.log(error);
                    _this.disableAcceptLog = false;
                    _this.message = "Something went wrong!!";

                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                });
        },
        sendLogFamily() {
            let _this = this;
            if (this.privileges.guest_invitation.inviteStatus != 6) {
                return;
            }
            if (this.selectedFam.length == 0 && this.hideUser == true) {
                console.log("exit");
                return;
            }
            this.disableLogFamily = true;
            let link = route("guestlogistics.familyprivilege", [
                _this.user,
                _this.privileges,
            ]);
            let logList = [];
            this.selectedFam.forEach((item) => {
                logList.push(item.id);
            });
            console.log(logList);
            let acc = 4;
            if (_this.hideUser == true) {
                acc = 5;
            }
            let open = null;
            if (this.active == "arrival") {
                open = "arrival";
            }
            if (this.active == "departure") {
                open = "departure";
            }
            if (this.active != "arrival" && this.active != "departure") {
                return;
            }
            axios({
                method: "POST",
                url: link,
                data: { logistics: acc, list: logList, type: open },
            })
                .then((response) => {
                    _this.disableLogFamily = false;
                    _this.$emit("log", response.data[0]);
                    if (_this.active == "arrival") {
                        _this.arrivalDetails = response.data[1];
                    }
                    if (_this.active == "departure") {
                        _this.departureDetails = response.data[1];
                    }
                    //_this.accInfo = response.data[1];
                    // _this.privileges = response.data;
                    _this.message = "Logistics Details Sent!!";

                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                })
                .catch((error) => {
                    console.log(error);
                    _this.disableLogFamily = false;
                    _this.message = "Something went wrong!!";

                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                });
        },
        submitDetails() {
            let _this = this;
            this.disableDetailsForm = true;
            if (this.privileges.guest_invitation.inviteStatus != 6) {
                return;
            }
            let link = route("guestlogistics.arrival", [
                _this.user,
                _this.privileges,
            ]);
            if (this.active == "departure") {
                //console.log("sss");
                link = route("guestlogistics.departure", [
                    _this.user,
                    _this.privileges,
                ]);
            }
            axios({
                method: "POST",
                url: link,
                data: _this.formFeilds,
            })
                .then((response) => {
                    _this.disableDetailsForm = false;
                    _this.$emit("log", response.data[0]);
                    if (_this.active == "arrival") {
                        _this.arrivalDetails = response.data[1];
                    }
                    if (_this.active == "departure") {
                        _this.departureDetails = response.data[1];
                    }
                    //_this.accInfo = response.data[1];
                    // _this.privileges = response.data;
                    _this.message = "Logistics Details Sent!!";

                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                })
                .catch((error) => {
                    console.log(error);
                    _this.disableDetailsForm = false;
                    _this.message = "Something went wrong!!";

                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                });
        },
        getWidth() {
            this.screenWidth = window.screen.width;
        },
    },
    watch: {
        inviStatus: function (newVal, oldVal) {
            // watch it
            this.privileges = newVal;
        },
    },
    mounted() {
        this.$nextTick(() => {
            window.addEventListener("resize", this.getWidth);
        });
    },
};
</script>

<style scoped>
.guest-invi-acc-cont {
    padding: 67px 15px;
    width: 60%;
    position: relative;
    background: #ffffff;
    border-radius: 18px;
}
.guest-invi-acc-cont > div {
    width: 70%;
    margin: auto;
}

.guest-acc-accept {
    display: flex;
    flex-direction: column;
    justify-content: center;
}
.guest-invi-heading {
    font-family: "Roboto Serif 72pt SemiExpanded";
    font-style: normal;
    font-weight: 400;
    font-size: 30px;
    line-height: 30px;
    text-align: center;
    letter-spacing: 0.03em;
    color: #000000;
    text-shadow: 8px 10px 33px #ead1bb;
    margin-bottom: 15px;
}
.guest-invi-sub-heading {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 16px;
    line-height: 16px;
    /* identical to box height, or 100% */

    color: #525252;
    width: 100%;
    margin-bottom: 15px;
    text-align: center;
}
.guest-acc-accept > div {
    margin: 15px 0;
    text-align: center;
}
.guest-acc-accept > div > button {
    outline: none;
    border: none;
    padding: 12px 39px;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 13px;
    line-height: 20px;
    text-align: center;
    color: #ffffff;
}
.guest-acc-accept > div > button:nth-child(1) {
    background: #e9c4d0;
    border: 1px solid #e9c4d0;
    border-radius: 36px;
    margin-right: 10px;
}
.guest-acc-accept > div > button:nth-child(2) {
    background: #ffffff;
    border: 1px solid #e9c4d0;
    border-radius: 36px;
    color: #e9c4d0;
}
.guest-acc-accept > div > button:nth-child(1).active {
    color: #ffffff;
    background: linear-gradient(93.08deg, #feb36d 5.23%, #e8a87b 100.38%);
}
.guest-acc-accept > div > button:nth-child(2).active {
    background: #ffffff;
    color: #c4456f;
}
.guest-acc-family-add {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
.guest-acc-fam-add-cont {
    /* width: 70%; */
    margin-top: 15px;
}
.guest-acc-fam-input {
    background: #ffffff;
    border-radius: 8px;
    padding: 9px 12px;
    display: flex;
    flex-wrap: wrap;
    min-height: 73px;
}
.guest-acc-fam-list {
    padding: 9px 12px;
    display: flex;
    flex-wrap: wrap;
}
.guest-acc-fam-single {
    padding: 8px 12px;
    border: 1px solid #ffffff;
    border-radius: 73px;
    width: max-content;
    margin-right: 10px;
}
.guest-acc-fam-single > div:nth-child(1) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 16px;
    line-height: 16px;
    /* identical to box height, or 100% */

    letter-spacing: 0.03em;

    color: #545453;
}
.guest-acc-fam-single > div:nth-child(2) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 10px;
    line-height: 10px;
    /* identical to box height, or 100% */

    letter-spacing: 0.03em;

    color: #000000;
}
.guest-acc-fam-input > .guest-acc-fam-single {
    background: #fee0ce;
    border: 1px solid #ffffff;
    border-radius: 4px;
}
.guest-acc-fam-input > .guest-acc-fam-single > div {
    color: #000000;
    position: relative;
}
.guest-acc-fam-input > .guest-acc-fam-single > div:nth-child(1) > span {
    display: inline-block;
    margin-right: 55px;
}
.guest-acc-fam-input > .guest-acc-fam-single > div:nth-child(1) > img {
    position: absolute;
    right: 0;
    top: 50%;
    cursor: pointer;
}
.guest-acc-submit {
    display: flex;
    justify-content: center;
    margin: 10px 0;
}
.guest-acc-submit > button {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 13px;
    line-height: 20px;
    text-align: center;
    color: #ffffff;
    border: none;
    background: linear-gradient(93.08deg, #feb36d 5.23%, #e8a87b 100.38%);
    border-radius: 36px;
    padding: 12px 21px;
}
.guest-profile-link {
    text-decoration: none;
    background: linear-gradient(93.08deg, #feb36d 5.23%, #e8a87b 100.38%);
    border-radius: 36px;
    padding: 14px 20px;
    display: flex;
    justify-content: space-between;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 12.2841px;
    line-height: 18px;
    color: #ffffff;
    top: 0;
    right: 0;
    position: absolute;
}
.guest-acc-family-wait {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
.guest-acc-family-wait > img {
    width: 70px;
    height: 70px;
}
.guest-acc-family-wait > button {
    outline: none;
    border: none;
    background: linear-gradient(93.08deg, #feb36d 5.23%, #e8a87b 100.38%);
    border-radius: 36px;
    padding: 12px 15.5px;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 13px;
    line-height: 20px;
    text-align: center;
    color: #ffffff;
    width: max-content;
}
.guest-acc-family-wait > button > img {
    margin-right: 6px;
}
.guest-log-form-head {
    display: flex;
    width: 60%;
    margin: auto;
}
.guest-log-form-head > div:nth-child(1) {
    margin-right: 10px;
}
.guest-log-form-head > div {
    padding: 9px 20px;
    background: #ffffff;
    border: 0.8px solid rgba(0, 0, 0, 0.5);
    border-radius: 69px;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 10.4358px;
    line-height: 16px;
    text-align: center;
    color: #000000;
}
.filter-black {
    filter: invert(0%) sepia(30%) saturate(7453%) hue-rotate(157deg)
        brightness(20%) contrast(67%);
}
.guest-log-form-head > .active {
    background: linear-gradient(93.08deg, #feb36d 5.23%, #e8a87b 100.38%);
    border: 0.802752px solid #d8839f;
    color: #ffffff;
}
.log-form > .form-group-custom {
    width: 40%;
    margin-right: 7px;
}
.form-group-custom label {
    font-family: "Poppins", sans-serif;
    font-style: normal;
    font-weight: 500;
    font-size: 12px;
    line-height: 8px;
    margin-left: 10px;

    color: #000000;
}
.form-group-custom input,
.form-group-custom select {
    background: rgba(255, 255, 255, 0.4) !important;
    border: 0.8px solid rgba(0, 0, 0, 0.5);
    border-radius: 66px !important;
    padding: 12px 17px !important;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 300;
    font-size: 11.29px;
    line-height: 17px;

    color: #000000;
}
.form-group-custom select {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    background-image: url(/assets/icon-down.svg);
    background-repeat: no-repeat;
    background-position: 98%;
    background-size: 20px;
}
.form-group-custom input::placeholder {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 300;
    font-size: 11.29px;
    line-height: 17px;

    color: #000000;
}
.form-group-custom button {
    border: none;
    outline: none;
    background: linear-gradient(93.08deg, #feb36d 5.23%, #e8a87b 100.38%);
    border-radius: 36px;
    display: inline-block;
    padding: 11px;
    font-family: "Poppins", sans-serif;
    font-style: normal;
    font-weight: 600;
    font-size: 9.10182px;
    line-height: 14px;
    text-align: center;
    box-shadow: none !important;
    color: #ffffff;
    width: 100%;
}
.log-form {
    display: flex;
    margin: 15px auto;
    justify-content: space-between;
}
.guest-log-total {
    background: rgba(255, 255, 255, 0.4);
    border: 0.8px solid rgba(0, 0, 0, 0.5);
    border-radius: 55px;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 11.29px;
    line-height: 17px;
    padding: 12px 17px;
    color: #000000;
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: max-content;
}
.guest-log-total > span {
    margin-right: 16px;
}
.log-form-disp-single {
    display: flex;
    justify-content: space-between;
    background: #ffffff;
    border: 0.8px solid rgba(0, 0, 0, 0.5);
    border-radius: 65px;
    padding: 14px 16px;
}
.log-form-disp {
    margin-top: 10px;
}
.log-form-disp-single > div {
    width: 80%;
}
.log-form-disp-single-head {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 9.35172px;
    line-height: 14px;
    margin-bottom: 7px;
    color: #000000;
}
.log-form-disp-single-content {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 14px;
    line-height: 21px;
    margin-bottom: 0;
    color: #333333;
}
.log-form-disp-double {
    display: flex;
    justify-content: space-between;
    margin-top: 10px;
}
.log-form-disp-double > div {
    background: #ffffff;
    border: 0.8px solid rgba(0, 0, 0, 0.5);
    border-radius: 65px;
    padding: 14px 16px;
    width: 49%;
}
.guest-log-room-disp {
    position: relative;
    width: 100%;
}
.guest-log-room-disp > div > button {
    outline: none;
    border: 1px solid #000000;
    border-radius: 10px;
    padding: 12px 15.5px;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 13px;
    line-height: 20px;
    text-align: center;
    color: #000000;
    width: max-content;
    margin-left: 15px;
    background-color: inherit;
}
@media screen and (max-width: 1200px) {
    .guest-invi-acc-cont > div > div {
        width: 100% !important;
    }
}
@media screen and (max-width: 992px) {
    .guest-invi-acc-cont {
        width: 80% !important;
    }
}
@media screen and (max-width: 768px) {
    .guest-invi-acc-cont > div {
        width: 100% !important;
    }
    .guest-invi-acc-cont > div > div {
        width: 100% !important;
    }
    /* .guest-log-form-head{
         width: 100% !important;
    } */
}
@media screen and (max-width: 576px) {
    .log-form {
        flex-wrap: wrap;
        margin-bottom: 0;
    }
    .log-form > div {
        width: 100% !important;
        margin-bottom: 10px;
    }
    .form-group-custom {
        margin-right: 0 !important;
    }
    .guest-invi-acc-cont {
        width: 90% !important;
    }
    .guest-invi-acc-cont > div {
        position: relative;
        z-index: 999;
    }
    .guest-invi-acc-cont > img:nth-child(1) {
        z-index: 9;
    }
    .guest-log-room-disp .guest-invi-heading {
        text-align: left !important;
    }
}
</style>
