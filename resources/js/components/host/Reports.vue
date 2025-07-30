<template>
    <div class="wed-host-section">
        <div v-if="listUsers.length > 0" class="wed-host-section-container">
            <div class="guest-upload-head">
                <div class="guest-head-details">
                    <h3>Guest Details</h3>
                </div>
               <div @click.stop class="guest-select-sort">
                    <span style="position: relative">
                        <button
                            @click.stop="showSort = !showSort"
                            type="button"
                        >
                            <img src="/assets/filter.svg" alt="" />
                            Sort by
                        </button>
                        <div v-show="showSort" class="sort-cont">
                            <div class="btn-container">
                                <button
                                    type="button"
                                    class="tab-btn sort-btns active"
                                    data-id="sort-location"
                                    title="Location"
                                    @click="toggleForm($event, true)"
                                >
                                    Location
                                </button>
                                <button
                                    type="button"
                                    class="tab-btn sort-btns"
                                    data-id="sort-status"
                                    title="Status"
                                    @click="toggleForm($event, true)"
                                >
                                    Status
                                </button>
                            </div>
                            <div class="about-content">
                                <div class="content active sort-location">
                                    <label for="all-location">
                                        <input
                                            type="radio"
                                            name="location-sort"
                                            id="all-location"
                                        />
                                        All
                                    </label>
                                    <input
                                        type="text"
                                        name=""
                                        id=""
                                        placeholder="Search location"
                                        class="sort-location-search"
                                    />
                                    <div
                                        style="
                                            max-height: 123px;
                                            overflow-y: auto;
                                            overflow-x: hidden;
                                        "
                                    >
                                        <label for="delhi">
                                            <input
                                                type="radio"
                                                name="location-sort"
                                                id="delhi"
                                            />
                                            Delhi
                                        </label>
                                        <label for="punjab">
                                            <input
                                                type="radio"
                                                name="location-sort"
                                                id="punjab"
                                            />
                                            Pubjab
                                        </label>
                                        <label for="chennai">
                                            <input
                                                type="radio"
                                                name="location-sort"
                                                id="chennai"
                                            />
                                            Chennai
                                        </label>
                                    </div>
                                </div>
                                <div class="content sort-status">
                                    <label for="all-status">
                                        <input
                                            type="radio"
                                            name="status-sort"
                                            id="all-status"
                                        />
                                        All
                                    </label>
                                    <input
                                        type="text"
                                        name=""
                                        id=""
                                        placeholder="Search status"
                                        class="sort-status-search"
                                    />
                                    <div
                                        style="
                                            max-height: 123px;
                                            overflow-y: auto;
                                            overflow-x: hidden;
                                        "
                                    >
                                        <label for="accepted">
                                            <input
                                                type="radio"
                                                name="status-sort"
                                                id="accepted"
                                            />
                                            Accepted
                                        </label>
                                        <label for="pending">
                                            <input
                                                type="radio"
                                                name="status-sort"
                                                id="pending"
                                            />
                                            Pending
                                        </label>
                                        <label for="declined">
                                            <input
                                                type="radio"
                                                name="status-sort"
                                                id="declined"
                                            />
                                            Declined
                                        </label>
                                        <label for="notSeen">
                                            <input
                                                type="radio"
                                                name="status-sort"
                                                id="notSeen"
                                            />
                                            Not seen
                                        </label>
                                        <label for="noInvite">
                                            <input
                                                type="radio"
                                                name="status-sort"
                                                id="noInvite"
                                            />
                                            No invite
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </span>
                </div>
            </div>
            <div class="host-reports-cont">
                <div class="host-reports-head">
                    <span style="width: 15%">Name</span>
                    <span style="width: 15%">Phone number</span>
                    <span style="width: 26%">E-mail</span>
                    <span style="width: 11%">Invite</span>
                    <span style="width: 11%">Status</span>
                    <span style="width: 11%">Accommodation</span>
                    <span style="width: 11%">Logistics</span>
                </div>
                <div class="host-reports-content">
                    <div
                        v-for="(item, index) in listUsers"
                        :key="index"
                        class="host-reports-single"
                        @click="toggle($event)"
                    >
                        <span style="width: 15%; font-weight: 900">{{
                            item.name
                        }}</span>
                        <span style="width: 15%">{{ item.mobile }}</span>
                        <span style="width: 26%">{{ item.email }}</span>
                        <div style="width: 11%">
                            <span v-if="item.pivot.invite == 0">
                                <span
                                    class="no-invite"
                                    v-if="screenWidth >= 768"
                                    >No Invite</span
                                >
                                <img
                                    :class="{
                                        'accepted-filter':
                                            item.pivot.inviteStatus == 6,
                                        'declined-filter':
                                            item.pivot.inviteStatus == 5,
                                        'pending-filter':
                                            item.pivot.inviteStatus == 4,
                                    }"
                                    v-else
                                    src="/assets/slash.svg"
                                    alt=""
                                />
                            </span>
                            <span v-else-if="item.pivot.invite == 1">
                                <span v-if="screenWidth >= 768">Single</span>
                                <img
                                    :class="{
                                        'accepted-filter':
                                            item.pivot.inviteStatus == 6,
                                        'declined-filter':
                                            item.pivot.inviteStatus == 5,
                                        'pending-filter':
                                            item.pivot.inviteStatus == 4,
                                    }"
                                    v-else
                                    src="/assets/carbon_user.svg"
                                    alt=""
                            /></span>
                            <span v-else-if="item.pivot.invite == 2"
                                ><span v-if="screenWidth >= 768">Spouse</span>
                                <img
                                    :class="{
                                        'accepted-filter':
                                            item.pivot.inviteStatus == 6,
                                        'declined-filter':
                                            item.pivot.inviteStatus == 5,
                                        'pending-filter':
                                            item.pivot.inviteStatus == 4,
                                    }"
                                    v-else
                                    src="/assets/carbon_user-multiple.svg"
                                    alt=""
                            /></span>
                            <span v-else-if="item.pivot.invite == 3"
                                ><span v-if="screenWidth >= 768">Family</span>
                                <img
                                    :class="{
                                        'accepted-filter':
                                            item.pivot.inviteStatus == 6,
                                        'declined-filter':
                                            item.pivot.inviteStatus == 5,
                                        'pending-filter':
                                            item.pivot.inviteStatus == 4,
                                    }"
                                    v-else
                                    src="/assets/carbon_family.svg"
                                    alt=""
                            /></span>
                        </div>
                        <div style="width: 11%">
                            <span
                                class="no-invite"
                                v-if="item.pivot.invite == 0"
                                >No Invite</span
                            >
                            <span
                                class="pending"
                                v-else-if="item.pivot.inviteStatus == 4"
                                ><span class="dot-icon"></span> Pending</span
                            >
                            <span
                                class="declined"
                                v-else-if="item.pivot.inviteStatus == 5"
                                ><span class="dot-icon"></span> Declined</span
                            >
                            <span
                                class="accepted"
                                v-else-if="item.pivot.inviteStatus == 6"
                                ><span class="dot-icon"></span> Accepted</span
                            >
                            <span
                                class="not-seen"
                                v-else-if="
                                    item.pivot.invite == 1 ||
                                    item.pivot.invite == 2 ||
                                    item.pivot.invite == 3
                                "
                                ><span class="dot-icon"></span>Not Seen</span
                            >
                        </div>
                       <div style="width: 11%">
                            <span
                                class="no-invite"
                                v-if="item.pivot.invite == 0"
                                ><span v-if="screenWidth >= 768"
                                    >No Invite</span
                                ></span
                            >
                            <span
                                class="no-invite"
                                v-else-if="item.pivot.accommodationStatus == 0"
                                ><span v-if="screenWidth >= 768"
                                    >Not Offered</span
                                ></span
                            >
                            <span
                                class="not-seen"
                                v-else-if="item.pivot.accommodationStatus == 1"
                                ><span v-if="screenWidth >= 768">Offered</span>
                                <img v-else src="/assets/acc-grey.svg" alt=""
                            /></span>
                            <span
                                class="accepted"
                                v-else-if="
                                    item.pivot.accommodationStatus == 2 ||
                                    item.pivot.accommodationStatus == 4
                                "
                                ><span v-if="screenWidth >= 768">Accepted</span>
                                <img
                                    class="accepted-filter"
                                    v-else
                                    src="/assets/acc-grey.svg"
                                    alt=""
                            /></span>
                            <span
                                class="accepted"
                                v-else-if="item.pivot.accommodationStatus == 3"
                                ><span v-if="screenWidth >= 768">Declined</span>
                                <img
                                    class="accepted-filter"
                                    v-else
                                    src="/assets/acc-grey.svg"
                                    alt=""
                            /></span>
                        </div>
                        <div style="width: 11%">
                            <span
                                class="no-invite"
                                v-if="item.pivot.invite == 0"
                                ><span v-if="screenWidth >= 768"
                                    >No Invite</span
                                ></span
                            >
                            <span
                                class="no-invite"
                                v-else-if="
                                    item.pivot.logisticsArrivalStatus == 0 ||
                                    item.pivot.logisticsDepartureStatus == 0
                                "
                                ><span v-if="screenWidth >= 768"
                                    >Not Offered</span
                                >
                            </span>
                            <span
                                class="not-seen"
                                v-else-if="
                                    item.pivot.logisticsArrivalStatus == 1 ||
                                    item.pivot.logisticsDepartureStatus == 1
                                "
                                ><span v-if="screenWidth >= 768">Offered</span>
                                <img
                                    v-else
                                    src="/assets/logistics-grey.svg"
                                    alt=""
                            /></span>
                            <span
                                class="accepted"
                                v-else-if="
                                    item.pivot.logisticsArrivalStatus == 2 ||
                                    item.pivot.logisticsDepartureStatus == 2 ||
                                    item.pivot.logisticsArrivalStatus == 4 ||
                                    item.pivot.logisticsDepartureStatus == 4
                                "
                                ><span v-if="screenWidth >= 768">Accepted</span>
                                <img
                                    class="accepted-filter"
                                    v-else
                                    src="/assets/logistics-grey.svg"
                                    alt=""
                                />
                            </span>
                            <span
                                class="accepted"
                                v-else-if="
                                    item.pivot.logisticsArrivalStatus == 3 ||
                                    item.pivot.logisticsDepartureStatus == 3
                                "
                                ><span v-if="screenWidth >= 768">Declined</span>
                                <img
                                    class="accepted-filter"
                                    v-else
                                    src="/assets/logistics-grey.svg"
                                    alt=""
                                />
                            </span>
                        </div>
                        <div>
                            <i class="fas fa-chevron-down drop-arrow"></i>
                            <i class="fas fa-chevron-up drop-arrow"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-else class="wed-host-section-container">
            <h1>Send Invittaions to see the reports</h1>
        </div>
    </div>
