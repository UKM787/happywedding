<template>
    <section>
        <div class="ven-project-tabs">
            <div
                v-for="item in projectOrders"
                :key="item.id"
                class="ven-project-tabs-single"
                :style="item.back"
            >
                <div class="ven-project-tabs-single-content">
                    <div>{{ item.name }}</div>
                    <div>
                        <img
                            :src="
                                require(`/assets/vendors/projects/` + item.icon)
                            "
                            alt=""
                        />
                    </div>
                    <div>{{ item.subname }}</div>
                </div>
                <div class="ven-project-tabs-single-number">
                    <div>{{ item.total }}</div>
                    <div>{{ item.subtotal }}</div>
                </div>
            </div>
        </div>
        <div class="ven-projects-main-cont">
            <div>
                <div class="ven-pro-charts">
                    <div class="ven-pro-multi-raidal-chart">
                        <div class="ven-pro-chart-head">Projects</div>
                        <apexchart
                            type="radialBar"
                            height="250"
                            width="210"
                            :options="radialChartOptions"
                            :series="radialChartOptions.series"
                        ></apexchart>
                        <div class="ven-pro-multi-raidal-label">
                            <div style="color: #a82cd0">
                                <span style="background-color: #a82cd0"></span>
                                Completed
                            </div>
                            <div style="color: #d4767f">
                                <span style="background-color: #d4767f"></span>
                                Pending
                            </div>
                            <div style="color: #ed9013">
                                <span style="background-color: #ed9013"></span>
                                Rejected
                            </div>
                        </div>
                    </div>
                    <div class="ven-pro-line-chart">
                        <div class="ven-pro-chart-head">
                            Profits
                            <div>62k</div>
                        </div>
                        <apexchart
                            type="area"
                            height="250"
                            width="210"
                            :options="lineChartOptions"
                            :series="lineChartOptions.series"
                        ></apexchart>
                    </div>
                </div>
                <div class="ven-projects-total-orders">
                    <div>Total orders</div>
                    <div>
                        <div class="ven-projects-total-orders-head">
                            <span style="width: 10%">S/No</span>
                            <span style="width: 35%">Clients</span>
                            <span style="width: 20%">Due Date</span>
                            <span style="width: 35%">Progress</span>
                        </div>
                        <div class="ven-projects-total-orders-content">
                            <div
                                v-for="(item, index) in projectTotalOrders"
                                :key="index"
                            >
                                <span style="width: 10%">{{ item.id }}</span>
                                <span style="width: 35%">{{ item.name }} </span>
                                <span style="width: 20%">{{ item.date }}</span>
                                <span style="width: 35%"> </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="vendor-project-upcoming">
                    <div class="vendor-project-upcoming-head">
                        Upcoming projects
                    </div>
                    <div class="vendor-project-upcoming-content">
                        <div
                            v-for="(item, index) in projectupcoming"
                            :key="index"
                            class="vendor-project-upcoming-single"
                        >
                            <div class="d-flex justify-content-between mb-3">
                                <div
                                    class="vendor-project-upcoming-single-head"
                                >
                                    <div>{{ item.name }}</div>
                                    <div>
                                        <i
                                            class="fas fa-calendar"
                                            style="margin-right: 10px"
                                        ></i
                                        >{{ item.accept }}
                                    </div>
                                </div>
                                <button class="custom-button">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </div>
                            <div style="display: flex">
                                <img
                                    src="\assets\vendors\projects\group866.svg"
                                    alt=""
                                    style="margin-right: 7px"
                                />
                                <div
                                    class="vendor-project-upcoming-single-content"
                                >
                                    <div>Deadline</div>
                                    <div>{{ item.date }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="ved-pro-cust-feed">
                    <div class="ved-pro-cust-feed-head">Customer feedback</div>
                    <apexchart
                        type="donut"
                        :options="donutChartOptions"
                        :series="donutChartOptions.series"
                    ></apexchart>
                    <div class="ved-pro-cust-feed-info">
                        <div>
                            <div>83%</div>
                            <div style="font-size: 10px; color: #138808">
                                Positive
                            </div>
                        </div>
                        <div>
                            <div>17%</div>
                            <div style="font-size: 10px; color: #ff8000">
                                Negative
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
// import VueApexCharts from "vue3-apexcharts";
import VueApexCharts from "vue-apexcharts";

export default {
    components: {
        apexchart: VueApexCharts
    },
    data() {
        return {
            radialChartOptions: {
                series: [70, 50, 27],
                chart: {
                    height: 350,
                    type: "radialBar"
                },
                colors: ["#b033ab", "#cb5b66", "#f39800"],
                plotOptions: {
                    radialBar: {
                        hollow: {
                            margin: 10,
                            size: "40%",
                            background: "transparent"
                        },
                        track: {
                            show: true,

                            background: ["#eeeeee", "#e2e2e2", "#eeeeee"],
                            strokeWidth: "97%",
                            opacity: 1,
                            margin: 3
                        },
                        dataLabels: {
                            name: {
                                fontSize: "17px"
                            },
                            value: {
                                fontSize: "13px"
                            }
                        }
                    }
                },
                stroke: {
                    lineCap: "round"
                },
                labels: ["Completed", "Pending", "Rejected"]
            },
            lineChartOptions: {
                series: [
                    {
                        name: "Profit in thousands",
                        data: [45, 42, 54, 51, 19, 17, 1]
                    }
                ],
                chart: {
                    type: "area",
                    zoom: {
                        enabled: false
                    },
                    toolbar: false
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: "straight",
                    width: 2,
                    colors: ["#ef2a82"]
                },
                fill: {
                    type: "solid",
                    colors: ["#fae6ef"]
                },
                grid: {
                    show: false
                },
                xaxis: {
                    categories: [
                        "01 Jan",
                        "02 Jan",
                        "03 Jan",
                        "04 Jan",
                        "05 Jan",
                        "06 Jan",
                        "07 Jan"
                    ]
                },
                yaxis: {
                    opposite: true
                }
            },
            donutChartOptions: {
                series: [88, 17],
                colors: ["#349628", "#e9b881"],
                chart: {
                    type: "donut"
                },
                dataLabels: {
                    enabled: false
                },
                plotOptions: {
                    pie: {
                        size: "90%"
                    }
                },
                labels: ["Positive", "Negative"],
                legend: {
                    show: false
                }
            },
            projectOrders: [
                {
                    id: 1,
                    icon: "emojione-monotone_shopping-cart.svg",
                    name: "Orders Received",
                    subname: "Completed orders",
                    total: 98,
                    subtotal: 88,
                    back: "background-color: #6aaefc"
                },
                {
                    id: 2,
                    icon: "line-md_cancel.svg",
                    name: "Orders rejected",
                    subname: "This month",
                    total: 20,
                    subtotal: 2,
                    back: "background-color: #3CDCBA"
                },
                {
                    id: 3,
                    icon: "entypo_cycle.svg",
                    name: "Revenue",
                    subname: "This month",
                    total: "Rs.22998",
                    subtotal: "Rs.8745",
                    back: "background-color: #FEBF65"
                },
                {
                    id: 4,
                    icon: "clarity_wallet-line.svg",
                    name: "Total profit",
                    subname: "This month",
                    total: "Rs.22998",
                    subtotal: "Rs.8745",
                    back: "background-color: #FF617B"
                }
            ],
            projectTotalOrders: [
                { id: 1, name: "Aman", date: "15 july", progress: "" },
                { id: 2, name: "Aman", date: "15 july", progress: "" },
                { id: 3, name: "Aman", date: "15 july", progress: "" },
                { id: 4, name: "Aman", date: "15 july", progress: "" },
                { id: 5, name: "Aman", date: "15 july", progress: "" }
            ],
            projectupcoming: [
                {
                    id: 1,
                    name: "Rajesh",
                    accept: "jan 21, 2021",
                    date: "Sunday, july 2021"
                },
                {
                    id: 2,
                    name: "Rajesh",
                    accept: "jan 21, 2021",
                    date: "Sunday, july 2021"
                },
                {
                    id: 3,
                    name: "Rajesh",
                    accept: "jan 21, 2021",
                    date: "Sunday, july 2021"
                },
                {
                    id: 4,
                    name: "Rajesh",
                    accept: "jan 21, 2021",
                    date: "Sunday, july 2021"
                },
                {
                    id: 5,
                    name: "Rajesh",
                    accept: "jan 21, 2021",
                    date: "Sunday, july 2021"
                }
            ]
        };
    }
};
</script>

<style>
.ven-pro-charts {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 350px));
    justify-content: center;
    column-gap: 15px;
    row-gap: 1.5em;
    margin-bottom: 1em;
}
.ven-pro-charts > div {
    background: rgba(255, 255, 255, 0.9);
    box-shadow: 0px 0px 4px 3px rgba(116, 101, 101, 0.25);
    border-radius: 20px;
    display: flex;
    align-items: center;
    flex-direction: column;
    height: auto;
    padding: 18px 15px;
}
.ven-pro-chart-head {
    font-family: Roboto;
    font-style: normal;
    font-weight: normal;
    font-size: 10px;
    line-height: 12px;
    color: #000000;
    text-align: left;
    width: 100%;
}
.ven-pro-chart-head > div {
    font-family: Roboto;
    font-style: normal;
    font-weight: 500;
    font-size: 32.9412px;
    line-height: 39px;
    color: #000000;
}
.ven-pro-multi-raidal-label {
    display: flex;
    width: 100%;
    font-family: Roboto;
    font-style: normal;
    font-weight: normal;
    font-size: 7.20879px;
    line-height: 8px;
    justify-content: space-between;
}
.ven-pro-multi-raidal-label span {
    border-radius: 50%;
    display: inline-block;
    width: 10px;
    height: 10px;
    margin-right: 5px;
}
.ved-pro-cust-feed {
    background: rgba(255, 255, 255, 0.9);
    box-shadow: 0px 0px 4px 3px rgba(116, 101, 101, 0.25);
    border-radius: 20px;
    display: flex;
    align-items: center;
    flex-direction: column;
    padding: 18px 15px;
}
.ved-pro-cust-feed-head {
    font-family: Roboto;
    font-style: normal;
    font-weight: normal;
    font-size: 14.8908px;
    line-height: 17px;
    color: #000000;
    text-align: left;
    width: 100%;
}
.ved-pro-cust-feed-info {
    display: flex;
    justify-content: space-around;
    width: 100%;
    font-family: Roboto;
    font-style: normal;
    font-weight: 500;
    font-size: 14.8908px;
    line-height: 17px;
    color: #000000;
    text-align: center;
}

