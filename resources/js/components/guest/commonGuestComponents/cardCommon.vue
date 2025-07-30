<template>
    <div class="guest-dash-card">
        <a
            :href="route('guestinvitation', [user, invi])"
            class="guest-dash-card-content"
        >
            <div class="img-cont" v-if="invi.imageOne">
                <img
                    :src="'/assets/defaults/ceramonies/images/' + invi.imageOne"
                    alt=""
                />
            </div>
            <div class="img-cont" v-else>
                <img src="/assets/guestDash/inviCommon.png" alt="" />
            </div>
            <div>
                <div class="guest-dash-card-head">
                    <span :class="setClass"
                        >{{ invi.startDate | moment("DD") }}
                        <span>{{ invi.startDate | moment("MMM") }}</span></span
                    >
                    <span>{{ invi.groomName }} weds {{ invi.brideName }}</span>
                </div>
                <div
                    v-if="invi?.ceraStart && invi?.ceraEnd"
                    class="guest-dash-info"
                >
                    <img src="/assets/guestDash/calender.svg" alt="" />
                    <span
                        ><b>Ceremonies:</b>
                        <!-- {{ invi.ceraStart | moment("dddd, MMMM D, YYYY") }} to
                        {{ invi.ceraEnd | moment("dddd, MMMM D, YYYY") }} -->
                        {{ invi.startDate | moment("dddd, MMMM D, YYYY") }}
                    </span>
                </div>
                <div v-if="invi.venues.length > 0" class="guest-dash-info">
                    <img src="/assets/guestDash/location.svg" alt="" />
                    <span v-for="e in invi.venues" :key="e.name">
                        {{ e.name }}
                        <template v-if="e.address">, {{ e.address }}</template>
                        <template v-if="e.pincode">, {{ e.pincode }}</template>
                        <template v-if="e.city">, {{ e.city }}</template>
                        <template v-if="e.state">, {{ e.state }}</template>
                        <template v-if="e.location && e.location.name">, {{ e.location.name }}</template>
                        <template v-if="e.location && e.location.state && e.location.state.name">, {{ e.location.state.name }}</template>
                    </span>
                </div>
            </div>
        </a>
        <!-- <div class="guest-dash-card-btns">
            <button title="Pending" @click="$emit('view', invi)" type="button">
                <img src="/assets/guestDash/eye.svg" alt="" />
            </button>
            <button title="Accept" @click="$emit('accept', invi)" type="button">
                <img src="/assets/guestDash/check.svg" alt="" />
            </button>
            <button
                title="Decline"
                @click="$emit('decline', invi)"
                type="button"
            >
                <img src="/assets/guestDash/x.svg" alt="" />
            </button>
        </div> -->
    </div>
</template>

<script>
export default {
    props: ["invi", "user", "active"],
    computed: {
        setClass() {
            if (this.active == "accepted") {
                return "green";
            }
            if (this.active == "declined") {
                return "red";
            }
            if (this.active == "pending") {
                return "yellow";
            }
        },
    },
};
</script>

<style scoped>
/* card csss start */
.red {
    background: #c94b33 !important;
}
.yellow {
    background: #e26b00 !important;
}
.green {
    background: #23871d !important;
}
.guest-dash-card {
    background: #ffffff;
    border: 7.91317px solid #f3f3f3;
    border-radius: 6.37724px;
    padding: 3px;
    max-width: 213px;
    width: 100%;
    margin-right: 10px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}
.guest-dash-card-content {
    padding: 8px;
    background: #ffffff;
    display: flex;
    text-decoration: none;
    flex-direction: column;
}
.img-cont {
    position: relative;
    padding-top: 80%;
    margin-bottom: 15px;
}
.guest-dash-card-content > .img-cont > img {
    width: 100%;
    height: 100%;
    object-fit: cover;

    position: absolute;
    top: 0;
    left: 0;
}
.guest-dash-card-head {
    display: flex;
    align-items: center;
}
.guest-dash-card-head > span:nth-child(1) {
    background: #461952;
    border-radius: 6.37724px;
    padding: 7px 8px;
    display: inline-block;
    text-align: center;
    vertical-align: center;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 13.1462px;
    line-height: 20px;
    margin-right: 10px;
    color: #ffffff;
}
.guest-dash-card-head > span:nth-child(1) > span {
    font-weight: 300;
    font-size: 9.14521px;
    line-height: 14px;
    display: block;
}
.guest-dash-card-head > span:nth-child(2) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 13.1462px;
    line-height: 20px;
    color: #000000;
}
.guest-dash-info {
    display: flex;
    align-items: center;
    margin: 5px 0;
}
.guest-dash-info > img {
    margin-right: 10px;
}
.guest-dash-info > span {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 9.81904px;
    line-height: 15px;
    color: #99a0af;
}
.guest-dash-card-btns {
    display: flex;
    justify-content: space-between;
    margin-top: 5px;
    border-top: 5.91317px solid #f3f3f3;
}
.guest-dash-card-btns > button {
    border: none;
    outline: none;
    background: #ffffff;
    border-radius: 2.5509px;
    width: 66px;
    height: 43px;
    display: block;
}

/* card css end */
</style>
