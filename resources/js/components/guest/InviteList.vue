<template>
    <div>
        <div class="container-lg main-cont">
            <!-- <h1 v-if="active == 'new'">
                New Invitation ({{ allInvites.length }})
            </h1>
            <h1 v-if="active == 'accepted'">Going ({{ allInvites.length }})</h1>
            <h1 v-if="active == 'declined'">
                Declined Invitation ({{ allInvites.length }})
            </h1>
            <h1 v-if="active == 'pending'">
                Pending Invitation ({{ allInvites.length }})
            </h1> -->
            <div class="no-invite-banner" v-if="allInvites.length == 0">
                <div>
                    <img src="/assets/guestDash/Frame100.png" alt="" />
                    <div v-if="active == 'new'">
                        <p>No new Invitation</p>
                        <p>You have no new invitations.</p>
                    </div>
                    <div v-if="active == 'accepted'">
                        <p>No Accepted Invitation</p>
                        <p>You have no pending invitations.</p>
                        <p>Accept Invitations</p>
                    </div>
                    <div v-if="active == 'declined'">
                        <p>No Declined Invitation</p>
                        <p>You have no declined invitations.</p>
                    </div>
                    <div v-if="active == 'pending'">
                        <p>No Pending Invitation</p>
                        <p>You have no pending invitations.</p>
                    </div>
                </div>
            </div>
            <div v-else class="all-invite-cont">
                <cardCommonVue
                    :class="{ blur: submit }"
                    style="max-width: none"
                    v-for="item in allInvites"
                    :key="item.id"
                    :invi="item"
                    :user="user"
                    :active="active"
                    @view="inviControl(item, 'view')"
                    @accept="inviControl(item, 'accept')"
                    @decline="inviControl(item, 'decline')"
                ></cardCommonVue>
            </div>
        </div>
        <flashMessage :message="message"></flashMessage>
    </div>
</template>

<script>
import flashMessage from "../FlashMessage.vue";
import navBar from "./commonGuestComponents/navCommon.vue";
import cardCommonVue from "./commonGuestComponents/cardCommon.vue";

export default {
    props: ["user", "invitations", "active"],
    data() {
        return {
            allInvites: this.invitations,
            message: null,
            submit: false,
        };
    },
    components: {
        flashMessage,
        navBar,
        cardCommonVue,
    },
    methods: {
        inviControl(item, type) {
            let _this = this;
            _this.submit = true;
            let link = null;
            if (type == "view") {
                link = route("guestnoted", [_this.user, item]);
            }
            if (type == "accept") {
                link = route("guestaccepted", [_this.user, item]);
            }
            if (type == "decline") {
                link = route("guestdeclined", [_this.user, item]);
            }
            axios({
                url: link,
                method: "POST",
            })
                .then((response) => {
                    let index = _this.allInvites.findIndex(
                        (x) => x.id == item.id
                    );
                    if (index > -1) {
                        _this.allInvites.splice(index, 1);
                    }
                    if (type == "view") {
                        _this.message = "Invitation Seen";
                        _this.$emit(
                            "invitechange",
                            "pending",
                            item,
                            _this.allInvites
                        );
                    }
                    if (type == "accept") {
                        _this.message = "Invitation accepted";
                        _this.$emit(
                            "invitechange",
                            "accepted",
                            item,
                            _this.allInvites
                        );
                    }
                    if (type == "decline") {
                        _this.message = "Invitation rejected";
                        _this.$emit(
                            "invitechange",
                            "declined",
                            item,
                            _this.allInvites
                        );
                    }
                    _this.submit = false;
                    setTimeout(() => {
                        _this.message = null;
                    }, 3000);
                })
                .catch((error) => {
                    _this.submit = false;
                    console.log(error);
                });
        },
    },
    watch: {
        invitations: function (newVal, oldVal) {
            // watch it
            this.allInvites = newVal;
        },
    },
};
</script>

<style scoped>
.blur {
    filter: blur(2px);
    pointer-events: none;
}
.main-cont {
    position: relative;
    top: 145px;
    margin-bottom: 145px;
    min-height: 70vh;
    height: 100%;
}
.all-invite-cont {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(215px, 1fr));
    grid-template-rows: max-content;
    grid-column-gap: 10px;
    grid-row-gap: 20px;
}
.main-cont > h1 {
    font-family: "Roboto";
    font-style: normal;
    font-weight: 400;
    font-size: 20px;
    line-height: 23px;
    text-align: center;
    width: 100%;
    color: #000000;
}
.no-invite-banner {
    background: #f6f5fb;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
}
.no-invite-banner > div > div > p:nth-child(1) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 22.2467px;
    line-height: 33px;
    width: 100%;
    text-align: center;
    color: #000000;
}
.no-invite-banner > div > img {
    max-width: 341px;
    max-height: 307px;
    width: 100%;
}
.no-invite-banner > div > div > p:nth-child(2),
.no-invite-banner > div > div > p:nth-child(3) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 16px;
    line-height: 24px;
    /* identical to box height */

    width: 100%;
    text-align: center;

    color: #898484;
}
@media screen and (max-width: 768px) {
    .main-cont {
        top: 115px !important;
        margin-bottom: 115px !important;
    }
}
</style>
