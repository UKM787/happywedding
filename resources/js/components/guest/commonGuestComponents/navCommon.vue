<template>
    <div class="guest-invi-navbar-cont">
        <div class="guest-invi-navbar">
            <div
                :class="{ active: active == 'welcome' }"
                @click="$emit('menuchange', 'welcome')"
            >
                <span v-if="screenWidth < 768">
                    <img src="/assets/guestDash/home.svg" @error="handleImageError" alt="Home" />
                </span>
                Welcome
            </div>
            <!-- <div
                :class="{ active: active == 'new' }"
                @click="$emit('menuchange', 'new')"
            >
                <span v-if="screenWidth < 768">
                    <img src="/assets/guestDash/new.svg" alt="" />
                </span>
                Invitation
            </div>
            <div
                :class="{ active: active == 'accepted' }"
                @click="$emit('menuchange', 'accepted')"
            >
                <span v-if="screenWidth < 768">
                    <img src="/assets/guestDash/going-invi.svg" alt="" />
                </span>
                Going
            </div>
            <div
                :class="{ active: active == 'pending' }"
                @click="$emit('menuchange', 'pending')"
            >
                <span v-if="screenWidth < 768">
                    <img src="/assets/guestDash/pending-invi.svg" alt="" />
                </span>
                Pending
            </div>
            <div
                :class="{ active: active == 'declined' }"
                @click="$emit('menuchange', 'declined')"
            >
                <span v-if="screenWidth < 768">
                    <img src="/assets/guestDash/decline-invi.svg" alt="" />
                </span>
                Declined
            </div> -->
        </div>
    </div>
</template>

<script>
export default {
    props: ["link", "user"],
    data() {
        return {
            active: this.link,
            screenWidth: window.screen.width,
        };
    },
    methods: {
        setWidth() {
            this.screenWidth = window.screen.width;
        },
        handleImageError(event) {
            // Try alternative paths or use a fallback icon
            console.warn('Image not found:', event.target.src);
            
            // Replace with a fallback image that definitely exists
            event.target.src = "/assets/icons/home.svg";
            
            // If that fails too, use a simple home icon from Font Awesome or similar
            event.target.onerror = function() {
                // Replace the img with an icon element
                const iconElement = document.createElement('i');
                iconElement.className = 'fas fa-home';
                event.target.parentNode.replaceChild(iconElement, event.target);
            };
        }
    },
    mounted() {
        window.addEventListener("resize", this.setWidth);
    },
    watch: {
        link: function (newVal, oldVal) {
            // watch it
            this.active = newVal;
        },
    },
};
</script>

<style scoped>
.guest-invi-navbar-cont {
    position: absolute;
    display: flex;
    justify-content: center;
    top: 91px;
    /* z-index: 9999999999; */
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
.guest-invi-navbar > div {
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
.guest-invi-navbar > div > span {
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
@media screen and (max-width: 768px) {
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
}
@media screen and (max-width: 576px) {
    .guest-invi-navbar-cont {
        top: 56px;
    }
}
</style>


