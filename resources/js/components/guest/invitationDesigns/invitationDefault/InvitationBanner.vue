<template>
    <div>
        <div class="guest-invi-navbar-cont">
            <div class="guest-invi-navbar container">
                <!-- <a :href="route('guestwelcome.index', guest)">
                    <span v-if="screenWidth < 768">
                        <img src="/assets/guestDash/home.svg" alt="" />
                    </span>
                    Welcome
                </a> -->
                <div
                    :class="{ active: active == 'banner' }"
                    @click="scrollToTargetAdjusted('banner')"
                >
                    <span v-if="screenWidth < 768">
                        <img src="/assets/guestInvi/invitation.svg" alt="" />
                    </span>
                    Invitation
                </div>
                <div
                    :class="{ active: active == 'ceramonies' }"
                    v-if="ceramonyList.length > 0"
                    @click="scrollToTargetAdjusted('ceramonies')"
                >
                    <span v-if="screenWidth < 768">
                        <img src="/assets/guestInvi/ceramonies.svg" alt="" />
                    </span>
                    Ceremony
                </div>
                <div
                    :class="{ active: active == 'accomodation' }"
                    v-if="invitation.guest_invitation.accommodation == 1"
                    @click="scrollToTargetAdjusted('accomodation')"
                >
                    <span v-if="screenWidth < 768">
                        <img src="/assets/guestInvi/accommodation.svg" alt="" />
                    </span>
                    Accomodation
                </div>
                <div
                    v-if="invitation.guest_invitation.logistics == 1"
                    :class="{ active: active == 'logistics' }"
                    @click="scrollToTargetAdjusted('logistics')"
                >
                    <span v-if="screenWidth < 768">
                        <img src="/assets/guestInvi/logistics.svg" alt="" />
                    </span>
                    Logistics
                </div>
                <div
                    :class="{ active: active == 'gallery' }"
                    @click="scrollToTargetAdjusted('gallery')"
                    v-if="
                        albums.length > 0 ||
                        galleries.length > 0 ||
                        videos.length > 0
                    "
                >
                    <span v-if="screenWidth < 768">
                        <img src="/assets/guestInvi/gallery.svg" alt="" />
                    </span>
                    Gallery
                </div>
                <div
                    :class="{ active: active == 'helpLine' }"
                    v-if="helpLineList.length > 0"
                    @click="scrollToTargetAdjusted('helpLine')"
                >
                    <span v-if="screenWidth < 768">
                        <img src="/assets/invitation/helpline.svg" alt="" />
                    </span>
                    Help
                </div>
                <div
                    v-if="story"
                    :class="{ active: active == 'story' }"
                    @click="scrollStory()"
                >
                    <span v-if="screenWidth < 768">
                        <img src="/assets/guestInvi/ourstory.svg" alt="" />
                    </span>
                    Our Story
                </div>
            </div>
        </div>
        <div class="all" :class="{ hide: showStory || showAllGallery }">
            <div ref="banner" class="guest-banner-cont">
                <img src="/assets/guestInvi/Frame-5602-1.png" alt="" />
                <div class="overlay"></div>
                <div class="guest-banner-content">
                    <div
                        v-if="invitation.guest_invitation.inviteStatus != 6"
                        class="guest-banner-accept"
                    >
                        <button
                            :disabled="disableReact"
                            @click="reactInvitation('accept')"
                        >
                            I'll be there
                        </button>
                        <button
                            :disabled="disableReact"
                            @click="reactInvitation('decline')"
                        >
                            turn down
                        </button>
                    </div>
                    <div class="guest-banner-couple-name">
                        <span>{{ invitation?.side == 'bride' ? invitation.brideName : invitation.groomName }}</span>
                        <span>weds</span>
                        <span>{{ invi?.side == 'groom' ? invitation.brideName : invitation.groomName }}</span>
                    </div>
                    <div>
                        <img src="/assets/guestInvi/banner-invite.svg" alt="" />
                    </div>
                    <div class="guest-banner-venue-date">
                        <span>
                            <img
                                src="/assets/guestInvi/banner-bird-left.svg"
                                alt=""
                            />
                        </span>
                        <span
                            >{{
                                new Date(
                                    invitation.startDate
                                ).toLocaleDateString("en-us", {
                                    month: "long",
                                })
                            }}
                            {{
                                new Date(
                                    invitation.startDate
                                ).toLocaleDateString("en-us", {
                                    day: "numeric",
                                })
                            }},
                            {{
                                new Date(
                                    invitation.startDate
                                ).toLocaleDateString("en-us", {
                                    year: "numeric",
                                })
                            }}
                            {{ invitation.venues[0].name }}
                            <template v-if="invitation.venues[0].address">, {{ invitation.venues[0].address }}</template>
                            <template v-if="invitation.venues[0].pincode">, {{ invitation.venues[0].pincode }}</template>
                            <template v-if="invitation.venues[0].city">, {{ invitation.venues[0].city }}</template>
                            <template v-if="invitation.venues[0].state">, {{ invitation.venues[0].state }}</template>
                            <template v-if="invitation.venues[0].location && invitation.venues[0].location.name">, {{ invitation.venues[0].location.name }}</template>
                            <template v-if="invitation.venues[0].location && invitation.venues[0].location.state && invitation.venues[0].location.state.name">, {{ invitation.venues[0].location.state.name }}</template>
                            </span
                        >
                        <span>
                            <img
                                src="/assets/guestInvi/banner-bird-right.svg"
                                alt=""
                            />
                        </span>
                    </div>
                    <div class="guest-banner-timer">
                        <div class="guest-banner-timer-single">
                            <span></span>
                            <span>days</span>
                        </div>
                        <div class="guest-banner-timer-single">
                            <span></span>
                            <span>hours</span>
                        </div>
                        <div class="guest-banner-timer-single">
                            <span></span>
                            <span>minutes</span>
                        </div>
                        <div class="guest-banner-timer-single">
                            <span></span>
                            <span>seconds</span>
                        </div>
                    </div>
                    <div class="guest-banner-slogan">
                        <div>We can't wait to celebrate with you!</div>
                        <div>
                            With pride and joy, we invite you to share a special
                            day in our lives as we…
                        </div>
                    </div>
                </div>
            </div>
            <guestCeramony
                ref="ceramonies"
                v-if="ceramonyList.length > 0"
                :ceramonies="ceramonyList"
                :invitation="invitation"
            ></guestCeramony>
            <guestAccommodation
                ref="accomodation"
                v-if="invitation.guest_invitation.accommodation == 1"
                :inviStatus="invitation"
                :familyAcc="familyList"
                :user="loggedIn"
                :accomodationInfo="familyAccInfo"
                :guestAccommodationInfo="guestAccommodationInfo"
                @acc="(n) => (invitation = n)"
                @help="scrollToTargetAdjusted('helpLine')"
                @addMember="famForm = {...famFormCopy} ;showFamForm = true; fEdit = false"  
                @editMember="editFamMember"
                @deleteMember= "deleteFamily"
            ></guestAccommodation>
            <guestLogistics
                ref="logistics"
                v-if="invitation.guest_invitation.logistics == 1"
                :inviStatus="invitation"
                :familyLog="familyList"
                :user="loggedIn"
                :departure="departureDetails"
                :arrival="arrivalDetails"
                @log="(n) => (invitation = n)"
                @help="scrollToTargetAdjusted('helpLine')"
                @addMember="famForm = {...famFormCopy} ;showFamForm = true; fEdit = false"
                @editMember="editFamMember"
                @deleteMember= "deleteFamily"
            ></guestLogistics>
            <guestGallery
                v-if="
                    albums.length > 0 ||
                    galleries.length > 0 ||
                    videos.length > 0
                "
                :inviAlbum="albums"
                :inviImages="galleries"
                :inviVideos="videos"
                :invi="invitation"
                :showAll="showAllGallery"
                @all="scrollGallery()"
                ref="gallery"
            ></guestGallery>
            <guestHelpline
                ref="helpLine"
                v-if="helpLineList.length > 0"
                :helpLine="helpLineList"
                :inviStatus="inviStatus"
            ></guestHelpline>
        </div>
        <guestStory
            v-if="story"
            :ourStory="story"
            :invi="invitation"
            ref="story"
            :class="{ hide: !showStory }"
            id="story-cont"
        ></guestStory>
        <div
            :class="{ hide: !showAllGallery }"
            class="gallery-all-cont wed-host-gallery container-md"
        >
            <div>
                <div
                    @click="
                        activeGallery = 'Pictures';
                        clickedAlbum = [];
                    "
                    :class="{
                        'wed-host-gallery-active': activeGallery == 'Pictures',
                    }"
                >
                    Pictures
                </div>
                <div
                    @click="
                        activeGallery = 'Albums';
                        clickedAlbum = [];
                    "
                    :class="{
                        'wed-host-gallery-active': activeGallery == 'Albums',
                    }"
                >
                    Albums
                </div>
                <div
                    @click="
                        activeGallery = 'Videos';
                        clickedAlbum = [];
                    "
                    :class="{
                        'wed-host-gallery-active': activeGallery == 'Videos',
                    }"
                >
                    Videos
                </div>
            </div>
            <div class="wed-host-gallery-items">
                <div v-if="activeGallery == 'Pictures'">
                    <div
                        v-for="(item, index) in nonAlbumImages"
                        :key="index"
                        class="img-cont"
                    >
                        <img
                            :src="
                                '/files/' + invitation.id + '/' + item.imageName
                            "
                            alt=""
                        />
                    </div>
                </div>
                <div
                    id="all-albums"
                    v-if="activeGallery == 'Albums' && clickedAlbum.length == 0"
                >
                    <div
                        v-for="(item, index) in albums"
                        :key="index"
                        @click="clickedAlbum = item.images"
                        class="album-cont"
                    >
                        <span>
                            {{ item.images.length }}
                            <img src="/assets/guestInvi/bi_image-fill.svg" />
                        </span>
                        <img src="/assets/guestInvi/Frame-5602-1.png" alt="" />
                        <span> {{ item.name }} </span>
                    </div>
                </div>
                <div v-else class="album-pics">
                    <div
                        v-for="single in clickedAlbum"
                        :key="single.imageName"
                        class="img-cont"
                    >
                        <img
                            :src="
                                '/files/' +
                                invitation.id +
                                '/' +
                                single.imageName
                            "
                            alt=""
                        />
                    </div>
                </div>
                <div v-if="activeGallery == 'Videos'">
                    <div
                        v-for="(item, index) in videos"
                        :key="index"
                        class="img-cont"
                    >
                        <video controls>
                            <source
                                :src="
                                    '/videos/' + invitation.id + '/' + item.name
                                "
                            />
                            Your browser does not support the video tag.
                        </video>
                    </div>
                </div>
            </div>
        </div>
        <flashMessage :message="message"></flashMessage>
        <div v-if="showFamForm" class="guest-acc-fam-add-form-cont">
            <div class="guest-acc-fam-add-form">
                <div class="close-img-cont">
                    <img @click="showFamForm = false;" style="cursor: pointer;" src="/assets/clarity_window-close-line.svg" alt="">
                </div>
                <img style="width: 76px; height: 76px;" src="/assets/guest-flowr-add-form.png" alt="">
                <h1>Add Member</h1>
                <h4>Add information of family members invited </h4>
                <form class="fam-add-frm" action="">
                    <div>
                        <div>
                            <label for="name">Name</label>
                            <input type="text" id="name" v-model="famForm.familyname">
                            <span
                                v-if="errors && errors.familyname"
                                class="errMsg"
                                >{{ errors.familyname[0] }}</span
                            >
                        </div>
                    </div>
                    <div>
                        <div>
                            <label for="age">Age</label>
                            <input type="text" id="age" v-model="famForm.familyage">
                            <span
                                v-if="errors && errors.familyage"
                                class="errMsg"
                                >{{ errors.familyage[0] }}</span
                            >
                        </div>
                        <div>
                            <label for="gender">Gender</label>
                            <select
                                v-model="
                                    famForm.familygender
                                "
                                id="gender"
                                style="padding: 13px;"
                            >
                                <!-- <option
                                    disabled
                                    selected
                                    value="null"
                                >
                                    Select Gender
                                </option> -->
                                <option
                                    value="male"
                                >
                                    Male
                                </option>
                                <option
                                    value="female"
                                >
                                    Female
                                </option>
                            </select>
                            <span
                                v-if="errors && errors.familygender"
                                class="errMsg"
                                >{{ errors.familygender[0] }}</span
                            >
                        </div>
                    </div>
                    <div>
                        <div>
                            <label for="phone">Phone Number</label>
                            <input type="text" id="phone" v-model="famForm.familymobile">
                            <span
                                v-if="errors && errors.familymobile"
                                class="errMsg"
                                >{{ errors.familymobile[0] }}</span
                            >
                        </div>
                        <div>
                            <label for="relation">Relation</label>
                            <select
                                v-model="
                                    famForm.familyrelation
                                "
                                id="relation"
                                style="padding: 13px;"
                            >
                                <option
                                    v-for="(item, index) in famRel"
                                    :key="index"
                                    :value="item"
                                >
                                    {{ item }}
                                </option>
                            </select>
                            <span
                                v-if="errors && errors.familyrelation"
                                class="errMsg"
                                >{{ errors.familyrelation[0] }}</span
                            >
                        </div>
                    </div>
                    <div>
                        <div>
                            <label for="pic">Upload Picture</label>
                            <input @change="uploadImg($event, 'familyOne')" ref="familyimageOne" type="file" name="pic" id="pic" hidden>
                            <div class="img-upld-cont">
                                <span @click="$refs.familyimageOne.click()">
                                    <img src="/assets/upload.png" alt="">
                                    Upload Picture
                                </span>
                            </div>
                            <span
                                v-if="errors && errors.familyimageOne"
                                class="errMsg"
                                >{{ errors.familyimageOne[0] }}</span
                            >
                            <img
                                style="
                                    width: 150px;
                                    height: 150px;
                                    border-radius: 50%;
                                "
                                v-if="familyimageOnePreview"
                                :src="familyimageOnePreview"
                                alt=""
                            />
                            <img
                                v-else-if="
                                    famForm.familyimageOne ==
                                    '/guests/kycDefault.png'
                                "
                                style="
                                    width: 150px;
                                    height: 150px;
                                    border-radius: 50%;
                                "
                                :src="
                                    '/storage' +
                                    famForm.familyimageOne
                                "
                                alt=""
                            />
                            <img
                                v-else-if="
                                    famForm.familyimageOne
                                "
                                style="
                                    width: 150px;
                                    height: 150px;
                                    border-radius: 50%;
                                "
                                :src="
                                    '/assets/guests/uploads/' +
                                    famForm.familyimageOne
                                "
                                alt=""
                            />
                        </div>
                        <div>
                            <label for="pic">Upload Picture</label>
                            <input  @change="uploadImg($event, 'familyTwo')" ref="familyimageTwo" type="file" name="pic" id="pic" hidden>
                            <div class="img-upld-cont">
                                <span  @click="$refs.familyimageTwo.click()">
                                    <img src="/assets/upload.png" alt="">
                                    Upload Picture
                                </span>
                            </div>
                            <span
                                v-if="errors && errors.familyimageTwo"
                                class="errMsg"
                                >{{ errors.familyimageTwo[0] }}</span
                            >
                            <img
                                style="
                                    width: 150px;
                                    height: 150px;
                                    border-radius: 50%;
                                "
                                v-if="familyimageTwoPreview"
                                :src="familyimageTwoPreview"
                                alt=""
                            />
                            <img
                                v-else-if="
                                    famForm.familyimageTwo ==
                                    '/guests/kycDefault.png'
                                "
                                style="
                                    width: 150px;
                                    height: 150px;
                                    border-radius: 50%;
                                "
                                :src="
                                    '/storage' +
                                    famForm.familyimageTwo
                                "
                                alt=""
                            />
                            <img
                                v-else-if="
                                    famForm.familyimageTwo
                                "
                                style="
                                    width: 150px;
                                    height: 150px;
                                    border-radius: 50%;
                                "
                                :src="
                                    '/assets/guests/uploads/' +
                                    famForm.familyimageTwo
                                "
                                alt=""
                            />
                        </div>
                    </div>
                    <span class="fam-add-btn-cont">
                        <button @click="submitFamMember()" type="button">Add</button>
                    </span>
                </form>
            </div>
        </div>
        <div v-if="loader" class="form-upload-spinner form-upload-vue">
            <svg
                width="30"
                height="20"
                viewBox="0 0 20 15"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    d="M3.54979 1.3875C-2.63254 5.39784 5.09979 11.4625 9.74979 13.7875C14.3998 13.0125 22.1498 4.48748 16.7248 1.3875C14.546 0.142315 11.2998 2.1625 9.74979 3.7125C8.19979 2.42084 5.11741 0.370628 3.54979 1.3875Z"
                    fill="#FF5BFF"
                    stroke="#FF5BFF"
                    stroke-width="1.55"
                />
            </svg>
            <div>
                <svg
                    width="70"
                    height="68"
                    viewBox="0 0 49 47"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M46.83 23.75C46.83 35.3256 37.1128 44.83 24.975 44.83C12.8371 44.83 3.11995 35.3256 3.11995 23.75C3.11995 12.1744 12.8371 2.67 24.975 2.67C37.1128 2.67 46.83 12.1744 46.83 23.75Z"
                        stroke="white"
                        stroke-width="4.34"
                    />
                </svg>
                <svg
                    width="70"
                    height="68"
                    viewBox="0 0 49 47"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M46.83 23.75C46.83 35.3256 37.1128 44.83 24.975 44.83C12.8371 44.83 3.11995 35.3256 3.11995 23.75C3.11995 12.1744 12.8371 2.67 24.975 2.67C37.1128 2.67 46.83 12.1744 46.83 23.75Z"
                        stroke="white"
                        stroke-width="4.34"
                    />
                </svg>
            </div>
        </div>
    </div>