</template>

<script>
export default {
    props: ["guests", "host"],
    data() {
        return {
            showSort: false,
            listUsers: this.guests,
            screenWidth: window.screen.width,
        };
    },
    methods: {
        toggleForm(e, bool) {
            //console.log(bool);
            let id = null;
            if (bool == true) {
                id = e.currentTarget.dataset.id;
            }
            if (bool == false) {
                id = e;
            }
            //console.log(e.currentTarget.parentElement.children);
            const btns = [...e.currentTarget.parentElement.children];
            const articles = [
                ...e.currentTarget.parentElement.nextElementSibling.children,
            ];
            const articlesCont =
                e.currentTarget.parentElement.nextElementSibling;

            //console.log(btns, articles);
            btns.forEach(function (btn) {
                btn.classList.remove("active");
            });
            btns.forEach(function (btn) {
                if (btn.dataset.id == id) {
                    btn.classList.add("active");
                }
            });
            articles.forEach(function (article) {
                article.classList.remove("active");
            });
            //console.log(document.getElementById(e.currentTarget.dataset.id));
            $(articlesCont)
                .find(`.${e.currentTarget.dataset.id}`)
                .addClass("active");
            //document.getElementById(id).classList.add("active");
        },
        toggle(e) {
            //console.log(screen.width);
            if (screen.width <= 968) {
                let currEle = e.currentTarget;
                let all = [
                    ...document.getElementsByClassName("host-reports-single"),
                ];
                if (currEle.classList.contains("active")) {
                    currEle.classList.remove("active");
                    return;
                }
                all.forEach(function (item) {
                    if (item.classList.contains("active")) {
                        item.classList.remove("active");
                    }
                });

                currEle.classList.add("active");
            }
        },
        listeners(e) {
            this.screenWidth = window.screen.width;
        },
        hideSort() {
            this.showSort = false;
        },
    },
    computed: {},
    mounted() {
        this.$nextTick(function () {
            window.addEventListener("resize", this.listeners);
        });
    },
    created: function () {
        document.body.addEventListener("click", this.hideSort);
    },
};
</script>

