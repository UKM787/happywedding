<template>
    <div>
        <div class="container ven-profile-form">
            <div class="row">
                <h2 id="ven-profile-form-head">PROFILE</h2>

                <div class="vendor-logo-upload">
                    <label v-if="!personalfileOpen" for="company-logo">
                        <img
                            v-if="companyPicPreview"
                            :src="companyPicPreview"
                            alt=""
                        />
                        <img
                            v-else-if="
                                companyProfile?.companyimg ==
                                'vendorDefault.png'
                            "
                            :src="
                                '/storage/vendors/' + companyProfile.companyimg
                            "
                            alt=""
                        />
                        <img
                            v-else-if="companyProfile?.companyimg"
                            :src="
                                '/assets/vendors/uploads/' +
                                companyProfile.companyimg
                            "
                            alt=""
                        />
                        <img
                            v-else
                            src="/assets/vendors/dashboard/ven-logo-upload.png"
                            alt=""
                        />
                        <span>Add</span>
                        <span
                            v-if="errors && errors.companyimg"
                            class="errMsg"
                            >{{ errors.companyimg[0] }}</span
                        >
                    </label>
                    <label v-if="personalfileOpen" for="vendor-logo">
                        <img
                            v-if="profilePicPreview"
                            :src="profilePicPreview"
                            alt=""
                        />
                        <img
                            v-else-if="
                                sendProfile?.avatar == 'vendorDefault.png'
                            "
                            :src="'/storage/vendors/' + sendProfile.avatar"
                            alt=""
                        />
                        <img
                            v-else-if="sendProfile?.avatar"
                            :src="
                                '/assets/vendors/uploads/' + sendProfile.avatar
                            "
                            alt=""
                        />
                        <img
                            v-else
                            src="/assets/vendors/dashboard/ven-logo-upload.png"
                            alt=""
                        />
                        <span>Add</span>
                        <span v-if="errors && errors.avatar" class="errMsg">{{
                            errors.avatar[0]
                        }}</span>
                    </label>
                </div>
            </div>
            <div :class="[loader ? 'blur row about' : 'row about']">
                <div class="btn-container">
                    <button
                        type="button"
                        class="tab-btn active"
                        data-id="company-details"
                        title="Company Profile"
                        @click="
                            toggleForm($event, true);
                            personalfileOpen = false;
                        "
                    ></button>
                    <button
                        type="button"
                        class="tab-btn"
                        data-id="vendor-details"
                        title="Personal Profile"
                        @click="
                            toggleForm($event, true);
                            personalfileOpen = true;
                        "
                    ></button>
                </div>
                <div class="about-content">
                    <form
                        @submit.prevent="submitCProfile($event)"
                        class="content active"
                        id="company-details"
                    >
                        <input
                            type="file"
                            id="company-logo"
                            name="company-logo"
                            style="
                                left: 42%;
                                position: absolute;
                                top: 13%;
                                opacity: 0;
                            "
                            @change="uploadImg($event, 'company')"
                        />
                        <h1>Company details</h1>
                        <div
                            v-if="cexist == 1"
                            style="display: flex; justify-content: flex-end"
                        >
                            <button
                                @click="editForm($event)"
                                style="
                                    outline: none;
                                    border: none;
                                    background-color: #461952;
                                    color: white;
                                    padding: 4px 20px;
                                    border-radius: 10px;
                                    margin-bottom: 10px;
                                    margin-right: 20px;
                                "
                                type="button"
                            >
                                Edit
                            </button>
                        </div>
                        <div class="vendor-details-form-fields">
                            <label for="companyname">
                                Company name
                                <input
                                    type="text"
                                    name="companyname"
                                    id="companyname"
                                    placeholder="Enter your company name"
                                    v-model="companyProfile.companyname"
                                />
                                <span
                                    v-if="errors && errors.companyname"
                                    class="errMsg"
                                    >{{ errors.companyname[0] }}</span
                                >
                            </label>
                            <label for="companyinfo">
                                Company Description
                                <input
                                    type="text"
                                    name="companyinfo"
                                    id="companyinfo"
                                    placeholder="Enter your company description"
                                    v-model="companyProfile.companyinfo"
                                />
                                <span
                                    v-if="errors && errors.companyinfo"
                                    class="errMsg"
                                    >{{ errors.companyinfo[0] }}</span
                                >
                            </label>
                            <label for="caddress">
                                Company Address
                                <input
                                    type="text"
                                    name="caddress"
                                    id="caddress"
                                    placeholder="Enter your company address"
                                    v-model="companyProfile.address"
                                />
                                <span
                                    v-if="errors && errors.address"
                                    class="errMsg"
                                    >{{ errors.address[0] }}</span
                                >
                            </label>
                            <label for="cmap">
                                Map
                                <input
                                    type="text"
                                    name="cmap"
                                    id="cmap"
                                    placeholder="Map"
                                    v-model="companyProfile.map"
                                />
                                <span
                                    v-if="errors && errors.map"
                                    class="errMsg"
                                    >{{ errors.map[0] }}</span
                                >
                            </label>
                            <label for="latitude">
                                Latitude
                                <input
                                    type="text"
                                    name="latitude"
                                    id="latitude"
                                    placeholder="Latitude"
                                    v-model="companyProfile.latitude"
                                />
                                <span
                                    v-if="errors && errors.latitude"
                                    class="errMsg"
                                    >{{ errors.latitude[0] }}</span
                                >
                            </label>
                            <label for="longitude">
                                Longitude
                                <input
                                    type="text"
                                    name="longitude"
                                    id="longitude"
                                    placeholder="Longtitude"
                                    v-model="companyProfile.longitude"
                                />
                                <span
                                    v-if="errors && errors.longitude"
                                    class="errMsg"
                                    >{{ errors.longitude[0] }}</span
                                >
                            </label>
                            <label for="establish">
                                Establish
                                <input
                                    type="text"
                                    name="establish"
                                    id="establish"
                                    placeholder="Company established"
                                    v-model="companyProfile.establish"
                                />
                                <span
                                    v-if="errors && errors.establish"
                                    class="errMsg"
                                    >{{ errors.establish[0] }}</span
                                >
                            </label>
                            <label for="gst">
                                GST Number
                                <input
                                    type="text"
                                    name="gst"
                                    id="gst"
                                    placeholder="GST"
                                    v-model="companyProfile.gst"
                                />
                                <span
                                    v-if="errors && errors.gst"
                                    class="errMsg"
                                    >{{ errors.gst[0] }}</span
                                >
                            </label>
                            <label for="phone">
                                Landline Number
                                <input
                                    type="text"
                                    name="whatsapp1"
                                    id="phone"
                                    placeholder="Landline Number"
                                    v-model="companyProfile.phone"
                                />
                                <span
                                    v-if="errors && errors.phone"
                                    class="errMsg"
                                    >{{ errors.phone[0] }}</span
                                >
                            </label>
                        </div>
                        <div class="vendor-address-form-fields">
                            <label for="vendorCategories">
                                {{ loggedIn.main_category.name }} sub-categories
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
                                        v-for="(item, index) in cats"
                                        :key="index"
                                        :value="item.id"
                                    >
                                        {{ item.name }}
                                    </option>
                                </select>
                                <span
                                    v-if="errors && errors.categories"
                                    class="errMsg"
                                    >{{ errors.categories[0] }}</span
                                >
                            </label>
                            <!-- <label for="vendorCategories">
                                Extra services
                                <select
                                    name="vendorCategories"
                                    id="vendorCategories"
                                    v-model="serviceId"
                                    multiple
                                >
                                    <option hidden disabled selected>
                                        Select vendor’s services
                                    </option>
                                    <option
                                        v-for="(item, index) in services"
                                        :key="index"
                                        :value="item.id"
                                    >
                                        {{ item.name }}
                                    </option>
                                </select>
                                <span
                                    v-if="errors && errors.services"
                                    class="errMsg"
                                    >{{ errors.services[0] }}</span
                                >
                            </label> -->
                            <label for="cities">
                                Location
                                <select
                                    name="cities"
                                    id="cities"
                                    v-model="companyProfile.location_id"
                                >
                                    <option disabled selected>
                                        Select Location
                                    </option>
                                    <option
                                        v-for="(item, index) in cities"
                                        :key="index"
                                        :value="item.code"
                                    >
                                        {{ item.name }}
                                    </option>
                                </select>
                                <span
                                    v-if="errors && errors.location_id"
                                    class="errMsg"
                                    >{{ errors.location_id[0] }}</span
                                >
                            </label>
                            <label for="mobile">
                                Primary Mobile
                                <input
                                    type="text"
                                    name="mobile"
                                    id="mobile"
                                    placeholder="Primary Mobile"
                                    v-model="companyProfile.mobile"
                                />
                                <span
                                    v-if="errors && errors.mobile"
                                    class="errMsg"
                                    >{{ errors.mobile[0] }}</span
                                >
                            </label>
                            <!-- <label for="mobile1">
                                Alternate Mobile
                                <input
                                    type="text"
                                    name="mobile1"
                                    id="mobile1"
                                    placeholder="Alternate Mobile "
                                    v-model="companyProfile.cmobile1"
                                    required
                                />
                                <span
                                    v-if="errors && errors.cmobile1"
                                    class="errMsg"
                                    >{{ errors.cmobile1[0] }}</span
                                >
                            </label> -->
                            <label for="whatsup">
                                Whatsapp
                                <input
                                    type="text"
                                    name="whatsup"
                                    id="whatsup"
                                    placeholder="Enter your Watsapp number"
                                    v-model="companyProfile.whatsup"
                                />
                                <span
                                    v-if="errors && errors.whatsup"
                                    class="errMsg"
                                    >{{ errors.whatsup[0] }}</span
                                >
                            </label>
                            <label for="email">
                                Email
                                <input
                                    type="email"
                                    name="email"
                                    id="email"
                                    placeholder="Enter your Watsapp number"
                                    v-model="companyProfile.email"
                                />
                                <span
                                    v-if="errors && errors.email"
                                    class="errMsg"
                                    >{{ errors.email[0] }}</span
                                >
                            </label>
                        </div>
                        <!-- <div class="vendor-preview-upload">
                            Add Company Pictures
                            <label for="vendorImagesUpload">
                                <div
                                    id="vendor-preview-upload-dropzone"
                                    class="dropzone"
                                    @dragover.prevent="drago($event)"
                                    @dragleave.prevent="dragl($event)"
                                    @drop.prevent="dragdrop($event)"
                                >
                                    <span>
                                        <img
                                            src="/assets/vendors/dashboard/ven-gallery-upload.png"
                                            alt=""
                                        />
                                    </span>
                                    <span>Add photos/ videos</span>
                                    <span>or drag and drop</span>
                                    <span></span>
                                </div>
                                <div id="vendor-preview-upload-dragtext"></div>
                                <input
                                    type="file"
                                    name="vendorImagesUpload"
                                    id="vendorImagesUpload"
                                    hidden
                                    multiple
                                    @change="count($event)"
                                />
                            </label>
                        </div> -->
                        <div class="ven-profile-form-submit">
                            <button
                                v-if="cexist != '1'"
                                :disabled="cprofileDisabled"
                                data-id="vendor-categories"
                                id="submitPprofile"
                            >
                                Submit
                            </button>
                            <button
                                v-else
                                style="display: none"
                                id="submitPprofile"
                                :disabled="cprofileDisabled"
                                type="submit"
                            >
                                Update
                            </button>
                            <button
                                data-id="vendor-details"
                                @click="
                                    toggleForm($event, true);
                                    personalfileOpen = true;
                                "
                                type="button"
                            >
                                <img src="/assets/vendors/Frame.svg" alt="" />
                            </button>
                        </div>
                    </form>
                    <form
                        @submit.prevent="submitProfile($event)"
                        class="content"
                        id="vendor-details"
                        data-id="company-details"
                    >
                        <input
                            v-show="personalfileOpen"
                            type="file"
                            id="vendor-logo"
                            name="vendor-logo"
                            style="
                                left: 42%;
                                position: absolute;
                                top: 13%;
                                opacity: 0;
                            "
                            @change="uploadImg($event, 'profile')"
                        />
                        <h1>Personal details</h1>
                        <div
                            v-if="exist == 1"
                            style="display: flex; justify-content: flex-end"
                        >
                            <button
                                @click="editForm($event)"
                                style="
                                    outline: none;
                                    border: none;
                                    background-color: #461952;
                                    color: white;
                                    padding: 4px 20px;
                                    border-radius: 10px;
                                    margin-bottom: 10px;
                                    margin-right: 20px;
                                "
                                type="button"
                            >
                                Edit
                            </button>
                        </div>
                        <div class="vendor-details-form-fields">
                            <label for="vendorFirstName">
                                First name
                                <input
                                    type="text"
                                    name="firstname"
                                    id="vendorFirstName"
                                    placeholder="Enter your first name"
                                    v-model="sendProfile.firstname"
                                />
                                <span
                                    v-if="errors && errors.firstname"
                                    class="errMsg"
                                    >{{ errors.firstname[0] }}</span
                                >
                            </label>
                            <label for="vendorLastName">
                                Last name
                                <input
                                    type="text"
                                    name="lastname"
                                    id="vendorLastName"
                                    placeholder="Enter your last name"
                                    v-model="sendProfile.lastname"
                                />
                                <span
                                    v-if="errors && errors.lastname"
                                    class="errMsg"
                                    >{{ errors.lastname[0] }}</span
                                >
                            </label>
                            <label for="vendorDesgination">
                                Designation
                                <input
                                    type="text"
                                    name="desgination"
                                    id="vendorDesgination"
                                    placeholder="Enter your designation in company"
                                    v-model="sendProfile.desgination"
                                />
                                <span
                                    v-if="errors && errors.desgination"
                                    class="errMsg"
                                    >{{ errors.desgination[0] }}</span
                                >
                            </label>
                            <label for="vendorPhone-1">
                                Phone Number-1
                                <input
                                    type="text"
                                    name="mobile"
                                    id="vendorPhone-1"
                                    placeholder="Enter your phone number"
                                    v-model="sendProfile.mobile"
                                />
                                <span
                                    v-if="errors && errors.mobile"
                                    class="errMsg"
                                    >{{ errors.mobile[0] }}</span
                                >
                            </label>

                            <!-- <label for="vendorPhone-2">
                                Phone Number-2
                                <input
                                    type="text"
                                    name="mobile1"
                                    id="vendorPhone-2"
                                    placeholder="Enter your phone number"
                                    v-model="sendProfile.mobile1"
                                    required
                                />
                                <span
                                    v-if="errors && errors.mobile1"
                                    class="errMsg"
                                    >{{ errors.mobile1[0] }}</span
                                >
                            </label> -->

                            <label for="vendorLandline">
                                Landline Number
                                <input
                                    type="text"
                                    name=";andline"
                                    id="vendorLandline"
                                    placeholder="Enter your landline number"
                                    v-model="sendProfile.landline"
                                />
                                <span
                                    v-if="errors && errors.landline"
                                    class="errMsg"
                                    >{{ errors.landline[0] }}</span
                                >
                            </label>
                            <label for="vendorEmailAddress">
                                Email Address
                                <input
                                    type="text"
                                    name="email"
                                    id="vendorEmailAddress"
                                    placeholder="Enter your email address"
                                    v-model="sendProfile.email"
                                />
                                <span
                                    v-if="errors && errors.email"
                                    class="errMsg"
                                    >{{ errors.email[0] }}</span
                                >
                            </label>
                            <label for="vendorWatsapp-1">
                                Watsapp Number-1
                                <input
                                    type="text"
                                    name="whatsapp"
                                    id="vendorWatsapp-1"
                                    placeholder="Enter your whatsapp number"
                                    v-model="sendProfile.whatsapp"
                                />
                                <span
                                    v-if="errors && errors.whatsapp"
                                    class="errMsg"
                                    >{{ errors.whatsapp[0] }}</span
                                >
                            </label>

                            <!-- <label for="vendorWatsapp-2">
                                Watsapp Number-2
                                <input
                                    type="text"
                                    name="whatsapp1"
                                    id="vendorWatsapp-2"
                                    placeholder="Enter your whatsapp number"
                                    v-model="sendProfile.whatsapp1"
                                    required
                                />
                                <span
                                    v-if="errors && errors.whatsapp1"
                                    class="errMsg"
                                    >{{ errors.whatsapp1[0] }}</span
                                >
                            </label> -->
                        </div>

                        <!-- <div class="vendor-address-form-fields">
                            <label for="vendorComplexName">
                                Complex Name
                                <input
                                    type="text"
                                    name="complex"
                                    id="vendorComplexName"
                                    placeholder="Enter your complex name"
                                    v-model="sendProfile.complex"
                                    required
                                />
                                <span
                                    v-if="errors && errors.complex"
                                    class="errMsg"
                                    >{{ errors.complex[0] }}</span
                                >
                            </label>
                            <label for="vendorArea">
                                Area
                                <input
                                    type="text"
                                    name="area"
                                    id="vendorArea"
                                    placeholder="Enter your area name"
                                    v-model="sendProfile.area"
                                    required
                                />
                                <span
                                    v-if="errors && errors.area"
                                    class="errMsg"
                                    >{{ errors.area[0] }}</span
                                >
                            </label>
                            <label for="vendorDistrict">
                                District
                                <input
                                    type="text"
                                    name="district"
                                    id="vendorDistrict"
                                    placeholder="Enter your district name"
                                    v-model="sendProfile.district"
                                    required
                                />
                                <span
                                    v-if="errors && errors.district"
                                    class="errMsg"
                                    >{{ errors.district[0] }}</span
                                >
                            </label>
                            <label for="vendorZipCode">
                                Zip Code
                                <input
                                    type="text"
                                    name="zipcode"
                                    id="vendorZipCode"
                                    placeholder="Enter your zip code"
                                    v-model="sendProfile.zipcode"
                                    required
                                />
                                <span
                                    v-if="errors && errors.zipcode"
                                    class="errMsg"
                                    >{{ errors.zipcode[0] }}</span
                                >
                            </label>
                            <label for="vendorState">
                                State
                                <input
                                    type="text"
                                    name="state"
                                    id="vendorState"
                                    placeholder="Enter your state name"
                                    v-model="sendProfile.state"
                                    required
                                />
                                <span
                                    v-if="errors && errors.state"
                                    class="errMsg"
                                    >{{ errors.state[0] }}</span
                                >
                            </label>
                            <label for="vendorCountry">
                                Country
                                <input
                                    type="text"
                                    name="country"
                                    id="vendorCountry"
                                    placeholder="Enter your country name"
                                    v-model="sendProfile.country"
                                    required
                                />
                                <span
                                    v-if="errors && errors.country"
                                    class="errMsg"
                                    >{{ errors.country[0] }}</span
                                >
                            </label>
                        </div> -->

                        <div class="ven-profile-form-submit">
                            <button
                                v-if="exist != '1'"
                                id="pprofilebtn"
                                :disabled="pprofileDisabled"
                                type="submit"
                            >
                                Submit
                            </button>
                            <button
                                v-else
                                style="display: none"
                                id="pprofilebtn"
                                :disabled="pprofileDisabled"
                                type="submit"
                            >
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <flashMessage :message="message"></flashMessage>
        <div v-if="loader" class="form-upload-spinner form-upload-vue">
            <svg
                width="30"
                height="20"
                viewBox="0 0 20 15"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    d="M3.54979 1.3875C-2.63254 5.39784 5.09979 11.4625 9.74979 13.7875C14.3998 13.0125 22.1498 4.48748 16.7248 1.3875C14.546 0.142315 11.2998 2.1625 9.74979 3.7125C8.19979 2.42084 5.11741 0.370628 3.54979 1.3875Z"
                    fill="#FF5BFF"
                    stroke="#FF5BFF"
                    stroke-width="1.55"
                />
            </svg>
            <div>
                <svg
                    width="70"
                    height="68"
                    viewBox="0 0 49 47"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M46.83 23.75C46.83 35.3256 37.1128 44.83 24.975 44.83C12.8371 44.83 3.11995 35.3256 3.11995 23.75C3.11995 12.1744 12.8371 2.67 24.975 2.67C37.1128 2.67 46.83 12.1744 46.83 23.75Z"
                        stroke="white"
                        stroke-width="4.34"
                    />
                </svg>
                <svg
                    width="70"
                    height="68"
                    viewBox="0 0 49 47"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M46.83 23.75C46.83 35.3256 37.1128 44.83 24.975 44.83C12.8371 44.83 3.11995 35.3256 3.11995 23.75C3.11995 12.1744 12.8371 2.67 24.975 2.67C37.1128 2.67 46.83 12.1744 46.83 23.75Z"
                        stroke="white"
                        stroke-width="4.34"
                    />
                </svg>
            </div>
        </div>
    </div>
