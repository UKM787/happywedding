<template>
    <div>
        <div class="subscription-cont">
            <div class="subs-details">
                <p>Here are the Membership Plans created for you.</p>
                <div class="sub-details-content" style="margin-top: 27px">
                    <div>Guest Count :</div>
                    <div>Invitation Card Design :</div>
                    <div>Email Reminders :</div>
                    <div>SMS Reminders :</div>
                    <div>Events Allowed :</div>
                    <div>Image Count- Img Size/Event :</div>
                    <div>Video Count- Vid Size/Event :</div>
                    <div>Wedding Venues :</div>
                    <div>Guest Accommodation :</div>
                    <div>Guest Transport :</div>
                    <div>Wedding URL (Standard) :</div>
                </div>
            </div>
            <div id="plan-slider" class="splide">
                <div class="splide__track">
                    <ul class="splide__list single-card-outer">
                        <li
                            v-for="(item, index) in plans"
                            :key="index"
                            class="splide__slide"
                            style="border: none !important"
                        >
                            <div class="single-sub-page">
                                <span>
                                    <img src="/assets/subs-banner.svg" alt="" />
                                    <span>
                                        <img
                                            style="
                                                width: 36px;
                                                height: 36px;
                                                margin: auto;
                                            "
                                            :src="item.icon"
                                            alt=""
                                        />
                                        <span>{{ item.name }}</span>
                                    </span>
                                </span>
                                <p>₹ {{ item.price }}</p>
                                <p>{{ item.validity }} months</p>
                                <div class="sub-details-content">
                                    <div>100</div>
                                    <div>Standard</div>
                                    <div>1</div>
                                    <div>1</div>
                                    <div>3</div>
                                    <div>50-100kb / Event</div>
                                    <div>50-100kb / Event</div>
                                    <div>
                                        <img
                                            src="/assets/login/check.svg"
                                            alt=""
                                        />
                                    </div>
                                    <div>
                                        <img
                                            src="/assets/login/check.svg"
                                            alt=""
                                        />
                                    </div>
                                    <div>
                                        <img
                                            src="/assets/login/check.svg"
                                            alt=""
                                        />
                                    </div>
                                    <div>
                                        <img
                                            src="/assets/login/iconoir_cancel.svg"
                                            alt=""
                                        />
                                    </div>
                                </div>
                                <button
                                    @click="purchase($event, item)"
                                    :style="item.color"
                                    type="button"
                                >
                                    Choose Plan
                                </button>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- <div id="section-8">
            <div style="margin: auto; overflow-x: auto">
                <div
                    v-for="(item, index) in priceCards"
                    :key="index"
                    class="price-card-container"
                >
                    <div>
                        <div :style="item.color" class="plan">
                            {{ item.name }}
                        </div>
                    </div>
                    <div class="details-cont">
                        <div>/Per Month</div>
                        <div style="text-align: center">
                            <span>₹</span><span>{{ item.price }}</span>
                        </div>
                        <div>
                            "Lorem ipsum dolor sit hjbsdc jsnznxk
                            amet,consectetur adipiscing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua.
                            Ut enim ad minim veniam, quis nostru exercitation.
                        </div>
                        <div class="pros">
                            <img src="/assets/Vector3.svg" alt="" />
                            <span
                                >illo inventore veritatis et quasi architecto
                                beatae vitae</span
                            >
                        </div>
                        <div class="pros">
                            <img src="/assets/Vector3.svg" alt="" />
                            <span
                                >quis nostrum exercitationem ullam corporis
                                suscipit laboriosam, nisi ut aliquid ex ea
                                commodi consequatur? Quis autem vel</span
                            >
                        </div>
                        <div class="pros">
                            <img src="/assets/Vector4.svg" alt="" />
                            <span
                                >Duis aute irure dolor in reprehenderit in
                                voluptate velit esse cillum dolore eu
                            </span>
                        </div>
                        <div class="pros">
                            <img src="/assets/Vector4.svg" alt="" />
                            <span
                                >eius modi tempora incidunt ut labore et dolore
                                magnam aliquam quaerat voluptatem.</span
                            >
                        </div>
                        <div style="text-align: center; margin: 1em 0">
                            <button @click="purchase($event, item)" class="buy">
                                Buy Now
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <flashMessage :message="message"></flashMessage>
    </div>
