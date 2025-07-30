<template>
    <div>
        <form class="container ven-profile-form">
            <div style="flex: 1; display: flex; justify-content: flex-end">
                <a @click="clicked($event)">
                    <div class="addCatProduct">
                        Add New
                        {{ selectedCatName }}
                    </div>
                </a>
            </div>
            <div class="row">
                <h2 id="ven-profile-form-head">
                    {{ selectedCatName }} OFFERED BY {{ vendorDetails.name }}
                </h2>
            </div>
            <div class="row about">
                <div class="btn-container">
                    <!-- <button type="button" class="tab-btn active"></button> -->
                </div>
                <div class="about-content">
                    <div class="content active" id="vendor-list">
                        <!-- <h1>{{ selectedCatName }}</h1> -->
                        <div style="margin-top: 3em" class="">
                            <div>
                                <div v-if="catProducts != null">
                                    <div class="wed-venue-items">
                                        <div
                                            v-for="(item, index) in catProducts"
                                            :key="index"
                                            style="
                                                transition: opacity 1s;
                                                opacity: 1;
                                            "
                                        >
                                            <a
                                                :href="
                                                    '/services/' +
                                                    vendorDetails.slug +
                                                    '/' +
                                                    url +
                                                    '/' +
                                                    item.slug
                                                "
                                            >
                                                <div>
                                                    <div>
                                                        <img
                                                            v-if="
                                                                item.images !=
                                                                null
                                                            "
                                                            :src="
                                                                '/assets/vendors/uploads/' +
                                                                item.images[0]
                                                            "
                                                            alt=""
                                                            width="100px"
                                                            height="auto"
                                                        />
                                                        <img
                                                            v-else
                                                            src="/assets/vendors/landing/Frame870.png"
                                                            alt=""
                                                            width="100px"
                                                            height="auto"
                                                        />
                                                        <div
                                                            class="wed-venue-items-desc"
                                                        >
                                                            <div>
                                                                <div>
                                                                    {{
                                                                        item.name
                                                                    }}
                                                                </div>
                                                                <div
                                                                    class="d-flex"
                                                                >
                                                                    <div>5</div>
                                                                    <div>
                                                                        <img
                                                                            src="/assets/icon-SVG/Star.svg"
                                                                            alt=""
                                                                            style="
                                                                                margin-top: -5px;
                                                                            "
                                                                        />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <p>location</p>
                                                                <p>
                                                                    30 reviews
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="wed-venue-items-price"
                                                >
                                                    <div>Starting from</div>
                                                    <div>
                                                        10000
                                                        <span>per day</span>
                                                    </div>
                                                </div>
                                            </a>
                                            <div
                                                style="
                                                    padding: 10px;
                                                    display: flex;
                                                    justify-content: space-between;
                                                "
                                            >
                                                <button
                                                    @click="edit(item.id)"
                                                    type="button"
                                                    :data-id="item.id"
                                                >
                                                    EDIT
                                                </button>
                                                <!-- <button
                                                    @click="
                                                        removeProd(
                                                            $event,
                                                            item.id
                                                        )
                                                    "
                                                    type="button"
                                                    :data-id="item.id"
                                                >
                                                    DELETE
                                                </button> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    name: "services",
    props: ["vendorCat", "vendor", "added", "url"],
    data() {
        return {
            form: false,
            route: null,
            sendCategory: [],
            defaultCategories: null,
            selectedCat: null,
            prodDisplay: false,
            showDisp: false,
            catProducts: null,
            vendorDetails: JSON.parse(this.vendor),
            selectedCatName: null,
            vendorCategory: this.vendorCat,
        };
    },
    methods: {
        clicked(e) {
            this.$emit("clickedAdd");
        },
        edit(e) {
            console.log(e);
            this.$emit("edit", e);
        },
        removeProd(evt, e) {
            //console.log(evt.currentTarget.parentElement.parentElement);
            let itm = evt.currentTarget.parentElement.parentElement;
            let _this = this;
            let link = null;
            if (_this.vendorCategory.name == "Accommodation") {
                link = "addacc";
            }
            if (_this.vendorCategory.name == "Venues") {
                link = "addvenue";
            }
            //console.log(`/api/vendor/${link}/${e}`, _this.vendorCategory.name);
            axios
                .delete(`/api/vendor/${link}/${e}`)
                .then(function (response) {
                    let id = _this.catProducts.findIndex((x) => x.id === e);
                    itm.style.opacity = 0;
                    _this.$emit("deleted");
                    setTimeout(function () {
                        _this.catProducts.splice(id, 1);
                        itm.style.opacity = 1;
                    }, 1500);
                    //fruits.splice(2);
                    // _this.getProducts("e");
                })
                .catch((error) => {
                    console.log(error.response);
                });
        },
        getProducts(e) {
            var _this = this;
            this.selectedCatName = this.vendorCategory.name;
            this.showDisp = false;
            _this.prodDisplay = true;
            let v = this.vendorDetails.id;
            let catid = this.vendorCategory.id;
            console.log(v, catid);
            axios
                .get(`/vendorsProducts/${v}/${catid}`)
                .then(function (response) {
                    console.log(response.data);
                    _this.route = `/services/${_this.vendorDetails.slug}/${response.data[1]}`;

                    if (response.data[0] != 0) {
                        _this.catProducts = response.data[0];
                    } else {
                        _this.catProducts = null;
                        _this.showDisp = true;
                    }
                })
                .catch((errors) => {
                    _this.catProducts = null;
                    console.log("Get All: " + errors);
                });
        },
    },
    mounted() {
        this.$nextTick(function () {
            this.getProducts();
        });
    },
    watch: {
        added: function (newVal, oldVal) {
            let _this = this;
            let elements = $(".wed-venue-items > div > div > button");
            let added = null;
            elements.each(function (index, item) {
                console.log(item.dataset.id, item);

                if (item.dataset.id == newVal) {
                    added = item;
                    console.log(item);
                }
            }),
                setTimeout(function () {
                    let ele = added.parentElement.parentElement;
                    ele.scrollIntoView(true);
                    //console.log(added);
                    ele.style.border = "2px solid black";
                }, 100);

            setTimeout(function () {
                let ele = added.parentElement.parentElement;
                ele.style.border = "";
            }, 1000);

            console.log("Prop changed: ", newVal, " | was: ", oldVal);
            console.log(added);
        },
    },
};
</script>