/* vendor project upcoming */
.vendor-project-upcoming-head {
    font-family: Roboto;
    font-style: normal;
    font-weight: 500;
    font-size: 20px;
    line-height: 23px;
    color: #000000;
    padding: 28px 22px;
    background-color: #ffffff;
    border-top-left-radius: 20px;
    border-top-right-radius: 20px;
}
.vendor-project-upcoming-content {
    background: rgba(255, 255, 255, 0.6);
    box-shadow: 0px 0px 0px 3px rgba(218, 218, 218, 0.25);
    border-bottom-left-radius: 20px;
    border-bottom-right-radius: 20px;
}
.vendor-project-upcoming-single {
    padding: 23px 22px;
    border-bottom: 1px solid #e2e2e2;
}
.vendor-project-upcoming-single-head > div:nth-child(1) {
    font-family: Roboto;
    font-style: normal;
    font-weight: 500;
    font-size: 15px;
    line-height: 18px;
    color: #000000;
}
.vendor-project-upcoming-single-head > div:nth-child(2) {
    font-family: Segoe UI;
    font-style: normal;
    font-weight: normal;
    font-size: 8px;
    line-height: 11px;
    color: #7b7474;
}
.custom-button {
    border: none;
    outline: 0;
    background-color: inherit;
}
.vendor-project-upcoming-single-content > div:nth-child(1) {
    font-family: Segoe UI;
    font-style: normal;
    font-weight: normal;
    font-size: 8px;
    line-height: 11px;
    color: #7b7474;
}
.vendor-project-upcoming-single-content > div:nth-child(2) {
    font-family: Segoe UI;
    font-style: normal;
    font-weight: 600;
    font-size: 8px;
    line-height: 11px;
    color: #000000;
}

