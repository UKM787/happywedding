<template>
    <div style="margin: 4em 2em">
        <div class="container first-sec">
            <div>
                <h4>Help Center</h4>
                <h1>FAQ’S</h1>
                <h3>
                    Everything you need to know about happywed. Can’t find the
                    answer your are looking for? Chat with our friendly team
                </h3>
            </div>
            <div class="for-business">
                <h3>For Business</h3>
                <h2>GET IN TOUCH</h2>
                <a href="">Multimedia</a>
                <a href="">Talk to our sales expert</a>
                <a href="">Request a demo</a>
                <a class="active" href="/login">Guest Sign in</a>
            </div>
        </div>
        <div class="second-sec">
            <div style="min-width: 30%">
                <div v-for="item in faqList" :key="item.id" class="faq-single">
                    <div @click="toggle($event)">
                        <span>{{ item.question }}</span>
                        <span class="btn-toggle">+</span>
                    </div>
                    <div style="display: none">
                        {{ item.answer }}
                    </div>
                </div>
            </div>
            <div>
                <img src="/assets/defaults/faq_pic.png" alt="" />
            </div>
            <div class="for-business" style="display: none">
                <h3>For Business</h3>
                <h2>GET IN TOUCH</h2>
                <a href="">Multimedia</a>
                <a href="">Talk to our sales expert</a>
                <a href="">Request a demo</a>
                <a class="active" href="/login">Guest Sign in</a>
            </div>
            <!-- <div>
                <h3>Support</h3>
                <h2>FAQ’S</h2>
                <p>
                    Everything you need to know about <br />
                    happywed. Can’t find the answer your <br />
                    are looking for? Chat with our friendly <br />
                    team
                </p>
            </div> -->
        </div>
        <!-- <div class="third-sec container">
            <div>
                <h1>Join 2000+ Subscribers</h1>
                <h3>Stay in the loop with everything you need to know</h3>
            </div>
            <div>
                <form @submit.prevent="subscribe($event)">
                    <label for="subscribe">
                        <input
                            type="email"
                            id="subscribe"
                            name="subscribe"
                            v-model="subscriptions"
                            required
                            :placeholder="placeholder"
                        />
                    </label>
                    <div
                        style="
                            background: #461952;
                            border-radius: 7.11111px 7.11111px 0px 0px;
                            width: 44.44px;
                            height: 44.44px;
                            display: flex;
                            justify-content: center;
                        "
                    >
                        <button
                            type="submit"
                            style="
                                outline: none;
                                border: none;
                                background-color: inherit;
                            "
                        >
                            <i
                                class="fas fa-chevron-right"
                                style="color: #ffffff; align-self: center"
                            ></i>
                        </button>
                    </div>
                </form>
                <div>Subscribe to Happywedding</div>
            </div>
        </div> -->
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
            faqList: [
                {
                    id: 1,
                    question: "Can i change my plan?",
                    answer: "Yes you can",
                },
                {
                    id: 2,
                    question: "Is there a free trial available?",
                    answer: " No You have to choose a plan to log in to happy wed",
                },
                {
                    id: 3,
                    question: "What is the cancellation policy?",
                    answer: "Yes you can",
                },
                {
                    id: 4,
                    question: "Can other info be added to an invoice?",
                    answer: "Yes you can",
                },
                {
                    id: 5,
                    question: "How does billing works?",
                    answer: "Yes you can",
                },
                {
                    id: 6,
                    question: "How to i change my account email?",
                    answer: "Yes you can",
                },
            ],
            subscriptions: "",
            placeholder: "Enter Email Address",
            message: null,
        };
    },
    methods: {
        toggle(e) {
            if ($(e.currentTarget).next().css("display") == "block") {
                $(e.currentTarget).next().css("display", "none");
                $(e.currentTarget).find(".btn-toggle").text("+");
                return;
            }
            $(".faq-single").each(function (index, item) {
                $(item).find(".btn-toggle").text("+");
                $(item).children().eq(1).css("display", "none");
                console.log();
            });

            $(e.currentTarget).next().css("display", "block");
            $(e.currentTarget).find(".btn-toggle").text("-");
        },
        subscribe(e) {
            let _this = this;
            let formData = new FormData();
            let data = _this.subscriptions;
            formData.append("subscriptions", data);
            axios
                .post("/news", formData)
                .then(function (response) {
                    _this.subscriptions = null;
                    _this.message =
                        "Subscription request submitted successfully";
                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                })
                .catch((errors) => {
                    _this.subscriptions = null;
                    _this.message = "Subscription request failed, try again";
                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                    console.log(errors);
                });
        },
    },
};
</script>

