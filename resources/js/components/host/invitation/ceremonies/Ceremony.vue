<template>
    <div class="wed-host-section container mx-auto">
        <div class="wed-host-section-container">
            <div>
                <div class="wed-cere-head">
                    <h1>Wedding Ceremonies</h1>
                    <button
                        v-if="showForm == false"
                        @click="
                            showForm = true;
                            active = totalCeramonies[0]['name'];
                        "
                    >
                        <span>+</span>Add Ceremony
                    </button>
                    <button
                        v-if="
                            showForm == true &&
                            totalCeramonies.length > 0 &&
                            inviCeramonies != 0
                        "
                        @click="closeForm()"
                    >
                        Close
                    </button>
                </div>
                <div v-if="totalCeramonies.length == 0 || showForm == true">
                    <div v-if="screenWidth > 768">
                        <div v-if="edit == false" class="wed-cere-title-cont">
                            <div
                                v-for="(item, index) in totalCeramonies"
                                :key="index"
                                :class="
                                    item['name'] == active
                                        ? 'wed-cere-title-single title-active'
                                        : 'wed-cere-title-single'
                                "
                                @click="switchForm($event, item)"
                            >
                                {{ titleCase(item["name"]) }}
                            </div>
                        </div>

                        <div v-else class="wed-cere-title-cont">
                            <div class="wed-cere-title-single title-active">
                                {{ titleCase(active) }}
                            </div>
                        </div>
                    </div>
                    <div v-else class="mobile-list-cont">
                        <div
                            @click.stop="showDropDown = !showDropDown"
                            class="mobile-list-head"
                        >
                            {{ titleCase(active) }}
                            <img
                                v-if="
                                    edit == false && totalCeramonies.length != 1
                                "
                                src="/assets/ceramonies/icon-down.svg"
                                alt=""
                            />
                        </div>
                        <div
                            v-if="showDropDown && edit == false"
                            class="mobile-list-content-cont"
                        >
                            <div
                                v-for="(item, index) in filteredList"
                                :key="index"
                                class="mobile-list-single"
                                @click="switchForm($event, item)"
                            >
                                {{ titleCase(item["name"]) }}
                            </div>
                        </div>
                    </div>
                    <div class="wed-cere-content">
                        <h3 class="wed-cere-content-title">
                            {{ titleCase(active) }}
                        </h3>
                        <ValidationObserver
                            v-slot="{ handleSubmit, invalid }"
                            :class="{ blur: loader }"
                            ref="formObserver"
                        >
                            <form
                                @submit.prevent="
                                    handleSubmit(
                                        sendCeremony(invalid, $event, active)
                                    )
                                "
                            >
                                <ValidationProvider
                                    v-if="active == 'Custom'"
                                    rules="required|min:3|max:70|alpha_spaces"
                                    v-slot="{ errors }"
                                >
                                    <div
                                        class="form-group-custom"
                                        :class="{
                                            'form-group--error':
                                                errors.length > 0,
                                        }"
                                    >
                                        <label for="title" class="form-label"
                                            >Display Name</label
                                        >
                                        <input
                                            type="text"
                                            name="title"
                                            id="title"
                                            class="form-control"
                                            placeholder="Ceremony Name"
                                            v-model="ceremonyData.name"
                                        />
                                        <span class="errMsg">{{
                                            errors[0]
                                        }}</span>

                                        <span
                                            v-if="
                                                errorsSubmit &&
                                                errorsSubmit.name
                                            "
                                            class="errMsg"
                                            >{{ errorsSubmit.name[0] }}</span
                                        >
                                    </div>
                                </ValidationProvider>
                                <ValidationProvider
                                    rules="image|mimes:image/jpeg,image/png"
                                    name="Ceremony Image"
                                    ref="ceramonyRef"
                                    v-slot="{ errors }"
                                >
                                    <div class="form-group-custom">
                                        <label for="title" class="form-label"
                                            >Display Image</label
                                        >
                                        <div
                                            class="upload-btn-cont disp-image-feild"
                                        >
                                            <span>{{ imageOneMessage }}</span>
                                            <input
                                                @change="
                                                    uploadImage(
                                                        $event,
                                                        'cereImage'
                                                    )
                                                "
                                                ref="dispImage"
                                                type="file"
                                                name="CeremonyImage"
                                            />
                                            <button
                                                @click="$refs.dispImage.click()"
                                                type="button"
                                            >
                                                <img
                                                    src="/assets/miscellenous/upload.svg"
                                                    alt=""
                                                />
                                                Upload
                                            </button>
                                        </div>
                                        <span class="errMsg">{{
                                            errors[0]
                                        }}</span>

                                        <span
                                            v-if="
                                                errorsSubmit &&
                                                errorsSubmit.imageOne
                                            "
                                            class="errMsg"
                                            >{{
                                                errorsSubmit.imageOne[0]
                                            }}</span
                                        >
                                    </div>
                                    <img
                                        style="width: 100px; height: 100px"
                                        v-if="imageOnePreview"
                                        :src="imageOnePreview"
                                        alt=""
                                    />
                                </ValidationProvider>

                                <div class="date-grp">
                                    <ValidationProvider
                                        rules="required"
                                        v-slot="{ errors }"
                                    >
                                        <div
                                            class="form-group-custom"
                                            :class="{
                                                'form-group--error':
                                                    errors.length > 0,
                                            }"
                                        >
                                            <input
                                                :type="
                                                    ceremonyData?.startDate
                                                        ? 'date'
                                                        : 'text'
                                                "
                                                name="completionDate"
                                                onfocus="(this.type='date')"
                                                class="form-date form-control"
                                                placeholder="Start date"
                                                v-model="ceremonyData.startDate"
                                                ref="typedate"
                                                :min="new Date().toISOString().split('T')[0]"
                                            />
                                            <span class="errMsg">{{
                                                errors[0]
                                            }}</span>

                                            <span
                                                v-if="
                                                    errorsSubmit &&
                                                    errorsSubmit.startDate
                                                "
                                                class="errMsg"
                                                >{{
                                                    errorsSubmit.startDate[0]
                                                }}</span
                                            >
                                        </div>
                                    </ValidationProvider>
                                    <ValidationProvider
                                        rules="required"
                                        v-slot="{ errors }"
                                    >
                                        <div
                                            class="form-group-custom"
                                            :class="{
                                                'form-group--error':
                                                    errors.length > 0,
                                            }"
                                        >
                                            <input
                                                :type="
                                                    ceremonyData?.startDate
                                                        ? 'time'
                                                        : 'text'
                                                "
                                                name="completionDate"
                                                onfocus="(this.type='time')"
                                                class="form-date form-control"
                                                placeholder="Start time"
                                                v-model="ceremonyData.startTime"
                                                ref="typetime"
                                            />
                                            <span class="errMsg">{{
                                                errors[0]
                                            }}</span>

                                            <span
                                                v-if="
                                                    errorsSubmit &&
                                                    errorsSubmit.startTime
                                                "
                                                class="errMsg"
                                                >{{
                                                    errorsSubmit.startTime[0]
                                                }}</span
                                            >
                                        </div>
                                    </ValidationProvider>
                                </div>
                                <div>
                                    <div class="dress-code-toggle-cont">
                                        <span>Dress Code</span>
                                        <label class="switch" for="toggle-btn">
                                            <!-- <input
                                                v-model="toggle"
                                                type="checkbox"
                                                id="toggle-btn"

                                            /> -->
                                            <span
                                                @click="toggle = !toggle"
                                                class="slider round"
                                                :class="{ checked: toggle }"
                                            ></span>
                                        </label>
                                    </div>
                                    <div v-if="toggle" class="dress-code-cont">
                                        <div>
                                            <ValidationProvider
                                                rules="min:3|max:20|alpha_spaces"
                                                v-slot="{ errors }"
                                            >
                                                <div
                                                    class="form-group-custom"
                                                    :class="{
                                                        'form-group--error':
                                                            errors.length > 0,
                                                    }"
                                                >
                                                    <label
                                                        for="ladiesDress"
                                                        class="form-label"
                                                    ></label>
                                                    <input
                                                        type="text"
                                                        id="ladiesDress"
                                                        class="form-control"
                                                        placeholder="Me dress code Eg: Black suit"
                                                        v-model="
                                                            ceremonyData.ladiesDress
                                                        "
                                                    />
                                                    <span class="errMsg">{{
                                                        errors[0]
                                                    }}</span>

                                                    <span
                                                        v-if="
                                                            errorsSubmit &&
                                                            errorsSubmit.ladiesDress
                                                        "
                                                        class="errMsg"
                                                        >{{
                                                            errorsSubmit
                                                                .ladiesDress[0]
                                                        }}</span
                                                    >
                                                </div>
                                            </ValidationProvider>
                                            <ValidationProvider
                                                rules="image|mimes:image/jpeg,image/png"
                                                name="Ladies Dress"
                                                ref="ladiesRef"
                                                v-slot="{ errors }"
                                            >
                                                <div class="upload-btn-cont">
                                                    <input
                                                        @change="
                                                            uploadImage(
                                                                $event,
                                                                'ladiesDress'
                                                            )
                                                        "
                                                        ref="ladyDress"
                                                        type="file"
                                                    />
                                                    <button
                                                        @click="
                                                            $refs.ladyDress.click()
                                                        "
                                                        type="button"
                                                    >
                                                        <img
                                                            src="/assets/miscellenous/upload.svg"
                                                            alt=""
                                                        />
                                                        Upload
                                                    </button>
                                                    <span>{{
                                                        imageTwoMessage
                                                    }}</span>
                                                </div>
                                                <span class="errMsg">{{
                                                    errors[0]
                                                }}</span>

                                                <span
                                                    v-if="
                                                        errorsSubmit &&
                                                        errorsSubmit.imageTwo
                                                    "
                                                    class="errMsg"
                                                    >{{
                                                        errorsSubmit.imageTwo[0]
                                                    }}</span
                                                >
                                                <img
                                                    style="
                                                        width: 100px;
                                                        height: 100px;
                                                    "
                                                    v-if="imageTwoPreview"
                                                    :src="imageTwoPreview"
                                                    alt=""
                                                />
                                            </ValidationProvider>
                                        </div>
                                        <div>
                                            <ValidationProvider
                                                rules="min:3|max:20|alpha_spaces"
                                                v-slot="{ errors }"
                                            >
                                                <div
                                                    class="form-group-custom"
                                                    :class="{
                                                        'form-group--error':
                                                            errors.length > 0,
                                                    }"
                                                >
                                                    <label
                                                        for="menDress"
                                                        class="form-label"
                                                    ></label>
                                                    <input
                                                        type="text"
                                                        name="menDress"
                                                        id="menDress"
                                                        class="form-control"
                                                        placeholder="Ladies dress code Eg: Black Lehenga"
                                                        v-model="
                                                            ceremonyData.menDress
                                                        "
                                                    />
                                                    <span class="errMsg">{{
                                                        errors[0]
                                                    }}</span>

                                                    <span
                                                        v-if="
                                                            errorsSubmit &&
                                                            errorsSubmit.menDress
                                                        "
                                                        class="errMsg"
                                                        >{{
                                                            errorsSubmit
                                                                .menDress[0]
                                                        }}</span
                                                    >
                                                </div>
                                            </ValidationProvider>
                                            <ValidationProvider
                                                rules="image|mimes:image/jpeg,image/png"
                                                name="Mens Dress"
                                                ref="gentsRef"
                                                v-slot="{ errors }"
                                            >
                                                <div class="upload-btn-cont">
                                                    <input
                                                        @change="
                                                            uploadImage(
                                                                $event,
                                                                'gentsDress'
                                                            )
                                                        "
                                                        ref="menDress"
                                                        type="file"
                                                    />
                                                    <button
                                                        @click="
                                                            $refs.menDress.click()
                                                        "
                                                        type="button"
                                                    >
                                                        <img
                                                            src="/assets/miscellenous/upload.svg"
                                                            alt=""
                                                        />
                                                        Upload
                                                    </button>
                                                    <span>{{
                                                        imageThreeMessage
                                                    }}</span>
                                                </div>
                                                <span class="errMsg">{{
                                                    errors[0]
                                                }}</span>

                                                <span
                                                    v-if="
                                                        errorsSubmit &&
                                                        errorsSubmit.imageThree
                                                    "
                                                    class="errMsg"
                                                    >{{
                                                        errorsSubmit
                                                            .imageThree[0]
                                                    }}</span
                                                >
                                                <img
                                                    style="
                                                        width: 100px;
                                                        height: 100px;
                                                    "
                                                    v-if="imageThreePreview"
                                                    :src="imageThreePreview"
                                                    alt=""
                                                />
                                            </ValidationProvider>
                                        </div>
                                    </div>
                                </div>
                                <ValidationProvider
                                    rules="required"
                                    name="venue"
                                    v-slot="{ errors }"
                                >
                                    <div
                                        class="form-group-custom"
                                        :class="{
                                            'form-group--error': errors.length > 0,
                                        }"
                                        style="margin-top: 7px"
                                    >
                                        <label class="form-label">Venues</label>
                                        <select
                                            name="venue_id"
                                            class="form-control"
                                            v-model="venueid"
                                        >
                                            <option value="">Select a venue</option>
                                            <option
                                                v-for="(venue, venueIndex) in venueList"
                                                :key="`venue-option-${venue.id || venue.code}-${venueIndex}`"
                                                :value="venue.id || venue.code"
                                            >
                                                {{ venue.name }}
                                            </option>
                                        </select>
                                        <div @click="showAddVenue = true" class="add-venue-link">Add or Edit Your Venues!</div>
                                        <span class="errMsg">{{ errors[0] }}</span>
                                        <span
                                            v-if="errorsSubmit && errorsSubmit.venue_id"
                                            class="errMsg"
                                        >{{ errorsSubmit.venue_id[0] }}</span>
                                    </div>
                                </ValidationProvider>
                                <!-- <div class="add-venue-link-cont">
                                    <a href="/host/venues/create"
                                        >Could'nt find a perfect venue? Add
                                        One!!</a
                                    >
                                </div> -->
                                <div class="form-group-custom ml-5">
                                    <button
                                        type="submit"
                                        :disabled="disableSubmit"
                                    >
                                        Submit
                                    </button>
                                </div>
                            </form>
                        </ValidationObserver>
                    </div>
                </div>
                <div v-else class="cere-view-cont">
                    <div
                        v-for="(item, index) in inviCeramonies"
                        :key="`ceremony-${item.id}-${index}`"
                        class="cere-view-single"
                    >
                        <div class="cere-single-image-cont">
                            <img
                                :src="
                                    '/assets/defaults/ceramonies/images/' +
                                    item.imageOne
                                "
                                alt=""
                            />
                            <div>
                                <img
                                    v-if="item.name.toLowerCase() !== 'wedding'"
                                    :class="{
                                        disabled: disabledEdit,
                                    }"
                                    @click="editCeramony(index, item)"
                                    src="/assets/ceramonies/edit.svg"
                                    alt=""
                                />
                                <img
                                    v-if="item.name.toLowerCase() !== 'wedding'"
                                    src="/assets/ceramonies/trash.svg"
                                    alt=""
                                    :class="{
                                        disabled: disabledDelete,
                                    }"
                                    @click="deleteCeramony(index, item)"
                                />
                            </div>
                        </div>
                        <div class="cere-view-info">
                            <h3>{{ titleCase(item.name) }}</h3>
                            <div class="cere-view-info-time">
                                <div>
                                    <img
                                        src="/assets/ceramonies/calendar.svg"
                                        alt=""
                                    />
                                </div>
                                <div>
                                    <div>
                                        {{
                                            new Date(
                                                item.startDate
                                            ).toLocaleDateString("en-us", {
                                                weekday: "long",
                                                year: "numeric",
                                                month: "long",
                                                day: "numeric",
                                            })
                                        }}
                                    </div>
                                    <div>
                                        {{
                                            new Date(
                                                "1970-01-01T" +
                                                    item.startTime +
                                                    "Z"
                                            ).toLocaleTimeString("en-US", {
                                                timeZone: "UTC",
                                                hour12: true,
                                                hour: "numeric",
                                                minute: "numeric",
                                            })
                                        }}
                                    </div>
                                </div>
                            </div>
                            <div class="cere-view-info-time">
                                <div>
                                    <img
                                        src="/assets/ceramonies/map-pin.svg"
                                        alt=""
                                    />
                                </div>
                                <div>
                                    <div v-for="(e, venueIndex) in item.venues" :key="`venue-${e.id || e.name}-${venueIndex}`">
                                        {{ e.name }}
                                        <template v-if="e.address">, {{ e.address }}</template>
                                        <template v-if="e.pincode">, {{ e.pincode }}</template>
                                        <template v-if="e.city">, {{ e.city }}</template>
                                        <template v-if="e.state">, {{ e.state }}</template>
                                        <template v-if="e.location && e.location.name">, {{ e.location.name }}</template>
                                        <template v-if="e.location && e.location.state && e.location.state.name">, {{ e.location.state.name }}</template>
                                    </div>
                                </div>
                            </div>
                            <div
                                v-if="
                                    item.menDress ||
                                    item.ladiesDress ||
                                    item.imageTwo ||
                                    item.imageThree
                                "
                                class="cere-view-dress-cont"
                            >
                                <h3>Dress Code</h3>
                                <div v-if="item.menDress || item.imageTwo">
                                    <span>
                                        <img
                                            src="/assets/ceramonies/carbon_gender-male.svg"
                                            alt=""
                                        />
                                        <span>Men:</span>
                                    </span>
                                    <span v-if="item.menDress">
                                        {{ item.menDress }}
                                    </span>
                                    <div v-if="item.imageTwo">
                                        <img
                                            class="dress-img"
                                            :src="
                                                '/assets/defaults/ceramonies/images/' +
                                                item.imageTwo
                                            "
                                            alt=""
                                        />
                                    </div>
                                </div>
                                <div v-if="item.ladiesDress || item.imageThree">
                                    <span>
                                        <img
                                            src="/assets/ceramonies/carbon_gender-female.svg"
                                            alt=""
                                        />
                                        <span>Women:</span>
                                    </span>
                                    <span v-if="item.ladiesDress">
                                        {{ item.ladiesDress }}
                                    </span>
                                    <div v-if="item.imageThree">
                                        <img
                                            class="dress-img"
                                            :src="
                                                '/assets/defaults/ceramonies/images/' +
                                                item.imageThree
                                            "
                                            alt=""
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <flashMessage :message="message"></flashMessage>
        <AddVenue v-if="showAddVenue == true" :hostvenues="hostVenueList" :showform="showAddVenue" @close="showAddVenue = false" @message="(n) => message = n" @venue="updateVenuelist"  @all="(n) => hostVenueList = n"></AddVenue>
    </div>
