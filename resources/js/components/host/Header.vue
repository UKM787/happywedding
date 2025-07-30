<template>
    <div
        style="
            overflow-x: hidden;
            position: fixed;
            top: 0;
            z-index: 9999999;
            width: 100%;
        "
    >
        <div class="landing-header-cont">
            <div class="landing-header-left">
                <a href="/"
                    ><img src="/assets/landing_page/logo.svg" alt=""
                /></a>
            </div>
            <div class="landing-header-right">
                <a :href="route('profile.index')" class="profile-img">
                    <img
                        v-if="
                            loggedIn?.profile?.imageOne &&
                            loggedIn?.profile?.imageOne !=
                                '/defautlsv1/avatar.png'
                        "
                        :src="
                            '/assets/hosts/uploads/' + loggedIn.profile.imageOne
                        "
                        alt=""
                    />
                    <img v-else src="/storage/guests/guestDefault.png" alt="" />
                </a>
                <!-- <div class="common-head">
                    {{ loggedIn.name }}
                </div> -->
                <!-- <div class="common-head">
                    <img src="/assets/hosthome/bell.svg" alt="" />
                </div> -->
                <a
                    :href="route('logoutAll')"
                    @click.prevent="logout()"
                    class="common-head"
                >
                    <img src="/assets/hosthome/iconoir_log-out.svg" alt="" />
                </a>
            </div>
        </div>
        <form
            style="display: none"
            :action="route('logoutAll')"
            method="POST"
            ref="logout"
        >
            <input type="hidden" name="_token" v-bind:value="csrf" />
            <input type="hidden" name="logoutAll" :value="true" />
        </form>
    </div>
</template>

<script>
export default {
    props: ["loggedIn"],
    data() {
        return {
            href: "#",
            csrf: $('meta[name="csrf-token"]').attr("content"),
        };
    },
    methods: {
        logout() {
            this.$refs.logout.submit();
        },
    },
    mounted() {
        this.$nextTick(function () {});
    },
};
</script>

<style scoped>
.landing-header-cont {
    display: flex;
    background-color: #461952;
    justify-content: space-between;
    padding: 5px 15px;
}
.landing-header-left {
    /* width: 10%; */
    display: flex;
    justify-content: space-between;
}
.landing-header-left > a > img {
    width: 80%;
    margin-bottom: 7px;
}
.landing-header-right {
    display: flex;
    align-items: center;
    justify-content: flex-end;
}
.landing-header-right > div,
.landing-header-right > a {
    margin-right: 12px;
    display: block;
}
.landing-header-right > .profile-img > img {
    width: 35px;
    height: 35px;
    border-radius: 50%;
}
.landing-header-right > .common-head {
    background: rgba(200, 189, 189, 0.1);
    border-radius: 10px;
    padding: 8px;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 13.7222px;
    line-height: 21px;
    color: #ffffff;
}

@media only screen and (max-width: 992px) {
    .landing-header-right {
        justify-content: flex-end;
    }
    .landing-header-left > img:nth-child(1) {
        display: block !important;
    }
}
</style>
