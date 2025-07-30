<template>
    <div>
        <div class="guest-story-cont container-lg">
            <div class="guest-banner-couple-name">
                <span>{{ invi.groomName }}</span>
                <span>&</span>
                <span>{{ invi.brideName }}</span>
            </div>
            <div>
                <img src="/assets/guestInvi/Frame-5602-1.png" alt="" />
            </div>
            <img
                @click="$emit('editstory')"
                v-if="edit"
                class="edit-story"
                src="/assets/edit.svg"
                alt=""
            />
        </div>
        <div class="guest-story-second">
            <div class="guest-story-head-common">
                <h1>ONCE - UPON - A - TIME</h1>
                <!-- <p>wedding</p> -->
            </div>
            <div class="guest-story-sec-content">
                <div class="guest-story-sec-content-single">
                    <div>
                        <img
                            :src="'/storage//' + ourStory.groom_image"
                            alt=""
                        />
                    </div>
                    <h3>{{ invi.groomName }}</h3>
                    <p>
                        {{ ourStory.groom_desc }}
                    </p>
                </div>
                <div class="guest-story-sec-content-single">
                    <div>
                        <img :src="'/storage/' + ourStory.bride_image" alt="" />
                    </div>
                    <h3>{{ invi.brideName }}</h3>
                    <p>
                        {{ ourStory.bride_desc }}
                    </p>
                </div>
            </div>
        </div>
        <div class="guest-story-timer-cont">
            <!-- <div class="guest-story-timer-text">
                <span>WE ARE WAITING FOR</span>
                The adventure
            </div> -->
            <div class="guest-banner-couple-name">
                <span>{{ invi.groomName }}</span>
                <span>&</span>
                <span>{{ invi.brideName }}</span>
            </div>
            <div class="guest-story-timer">
                <div class="guest-story-timer-single">
                    <span></span>
                    <span>days</span>
                </div>
                <div class="guest-story-timer-single">
                    <span></span>
                    <span>hours</span>
                </div>
                <div class="guest-story-timer-single">
                    <span></span>
                    <span>minutes</span>
                </div>
                <div class="guest-story-timer-single">
                    <span></span>
                    <span>seconds</span>
                </div>
            </div>
        </div>
        <div class="guest-story-timeline-cont">
            <div class="guest-story-head-common">
                <h1>OUR - LOVE STORY - TIMELINE</h1>
                <!-- <p>wedding</p> -->
            </div>
            <div class="guest-story-timeline-all">
                <!-- <div class="guest-story-timeline-single">
                    <div>
                        <img src="/assets/guestInvi/Rectangle196.png" alt="" />
                    </div>
                    <div>
                        <h3>How we met</h3>
                        <h5>{{ourStory.first_meet_date | moment('DD MMMM YYYY')}}</h5>
                        <p>
                            {{ ourStory.firstMeetDescription }}
                        </p>
                    </div>
                </div> -->
                <div class="guest-story-timeline-single reverse">
                    <div>
                        <img
                            :src="'/storage/' + ourStory.first_meet_image"
                            alt=""
                        />
                    </div>
                    <div>
                        <div>
                            <h3>First meet</h3>
                            <h5>
                                {{
                                    ourStory.first_meet_date
                                        | moment("DD MMMM YYYY")
                                }}
                            </h5>
                            <p>
                                {{ ourStory.first_meet }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="guest-story-timeline-single">
                    <div>
                        <img
                            :src="'/storage/' + ourStory.relation_start_image"
                            alt=""
                        />
                    </div>
                    <div>
                        <div>
                            <h3>The day we exchanged our hearts</h3>
                            <h5>
                                {{
                                    ourStory.relation_start_date
                                        | moment("DD MMMM YYYY")
                                }}
                            </h5>
                            <p>
                                {{ ourStory.relation_start }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="guest-story-timeline-single reverse">
                    <div>
                        <img
                            :src="'/storage/' + ourStory.marriage_decide_image"
                            alt=""
                        />
                    </div>
                    <div>
                        <div>
                            <h3>The day we decided to marry</h3>
                            <h5>
                                {{
                                    ourStory.marriage_decide_date
                                        | moment("DD MMMM YYYY")
                                }}
                            </h5>
                            <p>
                                {{ ourStory.marriage_decide }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div
            v-show="ourStory.images.length > 0"
            class="gallery-cont container-lg"
        >
            <h1>Gallery</h1>
            <div id="guest-story-slider" class="splide">
                <div class="splide__track">
                    <ul class="splide__list" style="align-items: stretch">
                        <li
                            v-for="(item, index) in ourStory.images"
                            :key="index"
                            style="border: none !important"
                            class="splide__slide"
                        >
                            <div>
                                <img :src="'/storage/' + item" alt="" />
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- <div v-show="ourStory.images.length > 0" class="guest-story-gallery">
            <div class="guest-story-head-common">
                <h1>OUR - LOVE STORY - GALLERY</h1>
                 <p>wedding</p> 
            </div>
            <section id="image-single-cont" class="splide">
                <div class="splide__track">
                    <ul class="splide__list">
                        <li
                            v-for="(item, index) in ourStory.images"
                            :key="index"
                            class="splide__slide"
                        >
                            <div class="image-single">
                                <img :src="'/storage/' + item" alt="" />
                            </div>
                        </li>
                    </ul>
                </div>
            </section>
        </div> -->
    </div>
</template>

<script>
export default {
    props: ["ourStory", "invi", "edit"],
    data() {
        return {
            splider: null,
        };
    },
    methods: {
        // makeBig() {
        //     let children = $("#image-single-cont ul").children();
        //     let index = null;
        //     let list = [];
        //     children.each((index, item) => {
        //         if (item.classList.contains("is-visible")) {
        //             list.push(item);
        //         }
        //         item.classList.remove("enlarge");
        //     });

        //     let centerIndex = Math.floor(list.length / 2);
        //     list[centerIndex].classList.add("enlarge");
        // },
        spliderEvent() {
            let _this = this;
            this.$nextTick(function () {
                _this.splider = new Splide(`#guest-story-slider`, {
                    gap: 5,
                    rewind: true,
                    pagination: false,
                    cover: true,
                    isNavigation: true,
                    arrows: true,
                    gap: 10,
                    perPage: 3,
                    breakpoints: {
                        768: {
                            perPage: 2,
                        },
                        567: {
                            perPage: 1,
                            padding: { right: "20%" },
                            arrows: false,
                            wheel: true,
                            direction: "ltr",
                            releaseWheel: false,
                        },
                    },
                });
                _this.splider.mount();
            });
            // this.splider.on("ready", function () {
            //     _this.makeBig();
            // });
            // this.splider.on("updated", function () {
            //     _this.makeBig();
            // });
            // this.splider.on("dragged", function () {
            //     _this.makeBig();
            // });
            // this.splider.on("moved", function () {
            //     _this.makeBig();
            // });
            // this.splider.on("active", function () {
            //     _this.makeBig();
            // });
            // this.splider.on("click", function () {
            //     _this.makeBig();
            // });
            // this.splider.on("visible", function () {
            //     _this.makeBig();
            // });
            this.splider.mount();
        },
        countDown() {
            const fixedDate = this.invi.startDate;
            //console.log(fixedDate);
            const deadlineTimer = document.querySelectorAll(
                ".guest-story-timer-single > span:nth-child(1)"
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
    },
    mounted() {
        this.$nextTick(function () {
            this.countDown();
        });
        // document.onreadystatechange = () => {
        //     if (document.readyState == "complete") {
        //         this.spliderEvent();
        //     }
        // };
    },
};
</script>

<style scoped>
.guest-story-cont {
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
.guest-story-cont > div:nth-child(2) {
    padding-top: 40%;
    position: relative;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.4);
    backdrop-filter: blur(17px);
    border-radius: 18px;
}
.guest-story-cont > div:nth-child(2) > img:nth-child(1) {
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
/* .guest-story-cont > img {
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    object-fit: cover;
} */
.edit-story {
    position: absolute;
    top: 20px;
    right: 20px;
    width: 40px !important;
    height: 40px !important;
    z-index: 99999;
}
/* .guest-story-cont > .overlay {
    background: rgba(0, 0, 0, 0.5);
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    z-index: 999;
} */
/* .guest-story-main-img {
    display: flex;
    justify-content: center;
    flex-direction: column;
    align-items: center;
    position: absolute;
    z-index: 999999;
    top: 35%;
}
.guest-story-main-img > div:nth-child(2) > span {
    font-family: "STSong";
    font-style: normal;
    font-weight: 400;
    font-size: 33.861px;
    line-height: 44px;
    text-transform: uppercase;
    color: #ffffff;
}
.guest-story-main-img > div:nth-child(2) > span:nth-child(2) {
    font-family: "Stalemate";
    font-style: normal;
    font-weight: 400;
    font-size: 61.5655px;
    line-height: 90px;
    color: #ffffff;
    margin: 0 15px;
    text-transform: none;
}
.guest-story-main-img > div:nth-child(3) > span {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 21.0056px;
    line-height: 32px;
    color: #ffffff;
} */
.guest-story-head-common {
    background: rgba(255, 255, 255, 0.4);
    backdrop-filter: blur(17px);
    border-radius: 18px;
    width: max-content;
    margin: auto;
    margin-bottom: 15px;
}
.guest-story-head-common > h1 {
    font-family: "Roboto Serif 72pt SemiExpanded";
    font-style: normal;
    font-weight: 400;
    font-size: 30px;
    line-height: 30px;
    padding: 22px 57px;
    letter-spacing: 0.03em;
    color: #000000;
    text-align: center;
}
/* .guest-story-head-common > p {
    font-family: "Stalemate";
    font-style: normal;
    font-weight: 400;
    font-size: 24.4197px;
    line-height: 36px;
    color: #7f004b;
    text-align: center;
} */
.guest-story-second {
    /* padding: 42px; */
    /* background-color: #ffffff; */
    margin-bottom: 20px;
}
.guest-story-sec-content {
    display: flex;
    width: 60%;
    margin: auto;
    justify-content: space-between;
}
.guest-story-sec-content-single {
    width: 45%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
.guest-story-sec-content-single > div {
    background: rgba(255, 255, 255, 0.4);
    backdrop-filter: blur(17px);
    border-radius: 22px;
    position: relative;
    padding-top: 75%;
    width: 100%;
    max-width: 389px;
    max-height: 344px;
}
.guest-story-sec-content-single > div > img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    position: absolute;
    top: 0;
    padding: 22px;
    left: 0;
    border-radius: 37px;
}
.guest-story-sec-content-single > h3 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 25px;
    line-height: 25px;
    color: #000000;
    text-shadow: 8px 10px 33px #ead1bb;
    padding: 20px;
    background: rgba(255, 255, 255, 0.93);
    backdrop-filter: blur(3px);
    border-radius: 13px;
    margin-bottom: 15px;
    margin-top: -38px;
}
.guest-story-sec-content-single > p {
    font-family: "Segoe UI";
    font-style: normal;
    font-weight: 350;
    font-size: 15.0311px;
    line-height: 20px;
    text-align: center;
    color: #000000;
    background: rgba(255, 255, 255, 0.6);
    backdrop-filter: blur(17px);
    border-radius: 22px;
    padding: 10px;
}
.guest-story-timer-cont {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    background: rgba(255, 255, 255, 0.4);
    backdrop-filter: blur(17px);
    border-radius: 18px;
    width: 80%;
    margin: auto;
    margin-bottom: 70px;
    padding: 5px;
    padding-top: 50px;
}
.guest-story-timer-text {
    font-family: "Stalemate";
    font-style: normal;
    font-weight: 400;
    font-size: 55.4022px;
    line-height: 81px;
    color: #ffffff;
    position: relative;
    padding: 10px 5px;
}
.guest-story-timer-text > span {
    position: absolute;
    top: 0;
    right: 0;
    font-family: "Segoe UI";
    font-style: normal;
    font-weight: 600;
    font-size: 9.90557px;
    line-height: 13px;
    letter-spacing: 0.1em;
    color: #ffffff;
    display: inline-block;
}
.guest-story-timer {
    display: flex;
    align-items: center;
    background: rgba(255, 255, 255, 0.93);
    backdrop-filter: blur(3px);
    padding: 30px;
    border-radius: 13px;
    width: max-content;
    margin-bottom: -50px;
}
.guest-story-timer-single {
    border-right: 1px solid #ffc194;
    padding: 12px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    margin-right: 12px;
}
.guest-story-timer-single:last-child {
    margin-right: 0;
    border: 0 !important;
}
.guest-story-timer-single > span:nth-child(1) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 30px;
    line-height: 30px;
    color: #000000;
    text-align: center;
}
.guest-story-timer-single > span:nth-child(2) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 23px;
    line-height: 23px;
    text-align: center;
    letter-spacing: 0.03em;
    color: #000000;
}
.guest-story-timeline-cont {
    /* padding: 48px; */
    /* background-color: white; */
}
.guest-story-timeline-all {
    width: 60%;
    margin: auto;
}
.guest-story-timeline-single {
    display: flex;
    justify-content: center;
}
.guest-story-timeline-single > div:nth-child(2) {
    width: 358px;
    position: relative;
    padding-left: 30px;
    padding-bottom: 48px;
}

.guest-story-timeline-single > div:nth-child(2) > div {
    background: rgba(255, 255, 255, 0.4);
    backdrop-filter: blur(17px);
    border-radius: 18px;
    padding: 15px;
    position: relative;
}
.guest-story-timeline-single > div:nth-child(2) > div::after {
    content: " ";
    height: 0;
    position: absolute;
    top: 22px;
    width: 0;
    z-index: 1;
    border: medium solid rgba(255, 255, 255, 0.5);
    border-width: 10px 0 10px 10px;
    border-color: transparent transparent transparent rgba(255, 255, 255, 0.5);
}
.guest-story-timeline-single > div:nth-child(2) > div::before {
    content: "";
    position: absolute;
    width: 25px;
    height: 25px;
    background-color: transparent;
    border: 4px solid #6f0f12;
    top: 19px;
    border-radius: 50%;
    z-index: 1;
}
.guest-story-timeline-single > div:nth-child(2) > div::after {
    right: unset;
    left: -10px;
    transform: rotate(180deg);
}
.guest-story-timeline-single > div:nth-child(2) > div::before {
    right: unset;
    left: -43px;
}
.guest-story-timeline-single.reverse > div:nth-child(2) > div::after {
    right: -10px;
    left: unset;
    transform: unset;
}
.guest-story-timeline-single.reverse > div:nth-child(2) > div::before {
    right: -42px;
    left: unset;
}
.guest-story-timeline-single > div:nth-child(1) {
    width: 358px;
    height: 314px;
}
.guest-story-timeline-single > div:nth-child(1) {
    padding-right: 30px;
    position: relative;
}
.guest-story-timeline-single > div:nth-child(1) > img {
    width: 100%;
    height: 100%;
    border-radius: 20px;
    object-fit: cover;
}
.guest-story-timeline-single > div:nth-child(2)::before {
    content: "";
    position: absolute;
    width: 1.569208px;
    background: #6f0f12;
    top: 0;
    bottom: 0;
    left: 0;
    margin-left: -1.5px;
}
.guest-story-timeline-single > div:nth-child(2) h3 {
    font-family: "Roboto Serif 72pt SemiExpanded";
    font-style: normal;
    font-weight: 400;
    font-size: 30px;
    line-height: 30px;
    letter-spacing: 0.03em;
    color: #000000;
    transform: rotate(-0.85deg);
    margin-bottom: 7px;
}
.guest-story-timeline-single > div:nth-child(2) h5 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 16px;
    line-height: 16px;
    /* text-align: center; */
    letter-spacing: 0.03em;
    color: #000000;
    transform: rotate(-0.85deg);
    margin-bottom: 10px;
}
.guest-story-timeline-single > div:nth-child(2) p {
    font-style: normal;
    font-weight: 400;
    font-size: 14px;
    line-height: 21px;
    letter-spacing: 0.03em;
    color: #808080;
}
.reverse {
    flex-direction: row-reverse;
}
.guest-story-timeline-single.reverse > div:nth-child(2)::before {
    right: 0 !important;
    left: unset !important;
    margin-left: -1.5px !important;
}
.guest-story-timeline-single.reverse > div:nth-child(1) {
    padding-left: 30px;
    padding-right: 0 !important;
}
.guest-story-timeline-single.reverse > div:nth-child(2) {
    padding-left: 0 !important;
    padding-right: 30px;
}
.gallery-cont {
    background: rgba(255, 255, 255, 0.4);
    backdrop-filter: blur(17px);
    border-radius: 18px;
    padding: 120px 0;
    margin-top: 150px;
}
.gallery-cont > h1 {
    width: max-content;
    background: #ffffff;
    box-shadow: 0px 7px 49px #ffd2b1;
    border-radius: 20px;
    padding: 30px 110px;
    font-family: "Style Script";
    font-style: normal;
    font-weight: 400;
    font-size: 70px;
    line-height: 70px;
    letter-spacing: 0.03em;
    color: #ebaa79;
    margin: auto;
    margin-top: -165px;
}
#guest-story-slider {
    margin-top: 50px;
}
#guest-story-slider div {
    height: 100%;
}
#guest-story-slider img {
    display: block !important;
    border: 2px solid #ffffff;
    border-radius: 20px;
    max-width: 546px;
    max-height: 374px;
    min-width: 250px;
    min-height: 220px;
    object-fit: cover;
    width: 100%;
    height: 100%;
}
/* .guest-story-gallery {
    padding: 42px;
} */
/* #image-single-cont {
    width: 100%;
    display: flex;
    justify-content: center;
}
.image-single {
    width: 179px !important;
    height: 199px !important;
}
.splide__slide.enlarge > .image-single {
    width: 209px !important;
    height: 239px !important;
}
.image-single > img {
    width: 100%;
    height: 100%;
    object-fit: cover;
} */
@media screen and (max-width: 1200px) {
    /* .guest-story-cont {
        padding-top: 55% !important;
    } */
    .guest-story-timeline-all {
        width: 80%;
    }
}
@media screen and (max-width: 968px) {
    .guest-story-timeline-all {
        width: 100%;
    }
    .guest-story-cont > div:nth-child(2) {
        padding-top: 50%;
        margin-left: 20px;
        margin-right: 20px;
    }
    .guest-story-sec-content {
        width: 80%;
    }
}
@media screen and (max-width: 768px) {
    .guest-story-head-common > h1 {
        padding: 22px 15px;
    }
    .guest-banner-couple-name {
        margin-top: 1px;
    }
    .guest-story-main-img {
        top: 18% !important;
    }
    .guest-story-sec-content {
        width: 100% !important;
    }
    .guest-story-timer-cont {
        flex-wrap: wrap;
        justify-content: center;
        padding: 22px 5px;
    }
    .guest-banner-couple-name {
        margin-top: 1px;
    }
    /* .guest-story-timer-cont > div:nth-child(2) {
        width: 100%;
    } */
    .guest-story-timer-single > span:nth-child(1) {
        font-size: 16px;
        line-height: 16px;
        letter-spacing: 0.03em;
    }
    .guest-story-timer-single > span:nth-child(2) {
        font-size: 12px;
        line-height: 12px;
        letter-spacing: 0.03em;
    }
    .guest-story-timer {
        padding: 17px 22px;
        margin-bottom: -35px;
    }
    .guest-story-timeline-single {
        flex-wrap: wrap;
        text-align: center;
    }
    .guest-story-timeline-single > div:nth-child(2) {
        width: 100%;
    }
    .guest-story-timeline-single > div:nth-child(2)::before,
    .guest-story-timeline-single > div:nth-child(2) > div::before,
    .guest-story-timeline-single > div:nth-child(2) > div::after {
        width: 0 !important;
        position: unset !important;
        border: none !important;
    }
    .guest-story-timeline-single > div:nth-child(1) {
        width: 50% !important;
        margin: auto;
        padding-right: 0 !important;
        height: unset !important;
    }
    .guest-story-timeline-single > div:nth-child(2) {
        padding-left: 0 !important;
        padding-right: 0 !important;
    }
}
@media screen and (max-width: 576px) {
    .gallery-cont > h1 {
        padding: 14px 30px;
        font-weight: 400;
        font-size: 40px;
        line-height: 40px;
    }
    .guest-story-timer-cont {
        width: 100%;
    }
    .guest-banner-couple-name > span {
        font-size: 40px;
        line-height: 40px;
        letter-spacing: 0.03em;
    }
    .guest-story-timer {
        padding: 17px 3px;
    }
    .guest-story-cont {
        top: 90px;
        margin-bottom: 130px;
    }
    .guest-story-cont > div:nth-child(2) > img:nth-child(1) {
        padding: 0px;
    }
    .guest-story-cont > div:nth-child(2) {
        margin-left: 2px;
        margin-right: 2px;
        padding-top: 70%;
    }
    .guest-story-timeline-single > div:nth-child(1) {
        width: 80% !important;
    }
    .guest-story-main-img > div:nth-child(2) > span {
        font-weight: 400;
        font-size: 18.2232px;
        line-height: 24px;
    }
    .guest-story-main-img > div:nth-child(2) > span:nth-child(2) {
        font-weight: 400;
        font-size: 33.1331px;
        line-height: 49px;
    }
    .guest-story-main-img > img {
        width: 30px;
        height: 30px;
    }
    .guest-story-main-img > div:nth-child(3) > span {
        font-weight: 500;
        font-size: 10px;
        line-height: 15px;
    }
    .guest-story-main-img > div:nth-child(3) > img {
        width: 70px;
        height: 70px;
    }
    .guest-story-sec-content {
        flex-wrap: wrap;
        row-gap: 15px;
    }
    .guest-story-sec-content-single {
        width: 100%;
    }
    .guest-banner-couple-name > span {
        font-size: 40px;
        line-height: 40px;
        letter-spacing: 0.03em;
    }
    .guest-story-head-common > h1 {
        font-size: 20px;
        line-height: 20px;
    }
}
</style>
<style>
.splide__track--nav > .splide__list > .splide__slide.is-active {
    border: none !important;
}
.splide__list {
    align-items: baseline;
}
</style>