</template>

<script>
import flashMessage from "../../FlashMessage.vue";
export default {
    components: {
        flashMessage,
    },
    props: [
        "loggedIn",
        "vendorId",
        "exists",
        "cexists",
        "profile",
        "company",
        "cats",
        "services",
        "cities",
        "categories",
        "servicesSelected",
    ],
    data() {
        return {
            loader: false,
            companyProfile:
                this.company != null
                    ? this.company
                    : {
                          companyname: null,
                          companyinfo: null,
                          address: null,
                          map: null,
                          latitude: null,
                          longitude: null,
                          establish: null,
                          vendor_id: this.vendorId,
                          gst: null,
                          phone: null,
                          mobile: null,
                          email: null,
                          // cmobile1: null,
                          whatsup: null,
                          location_id: null,
                      },
            sendProfile:
                this.profile != null
                    ? this.profile
                    : {
                          // area: null,
                          // complex: null,
                          // country: null,
                          // district: null,
                          email: null,
                          firstname: null,
                          desgination: null,
                          landline: null,
                          lastname: null,
                          mobile: null,
                          //mobile1: null,
                          //state: null,
                          vendor_id: this.vendorId,
                          whatsapp: null,
                          //whatsapp1: null,
                          //zipcode: null,
                      },
            sendProfile_imageOne: null,
            companyProfile_logo: null,
            exist: this.exists,
            cexist: this.cexists,
            profileId: null,
            companyId: null,
            vendorProfile: {},
            vendorDetails: this.loggedIn,
            errors: null,
            sendCategory: [],
            sendService: [],
            catId: this.categories,
            serviceId: this.servicesSelected,
            errors: null,
            defaultCategories: null,
            locationMaster: null,
            message: null,
            cprofileDisabled: false,
            pprofileDisabled: false,
            pedit: false,
            cedit: false,
            personalfileOpen: false,
            profilePicPreview: null,
            companyPicPreview: null,
            profileDataSubmitted: false,
            companyDataSubmitted: false,
        };
    },
    methods: {
        uploadImg(e, type) {
            if (type == "profile") {
                this.sendProfile_imageOne = e.target.files[0];
                this.profilePicPreview = URL.createObjectURL(
                    this.sendProfile_imageOne
                );
                if (this.sendProfile.imageOne) {
                    delete this.sendProfile.imageOne;
                }
            }

            if (type == "company") {
                this.companyProfile_logo = e.target.files[0];
                this.companyPicPreview = URL.createObjectURL(
                    this.companyProfile_logo
                );
                if (this.companyProfile.imageOne) {
                    delete this.companyProfile.imageOne;
                }
            }
        },
        editForm(e) {
            let id = e.currentTarget.parentElement.parentElement.id;
            $(`#${id} .ven-profile-form-submit button[type=submit]`).css(
                "display",
                "block"
            );
            $(`#${id} input`).removeAttr("disabled");
            $("#vendor-logo").removeAttr("required");
            $("#company-logo").removeAttr("required");
            $(`#${id} input`).eq(1).focus();
            if (id == "vendor-details") {
                this.pedit = true;
                this.pprofileDisabled = false;
            }
            if (id == "company-details") {
                this.cedit = true;
                this.cprofileDisabled = false;
            }
        },
        toggleForm(e, bool) {
            //console.log(bool);
            this.errors = null;
            let id = null;
            if (bool == true) {
                id = e.currentTarget.dataset.id;
            }
            if (bool == false) {
                id = e;
            }
            const btns = document.querySelectorAll(".tab-btn");
            const articles = document.querySelectorAll(".content");
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
            document.getElementById(id).classList.add("active");
        },
        submitProfile(e) {
            var _this = this;
            _this.errors = null;
            this.pprofileDisabled = true;
            const config = {
                headers: { "content-type": "multipart/form-data" },
            };
            if (this.sendProfile?.deleted_at) {
                delete this.sendProfile.deleted_at;
            }
            if (this.sendProfile?.created_at) {
                delete this.sendProfile.created_at;
            }
            if (this.sendProfile?.updated_at) {
                delete this.sendProfile.updated_at;
            }
            let formData = new FormData();
            let data = JSON.stringify(_this.sendProfile);
            formData.append("type", "personal");
            let img = this.sendProfile_imageOne;
            formData.append("avatar", img);
            formData.append("data", data);
            this.loader = true;
            if (this.pedit) {
                formData.append("_method", "PATCH");
                formData.append("type", "personal");
                //delete this.sendProfile.avatar;
                let updateId = this.sendProfile.id;
                if (this.profileId != null) {
                    updateId = parseInt(this.profileId);
                }
                axios
                    .post(
                        `/vendor/vendor/${_this.loggedIn.slug}/profile/${updateId}`,
                        formData,
                        config
                    )
                    .then(function (response) {
                        _this.loader = false;
                        _this.message = "Profile updated";
                        _this.exist = 1;
                        _this.updateEdit();
                        $(
                            `#vendor-details .ven-profile-form-submit button[type=submit]`
                        ).css("display", "none");
                        setTimeout(function () {
                            _this.message = null;
                            window.location.href =
                                "/vendor/vendor/" +
                                _this.vendorDetails.slug +
                                "/servicesnew";
                        }, 3000);
                    })
                    .catch((error) => {
                        this.pprofileDisabled = false;
                        _this.loader = false;
                        _this.errors = error.response.data.errors;
                        console.log(error.response.data.errors);
                    });
                return;
            }
            axios
                .post(
                    `/vendor/vendor/${_this.loggedIn.slug}/profile`,
                    formData,
                    config
                )
                .then(function (response) {
                    console.log(response.data);
                    window.location.href =
                        "/vendor/vendor/" +
                        _this.vendorDetails.slug +
                        "/servicesnew";
                })
                .catch((error) => {
                    this.pprofileDisabled = false;
                    _this.loader = false;
                    _this.errors = error.response.data.errors;
                });
        },
        submitCProfile(e) {
            var _this = this;
            _this.errors = null;
            this.cprofileDisabled = true;
            this.catId.forEach(function (item) {
                _this.sendCategory.push({
                    category_id: item,
                    vendor_id: _this.vendorId,
                });
            });
            this.serviceId.forEach(function (item) {
                _this.sendService.push({
                    service_master_id: item,
                    vendor_id: _this.vendorId,
                });
            });
            //this.companyProfile.vendor_id = _this.vendorId;
            const config = {
                headers: { "content-type": "multipart/form-data" },
            };
            if (this.companyProfile?.deleted_at) {
                delete this.companyProfile.deleted_at;
            }
            if (this.companyProfile?.created_at) {
                delete this.companyProfile.created_at;
            }
            if (this.companyProfile?.updated_at) {
                delete this.companyProfile.updated_at;
            }
            let formData = new FormData();
            let data = JSON.stringify(_this.companyProfile);
            let cats = JSON.stringify(_this.sendCategory);
            let services = JSON.stringify(_this.sendService);
            let img = this.companyProfile_logo;
            formData.append("type", "company");
            formData.append("companyimg", img);
            formData.append("data", data);
            formData.append("categories", cats);
            //formData.append("services", services);
            this.loader = true;
            if (this.cedit) {
                formData.append("_method", "PATCH");
                let updateId = this.companyProfile.id;
                if (this.companyId != null) {
                    updateId = this.companyId;
                }
                axios
                    .post(
                        `/vendor/vendor/${_this.loggedIn.slug}/profile/${updateId}`,
                        formData,
                        config
                    )
                    .then(function (response) {
                        _this.loader = false;
                        _this.toggleForm("vendor-details", false);
                        _this.personalfileOpen = true;
                        _this.message = "Company Profile updated";
                        _this.updateEdit();
                        $(
                            `#company-details .ven-profile-form-submit button[type=submit]`
                        ).css("display", "none");
                        _this.companyId = response.data;
                        setTimeout(function () {
                            _this.message = null;
                        }, 3000);
                    })
                    .catch((error) => {
                        this.cprofileDisabled = false;
                        _this.loader = false;
                        _this.errors = error.response.data.errors;
                        console.log(error.response.data.errors);
                    });
                return;
            }
            axios
                .post(
                    `/vendor/vendor/${_this.loggedIn.slug}/profile`,
                    formData,
                    config
                )
                .then(function (response) {
                    _this.loader = false;
                    _this.toggleForm("vendor-details", false);
                    _this.personalfileOpen = true;
                    _this.companyProfile_logo = null;
                    _this.message = "Company Profile Uploaded";
                    _this.cexist = 1;
                    _this.updateEdit();
                    _this.companyId = response.data;
                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                })
                .catch((error) => {
                    //console.log(error);
                    this.cprofileDisabled = false;
                    _this.loader = false;
                    _this.errors = error.response.data.errors;
                    //console.log(error.response.data.errors);
                });
        },
        // getvendorprofile() {
        //     var _this = this;
        //     var v = this.vendorId;
        //     axios
        //         .get(`/vendorsProfile/${v}`)
        //         .then(function (response) {
        //             console.log(response.data);
        //             _this.vendorDetails = response.data[0];
        //             //_this.locationMaster = response.data[2];
        //             if (response.data[1]) {
        //                 _this.sendProfile = response.data[1];
        //                 delete _this.sendProfile.created_at;
        //                 delete _this.sendProfile.deleted_at;
        //                 delete _this.sendProfile.updated_at;
        //             }
        //             if (response.data[3]) {
        //                 _this.companyProfile = response.data[3];
        //                 delete _this.companyProfile.created_at;
        //                 delete _this.companyProfile.deleted_at;
        //                 delete _this.companyProfile.updated_at;
        //             }
        //             if (response.data[4]) {
        //                 //_this.catId = response.data[4];
        //                 _this.catId = [
        //                     ...new Set(response.data[4].map((item) => item.id)),
        //                 ];
        //             }
        //         })
        //         .catch((errors) => {
        //             console.log("Get All: " + errors);
        //         });
        // },
        // getvendorcategories() {
        //     var _this = this;
        //     axios
        //         .get(`/wedding/vendorMasterList`)
        //         .then(function (response) {
        //             _this.defaultCategories = response.data.filter(function (
        //                 el
        //             ) {
        //                 return el.parent_id == null;
        //             });
        //         })
        //         .catch((errors) => {
        //             console.log("Get All: " + errors);
        //         });
        // },
        drago(e) {
            e.preventDefault();
            let dragTest = document.querySelector(
                "#vendor-preview-upload-dragtext"
            );

            if ((e.currentTarget.className = "dropzone")) {
                e.currentTarget.style.opacity = "0";
                dragTest.textContent = "Drop File to Upload";
            }
        },
        dragl(e) {
            if ((e.currentTarget.className = "dropzone")) {
                let dragTest = document.querySelector(
                    "#vendor-preview-upload-dragtext"
                );
                dragTest.textContent = "";
                e.currentTarget.style.opacity = "1";
            }
        },
        dragdrop(e) {
            let dragTest = document.querySelector(
                "#vendor-preview-upload-dragtext"
            );
            dragTest.textContent = "";
            e.currentTarget.style.opacity = "1";
            let file = e.dataTransfer.files;
            let number = file.length;
            e.currentTarget.lastElementChild.textContent =
                number + " files uploaded";
        },
        count(e) {
            let dropZone = document.querySelector(
                "#vendor-preview-upload-dropzone"
            );
            dropZone.lastElementChild.textContent =
                e.target.files.length + " files uploaded";
        },
        updateEdit() {
            if (this.exist == 1) {
                //console.log($("#vendor-details input"));
                $("#vendor-details input").attr("disabled", true);
                this.pprofileDisabled = true;
            }
            if (this.cexist == 1) {
                //console.log($("#company-details input"));
                $("#company-details input").attr("disabled", true);
                this.cprofileDisabled = true;
                if (this.exist == 0) {
                    this.toggleForm("vendor-details", false);
                    this.personalfileOpen = true;
                }
            }
        },
    },
    mounted() {
        this.$nextTick(function () {
            //  this.getvendorprofile();
            //  this.getvendorcategories();
            this.updateEdit();
        });
    },
};
</script>