<style scoped>
html {
    height: 100%;
}
@keyframes del {
    0% {
        opacity: 1;
    }
    20% {
        opacity: 0.75;
    }
    40% {
        opacity: 0.5;
    }
    60% {
        opacity: 0.25;
    }
    100% {
        opacity: 0;
    }
}
#vendor-list > h1 {
    font-family: Segoe UI;
    font-style: normal;
    font-weight: 600;
    font-size: 17.1823px;
    line-height: 18px;
    text-align: center;
    text-transform: capitalize;
    color: #461952;
}
.wed-venue-items {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 300px));
    grid-template-rows: max-content;
    grid-column-gap: 10px;
    grid-row-gap: 20px;
    padding: 20px;
}

.wed-venue-items > div > div > button:nth-child(1) {
    outline: none;
    border: none;
    background-color: #461952;
    color: white;
    padding: 4px 20px;
    border-radius: 10px;
}
.wed-venue-items > div > div > button:nth-child(2) {
    outline: none;
    border: none;
    background-color: #ee3e54;
    color: white;
    padding: 4px 20px;
    border-radius: 10px;
}

.wed-venue-items > div > a {
    text-decoration: none;
    color: inherit;
}

.wed-venue-items > div > a > div:nth-child(1) > div {
    position: relative;
    padding-top: 100%;
}

.wed-venue-items > div > a > div > div > img {
    width: 100%;
    border-radius: 14.6552px;
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
}

.wed-venue-items-desc {
    background-color: #ffffff;
    background: #ffffff;
    border: 0.146552px solid #000000;
    border-radius: 14.6552px;
    padding: 10px;
    position: absolute;
    bottom: 0;
    width: 100%;
}

.wed-venue-items-desc > div {
    display: flex;
    justify-content: space-between;
    margin: 4px 0;
}

.wed-venue-items-desc > div > div:nth-child(1) {
    font-family: Segoe UI;
    font-style: normal;
    font-weight: normal;
    font-size: 14.6552px;
    line-height: 19px;
    color: #000000;
    align-self: center;
}

