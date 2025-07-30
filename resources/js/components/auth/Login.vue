<template>
    <div class="login-main-cont">
        <div class="login-left-cont">
            <div class="login-form-cont">
                <h1>Welcome to Happywed!</h1>
                <p class="hide-mobile" v-if="url === 'host'">
                    Wedding Organizers! you have access to a range of tools that
                    make managing your wedding events easier. Login now to
                    create and manage your wedding invitations, track RSVPs, and
                    communicate with your guests.
                </p>
                <p class="hide-mobile" v-else-if="url === 'vendor'">
                    Vendors! As a member of our community, you have access to
                    our platform to showcase your professional services to
                    couples seeking your expertise. Simply log in to your
                    account to manage your business and connect with potential
                    clients.
                </p>
                <p class="hide-mobile" v-else-if="url === 'guest'">
                    Guests! you can log in to your account to view your wedding
                    invitation, RSVP, and provide your family member's details,
                    as well as your arrival and departure details. Log in now to
                    ensure your attendance is counted and you don't miss out on
                    any important wedding details.
                </p>
                <p v-else>Welcome! Wedding Community Members</p>

                <!-- login with password -->
                <form
                    @submit.prevent
                    v-if="loginWithOtp == false"
                    method="POST"
                >
                    <input type="hidden" name="_token" v-bind:value="csrf" />
                    <label for="email" class="login-form-group">
                        Mobile
                        <input
                            type="text"
                            name="email"
                            id="email"
                            v-model="email"
                            @change="emptyData()"
                            @input="emptyData()"
                        />
                        <span
                            v-if="errorSubmit && errorSubmit.email"
                            class="errMsg"
                            >{{ errorSubmit.email[0] }}</span
                        >
                        <span v-if="msgerr" class="errMsg">
                        {{ msgerr }}</span>
                    </label>

                    <div
                        v-if="multiUsersExist == true"
                        class="multiple-users"
                        style="display: flex; justify-content: space-between"
                    >
                        <span
                            @click="
                                selectedUser = item;
                                active = item;
                            "
                            :class="selectedUser == item ? 'active' : ''"
                            v-for="(item, index) in multiUsers"
                            :key="index"
                        >
                            {{ item }}
                        </span>
                    </div>
                    <div
                        v-if="
                            (userExists && multiUsersExist == false) ||
                            selectedUser != null
                        "
                    >
                        <label for="password" class="login-form-group">
                            Password
                            <input
                                :type="showPass"
                                name="password"
                                id="pass"
                                v-model="password"
                            />
                            <img
                                @click="showPass = 'text'"
                                v-if="showPass == 'password'"
                                src="/assets/login/eye.svg"
                                alt=""
                            />
                            <img
                                @click="showPass = 'password'"
                                v-if="showPass == 'text'"
                                src="/assets/login/eye-off.svg"
                                alt=""
                            />
                            <span
                                v-if="errorSubmit && errorSubmit.password"
                                class="errMsg"
                                >{{ errorSubmit.password[0] }}</span
                            >
                        </label>

                        <div class="forn-grp-dbl">
                            <label
                                for="remember_token"
                                class="login-form-group"
                                style="flex-direction: row"
                            >
                                <input
                                    type="checkbox"
                                    name="remember_token"
                                    id="remember_token"
                                    value="true"
                                    v-model="remember_token"
                                />
                                <span>Keep me logged in</span>
                            </label>
                            <a
                                class="forgot-link"
                                :href="route(url + 'password.request')"
                                >Forgot Password?</a
                            >
                        </div>
                    </div>
                    <span v-if="errMsg" class="errMsg">{{ errMsg }}</span>
                    <button
                        v-if="selectedUser == null"
                        @click="checkUserExists()"
                        type="button"
                        :disabled="disableLogIn"
                    >
                        Continue
                    </button>
                    <button
                        v-if="selectedUser != null"
                        @click="loginUser"
                        type="button"
                        :disabled="disableLogIn"
                    >
                        Log In
                    </button>
                </form>
                <!-- login with otp -->
                <form v-if="loginWithOtp == true" @submit.prevent="verifyOtp">
                    <!-- <input type="hidden" name="_token" v-bind:value="csrf" /> -->
                    <label for="email" class="login-form-group">
                        Mobile
                        <input
                            type="text"
                            name="mobile"
                            id="mobile"
                            v-model="email"
                        />
                        <span
                            v-if="asyncErrorSubmit && asyncErrorSubmit.mobile"
                            class="errMsg"
                            >{{ asyncErrorSubmit.mobile[0] }}</span
                        >
                        <span v-if="msgerr" class="errMsg">
                        {{ msgerr }}</span>
                    </label>

                    <div
                        v-if="multiUsersExist == true"
                        class="multiple-users"
                        style="display: flex; justify-content: space-between"
                    >
                        <span
                            @click="
                                selectedUser = item;
                                active = item;
                            "
                            v-for="(item, index) in multiUsers"
                            :class="selectedUser == item ? 'active' : ''"
                            :key="index"
                        >
                            {{ item }}
                        </span>
                    </div>

                    <label
                        v-if="otpSent == true"
                        for="otp"
                        class="login-form-group"
                    >
                        OTP
                        <input type="text" name="otp" id="otp" v-model="otp" />
                        <span
                            v-if="errorSubmit && errorSubmit.otp"
                            class="errMsg"
                            >{{ errorSubmit.otp[0] }}</span
                        >
                    </label>
                    <button 
                    v-if="selectedUser == null"
                        @click="checkUserExists()"
                        type="button"
                        :disabled="disableLogIn">
                        Send OTP
                    </button>
                    <button
                        @click="sendOtp"
                        v-else-if="otpSent == false && (selectedUser == 'guest' || selectedUser == 'vendor' || selectedUser == 'admin')"
                        type="button"
                        :disabled="disableLogIn"
                    >
                        Send Otp
                    </button>
                    <div v-if="otpSent == true">
                        <button type="submit" :disabled="disableLogIn">
                            Log In
                        </button>
                        <button
                            :disabled="disableLogIn"
                            @click="retryOtp"
                            type="button"
                        >
                            Resend OTP
                        </button>
                    </div>
                </form>

                <!-- "social-login-cont" was earlier class applied and need to removed  -->
                <div
                    class="d-flex justify-content-center"
                    v-if="url == 'host' || url == 'vendor' || url == 'admin'"
                >
                    <!-- <i class="text-small">login with </i> -->
                    <a class="mx-3" :href="route('googleLogin')">
                        <img
                            src="/assets/login/google.svg"
                            alt=""
                            style="margin-right: 4px"
                        />
                        <!-- Log in with Google -->
                    </a>
                    <a class="mx-3" :href="route('fblogin')">
                        <img
                            src="/assets/login/logos_facebook.svg"
                            alt=""
                            style="margin-right: 4px"
                        />
                        <!-- Log in with Facebook-->
                    </a>
                </div>
                <!-- login with OTP button -->
                <div
                    v-if="
                        (userExists &&
                            multiUsersExist == false &&
                            loginWithOtp != true &&
                            isNumericString(email)) ||
                        (selectedUser != null &&
                            isNumericString(email) &&
                            loginWithOtp != true)
                    "
                    class="social-login-cont"
                >
                    <div @click="loginWithOtp = true">
                        <i class="fas fa-sms"></i>
                        Log in with OTP
                    </div>
                </div>
                <!-- login with password button -->
                <div
                    v-if="
                        ((userExists &&
                            multiUsersExist == false &&
                            loginWithOtp == true) ||
                        (selectedUser != null &&
                            !isNumericString(email) &&
                            loginWithOtp == true) ||
                        loginWithOtp == true) && url != 'guest'
                    "
                    class="social-login-cont"
                >
                    <div @click="loginWithOtp = false">
                        <i class="fas fa-sms"></i>
                        Log in with Password
                    </div>
                </div>
                <div v-if="url == 'host'" class="sinup-link-cont">
                    Not a member? <a :href="route('hostRegister')">Sign up</a>
                </div>
                <div v-else-if="url == 'vendor'" class="sinup-link-cont">
                    Not a member? <a :href="route('vendorRegister')">Sign up</a>
                </div>
                <div v-else-if="url == 'admin'" class="sinup-link-cont">
                    Not a member? <a :href="route('adminRegister')">Sign up</a>
                </div>
                <div v-else class="sinup-link-cont"></div>
                <!-- <div class="login-toggle-cont">
                    <a :href="route('hostLogin')" v-if="active != 'host'">
                        Host
                    </a>
                    <a :href="route('login')" v-if="active != 'guest'">
                        Guest
                    </a>
                    <a :href="route('brideLogin')" v-if="active != 'bride'">
                        Bride
                    </a>
                    <a :href="route('groomLogin')" v-if="active != 'groom'">
                        Groom
                    </a>
                    <a :href="route('vendorLogin')" v-if="active != 'vendor'">
                        Vendor
                    </a>
                    <a :href="route('companyLogin')" v-if="active != 'company'">
                        Planner
                    </a>
                    <a :href="route('memberLogin')" v-if="active != 'member'">
                        Member
                    </a>
                </div> -->
            </div>
        </div>
        <div class="login-pics-cont">
            <div class="splide" id="login-splide-cont">
                <div class="splide__track">
                    <ul class="splide__list">
                        <li class="splide__slide">
                            <div
                                class="image-view-cont"
                                style="
                                    background-image: url('/assets/login/img1.png');
                                "
                            >
                                <img src="/assets/login/logo.png" alt="" />
                                <p>
                                    The easiest way to get from 'Save the Date'
                                    to 'thanks so much'. Designed and customized
                                    by you.
                                </p>
                            </div>
                        </li>
                        <li class="splide__slide">
                            <div
                                class="image-view-cont"
                                style="
                                    background-image: url('/assets/login/img7.png');
                                "
                            >
                                <img src="/assets/login/logo.png" alt="" />
                                <p>
                                    The online RSVP that's so simple and excited
                                    for you & your guests.
                                </p>
                            </div>
                        </li>
                        <li class="splide__slide">
                            <div
                                class="image-view-cont"
                                style="
                                    background-image: url('/assets/login/img6.png');
                                "
                            >
                                <img src="/assets/login/logo.png" alt="" />
                                <p>
                                    Decide who to celebrate with when and where,
                                    we'll help the rest-from collecting contact
                                    info to managing RSVPs.
                                </p>
                            </div>
                        </li>
                        <li class="splide__slide">
                            <div
                                class="image-view-cont"
                                style="
                                    background-image: url('/assets/login/img5.png');
                                "
                            >
                                <img src="/assets/login/logo.png" alt="" />
                                <p>
                                    Find pre-screened vendors and get
                                    personalised recs. Reach out here and book
                                    when you're ready.
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <FlashMessage :message="message"></FlashMessage>
    </div>
