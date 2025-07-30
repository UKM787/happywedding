<template>
    <div
        class="guest-invi-acc-cont"
        v-if="
            privileges.guest_invitation.logistics != 0 &&
            (privileges.guest_invitation.logisticsArrivalStatus != 3 ||
                privileges.guest_invitation.logisticsDepartureStatus != 3)
        "
    >
        <img src="/assets/guestInvi/cera-back.png" alt="" />
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
        <div v-else style="width: 60%; margin: auto">
            <div>
                <div
                    v-if="
                        (active == 'arrival' &&
                            (privileges.guest_invitation
                                .logisticsArrivalStatus == 2 || editFamilyMembers)) && privileges.guest_invitation
                                .hostLogisticsArrivalStatus != 2 ||
                        (active == 'departure' &&
                            (privileges.guest_invitation
                                .logisticsDepartureStatus == 2 || editFamilyMembers)) && privileges.guest_invitation
                                .hostLogisticsDepartureStatus != 2
                    "
                >
                    <div style="position: relative; width: 100%">
                        <h1 class="guest-invi-heading">Logistics</h1>
                        <!-- <a
                            class="guest-profile-link"
                            :href="route('guestprofile.index', user)"
                        >
                            <img
                                v-if="screenWidth > 768"
                                style="margin-right: 10px"
                                src="/assets/guestInvi/Group-1689.svg"
                                alt=""
                            />
                            <img
                                v-else
                                src="/assets/miscellenous/user-plus.svg"
                                alt=""
                            />
                            <span v-if="screenWidth > 768">Add Members</span>
                        </a> -->
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
                            (privileges.guest_invitation
                                .hostLogisticsArrivalStatus == 0 || editDetails) &&
                            active == 'arrival' && privileges.guest_invitation.hostLogisticsArrivalStatus != 2) ||
                        ((privileges.guest_invitation
                            .logisticsDepartureStatus == 4 ||
                            privileges.guest_invitation
                                .logisticsDepartureStatus == 5) &&
                            (privileges.guest_invitation
                                .hostLogisticsDepartureStatus == 0 || editDetails) &&
                            active == 'departure' && privileges.guest_invitation.hostLogisticsDepartureStatus != 2)
                    "
                >
                    <h1 class="guest-invi-heading">Logistics </h1>
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
                                src="/assets/guestInvi/Group-1702.svg"
                                alt=""
                            />
                        </button>
                        <button @click="$emit('help')" type="button">
                            <img
                                src="/assets/guestInvi/clarity_help-line.svg"
                                alt=""
                            />
                            <span>Help</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- <div v-if="active == 'arrival'">
                <div
                    v-if="
                        privileges.guest_invitation.logisticsArrivalStatus == 2
                    "
                >
                    <div style="position: relative; width: 100%">
                        <h1 class="guest-invi-heading">Logistics</h1>
                        <a
                            class="guest-profile-link"
                            :href="route('guestprofile.index', user)"
                        >
                            <img
                                style="margin-right: 10px"
                                src="/assets/guestInvi/Group-1689.svg"
                                alt=""
                            />
                            <span>Add Members</span>
                        </a>
                    </div>
                    <h6 class="guest-invi-sub-heading">
                        Add Members Detatils to provide accomodation service
                    </h6>
                </div>
                <div
                    v-else-if="
                        (privileges.guest_invitation.logisticsArrivalStatus ==
                            4 ||
                            privileges.guest_invitation
                                .logisticsArrivalStatus == 5) &&
                        privileges.guest_invitation
                            .hostLogisticsArrivalStatus == 0
                    "
                >
                    <h1 class="guest-invi-heading">Logistics</h1>
                    <h6 class="guest-invi-sub-heading">
                        Add your Arrival details to provide you logistics
                        service
                    </h6>
                </div>
            </div>
            <div v-if="active == 'departure'">
                <div
                    v-if="
                        privileges.guest_invitation.logisticsDepartureStatus ==
                        2
                    "
                >
                    <div style="position: relative; width: 100%">
                        <h1 class="guest-invi-heading">Logistics</h1>
                        <a
                            class="guest-profile-link"
                            :href="route('guestprofile.index', user)"
                        >
                            <img
                                style="margin-right: 10px"
                                src="/assets/guestInvi/Group-1689.svg"
                                alt=""
                            />
                            <span>Add Members</span>
                        </a>
                    </div>
                    <h6 class="guest-invi-sub-heading">
                        Add Members Detatils to provide accomodation service
                    </h6>
                </div>
                <div
                    v-else-if="
                        (privileges.guest_invitation.logisticsDepartureStatus ==
                            4 ||
                            privileges.guest_invitation
                                .logisticsDepartureStatus == 5) &&
                        privileges.guest_invitation
                            .hostLogisticsDepartureStatus == 0
                    "
                >
                    <h1 class="guest-invi-heading">Logistics</h1>
                    <h6 class="guest-invi-sub-heading">
                        Add your Departure details to provide you logistics
                        service
                    </h6>
                </div>
            </div> -->

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
                            (privileges.guest_invitation
                                .logisticsArrivalStatus == 2 || editFamilyMembers)) && privileges.guest_invitation
                                .hostLogisticsArrivalStatus != 2 ||
                        (active == 'departure' &&
                            (privileges.guest_invitation
                                .logisticsDepartureStatus == 2 || editFamilyMembers)) && privileges.guest_invitation
                                .hostLogisticsDepartureStatus != 2
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
                                    src="/assets/guestInvi/close-fam-click.svg"
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
                                    src="/assets/guestInvi/close-fam-click.svg"
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
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    {{ item.familyname }}
                                </div>
                                <div class="d-flex" style="margin-left: 20px;">
                                    <img  @click.stop="$emit('editMember', item)"  width="16px" height="16px" src="/assets/guestInvi/edit.svg" alt="" style="cursor: pointer;">
                                    <img @click.stop="$emit('deleteMember', item.id)" width="16px" height="16px" src="/assets/guestInvi/trash-2.svg" alt="" style="cursor: pointer;">
                                </div>
                            </div>
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
                        <button @click="$emit('addMember');" type="button" class="add-member-btn">
                            <img
                            v-if="screenWidth > 768"
                            style="margin-right: 10px"
                            src="/assets/guestInvi/Group-1689.svg"
                            alt=""
                            />
                            <img
                                v-else
                                src="/assets/miscellenous/user-plus.svg"
                                alt=""
                            />
                            <span v-if="screenWidth > 768">Add Members</span>
                        </button> 
                        <button
                            :disabled="disableLogFamily"
                            @click="sendLogFamily()"
                            type="button"
                        >
                            Continue
                        </button>
                    </div>
                </div>
                <form
                    v-else-if="
                        ((privileges.guest_invitation.logisticsArrivalStatus ==
                            4 ||
                            privileges.guest_invitation
                                .logisticsArrivalStatus == 5) &&
                            (privileges.guest_invitation
                                .hostLogisticsArrivalStatus == 0 || editDetails) &&
                            active == 'arrival' && privileges.guest_invitation.hostLogisticsArrivalStatus != 2) ||
                        ((privileges.guest_invitation
                            .logisticsDepartureStatus == 4 ||
                            privileges.guest_invitation
                                .logisticsDepartureStatus == 5) &&
                            (privileges.guest_invitation
                                .hostLogisticsDepartureStatus == 0 || editDetails) &&
                            active == 'departure' && privileges.guest_invitation.hostLogisticsDepartureStatus != 2)
                    "
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
                        <button :disabled="disableDetailsForm" type="button" @click="confirmSend=true">
                            Next
                        </button>
                        <button @click="refillForm(false);editFamilyMembers = true" type="button">
                            <img
                                style="margin-right:10px"
                                src="/assets/guestInvi/edit-3.png"
                                alt=""
                            />
                            Edit Members
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
                            src="/assets/guestInvi/clarity_help-line.svg"
                            alt=""
                        />
                        <span>Help</span>
                    </button>
                    <button class="mt-1" @click="refillForm(true)" type="button">
                        <img
                            style="margin-right:10px"
                            src="/assets/guestInvi/edit-3.png"
                            alt=""
                        />
                        Edit Details
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
                            src="/assets/guestInvi/carbon_arrival.svg"
                            alt=""
                        />
                        <img
                            v-if="active == 'departure'"
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
        <div v-if="confirmSend" class="guest-acc-fam-submit-form-cont">
            <div class="guest-acc-fam-submit-form">
                <div class="pup-up-head-cont">
                    <img @click="confirmSend = false" src="/assets/guestInvi/13.png" alt="">
                    <div></div>
                    <img src="/assets/guestInvi/abc.png" alt="">
                </div>
                <div class="pup-up-end-cont">
                    <h1>Send Details</h1>
                    <p>Are you sure you want to send details? This process can’t be undone</p>
                    <div>
                        <button @click="confirmSend = false" type="button">Discard</button>
                        <button :disabled="disableAccFamily"
                        @click="submitDetails()" type="button">Send</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import flashMessage from "../../../FlashMessage.vue";

