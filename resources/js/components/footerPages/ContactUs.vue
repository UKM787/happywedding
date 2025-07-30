<template>
    <div
        id="outer-cont"
        style="position: relative; min-height: 100vh; height: 100%"
    >
        <div class="back-img-cont">
            <img src="/assets/defaults/Rectangle.png" alt="" />
            <img src="/assets/defaults/left.png" alt="" />
            <img src="/assets/defaults/right.png" alt="" />
        </div>
        <div style="padding-bottom: 20%">
            <div class="container-md about-form">
                <div style="width: 50%" class="contact-form">
                    <h1>Get in touch</h1>
                    <!-- <h3>we are here for you! How can we help?</h3> -->
                    <form @submit.prevent="contactSubmit($event)">
                        <label for="name">
                            <input
                                type="text"
                                id="name"
                                name="name"
                                v-model="contactForm.name"
                                placeholder="Full Name"
                            />
                            <span v-if="errors && errors.name" class="errMsg">{{
                                errors.name[0]
                            }}</span>
                        </label>
                        <label for="cname">
                            <input
                                type="text"
                                id="cname"
                                name="cname"
                                v-model="contactForm.companyName"
                                placeholder="Company Name"
                            />
                            <span
                                v-if="errors && errors.companyName"
                                class="errMsg"
                                >{{ errors.companyName[0] }}</span
                            >
                        </label>
                        <label for="email">
                            <input
                                type="email"
                                id="email"
                                name="email"
                                v-model="contactForm.email"
                                placeholder="Enter a Valid E-mail ID"
                            />
                            <span
                                v-if="errors && errors.email"
                                class="errMsg"
                                >{{ errors.email[0] }}</span
                            >
                        </label>
                        <label for="mobile">
                            <input
                                type="text"
                                id="mobile"
                                name="mobile"
                                v-model="contactForm.mobile"
                                placeholder="Mobile Number"
                            />
                            <span
                                v-if="errors && errors.mobile"
                                class="errMsg"
                                >{{ errors.mobile[0] }}</span
                            >
                        </label>
                        <select
                            v-model="contactForm.reason"
                            name="reason"
                            id="reason"
                        >
                            <option disabled value="">What’s this about</option>
                            <option value="vendor">To Be A Vendor</option>
                            <option value="advertise">To Advertise</option>
                            <option value="demo">To Have A Demo</option>
                            <option value="participate">
                                Participate With Us
                            </option>
                            <option value="feedback">Feedback</option>
                        </select>
                        <label for="message">
                            <textarea
                                name="message"
                                id="message"
                                cols="30"
                                rows="10"
                                v-model="contactForm.message"
                                placeholder="Kindly supply additional details"
                            ></textarea>
                            <span
                                v-if="errors && errors.message"
                                class="errMsg"
                                >{{ errors.message[0] }}</span
                            >
                        </label>
                        <button :disabled="disableForm" type="submit">
                            Submit
                        </button>
                    </form>
                </div>
                <div style="width: 48%" id="right-section">
                    <img src="/assets/defaults/about_animated.png" alt="" />
                    <h1>Get in touch</h1>
                    <h2>we are here for you! How can we help?</h2>
                    <h3>HAPPYWED</h3>
                    <!-- <div>
                        <img src="/assets/defaults/ci_location.svg" alt="" />
                        <span
                            >No:5,1st floor, Damodar Street, Kellys, Kilpauk,
                            Chennai, Tamil Nadu 600010</span
                        >
                    </div> -->
                    <div>
                        <img
                            src="/assets/defaults/fluent_call-20-filled.svg"
                            alt=""
                        />
                        <a href="tel:+919840785986">+91 98407 85986 </a>
                    </div>
                    <div>
                        <img
                            src="/assets/defaults/clarity_email-solid.svg"
                            alt=""
                        />
                        <a href="mailto:happywed22@gmail.com"
                            >happywed22@gmail.com</a
                        >
                    </div>
                </div>
                <!-- <div class="links">
                    <div>
                        <a
                            href="https://www.facebook.com/Happy-Wed-102589325754190/"
                            ><i class="fab fa-facebook-f"></i
                        ></a>
                        <a href="https://twitter.com/HappyWed2?s=09"
                            ><i class="fab fa-twitter"></i
                        ></a>
                        <a
                            href="https://youtube.com/channel/UCcBPjhZHz_jOb1M_Nvk0mNA"
                            ><i class="fab fa-youtube"></i
                        ></a>
                        <a href=""><i class="fab fa-instagram"></i></a>
                    </div>
                </div> -->
            </div>
        </div>
        <flashMessage :message="message"></flashMessage>
    </div>
