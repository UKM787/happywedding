<template>
    <div class="login-main-cont">
        <div class="login-left-cont">
            <div class="login-form-cont">
                <h1>Welcome to Happywed.</h1>
                <p class="hide-mobile" v-if="url === 'host'">
                    As a host, you can create and manage wedding events, track
                    RSVPs, and communicate with your guests all in one place.
                    Sign up now to start your wedding planning journey.
                </p>
                <p class="hide-mobile" v-else-if="url === 'vendor'">
                    We're thrilled to have you join our community of wedding
                    professionals. Our platform connects you with couples who
                    are seeking your services, making it easier for you to
                    showcase your skills and grow your business. Sign up now to
                    get started and be a part of the Happywed family.
                </p>
                <p v-else>Welcome! Wedding Community Members</p>
                <form @submit.prevent="loginUser($event)">
                    <!-- <input type="hidden" name="_token" v-bind:value="csrf" /> -->
                    <label for="name" class="login-form-group">
                        Full Name
                        <input
                            type="text"
                            name="name"
                            id="name"
                            v-model="feilds.name"
                        />
                        <span
                            v-if="errorSubmit && errorSubmit.name"
                            class="errMsg"
                            >{{ errorSubmit.name[0] }}</span
                        >
                    </label>
                    <div class="double-form">
                        <label for="email" class="login-form-group">
                            E-Mail Address
                            <input
                                type="email"
                                name="email"
                                id="email"
                                v-model="feilds.email"
                            />
                            <span
                                v-if="errorSubmit && errorSubmit.email"
                                class="errMsg"
                                >{{ errorSubmit.email[0] }}</span
                            >
                        </label>
                        <label for="mobile" class="login-form-group">
                            Mobile Number
                            <input
                                type="mobile"
                                name="mobile"
                                id="mobile"
                                v-model="feilds.mobile"
                            />
                            <span
                                v-if="errorSubmit && errorSubmit.mobile"
                                class="errMsg"
                                >{{ errorSubmit.mobile[0] }}</span
                            >
                        </label>
                    </div>
                    <div v-if="url == 'vendor'">
                        <div class="double-form">
                            <div style="min-width: 48%">
                                <multiselect
                                    v-model="feilds.category"
                                    placeholder="Select Category"
                                    :options="categories"
                                    :show-labels="false"
                                    :allow-empty="false"
                                    track-by="name"
                                    label="name"
                                    ><span slot="noResult"
                                        >No category exists.</span
                                    >
                                </multiselect>
                                <span
                                    v-if="errorSubmit && errorSubmit.category"
                                    class="errMsg"
                                    >{{ errorSubmit.category[0] }}</span
                                >
                            </div>
                            <div style="min-width: 48%">
                                <multiselect
                                    v-model="feilds.city"
                                    placeholder="Select City"
                                    :options="cities"
                                    :show-labels="false"
                                    :allow-empty="false"
                                    track-by="name"
                                    label="name"
                                    ><span slot="noResult"
                                        >No city exists.</span
                                    >
                                </multiselect>
                                <span
                                    v-if="errorSubmit && errorSubmit.city"
                                    class="errMsg"
                                    >{{ errorSubmit.city[0] }}</span
                                >
                            </div>
                        </div>
                    </div>
                    <div v-if="url == 'host' || url == 'admin'">
                        <multiselect
                            v-model="feilds.city"
                            placeholder="Select City"
                            :options="cities"
                            :show-labels="false"
                            :allow-empty="false"
                            track-by="name"
                            label="name"
                            ><span slot="noResult">No city exists.</span>
                            <span
                                v-if="errorSubmit && errorSubmit.city"
                                class="errMsg"
                                >{{ errorSubmit.city[0] }}</span
                            >
                        </multiselect>
                        <span
                                    v-if="errorSubmit && errorSubmit.city"
                                    class="errMsg"
                                    >{{ errorSubmit.city[0] }}</span
                                >
                    </div>

                    <!-- <div v-if="url != 'admin'">
                        <multiselect
                            v-model="feilds.city"
                            placeholder="Select City"
                            :options="cities"
                            :show-labels="false"
                            :allow-empty="false"
                            track-by="name"
                            label="name"
                            ><span slot="noResult">No city exists.</span>
                            <span
                                v-if="errorSubmit && errorSubmit.city"
                                class="errMsg"
                                >{{ errorSubmit.city[0] }}</span
                            >
                        </multiselect>
                    </div> -->

                    <div class="double-form">
                        <!-- <label for="mobile" class="login-form-group">
                            Mobile Number
                            <input
                                type="mobile"
                                name="mobile"
                                id="mobile"
                                v-model="mobile"
                            />
                            <span
                                v-if="errorSubmit && errorSubmit.mobile"
                                class="errMsg"
                                >{{ errorSubmit.mobile[0] }}</span
                            >
                        </label> -->
                        <label for="role" class="login-form-group">
                            <input
                                hidden
                                v-model="feilds.role"
                                type="text"
                                name="role"
                                id="role"
                            />
                            <!-- <select name="role" id="role" v-model="role">
                                <option selected value="host">Host</option>
                                <option value="company">Wedding Planner</option>
                                <option value="vendor">Vendor</option>
                            </select> -->
                            <span
                                v-if="errorSubmit && errorSubmit.role"
                                class="errMsg"
                                >{{ errorSubmit.role[0] }}</span
                            >
                        </label>
                    </div>
                    <div class="double-form">
                        <label for="password" class="login-form-group">
                            Password
                            <input
                                :type="showPass"
                                name="password"
                                id="password"
                                autocomplete
                                v-model="feilds.password"
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
                                style="margin-top: 9px"
                                v-if="errorSubmit && errorSubmit.password"
                                class="errMsg"
                                >{{ errorSubmit.password[0] }}</span
                            >
                        </label>
                        <label
                            for="password_confirmation"
                            class="login-form-group"
                        >
                            Confirm Password
                            <input
                                :type="showPass"
                                name="password_confirmation"
                                id="password_confirmation"
                                autocomplete
                                v-model="feilds.password_confirmation"
                            />
                            <span
                                v-if="
                                    errorSubmit &&
                                    errorSubmit.password_confirmation
                                "
                                class="errMsg"
                                >{{
                                    errorSubmit.password_confirmation[0]
                                }}</span
                            >
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
                        </label>
                    </div>
                    <div class="forn-grp-dbl" style="flex-wrap: wrap">
                        <label
                            for="policy"
                            class="login-form-group"
                            style="flex-direction: row; margin-bottom: 0"
                        >
                            <input
                                type="checkbox"
                                id="policy"
                                v-model="feilds.policy"
                            />
                            <span
                                >I have read the
                                <a :href="route('termsandconditions')"
                                    >terms and conditions</a
                                >
                                and agreed with
                                <a :href="route('privacypolicy')"
                                    >privacy policy</a
                                ></span
                            >
                        </label>
                        <span
                            style="
                                width: 100%;
                                margin-top: 3px;
                                margin-left: 10px;
                            "
                            v-if="errorSubmit && errorSubmit.policy"
                            class="errMsg"
                            >{{ errorSubmit.policy[0] }}</span
                        >
                    </div>
                    <button type="submit" :disabled="disableLogIn">
                        Sign Up
                    </button>
                </form>
                <div class="sinup-link-cont">
                    Already have an Account, Login as
                    <a v-if="url == 'host'" :href="route('hostLogin')">Host</a>
                    <a v-if="url == 'vendor'" :href="route('vendorLogin')"
                        >Vendor</a
                    >
                    <a v-if="url == 'admin'" :href="route('adminLogin')"
                        >Admin</a
                    >
                </div>
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
                                    Moments made memorable for a unique love
                                    story
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
                                    Every love story is beautiful, but yours
                                    should be unique Making events come alive
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
                                <p>Make Any Occasion Unforgettable.</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <img src="/assets/login/top-right.png" alt="" class="ab-img" />
        </div>
        <FlashMessage :message="message"></FlashMessage>
    </div>