export default {
    components: {
        flashMessage,
    },
    props: ["inviStatus", "familyLog", "user", "arrival", "departure"],
    computed: {
        familyList() {
            let arr = [];
            if(this.editFamilyMembers == true){
                let customList = [...this.familyLog];
                return customList.filter(element2 => !this.selectedFam.some(element1 => element1.id === element2.id));
            }else{
                this.familyLog.forEach((item) => {
                    arr.push(item);
                });
                return arr;
            }
        }
    },
    data() {
        return {
            confirmSend: false,
            confirmSendTwo: false,
            confirmCancel: false,
            editDetails: false,
            editFamilyMembers: false,
            privileges: this.inviStatus,
            //familyList: [...this.familyLog],
            selectedFam: [],
            disableAcceptLog: false,
            disableLogFamily: false,
            disableDetailsForm: false,
            hideUser: false,
            active: "arrival",
            formFeilds: {
                date: null,
                time: null,
                location: null,
                specialRequest: null,
            },
            // formFeilds: {
            //     date: this.active == 'arrival' ? this.arrivalDetails.date : this.active == 'departure' ? this.departureDetails.date : null,
            //     time: this.active == 'arrival' ? this.arrivalDetails.time : this.active == 'departure' ? this.departureDetails.time : null,
            //     location: this.active == 'arrival' ? this.arrivalDetails.location : this.active == 'departure' ? this.departureDetails.location : null,
            //     specialRequest:this.active == 'arrival' ? this.arrivalDetails.specialRequest : this.active == 'departure' ? this.departureDetails.specialRequest : null,
            // },
            arrivalDetails: this.arrival,
            departureDetails: this.departure,
            message: null,
            screenWidth: window.screen.width,
        };
    },
    methods: {
        refillForm(bool){
            let _this = this;
            this.selectedFam = [];
            //this.familyList = [...this.familyLog];
            this.familyList.splice(0, _this.familyList.length);
            this.familyLog.forEach((item) => {
                _this.familyList.push(item);
            });
            let customList = [..._this.familyLog];
            //console.log(this.selectedFam, this.familyList, customList);
            //return;
            if(this.active == 'arrival'){
                if(this.arrivalDetails.date){
                    this.formFeilds.date = new Date(this.arrivalDetails.date).toISOString().split('T')[0];
                }else{
                    this.formFeilds.date = null;
                }
                
                this.formFeilds.time = this.arrivalDetails.time;
                this.formFeilds.location = this.arrivalDetails.location;
                this.formFeilds.specialRequest = this.arrivalDetails.specialRequest;
                if(this.privileges?.guest_invitation?.logisticsArrivalStatus == 4){
                    this.hideUser = false;
                }else{
                    this.hideUser = true;
                }
                

                for(let i = 0 ; i<customList.length; i++){
                    if(_this.arrivalDetails.memberCount.includes(customList[i].id)){
                        _this.addFamily(customList[i], 'add');
                    }
                }
                //enter looop for fam member disp
            }
            if(this.active == 'departure'){
                if(this.departureDetails.date){
                    this.formFeilds.date = new Date(this.departureDetails.date).toISOString().split('T')[0];
                }else{
                    this.formFeilds.date = null;
                }
                this.formFeilds.time = this.departureDetails.time;
                this.formFeilds.location = this.departureDetails.location;
                this.formFeilds.specialRequest = this.departureDetails.specialRequest;
                if(this.privileges?.guest_invitation?.logisticsDepartureStatus == 4){
                    this.hideUser = false;
                }else{
                    this.hideUser = true;
                }
                for(let i = 0 ; i<customList.length; i++){
                    if(_this.departureDetails.memberCount.includes(customList[i].id)){
                        _this.addFamily(customList[i], 'add');
                    }
                }
            }
            this.editDetails = bool;

        },
        toggle(type) {
            this.hideUser = false;
            this.selectedFam.forEach((item) => {
                this.familyList.push(item);
            });
            this.formFeilds = {};
            this.selectedFam = [];
            this.active = type;
            if(this.editDetails == true){
                this.refillForm(true);
            }else{
                this.refillForm(false);
            }
            
        },
        addFamily(ele, type) {
            if (type == "add") {
                //console.log(this.familyList);
                let index = this.familyList.findIndex((x) => x.id == ele.id);
                this.familyList.splice(index, 1);
                this.selectedFam.push(ele);
                return;
            }
            if (type == "remove") {
                let index = this.selectedFam.findIndex((x) => x.id == ele.id);
                this.selectedFam.splice(index, 1);
                this.familyList.push(ele);
                return;
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
            //_this.message = '     ';
            if (this.privileges.guest_invitation.inviteStatus != 6) {
                return;
            }
            if (this.selectedFam.length == 0 && this.hideUser == true) {
                _this.message = "Select Family members to proceed!"
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
                    if(_this.editDetails == true){
                        _this.confirmSendTwo = true;
                    }
                    _this.confirmSend = false;
                    _this.editDetails = false;
                    _this.editFamilyMembers = false;
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
                    if(_this.editDetails == true){
                        _this.confirmSendTwo = true;
                    }
                    _this.confirmSend = false;
                    _this.editDetails = false;
                    _this.editFamilyMembers = false;
                    _this.disableLogFamily = false;
                    _this.$emit("log", response.data[0]);
                    _this.disableDetailsForm = false;
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
/* pupup */

.guest-acc-fam-submit-form-cont {
    width: 100% !important;
    height: 100%;
    position: fixed;
    background: rgba(0, 0, 0, 0.50);
    z-index: 999999999999999;
    top: 0;
    left: 0;
    overflow-y: auto;
}
.guest-acc-fam-submit-form{
    border-radius: 8.388px;
    background: #FFF;
    box-shadow: 0px 3.35501px 50.3252px 0px rgba(0, 0, 0, 0.25);
    width: 100%;
    max-width: 450px;
    /* display: flex;
    justify-content: center;
    flex-direction: column;
    align-items: center; */
    margin-left:auto;
    margin-right:auto;
    margin-top:10%;
    margin-bottom:5%;
}
.pup-up-head-cont {
    position: relative;
    padding-bottom: 100px;
    /* margin-bottom: 30px; */
    display: flex;
    justify-content: center;
}
.pup-up-head-cont > img:nth-child(1) {
    width: 40px;
    height: 40px;
    position: absolute;
    top: 22px;
    right: 30px;
}
.pup-up-head-cont > div {
    background: #F8E0FF;
    width: 100%;
    max-width: 450px;
    height: 153px;
}
.pup-up-head-cont > img:nth-child(3) {
    position: absolute;
    bottom: 0;
    width:248px;
    height: 248px;
}
.pup-up-end-cont {
    padding: 50px;
    padding-top: 20px;
    text-align: center;
}
.pup-up-end-cont > h1 {
    color: #000;
    font-family: Poppins;
    font-size: 22.247px;
    font-style: normal;
    font-weight: 600;
    line-height: normal;
}

.pup-up-end-cont > p {
    color: #525252;
    text-align: center;
    font-family: Poppins;
    font-size: 11.863px;
    font-style: normal;
    font-weight: 500;
    line-height: normal;
}
.pup-up-end-cont > div {
    display: flex;
    justify-content: center;
    align-items: center;

}
.pup-up-end-cont > div > button:nth-child(1){
    color: #CC0202;
    font-family: Poppins;
    font-size: 11.924px;
    font-style: normal;
    font-weight: 500;
    line-height: normal;
    border: none;
    outline: none;
    background-color: inherit;
}
.pup-up-end-cont > div > button:nth-child(2){
    border-radius: 11px;
    background: #461952;
    padding: 10px 33px;
    color: #FFF;
    font-family: Mulish;
    font-size: 12.581px;
    font-style: normal;
    font-weight: 800;
    line-height: normal;
    margin-left: 10px;
}

.new-pupop{
    border-radius: 11.852px;
    background: #FFF;
    max-width:431px;
    padding:30px;
    text-align:center;
    position:relative;
}
.new-pupop > span {
    display: inline-block;
    border-radius: 78.225px;
    background: #C4456F;
    width: 78.225px;
    height: 78.225px;
    padding: 21.623px 20.988px 20.987px 21.623px;
    position:absolute;
    top: -50px;
    left:43%;
}
.new-pupop > h1 {
    color: #000;
    font-family: Poppins;
    font-size: 23.705px;
    font-style: normal;
    font-weight: 600;
    line-height: normal;
    margin-top:20px;
}
.new-pupop > p{
    color: #000;
    text-align: center;
    font-family: Poppins;
    font-size: 14.534px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
}
.new-pupop > button {
    border-radius: 7.77px;
    border: 1.295px solid #BDBDBD;
    background-color:#ffffff;
    outline: none;
    color: #484848;
    text-align: center;
    font-family: Poppins;
    font-size: 14px;
    font-style: normal;
    font-weight: 600;
    line-height: normal;
    padding:15px;
    width:100%;
}

/* popup */
.add-member-btn{
    border-radius: 6.142px;
    border: 1.228px solid #C4456F;
    background-color: white !important;
    color: #C4456F !important;
    margin-right: 10px;
}
.guest-invi-acc-cont {
    padding: 67px 15px;
    position: relative;
}
.guest-invi-acc-cont > div {
    width: 70%;
    margin: auto;
}
.guest-invi-acc-cont > img:nth-child(1) {
    position: absolute;
    top: 0;
    left: 0;
    width: 300px;
    height: 259px;
}
.guest-acc-accept {
    display: flex;
    flex-direction: column;
    justify-content: center;
}
.guest-invi-heading {
    font-family: "Perpetua";
    font-style: normal;
    font-weight: 700;
    font-size: 29.5136px;
    line-height: 34px;
    text-align: center;
    color: #333333;
    margin-bottom: 32px;
}
.guest-invi-sub-heading {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 16.5337px;
    line-height: 22px;
    color: #000000;
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
    border-radius: 10px;
    margin-right: 10px;
}
.guest-acc-accept > div > button:nth-child(2) {
    background: #ffffff;
    border: 1px solid #e9c4d0;
    border-radius: 10px;
    color: #e9c4d0;
}
.guest-acc-accept > div > button:nth-child(1).active {
    color: #ffffff;
    background: #c4456f;
    border: 1px solid #d8839f;
    border-radius: 10px;
}
.guest-acc-accept > div > button:nth-child(2).active {
    background: #ffffff;
    color: #c4456f;
    border: 1px solid #d8839f;
    border-radius: 10px;
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
    border: 0.5px solid #b4b4b4;
    border-radius: 6px;
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
    background: #f3f3f3;
    border-radius: 5px;
    width: max-content;
    margin-right: 10px;
}
.guest-acc-fam-single > div:nth-child(1) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 16px;
    line-height: 24px;
    color: #000000;
}

.guest-acc-fam-single > div:nth-child(1) > div:nth-child(1) {
    width: 100px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.guest-acc-fam-single > div:nth-child(2) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 13px;
    line-height: 20px;
    color: #828282;
}
.guest-acc-fam-input > .guest-acc-fam-single {
    background: #ffe9ee;
    border: 0.5px solid #c4456f;
    border-radius: 5px;
}
.guest-acc-fam-input > .guest-acc-fam-single > div {
    color: #c4456f;
    position: relative;
}
.guest-acc-fam-input > .guest-acc-fam-single > div:nth-child(1) > span {
    display: inline-block;
    width: 100px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
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
    background: #c4456f;
    border: 1px solid #d8839f;
    border-radius: 10px;
    padding: 12px 21px;
}
.guest-profile-link {
    text-decoration: none;
    border: 1.22841px solid #e3e8ee;
    border-radius: 6.14203px;
    padding: 14px 20px;
    display: flex;
    justify-content: space-between;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 12.2841px;
    line-height: 18px;
    color: #000000;
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
    border: 1px solid #d8839f;
    border-radius: 10px;
    padding: 12px 15.5px;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 13px;
    line-height: 20px;
    text-align: center;
    color: #c4456f;
    background-color: white;
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
    background: #ffe9ee;
    border: 0.802752px solid #d8839f;
    border-radius: 40.1376px;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 10.4358px;
    line-height: 16px;
    text-align: center;
    color: #c4456f;
}
.guest-log-form-head > .active {
    background: #c4456f;
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
    border: 0.5px solid #f7dae4 !important;
    border-radius: 8px !important;
    padding: 12px 17px !important;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 300;
    font-size: 11.29px;
    line-height: 17px;

    color: #828282;
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

    color: #828282;
}
.form-group-custom button:nth-child(1) {
    border: none;
    outline: none;
    background: #c4456f;
    border-radius: 7.72px;
    width: 48%;
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
    /* width: 100%; */
}
.form-group-custom button:nth-child(2){
    border: none;
    outline: none;
    font-family: "Poppins", sans-serif;
    font-style: normal;
    font-weight: 600;
    font-size: 9.10182px;
    line-height: 14px;
    text-align: center;
    color: #C4456F !important;
    background: white;
    border: 1px solid #d8839f;
    border-radius: 10px;
    padding: 9px 21px;
    width:48%;

}
.log-form {
    display: flex;
    margin: 15px auto;
    justify-content: space-between;
}
.guest-log-total {
    background: rgba(255, 255, 255, 0.4);
    border: 0.5px solid #f7dae4;
    border-radius: 8px;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 11.29px;
    line-height: 17px;
    padding: 12px 17px;
    color: #c4456f;
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
    border: 0.528708px solid #e9e9e9;
    border-radius: 5.28708px;
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
    border: 0.528708px solid #e9e9e9;
    border-radius: 5.28708px;
    padding: 14px 16px;
    width: 49%;
}
.guest-log-room-disp {
    position: relative;
    width: 100%;
}
.guest-log-room-disp > div > button {
    outline: none;
    border: 1px solid #d8839f;
    border-radius: 10px;
    padding: 12px 15.5px;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 13px;
    line-height: 20px;
    text-align: center;
    color: #c4456f;
    width: max-content;
    margin-left: 15px;
    background-color: inherit;
}
@media screen and (max-width: 1200px) {
    .guest-invi-acc-cont > div > div {
        width: 100% !important;
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
