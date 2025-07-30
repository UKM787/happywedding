@extends('layouts.host')

@section('styles')
<style>
    /* wedding Single Venues Page Css start */
    html,
    body {
        margin: 0;
        padding: 0;
        width: 100%;
        height: 100%;
        box-sizing: border-box;
    }

    body {
        background-image: url("/assets/background.png");
        background-color: #efdee4ff;
    }

    /* Section-1(image and search) CSS start */
    .wed-ven-main {
        position: relative;
        margin-bottom: 2em;
    }

    .wed-ven-main img {
        width: 100%;
    }

    .wed-ven-main>div:nth-child(2) {
        position: absolute;
        top: 50%;
    }

    .wed-ven-main-search {
        display: flex;
        flex-direction: column;
        width: 100%;
    }

    .wed-ven-main-search>p:nth-child(1) {
        font-family: Rage Italic;
        font-style: italic;
        font-weight: normal;
        font-size: 18.1818px;
        line-height: 23px;
        color: #ffffff;
        text-align: center;
    }

    .wed-ven-main-search>p:nth-child(2) {
        font-family: Segoe UI;
        font-style: normal;
        font-weight: normal;
        font-size: 21.8182px;
        line-height: 29px;
        color: #ffffff;
        text-align: center;
        margin-bottom: 2em;
    }

    .wed-ven-main-search>div {
        background: rgba(255, 255, 255, 0.5);
        padding: 28px 23px;
        width: 58%;
        margin: auto;
    }

    .wed-ven-main-search>div>form>select {
        padding: 11px 0;
        padding-left: 22px;
        border: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        background: #ffffff;
        border-radius: 5px;
        background-image: url("/assets/single-venue-page/twemoji_flag-for-flag-india.svg"),
            url("/assets/single-venue-page/dropdown.svg");
        background-repeat: no-repeat, no-repeat;
        background-position: 2%, 98%;
        background-size: 20px, 20px;
        width: 25%;
        border: none;
    }

    .wed-ven-main-search>div>form>select>option {
        font-family: Segoe UI;
        font-style: normal;
        font-weight: normal;
        font-size: 10px;
        line-height: 13px;
        color: #3d3838;
    }

    #search {
        width: 55%;
    }

    #search>input {
        width: 100%;
        padding: 11px;
        background-color: #ffffff;
        border-radius: 5px;
        border: none;
        background-image: url("/assets/single-venue-page/Group.svg");
        background-repeat: no-repeat;
        background-position: 1.5% 49%;
        background-size: 20px;
        padding-left: 40px;
    }

    #search>input::placeholder {
        font-family: Segoe UI;
        font-style: normal;
        font-weight: normal;
        font-size: 10px;
        line-height: 13px;
        color: rgba(0, 0, 0, 0.3);
    }

    .wed-ven-main-search>div>form>button {
        border: none;
        outline: 0;
        padding: 13px 35px;
        background: #461952;
        box-shadow: 0px 0px 4px 3px rgba(0, 0, 0, 0.25);
        border-radius: 5px;
        font-family: Segoe UI;
        font-style: normal;
        font-weight: normal;
        font-size: 10px;
        line-height: 13px;
        color: #ffffff;
    }

    /* Section-1(image and search) CSS end */
    /* wedding Venues Page Css start */

    /* Section-1(search) CSS start */
    .wed-venue-main {
        display: flex;
    }

    .wed-venue-main>div:nth-child(2) {
        width: 30%;
    }

    .wed-venue-search {
        padding: 20px 0 45px 25px;
        width: 70%;
        border-bottom: 1px solid #e1cfd6;
        transform: rotate(-0.03deg);
        position: relative;
    }

    .wed-venue-search>div:nth-child(1) {
        font-family: Segoe UI;
        font-style: normal;
        font-weight: normal;
        font-size: 13.6563px;
        line-height: 18px;
        color: #929090;
    }

    .wed-venue-search>div:nth-child(2) {
        font-family: Perpetua;
        font-style: normal;
        font-weight: bold;
        font-size: 25.7763px;
        line-height: 30px;
        color: #461952;
        padding: 10px 0;
    }

    .wed-venue-search .wed-ven-main-search>div {
        margin: 0;
        width: 100%;
    }

    /* Section-1(search) CSS end */

    /* section-2 (contacts) CSS starts */

    .btn-nostyle {
        outline: none;
        border: 0;
        background-color: inherit;
    }

    .wed-venue-contact {
        display: grid;
        grid-template-columns: minmax(500px, 70%) minmax(300px, 30%);
        justify-content: center;
    }

    .wed-venue-contact-info {
        position: relative;
        padding: 3em;
    }

    .wed-venue-contact-info>div {
        position: relative;
        width: fit-content;
        margin: auto;
    }

    .wed-venue-contact-info>div>div:nth-child(1) {
        z-index: 9999;
        display: flex;
        position: absolute;
        padding: 15px 25px;
    }

    .wed-venue-contact-info>div>div>a {
        font-size: 0;
        padding: 5px;
        width: max-content;
        height: max-content;
        display: block;
    }

    .wed-venue-contact-info-desc {
        background: #ffffff;
        border: 0.393044px solid #241010;
        box-sizing: border-box;
        border-radius: 17.3516px;
        padding: 20px 32px 28px;
        width: 100%;
        position: absolute;
        bottom: 0;
    }

    .wed-venue-contact-info-desc>div:nth-child(1) {
        font-family: Segoe UI;
        font-style: normal;
        font-weight: 300;
        font-size: 15.7207px;
        line-height: 21px;
        color: #7c7c7c;
    }

    .wed-venue-contact-info-desc>div:nth-child(1)>a {
        text-decoration: none;
        color: #7c7c7c;
    }

    .wed-venue-contact-info-desc>div:nth-child(2) {
        display: flex;
        justify-content: space-between;
        font-family: Segoe UI;
        font-style: normal;
        font-weight: normal;
        font-size: 26.7661px;
        line-height: 40px;
        color: #000000;
    }

    .wed-venue-contact-info-details {
        padding-top: 3em;
    }

    .wed-venue-contact-info-details>div:nth-child(1)>div:nth-child(1) {
        font-family: Segoe UI;
        font-style: normal;
        font-weight: 350;
        font-size: 20.1122px;
        line-height: 27px;
        color: #364667;
    }

    .wed-venue-contact-info-details>div:nth-child(1)>div:nth-child(2) {
        font-family: Segoe UI;
        font-style: normal;
        font-weight: 600;
        font-size: 28.7664px;
        line-height: 38px;
        color: #461952;
    }

    .wed-venue-contact-info-details>div:nth-child(2) {
        display: flex;
        flex-direction: column;
        margin-top: 1.5em;
    }

    .wed-venue-contact-info-details>div:nth-child(2)>button {
        outline: none;
        border: 0;
        background-color: inherit;
        background: #c4456f;
        border-radius: 50px;
        font-family: Segoe UI;
        font-style: normal;
        font-weight: 600;
        font-size: 19.0751px;
        line-height: 25px;
        color: #ffffff;
        display: flex;
        padding: 10px;
        width: 278px;
        margin-bottom: 0.9em;
    }

    .wed-venue-contact-info-details>div:nth-child(2)>button>img {
        padding: 1px 20px;
    }

    .wed-venue-contact-info-details>div:nth-child(2)>button:nth-child(2) {
        outline: none;
        border: 0;
        background-color: inherit;
        background: #2fa706;
        border-radius: 50px;
    }

    .wed-venue-contact-info-details>div:nth-child(2)>div {
        display: flex;
    }

    .wed-venue-contact-info-details>div:nth-child(2)>div>button {
        background: #461952;
        border-radius: 5.33146px;
        outline: none;
        border: 0;
        font-family: Roboto;
        font-style: normal;
        font-weight: 500;
        font-size: 15.9944px;
        line-height: 19px;
        display: flex;
        align-items: center;
        text-align: center;
        color: #ffffff;
        padding: 10px 48px;
    }

    .wed-venue-contact-info-details>div:nth-child(2)>div>button:nth-child(2) {
        background: #ffffff;
        color: black;
        margin-left: 5px;
    }

    /* section-2 (contacts) CSS starts */

    /* section-3 (portfolio) CSS starts */

    .wed-venue-port {
        background-image: url("/assets/single-venue-page/Rectangle\ 148.png");
        background-color: white;
        background-repeat: no-repeat;
        background-size: contain;
        padding: 2em 0;
    }

    .wed-venue-port-head {
        font-family: Segoe UI;
        font-style: normal;
        font-weight: normal;
        font-size: 16.1994px;
        line-height: 22px;
        color: #6f747d;
        display: flex;
        width: 30%;
        margin: auto;
        justify-content: space-between;
        padding: 3em 0;
    }

    .wed-venue-port-head-active {
        padding-bottom: 4px;
        font-family: Segoe UI;
        font-style: normal;
        font-weight: 600;
        font-size: 16.1994px;
        line-height: 22px;
        color: #ffffff;
        border-bottom: 2px solid white;
    }

    .wed-venue-port-items {
        background-color: #ffffff;
        width: 70%;
        margin: auto;
        padding: 19px 23px;
    }

    .wed-venue-port-items>div {
        display: grid;
        grid-template-columns: repeat(3, minmax(100px, 500px));
        grid-row-gap: 25px;
        grid-column-gap: 25px;
        overflow: hidden;
        /* opacity: 1;
            height: 100%;
            transition: height 0s ,opacity 0.5s linear; */
        visibility: visible;
        opacity: 1;
        transition: all 0.5s linear;
    }

    .wed-venue-port-items>div>img {
        width: 100%;
    }

    .wed-venue-port-all {
        outline: none;
        background-color: inherit;
        border: 1.5px solid #c4456f;
        width: max-content;
        display: block;
        margin: 2em auto;
        border-radius: 50px;
        padding: 5px 32px;
    }

    .jsTabHide {
        /* height: 0 !important;
            opacity: 0 !important;
            display: none !important; */
        visibility: hidden !important;
        opacity: 0 !important;
        max-height: 0 !important;
    }

    /* section-3 (portfolio) CSS end */

    /* section-4 (products) CSS starts */

    .wed-venue-prod {
        padding: 3em;
    }

    .wed-venue-prod>div:nth-child(1) {
        font-family: Segoe UI;
        font-style: normal;
        font-weight: 600;
        font-size: 22.8326px;
        line-height: 30px;
        color: #c4456f;
        width: max-content;
        margin: auto;
        margin-bottom: 3em;
    }

    .wed-venue-prod-items {
        width: 85%;
        margin: auto;
    }

    .wed-venue-prod-items>div {
        display: grid;
        grid-template-columns: repeat(3, minmax(200px, 500px));
        grid-template-rows: auto;
        grid-column-gap: 1.5em;
    }

    .wed-venue-prod-desc {
        margin: 1em 0;
    }

    .wed-venue-prod-desc>div:nth-child(1) {
        font-family: Segoe UI;
        font-style: normal;
        font-weight: normal;
        font-size: 22.8326px;
        line-height: 30px;
        color: #6b6b6b;
        text-align: center;
    }

    .wed-venue-prod-desc>div:nth-child(2) {
        font-family: Segoe UI;
        font-style: normal;
        font-weight: 600;
        font-size: 25.0579px;
        line-height: 33px;
        color: #000000;
        text-align: center;
    }

    .wed-venue-prod-desc>div:nth-child(3) {
        font-family: Segoe UI;
        font-style: normal;
        font-weight: normal;
        font-size: 15.2218px;
        line-height: 20px;
        color: #000000;
        text-align: center;
    }

    .wed-venue-prod-desc>div:nth-child(4) {
        font-family: Segoe UI;
        font-style: normal;
        font-weight: 600;
        font-size: 32.6042px;
        line-height: 43px;
        color: #c4456f;
        text-align: center;
    }

    /* section-4 (products) CSS end */

    /* section-5 (about) CSS starts */

    .wed-venue-about {
        width: 90%;
        margin: auto;
        margin-bottom: 3em;
    }

    .wed-venue-about>div {
        margin-bottom: 1.5em;
    }

    .wed-venue-about h2 {
        font-family: Sansation;
        font-style: normal;
        font-weight: normal;
        font-size: 28.8454px;
        line-height: 32px;
        color: #c4456f;
    }

    .wed-venue-about div>div {
        font-family: Roboto;
        font-style: normal;
        font-size: 20.681px;
        line-height: 24px;
        align-items: center;
        color: #6b6b6b;
    }

    /* section-5 (about) CSS end */

    /* section-6 (testimonials) CSS start */
    .wed-venue-splide {
        margin-left: 3em;
    }

    .wed-venue-splide>div:nth-child(1) {
        font-family: Roboto;
        font-style: normal;
        font-weight: bold;
        font-size: 24px;
        line-height: 26px;
        color: #c4456f;
    }

    .wed-venue-splide>div:nth-child(2) {
        font-family: Roboto;
        font-style: normal;
        font-weight: normal;
        font-size: 16px;
        line-height: 20px;
        color: #364667;
    }

    .wed-venue-splide>div:nth-child(3) {
        margin-top: 2em;
        padding-bottom: 2.5em;
        margin-bottom: 4em;
    }

    .wed-venue-testi {
        display: flex;
        flex-direction: column;
        padding: 1.5em;
        background-color: #ffffff;
        width: 255px;
    }

    .wed-venue-testi>div:nth-child(2) {
        font-family: Roboto;
        font-style: normal;
        font-weight: 500;
        font-size: 18px;
        line-height: 26px;
        color: #000000;
        margin-bottom: 0.3em;
    }

    .wed-venue-testi>div:nth-child(3)>img {
        margin: 2px;
        background: #c4456f;
    }

    .wed-venue-testi>div:nth-child(3)>span {
        font-family: Roboto;
        font-style: normal;
        font-weight: 300;
        font-size: 12px;
        line-height: 26px;
        color: #000000;
        padding-left: 5px;
    }

    .wed-venue-testi>div:nth-child(4) {
        font-family: Roboto;
        font-style: normal;
        font-weight: 300;
        font-size: 14px;
        line-height: 22px;
        color: #000000;
    }

    .wed-venue-testi>div:nth-child(5) {
        font-family: Roboto;
        font-style: normal;
        font-weight: bold;
        font-size: 14px;
        line-height: 22px;
        color: #000000;
    }

    /* section-6 (testimonials) CSS end */

    /* section-6 (rating) CSS start */

    .wed-venue-rating {
        width: 90%;
        margin: auto;
        display: grid;
        grid-template-columns: minmax(300px, 500px) minmax(350px, 700px);
        grid-column-gap: 7em;
        justify-content: space-between;
    }

    .rating-distribution>div {
        display: flex;
        justify-content: space-between;
    }

    .rating-distribution>div:nth-child(1)>div:nth-child(1) {
        font-family: Roboto;
        font-style: normal;
        font-weight: bold;
        font-size: 24px;
        line-height: 28px;
        color: #c4456f;
    }

    .rating-distribution>div:nth-child(1)>div:nth-child(2) {
        background: #2fa706;
        border-radius: 2.10938px;
        font-family: Roboto;
        font-style: normal;
        font-weight: 500;
        font-size: 18.683px;
        line-height: 22px;
        color: #ffffff;
        padding: 5px 7px;
    }

    .rating-distribution>div:nth-child(2) {
        margin-top: 1.5em;
        display: flex;
        flex-direction: column;
    }

    .rating-bar-box {
        display: flex;
        margin-bottom: 2.1em;
    }

    .rating-bar-box>div:nth-child(1) {
        font-family: Roboto;
        font-style: normal;
        font-weight: 500;
        font-size: 18.683px;
        line-height: 22px;
        color: #868686;
        align-self: center;
        width: 2em;
    }

    .rating-bar-box>div:nth-child(2) {
        background: linear-gradient(0deg, #ffffff, #ffffff),
            linear-gradient(0deg, #ffffff, #ffffff), #ffffff;
        border-radius: 100px;
        margin: auto 1em;
        height: 1em;
        width: 75%;
    }

    .rating-bar-box>div:nth-child(3) {
        font-family: Roboto;
        font-style: normal;
        font-weight: 500;
        font-size: 11.412px;
        line-height: 13px;
        color: #868686;
        align-self: center;
        width: 5em;
    }

    .rating-percent {
        width: 70%;
        background-color: #2fa706;
        border-radius: 100px;
        height: 100%;
    }

    .form-rating {
        position: relative;
    }

    .rate {
        display: none;
    }

    .custom-rate {
        color: #fed21e;
        font-size: 30px;
    }

    .rating-form {
        display: flex;
        flex-direction: column;
        position: relative;
    }

    .rating-form label {
        font-family: Roboto;
        font-style: normal;
        font-weight: 500;
        font-size: 20.4931px;
        line-height: 24px;
        color: #000000;
        padding: 0.7em 0;
    }

    .rating-form input {
        outline: none;
        background-color: inherit;
        border: none;
        border-bottom: 1.62771px solid #b5b5b5;
        padding-right: 4em;
    }

    .rating-form input::placeholder {
        font-family: Roboto;
        font-style: normal;
        font-weight: 500;
        font-size: 12.4666px;
        line-height: 15px;
        color: #b5b5b5;
    }

    .rating-form>span {
        position: absolute;
        bottom: 0;
        right: 0;
        padding: 0 10px 5px 0;
        font-family: Roboto;
        font-style: normal;
        font-weight: 500;
        font-size: 12.4666px;
        line-height: 15px;
        color: #b5b5b5;
    }

    .wed-venue-rating form>button {
        font-family: Roboto;
        font-style: normal;
        font-weight: 500;
        font-size: 13.6996px;
        line-height: 16px;
        color: #ffffff;
        background: #c4456f;
        border: 1.15196px solid #c4456f;
        border-radius: 38.3986px;
        padding: 0.7em 2.5em;
        margin-top: 3em;
    }

    /* section-6 (rating) CSS start */

    @media only screen and (max-width: 992px) {
        .wed-venue-contact-info-desc>div:nth-child(2) {
            font-size: 23px !important;
        }

        .wed-venue-port {
            background-size: 200%;
        }

        .wed-venue-prod {
            padding: 3em 2em;
        }

        .wed-venue-prod-items {
            width: 90%;
        }

        .wed-venue-rating {
            grid-column-gap: 4em;
        }
    }

    @media only screen and (max-width: 768px) {
        #main-foot {
            display: none !important;
        }

        #mobile-foot {
            display: block !important;
        }

        .wed-venue-sidebar {
            display: none;
        }

        .wed-venue-content {
            display: block;
        }

        #sidebar-open {
            display: inline-block;
        }

        .wed-venue-contact {
            display: block;
        }

        .wed-venue-contact-info {
            padding: 0;
            margin: 2em 1.5em;
        }

        .wed-venue-contact-info-desc {
            padding: 1em;
        }

        .wed-venue-contact-info-details {
            width: max-content;
            margin: auto;
            padding-top: 0;
            margin-bottom: 3em;
        }

        .wed-venue-port-head {
            width: 70%;
        }

        .wed-venue-prod-items>div {
            /* grid-template-columns: minmax(120px , 500px) minmax(120px , 500px); */
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .wed-venue-prod-items>div>div {
            flex: 150px 1 1;
            max-width: 250px;
        }

        .wed-venue-rating {
            display: block;
            width: 70%;
            margin: auto;
        }
    }

    @media only screen and (max-width: 576px) {
        .wed-venue-contact-info-desc>div:nth-child(2) {
            font-size: 15px !important;
        }

        .wed-venue-port-items>div {
            grid-template-columns: repeat(2, minmax(100px, 500px));
        }

        .wed-venue-port-items {
            width: 80%;
        }

        .wed-venue-rating {
            display: block;
            width: 90%;
            margin: auto;
        }
    }

    /* footer css starts */
    footer {
        margin-top: 3em;
        background: #000;
        color: #fff;
        /* padding: 140px 0 80px; */
        font-size: 15px;
        line-height: 20px;
    }

    footer a {
        color: #fff;
        text-decoration: none;
        font-size: 15px;
        line-height: 20px;
    }

    .wed-host-footer {
        width: 70%;
        display: flex;
        flex-direction: column;
        padding: 4em 0;
        margin: auto;
    }

    .wed-host-footer>div {
        display: flex;
    }

    .wed-host-footer-sec-1 {
        width: 30%;
    }

    .wed-host-footer-sec-2 {
        width: 70%;
        display: flex;
        justify-content: space-around;
    }

    .wed-host-footer-sec-2>div {
        flex: 1;
    }

    .wed-host-footer-sec-1>img {
        width: 103px;
        height: 41px;
        margin-bottom: 1em;
    }

    .wed-host-footer-sec-1>div {
        font-family: DM Sans;
        font-style: normal;
        font-weight: normal;
        font-size: 13.3333px;
        line-height: 17px;
        letter-spacing: -0.181818px;
        color: #ffffff;
    }

    .wed-host-footer-sec-2>div {
        display: flex;
        flex-direction: column;
        padding-left: 3.8em;
    }

    .wed-host-footer-sec-2>div>h5 {
        font-family: DM Sans;
        font-style: normal;
        font-weight: normal;
        font-size: 15.1111px;
        line-height: 20px;
        letter-spacing: -0.206061px;
        color: #ffd2dd;
        margin-bottom: 1.2em;
    }

    .wed-host-footer-sec-2>div>a {
        font-family: DM Sans;
        font-style: normal;
        font-weight: normal;
        font-size: 13.3333px;
        line-height: 17px;
        letter-spacing: -0.181818px;
        color: #ffffff;
        margin-bottom: 1em;
        text-decoration: none;
    }

    .wed-host-footer-sec-3 {
        margin-top: 4em;
        display: flex;
        justify-content: space-between;
        color: #ffffff;
        font-size: 15px;
        line-height: 20px;
    }

    .wed-host-footer-sec-3>div:nth-child(2) {
        display: flex;
    }

    /* host footer css star */
    .foot-drop {
        padding-bottom: 1.5em;
        display: flex;
        justify-content: space-between;
        cursor: pointer;
    }

    .mobile-foot-heading {
        font-family: Segoe UI;
        font-style: normal;
        font-weight: normal;
        font-size: 12px;
        line-height: 16px;
        /* identical to box height */
        color: #ffffff;
    }

    .mobile-foot1 {
        margin: 28px auto 7px auto;
        display: none;
        align-items: center;
        flex-direction: column;
    }

    .show-mobile-foot {
        display: flex;
    }

    .mobile-foot1>div {
        padding-bottom: 16px;
    }

    .mobile-foot1>div>a {
        font-family: DM Sans;
        font-style: normal;
        font-weight: 500;
        font-size: 12.3175px;
        line-height: 16px;
        /* identical to box height */

        letter-spacing: -0.167965px;

        color: #ffffff;
    }

    .mobile-foot2 {
        font-family: DM Sans;
        font-style: normal;
        font-weight: normal;
        font-size: 15px;
        line-height: 20px;
        text-align: center;
        letter-spacing: -0.487197px;
        color: #ffffff;
        margin: 14px auto 55px auto;
    }

    /* host footer css end */
