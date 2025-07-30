<template>
    <div class="guest-invi-navbar-cont">
        <div class="container-lg px-0">
            <div id="nav-slider" class="splide">
                <div
                    class="splide__track"
                    style="background: #461952; border-radius: 27px"
                >
                    <ul class="splide__list guest-invi-navbar">
                        <li class="splide__slide">
                            <a
                                :href="route('hostwelcome')"
                                :class="{ active: active == 'home' }"
                                ref="home"
                            >
                                <span v-if="screenWidth < 768">
                                    <img
                                        src="/assets/hosthome/home.svg"
                                        alt=""
                                    />
                                </span>
                                Home
                            </a>
                        </li>
                        <li class="splide__slide">
                            <a
                                :href="route('hostinvitations.index')"
                                :class="{ active: active == 'invitation' }"
                                ref="invitation"
                            >
                                <span v-if="screenWidth < 768">
                                    <img
                                        src="/assets/hosthome/invitation.svg"
                                        alt=""
                                    />
                                </span>
                                Invitation
                            </a>
                        </li>
                        <li class="splide__slide">
                            <a
                                :href="
                                    route(
                                        'invitedguests.custom',
                                        invi?.slug ?? ''
                                    )
                                "
                                :class="{ active: active == 'guests' }"
                                ref="guests"
                            >
                                <span v-if="screenWidth < 768">
                                    <img
                                        src="/assets/invitation/guests.svg"
                                        alt=""
                                    />
                                </span>
                                Guest Book
                            </a>
                        </li>
                         <li class="splide__slide">
                            <a
                                href="/host/members"
                                :class="{ active: active == 'members' }"
                                ref="members"
                            >
                                <span v-if="screenWidth < 768">
                                    <img
                                        src="/assets/hosthome/members.svg"
                                        alt=""
                                    />
                                </span>
                                Members
                            </a>
                        </li>
                        <li class="splide__slide">
                            <a
                                :href="route('hosttasks.index')"
                                :class="{ active: active == 'tasklist' }"
                                ref="tasklist"
                            >
                                <span v-if="screenWidth < 768">
                                    <img
                                        src="/assets/hosthome/tasklist.svg"
                                        alt=""
                                    />
                                </span>
                                Task Management
                            </a>
                        </li> 
                        <li class="splide__slide">
                            <a
                                href="/host/logistics"
                                :class="{ active: active == 'logistics' }"
                                ref="logistics"
                            >
                                <span v-if="screenWidth < 768">
                                    <img
                                        src="/assets/hosthome/logistics.svg"
                                        alt=""
                                    />
                                </span>
                                Logistics
                            </a>
                        </li>
                        <li class="splide__slide">
                            <a
                                href="/host/accommodation"
                                :class="{ active: active == 'accommodation' }"
                                ref="accommodation"
                            >
                                <span v-if="screenWidth < 768">
                                    <img
                                        src="/assets/hosthome/accommodation.svg"
                                        alt=""
                                    />
                                </span>
                                Accommodation
                            </a>
                        </li>
                        <li class="splide__slide">
                            <a
                                href="/host/gallery"
                                :class="{ active: active == 'gallery' }"
                                ref="gallery"
                            >
                                <span v-if="screenWidth < 768">
                                    <img
                                        src="/assets/hosthome/gallery.svg"
                                        alt=""
                                    />
                                </span>
                                Gallery
                            </a>
                        </li>
                        <li class="splide__slide">
                            <a
                                href="/host/reports"
                                :class="{ active: active == 'reports' }"
                                ref="reports"
                            >
                                <span v-if="screenWidth < 768">
                                    <img
                                        src="/assets/hosthome/reports.svg"
                                        alt=""
                                    />
                                </span>
                                Reports
                            </a>
                        </li>
                        <!-- <a
                                :href="route('subscribePage')"
                                :class="{ active: active == 'subscribe' }"
                                ref="subscribe"
                            >
                                <span v-if="screenWidth < 768">
                                    <img src="/assets/hosthome/reports.svg" alt="" />
                                </span>
                                Subscribe
                            </a> -->
                        <!-- <a
                                :href="route('subscribeReccuringPage')"
                                :class="{ active: active == 'subscribeReccuring' }"
                                ref="subscribeReccuring"
                            >
                                <span v-if="screenWidth < 768">
                                    <img src="/assets/hosthome/reports.svg" alt="" />
                                </span>
                                Subscribe Reccuring
                            </a> -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["link", "invitation"],
    data() {
        return {
            active: this.link,
            invi: this.invitation,
            screenWidth: window.screen.width,
            cont: null,
        };
    },
    methods: {
        handleImageError(event) {
            event.target.src = "/assets/hosts/hostDefault.png";
        },
        setSplider() {
            let _this = this;
            this.$nextTick(function () {
                const navSlider = document.querySelector('#nav-slider');
                if (!navSlider) {
                    console.log('nav-slider element not found');
                    return;
                }
                
                _this.cont = new Splide(`#nav-slider`, {
                    perMove: 3,
                    rewind: true,
                    pagination: false,
                    isNavigation: true,
                    arrows: true,
                    autoWidth: true,
                    breakpoints: {
                        567: {
                            arrows: false,
                            wheel: true,
                            direction: "ltr",
                            releaseWheel: false,
                        },
                    },
                });
                _this.cont.mount();
            });
        },
        setinvi(data) {
            this.invi = data;
        },
        setWidth() {
            this.screenWidth = window.screen.width;
        },
    },
    created() {
        this.$root.$on("updateinvi", this.setinvi);
    },
    mounted() {
        console.log('nav mount');
        
        document.onreadystatechange = () => {
            if (document.readyState == "complete") {
                console.log('nav splide');
                setTimeout(() => {
                    this.setSplider();
                }, 100);
            }
        };
        
        window.addEventListener("resize", this.setWidth);
        this.$nextTick(() => {
            if(this.$refs[this.link]){
                this.$refs[this.link].scrollIntoView({
                    behavior: "smooth",
                    block: "start",
                    inline: "nearest",
                });
            }
        });
    },
};
</script>

<style scoped>
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
    padding: 8px 13px !important;
}
/* .guest-invi-navbar::-webkit-scrollbar {
    display: none;
} */
.guest-invi-navbar a {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 15px;
    line-height: 22px;
    text-align: center;
    color: #9a9a9a;
    padding: 8px 40px;
    cursor: pointer;
    white-space: nowrap;
    text-decoration: none;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
.guest-invi-navbar a > span {
    width: 46px;
    height: 46px;
    margin-bottom: 25px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    background: rgba(255, 255, 255, 0.1);
}
.guest-invi-navbar .active {
    background: #ffffff;
    border-radius: 23px;
    color: #461952;
    font-weight: 700;
}
.guest-invi-navbar > li {
    border: none !important;
}
/* Navbar css end */
@media screen and (max-width: 768px) {
    .guest-invi-navbar-cont {
        top: 61px;
    }
    .guest-invi-navbar {
        width: 100%;
        max-width: 100% !important;
        border-radius: 0 !important;
    }
    .guest-invi-navbar .active {
        background: inherit;
        border-radius: 0;
        color: #ffffff;
        font-weight: 700;
    }
    .guest-invi-navbar .active > span {
        background-color: #ffffff;
    }
    .splide__track {
        border-radius: 0 !important;
    }
}
@media screen and (max-width: 576px) {
    .guest-invi-navbar-cont {
        top: 56px;
    }
}
</style>



















