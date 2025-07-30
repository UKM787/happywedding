<template>
    <div>
        <div class="guest-story-cont">
            <img src="/assets/guestInvi/story-banner.png" alt="" />
            <div class="overlay"></div>
            <div class="guest-story-main-img">
                <img src="/assets/guestInvi/19.svg" alt="" />
                <div>
                    <span>{{ invi?.side == 'bride' ? invi.brideName : invi.groomName }}</span>
                    <span>weds</span>
                    <span>{{ invi?.side == 'groom' ? invi.brideName : invi.groomName }}</span>
                </div>
                <div>
                    <img src="/assets/guestInvi/18.png" alt="" />
                    <span
                        >{{ new Date(invi.startDate).getDate().toString().padStart(2, '0') }}.{{
                            (new Date(invi.startDate).getMonth() + 1).toString().padStart(2, '0')
                        }}.{{ new Date(invi.startDate).getFullYear() }}</span
                    >
                    <img src="/assets/guestInvi/17.png" alt="" />
                </div>
            </div>
            <img
                @click="$emit('editstory')"
                v-if="edit"
                class="edit-story"
                src="/assets/miscellenous/edit.svg"
                alt=""
            />
        </div>
        <div class="guest-story-second">
            <div class="guest-story-head-common">
                <h1>ONCE - UPON - A - TIME</h1>
                <p>wedding</p>
            </div>
            <div v-if="invi.side == 'groom'" class="guest-story-sec-content">
                <div class="guest-story-sec-content-single">
                    <img :src="getImagePath(ourStory.groom_image)" alt="" />
                    <h3>{{ invi.groomName }}</h3>
                    <p>{{ ourStory.groom_desc }}</p>
                </div>
                <div class="guest-story-sec-content-single">
                    <img :src="getImagePath(ourStory.bride_image)" alt="" />
                    <h3>{{ invi.brideName }}</h3>
                    <p>{{ ourStory.bride_desc }}</p>
                </div>
            </div>
            <div v-else class="guest-story-sec-content">
                <div class="guest-story-sec-content-single">
                    <img :src="getImagePath(ourStory.bride_image)" alt="" />
                    <h3>{{ invi.brideName }}</h3>
                    <p>{{ ourStory.bride_desc }}</p>
                </div>
                <div class="guest-story-sec-content-single">
                    <img :src="getImagePath(ourStory.groom_image)" alt="" />
                    <h3>{{ invi.groomName }}</h3>
                    <p>{{ ourStory.groom_desc }}</p>
                </div>
            </div>
        </div>
        <div class="guest-story-timer-cont">
            <div class="guest-story-timer-text">
                <span>WE ARE WAITING FOR</span>
                The adventure
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
        <div v-if="ourStory.first_meet || ourStory.relation_start || ourStory.marriage_decide" class="guest-story-timeline-cont">
            <div class="guest-story-head-common">
                <h1>OUR - LOVE STORY - TIMELINE</h1>
                <p>wedding</p>
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
                <div v-if="ourStory.first_meet" class="guest-story-timeline-single reverse">
                    <div>
                        <img
                            :src="getImagePath(ourStory.first_meet_image)"
                            alt=""
                        />
                    </div>
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
                <div v-if="ourStory.relation_start" class="guest-story-timeline-single">
                    <div>
                        <img
                            :src="getImagePath(ourStory.relation_start_image)"
                            alt=""
                        />
                    </div>
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
                <div v-if="ourStory.marriage_decide" class="guest-story-timeline-single reverse">
                    <div>
                        <img
                            :src="getImagePath(ourStory.marriage_decide_image)"
                            alt=""
                        />
                    </div>
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
        <div v-show="ourStory.images.length > 0" class="guest-story-gallery">
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
                                <img :src="getImagePath(item)" alt="" />
                            </div>
                        </li>
                    </ul>
                </div>
            </section>
        </div>
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
        makeBig() {
            let children = $("#image-single-cont ul").children();
            let index = null;
            let list = [];
            children.each((index, item) => {
                if (item.classList.contains("is-visible")) {
                    list.push(item);
                }
                item.classList.remove("enlarge");
            });

            let centerIndex = Math.floor(list.length / 2);
            list[centerIndex].classList.add("enlarge");
        },
        spliderEvent() {
            let _this = this;
            _this.splider = new Splide("#image-single-cont", {
                type: "slide",
                arrows: true,
                gap: "10px",
                autoWidth: true,
                trimSpace: "move",
                focus: "center",
                isNavigation: true,
                updateOnMove: true,
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
        getImagePath(path) {
            if (!path) return '';
            
            // Check if the path is a full URL
            if (path.startsWith('http://') || path.startsWith('https://')) {
                return path;
            }
            
            // Remove any leading slashes
            const cleanPath = path.replace(/^\/+/, '');
            
            // Check if the path already contains 'storage'
            if (cleanPath.includes('storage/')) {
                return '/' + cleanPath;
            }
            
            // Check if the path contains 'Uploads'
            if (cleanPath.includes('Uploads/')) {
                return '/' + cleanPath;
            }
            
            // Default case - add storage prefix
            return '/storage/' + cleanPath;
        }
    },
    mounted() {
        this.$nextTick(function () {
            this.countDown();
        });
        if(!this.edit){
            document.onreadystatechange = () => {
                if (document.readyState == "complete") {
                    this.spliderEvent();
                }
            };
        }
        
    },
};
</script>

<style scoped>
.guest-story-cont {
    padding-top: 40%;
    position: relative;
    width: 100%;
    height: 100%;
    top: -2px;
    display: flex;
    justify-content: center;
    align-items: center;
}
.guest-story-cont > img {
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    object-fit: cover;
}
.edit-story {
    position: absolute;
    top: 20px;
    right: 20px;
    width: 40px !important;
    height: 40px !important;
    z-index: 99999;
}
.guest-story-cont > .overlay {
    background: rgba(0, 0, 0, 0.5);
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    z-index: 999;
}
.guest-story-main-img {
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
}
.guest-story-head-common > h1 {
    font-family: "Segoe UI";
    font-style: normal;
    font-weight: 600;
    font-size: 21.4893px;
    line-height: 29px;
    letter-spacing: 0.1em;
    color: #7f004b;
    text-align: center;
}
.guest-story-head-common > p {
    font-family: "Stalemate";
    font-style: normal;
    font-weight: 400;
    font-size: 24.4197px;
    line-height: 36px;
    color: #7f004b;
    text-align: center;
}
.guest-story-second {
    padding: 42px;
    background-color: #ffffff;
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
.guest-story-sec-content-single > img {
    width: 164px;
    height: 159px;
    border-radius: 50%;
}
.guest-story-sec-content-single > h3 {
    font-family: "Stalemate";
    font-style: normal;
    font-weight: 400;
    font-size: 37.2728px;
    line-height: 55px;
    letter-spacing: 0.1em;
    color: #7f004b;
    margin-bottom: 15px;
}
.guest-story-sec-content-single > p {
    font-family: "Segoe UI";
    font-style: normal;
    font-weight: 350;
    font-size: 15.0311px;
    line-height: 20px;
    text-align: center;

    color: #000000;
}
.guest-story-timer-cont {
    display: flex;
    justify-content: space-between;
    padding: 48px 60px;
    background-image: url("/assets/guestInvi/Frame5036.png");
    background-repeat: no-repeat;
    background-position: 0 0;
    background-size: 100% 100%;
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
}
.guest-story-timer-single {
    background: #ffffff;
    backdrop-filter: blur(2.27683px);
    padding: 12px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    margin-right: 12px;
    width: 85px;
    height: 76px;
}
.guest-story-timer:last-child {
    margin-right: 0;
}
.guest-story-timer-single > span:nth-child(1) {
    font-family: "Segoe UI";
    font-style: normal;
    font-weight: 400;
    font-size: 33.236px;
    line-height: 44px;
    display: block;
    text-align: center;
    color: #7f004b;
}
.guest-story-timer-single > span:nth-child(2) {
    font-family: "Segoe UI";
    font-style: normal;
    font-weight: 350;
    font-size: 13.2163px;
    line-height: 18px;
    color: #5a5a5a;
    display: block;
    text-align: center;
}
.guest-story-timeline-cont {
    padding: 48px;
    background-color: white;
}
.guest-story-timeline-all {
    width: 60%;
    margin: auto;
}
.guest-story-timeline-single {
    display: flex;
    justify-content: center;
    margin-bottom: 48px;
}
.guest-story-timeline-single > div:nth-child(2) {
    width: 358px;
    padding-left: 30px;
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
    object-fit: cover;
}
.guest-story-timeline-single > div:nth-child(1)::after {
    content: "";
    position: absolute;
    width: 0.569208px;
    background: #c4c4c4;
    top: 0;
    bottom: 0;
    right: 0;
    margin-left: -1px;
}
.guest-story-timeline-single > div:nth-child(2) > h3 {
    font-family: "Cinzel";
    font-style: normal;
    font-weight: 700;
    font-size: 20.8484px;
    line-height: 28px;
    color: #6f0f12;
    transform: rotate(-0.85deg);
    margin-bottom: 7px;
}
.guest-story-timeline-single > div:nth-child(2) > h5 {
    font-family: "Stalemate";
    font-style: normal;
    font-weight: 400;
    font-size: 14.6701px;
    line-height: 22px;
    color: #000000;
    margin-bottom: 10px;
}
.guest-story-timeline-single > div:nth-child(2) > p {
    font-family: "Segoe UI";
    font-style: normal;
    font-weight: 350;
    font-size: 16.5823px;
    line-height: 22px;
    color: #808080;
}
.reverse {
    flex-direction: row-reverse;
}
.guest-story-timeline-single.reverse > div:nth-child(1)::after {
    left: 0 !important;
    margin-left: -1px !important;
}
.guest-story-timeline-single.reverse > div:nth-child(1) {
    padding-left: 30px;
    padding-right: 0 !important;
}
.guest-story-timeline-single.reverse > div:nth-child(2) {
    padding-left: 0 !important;
    padding-right: 30px;
}
.guest-story-gallery {
    padding: 42px;
}
#image-single-cont {
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
}
@media screen and (max-width: 1200px) {
    .guest-story-cont {
        padding-top: 55% !important;
    }
    .guest-story-timeline-all {
        width: 80%;
    }
}
@media screen and (max-width: 968px) {
    .guest-story-timeline-all {
        width: 100%;
    }
}
@media screen and (max-width: 768px) {
    .guest-story-main-img {
        top: 18% !important;
    }
    .guest-story-sec-content {
        width: 100% !important;
    }
    .guest-story-timer-cont {
        flex-wrap: wrap;
        justify-content: center;
        padding: 22px 60px;
    }
    .guest-story-timer-cont > div:nth-child(2) {
        width: 100%;
    }
    .guest-story-timer {
        justify-content: center;
    }
    .guest-story-timeline-single {
        flex-wrap: wrap;
        text-align: center;
    }
    .guest-story-timeline-single > div:nth-child(2) {
        width: 100%;
    }
    .guest-story-timeline-single > div:nth-child(1)::after {
        width: 0 !important;
        position: unset !important;
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



