<template>
    <div>
        <div
            v-if="ceramonies.length > 0"
            class="container-lg guest-invi-ceramony"
        >
            <!-- <h3>Wedding ceremonies</h3>
            <h2>Accept Invitation to choose Members to the ceremonies</h2> -->
            <div
                v-for="item in ceramonies"
                :key="item.id"
                class="cera-peach-single"
                @click="popupCera = item"
            >
                <div class="cer-head-mobile">
                    <h1>{{ titleCase(item.name) }}</h1>
                </div>
                <div class="img-peach-cont">
                    <img :src="'/storage/' + item.imageOne" alt="" />
                </div>
                <div class="peach-inner-details">
                    <div class="peach-inner-info">
                        <span>{{ titleCase(item.name) }}</span>
                        <span>
                            <img
                                src="/storage/guestInvitation/Peach/calender.svg"
                                alt=""
                            />
                            {{
                                new Date(item.startDate).toLocaleDateString(
                                    "en-us",
                                    {
                                        weekday: "long",
                                        year: "numeric",
                                        month: "long",
                                        day: "numeric",
                                    }
                                )
                            }}
                            {{
                                new Date(
                                    "1970-01-01T" + item.startTime + "Z"
                                ).toLocaleTimeString("en-US", {
                                    timeZone: "UTC",
                                    hour12: true,
                                    hour: "numeric",
                                    minute: "numeric",
                                })
                            }}
                        </span>
                        <span v-for="e in item.venues" :key="e.name">
                            <img
                                src="/storage/guestInvitation/Peach/location.svg"
                                alt=""
                            />
                            {{ e.name }}, {{ e.location.name }},
                            {{ e.location.state }}
                        </span>
                    </div>
                    <div class="peach-inner-dress">
                        <h1>Dress Code</h1>
                        <div>
                            <div>
                                <img
                                    src="/storage/guestInvitation/Peach/female.svg"
                                    alt=""
                                />
                                <img
                                    :src="'/storage/' + item.imageTwo"
                                    alt=""
                                />
                            </div>
                            <div>
                                <img
                                    src="/storage/guestInvitation/Peach/male.svg"
                                    alt=""
                                />
                                <img
                                    :src="'/storage/' + item.imageThree"
                                    alt=""
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div
                v-if="popupCera"
                class="cere-popup-container"
                @click="popupCera = null"
            >
                <component
                    @ceraClose="popupCera = null"
                    :ceremony="popupCera"
                    :brideName="invitation.brideName"
                    :groomName="invitation.groomName"
                    v-bind:is="ceremonyCard"
                ></component>
            </div>
        </div>
    </div>
</template>

<script>
import CardDefault from "./ceremonyCards/CardDefault.vue";

export default {
    components: {
        CardDefault,
    },
    props: ["ceramonies", "invitation"],
    data() {
        return {
            popupCera: null,
        };
    },
    methods: {
        titleCase(str) {
            let _this = this;
            var splitStr = str.toLowerCase().split(" ");
            for (var i = 0; i < splitStr.length; i++) {
                // You do not need to check if i is larger than splitStr length, as your for does that for you
                // Assign it back to the array
                splitStr[i] =
                    splitStr[i].charAt(0).toUpperCase() +
                    splitStr[i].substring(1);
            }
            // Directly return the joined string
            return splitStr.join(" ");
        },
    },
    computed: {
        ceremonyCard() {
            //return this.popupCera.file;
            return "CardDefault";
        },
    },
};
</script>

<style scoped>
.guest-invi-ceramony {
    /* background-image: url("/assets/guestInvi/cera-back.png");
    background-repeat: no-repeat;
    background-position: top left; */
    /* padding: 68px;
    display: flex; */
    /* flex-direction: column;
    justify-content: center;
    align-items: center; */
}
/* .guest-invi-ceramony > h3 {
    font-family: "Perpetua";
    font-style: normal;
    font-weight: 700;
    font-size: 29.5136px;
    line-height: 34px;
    color: #333333;
    margin-bottom: 15px;
}
.guest-invi-ceramony > h2 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 14.5337px;
    line-height: 22px;
    color: #000000;
    margin-bottom: 15px;
    text-align: center;
} */

