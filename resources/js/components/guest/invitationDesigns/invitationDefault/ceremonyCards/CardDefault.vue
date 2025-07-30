<template>
    <div @click.stop class="cera-single-popup-cont">
        <div class="cera-single-popup-img">
            <img
                :src="ceremony && ceremony.imageOne ? '/assets/defaults/ceramonies/images/' + ceremony.imageOne : ''"
                alt=""
            />
            <button @click="$emit('ceraClose')">
                <img src="/assets/guestInvi/cera-popup-close.svg" alt="" />
            </button>
        </div>
        <div class="cera-single-popup-content">
            <div class="cera-popup-head">
                <div>
                    <h1>{{ ceremony && ceremony.name ? titleCase(ceremony.name) : '' }}</h1>
                    <p>
                        You are invited to {{ groomName }} weds {{ brideName }}
                        {{ ceremony && ceremony.inviteWith != 1 ? "with" : "" }}
                        <span v-if="ceremony && ceremony.inviteWith == 2">Your Spouse</span>
                        <span v-if="ceremony && ceremony.inviteWith == 3">Your Family</span>
                    </p>
                </div>
                <div>
                    <span v-if="ceremony && ceremony.startDate">{{
                        new Date(ceremony.startDate).toLocaleDateString(
                            "en-us",
                            {
                                day: "numeric",
                            }
                        )
                    }}</span>
                    <span v-if="ceremony && ceremony.startDate">{{
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
                            src="/assets/guestInvi/cera-popup-cal.svg"
                            alt=""
                        />
                    </div>
                    <div>
                        <div v-if="ceremony && ceremony.startDate">
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
                        <div v-if="ceremony && ceremony.startTime">
                            At&nbsp
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
                            src="/assets/guestInvi/cera-popup-loc.svg"
                            alt=""
                        />
                    </div>
                    <div>
                        <div v-for="e in ceremony && ceremony.venues ? ceremony.venues : []" :key="e.name">
                            <div class="venue-name">{{ e.name }}</div>
                            <div class="venue-details">
                                <template v-if="e.address">{{ e.address }}</template>
                                <template v-if="e.landmark"><br>{{ e.landmark }}</template>
                                <template v-if="e.city"><br>{{ e.city }}</template>
                                <template v-if="e.state"><br>{{ e.state }}</template>
                                <template v-if="e.pincode"><br>{{ e.pincode }}</template>
                                <template v-if="e.mobile"><br>Contact: {{ e.mobile }}</template>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    v-if="
                        ceremony && (
                        ceremony.menDress ||
                        ceremony.ladiesDress ||
                        ceremony.imageTwo ||
                        ceremony.imageThree
                    )"
                    class="cere-view-dress-cont"
                >
                    <h3>Dress Code</h3>
                    <div v-if="ceremony && ceremony.menDress || ceremony && ceremony.imageTwo">
                        <span>
                            <img
                                src="/assets/ceramonies/carbon_gender-male.svg"
                                alt=""
                            />
                            <span>Men:</span>
                        </span>
                        <span v-if="ceremony && ceremony.menDress">
                            {{ ceremony && ceremony.menDress }}
                        </span>
                        <div v-if="ceremony && ceremony.imageTwo">
                            <img
                                class="dress-img"
                                :src="
                                    ceremony && ceremony.imageTwo ? 
                                    '/assets/defaults/ceramonies/images/' + ceremony.imageTwo : ''
                                "
                                alt=""
                            />
                        </div>
                    </div>
                    <div v-if="ceremony && ceremony.ladiesDress || ceremony && ceremony.imageThree">
                        <span>
                            <img
                                src="/assets/ceramonies/carbon_gender-female.svg"
                                alt=""
                            />
                            <span>Women:</span>
                        </span>
                        <span v-if="ceremony && ceremony.ladiesDress">
                            {{ ceremony && ceremony.ladiesDress }}
                        </span>
                        <div v-if="ceremony && ceremony.imageThree">
                            <img
                                class="dress-img"
                                :src="
                                    ceremony && ceremony.imageThree ? 
                                    '/assets/defaults/ceramonies/images/' + ceremony.imageThree : ''
                                "
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
    background: #ffffff;
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
}
.cera-popup-head > div:nth-child(1) > h1 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 17.3622px;
    line-height: 26px;
    margin-bottom: 7px;
    color: #000000;
}
.cera-popup-head > div:nth-child(1) > p {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 300;
    font-size: 13px;
    line-height: 20px;
    color: #000000;
}
.cera-popup-head > div:nth-child(1) > p > span {
    font-weight: 600;
}
.cera-popup-head > div:nth-child(2) {
    background: #f3f5f7;
    border-radius: 9px;
    width: 72px;
    height: 93px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    margin-left: 5px;
}
.cera-popup-head > div:nth-child(2) > span {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 21.2409px;
    line-height: 32px;
    color: #384a64;
    display: block;
    margin-bottom: 5px;
}
.cera-popup-head > div:nth-child(2) > span:nth-child(2) {
    font-weight: 400;
    font-size: 9.5584px;
    line-height: 14px;
}
.cera-popup-details > h5 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 13.5989px;
    line-height: 20px;
    color: #384a64;
    margin-bottom: 7px;
}
.cera-popup-details > .cere-view-info-time {
    margin-bottom: 12px;
    align-items: center !important;
}
.cera-popup-details > .cere-view-info-time > div {
    font-weight: 500 !important;
    font-size: 13.5989px !important;
    line-height: 20px !important;
    color: #626262 !important;
    display: flex !important;
}
.cera-popup-details > .cere-view-info-time > img {
    margin-right: 10px;
}
.cera-popup-details > .cere-view-dress-cont {
    display: flex;
    flex-wrap: wrap;
}
.cera-popup-details > .cere-view-dress-cont > h3 {
    font-weight: 500;
    font-size: 13.5989px;
    line-height: 20px;
    width: 100%;
    color: #384a64;
}
.cera-popup-details > .cere-view-dress-cont > div > span:nth-child(2) {
    font-weight: 500;
    font-size: 11.29px;
    line-height: 17px;
    color: #000000;
}
.cera-popup-details > .cere-view-dress-cont > div {
    margin-right: 32px;
}
.cera-popup-details .dress-img {
    width: 111px;
    height: 73px;
    margin-top: 8px;
}
.cere-view-dress-cont {
    margin-top: 13px;
}
.cere-view-dress-cont > h3 {
    font-family: "Poppins", sans-serif;
    font-style: normal;
    font-weight: 400;
    font-size: 11.29px;
    line-height: 17px;
    margin-bottom: 10px;
    color: #461952;
}
.cere-view-dress-cont > div {
    font-family: "Poppins", sans-serif;
    font-style: normal;
    font-weight: 300;
    font-size: 11.29px;
    line-height: 17px;
    color: #461952;
    margin-bottom: 5px;
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
.venue-name {
    font-weight: bold;
    font-size: 16px;
    margin-bottom: 8px;
}

.venue-details {
    font-size: 14px;
    color: #666;
    line-height: 1.5;
    margin-bottom: 16px;
}
</style>