</template>

<script>
import flashMessage from "../../../FlashMessage.vue";
import AddVenue from "../AddVenue.vue"

export default {
    components: {
        flashMessage,
        AddVenue,
    },
    props: {
        host: {
            type: Object,
            required: true
        },
        invitation: {
            type: Object,
            required: true
        },
        ceramonies: {
            type: Array,
            required: true
        },
        venues: {
            type: Array,
            required: true
        },
        ceramonylist: {
            type: Array,
            required: true
        },
        hostvenues: {
            type: Array,
            required: true
        }
    },
    data() {
        return {
            venueid: null,
            active: this.ceramonylist[0]["name"] ?? null,
            toggle: false,
            ceremonyData: {
                name: this.ceramonylist[0]["name"] ?? null,
            },
            inviCeramonies: this.ceramonies,
            totalCeramonies: this.ceramonylist,
            imageOne: null,
            imageTwo: null,
            imageThree: null,
            imageOneMessage: "Upload Image",
            imageTwoMessage: null,
            imageThreeMessage: null,
            imageOnePreview: null,
            imageTwoPreview: null,
            imageThreePreview: null,
            showForm: false,
            disableSubmit: false,
            disabledDelete: false,
            disabledEdit: false,
            edit: false,
            editCera: null,
            message: null,
            showDropDown: false,
            screenWidth: window.screen.width,
            errorsSubmit: null,
            loader: false,
            showAddVenue: false,
            venueList: this.venues || [],
            hostVenueList: this.hostvenues || [],
        };
    },
    methods: {
        // Venue update handler - moved to top for better accessibility
        handleVenueUpdate(data) {
            console.log('handleVenueUpdate called with:', data);
            if (data && data.action === 'update') {
                const index = this.venueList.findIndex(v => v.code === data.venue.code);
                if (index !== -1) {
                    this.venueList[index] = { ...this.venueList[index], ...data.venue };
                }
            } else if (data && data.action === 'add') {
                this.venueList.unshift(data.venue);
            }
        },
        updateVenuelist(n) {
            console.log('updateVenuelist called with:', n);
            if (n[1] === 'update') {
                const index = this.venueList.findIndex(v => v.id === n[0].id || v.code === n[0].code);
                if (index !== -1) {
                    this.venueList[index] = { ...this.venueList[index], ...n[0] };
                }
                // Call the internal handler for consistency with defensive check
                if (typeof this.handleVenueUpdate === 'function') {
                    this.handleVenueUpdate({
                        venue: n[0],
                        action: 'update'
                    });
                }
            } else if (n[1] === 'add') {
                // Create a properly formatted venue object
                const newVenue = {
                    id: n[0].id || n[0].code,
                    name: n[0].name,
                    code: n[0].code || n[0].id,
                    address: n[0].address
                };

                // Add the new venue to the list
                this.venueList.unshift(newVenue);

                // Explicitly set the venue ID to match what the backend expects
                this.venueid = newVenue.id;

                // Force validation refresh
                this.$nextTick(() => {
                    if (this.$refs.formObserver) {
                        this.$refs.formObserver.validate();
                    }
                });

                // Call the internal handler for consistency with defensive check
                if (typeof this.handleVenueUpdate === 'function') {
                    this.handleVenueUpdate({
                        venue: newVenue,
                        action: 'add'
                    });
                }
            }
        },
        switchForm(e, id) {
            let _this = this;

            //let check = this.ceramonies.find(x => x.name == id);
            if (_this.edit == true) {
                return;
            }
            if (id != this.active) {
                this.active = id["name"];

                this.setFeilds();
            } else {
                this.active = id;
            }
        },
        closeForm() {
            this.setFeilds();
            this.edit = false;
            this.showDropDown = true;
            this.showForm = false;
        },
        titleCase(str) {
            let _this = this;
            var splitStr = str.toLowerCase().split(" ");
            for (var i = 0; i < splitStr.length; i++) {
                // You do not need to check if i is larger than splitStr length, as your for does that for you
                // Assign it back to the array
                splitStr[i] =
                    splitStr[i].charAt(0).toUpperCase() +
                    splitStr[i].substring(1);
            }
            // Directly return the joined string
            return splitStr.join(" ");
        },
        setFeilds() {
            let _this = this;
            this.$refs.formObserver.reset();
            _this.toggle = false;
            _this.venueid = null;
            _this.$refs.typedate.type = "text";
            _this.$refs.typetime.type = "text";
            _this.imageOne = null;
            _this.imageOnePreview = null;
            _this.imageOneMessage = "Upload Image";
            _this.imageTwo = null;
            _this.imageTwoPreview = null;
            _this.imageTwoMessage = null;
            _this.imageThree = null;
            _this.imageThreePreview = null;
            _this.imageThreeMessage = null;
            _this.ceremonyData = {
                name: this.active,
            };
        },
        async uploadImage(e, type) {
            let _this = this;
            if (type == "cereImage") {
                await this.$refs.ceramonyRef.validate(e);
                this.imageOne = e.target.files[0];
                this.imageOneMessage = e.target.files[0].name;
                _this.imageOnePreview = URL.createObjectURL(_this.imageOne);
                // if (this.sendProfile.imageOne) {
                //     delete this.sendProfile.imageOne;
                // }
            }
            if (type == "ladiesDress") {
                await this.$refs.ladiesRef.validate(e);
                this.imageTwo = e.target.files[0];
                this.imageTwoMessage = e.target.files[0].name;
                _this.imageTwoPreview = URL.createObjectURL(_this.imageTwo);
                // if (this.sendProfile.imageOne) {
                //     delete this.sendProfile.imageOne;
                // }
            }
            if (type == "gentsDress") {
                await this.$refs.gentsRef.validate(e);
                this.imageThree = e.target.files[0];
                this.imageThreeMessage = e.target.files[0].name;
                _this.imageThreePreview = URL.createObjectURL(_this.imageThree);
                // if (this.sendProfile.imageOne) {
                //     delete this.sendProfile.imageOne;
                // }
            }
        },
        sendCeremony(validate, e, type) {
            this.loader = true;
            if (validate == true) {
                this.loader = false;
                return;
            }

            let _this = this;
            _this.errorsSubmit = null;
            this.disableSubmit = true;
            let formData = new FormData();
            
            if (_this.imageOne != null) {
                formData.append("imageOne", _this.imageOne);
            }
            if (_this.imageTwo != null) {
                formData.append("imageTwo", _this.imageTwo);
            }
            if (_this.imageThree != null) {
                formData.append("imageThree", _this.imageThree);
            }
            for (var key in _this.ceremonyData) {
                formData.append(key, _this.ceremonyData[key]);
            }
            
            if (_this.venueid != null) {
                formData.append("venue_id", _this.venueid);
            }
            
            let link = route("ceramony.store", _this.invitation);
            if (_this.edit == true) {
                formData.append("_method", "PATCH");
                link = route("ceramony.update", [
                    _this.invitation,
                    _this.editCera,
                ]);
            }
            
            axios({
                method: "POST",
                url: link,
                data: formData,
                headers: { "content-type": "multipart/form-data" },
            })
            .then(function (response) {
                _this.inviCeramonies = response.data[0];
                _this.totalCeramonies = response.data[1];
                _this.active = _this.totalCeramonies[0]["name"];
                _this.loader = false;
                _this.setFeilds();
                _this.editCera = false;
                _this.edit = false;
                _this.showForm = false;
                _this.disableSubmit = false;
                _this.message = "Ceremony Added Successfully!";

                setTimeout(function () {
                    _this.message = null;
                }, 3000);
            })
            .catch((error) => {
                console.log(error);
                _this.errorsSubmit = error.response.data.errors;
                _this.disableSubmit = false;
                _this.message = error.response.data.message;
                _this.loader = false;
                setTimeout(function () {
                    _this.message = null;
                }, 3000);
            });
        },
        deleteCeramony(index, ele) {
            let _this = this;
            _this.disabledDelete = true;
            axios({
                method: "DELETE",
                url: route("hostceramony.destroy", [_this.invitation, ele.id]),
            })
                .then((response) => {
                    _this.message = "Ceremony Deleted Successfully!";
                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                    _this.inviCeramonies = response.data[0];
                    _this.totalCeramonies = response.data[1];
                    _this.active = _this.totalCeramonies[0]["name"];
                    _this.disabledDelete = false;
                    if (_this.inviCeramonies.length == 0) {
                        _this.showForm = true;
                    }
                })
                .catch((error) => {
                    _this.message = error.response.data.message;
                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                    _this.disabledDelete = false;
                });
        },
        editCeramony(index, item) {
            let _this = this;
            _this.edit = true;
            _this.editCera = item;
            _this.active = item.name;
            _this.venueid = item.venues[0].id;
            _this.ceremonyData.name = item.name;
            _this.ceremonyData.startDate = item.startDate;
            _this.ceremonyData.startTime = item.startTime;
            _this.showForm = true;
            if (item.imageOne != null) {
                _this.imageOneMessage = "Change Old Image";
            }
            if (
                item.imageTwo ||
                item.imageThree ||
                item.menDress ||
                item.ladiesDress
            ) {
                _this.toggle = true;
            }
            if (item.imageTwo != null) {
                _this.imageTwoMessage = "Change Old Image";
            }
            if (item.imageThree != null) {
                _this.imageThreeMessage = "Change Old Image";
            }
            if (item.menDress != null) {
                _this.ceremonyData.menDress = item.menDress;
            }
            if (item.ladiesDress != null) {
                _this.ceremonyData.ladiesDress = item.ladiesDress;
            }
        },
        hideDropdown() {
            this.showDropDown = false;
            this.screenWidth = window.screen.width;
        },
    },
    mounted() {
        this.$nextTick(() => {
            if (this.inviCeramonies.length == 0) {
                this.showForm = true;
            }
            window.addEventListener("resize", this.hideDropdown);
        });
    },
    computed: {
        filteredList() {
            return this.totalCeramonies.filter(
                (item) => this.active != item["name"]
            );
        },
    },
    created: function () {
        document.body.addEventListener("click", this.hideDropdown);
    },
};
</script>

