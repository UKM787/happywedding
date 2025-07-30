<template>
    <div @click.stop class="cera-single-popup-cont">
        <div class="cera-single-popup-img">
            <img :src="'/storage' + ceremony.imageOne" alt="" />
            <button @click="$emit('ceraClose')">
                <img src="/assets/guestInvi/cera-popup-close.svg" alt="" />
            </button>
        </div>
        <div class="cera-single-popup-content">
            <div class="cera-popup-head">
                <div>
                    <h1>{{ titleCase(ceremony.name) }}</h1>
                    <p>
                        You are invited to Shamil weds Sheetal engagement
                        {{ ceremony.inviteWith != 1 ? "with" : "" }}
                        <span v-if="ceremony.inviteWith == 2">Your Spouse</span>
                        <span v-if="ceremony.inviteWith == 3">Your Family</span>
                    </p>
                </div>
                <div>
                    <span>{{
                        new Date(ceremony.startDate).toLocaleDateString(
                            "en-us",
                            {
                                day: "numeric",
                            }
                        )
                    }}</span>
                    <span>{{
                        new Date(ceremony.startDate).toLocaleDateString(
                            "en-us",
                            {
                                month: "long",
                            }
                        )
                    }}</span>
                </div>
            </div>
            <div class="cera-popup-details">
                <h5>Details</h5>
                <div class="cere-view-info-time">
                    <div>
                        <img
                            src="/storage/guestInvitation/Peach/Calendar_check.svg"
                            alt=""
                        />
                    </div>
                    <div>
                        <div>
                            {{
                                new Date(ceremony.startDate).toLocaleDateString(
                                    "en-us",
                                    {
                                        weekday: "long",
                                        year: "numeric",
                                        month: "long",
                                        day: "numeric",
                                    }
                                )
                            }}
                            &nbsp
                        </div>
                        <div>
                            From&nbsp
                            {{
                                new Date(
                                    "1970-01-01T" + ceremony.startTime + "Z"
                                ).toLocaleTimeString("en-US", {
                                    timeZone: "UTC",
                                    hour12: true,
                                    hour: "numeric",
                                    minute: "numeric",
                                })
                            }}
                        </div>
                    </div>
                </div>
                <div class="cere-view-info-time">
                    <div>
                        <img
                            src="/storage/guestInvitation/Peach/location-popup.svg"
                            alt=""
                        />
                    </div>
                    <div>
                        <div v-for="e in ceremony.venues" :key="e.name">
                            {{ e.name }}, {{ e.location.name }},
                            {{ e.location.state }}
                        </div>
                    </div>
                </div>
                <div
                    v-if="
                        ceremony.menDress ||
                        ceremony.ladiesDress ||
                        ceremony.imageTwo ||
                        ceremony.imageThree
                    "
                    class="cere-view-dress-cont"
                >
                    <h3>Dress Code</h3>
                    <div v-if="ceremony.menDress || ceremony.imageTwo">
                        <span>
                            <img
                                src="/assets/ceramonies/carbon_gender-male.svg"
                                alt=""
                            />
                            <span>Men:</span>
                        </span>
                        <span v-if="ceremony.menDress">
                            {{ ceremony.menDress }}
                        </span>
                        <div
                            style="display: flex; justify-content: center"
                            v-if="ceremony.imageTwo"
                        >
                            <img
                                class="dress-img"
                                :src="'/storage' + ceremony.imageTwo"
                                alt=""
                            />
                        </div>
                    </div>
                    <div v-if="ceremony.ladiesDress || ceremony.imageThree">
                        <span>
                            <img
                                src="/assets/ceramonies/carbon_gender-female.svg"
                                alt=""
                            />
                            <span>Women:</span>
                        </span>
                        <span v-if="ceremony.ladiesDress">
                            {{ ceremony.ladiesDress }}
                        </span>
                        <div
                            style="display: flex; justify-content: center"
                            v-if="ceremony.imageThree"
                        >
                            <img
                                class="dress-img"
                                :src="'/storage' + ceremony.imageThree"
                                alt=""
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["ceremony", "brideName", "groomName"],
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
};
</script>

<style scoped>
/* .cere-popup-container {
    background: rgba(38, 38, 38, 0.8);
    position: fixed;
    width: 100vw;
    height: 100vh;
    top: 0;
    z-index: 999999;
    display: flex;
    justify-content: center;
    overflow-y: auto;
    -ms-overflow-style: none;
    scrollbar-width: none;
    padding: 10px;
}
.cere-popup-container::-webkit-scrollbar {
    display: none;
} */
.cera-single-popup-cont {
    background: url(/storage/guestInvitation/Peach/Background.png);
    background-size: 100%;
    background-position: 0 0;
    border-radius: 8px;
    width: 60%;
    max-width: 512px;
    position: relative;
    z-index: 999999;
    height: max-content;
    margin: auto;
    margin-top: 160px;
}

