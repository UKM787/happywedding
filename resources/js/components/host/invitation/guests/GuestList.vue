<template>
    <div class="wed-host-section container mx-auto">
        <div class="wed-host-section-container position-relative">
            <div
                v-if="
                    showSendInvitation == false &&
                    showUploadForm == false &&
                    addSingleGuest == false
                "
            >
                <div class="host-guest-head">
                    <div class="guest-head-add-btns">
                        <a @click="setUploadForm"
                            ><img src="/assets/user-plus-multi.svg" alt=""
                        /></a>
                        <a @click="addSingleGuest = true"
                            ><img src="/assets/user-plus.svg" alt=""
                        /></a>
                    </div>
                    <div class="guest-head-details">
                        <h3>Guest Details</h3>
                        <h3 v-if="invitation.side == 'bride'">{{invitation.brideName}} Weds {{invitation.groomName}}</h3>
                        <h3 v-if="invitation.side == 'groom'">{{invitation.groomName}} Weds {{invitation.brideName}}</h3>
                    </div>
                    <div
                        :class="{
                            hide: selectGuestClick,
                        }"
                        class="guest-select-sort"
                    >
                        <button
                            @click="
                                selectGuestClick = true;
                                selectedGuests = [];
                            "
                            type="button"
                        >
                            Send Invitations
                        </button>
                        <a 
                            :href=" route('exportWatsapp', invitation)"
                            type="button"
                        >
                                Export Invitations
                        </a>
                         <span style="position: relative">
                            <button @click="showSort = !showSort" type="button">
                                <img src="/assets/filter.svg" alt="" />
                                Sort by
                            </button>
                            <div v-if="showSort" class="sort-cont">
                                <div class="btn-container">
                                    <button
                                        type="button"
                                        class="tab-btn sort-btns active"
                                        data-id="sort-location"
                                        title="Location"
                                        @click="toggleForm($event, true)"
                                    >
                                        Location
                                    </button>
                                    <button
                                        type="button"
                                        class="tab-btn sort-btns"
                                        data-id="sort-relation"
                                        title="Relation"
                                        @click="toggleForm($event, true)"
                                    >
                                        Relation
                                    </button>
                                </div>
                                <div class="about-content">
                                    <div class="content active sort-location">
                                        <label for="all-location">
                                            <input
                                                type="radio"
                                                name="location-sort"
                                                id="all-location"
                                            />
                                            All
                                        </label>
                                        <input
                                            type="text"
                                            name=""
                                            id=""
                                            placeholder="Search location"
                                            class="sort-location-search"
                                        />
                                        <div
                                            style="
                                                height: 123px;
                                                overflow-y: auto;
                                                overflow-x: hidden;
                                            "
                                        >
                                            <label for="delhi">
                                                <input
                                                    type="radio"
                                                    name="location-sort"
                                                    id="delhi"
                                                />
                                                Delhi
                                            </label>
                                            <label for="punjab">
                                                <input
                                                    type="radio"
                                                    name="location-sort"
                                                    id="punjab"
                                                />
                                                Pubjab
                                            </label>
                                            <label for="chennai">
                                                <input
                                                    type="radio"
                                                    name="location-sort"
                                                    id="chennai"
                                                />
                                                Chennai
                                            </label>
                                        </div>
                                    </div>
                                    <div class="content sort-relation">
                                        <label for="all-relation">
                                            <input
                                                type="radio"
                                                name="relation-sort"
                                                id="all-relation"
                                            />
                                            All
                                        </label>
                                        <input
                                            type="text"
                                            name=""
                                            id=""
                                            placeholder="Search relation"
                                            class="sort-relation-search"
                                        />
                                        <div
                                            style="
                                                height: 123px;
                                                overflow-y: auto;
                                                overflow-x: hidden;
                                            "
                                        >
                                            <label for="bride">
                                                <input
                                                    type="radio"
                                                    name="relation-sort"
                                                    id="bride"
                                                />
                                                Bride
                                            </label>
                                            <label for="groom">
                                                <input
                                                    type="radio"
                                                    name="relation-sort"
                                                    id="groom"
                                                />
                                                Groom
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </span> 
                    </div>
                </div>
                <div
                    :class="[
                        mainLoader
                            ? 'blur custom-accordion'
                            : 'custom-accordion',
                    ]"
                >
                    <div
                        v-for="(item, index) in listUsers"
                        :key="index"
                        class="custom-accord-item"
                    >
                        <div
                            @click="closeAccord($event)"
                            class="custom-accord-head host-guest-accord-head"
                            :class="{
                                'select-on': selectGuestClick,
                            }"
                        >
                            <div class="d-flex" style="width: 35%">
                                <input
                                    type="checkbox"
                                    v-model="selectedGuests"
                                    :value="index"
                                    @click.stop="changeColor($event)"
                                    class="select-guest-checkbox"
                                    v-if="
                                        selectGuestClick &&
                                        item.pivot.invite == 0
                                    "
                                />
                                <div class="host-guest-acc-single-info">
                                    <span>{{ item.name ?? "" }}</span>
                                    <span>{{ item.mobile ?? "" }}</span>
                                </div>
                            </div>
                            <div class="host-guest-acc-single-btns">
                                <span v-if="item.pivot.invite == 0"
                                    >unactive</span
                                >
                                <span v-else>active</span>
                                <button
                                    @click.stop="deleteGuest(item)"
                                    :disabled="deleteGuestDisabled"
                                >
                                    <img src="/assets/trash-icon.svg" alt="" />
                                    <img
                                        style="display: none"
                                        src="/assets/trash-grey.svg"
                                        alt=""
                                    />
                                </button>
                                <span>
                                    <i
                                        class="fas fa-chevron-down drop-arrow"
                                    ></i>
                                    <!-- <i class="fas fa-chevron-up drop-arrow"></i> -->
                                </span>
                            </div>
                        </div>
                        <div
                            :class="[
                                loader
                                    ? 'blur custom-accord-content host-guest-accord-content'
                                    : 'custom-accord-content host-guest-accord-content',
                            ]"
                        >
                            <div class="btn-container">
                                <button
                                    type="button"
                                    class="tab-btn active"
                                    data-id="personal-profile"
                                    title="Personal Profile"
                                    @click="toggleForm($event, true)"
                                >
                                    Profile
                                </button>
                                <button
                                    type="button"
                                    class="tab-btn"
                                    data-id="home-address"
                                    title="Home Address"
                                    @click="toggleForm($event, true)"
                                >
                                    Home Address
                                </button>
                                <button
                                    type="button"
                                    class="tab-btn"
                                    data-id="office-address"
                                    title="Office Address"
                                    @click="toggleForm($event, true)"
                                >
                                    Office Address
                                </button>
                                <button
                                    type="button"
                                    class="tab-btn"
                                    data-id="family"
                                    title="Family"
                                    @click="toggleForm($event, true)"
                                >
                                    Family
                                </button>
                                <button
                                    type="button"
                                    class="tab-btn"
                                    data-id="ceremony"
                                    title="Ceremony"
                                    @click="
                                        toggleForm($event, true);
                                        checkUser($event, item.id);
                                    "
                                >
                                    Ceremony
                                </button>
                            </div>
                            <div class="about-content">
                                <ValidationObserver
                                    class="content active personal-profile"
                                    v-slot="{ handleSubmit, invalid }"
                                >
                                    <form
                                        @submit.prevent="
                                            handleSubmit(
                                                submitProfile(invalid, item.id)
                                            )
                                        "
                                    >
                                        <div class="guest-details-form-fields">
                                            <ValidationProvider
                                                rules="required|min:3|max:20|alpha_spaces"
                                                v-slot="{ errors }"
                                            >
                                                <div
                                                    class="form-group"
                                                    :class="{
                                                        'form-group--error':
                                                            errors.length > 0,
                                                    }"
                                                >
                                                    <label for="name">
                                                        Name

                                                        <input
                                                            type="text"
                                                            name="Name"
                                                            id="Name"
                                                            placeholder="Enter your name"
                                                            v-model.trim="
                                                                item.profile
                                                                    .name
                                                            "
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
                                                            >{{
                                                                errorsSubmit
                                                                    .name[0]
                                                            }}</span
                                                        >
                                                    </label>
                                                </div>
                                            </ValidationProvider>
                                            <ValidationProvider
                                                rules="min:3|max:20|alpha_spaces"
                                                v-slot="{ errors }"
                                            >
                                                <div
                                                    class="form-group"
                                                    :class="{
                                                        'form-group--error':
                                                            errors.length > 0,
                                                    }"
                                                >
                                                    <label for="fatherName">
                                                        Father Name
                                                        <input
                                                            type="text"
                                                            name="fatherName"
                                                            id="fatherName"
                                                            placeholder="Enter your father name"
                                                            v-model.trim="
                                                                item.profile
                                                                    .fatherName
                                                            "
                                                        />
                                                        <span class="errMsg">{{
                                                            errors[0]
                                                        }}</span>
                                                        <span
                                                            v-if="
                                                                errorsSubmit &&
                                                                errorsSubmit.fatherName
                                                            "
                                                            class="errMsg"
                                                            >{{
                                                                errorsSubmit
                                                                    .fatherName[0]
                                                            }}</span
                                                        >
                                                    </label>
                                                </div>
                                            </ValidationProvider>
                                            <ValidationProvider
                                                rules="min:3|max:20|alpha_spaces"
                                                v-slot="{ errors }"
                                            >
                                                <div
                                                    class="form-group"
                                                    :class="{
                                                        'form-group--error':
                                                            errors.length > 0,
                                                    }"
                                                >
                                                    <label for="surname">
                                                        Surname
                                                        <input
                                                            type="text"
                                                            name="surname"
                                                            id="surname"
                                                            placeholder="Enter your surname"
                                                            v-model.trim="
                                                                item.profile
                                                                    .surname
                                                            "
                                                        />
                                                        <span class="errMsg">{{
                                                            errors[0]
                                                        }}</span>
                                                        <span
                                                            v-if="
                                                                errorsSubmit &&
                                                                errorsSubmit.surname
                                                            "
                                                            class="errMsg"
                                                            >{{
                                                                errorsSubmit
                                                                    .surname[0]
                                                            }}</span
                                                        >
                                                    </label>
                                                </div>
                                            </ValidationProvider>
                                            <ValidationProvider
                                                rules="max:3|numeric"
                                                v-slot="{ errors }"
                                            >
                                                <div
                                                    class="form-group"
                                                    :class="{
                                                        'form-group--error':
                                                            errors.length > 0,
                                                    }"
                                                >
                                                    <label for="age">
                                                        Age
                                                        <input
                                                            type="text"
                                                            name="age"
                                                            id="age"
                                                            placeholder="Enter your age"
                                                            v-model.trim="
                                                                item.profile.age
                                                            "
                                                        />
                                                        <span class="errMsg">{{
                                                            errors[0]
                                                        }}</span>
                                                        <span
                                                            v-if="
                                                                errorsSubmit &&
                                                                errorsSubmit.age
                                                            "
                                                            class="errMsg"
                                                            >{{
                                                                errorsSubmit
                                                                    .age[0]
                                                            }}</span
                                                        >
                                                    </label>
                                                </div>
                                            </ValidationProvider>
                                            <ValidationProvider
                                                rules=""
                                                v-slot="{ errors }"
                                            >
                                                <div
                                                    class="form-group"
                                                    :class="{
                                                        'form-group--error':
                                                            errors.length > 0,
                                                    }"
                                                >
                                                    <label for="gender">
                                                        Gender
                                                        <div>
                                                            <input
                                                                type="radio"
                                                                id="male"
                                                                value="male"
                                                                v-model.trim="
                                                                    item.profile
                                                                        .gender
                                                                "
                                                            />
                                                            <label for="male"
                                                                >Male</label
                                                            >
                                                            <input
                                                                type="radio"
                                                                id="female"
                                                                value="female"
                                                                v-model.trim="
                                                                    item.profile
                                                                        .gender
                                                                "
                                                            />
                                                            <label for="female"
                                                                >Female</label
                                                            >
                                                        </div>
                                                        <span class="errMsg">{{
                                                            errors[0]
                                                        }}</span>
                                                        <span
                                                            v-if="
                                                                errorsSubmit &&
                                                                errorsSubmit.gender
                                                            "
                                                            class="errMsg"
                                                            >{{
                                                                errorsSubmit
                                                                    .gender[0]
                                                            }}</span
                                                        >
                                                    </label>
                                                </div>
                                            </ValidationProvider>
                                            <ValidationProvider
                                                rules="min:3|max:20|alpha_spaces"
                                                v-slot="{ errors }"
                                            >
                                                <div
                                                    class="form-group"
                                                    :class="{
                                                        'form-group--error':
                                                            errors.length > 0,
                                                    }"
                                                >
                                                    <label for="relation">
                                                        Relation
                                                        <input
                                                            type="text"
                                                            name="relation"
                                                            id="relation"
                                                            placeholder="Enter your relation"
                                                            v-model.trim="
                                                                item.profile
                                                                    .relation
                                                            "
                                                        />
                                                        <span class="errMsg">{{
                                                            errors[0]
                                                        }}</span>
                                                        <span
                                                            v-if="
                                                                errorsSubmit &&
                                                                errorsSubmit.relation
                                                            "
                                                            class="errMsg"
                                                            >{{
                                                                errorsSubmit
                                                                    .relation[0]
                                                            }}</span
                                                        >
                                                    </label>
                                                </div>
                                            </ValidationProvider>
                                            <ValidationProvider
                                                rules="required|email"
                                                v-slot="{ errors }"
                                            >
                                                <div
                                                    class="form-group"
                                                    :class="{
                                                        'form-group--error':
                                                            errors.length > 0,
                                                    }"
                                                >
                                                    <label for="email">
                                                        Email
                                                        <input
                                                            type="email"
                                                            name="email"
                                                            id="email"
                                                            placeholder="Enter your email"
                                                            v-model.trim="
                                                                item.profile
                                                                    .email
                                                            "
                                                        />
                                                        <span class="errMsg">{{
                                                            errors[0]
                                                        }}</span>
                                                        <span
                                                            v-if="
                                                                errorsSubmit &&
                                                                errorsSubmit.email
                                                            "
                                                            class="errMsg"
                                                            >{{
                                                                errorsSubmit
                                                                    .email[0]
                                                            }}</span
                                                        >
                                                    </label>
                                                </div>
                                            </ValidationProvider>
                                            <ValidationProvider
                                                rules="digits:10|numeric"
                                                v-slot="{ errors }"
                                            >
                                                <div
                                                    class="form-group"
                                                    :class="{
                                                        'form-group--error':
                                                            errors.length > 0,
                                                    }"
                                                >
                                                    <label for="phone">
                                                        Phone
                                                        <input
                                                            type="text"
                                                            name="phone"
                                                            id="phone"
                                                            placeholder="Enter your phone"
                                                            v-model.trim="
                                                                item.profile
                                                                    .phone
                                                            "
                                                        />
                                                        <span class="errMsg">{{
                                                            errors[0]
                                                        }}</span>
                                                        <span
                                                            v-if="
                                                                errorsSubmit &&
                                                                errorsSubmit.phone
                                                            "
                                                            class="errMsg"
                                                            >{{
                                                                errorsSubmit
                                                                    .phone[0]
                                                            }}</span
                                                        >
                                                    </label>
                                                </div>
                                            </ValidationProvider>
                                            <ValidationProvider
                                                rules="required|digits:10|numeric"
                                                v-slot="{ errors }"
                                            >
                                                <div
                                                    class="form-group"
                                                    :class="{
                                                        'form-group--error':
                                                            errors.length > 0,
                                                    }"
                                                >
                                                    <label for="mobile">
                                                        Primary Mobile
                                                        <input
                                                            type="number"
                                                            name="mobile"
                                                            id="mobile"
                                                            placeholder="Enter your mobile"
                                                            v-model.trim="
                                                                item.profile
                                                                    .mobile
                                                            "
                                                        />
                                                        <span class="errMsg">{{
                                                            errors[0]
                                                        }}</span>
                                                        <span
                                                            v-if="
                                                                errorsSubmit &&
                                                                errorsSubmit.mobile
                                                            "
                                                            class="errMsg"
                                                            >{{
                                                                errorsSubmit
                                                                    .mobile[0]
                                                            }}</span
                                                        >
                                                    </label>
                                                </div>
                                            </ValidationProvider>
                                            <ValidationProvider
                                                rules="digits:10|numeric"
                                                v-slot="{ errors }"
                                            >
                                                <div
                                                    class="form-group"
                                                    :class="{
                                                        'form-group--error':
                                                            errors.length > 0,
                                                    }"
                                                >
                                                    <label for="mobile1">
                                                        Alternate Mobile
                                                        <input
                                                            type="number"
                                                            name="mobile1"
                                                            id="mobile1"
                                                            placeholder="Enter your mobile1"
                                                            v-model.trim="
                                                                item.profile
                                                                    .mobile1
                                                            "
                                                        />
                                                        <span class="errMsg">{{
                                                            errors[0]
                                                        }}</span>
                                                        <span
                                                            v-if="
                                                                errorsSubmit &&
                                                                errorsSubmit.mobile1
                                                            "
                                                            class="errMsg"
                                                            >{{
                                                                errorsSubmit
                                                                    .mobile1[0]
                                                            }}</span
                                                        >
                                                    </label>
                                                </div>
                                            </ValidationProvider>
                                            <ValidationProvider
                                                rules="digits:10|numeric"
                                                v-slot="{ errors }"
                                            >
                                                <div
                                                    class="form-group"
                                                    :class="{
                                                        'form-group--error':
                                                            errors.length > 0,
                                                    }"
                                                >
                                                    <label for="whatsup">
                                                        Whatsapp
                                                        <input
                                                            type="number"
                                                            name="whatsup"
                                                            id="whatsup"
                                                            placeholder="Enter your whatsapp"
                                                            v-model.trim="
                                                                item.profile
                                                                    .whatsup
                                                            "
                                                        />
                                                        <span class="errMsg">{{
                                                            errors[0]
                                                        }}</span>
                                                        <span
                                                            v-if="
                                                                errorsSubmit &&
                                                                errorsSubmit.whatsup
                                                            "
                                                            class="errMsg"
                                                            >{{
                                                                errorsSubmit
                                                                    .whatsup[0]
                                                            }}</span
                                                        >
                                                    </label>
                                                </div>
                                            </ValidationProvider>
                                        </div>

                                        <div class="ven-profile-form-submit">
                                            <button
                                                :disabled="pprofileDisabled"
                                                type="submit"
                                            >
                                                Save Changes
                                            </button>
                                        </div>
                                    </form>
                                </ValidationObserver>
                                <ValidationObserver
                                    class="content home-address"
                                    v-slot="{ handleSubmit, invalid }"
                                >
                                    <form
                                        @submit.prevent="
                                            handleSubmit(
                                                submitHome(invalid, item.id)
                                            )
                                        "
                                    >
                                        <div class="guest-details-form-fields">
                                            <ValidationProvider
                                                rules="min:3|alpha_spaces"
                                                v-slot="{ errors }"
                                            >
                                                <div
                                                    class="form-group"
                                                    :class="{
                                                        'form-group--error':
                                                            errors.length > 0,
                                                    }"
                                                >
                                                    <label
                                                        for="guestcomplexName"
                                                    >
                                                        Complex Name
                                                        <input
                                                            type="text"
                                                            name="complexName"
                                                            id="guestcomplexName"
                                                            placeholder="Enter your complex name"
                                                            v-model.trim="
                                                                item.home
                                                                    .complexName
                                                            "
                                                        />
                                                        <span class="errMsg">{{
                                                            errors[0]
                                                        }}</span>
                                                        <span
                                                            v-if="
                                                                errorsSubmit &&
                                                                errorsSubmit.complexName
                                                            "
                                                            class="errMsg"
                                                            >{{
                                                                errorsSubmit
                                                                    .complexName[0]
                                                            }}</span
                                                        >
                                                    </label>
                                                </div>
                                            </ValidationProvider>
                                            <ValidationProvider
                                                rules="min:1"
                                                v-slot="{ errors }"
                                            >
                                                <div
                                                    class="form-group"
                                                    :class="{
                                                        'form-group--error':
                                                            errors.length > 0,
                                                    }"
                                                >
                                                    <label for="guestfloor">
                                                        Floor
                                                        <input
                                                            type="text"
                                                            name="floor"
                                                            id="guestfloor"
                                                            placeholder="Enter your floor"
                                                            v-model.trim="
                                                                item.home.floor
                                                            "
                                                        />
                                                        <span class="errMsg">{{
                                                            errors[0]
                                                        }}</span>
                                                        <span
                                                            v-if="
                                                                errorsSubmit &&
                                                                errorsSubmit.floor
                                                            "
                                                            class="errMsg"
                                                            >{{
                                                                errorsSubmit
                                                                    .floor[0]
                                                            }}</span
                                                        >
                                                    </label>
                                                </div>
                                            </ValidationProvider>
                                            <ValidationProvider
                                                rules="min:1|numeric"
                                                v-slot="{ errors }"
                                            >
                                                <div
                                                    class="form-group"
                                                    :class="{
                                                        'form-group--error':
                                                            errors.length > 0,
                                                    }"
                                                >
                                                    <label for="guestdoorNo">
                                                        Door No.
                                                        <input
                                                            type="text"
                                                            name="doorNo"
                                                            id="guestdoorNo"
                                                            placeholder="Enter your doorNo"
                                                            v-model.trim="
                                                                item.home.doorNo
                                                            "
                                                        />
                                                        <span class="errMsg">{{
                                                            errors[0]
                                                        }}</span>
                                                        <span
                                                            v-if="
                                                                errorsSubmit &&
                                                                errorsSubmit.doorNo
                                                            "
                                                            class="errMsg"
                                                            >{{
                                                                errorsSubmit
                                                                    .doorNo[0]
                                                            }}</span
                                                        >
                                                    </label>
                                                </div>
                                            </ValidationProvider>
                                            <ValidationProvider
                                                rules="min:1"
                                                v-slot="{ errors }"
                                            >
                                                <div
                                                    class="form-group"
                                                    :class="{
                                                        'form-group--error':
                                                            errors.length > 0,
                                                    }"
                                                >
                                                    <label for="gueststreetNo">
                                                        Street Name/No.
                                                        <input
                                                            type="text"
                                                            name="streetNo"
                                                            id="gueststreetNo"
                                                            placeholder="Enter your streetNo"
                                                            v-model.trim="
                                                                item.home
                                                                    .streetNo
                                                            "
                                                        />
                                                        <span class="errMsg">{{
                                                            errors[0]
                                                        }}</span>
                                                        <span
                                                            v-if="
                                                                errorsSubmit &&
                                                                errorsSubmit.streetNo
                                                            "
                                                            class="errMsg"
                                                            >{{
                                                                errorsSubmit
                                                                    .streetNo[0]
                                                            }}</span
                                                        >
                                                    </label>
                                                </div>
                                            </ValidationProvider>
                                            <ValidationProvider
                                                rules="min:3|alpha_spaces"
                                                v-slot="{ errors }"
                                            >
                                                <div
                                                    class="form-group"
                                                    :class="{
                                                        'form-group--error':
                                                            errors.length > 0,
                                                    }"
                                                >
                                                    <label for="guestarea">
                                                        Area
                                                        <input
                                                            type="text"
                                                            name="area"
                                                            id="guestarea"
                                                            placeholder="Enter your area"
                                                            v-model.trim="
                                                                item.home.area
                                                            "
                                                        />
                                                        <span class="errMsg">{{
                                                            errors[0]
                                                        }}</span>
                                                        <span
                                                            v-if="
                                                                errorsSubmit &&
                                                                errorsSubmit.area
                                                            "
                                                            class="errMsg"
                                                            >{{
                                                                errorsSubmit
                                                                    .area[0]
                                                            }}</span
                                                        >
                                                    </label>
                                                </div>
                                            </ValidationProvider>
                                            <ValidationProvider
                                                rules="alpha_spaces"
                                                v-slot="{ errors }"
                                            >
                                                <div
                                                    class="form-group"
                                                    :class="{
                                                        'form-group--error':
                                                            errors.length > 0,
                                                    }"
                                                >
                                                    <label for="guestdistrict">
                                                        District
                                                        <input
                                                            type="text"
                                                            name="district"
                                                            id="guestdistrict"
                                                            placeholder="Enter your district"
                                                            v-model.trim="
                                                                item.home
                                                                    .district
                                                            "
                                                        />
                                                        <span class="errMsg">{{
                                                            errors[0]
                                                        }}</span>
                                                        <span
                                                            v-if="
                                                                errorsSubmit &&
                                                                errorsSubmit.district
                                                            "
                                                            class="errMsg"
                                                            >{{
                                                                errorsSubmit
                                                                    .district[0]
                                                            }}</span
                                                        >
                                                    </label>
                                                </div>
                                            </ValidationProvider>
                                            <ValidationProvider
                                                rules="max:7|numeric"
                                                v-slot="{ errors }"
                                            >
                                                <div
                                                    class="form-group"
                                                    :class="{
                                                        'form-group--error':
                                                            errors.length > 0,
                                                    }"
                                                >
                                                    <label for="guestpin">
                                                        Pin
                                                        <input
                                                            type="text"
                                                            name="pin"
                                                            id="guestpin"
                                                            placeholder="Enter your pin"
                                                            v-model.trim="
                                                                item.home.pin
                                                            "
                                                        />
                                                        <span class="errMsg">{{
                                                            errors[0]
                                                        }}</span>
                                                        <span
                                                            v-if="
                                                                errorsSubmit &&
                                                                errorsSubmit.pin
                                                            "
                                                            class="errMsg"
                                                            >{{
                                                                errorsSubmit
                                                                    .pin[0]
                                                            }}</span
                                                        >
                                                    </label>
                                                </div>
                                            </ValidationProvider>
                                            <ValidationProvider
                                                rules="alpha_spaces"
                                                v-slot="{ errors }"
                                            >
                                                <div
                                                    class="form-group"
                                                    :class="{
                                                        'form-group--error':
                                                            errors.length > 0,
                                                    }"
                                                >
                                                    <label for="gueststate">
                                                        State
                                                        <input
                                                            type="text"
                                                            name="state"
                                                            id="gueststate"
                                                            placeholder="Enter your state"
                                                            v-model.trim="
                                                                item.home.state
                                                            "
                                                        />
                                                        <span class="errMsg">{{
                                                            errors[0]
                                                        }}</span>
                                                        <span
                                                            v-if="
                                                                errorsSubmit &&
                                                                errorsSubmit.state
                                                            "
                                                            class="errMsg"
                                                            >{{
                                                                errorsSubmit
                                                                    .state[0]
                                                            }}</span
                                                        >
                                                    </label>
                                                </div>
                                            </ValidationProvider>
                                            <ValidationProvider
                                                rules="min:3|alpha_spaces"
                                                v-slot="{ errors }"
                                            >
                                                <div
                                                    class="form-group"
                                                    :class="{
                                                        'form-group--error':
                                                            errors.length > 0,
                                                    }"
                                                >
                                                    <label for="guestzone">
                                                        Zone
                                                        <input
                                                            type="text"
                                                            name="zone"
                                                            id="guestzone"
                                                            placeholder="Enter your zone"
                                                            v-model.trim="
                                                                item.home.zone
                                                            "
                                                        />
                                                        <span class="errMsg">{{
                                                            errors[0]
                                                        }}</span>
                                                        <span
                                                            v-if="
                                                                errorsSubmit &&
                                                                errorsSubmit.zone
                                                            "
                                                            class="errMsg"
                                                            >{{
                                                                errorsSubmit
                                                                    .zone[0]
                                                            }}</span
                                                        >
                                                    </label>
                                                </div>
                                            </ValidationProvider>
                                            <ValidationProvider
                                                rules="min:3|alpha_spaces"
                                                v-slot="{ errors }"
                                            >
                                                <div
                                                    class="form-group"
                                                    :class="{
                                                        'form-group--error':
                                                            errors.length > 0,
                                                    }"
                                                >
                                                    <label for="guestcountry">
                                                        Country
                                                        <input
                                                            type="text"
                                                            name="country"
                                                            id="guestcountry"
                                                            placeholder="Enter your country"
                                                            v-model.trim="
                                                                item.home
                                                                    .country
                                                            "
                                                        />
                                                        <span class="errMsg">{{
                                                            errors[0]
                                                        }}</span>
                                                        <span
                                                            v-if="
                                                                errorsSubmit &&
                                                                errorsSubmit.country
                                                            "
                                                            class="errMsg"
                                                            >{{
                                                                errorsSubmit
                                                                    .country[0]
                                                            }}</span
                                                        >
                                                    </label>
                                                </div>
                                            </ValidationProvider>
                                            <ValidationProvider
                                                rules=""
                                                v-slot="{ errors }"
                                            >
                                                <div
                                                    class="form-group"
                                                    :class="{
                                                        'form-group--error':
                                                            errors.length > 0,
                                                    }"
                                                >
                                                    <label for="guestreachus">
                                                        Map Location
                                                        <input
                                                            type="text"
                                                            name="reachus"
                                                            id="guestreachus"
                                                            placeholder="Enter your map location"
                                                            v-model.trim="
                                                                item.home
                                                                    .reachus
                                                            "
                                                        />
                                                        <span
                                                            v-if="
                                                                errorsSubmit &&
                                                                errorsSubmit.reachus
                                                            "
                                                            class="errMsg"
                                                            >{{
                                                                errorsSubmit
                                                                    .reachus[0]
                                                            }}</span
                                                        >
                                                        <span class="errMsg">{{
                                                            errors[0]
                                                        }}</span>
                                                    </label>
                                                </div>
                                            </ValidationProvider>
                                        </div>

                                        <div class="ven-profile-form-submit">
                                            <button
                                                :disabled="hprofileDisabled"
                                                type="submit"
                                            >
                                                Save Changes
                                            </button>
                                        </div>
                                    </form>
                                </ValidationObserver>
                                <ValidationObserver
                                    class="content office-address"
                                    v-slot="{ handleSubmit, invalid }"
                                >
                                    <form
                                        @submit.prevent="
                                            handleSubmit(
                                                submitOffice(invalid, item.id)
                                            )
                                        "
                                    >
                                        <div class="guest-details-form-fields">
                                            <ValidationProvider
                                                rules="min:3|alpha_spaces"
                                                v-slot="{ errors }"
                                            >
                                                <div
                                                    class="form-group"
                                                    :class="{
                                                        'form-group--error':
                                                            errors.length > 0,
                                                    }"
                                                >
                                                    <label
                                                        for="guestofficecompanyName"
                                                    >
                                                        Company Name
                                                        <input
                                                            type="text"
                                                            name="officecompanyName"
                                                            id="guestofficecompanyName"
                                                            placeholder="Enter your company name"
                                                            v-model.trim="
                                                                item.office
                                                                    .officecompanyName
                                                            "
                                                        />
                                                        <span class="errMsg">{{
                                                            errors[0]
                                                        }}</span>
                                                        <span
                                                            v-if="
                                                                errorsSubmit &&
                                                                errorsSubmit.officecompanyName
                                                            "
                                                            class="errMsg"
                                                            >{{
                                                                errorsSubmit
                                                                    .officecompanyName[0]
                                                            }}</span
                                                        >
                                                    </label>
                                                </div>
                                            </ValidationProvider>
                                            <ValidationProvider
                                                rules="min:3|alpha_spaces"
                                                v-slot="{ errors }"
                                            >
                                                <div
                                                    class="form-group"
                                                    :class="{
                                                        'form-group--error':
                                                            errors.length > 0,
                                                    }"
                                                >
                                                    <label
                                                        for="guestofficecomplexName"
                                                    >
                                                        Complex Name
                                                        <input
                                                            type="text"
                                                            name="officecomplexName"
                                                            id="guestofficecomplexName"
                                                            placeholder="Enter your company complex name"
                                                            v-model.trim="
                                                                item.office
                                                                    .officecomplexName
                                                            "
                                                        />
                                                        <span class="errMsg">{{
                                                            errors[0]
                                                        }}</span>
                                                        <span
                                                            v-if="
                                                                errorsSubmit &&
                                                                errorsSubmit.officecomplexName
                                                            "
                                                            class="errMsg"
                                                            >{{
                                                                errorsSubmit
                                                                    .officecomplexName[0]
                                                            }}</span
                                                        >
                                                    </label>
                                                </div>
                                            </ValidationProvider>
                                            <ValidationProvider
                                                rules="min:1"
                                                v-slot="{ errors }"
                                            >
                                                <div
                                                    class="form-group"
                                                    :class="{
                                                        'form-group--error':
                                                            errors.length > 0,
                                                    }"
                                                >
                                                    <label
                                                        for="guestofficefloor"
                                                    >
                                                        Floor
                                                        <input
                                                            type="text"
                                                            name="officefloor"
                                                            id="guestofficefloor"
                                                            placeholder="Enter your company floor"
                                                            v-model.trim="
                                                                item.office
                                                                    .officefloor
                                                            "
                                                        />
                                                        <span class="errMsg">{{
                                                            errors[0]
                                                        }}</span>
                                                        <span
                                                            v-if="
                                                                errorsSubmit &&
                                                                errorsSubmit.officefloor
                                                            "
                                                            class="errMsg"
                                                            >{{
                                                                errorsSubmit
                                                                    .officefloor[0]
                                                            }}</span
                                                        >
                                                    </label>
                                                </div>
                                            </ValidationProvider>
                                            <ValidationProvider
                                                rules="min:1|numeric"
                                                v-slot="{ errors }"
                                            >
                                                <div
                                                    class="form-group"
                                                    :class="{
                                                        'form-group--error':
                                                            errors.length > 0,
                                                    }"
                                                >
                                                    <label
                                                        for="guestofficedoorNo"
                                                    >
                                                        Door No
                                                        <input
                                                            type="text"
                                                            name="officedoorNo"
                                                            id="guestofficedoorNo"
                                                            placeholder="Enter your company door no"
                                                            v-model.trim="
                                                                item.office
                                                                    .officedoorNo
                                                            "
                                                        />
                                                        <span class="errMsg">{{
                                                            errors[0]
                                                        }}</span>
                                                        <span
                                                            v-if="
                                                                errorsSubmit &&
                                                                errorsSubmit.officedoorNo
                                                            "
                                                            class="errMsg"
                                                            >{{
                                                                errorsSubmit
                                                                    .officedoorNo[0]
                                                            }}</span
                                                        >
                                                    </label>
                                                </div>
                                            </ValidationProvider>
                                            <ValidationProvider
                                                rules="min:1"
                                                v-slot="{ errors }"
                                            >
                                                <div
                                                    class="form-group"
                                                    :class="{
                                                        'form-group--error':
                                                            errors.length > 0,
                                                    }"
                                                >
                                                    <label
                                                        for="guestofficestreetNo"
                                                    >
                                                        Street Name/No
                                                        <input
                                                            type="text"
                                                            name="officestreetNo"
                                                            id="guestofficestreetNo"
                                                            placeholder="Enter your company street no"
                                                            v-model.trim="
                                                                item.office
                                                                    .officestreetNo
                                                            "
                                                        />
                                                        <span class="errMsg">{{
                                                            errors[0]
                                                        }}</span>
                                                        <span
                                                            v-if="
                                                                errorsSubmit &&
                                                                errorsSubmit.officestreetNo
                                                            "
                                                            class="errMsg"
                                                            >{{
                                                                errorsSubmit
                                                                    .officestreetNo[0]
                                                            }}</span
                                                        >
                                                    </label>
                                                </div>
                                            </ValidationProvider>
                                            <ValidationProvider
                                                rules="min:3|alpha_spaces"
                                                v-slot="{ errors }"
                                            >
                                                <div
                                                    class="form-group"
                                                    :class="{
                                                        'form-group--error':
                                                            errors.length > 0,
                                                    }"
                                                >
                                                    <label
                                                        for="guestofficearea"
                                                    >
                                                        Area
                                                        <input
                                                            type="text"
                                                            name="officearea"
                                                            id="guestoofficearea"
                                                            placeholder="Enter your company area"
                                                            v-model.trim="
                                                                item.office
                                                                    .officearea
                                                            "
                                                        />
                                                        <span class="errMsg">{{
                                                            errors[0]
                                                        }}</span>
                                                        <span
                                                            v-if="
                                                                errorsSubmit &&
                                                                errorsSubmit.officearea
                                                            "
                                                            class="errMsg"
                                                            >{{
                                                                errorsSubmit
                                                                    .officearea[0]
                                                            }}</span
                                                        >
                                                    </label>
                                                </div>
                                            </ValidationProvider>
                                            <ValidationProvider
                                                rules="alpha_spaces"
                                                v-slot="{ errors }"
                                            >
                                                <div
                                                    class="form-group"
                                                    :class="{
                                                        'form-group--error':
                                                            errors.length > 0,
                                                    }"
                                                >
                                                    <label
                                                        for="guestofficedistrict"
                                                    >
                                                        District
                                                        <input
                                                            type="text"
                                                            name="officedistrict"
                                                            id="guestofficedistrict"
                                                            placeholder="Enter your company district"
                                                            v-model.trim="
                                                                item.office
                                                                    .officedistrict
                                                            "
                                                        />
                                                        <span class="errMsg">{{
                                                            errors[0]
                                                        }}</span>
                                                        <span
                                                            v-if="
                                                                errorsSubmit &&
                                                                errorsSubmit.officedistrict
                                                            "
                                                            class="errMsg"
                                                            >{{
                                                                errorsSubmit
                                                                    .officedistrict[0]
                                                            }}</span
                                                        >
                                                    </label>
                                                </div>
                                            </ValidationProvider>
                                            <ValidationProvider
                                                rules="max:7|numeric"
                                                v-slot="{ errors }"
                                            >
                                                <div
                                                    class="form-group"
                                                    :class="{
                                                        'form-group--error':
                                                            errors.length > 0,
                                                    }"
                                                >
                                                    <label
                                                        for="guestofficepint"
                                                    >
                                                        Pin
                                                        <input
                                                            type="text"
                                                            name="officepin"
                                                            id="guestofficepin"
                                                            placeholder="Enter your company pin"
                                                            v-model.trim="
                                                                item.office
                                                                    .officepin
                                                            "
                                                        />
                                                        <span class="errMsg">{{
                                                            errors[0]
                                                        }}</span>
                                                        <span
                                                            v-if="
                                                                errorsSubmit &&
                                                                errorsSubmit.officepin
                                                            "
                                                            class="errMsg"
                                                            >{{
                                                                errorsSubmit
                                                                    .officepin[0]
                                                            }}</span
                                                        >
                                                    </label>
                                                </div>
                                            </ValidationProvider>
                                            <ValidationProvider
                                                rules="alpha_spaces"
                                                v-slot="{ errors }"
                                            >
                                                <div
                                                    class="form-group"
                                                    :class="{
                                                        'form-group--error':
                                                            errors.length > 0,
                                                    }"
                                                >
                                                    <label
                                                        for="guestofficestate"
                                                    >
                                                        State
                                                        <input
                                                            type="text"
                                                            name="officestate"
                                                            id="guestofficestate"
                                                            placeholder="Enter your company state"
                                                            v-model.trim="
                                                                item.office
                                                                    .officestate
                                                            "
                                                        />
                                                        <span class="errMsg">{{
                                                            errors[0]
                                                        }}</span>
                                                        <span
                                                            v-if="
                                                                errorsSubmit &&
                                                                errorsSubmit.officestate
                                                            "
                                                            class="errMsg"
                                                            >{{
                                                                errorsSubmit
                                                                    .officestate[0]
                                                            }}</span
                                                        >
                                                    </label>
                                                </div>
                                            </ValidationProvider>
                                            <ValidationProvider
                                                rules="min:3|alpha_spaces"
                                                v-slot="{ errors }"
                                            >
                                                <div
                                                    class="form-group"
                                                    :class="{
                                                        'form-group--error':
                                                            errors.length > 0,
                                                    }"
                                                >
                                                    <label
                                                        for="guestofficezone"
                                                    >
                                                        Zone
                                                        <input
                                                            type="text"
                                                            name="officezone"
                                                            id="guestofficezone"
                                                            placeholder="Enter your company zone"
                                                            v-model.trim="
                                                                item.office
                                                                    .officezone
                                                            "
                                                        />
                                                        <span class="errMsg">{{
                                                            errors[0]
                                                        }}</span>
                                                        <span
                                                            v-if="
                                                                errorsSubmit &&
                                                                errorsSubmit.officezone
                                                            "
                                                            class="errMsg"
                                                            >{{
                                                                errorsSubmit
                                                                    .officezone[0]
                                                            }}</span
                                                        >
                                                    </label>
                                                </div>
                                            </ValidationProvider>
                                            <ValidationProvider
                                                rules="min:3|alpha_spaces"
                                                v-slot="{ errors }"
                                            >
                                                <div
                                                    class="form-group"
                                                    :class="{
                                                        'form-group--error':
                                                            errors.length > 0,
                                                    }"
                                                >
                                                    <label
                                                        for="guestofficecountry"
                                                    >
                                                        Country
                                                        <input
                                                            type="text"
                                                            name="officecountry"
                                                            id="guestofficecountry"
                                                            placeholder="Enter your company country"
                                                            v-model.trim="
                                                                item.office
                                                                    .officecountry
                                                            "
                                                        />
                                                        <span class="errMsg">{{
                                                            errors[0]
                                                        }}</span>
                                                        <span
                                                            v-if="
                                                                errorsSubmit &&
                                                                errorsSubmit.officecountry
                                                            "
                                                            class="errMsg"
                                                            >{{
                                                                errorsSubmit
                                                                    .officecountry[0]
                                                            }}</span
                                                        >
                                                    </label>
                                                </div>
                                            </ValidationProvider>
                                            <ValidationProvider
                                                rules=""
                                                v-slot="{ errors }"
                                            >
                                                <div
                                                    class="form-group"
                                                    :class="{
                                                        'form-group--error':
                                                            errors.length > 0,
                                                    }"
                                                >
                                                    <label
                                                        for="guestofficereachus"
                                                    >
                                                        Map Location
                                                        <input
                                                            type="text"
                                                            name="officereachus"
                                                            id="guestofficereachus"
                                                            placeholder="Enter your company Map location"
                                                            v-model.trim="
                                                                item.office
                                                                    .officereachus
                                                            "
                                                        />
                                                        <span class="errMsg">{{
                                                            errors[0]
                                                        }}</span>
                                                        <span
                                                            v-if="
                                                                errorsSubmit &&
                                                                errorsSubmit.officereachus
                                                            "
                                                            class="errMsg"
                                                            >{{
                                                                errorsSubmit
                                                                    .officereachus[0]
                                                            }}</span
                                                        >
                                                    </label>
                                                </div>
                                            </ValidationProvider>
                                        </div>

                                        <div class="ven-profile-form-submit">
                                            <button
                                                :disabled="oprofileDisabled"
                                                type="submit"
                                            >
                                                Save Changes
                                            </button>
                                        </div>
                                    </form>
                                </ValidationObserver>
                                <div class="content family">
                                    <div>
                                        <ValidationObserver
                                            v-if="showFamilyForm"
                                            v-slot="{ handleSubmit, invalid }"
                                        >
                                            <form
                                                @submit.prevent="
                                                    handleSubmit(
                                                        submitFamily(
                                                            invalid,
                                                            item.id
                                                        )
                                                    )
                                                "
                                                class="guest-details-family-form-cont"
                                            >
                                                <div
                                                    class="guest-details-form-fields"
                                                >
                                                    <ValidationProvider
                                                        rules="required|min:3|alpha_spaces"
                                                        v-slot="{ errors }"
                                                    >
                                                        <div
                                                            class="form-group"
                                                            :class="{
                                                                'form-group--error':
                                                                    errors.length >
                                                                    0,
                                                            }"
                                                        >
                                                            <label
                                                                for="guestfamilyname"
                                                            >
                                                                Name
                                                                <input
                                                                    type="text"
                                                                    name="guestfamilyname"
                                                                    id="guestfamilyname"
                                                                    placeholder="Enter your family member name"
                                                                    v-model.trim="
                                                                        guestFamily.familyname
                                                                    "
                                                                />
                                                                <span
                                                                    class="errMsg"
                                                                    >{{
                                                                        errors[0]
                                                                    }}</span
                                                                >
                                                                <span
                                                                    v-if="
                                                                        errorsSubmit &&
                                                                        errorsSubmit.familyname
                                                                    "
                                                                    class="errMsg"
                                                                    >{{
                                                                        errorsSubmit
                                                                            .familyname[0]
                                                                    }}</span
                                                                >
                                                            </label>
                                                        </div>
                                                    </ValidationProvider>
                                                    <ValidationProvider
                                                        rules="max:3|numeric"
                                                        v-slot="{ errors }"
                                                    >
                                                        <div
                                                            class="form-group"
                                                            :class="{
                                                                'form-group--error':
                                                                    errors.length >
                                                                    0,
                                                            }"
                                                        >
                                                            <label
                                                                for="guestfamilyage"
                                                            >
                                                                Age
                                                                <input
                                                                    type="text"
                                                                    name="guestfamilyage"
                                                                    id="guestfamilyage"
                                                                    placeholder="Enter your family member age"
                                                                    v-model.trim="
                                                                        guestFamily.familyage
                                                                    "
                                                                />
                                                                <span
                                                                    class="errMsg"
                                                                    >{{
                                                                        errors[0]
                                                                    }}</span
                                                                >
                                                                <span
                                                                    v-if="
                                                                        errorsSubmit &&
                                                                        errorsSubmit.familyage
                                                                    "
                                                                    class="errMsg"
                                                                    >{{
                                                                        errorsSubmit
                                                                            .familyage[0]
                                                                    }}</span
                                                                >
                                                            </label>
                                                        </div>
                                                    </ValidationProvider>
                                                    <ValidationProvider
                                                        rules=""
                                                        v-slot="{ errors }"
                                                    >
                                                        <div
                                                            class="form-group"
                                                            :class="{
                                                                'form-group--error':
                                                                    errors.length >
                                                                    0,
                                                            }"
                                                        >
                                                            <label
                                                                for="guestfamilygender"
                                                            >
                                                                Gender
                                                                <div>
                                                                    <input
                                                                        type="radio"
                                                                        id="male"
                                                                        value="male"
                                                                        v-model.trim="
                                                                            guestFamily.familygender
                                                                        "
                                                                    />
                                                                    <label
                                                                        for="male"
                                                                        >Male</label
                                                                    >
                                                                    <input
                                                                        type="radio"
                                                                        id="female"
                                                                        value="female"
                                                                        v-model.trim="
                                                                            guestFamily.familygender
                                                                        "
                                                                    />
                                                                    <label
                                                                        for="female"
                                                                        >Female</label
                                                                    >
                                                                </div>
                                                                <span
                                                                    class="errMsg"
                                                                    >{{
                                                                        errors[0]
                                                                    }}</span
                                                                >
                                                                <span
                                                                    v-if="
                                                                        errorsSubmit &&
                                                                        errorsSubmit.familygender
                                                                    "
                                                                    class="errMsg"
                                                                    >{{
                                                                        errorsSubmit
                                                                            .familygender[0]
                                                                    }}</span
                                                                >
                                                            </label>
                                                        </div>
                                                    </ValidationProvider>
                                                    <ValidationProvider
                                                        rules="required|min:3|alpha_spaces"
                                                        v-slot="{ errors }"
                                                    >
                                                        <div
                                                            class="form-group"
                                                            :class="{
                                                                'form-group--error':
                                                                    errors.length >
                                                                    0,
                                                            }"
                                                        >
                                                            <label
                                                                for="guestfamilyrelation"
                                                            >
                                                                Relation
                                                                <select
                                                                    v-model.trim="
                                                                        guestFamily.familyrelation
                                                                    "
                                                                    id="guestfamilyrelation"
                                                                    required
                                                                >
                                                                    <option
                                                                        disabled
                                                                        selected
                                                                        value="null"
                                                                    >
                                                                        Select
                                                                        Relation
                                                                    </option>
                                                                    <option
                                                                        v-for="(
                                                                            item,
                                                                            index
                                                                        ) in famRel"
                                                                        :key="
                                                                            index
                                                                        "
                                                                        :value="
                                                                            item
                                                                        "
                                                                    >
                                                                        {{
                                                                            item
                                                                        }}
                                                                    </option>
                                                                </select>
                                                                <span
                                                                    class="errMsg"
                                                                    >{{
                                                                        errors[0]
                                                                    }}</span
                                                                >
                                                                <span
                                                                    v-if="
                                                                        errorsSubmit &&
                                                                        errorsSubmit.familyrelation
                                                                    "
                                                                    class="errMsg"
                                                                    >{{
                                                                        errorsSubmit
                                                                            .familyrelation[0]
                                                                    }}</span
                                                                >
                                                            </label>
                                                        </div>
                                                    </ValidationProvider>
                                                    <ValidationProvider
                                                        rules="required|digits:10|numeric"
                                                        v-slot="{ errors }"
                                                    >
                                                        <div
                                                            class="form-group"
                                                            :class="{
                                                                'form-group--error':
                                                                    errors.length >
                                                                    0,
                                                            }"
                                                        >
                                                            <label
                                                                for="guestfamilymobile"
                                                            >
                                                                Mobile
                                                                <input
                                                                    type="text"
                                                                    name="guestfamilymobile"
                                                                    id="guestfamilymobile"
                                                                    placeholder="Enter your family member mobile"
                                                                    v-model.trim="
                                                                        guestFamily.familymobile
                                                                    "
                                                                />
                                                                <span
                                                                    class="errMsg"
                                                                    >{{
                                                                        errors[0]
                                                                    }}</span
                                                                >
                                                                <span
                                                                    v-if="
                                                                        errorsSubmit &&
                                                                        errorsSubmit.familymobile
                                                                    "
                                                                    class="errMsg"
                                                                    >{{
                                                                        errorsSubmit
                                                                            .familymobile[0]
                                                                    }}</span
                                                                >
                                                            </label>
                                                        </div>
                                                    </ValidationProvider>
                                                    <div
                                                        class="form-group fam-images"
                                                    >
                                                        <label
                                                            for="guestfamilyimageone"
                                                            id="fam-img"
                                                        >
                                                            Upload a picture
                                                            <span
                                                                v-if="
                                                                    familyimageOneName
                                                                "
                                                                >{{
                                                                    familyimageOneName
                                                                }}</span
                                                            >
                                                            <span v-else
                                                                >Choose
                                                                file</span
                                                            >
                                                            <input
                                                                type="file"
                                                                name="guestfamilyimageone"
                                                                id="guestfamilyimageone"
                                                                @change="
                                                                    uploadImg(
                                                                        $event,
                                                                        'familyOne'
                                                                    )
                                                                "
                                                            />
                                                            <!-- <img
                                                        style="
                                                            width: 150px;
                                                            height: 150px;
                                                            border-radius: 50%;
                                                        "
                                                        v-if="familyimageOnePreview"
                                                        :src="familyimageOnePreview"
                                                        alt=""
                                                    />
                                                    <img
                                                        v-else-if="
                                                            guestFamily.familyimageOne ==
                                                            '/guests/familyDefault.png'
                                                        "
                                                        style="
                                                            width: 150px;
                                                            height: 150px;
                                                            border-radius: 50%;
                                                        "
                                                        :src="
                                                            '/storage' +
                                                            guestFamily.familyimageOne
                                                        "
                                                        alt=""
                                                    />
                                                    <img
                                                        v-else-if="
                                                            guestFamily.familyimageOne
                                                        "
                                                        style="
                                                            width: 150px;
                                                            height: 150px;
                                                            border-radius: 50%;
                                                        "
                                                        :src="
                                                            '/assets/guests/uploads/' +
                                                            guestFamily.familyimageOne
                                                        "
                                                        alt=""
                                                    /> -->
                                                            <span
                                                                v-if="
                                                                    errorsSubmit &&
                                                                    errorsSubmit.familyimageOne
                                                                "
                                                                class="errMsg"
                                                                >{{
                                                                    errorsSubmit
                                                                        .familyimageOne[0]
                                                                }}</span
                                                            >
                                                        </label>
                                                    </div>
                                                    <div
                                                        class="form-group fam-images"
                                                    >
                                                        <label
                                                            id="fam-identity"
                                                            for="guestfamilyimagetwo"
                                                        >
                                                            Upload a picture of
                                                            identification
                                                            <span
                                                                v-if="
                                                                    familyimageTwoName
                                                                "
                                                                >{{
                                                                    familyimageTwoName
                                                                }}</span
                                                            >
                                                            <span v-else
                                                                >Choose
                                                                file</span
                                                            >
                                                            <input
                                                                type="file"
                                                                name="guestfamilyimagetwo"
                                                                id="guestfamilyimagetwo"
                                                                @change="
                                                                    uploadImg(
                                                                        $event,
                                                                        'familyTwo'
                                                                    )
                                                                "
                                                            />
                                                            <!-- <img
                                                        style="
                                                            width: 150px;
                                                            height: 150px;
                                                            border-radius: 50%;
                                                        "
                                                        v-if="familyimageTwoPreview"
                                                        :src="familyimageTwoPreview"
                                                        alt=""
                                                    />
                                                    <img
                                                        v-else-if="
                                                            guestFamily.familyimageTwo ==
                                                            '/guests/kycDefault.png'
                                                        "
                                                        style="
                                                            width: 150px;
                                                            height: 150px;
                                                            border-radius: 50%;
                                                        "
                                                        :src="
                                                            '/storage' +
                                                            guestFamily.familyimageTwo
                                                        "
                                                        alt=""
                                                    />
                                                    <img
                                                        v-else-if="
                                                            guestFamily.familyimageTwo
                                                        "
                                                        style="
                                                            width: 150px;
                                                            height: 150px;
                                                            border-radius: 50%;
                                                        "
                                                        :src="
                                                            '/assets/guests/uploads/' +
                                                            guestFamily.familyimageTwo
                                                        "
                                                        alt=""
                                                    /> -->
                                                            <span
                                                                v-if="
                                                                    errorsSubmit &&
                                                                    errorsSubmit.familyimageTwo
                                                                "
                                                                class="errMsg"
                                                                >{{
                                                                    errorsSubmit
                                                                        .familyimageTwo[0]
                                                                }}</span
                                                            >
                                                        </label>
                                                    </div>
                                                </div>
                                                <div
                                                    class="ven-profile-form-submit"
                                                >
                                                    <button
                                                        @click="
                                                            showFamilyForm = false
                                                        "
                                                        type="button"
                                                    >
                                                        Discard
                                                    </button>
                                                    <button
                                                        style="margin-left: 0"
                                                        type="submit"
                                                    >
                                                        Submit
                                                    </button>
                                                </div>
                                            </form>
                                        </ValidationObserver>
                                        <div
                                            style="padding-top: 15px"
                                            v-if="showFamilyForm == false"
                                        >
                                            <div
                                                v-for="(
                                                    ele, indexVal
                                                ) in item.family"
                                                :key="indexVal + '.' + index"
                                                class="guest-details-single-view"
                                            >
                                                <div style="width: 30%">
                                                    <span>{{
                                                        ele.familyname
                                                    }}</span>
                                                    <span>{{
                                                        ele.familyrelation
                                                    }}</span>
                                                    <span
                                                        style="
                                                            width: 30px;
                                                            flex: unset;
                                                        "
                                                        >{{
                                                            ele.familyage
                                                        }}</span
                                                    >
                                                </div>
                                                <div style="width: 20%">
                                                    <span>{{
                                                        ele.familygender
                                                    }}</span>
                                                    <span>{{
                                                        ele.familymobile
                                                    }}</span>
                                                </div>
                                                <div style="width: 30%">
                                                    <span>
                                                        <img
                                                            src="/assets/Group-2.svg"
                                                            class="thumbnails"
                                                        />
                                                        Photo</span
                                                    >
                                                    <span>
                                                        <img
                                                            src="/assets/Group-2.svg"
                                                            class="thumbnails"
                                                        />
                                                        Identification</span
                                                    >
                                                </div>
                                                <div style="width: 10%">
                                                    <span>
                                                        <img
                                                            @click="
                                                                editFamilyForm(
                                                                    $event,
                                                                    item.id,
                                                                    ele.id
                                                                )
                                                            "
                                                            style="
                                                                cursor: pointer;
                                                            "
                                                            src="/assets/edit.svg"
                                                            alt=""
                                                        />
                                                        <img
                                                            @click="
                                                                deleteFamily(
                                                                    $event,
                                                                    item.id,
                                                                    ele.id
                                                                )
                                                            "
                                                            src="/assets/trash.svg"
                                                            alt=""
                                                            style="
                                                                margin-right: 0 !important;
                                                                cursor: pointer;
                                                            "
                                                        />
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="add-family-button">
                                                <button
                                                    type="button"
                                                    @click="
                                                        editFamilyForm(
                                                            $event,
                                                            'new'
                                                        )
                                                    "
                                                >
                                                    Add new member
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="content ceremony">
                                    <form
                                        @submit.prevent="
                                            sendCeremonyInfo($event, item)
                                        "
                                        v-if="ceremonyList.length > 0"
                                    >
                                        <div
                                            class="guest-details-ceremony-fields"
                                        >
                                            <div
                                                v-for="(
                                                    single, index
                                                ) in ceremonyList"
                                                :key="index"
                                                class="ceremony-select-single"
                                            >
                                                <div>{{ single.name }}</div>
                                                <div>
                                                    <label
                                                        title="No Invite"
                                                        :for="
                                                            single.slug +
                                                            'noInvite' +
                                                            item.id
                                                        "
                                                    >
                                                        <input
                                                            type="radio"
                                                            @change="
                                                                setCeremonyVModel(
                                                                    $event,
                                                                    single.id,
                                                                    item.id
                                                                )
                                                            "
                                                            :id="
                                                                single.slug +
                                                                'noInvite' +
                                                                item.id
                                                            "
                                                            :name="
                                                                single.name +
                                                                single.id +
                                                                item.id
                                                            "
                                                            value="0"
                                                            :checked="
                                                                item.pivot
                                                                    .ceremony_invite?.[
                                                                    single['id']
                                                                ] == 0
                                                            "
                                                        />
                                                        <span
                                                            class="checkmark"
                                                        ></span>
                                                        <img
                                                            class="ceremony-img"
                                                            src="/assets/slash.svg"
                                                            alt=""
                                                        />
                                                    </label>
                                                    <label
                                                        title="Single Invite"
                                                        :for="
                                                            single.slug +
                                                            'singleInvite' +
                                                            item.id
                                                        "
                                                    >
                                                        <input
                                                            type="radio"
                                                            @change="
                                                                setCeremonyVModel(
                                                                    $event,
                                                                    single.id,
                                                                    item.id
                                                                )
                                                            "
                                                            :id="
                                                                single.slug +
                                                                'singleInvite' +
                                                                item.id
                                                            "
                                                            :name="
                                                                single.name +
                                                                single.id +
                                                                item.id
                                                            "
                                                            value="1"
                                                            :checked="
                                                                item.pivot
                                                                    .ceremony_invite?.[
                                                                    single['id']
                                                                ] == 1
                                                            "
                                                        />
                                                        <span
                                                            class="checkmark"
                                                        ></span>
                                                        <img
                                                            class="ceremony-img"
                                                            src="/assets/carbon_user.svg"
                                                            alt=""
                                                        />
                                                    </label>
                                                    <label
                                                        title="Spouse Invite"
                                                        :for="
                                                            single.slug +
                                                            'spuseeInvite' +
                                                            item.id
                                                        "
                                                    >
                                                        <input
                                                            type="radio"
                                                            @change="
                                                                setCeremonyVModel(
                                                                    $event,
                                                                    single.id,
                                                                    item.id
                                                                )
                                                            "
                                                            :id="
                                                                single.slug +
                                                                'spuseeInvite' +
                                                                item.id
                                                            "
                                                            :name="
                                                                single.name +
                                                                single.id +
                                                                item.id
                                                            "
                                                            value="2"
                                                            :checked="
                                                                item.pivot
                                                                    .ceremony_invite?.[
                                                                    single['id']
                                                                ] == 2
                                                            "
                                                        />
                                                        <span
                                                            class="checkmark"
                                                        ></span>
                                                        <img
                                                            class="ceremony-img"
                                                            src="/assets/carbon_user-multiple.svg"
                                                            alt=""
                                                        />
                                                    </label>
                                                    <label
                                                        title="Family Invite"
                                                        :for="
                                                            single.slug +
                                                            'familyInvite' +
                                                            item.id
                                                        "
                                                    >
                                                        <input
                                                            type="radio"
                                                            @change="
                                                                setCeremonyVModel(
                                                                    $event,
                                                                    single.id,
                                                                    item.id
                                                                )
                                                            "
                                                            :id="
                                                                single.slug +
                                                                'familyInvite' +
                                                                item.id
                                                            "
                                                            :name="
                                                                single.name +
                                                                single.id +
                                                                item.id
                                                            "
                                                            value="3"
                                                            :checked="
                                                                item.pivot
                                                                    .ceremony_invite?.[
                                                                    single['id']
                                                                ] == 3
                                                            "
                                                        />
                                                        <span
                                                            class="checkmark"
                                                        ></span>
                                                        <img
                                                            class="ceremony-img"
                                                            src="/assets/carbon_family.svg"
                                                            alt=""
                                                        />
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="ven-profile-form-submit"
                                            style="grid-column: span 3"
                                        >
                                            <button
                                                :disabled="sendCeremonyDisabled"
                                                type="submit"
                                            >
                                                Submit
                                            </button>
                                        </div>
                                    </form>
                                    <div v-else>
                                        <h1>No Ceremonies Exists yet</h1>
                                        <a
                                            :href="
                                                route(
                                                    'hostceremony.custom',
                                                    $invitation ?? ''
                                                )
                                            "
                                            >Add ceremonies</a
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div
                v-if="
                    showSendInvitation == true &&
                    showUploadForm == false &&
                    addSingleGuest == false
                "
            >
                <div class="guest-shortlisted-head">
                    <div class="guest-head-details">
                        <h3>{{ selectedGuests.length }} Guest Shortlisted</h3>
                        <span @click="showSendInvitation = false"
                            ><img src="/assets/user-plus.svg" alt=""
                        /></span>
                    </div>
                    <form
                        @submit.prevent="sendInvi($event)"
                        v-if="selectedGuests.length > 0"
                        class="guest-shortlisted-list"
                    >
                        <div class="guest-shortlisted-list-head">
                            <span style="width: 13%">Name</span>
                            <span style="width: 13%">Phone</span>
                            <span style="width: 30%">Invite</span>
                            <span style="width: 10%; text-align: center"
                                >Accomodation</span
                            >
                            <span style="width: 10%; text-align: center"
                                >Logistics</span
                            >
                            <span style="width: 6%; text-align: center"
                                >SMS</span
                            >
                            <span style="width: 6%; text-align: center"
                                >Mail</span
                            >
                            <!--<span style="width: 6%; text-align: center"
                                >Post</span
                            >-->
                            <span style="width: 6%; text-align: center"
                                >Whatsapp</span
                            >
                        </div>
                        <div
                            v-for="(item, index) in selectedGuests"
                            :key="index"
                            :class="[
                                loader
                                    ? 'blur guest-shortlisted-list-content'
                                    : 'guest-shortlisted-list-content',
                            ]"
                        >
                            <span style="width: 13%">{{
                                listUsers[item].name
                            }}</span>
                            <span style="width: 13%">{{
                                listUsers[item].mobile
                            }}</span>
                            <h6 class="hide-text">Invite</h6>
                            <div
                                class="guest-shortlisted-list-checkbox"
                                style="width: 30%"
                            >
                                <label
                                    title="No Invite"
                                    :for="
                                        listUsers[item].slug + 'noInvite' + item
                                    "
                                >
                                    <input
                                        :checked="
                                            listUsers[item].pivot.invite == 0
                                        "
                                        type="radio"
                                        value="0"
                                        :name="listUsers[item].slug + item"
                                        :id="
                                            listUsers[item].slug +
                                            'noInvite' +
                                            item
                                        "
                                        v-model="
                                            dataSendInvitation[index].invite
                                        "
                                    />
                                    <span class="checkmark"></span>
                                    <img
                                        class="ceremony-img"
                                        src="/assets/slash.svg"
                                        alt=""
                                    />
                                </label>
                                <label
                                    title="Single Invite"
                                    :for="
                                        listUsers[item].slug +
                                        'singleInvite' +
                                        item
                                    "
                                >
                                    <input
                                        :checked="
                                            listUsers[item].pivot.invite == 1
                                        "
                                        type="radio"
                                        value="1"
                                        :name="listUsers[item].slug + item"
                                        :id="
                                            listUsers[item].slug +
                                            'singleInvite' +
                                            item
                                        "
                                        v-model="
                                            dataSendInvitation[index].invite
                                        "
                                    />
                                    <span class="checkmark"></span>
                                    <img
                                        class="ceremony-img"
                                        src="/assets/carbon_user.svg"
                                        alt=""
                                    />
                                </label>
                                <label
                                    title="Spouse Invite"
                                    :for="
                                        listUsers[item].slug +
                                        'spouseInvite' +
                                        item
                                    "
                                >
                                    <input
                                        :checked="
                                            listUsers[item].pivot.invite == 2
                                        "
                                        type="radio"
                                        value="2"
                                        :name="listUsers[item].slug + item"
                                        :id="
                                            listUsers[item].slug +
                                            'spouseInvite' +
                                            item
                                        "
                                        v-model="
                                            dataSendInvitation[index].invite
                                        "
                                    />
                                    <span class="checkmark"></span>
                                    <img
                                        class="ceremony-img"
                                        src="/assets/carbon_user-multiple.svg"
                                        alt=""
                                    />
                                </label>
                                <label
                                    title="Family Invite"
                                    :for="
                                        listUsers[item].slug +
                                        'familyInvite' +
                                        item
                                    "
                                >
                                    <input
                                        :checked="
                                            listUsers[item].pivot.invite == 3
                                        "
                                        type="radio"
                                        value="3"
                                        :name="listUsers[item].slug + item"
                                        :id="
                                            listUsers[item].slug +
                                            'familyInvite' +
                                            item
                                        "
                                        v-model="
                                            dataSendInvitation[index].invite
                                        "
                                    />
                                    <span class="checkmark"></span>
                                    <img
                                        class="ceremony-img"
                                        src="/assets/carbon_family.svg"
                                        alt=""
                                    />
                                </label>
                            </div>
                            <h6 class="hide-text">Facilities</h6>
                            <span
                                style="width: 10%; justify-content: center"
                                class="guest-shortlisted-list-checkbox"
                            >
                                <label
                                    :for="
                                        listUsers[item].slug +
                                        'accomodation' +
                                        item
                                    "
                                >
                                    <input
                                        :checked="
                                            listUsers[item].pivot
                                                .accommodation != 0
                                        "
                                        type="checkbox"
                                        :id="
                                            listUsers[item].slug +
                                            'accomodation' +
                                            item
                                        "
                                        v-model="
                                            dataSendInvitation[index]
                                                .accommodation
                                        "
                                        value="1"
                                    />
                                    <span class="checkmark"></span>
                                    <img
                                        class="ceremony-img hide-img"
                                        src="/assets/cil_bed.svg"
                                        alt=""
                                    />
                                </label>
                            </span>
                            <span
                                style="width: 10%; justify-content: center"
                                class="guest-shortlisted-list-checkbox"
                            >
                                <label
                                    :for="
                                        listUsers[item].slug +
                                        'logistics' +
                                        item
                                    "
                                >
                                    <input
                                        :checked="
                                            listUsers[item].pivot.logistics != 0
                                        "
                                        type="checkbox"
                                        value="1"
                                        :id="
                                            listUsers[item].slug +
                                            'logistics' +
                                            item
                                        "
                                        v-model="
                                            dataSendInvitation[index].logistics
                                        "
                                    />
                                    <span class="checkmark"></span>
                                    <img
                                        class="ceremony-img hide-img"
                                        src="/assets/car-alt.svg"
                                        alt=""
                                    />
                                </label>
                            </span>
                            <span
                                style="width: 6%; justify-content: center"
                                class="guest-shortlisted-list-checkbox"
                            >
                                <label
                                    :for="listUsers[item].slug + 'sms' + item"
                                >
                                    <input
                                        :checked="
                                            listUsers[item].pivot.sms != 0
                                        "
                                        type="checkbox"
                                        value="1"
                                        :id="
                                            listUsers[item].slug + 'sms' + item
                                        "
                                        v-model="dataSendInvitation[index].sms"
                                    />
                                    <span class="checkmark"></span>
                                    <img
                                        class="ceremony-img hide-img"
                                        src="/assets/ic_outline-textsms.svg"
                                        alt=""
                                    />
                                </label>
                            </span>
                            <span
                                style="width: 6%; justify-content: center"
                                class="guest-shortlisted-list-checkbox"
                            >
                                <label
                                    :for="listUsers[item].slug + 'email' + item"
                                >
                                    <input
                                        :checked="
                                            listUsers[item].pivot.email != 0
                                        "
                                        type="checkbox"
                                        value="1"
                                        :id="
                                            listUsers[item].slug +
                                            'email' +
                                            item
                                        "
                                        v-model="
                                            dataSendInvitation[index].email
                                        "
                                    />
                                    <img
                                        class="ceremony-img hide-img"
                                        src="/assets/cil-mail.svg"
                                        alt=""
                                    />
                                    <span class="checkmark"></span>
                                </label>
                            </span>
                            <!--<span
                                style="width: 6%; justify-content: center"
                                class="guest-shortlisted-list-checkbox"
                            >
                                <label
                                    :for="listUsers[item].slug + 'post' + item"
                                >
                                    <input
                                        :checked="
                                            listUsers[item].pivot.post != 0
                                        "
                                        type="checkbox"
                                        value="1"
                                        :id="
                                            listUsers[item].slug + 'post' + item
                                        "
                                        v-model="dataSendInvitation[index].post"
                                    />
                                    <span class="checkmark"></span>
                                    <img
                                        class="ceremony-img hide-img"
                                        src="/assets/ep_postcard.svg"
                                        alt=""
                                    />
                                </label>
                            </span>-->
                            <span
                                style="width: 6%; justify-content: center"
                                class="guest-shortlisted-list-checkbox"
                            >
                                <label
                                    :for="listUsers[item].slug + 'watsapp' + item"
                                >
                                    <input
                                        :checked="
                                            listUsers[item].pivot.watsapp != 0
                                        "
                                        type="checkbox"
                                        value="1"
                                        :id="
                                            listUsers[item].slug + 'watsapp' + item
                                        "
                                        v-model="dataSendInvitation[index].watsapp"
                                    />
                                    <span class="checkmark"></span>
                                    <img
                                        class="ceremony-img hide-img"
                                        src="/assets/ep_postcard.svg"
                                        alt=""
                                    />
                                </label>
                            </span>
                        </div>
                        <div class="send-inv-form-submit">
                            <button
                                :disabled="sendGuestsDisabled"
                                type="submit"
                            >
                                <img src="/assets/send.svg" alt="" />
                                Send Invitations
                            </button>
                        </div>
                    </form>
                    <div v-else>Kindly select guests to send Invitations!!</div>
                </div>
            </div>
            <div v-if="showUploadForm == true">
                <div class="guest-upload-head">
                    <div class="guest-head-details">
                        <h3>Guest Details</h3>
                        <h3 v-if="invitation.side == 'bride'">{{invitation.brideName}} Weds {{invitation.groomName}}</h3>
                        <h3 v-if="invitation.side == 'groom'">{{invitation.groomName}} Weds {{invitation.brideName}}</h3>
                    </div>
                    <div
                        :class="{
                            hide: selectGuestClick,
                        }"
                        class="guest-select-sort"
                    >
                        <button @click="showUploadForm = false" type="button">
                            <img src="/assets/guest-list.svg" alt="" />
                            Guest List
                        </button>
                    </div>
                </div>
                <div class="guest-upload-cont">
                    <div class="guest-upload-form-head">
                        <div
                            @click="
                                showGuestAll = false;
                                showGuestSimple = true;
                            "
                            class="guest-upload-form-head-btn"
                            :class="{
                                active: showGuestSimple,
                            }"
                        >
                            Import guest only
                        </div>
                        <div
                            @click="
                                showGuestAll = true;
                                showGuestSimple = false;
                            "
                            :class="{
                                active: showGuestAll,
                            }"
                            class="guest-upload-form-head-btn"
                        >
                            Import guest with full details
                        </div>
                    </div>
                    <div
                        :class="[
                            fileUploadLoader
                                ? 'blur guest-upload-form-content'
                                : 'guest-upload-form-content',
                        ]"
                    >
                        <Transition>
                            <label
                                v-if="showGuestSimple"
                                @click.self.prevent
                                for="guest-simple-upload"
                                @dragover.prevent="drago($event, 'simple')"
                                @dragleave.prevent="dragl($event, 'simple')"
                                @drop.prevent="dragdrop($event, 'simple')"
                            >
                                <img
                                    @click.self.prevent
                                    src="/assets/upload-input.png"
                                    alt=""
                                />
                                <div class="upload-label-text">
                                    <div>{{ simpleUploadMessage }}</div>
                                    <div
                                        @click.self.prevent
                                        v-if="guestSimpleFile == null"
                                    >
                                        OR
                                    </div>
                                </div>
                                <input
                                    type="file"
                                    name="guest-simple-upload"
                                    id="guest-simple-upload"
                                    ref="file"
                                    @change="uploadGuestFile($event, 'simple')"
                                />
                                <div
                                    @click.self.prevent
                                    class="upload-label-btns"
                                >
                                    <button
                                        @click="$refs.file.click()"
                                        type="button"
                                        v-if="guestSimpleFile == null"
                                    >
                                        Browse files
                                    </button>
                                    <button
                                        v-else
                                        style="background: #461952"
                                        type="button"
                                        @click="
                                            sendUploadFile($event, 'simple')
                                        "
                                        :disabled="sendUploadFileDisabled"
                                    >
                                        Upload
                                    </button>
                                </div>
                            </label>
                        </Transition>
                        <Transition>
                            <label
                                v-if="showGuestAll"
                                @click.self.prevent
                                @dragover.prevent="drago($event, 'all')"
                                @dragleave.prevent="dragl($event, 'all')"
                                @drop.prevent="dragdrop($event, 'all')"
                                for="guest-all-upload"
                            >
                                <img
                                    @click.self.prevent
                                    src="/assets/upload-input.png"
                                    alt=""
                                />
                                <div class="upload-label-text">
                                    <div id="guest-simple-text">
                                        {{ allUploadMessage }}
                                    </div>
                                    <div
                                        @click.self.prevent
                                        v-if="guestAllFile == null"
                                    >
                                        OR
                                    </div>
                                </div>
                                <input
                                    type="file"
                                    name="guest-all-upload"
                                    id="guest-all-upload"
                                    ref="fileall"
                                    @change="uploadGuestFile($event, 'all')"
                                />
                                <div
                                    @click.self.prevent
                                    class="upload-label-btns"
                                >
                                    <button
                                        @click="$refs.fileall.click()"
                                        type="button"
                                        v-if="guestAllFile == null"
                                    >
                                        Browse files
                                    </button>
                                    <button
                                        v-else
                                        style="background: #461952"
                                        type="button"
                                        @click="sendUploadFile($event, 'all')"
                                        :disabled="sendUploadFileDisabled"
                                    >
                                        Upload
                                    </button>
                                </div>
                            </label>
                        </Transition>
                        <div class="guest-download-btns">
                            <a
                                :href="
                                    showGuestSimple == true
                                        ? route('sampleGuest', 'guest')
                                        : route('sampleGuest', 'guestall')
                                "
                                type="button"
                            >
                                <img src="/assets/download-sample.svg" alt="" />
                                Download sample
                            </a>
                            <a
                                :href="
                                    showGuestSimple == true
                                        ? route('guestexport', invitation)
                                        : route('allguestexport', invitation)
                                "
                                type="button"
                            >
                                <img src="/assets/external-link.svg" alt="" />
                                Export Guest Details
                            </a>
                            <a
                                :href="route('familyguestexport1', invitation)"
                                type="button"
                            >
                                <img src="/assets/external-link.svg" alt="" />
                                Export Guest Family
                            </a>
                        </div>
                    </div>
                    <div v-if="uploadErrors">
                        <div class="guest-upload-err-table">
                            <h1>Rows with Errors</h1>
                            <table>
                                <tr>
                                    <th>Row</th>
                                    <th>Field</th>
                                    <th>Value</th>
                                    <th>Error</th>
                                </tr>

                                <tr
                                    v-for="(item, index) in uploadErrors"
                                    :key="index"
                                >
                                    <td>{{ item.row }}</td>
                                    <td>{{ item.attribute }}</td>
                                    <td>{{ item.values[item.attribute] }}</td>
                                    <td>
                                        <ul style="padding-left: 15px">
                                            <li
                                                v-for="(
                                                    err, indexx
                                                ) in item.errors"
                                                :key="index + indexx"
                                            >
                                                {{ err }}
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            </table>
                            <h3>
                                Note: The File is not Uploaded as the above
                                mentioned rows have errors.<br />To import the
                                file, correct the errors and import it again!!
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="wed-host-section-container-form" v-if="addSingleGuest">
                <div class="host-guest-head">
                    <div class="guest-head-add-btns">
                        <a @click="setUploadForm"
                            ><img src="/assets/user-plus-multi.svg" alt=""
                        /></a>
                        <a @click="addSingleGuest = true"
                            ><img src="/assets/user-plus.svg" alt=""
                        /></a>
                    </div>
                    <div class="guest-head-details">
                        <h3>Add Guests</h3>
                        <h3 v-if="invitation.side == 'bride'">{{invitation.brideName}} Weds {{invitation.groomName}}</h3>
                        <h3 v-if="invitation.side == 'groom'">{{invitation.groomName}} Weds {{invitation.brideName}}</h3>
                    </div>
                    <div
                        :class="{
                            hide: selectGuestClick,
                        }"
                        class="guest-select-sort"
                    >
                        <button @click="addSingleGuest = false" type="button">
                            <img src="/assets/guest-list.svg" alt="" />
                            Guest List
                        </button>
                    </div>
                </div>
                <form @submit.prevent="sendSingle($event)" class="form-row">
                    <div class="form-group-custom">
                        <label for="name" class="form-label">Name</label>
                        <input
                            type="text"
                            class="form-control"
                            id="name"
                            required
                            placeholder="Name"
                            name="name"
                            v-model="singleGuest.name"
                        />
                        <span
                            v-if="errorsSubmit && errorsSubmit.name"
                            class="errMsg"
                            >{{ errorsSubmit.name[0] }}</span
                        >
                    </div>
                    <div class="form-group-custom">
                        <label for="email" class="form-label">Email</label>
                        <input
                            type="email"
                            class="form-control"
                            id="email"
                            placeholder="Email"
                            name="email"
                            v-model="singleGuest.email"
                        />
                        <span
                            v-if="errorsSubmit && errorsSubmit.email"
                            class="errMsg"
                            >{{ errorsSubmit.email[0] }}</span
                        >
                    </div>
                    <div class="form-group-custom">
                        <label for="mobile" class="form-label">Mobile</label>
                        <input
                            type="number"
                            class="form-control"
                            id="mobile"
                            required
                            placeholder="Mobile"
                            name="mobile"
                            maxlength="10"
                            v-model="singleGuest.mobile"
                        />
                        <span
                            v-if="errorsSubmit && errorsSubmit.mobile"
                            class="errMsg"
                            >{{ errorsSubmit.mobile[0] }}</span
                        >
                    </div>
                    <!-- <div class="form-group-custom">
                        <label for="pass" class="form-label">Password</label>
                        <span style="position: relative">
                            <input
                                type="password"
                                class="form-control"
                                id="pass"
                                required
                                placeholder="Password"
                                v-model="singleGuest.password"
                            />
                            <img
                                class="eyee-pass"
                                @click="TogglePassLogin"
                                src="/assets/eye-off.svg"
                                alt=""
                            />
                        </span>
                        <span
                            v-if="errorsSubmit && errorsSubmit.mobile"
                            class="errMsg"
                            >{{ errorsSubmit.mobile[0] }}</span
                        >
                    </div> -->
                    <div class="form-group-custom text-center">
                        <button
                            :disabled="singleGuestDisabled"
                            type="submit"
                            class="btn btn-sm"
                        >
                            <span>Submit</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <flashMessage :message="message"></flashMessage>
        <div
            v-if="loader && mainLoader && fileUploadLoader"
            class="form-upload-spinner form-upload-vue"
        >
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
        <div
            style="position: relative; width: 100%"
            v-if="selectGuestClick == true && showSendInvitation == false"
        >
            <div class="guest-select-summary">
                <div>
                    <span>{{ selectedGuests.length }} Selected</span>
                    <button @click="selectGuestClick = false" type="button">
                        Deselect
                    </button>
                </div>
                <div>
                    <button @click="setVModel($event)" type="button">
                        <img src="/assets/send.svg" alt="" />
                        Shortlist
                    </button>
                </div>
            </div>
        </div>
        <div v-if="sendInviPressed" class="send-invi-popup-wrapper">
            <div class="send-invi-popup">
                <div>
                    <img
                        @click="sendInviPressed = false"
                        src="/assets/send-invi-cross.svg"
                        alt=""
                    />
                </div>
                <div><img src="/assets/send-invi-icon.png" alt="" /></div>
                <h4>Invitation Sent</h4>
                <p>
                    Invitation sent to 2 Guest. Track the status of invitation
                    in Reports
                </p>
                <div>
                    <button
                        @click="
                            selectGuestClick = false;
                            showSendInvitation = false;
                            selectedGuests = [];
                            dataSendInvitation = [];
                            sendInviPressed = false;
                        "
                        type="button"
                    >
                        Send More Invitation
                    </button>
                </div>
                <div><a href="/host/reports">Status</a></div>
            </div>
        </div>
    </div>
