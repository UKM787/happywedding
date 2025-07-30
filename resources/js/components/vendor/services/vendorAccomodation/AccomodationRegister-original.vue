<template>
    <div>
        <div class="container ven-profile-form">
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
                        @click="toggleForm($event)"
                    ></button>
                    <button
                        type="button"
                        class="tab-btn"
                        data-id="vendor-add-room"
                        @click="toggleForm($event)"
                    ></button>
                    <button
                        type="button"
                        class="tab-btn"
                        data-id="vendor-about"
                        @click="toggleForm($event)"
                    ></button>
                    <button
                        type="button"
                        class="tab-btn"
                        data-id="vendor-add-space"
                        @click="toggleForm($event)"
                    ></button>
                </div>
                <div class="about-content">
                    <div class="content active" id="vendor-details">
                        <h1>Vendor’s details</h1>
                        <div class="vendor-details-form-fields">
                            <label for="vendorFirstName">
                                First name
                                <input
                                    type="text"
                                    name="vendorFirstName"
                                    id="vendorFirstName"
                                    placeholder="Enter your first name"
                                />
                            </label>
                            <label for="vendorLastName">
                                Last name
                                <input
                                    type="text"
                                    name="vendorLastName"
                                    id="vendorLastName"
                                    placeholder="Enter your last name"
                                />
                            </label>
                            <label for="vendorFatherName">
                                Father's name
                                <input
                                    type="text"
                                    name="vendorFatherName"
                                    id="vendorFatherName"
                                    placeholder="Enter your father's name"
                                />
                            </label>
                            <label for="vendorPhone-1">
                                Phone Number-1
                                <input
                                    type="text"
                                    name="vendorPhone-1"
                                    id="vendorPhone-1"
                                    placeholder="Enter your phone number"
                                />
                            </label>
                            <label for="vendorPhone-2">
                                Phone Number-2
                                <input
                                    type="text"
                                    name="vendorPhone-2"
                                    id="vendorPhone-2"
                                    placeholder="Enter your phone number"
                                />
                            </label>
                            <label for="vendorLandline">
                                Landline Number
                                <input
                                    type="text"
                                    name="vendorLandline"
                                    id="vendorLandline"
                                    placeholder="Enter your landline number"
                                />
                            </label>
                            <label for="vendorEmailAddress">
                                Email Address
                                <input
                                    type="text"
                                    name="vendorEmailAddress"
                                    id="vendorEmailAddress"
                                    placeholder="Enter your email address"
                                />
                            </label>
                            <label for="vendorWatsapp-1">
                                Watsapp Number-1
                                <input
                                    type="text"
                                    name="vendorWatsapp-1"
                                    id="vendorWatsapp-1"
                                    placeholder="Enter your whatsapp number"
                                />
                            </label>
                            <label for="vendorWatsapp-2">
                                Watsapp Number-2
                                <input
                                    type="text"
                                    name="vendorWatsapp-2"
                                    id="vendorWatsapp-2"
                                    placeholder="Enter your whatsapp number"
                                />
                            </label>
                        </div>
                        <div class="vendor-address-form-fields">
                            <label for="vendorCategories">
                                Vendor categories
                                <select
                                    name="vendorCategories"
                                    id="vendorCategories"
                                >
                                    <option hidden disabled selected>
                                        Select vendor’s category
                                    </option>
                                    <option value="">Mehndi Artist</option>
                                    <option value="">Mehndi Artist</option>
                                    <option value="">Mehndi Artist</option>
                                    <option value="">Mehndi Artist</option>
                                </select>
                            </label>
                            <label for="vendorComplexName">
                                Complex Name
                                <input
                                    type="text"
                                    name="vendorComplexName"
                                    id="vendorComplexName"
                                    placeholder="Enter your complex name"
                                />
                            </label>
                            <label for="vendorArea">
                                Area
                                <input
                                    type="text"
                                    name="vendorArea"
                                    id="vendorArea"
                                    placeholder="Enter your area name"
                                />
                            </label>
                            <label for="vendorDistrict">
                                District
                                <input
                                    type="text"
                                    name="vendorDistrict"
                                    id="vendorDistrict"
                                    placeholder="Enter your district name"
                                />
                            </label>
                            <label for="vendorZipCode">
                                Zip Code
                                <input
                                    type="text"
                                    name="vendorZipCode"
                                    id="vendorZipCode"
                                    placeholder="Enter your zip code"
                                />
                            </label>
                            <label for="vendorState">
                                State
                                <input
                                    type="text"
                                    name="vendorState"
                                    id="vendorState"
                                    placeholder="Enter your state name"
                                />
                            </label>
                            <label for="vendorCountry">
                                Country
                                <input
                                    type="text"
                                    name="vendorCountry"
                                    id="vendorCountry"
                                    placeholder="Enter your country name"
                                />
                            </label>
                            <label for="vendorLocationLink">
                                <input
                                    type="text"
                                    name="vendorLocationLink"
                                    id="vendorLocationLink"
                                    placeholder="Add location link"
                                />
                                <button id="location-link">
                                    <img
                                        src="/assets/vendors/dashboard/location-icon.svg"
                                        alt=""
                                    />
                                    Insert Link
                                </button>
                            </label>
                        </div>
                        <div id="ven-profile-form-submit">
                            <button
                                data-id="vendor-add-room"
                                @click="toggleForm($event)"
                                type="submit"
                            >
                                Submit
                            </button>
                            <button
                                data-id="vendor-add-room"
                                @click="toggleForm($event)"
                                type="button"
                            >
                                <img src="/assets/vendors/Frame.svg" alt="" />
                            </button>
                        </div>
                    </div>
                    <div class="content" id="vendor-add-room">
                        <h1>Add rooms</h1>
                        <div class="vendor-add-room-btn">
                            <button @click="hidden = true">
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
                                <form class="vendor-add-room-form-popup">
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
                                            v-model="addRoomSubmit.roomType"
                                        />
                                        <label for="sleeps">
                                            <div>Sleeps</div>
                                            <div>
                                                Number of people can sleep
                                            </div>
                                            <input
                                                type="text"
                                                name="sleep"
                                                id="sleeps"
                                                v-model="addRoomSubmit.sleep"
                                            />
                                        </label>
                                        <label for="Beds_available">
                                            <div>Beds available</div>
                                            <div>Number of beds available</div>
                                            <input
                                                type="text"
                                                name="Beds_available"
                                                id="Beds_available"
                                                v-model="
                                                    addRoomSubmit.Beds_available
                                                "
                                            />
                                        </label>
                                        <label for="Total_rooms">
                                            <div>Total rooms</div>
                                            <div>Number of rooms</div>
                                            <input
                                                type="text"
                                                name="Total_rooms"
                                                id="Total_rooms"
                                                v-model="
                                                    addRoomSubmit.Total_rooms
                                                "
                                            />
                                        </label>
                                        <label for="room_specification">
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
                                                        ) in addRoomSubmit.room_specification"
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
                                                    v-on:keyup.enter="
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
                                        <label for="room_facilities">
                                            Facilities
                                            <div
                                                class="room-specifications-facilities"
                                            >
                                                <div style="display: flex">
                                                    <div
                                                        class="room-specifications-facilities-blocks"
                                                        v-for="(
                                                            item, index
                                                        ) in addRoomSubmit.facilities_specification"
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
                                                    v-on:keyup.enter="
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
                                                    addRoomSubmit.Price_per_room
                                                "
                                            />
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
                                                    addRoomSubmit.Tax_and_services
                                                "
                                            />
                                        </label>
                                    </div>
                                    <div>
                                        <button
                                            @click="hidden = false"
                                            type="button"
                                        >
                                            Close
                                        </button>
                                        <button type="button">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <table class="vendor-add-room-table">
                            <tr>
                                <th style="width: 35%">Room type</th>
                                <th style="width: 10%">Sleeps</th>
                                <th style="width: 20%">Prices and Taxes</th>
                                <th style="width: 35%">Facilities</th>
                            </tr>

                            <tr>
                                <td style="width: 35%">
                                    <div class="vendor-add-room-table-type">
                                        <div><u>Superior Room</u></div>
                                        <div>Total 50 rooms</div>
                                        <div>
                                            <img
                                                src="/assets/vendors/dashboard/ion_bed-sharp.svg"
                                                alt=""
                                            />
                                            <span> 1 double bed</span>
                                        </div>
                                        <div>
                                            <div>
                                                <img
                                                    src="/assets/vendors/dashboard/la_city.svg"
                                                    alt=""
                                                />
                                                <span>City View</span>
                                            </div>
                                            <div>
                                                <img
                                                    src="/assets/vendors/dashboard/cil_tv.svg"
                                                    alt=""
                                                />
                                                <span>Flat Screen Tv</span>
                                            </div>
                                            <div>
                                                <img
                                                    src="/assets/vendors/dashboard/cil_bathroom.svg"
                                                    alt=""
                                                />
                                                <span>Ensuite bathroom</span>
                                            </div>
                                            <div>
                                                <img
                                                    src="/assets/vendors/dashboard/iconoir_air-conditioner.svg"
                                                    alt=""
                                                />
                                                <span>Air conditioning</span>
                                            </div>
                                            <div>
                                                <img
                                                    src="/assets/vendors/dashboard/bx_wifi.svg"
                                                    alt=""
                                                />
                                                <span>Free WiFi</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td style="width: 10%">
                                    <div class="vendor-add-room-table-number">
                                        <img
                                            src="/assets/vendors/dashboard/sleep.svg"
                                            alt=""
                                        />
                                        <img
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
                                            >65,238
                                        </div>
                                        <div>
                                            +<i
                                                class="fa-solid fa-indian-rupee-sign"
                                            ></i
                                            >7,854 taxes and charges
                                        </div>
                                    </div>
                                </td>
                                <td style="width: 35%">
                                    <div
                                        class="vendor-add-room-table-facilities"
                                    >
                                        <div>
                                            Free toiletries/ Shower Safety/
                                            deposit box Toilet Towels/ Linen
                                            Socket/ near the bed Desk TV
                                            /Slippers /Telephone Ironing
                                            facilities Satellite channels
                                            Tea/Coffee maker Radio Hairdryer
                                            Wake up service/Alarm clock Carpeted
                                            Electric kettle Wake-up service
                                            Alarm clock Laptop safe Upper floors
                                            accessible by elevator Toilet paper
                                            Entire unit wheelchair accessible
                                        </div>
                                        <div>
                                            <button type="button">
                                                <img
                                                    src="/assets/vendors/dashboard/iconoir_edit.svg"
                                                    alt=""
                                                />
                                            </button>
                                            <button type="button">
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
                        <div id="ven-profile-form-submit">
                            <button
                                data-id="vendor-about"
                                @click="toggleForm($event)"
                                type="submit"
                            >
                                Submit
                            </button>
                            <button
                                data-id="vendor-about"
                                @click="toggleForm($event)"
                                type="button"
                            >
                                <img src="/assets/vendors/Frame.svg" alt="" />
                            </button>
                        </div>
                    </div>
                    <div class="content" id="vendor-about">
                        <h1>Vendor profile preview</h1>
                        <div class="vendor-preview-form-fields">
                            <label for="vendorAbout">
                                About
                                <textarea
                                    name="vendorAbout"
                                    id="vendorAbout"
                                    rows="10"
                                ></textarea>
                            </label>
                            <label for="vendorFeatures">
                                Features
                                <textarea
                                    name="vendorFeatures"
                                    id="vendorFwatures"
                                    rows="10"
                                ></textarea>
                            </label>
                            <label for="vendorStartingPrice">
                                Veg/ Per Plate Price
                                <input
                                    type="text"
                                    name="vendorStartingPrice"
                                    id="vendorStartingPrice"
                                    placeholder=""
                                />
                            </label>
                            <label for="vendorEndingPrice">
                                Non Veg/ Per Plate Price
                                <input
                                    type="text"
                                    name="vendorEndingPrice"
                                    id="vendorEndingPrice"
                                    placeholder=""
                                />
                            </label>
                            <label for="Facebook_Profile_link">
                                Facebook Profile link
                                <input
                                    type="text"
                                    name="Facebook_Profile_link"
                                    id="Facebook_Profile_link"
                                    placeholder="Insert facebook link"
                                />
                            </label>
                            <label for="Instagram_Profile_link">
                                Instagram Profile link
                                <input
                                    type="text"
                                    name="Instagram_Profile_link"
                                    id="Instagram_Profile_link"
                                    placeholder="Insert instagram link"
                                />
                            </label>
                            <label for="Twitter_Profile_link">
                                Twitter Profile link
                                <input
                                    type="text"
                                    name="Twitter_Profile_link"
                                    id="Twitter_Profile_link"
                                    placeholder="Insert Twitter link"
                                />
                            </label>
                            <label for="Snapchat_Profile_link">
                                Snapchat Profile link
                                <input
                                    type="text"
                                    name="Snapchat_Profile_link"
                                    id="Snapchat_Profile_link"
                                    placeholder="Insert Snapchat link"
                                />
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
                                        hidden
                                        multiple
                                        @change="count($event)"
                                    />
                                </label>
                            </div>
                        </div>
                        <div id="ven-profile-form-submit">
                            <button
                                data-id="vendor-add-space"
                                @click="toggleForm($event)"
                                type="submit"
                            >
                                Submit
                            </button>
                            <button
                                data-id="vendor-add-space"
                                @click="toggleForm($event)"
                                type="button"
                            >
                                <img src="/assets/vendors/Frame.svg" alt="" />
                            </button>
                        </div>
                    </div>
                    <div class="content" id="vendor-add-space">
                        <h1>Vendor profile preview</h1>
                        <div
                            class="vendor-preview-form-fields vendor-addspace-form-feilds"
                        >
                            <label for="businessFacilities">
                                Business Facilities
                                <input
                                    type="text"
                                    name="businessFacilities"
                                    id="businessFacilities"
                                    placeholder="Add timing and slots"
                                    @keyup.enter="addspace($event)"
                                />
                                <ul>
                                    <li
                                        v-for="(
                                            item, index
                                        ) in addSpaceSubmit.businessFacilities"
                                        :key="index"
                                    >
                                        {{ item }}
                                    </li>
                                </ul>
                            </label>
                            <label for="FoodAndDrink">
                                Food and Drink
                                <input
                                    type="text"
                                    name="FoodAndDrink"
                                    id="FoodAndDrink"
                                    placeholder="Add Advances"
                                    @keyup.enter="addspace($event)"
                                />
                                <ul>
                                    <li
                                        v-for="(
                                            item, index
                                        ) in addSpaceSubmit.FoodAndDrink"
                                        :key="index"
                                    >
                                        {{ item }}
                                    </li>
                                </ul>
                            </label>
                            <label for="SafetyAndSecurity">
                                Safety and security
                                <input
                                    type="text"
                                    name="SafetyAndSecurity"
                                    id="SafetyAndSecurity"
                                    placeholder="Add Taxes"
                                    @keyup.enter="addspace($event)"
                                />
                                <ul>
                                    <li
                                        v-for="(
                                            item, index
                                        ) in addSpaceSubmit.SafetyAndSecurity"
                                        :key="index"
                                    >
                                        {{ item }}
                                    </li>
                                </ul>
                            </label>
                            <label for="Bathroom">
                                Bathroom
                                <input
                                    type="text"
                                    name="Bathroom"
                                    id="Bathroom"
                                    placeholder="Add Cancellation"
                                    @keyup.enter="addspace($event)"
                                />
                                <ul>
                                    <li
                                        v-for="(
                                            item, index
                                        ) in addSpaceSubmit.Bathroom"
                                        :key="index"
                                    >
                                        {{ item }}
                                    </li>
                                </ul>
                            </label>
                            <label for="Parking">
                                Parking
                                <input
                                    type="text"
                                    name="Parking"
                                    id="Parking"
                                    placeholder="Add Space preference"
                                    @keyup.enter="addspace($event)"
                                />
                                <ul>
                                    <li
                                        v-for="(
                                            item, index
                                        ) in addSpaceSubmit.Parking"
                                        :key="index"
                                    >
                                        {{ item }}
                                    </li>
                                </ul>
                            </label>
                            <label for="Outdoors">
                                Outdoors
                                <input
                                    type="text"
                                    name="Outdoors"
                                    id="Outdoors"
                                    placeholder="Add Changing room"
                                    @keyup.enter="addspace($event)"
                                />
                                <ul>
                                    <li
                                        v-for="(
                                            item, index
                                        ) in addSpaceSubmit.Outdoors"
                                        :key="index"
                                    >
                                        {{ item }}
                                    </li>
                                </ul>
                            </label>
                            <label for="MediaTecnology">
                                Media tecnology
                                <input
                                    type="text"
                                    name="MediaTecnology"
                                    id="MediaTecnology"
                                    placeholder="Add Decor policy"
                                    @keyup.enter="addspace($event)"
                                />
                                <ul>
                                    <li
                                        v-for="(
                                            item, index
                                        ) in addSpaceSubmit.MediaTecnology"
                                        :key="index"
                                    >
                                        {{ item }}
                                    </li>
                                </ul>
                            </label>
                            <label for="RoomsAndAmenities">
                                Rooms and amenities
                                <input
                                    type="text"
                                    name="RoomsAndAmenities"
                                    id="RoomsAndAmenities"
                                    placeholder="Add Parking"
                                    @keyup.enter="addspace($event)"
                                />
                                <ul>
                                    <li
                                        v-for="(
                                            item, index
                                        ) in addSpaceSubmit.RoomsAndAmenities"
                                        :key="index"
                                    >
                                        {{ item }}
                                    </li>
                                </ul>
                            </label>
                            <label for="General">
                                General
                                <input
                                    type="text"
                                    name="General"
                                    id="General"
                                    placeholder="Add Alcohol"
                                    @keyup.enter="addspace($event)"
                                />
                                <ul>
                                    <li
                                        v-for="(
                                            item, index
                                        ) in addSpaceSubmit.General"
                                        :key="index"
                                    >
                                        {{ item }}
                                    </li>
                                </ul>
                            </label>
                            <label for="Internet">
                                Internet
                                <input
                                    type="text"
                                    name="Internet"
                                    id="Internet"
                                    placeholder="Add Food"
                                    @keyup.enter="addspace($event)"
                                />
                                <ul>
                                    <li
                                        v-for="(
                                            item, index
                                        ) in addSpaceSubmit.Internet"
                                        :key="index"
                                    >
                                        {{ item }}
                                    </li>
                                </ul>
                            </label>
                            <label for="Lodging">
                                Lodging
                                <input
                                    type="text"
                                    name="Lodging"
                                    id="Lodging"
                                    placeholder="Add Food"
                                    @keyup.enter="addspace($event)"
                                />
                                <ul>
                                    <li
                                        v-for="(
                                            item, index
                                        ) in addSpaceSubmit.Lodging"
                                        :key="index"
                                    >
                                        {{ item }}
                                    </li>
                                </ul>
                            </label>
                            <label for="OtherAmenities">
                                Other amenities
                                <input
                                    type="text"
                                    name="OtherAmenities"
                                    id="OtherAmenities"
                                    placeholder="Add Food"
                                    @keyup.enter="addspace($event)"
                                />
                                <ul>
                                    <li
                                        v-for="(
                                            item, index
                                        ) in addSpaceSubmit.OtherAmenities"
                                        :key="index"
                                    >
                                        {{ item }}
                                    </li>
                                </ul>
                            </label>
                        </div>
                        <div id="ven-profile-form-submit">
                            <button type="submit">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            hidden: false,
            addRoomSubmit: {
                roomType: null,
                sleep: null,
                Beds_available: null,
                Total_rooms: null,
                Price_per_room: null,
                Tax_and_services: null,
                room_specification: [],
                facilities_specification: [],
            },
            addSpaceSubmit: {
                businessFacilities: [],
                FoodAndDrink: [],
                SafetyAndSecurity: [],
                Bathroom: [],
                Parking: [],
                Outdoors: [],
                MediaTecnology: [],
                RoomsAndAmenities: [],
                General: [],
                Internet: [],
                Lodging: [],
                OtherAmenities: [],
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
        };
    },
    methods: {
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
        toggleForm(e) {
            const btns = document.querySelectorAll(".tab-btn");
            const articles = document.querySelectorAll(".content");
            btns.forEach(function (btn) {
                btn.classList.remove("active");
            });
            btns.forEach(function (btn) {
                if (btn.dataset.id == e.currentTarget.dataset.id) {
                    btn.classList.add("active");
                }
            });
            articles.forEach(function (article) {
                article.classList.remove("active");
            });
            document
                .getElementById(e.currentTarget.dataset.id)
                .classList.add("active");
        },
        hideBlock(e, id, txt) {
            if (txt == "room") {
                this.addRoomSubmit.room_specification.splice(id, 1);
            }
            if (txt == "facility") {
                this.addRoomSubmit.facilities_specification.splice(id, 1);
            }
        },
        onEnter(e) {
            let val = e.currentTarget.value;
            if (!val) {
                return;
            }
            if (!val.replace(/\s/g, "").length) {
                return;
            }
            if (e.currentTarget.id === "room_specification") {
                this.addRoomSubmit.room_specification.push({ name: val });
            }
            if (e.currentTarget.id == "room_facilities") {
                this.addRoomSubmit.facilities_specification.push({ name: val });
            }
            e.currentTarget.value = "";
        },
        addspace(e) {
            if (!e.currentTarget.value) {
                return;
            }
            if (!e.currentTarget.value.replace(/\s/g, "").length) {
                return;
            }
            let od = e.currentTarget.id;
            let ss = this.addSpaceSubmit[od];
            ss.push(e.currentTarget.value);
            e.currentTarget.value = "";
        },
        addInput(e) {
            if (e.currentTarget.parentElement.id == "specification-btn-cont") {
                let val = this.roomSpecificationTags.find(function (
                    item,
                    index
                ) {
                    if (item.id == e.currentTarget.dataset.id) {
                        return true;
                    }
                });
                if (val) {
                    this.addRoomSubmit.room_specification.push(val);
                }
            }
            if (e.currentTarget.parentElement.id == "facilities-btn-cont") {
                let val2 = this.accomoFacilitiesTags.find(function (
                    item,
                    index
                ) {
                    if (item.id == e.currentTarget.dataset.id) {
                        return true;
                    }
                });
                if (val2) {
                    this.addRoomSubmit.facilities_specification.push(val2);
                }
            }
        },
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
    justify-content: space-between;
}
.vendor-add-room-table-type > div:nth-child(4) > div {
    margin-right: 5px;
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
#ven-profile-form-submit {
    position: relative;
    margin: 1.5em 0;
    padding: 4.5em;
    padding-right: 0;
    display: flex;
    justify-content: flex-end;
}

#ven-profile-form-submit > button:nth-child(1) {
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
#ven-profile-form-submit > button:nth-child(2) {
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