<style scoped>
.hide {
    display: none !important;
}
.guest-upload-head {
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 43px;
    margin-bottom: 12px;
}
.guest-upload-head > div:nth-child(2) {
    position: absolute;
    top: 0;
    right: 0;
}
.guest-head-details > h3 {
    font-family: "Perpetua";
    font-style: normal;
    font-weight: 700;
    font-size: 24.4444px;
    line-height: 28px;
    color: #333333;
    margin-bottom: 0px;
    text-align: center;
    margin-top: auto;
}
.guest-select-sort button {
    border: 1px solid #e3e8ee;
    border-radius: 5px;
    padding: 13px 22px;
    background-color: #ffffff;
    font-family: "Inter";
    font-style: normal;
    font-weight: 400;
    font-size: 12px;
    line-height: 15px;
    color: #c4456f;
}
.sort-cont {
    position: absolute;
    background: #ffffff;
    box-shadow: 0px 3.65812px 7.31624px rgba(0, 0, 0, 0.25);
    right: 0;
    z-index: 99999;
    width: 186px;
}
.sort-btns {
    border: none !important;
    border-bottom: 0.3px solid #cdcdcd !important;
    border-radius: 0 !important;
}
.sort-btns.active {
    border-bottom: 4px solid #461952 !important;
    font-weight: 900;
    color: #461952;
}
.sort-location,
.sort-status {
    padding: 13px;
}
.sort-location input,
.sort-status input {
    margin-right: 10px;
}
.sort-location label,
.sort-status label {
    font-family: "Inter";
    font-style: normal;
    font-weight: 600;
    font-size: 9.84112px;
    line-height: 12px;
    text-transform: capitalize;
    margin: 10px;
    padding-bottom: 5px;
    color: #6b6b6b;
    width: 90%;
    border-bottom: 0.328037px solid #cdcdcd;
}
.sort-location-search,
.sort-status-search {
    font-family: "Inter";
    font-style: normal;
    font-weight: 600;
    font-size: 9.84112px;
    line-height: 12px;
    width: 97%;
    border: 0.546729px solid #b4b4b4;
    border-radius: 5.46729px;
    padding: 5px;
    text-transform: capitalize;

    color: #6b6b6b;
}
.content {
    display: none;
}
.content.active {
    display: block;
}
.host-reports-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    border: 0.5px solid #dedede;
    border-radius: 6px;
    padding: 17px 30px;
    margin-bottom: 10px;
}
.host-reports-head > span {
    display: block;
    font-family: "Poppins", sans-serif;
    font-style: normal;
    font-weight: 900;
    font-size: 12px;
    line-height: 18px;
    white-space: nowrap;
    text-overflow: ellipsis;
    overflow: hidden;
    margin-right: 3px;
    /* identical to box height */

    color: #000000;
}
.host-reports-single {
    display: flex;
    align-items: center;
    justify-content: space-between;
    border: 0.5px solid #dedede;
    border-radius: 6px;
    padding: 17px 30px;
    margin-bottom: 10px;
}
.host-reports-single span {
    font-family: "Poppins", sans-serif;
    font-style: normal;
    font-weight: 500;
    font-size: 12px;
    line-height: 18px;
    color: #000000;
    white-space: nowrap;
    text-overflow: ellipsis;
    overflow: hidden;
    margin-right: 3px;
    display: block;
}
.host-reports-singlec > span:nth-child(1) {
    font-weight: 600;
}
.accepted {
    color: #2fa706 !important;
}
.pending {
    color: #c96218 !important;
}
.declined {
    color: #f31c45 !important;
}
.not-seen {
    color: #898484 !important;
}
.no-invite {
    color: #afa5a5 !important;
}
.dot-icon {
    display: inline-block !important;
    margin-right: 2px !important;
    padding: 4px;
    border-radius: 50%;
    vertical-align: middle;
}
.accepted .dot-icon {
    background: #2fa706;
    border: 4px solid rgb(188 245 168);
}
.accepted-filter {
    filter: invert(45%) sepia(35%) saturate(2494%) hue-rotate(72deg)
        brightness(96%) contrast(95%);
}
.pending-filter {
    filter: invert(37%) sepia(94%) saturate(736%) hue-rotate(353deg)
        brightness(97%) contrast(88%);
}
.declined-filter {
    filter: invert(16%) sepia(54%) saturate(6708%) hue-rotate(341deg)
        brightness(103%) contrast(91%);
}
.not-seen-filter {
    filter: invert(58%) sepia(6%) saturate(0%) hue-rotate(61deg) brightness(91%)
        contrast(94%);
}
.pending .dot-icon {
    background: #c96218;
    border: 4px solid rgb(255 210 178);
}
.declined .dot-icon {
    background: #f31c45;
    border: 4px solid rgb(251 197 197);
}
.not-seen .dot-icon {
    background: #898484;
    border: 4px solid rgb(213 213 213);
}
.drop-arrow {
    display: none;
    margin-left: 5px;
}
@media only screen and (max-width: 996px) {
    .host-reports-head {
        display: none;
    }
    .host-reports-single {
        overflow: hidden;
        flex-wrap: wrap;
        max-height: 50px;
    }
    .host-reports-single > span:nth-child(1) {
        width: 35% !important;
        order: 1;
        margin-bottom: 12px;
    }
    .host-reports-single > span:nth-child(2) {
        width: 60% !important;
        order: 6;
    }

    .host-reports-single > span:nth-child(3) {
        width: 100% !important;
        order: 5;
        margin-bottom: 5px;
    }
    .host-reports-single > div:nth-child(4) {
        width: 20% !important;
        order: 2;
        margin-bottom: 12px;
    }
    .host-reports-single > div:nth-child(5) {
        width: 35% !important;
        order: 3;
        margin-bottom: 12px;
    }
    .host-reports-single > div:nth-child(6) {
        width: 20% !important;
        order: 7;
    }
    .host-reports-single > div:nth-child(7) {
        width: 18% !important;
        order: 8;
    }
    .host-reports-single > div:nth-child(8) {
        order: 4;
        margin-bottom: 7px;
    }
    .host-reports-single .fa-chevron-down.drop-arrow {
        display: block;
    }
    .host-reports-single .fa-chevron-up.up-arrow {
        display: none;
    }
    .host-reports-single.active .fa-chevron-down.drop-arrow {
        display: none;
    }
    .host-reports-single.active .fa-chevron-up.drop-arrow {
        display: block;
    }
    .host-reports-single.active {
        max-height: 300px;
        transition: all linear 300ms;
    }
}
</style>

