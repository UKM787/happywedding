<template>
    <div class="main-cont">
        <div class="verify-box">
            <div class="top">
                <div>
                    <h1>Reset Password</h1>
                    <p>
                        Enter your email address for instructions to reset your
                        password.
                    </p>
                </div>
                <img src="/assets/login/reset.png" alt="" />
            </div>
            <div v-if="status == 'success'" class="middle">
                {{ message }}
                <a target="_blank" href="https://mail.google.com"
                    >Go to Gmail »</a
                >
            </div>
            <div v-if="status == 'failure'" class="middle">
                {{ message }}
            </div>
            <form :action="formSubmitRoute" method="POST">
                <input type="hidden" name="_token" v-bind:value="csrf" />

                <label class="form-grp-cstm">
                    E-Mail Address
                    <input name="email" type="email" v-model="email" />
                    <span
                        v-if="errorSubmit && errorSubmit.email"
                        class="errMsg"
                        >{{ errorSubmit.email[0] }}</span
                    >
                </label>
                <button type="submit">Resend Link</button>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    props: ["errorSubmit", "oldvalues", "url", "message", "status"],
    data() {
        return {
            active: this.url ?? "Host",
            csrf: $('meta[name="csrf-token"]').attr("content"),
            email: this.oldvalues["email"] ?? null,
        };
    },
    computed: {
        formSubmitRoute() {
            if (
                this.url == "host" ||
                this.url == "bride" ||
                this.url == "groom" ||
                this.url == "member"
            ) {
                return route("hostpassword.email", [this.url]);
            }
            if (this.url == "vendor") {
                return route("vendorpassword.email", [this.url]);
            }
            if (this.url == "guest") {
                return route("guestpassword.email", [this.url]);
            }
            if (this.url == "company") {
                return route("companypassword.email", [this.url]);
            }
            if (this.url == "admin") {
                return route("adminpassword.email", [this.url]);
            }
        },
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
    padding: 49px;
}
.verify-box > .top {
    display: flex;
}
.top h1 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 25px;
    line-height: 38px;
    color: #000000;
}
.top p {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 16px;
    line-height: 24px;
    color: #000000;
}
.top img {
    width: 100px;
    height: 100px;
    align-self: flex-end;
}
.middle {
    background: #e8f8e2;
    border-radius: 5px;
    padding: 16px;
    font-family: "Inter";
    font-style: normal;
    font-weight: 400;
    font-size: 15px;
    line-height: 20px;
    color: #3b682c;
}
.middle > a {
    text-decoration: none;
    display: block;
    width: 100%;
    color: inherit;
}
.form-grp-cstm {
    font-family: "Inter";
    font-style: normal;
    font-weight: 500;
    font-size: 14px;
    line-height: 20px;
    color: #6b7280;
    display: flex;
    flex-direction: column;
}
.form-grp-cstm input {
    background: #ffffff !important;
    border: 0.896226px solid #e5e7eb !important;
    box-shadow: 0px 0.896226px 1.79245px rgba(31, 41, 55, 0.08) !important;
    border-radius: 3.58491px !important;
    padding: 15px 7px;
}
.verify-box > form {
    margin-top: 15px;
}
.verify-box > form > button {
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
    display: flex;
    justify-content: center;
    align-items: center;
    margin-left: auto;
    margin-top: 12px;
}
</style>