<style scoped>
.form-upload-vue {
    display: block !important;
}
.blur {
    filter: blur(2px);
    pointer-events: none;
}
.shake {
    animation: shake 1s linear infinite both alternate;
    transform: translate3d(0, 0, 0);
}
.v-enter-active,
.v-leave-active {
    transition: opacity 0.15s linear;
}
.v-enter-from,
.v-leave-to {
    opacity: 0;
}
.vendor-preview-upload {
    border: 0.162319px solid #959595;
    box-sizing: border-box;
    border-radius: 8.11594px;
    grid-column-start: 1;
    grid-column-end: -1;
    padding: 1.5em;
}
.vendor-preview-upload > label {
    background: #efefef;
    border-radius: 4.05797px;
    width: 100%;
    cursor: pointer;
    position: relative;
}
#vendor-preview-upload-dropzone {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 2em;
}
#vendor-preview-upload-dropzone > span:nth-child(1) {
    width: 45px;
    height: 45px;
    background: #dfdfdf;
    border-radius: 50%;
    margin-bottom: 5px;
}
#vendor-preview-upload-dropzone > span:nth-child(1) > img {
    width: 21px;
    height: 21px;
    margin-top: 12px;
    margin-left: 12px;
}
#vendor-preview-upload-dropzone > span:nth-child(2) {
    font-family: Poppins;
    font-style: normal;
    font-weight: 500;
    font-size: 9.58349px;
    line-height: 14px;
    color: #000000;
    margin-bottom: 5px;
}
#vendor-preview-upload-dropzone > span:nth-child(3) {
    font-family: Poppins;
    font-style: normal;
    font-weight: 300;
    font-size: 6.59415px;
    line-height: 10px;
    color: #7c7c7c;
}
#vendor-preview-upload-dragtext {
    font-family: Segoe UI;
    font-style: normal;
    font-weight: 600;
    font-size: 17.1823px;
    line-height: 18px;
    text-align: center;
    text-transform: capitalize;
    color: #461952;
    position: absolute;
    top: 45%;
    left: 32%;
    pointer-events: none;
}
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
.tab-btn {
    border: none;
    display: block;
    background: white;
    cursor: pointer;
    background: linear-gradient(0deg, #ffffff, #ffffff),
        linear-gradient(0deg, #c4456f, #c4456f), #c4456f;
    border-radius: 58.0689px;
    width: 32px;
    height: 4px;
    margin: 0 3px;
    box-shadow: 0px 0px 3px 1.5px #888888;
}

.content {
    display: none;
}

.tab-btn.active {
    background: #461952;
    color: white !important;
    background: linear-gradient(0deg, #c4456f, #c4456f),
        linear-gradient(0deg, #c4456f, #c4456f), #c4456f;
    border-radius: 58.0689px;
    box-shadow: none;
}

.content.active {
    display: block;
}
.ven-profile-form {
    background: rgba(255, 255, 255, 0.8);
    box-shadow: 1.97875px 1.97875px 1.97875px rgba(224, 219, 219, 0.25);
    border-radius: 21.0451px;
    margin-top: 5em;
    position: relative;
}
#ven-profile-form-head {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 900;
    font-size: 21.9267px;
    line-height: 28px;
    text-align: center;
    text-transform: uppercase;
    color: #461952;
    text-shadow: 0px 1.51414px 1.51414px rgba(0, 0, 0, 0.25);
    margin: 2em 0 0.5em 0;
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
    border-radius: 50%;
}
.vendor-logo-upload > label > span:nth-child(2) {
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
    font-weight: 500;
    font-size: 17.1823px;
    line-height: 18px;
    text-align: center;
    text-transform: capitalize;
    color: #461952;
    margin-top: 1em;
}
#company-details > h1 {
    font-family: Segoe UI;
    font-style: normal;
    font-weight: 500;
    font-size: 17.1823px;
    line-height: 18px;
    text-align: center;
    text-transform: capitalize;
    color: #461952;
    margin-top: 1em;
}
.vendor-details-form-fields {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    grid-auto-rows: max-content;
    column-gap: 12px;
    row-gap: 4px;
}
.vendor-details-form-fields > label {
    display: flex;
    flex-direction: column;
    background: #ffffff;
    border: 0.528708px solid #e9e9e9;
    border-radius: 5.28708px;

    box-sizing: border-box;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 600;
    font-size: 14.23896px;
    line-height: 16px;

    color: #c4456f;
    padding: 10px 20px;
}
.vendor-details-form-fields > label > input {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 600;
    font-size: 12.23896px;
    line-height: 16px;

    color: #afa5a5;
    outline: none;
    border: 0;
    margin: 5px 0;
    background-color: transparent !important;
}

.vendor-address-form-fields {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
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
    border: 0.528708px solid #e9e9e9;
    border-radius: 5.28708px;

    box-sizing: border-box;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 600;
    font-size: 14.23896px;
    line-height: 16px;

    color: #c4456f;
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
    font-family: "Poppins";
    font-style: normal;
    font-weight: 600;
    font-size: 12.23896px;
    line-height: 16px;

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

.ven-profile-form-submit {
    position: relative;
    margin: 1.5em 0;
    padding: 4.5em;
    padding-right: 0;
    display: flex;
    justify-content: flex-end;
}

.ven-profile-form-submit > button:nth-child(1) {
    background: #c4456f;
    box-shadow: 0px 0px 4px 1px rgba(0, 0, 0, 0.25);
    border-radius: 5.53571px;
    padding: 7px 30px;
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
.ven-profile-form-submit > button:nth-child(2) {
    background: rgba(255, 255, 255, 0.8);
    box-shadow: 0px 2.80602px 2.80602px rgba(0, 0, 0, 0.25);
    outline: none;
    border: 0;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    margin-left: 15px;
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
