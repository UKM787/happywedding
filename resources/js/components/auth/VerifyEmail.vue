<template>
    <div class="main-cont">
        <form
            class="verify-box"
            :action="route('verification.send')"
            method="POST"
        >
            <input type="hidden" name="_token" v-bind:value="csrf" />

            <h1>Verify Your Email Address</h1>
            <p>
                Before proceeding please check your email for a verification
                link, if you did not receive any
            </p>
            <img src="/assets/login/Frame-5743.svg" alt="" />
            <button type="submit">Resend Link</button>
        </form>
        <!-- <form
            class="verify-box"
            :action="route('customEmailVerify')"
            method="POST"
        >
            <input type="hidden" name="_token" v-bind:value="csrf" />

            <button type="submit">Verify Now!</button>
        </form> -->
    </div>
</template>

<script>
export default {
    data() {
        return {
            csrf: $('meta[name="csrf-token"]').attr("content"),
        };
    },
};
</script>

<style scoped>
.main-cont {
    width: 100%;
    height: 100%;
    min-height: 80vh;
    display: flex;
    justify-content: center;
    align-items: center;
}
.verify-box {
    background: #ffffff;
    border: 0.5px solid #e1e1e1;
    border-radius: 16px;
    max-width: 532px;
    margin: 10px;
    padding: 55px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
.verify-box > h1 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 25px;
    line-height: 38px;
    color: #000000;
    text-align: center;
}
.verify-box > p {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 16px;
    line-height: 24px;
    text-align: center;
    color: #000000;
}
.verify-box > button {
    font-family: "Inter";
    font-style: normal;
    font-weight: 400;
    font-size: 13.3726px;
    line-height: 19px;
    color: #ffffff;
    width: 162px;
    height: 40.5px;
    background: #461952;
    border-radius: 6.39474px;
}
</style>