</template>
<script>
import flashMessage from "../FlashMessage.vue";

export default {
    props: ["host", "plans"],
    components: {
        flashMessage,
    },
    data() {
        return {
            priceCards: this.plans,
            message: null,
            paid: false,
            cont: null,
        };
    },
    methods: {
        setSplider() {
            let _this = this;
            this.$nextTick(function () {
                _this.cont = new Splide(`#plan-slider`, {
                    gap: 10,
                    rewind: true,
                    autoWidth: true,
                    pagination: false,
                    isNavigation: true,
                    arrows: true,
                    wheel: false,
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
        purchase(e, item) {
            let _this = this;
            if (this.paid == true) {
                window.location.reload;
                return;
            }
            axios
                .get(route("subscribeCreateOrder", item.id))
                .then((res) => {
                    console.log(res);
                    if (res.data.data?.subscribeable?.name == "Free") {
                        window.location.href = res.data.redirect;
                        return;
                    }
                    _this.checkout(item.price, res.data.data);
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        checkout(price, data) {
            let _this = this;
            var options = {
                key: "rzp_live_wLIDlEVBFdFkFS", // Enter the Key ID generated from the Dashboard
                amount: price * 100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                currency: "INR",
                name: "HappyWed",
                description: "Test Transaction",
                image: "http://wedding.test/assets/login/logo.png",
                order_id: data.order_id, //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
                handler: function (response) {
                    let formData = new FormData();
                    this.paid = true;
                    formData.append("id", data.id);
                    formData.append("data", JSON.stringify(response));
                    axios({
                        method: "post",
                        url: route("subscribeVerifyPayment"),
                        data: formData,
                    })
                        .then((res) => {
                            window.location.reload();
                        })
                        .catch((err) => {
                            console.log(err);
                        });
                },
                prefill: {
                    name: _this.host.name,
                    email: _this.host.email,
                    contact: _this.host.mobile,
                },
                notes: {
                    address: "Razorpay Corporate Office",
                },
                theme: {
                    color: "#3399cc",
                },
            };
            var rzp1 = new Razorpay(options);

            rzp1.on("payment.failed", function (response) {
                let formData = new FormData();
                formData.append("id", data.id);
                formData.append("data", JSON.stringify(response));
                axios({
                    method: "post",
                    url: route("subscribeVerifyPayment"),
                    data: formData,
                })
                    .then((res) => {
                        console.log("err", res, _this);
                        //_this.message = res.data;
                        // setTimeout(function () {
                        //     _this.message = null;
                        // }, 3000);
                        //window.location.reload();
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            });
            rzp1.open();
        },
    },
    mounted() {
        console.log('subscribe mounted');
        document.onreadystatechange = () => {
            if (document.readyState == "complete") {
                console.log('subscribe splide');
                this.setSplider();
            }
        };
    },
};
</script>

<style scoped>
#section-8 > div:nth-child(1)::-webkit-scrollbar {
    display: none;
}

/* Hide scrollbar for IE, Edge and Firefox */
#section-8 > div:nth-child(1) {
    -ms-overflow-style: none; /* IE and Edge */
    scrollbar-width: none; /* Firefox */
}
/* price card css start */
#section-8 {
    background: #f8f8f8;
    padding: 3em 0;
}
#section-8 > div {
    display: flex;
}
.price-card-container {
    padding-left: 19px;
    width: max-content;
    align-self: center;
    position: relative;
}
.price-card-container > div:nth-child(1) {
    padding-bottom: 20px;
    position: absolute;
}
.price-card-container > div:nth-child(1)::before {
    content: "";
    display: block;
    clip-path: polygon(0 62%, 28% 62%, 28% 100%, 28% 100%);
    width: 65px;
    height: 50px;
    background: #04262e;
    z-index: 99999;
    top: 26px;
    position: absolute;
    margin-left: -17px;
}
.plan {
    font-family: Josefin Sans;
    font-style: normal;
    font-weight: 600;
    font-size: 18.4072px;
    line-height: 18px;
    color: #ffffff;
    /* background: linear-gradient(90.27deg, #9b3154 1.62%, #6d223b 95.36%); */
    width: 111px;
    height: 37px;
    clip-path: polygon(0 0, 69% 0, 100% 100%, 0 100%);
    margin-left: -17px;
    position: absolute;
    top: 20px;
}
.details-cont {
    background: #ffffff;
    border-radius: 20px;
    padding: 1.5em 2em;
    padding-top: 5em;
    width: 266px;
}
.details-cont > div:nth-child(1) {
    font-family: Inter;
    font-style: normal;
    font-weight: normal;
    font-size: 11.1324px;
    line-height: 13px;
    color: #464646;
    text-align: right;
    padding-right: 6em;
}
.details-cont > div:nth-child(2) > span:nth-child(1) {
    font-family: Inter;
    font-style: normal;
    font-weight: bold;
    font-size: 33.6722px;
    line-height: 41px;
    color: #000000;
    padding-right: 10px;
}

.details-cont > div:nth-child(2) > span:nth-child(2) {
    font-family: Inter;
    font-style: normal;
    font-weight: bold;
    font-size: 49.4522px;
    line-height: 60px;
    color: #000000;
}
.details-cont > div:nth-child(3) {
    font-family: Josefin Sans;
    font-style: normal;
    font-weight: normal;
    font-size: 12px;
    line-height: 12px;
    color: #000000;
    margin-top: 1em;
    margin-bottom: 1.5em;
}
.pros {
    font-family: Josefin Sans;
    font-style: normal;
    font-weight: normal;
    font-size: 9px;
    line-height: 9px;
    color: #5e5e5e;
    display: flex;
    margin-bottom: 10px;
}
.pros > img {
    margin-right: 12px;
    width: 16px;
    height: 16px;
}
.pros > span {
    vertical-align: middle;
}
.buy {
    font-family: Josefin Sans;
    font-style: normal;
    font-weight: 600;
    font-size: 11.3478px;
    line-height: 11px;
    color: #ffffff;
    border: none;
    outline: 0;
    background: linear-gradient(90deg, #9b3154 0%, #6d223b 100%);
    border-radius: 20px;
    padding: 12px 28px;
}
/* price card css end */
.subscription-cont {
    display: flex;
    margin-bottom: 100px;
}
.subs-details {
    min-width: 280px;
    width: 30%;
    margin-right: 10px;
}
.subs-details > p {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 24px;
    line-height: 36px;
    color: #000000;
    height: 160px;
}
.sub-details-content > div {
    background: #f6f7f9;
    border-radius: 3.62305px;
    padding: 9px 22px;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 15.3063px;
    line-height: 23px;
    color: #5b5252;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 41px;
}
.sub-details-content > div:nth-child(even) {
    background: #ffffff;
}
.single-sub-page {
    width: 200px;
}
.single-sub-page > span:nth-child(1) {
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 110px;
}
.single-sub-page > span:nth-child(1) > img {
    position: absolute;
    top: 0;
    left: 11%;
    width: 150px;
    height: 110px;
    z-index: 99;
}
.single-sub-page > span:nth-child(1) > span {
    z-index: 999;
    display: flex;
    justify-content: center;
    flex-direction: column;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 600;
    font-size: 20.4084px;
    line-height: 31px;
    color: #ffffff;
}
.single-sub-page > p:nth-child(2) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 31.5434px;
    line-height: 47px;
    text-align: center;
    color: #5b5252;
    margin-bottom: 7px;
}
.single-sub-page > p:nth-child(3) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 10.4717px;
    line-height: 16px;
    color: #ada2a2;
    text-align: center;
    margin-bottom: 7px;
}
#plan-slider {
    width: 70%;
}
.single-sub-page > button {
    outline: none;
    border: none;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 12.225px;
    line-height: 18px;
    color: #ffffff;
    margin-top: 15px;
    /* border: 0.670952px solid #00a861; */
    border-radius: 27.1729px;
    width: 100%;
    padding: 14px;
}
</style>