</template>

<script>
import flashMessage from "../../../FlashMessage.vue";

export default {
    components: {
        flashMessage,
    },
    props: ["users", "host", "ceremonyList", "invitation", "relationList"],
    data() {
        return {
            guestFamily: {
                familyname: null,
                familyage: null,
                familygender: null,
                familyrelation: null,
                familymobile: null,
                guest_id: this.guestId,
            },
            singleGuest: {},
            familyimageOne: null,
            familyimageTwo: null,
            familyimageOneName: null,
            familyimageTwoName: null,
            famRel: [
                "Father",
                "Mother",
                "Wife",
                "Husband",
                "Son",
                "Daughter",
                "Son-in-law",
                "Daughter-in-law",
                "Grand Son",
                "Grand Daughter",
                "Others",
            ],
            errorsSubmit: null,
            uploadErrors: null,
            message: null,
            loader: null,
            mainLoader: null,
            fileUploadLoader: null,
            pprofileDisabled: false,
            oprofileDisabled: false,
            hprofileDisabled: false,
            fprofileDisabled: false,
            sendGuestsDisabled: false,
            deleteGuestDisabled: false,
            sendCeremonyDisabled: false,
            sendUploadFileDisabled: false,
            singleGuestDisabled: false,
            selectedGuests: [],
            selectGuestClick: false,
            showSendInvitation: false,
            showUploadForm: false,
            dataSendInvitation: [],
            dataSendCeremonies: {},
            userIdSendCerermonies: null,
            listUsers: this.users,
            sendInviPressed: false,
            showFamilyForm: false,
            fedit: false,
            showSort: false,
            showGuestSimple: true,
            showGuestAll: false,
            guestSimpleFile: null,
            guestAllFile: null,
            simpleUploadMessage: "Drag & Drop your file here",
            allUploadMessage: "Drag & Drop your file here",
            url: "",
            addSingleGuest: false,
        };
    },
    methods: {
        sendSingle(e) {
            let _this = this;
            _this.uploadErrors = null;
            _this.singleGuestDisabled = true;
            let formData = new FormData();
            let url = route("invitedguests.store", _this.invitation);
            for (let key in _this.singleGuest) {
                console.log(key, _this.singleGuest[key]);
                formData.append(key, _this.singleGuest[key]);
            }
            formData.append("type", "single");
            axios({
                method: "POST",
                url: url,
                data: formData,
            })
                .then(function (response) {
                    _this.listUsers = response.data;
                    _this.message = "Guest Added";
                    _this.addSingleGuest = false;
                    _this.singleGuest = {};
                    _this.singleGuestDisabled = false;
                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                })
                .catch((error) => {
                    // console.log(e.target);
                    _this.singleGuestDisabled = false;
                    _this.message =
                        error.response?.data?.message ?? "something went wrong";
                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                });
        },
        setUploadForm() {
            this.simpleUploadMessage = "Drag & Drop your file here";
            this.allUploadMessage = "Drag & Drop your file here";
            this.showGuestSimple = true;
            this.showGuestAll = false;
            this.guestSimpleFile = null;
            this.guestAllFile = null;
            this.selectGuestClick = false;
            this.addSingleGuest = false;
            this.selectedGuests = [];
            this.showUploadForm = true;
        },
        uploadGuestFile(e, type) {
            //console.log(e.target, type);
            if (type == "simple") {
                if (e.target.files.length == 0) {
                    return;
                }
                this.guestSimpleFile = e.target.files[0];
                this.simpleUploadMessage = e.target.files[0].name;
            }
            if (type == "all") {
                if (e.target.files.length == 0) {
                    return;
                }
                this.guestAllFile = e.target.files[0];
                this.allUploadMessage = e.target.files[0].name;
            }
        },
        sendUploadFile(e, type) {
            let _this = this;
            _this.uploadErrors = null;
            let url = null;
            let formData = new FormData();
            if (type == "simple") {
                url = route("invitedguests.store", _this.invitation);
                formData.append("guests", _this.guestSimpleFile);
            }
            if (type == "all") {
                url = route("guestall", [_this.host, _this.invitation]);
                formData.append("guestAll", _this.guestAllFile);
            }
            _this.fileUploadLoader = true;
            _this.sendUploadFileDisabled = true;
            axios({
                method: "POST",
                url: url,
                data: formData,
                headers: { "content-type": "multipart/form-data" },
            })
                .then(function (response) {
                    _this.fileUploadLoader = false;
                    _this.listUsers = response.data;
                    _this.message = "Guest List Uploaded succesfully";
                    _this.showUploadForm = false;
                    _this.sendUploadFileDisabled = false;
                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                })
                .catch((error) => {
                    // console.log(e.target);
                    if (type == "simple") {
                        _this.$refs.file.value = null;
                        _this.guestSimpleFile = null;
                        _this.simpleUploadMessage =
                            "Drag & Drop your file here";
                    }
                    if (type == "all") {
                        _this.$refs.fileall.value = null;
                        _this.guestAllFile = null;
                        _this.allUploadMessage = "Drag & Drop your file here";
                    }
                    _this.fileUploadLoader = false;
                    _this.message =
                        error.response?.data?.message ?? "something went wrong";
                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                    _this.sendUploadFileDisabled = false;
                    _this.uploadErrors = error.response?.data?.errors ?? null;
                });
        },
        changeColor(e) {
            let item = e.currentTarget.parentElement.parentElement;
            //console.log(e.currentTarget.checked);
            if (e.currentTarget.checked == true) {
                item.classList.remove("select-on");
            } else {
                item.classList.add("select-on");
            }
        },
        toggleForm(e, bool) {
            let id = null;
            if (bool == true) {
                id = e.currentTarget.dataset.id;
            }
            if (bool == false) {
                id = e;
            }
            //console.log(e.currentTarget.parentElement.children);
            const btns = [...e.currentTarget.parentElement.children];
            const articles = [
                ...e.currentTarget.parentElement.nextElementSibling.children,
            ];
            const articlesCont =
                e.currentTarget.parentElement.nextElementSibling;

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
            $(articlesCont)
                .find(`.${e.currentTarget.dataset.id}`)
                .addClass("active");
            //document.getElementById(id).classList.add("active");
        },
        closeAccord(e) {
            let item = e.currentTarget;
            var drop = item.nextElementSibling;
            var accordian = document.querySelectorAll(".custom-accord-head");
            if (drop.style.maxHeight) {
                drop.style.maxHeight = null;
                drop.style.padding = null;
                item.style.paddingBottom = "5px";
            } else {
                accordian.forEach(function (element) {
                    if (element !== item) {
                        element.nextElementSibling.style.maxHeight = null;
                        element.nextElementSibling.style.padding = null;
                        element.style.paddingBottom = "5px";
                    } else {
                        drop.style.maxHeight = drop.scrollHeight + 500 + "px";
                        drop.style.padding = "20px";
                        if (item.style.paddingBottom) {
                            item.style.paddingBottom = null;
                        }
                    }
                });
            }
        },
        submitProfile(e, id) {
            this.loader = true;
            let data = this.listUsers.find((x) => x.id === id);
            if (e == true) {
                this.loader = false;
                return;
            }
            if (data == null) {
                this.loader = false;
                return;
            }
            var _this = this;
            _this.errorsSubmit = null;
            _this.pprofileDisabled = true;
            data.profile.guest_id = data.id;
            let formData = new FormData();
            formData.append("type", "personal");
            formData.append("data", JSON.stringify(data.profile));
            if (data.profile.id == null) {
                axios
                    .post(`/api/guest/profile`, formData)
                    .then(function (response) {
                        _this.loader = false;
                        _this.message = "Personal Profile Uploaded";
                        _this.pprofileDisabled = false;
                        setTimeout(function () {
                            _this.message = null;
                        }, 3000);
                    })
                    .catch((error) => {
                        _this.pprofileDisabled = false;
                        _this.loader = false;
                        _this.errorsSubmit = error.response.data.errors;
                    });
                return;
            }
            formData.append("_method", "PATCH");
            axios
                .post(`/api/guest/profile/${data.profile.id}`, formData)
                .then(function (response) {
                    _this.loader = false;
                    _this.message = "Personal Profile updated";
                    _this.pprofileDisabled = false;
                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                })
                .catch((error) => {
                    _this.pprofileDisabled = false;
                    _this.loader = false;
                    _this.errorsSubmit = error.response.data.errors;
                });
        },
        submitHome(e, id) {
            this.loader = true;
            let data = this.listUsers.find((x) => x.id === id);
            if (e == true) {
                this.loader = false;
                return;
            }
            if (data == null) {
                this.loader = false;
                return;
            }
            var _this = this;
            _this.errorsSubmit = null;
            _this.hprofileDisabled = true;
            data.home.guest_id = data.id;
            // if(data.home.id != null){
            //     delete
            // }
            let formData = new FormData();
            formData.append("type", "home");
            formData.append("data", JSON.stringify(data.home));
            if (data.home.id == null) {
                axios
                    .post(`/api/guest/profile`, formData)
                    .then(function (response) {
                        _this.loader = false;
                        _this.message = "Home Profile Uploaded";
                        _this.hprofileDisabled = false;
                        setTimeout(function () {
                            _this.message = null;
                        }, 3000);
                    })
                    .catch((error) => {
                        console.log(error.response);
                        _this.hprofileDisabled = false;
                        _this.loader = false;
                        _this.errorsSubmit = error.response.data.errors;
                    });
                return;
            }
            formData.append("_method", "PATCH");
            axios
                .post(`/api/guest/profile/${data.home.id}`, formData)
                .then(function (response) {
                    _this.loader = false;
                    _this.message = "Home Profile updated";
                    _this.hprofileDisabled = false;
                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                })
                .catch((error) => {
                    console.log(error);

                    _this.hprofileDisabled = false;
                    _this.loader = false;
                    _this.errorsSubmit = error.response.data.errors;
                });
        },
        submitOffice(e, id) {
            this.loader = true;
            let data = this.listUsers.find((x) => x.id === id);
            if (e == true) {
                this.loader = false;
                return;
            }
            if (data == null) {
                this.loader = false;
                return;
            }
            var _this = this;
            _this.errorsSubmit = null;
            _this.oprofileDisabled = true;
            data.office.guest_id = data.id;
            let formData = new FormData();
            formData.append("type", "office");
            formData.append("data", JSON.stringify(data.office));
            if (data.office.id == null) {
                axios
                    .post(`/api/guest/profile`, formData)
                    .then(function (response) {
                        _this.loader = false;
                        _this.message = "Office Profile Uploaded";
                        _this.oprofileDisabled = false;
                        setTimeout(function () {
                            _this.message = null;
                        }, 3000);
                    })
                    .catch((error) => {
                        _this.oprofileDisabled = false;
                        _this.loader = false;
                        _this.errorsSubmit = error.response.data.errors;
                    });
                return;
            }
            formData.append("_method", "PATCH");
            axios
                .post(`/api/guest/profile/${data.office.id}`, formData)
                .then(function (response) {
                    _this.loader = false;
                    _this.message = "Office Profile updated";
                    _this.oprofileDisabled = false;
                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                })
                .catch((error) => {
                    _this.oprofileDisabled = false;
                    _this.loader = false;
                    _this.errorsSubmit = error.response.data.errors;
                });
        },
        submitFamily(e, id) {
            this.loader = true;
            let data = this.listUsers.find((x) => x.id === id);
            console.log(data);
            if (e == true) {
                this.loader = false;
                return;
            }
            if (data == null) {
                this.loader = false;
                return;
            }
            var _this = this;
            _this.errorsSubmit = null;
            _this.guestFamily.guest_id = data.id;
            this.fprofileDisabled = true;
            const config = {
                headers: { "content-type": "multipart/form-data" },
            };
            let formData = new FormData();
            if (this.familyimageOne != null) {
                formData.append("familyimageOne", _this.familyimageOne);
                delete _this.guestFamily.familyimageOne;
            }
            if (this.familyimageTwo != null) {
                formData.append("familyimageTwo", _this.familyimageTwo);
                delete _this.guestFamily.familyimageTwo;
            }
            formData.append("data", JSON.stringify(_this.guestFamily));
            formData.append("type", "family");
            //data.family.guest_id = data.id;
            console.log("ss");
            if (this.fedit) {
                formData.append("_method", "PATCH");
                let updateId = this.guestFamily.id;
                delete this.guestFamily.id;
                delete this.guestFamily.familyimageOne;
                delete this.guestFamily.familyimageTwo;
                axios
                    .post(`/api/guest/profile/${updateId}`, formData)
                    .then(function (response) {
                        console.log(response);
                        _this.loader = false;
                        // _this.toggleForm("family-details", false);
                        data.family = response.data;
                        //_this.editFamilyForm(e, "new");
                        _this.message = "Family Member updated";
                        //_this.updateEdit();
                        _this.fedit = false;
                        _this.fprofileDisabled = false;
                        _this.showFamilyForm = false;
                        setTimeout(function () {
                            _this.message = null;
                        }, 3000);
                    })
                    .catch((error) => {
                        _this.fprofileDisabled = false;
                        _this.loader = false;
                        _this.errors = error.response.data.errors;
                    });
                return;
            }

            axios
                .post(`/api/guest/profile`, formData)
                .then(function (response) {
                    _this.loader = false;
                    data.family = response.data;
                    // _this.toggleForm("family-details", false);
                    //_this.familyList = response.data;
                    // _this.editFamilyForm(e, "new");
                    console.log(response);
                    _this.message = "Family Member added";
                    _this.showFamilyForm = false;
                    //_this.fexist = 1;
                    _this.fprofileDisabled = false;
                    // _this.updateEdit();
                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                })
                .catch((error) => {
                    this.fprofileDisabled = false;
                    _this.loader = false;
                    _this.errors = error.response.data.errors;
                });
        },
        setVModel(e) {
            let _this = this;
            if (_this.selectedGuests.length == 0) {
                _this.showSendInvitation = true;
                return;
            } else {
                _this.selectedGuests.forEach(function (item) {
                    let user = _this.listUsers[item];
                    let check = _this.dataSendInvitation.find(
                        (x) => x.user_id == user.id
                    );
                    if (check == null || check == undefined || check == "") {
                        //let user = _this.users.find((x) => x.id == item);
                        ///console.log(user);
                        _this.dataSendInvitation.push({
                            user_id: user.id,
                            invitation_id: user.pivot.invitation_id,
                            invite: user.pivot.invite,
                            //inviteStatus: user.pivot.inviteStatus,
                            logistics: user.pivot.logistics,
                            accommodation: user.pivot.accommodation,
                            sms: user.pivot.sms,
                            watsapp: user.pivot.watsapp,
                            email: user.pivot.email,
                            post: user.pivot.post,
                        });
                    }
                });
                _this.showSendInvitation = true;
            }
        },
        sendInvi(e) {
            var _this = this;
            _this.loader = true;
            _this.errorsSubmit = null;
            _this.sendGuestsDisabled = true;
            let formData = new FormData();
            formData.append("data", JSON.stringify(_this.dataSendInvitation));
            axios({
                method: "POST",
                url: route("sendinvite", _this.invitation),
                data: formData,
            })
                .then(function (response) {
                    _this.listUsers = response.data;
                    _this.sendInviPressed = true;
                    _this.loader = false;
                    _this.message = "Invitation Sent succesfully!!";
                    _this.sendGuestsDisabled = false;
                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                })
                .catch((error) => {
                    _this.sendGuestsDisabled = false;
                    _this.loader = false;
                    _this.errorsSubmit = error.response.data.errors;
                });
        },
        deleteGuest(item) {
            let _this = this;
            _this.mainLoader = true;
            _this.errorsSubmit = null;
            _this.deleteGuestDisabled = true;
            axios({
                method: "DELETE",
                url: route("deleteguest", [
                    _this.host,
                    _this.invitation,
                    item.id,
                ]),
            })
                .then(function (response) {
                    _this.listUsers = response.data;
                    _this.mainLoader = false;
                    _this.message = "Guest Deleted!!";
                    _this.deleteGuestDisabled = false;
                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                })
                .catch((error) => {
                    _this.deleteGuestDisabled = false;
                    _this.mainLoader = false;
                    _this.errorsSubmit = error.response.data.errors;
                });
        },
        sendCeremonyInfo(e, user) {
            let _this = this;
            _this.loader = true;
            _this.errorsSubmit = null;
            _this.sendCeremonyDisabled = true;
            let formData = new FormData();
            formData.append("data", JSON.stringify(_this.dataSendCeremonies));
            axios({
                method: "POST",
                url: route("ceremonyUpdate", [
                    _this.host,
                    _this.invitation,
                    user.id,
                ]),
                data: formData,
            })
                .then(function (response) {
                    _this.dataSendCeremonies = {};
                    //console.log(user.pivot.ceremony_invite, response.data);
                    user.pivot.ceremony_invite = response.data;
                    // console.log(user.pivot.ceremony_invite, response.data);
                    _this.loader = false;
                    _this.message = "Ceremony added!!";
                    _this.sendCeremonyDisabled = false;
                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                })
                .catch((error) => {
                    _this.sendCeremonyDisabled = false;
                    _this.loader = false;
                    _this.errorsSubmit = error.response.data.errors;
                });
        },
        setCeremonyVModel(e, ceremonyId, userId) {
            let _this = this;
            _this.userIdSendCerermonies = userId;
            // console.log(ceremonyId, userId, e.currentTarget.value);
            _this.dataSendCeremonies[ceremonyId] = e.currentTarget.value;
        },
        checkUser(e, id) {
            if (id == this.userIdSendCerermonies) {
                return;
            } else {
                this.dataSendCeremonies = {};
                //this.userIdSendCerermonies = null;
            }
        },
        uploadImg(e, type) {
            if (type == "familyOne") {
                this.familyimageOne = e.target.files[0];
                this.familyimageOneName = e.target.files[0].name;
                //console.log(e.target.files[0]);
            }
            if (type == "familyTwo") {
                this.familyimageTwo = e.target.files[0];
                this.familyimageTwoName = e.target.files[0].name;
            }
        },
        deleteFamily(e, id, ele) {
            let _this = this;
            let data = this.listUsers.find((x) => x.id == id);
            this.loader = true;

            axios
                .delete(`/api/guest/profile/${ele}`)
                .then(function (response) {
                    _this.loader = false;
                    _this.message = "Deleted";
                    data.family = response.data;
                    console.log(response.data);
                    //_this.familyList = response.data;
                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                })
                .catch((error) => {
                    _this.loader = false;
                    console.log(error.response.data.errors);
                });
        },
        editFamilyForm(e, id, ele) {
            let _this = this;
            if (id == "new") {
                for (const key in this.guestFamily) {
                    _this.guestFamily[key] = null;
                }
                _this.showFamilyForm = true;
                _this.familyimageTwoName = null;
                _this.familyimageOneName = null;
                _this.familyimageTwo = null;
                _this.familyimageOne = null;
                //_this.guestFamily.guest_id = _this.guestId;
                _this.fedit = false;
            } else {
                let user = this.listUsers.find((x) => x.id == id).family;
                _this.guestFamily = { ...user.find((y) => y.id == ele) };
                console.log(_this.guestFamily, user);
                // _this.guestFamily = { ..._this.listUsers.[id] };
                _this.fedit = true;
                _this.showFamilyForm = true;
                //console.log(_this.guestFamily);
            }
        },
        drago(e, type) {
            if (type == "simple") {
                this.simpleUploadMessage = "Drop your File";
            }
            if (type == "all") {
                this.allUploadMessage = "Drop your File";
            }
        },
        dragl(e, type) {
            if (type == "simple") {
                this.simpleUploadMessage = "Drag & Drop your file here";
            }
            if (type == "all") {
                this.allUploadMessage = "Drag & Drop your file here";
            }
        },
        dragdrop(e, type) {
            if (type == "simple") {
                this.guestSimpleFile = e.dataTransfer.files[0];
                this.simpleUploadMessage = e.dataTransfer.files[0].name;
                //console.log(e.target, e.dataTransfer.files, e.currentTarget);
            }
            if (type == "all") {
                this.guestAllFile = e.dataTransfer.files[0];
                this.allUploadMessage = e.dataTransfer.files[0].name;
                //console.log(e.target, e.dataTransfer.files, e.currentTarget);
            }
        },
        TogglePassLogin() {
            var x = document.getElementById("pass");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        },
    },
    mounted() {
        this.$nextTick(function () {
            if (this.listUsers.length == 0) {
                this.showUploadForm = true;
            }
        });
    },
    computed: {
        // listUsers() {
        //     if (this.users != null && this.users != "") {
        //         return this.users;
        //     } else {
        //         return {};
        //     }
        // },
        // loggedIn() {
        //     if (this.host != null && this.host != "") {
        //         return this.host;
        //     } else {
        //         return {};
        //     }
        // },
    },
};
</script>

