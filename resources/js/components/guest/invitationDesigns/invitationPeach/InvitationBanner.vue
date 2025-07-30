<template>
    <div class="guest-peach-main-cont">
        <div class="guest-invi-navbar-cont">
            <div class="guest-invi-navbar container">
                <a :href="route('guestwelcome.index', guest)">
                    <span v-if="screenWidth < 768">
                        <img src="/assets/guestDash/home.svg" alt="" />
                    </span>
                    Welcome
                </a>
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
            <div ref="banner" class="container-lg guest-banner-cont">
                <div class="guest-banner-couple-name">
                    <span>{{ invitation.groomName }}</span>
                    <span>&</span>
                    <span>{{ invitation.brideName }}</span>
                </div>
                <div>
                    <img src="/assets/guestInvi/Frame-5602-1.png" alt="" />
                </div>
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
                :accomodationInfo="accomodationInfo"
                :guestAccommodationInfo="guestAccommodationInfo"
                @acc="(n) => (invitation = n)"
                @help="scrollToTargetAdjusted('helpLine')"
                style="padding-bottom: 97px"
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
                style="margin-top: -70px"
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
                        v-for="(item, index) in galleries"
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
    </div>
</template>

<script>
import guestCeramony from "../invitationPeach/InvitationCeramony.vue";
import guestAccommodation from "../invitationPeach/InvitationAccommodation.vue";
import guestLogistics from "../invitationPeach/InvitationLogistics.vue";
import guestGallery from "../invitationPeach/InvitationGallery.vue";
import guestHelpline from "../invitationPeach/InvitationHelpline.vue";
import guestStory from "../invitationPeach/InvitationStory.vue";
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
            ceramonyList: this.ceramonies,
            loggedIn: this.guest,
            invitation: this.inviStatus,
            familyList: this.family,
            helpLineList: this.helpLine,
            disableReact: false,
            message: null,
            active: "banner",
            showStory: false,
            showAllGallery: false,
            activeGallery: "Pictures",
            clickedAlbum: [],
            screenWidth: window.screen.width,
        };
    },
    methods: {
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
                this.$refs.story.spliderEvent();
            }
        });
        document.onreadystatechange = () => {
            if (document.readyState == "complete") {
                this.$refs.gallery.setSplider();
            }
        };
    },
};
</script>

<style scoped>
.guest-peach-main-cont {
    background: url(/storage/guestInvitation/Peach/Background.png);
    background-size: 100%;
    background-position: 0 0;
}
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
    top: 160px;
    position: relative;
    margin: 0 auto;
    padding-left: 0;
    padding-right: 0;
    margin-bottom: 240px;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}

.guest-banner-cont > div:nth-child(2) {
    padding-top: 40%;
    position: relative;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.4);
    backdrop-filter: blur(17px);
    border-radius: 18px;
}
.guest-banner-cont > div:nth-child(2) > img:nth-child(1) {
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    object-fit: cover;
    border: 3px solid #ffffff;
    border-radius: 6px;
    padding: 16px;
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
    text-align: center;
    width: 100%;
    text-align: center;
}
.guest-banner-couple-name > span {
    font-family: "Style Script";
    font-style: normal;
    font-weight: 400;
    font-size: 70px;
    line-height: 70px;
    text-transform: capitalize;
    letter-spacing: 0.03em;
    color: #04220b;
}

.guest-banner-timer {
    display: flex;
    margin: auto;
    position: absolute;
    bottom: 0%;
    background: rgba(255, 255, 255, 0.93);
    backdrop-filter: blur(3px);
    padding: 30px;
    border-radius: 13px;
    margin-bottom: -60px;
}
.guest-banner-timer-single {
    border-right: 1px solid #ffc194;
    padding: 12px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    margin-right: 12px;
}
.guest-banner-timer-single:last-child {
    margin-right: 0;
    border: 0 !important;
}
.guest-banner-timer-single > span:nth-child(1) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 30px;
    line-height: 30px;
    color: #000000;
    text-align: center;
}
.guest-banner-timer-single > span:nth-child(2) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 23px;
    line-height: 23px;
    text-align: center;
    letter-spacing: 0.03em;
    color: #000000;
}
@media screen and (max-width: 992px) {
    .guest-banner-cont > div:nth-child(2) {
        padding-top: 50%;
        margin-left: 20px;
        margin-right: 20px;
    }
    /* .guest-banner-timer {
        margin: 22px auto;
    } */
    /* .guest-banner-timer-single {
        width: 76px;
        height: 76px;
    } */
    /* .guest-banner-timer-single > span:nth-child(1) {
        font-size: 60px;
        line-height: 60px;
    } */
    /* .guest-banner-content {
        top: 28%;
    } */
}
@media screen and (max-width: 769px) {
    .guest-banner-timer-single > span:nth-child(1) {
        font-size: 16px;
        line-height: 16px;
        letter-spacing: 0.03em;
    }
    .guest-banner-timer-single > span:nth-child(2) {
        font-size: 12px;
        line-height: 12px;
        letter-spacing: 0.03em;
    }
    .guest-banner-timer {
        padding: 17px 22px;
        margin-bottom: -35px;
    }

    .wed-host-gallery {
        padding: 14px 0 !important;
    }
    /* .guest-banner-cont {
        padding-top: 100%;
    } */
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
    .guest-banner-cont > div:nth-child(2) > img:nth-child(1) {
        padding: 0px;
    }
    .guest-banner-cont > div:nth-child(2) {
        margin-left: 2px;
        margin-right: 2px;
        padding-top: 70%;
    }
    .guest-banner-timer {
        padding: 17px 3px;
    }
    .guest-banner-couple-name > span {
        font-size: 40px;
        line-height: 40px;
        letter-spacing: 0.03em;
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
    .guest-invi-navbar-cont {
        top: 56px;
    }
    .all {
        position: relative;
        top: 43px;
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
    background: rgba(255, 255, 255, 0.4);
    backdrop-filter: blur(17px);
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