</style>
@endsection

@section('content')

@if($venue != null)
<div class="wed-host-section">
    <div class="wed-host-section-container">

        <section class="wed-venue-main">
            <div class="wed-venue-search">
                <div>Vendors / Wedding venues / Chennai</div>
                <div>Wedding Venues In Chennai</div>
                <div class="wed-ven-main-search">
                    <div>
                        <form action="" style="display: flex; justify-content: space-between">
                            <select id="states" name="states">
                                <option hidden disabled selected value></option>
                                <option>Option 1</option>
                                <option>Option 2</option>
                                <option>Option 3</option>
                            </select>

                            <div id="search">
                                <input type="text" placeholder="Wedding venues, wedding photographers, makeup artists, Mehendi artists......" />
                            </div>
                            <button type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </div>

                <img src="/assets/single-venue-page/Rectangle 149.png" alt="" style="width: 100%; height: 100%" />
            </div>
        </section>

        <section class="wed-venue-contact">
            <div class="wed-venue-contact-info">
                <div>
                    <div>
                        <a href="">
                            <img src="/assets/single-venue-page/facebook.svg" alt="" />
                        </a>
                        <a href="">
                            <img src="/assets/single-venue-page/instagram.svg" alt="" />
                        </a>
                        <a href="">
                            <img src="/assets/single-venue-page/snapchat.svg" alt="" />
                        </a>
                        <a href="">
                            <img src="/assets/single-venue-page/twitter.svg" alt="" />
                        </a>
                    </div>
                    <img src="/assets/single-venue-page/Rectangle 126.png" alt="" width="100%" />
                    <div class="wed-venue-contact-info-desc">
                        <div>{{$venue->address}}<a href="">( view on map)</a></div>
                        <div>
                            <div>{{$venue->name}}</div>
                            <div>
                                <button class="btn-nostyle">
                                    <i class="fas fa-share-alt"></i>
                                </button>
                                <button class="btn-nostyle">
                                    <i class="far fa-heart"></i>
                                </button>
                                <button class="btn-nostyle">
                                    <i class="far fa-bookmark"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="wed-venue-contact-info-details">
                <div>
                    <div>Starting price</div>
                    <div>60,000 - 1,00,000</div>
                </div>
                <div>
                    <button>
                        <img src="/assets/single-venue-page/ic_outline-message.svg" alt="" />
                        Send message
                    </button>
                    <button>
                        <img src="/assets/single-venue-page/carbon_phone-filled.svg" alt="" />
                        View contact
                    </button>
                    <div>
                        <button>Follow</button>
                        <button>Email</button>
                    </div>
                </div>
            </div>
        </section>

        <section class="wed-venue-port">
            <div class="jsNav wed-venue-port-head">
                <div class="wed-venue-port-head-active">Portfolio(12)</div>
                <div>Albums</div>
                <div>Videos</div>
            </div>
            <div class="jsTab wed-venue-port-items">
                <div>
                    <img src="/assets/single-venue-page/Frame 889.png" alt="" />
                    <img src="/assets/single-venue-page/Frame 890.png" alt="" />
                    <img src="/assets/single-venue-page/Frame 891.png" alt="" />
                    <img src="/assets/single-venue-page/Frame 892.png" alt="" />
                    <img src="/assets/single-venue-page/Frame 893.png" alt="" />
                    <img src="/assets/single-venue-page/Frame 894.png" alt="" />
                </div>
                <div class="jsTabHide">
                    <img src="/assets/single-venue-page/Frame 893.png" alt="" />
                    <img src="/assets/single-venue-page/Frame 894.png" alt="" />
                    <img src="/assets/single-venue-page/Frame 895.png" alt="" />
                    <img src="/assets/single-venue-page/Frame 896.png" alt="" />
                    <img src="/assets/single-venue-page/Frame 897.png" alt="" />
                    <img src="/assets/single-venue-page/Frame 898.png" alt="" />
                </div>
                <div class="jsTabHide">
                    <img src="/assets/single-venue-page/Frame 897.png" alt="" />
                    <img src="/assets/single-venue-page/Frame 898.png" alt="" />
                    <img src="/assets/single-venue-page/Frame 891.png" alt="" />
                    <img src="/assets/single-venue-page/Frame 890.png" alt="" />
                    <img src="/assets/single-venue-page/Frame 891.png" alt="" />
                </div>
            </div>
            <button class="wed-venue-port-all">View all</button>
        </section>

        <section class="wed-venue-prod">
            <div>Products</div>
            <div class="wed-venue-prod-items">
                <div>
                    <div>
                        <img src="/assets/single-venue-page/Framerec1.png" alt="" width="100%" />
                        <div class="wed-venue-prod-desc">
                            <div>Floral design card</div>
                            <div>Infinite memories & co</div>
                            <div><i class="fas fa-map-marker-alt"></i>Chennai</div>
                            <div>₹1,20,000</div>
                        </div>
                    </div>
                    <div>
                        <img src="/assets/single-venue-page/Framerec2.png" alt="" width="100%" />
                        <div class="wed-venue-prod-desc">
                            <div>Floral design card</div>
                            <div>Infinite memories & co</div>
                            <div><i class="fas fa-map-marker-alt"></i>Chennai</div>
                            <div>₹1,20,000</div>
                        </div>
                    </div>
                    <div>
                        <img src="/assets/single-venue-page/Framerec3.png" alt="" width="100%" />
                        <div class="wed-venue-prod-desc">
                            <div>Floral design card</div>
                            <div>Infinite memories & co</div>
                            <div><i class="fas fa-map-marker-alt"></i>Chennai</div>
                            <div>₹1,20,000</div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="wed-venue-port-all">View all</button>
        </section>

        <section class="wed-venue-about">
            <div>
                <h2>
                    About Infinite memories & co - Invitation cards, Egmore - Chennai 600
                    118
                </h2>
                <div>
                    Studio F3 is a group of experienced and specialized photographers who
                    are extremely passionate about photography and cinematography. They
                    cover the entire event using advanced devices. Their team always gives
                    importance to quality so that their clients can always remember their
                    brand for all their special occasions! The team is led
                    enthusiastically by Mr. Balaji, who is an ardent photographer himself.
                    They have over a decade of experience, having started their studio in
                    2007 and their work speaks tons about their expertise. They provide
                    over 300 processed pictures to cherish your memories for a lifetime.
                    They’ve been rewarded with an award ‘Best Editor Award Pradhana Vizha
                    2014’ from Mediacorp, Singapore.
                </div>
            </div>
            <div>
                <h2>Services offered</h2>
                <div>
                    Studio F3 captures stunning photos having a perfect blend of colors,
                    hues and tones. They have a team of professionals who’re experts in
                    various Design types. They offer a wide range of services to capture
                    every single ceremony of your Wedding frame by frame.
                </div>
            </div>
            <div>
                <h2>Services :</h2>
                <div>
                    <div>Candid Photography</div>
                    <div>Wedding Films</div>
                    <div>Traditional Photography</div>
                    <div>Traditional Videography</div>
                    <div>Pre Wedding Shoots</div>
                    <div>Pre Wedding Films</div>
                </div>
            </div>
            <div>
                <h2>Destination Wedding</h2>
                <div>
                    At Greetings Island, we see ourselves taking part in all our user's
                    life milestones: from baby showers to retirement parties, we are
                    always there with the perfect card or invitation. <br /><br />

                    We also understand how important personal touch is;<br /><br />

                    that is why we offer our users online design tools that allow them to
                    customize and create beautiful invitations & greeting cards.
                </div>
            </div>
        </section>

        <section class="wed-venue-splide">
            <div>What customers say about us</div>
            <div>We do our best to provide you the best experience ever</div>

            <div class="splide testimonials">
                <div class="splide__track">
                    <ul class="splide__list">
                        <li class="splide__slide">
                            <div class="wed-venue-testi">
                                <div>
                                    <img src="/assets/single-venue-page/oi_double-quote-serif-left.svg" alt="" />
                                </div>
                                <div>Best on the market</div>
                                <div>
                                    <img src="/assets/single-venue-page/Shape.svg" alt="" /><img src="/assets/single-venue-page/Shape.svg" alt="" /><img src="/assets/single-venue-page/Shape.svg" alt="" /><img src="/assets/single-venue-page/Shape.svg" alt="" /><img src="/assets/single-venue-page/Shape.svg" alt="" />
                                    <span>2 days ago</span>
                                </div>
                                <div>
                                    I love this product because the support is great. Please ...
                                </div>
                                <hr style="background-color: #c4c4c4; width: 50px" />
                                <div>Viddhant</div>
                            </div>
                        </li>
                        <li class="splide__slide">
                            <div class="wed-venue-testi">
                                <div>
                                    <img src="/assets/single-venue-page/oi_double-quote-serif-left.svg" alt="" />
                                </div>
                                <div>Best on the market</div>
                                <div>
                                    <img src="/assets/single-venue-page/Shape.svg" alt="" /><img src="/assets/single-venue-page/Shape.svg" alt="" /><img src="/assets/single-venue-page/Shape.svg" alt="" /><img src="/assets/single-venue-page/Shape.svg" alt="" /><img src="/assets/single-venue-page/Shape.svg" alt="" />
                                    <span>2 days ago</span>
                                </div>
                                <div>
                                    I love this product because the support is great. Please ...
                                </div>
                                <hr style="background-color: #c4c4c4; width: 50px" />
                                <div>Viddhant</div>
                            </div>
                        </li>
                        <li class="splide__slide">
                            <div class="wed-venue-testi">
                                <div>
                                    <img src="/assets/single-venue-page/oi_double-quote-serif-left.svg" alt="" />
                                </div>
                                <div>Best on the market</div>
                                <div>
                                    <img src="/assets/single-venue-page/Shape.svg" alt="" /><img src="/assets/single-venue-page/Shape.svg" alt="" /><img src="/assets/single-venue-page/Shape.svg" alt="" /><img src="/assets/single-venue-page/Shape.svg" alt="" /><img src="/assets/single-venue-page/Shape.svg" alt="" />
                                    <span>2 days ago</span>
                                </div>
                                <div>
                                    I love this product because the support is great. Please ...
                                </div>
                                <hr style="background-color: #c4c4c4; width: 50px" />
                                <div>Viddhant</div>
                            </div>
                        </li>
                        <li class="splide__slide">
                            <div class="wed-venue-testi">
                                <div>
                                    <img src="/assets/single-venue-page/oi_double-quote-serif-left.svg" alt="" />
                                </div>
                                <div>Best on the market</div>
                                <div>
                                    <img src="/assets/single-venue-page/Shape.svg" alt="" /><img src="/assets/single-venue-page/Shape.svg" alt="" /><img src="/assets/single-venue-page/Shape.svg" alt="" /><img src="/assets/single-venue-page/Shape.svg" alt="" /><img src="/assets/single-venue-page/Shape.svg" alt="" />
                                    <span>2 days ago</span>
                                </div>
                                <div>
                                    I love this product because the support is great. Please ...
                                </div>
                                <hr style="background-color: #c4c4c4; width: 50px" />
                                <div>Viddhant</div>
                            </div>
                        </li>
                        <li class="splide__slide">
                            <div class="wed-venue-testi">
                                <div>
                                    <img src="/assets/single-venue-page/oi_double-quote-serif-left.svg" alt="" />
                                </div>
                                <div>Best on the market</div>
                                <div>
                                    <img src="/assets/single-venue-page/Shape.svg" alt="" /><img src="/assets/single-venue-page/Shape.svg" alt="" /><img src="/assets/single-venue-page/Shape.svg" alt="" /><img src="/assets/single-venue-page/Shape.svg" alt="" /><img src="/assets/single-venue-page/Shape.svg" alt="" />
                                    <span>2 days ago</span>
                                </div>
                                <div>
                                    I love this product because the support is great. Please ...
                                </div>
                                <hr style="background-color: #c4c4c4; width: 50px" />
                                <div>Viddhant</div>
                            </div>
                        </li>
                        <li class="splide__slide">
                            <div class="wed-venue-testi">
                                <div>
                                    <img src="/assets/single-venue-page/oi_double-quote-serif-left.svg" alt="" />
                                </div>
                                <div>Best on the market</div>
                                <div>
                                    <img src="/assets/single-venue-page/Shape.svg" alt="" /><img src="/assets/single-venue-page/Shape.svg" alt="" /><img src="/assets/single-venue-page/Shape.svg" alt="" /><img src="/assets/single-venue-page/Shape.svg" alt="" /><img src="/assets/single-venue-page/Shape.svg" alt="" />
                                    <span>2 days ago</span>
                                </div>
                                <div>
                                    I love this product because the support is great. Please ...
                                </div>
                                <hr style="background-color: #c4c4c4; width: 50px" />
                                <div>Viddhant</div>
                            </div>
                        </li>
                        <li class="splide__slide">
                            <div class="wed-venue-testi">
                                <div>
                                    <img src="/assets/single-venue-page/oi_double-quote-serif-left.svg" alt="" />
                                </div>
                                <div>Best on the market</div>
                                <div>
                                    <img src="/assets/single-venue-page/Shape.svg" alt="" /><img src="/assets/single-venue-page/Shape.svg" alt="" /><img src="/assets/single-venue-page/Shape.svg" alt="" /><img src="/assets/single-venue-page/Shape.svg" alt="" /><img src="/assets/single-venue-page/Shape.svg" alt="" />
                                    <span>2 days ago</span>
                                </div>
                                <div>
                                    I love this product because the support is great. Please ...
                                </div>
                                <hr style="background-color: #c4c4c4; width: 50px" />
                                <div>Viddhant</div>
                            </div>
                        </li>
                        <li class="splide__slide">
                            <div class="wed-venue-testi">
                                <div>
                                    <img src="/assets/single-venue-page/oi_double-quote-serif-left.svg" alt="" />
                                </div>
                                <div>Best on the market</div>
                                <div>
                                    <img src="/assets/single-venue-page/Shape.svg" alt="" /><img src="/assets/single-venue-page/Shape.svg" alt="" /><img src="/assets/single-venue-page/Shape.svg" alt="" /><img src="/assets/single-venue-page/Shape.svg" alt="" /><img src="/assets/single-venue-page/Shape.svg" alt="" />
                                    <span>2 days ago</span>
                                </div>
                                <div>
                                    I love this product because the support is great. Please ...
                                </div>
                                <hr style="background-color: #c4c4c4; width: 50px" />
                                <div>Viddhant</div>
                            </div>
                        </li>
                        <li class="splide__slide">
                            <div class="wed-venue-testi">
                                <div>
                                    <img src="/assets/single-venue-page/oi_double-quote-serif-left.svg" alt="" />
                                </div>
                                <div>Best on the market</div>
                                <div>
                                    <img src="/assets/single-venue-page/Shape.svg" alt="" /><img src="/assets/single-venue-page/Shape.svg" alt="" /><img src="/assets/single-venue-page/Shape.svg" alt="" /><img src="/assets/single-venue-page/Shape.svg" alt="" /><img src="/assets/single-venue-page/Shape.svg" alt="" />
                                    <span>2 days ago</span>
                                </div>
                                <div>
                                    I love this product because the support is great. Please ...
                                </div>
                                <hr style="background-color: #c4c4c4; width: 50px" />
                                <div>Viddhant</div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        <section class="wed-venue-rating">
            <div class="rating-distribution">
                <div>
                    <div>Rating Distribution</div>
                    <div>
                        5 <img src="/assets/single-venue-page/Rating Star.svg" alt="" />
                    </div>
                </div>
                <div>
                    <div class="rating-bar-box">
                        <div>
                            5&nbsp<img src="/assets/single-venue-page/Rating Star small.svg" alt="" style="margin-top: -4px" />
                        </div>
                        <div>
                            <div class="rating-percent"></div>
                        </div>
                        <div>20 ratings</div>
                    </div>
                    <div class="rating-bar-box">
                        <div>
                            4&nbsp<img src="/assets/single-venue-page/Rating Star small.svg" alt="" style="margin-top: -4px" />
                        </div>
                        <div>
                            <div class="rating-percent"></div>
                        </div>
                        <div>16 ratings</div>
                    </div>
                    <div class="rating-bar-box">
                        <div>
                            3&nbsp<img src="/assets/single-venue-page/Rating Star small.svg" alt="" style="margin-top: -4px" />
                        </div>
                        <div>
                            <div class="rating-percent"></div>
                        </div>
                        <div>0 ratings</div>
                    </div>
                    <div class="rating-bar-box">
                        <div>
                            2&nbsp<img src="/assets/single-venue-page/Rating Star small.svg" alt="" style="margin-top: -4px" />
                        </div>
                        <div>
                            <div class="rating-percent"></div>
                        </div>
                        <div>0 ratings</div>
                    </div>
                    <div class="rating-bar-box">
                        <div>
                            1&nbsp<img src="/assets/single-venue-page/Rating Star small.svg" alt="" style="margin-top: -4px" />
                        </div>
                        <div>
                            <div class="rating-percent"></div>
                        </div>
                        <div>0 ratings</div>
                    </div>
                </div>
            </div>
            <div>
                <div>Rate your experience</div>
                <form action="" method="get">
                    <div class="form-rating">
                        <input class="rate" type="checkbox" name="" id="" value="1" checked />
                        <input class="rate" type="checkbox" name="" id="" value="2" checked />
                        <input class="rate" type="checkbox" name="" id="" value="3" checked />
                        <input class="rate" type="checkbox" name="" id="" value="4" checked />
                        <input class="rate" type="checkbox" name="" id="" value="5" checked />
                        <span class="custom-rate"><i class="fas fa-star"></i></span>
                        <span class="custom-rate"><i class="fas fa-star"></i></span>
                        <span class="custom-rate"><i class="fas fa-star"></i></span>
                        <span class="custom-rate"><i class="fas fa-star"></i></span>
                        <span class="custom-rate"><i class="fas fa-star"></i></span>
                    </div>
                    <div class="rating-form">
                        <label for="">Review title</label>
                        <input type="text" name="" id="" placeholder="Example ; Marvellous" maxlength="100" />
                        <span style="position: absolute">1/100</span>
                    </div>
                    <div class="rating-form">
                        <label for="">Write a review</label>
                        <input type="text" name="" id="" placeholder="Example ; Marvellous" maxlength="100" />
                        <span style="position: absolute">1/100</span>
                    </div>
                    <div class="rating-form">
                        <label for="">Add keywords</label>
                        <input type="text" name="" id="" placeholder="Example ; Marvellous" maxlength="100" />
                        <span style="position: absolute">1/100</span>
                    </div>
                    <button>submit</button>
                </form>
            </div>
        </section>

    </div>