<style scoped>
.eyee-pass {
    position: absolute;
    right: 8px;
    top: 56%;
    cursor: pointer;
}
.form-group-custom > label {
    font-family: "Poppins", sans-serif;
    font-style: normal;
    font-weight: 800;
    font-size: 12px;
    line-height: 8px;
    margin-left: 10px;

    color: #000000;
}
.form-group-custom input {
    background: rgba(239, 220, 226, 0.2);
    border: 0.643349px solid #f7dae4;
    border-radius: 7.72019px;
    margin-bottom: 12px;
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
.form-group-custom > button {
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
    /* identical to box height */

    text-align: center;
    box-shadow: none !important;
    color: #ffffff;
}
.form-row {
    width: 50%;
    margin: auto;
}
.select-guest-checkbox {
    margin-right: 10px;
    padding: 10px;
}
.select-on {
    background: #f7f7f7 !important;
}
.select-on .host-guest-acc-single-info,
.select-on .host-guest-acc-single-btns > span,
.select-on .host-guest-acc-single-btns > button {
    color: #828282 !important;
}
.select-on
    .host-guest-acc-single-btns
    > button:nth-child(2)
    > img:nth-child(1) {
    display: none;
}
.select-on .host-guest-acc-single-btns > button:nth-child(2) {
    border: 0.5px solid #828282 !important;
}
.select-on
    .host-guest-acc-single-btns
    > button:nth-child(2)
    > img:nth-child(2) {
    display: block !important;
}
.select-on .form-upload-vue {
    display: block !important;
}
.form-upload-vue {
    position: absolute !important;
    width: max-content !important;
    z-index: 9999 !important;
    background-color: transparent !important;
    position: fixed !important;
    top: 50% !important;
    left: 48% !important;
    display: block !important;
    z-index: 999999 !important;
}
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
.custom-accord-content {
    max-height: 0;
    overflow: hidden;
    transition: all linear 500ms;
    padding: 0;
}
.custom-accord-head {
    cursor: pointer;
}
.host-guest-head {
    display: flex;
    justify-content: space-between;
}
.guest-head-add-btns > a {
    border: 1px solid #e3e8ee;
    border-radius: 5px;
    padding: 11px 15px;
    margin-right: 10px;
}
.guest-head-details > h3 {
    margin-bottom: 10px;
    text-align: center;
}
.guest-head-details > h3:nth-child(1) {
    font-family: "Perpetua";
    font-style: normal;
    font-weight: 700;
    font-size: 24.4444px;
    line-height: 28px;
    color: #333333;
}
.guest-head-details > h3:nth-child(2) {
    font-family: Niconne;
    font-style: normal;
    font-weight: normal;
    font-weight: 400;
    font-size: 19.9799px;
    line-height: 25px;
    color: #461952;
}
.guest-select-sort button, .guest-select-sort a {
    text-decoration: none;
    border: 1px solid #e3e8ee;
    border-radius: 5px;
    padding: 13px 22px;
    background-color: #ffffff;
    font-family: "Inter";
    font-style: normal;
    font-weight: 400;
    font-size: 12px;
    line-height: 15px;
    color: #c4456f;
}
.host-guest-accord-head {
    background: #c4456f;
    border: 0.5px solid #ffffff;
    border-radius: 6px;
    padding: 12px 23px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.hide {
    visibility: hidden;
}
.host-guest-acc-single-info {
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-family: "Poppins", sans-serif;
    font-style: normal;
    font-weight: 600;
    font-size: 12px;
    line-height: 18px;
    color: #ffffff;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
/* .host-guest-acc-single-info > span:nth-child(2) {
    font-weight: 400;
} */
.host-guest-acc-single-btns > span:nth-child(1) {
    font-family: "Mulish", sans-serif;
    font-style: normal;
    font-weight: 500;
    font-size: 12.5813px;
    line-height: 16px;
    text-transform: uppercase;
    color: #ffffff;
    margin: 0 15px;
}
.host-guest-acc-single-btns > button {
    background-color: inherit;
    width: 24px;
    height: 24px;
    border: 0.5px solid #ffffff;
    border-radius: 2px;
    outline: none;
    display: inline-flex;
    justify-content: center;
    align-items: center;
    padding: 2px;
    margin: 0 15px;
}
.host-guest-acc-single-btns > span:nth-child(3) {
    color: white;
    display: inline-flex;
    align-items: center;
}
.content {
    display: none;
}
.content.active {
    display: block;
}
.host-guest-accord-content {
    border: 0.5px solid #e2c4ce;
    /* padding: 24px 15px; */
    width: 95%;
    margin: auto;
}
.btn-container {
    overflow-y: auto;
    /* min-width: 500px; */
    display: flex;
    flex-wrap: nowrap;
}
.tab-btn {
    font-family: "Poppins", sans-serif;
    font-style: normal;
    font-weight: 300;
    font-size: 13px;
    line-height: 20px;
    color: #6b6b6b;
    background-color: inherit;
    outline: none;
    border: none;
    padding: 10px;
    min-width: fit-content;
}
.tab-btn.active {
    border-bottom: 4px solid #c4456f;
    font-weight: 500;
    color: #c4456f;
}
.sort-btns {
    border: none !important;
    border-bottom: 0.3px solid #cdcdcd !important;
    border-radius: 0 !important;
}
.sort-btns.active {
    border-bottom: 4px solid #461952 !important;
    font-weight: 900;
    color: #461952;
}
.guest-details-form-fields,
.guest-details-ceremony-fields {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    grid-auto-rows: max-content;
    column-gap: 12px;
    row-gap: 4px;
    padding-top: 15px;
}
.ceremony-select-single {
    display: flex;
    flex-direction: column;
    background: #ffffff;
    border: 0.528708px solid #e9e9e9;
    border-radius: 5.28708px;
    box-sizing: border-box;
    font-family: "Poppins", sans-serif;
    font-style: normal;
    font-weight: 600;
    font-size: 14.23896px;
    line-height: 16px;
    height: 100%;
    color: #000000;
    padding: 10px 20px;
}
.form-group > label {
    display: flex;
    flex-direction: column;
    background: #ffffff;
    border: 0.528708px solid #e9e9e9;
    border-radius: 5.28708px;

    box-sizing: border-box;
    font-family: "Poppins", sans-serif;
    font-style: normal;

    height: 100%;
    padding: 10px 20px;
    font-weight: 500;
    font-size: 12px;
    line-height: 18px;

    color: #959595;
}
.form-group > label input,
.form-group > label select {
    font-family: "Poppins", sans-serif;
    font-style: normal;
    font-weight: 400;
    font-size: 13px;
    line-height: 20px;

    color: #000000;
    outline: none;
    border: 0;
    margin: 5px 0;
    background-color: transparent !important;
}
.ven-profile-form-submit {
    position: relative;
    margin: 1.5em 0;

    padding-right: 0;
    display: flex;
    justify-content: flex-end;
}
.send-inv-form-submit {
    position: relative;
    margin: 1.5em 0;

    padding-right: 0;
    display: flex;
    justify-content: flex-end;
}
.send-inv-form-submit > button:nth-child(1) {
    background: #461952;
    box-shadow: 0px 0px 4px 1px rgba(0, 0, 0, 0.25);
    border-radius: 5.53571px;
    padding: 16px 24px;
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
    margin-right: 10px;
}
.send-inv-form-submit > button:nth-child(1) > img {
    margin-right: 5px;
}
.ven-profile-form-submit > button {
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
    margin-right: 10px;
}
.ven-family-form-submit {
}
.fam-images > label > span {
    width: 100%;
    display: block;
    font-family: "Poppins", sans-serif;
    font-style: normal;
    font-weight: 300;
    font-size: 12.689px;
    line-height: 19px;
    margin-top: 5px;
    color: #afa5a5;
}
.fam-images > label {
    background-image: url(/assets/upload.svg) !important;
    background-repeat: no-repeat !important;
    background-size: 16px !important;
    background-origin: padding-box !important;
    background-position: 96% 22px !important;
}

.guest-details-form-fields input[type="file"] {
    display: none;
}
.guest-details-single-view {
    display: flex;
    align-items: center;
    justify-content: space-between;
    border: 0.5px solid #dedede;
    border-radius: 6px;
    padding: 17px 30px;
    margin-bottom: 10px;
}
.guest-details-single-view > div {
    display: flex;
}
.guest-details-single-view span {
    font-family: "Poppins", sans-serif;
    font-style: normal;
    font-weight: 300;
    font-size: 12px;
    line-height: 18px;
    color: #7b7b7b;
    padding: 0 5px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    flex: 1;
    display: inline-block;
}
.guest-details-single-view span:nth-child(1) {
    font-weight: 900;
}
.thumbnails {
    width: 13px;
    height: 13px;
    margin-right: 7px;
}
.guest-select-summary {
    padding: 9px 50px;
    background: #461952;
    position: fixed;
    bottom: 70px;
    /* width: 100%; */
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-radius: 15px;
    left: 50%;
    transform: translate(-50%, -50%);
}
.guest-select-summary span {
    font-family: "Inter";
    font-style: normal;
    font-weight: 600;
    font-size: 14px;
    line-height: 17px;
    color: #ffffff;
    margin-right: 10px;
}
.guest-select-summary button {
    font-family: "Inter";
    font-style: normal;
    font-weight: 400;
    font-size: 12px;
    line-height: 15px;
    color: #ffffff;
    outline: none;
    border: none;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 5px;
    padding: 13px 24px;
    margin-right: 5px;
}
.guest-details-ceremony-fields label,
.guest-shortlisted-list-checkbox label {
    position: relative;
    cursor: pointer;
    font-size: 22px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    display: flex;
}
.guest-shortlisted-list-checkbox {
    display: flex;
    align-items: center;
}
.guest-shortlisted-list-checkbox label {
    margin-right: 5px;
}
.guest-details-ceremony-fields input,
.guest-shortlisted-list-checkbox input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
    height: 0;
    width: 0;
}

.checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 12px;
    width: 12px;
    background: #ffffff;
    margin-right: 10px;
    border: 1px solid #7b7b7b;
}
.guest-details-ceremony-fields input:checked ~ .checkmark,
.guest-shortlisted-list-checkbox input:checked ~ .checkmark {
    background-color: #e27487;
    border: none;
}
.checkmark::after {
    content: "";
    position: absolute;
    display: none;
}

.guest-details-ceremony-fields input:checked ~ .checkmark:after,
.guest-shortlisted-list-checkbox input:checked ~ .checkmark:after {
    display: block;
}
.checkmark::after {
    left: 4px;
    top: 2px;
    width: 3px;
    height: 6px;
    border: solid white;
    border-width: 0px 1px 1px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
}
.guest-details-ceremony-fields {
    padding-bottom: 2em;
}
.ceremony-select-single > div:nth-child(1) {
    font-family: "Poppins", sans-serif;
    font-style: normal;
    font-weight: 600;
    font-size: 10.5742px;
    line-height: 16px;
    color: #c4456f;
    margin-bottom: 5px;
}
.ceremony-select-single > div:nth-child(2) {
    display: flex;
    justify-content: space-between;
}
.ceremony-img {
    margin-left: 15px;
}
.guest-shortlisted-head > div:nth-child(1) {
    position: relative;
    height: 56px;
    align-items: center;
    display: flex;
    justify-content: center;
    align-items: center;
}
.guest-shortlisted-head > div:nth-child(1) > span {
    position: absolute;
    right: 30px;
    top: 0;
    border: 1px solid #e3e8ee;
    border-radius: 5px;
    padding: 11px 15px;
    margin-right: 10px;
    display: inline-block;
}
.guest-shortlisted-list-head,
.guest-shortlisted-list-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
    border: 0.5px solid #dedede;
    border-radius: 6px;
    padding: 17px 30px;
    margin-bottom: 10px;
}
.guest-shortlisted-list-head > span,
.guest-shortlisted-list-content > span {
    margin-right: 5px;
}
.guest-shortlisted-list-head > span {
    font-family: "Poppins", sans-serif;
    font-style: normal;
    font-weight: 000;
    font-size: 12px;
    line-height: 18px;
    color: #000000;
}
.send-invi-popup-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100%;
    overflow-y: auto;
    background-color: rgba(0, 0, 0, 0.4);
    z-index: 999;
    top: 0;
    position: fixed;
    right: 0;
}
.send-invi-popup {
    background: #ffffff;
    box-shadow: 0px 3.35501px 50.3252px rgba(0, 0, 0, 0.25);
    border-radius: 8.38753px;
    padding: 24px;
    max-width: 620px;
    margin: auto;
}
.send-invi-popup > div:nth-child(1) {
    display: flex;
    justify-content: flex-end;
    align-items: center;
}
.send-invi-popup > div:nth-child(2),
.send-invi-popup > div:nth-child(5),
.send-invi-popup > div:nth-child(6) {
    display: flex;
    justify-content: center;
}
.send-invi-popup > h4 {
    font-family: "Poppins", sans-serif;
    font-style: normal;
    font-weight: 500;
    font-size: 22.2467px;
    line-height: 33px;
    text-align: center;
    color: #000000;
    margin-bottom: 10px;
}
.send-invi-popup > p {
    font-family: "Poppins", sans-serif;
    font-style: normal;
    font-weight: 500;
    font-size: 11.8626px;
    line-height: 18px;
    text-align: center;
    max-width: 300px;
    width: 100%;
    color: #898484;
    margin: auto;
    margin-bottom: 1.5em;
}
.send-invi-popup button {
    display: block;
    background: #461952;
    border-radius: 33.5501px;
    border: none;
    outline: none;
    font-family: "Mulish";
    font-style: normal;
    font-weight: 800;
    font-size: 12.5813px;
    line-height: 16px;
    width: 100%;
    max-width: 300px;
    color: #ffffff;
    padding: 16px;
    margin-bottom: 10px;
}
.send-invi-popup a {
    text-decoration: none;
    border: 0.419377px solid #c6c6c6;
    border-radius: 33.5501px;
    filter: drop-shadow(0px 0px 0.838753px rgba(0, 0, 0, 0.25));
    font-family: "Mulish";
    font-style: normal;
    font-weight: 500;
    font-size: 12.5813px;
    line-height: 16px;
    padding: 16px;
    width: 100%;
    max-width: 300px;
    display: block;
    color: #6d6666;
    text-align: center;
    margin-bottom: 2em;
}
.add-family-button {
    display: flex;
    justify-content: center;
    margin: 15px 0;
}
.add-family-button > button {
    outline: none;
    border: none;
    font-family: "Poppins", sans-serif;
    font-style: normal;
    font-weight: 400;
    font-size: 11px;
    line-height: 16px;
    /* identical to box height */
    padding: 12px 16px;
    background: #c4456f;
    border-radius: 5px;
    color: #ffffff;
}
.hide-img {
    display: none;
}
.guest-shortlisted-list-head > span,
.guest-shortlisted-list-content > span:nth-child(1),
.guest-shortlisted-list-content > span:nth-child(2) {
    white-space: nowrap;
    text-overflow: ellipsis;
    overflow: hidden;
}
.hide-text {
    font-family: "Poppins", sans-serif;
    font-style: normal;
    font-weight: 900;
    font-size: 13px;
    line-height: 12px;
    display: none;
    color: #d2d2d2;
    width: 100%;
    margin-bottom: 0;
}
.sort-cont {
    position: absolute;
    background: #ffffff;
    box-shadow: 0px 3.65812px 7.31624px rgba(0, 0, 0, 0.25);
    right: 0;
    z-index: 99999;
}
.sort-location,
.sort-relation {
    padding: 13px;
}
.sort-location input,
.sort-relation input {
    margin-right: 10px;
}
.sort-location label,
.sort-relation label {
    font-family: "Inter";
    font-style: normal;
    font-weight: 600;
    font-size: 9.84112px;
    line-height: 12px;
    text-transform: capitalize;
    margin: 10px;
    padding-bottom: 5px;
    color: #6b6b6b;
    width: 90%;
    border-bottom: 0.328037px solid #cdcdcd;
}
.sort-location-search,
.sort-relation-search {
    font-family: "Inter";
    font-style: normal;
    font-weight: 600;
    font-size: 9.84112px;
    line-height: 12px;
    width: 97%;
    border: 0.546729px solid #b4b4b4;
    border-radius: 5.46729px;
    padding: 5px;
    text-transform: capitalize;

    color: #6b6b6b;
}
.guest-upload-head {
    position: relative;
}
.guest-upload-head > div:nth-child(2) {
    position: absolute;
    top: 0;
    right: 0;
}
.guest-upload-cont {
    border: 0.540636px solid #ecebeb;
    border-radius: 15.1378px;
    /* padding: 18px; */
    width: 60%;
    margin: 1.5em auto;
}
.guest-upload-form-head {
    display: flex;
    padding: 18px 18px 0 18px;
    justify-content: space-evenly;
    border-bottom: 0.540636px solid #dfdfdf;
}
.guest-upload-form-head-btn {
    font-family: "Poppins", sans-serif;
    font-style: normal;
    font-weight: 300;
    font-size: 13.9379px;
    line-height: 21px;
    width: 40%;
    text-align: center;
    padding: 10px;
    color: #d8d8d8;
}
.guest-upload-form-head-btn.active {
    color: #c4456f;
    font-weight: 600;
    border-bottom: 2px solid #c4456f;
}
.guest-upload-form-content {
    padding: 18px;
}
.upload-label-text > div:nth-child(1) {
    font-family: "Poppins", sans-serif;
    font-style: normal;
    font-weight: 800;
    font-size: 11.4928px;
    line-height: 17px;
    margin: 15px auto;
    width: max-content;
    color: #8b8b8b;
}
.upload-label-text > div:nth-child(2) {
    font-family: "Montserrat";
    font-style: normal;
    font-weight: 500;
    font-size: 9.28264px;
    line-height: 11px;
    margin-bottom: 10px;
    color: #c8c3c3;
}
.guest-upload-form-content > label {
    background: linear-gradient(180deg, #fafcff 0%, #f1f6ff 100%);
    border: 2px dashed #c8c3c3;
    width: 100%;
    text-align: center;
    padding: 2em 0;
}
.upload-label-btns > button {
    background: #c4456f;
    border-radius: 4.24279px;
    font-family: "Poppins", sans-serif;
    font-style: normal;
    font-weight: 400;
    font-size: 9.69686px;
    line-height: 15px;
    border: none;
    text-align: center;
    outline: none;
    color: #ffffff;
    padding: 10px 15px;
}
.v-enter-active {
    transition: opacity 0.5s ease;
}

.v-enter,
.v-leave-to {
    opacity: 0;
}
.guest-upload-form-content input[type="file"] {
    display: none;
}
.guest-download-btns {
    padding-top: 18px;
    display: flex;
    justify-content: space-between;
}
.guest-download-btns > a {
    border: none;
    outline: none;
    text-decoration: none;
    font-family: "Poppins", sans-serif;
    font-style: normal;
    font-weight: 300;
    font-size: 12.9753px;
    line-height: 19px;
    color: #c4456f;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 30%;
    padding: 7px;
    background: #f7e8ec;
    border-radius: 7.5689px;
}
.guest-download-btns > a > img {
    margin-right: 5px;
}

@media screen and (max-width: 1400px) {
    .guest-upload-cont {
        width: 90%;
    }
}
@media screen and (max-width: 992px) {
    .guest-download-btns {
        flex-wrap: wrap;
        justify-content: center;
    }
    .guest-download-btns > a {
        width: 70%;
        margin-bottom: 10px;
    }
    .guest-details-form-fields,
    .guest-details-ceremony-fields {
        grid-template-columns: repeat(2, 1fr);
    }
    .guest-head-details > h3:nth-child(2) {
        display: none;
    }
    .host-guest-head {
        flex-wrap: wrap;
        margin-bottom: 15px;
        align-items: center;
    }
    .guest-head-add-btns {
        order: 2;
    }
    .guest-head-details {
        order: 1;
        width: 100%;
    }
    .guest-select-sort {
        order: 3;
    }
    .guest-select-sort button, .guest-select-sort a {
        padding: 13px 14px;
    }
    .guest-details-single-view {
        flex-wrap: wrap;
        padding: 8px 4px;
    }
    .guest-details-single-view > div {
        width: 100% !important;
    }

    .guest-details-single-view > div:nth-child(4) {
        margin-top: 5px;
    }
    .host-guest-accord-head > div:nth-child(1) {
        width: 50% !important;
    }
    .host-guest-acc-single-info > span {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        margin-right: 5px;
    }
    .host-guest-acc-single-info > span:nth-child(2) {
        width: 80px;
    }
    .host-guest-acc-single-info > span:nth-child(1) {
        width: 58%;
    }
}
@media screen and (max-width: 762px) {
    .guest-details-form-fields,
    .guest-details-ceremony-fields {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    }
}
@media screen and (max-width: 768px) {
    .host-guest-acc-single-btns > span:nth-child(1) {
        display: none !important;
    }
    .host-guest-accord-head > div:nth-child(1) {
        width: 70% !important;
    }
    .hide-img,
    .hide-text {
        display: block !important;
    }
    .guest-shortlisted-list-content {
        flex-wrap: wrap;
        row-gap: 10px;
    }
    .guest-shortlisted-list-content > span:nth-child(1) {
        width: 50% !important;
    }
    .guest-shortlisted-list-content > span:nth-child(2) {
        width: 45% !important;
    }
    .guest-shortlisted-list-content > div:nth-child(4) {
        width: 100% !important;
    }
    .send-invi-popup > div:nth-child(2) > img {
        width: 40%;
    }
    .guest-upload-head > .guest-select-sort {
        position: unset !important;
        text-align: center;
    }
    .guest-upload-cont {
        width: 100%;
    }
    .guest-upload-form-head {
        padding: 18px 3px 0 3px;
    }
    .guest-upload-form-head-btn {
        width: max-content;
        font-size: 11.94521px;
        line-height: 15px;
        padding: 10px 3px;
        font-weight: 900;
    }
}
</style>