</template>

<script>
import FlashMessage from "@/components/FlashMessage.vue";

export default {
    props: ["errorSubmit", "oldvalues", "url"],
    components: {
        FlashMessage,
    },
    data() {
        return {

            splider: null,
            active: null,
            disableLogIn: false,
            email: this.oldvalues["email"] ?? null,
            mobile: this.oldvalues["mobile"] ?? null,
            password: this.oldvalues["password"] ?? null,
            otp: this.oldvalues["otp"] ?? null,
            remember_token: this.oldvalues["remember_token"] ?? false,
            //formRoute: route("hostLogin"),
            csrf: $('meta[name="csrf-token"]').attr("content"),
            showPass: "password",
            loginWithOtp: true,
            clickedUserCheck: false,
           // loginWithOtp: this.url === "vendor" ? false : this.url === "admin" ? false : true,
            otpSent: false,
            message: null,
            asyncErrorSubmit: null,
            userExists:
                this.url === "guest"
                    ? true
                    : this.url === "admin"
                    ? true
                    : this.url === "vendor"
                    ? true
                    : false,
            multiUsersExist: false,
            multiUsers: [],
            activeUser: null,
            selectedUser:
                this.url === "guest"
                    ? "guest"
                    : this.url === "admin"
                    ? "admin"
                    : this.url === "vendor"
                    ? "vendor"
                    : null,
            errMsg: null,
            msgerr: null,
        };
    },
    methods: {
        isNumericString(str) {
            return !isNaN(str) && !isNaN(parseFloat(str));
        },
        sendOtp() {
            let _this = this;
            _this.disableLogIn = true;
            let formData = new FormData();
            let link = route("sendOtp");
            formData.append("mobile", _this.email);
            formData.append("role", _this.selectedUser);

            axios({
                url: link,
                method: "POST",
                data: formData,
            })
                .then((response) => {
                    if(response.data?.redirect){
                        window.location.href = response.data.redirect;
                        return;
                    }
                    _this.disableLogIn = false;
                    console.log(response.data);
                    if (response.data["type"] == "success") {
                        _this.otpSent = true;
                    }
                    _this.message = response.data["message"];
                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                })
                .catch((error) => {
                    _this.disableLogIn = false;
                    _this.asyncErrorSubmit = error.response.data.errors;
                    _this.otpSent = false;
                    if (error.response.status == 429) {
                        _this.message =
                            "Too many attempt! Please try again later";
                        setTimeout(function () {
                            _this.message = null;
                        }, 3000);
                    }
                });
        },
        retryOtp() {
            let _this = this;
            _this.disableLogIn = true;
            let formData = new FormData();
            let link = route("retryOtp");
            formData.append("mobile", _this.email);
            axios({
                url: link,
                method: "POST",
                data: formData,
            })
                .then((response) => {
                    console.log(response.data);
                    _this.disableLogIn = false;
                    if (response.data["type"] == "success") {
                        _this.otpSent = true;
                    }
                    if (response.data["type"] == "error") {
                        if (response.data["message"] == "otp_expired") {
                            _this.otpSent = false;
                            _this.message = "OTP expired! Please send new OTP!";
                            return;
                        }
                    }
                    _this.message = response.data["message"];
                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                })
                .catch((error) => {
                    _this.disableLogIn = false;
                    _this.asyncErrorSubmit = error.response.data.errors;
                    if (error.response.status == 429) {
                        _this.message = "Too many attempt!";
                        setTimeout(function () {
                            _this.message = null;
                        }, 3000);
                    }
                });
        },
        verifyOtp() {
            let _this = this;
            _this.disableLogIn = true;
            let formData = new FormData();
            let link = route("verifyOtp");
            formData.append("mobile", _this.email);
            formData.append("role", _this.selectedUser);
            formData.append("otp", _this.otp);
            axios({
                url: link,
                method: "POST",
                data: formData,
            })
                .then((response) => {
                    console.log(response);
                    _this.disableLogIn = false;
                    if (response.data["type"] == "error") {
                        if (response.data["message"] == "OTP expired") {
                            _this.otpSent = false;
                            _this.message = "OTP expired! Please send new OTP!";
                            return;
                        }
                        _this.message = response.data["message"];
                        setTimeout(function () {
                            _this.message = null;
                        }, 3000);
                        return;
                    }
                    //console.log(response.data.redirect);

                    window.location.href = response.data.redirect;
                })
                .catch((error) => {
                    _this.disableLogIn = false;
                    _this.asyncErrorSubmit = error.response.data.errors;
                    // _this.otpSent = false;
                    // console.log(error);
                });
        },
        emptyData() {
            let _this = this;
            _this.errMsg = null;
            _this.multiUsers = [];
            _this.multiUsersExist = false;
            _this.activeUser = null;
            if (this.url == "guest") {
                _this.selectedUser = "guest";
                _this.userExists = true;
            } else if (this.url == "admin") {
                _this.selectedUser = "admin";
                _this.userExists = true;
            } else if (this.url == "vendor") {
                _this.selectedUser = "vendor";
                _this.userExists = true;
            } else {
                _this.selectedUser = null;
                _this.userExists = false;
            }
        },
        checkUserExists(e) {
            let _this = this;
            _this.disableLogIn = true;
            _this.errMsg = null;
            _this.msgerr = null;
            _this.multiUsers = [];
            _this.userExists = false;
            _this.multiUsersExist = false;
            _this.selectedUser = null;
            _this.activeUser = null;
            let formData = new FormData();
            let link = route("checkUserExists");
            formData.append("email", _this.email);
            // if (_this.url == "vendor") {
            //     formData.append("type", "vendor");
            // }
            axios({
                url: link,
                method: "POST",
                data: formData,
            })
                .then((response) => {
                    if(response.data?.redirect){
                        window.location.href = response.data.redirect;
                        return;
                    }
                    _this.disableLogIn = false;
                    _this.multiUsers = response.data;
                    if (_this.multiUsers.length > 1) {
                        _this.multiUsersExist = true;
                    }
                    if (_this.multiUsers.length == 1) {
                        _this.selectedUser = _this.multiUsers[0];
                    }
                    _this.userExists = true;
                    _this.errMsg = null;
                    if(_this.loginWithOtp == true){
                        _this.sendOtp();
                    }
                })
                .catch((error) => {
                    _this.disableLogIn = false;
                    _this.asyncErrorSubmit = error.response.data.errors;
                    _this.msgerr = error.response?.data?.message;
                    console.log(error.response);
                });
        },
        // login user with password
        loginUser(e) {
            //console.log(this.active);
            let _this = this;
            _this.disableLogIn = true;
            let formData = new FormData();
            let link = route("hostLogin");
            if (_this.selectedUser == "host") {
                formData.append("role", "host");
            } else if (_this.selectedUser == "bride") {
                formData.append("role", "bride");
            } else if (_this.selectedUser == "groom") {
                formData.append("role", "groom");
            } else if (_this.selectedUser == "member") {
                formData.append("role", "member");
            } else if (_this.selectedUser == "guest") {
                formData.append("role", "guest");
            } else if (_this.selectedUser == "vendor") {
                formData.append("role", "vendor");
            } else if (_this.selectedUser == "admin") {
                formData.append("role", "admin");
            }

            formData.append("email", _this.email);
            formData.append("password", _this.password);
            formData.append("remember_token", _this.remember_token);
            axios({
                url: link,
                method: "POST",
                data: formData,
            })
                .then((response) => {
                    _this.disableLogIn = false;
                    console.log(response);
                    window.location.href = response.data.redirect;
                })
                .catch((error) => {
                    console.log(error.response.data);
                    _this.disableLogIn = false;
                    if (error.response.data?.status == "failure") {
                        _this.message = error.response.data.message;
                        setTimeout(function () {
                            _this.message = null;
                        }, 5000);
                    }
                    _this.errorSubmit = error.response.data.errors;
                    console.log(response);
                });
        },
        spliderEvent() {
            let _this = this;
            this.splider = new Splide("#login-splide-cont", {
                type: "slide",
                arrows: false,
                pagination: true,
                gap: "10px",
                width: "100%",
                perPage: 1,
                perMove: 1,
                autoplay: true,
                interval: 3000,
                rewind: true,
                pauseOnHover: true,
            });
            this.splider.mount();
        },
    },
    mounted() {
        document.onreadystatechange = () => {
            if (document.readyState == "complete") {
                this.spliderEvent();
            }
        };
    },
    computed: {
        formSubmitRoute() {
            // if (
            //     this.url == "host" ||
            //     this.url == "bride" ||
            //     this.url == "groom" ||
            //     this.url == "member"
            // ) {
            //     return route("hostLogin");
            // }
            // if (this.url == "vendor") {
            //     return route("vendorLogin");
            // }
            // if (this.url == "company") {
            //     return route("companyLogin");
            // }
            // if (this.url == "admin") {
            //     return route("adminLogin");
            // }
        },
    },
};
</script>

