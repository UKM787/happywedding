<template>
    <div @click.stop class="cera-single-popup-cont">
        <div class="cere-haldi-cont">
            <div class="cere-haldi-cont-inner">
                <P class="cere-haldi-couple" style="font-family: Bahnschrift SemiBold;">
                    {{ invi?.side == 'bride' ? 
                        `D/O ${invi.brideFatherName} & ${invi.brideMotherName}` : 
                        `S/O ${invi.groomFatherName} & ${invi.groomMotherName}` 
                    }}
                </p>
                <img
                    class="cere-haldi-udnerline"
                    src="/assets/guestInvi/cera-under-common.svg"
                    alt=""
                />
                <h1 class="cere-haldi-title">Haldi Ceremony</h1>
                <p class="cere-haldi-invite-type">
                    You are invited to
                    <span class="bold"
                        >{{ invi?.side == 'bride' ? invi.brideName : invi.groomName }} WEDS {{ invi?.side == 'groom' ? invi.brideName : invi.groomName }} </span
                    >
                    haldi
                    {{ ceremony.inviteWith != 1 ? "with" : "" }}
                    <span class="bold" v-if="ceremony.inviteWith == 2"
                        >Your Spouse</span
                    >
                    <span class="bold" v-if="ceremony.inviteWith == 3"
                        >Your Family</span
                    >
                </p>
                <div class="cere-haldi-time-venue">
                    <h5>
                        <img
                            src="/assets/guestInvi/bi_calendar-fill.svg"
                            alt=""
                        />
                        Ceremony:
                    </h5>
                    <p>
                        <span>
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
                        </span>
                        <span>
                            At
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
                        </span>
                    </p>
                </div>
                <div class="cere-haldi-time-venue">
                    <h5>
                        <img
                            src="/assets/guestInvi/bi_location-fill.svg"
                            alt=""
                        />
                        Venue:
                    </h5>
                    <p v-for="e in ceremony && ceremony.venues ? ceremony.venues : []" :key="e.name">
                        {{ e.name }}
                        <span v-if="e.location && e.location.name">, {{ e.location.name }}</span>
                        <span v-if="e.location && e.location.state">, {{ e.location.state }}</span>
                        <span v-if="!e.location && e.address">, {{ e.address }}</span>
                    </p>
                </div>
                <div
                    v-if="
                        ceremony.menDress ||
                        ceremony.ladiesDress ||
                        ceremony.imageTwo ||
                        ceremony.imageThree
                    "
                    class="cere-haldi-dress-cont"
                >
                    <h3>Dress Code</h3>
                    <div>
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
                            <div v-if="ceremony.imageTwo">
                                <img
                                    class="dress-img"
                                    :src="
                                        '/assets/defaults/ceramonies/images/' +
                                        ceremony.imageTwo
                                    "
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
                            <div v-if="ceremony.imageThree">
                                <img
                                    class="dress-img"
                                    :src="
                                        '/assets/defaults/ceramonies/images/' +
                                        ceremony.imageThree
                                    "
                                    alt=""
                                />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cere-reception-end">
                    With pride and joy, we invite you to share a special day in
                    our lives as we…
                </div>
            </div>
        </div>
        <button @click="$emit('ceraClose')" type="button">
            <img
                class="grey-filter"
                src="/assets/guestInvi/Group-1714.svg"
                alt=""
            />
        </button>
    </div>
</template>

<script>
export default {
    props: ["ceremony", "brideName", "groomName", 'invi'],
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
.cera-single-popup-cont > button {
    position: absolute;
    top: 18px;
    right: 23px;
    z-index: 9999;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 41px;
    height: 41px;
    background: rgba(255, 255, 255, 0.4);
    border: 0.5px solid #e3d9d7;
    backdrop-filter: blur(7.85714px);
}
.cere-haldi-cont {
    padding: 40px 33px;
    background-image: url("/assets/guestInvi/haldi-card-top.png"),
        url("/assets/guestInvi/haldi-card-left-bottom.png"),
        url("/assets/guestInvi/haldi-card-right-bottom.png");
    background-repeat: no-repeat, no-repeat, no-repeat, no-repeat;
    background-position: top, left bottom, right bottom;
    background-size: 100%, auto, auto;
}
.grey-filter {
    filter: invert(80%) sepia(1%) saturate(0) hue-rotate(314deg) brightness(12%)
        contrast(1%);
}
.cere-haldi-cont-inner {
    padding: 30px 39px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}
.cere-haldi-couple {
    font-family: "Bell MT";
    font-style: normal;
    font-weight: 400;
    font-size: 14.1268px;
    line-height: 16px;
    text-align: center;
    color: #000000;
    margin-bottom: 10px;
    text-transform: uppercase;
}
.cere-haldi-title {
    font-family: "Engagement";
    font-style: normal;
    font-weight: 400;
    font-size: 46px;
    line-height: 57px;
    text-align: center;
    color: #613f35;
}
.cere-haldi-invite-type {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 300;
    font-size: 13px;
    line-height: 20px;
    text-align: center;
    color: #613f35;
}
.cere-haldi-invite-type > .bold {
    font-weight: 500;
}
.cere-haldi-time-venue > h5 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 13.5989px;
    line-height: 20px;
    text-align: center;
    color: #613f35;
}
.cere-haldi-time-venue > p {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 300;
    font-size: 13px;
    line-height: 20px;
    text-align: center;
    color: #613f35;
}
.cere-haldi-dress-cont {
    width: 100%;
}
.cere-haldi-dress-cont > h3 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 600;
    font-size: 13.5989px;
    line-height: 20px;
    color: #613f35;
    text-align: center;
}
.cere-haldi-dress-cont > div {
    display: flex;
    justify-content: center;
    width: 100%;
}
.cere-haldi-dress-cont > div > div:nth-child(1) {
    margin-right: 32px;
}
.dress-img {
    width: 111px;
    height: 73px;
    margin-top: 8px;
    border-radius: 2px;
}
.cere-haldi-dress-cont {
    margin-top: 13px;
}

.cere-haldi-dress-cont > div {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 300;
    font-size: 11.29px;
    line-height: 17px;
    color: #613f35;
}
.cere-reception-end {
    font-family: "Poppins";
    font-style: italic;
    font-weight: 400;
    font-size: 13px;
    line-height: 20px;
    text-align: center;
    color: #613f35;
    width: 80%;
    margin-top: 15px;
}
@media screen and (max-width: 768px) {
    .cera-single-popup-cont {
        width: 95% !important;
    }
    .cere-haldi-cont {
        background-size: 100%, 30%, 30% !important;
    }
}
</style>
