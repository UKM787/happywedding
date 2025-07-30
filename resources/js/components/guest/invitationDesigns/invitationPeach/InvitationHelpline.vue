<template>
    <div class="guest-inv-helpline container-lg">
        <h1 class="guest-invi-heading">Help Line</h1>
        <h6 class="guest-invi-sub-heading">
            If you are facing trouble in services contact to the help line
            provided
        </h6>
        <div class="guest-helpline-all">
            <div
                v-for="(item, index) in helpLine"
                :key="'helpline' + index"
                class="guest-helpline-single"
                @click="toggle($event)"
            >
                <span style="width: 25%">{{ item.contact_for }}</span>
                <span style="width: 25%">{{ item.member.name }}</span>
                <span
                    ><i class="fas fa-chevron-down drop-arrow"></i>
                    <i class="fas fa-chevron-up drop-arrow"></i
                ></span>
                <span style="width: 20%">{{ item.member.mobile }}</span>
                <span style="width: 30%">{{ item.member.email }}</span>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["helpLine"],
    data() {
        return {};
    },
    methods: {
        toggle(e) {
            //console.log(screen.width);
            if (screen.width <= 576) {
                let currEle = e.currentTarget;
                let all = document.getElementsByClassName(
                    "guest-helpline-single"
                );
                if (currEle.classList.contains("active")) {
                    currEle.classList.remove("active");
                    return;
                }
                // console.log(all);
                Array.prototype.forEach.call(all, function (item) {
                    if (item.classList.contains("active")) {
                        item.classList.remove("active");
                    }
                });
                // all.each(function (index, item) {
                //     if (item.classList.contains("active")) {
                //         item.classList.remove("active");
                //     }
                // });

                currEle.classList.add("active");
            }
        },
    },
};
</script>

<style scoped>
.drop-arrow {
    display: none;
    margin-left: 15px;
}
.guest-invi-heading {
    background: #ffffff;
    border-radius: 35.5px;
    margin-bottom: 15px;
    margin-top: -102px;
    padding: 20px 40px;
    width: max-content;
    font-family: "Roboto Serif 72pt SemiExpanded";
    font-style: normal;
    font-weight: 400;
    font-size: 30px;
    line-height: 30px;
    letter-spacing: 0.03em;
    color: #000000;
    text-shadow: 8px 10px 33px #ead1bb;
}
.guest-invi-sub-heading {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 16px;
    line-height: 16px;
    /* identical to box height, or 100% */

    letter-spacing: 0.03em;

    color: #000000;
    margin-bottom: 15px;
    text-align: center;
}
.guest-inv-helpline {
    background: rgba(255, 255, 255, 0.4);
    backdrop-filter: blur(17px);
    border-radius: 18px;
    margin-top: 100px;
    padding: 67px 15px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
.guest-helpline-all {
    width: 90%;
    margin: 10px 0;
}
.guest-helpline-single {
    background: #ffffff;
    border-radius: 87px;
    padding: 22px 23px;
    width: 100%;
    display: flex;
    margin-bottom: 10px;
    align-items: center;
}
.guest-helpline-single > span {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 12px;
    line-height: 16px;
    letter-spacing: 0.03em;
    display: block;
    color: #000000;
    white-space: nowrap;
    text-overflow: ellipsis;
    overflow-x: hidden;
    margin-right: 5px;
}
.guest-helpline-single > span:nth-child(1) {
    font-weight: 500;
    font-size: 16px;
    line-height: 24px;
    color: #c4854c;
}
@media screen and (max-width: 968px) {
    .guest-helpline-all {
        width: 100% !important;
    }
}
@media screen and (max-width: 576px) {
    .guest-helpline-all {
        width: 100% !important;
    }
    .guest-helpline-single .fa-chevron-down.drop-arrow {
        display: block;
    }
    .guest-helpline-single .fa-chevron-up.up-arrow {
        display: none;
    }
    .guest-helpline-single.active .fa-chevron-down.drop-arrow {
        display: none;
    }
    .guest-helpline-single.active .fa-chevron-up.drop-arrow {
        display: block;
    }
    .guest-helpline-single {
        flex-wrap: wrap;
    }
    .guest-helpline-single > span:nth-child(1) {
        width: 40% !important;
    }
    .guest-helpline-single > span:nth-child(2) {
        width: 40% !important;
    }
    .guest-helpline-single > span:nth-child(3) {
        width: max-content !important;
        text-align: right;
        margin-left: auto;
    }
    .guest-helpline-single > span:nth-child(4) {
        width: 100% !important;
        display: none;
    }
    .guest-helpline-single > span:nth-child(5) {
        width: 100% !important;
        display: none;
    }
    .guest-helpline-single.active > span:nth-child(4),
    .guest-helpline-single.active > span:nth-child(5) {
        display: block !important;
        margin-bottom: 5px;
    }
    .guest-helpline-single.active > span:nth-child(1) {
        margin-bottom: 10px;
    }
}
</style>