/*  projects total orders css starts */
.ven-projects-main-cont {
    display: grid;
    grid-template-columns: 45% 30% 23%;
    padding: 1em;
    justify-content: space-between;
    column-gap: 10px;
    row-gap: 2em;
}
.ven-projects-total-orders {
    padding: 29px 21px;
    background: #ffffff;
    box-shadow: 0px 0px 4px 3px rgba(137, 131, 131, 0.25);
    border-radius: 20px;
}
.ven-projects-total-orders > div:nth-child(1) {
    font-family: Roboto;
    font-style: normal;
    font-weight: 700;
    font-size: 12px;
    line-height: 12px;
    margin-bottom: 10px;
}
.ven-projects-total-orders-head {
    font-family: Roboto;
    font-style: normal;
    font-weight: normal;
    font-size: 12px;
    line-height: 14px;
    color: #000000;
    padding-bottom: 5px;
    border-bottom: 1px solid #eaeaea;
}
.ven-projects-total-orders span {
    display: inline-block;
}
.ven-projects-total-orders-content {
    font-family: Roboto;
    font-style: normal;
    font-weight: 300;
    font-size: 12px;
    line-height: 14px;
    color: #000000;
}
.ven-projects-total-orders-content > div {
    border-bottom: 1px solid #eaeaea;
    padding: 5px 0;
}
.ven-projects-total-orders-content > div:last-child {
    border: none;
}
/* top tabs css starts */
.ven-project-tabs {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    column-gap: 1em;
    row-gap: 1em;
    justify-content: space-between;
}
.ven-project-tabs-single {
    background-image: url("/assets/vendors/projects/Ellipse.png"),
        url("/assets/vendors/projects/Ellipse.png");
    background-repeat: no-repeat, no-repeat;
    background-position: top right, bottom right;
    border-radius: 10px;
    padding: 22px 25px;
    display: flex;
    justify-content: space-between;
}
.ven-project-tabs-single-content > div:nth-child(1) {
    font-family: Segoe UI;
    font-style: normal;
    font-weight: 600;
    font-size: 10px;
    line-height: 13px;
    color: #ffffff;
    margin-bottom: 12px;
}
.ven-project-tabs-single-content > div:nth-child(3) {
    font-family: Segoe UI;
    font-style: normal;
    font-weight: normal;
    font-size: 8px;
    color: #ffffff;
}
.ven-project-tabs-single-number {
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
}
.ven-project-tabs-single-number > div:nth-child(1) {
    font-family: Segoe UI;
    font-style: normal;
    font-weight: 600;
    font-size: 30px;
    line-height: 40px;
    color: #ffffff;
}
.ven-project-tabs-single-number > div:nth-child(2) {
    font-family: Segoe UI;
    font-style: normal;
    font-weight: normal;
    font-size: 8px;
    line-height: 11px;
    color: #ffffff;
    text-align: right;
    margin-right: 10px;
    margin-top: 13px;
}
@media only screen and (max-width: 992px) {
    .ven-projects-main-cont {
        grid-template-columns: repeat(12, 1fr);
    }
    .ven-projects-main-cont > div:nth-child(1) {
        grid-column: 1/13;
    }
    .ven-projects-main-cont > div:nth-child(2) {
        grid-column: 1/13;
    }
    .ven-projects-main-cont > div:nth-child(3) {
        grid-column: 1/13;
    }
}
</style>
