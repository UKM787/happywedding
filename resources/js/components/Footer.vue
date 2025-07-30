<template>
    <section
        style="
            background-color: #461952;
            padding-bottom: 2em;
            margin-bottom: -2em;
        "
    >
        <div class="footer-lastest container-lg">
            <div>
                <a href="/"
                    ><img
                        style="margin-bottom: 10px"
                        src="/assets/landing_page/logo.svg"
                        alt=""
                /></a>
                <p>
                    The Wedding Work Management System is related to the
                    arrangement and organization of the wedding ceremonies and
                    how this arrangement is managed by family members. The main
                    function of wedding planning is linked with budgeting, site
                    selection, scheduling, arranging decor, catering,
                    facilitating with transportation and parking, event security
                    system, obtaining necessary permits, coordination with third
                    party vendors to settle emergency plans, arrangement of
                    singers or speakers or entertainers for events etc.
                </p>
                <p style="display: none">
                    The Wedding Work Management System is related to the
                    arrangement and organization of the wedding ceremonies and
                    how this arrangement is managed by family members. The main
                    function of wedding planning is linked with budgeting, site
                    selection, scheduling, arranging decor, catering,
                    facilitating with transportation and parking, event security
                    system, obtaining necessary permits, coordination with third
                    party vendors to settle emergency plans, arrangement of
                    singers or speakers or entertainers for events etc.
                </p>
            </div>
            <div class="footer-latest-section2">
                <!-- <ul>
                    <li @click="footerToogle($event)">
                        <a href="/">Services</a>
                    </li>
                    <div>
                        <li><a href="/"> Terms of services </a></li>
                        <li><a href="/">Custom field</a></li>
                        <li><a href="/">Listing</a></li>
                        <li><a href="/">Offline</a></li>
                    </div>
                </ul> -->
                <ul>
                    <li><a href="/">Home</a></li>
                    <div>
                        <li><a href="/about"> About us </a></li>
                        <!-- <li><a href="/"> Our Story </a></li> -->
                        <!-- <li><a href="/careers"> Careers </a></li>
                        <li><a href="/">Team</a></li>
                        <li><a href="/sitemap">Sitemap</a></li> -->
                        <li>
                            <a :href="route('termsandconditions')"
                                >Terms & Conditions</a
                            >
                        </li>
                        <li>
                            <a :href="route('privacypolicy')">Privacy Policy</a>
                        </li>
                    </div>
                </ul>
                <ul>
                    <!-- <li @click="footerToogle($event)">
                        <a href="/help">Help</a>
                    </li> -->
                    <li @click="footerToogle($event)">
                        <a href="/faqs">FAQs</a>
                    </li>
                    <div>
                        <li><a href="/contact-us">Contact Us</a></li>
                    </div>
                </ul>
                <div class="footer-latest-ven">
                    <div class="footer-contact">
                        <div>Follow us</div>
                        <div>
                            <a
                                target="_blank"
                                href="https://www.facebook.com/profile.php?id=100082070712846"
                                ><img
                                    src="/assets/landing_page/facebook.png"
                                    alt=""
                            /></a>
                            <a
                                target="_blank"
                                href="https://twitter.com/_happy_wed?t=RU6EOkiI-22r5sMAkAIBrw&s=09"
                                ><img
                                    src="/assets/landing_page/twitter.png"
                                    alt=""
                            /></a>
                            <a
                                target="_blank"
                                href="https://www.youtube.com/@happy_wed"
                                ><img
                                    src="/assets/landing_page/youtube.png"
                                    alt=""
                            /></a>
                            <a
                                target="_blank"
                                href="https://www.instagram.com/p/Ck_bDGatsA9/?igshid=YmMyMTA2M2Y="
                                ><img
                                    src="/assets/landing_page/insta.png"
                                    alt=""
                            /></a>
                            <a
                                target="_blank"
                                href="https://www.linkedin.com/company/happy-wed/"
                                ><img
                                    src="/assets/landing_page/linkedin.png"
                                    alt=""
                            /></a>
                        </div>
                        <!-- <div><i class="fas fa-phone-alt"></i> - 9840785986</div>
                        <div>
                            <i class="fas fa-envelope"></i> -
                            bhushanbjain@gmail.com
                        </div> -->
                    </div>

                    <div>Are you a vendor?</div>
                    <div>
                        Sign up on with us to reach more couples and book more
                        weddings!
                    </div>
                    <div>
                        <a
                            style="color: inherit; text-decoration: none"
                            :href="route('vendorLogin')"
                            >Start Here
                            <i class="fas fa-long-arrow-alt-right"></i
                        ></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-latest-section3 container-lg">
            <div>Copyright © 2023. Happywed. All rights reserved.</div>
            <div>
                <!-- <a href="/terms-and-conditions" style="margin-right: 4em"
                    >Terms & Conditions</a
                >
                <a href="/privacy-policy">Privacy Policy</a> -->
            </div>
        </div>
    </section>
</template>