.wed-venue-items-desc > div > div:nth-child(2) > div:nth-child(1) {
    font-family: Inter;
    font-style: normal;
    font-weight: 600;
    font-size: 6.74138px;
    line-height: 8px;
    text-align: center;
    color: #ffffff;
    background: #461952;
    padding: 8px 13px;
}

.wed-venue-items-desc > div > div:nth-child(2) > div:nth-child(2) {
    background: #7fd926;
    height: inherit;
    padding: 0 8px;
}

.wed-venue-items-desc > div:nth-child(2) > p {
    font-family: Segoe UI;
    font-style: normal;
    font-weight: 350;
    font-size: 10.9914px;
    line-height: 15px;
    color: #a79c9c;
    margin: 0;
}

.wed-venue-items-price {
    display: flex;
    justify-content: space-between;
    background-color: #ffffff;
    border-radius: 14.6552px;
    padding: 10px;
    border: 0.146552px solid #000000;
}

.wed-venue-items-price > div:nth-child(1) {
    font-family: "Segoe UI";
    font-style: normal;
    font-weight: 350;
    font-size: 10.9914px;
    line-height: 15px;
    color: #a79c9c;
}

.wed-venue-items-price > div:nth-child(2) {
    font-family: "Segoe UI";
    font-style: normal;
    font-weight: 700;
    font-size: 14.2888px;
    line-height: 19px;
    color: #461952;
}
.wed-venue-items-price > div:nth-child(2) > span {
    font-family: "Segoe UI";
    font-style: normal;
    font-weight: 350;
    font-size: 10.9914px;
    line-height: 15px;
    color: #a79c9c;
}

/* Nav Tab CSS Start*/
.txt {
    flex: 1;
    background-color: rgba(244, 63, 94, 0.1);
    border: 1px solid rgb(244, 63, 94);
    padding: 10px;
    color: rgb(244, 63, 94);
    font-weight: 900;
}
/* Nav Tab CSS Ends */
.errMsg {
    color: red;
    font-size: 10px;
}
.addCatProduct {
    background: #c4456f;
    box-shadow: 0px 0px 4px 1px rgba(0, 0, 0, 0.25);
    border-radius: 22.4987px;
    padding: 7px 30px;
    font-family: Segoe UI;
    font-style: normal;
    font-weight: 600;
    font-size: 11.2493px;
    line-height: 15px;
    text-transform: capitalize;
    color: #ffffff;
    outline: none;
    border: 0;
    width: max-content;
    cursor: pointer;
}
.btn-container {
    display: flex;
    flex-direction: row;
    justify-content: center;
    margin: 1em 0;
}
.tab-btn.active {
    background: #461952;
    color: white !important;
    background: linear-gradient(0deg, #c4456f, #c4456f),
        linear-gradient(0deg, #c4456f, #c4456f), #c4456f;
    border-radius: 58.0689px;
    box-shadow: none;
    border: none;
    display: block;
    cursor: pointer;
    border-radius: 58.0689px;
    width: 32px;
    height: 4px;
    margin: 0 3px;
    box-shadow: 0px 0px 3px 1.5px #888888;
}

.ven-profile-form {
    background: rgba(255, 255, 255, 0.8);
    box-shadow: 1.97875px 1.97875px 1.97875px rgba(224, 219, 219, 0.25);
    border-radius: 21.0451px;
    margin-top: 5em;
    padding: 3em 2em;
}
#ven-profile-form-head {
    font-family: Sahitya;
    font-style: normal;
    font-weight: normal;
    font-size: 18.9267px;
    line-height: 29px;
    text-align: center;
    text-transform: uppercase;
    color: #461952;
    text-shadow: 0px 1.51414px 1.51414px rgba(0, 0, 0, 0.25);
    margin: 1em 0;
}
.vendor-logo-upload > label {
    display: flex;
    flex-direction: column;
    width: max-content;
    text-align: center;
    margin: 0.5em auto;
    position: relative;
    cursor: pointer;
}
.vendor-logo-upload img {
    width: 61px;
    height: 61px;
}
.vendor-logo-upload span {
    display: block;
    font-family: Segoe UI;
    font-style: normal;
    font-weight: normal;
    font-size: 8.67394px;
    line-height: 9px;
    color: #736e6e;
    position: absolute;
    bottom: 3px;
    left: 22px;
}

#vendor-details > h1 {
    font-family: Segoe UI;
    font-style: normal;
    font-weight: 600;
    font-size: 17.1823px;
    line-height: 18px;
    text-align: center;
    text-transform: capitalize;
    color: #461952;
}
.vendor-details-form-fields > label {
    display: flex;
    flex-direction: column;
    background: #ffffff;
    border: 0.179498px solid #7e7979;
    box-sizing: border-box;
    border-radius: 3.29558px;
    font-family: Segoe UI;
    font-style: normal;
    font-weight: normal;
    font-size: 16.23896px;
    color: #000000;
    padding: 10px 20px;
}
.vendor-details-form-fields > label > input {
    font-family: Segoe UI;
    font-style: normal;
    font-weight: normal;
    font-size: 12.23896px;
    line-height: 11px;
    color: #afa5a5;
    outline: none;
    border: 0;
    margin: 5px 0;
    background-color: transparent !important;
}