<style scoped>
.first-sec {
    display: flex;
    justify-content: space-between;
}
.first-sec > div:nth-child(1) {
    max-width: 360px;
    width: 100%;
}
.first-sec h4 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 16.1375px;
    line-height: 24px;
    color: #6a5e5e;
}
.first-sec h1 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 40.713px;
    line-height: 61px;
    color: #000000;
}
.first-sec h3 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 13.9348px;
    line-height: 21px;
    color: #000000;
}
.second-sec {
    background-color: #f8f8fa;
    display: flex;
    justify-content: space-around;
    padding: 3em 0;
}
.second-sec > div:nth-child(1) > h3 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 16.1375px;
    line-height: 24px;
    color: #6a5e5e;
    margin-bottom: 10px !important;
}
.second-sec > div:nth-child(1) > h2 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 32.0136px;
    line-height: 48px;
    color: #000000;
    margin-bottom: 10px !important;
}
.second-sec > div:nth-child(1) > p {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 13.9348px;
    line-height: 21px;
    color: #000000;
}
.faq-single {
    margin-bottom: 23px;
}
/* .second-sec > div:nth-child(1) {
    display: flex;
    justify-content: space-between;
} */
.faq-single > div:nth-child(1) {
    display: flex;
    justify-content: space-between;
    margin-bottom: 6px;
}
.faq-single > div:nth-child(2) {
    margin-bottom: 12px;
}
.faq-single > div:nth-child(1) > span:nth-child(1) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 15px;
    line-height: 22px;
    color: #000000;
}
.faq-single > div:nth-child(1) > span:nth-child(2) {
    border: 1.07143px solid #706f6f;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    text-align: center;
    display: flex;
    justify-content: center;
    align-items: center;
}
.faq-single > div:nth-child(2) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 12px;
    line-height: 18px;
    color: #706f6f;
}
.third-sec {
    display: flex;
    justify-content: space-between;
    margin: 5em auto;
}
.third-sec h1 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 26.7843px;
    line-height: 40px;
    letter-spacing: -0.36524px;
    color: #000000;
}
.third-sec h3 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 13.9348px;
    line-height: 21px;
    color: #000000;
}
.third-sec form {
    display: flex;
}
.third-sec form input {
    border: none;
    border-bottom: 2px solid #000000;
    background-color: #ffffff !important;
    height: 44px;
}
.third-sec form input::placeholder {
    font-family: "DM Sans";
    font-style: normal;
    font-weight: 400;
    font-size: 13.3333px;
    line-height: 17px;
    /* identical to box height */

    letter-spacing: -0.181818px;

    color: #000000;

    mix-blend-mode: normal;
    opacity: 0.5;
}
.third-sec > div:nth-child(2) > div {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 9.29915px;
    line-height: 14px;
    letter-spacing: -0.126807px;

    color: #959595;
}
.for-business > h3 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 600;
    font-size: 32.8942px;
    line-height: 49px;
    color: #c4456f;
    margin-bottom: 10px;
}
.for-business > h2 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 600;
    font-size: 17.1627px;
    line-height: 26px;
    color: #c4456f;
    margin-bottom: 20px;
}
.for-business > a {
    display: block;
    text-decoration: none;
    border: 1.14371px solid #d6d5d5;
    border-radius: 6.33127px;
    padding: 6px 21px;
    overflow-x: hidden;
    font-family: "Segoe UI";
    font-style: normal;
    font-weight: 600;
    font-size: 12.9878px;
    line-height: 17px;
    text-transform: capitalize;
    color: #636363;
    margin-bottom: 7px;
    width: max-content;
}
.for-business > a.active {
    background: #c4456f;
    color: #ffffff;
}
@media only screen and (max-width: 576px) {
    .second-sec {
        flex-wrap: wrap;
    }
    .second-sec > div:nth-child(1) {
        width: 100%;
        padding: 10px;
    }
    .second-sec > div:nth-child(2) {
        display: none;
    }
    .second-sec > .for-business {
        display: block !important;
        width: 100%;
    }
    .first-sec {
        justify-content: center;
    }
    .first-sec > div:nth-child(1) {
        text-align: center;
    }
    .first-sec > .for-business {
        display: none;
    }
}
</style>