</template>

<script>
import guestCeramony from "../invitationDefault/InvitationCeramony.vue";
import guestAccommodation from "../invitationDefault/InvitationAccommodation.vue";
import guestLogistics from "../invitationDefault/InvitationLogistics.vue";
import guestGallery from "../invitationDefault/InvitationGallery.vue";
import guestHelpline from "../invitationDefault/InvitationHelpline.vue";
import guestStory from "../invitationDefault/InvitationStory.vue";
import flashMessage from "../../../FlashMessage.vue";

export default {
    components: {
        guestCeramony,
        guestAccommodation,
        guestLogistics,
        guestGallery,
        guestHelpline,
        guestStory,
        flashMessage,
    },

    props: [
        "guest",
        "ceramonies",
        "inviStatus",
        "family",
        "accomodationInfo",
        "guestAccommodationInfo",
        "arrivalDetails",
        "departureDetails",
        "helpLine",
        "story",
        "albums",
        "galleries",
        "videos",
    ],
    data() {
        return {
            famRel: [
                "Father",
                "Mother",
                "Wife",
                "Husband",
                "Son",
                "Daughter",
                "Son-in-law",
                "Daughter-in-law",
                "Grand Son",
                "Grand Daughter",
                "Others",
            ],
            famFormCopy: {
                familyname: null,
                familyage: null,
                familygender: null,
                familyrelation: null,
                familymobile: null,
                familyimageOne: null,
                familyimageTwo: null,
                guest_id: this.guest.id,
            },
            famForm: {
                familyname: null,
                familyage: null,
                familygender: null,
                familyrelation: null,
                familymobile: null,
                familyimageOne: null,
                familyimageTwo: null,
                guest_id: this.guest.id,
            },
            ceramonyList: this.ceramonies,
            loggedIn: this.guest,
            invitation: this.inviStatus,
            invi: this.inviStatus,
            familyList: this.family,
            familyAccInfo: this.accomodationInfo,
            helpLineList: this.helpLine,
            disableReact: false,
            message: null,
            active: "banner",
            showStory: false,
            showAllGallery: false,
            activeGallery: "Pictures",
            clickedAlbum: [],
            screenWidth: window.screen.width,
            familyimageOne: null,
            familyimageTwo: null,
            familyimageOnePreview: null,
            familyimageTwoPreview: null,
            fprofileDisabled: false,
            fEdit: false,
            showFamForm: false,
            errors: null,
            loader:false,
        };
    },
    computed: {
        nonAlbumImages() {
            // Filter out images that have an album
            return this.galleries.filter(image => !image.album_id);
        }
    },
    methods: {
        deleteFamily(id) {
            let _this = this;
            this.loader = true;
            axios
                .delete(`/api/guest/profile/${id}`)
                .then(function (response) {
                    _this.message = "Deleted";
                    console.log(response.data);
                    _this.familyList = response.data;
                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                })
                .catch((error) => {
                    _this.loader = false;
                    console.log(error.response.data.errors);
                });
        },
        editFamMember(item){
            this.famForm = item;
            this.fEdit = true;
            this.showFamForm = true;
        },
        submitFamMember(id = null){
            var _this = this;
            _this.errors = null;
            _this.fprofileDisabled = true;
            let formData = new FormData();
            if(this.familyimageOne != null){
                formData.append("familyimageOne", this.familyimageOne);
            }
            if(this.familyimageTwo != null){
                formData.append("familyimageTwo", this.familyimageTwo);
            }
            let data = JSON.stringify(_this.famForm);
            formData.append("data", data);
            formData.append("type", "family");
            let link = route("guest.profile.store");
            if (_this.fEdit == true) {
                link = route("guest.profile.update", _this.famForm.id);
                formData.append("_method", "PATCH");
            }
            axios({
                method: "POST",
                url: link,
                data: formData,
                headers: { "content-type": "multipart/form-data" },
            })
                .then((response) => {
                    _this.message = 'Family member added';
                    _this.familyList = response.data;
                    _this.fprofileDisabled = false;
                    _this.showFamForm = false;
                    _this.familyimageOne = null;
                    _this.familyimageTwo = null;
                    _this.familyimageOnePreview = null;
                    _this.familyimageTwoPreview = null;

                })
                .catch((error) => {
                    _this.errors = error.response.data?.errors;
                    _this.message = "something went wrong!";
                    _this.fprofileDisabled = false;
                });
        },
        uploadImg(e, type){
            if (type == "familyOne") {
                this.familyimageOne = e.target.files[0];
                this.familyimageOnePreview = URL.createObjectURL(
                    this.familyimageOne
                );
                return;
            }
            if (type == "familyTwo") {
                this.familyimageTwo = e.target.files[0];
                this.familyimageTwoPreview = URL.createObjectURL(
                    this.familyimageTwo
                );
                return;
            }
        },
        scrollStory() {
            this.showStory = true;
            this.active = "story";
            // this.$refs.story.$el.scrollIntoView(true);
            window.scrollTo(0, 0);
        },
        scrollGallery() {
            this.showAllGallery = true;
            this.active = "gallery";
            // this.$refs.story.$el.scrollIntoView(true);
            window.scrollTo(0, 0);
        },
        async scrollToTargetAdjusted(e) {
            let _this = this;
            console.log(e);
            this.showStory = false;
            this.showAllGallery = false;
            await this.$nextTick();
            // await new Promise(function (resolve, reject) {
            //     if (_this.showAllGallery == false) {
            //         resolve("resolved");
            //     } else {
            //         reject("reject");
            //     }
            // });
            var element = null;
            var headerOffset = 91;
            this.active = e;

            if (e == "banner") {
                element = this.$refs[e];
                headerOffset = 0;
            } else {
                element = this.$refs[e].$el;
            }
            var elementPosition = element.getBoundingClientRect().top;
            var offsetPosition =
                elementPosition + window.pageYOffset - headerOffset;
            //console.log(offsetPosition, element, elementPosition);
            window.scrollTo({
                top: offsetPosition,
                behavior: "smooth",
            });
        },
        reactInvitation(type) {
            let _this = this;
            this.disableReact = true;
            let link = route("guestaccepted", [
                _this.loggedIn,
                _this.invitation,
            ]);
            if (type == "decline") {
                link = route("guestdeclined", [
                    _this.loggedIn,
                    _this.invitation,
                ]);
            }
            axios({
                method: "POST",
                url: link,
            })
                .then((response) => {
                    console.log(response);
                    _this.disableReact = false;
                    //_this.invitation = response.data;
                    if (type == "accept") {
                        _this.message = "Invitation Accepted!!";
                        _this.invitation.guest_invitation.inviteStatus = 6;
                    }
                    if (type == "decline") {
                        _this.message = "Invitation Declined!!";
                        _this.invitation.guest_invitation.inviteStatus = 5;
                    }
                    console.log(_this.message);
                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                })
                .catch((error) => {
                    console.log(error);
                    _this.disableReact = false;
                    _this.message = "Something went wrong!!";

                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                });
        },
        countDown() {
            const fixedDate = this.invitation.startDate;
            //console.log(fixedDate);
            const deadlineTimer = document.querySelectorAll(
                ".guest-banner-timer-single > span:nth-child(1)"
            );

            const futureDate = new Date(fixedDate);

            const futureTime = futureDate.getTime();

            function getRemainingTime() {
                let today = new Date().getTime();

                let totalRemainingMS = futureTime - today;
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
        },
        setWidth() {
            this.screenWidth = window.screen.width;
        },
    },
    mounted() {
        window.addEventListener("resize", this.setWidth);
        this.$nextTick(() => {
            this.countDown();
            if (this.story) {
                this.$refs.story.countDown();
            }
            console.log('Ceremony List:', this.ceramonyList);
        });
    },
};
</script>

<style scoped>
/* fam form add start */

.guest-acc-fam-add-form-cont {
    width: 100% !important;
    height: 100%;
    position: fixed;
    background: rgba(0, 0, 0, 0.50);
    z-index: 999999999999999;
    top: 0;
    left: 0;
    /* display: flex;
    justify-content: center;
    align-items: center; */
    overflow-y: auto;
}
.guest-acc-fam-add-form{
    border-radius: 8.388px;
    background: #FFF;
    box-shadow: 0px 3.35501px 50.3252px 0px rgba(0, 0, 0, 0.25);
    width: 100%;
    padding: 20px;
    max-width: 505px;
    display: flex;
    justify-content: center;
    flex-direction: column;
    align-items: center;
    margin-left:auto;
    margin-right:auto;
    margin-top:10%;
    margin-bottom:5%;
}
.close-img-cont{
    display: flex;
    width: 100%;
    justify-content: flex-end;
}
.guest-acc-fam-add-form > h1 {
    color: #333;
    text-align: center;
    font-family: Perpetua;
    font-size: 24.444px;
    font-style: normal;
    font-weight: 700;
    line-height: normal;
}
.guest-acc-fam-add-form > h4 {
    color: #8B8B8B;
    text-align: center;
    font-family: Poppins;
    font-size: 12.87px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
}
.fam-add-frm  label {
    color: #000;
    font-family: Poppins;
    font-size: 13px;
    font-style: normal;
    font-weight: 500;
    line-height: 7.698px;
    margin-left: 10px;
}
.fam-add-frm {
    width: 100%;
}
.fam-add-frm  > div {
    display: flex;
    margin-bottom:10px; 
}
.fam-add-frm  > div > div {
    width: 100%;
}
.fam-add-frm  > div > div:nth-child(2){
    margin-left: 5px;
}
.fam-add-frm  input, .fam-add-frm  select, .img-upld-cont{
    border-radius: 7.72px !important;
    border: 0.643px solid #D2D2D2 !important;
    background-color: #ffffff !important;
    width: 100%;
    padding:10px ;
}
.img-upld-cont >span{
    display: flex;
    height: 29px;
    padding: 5.847px 6px 6.153px 9px;
    justify-content: center;
    align-items: center;
    gap: 7px;
    background-color: #F2F1F1;
    color: #828282;
    font-family: Poppins;
    font-size: 11.29px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
    width: 122px;
}
.fam-add-btn-cont {
    display: flex;
    justify-content: flex-end;
}
.fam-add-btn-cont > button {
    border-radius: 6px;
    background: #5C1B6D;
    padding: 6px 16.5px;
    color: #FFF;
    text-align: center;
    font-family: Poppins;
    font-size: 12px;
    font-style: normal;
    font-weight: 500;
    line-height: normal;
}

/* fam form add ends */
.hide {
    max-height: 0 !important;
    overflow: hidden !important;
    padding: 0 !important;
}
/* Navbar css start */
.guest-invi-navbar-cont {
    position: fixed;
    display: flex;
    justify-content: center;
    top: 91px;
    z-index: 9999999999;
    width: 100%;
}
.guest-invi-navbar {
    background: #461952;
    border-radius: 27px;
    padding: 8px 13px;
    display: flex;
    justify-content: space-between;
    overflow-x: auto;
    -ms-overflow-style: none; /* IE and Edge */
    scrollbar-width: none; /* Firefox */
}
.guest-invi-navbar::-webkit-scrollbar {
    display: none;
}
.guest-invi-navbar > div,
.guest-invi-navbar > a {
    text-decoration: none;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 15px;
    line-height: 22px;
    text-align: center;
    color: #9a9a9a;
    padding: 8px 40px;
    cursor: pointer;
    text-decoration: none;
    white-space: nowrap;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
.guest-invi-navbar > div > span,
.guest-invi-navbar > a > span {
    width: 46px;
    height: 46px;
    margin-bottom: 25px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    background: rgba(255, 255, 255, 0.1);
}
.guest-invi-navbar > .active {
    background: #ffffff;
    border-radius: 23px;
    color: #461952;
    font-weight: 700;
}
/* Navbar css end */

/* Banner css start */
.guest-banner-cont {
    padding-top: 40%;
    position: relative;
    width: 100%;
    height: 100%;
    top: 0;
}
.guest-banner-cont > img:nth-child(1) {
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    object-fit: cover;
}
.guest-banner-cont > .overlay {
    background: rgba(0, 0, 0, 0.5);
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    z-index: 999;
}
.guest-banner-content {
    margin: auto;
    position: absolute;
    top: 25%;
    text-align: center;
    display: flex;
    flex-direction: column;
    width: 100%;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}
/* .guest-banner-content {
    margin-bottom: 3em;
} */
.guest-banner-accept > button {
    font-family: "Segoe UI";
    font-style: normal;
    font-weight: 700;
    font-size: 13.052px;
    line-height: 17px;
    text-transform: uppercase;
    padding: 13px 38px;
}
.guest-banner-accept > button:nth-child(1) {
    outline: none;
    background: rgba(196, 69, 111, 0.5);
    border: 1.12998px solid #c4456f;
    border-radius: 6.81176px;
    color: #ffffff;
    margin-right: 15px;
}
.guest-banner-accept > button:nth-child(2) {
    outline: none;
    background: rgba(72, 72, 72, 0.2);
    border: 1.12998px solid #696969;
    border-radius: 6.81176px;
    color: #ffffff;
}
.guest-banner-couple-name {
    margin-top: 2em;
}
.guest-banner-couple-name > span {
    font-family: "STSong";
    font-style: normal;
    font-weight: 400;
    font-size: 29.2084px;
    line-height: 38px;
    text-transform: uppercase;
    color: #ffffff;
}
.guest-banner-couple-name > span:nth-child(2) {
    font-family: "Stalemate";
    font-style: normal;
    font-weight: 400;
    font-size: 53.1063px;
    line-height: 78px;
    color: #ffffff;
    text-transform: none;
    margin: 0 20px;
}
.guest-banner-venue-date {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 16px;
    line-height: 24px;
    text-transform: capitalize;
    color: #ffffff;
    position: relative;
    display: flex;
    flex-wrap: nowrap;
}
.guest-banner-venue-date > span {
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
}
.guest-banner-venue-date > span:nth-child(2) {
    margin: 0 7px;
}

.guest-banner-venue-date > span:nth-child(1)::after {
    content: "";
    position: relative;
    width: 50px;
    height: 2px;
    top: -1px;
    background: #ffffff;
    display: inline-block;
    right: 0;
    z-index: 99999;
}
.guest-banner-venue-date > span:nth-child(3)::before {
    content: "";
    position: relative;
    width: 50px;
    height: 2px;
    top: -1px;
    background: #ffffff;
    display: inline-block;
    right: 0;
    z-index: 99999;
}
.guest-banner-timer {
    display: flex;
    margin: 42px auto;
}
.guest-banner-timer-single {
    background: rgba(255, 255, 255, 0.3);
    box-shadow: 0px 0px 4px 1px rgba(0, 0, 0, 0.25);
    padding: 12px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    margin-right: 12px;
    width: 76px;
    height: 76px;
}
.guest-banner-timer:last-child {
    margin-right: 0;
}
.guest-banner-timer-single > span:nth-child(1) {
    font-family: "Perpetua";
    font-style: normal;
    font-weight: 400;
    font-size: 44.083px;
    line-height: 51px;
    text-align: center;
    display: block;
    color: #ffffff;
}
.guest-banner-timer-single > span:nth-child(2) {
    font-family: "Segoe UI";
    font-style: normal;
    font-weight: 400;
    font-size: 7.62142px;
    line-height: 10px;
    display: block;
    text-align: center;
    color: #ffffff;
}
.guest-banner-slogan > div:nth-child(1) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 24.7422px;
    line-height: 37px;
    text-align: center;
    text-transform: capitalize;
    color: #ffffff;
}
.guest-banner-slogan > div:nth-child(2) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 14.8453px;
    line-height: 22px;
    text-align: center;
    text-transform: lowercase;

    color: #dfdfdf;
}
@media screen and (max-width: 1600px) {
    .guest-banner-cont {
        padding-top: 50%;
    }
}
@media screen and (max-width: 1300px) {
    .guest-banner-cont {
        padding-top: 60%;
    }
}
@media screen and (max-width: 1100px) {
    .guest-banner-cont {
        padding-top: 70%;
    }
}
@media screen and (max-width: 968px) {
    .guest-banner-cont {
        padding-top: 80%;
    }
    .guest-banner-timer {
        margin: 22px auto;
    }
    .guest-banner-timer-single {
        width: 76px;
        height: 76px;
    }
    /* .guest-banner-timer-single > span:nth-child(1) {
        font-size: 60px;
        line-height: 60px;
    } */
    .guest-banner-content {
        top: 28%;
    }
}
@media screen and (max-width: 769px) {
    .wed-host-gallery {
        padding: 14px 0 !important;
    }
    .guest-banner-cont {
        padding-top: 100%;
    }
    .guest-invi-navbar-cont {
        top: 63px;
    }
    .guest-invi-navbar {
        width: 100%;
        max-width: 100% !important;
        border-radius: 0 !important;
    }
    .guest-invi-navbar > .active {
        background: inherit;
        border-radius: 0;
        color: #ffffff;
        font-weight: 700;
    }
    .guest-invi-navbar > .active > span {
        background-color: #ffffff;
    }
    .guest-banner-couple-name {
        margin-top: 1px;
    }
    #story-cont {
        position: relative;
        top: 110px;
        margin-bottom: 107px;
    }
    .all {
        position: relative;
        top: 80px;
    }
}
@media screen and (max-width: 576px) {
    .guest-banner-couple-name > span {
        font-weight: 400;
        font-size: 18.2232px;
        line-height: 24px;
    }
    .guest-banner-couple-name > span:nth-child(2) {
        font-weight: 400;
        font-size: 33.1331px;
        line-height: 49px;
    }
    .guest-banner-accept > button {
        font-weight: 700;
        font-size: 11.3529px;
        line-height: 15px;
        padding: 11px 30px;
    }
    .guest-banner-venue-date {
        font-weight: 500;
        font-size: 10px;
        line-height: 15px;
    }
    .guest-banner-timer-single > span:nth-child(1) {
        font-weight: 400;
        font-size: 35.2648px;
        line-height: 40px;
    }
    .guest-banner-timer-single {
        width: 80px;
    }
    .guest-banner-slogan > div:nth-child(1) {
        font-weight: 400;
        font-size: 10.6195px;
        line-height: 16px;
    }
    .guest-banner-slogan > div:nth-child(2) {
        font-weight: 400;
        font-size: 6.37168px;
        line-height: 10px;
    }
    /* .guest-invi-navbar-cont {
        position: unset;
    } */
    .guest-banner-content {
        top: 8%;
    }
    .guest-invi-navbar-cont {
        top: 56px;
    }
    .all {
        position: relative;
        top: 177px;
    }
    .wed-host-gallery-items > div {
        display: grid;
        grid-template-columns: repeat(2, 1fr) !important;
        grid-auto-rows: max-content;
        padding: 1em;
        grid-column-gap: 1em;
        grid-row-gap: 1.5em;
    }
}
/* Gallery all css start */
.wed-host-gallery {
    background-color: white;
    margin-top: 2em;
    padding: 117px 0;
}