.cera-single-popup-img {
    padding-top: 50%;
    position: relative;
}
.cera-single-popup-img > img {
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
    object-fit: cover;
    padding: 6px;
}
.cera-single-popup-img > button {
    border: none;
    outline: none;
    background-color: inherit;
    position: absolute;
    top: 14px;
    right: 19px;
}
.cera-single-popup-content {
    padding: 27px 35px;
}
.cera-popup-head {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: -75px;
    background: rgba(255, 255, 255, 0.8);
    backdrop-filter: blur(27px);
    padding: 30px;
    border-radius: 18px;
}
.cera-popup-head > div:nth-child(1) > h1 {
    font-family: "Quico Display";
    font-style: normal;
    font-weight: 700;
    font-size: 30px;
    line-height: 30px;
    color: #7a032a;
    margin-bottom: 7px;
}
.cera-popup-head > div:nth-child(1) > p {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 14px;
    line-height: 19px;
    margin-bottom: 0;
    color: #390a1a;
}
.cera-popup-head > div:nth-child(1) > p > span {
    font-weight: 700;
}
.cera-popup-head > div:nth-child(2) {
    background: #ffffff;
    box-shadow: 5px 4px 14px rgba(189, 166, 148, 0.2);
    border-radius: 9px;
    width: max-content;
    display: flex;
    height: max-content;
    align-items: center;
    padding: 13px;
}
.cera-popup-head > div:nth-child(2) > span {
    font-family: "Quico Display";
    font-style: normal;
    font-weight: 700;
    font-size: 30px;
    line-height: 30px;
    color: #7a032a;
}
.cera-popup-head > div:nth-child(2) > span:nth-child(2) {
    font-weight: 600;
    font-size: 18px;
    line-height: 18px;
    text-transform: uppercase;
    margin-left: 5px;
    display: inline-block;
}
.cera-popup-details > h5 {
    font-family: "Quico Display";
    font-style: normal;
    font-weight: 700;
    font-size: 20px;
    line-height: 20px;
    color: #000000;
    margin-bottom: 7px;
    margin-top: 10px;
}
.cera-popup-details > .cere-view-info-time {
    margin-bottom: 12px;
    align-items: center !important;
    display: flex !important;
}
.cera-popup-details > .cere-view-info-time > div {
    display: flex !important;

    font-family: "Poppins";
    font-style: normal !important;
    font-weight: 500 !important;
    font-size: 14px !important;
    line-height: 19px !important;
    color: #390a1a !important;
}
.cera-popup-details > .cere-view-info-time > img {
    margin-right: 10px;
}
.cera-popup-details > .cere-view-dress-cont {
    display: flex;
    flex-wrap: wrap;
    background: rgba(255, 255, 255, 0.4);
    backdrop-filter: blur(17px);
    padding: 20px;
    border-radius: 18px;
}
.cera-popup-details > .cere-view-dress-cont > h3 {
    font-family: "Quico Display";
    font-style: normal;
    font-weight: 700;
    font-size: 20px;
    line-height: 20px;
    width: 100%;
    color: #7a032a;
    margin-bottom: 10px;
}
/* .cera-popup-details > .cere-view-dress-cont > div {
    margin-right: 32px;
} */
.cera-popup-details .dress-img {
    width: 111px;
    height: 73px;
    margin-top: 8px;
}
.cere-view-dress-cont {
    margin-top: 13px;
}
.cere-view-dress-cont > div {
    font-family: "Quico Display";
    font-style: normal;
    font-weight: 700;
    font-size: 20px;
    line-height: 20px;
    color: #7a032a;
    margin-bottom: 5px;
    width: 50%;
    word-break: break-all;
}
.cere-view-dress-cont > div > span:nth-child(1) {
    font-weight: 500;
}
.disp-image-feild {
    background: rgba(239, 220, 226, 0.6);
    border: 0.643349px solid #f7dae4;
    border-radius: 7.72019px;
    margin-bottom: 12px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 6px 0;
}
.disp-image-feild > button {
    width: max-content;
    padding: 4px 10px;
    margin-right: 10px;
}
.disp-image-feild > span {
    font-family: "Poppins", sans-serif;
    font-style: normal;
    font-weight: 400;
    font-size: 12px;
    line-height: 8px;
    /* identical to box height, or 64% */
    margin-left: 10px;
    color: #000000;
}
.dress-img {
    width: 55px;
    height: 41px;
    object-fit: cover;
}
@media screen and (max-width: 768px) {
    .cera-single-popup-cont {
        width: 95% !important;
    }
}
</style>
