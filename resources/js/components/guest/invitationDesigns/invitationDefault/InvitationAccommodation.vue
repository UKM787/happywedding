<template>
    <div
        class="guest-invi-acc-cont"
        
    >
        <!-- v-if="
            privileges.guest_invitation.accommodation != 0 &&
            privileges.guest_invitation.accommodationStatus != 3
        " -->
        <img src="/assets/guestInvi/acc-right.png" alt="" />
        <!-- <div
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
        </div> -->
        <div
            v-if="(privileges.guest_invitation.accommodationStatus != 0 && privileges.guest_invitation.accommodationStatus != 3 ) &&privileges.guest_invitation.hostAccommodationStatus == 0"
            class="guest-acc-family-add"
        >
            <div style="position: relative; width: 100%">
                <h1 class="guest-invi-heading">Accomodation</h1>
            </div>
            <h6 v-if="privileges.guest_invitation.accommodationStatus == 2" class="guest-invi-sub-heading">
                Add Members Detatils to provide accomodation service
            </h6>
            <h6 v-else>Members Details has been sent. You will be notified when the Accomodation details were allotted to you and your members</h6>
            <div class="guest-acc-fam-add-cont">
                <div class="guest-acc-fam-input">
                    <div v-if="hideUser == false" class="guest-acc-fam-single">
                        <div>
                            <span>{{ user.name }}</span>
                            <img
                                v-if="privileges.guest_invitation.accommodationStatus == 2 ||privileges.guest_invitation.accommodationStatus == 1"
                                @click="hideUser = true"
                                src="/assets/guestInvi/close-fam-click.svg"
                                alt=""
                            />
                        </div>
                        <div>Me</div>
                    </div>
                    <div
                        v-for="item in selectedFamList"
                        :key="item.id"
                        class="guest-acc-fam-single"
                    >
                        <div>
                            <span>{{ item.familyname }}</span>
                            <img
                                v-if="privileges.guest_invitation.accommodationStatus == 2 ||privileges.guest_invitation.accommodationStatus == 1"
                                @click="addFamily(item, 'remove')"
                                src="/assets/guestInvi/close-fam-click.svg"
                                alt=""
                            />
                        </div>
                        <div>{{ item.familyrelation }}</div>
                    </div>
                    <div
                        v-for="item in selectedFam"
                        :key="item.id"
                        class="guest-acc-fam-single"
                    >
                        <div>
                            <span>{{ item.familyname }}</span>
                            <img
                                v-if="editDetails == true"
                                @click="addFamily(item, 'remove')"
                                src="/assets/guestInvi/close-fam-click.svg"
                                alt=""
                            />
                        </div>
                        <div>{{ item.familyrelation }}</div>
                    </div>
                </div>
                <div  v-if="(privileges.guest_invitation.accommodationStatus == 2 || privileges.guest_invitation.accommodationStatus == 1) || editDetails == true" class="guest-acc-fam-list">
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
                    <!-- if Add meemers is true or user clicked on edit details -->
                    <!-- add memeber button -->
                    <button  v-if="(privileges.guest_invitation.accommodationStatus == 1 || privileges.guest_invitation.accommodationStatus == 2) || editDetails == true" @click="$emit('addMember')" type="button" class="add-member-btn">
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
                    <!-- No Thanks btn -->
                    <button v-if="privileges.guest_invitation.accommodationStatus == 1" @click="confirmCancel = true;" class="add-member-btn" type="button">
                        <span>No Thanks</span>
                    </button>
                     <!--help button  -->
                    <button v-if="privileges.guest_invitation.accommodationStatus >3  && editDetails == false"  class="add-member-btn" type="button" @click="$emit('help')">
                        <img
                        v-if="screenWidth > 768"
                        style="margin-right: 10px"
                        src="/assets/guestInvi/clarity_help-line.svg"
                        alt=""
                        />
                        <img
                            v-else
                            src="/assets/clarity_help-line.png"
                            alt=""
                        />
                        <span v-if="screenWidth > 768">Help</span>
                    </button>
                    <!-- edit memeber butotn -->
                    <button v-if="privileges.guest_invitation.accommodationStatus > 3 && editDetails == false" @click="editDetails = true;" class="add-member-btn" type="button">
                        <img
                        v-if="screenWidth > 768"
                        style="margin-right: 10px"
                        src="/assets/guestInvi/edit-3.png"
                        alt=""
                        />
                        <img
                            v-else
                            src="/assets/miscellenous/edit-3.png"
                            alt=""
                        />
                        <span v-if="screenWidth > 768">Edit Members</span>
                    </button>
                    <!-- cancel request button -->
                    <button v-if="privileges.guest_invitation.accommodationStatus >3 && editDetails == false"  type="button" @click="confirmCancel = true;">
                        <span>Cancel Request</span>
                    </button>
                    <!-- cancel edit btn -->
                    <button v-if="privileges.guest_invitation.accommodationStatus != 2 && editDetails == true" @click="editDetails = false; selctedFamDummy = []; selectedFam = []" class="add-member-btn" type="button">
                        <span>Cancel</span>
                    </button>
                    <!-- submit details btn -->
                    <button
                        v-if="(privileges.guest_invitation.accommodationStatus == 2 || privileges.guest_invitation.accommodationStatus == 1)"
                        @click="confirmSend = true"
                        type="button"
                    >
                        Send Details
                    </button>
                    <button
                        v-if="editDetails == true"
                        @click="sendAccFamily()"
                        type="button"
                    >
                        Send Details
                    </button>
                </div>
            </div>
        </div>
        <div
            v-else-if="privileges.guest_invitation.accommodationStatus == 3"
            class="guest-acc-family-wait"
        >
            <img src="/assets/guestInvi/acc-circle.png" alt="" />
            <h1 class="guest-invi-heading">Accomodation</h1>
            <h6 class="guest-invi-sub-heading">
                You denied accommodation request, If you have any concerns or would like additional information ask help. 
            </h6>
            <button @click="$emit('help')" type="button">
                <img src="/assets/guestInvi/clarity_help-line.svg" alt="" />
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
                        <img src="/assets/guestInvi/Group-1702.svg" alt="" />
                    </button>
                    <button @click="$emit('help')" type="button">
                        <img
                            src="/assets/guestInvi/clarity_help-line.svg"
                            alt=""
                        />
                        <span v-if="screenWidth > 768">Help</span>
                    </button>
                </div>
                <div class="guest-invi-room-all">
                    <div class="guest-invi-room-head">
                        <span style="width: 25%">Name</span>
                        <!-- <span style="width: 20%">Phone Number</span> -->
                        <span style="width: 25%">Hotel</span>
                        <span style="width: 25%">Block</span>
                        <span style="width: 12%">Floor</span>
                        <span style="width: 13%">Room.No</span>
                    </div>
                    <div
                        v-if="
                            privileges.guest_invitation.accommodationStatus == 4
                        "
                        class="guest-invi-room-single"
                    >
                        <span style="width: 25%">{{ user.name }}</span>
                        <!-- <span style="width: 20%">{{ user.mobile }}</span> -->
                        <span style="width: 25%">{{
                            guestAccommodationInfo?.hotelName
                        }}</span>
                        <span style="width: 25%">{{
                            guestAccommodationInfo?.block
                        }}</span>
                        <span style="width: 12%">{{
                            guestAccommodationInfo?.floor
                        }}</span>
                        <span style="width: 13%">{{
                            guestAccommodationInfo?.roomno
                        }}</span>
                    </div>
                    <div
                        v-for="(item, index) in accInfo"
                        :key="index"
                        class="guest-invi-room-single"
                    >
                        <span style="width: 25%">{{
                            item.family.familyname
                        }}</span>
                        <!-- <span style="width: 20%">{{
                            item.family.familymobile
                        }}</span> -->
                        <span style="width: 25%">{{ item.hotelName }}</span>
                        <span style="width: 25%">{{ item.block }}</span>
                        <span style="width: 12%">{{ item.floor }}</span>
                        <span style="width: 13%">{{ item.roomno }}</span>
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
                        <button                         :disabled="disableAccFamily"
                        @click="sendAccFamily()" type="button">Send</button>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="confirmSendTwo" class="guest-acc-fam-submit-form-cont">
            <div class="guest-acc-fam-submit-form">
                <div class="new-pupop">
                    <span><img src="/assets/guestInvi/check.svg" /></span>
                    <h1>Request sent!!</h1>
                    <p>Members Details has been sent. You will be notified when the Accomodation details were allotted to you and your members</p>
                    <button @click="confirmSendTwo = false;">Close</button>
                </div>
            </div>
        </div>
        <div v-if="confirmCancel" class="guest-acc-fam-submit-form-cont">
            <div class="guest-acc-fam-submit-form">
                <div class="pup-up-head-cont">
                    <img @click="confirmCancel = false" src="/assets/guestInvi/13.png" alt="">
                    <div></div>
                    <img src="/assets/guestInvi/abc.png" alt=""> 
                </div>
                <div class="pup-up-end-cont">
                    <h1>No Thanks</h1>
                    <p>Are you sure you don’t want accomodation?</p>
                    <div>
                        <button @click="confirmCancel = false" type="button">Discard</button>
                        <button  @click="acceptAcc('decline')" type="button">Confirm</button> 
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
    props: [
        "inviStatus",
        "familyAcc",
        "user",
        "accomodationInfo",
        "guestAccommodationInfo",
    ],
    computed: {
        familyList() {
            let _this = this;

            let arr = _this.familyAcc.filter(item1 =>
                !_this.accInfo.some((item2) => {
                    return item1.id == item2.family_id;
                })
            );
            return arr.concat(_this.selctedFamDummy);
            //return this.familyAcc
        },
        selectedFamList() {
            let _this = this;
            let members = _this.accInfo.filter(item => item.family).map(item => item.family);
           // return members.concat(_this.selectedFam);
           return members;
        }
    },
    data() {
        return {
            privileges: this.inviStatus,
            //familyList: this.familyAcc,
            selectedFam: [],
            selctedFamDummy: [],
            disableAcceptAcc: false,
            disableAccFamily: false,
            hideUser: false,
            accInfo: this.accomodationInfo,
            message: null,
            screenWidth: window.screen.width,
            confirmSend: false,
            confirmSendTwo: false,
            confirmCancel: false,
            editDetails: false,
        };
    },
    methods: {
        // openPopup(name){
        //     if(name == 'send'){

        //     }
        // }
        addFamily(ele, type) {
            //this.selectedFam = [];
            // this.selctedFamDummy = [];
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
            // let fam = this.selectedFam;
            // this.selctedFamDummy = fam;
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
                    _this.confirmCancel = false;
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
                    if(_this.editDetails == true){
                        _this.confirmSendTwo = true;
                    }
                    _this.confirmSend = false;
                    _this.editDetails = false;
                    _this.disableAccFamily = false;
                    _this.selectedFam = [];
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
                    _this.confirmSend = false;
                    _this.editDetails = false;
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
    background-color: #ffffff;
}
.guest-invi-acc-cont > div {
    width: 70%;
    margin: auto;
}
.guest-invi-acc-cont > img:nth-child(1) {
    position: absolute;
    bottom: 0;
    right: 0;
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
    margin-bottom: 15px;
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
    width: 70%;
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
    width: 175px;
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
    /* margin-right: 55px; */
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
.guest-acc-family-wait > button > img,
.guest-acc-room-head > div > button:nth-child(1) > img {
    margin-right: 6px;
}
.guest-acc-room-head {
    position: relative;
    width: 100%;
}
.guest-acc-room-head > div > button {
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
    margin-left: 15px;
}
.guest-invi-room-head,
.guest-invi-room-single {
    display: flex;
    border-bottom: 1.1635px solid #e3e8ee;
}
.guest-invi-room-head > span {
    font-family: "Segoe UI";
    font-style: normal;
    font-weight: 400;
    font-size: 12.7985px;
    line-height: 17px;
    color: #8792a2;
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
        background: #ffffff;
        border: 0.5px solid #e3e8ee;
        border-radius: 3px;
        margin-bottom: 3px;
        flex-wrap: wrap;
        justify-content: space-between;
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