.wed-host-gallery > div:nth-child(1) {
    display: flex;
    justify-content: center;
}

.wed-host-gallery-active {
    font-weight: bold !important;
    color: #7f004b !important;
    border-bottom: 4px solid #7f004b !important;
}

.wed-host-gallery > div:nth-child(1) > div {
    font-family: Roboto;
    font-style: normal;
    font-weight: normal;
    font-size: 17.8211px;
    line-height: 21px;
    color: #968585;
    flex: 1;
    text-align: center;
    padding: 2em 0;
    border-right: 0.891053px solid #cbc7c7;
    border-bottom: 0.891053px solid #cbc7c7;
    cursor: pointer;
}
.wed-host-gallery > div:nth-child(1) > div:last-child {
    border-right: none;
}
.wed-host-gallery-items {
    padding-bottom: 1em;
}
.wed-host-gallery-items > div {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    grid-auto-rows: max-content;
    padding: 1em;
    grid-column-gap: 1em;
    grid-row-gap: 1.5em;
}
.img-cont,
.album-cont {
    position: relative;
    padding-top: 100%;
    border-radius: 20px;
}
.img-cont > img,
.img-cont > video,
.album-cont > img {
    position: absolute;
    top: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 20px;
    z-index: 99;
}
.album-cont > span:nth-child(1) {
    position: absolute;
    top: 15px;
    right: 15px;
    z-index: 999;
    font-family: "Roboto";
    font-style: normal;
    font-weight: 400;
    font-size: 16px;
    line-height: 19px;
    color: #ffffff;
}
.album-cont > span:nth-child(3) {
    position: absolute;
    bottom: 15px;
    left: 15px;
    z-index: 999;
    font-family: "Roboto";
    font-style: normal;
    font-weight: 500;
    font-size: 15px;
    line-height: 18px;
    color: #ffffff;
}
.album-pics {
    /* display: none;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    grid-auto-rows: max-content;
    padding: 1em;
    grid-column-gap: 1em;
    grid-row-gap: 1.5em; */
}
/* .album-pics.active {
    display: grid !important;
}
.album-cont.active {
    display: none !important;
} */

/* Gallery all css end */
</style>
<style></style>


