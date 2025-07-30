<template>
    <div>
        <Services
            @clickedAdd="showForm('scroll', true)"
            @edit="editForm($event)"
            @deleted="form = false"
            :vendorCat="this.selectedSubCat"
            :url="'accommodation'"
            :vendor="this.vendor"
            :added="this.added"
            ref="services"
        ></Services>
        <div
            v-show="form"
            style="position: relative"
            ref="scroll"
            class="container ven-profile-form"
        >
            <div class="row">
                <h2 id="ven-profile-form-head">Accomodation Form</h2>
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
                        title="Accomodation Details"
                        @click="toggleForm($event, true)"
                    ></button>
                    <button
                        type="button"
                        class="tab-btn"
                        data-id="vendor-add-room"
                        title="Room Details"
                        @click="
                            toggleForm($event, true);
                            showRoomPics();
                        "
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
                        title="Amenities"
                        @click="toggleForm($event, true)"
                    ></button>
                </div>
                <div class="about-content forms">
                    <form
                        @submit.prevent="submitForm1($event)"
                        data-id="vendor-add-room"
                        class="content active"
                        id="vendor-details"
                    >
                        <h1>Accomodation details</h1>
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
                                Name
                                <input
                                    type="text"
                                    name="vendorFirstName"
                                    id="vendorFirstName"
                                    placeholder="Enter your first name"
                                    v-model="addAccomodation.name"
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
                                    placeholder="Enter accomodation contact number"
                                    v-model="addAccomodation.number_1"
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
                                    placeholder="Enter accomodation contact number"
                                    v-model="addAccomodation.number_2"
                                />
                                <span
                                    v-if="errors && errors.number_2"
                                    class="errMsg"
                                    >{{ errors.number_2[0] }}</span
                                >
                            </label>
                        </div>
                        <div class="vendor-address-form-fields">
                            <!-- <label for="accType">
                                Accomodation type
                                <select
                                    v-model="addAccomodation.type"
                                    name="accType"
                                    id="accType"
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
                            </label> -->
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
                            <label for="accTypeStar">
                                Accomodation Stars
                                <select
                                    v-model="addAccomodation.stars"
                                    name="accType"
                                    id="accType"
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
                                    v-model="addAccomodation.address1"
                                />
                                <span
                                    v-if="errors && errors.address1"
                                    class="errMsg"
                                    >{{ errors.address1[0] }}</span
                                >
                            </label>
                            <label for="accAddress1">
                                Address Line 2
                                <input
                                    type="text"
                                    name="accAddress1"
                                    id="accAddress1"
                                    placeholder="Enter address"
                                    v-model="addAccomodation.address2"
                                />
                                <span
                                    v-if="errors && errors.address2"
                                    class="errMsg"
                                    >{{ errors.address2[0] }}</span
                                >
                            </label>
                            <label for="accstate">
                                State
                                <select
                                    v-model="addAccomodation.state"
                                    name="accstate"
                                    id="accstate"
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
                                    v-model="addAccomodation.location_id"
                                    name="accdistrict"
                                    id="accdistrict"
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
                                    placeholder="Enter your zip code"
                                    v-model="addAccomodation.zipcode"
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
                                    placeholder="Enter your country name"
                                    v-model="addAccomodation.country"
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
                                    v-model="addAccomodation.latitude"
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
                                    v-model="addAccomodation.longitude"
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
                                    v-model="addAccomodation.map"
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
                                data-id="vendor-add-room"
                                @click="
                                    toggleForm($event, true);
                                    showRoomPics();
                                "
                                type="button"
                            >
                                <img src="/assets/vendors/Frame.svg" alt="" />
                            </button>
                        </div>
                    </form>
                    <div class="content" id="vendor-add-room">
                        <h1>Add rooms</h1>
                        <div class="vendor-add-room-btn">
                            <button @click="openRoomForm($event, true)">
                                + Add new room
                            </button>

                            <div
                                v-if="hidden"
                                style="
                                    z-index: 9999999;
                                    width: 100%;
                                    height: 100vh;
                                    position: fixed;
                                    top: 0;
                                    left: 0;
                                    background: rgba(0, 0, 0, 0.7);
                                "
                            >
                                <form
                                    @submit.prevent="submitForm2($event)"
                                    class="vendor-add-room-form-popup"
                                >
                                    <div>
                                        <span>ADD ROOMS</span>
                                        <button type="button">
                                            <i
                                                style="color: #afafaf"
                                                class="fas fa-times-circle"
                                                @click="hidden = false"
                                            ></i>
                                        </button>
                                    </div>
                                    <div>
                                        <input
                                            type="text"
                                            name="roomType"
                                            placeholder="Room Type"
                                            id="roomType"
                                            v-model="addRoomSubmit.room_type"
                                        />
                                        <span
                                            v-if="errors && errors.room_type"
                                            class="errMsg"
                                            >{{ errors.room_type[0] }}</span
                                        >
                                        <label for="sleeps">
                                            <div>Sleeps</div>
                                            <div>
                                                Number of people can sleep
                                            </div>
                                            <input
                                                type="text"
                                                name="sleep"
                                                id="sleeps"
                                                v-model="addRoomSubmit.sleeps"
                                            />
                                            <span
                                                v-if="errors && errors.sleeps"
                                                class="errMsg"
                                                >{{ errors.sleeps[0] }}</span
                                            >
                                        </label>
                                        <label for="Beds_available">
                                            <div>Beds available</div>
                                            <div>Number of beds available</div>
                                            <input
                                                type="text"
                                                name="Beds_available"
                                                id="Beds_available"
                                                v-model="
                                                    addRoomSubmit.beds_available
                                                "
                                            />
                                            <span
                                                v-if="
                                                    errors &&
                                                    errors.beds_available
                                                "
                                                class="errMsg"
                                                >{{
                                                    errors.beds_available[0]
                                                }}</span
                                            >
                                        </label>
                                        <label for="Total_rooms">
                                            <div>Total rooms</div>
                                            <div>Number of rooms</div>
                                            <input
                                                type="text"
                                                name="Total_rooms"
                                                id="Total_rooms"
                                                v-model="
                                                    addRoomSubmit.total_rooms
                                                "
                                            />
                                            <span
                                                v-if="
                                                    errors && errors.total_rooms
                                                "
                                                class="errMsg"
                                                >{{
                                                    errors.total_rooms[0]
                                                }}</span
                                            >
                                        </label>
                                        <label
                                            class="tooltipp"
                                            for="room_specification"
                                        >
                                            <span class="tooltipptext"
                                                >Press Enter to add
                                                specifications!!</span
                                            >
                                            Room specifications
                                            <div
                                                class="room-specifications-facilities"
                                            >
                                                <div
                                                    style="
                                                        display: flex;
                                                        flex-wrap: wrap;
                                                    "
                                                >
                                                    <div
                                                        class="room-specifications-facilities-blocks"
                                                        v-for="(
                                                            item, index
                                                        ) in addRoomSubmit.room_specifications"
                                                        :key="index"
                                                    >
                                                        <object
                                                            v-if="item.img"
                                                            :data="
                                                                `/assets/vendors/dashboard/` +
                                                                item.img
                                                            "
                                                            type="image/svg+xml"
                                                        ></object>
                                                        <span>{{
                                                            item.name
                                                        }}</span>
                                                        <i
                                                            style="
                                                                margin=left: 5px;
                                                                color: white;
                                                                margin: auto 3px;
                                                                font-size: 11px;
                                                                cursor: pointer;
                                                            "
                                                            class="fas fa-times"
                                                            @click="
                                                                hideBlock(
                                                                    $event,
                                                                    index,
                                                                    'room'
                                                                )
                                                            "
                                                        ></i>
                                                    </div>
                                                </div>
                                                <input
                                                    style="
                                                        outline: none;
                                                        border: none;
                                                        min-width: 30%;
                                                        width: auto;
                                                    "
                                                    type="text"
                                                    name="room_specification"
                                                    id="room_specification"
                                                    v-on:keydown.enter.prevent="
                                                        onEnter($event)
                                                    "
                                                />
                                            </div>
                                            <div
                                                class="room-specifications-facilities-suggestions"
                                            >
                                                <div>Suggested:</div>
                                                <div
                                                    id="specification-btn-cont"
                                                >
                                                    <button
                                                        v-for="(
                                                            item, index
                                                        ) in roomSpecificationTags"
                                                        :key="index"
                                                        type="button"
                                                        :data-id="item.id"
                                                        @click="
                                                            addInput($event)
                                                        "
                                                    >
                                                        <img
                                                            :src="
                                                                `/assets/vendors/dashboard/` +
                                                                item.img
                                                            "
                                                            alt=""
                                                        />
                                                        <span>{{
                                                            item.name
                                                        }}</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </label>
                                        <label
                                            class="tooltipp"
                                            for="room_facilities"
                                        >
                                            <span class="tooltipptext"
                                                >Press Enter to add
                                                facilities!!</span
                                            >
                                            Facilities
                                            <div
                                                class="room-specifications-facilities"
                                            >
                                                <div style="display: flex">
                                                    <div
                                                        class="room-specifications-facilities-blocks"
                                                        v-for="(
                                                            item, index
                                                        ) in addRoomSubmit.room_facilities"
                                                        :key="index"
                                                    >
                                                        <span>{{
                                                            item.name
                                                        }}</span>
                                                        <i
                                                            style="
                                                                margin=left: 5px;
                                                                color: white;
                                                                margin: auto 3px;
                                                                font-size: 11px;
                                                                cursor: pointer;
                                                            "
                                                            class="fas fa-times"
                                                            @click="
                                                                hideBlock(
                                                                    $event,
                                                                    index,
                                                                    'facility'
                                                                )
                                                            "
                                                        ></i>
                                                    </div>
                                                </div>
                                                <input
                                                    style="
                                                        outline: none;
                                                        border: none;
                                                        min-width: 30%;
                                                        width: auto;
                                                    "
                                                    type="text"
                                                    name="room_facilities"
                                                    id="room_facilities"
                                                    v-on:keydown.enter.prevent="
                                                        onEnter($event)
                                                    "
                                                />
                                            </div>
                                            <div
                                                class="room-specifications-facilities-suggestions"
                                            >
                                                <div>Suggested:</div>
                                                <div id="facilities-btn-cont">
                                                    <button
                                                        v-for="(
                                                            item, index
                                                        ) in accomoFacilitiesTags"
                                                        :key="index"
                                                        type="button"
                                                        :data-id="item.id"
                                                        @click="
                                                            addInput($event)
                                                        "
                                                    >
                                                        <span>{{
                                                            item.name
                                                        }}</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </label>
                                        <label for="Price_per_room">
                                            <div>Price per room</div>
                                            <div>Price cost of each room</div>
                                            <input
                                                type="text"
                                                name="Price_per_room"
                                                id="Price_per_room"
                                                v-model="
                                                    addRoomSubmit.price_per_room
                                                "
                                            />
                                            <span
                                                v-if="
                                                    errors &&
                                                    errors.price_per_room
                                                "
                                                class="errMsg"
                                                >{{
                                                    errors.price_per_room[0]
                                                }}</span
                                            >
                                        </label>
                                        <label for="Tax_and_services">
                                            <div>
                                                Tax and services of each room
                                            </div>
                                            <input
                                                type="text"
                                                name="Tax_and_services"
                                                id="Tax_and_services"
                                                v-model="
                                                    addRoomSubmit.tax_per_room
                                                "
                                            />
                                            <span
                                                v-if="
                                                    errors &&
                                                    errors.tax_per_room
                                                "
                                                class="errMsg"
                                                >{{
                                                    errors.tax_per_room[0]
                                                }}</span
                                            >
                                        </label>
                                        <div class="vendor-preview-upload mb-2">
                                            <label for="vendorroomImagesUpload">
                                                <div
                                                    id="vendor-preview-upload-dropzone"
                                                    class="dropzone"
                                                    @dragover.prevent="
                                                        drago($event)
                                                    "
                                                    @dragleave.prevent="
                                                        dragl($event)
                                                    "
                                                    @drop.prevent="
                                                        dragdrop($event)
                                                    "
                                                >
                                                    <span>
                                                        <img
                                                            src="/assets/vendors/dashboard/ven-gallery-upload.png"
                                                            alt=""
                                                        />
                                                    </span>
                                                    <span
                                                        >Add photos/
                                                        videos</span
                                                    >
                                                    <span
                                                        >or drag and drop</span
                                                    >
                                                    <span></span>
                                                </div>
                                                <div
                                                    id="vendor-preview-upload-dragtext"
                                                ></div>
                                                <input
                                                    type="file"
                                                    name="vendorroomImagesUpload"
                                                    id="vendorroomImagesUpload"
                                                    style="opacity: 0"
                                                    multiple
                                                    @change="
                                                        count($event);
                                                        uploadRoomImg($event);
                                                    "
                                                />
                                            </label>
                                            <div
                                                v-if="formUpdate.form2 == false"
                                                style="
                                                    display: flex;
                                                    flex-wrap: wrap;
                                                "
                                            >
                                                <img
                                                    width="200px"
                                                    height="200px"
                                                    v-for="(
                                                        item, index
                                                    ) in roomimagePreview"
                                                    :key="index"
                                                    :src="item"
                                                    style="margin: 5px"
                                                    alt=""
                                                />
                                                <video
                                                    v-for="(
                                                        item, index
                                                    ) in roomvideoPreview"
                                                    :key="'A' + index"
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
                                                            pic, picindex
                                                        ) in roomimagePreview"
                                                        :key="'C' + picindex"
                                                        style="
                                                            position: relative;
                                                        "
                                                    >
                                                        <img
                                                            v-if="
                                                                formUpdate.form2
                                                            "
                                                            width="200px"
                                                            height="200px"
                                                            :src="
                                                                '/assets/vendors/uploads/' +
                                                                pic
                                                            "
                                                            style="margin: 5px"
                                                            alt=""
                                                        />
                                                        <!-- <span
                                                            class="dlt-room-btn"
                                                            @click="
                                                                deleteImage(
                                                                    'room',
                                                                    roomUpdateID,
                                                                    pic,
                                                                    picindex,
                                                                    'image'
                                                                )
                                                            "
                                                        >
                                                            <i
                                                                class="fas fa-trash"
                                                            ></i>
                                                        </span> -->
                                                    </div>
                                                    <div
                                                        v-for="(
                                                            item, index
                                                        ) in roomnewimagePreview"
                                                        :key="index"
                                                    >
                                                        <img
                                                            width="200px"
                                                            height="200px"
                                                            :src="item"
                                                            style="margin: 5px"
                                                            alt=""
                                                        />
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
                                                            vid, vidindex
                                                        ) in roomvideoPreview"
                                                        :key="'A' + vidindex"
                                                        style="
                                                            position: relative;
                                                        "
                                                    >
                                                        <!-- <span
                                                            class="dlt-room-btn"
                                                            @click="
                                                                deleteImage(
                                                                    'room',
                                                                    roomUpdateID,
                                                                    vid,
                                                                    vidindex,
                                                                    'video'
                                                                )
                                                            "
                                                        >
                                                            <i
                                                                class="fas fa-trash"
                                                            ></i>
                                                        </span> -->
                                                        <video
                                                            v-if="
                                                                formUpdate.form2
                                                            "
                                                            :src="
                                                                '/assets/vendors/uploads/' +
                                                                vid
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
                                                    </div>
                                                    <div
                                                        v-for="(
                                                            item, index
                                                        ) in roomnewvideoPreview"
                                                        :key="'B' + index"
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
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <button
                                            @click="hidden = false"
                                            type="button"
                                        >
                                            Close
                                        </button>

                                        <button
                                            v-if="formUpdate.form2 == false"
                                            type="submit"
                                        >
                                            Submit
                                        </button>
                                        <button v-else type="submit">
                                            Update
                                        </button>
                                    </div>
                                </form>
                                <flashMessage
                                    :message="message2"
                                ></flashMessage>
                            </div>
                        </div>
                        <table
                            v-if="vendorAccomRooms.length > 0"
                            class="vendor-add-room-table"
                        >
                            <tr>
                                <th style="width: 35%">Room type</th>
                                <th style="width: 10%">Sleeps</th>
                                <th style="width: 20%">Prices and Taxes</th>
                                <th style="width: 35%">Facilities</th>
                            </tr>

                            <tr
                                v-for="(item, indexxx) in vendorAccomRooms"
                                :key="indexxx"
                            >
                                <td
                                    :id="'getWidth' + item.id"
                                    style="width: 35%"
                                >
                                    <div class="vendor-add-room-table-type">
                                        <div>
                                            <u>{{ item.room_type }}</u>
                                        </div>
                                        <div>
                                            Total {{ item.total_rooms }} rooms
                                        </div>
                                        <div>
                                            <img
                                                src="/assets/vendors/dashboard/ion_bed-sharp.svg"
                                                alt=""
                                            />
                                            <span>
                                                {{ item.beds_available }}</span
                                            >
                                        </div>
                                        <div>
                                            <div
                                                v-for="(
                                                    ele, index
                                                ) in item.room_specifications"
                                                :key="index"
                                            >
                                                <img
                                                    v-if="ele.img"
                                                    :src="
                                                        '/assets/vendors/dashboard/' +
                                                        ele.img
                                                    "
                                                    alt=""
                                                />
                                                <span>{{ ele.name }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        style="max-width: 445px"
                                        ref="roomCont"
                                        v-if="item.images"
                                    >
                                        <div
                                            class="splide"
                                            :id="
                                                'room-picture-splide' + item.id
                                            "
                                            style="padding: 1em"
                                        >
                                            <div class="splide__track">
                                                <ul class="splide__list d-flex">
                                                    <li
                                                        v-for="(
                                                            ele, index
                                                        ) in item.images"
                                                        :key="'A' + index"
                                                        class="splide__slide"
                                                        style="border: none"
                                                    >
                                                        <img
                                                            width="200px"
                                                            height="200px"
                                                            :src="
                                                                '/assets/vendors/uploads/' +
                                                                ele
                                                            "
                                                            style="
                                                                margin: 5px;
                                                                border-radius: 15px;
                                                                object-fit: cover;
                                                            "
                                                            alt=""
                                                        />
                                                    </li>
                                                    <li
                                                        v-for="(
                                                            vid, index
                                                        ) in item.videos"
                                                        :key="'B' + index"
                                                        class="splide__slide"
                                                        style="border: none"
                                                    >
                                                        <video
                                                            :src="
                                                                '/assets/vendors/uploads/' +
                                                                vid
                                                            "
                                                            width="200px"
                                                            height="200px"
                                                            style="
                                                                margin: 5px;
                                                                border-radius: 15px;
                                                                object-fit: cover;
                                                            "
                                                            controls
                                                        >
                                                            <source
                                                                src="movie.mp4"
                                                                type="video/mp4"
                                                            />
                                                        </video>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td style="width: 10%">
                                    <div class="vendor-add-room-table-number">
                                        <img
                                            v-for="index in parseInt(
                                                item.sleeps
                                            )"
                                            :key="index"
                                            src="/assets/vendors/dashboard/sleep.svg"
                                            alt=""
                                        />
                                    </div>
                                </td>
                                <td style="width: 20%">
                                    <div class="vendor-add-room-table-price">
                                        <div>
                                            <i
                                                class="fa-solid fa-indian-rupee-sign"
                                            ></i
                                            >{{ item.price_per_room }}
                                        </div>
                                        <div>
                                            +<i
                                                class="fa-solid fa-indian-rupee-sign"
                                            ></i
                                            >{{ item.tax_per_room }} taxes and
                                            charges
                                        </div>
                                    </div>
                                </td>
                                <td style="width: 35%">
                                    <div
                                        class="vendor-add-room-table-facilities"
                                    >
                                        <div>
                                            <span
                                                v-for="(
                                                    elee, index
                                                ) in item.room_facilities"
                                                :key="index"
                                            >
                                                {{ elee.name }}/&nbsp
                                            </span>
                                        </div>
                                        <div>
                                            <button
                                                @click="
                                                    openRoomForm(
                                                        $event,
                                                        item.id
                                                    )
                                                "
                                                type="button"
                                            >
                                                <img
                                                    src="/assets/vendors/dashboard/iconoir_edit.svg"
                                                    alt=""
                                                />
                                            </button>
                                            <button
                                                @click="
                                                    deleteRoom($event, item.id)
                                                "
                                                type="button"
                                            >
                                                <img
                                                    src="/assets/vendors/dashboard/ant-design_delete-outlined.svg"
                                                    alt=""
                                                />
                                            </button>
                                            <button type="button">
                                                <img
                                                    src="/assets/vendors/dashboard/ant-design_save-outlined.svg"
                                                    alt=""
                                                />
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <div class="ven-profile-form-submit">
                            <!-- <button
                                v-if="false"
                                data-id="vendor-about"
                                @click="toggleForm($event)"
                                type="button"
                            >
                                Submit
                            </button> -->
                            <button
                                data-id="vendor-about"
                                @click="toggleForm($event, true)"
                                type="button"
                            >
                                <img src="/assets/vendors/Frame.svg" alt="" />
                            </button>
                        </div>
                    </div>
                    <form
                        data-id="vendor-add-space"
                        @submit.prevent="updateForm($event)"
                        class="content"
                        id="vendor-about"
                    >
                        <h1>Gallery</h1>
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
                                    v-model="addAccomodation2.about"
                                ></textarea>
                                <span
                                    v-if="errors && errors.about"
                                    class="errMsg"
                                    >{{ errors.about[0] }}</span
                                >
                            </label>
                            <label for="vendorFeatures">
                                Features
                                <textarea
                                    name="vendorFeatures"
                                    id="vendorFwatures"
                                    rows="10"
                                    v-model="addAccomodation2.features"
                                ></textarea>
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
                                    v-model="addAccomodation2.veg_plate"
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
                                    v-model="addAccomodation2.non_veg_plate"
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
                                    v-model="addAccomodation2.facebook_link"
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
                                    placeholder="Insert instagram link"
                                    v-model="addAccomodation2.instagram_link"
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
                                    v-model="addAccomodation2.twitter_link"
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
                                    v-model="addAccomodation2.snapchat_link"
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
                                        multiple
                                        @change="
                                            count($event);
                                            uploadImg($event);
                                        "
                                    />
                                </label>
                                <span
                                    v-if="errors && errors.img"
                                    class="errMsg"
                                    >{{ errors.img[0] }}</span
                                >
                                <span
                                    v-if="errors && errors.vid"
                                    class="errMsg"
                                    >{{ errors.vid[0] }}</span
                                >
                                <div
                                    v-if="formEdit.form3 == false"
                                    style="display: flex; flex-wrap: wrap"
                                >
                                    <img
                                        width="200px"
                                        height="200px"
                                        v-for="(item, index) in imagePreview"
                                        :key="index"
                                        :src="item"
                                        style="margin: 5px"
                                        alt=""
                                    />
                                    <video
                                        v-for="(item, index) in videoPreview"
                                        :key="'A' + index"
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
                                            style="position: relative"
                                        >
                                            <!-- <span
                                                class="dlt-room-btn"
                                                @click="
                                                    deleteImage(
                                                        'hotel',
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
                                        </div>
                                        <div
                                            v-for="(
                                                item, index
                                            ) in newimagePreview"
                                            :key="index"
                                        >
                                            <img
                                                width="200px"
                                                height="200px"
                                                :src="item"
                                                style="margin: 5px"
                                                alt=""
                                            />
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
                                            style="position: relative"
                                        >
                                            <!-- <span
                                                class="dlt-room-btn"
                                                @click="
                                                    deleteImage(
                                                        'hotel',
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
                                        </div>
                                        <div
                                            v-for="(
                                                item, index
                                            ) in newvideoPreview"
                                            :key="'B' + index"
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
                        @submit.prevent="updateForm1($event)"
                        class="content"
                        id="vendor-add-space"
                    >
                        <h1>Accomodation Facilities</h1>
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
                            <span class="tooltipptext"
                                >Press Enter to add amenities</span
                            >
                            <label for="businessFacilities">
                                Business Facilities
                                <input
                                    type="text"
                                    name="businessFacilities"
                                    id="businessFacilities"
                                    data-id="Business Facilities"
                                    placeholder="Add timing and slots"
                                    @keydown.enter.prevent="addspace($event)"
                                />
                                <ul
                                    v-if="addSpaceSubmit['Business Facilities']"
                                >
                                    <li
                                        v-for="(item, index) in addSpaceSubmit[
                                            'Business Facilities'
                                        ]['facilities']"
                                        :key="index"
                                    >
                                        {{ item }}
                                    </li>
                                </ul>
                                <span
                                    v-if="
                                        errors && errors['Business Facilities']
                                    "
                                    class="errMsg"
                                    >{{ errors["Business Facilities"] }}</span
                                >
                            </label>
                            <label for="FoodAndDrink">
                                Food and Drink
                                <input
                                    type="text"
                                    name="FoodAndDrink"
                                    id="FoodAndDrink"
                                    data-id="Food and Drink"
                                    placeholder="Add Advances"
                                    @keydown.enter.prevent="addspace($event)"
                                />
                                <ul v-if="addSpaceSubmit['Food and Drink']">
                                    <li
                                        v-for="(item, index) in addSpaceSubmit[
                                            'Food and Drink'
                                        ].facilities"
                                        :key="index"
                                    >
                                        {{ item }}
                                    </li>
                                </ul>
                                <span
                                    v-if="errors && errors['Food and Drink']"
                                    class="errMsg"
                                    >{{ errors["Food and Drink"] }}</span
                                >
                            </label>
                            <label for="SafetyAndSecurity">
                                Safety and security
                                <input
                                    type="text"
                                    name="SafetyAndSecurity"
                                    id="SafetyAndSecurity"
                                    data-id="Safety and Security"
                                    placeholder="Add Taxes"
                                    @keydown.enter.prevent="addspace($event)"
                                />
                                <ul
                                    v-if="addSpaceSubmit['Safety and Security']"
                                >
                                    <li
                                        v-for="(item, index) in addSpaceSubmit[
                                            'Safety and Security'
                                        ].facilities"
                                        :key="index"
                                    >
                                        {{ item }}
                                    </li>
                                </ul>
                                <span
                                    v-if="
                                        errors && errors['Safety and Security']
                                    "
                                    class="errMsg"
                                    >{{ errors["Safety and Security"] }}</span
                                >
                            </label>
                            <label for="Bathroom">
                                Bathroom
                                <input
                                    type="text"
                                    name="Bathroom"
                                    id="Bathroom"
                                    data-id="Bathroom"
                                    placeholder="Add Cancellation"
                                    @keydown.enter.prevent="addspace($event)"
                                />
                                <ul v-if="addSpaceSubmit.Bathroom">
                                    <li
                                        v-for="(item, index) in addSpaceSubmit
                                            .Bathroom.facilities"
                                        :key="index"
                                    >
                                        {{ item }}
                                    </li>
                                </ul>
                                <span
                                    v-if="errors && errors['Bathroom']"
                                    class="errMsg"
                                    >{{ errors["Bathroom"] }}</span
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
                            <label for="Outdoors">
                                Outdoors
                                <input
                                    type="text"
                                    name="Outdoors"
                                    id="Outdoors"
                                    data-id="Outdoors"
                                    placeholder="Add Changing room"
                                    @keydown.enter.prevent="addspace($event)"
                                />
                                <ul v-if="addSpaceSubmit.Outdoors">
                                    <li
                                        v-for="(item, index) in addSpaceSubmit
                                            .Outdoors.facilities"
                                        :key="index"
                                    >
                                        {{ item }}
                                    </li>
                                </ul>
                                <span
                                    v-if="errors && errors['Outdoors']"
                                    class="errMsg"
                                    >{{ errors["Outdoors"] }}</span
                                >
                            </label>
                            <label for="MediaTecnology">
                                Media tecnology
                                <input
                                    type="text"
                                    name="MediaTecnology"
                                    id="MediaTecnology"
                                    data-id="Media Technology"
                                    placeholder="Add Decor policy"
                                    @keydown.enter.prevent="addspace($event)"
                                />
                                <ul v-if="addSpaceSubmit['Media Technology']">
                                    <li
                                        v-for="(item, index) in addSpaceSubmit[
                                            'Media Technology'
                                        ].facilities"
                                        :key="index"
                                    >
                                        {{ item }}
                                    </li>
                                </ul>
                                <span
                                    v-if="errors && errors['Media Technology']"
                                    class="errMsg"
                                    >{{ errors["Media Technology"] }}</span
                                >
                            </label>
                            <label for="RoomsAndAmenities">
                                Rooms and amenities
                                <input
                                    type="text"
                                    name="RoomsAndAmenities"
                                    id="RoomsAndAmenities"
                                    data-id="Room and Amenities"
                                    placeholder="Add Parking"
                                    @keydown.enter.prevent="addspace($event)"
                                />
                                <ul v-if="addSpaceSubmit['Room and Amenities']">
                                    <li
                                        v-for="(item, index) in addSpaceSubmit[
                                            'Room and Amenities'
                                        ].facilities"
                                        :key="index"
                                    >
                                        {{ item }}
                                    </li>
                                </ul>
                                <span
                                    v-if="
                                        errors && errors['Room and Amenities']
                                    "
                                    class="errMsg"
                                    >{{ errors["Room and Amenities"] }}</span
                                >
                            </label>
                            <label for="General">
                                General
                                <input
                                    type="text"
                                    name="General"
                                    id="General"
                                    data-id="General"
                                    placeholder="Add Alcohol"
                                    @keydown.enter.prevent="addspace($event)"
                                />
                                <ul v-if="addSpaceSubmit.General">
                                    <li
                                        v-for="(item, index) in addSpaceSubmit
                                            .General.facilities"
                                        :key="index"
                                    >
                                        {{ item }}
                                    </li>
                                </ul>
                                <span
                                    v-if="errors && errors['General']"
                                    class="errMsg"
                                    >{{ errors["General"] }}</span
                                >
                            </label>
                            <label for="Internet">
                                Internet
                                <input
                                    type="text"
                                    name="Internet"
                                    id="Internet"
                                    data-id="Internet"
                                    placeholder="Add Food"
                                    @keydown.enter.prevent="addspace($event)"
                                />
                                <ul v-if="addSpaceSubmit.Internet">
                                    <li
                                        v-for="(item, index) in addSpaceSubmit
                                            .Internet.facilities"
                                        :key="index"
                                    >
                                        {{ item }}
                                    </li>
                                </ul>
                                <span
                                    v-if="errors && errors['Internet']"
                                    class="errMsg"
                                    >{{ errors["Internet"] }}</span
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
            showImg: false,
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
            cont: [],
            locationMaster: [],
            states: [],
            district: [],
            image: null,
            imagePreview: [],
            videoPreview: [],
            newimagePreview: [],
            newvideoPreview: [],
            roomimagePreview: [],
            roomvideoPreview: [],
            roomnewimagePreview: [],
            roomnewvideoPreview: [],
            addSpaceSubmit: {},
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
            addAccomodation: {
                name: null,
                number_1: null,
                number_2: null,
                stars: null,
                address1: null,
                address2: null,
                state: null,
                location_id: null,
                zipcode: null,
                country: null,
                latitude: null,
                longitude: null,
                map: null,
            },
            addAccomodation2: {
                veg_plate: null,
                non_veg_plate: null,
                facebook_link: null,
                instagram_link: null,
                twitter_link: null,
                snapchat_link: null,
                about: null,
                features: null,
            },
            addRoomSubmit: {
                room_type: null,
                sleeps: null,
                beds_available: null,
                total_rooms: null,
                price_per_room: null,
                tax_per_room: null,
                room_specifications: [],
                room_facilities: [],
            },
            roomSpecificationTags: [
                { id: 1, name: "City view", img: "la_city.svg" },
                { id: 2, name: "Flat-screen TV", img: "cil_tv.svg" },
                { id: 3, name: "Ensuite bathroom", img: "cil_tv.svg" },
                { id: 4, name: "Air conditioning", img: "cil_tv.svg" },
                { id: 5, name: "Free WiFi", img: "cil_tv.svg" },
            ],
            accomoFacilitiesTags: [
                { id: 1, name: "Free toiletries" },
                { id: 2, name: "Shower safety" },
                { id: 3, name: "Linen sockets" },
                { id: 4, name: "Alaram clock" },
                { id: 5, name: "Hair dryer" },
                { id: 6, name: "Wakeup service" },
            ],
            addSpaceSubmitImages: {
                "Business Facilities":
                    "/assets/vendors/accomodations/uil_bag.svg",
                "Food and Drink":
                    "/assets/vendors/accomodations/fluent_food-16-regular.svg",
                "Safety and Security":
                    "/assets/vendors/accomodations/bytesize_lock.svg",
                Bathroom: "/assets/vendors/accomodations/cil_bathroom.svg",
                Parking: "/assets/vendors/accomodations/cil_car-alt.svg",
                Outdoors:
                    "/assets/vendors/accomodations/mdi_flower-tulip-outline.svg",
                "Media Technology": "/assets/vendors/accomodations/cil_tv.svg",
                "Room and Amenities":
                    "/assets/vendors/accomodations/ic_outline-bed.svg",
                General:
                    "/assets/vendors/accomodations/ant-design_info-circle-outlined.svg",
                Internet:
                    "/assets/vendors/accomodations/ant-design_wifi-outlined.svg",
                Lodging:
                    "/assets/vendors/accomodations/carbon_pedestrian-family.svg",
                "Other Amenities":
                    "/assets/vendors/accomodations/carbon_pedestrian-family.svg",
            },
            vendorAccomRooms: [],
            roomUpdateID: null,
            message2: null,
        };
    },
    methods: {
        deleteImage(item, mainId, name, id, type) {
            let _this = this;
            if (item == "room") {
                let imgName = name.substring(name.lastIndexOf("/") + 1);
                let data = [item, mainId, imgName, id, type];
                console.log(data);
                axios
                    .delete(
                        route("vendoraccommodation.destroy", [
                            "services",
                            _this.vendorDetails?.slug,
                            data,
                        ])
                    )
                    //.delete(`/api/vendor/addacc/${data}`)
                    .then(function (response) {
                        console.log(response);
                        if (type == "image") {
                            let index = _this.roomimagePreview.find(function (
                                item,
                                index
                            ) {
                                return index;
                            });
                            _this.roomimagePreview.splice(index, 1);
                            _this.message2 = "Picture Deleted";
                            setTimeout(function () {
                                _this.message2 = null;
                            }, 3000);
                        }
                        if (type == "video") {
                            let index = _this.roomvideoPreview.find(function (
                                item,
                                index
                            ) {
                                return index;
                            });
                            _this.roomvideoPreview.splice(index, 1);
                            _this.message2 = "Video Deleted";
                            setTimeout(function () {
                                _this.message2 = null;
                            }, 3000);
                        }
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
            if (item == "hotel") {
                if (_this.formUpdate.form3 == false) {
                    return;
                }
                let vidName = name.substring(name.lastIndexOf("/") + 1);
                let data = [item, mainId, vidName, id, type];
                axios
                    .delete(
                        route("vendoraccommodation.destroy", [
                            "services",
                            _this.vendorDetails?.slug,
                            data,
                        ])
                    )
                    //.delete(`/api/vendor/addacc/${data}`)
                    .then(function (response) {
                        console.log(response);
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
        showRoomPics() {
            let _this = this;

            _this.vendorAccomRooms.forEach(function (item, index) {
                _this.cont[item.id] = new Splide(
                    `#room-picture-splide${item.id}`,
                    {
                        type: "slide",
                        fixedWidth: "200px",
                        perPage: 1,
                        perMove: 1,
                        gap: "1em",
                        drag: true,
                        arrows: true,
                        trimSpace: true,
                        pagination: false,
                        isNavigation: true,
                    }
                );
                _this.cont[item.id].mount();
                _this.cont = _this.cont.filter(
                    (value) => Object.keys(value).length !== 0
                );
            });
        },
        openRoomForm(e, bool) {
            let _this = this;
            //console.log(bool);
            if (bool === true) {
                Object.keys(_this.addRoomSubmit).forEach(function (index) {
                    _this.addRoomSubmit[index] = null;
                });
                _this.addRoomSubmit.room_specifications = [];
                _this.addRoomSubmit.room_facilities = [];
                _this.hidden = true;
                if (_this.vendorAccomRooms.length == 0) {
                    _this.formSubmitted.form2 = false;
                }
                _this.roomimagePreview = [];
                _this.roomvideoPreview = [];
                _this.roomnewimagePreview = [];
                _this.roomnewvideoPreview = [];
                _this.formUpdate.form2 = false;
            } else {
                let _this = this;
                _this.formSubmitted.form2 = true;
                _this.formUpdate.form2 = true;
                axios
                    .get(`/api/vendor/addacc/${e}?id=${bool}`)
                    .then(function (response) {
                        for (const key in _this.addRoomSubmit) {
                            for (const key2 in response.data) {
                                if (key == key2) {
                                    _this.addRoomSubmit[key] =
                                        response.data[key2];
                                }
                            }
                        }
                        _this.roomimagePreview = response.data.images;
                        _this.roomvideoPreview = response.data.videos;
                        _this.roomUpdateID = response.data.id;
                        _this.hidden = true;
                        setTimeout(function () {
                            $(
                                `#vendor-add-room  .vendor-add-room-btn  form button[type=submit]`
                            ).css("display", "block");
                            if (
                                _this.addRoomSubmit.room_specifications.length >
                                0
                            ) {
                                document
                                    .querySelector("#room_specification")
                                    .removeAttribute("required");
                            }
                            if (
                                _this.addRoomSubmit.room_facilities.length > 0
                            ) {
                                document
                                    .querySelector("#room_facilities")
                                    .removeAttribute("required");
                            }
                            $("#vendorroomImagesUpload").attr(
                                "required",
                                false
                            );
                        }, 100);
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
        },
        deleteRoom(e, id) {
            let _this = this;
            let dlt = [id, "delete"];
            axios
                .delete(
                    route("vendoraccommodation.destroy", [
                        "services",
                        _this.vendorDetails?.slug,
                        dlt,
                    ])
                )
                //.delete(`/api/vendor/addacc/${}`)
                .then(function (response) {
                    _this.message = "Room Deleted Succesfully";
                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                    let item = _this.vendorAccomRooms.findIndex(
                        (x) => x.id === id
                    );

                    _this.vendorAccomRooms.splice(item, 1);
                })
                .catch((error) => {});
        },
        showForm(e, bool) {
            this.toggleForm("vendor-details", false);
            //console.log("name");
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
                for (const key in this.addAccomodation) {
                    this.addAccomodation[key] = null;
                }
                for (const key in this.addAccomodation2) {
                    this.addAccomodation2[key] = null;
                }
                this.addSpaceSubmit = {};
                this.imagePreview = [];
                this.videoPreview = [];
                this.newimagePreview = [];
                this.newvideoPreview = [];
                this.vendorAccomRooms = [];
                this.showImg = false;
                $(".forms :input").removeAttr("disabled");
            }
            this.newimagePreview = [];
            this.newvideoPreview = [];
            this.form = true;
            var element = this.$refs[e];
            setTimeout(function () {
                element.scrollIntoView(true);
            }, 100);
            // document.querySelector("").scrollIntoView({
            //     behavior: "smooth",
            // });
        },
        editForm(e) {
            let _this = this;
            _this.accomodation_id = e;
            _this.showImg = true;
            axios
                .get(`/api/vendor/addacc/${e}`)
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
                    //console.log(response.data);
                    if (response.data[1].length > 0) {
                        _this.vendorAccomRooms = response.data[1];
                        _this.formSubmitted.form2 = true;
                        _this.formEdit.form2 = true;
                        _this.formUpdate.form2 = true;
                    } else {
                        _this.vendorAccomRooms = [];
                    }

                    if (response.data[0]?.services) {
                        console.log("ssssss");
                        for (
                            let i = 0;
                            i < response.data[0]?.services.length;
                            i++
                        ) {
                            _this.serviceId.push(
                                response.data[0]?.services[i].id
                            );
                        }
                    }
                    for (const key in _this.addAccomodation) {
                        for (const key2 in response.data[0]) {
                            if (key == key2) {
                                _this.addAccomodation[key] =
                                    response.data[0][key2];
                                _this.formSubmitted.form1 = true;
                                _this.formEdit.form1 = true;
                            }
                        }
                    }

                    let state = _this.addAccomodation?.state;
                    if (state) {
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

                    for (const key in _this.addAccomodation2) {
                        for (const key2 in response.data[0]) {
                            if (key == key2) {
                                _this.addAccomodation2[key] =
                                    response.data[0][key2];
                            }
                        }
                    }
                    //console.log(response.data[0]);

                    if (
                        response.data[0].accom_facilities != null &&
                        !(
                            Array.isArray(response.data[0].accom_facilities) &&
                            response.data[0].accom_facilities.length === 0
                        )
                    ) {
                        _this.addSpaceSubmit =
                            response.data[0].accom_facilities;
                        _this.formSubmitted.form4 = true;
                        _this.formEdit.form4 = true;
                    } else {
                        _this.addSpaceSubmit = {};
                    }
                    if (response.data[0].images != null) {
                        if (response.data[0].images.length > 0) {
                            _this.imagePreview = response.data[0].images;
                            _this.formSubmitted.form3 = true;
                            _this.formEdit.form3 = true;
                        }
                    } else {
                        _this.imagePreview = [];
                    }
                    if (response.data[0].videos != null) {
                        if (response.data[0].videos.length > 0) {
                            _this.videoPreview = response.data[0].videos;
                        }
                    } else {
                        _this.videoPreview = [];
                    }

                    for (const key in _this.formSubmitted) {
                        if (_this.formSubmitted[key] == true) {
                            //console.log("hrl");
                            let id = key.substr(key.length - 1) - 1;
                            if (id == 1) {
                                continue;
                            }
                            let ele = $(".forms").children().eq(id).attr("id");
                            //console.log(ele);
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
                    //console.log($(".vendor-add-room-btn :input"));
                    $(".vendor-add-room-btn :input").removeAttr("disabled");
                    _this.showForm("scroll", false);
                })
                .catch((error) => {
                    console.log(error);
                });
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
            //console.log($(`#${id}`));
            $(`#${id} > .ven-profile-form-submit > button[type=submit]`).css(
                "display",
                "block"
            );
            $(`#${id} :input`).eq(0).removeClass("shake");
            $(`#${id} :input`).eq(1).focus();
            if (this.addAccomodation2.features != null) {
                if (this.addAccomodation2.features.length > 0) {
                    $("#vendorFwatures").removeAttr("required");
                }
            }
            if (this.imagePreview != null) {
                if (this.imagePreview.length > 0) {
                    //console.log($("#vendorImagesUpload"));
                    $("#vendorImagesUpload").removeAttr("required");
                }
            }

            if (Object.keys(this.addSpaceSubmit).length > 0) {
                $("#vendor-add-space label input").removeAttr("required");
            }
        },
        uploadRoomImg(e) {
            //console.log(e.target.files[0]);
            var _this = this;
            this.image = e.target.files;
            if (this.formUpdate.form2 == false) {
                this.roomimagePreview = [];
                this.roomvideoPreview = [];
            }
            if (this.formUpdate.form2 == true) {
                console.log("ff");
                _this.roomnewimagePreview = [];
                _this.roomnewvideoPreview = [];
                this.image.forEach(function (item) {
                    if (item.type.split("/")[0] == "image") {
                        _this.roomnewimagePreview.push(
                            URL.createObjectURL(item)
                        );
                    }
                    if (item.type.split("/")[0] == "video") {
                        _this.roomnewvideoPreview.push(
                            URL.createObjectURL(item)
                        );
                    }
                });
                return;
            }
            //console.log("hh");
            this.roomimagePreview = [];
            this.roomvideoPreview = [];
            this.image.forEach(function (item) {
                if (item.type.split("/")[0] == "image") {
                    _this.roomimagePreview.push(URL.createObjectURL(item));
                }
                if (item.type.split("/")[0] == "video") {
                    _this.roomvideoPreview.push(URL.createObjectURL(item));
                }
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
            this.imagePreview = [];
            this.videoPreview = [];
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
            this.loader = true;
            let formData = new FormData();
            this.serviceId.forEach(function (item) {
                _this.sendService.push({
                    service_id: item,
                    vendor_id: _this.vendorId,
                });
            });
            let data = JSON.stringify(_this.addAccomodation);
            let services = JSON.stringify(_this.serviceId);
            formData.append("contentType", "details");
            formData.append("data", data);
            formData.append("services", services);
            formData.append("catId", _this.vendorCategories.id);
            formData.append("vendorId", _this.vendorDetails.id);
            if (this.formUpdate.form1 == true) {
                formData.append("_method", "PATCH");
                axios
                    .post(
                        route("vendoraccommodation.update", [
                            "services",
                            _this.vendorDetails?.slug,
                            _this.accomodation_id,
                        ]),
                        formData
                    )
                    // .post(
                    //     `/api/vendor/addacc/${_this.accomodation_id}`,
                    //     formData
                    // )
                    .then(function (response) {
                        _this.loader = false;
                        _this.toggleForm("vendor-add-room", false);
                        _this.showRoomPics();
                        $(".forms")
                            .children()
                            .eq(0)
                            .children()
                            .eq(1)
                            .find("button")
                            .addClass("shake");
                        _this.formSubmitted.form1 = true;
                        _this.accomodation_id = response.data;
                        _this.formUpdate.form1 = false;
                        _this.message = "Accomodation detalis updated!!";
                        _this.formEdit.form1 = true;
                        $(
                            `#vendor-details .ven-profile-form-submit button[type=submit]`
                        ).css("display", "none");
                        let current = $(".forms").children().eq(0);
                        //console.log(current);
                        current.find("input").attr("disabled", true);
                        current.find("select").attr("disabled", true);
                        current
                            .find("button[type=submit]")
                            .css("display", "none");
                        current
                            .find("button[type=submit]")
                            .attr("disabled", true);
                        setTimeout(function () {
                            _this.message = null;
                        }, 3000);
                    })
                    .catch((error) => {
                        console.log(error.response);
                        _this.errors = error.response.data.errors;
                        _this.loader = false;
                    });
                return;
            }
            axios
                .post(
                    route("vendoraccommodation.store", [
                        "services",
                        _this.vendorDetails?.slug,
                    ]),
                    formData
                )
                //.post(`/api/vendor/addacc`, formData)
                .then(function (response) {
                    _this.loader = false;
                    _this.toggleForm("vendor-add-room", false);
                    _this.showRoomPics();
                    _this.accomodation_id = response.data;
                    _this.message =
                        "Accomodation Added Successfully!! Kindly Fill other Details";
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
                    console.log(error);
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
            const config = {
                headers: { "content-type": "multipart/form-data" },
            };
            if (this.formUpdate.form2 == true) {
                this.loader = true;
                let formData = new FormData();
                let data = JSON.stringify(_this.addRoomSubmit);
                formData.append("contentType", "room");
                formData.append("data", data);
                formData.append("id", _this.roomUpdateID);
                formData.append("accid", _this.accomodation_id);
                formData.append("_method", "PATCH");
                if (this.image != null) {
                    formData.append("uploadimg", "uploadimg");
                }
                if (this.image != null) {
                    for (var i = 0; i < this.image.length; i++) {
                        let file = this.image[i];
                        //console.log(file);
                        formData.append("files[" + i + "]", file);
                    }
                }

                axios
                    .post(
                        route("vendoraccommodation.update", [
                            "services",
                            _this.vendorDetails?.slug,
                            _this.accomodation_id,
                        ]),
                        formData
                    )
                    // .post(
                    //     `/api/vendor/addacc/${_this.accomodation_id}`,
                    //     formData
                    // )
                    .then(function (response) {
                        _this.hidden = false;
                        _this.loader = false;
                        _this.accomodation_id = response.data[0];
                        _this.vendorAccomRooms = response.data[1];
                        _this.formSubmitted.form2 = true;
                        _this.roomnewimagePreview = [];
                        _this.roomnewvideoPreview = [];
                        _this.image = null;
                        _this.roomUpdateID = response.data;
                        _this.formUpdate.form2 = false;
                        _this.message = "New Room added!";
                        _this.formEdit.form2 = true;
                        _this.cont = [];
                        // _this.cont[_this.roomUpdateID].destroy();
                        // console.log(_this.cont[_this.roomUpdateID]);
                        setTimeout(function () {
                            _this.showRoomPics();
                        }, 100);
                        setTimeout(function () {
                            _this.message = null;
                        }, 3000);
                    })
                    .catch((error) => {
                        _this.hidden = true;
                        _this.loader = false;
                        _this.errors = error.response.data.errors;
                        console.log(error.response);
                    });
                return;
            }
            let formData = new FormData();
            let data = JSON.stringify(_this.addRoomSubmit);
            formData.append("contentType", "room");
            formData.append("data", data);
            formData.append("accid", _this.accomodation_id);
            //formData.append("contentType", "image");
            if (this.image != null) {
                for (var i = 0; i < this.image.length; i++) {
                    let file = this.image[i];
                    //console.log(file);
                    formData.append("files[" + i + "]", file);
                }
            }
            this.loader = true;
            axios
                .post(
                    route("vendoraccommodation.store", [
                        "services",
                        _this.vendorDetails?.slug,
                    ]),
                    formData
                )
                //.post(`/api/vendor/addacc`, formData)
                .then(function (response) {
                    //console.log(response);
                    _this.hidden = false;
                    _this.image = null;
                    _this.loader = false;
                    _this.accomodation_id = response.data[0];
                    _this.vendorAccomRooms = response.data[1];
                    setTimeout(function () {
                        _this.showRoomPics();
                    }, 500);
                    Object.keys(_this.addRoomSubmit).forEach(function (index) {
                        _this.addRoomSubmit[index] = null;
                    });
                    _this.message =
                        "Room added successfully!! Kindly Fill other Details";
                    _this.formSubmitted.form2 = true;
                    _this.formEdit.form2 = true;
                    setTimeout(function () {
                        _this.hidden = true;
                        _this.message = null;
                    }, 3000);
                })
                .catch((error) => {
                    _this.loader = false;
                    _this.errors = error.response.data.errors;
                    console.log(error.response.data.errors);
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
            if (this.formSubmitted.form2 == false) {
                this.message = "kindly fill second form";
                setTimeout(function () {
                    _this.message = null;
                }, 3000);
                this.toggleForm("vendor-add-room", false);
                return;
            }
            const config = {
                headers: { "content-type": "multipart/form-data" },
            };
            let formData = new FormData();
            let data = JSON.stringify(_this.addAccomodation2);
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
                    route("vendoraccommodation.update", [
                        "services",
                        _this.vendorDetails?.slug,
                        _this.accomodation_id,
                    ]),
                    formData,
                    config
                )
                // .post(
                //     `/api/vendor/addacc/${_this.accomodation_id}`,
                //     formData,
                //     config
                // )
                .then(function (response) {
                    _this.image = null;
                    _this.loader = false;
                    _this.toggleForm("vendor-add-space", false);
                    $(".forms")
                        .children()
                        .eq(2)
                        .children()
                        .eq(1)
                        .find("button")
                        .addClass("shake");
                    _this.accomodation_id = response.data;
                    if (_this.formUpdate.form3 == true) {
                        _this.message = "Gallery Updated";
                    } else {
                        _this.message =
                            "Venue Added Successfully!! Kindly Fill other Details";
                    }
                    _this.formSubmitted.form3 = true;
                    _this.formEdit.form3 = true;
                    _this.formUpdate.form3 = false;
                    let current = $(".forms").children().eq(2);
                    //console.log(current);
                    current.find("input").attr("disabled", true);
                    current.find("select").attr("disabled", true);
                    current.find("textarea").attr("disabled", true);
                    current.find("button[type=submit]").css("display", "none");
                    current.find("button[type=submit]").attr("disabled", true);
                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                })
                .catch((error) => {
                    _this.loader = false;
                    _this.errors = error.response.data.errors;
                    console.log(error.response);
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
                this.toggleForm("vendor-add-room", false);
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
            _this.errors = {};
            let err = false;
            for (let keys in _this.addSpaceSubmitImages) {
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
            formData.append("contentType", "json");
            formData.append("data", data);
            formData.append("_method", "PATCH");
            _this.loader = true;

            axios
                .post(
                    route("vendoraccommodation.update", [
                        "services",
                        _this.vendorDetails?.slug,
                        _this.accomodation_id,
                    ]),
                    formData
                )
                //.post(`/api/vendor/addacc/${_this.accomodation_id}`, formData)
                .then(function (response) {
                    $(".forms")
                        .children()
                        .eq(3)
                        .children()
                        .eq(1)
                        .find("button")
                        .addClass("shake");
                    $(".forms")
                        .children()
                        .eq(3)
                        .find("button[type=submit]")
                        .css("display", "none");
                    _this.formUpdate.form4 = false;
                    _this.formSubmitted.form4 = true;
                    _this.formEdit.form4 = true;
                    _this.accomodation_id = response.data;
                    if (_this.formUpdate.form4 == true) {
                        _this.message = "Amenities Updated";
                    } else {
                        _this.message = "Amenities Added Successfully!!";
                    }
                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                    $(
                        `#vendor-add-space .ven-profile-form-submit button[type=submit]`
                    ).css("display", "none");
                    _this.loader = false;

                    _this.form = false;

                    //console.log(_this.$refs);
                    _this.$refs.services.getProducts("parent");
                    _this.added = _this.accomodation_id;
                })
                .catch((error) => {
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

            this.img = "hjee";
        },
        toggleForm(e, bool) {
            let id = null;
            if (bool == true) {
                id = e.currentTarget.dataset.id;
            }
            if (bool == false) {
                id = e;
            }
            console.log(id, e);
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
        hideBlock(e, id, txt) {
            if (txt == "room") {
                this.addRoomSubmit.room_specifications.splice(id, 1);
            }
            if (txt == "facility") {
                this.addRoomSubmit.room_facilities.splice(id, 1);
            }
        },
        onEnter(e) {
            if (this.addRoomSubmit.room_specifications == null) {
                this.addRoomSubmit.room_specifications = [];
            }
            if (this.addRoomSubmit.room_facilities == null) {
                this.addRoomSubmit.room_facilities = [];
            }
            let val = e.currentTarget.value;
            if (!val) {
                return;
            }
            if (!val.replace(/\s/g, "").length) {
                return;
            }
            if (e.currentTarget.id === "room_specification") {
                this.addRoomSubmit.room_specifications.push({ name: val });
                e.currentTarget.removeAttribute("required");
            }
            if (e.currentTarget.id == "room_facilities") {
                this.addRoomSubmit.room_facilities.push({ name: val });
                e.currentTarget.removeAttribute("required");
            }
            e.currentTarget.value = "  ";
        },
        addspace(e) {
            if (!e.currentTarget.value) {
                return;
            }
            if (!e.currentTarget.value.replace(/\s/g, "").length) {
                return;
            }
            let od = e.currentTarget.dataset.id;
            let ob = this.addSpaceSubmit;
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
        addInput(e) {
            if (e.currentTarget.parentElement.id == "specification-btn-cont") {
                document
                    .querySelector("#room_specification")
                    .removeAttribute("required");
                let val = this.roomSpecificationTags.find(function (
                    item,
                    index
                ) {
                    if (item.id == e.currentTarget.dataset.id) {
                        return true;
                    }
                });
                if (val) {
                    if (
                        this.addRoomSubmit.room_specifications.some(
                            (item) => item.name === val.name
                        )
                    ) {
                        return;
                    }
                    this.addRoomSubmit.room_specifications.push(val);
                }
            }
            if (e.currentTarget.parentElement.id == "facilities-btn-cont") {
                document
                    .querySelector("#room_facilities")
                    .removeAttribute("required");
                let val2 = this.accomoFacilitiesTags.find(function (
                    item,
                    index
                ) {
                    if (item.id == e.currentTarget.dataset.id) {
                        return true;
                    }
                });
                // console.log(
                //     val2,
                //     this.addRoomSubmit.room_facilities,
                //     this.addRoomSubmit.room_facilities.includes(val2),

                // );
                if (val2) {
                    if (
                        this.addRoomSubmit.room_facilities.some(
                            (item) => item.name === val2.name
                        )
                    ) {
                        return;
                    }
                    this.addRoomSubmit.room_facilities.push(val2);
                }
            }
        },
        getStates() {
            var _this = this;
            let v = this.vendor.id;
            axios
                .get(`/api/vendor/addacc`)
                .then(function (response) {
                    console.log(response);
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
    },
    mounted() {
        this.$nextTick(function () {
            //console.log(this.vendorCat, this.vendor);
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
    z-index: 9999999999999;
    top: -19px;
    left: 86%;
}
.tooltipp .tooltipptext::after {
    content: "";
    position: absolute;
    top: 86%;
    right: 100%;
    margin-top: -12px;
    border-width: 7px;
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
.vendor-add-room-form-popup {
    padding: 15px 27px;
    background: #ffffff;
    border-radius: 6px;
    position: fixed;
    top: 10%;
    left: 25%;
    width: 50%;
    overflow-y: scroll;
    height: 80vh;
}
.vendor-add-room-form-popup > div:nth-child(1) {
    display: flex;
    justify-content: space-between;
    border-bottom: 0.5px solid #c9c9c9;
}
.vendor-add-room-form-popup > div:nth-child(1) > span {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 600;
    font-size: 15.8559px;
    line-height: 24px;
    text-transform: uppercase;
    color: #333333;
}
.vendor-add-room-form-popup > div:nth-child(1) > button {
    outline: none;
    border: none;
    background-color: inherit;
}
.vendor-add-room-form-popup > div:nth-child(2) input {
    border: 0.2px solid #959595;
    box-sizing: border-box;
    border-radius: 5px;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 12.652px;
    line-height: 19px;
    color: #8b8b8b;
    margin: 5px 0;
    padding: 5px;
    background-color: transparent !important;
    width: 100%;
}
.vendor-add-room-form-popup > div:nth-child(2) > label {
    width: 100%;
}
.vendor-add-room-form-popup > div:nth-child(2) > label > div:nth-child(1) {
    margin-top: 10px;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 16.04px;
    line-height: 24px;
    color: #000000;
}
.vendor-add-room-form-popup > div:nth-child(2) > label > div:nth-child(2) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 12.87px;
    line-height: 19px;
    color: #8b8b8b;
}
.vendor-add-room-form-popup > div:nth-child(3) {
    display: flex;
    justify-content: flex-end;
}
.vendor-add-room-form-popup > div:nth-child(3) > button:nth-child(1) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 12px;
    line-height: 18px;
    text-align: center;
    color: #d0d0d0;
    outline: none;
    background-color: white;
    border-radius: 6px;
    padding: 6px 15px;
    border: 0.5px solid #d0d0d0;
    margin-right: 10px;
}
.vendor-add-room-form-popup > div:nth-child(3) > button:nth-child(2) {
    background: #9b3154;
    border-radius: 6px;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 12px;
    line-height: 18px;
    text-align: center;
    color: #ffffff;
    outline: none;
    padding: 6px 15px;
    border: none;
}
.room-specifications-facilities {
    position: relative;
    border: 1px solid black;
    display: flex;
    flex-wrap: wrap;
    padding: 14px 20px;
}
.room-specifications-facilities-blocks {
    background: #c4456f;
    border-radius: 5px;
    padding: 5px 7px;
    display: flex;
    height: 37px;
    margin-right: 10px;
    margin-bottom: 10px;
}
.room-specifications-facilities-blocks > object {
    width: 20px;
    height: 22px;
    filter: invert(100%) sepia(100%) saturate(0%) hue-rotate(180deg)
        brightness(240%) contrast(108%);
    margin: auto;
}
.room-specifications-facilities-blocks > span {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 9.7277px;
    line-height: 15px;
    margin: auto;
    color: #ffffff;
    margin-right: 5px;
}

#vendor-add-room > h1 {
    font-family: Segoe UI;
    font-style: normal;
    font-weight: 600;
    font-size: 17.1823px;
    line-height: 18px;
    text-align: center;
    text-transform: capitalize;
    color: #461952;
}
.vendor-add-room-btn {
    display: flex;
    justify-content: flex-end;
}
.vendor-add-room-btn > button {
    font-family: "Segoe UI";
    font-style: normal;
    font-weight: 600;
    font-size: 11.2493px;
    line-height: 15px;
    text-transform: capitalize;
    color: #ffffff;
    border: none;
    outline: 0;
    background: #c4456f;
    border-radius: 22.4987px;
    padding: 5px 15px;
    margin-left: auto;
}
.vendor-add-room-table {
    width: 100%;
    margin-top: 1em;
}
.vendor-add-room-table th {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 13.6796px;
    line-height: 21px;
    color: #ffffff;
    background: #461952;
    border: 0 !important;
    padding: 18px 25px;
}
.vendor-add-room-table td {
    vertical-align: top;
    border: 0.5px solid #c4c4c4;
}
.vendor-add-room-table-type {
    padding: 16px 37px;
}
.vendor-add-room-table-type > div:nth-child(1) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 800;
    font-size: 17.6796px;
    line-height: 21px;
    text-decoration-line: underline;
    color: #000000;
    margin-bottom: 10px;
}
.vendor-add-room-table-type > div:nth-child(2) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 14.81205px;
    line-height: 15px;
    margin-bottom: 10px;
    color: #de2b2b;
}
.vendor-add-room-table-type > div:nth-child(3) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 11.81205px;
    line-height: 15px;
    color: #797979;
    margin-bottom: 10px;
}
.vendor-add-room-table-type > div:nth-child(3) > img {
    width: 25px;
    height: 23px;
}
.vendor-add-room-table-type > div:nth-child(4) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 9.16549px;
    line-height: 11px;
    color: #a8a8a8;
    display: flex;
    flex-wrap: wrap;
}
.vendor-add-room-table-type > div:nth-child(4) > div {
    margin-right: 30px;
}
.vendor-add-room-table-type > div:nth-child(4) > div > img {
    margin-right: 10px;
    width: 20px;
    height: 17px;
}

.vendor-add-room-table-number {
    padding: 16px 25px;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: flex-start;
}

.vendor-add-room-table-price {
    padding: 16px 25px;
}
.vendor-add-room-table-price > div:nth-child(1) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 700;
    font-size: 18px;
    line-height: 27px;
    color: #000000;
}
.vendor-add-room-table-price > div:nth-child(2) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 12px;
    line-height: 27px;
    color: #000000;
}

.vendor-add-room-table-facilities {
    display: flex;
    padding: 16px 25px;
}
.vendor-add-room-table-facilities > div:nth-child(1) {
    width: 85%;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 10px;
    line-height: 15px;
    color: #000000;
}

.vendor-add-room-table-facilities > div:nth-child(2) {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    width: 15%;
}
.vendor-add-room-table-facilities > div:nth-child(2) button {
    background: #c4456f;
    box-shadow: 0px 0px 0.52193px 0.52193px rgba(0, 0, 0, 0.25);
    border-radius: 35.5263px;
    width: 27px;
    height: 27px;
    margin-bottom: 15px;
    border: none;
    outline: 0;
}

.room-specifications-facilities-suggestions {
    display: flex;
}
.room-specifications-facilities-suggestions > div:nth-child(1) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 12.87px;
    line-height: 19px;
    color: #000000;
}

.room-specifications-facilities-suggestions > div:nth-child(2) > button {
    background: #f7f7f7;
    border-radius: 12.9752px;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 7.88868px;
    line-height: 12px;
    color: #c4456f;
    margin: 0 10px;
    border: none;
    outline: 0;
    padding: 5px 10px;
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
#vendor-add-room .ven-profile-form-submit > button {
    background: rgba(255, 255, 255, 0.8);
    box-shadow: 0px 2.80602px 2.80602px rgba(0, 0, 0, 0.25);
    outline: none;
    border: 0;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    margin-left: 15px;
    padding: 0 !important;
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
