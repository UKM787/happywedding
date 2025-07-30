<template>
    <div>
        <Services
            @clickedAdd="showForm('scroll', true)"
            @edit="editForm($event)"
            @deleted="form = false"
            :vendorCat="this.selectedSubCat"
            :url="'venues'"
            :vendor="this.vendor"
            :added="this.added"
            ref="services"
        ></Services>
        <div
            style="position: relative"
            v-show="form"
            ref="scroll"
            class="container ven-profile-form"
        >
            <div class="row">
                <h2 id="ven-profile-form-head">
                    {{ selectedSubCat.name }} Form
                </h2>
                <!-- <div class="vendor-logo-upload">
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
                </div> -->
            </div>
            <div :class="[loader ? 'blur row about' : 'row about']">
                <div class="btn-container">
                    <button
                        type="button"
                        class="tab-btn active"
                        data-id="vendor-details"
                        title="Venue Details"
                        @click="toggleForm($event, true)"
                    ></button>
                    <button
                        type="button"
                        class="tab-btn active"
                        data-id="contact-details"
                        title="Venue contact Details"
                        @click="toggleForm($event, true)"
                    ></button>
                    <button
                        type="button"
                        class="tab-btn"
                        data-id="vendor-add-party-area"
                        title="Add Party Area"
                        @click="toggleForm($event, true)"
                    ></button>
                    <button
                        type="button"
                        class="tab-btn"
                        data-id="vendor-about"
                        title="Gallery"
                        @click="toggleForm($event, true)"
                    ></button>
                    <button
                        type="button"
                        class="tab-btn"
                        data-id="vendor-add-space"
                        title="Policies and Amenities"
                        @click="toggleForm($event, true)"
                    ></button>
                    <button
                        type="button"
                        class="tab-btn"
                        data-id="price-policy"
                        title="Price and Policy"
                        @click="toggleForm($event, true)"
                    ></button>
                </div>
                <div class="about-content forms">
                    <form
                        @submit.prevent="submitForm1($event)"
                        class="content active"
                        id="vendor-details"
                        data-id="contact-details"
                    >
                        <h1>Venue details</h1>
                        <div
                            v-if="formEdit.form1"
                            style="display: flex; justify-content: flex-end"
                            class="editbtn"
                        >
                            <button
                                class="shake"
                                @click="enableFeilds($event)"
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
                        <div
                            style="grid-template-columns: repeat(4, 1fr)"
                            class="vendor-details-form-fields"
                        >
                            <label for="accName">
                                Venue Name
                                <input
                                    type="text"
                                    name="vendorFirstName"
                                    id="vendorFirstName"
                                    placeholder="Enter venue name"
                                    v-model="addVenue.name"
                                />
                                <span
                                    v-if="errors && errors.name"
                                    class="errMsg"
                                    >{{ errors.name[0] }}</span
                                >
                            </label>
                            <!-- <label for="accType">
                                Venue type
                                <select
                                    v-model="addVenue.category_id"
                                    name="accType"
                                    id="accType"
                                    style="margin-top: 10px; padding: 10px"
                                >
                                    <option :value="selectedSubCat.id">
                                        {{ selectedSubCat.name }}
                                    </option>
                                </select>
                                <span
                                    v-if="errors && errors.category_id"
                                    class="errMsg"
                                    >{{ errors.category_id[0] }}</span
                                >
                            </label> -->
                            <!-- <input
                                type="hidden"
                                name="category_id"
                                :value="selectedSubCat.id"
                            /> -->
                            <label for="accType">
                                Services
                                <select
                                    name="vendorCategories"
                                    id="vendorCategories"
                                    v-model="serviceId"
                                    multiple
                                    style="margin-top: 10px; padding: 10px"
                                >
                                    <option hidden disabled selected>
                                        Select vendor’s category
                                    </option>
                                    <option
                                        v-for="item in services"
                                        :key="item.id"
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
                            </label>
                        </div>
                        <div class="vendor-preview-form-fields">
                            <label for="vendorAbout">
                                About
                                <textarea
                                    name="vendorAbout"
                                    id="vendorAbout"
                                    rows="10"
                                    v-model="addVenue.description"
                                ></textarea>
                                <span
                                    v-if="errors && errors.description"
                                    class="errMsg"
                                    >{{ errors.description[0] }}</span
                                >
                            </label>
                            <label class="tooltipp" for="vendorFeatures">
                                <span class="tooltipptext"
                                    >Press Enter to add features!!</span
                                >
                                Features
                                <textarea
                                    name="vendorFeatures"
                                    id="vendorFwatures"
                                    rows="10"
                                    @keydown.enter.prevent="addfeatures($event)"
                                ></textarea>
                                <ul v-if="addVenue.features != null">
                                    <li
                                        v-for="(
                                            item, index
                                        ) in addVenue.features"
                                        :key="index"
                                    >
                                        {{ item }}
                                    </li>
                                </ul>
                                <span
                                    v-if="errors && errors.features"
                                    class="errMsg"
                                    >{{ errors.features[0] }}</span
                                >
                            </label>
                        </div>
                        <div
                            style="grid-template-columns: repeat(4, 1fr)"
                            class="vendor-address-form-fields"
                        >
                            <label for="Instagram_Profile_link">
                                Instagram Profile link
                                <input
                                    type="text"
                                    name="Instagram_Profile_link"
                                    id="Instagram_Profile_link"
                                    placeholder="Insert instagram link"
                                    v-model="addVenue.instagram_link"
                                />
                                <span
                                    v-if="errors && errors.instagram_link"
                                    class="errMsg"
                                    >{{ errors.instagram_link[0] }}</span
                                >
                            </label>
                            <label for="Twitter_Profile_link">
                                Twitter Profile link
                                <input
                                    type="text"
                                    name="Twitter_Profile_link"
                                    id="Twitter_Profile_link"
                                    placeholder="Insert Twitter link"
                                    v-model="addVenue.twitter_link"
                                />
                                <span
                                    v-if="errors && errors.twitter_link"
                                    class="errMsg"
                                    >{{ errors.twitter_link[0] }}</span
                                >
                            </label>
                            <label for="Snapchat_Profile_link">
                                Snapchat Profile link
                                <input
                                    type="text"
                                    name="Snapchat_Profile_link"
                                    id="Snapchat_Profile_link"
                                    placeholder="Insert Snapchat link"
                                    v-model="addVenue.snapchat_link"
                                />
                                <span
                                    v-if="errors && errors.snapchat_link"
                                    class="errMsg"
                                    >{{ errors.snapchat_link[0] }}</span
                                >
                            </label>
                            <label for="Facebook_Profile_link">
                                Facebook Profile link
                                <input
                                    type="text"
                                    name="Facebook_Profile_link"
                                    id="Facebook_Profile_link"
                                    placeholder="Insert facebook link"
                                    v-model="addVenue.facebook_link"
                                />
                                <span
                                    v-if="errors && errors.facebook_link"
                                    class="errMsg"
                                    >{{ errors.facebook_link[0] }}</span
                                >
                            </label>
                        </div>
                        <div class="ven-profile-form-submit">
                            <button
                                v-if="formSubmitted.form1 == false"
                                type="submit"
                            >
                                Submit
                            </button>
                            <button style="display: none" v-else type="submit">
                                Update
                            </button>
                            <button
                                data-id="contact-details"
                                @click="toggleForm($event, true)"
                                type="button"
                            >
                                <img src="/assets/vendors/Frame.svg" alt="" />
                            </button>
                        </div>
                    </form>
                    <form
                        @submit.prevent="submitForm2($event)"
                        class="content active"
                        id="contact-details"
                        data-id="vendor-add-party-area"
                    >
                        <h1>Venue contact details</h1>
                        <div
                            v-if="formEdit.form2"
                            style="display: flex; justify-content: flex-end"
                            class="editbtn"
                        >
                            <button
                                class="shake"
                                @click="enableFeilds($event)"
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
                            <label
                                style="
                                    grid-column-start: 1;
                                    grid-column-end: -1;
                                "
                                for="accAddress"
                            >
                                Address Line 1
                                <input
                                    type="text"
                                    name="accAddress"
                                    id="accAddress"
                                    placeholder="Enter address"
                                    v-model="venueContact.address"
                                />
                                <span
                                    v-if="errors && errors.address"
                                    class="errMsg"
                                    >{{ errors.address[0] }}</span
                                >
                            </label>
                            <label for="accstate">
                                State
                                <select
                                    v-model="venueContact.state"
                                    name="accstate"
                                    id="accstate"
                                    style="margin-top: 10px; padding: 10px"
                                    @change="getDistricts($event)"
                                >
                                    <option hidden disabled selected>
                                        Select vendor’s category
                                    </option>
                                    <option
                                        v-for="(item, index) in states"
                                        :key="item.name"
                                        :value="item.name"
                                    >
                                        {{ item?.name }}
                                    </option>
                                </select>
                                <span
                                    v-if="errors && errors.state"
                                    class="errMsg"
                                    >{{ errors.state[0] }}</span
                                >
                            </label>
                            <label for="accdistrict">
                                District
                                <select
                                    v-model="venueContact.location_id"
                                    name="accdistrict"
                                    id="accdistrict"
                                    style="margin-top: 10px; padding: 10px"
                                >
                                    <option hidden disabled selected>
                                        Select vendor’s category
                                    </option>
                                    <option
                                        v-for="(item, index) in district"
                                        :key="index"
                                        :value="item.id"
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
                            <label for="vendorpinCode">
                                Pin Code
                                <input
                                    type="text"
                                    name="vendorpinCode"
                                    id="vendorpinCode"
                                    placeholder="Enter pin code"
                                    v-model="venueContact.pincode"
                                />
                                <span
                                    v-if="errors && errors.pincode"
                                    class="errMsg"
                                    >{{ errors.pincode[0] }}</span
                                >
                            </label>
                        </div>
                        <div class="vendor-address-form-fields">
                            <!-- <label for="accaddress">
                                Address Line 2
                                <input
                                    type="text"
                                    name="accaddress"
                                    id="accaddress"
                                    placeholder="Enter address"
                                    
                                    v-model="venueContact.area"
                                />
                                <span
                                    v-if="errors && errors.area"
                                    class="errMsg"
                                    >{{ errors.area[0] }}</span
                                >
                            </label> -->
                            <!-- <label for="vendorCountry">
                                Country
                                <input
                                    type="text"
                                    name="vendorCountry"
                                    id="vendorCountry"
                                    placeholder="Enter country name"
                                    
                                    v-model="addVenue.country"
                                />
                                <span
                                    v-if="errors && errors.country"
                                    class="errMsg"
                                    >{{ errors.country[0] }}</span
                                >
                            </label> -->
                            <label for="acclatitude">
                                Latitude
                                <input
                                    type="text"
                                    name="acclatitude"
                                    id="acclatitude"
                                    placeholder="Enter latitude"
                                    v-model="venueContact.latitude"
                                />
                                <span
                                    v-if="errors && errors.latitude"
                                    class="errMsg"
                                    >{{ errors.latitude[0] }}</span
                                >
                            </label>
                            <label for="acclongitude">
                                Longitude
                                <input
                                    type="text"
                                    name="acclongitude"
                                    id="acclongitude"
                                    placeholder="Enter longitude"
                                    v-model="venueContact.longitude"
                                />
                                <span
                                    v-if="errors && errors.longitude"
                                    class="errMsg"
                                    >{{ errors.longitude[0] }}</span
                                >
                            </label>
                            <label
                                style="position: relative"
                                for="vendorLocationLink"
                            >
                                Map Link
                                <input
                                    type="text"
                                    name="vendorLocationLink"
                                    id="vendorLocationLink"
                                    placeholder="Add location link"
                                    v-model="venueContact.map"
                                />
                                <button type="button" id="location-link">
                                    <img
                                        src="/assets/vendors/dashboard/location-icon.svg"
                                        alt=""
                                    />
                                    Insert Link
                                </button>
                                <span
                                    v-if="errors && errors.map"
                                    class="errMsg"
                                    >{{ errors.map[0] }}</span
                                >
                            </label>
                        </div>
                        <div
                            style="grid-template-columns: repeat(4, 1fr)"
                            class="vendor-address-form-fields"
                        >
                            <label for="accPhone1">
                                Landline Number
                                <input
                                    type="text"
                                    name="accPhone1"
                                    id="accPhone1"
                                    placeholder="Enter venue landline number"
                                    v-model="venueContact.landline"
                                />
                                <span
                                    v-if="errors && errors.landline"
                                    class="errMsg"
                                    >{{ errors.landline[0] }}</span
                                >
                            </label>
                            <label for="accPhone2">
                                Phone Number - 2
                                <input
                                    type="text"
                                    name="accPhone2"
                                    id="accPhone2"
                                    placeholder="Enter venue contact number"
                                    v-model="venueContact.number_2"
                                />
                                <span
                                    v-if="errors && errors.number_2"
                                    class="errMsg"
                                    >{{ errors.number_2[0] }}</span
                                >
                            </label>
                            <label for="accPhone1">
                                Watsapp Number
                                <input
                                    type="text"
                                    name="accPhone1"
                                    id="accPhone1"
                                    placeholder="Enter venue landline number"
                                    v-model="venueContact.watsapp"
                                />
                                <span
                                    v-if="errors && errors.watsapp"
                                    class="errMsg"
                                    >{{ errors.watsapp[0] }}</span
                                >
                            </label>
                            <label for="accPhone2">
                                Email
                                <input
                                    type="email"
                                    name="accPhone2"
                                    id="accPhone2"
                                    placeholder="Enter venue contact number"
                                    v-model="venueContact.email"
                                />
                                <span
                                    v-if="errors && errors.email"
                                    class="errMsg"
                                    >{{ errors.email[0] }}</span
                                >
                            </label>
                        </div>
                        <div class="ven-profile-form-submit">
                            <button
                                v-if="formSubmitted.form2 == false"
                                type="submit"
                            >
                                Submit
                            </button>
                            <button style="display: none" v-else type="submit">
                                Update
                            </button>
                            <button
                                data-id="vendor-add-party-area"
                                @click="toggleForm($event, true)"
                                type="button"
                            >
                                <img src="/assets/vendors/Frame.svg" alt="" />
                            </button>
                        </div>
                    </form>
                    <form
                        @submit.prevent="updateForm($event)"
                        @keydown.enter.prevent
                        class="content"
                        id="vendor-add-party-area"
                        data-id="vendor-about"
                    >
                        <h1>Add space</h1>

                        <div>
                            <div
                                v-for="(item, index) in partyPlaces"
                                :key="index"
                                style="flex-wrap: wrap"
                                class="vendor-add-party-area-single"
                            >
                                <div style="flex: 1; align-self: center">
                                    {{ item.name }}
                                </div>
                                <div
                                    style="
                                        flex: 1;
                                        display: flex;
                                        justify-content: flex-end;
                                    "
                                >
                                    <label for="seating">
                                        <span style="margin-bottom: 15px"
                                            >Seating</span
                                        >
                                        <input
                                            type="text"
                                            id="seating"
                                            name="poolseating"
                                            disabled
                                            v-model="item.Seating"
                                        />
                                        <span
                                            v-if="
                                                errors &&
                                                errors[
                                                    'data' +
                                                        '.' +
                                                        index +
                                                        '.' +
                                                        'Seating'
                                                ]
                                            "
                                            class="errMsg"
                                            >{{
                                                errors[
                                                    "data" +
                                                        "." +
                                                        index +
                                                        "." +
                                                        "Seating"
                                                ][0]
                                            }}</span
                                        >
                                    </label>
                                    <label for="maxpool">
                                        <span style="margin-bottom: 15px"
                                            >Maximum capacity</span
                                        >
                                        <input
                                            type="text"
                                            id="maxpool"
                                            name="maxpool"
                                            disabled
                                            v-model="item['Maximum capacity']"
                                        />
                                        <span
                                            v-if="
                                                errors &&
                                                errors[
                                                    'data' +
                                                        '.' +
                                                        index +
                                                        '.' +
                                                        'Maximum capacity'
                                                ]
                                            "
                                            class="errMsg"
                                            >{{
                                                errors[
                                                    "data" +
                                                        "." +
                                                        index +
                                                        "." +
                                                        "Maximum capacity"
                                                ][0]
                                            }}</span
                                        >
                                    </label>
                                    <div>
                                        <button
                                            @click="
                                                editPartyArea($event, 'edit')
                                            "
                                            type="button"
                                        >
                                            <img
                                                src="/assets/vendors/venues/edit.svg"
                                                alt=""
                                            />
                                        </button>
                                        <!-- <button
                                            @click="
                                                editPartyArea(
                                                    $event,
                                                    'delete',
                                                    index
                                                )
                                            "
                                            type="button"
                                        >
                                            <img
                                                src="/assets/vendors/venues/delete.svg"
                                                alt=""
                                            />
                                        </button> -->
                                        <button
                                            @click="
                                                editPartyArea(
                                                    $event,
                                                    'save',
                                                    index
                                                )
                                            "
                                            type="button"
                                        >
                                            <img
                                                src="/assets/vendors/venues/saveform.svg"
                                                alt=""
                                            />
                                        </button>
                                    </div>
                                </div>
                                <div
                                    style="
                                        display: flex;
                                        width: 100%;
                                        flex-wrap: wrap;
                                    "
                                >
                                    <div
                                        style="
                                            width: 100%;
                                            display: flex;
                                            flex-wrap: wrap;
                                        "
                                        class="vendor-preview-upload"
                                    >
                                        <label
                                            style="width: 15%"
                                            :for="'vendorImagesUpload' + index"
                                        >
                                            <div
                                                id="vendor-preview-upload-dropzone"
                                                class="dropzone"
                                                @dragover.prevent="
                                                    drago($event)
                                                "
                                                @dragleave.prevent="
                                                    dragl($event)
                                                "
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
                                            <div
                                                id="vendor-preview-upload-dragtext"
                                            ></div>
                                            <input
                                                type="file"
                                                name="vendorImagesUpload"
                                                :id="
                                                    'vendorImagesUpload' + index
                                                "
                                                style="opacity: 0"
                                                multiple
                                                @change="
                                                    count($event);
                                                    uploadpartyImg(
                                                        $event,
                                                        index
                                                    );
                                                "
                                            />
                                        </label>
                                        <div
                                            v-for="(
                                                item, indexx
                                            ) in item.partyimagePreview"
                                            :key="indexx"
                                            style="
                                                display: flex;
                                                flex-direction: column;
                                                width: 15%;
                                            "
                                        >
                                            <img
                                                height="100%"
                                                :src="item"
                                                style="margin: 5px"
                                                alt=""
                                            />
                                            <span
                                                style="width: 100%"
                                                v-if="
                                                    errors &&
                                                    errors[
                                                        'data.' +
                                                            index +
                                                            '.uploadimg.' +
                                                            indexx
                                                    ]
                                                "
                                                class="errMsg"
                                                >{{
                                                    errors[
                                                        "data." +
                                                            index +
                                                            ".uploadimg." +
                                                            indexx
                                                    ][0]
                                                }}</span
                                            >
                                        </div>
                                        <div
                                            v-for="(
                                                item, indexx
                                            ) in item.partyvideoPreview"
                                            :key="'A' + indexx"
                                            style="
                                                display: flex;
                                                flex-direction: column;
                                                width: 15%;
                                            "
                                        >
                                            <video
                                                height="100%"
                                                :src="item"
                                                style="margin: 5px"
                                                controls
                                            >
                                                <source
                                                    src="movie.mp4"
                                                    type="video/mp4"
                                                />
                                            </video>
                                            <span
                                                style="width: 100%"
                                                v-if="
                                                    errors &&
                                                    errors[
                                                        'data.' +
                                                            index +
                                                            '.uploadvid.' +
                                                            indexx
                                                    ]
                                                "
                                                class="errMsg"
                                                >{{
                                                    errors[
                                                        "data." +
                                                            index +
                                                            ".uploadvid." +
                                                            indexx
                                                    ][0]
                                                }}</span
                                            >
                                        </div>
                                    </div>
                                    <div style="width: 100%">
                                        <div
                                            style="
                                                display: flex;
                                                flex-wrap: wrap;
                                            "
                                            v-if="item.img"
                                        >
                                            <div
                                                v-for="(
                                                    item, indexx
                                                ) in item.img"
                                                :key="indexx"
                                                style="
                                                    display: flex;
                                                    flex-direction: column;
                                                    width: 15%;
                                                    position: relative;
                                                "
                                            >
                                                <!-- <span
                                                    class="dlt-room-btn"
                                                    @click="
                                                        deleteImage(
                                                            'partyarea',
                                                            accomodation_id,
                                                            item,
                                                            indexx,
                                                            'image',
                                                            index
                                                        )
                                                    "
                                                >
                                                    <i class="fas fa-trash"></i>
                                                </span> -->
                                                <img
                                                    height="100%"
                                                    :src="
                                                        '/assets/vendors/uploads/' +
                                                        item
                                                    "
                                                    style="margin: 5px"
                                                    alt=""
                                                />
                                            </div>
                                        </div>
                                        <div
                                            style="
                                                display: flex;
                                                flex-wrap: wrap;
                                            "
                                            v-if="item.vid"
                                        >
                                            <div
                                                v-for="(
                                                    item, indexx
                                                ) in item.vid"
                                                :key="'A' + indexx"
                                                style="
                                                    display: flex;
                                                    flex-direction: column;
                                                    position: relative;
                                                    width: 15%;
                                                "
                                            >
                                                <!-- <span
                                                    class="dlt-room-btn"
                                                    @click="
                                                        deleteImage(
                                                            'partyarea',
                                                            accomodation_id,
                                                            item,
                                                            indexx,
                                                            'video',
                                                            index
                                                        )
                                                    "
                                                >
                                                    <i class="fas fa-trash"></i>
                                                </span> -->
                                                <video
                                                    height="100%"
                                                    :src="
                                                        '/assets/vendors/uploads/' +
                                                        item
                                                    "
                                                    style="
                                                        margin: 35px 5px 5px;
                                                        object-fit: cover;
                                                    "
                                                    controls
                                                >
                                                    <source
                                                        src="movie.mp4"
                                                        type="video/mp4"
                                                    />
                                                </video>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div>
                                        <div
                                            v-for="(
                                                item, indexx
                                            ) in item.imgpreview"
                                            :key="indexx"
                                            style="
                                                display: flex;
                                                flex-direction: column;
                                                width: 15%;
                                            "
                                        >
                                            <img
                                                height="100%"
                                                :src="item"
                                                style="margin: 5px"
                                                alt=""
                                            />
                                            <span
                                                v-if="
                                                    errors &&
                                                    errors[
                                                        'data.' +
                                                            index +
                                                            'img.' +
                                                            indexx
                                                    ]
                                                "
                                                class="errMsg"
                                                >{{
                                                    errors[
                                                        "data." +
                                                            index +
                                                            "img." +
                                                            indexx
                                                    ][0]
                                                }}</span
                                            >
                                        </div>
                                        <div
                                            v-for="(
                                                item, indexx
                                            ) in item.vidpreview"
                                            :key="'A' + indexx"
                                            style="
                                                display: flex;
                                                flex-direction: column;
                                                width: 15%;
                                            "
                                        >
                                            <video
                                                height="100%"
                                                :src="item"
                                                style="margin: 5px"
                                                controls
                                            >
                                                <source
                                                    src="movie.mp4"
                                                    type="video/mp4"
                                                />
                                            </video>
                                            <span
                                                v-if="
                                                    errors &&
                                                    errors[
                                                        'data.' +
                                                            index +
                                                            'vid.' +
                                                            indexx
                                                    ]
                                                "
                                                class="errMsg"
                                                >{{
                                                    errors[
                                                        "data." +
                                                            index +
                                                            "vid." +
                                                            indexx
                                                    ][0]
                                                }}</span
                                            >
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                            <form
                                @submit.prevent="editPartyArea($event, 'add')"
                                class="vendor-add-party-area-single"
                                style="flex-wrap: wrap"
                            >
                                <div style="flex: 1; align-self: center">
                                    Add party area
                                    <select
                                        name="party-area"
                                        id="party-area-add"
                                        v-model="addPartyPlace.name"
                                    >
                                        <option
                                            v-for="item in defaultPartyPlaces"
                                            :key="item"
                                            :value="item"
                                        >
                                            {{ item }}
                                        </option>
                                    </select>
                                    <span
                                        v-if="
                                            errors &&
                                            errors['data' + '.' + 'name']
                                        "
                                        class="errMsg"
                                        >{{
                                            errors["data" + "." + "name"][0]
                                        }}</span
                                    >
                                </div>
                                <div
                                    style="
                                        flex: 1;
                                        display: flex;
                                        justify-content: flex-end;
                                    "
                                >
                                    <label for="seating">
                                        <span style="margin-bottom: 15px"
                                            >Seating</span
                                        >
                                        <input
                                            type="text"
                                            id="seating"
                                            name="poolseating"
                                            class="addpartyhall"
                                            v-model="addPartyPlace.Seating"
                                        />
                                        <span
                                            v-if="
                                                errors &&
                                                errors['data' + '.' + 'Seating']
                                            "
                                            class="errMsg"
                                            >{{
                                                errors[
                                                    "data" + "." + "Seating"
                                                ][0]
                                            }}</span
                                        >
                                    </label>
                                    <label for="maxpool">
                                        <span style="margin-bottom: 15px"
                                            >Maximum capacity</span
                                        >
                                        <input
                                            type="text"
                                            id="maxpool"
                                            name="maxpool"
                                            class="addpartyhall"
                                            v-model="
                                                addPartyPlace[
                                                    'Maximum capacity'
                                                ]
                                            "
                                        />
                                        <span
                                            v-if="
                                                errors &&
                                                errors[
                                                    'data' +
                                                        '.' +
                                                        'Maximum capacity'
                                                ]
                                            "
                                            class="errMsg"
                                            >{{
                                                errors[
                                                    "data" +
                                                        "." +
                                                        "Maximum capacity"
                                                ][0]
                                            }}</span
                                        >
                                    </label>
                                    <div>
                                        <button
                                            style="width: 100%"
                                            type="submit"
                                        >
                                            Add
                                        </button>
                                    </div>
                                </div>
                                <div
                                    style="
                                        width: 100%;
                                        display: flex;
                                        flex-wrap: wrap;
                                    "
                                    class="vendor-preview-upload"
                                >
                                    <label
                                        style="width: 15%"
                                        for="vendorImagesUploadadd"
                                    >
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
                                        <div
                                            id="vendor-preview-upload-dragtext"
                                        ></div>
                                        <input
                                            type="file"
                                            name="vendorImagesUpload"
                                            id="vendorImagesUploadadd"
                                            style="opacity: 0"
                                            multiple
                                            @change="
                                                count($event);
                                                uploadpartyImg($event);
                                            "
                                        />
                                    </label>
                                    <div
                                        v-for="(
                                            item, index
                                        ) in partyimagePreview"
                                        :key="index"
                                        style="
                                            display: flex;
                                            flex-direction: column;
                                            width: 15%;
                                        "
                                    >
                                        <img
                                            height="100%"
                                            :src="item"
                                            style="margin: 5px"
                                            alt=""
                                        />
                                        <span
                                            style="width: 100%"
                                            v-if="
                                                errors &&
                                                errors[
                                                    'data.uploadimg.' + index
                                                ]
                                            "
                                            class="errMsg"
                                            >{{
                                                errors[
                                                    "data.uploadimg." + index
                                                ][0]
                                            }}</span
                                        >
                                    </div>
                                    <div
                                        v-for="(
                                            item, index
                                        ) in partyvideoPreview"
                                        :key="'A' + index"
                                        style="
                                            display: flex;
                                            flex-direction: column;
                                            width: 15%;
                                        "
                                    >
                                        <video
                                            height="100%"
                                            :src="item"
                                            style="margin: 5px"
                                            controls
                                        >
                                            <source
                                                src="movie.mp4"
                                                type="video/mp4"
                                            />
                                        </video>
                                        <span
                                            style="width: 100%"
                                            v-if="
                                                errors &&
                                                errors[
                                                    'data.uploadvid.' + index
                                                ]
                                            "
                                            class="errMsg"
                                            >{{
                                                errors[
                                                    "data.uploadvid." + index
                                                ][0]
                                            }}</span
                                        >
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="ven-profile-form-submit">
                            <!-- <button
                                v-if="formSubmitted.form3 == false"
                                type="submit"
                            >
                                Submit
                            </button>
                            <button style="display: none" v-else type="submit">
                                Update
                            </button> -->
                            <button
                                data-id="vendor-about"
                                @click="toggleForm($event, true)"
                                type="button"
                            >
                                <img src="/assets/vendors/Frame.svg" alt="" />
                            </button>
                        </div>
                    </form>
                    <form
                        data-id="vendor-add-space"
                        @submit.prevent="updateForm1($event)"
                        class="content"
                        id="vendor-about"
                    >
                        <h1>Gallery</h1>
                        <div
                            v-if="formEdit.form4"
                            style="display: flex; justify-content: flex-end"
                            class="editbtn"
                        >
                            <button
                                class="shake"
                                @click="enableFeilds($event)"
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
                        <div class="vendor-preview-form-fields">
                            <div class="vendor-preview-upload">
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
                                    <div
                                        id="vendor-preview-upload-dragtext"
                                    ></div>
                                    <input
                                        type="file"
                                        name="vendorImagesUpload"
                                        id="vendorImagesUpload"
                                        style="opacity: 0"
                                        multiple
                                        @change="
                                            count($event);
                                            uploadImg($event);
                                        "
                                    />
                                </label>
                                <div
                                    v-if="formEdit.form4 == false"
                                    style="display: flex; flex-wrap: wrap"
                                >
                                    <div
                                        v-for="(item, index) in imagePreview"
                                        :key="index"
                                        style="
                                            display: flex;
                                            flex-direction: column;
                                        "
                                    >
                                        <img
                                            width="200px"
                                            height="200px"
                                            :src="item"
                                            style="margin: 5px"
                                            alt=""
                                        />
                                        <span
                                            v-if="
                                                errors && errors['img.' + index]
                                            "
                                            class="errMsg"
                                            >{{
                                                errors["img." + index][0]
                                            }}</span
                                        >
                                    </div>
                                    <div
                                        v-for="(item, index) in videoPreview"
                                        :key="'A' + index"
                                        style="
                                            display: flex;
                                            flex-direction: column;
                                        "
                                    >
                                        <video
                                            :src="item"
                                            width="200px"
                                            height="200px"
                                            style="margin: 5px"
                                            controls
                                        >
                                            <source
                                                src="movie.mp4"
                                                type="video/mp4"
                                            />
                                        </video>
                                        <span
                                            v-if="
                                                errors && errors['vid.' + index]
                                            "
                                            class="errMsg"
                                            >{{
                                                errors["vid." + index][0]
                                            }}</span
                                        >
                                    </div>
                                </div>
                                <div v-else>
                                    <div
                                        style="
                                            width: 100%;
                                            display: flex;
                                            flex-wrap: wrap;
                                        "
                                    >
                                        <div
                                            v-for="(
                                                item, index
                                            ) in imagePreview"
                                            :key="'C' + index"
                                            style="
                                                position: relative;
                                                display: flex;
                                                flex-direction: column;
                                            "
                                        >
                                            <!-- <span
                                                class="dlt-room-btn"
                                                @click="
                                                    deleteImage(
                                                        'venue',
                                                        accomodation_id,
                                                        item,
                                                        index,
                                                        'image'
                                                    )
                                                "
                                            >
                                                <i class="fas fa-trash"></i>
                                            </span> -->
                                            <img
                                                v-if="formSubmitted.form6"
                                                width="200px"
                                                height="200px"
                                                :src="
                                                    '/assets/vendors/uploads/' +
                                                    item
                                                "
                                                style="margin: 5px"
                                                alt=""
                                            />
                                            <img
                                                v-else-if="showImg"
                                                width="200px"
                                                height="200px"
                                                :src="
                                                    '/assets/vendors/uploads/' +
                                                    item
                                                "
                                                style="margin: 5px"
                                                alt=""
                                            />
                                            <img
                                                v-else
                                                width="200px"
                                                height="200px"
                                                :src="item"
                                                style="margin: 5px"
                                                alt=""
                                            />
                                            <!-- <span
                                                v-if="
                                                    errors &&
                                                    errors['img.' + index]
                                                "
                                                class="errMsg"
                                                >{{
                                                    errors["img." + index][0]
                                                }}</span
                                            > -->
                                        </div>
                                        <div
                                            v-for="(
                                                item, index
                                            ) in newimagePreview"
                                            :key="index"
                                            style="
                                                display: flex;
                                                flex-direction: column;
                                            "
                                        >
                                            <img
                                                width="200px"
                                                height="200px"
                                                :src="item"
                                                style="margin: 5px"
                                                alt=""
                                            />
                                            <span
                                                v-if="
                                                    errors &&
                                                    errors['img.' + index]
                                                "
                                                class="errMsg"
                                                >{{
                                                    errors["img." + index][0]
                                                }}</span
                                            >
                                        </div>
                                    </div>
                                    <div
                                        style="
                                            width: 100%;
                                            display: flex;
                                            flex-wrap: wrap;
                                        "
                                    >
                                        <div
                                            v-for="(
                                                item, index
                                            ) in videoPreview"
                                            :key="'A' + index"
                                            style="
                                                position: relative;
                                                display: flex;
                                                flex-direction: column;
                                            "
                                        >
                                            <!-- <span
                                                class="dlt-room-btn"
                                                @click="
                                                    deleteImage(
                                                        'venue',
                                                        accomodation_id,
                                                        item,
                                                        index,
                                                        'video'
                                                    )
                                                "
                                            >
                                                <i class="fas fa-trash"></i>
                                            </span> -->
                                            <video
                                                v-if="formSubmitted.form6"
                                                :src="
                                                    '/assets/vendors/uploads/' +
                                                    item
                                                "
                                                width="200px"
                                                height="165px"
                                                style="
                                                    margin: 5px;
                                                    margin-top: 35px;
                                                    object-fit: cover;
                                                "
                                                controls
                                            >
                                                <source
                                                    src="movie.mp4"
                                                    type="video/mp4"
                                                />
                                            </video>
                                            <video
                                                v-else-if="showImg"
                                                :src="
                                                    '/assets/vendors/uploads/' +
                                                    item
                                                "
                                                width="200px"
                                                height="165px"
                                                style="
                                                    margin: 5px;
                                                    margin-top: 35px;
                                                    object-fit: cover;
                                                "
                                                controls
                                            >
                                                <source
                                                    src="movie.mp4"
                                                    type="video/mp4"
                                                />
                                            </video>
                                            <video
                                                v-else
                                                :src="item"
                                                width="200px"
                                                height="165px"
                                                style="
                                                    margin: 5px;
                                                    margin-top: 35px;
                                                    object-fit: cover;
                                                "
                                                controls
                                            >
                                                <source
                                                    src="movie.mp4"
                                                    type="video/mp4"
                                                />
                                            </video>
                                            <!-- <span
                                                v-if="
                                                    errors &&
                                                    errors['vid.' + index]
                                                "
                                                class="errMsg"
                                                >{{
                                                    errors["vid." + index][0]
                                                }}</span
                                            > -->
                                        </div>
                                        <div
                                            v-for="(
                                                item, index
                                            ) in newvideoPreview"
                                            :key="'B' + index"
                                            style="
                                                display: flex;
                                                flex-direction: column;
                                            "
                                        >
                                            <video
                                                :src="item"
                                                width="200px"
                                                height="200px"
                                                style="margin: 5px"
                                                controls
                                            >
                                                <source
                                                    src="movie.mp4"
                                                    type="video/mp4"
                                                />
                                            </video>
                                            <span
                                                v-if="
                                                    errors &&
                                                    errors['vid.' + index]
                                                "
                                                class="errMsg"
                                                >{{
                                                    errors["vid." + index][0]
                                                }}</span
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ven-profile-form-submit">
                            <button
                                v-if="formSubmitted.form4 == false"
                                type="submit"
                            >
                                Submit
                            </button>
                            <button style="display: none" v-else type="submit">
                                Update
                            </button>
                            <button
                                data-id="vendor-add-space"
                                @click="toggleForm($event, true)"
                                type="button"
                            >
                                <img src="/assets/vendors/Frame.svg" alt="" />
                            </button>
                        </div>
                    </form>
                    <form
                        @submit.prevent="updateForm2($event)"
                        class="content"
                        id="vendor-add-space"
                        data-id="price-policy"
                    >
                        <h1>Amenities</h1>
                        <div
                            v-if="formEdit.form5"
                            style="display: flex; justify-content: flex-end"
                            class="editbtn"
                        >
                            <button
                                class="shake"
                                @click="enableFeilds($event)"
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
                        <div
                            class="vendor-preview-form-fields vendor-addspace-form-feilds tooltipp"
                        >
                            <span class="tooltipptext">Press Enter to add</span>
                            <label for="space">
                                Space preference
                                <input
                                    type="text"
                                    name="MediaTecnology"
                                    id="space"
                                    data-id="Space preference"
                                    placeholder="Add Decor policy"
                                    @keydown.enter.prevent="addspace($event)"
                                />
                                <ul v-if="addSpaceSubmit['Space preference']">
                                    <li
                                        v-for="(item, index) in addSpaceSubmit[
                                            'Space preference'
                                        ].facilities"
                                        :key="index"
                                    >
                                        {{ item }}
                                        <!-- <span @click="deleteFacility($event, 'addSpaceSubmit', )" style="padding:0 5px">×</span> -->
                                    </li>
                                </ul>
                                <span
                                    v-if="errors && errors['Space preference']"
                                    class="errMsg"
                                    >{{ errors["Space preference"] }}</span
                                >
                            </label>
                            <label for="changingroom">
                                Changing room
                                <input
                                    type="text"
                                    name="changingroom"
                                    id="changingroom"
                                    data-id="Changing room"
                                    placeholder="Add Decor policy"
                                    @keydown.enter.prevent="addspace($event)"
                                />
                                <ul v-if="addSpaceSubmit['Changing room']">
                                    <li
                                        v-for="(item, index) in addSpaceSubmit[
                                            'Changing room'
                                        ].facilities"
                                        :key="index"
                                    >
                                        {{ item }}
                                    </li>
                                </ul>
                                <span
                                    v-if="errors && errors['Changing room']"
                                    class="errMsg"
                                    >{{ errors["Changing room"] }}</span
                                >
                            </label>
                            <label for="decorPolicy">
                                Decor policy
                                <input
                                    type="text"
                                    name="decorPolicy"
                                    id="decorPolicy"
                                    data-id="Decor policy"
                                    placeholder="Add Decor policy"
                                    @keydown.enter.prevent="addspace($event)"
                                />
                                <ul v-if="addSpaceSubmit['Decor policy']">
                                    <li
                                        v-for="(item, index) in addSpaceSubmit[
                                            'Decor policy'
                                        ].facilities"
                                        :key="index"
                                    >
                                        {{ item }}
                                    </li>
                                </ul>
                                <span
                                    v-if="errors && errors['Decor policy']"
                                    class="errMsg"
                                    >{{ errors["Decor policy"] }}</span
                                >
                            </label>
                            <label for="Parking">
                                Parking
                                <input
                                    type="text"
                                    name="Parking"
                                    id="Parking"
                                    data-id="Parking"
                                    placeholder="Add Space preference"
                                    @keydown.enter.prevent="addspace($event)"
                                />
                                <ul v-if="addSpaceSubmit.Parking">
                                    <li
                                        v-for="(item, index) in addSpaceSubmit
                                            .Parking.facilities"
                                        :key="index"
                                    >
                                        {{ item }}
                                    </li>
                                </ul>
                                <span
                                    v-if="errors && errors['Parking']"
                                    class="errMsg"
                                    >{{ errors["Parking"] }}</span
                                >
                            </label>
                            <label for="Alcohol">
                                Alcohol
                                <input
                                    type="text"
                                    name="Alcohol"
                                    id="Alcohol"
                                    data-id="Alcohol"
                                    placeholder="Add Changing room"
                                    @keydown.enter.prevent="addspace($event)"
                                />
                                <ul v-if="addSpaceSubmit.Alcohol">
                                    <li
                                        v-for="(item, index) in addSpaceSubmit
                                            .Alcohol.facilities"
                                        :key="index"
                                    >
                                        {{ item }}
                                    </li>
                                </ul>
                                <span
                                    v-if="errors && errors['Alcohol']"
                                    class="errMsg"
                                    >{{ errors["Alcohol"] }}</span
                                >
                            </label>
                            <label for="Food">
                                Food
                                <input
                                    type="text"
                                    name="Food"
                                    id="Food"
                                    data-id="Food"
                                    placeholder="Add Alcohol"
                                    @keydown.enter.prevent="addspace($event)"
                                />
                                <ul v-if="addSpaceSubmit.Food">
                                    <li
                                        v-for="(item, index) in addSpaceSubmit
                                            .Food.facilities"
                                        :key="index"
                                    >
                                        {{ item }}
                                    </li>
                                </ul>
                                <span
                                    v-if="errors && errors['Food']"
                                    class="errMsg"
                                    >{{ errors["Food"] }}</span
                                >
                            </label>
                            <label for="Lodging">
                                Lodging
                                <input
                                    type="text"
                                    name="Lodging"
                                    id="Lodging"
                                    data-id="Lodging"
                                    placeholder="Add Food"
                                    @keydown.enter.prevent="addspace($event)"
                                />
                                <ul v-if="addSpaceSubmit.Lodging">
                                    <li
                                        v-for="(item, index) in addSpaceSubmit
                                            .Lodging.facilities"
                                        :key="index"
                                    >
                                        {{ item }}
                                    </li>
                                </ul>
                                <span
                                    v-if="errors && errors['Lodging']"
                                    class="errMsg"
                                    >{{ errors["Lodging"] }}</span
                                >
                            </label>
                            <label for="OtherAmenities">
                                Other amenities
                                <input
                                    type="text"
                                    name="OtherAmenities"
                                    id="OtherAmenities"
                                    data-id="Other Amenities"
                                    placeholder="Add Food"
                                    @keydown.enter.prevent="addspace($event)"
                                />
                                <ul v-if="addSpaceSubmit['Other Amenities']">
                                    <li
                                        v-for="(item, index) in addSpaceSubmit[
                                            'Other Amenities'
                                        ].facilities"
                                        :key="index"
                                    >
                                        {{ item }}
                                    </li>
                                </ul>
                                <span
                                    v-if="errors && errors['Other Amenities']"
                                    class="errMsg"
                                    >{{ errors["Other Amenities"] }}</span
                                >
                            </label>
                        </div>
                        <div class="ven-profile-form-submit">
                            <button
                                v-if="formSubmitted.form5 == false"
                                type="submit"
                            >
                                Submit
                            </button>
                            <button style="display: none" v-else type="submit">
                                Update
                            </button>
                            <button
                                data-id="price-policy"
                                @click="toggleForm($event, true)"
                                type="button"
                            >
                                <img src="/assets/vendors/Frame.svg" alt="" />
                            </button>
                        </div>
                    </form>
                    <form
                        data-id="vendor-add-space"
                        @submit.prevent="updateForm3($event)"
                        class="content"
                        id="price-policy"
                    >
                        <h1>Price and Policy</h1>
                        <div
                            v-if="formEdit.form6"
                            style="display: flex; justify-content: flex-end"
                            class="editbtn"
                        >
                            <button
                                class="shake"
                                @click="enableFeilds($event)"
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
                        <div class="vendor-preview-form-fields">
                            <h3>Pricing</h3>
                            <label
                                style="grid-column-start: 1; grid-column-end: 2"
                                for="vendorStartingPrice"
                            >
                                Veg/ Per Plate Price
                                <input
                                    type="text"
                                    name="vendorStartingPrice"
                                    id="vendorStartingPrice"
                                    placeholder=""
                                    v-model="addVenue1.veg_plate"
                                />
                                <span
                                    v-if="errors && errors.veg_plate"
                                    class="errMsg"
                                    >{{ errors.veg_plate[0] }}</span
                                >
                            </label>
                            <label
                                style="
                                    grid-column-start: 2;
                                    grid-column-end: -1;
                                "
                                for="vendorEndingPrice"
                            >
                                Non Veg/ Per Plate Price
                                <input
                                    type="text"
                                    name="vendorEndingPrice"
                                    id="vendorEndingPrice"
                                    placeholder=""
                                    v-model="addVenue1.non_veg_plate"
                                />
                                <span
                                    v-if="errors && errors.non_veg_plate"
                                    class="errMsg"
                                    >{{ errors.non_veg_plate[0] }}</span
                                >
                            </label>
                        </div>
                        <div class="vendor-preview-form-fields">
                            <h3>Policies</h3>
                            <label
                                style="grid-column-start: 1; grid-column-end: 2"
                                for="businessFacilities"
                            >
                                Timing And Slots
                                <input
                                    type="text"
                                    name="businessFacilities"
                                    id="businessFacilities"
                                    data-id="Timing And Slots"
                                    placeholder="Add timing and slots"
                                    @keydown.enter.prevent="
                                        addspace($event, 'policy')
                                    "
                                />
                                <ul v-if="addSpacePolicy['Timing And Slots']">
                                    <li
                                        v-for="(item, index) in addSpacePolicy[
                                            'Timing And Slots'
                                        ]['facilities']"
                                        :key="index"
                                    >
                                        {{ item }}
                                    </li>
                                </ul>
                                <span
                                    v-if="errors && errors['Timing And Slots']"
                                    class="errMsg"
                                    >{{ errors["Timing And Slots"] }}</span
                                >
                            </label>
                            <label
                                style="
                                    grid-column-start: 2;
                                    grid-column-end: -1;
                                "
                                for="FoodAndDrink"
                            >
                                Advances
                                <input
                                    type="text"
                                    name="FoodAndDrink"
                                    id="FoodAndDrink"
                                    data-id="Advances"
                                    placeholder="Add Advances"
                                    @keydown.enter.prevent="
                                        addspace($event, 'policy')
                                    "
                                />
                                <ul v-if="addSpacePolicy['Advances']">
                                    <li
                                        v-for="(item, index) in addSpacePolicy[
                                            'Advances'
                                        ].facilities"
                                        :key="index"
                                    >
                                        {{ item }}
                                    </li>
                                </ul>
                                <span
                                    v-if="errors && errors['Advances']"
                                    class="errMsg"
                                    >{{ errors["Advances"] }}</span
                                >
                            </label>
                            <label
                                style="grid-column-start: 1; grid-column-end: 2"
                                for="SafetyAndSecurity"
                            >
                                Taxes
                                <input
                                    type="text"
                                    name="SafetyAndSecurity"
                                    id="SafetyAndSecurity"
                                    data-id="Taxes"
                                    placeholder="Add Taxes"
                                    @keydown.enter.prevent="
                                        addspace($event, 'policy')
                                    "
                                />
                                <ul v-if="addSpacePolicy['Taxes']">
                                    <li
                                        v-for="(item, index) in addSpacePolicy[
                                            'Taxes'
                                        ].facilities"
                                        :key="index"
                                    >
                                        {{ item }}
                                    </li>
                                </ul>
                                <span
                                    v-if="errors && errors['Taxes']"
                                    class="errMsg"
                                    >{{ errors["Taxes"] }}</span
                                >
                            </label>
                            <label
                                style="
                                    grid-column-start: 2;
                                    grid-column-end: -1;
                                "
                                for="Cancellation"
                            >
                                Cancellation
                                <input
                                    type="text"
                                    name="Cancellation"
                                    id="Cancellation"
                                    data-id="Cancellation"
                                    placeholder="Add Cancellation"
                                    @keydown.enter.prevent="
                                        addspace($event, 'policy')
                                    "
                                />
                                <ul v-if="addSpacePolicy.Cancellation">
                                    <li
                                        v-for="(item, index) in addSpacePolicy
                                            .Cancellation.facilities"
                                        :key="index"
                                    >
                                        {{ item }}
                                    </li>
                                </ul>
                                <span
                                    v-if="errors && errors['Cancellation']"
                                    class="errMsg"
                                    >{{ errors["Cancellation"] }}</span
                                >
                            </label>
                        </div>
                        <div class="ven-profile-form-submit">
                            <button
                                v-if="formSubmitted.form6 == false"
                                type="submit"
                            >
                                Submit
                            </button>
                            <button style="display: none" v-else type="submit">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
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
        <flashMessage :message="message"></flashMessage>
    </div>