.cera-peach-single {
    width: 80%;
    background: rgba(255, 255, 255, 0.4);
    backdrop-filter: blur(17px);
    border-radius: 18px;
    padding: 32px;
    display: flex;
    margin: 10px auto;
    border: 2px solid white;
}
.img-peach-cont {
    width: 50%;
    position: relative;
    padding-top: 30%;
}
.img-peach-cont > img {
    position: absolute;
    top: 0;
    left: 0;
    object-fit: cover;
    width: 100%;
    height: 100%;
    border: 2px solid #ffffff;
    border-radius: 20px;
}
.peach-inner-details {
    width: 50%;
}
.peach-inner-info {
    width: 90%;
    margin: auto;
    margin-bottom: 20px;
    background: rgba(255, 247, 241, 0.49);
    box-shadow: 7px 8px 53px #eed1bd;
    display: flex;
    flex-direction: column;
    padding: 40px;
    padding-bottom: 20px;
    margin-top: -32px;
    border: 2px solid white;
    border-top: 1px solid white;
}
.peach-inner-info img {
    margin-right: 15px;
}
.peach-inner-info > span {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 18px;
    line-height: 18px;
    letter-spacing: 0.03em;
    color: #525252;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
}
.peach-inner-info > span:nth-child(1) {
    font-family: "Quico Display";
    font-style: normal;
    font-weight: 700;
    font-size: 30px;
    line-height: 30px;
    color: #7a032a;
}
.peach-inner-dress {
    width: 90%;
    margin: auto;
}
.peach-inner-dress > h1 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 16px;
    line-height: 16px;
    letter-spacing: 0.03em;
    color: #525252;
}
.peach-inner-dress > div {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}
.peach-inner-dress > div > div {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 16px;
    border: 2px solid white;
    margin: 5px auto;
}
.peach-inner-dress > div > div > img:nth-child(1) {
    padding: 30px;
}
.peach-inner-dress > div > div > img:nth-child(2) {
    width: 83px;
    height: 78px;
    border: 2px solid white;
}
.cer-head-mobile {
    display: none;
    width: 100%;
    justify-content: center;
}
.cer-head-mobile > h1 {
    margin-bottom: 0;
    width: max-content;
    padding: 14px 30px;
    background: #ffffff;
    border-top-right-radius: 13px;
    border-top-left-radius: 13px;
    font-family: "Reem Kufi Fun";
    font-style: normal;
    font-weight: 400;
    font-size: 40px;
    line-height: 40px;
    /* identical to box height, or 100% */

    color: #cd8e55;
}
.cere-popup-container {
    background: linear-gradient(
        0deg,
        rgba(95, 63, 15, 0.77),
        rgba(95, 63, 15, 0.77)
    );
    position: fixed;
    width: 100vw;
    height: 100vh;
    top: 0;
    left: 0;
    z-index: 999999;
    display: flex;
    justify-content: center;
    overflow-y: auto;
    -ms-overflow-style: none; /* IE and Edge */
    scrollbar-width: none; /* Firefox */
    padding: 10px;
}
.cere-popup-container::-webkit-scrollbar {
    display: none;
}
@media screen and (max-width: 1400px) {
    .cera-peach-single {
        width: 90%;
    }
}
@media screen and (max-width: 1200px) {
    .peach-inner-dress > div > div {
        padding: 8px;
    }
    .peach-inner-dress > div > div > img:nth-child(1) {
        padding: 10px;
    }
    .cera-peach-single {
        padding-right: 10px;
    }
}
@media screen and (max-width: 824px) {
    .cera-peach-single {
        width: 90%;
    }
    .peach-inner-info > span:last-child {
        margin-bottom: 0;
    }
    .peach-inner-dress > div > div > img:nth-child(2) {
        width: 65px;
        height: 60px;
    }
    .peach-inner-info > span {
        font-size: 16px;
        line-height: 16px;
        letter-spacing: 0.03em;
    }
}
@media screen and (max-width: 767px) {
    .cera-peach-single {
        width: 70%;
        flex-wrap: wrap;
        padding-right: 32px;
    }
    .img-peach-cont {
        width: 100%;
        padding-top: 60%;
    }
    .peach-inner-details {
        width: 100%;
    }
}
@media screen and (max-width: 576px) {
    .cera-peach-single {
        width: 100%;
        padding: 0;
        border: none;
        background: none;
    }
    .peach-inner-info {
        position: relative;
        z-index: 99;
        background: rgba(255, 255, 255, 0.8);
        border: 1.5px solid #ffffff;
        border-bottom: none;
        box-shadow: 4px -20px 18px rgba(0, 0, 0, 0.25);
        backdrop-filter: blur(26.5px);
        padding: 30px;
        border-top-left-radius: 10px;
        border-top-left-radius: 10px;
        margin-bottom: 0;
    }
    .peach-inner-dress {
        background: rgba(255, 255, 255, 0.8);
        border: 1.5px solid #ffffff;
        border-bottom-left-radius: 10px;
        border-bottom-left-radius: 10px;
        border-top: none;
        box-shadow: 4px 4px 18px rgba(0, 0, 0, 0.25);
        backdrop-filter: blur(26.5px);
        padding: 21px;
        padding-top: 0;
    }
    .peach-inner-info > span:nth-child(1) {
        display: none;
    }
    .peach-inner-info > span {
        font-size: 16px;
        line-height: 16px;
        letter-spacing: 0.03em;
    }
    .cer-head-mobile {
        display: flex;
    }
}
</style>