</div>
@endif

@endsection

@section('wed-host-script')
<script>
    const rate = document.querySelectorAll(".rate");
    const customRate = document.querySelectorAll(".custom-rate > i");
    // console.log(rate);
    // console.log(customRate);

    customRate.forEach(function(stars) {
        stars.addEventListener("click", function() {
            // console.log(indexOf(item));
            var clicked = Array.from(customRate).indexOf(stars);
            // console.log(clicked)
            if (stars.classList.contains("fas")) {
                for (let i = clicked + 1; i <= 4; i++) {
                    customRate.item(i).classList.remove("fas");
                    customRate.item(i).classList.add("far");
                }
            } else {
                for (let j = 0; j <= clicked; j++) {
                    customRate.item(j).classList.remove("far");
                    customRate.item(j).classList.add("fas");
                }
            }
            // console.log(rate.item(clicked));
            rate.forEach(function(box) {
                if (box.hasAttribute("checked")) {
                    for (k = clicked + 1; k <= 4; k++) {
                        // console.log(rate.item(k));
                        rate.item(k).removeAttribute("checked", "");
                    }
                } else {
                    for (let l = 0; l <= clicked; l++) {
                        rate.item(l).setAttribute("checked", "");
                    }
                }
            });
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var splide = new Splide(".testimonials", {
            type: "loop",
            perPage: 6,
            fixedWidth: "255px",
            gap: "3em",
            drag: true,
            arrows: true,
            trimSpace: true,
            pagination: "false",
            isNavigation: true,
        });
        splide.mount();
    });
</script>

<script>
    let footDrop = document.querySelectorAll(".foot-drop");
    footDrop.forEach(function(item) {
        item.addEventListener("click", function(e) {
            footDrop.forEach(function(all) {
                if (all !== item) {
                    all.nextElementSibling.classList.remove("show-mobile-foot");
                }
            });
            item.nextElementSibling.classList.toggle("show-mobile-foot");
        });
    });
</script>

<script>
    var jsNav = document.querySelector(".jsNav").children;
    var jsTab = document.querySelector(".jsTab").children;
    for (let i = 0; i < jsNav.length; i++) {
        jsNav[i].addEventListener("click", function() {
            for (let j = 0; j < jsTab.length; j++) {
                if (jsTab[j] !== jsTab[i]) {
                    jsTab[j].classList.add("jsTabHide");
                    jsNav[j].classList.remove("wed-venue-port-head-active");
                }
            }
            jsTab[i].classList.remove("jsTabHide");
            jsNav[i].classList.add("wed-venue-port-head-active");
        });
    }
</script>

@endsection