</template>

<script>
import FlashMessage from "@/components/FlashMessage.vue";
import Multiselect from "vue-multiselect";

//import Dropdown from "primevue/Dropdown";

export default {
    props: [
        "errorSubmit",
        "oldvalues",
        "locations",
        "cities",
        "url",
        "categories",
    ],
    components: {
        FlashMessage,
        //Dropdown,
        Multiselect,
    },
    data() {
        return {
            message: null,
            splider: null,
            active: "Host",
            disableLogIn: false,
            csrf: $('meta[name="csrf-token"]').attr("content"),
            locationMaster: null,
            stateList: [],
            district: [],
            hideDefaultOption: true,
            feilds: {
                name: this.oldvalues["name"] ?? null,
                email: this.oldvalues["email"] ?? null,
                //state_name: this.oldvalues["state_name"] ?? null,
                category: this.oldvalues["category"] ?? null,
                city: this.oldvalues["city"] ?? null,
                mobile: this.oldvalues["mobile"] ?? null,
                role: this.url,
                policy: false,
                password: null,
                password_confirmation: null,
            },
            // name: this.oldvalues["name"] ?? null,
            // email: this.oldvalues["email"] ?? null,
            // //state_name: this.oldvalues["state_name"] ?? null,
            // location_id: this.oldvalues["location_id"] ?? null,
            // city : this.oldvalues["city"] ?? null,
            // mobile: this.oldvalues["mobile"] ?? null,
            // role: this.url,
            // policy: true,
            // password: null,
            // password_confirmation: null,
            showPass: "password",
        };
    },
    methods: {
        submitForm(e) {
            console.log(e, "ss");
            if (this.policy == false) {
                this.message = "Accept terms and conditions first!!";
                setTimeout(function () {
                    this.message = null;
                }, 3000);
            } else {
                this.disableLogIn = true;
                e.currentTarget.submit();
            }
        },
        loginUser(e) {
            console.log(this.active);
            let _this = this;
            _this.disableLogIn = true;
            let formData = new FormData();
            let link = route("hostRegister");
            // for(let keys in this.feilds){
            //     formData.append(keys, _this.feilds[keys]);
            // }
            // formData.append("email", _this.email);
            // formData.append("password", _this.password);
            // formData.append("remember_token", _this.remember_token);
            axios({
                url: link,
                method: "POST",
                data: _this.feilds,
            })
                .then((response) => {
                    console.log(response.data);
                    window.location.href = response.data.redirect;
                    _this.disableLogIn = false;
                    //  window.location.reload();
                })
                .catch((error) => {
                    _this.disableLogIn = false;
                    _this.errorSubmit = error.response.data.errors;
                    console.log(error);
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
        // getStates() {
        //     var _this = this;
        //     _this.locationMaster = _this.locations;
        //     _this.stateList = [
        //         ...new Set(_this.locationMaster.map((item) => item.state)),
        //     ];
        //     if (this.state_name != null && this.state_name != "") {
        //         this.getDistricts(_this.state_name, false);
        //     }
        // },
        // getDistricts(e, bool) {
        //     let _this = this;
        //     let val = null;
        //     if (bool == true) {
        //         val = e.currentTarget.value;
        //     }
        //     if (bool == false) {
        //         val = e;
        //     }
        //     _this.district = [];
        //     this.locationMaster.map(function (el) {
        //         if ('"' + el.state + '"' == '"' + val + '"') {
        //             _this.district.push({ id: el.id, name: el.name });
        //         }
        //         _this.hideDefaultOption = false;
        //         //_this.location_id = "Select City";
        //     });
        // },
    },
    mounted() {
        document.onreadystatechange = () => {
            // this.$nextTick(() => {
            //     this.getStates();
            // });
            if (document.readyState == "complete") {
                this.spliderEvent();
            }
        };
    },
};
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

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
.login-form-group > input,
.login-form-group > select {
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
.login-form-cont > form > button {
    border: none;
    outline: none;
    font-family: "Inter";
    font-style: normal;
    font-weight: 400;
    font-size: 12.5472px;
    line-height: 18px;
    background: #461952;
    border-radius: 6px;
    color: #ffffff;
    padding: 10px;
    width: 100%;
    margin-bottom: 16px;
}
.social-login-cont {
    display: flex;
    justify-content: space-between;
    margin: 23px 0;
}
.social-login-cont > a {
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
    padding: 7px 40px;
    color: #374151;
}
.social-login-cont > button > img {
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
    background: #b52f6f;
    border-radius: 16px;
    background-image: url("/assets/login/bottom-left.png");
    background-position: bottom left;
    background-repeat: no-repeat;
    padding: 55px;
    position: relative;
}
.ab-img {
    position: absolute;
    top: 0;
    right: 0;
    z-index: 9999;
    width: 70%;
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
.forn-grp-dbl span {
    font-family: "Inter";
    font-style: normal;
    font-weight: 400;
    font-size: 9.90875px;
    line-height: 14px;
    color: #3b88c3;
}
.forn-grp-dbl span a {
    text-decoration: none;
    color: #de2f2f;
}
.double-form {
    display: flex;
    justify-content: space-between;
}
.double-form > label {
    width: 48%;
}
/* .double-form > label:nth-child(1) {
    margin-right: 10px;
} */
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
    .double-form > label {
        width: 100% !important;
    }
    .double-form {
        flex-wrap: wrap;
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
}
</style>