</template>

<script>
import flashMessage from "../FlashMessage.vue";

export default {
    components: {
        flashMessage,
    },
    data() {
        return {
            contactForm: {
                name: "",
                email: "",
                message: "",
                companyName: "",
                reason: "",
                mobile: "",
            },
            message: null,
            errors: null,
            disableForm: false,
        };
    },
    methods: {
        contactSubmit(e) {
            let _this = this;
            _this.disableForm = true;
            let formData = new FormData();
            let data = JSON.stringify(_this.contactForm);
            formData.append("data", data);
            axios
                .post("/api/contactus", formData)
                .then(function (response) {
                    _this.message = "Query Submitted!!";
                    _this.disableForm = false;
                    _this.errors = null;
                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                    _this.contactForm.name = "";
                    _this.contactForm.email = "";
                    _this.contactForm.message = "";
                    _this.contactForm.companyName = "";
                    _this.contactForm.reason = "";
                    _this.contactForm.mobile = "";
                })
                .catch((error) => {
                    _this.errors = error.response.data.errors;
                    _this.disableForm = false;
                    //console.log(error.response.data.errors);
                    _this.message = "Something went wrong!!";
                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                });
        },
    },
};
</script>

<style scoped>
.errMsg {
    color: red;
    font-size: 10px;
}
.links {
    width: 2%;
}
.links > div {
    position: absolute;
    background: #461952;
    border-radius: 3px 3px 20px 0px;
    bottom: 0;
    display: flex;
    flex-direction: column;
    padding: 1em;
    right: -3%;
}
.links > div > a {
    text-decoration: none;
    color: white;
}
.links > div > a > i {
    margin-bottom: 1.5em;
    color: white;
}
.back-img-cont {
    position: relative;
}
.back-img-cont > img:nth-child(1) {
    width: 100%;
    object-fit: cover;
}
.back-img-cont > img:nth-child(2) {
    position: absolute;
    left: 5%;
    bottom: -2%;
}
.back-img-cont > img:nth-child(3) {
    position: absolute;
    right: 0%;
    bottom: 20%;
}
.about-form {
    background: #ffffff;
    border-radius: 20px;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    flex-direction: row-reverse;
    position: absolute;
    top: 5%;
    left: 15.5%;
    padding: 3em 4em;
    width: 70%;
}
#right-section > h1 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 600;
    font-size: 32.8942px;
    line-height: 49px;
    color: #461952;
    margin-bottom: 10px;
}
#right-section > h2 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 16px;
    line-height: 24px;
    color: #000000;
    margin-bottom: 5px;
}
#right-section > h3 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 600;
    font-size: 17.1627px;
    line-height: 26px;
    color: #461952;
    margin-bottom: 30px;
}
#right-section > div {
    margin-bottom: 1em;
}
#right-section > div > a {
    text-decoration: none;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 800;
    font-size: 12px;
    line-height: 18px;

    color: #000000;
}
#right-section > div > img {
    margin-right: 1.2em;
}
.contact-form {
    padding: 2em;
}
.contact-form > h1 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 600;
    font-size: 21.8938px;
    line-height: 31px;
    color: #461952;
}
.contact-form > h3 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 14px;
    line-height: 21px;
    color: #000000;
}
.contact-form label,
.contact-form select {
    width: 100%;
    margin-bottom: 1em;
}
.contact-form input,
.contact-form select,
textarea {
    width: 100%;
    background-color: #f5f4fa !important;
    border-radius: 3px;
    border: none;
    padding: 1em;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 12.33333px;
    line-height: 14px;
    color: #404040;
}

.contact-form input::placeholder,
.contact-form option,
textarea::placeholder {
    font-family: "Poppins" !important;
    font-style: normal !important;
    font-weight: 500 !important;
    font-size: 12.33333px I !important;
    line-height: 14px !important;
    color: #a8a8a8 !important;
}
.contact-form button {
    background: #461952;
    border-radius: 3px;
    border: none;
    outline: none;
    text-align: center;
    width: 100%;
    padding: 1em;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 700;
    font-size: 12.33333px;
    line-height: 14px;
    color: #ffffff;
}
@media only screen and (max-width: 992px) {
    .about-form {
        padding: 20px;
    }
}
@media only screen and (max-width: 768px) {
    .about-form {
        width: 95%;
    }
    .about-form {
        left: 10px;
    }
}
@media only screen and (max-width: 992px) {
    .about-form > div {
        width: 100% !important;
        text-align: center;
    }
    #outer-cont {
        height: 1200px !important;
    }
}
</style>
