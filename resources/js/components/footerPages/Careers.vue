<template>
    <div class="container career-cont">
        <h1 class="careers-title">Current Job Openings</h1>
        <p class="careers-info">
            Turpis diam amet lacus turpis egestas odio nulla erat viverra. Ut
            faucibus est eget molestie. Arcu vulputate laoreet nunc velit mollis
            lectus pulvinar feugiat eget. Nunc, ornare sed vel ultrices
            scelerisque sit.
        </p>
        <div class="careers-filter-cont">
            <div>
                <div class="single-filter-head">Departments</div>
                <div class="single-filter-content">
                    <div>
                        All departments
                        <img
                            src="/assets/miscellenous/up-down-arrow.svg"
                            alt=""
                        />
                    </div>
                    <div class="single-filter-content-list"></div>
                </div>
            </div>
            <div>
                <div class="single-filter-head">Offices</div>
                <div class="single-filter-content">
                    <div>
                        All offices
                        <img
                            src="/assets/miscellenous/up-down-arrow.svg"
                            alt=""
                        />
                    </div>
                    <div class="single-filter-content-list"></div>
                </div>
            </div>
        </div>
        <div class="careers-list-cont">
            <div class="careers-list-single-cont">
                <h2>Customer Success</h2>
                <div>Senior Customer Success Architect Remote (US)</div>
            </div>
            <div class="careers-list-single-cont">
                <h2>Engineering</h2>
                <div>Senior Customer Success Architect Remote (US)</div>
                <div>Senior Customer Success Architect Remote (US)</div>

                <div>Senior Customer Success Architect Remote (US)</div>
                <div>Senior Customer Success Architect Remote (US)</div>
                <div>Senior Customer Success Architect Remote (US)</div>

                <div>Senior Customer Success Architect Remote (US)</div>
                <div>Senior Customer Success Architect Remote (US)</div>
                <div>Senior Customer Success Architect Remote (US)</div>
                <div>Senior Customer Success Architect Remote (US)</div>
            </div>
        </div>
    </div>
</template>

<script>
export default {};
</script>

<style scoped>
.career-cont {
    margin: 3em auto;
}
.careers-title {
    font-family: "Poppins", sans-serif;
    font-style: normal;
    font-weight: 900;
    font-size: 18.8718px;
    line-height: 28px;
    color: #461952;
}
.careers-info {
    font-family: "Poppins", sans-serif;
    font-style: normal;
    font-weight: 400;
    font-size: 12px;
    line-height: 18px;
    max-width: 511px;
    color: #000000;
}
.careers-filter-cont {
    max-width: 511px;
    display: flex;
    justify-content: space-between;
}
.careers-filter-cont > div {
    width: 45%;
}
.single-filter-head {
    font-family: "Poppins", sans-serif;
    font-style: normal;
    font-weight: 400;
    font-size: 11.1864px;
    line-height: 17px;
    color: #000000;
    margin-bottom: 10px;
}
.single-filter-content > div:nth-child(1) {
    background: #f6f8fc;
    padding: 17px 30px;
    font-family: "Poppins", sans-serif;
    font-style: normal;
    font-weight: 400;
    font-size: 10px;
    line-height: 15px;
    color: #8e8e8e;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.careers-list-cont {
    margin-top: 15px;
}
.careers-list-single-cont > h2 {
    font-family: "Poppins", sans-serif;
    font-style: normal;
    font-weight: 500;
    font-size: 13.8298px;
    line-height: 21px;
    color: #000000;
    margin-bottom: 15px;
}
.careers-list-single-cont > div {
    font-family: "Poppins", sans-serif;
    font-style: normal;
    font-weight: 500;
    font-size: 10.6667px;
    line-height: 16px;
    margin-bottom: 10px;
    color: #461952;
    max-width: 191px;
}
</style>