<style scoped>
.errMsg {
    color: red !important;
    font-size: 10px !important;
}
.login-main-cont {
    background-color: #fff;
    padding: 24px;
    display: flex;
    min-height: 95vh;
}
.login-left-cont {
    width: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
}
.login-form-cont {
    width: 70%;
    display: flex;
    flex-direction: column;
    margin: auto;
}
.login-form-cont > * {
    width: 100%;
}
.login-form-cont > h1 {
    font-family: "Inter";
    font-style: normal;
    font-weight: 600;
    font-size: 25px;
    line-height: 29px;
    color: #c4456f;
    margin-bottom: 7px;
}
.login-form-cont > div {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 12.5691px;
    line-height: 14px;
    color: #000000;
    margin-bottom: 23px;
    text-transform: uppercase;
}
.login-form-cont > p {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 12.5472px;
    line-height: 18px;
    color: #000000;
    margin-bottom: 23px;
}
.login-form-group {
    font-family: "Inter";
    font-style: normal;
    font-weight: 500;
    font-size: 14px;
    line-height: 20px;
    color: #6b7280;
    display: flex;
    flex-direction: column;
    margin-bottom: 14px;
}
.login-form-group > input {
    background: #ffffff !important;
    border: 0.896226px solid #e5e7eb !important;
    box-shadow: 0px 1px 2px rgba(31, 41, 55, 0.08) !important;
    border-radius: 3.58491px !important;
    padding: 8px;
    margin-top: 7px;
}
.login-form-group > img {
    width: 17px;
    height: 17px;
    align-self: flex-end;
    margin-top: -27px;
    margin-right: 12px;
}
.login-form-group > span {
    font-family: "Inter";
    font-style: normal;
    font-weight: 400;
    font-size: 14px;
    line-height: 20px;
    color: #374151;
    display: inline-block;
    margin-left: 10px;
}
.forn-grp-dbl {
    display: flex;
    justify-content: space-between;
    margin: 23px 0;
}
.forgot-link {
    text-decoration: none;
    font-family: "Inter";
    font-style: normal;
    font-weight: 400;
    font-size: 12.5472px;
    line-height: 18px;
    display: flex;
    align-items: center;
    text-align: right;
    color: #138ab3;
}
.login-form-cont > form > button,
.login-form-cont > form > div > button {
    border: none;
    outline: none;
    font-family: "Inter";
    font-style: normal;
    font-weight: 400;
    font-size: 12.5472px;
    line-height: 18px;
    background: #b52f6f;
    border-radius: 6px;
    color: #ffffff;
    padding: 10px;
    width: 100%;
    margin-bottom: 16px;
}
.multiple-users > span {
    border: none;
    outline: none;
    font-family: "Inter";
    font-style: normal;
    font-weight: 400;
    font-size: 12.5472px;
    line-height: 18px;
    background: #b52f6f;
    border-radius: 6px;
    color: #ffffff;
    padding: 10px;
    margin-bottom: 16px;
    cursor: pointer;
}
.multiple-users > span.active {
    background: #461952;
}
.social-login-cont {
    display: flex;
    justify-content: space-between;
    margin: 23px 0;
}
.social-login-cont > a,
.social-login-cont > div {
    text-decoration: none;
    outline: none;
    background: #ffffff;
    border: 0.896226px solid #e5e7eb;
    box-shadow: 0px 1px 2px rgba(31, 41, 55, 0.08);
    border-radius: 3.58491px;
    font-family: "Inter";
    font-style: normal;
    font-weight: 400;
    font-size: 14px;
    line-height: 20px;
    display: flex;
    align-items: center;
    padding: 7px 10px;
    color: #374151;
    width: 95%;
    text-align: center;
    justify-content: center;
    cursor: pointer;
}
.social-login-cont > div {
    width: 100%;
}
.social-login-cont > a > img,
.social-login-cont > div > i {
    margin-right: 5px;
    width: 18px;
    height: 18px;
}
.social-login-cont > button:nth-child(1) {
    margin-right: 10px;
}
.sinup-link-cont {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 12.5472px;
    line-height: 18px;
    text-align: center;
    color: #374151;
}
.sinup-link-cont > a {
    text-decoration: none;
    color: #b52f6f;
}
.login-toggle-cont {
    /* background: #f1f1f1; */
    border-radius: 5.23952px;
    padding: 6px 3px;
    /* width: max-content; */
    display: flex;
    flex-wrap: wrap;
}
.login-toggle-cont > a {
    text-decoration: none;
    margin: 0 3px;
    background: #ffffff;
    border-radius: 4.19162px;
    padding: 5px 24px;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 10.479px;
    line-height: 19px;
    color: #000000;
    cursor: pointer;
    border: 2px solid #f1f1f1;
    margin-top: 3px;
}
.login-pics-cont {
    width: 50%;
    background: #461952;
    border-radius: 16px;
    background-image: url("/assets/login/Group-1821.png");
    background-position: bottom left;
    background-repeat: no-repeat;
    padding: 55px;
}
#login-splide-cont {
    width: 100%;
    height: 100%;
}
.image-view-cont {
    background: rgba(232, 232, 232, 0.4);
    background-repeat: no-repeat;
    background-position-x: right;
    background-position-y: bottom;
    background-size: 65%;
    border: 1px solid #ffffff;
    box-shadow: 5px 5px 4px rgba(104, 101, 101, 0.25);
    backdrop-filter: blur(10px);
    border-radius: 15px;
    padding: 32px 0 0 32px;
    width: 100%;
    height: 100%;
}
.image-view-cont > p {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 30.6966px;
    line-height: 46px;
    width: 60%;
    color: #ffffff;
}
.forn-grp-dbl input {
    margin-top: 0;
}
</style>
<style>
.splide__track {
    height: 100%;
}
.splide_slide {
    width: 100%;
}
.splide__pagination {
    justify-content: flex-start;
}
.splide__pagination__page {
    width: 11px;
    height: 11px;
}
.splide__pagination__page.is-active {
    background: #ffffff;
    border-radius: 12.375px;
    width: 24px;
    height: 9px;
    margin-left: 8px;
    margin-right: 8px;
}
@media screen and (max-width: 968px) {
    .login-form-cont {
        width: 90% !important;
    }
    .image-view-cont > p {
        font-size: 19.6966px !important;
        line-height: 33px !important;
    }
    .image-view-cont {
        background-size: 90% !important;
    }
    .social-login-cont > a {
        padding: 7px 10px !important;
    }
}
@media screen and (max-width: 768px) {
    .login-left-cont {
        width: 100% !important;
    }
    .login-pics-cont {
        width: 100% !important;
        padding: 21px !important;
        min-height: 403px;
        margin-bottom: 10px;
    }
    .login-main-cont {
        flex-wrap: wrap-reverse;
        padding: 12px !important;
    }
    .social-login-cont > a {
        width: 100%;
        margin-bottom: 5px;
    }
    .social-login-cont {
        flex-wrap: wrap;
    }
    .image-view-cont {
        background-size: 45% !important;
    }
    .image-view-cont > img {
        order: 2;
    }
    .image-view-cont > p {
        font-size: 15px !important;
        line-height: 23px !important;
        order: 1;
    }
}
@media screen and (max-width: 576px) {
    .login-pics-cont {
        min-height: 253px !important;
    }
    .hide-mobile {
        display: none;
    }
    .image-view-cont > p {
        width: 100% !important;
    }
    .image-view-cont {
        background-image: none !important;
        padding: 5px !important;
    }
    .login-pics-cont {
        max-height: 220px;
    }
    .login-form-cont > h1 {
        font-size: 20px !important;
    }
    .login-main-cont {
        min-height: unset !important;
    }
}
</style>