</template>

<script>
import Services from "../Services.vue";
import flashMessage from "../../../FlashMessage.vue";
export default {
    components: {
        Services,
        flashMessage,
    },
    props: [
        "vendor",
        "vendorCat",
        "subcat",
        "selectedSubCat",
        "services",
        "servicesSelected",
    ],
    data() {
        return {
            sendPartyArea: {},
            errors: null,
            vendorDetails: JSON.parse(this.vendor),
            vendorCategories: JSON.parse(this.vendorCat),
            subCategories: JSON.parse(this.subcat),
            accomodation_id: null,
            form: false,
            added: false,
            hidden: false,
            message: null,
            loader: false,
            serviceId: this.servicesSelected ?? [],
            sendService: [],
            locationMaster: [],
            states: [],
            district: [],
            image: null,
            againUpload: false,
            imagePreview: [],
            partyimagePreview: [],
            partyvideoPreview: [],
            videoPreview: [],
            newimagePreview: [],
            newvideoPreview: [],
            addSpaceSubmit: {},
            addSpacePolicy: {},
            showImg: false,
            formSubmitted: {
                form1: false,
                form2: false,
                form3: false,
                form4: false,
                form5: false,
                form6: false,
            },
            formEdit: {
                form1: false,
                form2: false,
                form3: false,
                form4: false,
                form5: false,
                form6: false,
            },
            formUpdate: {
                form1: false,
                form2: false,
                form3: false,
                form4: false,
                form5: false,
                form6: false,
            },
            addPolicyDefaults: {
                "Timing And Slots": "/assets/vendors/venues/clock.png",
                Advances: "/assets/vendors/venues/ic_sharp-meeting-room.png",
                Taxes: "/assets/vendors/venues/ic_sharp-.png",
                Cancellation: "/assets/vendors/venues/ic_sharp-meeting-.png",
            },
            addSpaceSubmitImages: {
                "Timing And Slots": "/assets/vendors/venues/clock.png",
                "Decor policy": "/assets/vendors/venues/mdi_string-lights.png",
                Advances: "/assets/vendors/venues/ic_sharp-meeting-room.png",
                Taxes: "/assets/vendors/venues/ic_sharp-.png",
                Cancellation: "/assets/vendors/venues/ic_sharp-meeting-.png",
                Parking: "/assets/vendors/venues/fa6-solid_car-side.png",
                Alcohol: "/assets/vendors/venues/maki_alcohol-shop.png",
                "Space preference": "/assets/vendors/venues/ic_round-room.png",
                "Changing room": "/assets/vendors/venues/ic_sharp-meet.png",
                Food: "/assets/vendors/venues/mdi_room-service.png",
                Lodging: "/assets/vendors/venues/ic_sharp-meet.png",
                "Other Amenities":
                    "/assets/vendors/venues/teenyicons_adjust-vertical-solid.png",
            },
            addSpaceDefaults: {
                "Decor policy": "/assets/vendors/venues/mdi_string-lights.png",
                Parking: "/assets/vendors/venues/fa6-solid_car-side.png",
                Alcohol: "/assets/vendors/venues/maki_alcohol-shop.png",
                "Space preference": "/assets/vendors/venues/ic_round-room.png",
                "Changing room": "/assets/vendors/venues/ic_sharp-meet.png",
                Food: "/assets/vendors/venues/mdi_room-service.png",
                Lodging: "/assets/vendors/venues/ic_sharp-meet.png",
                "Other Amenities":
                    "/assets/vendors/venues/teenyicons_adjust-vertical-solid.png",
            },
            addVenue: {
                name: null,
                facebook_link: null,
                instagram_link: null,
                twitter_link: null,
                snapchat_link: null,
                description: null,
                features: null,
                category_id: null,
            },
            venueContact: {
                landline: null,
                number_2: null,
                address: null,
                watsapp: null,
                email: null,
                //area: null,
                state: null,
                location_id: null,
                pincode: null,
                latitude: null,
                longitude: null,
                map: null,
            },
            // addVenue: {
            //     name: null,
            //     landline: null,
            //     number_2: null,
            //     type: null,
            //     address: null,
            //     area: null,
            //     state: null,
            //     location_id: null,
            //     pincode: null,
            //     latitude: null,
            //     longitude: null,
            //     map: null,
            //     facebook_link: null,
            //     instagram_link: null,
            //     twitter_link: null,
            //     snapchat_link: null,
            //     description: null,
            //     features: null,
            // },
            addVenue1: {
                veg_plate: null,
                non_veg_plate: null,
            },
            addPartyPlace: {
                name: null,
                Seating: null,
                "Maximum capacity": null,
                // img: [],
                // vid: [],
            },
            partyPlaces: [],
            defaultPartyPlaces: ["Pool Side", "Terrace", "Lawn"],
        };
    },
    methods: {
        deleteImage(item, mainId, name, id, type, partyId) {
            let _this = this;
            if (item == "venue") {
                if (_this.formUpdate.form4 == false) {
                    return;
                }
                let vidName = name.substring(name.lastIndexOf("/") + 1);
                let data = [item, mainId, vidName, id, type];
                axios
                    .delete(
                        route("vendorvenues.destroy", [
                            "services",
                            _this.vendorDetails?.slug,
                            data,
                        ])
                    )
                    //.delete(`/api/vendor/addvenue/${data}`)
                    .then(function (response) {
                        if (type == "image") {
                            let index = _this.imagePreview.find(function (
                                item,
                                index
                            ) {
                                return index;
                            });
                            _this.imagePreview.splice(index, 1);
                            _this.message = "Picture Deleted";
                            setTimeout(function () {
                                _this.message = null;
                            }, 3000);
                        }
                        if (type == "video") {
                            let index = _this.videoPreview.find(function (
                                item,
                                index
                            ) {
                                return index;
                            });
                            _this.videoPreview.splice(index, 1);
                            _this.message = "Video Deleted";
                            setTimeout(function () {
                                _this.message = null;
                            }, 3000);
                        }
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
            if (item == "partyarea") {
                if (confirm("Are you sure you want to delete?")) {
                    // Save it!
                    let vidName = name.substring(name.lastIndexOf("/") + 1);
                    let data = [item, mainId, vidName, id, type, partyId];
                    axios
                        .delete(
                            route("vendorvenues.destroy", [
                                "services",
                                _this.vendorDetails?.slug,
                                data,
                            ])
                        )
                        //.delete(`/api/vendor/addvenue/${data}`)
                        .then(function (response) {
                            _this.partyPlaces = response.data;
                            _this.message = "File Deleted";
                            setTimeout(function () {
                                _this.message = null;
                            }, 3000);
                        })
                        .catch((error) => {
                            console.log(error);
                        });
                } else {
                    return;
                }
            }
        },
        showForm(e, bool) {
            this.toggleForm("vendor-details", false);
            if (bool == true) {
                for (const key in this.formSubmitted) {
                    this.formSubmitted[key] = false;
                }
                for (const key in this.formEdit) {
                    this.formEdit[key] = false;
                }
                for (const key in this.formUpdate) {
                    this.formUpdate[key] = false;
                }
                for (const key in this.addVenue) {
                    this.addVenue[key] = null;
                }
                for (const key in this.venueContact) {
                    this.venueContact[key] = null;
                }
                for (const key in this.addVenue1) {
                    this.addVenue1[key] = null;
                }
                this.partyPlaces = [];
                this.showImg = false;
                this.addSpacePolicy = {};
                this.addSpaceSubmit = {};
                this.imagePreview = [];
                this.videoPreview = [];
                this.newimagePreview = [];
                this.newvideoPreview = [];
                $(".forms :input").removeAttr("disabled");
            }
            this.newimagePreview = [];
            this.newvideoPreview = [];
            this.form = true;
            var element = this.$refs[e];
            setTimeout(function () {
                element.scrollIntoView(true);
            }, 100);
        },
        enableFeilds(e) {
            let _this = this;
            let id = e.currentTarget.parentElement.parentElement.id;
            let child =
                e.currentTarget.parentElement.parentElement.parentElement
                    .children;
            let form = null;
            for (let i = 0; i < child.length; i++) {
                if (child[i].id == id) {
                    let num = i + 1;
                    form = "form" + num;
                    //console.log(form);
                    _this.formUpdate[form] = true;
                    //console.log(_this.formUpdate[form]);
                }
            }

            $(`#${id} :input`).removeAttr("disabled");

            $(`#${id} > .ven-profile-form-submit > button[type=submit]`).css(
                "display",
                "block"
            );
            $(`#${id} :input`).eq(0).removeClass("shake");
            $(`#${id} :input`).eq(1).focus();
            if (this.addVenue.features != null) {
                if (this.addVenue.features.length > 0) {
                    $("#vendorFwatures").removeAttr("required");
                }
            }
            if (this.imagePreview != null) {
                if (this.imagePreview.length > 0) {
                    //console.log($("#vendorImagesUpload"));
                    $("#vendorImagesUpload").removeAttr("required");
                }
            }

            if (Object.keys(this.addSpacePolicy).length > 0) {
                if (Object.keys(this.addSpaceSubmit).length > 0) {
                    $("#vendor-add-space label input").removeAttr("required");
                }
            }
        },
        editForm(e) {
            let _this = this;
            _this.accomodation_id = e;
            _this.showImg = true;

            // for (const key in this.formEdit) {
            //     this.formEdit[key] = true;
            // }

            axios
                .get(`/api/vendor/addvenue/${e}`)
                .then(function (response) {
                    for (const key in _this.formSubmitted) {
                        _this.formSubmitted[key] = false;
                    }
                    for (const key in _this.formEdit) {
                        _this.formEdit[key] = false;
                    }
                    for (const key in _this.formUpdate) {
                        _this.formUpdate[key] = false;
                    }
                    console.log(response.data, response.data?.services);
                    for (const key in _this.addVenue) {
                        for (const key2 in response.data) {
                            if (key == key2) {
                                _this.addVenue[key] = response.data[key2];
                                _this.formSubmitted.form1 = true;
                                _this.formEdit.form1 = true;
                            }
                        }
                    }

                    if (response.data?.services) {
                        console.log("ssssss");
                        for (
                            let i = 0;
                            i < response.data?.services.length;
                            i++
                        ) {
                            console.log(response.data?.services[i].id);
                            _this.serviceId.push(response.data?.services[i].id);
                        }
                    }

                    for (const key in _this.venueContact) {
                        for (const key2 in response.data) {
                            if (key == key2) {
                                _this.venueContact[key] = response.data[key2];
                                _this.formSubmitted.form2 = true;
                                _this.formEdit.form2 = true;
                            }
                        }
                    }
                    let state = _this.venueContact?.state;
                    if (state) {
                        console.log("insede".state);
                        let customID = _this.locationMaster.find(function (
                            item
                        ) {
                            return item.name == state;
                        });
                        _this.district = [];
                        _this.locationMaster.map(function (el) {
                            if (
                                '"' + el.parent_id + '"' ==
                                '"' + customID.id + '"'
                            ) {
                                _this.district.push({
                                    id: el.id,
                                    name: el.name,
                                });
                            }
                        });
                    }

                    for (const key in _this.addVenue1) {
                        for (const key2 in response.data) {
                            if (key == key2) {
                                _this.addVenue1[key] = response.data[key2];
                            }
                        }
                    }
                    if (response.data.party_area != null) {
                        console.log(
                            "yes available",
                            Object.keys(response.data.party_area).length
                        );
                        if (Object.keys(response.data.party_area).length > 0) {
                            _this.partyPlaces = response.data.party_area;
                            _this.formSubmitted.form3 = true;
                            _this.formEdit.form3 = true;
                        } else {
                            _this.partyPlaces = [];
                        }
                    } else {
                        _this.partyPlaces = [];
                    }
                    if (response.data.venue_facilities != null) {
                        _this.addSpaceSubmit = response.data.venue_facilities;
                        _this.formSubmitted.form5 = true;
                        _this.formEdit.form5 = true;
                    } else {
                        _this.addSpaceSubmit = {};
                    }
                    if (response.data.venue_policies != null) {
                        _this.addSpacePolicy = response.data.venue_policies;
                        _this.formSubmitted.form6 = true;
                        _this.formEdit.form6 = true;
                    } else {
                        _this.addSpacePolicy = {};
                    }
                    if (response.data.images != null) {
                        if (response.data.images.length > 0) {
                            _this.imagePreview = response.data.images;
                            _this.formSubmitted.form4 = true;
                            _this.formEdit.form4 = true;
                        }
                    } else {
                        _this.imagePreview = [];
                    }
                    if (response.data.videos != null) {
                        if (response.data.videos.length > 0) {
                            _this.videoPreview = response.data.videos;
                        }
                    } else {
                        _this.videoPreview = [];
                    }

                    for (const key in _this.formSubmitted) {
                        if (_this.formSubmitted[key] == true) {
                            let id = key.substr(key.length - 1) - 1;
                            //console.log(id);
                            if (id == 2) {
                                continue;
                            }
                            let ele = $(".forms").children().eq(id).attr("id");
                            //console.log(ele, "ele");
                            $(`#${ele} :input`).attr("disabled", true);
                            $(`#${ele} .editbtn :input`).removeAttr("disabled");
                            $(
                                `#${ele} .ven-profile-form-submit :input`
                            ).removeAttr("disabled");
                            $(
                                `#${ele}  .ven-profile-form-submit :submit").attr(
                                "disabled`,
                                true
                            );
                        }
                    }
                    $("#vendor-add-party-area :input").removeAttr("disabled");
                    _this.showForm("scroll", false);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        uploadImg(e) {
            //console.log(e.target.files[0]);
            var _this = this;
            this.image = e.target.files;
            if (this.formSubmitted.form4 == false) {
                this.imagePreview = [];
                this.videoPreview = [];
            }
            if (this.formSubmitted.form4 == true) {
                _this.newimagePreview = [];
                _this.newvideoPreview = [];
                for (var i = 0; i < this.image.length; i++) {
                    if (_this.image[i].type.split("/")[0] == "image") {
                        _this.newimagePreview.push(
                            URL.createObjectURL(_this.image[i])
                        );
                    }
                    if (_this.image[i].type.split("/")[0] == "video") {
                        _this.newvideoPreview.push(
                            URL.createObjectURL(_this.image[i])
                        );
                    }
                }
                return;
            }
            for (var i = 0; i < this.image.length; i++) {
                if (_this.image[i].type.split("/")[0] == "image") {
                    _this.imagePreview.push(
                        URL.createObjectURL(_this.image[i])
                    );
                }
                if (_this.image[i].type.split("/")[0] == "video") {
                    _this.videoPreview.push(
                        URL.createObjectURL(_this.image[i])
                    );
                }
            }
        },
        uploadpartyImg(e, index) {
            var _this = this;
            this.image = e.target.files;
            if (this.formUpdate.form3 == false) {
                this.partyimagePreview = [];
                this.partyvideoPreview = [];
            }
            console.log("hh");
            if (index != null) {
                _this.partyPlaces[index].partyimagePreview = [];
                _this.partyPlaces[index].partyvideoPreview = [];
            }
            this.partyimagePreview = [];
            this.partyvideoPreview = [];
            for (var i = 0; i < this.image.length; i++) {
                if (_this.image[i].type.split("/")[0] == "image") {
                    if (index != null) {
                        _this.partyPlaces[index].partyimagePreview.push(
                            URL.createObjectURL(_this.image[i])
                        );
                    } else {
                        _this.partyimagePreview.push(
                            URL.createObjectURL(_this.image[i])
                        );
                    }
                }
                if (_this.image[i].type.split("/")[0] == "video") {
                    if (index != null) {
                        _this.partyPlaces[index].partyvideoPreview.push(
                            URL.createObjectURL(_this.image[i])
                        );
                    } else {
                        _this.partyvideoPreview.push(
                            URL.createObjectURL(_this.image[i])
                        );
                    }
                }
            }
            // this.image.forEach(function (item) {
            //     if (item.type.split("/")[0] == "image") {
            //         if (index != null) {
            //             _this.partyPlaces[index].partyimagePreview.push(
            //                 URL.createObjectURL(item)
            //             );
            //         } else {
            //             _this.partyimagePreview.push(URL.createObjectURL(item));
            //         }
            //     }
            //     if (item.type.split("/")[0] == "video") {
            //         if (index != null) {
            //             _this.partyPlaces[index].partyvideoPreview.push(
            //                 URL.createObjectURL(item)
            //             );
            //         } else {
            //             _this.partyvideoPreview.push(URL.createObjectURL(item));
            //         }
            //     }
            // });
        },
        submitForm1(e) {
            var _this = this;
            _this.errors = null;
            if (
                _this.addVenue.features == null ||
                _this.addVenue.features.length == 0
            ) {
                _this.errors = {
                    features: ["Press Enter to add features"],
                };
                //console.log(0);
                return;
            }
            let name = "create";
            let formData = new FormData();
            this.serviceId.forEach(function (item) {
                _this.sendService.push({
                    service_id: item,
                    vendor_id: _this.vendorId,
                });
            });
            _this.addVenue.category_id = _this.selectedSubCat.id;
            let data = JSON.stringify(_this.addVenue);
            //let services = JSON.stringify(_this.sendService);
            let services = JSON.stringify(_this.serviceId);

            formData.append("contentType", "details");
            formData.append("data", data);
            formData.append("catId", _this.vendorCategories.id);
            formData.append("vendorId", _this.vendorDetails.id);
            formData.append("services", services);
            if (this.formUpdate.form1 == true) {
                formData.append("_method", "PATCH");
                this.loader = true;
                axios
                    .post(
                        route("vendorvenues.update", [
                            "services",
                            _this.vendorDetails?.slug,
                            _this.accomodation_id,
                        ]),
                        formData
                    )
                    // .post(
                    //     `/api/vendor/addvenue/${_this.accomodation_id}`,
                    //     formData
                    // )
                    .then(function (response) {
                        _this.loader = false;
                        _this.toggleForm("vendor-add-party-area", false);
                        $(".forms")
                            .children()
                            .eq(0)
                            .children()
                            .eq(1)
                            .find("button")
                            .addClass("shake");
                        _this.formSubmitted.form1 = true;
                        _this.accomodation_id = response.data;
                        _this.message = "Venue detalis updated!!";
                        _this.formEdit.form1 = true;
                        _this.formUpdate.form1 = false;
                        $(
                            `#vendor-details .ven-profile-form-submit button[type=submit]`
                        ).css("display", "none");
                        let current = $(".forms").children().eq(0);
                        //console.log(current);
                        current.find("input").attr("disabled", true);
                        current.find("select").attr("disabled", true);
                        current
                            .find("button[type=submit]")
                            .attr("disabled", true);
                        setTimeout(function () {
                            _this.message = null;
                        }, 3000);
                    })
                    .catch((error) => {
                        _this.loader = false;
                        _this.errors = error.response.data.errors;
                    });
                return;
            }
            this.loader = true;
            axios
                //.post(`/api/vendor/addvenue`, formData)
                .post(
                    route("vendorvenues.store", [
                        "services",
                        _this.vendorDetails?.slug,
                    ]),
                    formData
                )
                .then(function (response) {
                    _this.loader = false;
                    _this.toggleForm("contact-details", false);
                    _this.accomodation_id = response.data;
                    _this.message =
                        "Venue Added Successfully!! Kindly Fill other Details";
                    _this.formSubmitted.form1 = true;
                    _this.formEdit.form1 = true;
                    let current = $(".forms").children().eq(0);
                    //console.log(current);
                    current.find("input").attr("disabled", true);
                    current.find("select").attr("disabled", true);
                    current.find("button[type=submit]").attr("disabled", true);

                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                })
                .catch((error) => {
                    _this.loader = false;
                    _this.errors = error.response.data.errors;
                });
        },
        submitForm2(e) {
            var _this = this;
            _this.errors = null;
            if (this.formSubmitted.form1 == false) {
                this.message = "kindly fill first form";
                setTimeout(function () {
                    _this.message = null;
                }, 3000);
                this.toggleForm("vendor-details", false);

                return;
            }
            let formData = new FormData();
            let data = JSON.stringify(_this.venueContact);
            formData.append("contentType", "contactdetails");
            formData.append("data", data);
            this.loader = true;
            formData.append("_method", "PATCH");
            this.loader = true;
            axios
                .post(
                    route("vendorvenues.update", [
                        "services",
                        _this.vendorDetails?.slug,
                        _this.accomodation_id,
                    ]),
                    formData
                )
                // .post(`/api/vendor/addvenue/${_this.accomodation_id}`, formData)
                .then(function (response) {
                    _this.loader = false;
                    _this.toggleForm("vendor-add-party-area", false);
                    $(".forms")
                        .children()
                        .eq(1)
                        .children()
                        .eq(1)
                        .find("button")
                        .addClass("shake");
                    _this.formSubmitted.form2 = true;
                    _this.accomodation_id = response.data;
                    _this.message = "Venue contact detalis updated!!";
                    _this.formEdit.form2 = true;
                    _this.formUpdate.form2 = false;
                    $(
                        `#contact-details .ven-profile-form-submit button[type=submit]`
                    ).css("display", "none");
                    let current = $(".forms").children().eq(1);
                    //console.log(current);
                    current.find("input").attr("disabled", true);
                    current.find("select").attr("disabled", true);
                    current.find("button[type=submit]").attr("disabled", true);
                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                })
                .catch((error) => {
                    _this.loader = false;
                    _this.errors = error.response.data.errors;
                });
            return;
        },
        sendPartyAreaa(single, index, type) {
            var _this = this;
            _this.errors = null;
            console.log(index);

            if (this.formSubmitted.form1 == false) {
                this.message = "kindly fill first form";
                setTimeout(function () {
                    _this.message = null;
                }, 3000);
                this.toggleForm("vendor-details", false);

                return;
            }
            if (this.formSubmitted.form2 == false) {
                this.message = "kindly fill second form";
                setTimeout(function () {
                    _this.message = null;
                }, 3000);
                this.toggleForm("contact-details", false);
                return;
            }
            let formData = new FormData();

            let data = JSON.stringify(single);
            if (this.image != null) {
                for (var i = 0; i < this.image.length; i++) {
                    let file = this.image[i];
                    //console.log(file);
                    formData.append("files[" + i + "]", file);
                }
            }
            formData.append("contentType", "partyArea");
            formData.append("data", data);
            if (type == "dlt") {
                formData.append("ifdelete", "dlt");
            }

            formData.append("_method", "PATCH");
            this.loader = true;
            axios
                .post(
                    route("vendorvenues.update", [
                        "services",
                        _this.vendorDetails?.slug,
                        _this.accomodation_id,
                    ]),
                    formData
                )
                // .post(`/api/vendor/addvenue/${_this.accomodation_id}`, formData)
                .then(function (response) {
                    console.log(response, "ss");
                    _this.loader = false;
                    _this.image = null;
                    let dropZone = document.querySelector(
                        "#vendor-preview-upload-dropzone"
                    );
                    dropZone.lastElementChild.textContent = "";
                    _this.partyPlaces = response.data;
                    _this.addPartyPlace = {
                        name: null,
                        Seating: null,
                        "Maximum capacity": null,
                    };
                    _this.partyimagePreview = [];
                    _this.partyvideoPreview = [];
                    //_this.toggleForm("vendor-about", false);
                    _this.formSubmitted.form3 = true;
                    //_this.accomodation_id = response.data;
                    if (type == "dlt") {
                        _this.message = "Party area deleted successfully!!";
                    } else {
                        if (_this.formUpdate.form3 == true) {
                            _this.message = "Party Places Updated";
                        } else {
                            _this.message =
                                "Party Places added successfully!! Kindly Fill other Details";
                        }
                    }
                    _this.formUpdate.form3 = false;
                    _this.formEdit.form3 = true;

                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                })
                .catch((error) => {
                    _this.loader = false;
                    console.log(error);
                    if (index != null) {
                        let err = error.response.data.errors;
                        if (err == null) {
                            return;
                        }
                        let refinederr = {};
                        // refinederr[`data.${index}.Seating`] = err["data.Seating"];
                        // refinederr[`data.${index}.Maximum capacity`] =
                        //     err[data["data.Maximum capacity"]];
                        // console.log(refinederr);
                        // _this.errors = refinederr;

                        for (const property in err) {
                            let prop = property;
                            let updated = prop.replace(
                                `data.`,
                                `data.${index}.`
                            );
                            refinederr[updated] = err[property];
                        }
                        _this.errors = refinederr;
                    } else {
                        _this.errors = error.response.data.errors;
                    }
                });
        },
        // updateForms(e) {
        //     var _this = this;
        //     _this.errors = null;

        //     if (this.formSubmitted.form1 == false) {
        //         this.message = "kindly fill first form";
        //         setTimeout(function () {
        //             _this.message = null;
        //         }, 3000);
        //         this.toggleForm("vendor-details", false);

        //         return;
        //     }
        //     if (this.formSubmitted.form2 == false) {
        //         this.message = "kindly fill second form";
        //         setTimeout(function () {
        //             _this.message = null;
        //         }, 3000);
        //         this.toggleForm("contact-details", false);
        //         return;
        //     }
        //     let formData = new FormData();
        //     let data = JSON.stringify(_this.partyPlaces);
        //     formData.append("contentType", "partyArea");
        //     formData.append("data", data);

        //     formData.append("_method", "PATCH");
        //     this.loader = true;
        //     axios
        //         .post(
        //             route("vendorvenues.update", [
        //                 "services",
        //                 _this.vendorDetails?.slug,
        //                 _this.accomodation_id,
        //             ]),
        //             formData
        //         )
        //         // .post(`/api/vendor/addvenue/${_this.accomodation_id}`, formData)
        //         .then(function (response) {
        //             _this.loader = false;
        //             _this.toggleForm("vendor-about", false);
        //             _this.formSubmitted.form3 = true;
        //             _this.accomodation_id = response.data;
        //             if (_this.formUpdate.form3 == true) {
        //                 _this.message = "Party Places Updated";
        //             } else {
        //                 _this.message =
        //                     "Party Places added successfully!! Kindly Fill other Details";
        //             }
        //             _this.formUpdate.form3 = false;
        //             _this.formEdit.form3 = true;
        //             // $(".forms")
        //             //     .children()
        //             //     .eq(1)
        //             //     .children()
        //             //     .eq(1)
        //             //     .find("button")
        //             //     .addClass("shake");
        //             $(
        //                 `#vendor-add-party-area .ven-profile-form-submit button[type=submit]`
        //             ).css("display", "none");
        //             let current = $(".forms").children().eq(2).attr("id");

        //             //console.log(current, btn);
        //             $(`#${current} :input`).attr("disabled", true);
        //             $(`#${current} .editbtn :input`).removeAttr("disabled");
        //             $(`#${current} .editbtn button`).addClass("shake");
        //             $(`#${current} .ven-profile-form-submit :input`).removeAttr(
        //                 "disabled"
        //             );
        //             $(
        //                 `#${current}  .ven-profile-form-submit :submit").attr(
        //                         "disabled`,
        //                 true
        //             );

        //             setTimeout(function () {
        //                 _this.message = null;
        //             }, 3000);
        //         })
        //         .catch((error) => {
        //             _this.loader = false;
        //             _this.errors = error.response.data.errors;
        //         });
        // },
        updateForm1(e) {
            var _this = this;
            _this.errors = null;

            if (this.formSubmitted.form1 == false) {
                this.message = "kindly fill first form";
                setTimeout(function () {
                    _this.message = null;
                }, 3000);
                this.toggleForm("vendor-details", false);
                return;
            }
            if (this.formSubmitted.form2 == false) {
                this.message = "kindly fill second form";
                setTimeout(function () {
                    _this.message = null;
                }, 3000);
                this.toggleForm("contact-details", false);
                return;
            }
            if (this.formSubmitted.form3 == false) {
                this.message = "kindly fill third form";
                setTimeout(function () {
                    _this.message = null;
                }, 3000);
                this.toggleForm("vendor-add-party-area", false);
                return;
            }
            const config = {
                headers: { "content-type": "multipart/form-data" },
            };
            let formData = new FormData();
            //let data = JSON.stringify(_this.addVenue1);
            formData.append("contentType", "image");
            if (this.image != null) {
                for (var i = 0; i < this.image.length; i++) {
                    let file = this.image[i];
                    //console.log(file);
                    formData.append("files[" + i + "]", file);
                }
            }
            //formData.append("image", this.image);
            //formData.append("data", data);
            if (_this.formUpdate.form3) {
                formData.append("uploadimg", "uploadimg");
            }

            formData.append("_method", "PATCH");
            this.loader = true;
            axios
                .post(
                    route("vendorvenues.update", [
                        "services",
                        _this.vendorDetails?.slug,
                        _this.accomodation_id,
                    ]),
                    formData,
                    config
                )
                // .post(
                //     `/api/vendor/addvenue/${_this.accomodation_id}`,
                //     formData,
                //     config
                // )
                .then(function (response) {
                    _this.formSubmitted.form4 = true;
                    _this.loader = false;
                    _this.image = null;
                    _this.toggleForm("vendor-add-space", false);
                    $(".forms")
                        .children()
                        .eq(3)
                        .children()
                        .eq(1)
                        .find("button")
                        .addClass("shake");
                    if (_this.formUpdate.form4 == true) {
                        _this.message = "Gallery Updated";
                    } else {
                        _this.message =
                            "Venue Added Successfully!! Kindly Fill other Details";
                    }
                    _this.formUpdate.form4 = false;
                    _this.formEdit.form4 = true;
                    $(
                        `#vendor-about .ven-profile-form-submit button[type=submit]`
                    ).css("display", "none");
                    console.log(
                        $(
                            `#vvendor-about .ven-profile-form-submit button[type=submit]`
                        ).css("display", "none")
                    );
                    let current = $(".forms").children().eq(3);
                    //console.log(current);
                    current.find("input").attr("disabled", true);
                    current.find("select").attr("disabled", true);
                    current.find("textarea").attr("disabled", true);
                    current.find("button[type=submit]").attr("disabled", true);
                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                    _this.accomodation_id = response.data;
                })
                .catch((error) => {
                    _this.loader = false;
                    _this.errors = error.response.data.errors;
                });
        },
        updateForm2(e) {
            var _this = this;
            _this.errors = null;

            if (this.formSubmitted.form1 == false) {
                this.message = "kindly fill first form";
                setTimeout(function () {
                    _this.message = null;
                }, 3000);
                this.toggleForm("vendor-details", false);
                return;
            }
            if (this.formSubmitted.form2 == false) {
                this.message = "kindly fill second form";
                setTimeout(function () {
                    _this.message = null;
                }, 3000);
                this.toggleForm("contact-details", false);
                return;
            }

            if (this.formSubmitted.form3 == false) {
                this.message = "kindly fill third form";
                setTimeout(function () {
                    _this.message = null;
                }, 3000);
                this.toggleForm("vendor-add-party-area", false);
                return;
            }
            if (this.formSubmitted.form4 == false) {
                this.message = "kindly fill forth form";
                setTimeout(function () {
                    _this.message = null;
                }, 3000);
                this.toggleForm("vendor-about", false);
                return;
            }

            _this.errors = {};
            let err = false;
            for (let keys in _this.addSpaceDefaults) {
                if (!_this.addSpaceSubmit[keys]) {
                    err = true;
                    console.log("errr");
                    _this.errors[keys] = `This ${keys} is required!`;
                }
            }
            if (err) {
                return;
            }

            let formData = new FormData();
            let data = JSON.stringify(_this.addSpaceSubmit);
            //let data1 = JSON.stringify(_this.addSpacePolicy);
            formData.append("contentType", "json");
            formData.append("data", data);
            //formData.append("data1", data1);
            formData.append("_method", "PATCH");
            this.loader = true;
            axios
                .post(
                    route("vendorvenues.update", [
                        "services",
                        _this.vendorDetails?.slug,
                        _this.accomodation_id,
                    ]),
                    formData
                )
                // .post(`/api/vendor/addvenue/${_this.accomodation_id}`, formData)
                .then(function (response) {
                    _this.formSubmitted.form5 = true;
                    _this.accomodation_id = response.data;
                    _this.toggleForm("price-policy", false);
                    $(".forms")
                        .children()
                        .eq(4)
                        .children()
                        .eq(1)
                        .find("button")
                        .addClass("shake");
                    _this.loader = false;
                    if (_this.formUpdate.form5 == true) {
                        _this.message = "Amenities Updated";
                    } else {
                        _this.message = "Amenities Added Successfully!!";
                    }
                    _this.formEdit.form5 = true;
                    _this.formUpdate.form5 = false;
                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                    $(
                        `#vendor-add-space .ven-profile-form-submit button[type=submit]`
                    ).css("display", "none");
                    // _this.form = false;

                    // //console.log(_this.$refs.services);
                    // _this.$refs.services.getProducts("parent");
                    _this.added = _this.accomodation_id;
                })
                .catch((error) => {
                    //console.log(error.response.data.errors);
                    let err = error.response.data.errors;
                    let refinederr = {};
                    for (const property in err) {
                        //console.log(`${property}: ${err[property]}`);
                        let val = property.substring(property.indexOf(".") + 1);
                        val = val.substring(0, val.indexOf("."));
                        //console.log(val);
                        let msg = err[property];
                        msg = msg[0].replace(`${property}`, val);
                        msg = msg.replace(`The`, "Each");
                        refinederr[val] = msg;
                    }
                    console.log(refinederr);
                    _this.loader = false;
                    _this.errors = refinederr;
                });
        },
        updateForm3(e) {
            var _this = this;
            _this.errors = null;

            if (this.formSubmitted.form1 == false) {
                this.message = "kindly fill first form";
                setTimeout(function () {
                    _this.message = null;
                }, 3000);
                this.toggleForm("vendor-details", false);
                return;
            }
            if (this.formSubmitted.form2 == false) {
                this.message = "kindly fill second form";
                setTimeout(function () {
                    _this.message = null;
                }, 3000);
                this.toggleForm("contact-details", false);
                return;
            }

            if (this.formSubmitted.form3 == false) {
                this.message = "kindly fill third form";
                setTimeout(function () {
                    _this.message = null;
                }, 3000);
                this.toggleForm("vendor-add-party-area", false);
                return;
            }
            if (this.formSubmitted.form4 == false) {
                this.message = "kindly fill forth form";
                setTimeout(function () {
                    _this.message = null;
                }, 3000);
                this.toggleForm("vendor-about", false);
                return;
            }
            if (this.formSubmitted.form5 == false) {
                this.message = "kindly fill forth form";
                setTimeout(function () {
                    _this.message = null;
                }, 3000);
                this.toggleForm("vendor-add-space", false);
                return;
            }
            _this.errors = {};
            let err = false;
            for (let keys in _this.addPolicyDefaults) {
                if (!_this.addSpacePolicy[keys]) {
                    err = true;
                    console.log("errr");
                    _this.errors[keys] = `This ${keys} is required!`;
                }
            }
            if (err) {
                return;
            }

            let formData = new FormData();
            //let data = JSON.stringify(_this.addSpaceSubmit);
            let data1 = JSON.stringify(_this.addVenue1);
            let data = JSON.stringify(_this.addSpacePolicy);
            formData.append("contentType", "policy");
            formData.append("data", data);
            formData.append("data1", data1);
            formData.append("_method", "PATCH");
            this.loader = true;
            axios
                .post(
                    route("vendorvenues.update", [
                        "services",
                        _this.vendorDetails?.slug,
                        _this.accomodation_id,
                    ]),
                    formData
                )
                // .post(`/api/vendor/addvenue/${_this.accomodation_id}`, formData)
                .then(function (response) {
                    _this.formSubmitted.form6 = true;
                    _this.accomodation_id = response.data;
                    $(".forms")
                        .children()
                        .eq(4)
                        .children()
                        .eq(1)
                        .find("button")
                        .addClass("shake");
                    _this.loader = false;
                    if (_this.formUpdate.form6 == true) {
                        _this.message = "Policy and Price Updated";
                    } else {
                        _this.message = "Policy and Price Added Successfully!!";
                    }
                    _this.formEdit.form6 = true;
                    _this.formUpdate.form6 = false;
                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                    $(
                        `#vendor-add-space .ven-profile-form-submit button[type=submit]`
                    ).css("display", "none");
                    _this.form = false;

                    //console.log(_this.$refs.services);
                    _this.$refs.services.getProducts("parent");
                    _this.added = _this.accomodation_id;
                })
                .catch((error) => {
                    //console.log(error.response.data.errors);
                    let err = error.response.data.errors;
                    let refinederr = {};
                    for (const property in err) {
                        //console.log(`${property}: ${err[property]}`);
                        let check = property.substring(0, 7);
                        //console.log(check, check != "policy.");
                        if (check != "policy.") {
                            let msgg = err[property];
                            refinederr[property] = msgg;
                            continue;
                        }
                        let val = property.substring(property.indexOf(".") + 1);
                        val = val.substring(0, val.indexOf("."));
                        //console.log(val);
                        let msg = err[property];
                        msg = msg[0].replace(`${property}`, val);
                        msg = msg.replace(`The`, "Each");
                        refinederr[val] = msg;
                    }
                    console.log(refinederr);
                    _this.loader = false;
                    _this.errors = refinederr;
                });
        },
        editPartyArea(e, btn, index) {
            let _this = this;
            //console.log(index);
            if (btn == "add") {
                let _this = this;
                let exist = this.partyPlaces.find(
                    (x) => x.name === _this.addPartyPlace.name
                );
                if (exist != null) {
                    this.message = "Already Added";
                    setTimeout(function () {
                        _this.message = null;
                    }, 2000);
                    return;
                }
                // this.addPartyPlace["imgPreview"] = null;
                // this.addPartyPlace["vidPreview"] = null;
                this.sendPartyAreaa(this.addPartyPlace);

                // this.image.forEach(function (item) {
                //     if (item.type.split("/")[0] == "image") {
                //         _this.addPartyPlace.img.push(item);
                //         console.log(item);
                //     }
                //     if (item.type.split("/")[0] == "video") {
                //         _this.addPartyPlace.vid.push(item);
                //     }
                // });
                // this.addPartyPlace.imgpreview = this.partyimagePreview;
                // this.addPartyPlace.vidpreview = this.partyvideoPreview;
                // this.partyPlaces.push(_this.addPartyPlace);
                // this.addPartyPlace = {
                //     name: null,
                //     Seating: null,
                //     "Maximum capacity": null,
                //     // img: [],
                //     // vid: [],
                // };
                // // this.partyimagePreview = [];
                // // this.partyvideoPreview = [];
                return;
            }

            let inputs = e.currentTarget.parentElement.parentElement;
            //  console.log(inputs);

            // if ($(inputs).find("input").eq(0).attr("disabled")) {
            //     return;
            // }
            if (btn == "edit") {
                $(inputs).find("input").removeAttr("disabled");
                $(inputs).find("input").first().focus();
            }
            if (btn == "delete") {
                this.sendPartyAreaa(this.partyPlaces[index], index, "dlt");
                //this.partyPlaces.splice(index, 1);
            }
            if (btn == "save") {
                //console.log(this.partyPlaces[index]);
                this.sendPartyAreaa(this.partyPlaces[index], index);
                $(inputs).find("input").attr("disabled", "disabled");
            }
        },
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
        toggleForm(e, bool) {
            //console.log(bool);
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
        addfeatures(e) {
            if (this.addVenue.features == null) {
                this.addVenue.features = [];
            }
            if (!e.currentTarget.value) {
                return;
            }
            if (!e.currentTarget.value.replace(/\s/g, "").length) {
                return;
            }
            this.addVenue.features.push(e.currentTarget.value);
            e.currentTarget.value = "  ";
        },
        addspace(e, btn) {
            if (!e.currentTarget.value) {
                return;
            }
            if (!e.currentTarget.value.replace(/\s/g, "").length) {
                return;
            }
            let od = e.currentTarget.dataset.id;
            let ob = this.addSpaceSubmit;
            if (btn == "policy") {
                ob = this.addSpacePolicy;
            }
            if (ob[od]) {
                //console.log(e.currentTarget.dataset.id);
                ob[od].facilities.push(e.currentTarget.value);
                e.currentTarget.setAttribute("required", false);
            } else {
                this.$set(ob, od, {
                    facilities: [e.currentTarget.value],
                    img: this.addSpaceSubmitImages[od],
                });
                //this.$set(this.addSpaceSubmit, od, [e.currentTarget.value]);
                e.currentTarget.setAttribute("required", false);
            }
            //console.log();
            e.currentTarget.value = "  ";
        },
        getStates() {
            var _this = this;
            axios
                .get(`/api/vendor/addacc`)
                .then(function (response) {
                    _this.locationMaster = response.data[0];
                    _this.states = _this.locationMaster.filter(function (item) {
                        if (item.parent_id == 1) {
                            return { name: item.name, id: item.id };
                        }
                    });
                })
                .catch((errors) => {
                    console.log("Get All: " + errors);
                });
        },
        getDistricts(e) {
            let _this = this;
            let val = e.currentTarget.value;
            let customID = _this.locationMaster.find(function (item) {
                return item.name == val;
            });

            _this.district = [];
            this.locationMaster.map(function (el) {
                if ('"' + el.parent_id + '"' == '"' + customID.id + '"') {
                    _this.district.push({ id: el.id, name: el.name });
                }
            });
        },
    },
    mounted() {
        this.$nextTick(function () {
            this.getStates();
        });
    },
};
</script>

<style scoped>
html,
body {
    margin: 0;
    padding: 0;
    width: 100%;
    height: 100%;
    box-sizing: border-box;
}
body {
    background: url(/assets/vendors/dashboard/background-img.png);
    background-color: #efdee4ff !important;
    background-repeat: repeat;
}
.errMsg {
    color: red;
    font-size: 10px;
}
.vendor-preview-upload .errMsg {
    width: 200px;
}
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

@keyframes shake {
    0% {
        transform: scale(1, 1);
    }
    25% {
        transform: scale(1.05, 1.05);
    }
    50% {
        transform: scale(1.1, 1.1);
    }
    75% {
        transform: scale(1.15, 1.15);
    }
    100% {
        transform: scale(1.2, 1.2);
    }
}
.dlt-room-btn {
    border-radius: 8px;
    width: 24px;
    height: 24px;
    display: inline-block;
    position: absolute;
    top: 10px;
    right: 10px;
    text-align: center;
    background-color: rgba(244, 63, 94, 0.5);
}

.tooltipp {
    position: relative;
    display: inline-block;
    border-bottom: 1px dotted black; /* If you want dots under the hoverable text */
}
.tooltipp .tooltipptext {
    visibility: hidden;
    width: 120px;
    background-color: black;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;
    position: absolute;
    z-index: 1;
    top: -5px;
    left: 110%;
}
.tooltipp .tooltipptext::after {
    content: "";
    position: absolute;
    top: 50%;
    right: 100%;
    margin-top: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: transparent black transparent transparent;
}
.tooltipp:hover .tooltipptext {
    visibility: visible;
}

/* Nav Tab CSS Start*/

.about {
    background: var(--clr-white);
    border-radius: var(--radius);
    display: grid;
    grid-template-rows: auto 1fr;
}

.btn-container {
    display: flex;
    flex-direction: row;
    justify-content: center;
    margin: 1em 0;
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

.about-content {
    border-bottom-left-radius: var(--radius);
    border-bottom-right-radius: var(--radius);
    padding: 2rem 1.5rem;
}

/* hide content */
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

/* Nav Tab CSS Ends */

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

#vendor-details > h1,
#contact-details > h1,
#price-policy > h1 {
    font-family: Segoe UI;
    font-style: normal;
    font-weight: 600;
    font-size: 17.1823px;
    line-height: 18px;
    text-align: center;
    text-transform: capitalize;
    color: #461952;
}

.vendor-preview-form-fields h3 {
    font-family: Segoe UI;
    font-style: normal;
    font-weight: 600;
    font-size: 15.1823px;
    line-height: 18px;
    text-transform: capitalize;
    color: #461952;
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
    border: 0.179498px solid #7e7979;
    box-sizing: border-box;
    border-radius: 3.29558px;
    font-family: Segoe UI;
    font-style: normal;
    font-weight: normal;
    font-size: 16.23896px;
    line-height: 11px;
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

.vendor-address-form-fields select,
.vendor-details-form-fields select {
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
.vendor-address-form-fields option,
.vendor-details-form-fields select {
    font-family: Segoe UI;
    font-style: normal;
    font-weight: normal;
    font-size: 10px;
    line-height: 13px;
    color: #3d3838;
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
    top: 25px;
    position: absolute;
}

/* add room form css start */

#vendor-add-party-area-single {
    background: #ffffff;
    border: 0.164779px solid #2d2a2a;
    box-sizing: border-box;
    border-radius: 3.29558px;
}
.vendor-add-party-area-single {
    display: flex;
    background: #ffffff;
    border: 0.164779px solid #2d2a2a;
    box-sizing: border-box;
    border-radius: 3.29558px;
    padding: 10px 30px;
    margin-bottom: 10px;
}

.vendor-add-party-area-single > div:nth-child(1) {
    font-family: "Segoe UI";
    font-style: normal;
    font-weight: 600;
    font-size: 12px;
    line-height: 16px;
    color: #000000;
    vertical-align: middle;
}
.vendor-add-party-area-single > div:nth-child(2) {
    display: flex;
}
.vendor-add-party-area-single > div:nth-child(2) > label {
    display: flex;
    flex-direction: column;
    border: 0.164779px solid #2d2a2a;
    box-sizing: border-box;
    border-radius: 3.29558px;
    font-family: "Segoe UI";
    font-style: normal;
    font-weight: 400;
    font-size: 8.23896px;
    line-height: 11px;
    text-align: center;
    color: #000000;
    padding: 5px 15px;
    margin-right: 10px;
}
.vendor-add-party-area-single > div:nth-child(2) > label > input {
    border: none;
    outline: none;
    background-color: white !important;
    margin-bottom: 10px;
    text-align: center;
}
.addpartyhall {
    outline: none;
    background-color: white !important;
    margin-bottom: 10px;
    border-bottom: 0.164779px solid #2d2a2a !important;
    width: 100%;
}
.vendor-add-party-area-single > div:nth-child(2) > div {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100px;
}
.vendor-add-party-area-single > div:nth-child(2) > div > button {
    border: none;
    outline: none;
    background: #c4456f;
    box-shadow: 0px 0px 0.52193px 0.52193px rgba(0, 0, 0, 0.25);
    border-radius: 35.5263px;
    font-family: "Segoe UI";
    font-style: normal;
    font-weight: 600;
    font-size: 12.2493px;
    line-height: 15px;
    text-align: center;
    text-transform: capitalize;
    padding: 10px;
    margin-right: 5px;

    color: #ffffff;
}
.vendor-add-party-area-single > div:nth-child(2) > div > button > img {
    height: 20px;
    width: 17px;
}
.vendor-add-party-area-single select {
    width: 100%;
    padding: 11px 0;
    padding-left: 22px;
    border: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    background-color: #ffffff !important;
    background-image: url("/assets/vendors/landing/dropdown.svg");
    background-repeat: no-repeat;
    background-position: 98%;
    background-size: 20px;
    border-radius: 5px;
    border: none;
}
.vendor-add-party-area-single select option {
    font-family: Segoe UI;
    font-style: normal;
    font-weight: normal;
    font-size: 10px;
    line-height: 13px;
    background-color: #ffffff !important;

    color: #3d3838;
}

#vendor-about > h1 {
    font-family: Segoe UI;
    font-style: normal;
    font-weight: 600;
    font-size: 17.1823px;
    line-height: 18px;
    text-align: center;
    text-transform: capitalize;
    color: #461952;
}
#vendor-add-space > h1 {
    font-family: Segoe UI;
    font-style: normal;
    font-weight: 600;
    font-size: 17.1823px;
    line-height: 18px;
    text-align: center;
    text-transform: capitalize;
    color: #461952;
}
#vendor-add-party-area > h1 {
    font-family: Segoe UI;
    font-style: normal;
    font-weight: 600;
    font-size: 17.1823px;
    line-height: 18px;
    text-align: center;
    text-transform: capitalize;
    color: #461952;
}
.vendor-preview-form-fields {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    column-gap: 12px;
    row-gap: 4px;
}
.vendor-preview-form-fields > label {
    grid-column-start: 1;
    grid-column-end: -1;
}
.vendor-preview-form-fields > label:nth-child(3) {
    grid-column-start: 1;
    grid-column-end: 2;
}
.vendor-preview-form-fields > label:nth-child(4) {
    grid-column-start: 2;
    grid-column-end: 3;
}
.vendor-preview-form-fields > label {
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
.vendor-preview-form-fields > label > input,
textarea {
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

.vendor-addspace-form-feilds label:nth-of-type(odd) {
    grid-column-start: 1;
    grid-column-end: 2;
}
.vendor-addspace-form-feilds label:nth-of-type(even) {
    grid-column-start: 2;
    grid-column-end: 3;
}
.vendor-addspace-form-feilds ul {
    display: flex;
    flex-wrap: wrap;
}
.vendor-addspace-form-feilds ul > li {
    margin-right: 30px;
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
    border-radius: 22.4987px;
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
#vendor-add-party-area .ven-profile-form-submit > button:nth-child(1) {
    background: rgba(255, 255, 255, 0.8);
    box-shadow: 0px 2.80602px 2.80602px rgba(0, 0, 0, 0.25);
    outline: none;
    border: 0;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    margin-left: 15px;
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
    padding: 0;
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
