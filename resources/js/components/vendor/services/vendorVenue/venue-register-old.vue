<template>
    <div>
        <Services
            @clickedAdd="showForm('scroll', true)"
            @edit="editForm($event)"
            @deleted="form = false"
            :vendorCat="this.vendorCat"
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
                <h2 id="ven-profile-form-head">Venue Form</h2>
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
                </div>
                <div class="about-content forms">
                    <form
                        @submit.prevent="submitForm1($event)"
                        class="content active"
                        id="vendor-details"
                        data-id="vendor-add-party-area"
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
                        <div class="vendor-details-form-fields">
                            <label for="accName">
                                Venue Name
                                <input
                                    type="text"
                                    name="vendorFirstName"
                                    id="vendorFirstName"
                                    placeholder="Enter venue name"
                                    required
                                    v-model="addVenue.name"
                                />
                                <span
                                    v-if="errors && errors.name"
                                    class="errMsg"
                                    >{{ errors.name[0] }}</span
                                >
                            </label>
                            <label for="accPhone1">
                                Phone Number - 1
                                <input
                                    type="text"
                                    name="accPhone1"
                                    id="accPhone1"
                                    required
                                    placeholder="Enter venue contact number"
                                    v-model="addVenue.number_1"
                                />
                                <span
                                    v-if="errors && errors.number_1"
                                    class="errMsg"
                                    >{{ errors.number_1[0] }}</span
                                >
                            </label>
                            <label for="accPhone2">
                                Phone Number - 2
                                <input
                                    type="text"
                                    name="accPhone2"
                                    id="accPhone2"
                                    required
                                    placeholder="Enter venue contact number"
                                    v-model="addVenue.number_2"
                                />
                                <span
                                    v-if="errors && errors.number_2"
                                    class="errMsg"
                                    >{{ errors.number_2[0] }}</span
                                >
                            </label>
                        </div>
                        <div class="vendor-address-form-fields">
                            <label for="accType">
                                Venue type
                                <select
                                    v-model="addVenue.type"
                                    name="accType"
                                    id="accType"
                                    required
                                >
                                    <option hidden disabled selected>
                                        Select vendor’s category
                                    </option>
                                    <option
                                        v-for="item in subCategories"
                                        :key="item.id"
                                        :value="item.id"
                                    >
                                        {{ item.name }}
                                    </option>
                                </select>
                                <span
                                    v-if="errors && errors.type"
                                    class="errMsg"
                                    >{{ errors.type[0] }}</span
                                >
                            </label>
                            <label for="accTypeStar">
                                Venue Stars
                                <select
                                    v-model="addVenue.stars"
                                    name="accType"
                                    id="accType"
                                    required
                                >
                                    <option hidden disabled selected>
                                        Select vendor’s category
                                    </option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                                <span
                                    v-if="errors && errors.stars"
                                    class="errMsg"
                                    >{{ errors.stars[0] }}</span
                                >
                            </label>
                            <label for="accAddress">
                                Address Line 1
                                <input
                                    type="text"
                                    name="accAddress"
                                    id="accAddress"
                                    placeholder="Enter address"
                                    required
                                    v-model="addVenue.address"
                                />
                                <span
                                    v-if="errors && errors.address"
                                    class="errMsg"
                                    >{{ errors.address[0] }}</span
                                >
                            </label>
                            <label for="accaddress">
                                Address Line 2
                                <input
                                    type="text"
                                    name="accaddress"
                                    id="accaddress"
                                    placeholder="Enter address"
                                    required
                                    v-model="addVenue.area"
                                />
                                <span
                                    v-if="errors && errors.area"
                                    class="errMsg"
                                    >{{ errors.area[0] }}</span
                                >
                            </label>
                            <label for="accstate">
                                State
                                <select
                                    v-model="addVenue.state"
                                    name="accstate"
                                    id="accstate"
                                    required
                                    @change="getDistricts($event)"
                                >
                                    <option hidden disabled selected>
                                        Select vendor’s category
                                    </option>
                                    <option
                                        v-for="(item, index) in states"
                                        :key="index"
                                        :value="item"
                                    >
                                        {{ item }}
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
                                    v-model="addVenue.location_id"
                                    name="accdistrict"
                                    id="accdistrict"
                                    required
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
                            <label for="vendorZipCode">
                                Zip Code
                                <input
                                    type="text"
                                    name="vendorZipCode"
                                    id="vendorZipCode"
                                    placeholder="Enter zip code"
                                    required
                                    v-model="addVenue.zipcode"
                                />
                                <span
                                    v-if="errors && errors.zipcode"
                                    class="errMsg"
                                    >{{ errors.zipcode[0] }}</span
                                >
                            </label>
                            <label for="vendorCountry">
                                Country
                                <input
                                    type="text"
                                    name="vendorCountry"
                                    id="vendorCountry"
                                    placeholder="Enter country name"
                                    required
                                    v-model="addVenue.country"
                                />
                                <span
                                    v-if="errors && errors.country"
                                    class="errMsg"
                                    >{{ errors.country[0] }}</span
                                >
                            </label>
                            <label for="acclatitude">
                                Latitude
                                <input
                                    type="text"
                                    name="acclatitude"
                                    id="acclatitude"
                                    placeholder="Enter latitude"
                                    required
                                    v-model="addVenue.latitude"
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
                                    required
                                    v-model="addVenue.longitude"
                                />
                                <span
                                    v-if="errors && errors.longitude"
                                    class="errMsg"
                                    >{{ errors.longitude[0] }}</span
                                >
                            </label>
                            <label for="vendorLocationLink">
                                <input
                                    type="text"
                                    name="vendorLocationLink"
                                    id="vendorLocationLink"
                                    placeholder="Add location link"
                                    required
                                    v-model="addVenue.map"
                                />
                                <button id="location-link">
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
                        <div class="vendor-preview-form-fields"></div>
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
                        <div>
                            <div
                                v-for="(item, index) in partyPlaces"
                                :key="index"
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
                                            required
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
                                            required
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
                                        <button
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
                                        </button>
                                        <button
                                            @click="
                                                editPartyArea($event, 'save')
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
                            </div>
                            <form
                                @submit.prevent="editPartyArea($event, 'add')"
                                class="vendor-add-party-area-single"
                            >
                                <div style="flex: 1; align-self: center">
                                    Add party area
                                    <select
                                        name="party-area"
                                        id="party-area-add"
                                        required
                                        v-model="addPartyPlace.name"
                                    >
                                        <option value="" disabled selected>
                                            Select Category
                                        </option>
                                        <option value="a">a</option>
                                        <option value="b">b</option>
                                        <option value="c">c</option>
                                    </select>
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
                                            required
                                            v-model="addPartyPlace.Seating"
                                        />
                                    </label>
                                    <label for="maxpool">
                                        <span style="margin-bottom: 15px"
                                            >Maximum capacity</span
                                        >
                                        <input
                                            required
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
                            </form>
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
                        <h1>Vendor profile preview</h1>
                        <div
                            v-if="formEdit.form3"
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
                            <label for="vendorAbout">
                                About
                                <textarea
                                    name="vendorAbout"
                                    id="vendorAbout"
                                    rows="10"
                                    required
                                    v-model="addVenue1.description"
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
                                    required
                                    @keydown.enter.prevent="addfeatures($event)"
                                ></textarea>
                                <ul v-if="addVenue1.features != null">
                                    <li
                                        v-for="(
                                            item, index
                                        ) in addVenue1.features"
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
                            <label for="vendorStartingPrice">
                                Veg/ Per Plate Price
                                <input
                                    type="text"
                                    name="vendorStartingPrice"
                                    id="vendorStartingPrice"
                                    placeholder=""
                                    required
                                    v-model="addVenue1.veg_plate"
                                />
                                <span
                                    v-if="errors && errors.veg_plate"
                                    class="errMsg"
                                    >{{ errors.veg_plate[0] }}</span
                                >
                            </label>
                            <label for="vendorEndingPrice">
                                Non Veg/ Per Plate Price
                                <input
                                    type="text"
                                    name="vendorEndingPrice"
                                    id="vendorEndingPrice"
                                    placeholder=""
                                    required
                                    v-model="addVenue1.non_veg_plate"
                                />
                                <span
                                    v-if="errors && errors.non_veg_plate"
                                    class="errMsg"
                                    >{{ errors.non_veg_plate[0] }}</span
                                >
                            </label>
                            <label for="Facebook_Profile_link">
                                Facebook Profile link
                                <input
                                    type="text"
                                    name="Facebook_Profile_link"
                                    id="Facebook_Profile_link"
                                    placeholder="Insert facebook link"
                                    required
                                    v-model="addVenue1.facebook_link"
                                />
                                <span
                                    v-if="errors && errors.facebook_link"
                                    class="errMsg"
                                    >{{ errors.facebook_link[0] }}</span
                                >
                            </label>
                            <label for="Instagram_Profile_link">
                                Instagram Profile link
                                <input
                                    type="text"
                                    name="Instagram_Profile_link"
                                    id="Instagram_Profile_link"
                                    required
                                    placeholder="Insert instagram link"
                                    v-model="addVenue1.instagram_link"
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
                                    required
                                    v-model="addVenue1.twitter_link"
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
                                    required
                                    v-model="addVenue1.snapchat_link"
                                />
                                <span
                                    v-if="errors && errors.snapchat_link"
                                    class="errMsg"
                                    >{{ errors.snapchat_link[0] }}</span
                                >
                            </label>
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
                                        required
                                        multiple
                                        @change="
                                            count($event);
                                            uploadImg($event);
                                        "
                                    />
                                </label>
                                <div
                                    v-if="formEdit.form3 == false"
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
                                            <span
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
                                            </span>
                                            <img
                                                v-if="formSubmitted.form4"
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
                                            <span
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
                                            </span>
                                            <video
                                                v-if="formSubmitted.form4"
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
                                v-if="formSubmitted.form3 == false"
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
                    >
                        <h1>Vendor profile preview</h1>
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
                        <div
                            class="vendor-preview-form-fields vendor-addspace-form-feilds tooltipp"
                        >
                            <span class="tooltipptext">Press Enter to add</span>
                            <label for="businessFacilities">
                                Timing And Slots
                                <input
                                    type="text"
                                    name="businessFacilities"
                                    id="businessFacilities"
                                    data-id="Timing And Slots"
                                    placeholder="Add timing and slots"
                                    required
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
                            <label for="FoodAndDrink">
                                Advances
                                <input
                                    type="text"
                                    name="FoodAndDrink"
                                    id="FoodAndDrink"
                                    data-id="Advances"
                                    placeholder="Add Advances"
                                    required
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
                            <label for="SafetyAndSecurity">
                                Taxes
                                <input
                                    type="text"
                                    name="SafetyAndSecurity"
                                    id="SafetyAndSecurity"
                                    data-id="Taxes"
                                    placeholder="Add Taxes"
                                    required
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
                            <label for="Cancellation">
                                Cancellation
                                <input
                                    type="text"
                                    name="Cancellation"
                                    id="Cancellation"
                                    data-id="Cancellation"
                                    placeholder="Add Cancellation"
                                    required
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
                            <label for="space">
                                Space preference
                                <input
                                    type="text"
                                    name="MediaTecnology"
                                    id="space"
                                    data-id="Space preference"
                                    placeholder="Add Decor policy"
                                    required
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
                                    </li>
                                </ul>
                                <span
                                    v-if="
                                        errors &&
                                        errors[
                                            'policy.Space preference.facilities.0'
                                        ]
                                    "
                                    class="errMsg"
                                    >{{
                                        errors[
                                            "policy.Space preference.facilities.0"
                                        ][0]
                                    }}</span
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
                                    required
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
                                    required
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
                                    required
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
                                    required
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
                                    required
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
                                    required
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
                                    required
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
                                v-if="formSubmitted.form4 == false"
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
    props: ["vendor", "vendorCat", "subcat"],
    data() {
        return {
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
            locationMaster: [],
            states: [],
            district: [],
            image: null,
            againUpload: false,
            imagePreview: [],
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
            },
            formEdit: {
                form1: false,
                form2: false,
                form3: false,
                form4: false,
            },
            formUpdate: {
                form1: false,
                form2: false,
                form3: false,
                form4: false,
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
            addVenue: {
                name: null,
                number_1: null,
                number_2: null,
                type: null,
                stars: null,
                address: null,
                area: null,
                state: null,
                location_id: null,
                zipcode: null,
                country: null,
                latitude: null,
                longitude: null,
                map: null,
            },
            addVenue1: {
                veg_plate: null,
                non_veg_plate: null,
                facebook_link: null,
                instagram_link: null,
                twitter_link: null,
                snapchat_link: null,
                description: null,
                features: null,
            },
            addPartyPlace: {
                name: null,
                Seating: null,
                "Maximum capacity": null,
            },
            partyPlaces: [
                { name: "Pool Side", Seating: 0, "Maximum capacity": 0 },
            ],
        };
    },
    methods: {
        deleteImage(item, mainId, name, id, type) {
            let _this = this;
            if (item == "venue") {
                if (_this.formUpdate.form3 == false) {
                    return;
                }
                let vidName = name.substring(name.lastIndexOf("/") + 1);
                let data = [item, mainId, vidName, id, type];
                axios
                    .delete(`/api/vendor/addvenue/${data}`)
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
                for (const key in this.addVenue1) {
                    this.addVenue1[key] = null;
                }
                this.partyPlaces = [
                    { name: "Pool Side", Seating: 0, "Maximum capacity": 0 },
                ];
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
            if (this.addVenue1.features != null) {
                if (this.addVenue1.features.length > 0) {
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
                    console.log(response.data);
                    for (const key in _this.addVenue) {
                        for (const key2 in response.data) {
                            if (key == key2) {
                                _this.addVenue[key] = response.data[key2];
                                _this.formSubmitted.form1 = true;
                                _this.formEdit.form1 = true;
                            }
                        }
                    }

                    let state = _this.addVenue.state;
                    _this.district = [];
                    _this.locationMaster.map(function (el) {
                        if ('"' + el.state + '"' == '"' + state + '"') {
                            _this.district.push({ id: el.id, name: el.name });
                        }
                    });
                    for (const key in _this.addVenue1) {
                        for (const key2 in response.data) {
                            if (key == key2) {
                                _this.addVenue1[key] = response.data[key2];
                            }
                        }
                    }
                    if (response.data.party_area != null) {
                        if (response.data.party_area.length > 0) {
                            _this.partyPlaces = response.data.party_area;
                            _this.formSubmitted.form2 = true;
                            _this.formEdit.form2 = true;
                        } else {
                            _this.partyPlaces = [];
                        }
                    } else {
                        _this.partyPlaces = [];
                    }
                    if (response.data.venue_facilities != null) {
                        _this.addSpaceSubmit = response.data.venue_facilities;
                    } else {
                        _this.addSpaceSubmit = {};
                    }
                    if (response.data.venue_policies != null) {
                        _this.addSpacePolicy = response.data.venue_policies;
                        _this.formSubmitted.form4 = true;
                        _this.formEdit.form4 = true;
                    } else {
                        _this.addSpacePolicy = {};
                    }
                    if (response.data.images != null) {
                        if (response.data.images.length > 0) {
                            _this.imagePreview = response.data.images;
                            _this.formSubmitted.form3 = true;
                            _this.formEdit.form3 = true;
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
                            // if (id == 1) {
                            //     continue;
                            // }
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
            if (this.formSubmitted.form3 == false) {
                this.imagePreview = [];
                this.videoPreview = [];
            }
            if (this.formSubmitted.form3 == true) {
                _this.newimagePreview = [];
                _this.newvideoPreview = [];
                this.image.forEach(function (item) {
                    if (item.type.split("/")[0] == "image") {
                        _this.newimagePreview.push(URL.createObjectURL(item));
                    }
                    if (item.type.split("/")[0] == "video") {
                        _this.newvideoPreview.push(URL.createObjectURL(item));
                    }
                });
                return;
            }
            this.image.forEach(function (item) {
                if (item.type.split("/")[0] == "image") {
                    _this.imagePreview.push(URL.createObjectURL(item));
                }
                if (item.type.split("/")[0] == "video") {
                    _this.videoPreview.push(URL.createObjectURL(item));
                }
            });
        },
        submitForm1(e) {
            var _this = this;
            _this.errors = null;
            let name = "create";
            let formData = new FormData();
            let data = JSON.stringify(_this.addVenue);
            formData.append("contentType", "details");
            formData.append("data", data);
            formData.append("catId", _this.vendorCategories.id);
            formData.append("vendorId", _this.vendorDetails.id);
            if (this.formUpdate.form1 == true) {
                formData.append("_method", "PATCH");
                this.loader = true;
                axios
                    .post(
                        `/api/vendor/addvenue/${_this.accomodation_id}`,
                        formData
                    )
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
                .post(`/api/vendor/addvenue`, formData)
                .then(function (response) {
                    _this.loader = false;
                    _this.toggleForm("vendor-add-party-area", false);
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
        updateForm(e) {
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
            let data = JSON.stringify(_this.partyPlaces);
            formData.append("contentType", "partyArea");
            formData.append("data", data);
            formData.append("_method", "PATCH");
            this.loader = true;
            axios
                .post(`/api/vendor/addvenue/${_this.accomodation_id}`, formData)
                .then(function (response) {
                    _this.loader = false;
                    _this.toggleForm("vendor-about", false);
                    _this.formSubmitted.form2 = true;
                    _this.accomodation_id = response.data;
                    if (_this.formUpdate.form2 == true) {
                        _this.message = "Party Places Updated";
                    } else {
                        _this.message =
                            "Party Places added successfully!! Kindly Fill other Details";
                    }
                    _this.formUpdate.form2 = false;
                    _this.formEdit.form2 = true;
                    // $(".forms")
                    //     .children()
                    //     .eq(1)
                    //     .children()
                    //     .eq(1)
                    //     .find("button")
                    //     .addClass("shake");
                    $(
                        `#vendor-add-party-area .ven-profile-form-submit button[type=submit]`
                    ).css("display", "none");
                    let current = $(".forms").children().eq(1).attr("id");

                    //console.log(current, btn);
                    $(`#${current} :input`).attr("disabled", true);
                    $(`#${current} .editbtn :input`).removeAttr("disabled");
                    $(`#${current} .editbtn button`).addClass("shake");
                    $(`#${current} .ven-profile-form-submit :input`).removeAttr(
                        "disabled"
                    );
                    $(
                        `#${current}  .ven-profile-form-submit :submit").attr(
                                "disabled`,
                        true
                    );

                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                })
                .catch((error) => {
                    _this.loader = false;
                    _this.errors = error.response.data.errors;
                });
        },
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
                this.toggleForm("vendor-add-party-area", false);
                return;
            }
            if (
                _this.addVenue1.features == null ||
                _this.addVenue1.features.length == 0
            ) {
                _this.errors = {
                    features: ["Press Enter to add features"],
                };
                //console.log(0);
                return;
            }
            const config = {
                headers: { "content-type": "multipart/form-data" },
            };
            let formData = new FormData();
            let data = JSON.stringify(_this.addVenue1);
            formData.append("contentType", "image");
            if (this.image != null) {
                for (var i = 0; i < this.image.length; i++) {
                    let file = this.image[i];
                    //console.log(file);
                    formData.append("files[" + i + "]", file);
                }
            }
            //formData.append("image", this.image);
            formData.append("data", data);
            if (_this.formUpdate.form3) {
                formData.append("uploadimg", "uploadimg");
            }

            formData.append("_method", "PATCH");
            this.loader = true;
            axios
                .post(
                    `/api/vendor/addvenue/${_this.accomodation_id}`,
                    formData,
                    config
                )
                .then(function (response) {
                    _this.formSubmitted.form3 = true;
                    _this.loader = false;
                    _this.image = null;
                    _this.toggleForm("vendor-add-space", false);
                    $(".forms")
                        .children()
                        .eq(2)
                        .children()
                        .eq(1)
                        .find("button")
                        .addClass("shake");
                    if (_this.formUpdate.form3 == true) {
                        _this.message = "Gallery Updated";
                    } else {
                        _this.message =
                            "Venue Added Successfully!! Kindly Fill other Details";
                    }
                    _this.formUpdate.form3 = false;
                    _this.formEdit.form3 = true;
                    $(
                        `#vendor-about .ven-profile-form-submit button[type=submit]`
                    ).css("display", "none");
                    console.log(
                        $(
                            `#vvendor-about .ven-profile-form-submit button[type=submit]`
                        ).css("display", "none")
                    );
                    let current = $(".forms").children().eq(2);
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
                this.toggleForm("vendor-add-party-area", false);
                return;
            }
            if (this.formSubmitted.form3 == false) {
                this.message = "kindly fill third form";
                setTimeout(function () {
                    _this.message = null;
                }, 3000);
                this.toggleForm("vendor-about", false);
                return;
            }

            let formData = new FormData();
            let data = JSON.stringify(_this.addSpaceSubmit);
            let data1 = JSON.stringify(_this.addSpacePolicy);
            formData.append("contentType", "json");
            formData.append("data", data);
            formData.append("data1", data1);
            formData.append("_method", "PATCH");
            this.loader = true;
            axios
                .post(`/api/vendor/addvenue/${_this.accomodation_id}`, formData)
                .then(function (response) {
                    _this.formSubmitted.form4 = true;
                    _this.accomodation_id = response.data;
                    $(".forms")
                        .children()
                        .eq(3)
                        .children()
                        .eq(1)
                        .find("button")
                        .addClass("shake");
                    _this.loader = false;
                    if (_this.formUpdate.form4 == true) {
                        _this.message = "Amenities Updated";
                    } else {
                        _this.message = "Amenities Added Successfully!!";
                    }
                    _this.formEdit.form4 = true;
                    _this.formUpdate.form4 = false;
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

                this.partyPlaces.push(_this.addPartyPlace);
                this.addPartyPlace = {
                    name: null,
                    Seating: null,
                    "Maximum capacity": null,
                };
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
                this.partyPlaces.splice(index, 1);
            }
            if (btn == "save") {
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
            if (this.addVenue1.features == null) {
                this.addVenue1.features = [];
            }
            if (!e.currentTarget.value) {
                return;
            }
            if (!e.currentTarget.value.replace(/\s/g, "").length) {
                return;
            }
            this.addVenue1.features.push(e.currentTarget.value);
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
            let v = this.vendor.id;
            axios
                .get(`/api/vendor/addacc`)
                .then(function (response) {
                    console.log(response);
                    _this.locationMaster = response.data[0];
                    _this.states = [
                        ...new Set(
                            _this.locationMaster.map((item) => item.state)
                        ),
                    ];
                })
                .catch((errors) => {
                    console.log("Get All: " + errors);
                });
        },
        getDistricts(e) {
            let _this = this;
            let val = e.currentTarget.value;

            _this.district = [];
            this.locationMaster.map(function (el) {
                if ('"' + el.state + '"' == '"' + val + '"') {
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
.vendor-address-form-fields > label:first-child {
    grid-column-start: 1;
    grid-column-end: -1;
}
.vendor-address-form-fields > label:last-child {
    grid-column-start: 1;
    grid-column-end: -1;
    position: relative;
}
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

.vendor-address-form-fields select {
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
.vendor-address-form-fields option {
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
    font-size: 11.2493px;
    line-height: 15px;
    text-align: center;
    text-transform: capitalize;

    color: #ffffff;
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