<style scoped>
.blur {
    filter: blur(2px);
    pointer-events: none;
}
.errMsg {
    color: red;
    font-size: 10px;
}
.form-group--error label {
    border-color: #f79483 !important;
    color: #f04124 !important;
}
.form-group--error .error {
    font-size: 10px;
    color: #f57f6c;
}
.disabled {
    pointer-events: none;
}
.wed-cere-head {
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
    min-height: 50px;
    margin-bottom: 15px;
}
.wed-cere-head > h1 {
    font-family: "Perpetua";
    font-style: normal;
    font-weight: 700;
    font-size: 24.4444px;
    line-height: 28px;
    text-align: center;
    color: #333333;
}
.wed-cere-head > button {
    outline: none;
    border: 1.14286px solid #e3e8ee;
    border-radius: 5.71429px;
    background: white;
    padding: 14px 20px;
    font-family: "Poppins", sans-serif;
    font-style: normal;
    font-weight: 400;
    font-size: 11.4286px;
    line-height: 17px;
    color: #000000;
    position: absolute;
    right: 0;
    display: flex;
    align-items: center;
}
.wed-cere-head > button > span {
    font-size: 17px;
    margin-right: 5px;
    color: #c4456f;
}
.wed-cere-title-cont {
    display: flex;
    flex-wrap: wrap;
    width: 70%;
    margin: auto;
    justify-content: center;
}
.wed-cere-content {
    width: 70%;
    margin: auto;
}
.wed-cere-content form > *,
.dress-code-cont > div > * {
    margin-bottom: 12px;
    display: block;
}
.wed-cere-content-title {
    font-family: "Poppins", sans-serif;
    font-style: normal;
    font-weight: 600;
    font-size: 20px;
    line-height: 30px;
    text-align: center;

    color: #333333;
}
.wed-cere-title-single {
    background: #ffe9ee;
    border: 1px solid #d8839f;
    border-radius: 10px;
    padding: 12px 26px;
    font-family: "Poppins", sans-serif;
    font-style: normal;
    font-weight: 500;
    font-size: 13px;
    line-height: 20px;
    text-align: center;
    color: #c4456f;
    width: max-content;
    margin-right: 10px;
    margin-bottom: 10px;
}
.title-active {
    background: #c4456f !important;
    color: white !important;
}
.form-group-custom label {
    font-family: "Poppins", sans-serif;
    font-style: normal;
    font-weight: 500;
    font-size: 12px;
    line-height: 8px;
    margin-left: 10px;

    color: #000000;
}
.form-group-custom input,
.form-group-custom select {
    background: rgba(239, 220, 226, 0.2);
    border: 0.643349px solid #f7dae4;
    border-radius: 7.72019px;
}
.form-group-custom select {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    background-image: url(/assets/miscellenous/icon-down.svg);
    background-repeat: no-repeat;
    background-position: 98%;
    background-size: 20px;
}
.form-group-custom input::placeholder {
    font-family: "Poppins", sans-serif;
    font-style: normal;
    font-weight: 400;
    font-size: 10px;
    line-height: 8px;
    margin-left: 10px;

    color: #000000;
}
.form-group-custom button {
    border: none;
    outline: none;
    background: #c4456f;
    border-radius: 7.72px;
    width: 100%;
    display: inline-block;
    padding: 11px;
    font-family: "Poppins", sans-serif;
    font-style: normal;
    font-weight: 600;
    font-size: 9.10182px;
    line-height: 14px;

    text-align: center;
    box-shadow: none !important;
    color: #ffffff;
}
.date-grp {
    display: flex !important;
    flex-wrap: wrap;
    justify-content: space-between;
}
.date-grp > span {
    width: 48%;
    display: block;
}
.switch {
    position: relative;
    display: inline-block;
    width: 39px;
    height: 23px;
}

