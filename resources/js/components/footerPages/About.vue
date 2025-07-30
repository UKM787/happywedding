<template>
    <div class="container-lg about-cont">
        <div style="width: 60%; margin-left: 3em">
            <h1>About- Happywed</h1>
            <p>
                In this Digital Moving World this application will help Family &
                couple to manage whole wedding ceremonies at figure tips. Here
                they can track all activities, create a list of activities,
                ceremonies, guest list. <br />
                The Wedding Work Management System is related to the arrangement
                and organization of the wedding ceremonies and how this
                arrangement is managed by family members. The main function of
                wedding planning is linked with budgeting, site selection,
                scheduling, arranging decor, catering, facilitating with
                transportation and parking, event security system, obtaining
                necessary permits, coordination with third party vendors to
                settle emergency plans, arrangement of singers or speakers or
                entertainers for events etc.<br />
                The Best Software for Wedding Management<br />
                Unique Features in the Software to Manage Your Wedding
            </p>
        </div>
        <div style="width: 40%">
            <img src="/assets/defaults/about_pic.png" alt="" />
        </div>
    </div>
</template>

<script>
export default {};
</script>

<style scoped>
.about-cont {
    display: flex;
    justify-content: space-between;
    margin: 3em auto;
    min-height: 70vh;
    height: 100%;
}
.about-cont h1 {
    font-family: "Poppins", sans-serif;
    font-style: normal;
    font-weight: 600;
    font-size: 18.8718px;
    line-height: 28px;
    color: #461952;
}
.about-cont img {
    width: 100%;
    object-fit: cover;
}
@media only screen and (max-width: 576px) {
    .about-cont {
        flex-wrap: wrap-reverse;
    }
    .about-cont > div {
        width: 100% !important;
        margin-left: 0 !important;
        text-align: center;
    }
    .about-cont img {
        margin-bottom: 30px;
    }
}
</style>
