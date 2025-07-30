<template>
    <div>
        <form
            @submit.prevent="formSubmit($event)"
            class="container ven-profile-form"
        >
            <div class="row">
                <h2 id="ven-profile-form-head">VENDOR’S PROFILE</h2>
                <div class="vendor-logo-upload">
                    <label for="vendor-logo">
                        <img
                            src="/assets/vendors/dashboard/ven-logo-upload.png"
                            alt=""
                        />
                        <span>Add</span>
                        <input
                            type="file"
                            name="vendor-logo"
                            id="vendor-logo"
                            hidden
                        />
                    </label>
                </div>
            </div>
            <div class="row about">
                <div class="btn-container">
                    <button
                        type="button"
                        class="tab-btn active"
                        data-id="vendor-details"
                    ></button>
                </div>
                <div class="about-content">
                    <div class="content active" id="vendor-details">
                        <h1>Vendor’s details</h1>
                        <div class="vendor-address-form-fields">
                            <label for="vendorCategories">
                                Add Services
                                <select
                                    name="vendorCategories"
                                    id="vendorCategories"
                                    v-model="catId"
                                    multiple
                                >
                                    <option hidden disabled selected>
                                        Select vendor’s category
                                    </option>
                                    <option
                                        v-for="(
                                            item, index
                                        ) in defaultCategories"
                                        :key="index"
                                        :value="item.id"
                                    >
                                        {{ item.name }}
                                    </option>
                                </select>
                            </label>
                            <div>
                                <span
                                    v-for="(item, index) in catId"
                                    :key="index"
                                >
                                    {{
                                        defaultCategories.find(
                                            (x) => x.id === item
                                        ).name
                                    }}
                                </span>
                            </div>
                            <!-- <label for="vendorLocationLink">
                                <input
                                    type="text"
                                    name="map"
                                    id="vendorLocationLink"
                                    placeholder="Add location link"
                                    v-model="sendProfile.map"
                                />
                                <button id="location-link">
                                    <img
                                        src="/assets/vendors/dashboard/location-icon.svg"
                                        alt=""
                                    />
                                    Insert Link
                                </button>
                            </label> -->
                        </div>
                    </div>
                </div>
            </div>
            <div id="ven-profile-form-submit">
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    props: ["vendorId"],
    data() {
        return {
            sendCategory: [],
            catId: [],
            errors: null,
            defaultCategories: null,
        };
    },
    methods: {
        formSubmit(e) {
            var _this = this;
            console.log(this.catId);
            this.catId.forEach(function (item) {
                _this.sendCategory.push({
                    category_id: item,
                    vendor_id: _this.vendorId,
                });
            });
            console.log(this.sendCategory);

            axios
                .post(`/api/vendor/vendorsCategory`, _this.sendCategory)
                .then(function (response) {
                    window.location.reload();
                })
                .catch((error) => {
                    _this.errors = error.response.data.errors;
                    console.log(error.response.data.errors);
                });
        },
        getvendorprofile() {
            var _this = this;
            axios
                .get(`/wedding/vendorMasterList`)
                .then(function (response) {
                    console.log(response);
                    _this.defaultCategories = response.data;
                })
                .catch((errors) => {
                    console.log("Get All: " + errors);
                });
        },
    },
    mounted() {
        this.$nextTick(function () {
            this.getvendorprofile();
        });
    },
};
</script>

<style scoped>
/* Nav Tab CSS Start*/

/* Nav Tab CSS Ends */

.errMsg {
    color: red;
    font-size: 10px;
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