.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(120, 120, 128, 0.16);
    -webkit-transition: 0.4s;
    transition: 0.4s;
}

.slider:before {
    position: absolute;
    content: "";
    height: 17px;
    width: 18px;
    left: 4px;
    bottom: 3px;
    background-color: white;
    -webkit-transition: 0.4s;
    transition: 0.4s;
}

/* input:checked + .slider {
    background-color: #34c759;
}

input:focus + .slider {
    box-shadow: 0 0 1px #34c759;
}

input:checked + .slider:before {
    -webkit-transform: translateX(14px);
    -ms-transform: translateX(14px);
    transform: translateX(14px);
} */
.slider.checked {
    background-color: #34c759;
}

/* input:focus + .slider {
    box-shadow: 0 0 1px #34c759;
} */

.slider.checked:before {
    -webkit-transform: translateX(14px);
    -ms-transform: translateX(14px);
    transform: translateX(14px);
}
/* Rounded sliders */
.slider.round {
    border-radius: 34px;
}

.slider.round:before {
    border-radius: 50%;
}
.slider:after {
    content: none !important;
}
.dress-code-cont {
    display: flex;
    justify-content: space-between;
}
.dress-code-cont > div {
    width: 48%;
}
.dress-code-toggle-cont {
    display: flex;
    align-items: center;
}
.dress-code-toggle-cont > span {
    font-family: "Poppins", sans-serif;
    font-style: normal;
    font-weight: 700;
    font-size: 11.29px;
    line-height: 17px;
    margin-left: 10px;
    margin-right: 10px;
    color: #000000;
}
.upload-btn-cont > input {
    display: none;
}
.upload-btn-cont > button {
    outline: none;
    border: none;
    background: #f2f1f1;
    border-radius: 7px;
    padding: 8px 10px;
    font-family: "Poppins", sans-serif;
    font-style: normal;
    font-weight: 400;
    font-size: 11.29px;
    line-height: 17px;
    color: #828282;
}
.upload-btn-cont > button > img {
    margin-right: 10px;
}
.cere-view-cont {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    grid-template-rows: max-content;
    grid-column-gap: 10px;
    grid-row-gap: 20px;
    /* align-items: flex-start; */
}
.cere-view-single {
    background: #ffffff;
    border: 0.5px solid #9c9797;
    border-radius: 7px;
    padding: 10px;
}
.cere-single-image-cont {
    position: relative;
    padding-top: 80%;
}
.cere-single-image-cont > img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.cere-single-image-cont > div {
    position: absolute;
    top: 15px;
    right: 15px;
    z-index: 99999;
}
.cere-view-info {
    margin-top: 15px;
}
.cere-view-info > h3 {
    font-family: "Perpetua";
    font-style: normal;
    font-weight: 700;
    font-size: 18px;
    line-height: 21px;
    margin-bottom: 10px;
    color: #461952;
}
.cere-view-info-time {
    display: flex;
    align-items: baseline;
}
.cere-view-info-time > div:nth-child(1) {
    margin-right: 10px;
}
.cere-view-info-time > div:nth-child(2) {
    font-family: "Poppins", sans-serif;
    font-style: normal;
    font-weight: 300;
    font-size: 10.2px;
    line-height: 15px;

    color: #31373a;
}
.cere-view-dress-cont {
    margin-top: 13px;
}
.cere-view-dress-cont > h3 {
    font-family: "Poppins", sans-serif;
    font-style: normal;
    font-weight: 400;
    font-size: 11.29px;
    line-height: 17px;
    margin-bottom: 10px;
    color: #461952;
}
.cere-view-dress-cont > div {
    font-family: "Poppins", sans-serif;
    font-style: normal;
    font-weight: 300;
    font-size: 11.29px;
    line-height: 17px;
    color: #461952;
    margin-bottom: 5px;
}
.disp-image-feild {
    background: rgba(239, 220, 226, 0.6);
    border: 0.643349px solid #f7dae4;
    border-radius: 7.72019px;
    margin-bottom: 12px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 6px 0;
}
.disp-image-feild > button {
    width: max-content;
    padding: 4px 10px;
    margin-right: 10px;
}
.disp-image-feild > span {
    font-family: "Poppins", sans-serif;
    font-style: normal;
    font-weight: 400;
    font-size: 12px;
    line-height: 8px;
    /* identical to box height, or 64% */
    margin-left: 10px;
    color: #000000;
}
.dress-img {
    width: 55px;
    height: 41px;
    object-fit: cover;
}
.mobile-list-cont {
    font-family: "Poppins", sans-serif;
    font-style: normal;
    font-weight: 400;
    font-size: 10.4px;
    line-height: 16px;
    text-transform: capitalize;
    color: #000000;
    min-width: 160px;
    width: max-content;
    position: relative;
    margin: 10px auto;
}
.mobile-list-head {
    background: #ffe9ee;
    border: 1px solid #c4456f;
    border-radius: 5px;
    color: #c4456f;
    padding: 9px 15px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.mobile-list-single {
    border-bottom: 0.3px solid #cdcdcd;
    padding: 9px 15px;
}
.mobile-list-content-cont {
    position: absolute;
    z-index: 99999;
    background-color: white;
    min-width: 160px;

    width: max-content;
}
.add-venue-link {
    color: #0a7aff;
    font-size: 14px;
    margin-top: 5px;
    cursor: pointer;
    text-decoration: underline;
}

.add-venue-link:hover {
    color: #0056b3;
}
@media screen and (max-width: 1200px) {
    .wed-cere-title-cont {
        width: 97%;
    }
}
@media screen and (max-width: 992px) {
    .wed-cere-head {
        flex-wrap: wrap;
    }
    .wed-cere-head > h1 {
        width: 100%;
    }
    .wed-cere-head > button {
        position: unset;
    }
}
@media screen and (max-width: 768px) {
    .wed-cere-content {
        width: 90%;
    }
    .cere-view-cont {
        overflow-x: scroll;
        display: flex;
        width: 100%;
        padding: 10px;
    }
    .cere-view-single {
        min-width: 230px;
        margin-right: 15px;
        grid-column-gap: 0;
    }
}
</style>






