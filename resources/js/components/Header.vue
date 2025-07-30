<template>
    <div>
        <div class="landing-header-cont">
            <div class="landing-header-left">
                <img
                    @click="toggleNavLinks = !toggleNavLinks"
                    style="display: none"
                    src="/assets/landing_page/Frame_5038.svg"
                    alt=""
                />
                <a style="margin-left: 10px" href="/"
                    ><img
                        @click="window.location = '/'"
                        src="/assets/landing_page/logo.svg"
                        alt=""
                /></a>
            </div>
            <div class="landing-header-middle">
                <a href="/" class="active">HOME</a>
                <a href="/manager-tools">MANAGER TOOLS</a>
                <a href="/directory/vendors/venues">Wedding venues</a>
                <a href="/ideas-and-inspiration">Ideas and inspiration</a>
                <a href="/vendor-directory">Wedding vendors</a>
            </div>
            <div class="landing-header-middle-2">
                <a style="margin-left: 10px" href="/"
                    ><img
                        @click="window.location = '/'"
                        src="/assets/landing_page/logo.svg"
                        alt=""
                /></a>
            </div>
            <div class="landing-header-right">
                <div v-if="loggedIn">
                    <a id="dashboard-btn" :href="href">Dashboard</a>
                    <a
                        id="logout-btn"
                        :href="route('logoutAll')"
                        @click.prevent="logout()"
                        >LOGOUT</a
                    >
                    
                    <a
                        :href="route('logoutAll')"
                        @click.prevent="logout()"
                        style="display: none"
                    >
                        <i
                            style="
                                width: 28px;
                                height: 28px;
                                border-radius: 50%;
                            "
                            class="fas fa-sign-out-alt"
                        ></i>
                    </a>
                    <a :href="href" style="display: none"
                        ><img
                            style="
                                width: 28px;
                                height: 28px;
                                border-radius: 50%;
                            "
                            src="/storage/defaultsv1/avatar.png"
                            alt=""
                    /></a>
                </div>
                <div v-else class="d-flex justify-content-space-around">
                    <a :href="route('hostLogin')"
                        ><img
                            src="/assets/landing_page/ic_round-log-in.svg"
                            alt=""
                        />Host</a
                    >
                    <a :href="route('login')"
                        ><img
                            src="/assets/landing_page/fluent_guest-16-regular.svg"
                            alt=""
                        />Guests</a
                    >
                    <a
                        class="mx-1"
                        :href="route('hostLogin')"
                        style="display: none"
                        ><img
                            src="/assets/landing_page/ic_round-log-in.svg"
                            alt=""
                    /></a>
                    <a class="mx-1" :href="route('login')" style="display: none"
                        ><img
                            src="/assets/landing_page/fluent_guest-16-regular.svg"
                            alt=""
                    /></a>
                </div>
            </div>
        </div>
        <div v-show="toggleNavLinks" class="landing-mobile-links">
            <a href="/" class="landing-mobile-links-single active">
                <div>
                    <img src="/assets/landing_page/2.svg" alt="" />
                </div>
                <p>Home</p>
            </a>
            <a href="/manager-tools" class="landing-mobile-links-single">
                <div>
                    <img src="/assets/landing_page/3.svg" alt="" />
                </div>
                <p>Manager Tools</p>
            </a>
            <a href="/wedding-venues" class="landing-mobile-links-single">
                <div>
                    <img src="/assets/landing_page/4.svg" alt="" />
                </div>
                <p>Wedding Venues</p>
            </a>
            <a
                href="/ideas-and-inspiration"
                class="landing-mobile-links-single"
            >
                <div>
                    <img src="/assets/landing_page/3.svg" alt="" />
                </div>
                <p>Ideas & Insipiration</p>
            </a>
             <a href="/vendor-directory" class="landing-mobile-links-single">
                <div>
                    <img src="/assets/landing_page/2.svg" alt="" />
                </div>
                <p>Directory</p>
            </a> 
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
    data() {
        return {
            toggleNavLinks: false,
            loggedIn: false,
            href: "#",
            csrf: $('meta[name="csrf-token"]').attr("content"),
        };
    },
    methods: {
        logout() {
            this.$refs.logout.submit();
        },
        activeLink() {
            let path = window.location.pathname.substring(1);
            let finalPath = path.split("/")[0];

            let elements = $(".landing-header-middle > a");
            let mobileEle = $(".landing-mobile-links-single");
            elements.each(function (index, item) {
                $(item).removeClass("active");
            });
            mobileEle.each(function (index, item) {
                $(item).removeClass("active");
            });
            // console.log(finalPath, path);
            if (finalPath == "") {
                $(elements[0]).addClass("active");
                $(mobileEle[0]).addClass("active");
            } else if (finalPath == "manager-tools") {
                $(elements[1]).addClass("active");
                $(mobileEle[1]).addClass("active");
            } else if (finalPath == "wedding-venues") {
                $(elements[2]).addClass("active");
                $(mobileEle[2]).addClass("active");
            } else if (finalPath == "directory") {
                $(elements[2]).addClass("active");
                $(mobileEle[2]).addClass("active");
            } else if (finalPath == "ideas-and-inspiration") {
                $(elements[3]).addClass("active");
                $(mobileEle[3]).addClass("active");
            }
        },
        getAuthenticatedUser() {
            let _this = this;
            axios
                .get("/api/authcheck")
                .then(function (response) {
                    if (response.data == "False") {
                        _this.href = "#";
                        _this.loggedIn = false;
                    } else {
                        _this.loggedIn = true;
                        _this.href = `/${response.data}/welcome`;
                    }
                })
                .catch((error) => {
                    console.log(error.response);
                });
        },
        hideMobileToggleLinks() {
            let wid = screen.width;
            if (wid > 992) {
                this.toggleNavLinks = false;
            }
        },
    },
    mounted() {
        this.$nextTick(function () {
            this.getAuthenticatedUser();
            this.activeLink();
            this.hideMobileToggleLinks();
        });
        window.addEventListener("resize", this.hideMobileToggleLinks);
    },
};
</script>

<style src="../../css/header.css"></style>
