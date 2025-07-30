<template>
    <div>
        <form class="container ven-profile-form">
            <div class="row">
                <h2 id="ven-profile-form-head">
                    SERVICE'S OFFERED BY {{ vendorDetails.name }}
                </h2>
            </div>
            <div class="row about">
                <div class="btn-container"></div>
                <div class="about-content">
                    <div class="content active" id="vendor-details">
                        <div>
                            <div
                                class="d-flex"
                                style="width: 100%; flex-wrap: wrap"
                            >
                                <a
                                    v-for="(item, index) in defaultCategories"
                                    :key="index"
                                    :data-val="item.id"
                                    class="text-center txt"
                                    style=""
                                >
                                    <div style="position: relative">
                                        <img
                                            :src="
                                                '/assets/defaults/categories/images/' +
                                                item.imageOne
                                            "
                                            alt=""
                                            style="width:100%; max-height:200px;height:100%, object-fit:cover; border-radius:20px"
                                        />
                                        <span
                                            style="
                                                display: block;

                                                background: white;
                                                width: 100%;
                                                border: 1px solid black;
                                                border-radius: 20px;
                                                padding: 10px;
                                            "
                                            >{{ item.name }}</span
                                        >
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div
                            style="margin-top: 3em; display: none"
                            class="vendor-address-form-fields"
                        >
                            <div>
                                <div
                                    style="display: flex; width: 100%"
                                    v-if="catProducts != null"
                                >
                                    <div style="width: 25%">
                                        <a
                                            :href="
                                                '/vendor/welcome/' +
                                                vendorDetails.id +
                                                '/' +
                                                item.id
                                            "
                                            v-for="(item, index) in catProducts"
                                            :key="index"
                                        >
                                            <div>
                                                {{ item.name }}
                                            </div>
                                        </a>
                                    </div>
                                    <div
                                        style="
                                            flex: 1;
                                            display: flex;
                                            justify-content: flex-end;
                                        "
                                    >
                                        <a :href="route">
                                            <div class="addCatProduct">
                                                Add
                                                {{ selectedCatName }}
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div style="display: flex" v-if="showDisp">
                                    No
                                    {{
                                        defaultCategories.find(
                                            (x) => x.id === selectedCat
                                        ).name
                                    }}
                                    added

                                    <div>
                                        <a :href="route">
                                            <div class="addCatProduct">
                                                Add
                                                {{
                                                    defaultCategories.find(
                                                        (x) =>
                                                            x.id === selectedCat
                                                    ).name
                                                }}
                                            </div>
                                        </a>
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
    props: ["vendorId", "vendor", "categories"],
    data() {
        return {
            route: null,
            sendCategory: [],
            defaultCategories: this.categories,
            selectedCat: null,
            prodDisplay: false,
            showDisp: false,
            catProducts: null,
            vendorDetails: this.vendor,
            selectedCatName: null,
            linkkk: null,
        };
    },
    methods: {
        // getvendorprofile() {
        //     var _this = this;
        //     let v = this.vendorId;
        //     axios
        //         .get(`/api/vendor/vendorsCategory/${v}`)
        //         .then(function (response) {
        //             _this.defaultCategories = response.data[1];
        //             _this.vendorDetails = response.data[0];
        //         })
        //         .catch((errors) => {
        //             console.log("Get All: " + errors);
        //         });
        // },
    },
    mounted() {
        this.$nextTick(function () {
            //this.getvendorprofile();
        });
    },
};
</script>

<style scoped>
/* Nav Tab CSS Start*/
.txt {
    width: 25%;

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
    padding: 4em;
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