<script>
export default {
    methods: {
        // footerToogle(e) {
        //     let cont = e.currentTarget.nextElementSibling;
        //     if (cont.style.maxHeight == "500px") {
        //         cont.style.maxHeight = 0;
        //     } else {
        //         cont.style.maxHeight = "500px";
        //     }
        // },
    },
};
</script>

<style scoped>
.footer-lastest {
    display: flex;
    flex-wrap: wrap;
    padding: 4em 0;
    background-color: #461952;
}
.footer-lastest > div:nth-child(1) {
    width: 35%;
}
.footer-lastest > div:nth-child(2) {
    width: 65%;
}
.footer-lastest > div:nth-child(1) > p:nth-child(1) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 13.3333px;
    line-height: 20px;
    letter-spacing: -0.181818px;
    color: #ffffff;
}
.footer-lastest > div:nth-child(1) > p {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 13.3333px;
    line-height: 20px;
    letter-spacing: -0.181818px;
    color: #ffffff;
    mix-blend-mode: normal;
    opacity: 0.5;
    padding-right: 3em;
    padding-left: 27px;
}
.footer-latest-section2 {
    display: flex;
    justify-content: space-between;
}
.footer-latest-section2 > ul {
    list-style-type: none;
    width: 30%;
}
.footer-latest-section2 > ul li > a {
    text-decoration: none;
    color: inherit;
}
.footer-latest-section2 > ul li {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 13.3333px;
    line-height: 20px;
    letter-spacing: -0.181818px;
    margin-bottom: 10px;
    color: #ffffff;
}
.footer-latest-section2 > ul > li:nth-child(1),
.footer-contact > div:nth-child(1) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 15.1111px;
    line-height: 23px;
    letter-spacing: -0.206061px;
    color: #ffd2dd;
}
.footer-contact > div {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 13.3333px;
    line-height: 20px;
    letter-spacing: -0.181818px;
    margin-bottom: 10px;
    color: #ffffff;
}
.footer-contact > div > a {
    color: #ffffff;
}
.footer-contact > div > a > i {
    color: #ffffff;
    margin-right: 10px;
    font-size: 15px;
}
.footer-latest-ven > div:nth-child(2) {
    margin-top: 1em;
    margin-bottom: 10px;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 700;
    font-size: 19.9051px;
    line-height: 30px;
    letter-spacing: -0.212888px;
    color: #ffd2dd;
}
.footer-latest-ven > div:nth-child(3) {
    margin-bottom: 10px;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 13.3333px;
    line-height: 20px;
    letter-spacing: -0.181818px;
    color: #ffffff;
}
.footer-latest-ven > div:nth-child(4) {
    margin-bottom: 10px;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 13.3333px;
    line-height: 20px;
    letter-spacing: -0.181818px;
    text-decoration-line: underline;
    color: #ffffff;
}
.footer-latest-section3 {
    display: flex;
    justify-content: space-between;
}
.footer-latest-section3 > div:nth-child(1) {
    font-family: "DM Sans", sans-serif;
    font-style: normal;
    font-weight: 400;
    font-size: 13.3333px;
    line-height: 17px;
    letter-spacing: -0.181818px;
    color: #ffffff;
    mix-blend-mode: normal;
    opacity: 0.5;
}
.footer-latest-section3 > div:nth-child(2) {
    display: flex;
    justify-content: space-between;
    font-family: "DM Sans", sans-serif;
    font-style: normal;
    font-weight: 400;
    font-size: 13.3333px;
    line-height: 17px;
    /* identical to box height */

    letter-spacing: -0.181818px;

    color: #ffffff;
}
.footer-latest-section3 > div:nth-child(2) > a {
    text-decoration: none;
    color: inherit;
}
@media only screen and (max-width: 992px) {
    .footer-lastest > div {
        width: 100% !important;
        text-align: center;
    }
    .footer-lastest > div:nth-child(1) {
        margin-bottom: 12px;
    }
}
@media only screen and (max-width: 767px) {
    .footer-lastest > div:nth-child(1) > p:nth-child(2) {
        display: none;
    }
    .footer-lastest > div:nth-child(1) > p:nth-child(3) {
        display: block !important;
    }
    .footer-latest-section2 {
        flex-wrap: wrap;
    }
    .footer-latest-section2 > ul,
    div {
        width: 100%;
        text-align: center;
    }
    .footer-latest-section2 > ul {
        padding-left: 0 !important ;
    }
    /* .footer-latest-section2 > ul > div {
        max-height: 0;
        transition: max-height 1s linear;
        overflow: hidden;
        margin: 0;
    } */
    /* .footer-latest-section2 > ul > li > a {
        pointer-events: none;
    } */
    .footer-latest-section3 {
        flex-wrap: wrap;
        text-align: center;
    }
    .footer-latest-section3 > div {
        width: 100%;
        margin-bottom: 15px;
    }
    .footer-latest-section3 > div:nth-child(2) {
        flex-wrap: wrap;
        text-align: center;
    }
    .footer-latest-section3 > div:nth-child(2) > a {
        display: inline-block;
        width: 100%;
        margin-right: 0 !important;
        margin-bottom: 12px;
    }
}
</style>
