<template>
    <div
        class="guest-invi-acc-cont container-lg"
        v-if="
            privileges.guest_invitation.accommodation != 0 &&
            privileges.guest_invitation.accommodationStatus != 3
        "
    >
        <div
            v-if="privileges.guest_invitation.accommodationStatus == 1"
            class="guest-acc-accept"
        >
            <h1 class="guest-invi-heading">Accomodation</h1>
            <h6 class="guest-invi-sub-heading">
                Accept Invitation to Accept accomodation
            </h6>
            <div>
                <button
                    @click="acceptAcc('accept')"
                    :class="{
                        active: privileges.guest_invitation.inviteStatus == 6,
                    }"
                    type="button"
                    :disabled="disableAcceptAcc"
                >
                    Accept
                </button>
                <button
                    @click="acceptAcc('decline')"
                    :class="{
                        active: privileges.guest_invitation.inviteStatus == 6,
                    }"
                    type="button"
                    :disabled="disableAcceptAcc"
                >
                    Decline
                </button>
            </div>
        </div>
        <div
            v-else-if="privileges.guest_invitation.accommodationStatus == 2"
            class="guest-acc-family-add"
        >
            <div style="position: relative; width: 100%">
                <h1 class="guest-invi-heading">Accomodation</h1>
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
                Add Members Detatils to provide accomodation service
            </h6>
            <div class="guest-acc-fam-add-cont">
                <div class="guest-acc-fam-input">
                    <div v-if="hideUser == false" class="guest-acc-fam-single">
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
                        :disabled="disableAccFamily"
                        @click="sendAccFamily()"
                        type="button"
                    >
                        Send Details
                    </button>
                </div>
            </div>
        </div>
        <div
            v-else-if="
                (privileges.guest_invitation.accommodationStatus == 4 ||
                    privileges.guest_invitation.accommodationStatus == 5) &&
                privileges.guest_invitation.hostAccommodationStatus == 0
            "
            class="guest-acc-family-wait"
        >
            <img src="/storage/guestInvitation/Peach/acc-pic.png" alt="" />
            <h1 class="guest-invi-heading">Accomodation</h1>
            <h6 class="guest-invi-sub-heading">
                Members Details has been sent. You will be notified when the
                Accomodation details were allotted to you and your members
            </h6>
            <button @click="$emit('help')" type="button">
                <img
                    src="/storage/guestInvitation/Peach/help-mark.svg"
                    alt=""
                />
                <span>Help</span>
            </button>
        </div>
        <div
            v-else-if="
                (privileges.guest_invitation.accommodationStatus == 4 ||
                    privileges.guest_invitation.accommodationStatus == 5) &&
                privileges.guest_invitation.hostAccommodationStatus == 1
            "
            class="guest-acc-room-container"
        >
            <div class="guest-acc-room-head">
                <h1 class="guest-invi-heading">Accomodation</h1>
                <div style="position: absolute; right: 0; top: 0">
                    <button>
                        <!-- <a :href="route('guestacc.export', [user, inviStatus])"
                            ><img src="/assets/guestInvi/Group-1702.svg" alt=""
                        /></a> -->
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
                        <span v-if="screenWidth > 768">Help</span>
                    </button>
                </div>
                <div class="guest-invi-room-all">
                    <div class="guest-invi-room-head">
                        <span style="width: 20%">Name</span>
                        <span style="width: 20%">Phone Number</span>
                        <span style="width: 20%">Hotel</span>
                        <span style="width: 20%">Block</span>
                        <span style="width: 10%">Floor</span>
                        <span style="width: 10%">Room.No</span>
                    </div>
                    <div
                        v-if="
                            privileges.guest_invitation.accommodationStatus == 4
                        "
                        class="guest-invi-room-single"
                    >
                        <span style="width: 20%">{{ user.name }}</span>
                        <span style="width: 20%">{{ user.mobile }}</span>
                        <span style="width: 20%">{{
                            guestAccommodationInfo?.hotelName
                        }}</span>
                        <span style="width: 20%">{{
                            guestAccommodationInfo?.block
                        }}</span>
                        <span style="width: 10%">{{
                            guestAccommodationInfo?.floor
                        }}</span>
                        <span style="width: 10%">{{
                            guestAccommodationInfo?.roomno
                        }}</span>
                    </div>
                    <div
                        v-for="(item, index) in accInfo"
                        :key="index"
                        class="guest-invi-room-single"
                    >
                        <span style="width: 20%">{{
                            item.family.familyname
                        }}</span>
                        <span style="width: 20%">{{
                            item.family.familymobile
                        }}</span>
                        <span style="width: 20%">{{ item.hotelName }}</span>
                        <span style="width: 20%">{{ item.block }}</span>
                        <span style="width: 10%">{{ item.floor }}</span>
                        <span style="width: 10%">{{ item.roomno }}</span>
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
    props: [
        "inviStatus",
        "familyAcc",
        "user",
        "accomodationInfo",
        "guestAccommodationInfo",
    ],
    data() {
        return {
            privileges: this.inviStatus,
            familyList: [...this.familyAcc],
            selectedFam: [],
            disableAcceptAcc: false,
            disableAccFamily: false,
            hideUser: false,
            accInfo: this.accomodationInfo,
            message: null,
            screenWidth: window.screen.width,
        };
    },
    methods: {
        addFamily(ele, type) {
            if (type == "add") {
                let index = this.familyList.findIndex((x) => x.id == ele.id);
                this.familyList.splice(index, 1);
                this.selectedFam.push(ele);
            }
            if (type == "remove") {
                let index = this.selectedFam.findIndex((x) => x.id == ele.id);
                this.selectedFam.splice(index, 1);
                this.familyList.push(ele);
            }
        },
        acceptAcc(type) {
            let _this = this;
            if (this.privileges.guest_invitation.inviteStatus != 6) {
                return;
            }
            this.disableAcceptAcc = true;
            let link = route("guestprivilege.update", [
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
                data: { accommodation: acc },
            })
                .then((response) => {
                    console.log(response);
                    _this.disableAcceptAcc = false;
                    _this.$emit("acc", response.data);
                    // _this.privileges = response.data;
                    if (type == "accept") {
                        _this.message = "Accomodation Accepted!!";
                    }
                    if (type == "decline") {
                        _this.message = "Accomodation Declined!!";
                    }

                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                })
                .catch((error) => {
                    console.log(error);
                    _this.disableAcceptAcc = false;
                    _this.message = "Something went wrong!!";

                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                });
        },
        sendAccFamily() {
            let _this = this;
            if (this.privileges.guest_invitation.inviteStatus != 6) {
                return;
            }
            if (this.selectedFam.length == 0 && this.hideUser == true) {
                return;
            }
            this.disableAccFamily = true;
            let link = route("guestfamilyprivilege.update", [
                _this.user,
                _this.privileges,
            ]);
            let acc = 4;
            if (_this.hideUser == true) {
                acc = 5;
            }
            axios({
                method: "POST",
                url: link,
                data: { accommodation: acc, list: _this.selectedFam },
            })
                .then((response) => {
                    _this.disableAccFamily = false;
                    _this.$emit("acc", response.data[0]);
                    _this.accInfo = response.data[1];
                    // _this.privileges = response.data;
                    _this.message = "Accomodation Details Sent!!";

                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                })
                .catch((error) => {
                    console.log(error);
                    _this.disableAccFamily = false;
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
    position: relative;
    background-color: #ffffff;
    background: rgba(255, 255, 255, 0.4);
    backdrop-filter: blur(17px);
    width: 95%;
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
    width: 70%;
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
.guest-acc-family-wait > button > img,
.guest-acc-room-head > div > button:nth-child(2) > img {
    margin-right: 6px;
}
.guest-acc-room-head {
    position: relative;
    width: 100%;
}
.filter-black {
    filter: invert(0%) sepia(30%) saturate(7453%) hue-rotate(157deg)
        brightness(20%) contrast(67%);
}
.guest-acc-room-head > div > button {
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
    background-color: transparent;
    width: max-content;
    margin-left: 15px;
}
.guest-invi-room-head,
.guest-invi-room-single {
    display: flex;
    border-bottom: 1.1635px solid #ffffff;
}
.guest-invi-room-head > span {
    font-family: "Segoe UI";
    font-style: normal;
    font-weight: 400;
    font-size: 12.7985px;
    line-height: 17px;
    color: #000000;
    display: block;
    padding: 16px;
}
.guest-invi-room-single > span {
    font-family: "Segoe UI";
    font-style: normal;
    font-weight: 400;
    font-size: 12.7985px;
    line-height: 17px;
    color: #000000;
    display: block;
    padding: 16px;
    white-space: pre-line;
    word-break: break-word;
}
.guest-invi-room-single > span:nth-child(1) {
    font-weight: 600;
    font-size: 14px;
    line-height: 19px;
}
@media screen and (max-width: 768px) {
    .guest-acc-family-add {
        width: 100% !important;
    }
    .guest-acc-fam-add-cont {
        width: 100%;
    }
    .guest-acc-room-container {
        width: 100% !important;
    }
    /* .guest-invi-heading {
        text-align: left !important;
    } */
    .guest-invi-room-head {
        display: none;
    }
    .guest-invi-room-single {
        background: #f9ede2;
        border: 0.5px solid #e3e8ee;
        border-radius: 3px;
        margin-bottom: 3px;
        flex-wrap: wrap;
        justify-content: space-between;
    }
    .guest-acc-room-head > div > button:nth-child(2) > img {
        margin-right: 0;
    }
    .guest-invi-room-all {
        padding-top: 10px;
    }
    .guest-invi-room-single > span:nth-child(1) {
        width: 48% !important;
    }
    .guest-invi-room-single > span:nth-child(2) {
        width: 48% !important;
        text-align: right;
    }
    .guest-invi-room-single > span:nth-child(3) {
        width: 35% !important;
    }
    .guest-invi-room-single > span:nth-child(4) {
        width: 35% !important;
    }
    .guest-invi-room-single > span:nth-child(5) {
        width: 15% !important;
        padding-left: 0 !important;
    }
    .guest-invi-room-single > span:nth-child(6) {
        width: 15% !important;
        text-align: right;
        padding-left: 0 !important;
    }
    .guest-invi-acc-cont > img:nth-child(1) {
        z-index: 9;
    }
    .guest-acc-accept {
        width: 100% !important;
        position: relative;
        z-index: 99;
    }
    .guest-acc-accept > .guest-invi-heading {
        text-align: center !important;
    }

    .guest-invi-acc-cont > div {
        position: relative;
        z-index: 999;
    }
    .guest-invi-acc-cont > img:nth-child(1) {
        z-index: 9;
    }
}
@media screen and (max-width: 576px) {
    .guest-acc-room-container .guest-invi-heading {
        text-align: left !important;
        margin-bottom: 30px !important;
    }
}
</style>