.vendor-address-form-fields {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    column-gap: 12px;
    row-gap: 4px;
}
/* .vendor-address-form-fields > label:first-child {
    grid-column-start: 1;
    grid-column-end: -1;
} */
/* .vendor-address-form-fields > label:last-child {
    grid-column-start: 1;
    grid-column-end: -1;
    position: relative;
} */
.vendor-address-form-fields > label {
    display: flex;
    flex-direction: column;
    background: #ffffff;
    border: 0.179498px solid #7e7979;
    box-sizing: border-box;
    border-radius: 3.29558px;
    font-family: Segoe UI;
    font-style: normal;
    font-weight: normal;
    font-size: 16.23896px;
    color: #000000;
    padding: 10px 20px;
}
.vendor-address-form-fields > div {
    grid-column-start: 1;
    grid-column-end: -1;
}
#vendorCategories {
    padding: 0px 25px 9px 0px;
    margin-left: -4px;
    border: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    background: #ffffff;
    border-radius: 5px;
    background-image: url("/assets/vendors/dashboard/dropdown-arrow.svg");
    background-repeat: no-repeat;
    background-position: 98%;
    background-size: 15px;
    border: none;
    font-family: Segoe UI;
    font-style: normal;
    font-weight: normal;
    font-size: 12.97492px;

    /* identical to box height */

    color: #7e7979;
}
#vendorCategories > option {
    font-family: Segoe UI;
    font-style: normal;
    font-weight: normal;
    font-size: 10px;
    line-height: 13px;
    color: #3d3838;
}
.vendor-address-form-fields > label > input {
    font-family: Segoe UI;
    font-style: normal;
    font-weight: normal;
    font-size: 12.23896px;
    line-height: 11px;
    color: #afa5a5;
    outline: none;
    border: 0;
    margin: 5px 0;
    background-color: transparent !important;
}
#location-link {
    background: #d8839f;
    box-shadow: 0px 0px 4px 0.1px rgba(0, 0, 0, 0.25);
    border-radius: 14.3599px;
    font-family: Segoe UI;
    font-style: normal;
    font-weight: 600;
    font-size: 9.05367px;
    line-height: 8px;
    text-transform: capitalize;
    color: #ffffff;
    width: max-content;
    padding: 5px 15px;
    outline: none;
    border: 0;
    right: 10px;
    position: absolute;
}

#ven-profile-form-submit {
    position: relative;
    margin: 1.5em 0;
    padding: 5em;
}

#ven-profile-form-submit > button {
    background: #c4456f;
    box-shadow: 0px 0px 4px 1px rgba(0, 0, 0, 0.25);
    border-radius: 22.4987px;
    padding: 7px 30px;
    position: absolute;
    right: 15px;
    top: 40px;
    margin-left: auto;
    font-family: Segoe UI;
    font-style: normal;
    font-weight: 600;
    font-size: 11.2493px;
    line-height: 15px;
    text-transform: capitalize;
    color: #ffffff;
    outline: none;
    border: 0;
}

@media screen and (max-width: 762px) {
    .vendor-details-form-fields {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    }
    .vendor-address-form-fields {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    }
    .vendor-preview-form-fields {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    }
}
</style>
