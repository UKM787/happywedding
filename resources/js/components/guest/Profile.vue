<template>
    <div>
        <div v-if="showForm == false" class="profile-view-cont cotainer-md">
            <h1>Profile Details</h1>
            <div class="profile-view-details">
                <div>
                    <div v-if="cexist == 1" class="left-details">
                        <div class="name-age-gender">
                            <span v-if="guestProfile?.name">{{
                                guestProfile?.name
                            }}</span>
                            <span v-if="guestProfile?.age">{{
                                guestProfile?.age
                            }}</span>
                            <span v-if="guestProfile?.gender">{{
                                guestProfile?.gender
                            }}</span>
                        </div>
                        <div class="contact-details">
                            <h3>Contact Details:</h3>
                            <p v-if="guestProfile?.email">
                                {{ guestProfile?.email }}
                            </p>
                        </div>
                        <div class="contact-phone">
                            <img src="/assets/phoneblue.svg" alt="" />
                            <a
                                v-if="guestProfile?.mobile"
                                href="tel:+91837423849"
                                >+91 {{ guestProfile?.mobile }}</a
                            >
                            <a
                                v-if="guestProfile?.mobile1"
                                href="tel:+913942030239"
                                >+91 {{ guestProfile?.mobile1 }}</a
                            >
                        </div>
                    </div>
                    <div
                        v-else
                        class="left-details"
                        style="margin-bottom: 10px"
                    >
                        <h1 class="address-head">Personal Details:</h1>
                        <p class="address-mid">No details added!</p>
                    </div>
                    <div class="right-details">
                        <span v-if="guestProfile?.relation">{{
                            guestProfile?.relation
                        }}</span>
                        <img
                            @click="
                                toggleForm('company-details', false);
                                personalfileOpen = false;
                            "
                            src="/assets/miscellenous/Frame-929.svg"
                            alt=""
                        />
                    </div>
                </div>
                <div>
                    <div class="left-details" style="margin: 15px 0">
                        <h1 class="address-head">Home Details:</h1>
                        <p v-if="exist == 1" class="address-mid">
                            {{ guestHome?.doorNo }}
                            {{ guestHome?.floorNo }}
                            {{ guestHome?.area }}, {{ guestHome?.complexName }},
                            {{ guestHome?.district }},
                            {{ guestHome?.state }}
                            {{ guestHome?.pin }}
                        </p>
                        <p v-else class="address-mid">No details added!</p>
                        <p v-if="exist == 1" class="address-end">
                            Map Location:
                            <a href="">{{ guestHome?.reachus }}</a>
                        </p>
                    </div>
                    <div class="right-details">
                        <img
                            @click="
                                toggleForm('guest-details', false);
                                personalfileOpen = true;
                            "
                            src="/assets/miscellenous/Frame-929.svg"
                            alt=""
                        />
                    </div>
                </div>
                <div>
                    <div class="left-details" style="margin: 15px 0">
                        <h1 class="address-head">Office Details:</h1>
                        <p v-if="oexist == 1" class="address-mid">
                            {{ guestOffice?.officedoorNo }}
                            {{ guestOffice?.officefloorNo }}
                            {{ guestOffice?.officearea }},
                            {{ guestOffice?.officecomplexName }},
                            {{ guestOffice?.officedistrict }},
                            {{ guestOffice?.officestate }}
                            {{ guestOffice?.officepin }}
                        </p>
                        <p v-else class="address-mid">No details added!</p>
                        <p v-if="oexist == 1" class="address-end">
                            Map Location:
                            <a href="">{{ guestOffice?.officereachus }}</a>
                        </p>
                    </div>
                    <div class="right-details">
                        <img
                            @click="
                                toggleForm('office-details', false);
                                personalfileOpen = true;
                            "
                            src="/assets/miscellenous/Frame-929.svg"
                            alt=""
                        />
                    </div>
                </div>
                <div>
                    <div v-if="familyList.length > 0" class="left-details">
                        <div class="contact-details">
                            <h3>Family Details:</h3>
                        </div>
                        <div
                            v-for="(item, index) in familyList"
                            :key="index"
                            style="margin-bottom: 20px"
                        >
                            <div class="name-age-gender">
                                <span v-if="item?.familyname">{{
                                    item?.familyname
                                }}</span>
                                <span v-if="item?.familyage">{{
                                    item?.familyage
                                }}</span>
                                <span v-if="item?.familygender">{{
                                    item?.familygender
                                }}</span>
                                <span
                                    class="fam-rel"
                                    style="
                                        margin-left: 15px;
                                        display: inline-block;
                                    "
                                    v-if="item?.familyrelation"
                                    >{{ item?.familyrelation }}</span
                                >
                            </div>
                            <div class="contact-details">
                                <h3>Contact Details:</h3>
                            </div>
                            <div class="contact-phone">
                                <img src="/assets/phoneblue.svg" alt="" />
                                <a
                                    v-if="item?.familymobile"
                                    href="tel:+91837423849"
                                    >+91 {{ item?.familymobile }}</a
                                >
                            </div>
                        </div>
                    </div>
                    <div
                        v-else
                        class="left-details"
                        style="margin-bottom: 10px"
                    >
                        <h1 class="address-head">Family Details:</h1>
                        <p class="address-mid">No members added!</p>
                    </div>
                    <div class="right-details">
                        <img
                            @click="
                                toggleForm('family-details', false);
                                personalfileOpen = false;
                            "
                            src="/assets/miscellenous/Frame-929.svg"
                            alt=""
                        />
                    </div>
                </div>
            </div>
        </div>
        <div v-else class="container ven-profile-form">
            <div class="row">
                <h2 id="ven-profile-form-head">PROFILE</h2>

                <div class="guest-logo-upload">
                    <label v-if="!personalfileOpen" for="company-logo">
                        <img
                            v-if="companyPicPreview"
                            :src="companyPicPreview"
                            alt=""
                        />
                        <img
                            v-else-if="
                                guestProfile.imageOne ==
                                '/guests/guestDefault.png'
                            "
                            :src="'/storage' + guestProfile.imageOne"
                            alt=""
                        />
                        <img
                            v-else-if="guestProfile.imageOne"
                            :src="
                                '/assets/guests/uploads/' +
                                guestProfile.imageOne
                            "
                            alt=""
                        />
                        <img
                            v-else
                            src="/assets/vendors/dashboard/ven-logo-upload.png"
                            alt=""
                        />
                        <span
                            v-if="errors && errors.companyimg"
                            class="errMsg"
                            >{{ errors.companyimg[0] }}</span
                        >
                    </label>
                </div>
            </div>
            <div :class="[loader ? 'blur row about' : 'row about']">
                <div class="btn-container">
                    <button
                        type="button"
                        class="tab-btn active"
                        data-id="company-details"
                        title="Personal Profile"
                        @click="
                            toggleForm($event, true);
                            personalfileOpen = false;
                        "
                    ></button>
                    <button
                        type="button"
                        class="tab-btn"
                        data-id="guest-details"
                        title="Home Profile"
                        @click="
                            toggleForm($event, true);
                            personalfileOpen = true;
                        "
                    ></button>
                    <button
                        type="button"
                        class="tab-btn"
                        data-id="office-details"
                        title="Office Profile"
                        @click="
                            toggleForm($event, true);
                            personalfileOpen = true;
                        "
                    ></button>
                    <button
                        type="button"
                        class="tab-btn"
                        data-id="family-details"
                        title="Family Profile"
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
                        <h1><span v-if="cedit">Edit</span> Personal details</h1>
                        <div style="display: flex; justify-content: flex-end">
                            <button
                                v-if="
                                    exist == 1 ||
                                    cexist == 1 ||
                                    oexist == 1 ||
                                    fexist == 1
                                "
                                @click="showForm = false"
                                style="
                                    outline: none;
                                    border: none;
                                    padding: 0;
                                    margin-bottom: 10px;
                                    margin-right: 20px;
                                    width: 44px;
                                    border-radius: 3px;
                                    background-color: #fff3f7;
                                "
                                type="button"
                            >
                                <img
                                    class="filter-pink"
                                    src="/assets/ideas/Group1702.svg"
                                    alt=""
                                />
                            </button>
                            <a
                                style="
                                    margin-bottom: 10px;
                                    margin-right: 20px;
                                    text-decoration: none;
                                "
                                :href="'/guest/' + routeSlug + '/welcome'"
                                data-id="office-details"
                                type="button"
                            >
                                <img
                                    src="/assets/miscellenous/Frame-930.svg"
                                    alt=""
                                />
                            </a>
                        </div>
                        <div class="guest-details-form-fields">
                            <div
                                class="form-group"
                                :class="{
                                    'form-group--error':
                                        $v.guestProfile.name.$error,
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
                                            $v.guestProfile.name.$model
                                        "
                                    />
                                    <span
                                        v-if="errors && errors.name"
                                        class="errMsg"
                                        >{{ errors.name[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.guestProfile.name"
                                        :validation="[
                                            'required',
                                            'minLength',
                                            'maxLength',
                                            'alpha',
                                        ]"
                                    ></vue-validation>
                                </label>
                            </div>
                            <div
                                class="form-group"
                                :class="{
                                    'form-group--error':
                                        $v.guestProfile.fatherName.$error,
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
                                            $v.guestProfile.fatherName.$model
                                        "
                                    />
                                    <span
                                        v-if="errors && errors.fatherName"
                                        class="errMsg"
                                        >{{ errors.fatherName[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.guestProfile.fatherName"
                                        :validation="[
                                            'minLength',
                                            'maxLength',
                                            'alpha',
                                        ]"
                                    ></vue-validation>
                                </label>
                            </div>
                            <div
                                class="form-group"
                                :class="{
                                    'form-group--error':
                                        $v.guestProfile.surname.$error,
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
                                            $v.guestProfile.surname.$model
                                        "
                                    />
                                    <span
                                        v-if="errors && errors.surname"
                                        class="errMsg"
                                        >{{ errors.surname[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.guestProfile.surname"
                                        :validation="['minLength', 'alpha']"
                                    ></vue-validation>
                                </label>
                            </div>
                            <div
                                class="form-group"
                                :class="{
                                    'form-group--error':
                                        $v.guestProfile.age.$error,
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
                                            $v.guestProfile.age.$model
                                        "
                                    />
                                    <span
                                        v-if="errors && errors.age"
                                        class="errMsg"
                                        >{{ errors.age[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.guestProfile.age"
                                        :validation="['maxLength', 'numeric']"
                                    ></vue-validation>
                                </label>
                            </div>
                            <div
                                class="form-group"
                                :class="{
                                    'form-group--error':
                                        $v.guestProfile.gender.$error,
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
                                                $v.guestProfile.gender.$model
                                            "
                                        />
                                        <label for="male">Male</label>
                                        <input
                                            type="radio"
                                            id="female"
                                            value="female"
                                            v-model.trim="
                                                $v.guestProfile.gender.$model
                                            "
                                        />
                                        <label for="female">Female</label>
                                    </div>
                                    <span
                                        v-if="errors && errors.gender"
                                        class="errMsg"
                                        >{{ errors.gender[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.guestProfile.gender"
                                        :validation="[]"
                                    ></vue-validation>
                                </label>
                            </div>
                            <div
                                class="form-group"
                                :class="{
                                    'form-group--error':
                                        $v.guestProfile.relation.$error,
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
                                            $v.guestProfile.relation.$model
                                        "
                                    />
                                    <span
                                        v-if="errors && errors.relation"
                                        class="errMsg"
                                        >{{ errors.relation[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.guestProfile.relation"
                                        :validation="['minLength', 'alpha']"
                                    ></vue-validation>
                                </label>
                            </div>
                            <div
                                class="form-group"
                                :class="{
                                    'form-group--error':
                                        $v.guestProfile.email.$error,
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
                                            $v.guestProfile.email.$model
                                        "
                                    />
                                    <span
                                        v-if="errors && errors.email"
                                        class="errMsg"
                                        >{{ errors.email[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.guestProfile.email"
                                        :validation="['required', 'email']"
                                    ></vue-validation>
                                </label>
                            </div>
                            <div
                                class="form-group"
                                :class="{
                                    'form-group--error':
                                        $v.guestProfile.phone.$error,
                                }"
                            >
                                <label for="phone">
                                    Phone
                                    <input
                                        type="number"
                                        name="phone"
                                        id="phone"
                                        placeholder="Enter your phone"
                                        v-model.trim="
                                            $v.guestProfile.phone.$model
                                        "
                                    />
                                    <span
                                        v-if="errors && errors.phone"
                                        class="errMsg"
                                        >{{ errors.phone[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.guestProfile.phone"
                                        :validation="[
                                            'digits_validate',
                                            'numeric',
                                        ]"
                                    ></vue-validation>
                                </label>
                            </div>
                            <div
                                class="form-group"
                                :class="{
                                    'form-group--error':
                                        $v.guestProfile.mobile.$error,
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
                                            $v.guestProfile.mobile.$model
                                        "
                                    />
                                    <span
                                        v-if="errors && errors.mobile"
                                        class="errMsg"
                                        >{{ errors.mobile[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.guestProfile.mobile"
                                        :validation="[
                                            'required',
                                            'digits_validate',
                                            'numeric',
                                        ]"
                                    ></vue-validation>
                                </label>
                            </div>
                            <div
                                class="form-group"
                                :class="{
                                    'form-group--error':
                                        $v.guestProfile.mobile1.$error,
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
                                            $v.guestProfile.mobile1.$model
                                        "
                                    />
                                    <span
                                        v-if="errors && errors.mobile1"
                                        class="errMsg"
                                        >{{ errors.mobile1[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.guestProfile.mobile1"
                                        :validation="[
                                            'digits_validate',
                                            'numeric',
                                        ]"
                                    ></vue-validation>
                                </label>
                            </div>
                            <div
                                class="form-group"
                                :class="{
                                    'form-group--error':
                                        $v.guestProfile.whatsup.$error,
                                }"
                            >
                                <label for="whatsup">
                                    Whatsup
                                    <input
                                        type="number"
                                        name="whatsup"
                                        id="whatsup"
                                        placeholder="Enter your whatsapp"
                                        v-model.trim="
                                            $v.guestProfile.whatsup.$model
                                        "
                                    />
                                    <span
                                        v-if="errors && errors.whatsup"
                                        class="errMsg"
                                        >{{ errors.whatsup[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.guestProfile.whatsup"
                                        :validation="[
                                            'digits_validate',
                                            'numeric',
                                        ]"
                                    ></vue-validation>
                                </label>
                            </div>
                        </div>

                        <div class="ven-profile-form-submit">
                            <button
                                v-if="cexist != '1'"
                                :disabled="cprofileDisabled"
                                data-id="guest-categories"
                                id="submitPprofile"
                            >
                                Submit
                            </button>
                            <button
                                v-else
                                @click="cedit = true"
                                id="submitPprofile"
                                :disabled="cprofileDisabled"
                                type="submit"
                            >
                                Update
                            </button>
                            <button
                                data-id="guest-details"
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
                        id="guest-details"
                        data-id="company-details"
                    >
                        <!-- <input
                            v-show="personalfileOpen"
                            type="file"
                            id="guest-logo"
                            name="guest-logo"
                            required
                            style="
                                left: 42%;
                                position: absolute;
                                top: 13%;
                                opacity: 0;
                            "
                            @change="uploadImg($event, 'profile')"
                        /> -->
                        <h1><span v-if="pedit">Edit</span> Home details</h1>
                        <div style="display: flex; justify-content: flex-end">
                            <button
                                v-if="
                                    exist == 1 ||
                                    cexist == 1 ||
                                    oexist == 1 ||
                                    fexist == 1
                                "
                                @click="showForm = false"
                                style="
                                    outline: none;
                                    border: none;
                                    margin-bottom: 10px;
                                    margin-right: 20px;
                                    padding: 0;
                                    width: 44px;
                                    border-radius: 3px;
                                    background-color: #fff3f7;
                                "
                                type="button"
                            >
                                <img
                                    class="filter-pink"
                                    src="/assets/ideas/Group1702.svg"
                                    alt=""
                                />
                            </button>
                            <a
                                style="
                                    margin-bottom: 10px;
                                    margin-right: 20px;
                                    text-decoration: none;
                                "
                                :href="'/guest/' + routeSlug + '/welcome'"
                                data-id="office-details"
                                type="button"
                            >
                                <img
                                    src="/assets/miscellenous/Frame-930.svg"
                                    alt=""
                                />
                            </a>
                        </div>
                        <div class="guest-details-form-fields">
                            <div
                                class="form-group"
                                :class="{
                                    'form-group--error':
                                        $v.guestHome.complexName.$error,
                                }"
                            >
                                <label for="guestcomplexName">
                                    Complex Name
                                    <input
                                        type="text"
                                        name="complexName"
                                        id="guestcomplexName"
                                        placeholder="Enter your complex name"
                                        v-model.trim="
                                            $v.guestHome.complexName.$model
                                        "
                                    />
                                    <span
                                        v-if="errors && errors.complexName"
                                        class="errMsg"
                                        >{{ errors.complexName[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.guestHome.complexName"
                                        :validation="[
                                            'required',
                                            'minLength',
                                            'alpha',
                                        ]"
                                    ></vue-validation>
                                </label>
                            </div>
                            <div
                                :class="{
                                    'form-group--error':
                                        $v.guestHome.floor.$error,
                                }"
                            >
                                <label for="guestfloor">
                                    Floor
                                    <input
                                        type="text"
                                        name="floor"
                                        id="guestfloor"
                                        placeholder="Enter your floor"
                                        v-model.trim="$v.guestHome.floor.$model"
                                    />
                                    <span
                                        v-if="errors && errors.floor"
                                        class="errMsg"
                                        >{{ errors.floor[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.guestHome.floor"
                                        :validation="['required', 'minLength']"
                                    ></vue-validation>
                                </label>
                            </div>
                            <div
                                class="form-group"
                                :class="{
                                    'form-group--error':
                                        $v.guestHome.doorNo.$error,
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
                                            $v.guestHome.doorNo.$model
                                        "
                                    />
                                    <span
                                        v-if="errors && errors.doorNo"
                                        class="errMsg"
                                        >{{ errors.doorNo[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.guestHome.doorNo"
                                        :validation="[
                                            'required',
                                            'minLength',
                                            'numeric',
                                        ]"
                                    ></vue-validation>
                                </label>
                            </div>
                            <div
                                class="form-group"
                                :class="{
                                    'form-group--error':
                                        $v.guestHome.streetNo.$error,
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
                                            $v.guestHome.streetNo.$model
                                        "
                                    />
                                    <span
                                        v-if="errors && errors.streetNo"
                                        class="errMsg"
                                        >{{ errors.streetNo[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.guestHome.streetNo"
                                        :validation="['required', 'minLength']"
                                    ></vue-validation>
                                </label>
                            </div>
                            <div
                                class="form-group"
                                :class="{
                                    'form-group--error':
                                        $v.guestHome.area.$error,
                                }"
                            >
                                <label for="guestarea">
                                    Area
                                    <input
                                        type="text"
                                        name="area"
                                        id="guestarea"
                                        placeholder="Enter your area"
                                        v-model.trim="$v.guestHome.area.$model"
                                    />
                                    <span
                                        v-if="errors && errors.area"
                                        class="errMsg"
                                        >{{ errors.area[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.guestHome.area"
                                        :validation="[
                                            'required',
                                            'minLength',
                                            'alpha',
                                        ]"
                                    ></vue-validation>
                                </label>
                            </div>
                            <div
                                class="form-group"
                                :class="{
                                    'form-group--error':
                                        $v.guestHome.district.$error,
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
                                            $v.guestHome.district.$model
                                        "
                                    />
                                    <span
                                        v-if="errors && errors.district"
                                        class="errMsg"
                                        >{{ errors.district[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.guestHome.district"
                                        :validation="[
                                            'required',
                                            'minLength',
                                            'alpha',
                                        ]"
                                    ></vue-validation>
                                </label>
                            </div>
                            <div
                                class="form-group"
                                :class="{
                                    'form-group--error':
                                        $v.guestHome.pin.$error,
                                }"
                            >
                                <label for="guestpin">
                                    Pin
                                    <input
                                        type="text"
                                        name="pin"
                                        id="guestpin"
                                        placeholder="Enter your pin"
                                        v-model.trim="$v.guestHome.pin.$model"
                                    />
                                    <span
                                        v-if="errors && errors.pin"
                                        class="errMsg"
                                        >{{ errors.pin[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.guestHome.pin"
                                        :validation="[
                                            'required',
                                            'maxLength',
                                            'numeric',
                                        ]"
                                    ></vue-validation>
                                </label>
                            </div>
                            <div
                                class="form-group"
                                :class="{
                                    'form-group--error':
                                        $v.guestHome.state.$error,
                                }"
                            >
                                <label for="gueststate">
                                    State
                                    <input
                                        type="text"
                                        name="state"
                                        id="gueststate"
                                        placeholder="Enter your state"
                                        v-model.trim="$v.guestHome.state.$model"
                                    />
                                    <span
                                        v-if="errors && errors.state"
                                        class="errMsg"
                                        >{{ errors.state[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.guestHome.state"
                                        :validation="[
                                            'required',
                                            'minLength',
                                            'alpha',
                                        ]"
                                    ></vue-validation>
                                </label>
                            </div>
                            <div
                                class="form-group"
                                :class="{
                                    'form-group--error':
                                        $v.guestHome.zone.$error,
                                }"
                            >
                                <label for="guestzone">
                                    Zone
                                    <input
                                        type="text"
                                        name="zone"
                                        id="guestzone"
                                        placeholder="Enter your zone"
                                        v-model.trim="$v.guestHome.zone.$model"
                                    />
                                    <span
                                        v-if="errors && errors.zone"
                                        class="errMsg"
                                        >{{ errors.zone[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.guestHome.zone"
                                        :validation="[
                                            'required',
                                            'minLength',
                                            'alpha',
                                        ]"
                                    ></vue-validation>
                                </label>
                            </div>
                            <div
                                class="form-group"
                                :class="{
                                    'form-group--error':
                                        $v.guestHome.country.$error,
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
                                            $v.guestHome.country.$model
                                        "
                                    />
                                    <span
                                        v-if="errors && errors.country"
                                        class="errMsg"
                                        >{{ errors.country[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.guestHome.country"
                                        :validation="[
                                            'required',
                                            'minLength',
                                            'alpha',
                                        ]"
                                    ></vue-validation>
                                </label>
                            </div>
                            <div
                                class="form-group"
                                :class="{
                                    'form-group--error':
                                        $v.guestHome.reachus.$error,
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
                                            $v.guestHome.reachus.$model
                                        "
                                    />
                                    <span
                                        v-if="errors && errors.reachus"
                                        class="errMsg"
                                        >{{ errors.reachus[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.guestHome.reachus"
                                        :validation="['required', 'url']"
                                    ></vue-validation>
                                </label>
                            </div>
                        </div>

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
                                @click="pedit = true"
                                id="pprofilebtn"
                                :disabled="pprofileDisabled"
                                type="submit"
                            >
                                Update
                            </button>
                            <button
                                data-id="office-details"
                                @click="toggleForm($event, true)"
                                type="button"
                            >
                                <img src="/assets/vendors/Frame.svg" alt="" />
                            </button>
                        </div>
                    </form>
                    <form
                        @submit.prevent="submitOProfile($event)"
                        class="content"
                        id="office-details"
                    >
                        <!-- <input
                            v-show="personalfileOpen"
                            type="file"
                            id="guest-logo"
                            name="guest-logo"
                            required
                            style="
                                left: 42%;
                                position: absolute;
                                top: 13%;
                                opacity: 0;
                            "
                            @change="uploadImg($event, 'profile')"
                        /> -->
                        <h1><span v-if="oedit">Edit</span> Office details</h1>
                        <div style="display: flex; justify-content: flex-end">
                            <button
                                v-if="
                                    exist == 1 ||
                                    cexist == 1 ||
                                    oexist == 1 ||
                                    fexist == 1
                                "
                                @click="showForm = false"
                                style="
                                    outline: none;
                                    border: none;
                                    margin-bottom: 10px;
                                    margin-right: 20px;
                                    padding: 0;
                                    width: 44px;
                                    border-radius: 3px;
                                    background-color: #fff3f7;
                                "
                                type="button"
                            >
                                <img
                                    class="filter-pink"
                                    src="/assets/ideas/Group1702.svg"
                                    alt=""
                                />
                            </button>
                            <a
                                style="
                                    margin-bottom: 10px;
                                    margin-right: 20px;
                                    text-decoration: none;
                                "
                                :href="'/guest/' + routeSlug + '/welcome'"
                                data-id="office-details"
                                type="button"
                            >
                                <img
                                    src="/assets/miscellenous/Frame-930.svg"
                                    alt=""
                                />
                            </a>
                        </div>
                        <div class="guest-details-form-fields">
                            <div
                                class="form-group"
                                :class="{
                                    'form-group--error':
                                        $v.guestOffice.officecompanyName.$error,
                                }"
                            >
                                <label for="guestofficecompanyName">
                                    Company Name
                                    <input
                                        type="text"
                                        name="officecompanyName"
                                        id="guestofficecompanyName"
                                        placeholder="Enter your company name"
                                        v-model.trim="
                                            $v.guestOffice.officecompanyName
                                                .$model
                                        "
                                    />
                                    <span
                                        v-if="
                                            errors && errors.officecompanyName
                                        "
                                        class="errMsg"
                                        >{{ errors.officecompanyName[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="
                                            $v.guestOffice.officecompanyName
                                        "
                                        :validation="[
                                            'required',
                                            'minLength',
                                            'alpha_num',
                                        ]"
                                    ></vue-validation>
                                </label>
                            </div>
                            <div
                                class="form-group"
                                :class="{
                                    'form-group--error':
                                        $v.guestOffice.officecomplexName.$error,
                                }"
                            >
                                <label for="guestofficecomplexName">
                                    Complex Name
                                    <input
                                        type="text"
                                        name="officecomplexName"
                                        id="guestofficecomplexName"
                                        placeholder="Enter your company complex name"
                                        v-model.trim="
                                            $v.guestOffice.officecomplexName
                                                .$model
                                        "
                                    />
                                    <span
                                        v-if="
                                            errors && errors.officecomplexName
                                        "
                                        class="errMsg"
                                        >{{ errors.officecomplexName[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="
                                            $v.guestOffice.officecomplexName
                                        "
                                        :validation="[
                                            'required',
                                            'minLength',
                                            'alpha_num',
                                        ]"
                                    ></vue-validation>
                                </label>
                            </div>
                            <div
                                class="form-group"
                                :class="{
                                    'form-group--error':
                                        $v.guestOffice.officefloor.$error,
                                }"
                            >
                                <label for="guestofficefloor">
                                    Floor
                                    <input
                                        type="text"
                                        name="officefloor"
                                        id="guestofficefloor"
                                        placeholder="Enter your company floor"
                                        v-model.trim="
                                            $v.guestOffice.officefloor.$model
                                        "
                                    />
                                    <span
                                        v-if="errors && errors.officefloor"
                                        class="errMsg"
                                        >{{ errors.officefloor[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.guestOffice.officefloor"
                                        :validation="['required', 'minLength']"
                                    ></vue-validation>
                                </label>
                            </div>
                            <div
                                class="form-group"
                                :class="{
                                    'form-group--error':
                                        $v.guestOffice.officedoorNo.$error,
                                }"
                            >
                                <label for="guestofficedoorNo">
                                    Door No
                                    <input
                                        type="text"
                                        name="officedoorNo"
                                        id="guestofficedoorNo"
                                        placeholder="Enter your company door no"
                                        v-model.trim="
                                            $v.guestOffice.officedoorNo.$model
                                        "
                                    />
                                    <span
                                        v-if="errors && errors.officedoorNo"
                                        class="errMsg"
                                        >{{ errors.officedoorNo[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="
                                            $v.guestOffice.officedoorNo
                                        "
                                        :validation="[
                                            'required',
                                            'minLength',
                                            'numeric',
                                        ]"
                                    ></vue-validation>
                                </label>
                            </div>
                            <div
                                class="form-group"
                                :class="{
                                    'form-group--error':
                                        $v.guestOffice.officestreetNo.$error,
                                }"
                            >
                                <label for="guestofficestreetNo">
                                    Street Name/No
                                    <input
                                        type="text"
                                        name="officestreetNo"
                                        id="guestofficestreetNo"
                                        placeholder="Enter your company street no"
                                        v-model.trim="
                                            $v.guestOffice.officestreetNo.$model
                                        "
                                    />
                                    <span
                                        v-if="errors && errors.officestreetNo"
                                        class="errMsg"
                                        >{{ errors.officestreetNo[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="
                                            $v.guestOffice.officestreetNo
                                        "
                                        :validation="['required', 'minLength']"
                                    ></vue-validation>
                                </label>
                            </div>
                            <div
                                class="form-group"
                                :class="{
                                    'form-group--error':
                                        $v.guestOffice.officearea.$error,
                                }"
                            >
                                <label for="guestofficearea">
                                    Area
                                    <input
                                        type="text"
                                        name="officearea"
                                        id="guestoofficearea"
                                        placeholder="Enter your company area"
                                        v-model.trim="
                                            $v.guestOffice.officearea.$model
                                        "
                                    />
                                    <span
                                        v-if="errors && errors.officearea"
                                        class="errMsg"
                                        >{{ errors.officearea[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.guestOffice.officearea"
                                        :validation="[
                                            'required',
                                            'minLength',
                                            'alpha',
                                        ]"
                                    ></vue-validation>
                                </label>
                            </div>
                            <div
                                class="form-group"
                                :class="{
                                    'form-group--error':
                                        $v.guestOffice.officedistrict.$error,
                                }"
                            >
                                <label for="guestofficedistrict">
                                    District
                                    <input
                                        type="text"
                                        name="officedistrict"
                                        id="guestofficedistrict"
                                        placeholder="Enter your company district"
                                        v-model.trim="
                                            $v.guestOffice.officedistrict.$model
                                        "
                                    />
                                    <span
                                        v-if="errors && errors.officedistrict"
                                        class="errMsg"
                                        >{{ errors.officedistrict[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="
                                            $v.guestOffice.officedistrict
                                        "
                                        :validation="[
                                            'required',
                                            'minLength',
                                            'alpha',
                                        ]"
                                    ></vue-validation>
                                </label>
                            </div>
                            <div
                                class="form-group"
                                :class="{
                                    'form-group--error':
                                        $v.guestOffice.officepin.$error,
                                }"
                            >
                                <label for="guestofficepint">
                                    Pin
                                    <input
                                        type="text"
                                        name="officepin"
                                        id="guestofficepin"
                                        placeholder="Enter your company pin"
                                        v-model.trim="
                                            $v.guestOffice.officepin.$model
                                        "
                                    />
                                    <span
                                        v-if="errors && errors.officepin"
                                        class="errMsg"
                                        >{{ errors.officepin[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.guestOffice.officepin"
                                        :validation="[
                                            'required',
                                            'maxLength',
                                            'numeric',
                                        ]"
                                    ></vue-validation>
                                </label>
                            </div>
                            <div
                                class="form-group"
                                :class="{
                                    'form-group--error':
                                        $v.guestOffice.officestate.$error,
                                }"
                            >
                                <label for="guestofficestate">
                                    State
                                    <input
                                        type="text"
                                        name="officestate"
                                        id="guestofficestate"
                                        placeholder="Enter your company state"
                                        v-model.trim="
                                            $v.guestOffice.officestate.$model
                                        "
                                    />
                                    <span
                                        v-if="errors && errors.officestate"
                                        class="errMsg"
                                        >{{ errors.officestate[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.guestOffice.officestate"
                                        :validation="[
                                            'required',
                                            'minLength',
                                            'alpha',
                                        ]"
                                    ></vue-validation>
                                </label>
                            </div>
                            <div
                                class="form-group"
                                :class="{
                                    'form-group--error':
                                        $v.guestOffice.officezone.$error,
                                }"
                            >
                                <label for="guestofficezone">
                                    Zone
                                    <input
                                        type="text"
                                        name="officezone"
                                        id="guestofficezone"
                                        placeholder="Enter your company zone"
                                        v-model.trim="
                                            $v.guestOffice.officezone.$model
                                        "
                                    />
                                    <span
                                        v-if="errors && errors.officezone"
                                        class="errMsg"
                                        >{{ errors.officezone[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.guestOffice.officezone"
                                        :validation="[
                                            'required',
                                            'minLength',
                                            'alpha',
                                        ]"
                                    ></vue-validation>
                                </label>
                            </div>
                            <div
                                class="form-group"
                                :class="{
                                    'form-group--error':
                                        $v.guestOffice.officecountry.$error,
                                }"
                            >
                                <label for="guestofficecountry">
                                    Country
                                    <input
                                        type="text"
                                        name="officecountry"
                                        id="guestofficecountry"
                                        placeholder="Enter your company country"
                                        v-model.trim="
                                            $v.guestOffice.officecountry.$model
                                        "
                                    />
                                    <span
                                        v-if="errors && errors.officecountry"
                                        class="errMsg"
                                        >{{ errors.officecountry[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="
                                            $v.guestOffice.officecountry
                                        "
                                        :validation="[
                                            'required',
                                            'minLength',
                                            'alpha',
                                        ]"
                                    ></vue-validation>
                                </label>
                            </div>
                            <div
                                class="form-group"
                                :class="{
                                    'form-group--error':
                                        $v.guestOffice.officereachus.$error,
                                }"
                            >
                                <label for="guestofficereachus">
                                    Map Location
                                    <input
                                        type="text"
                                        name="officereachus"
                                        id="guestofficereachus"
                                        placeholder="Enter your company Map location"
                                        v-model.trim="
                                            $v.guestOffice.officereachus.$model
                                        "
                                    />
                                    <span
                                        v-if="errors && errors.officereachus"
                                        class="errMsg"
                                        >{{ errors.officereachus[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="
                                            $v.guestOffice.officereachus
                                        "
                                        :validation="['required', 'url']"
                                    ></vue-validation>
                                </label>
                            </div>
                        </div>

                        <div class="ven-profile-form-submit">
                            <button
                                v-if="oexist != '1'"
                                id="oprofilebtn"
                                :disabled="oprofileDisabled"
                                type="submit"
                            >
                                Submit
                            </button>
                            <button
                                v-else
                                @click="oedit = true"
                                id="oprofilebtn"
                                :disabled="oprofileDisabled"
                                type="submit"
                            >
                                Update
                            </button>
                            <button
                                data-id="family-details"
                                @click="toggleForm($event, true)"
                                type="button"
                            >
                                <img src="/assets/vendors/Frame.svg" alt="" />
                            </button>
                        </div>
                    </form>
                    <form
                        @submit.prevent="submitFProfile($event)"
                        class="content"
                        id="family-details"
                    >
                        <h1>Family details</h1>
                        <div style="display: flex; justify-content: flex-end">
                            <button
                                @click="editFamilyForm($event, 'new')"
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
                                id="addClose"
                            >
                                Add
                            </button>
                            <a
                                style="
                                    outline: none;
                                    border: none;
                                    background-color: #461952;
                                    color: white;
                                    padding: 4px 20px;
                                    border-radius: 10px;
                                    margin-bottom: 10px;
                                    margin-right: 20px;
                                    text-decoration: none;
                                "
                                :href="'/guest/' + routeSlug + '/welcome'"
                                data-id="office-details"
                                type="button"
                            >
                                Home <i class="fas fa-home"></i>
                            </a>
                        </div>
                        <div class="guest-details-family-form-cont">
                            <div class="guest-details-form-fields">
                                <div
                                    class="form-group"
                                    :class="{
                                        'form-group--error':
                                            $v.guestFamily.familyname.$error,
                                    }"
                                >
                                    <label for="guestfamilyname">
                                        Name
                                        <input
                                            type="text"
                                            name="guestfamilyname"
                                            id="guestfamilyname"
                                            placeholder="Enter your family member name"
                                            v-model.trim="
                                                $v.guestFamily.familyname.$model
                                            "
                                        />
                                        <span
                                            v-if="errors && errors.familyname"
                                            class="errMsg"
                                            >{{ errors.familyname[0] }}</span
                                        >
                                        <vue-validation
                                            :instance="$v"
                                            :nestedName="
                                                $v.guestFamily.familyname
                                            "
                                            :validation="[
                                                'required',
                                                'minLength',
                                                'alpha',
                                            ]"
                                        ></vue-validation>
                                    </label>
                                </div>
                                <div
                                    class="form-group"
                                    :class="{
                                        'form-group--error':
                                            $v.guestFamily.familyage.$error,
                                    }"
                                >
                                    <label for="guestfamilyage">
                                        Age
                                        <input
                                            type="text"
                                            name="guestfamilyage"
                                            id="guestfamilyage"
                                            placeholder="Enter your family member age"
                                            v-model.trim="
                                                $v.guestFamily.familyage.$model
                                            "
                                        />
                                        <span
                                            v-if="errors && errors.familyage"
                                            class="errMsg"
                                            >{{ errors.familyage[0] }}</span
                                        >
                                        <vue-validation
                                            :instance="$v"
                                            :nestedName="
                                                $v.guestFamily.familyage
                                            "
                                            :validation="[
                                                'required',
                                                'maxLength',
                                                'numeric',
                                            ]"
                                        ></vue-validation>
                                    </label>
                                </div>
                                <div
                                    class="form-group"
                                    :class="{
                                        'form-group--error':
                                            $v.guestFamily.familygender.$error,
                                    }"
                                >
                                    <label for="guestfamilygender">
                                        Gender
                                        <div>
                                            <input
                                                type="radio"
                                                id="male"
                                                value="male"
                                                v-model.trim="
                                                    $v.guestFamily.familygender
                                                        .$model
                                                "
                                            />
                                            <label for="male">Male</label>
                                            <input
                                                type="radio"
                                                id="female"
                                                value="female"
                                                v-model.trim="
                                                    $v.guestFamily.familygender
                                                        .$model
                                                "
                                            />
                                            <label for="female">Female</label>
                                        </div>
                                        <span
                                            v-if="errors && errors.familygender"
                                            class="errMsg"
                                            >{{ errors.familygender[0] }}</span
                                        >
                                        <vue-validation
                                            :instance="$v"
                                            :nestedName="
                                                $v.guestFamily.familygender
                                            "
                                            :validation="['required']"
                                        ></vue-validation>
                                    </label>
                                </div>
                                <div
                                    class="form-group"
                                    :class="{
                                        'form-group--error':
                                            $v.guestFamily.familyrelation
                                                .$error,
                                    }"
                                >
                                    <label for="guestfamilyrelation">
                                        Relation
                                        <select
                                            v-model.trim="
                                                $v.guestFamily.familyrelation
                                                    .$model
                                            "
                                            id="guestfamilyrelation"
                                            required
                                        >
                                            <option
                                                disabled
                                                selected
                                                value="null"
                                            >
                                                Select Relation
                                            </option>
                                            <option
                                                v-for="(item, index) in famRel"
                                                :key="index"
                                                :value="item"
                                            >
                                                {{ item }}
                                            </option>
                                        </select>
                                        <span
                                            v-if="
                                                errors && errors.familyrelation
                                            "
                                            class="errMsg"
                                            >{{
                                                errors.familyrelation[0]
                                            }}</span
                                        >
                                        <vue-validation
                                            :instance="$v"
                                            :nestedName="
                                                $v.guestFamily.familyrelation
                                            "
                                            :validation="[
                                                'required',
                                                'minLength',
                                                'alpha',
                                            ]"
                                        ></vue-validation>
                                    </label>
                                </div>
                                <div
                                    class="form-group"
                                    :class="{
                                        'form-group--error':
                                            $v.guestFamily.familymobile.$error,
                                    }"
                                >
                                    <label for="guestfamilymobile">
                                        Mobile
                                        <input
                                            type="text"
                                            name="guestfamilymobile"
                                            id="guestfamilymobile"
                                            placeholder="Enter your family member mobile"
                                            v-model.trim="
                                                $v.guestFamily.familymobile
                                                    .$model
                                            "
                                        />
                                        <span
                                            v-if="errors && errors.familymobile"
                                            class="errMsg"
                                            >{{ errors.familymobile[0] }}</span
                                        >
                                        <vue-validation
                                            :instance="$v"
                                            :nestedName="
                                                $v.guestFamily.familymobile
                                            "
                                            :validation="[
                                                'required',
                                                'digits_validate',
                                                'numeric',
                                            ]"
                                        ></vue-validation>
                                    </label>
                                </div>
                                <div>
                                    <label for="guestfamilyimageone">
                                        Image
                                        <input
                                            type="file"
                                            name="guestfamilyimageone"
                                            id="guestfamilyimageone"
                                            @change="
                                                uploadImg($event, 'familyOne')
                                            "
                                        />
                                        <img
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
                                        />
                                        <span
                                            v-if="
                                                errors && errors.familyimageOne
                                            "
                                            class="errMsg"
                                            >{{
                                                errors.familyimageOne[0]
                                            }}</span
                                        >
                                    </label>
                                </div>
                                <div>
                                    <label for="guestfamilyimagetwo">
                                        Image Two
                                        <input
                                            type="file"
                                            name="guestfamilyimagetwo"
                                            id="guestfamilyimagetwo"
                                            @change="
                                                uploadImg($event, 'familyTwo')
                                            "
                                        />
                                        <img
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
                                        />
                                        <span
                                            v-if="
                                                errors && errors.familyimageTwo
                                            "
                                            class="errMsg"
                                            >{{
                                                errors.familyimageTwo[0]
                                            }}</span
                                        >
                                    </label>
                                </div>
                            </div>
                            <div class="ven-profile-form-submit">
                                <button
                                    v-if="fedit == false"
                                    id="oprofilebtn"
                                    :disabled="fprofileDisabled"
                                    type="submit"
                                >
                                    Submit
                                </button>
                                <button
                                    v-else
                                    id="fprofilebtn"
                                    :disabled="fprofileDisabled"
                                    type="submit"
                                >
                                    Update
                                </button>
                            </div>
                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Age</th>
                                    <th scope="col">Gender</th>
                                    <th scope="col">Relation</th>
                                    <th scope="col">Mobile</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(item, index) in familyList"
                                    :key="index"
                                >
                                    <th scope="row">{{ index + 1 }}</th>
                                    <td>{{ item.familyname }}</td>
                                    <td>{{ item.familyage }}</td>
                                    <td>{{ item.familygender }}</td>
                                    <td>{{ item.familyrelation }}</td>
                                    <td>{{ item.familymobile }}</td>
                                    <td>{{ item.familyimageOne }}</td>
                                    <td>{{ item.familyimageTwo }}</td>
                                    <td class="edit-btn-tab">
                                        <button
                                            @click="
                                                editFamilyForm($event, index)
                                            "
                                            type="button"
                                        >
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button
                                            @click="
                                                deleteFamily($event, item.id)
                                            "
                                            type="button"
                                        >
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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
import flashMessage from "../FlashMessage.vue";
import vueValidation from "../commonComponents/VueValidation.vue";
import { helpers } from "vuelidate/lib/validators";

import {
    required,
    minLength,
    alpha,
    numeric,
    email,
    maxLength,
    url,
} from "vuelidate/lib/validators";
export default {
    components: {
        flashMessage,
        vueValidation,
    },
    props: ["guestId", "exists", "cexists", "oexists", "fexists"],
    data() {
        return {
            showForm: true,
            loader: false,
            guestProfile: {
                name: null,
                fatherName: null,
                surname: null,
                age: null,
                gender: null,
                relation: null,
                email: null,
                phone: null,
                mobile: null,
                mobile1: null,
                whatsup: null,
                guest_id: this.guestId,
            },
            guestHome: {
                complexName: null,
                floor: null,
                doorNo: null,
                streetNo: null,
                area: null,
                district: null,
                pin: null,
                state: null,
                zone: null,
                country: null,
                reachus: null,
                guest_id: this.guestId,
            },
            guestOffice: {
                officecompanyName: null,
                officecomplexName: null,
                officefloor: null,
                officedoorNo: null,
                officestreetNo: null,
                officearea: null,
                officedistrict: null,
                officepin: null,
                officestate: null,
                officezone: null,
                officecountry: null,
                officereachus: null,
                guest_id: this.guestId,
            },
            guestFamily: {
                familyname: null,
                familyage: null,
                familygender: null,
                familyrelation: null,
                familymobile: null,
                guest_id: this.guestId,
            }, /// create feilds and family memeber and change submit and update for last form to toggle to next link
            sendProfile_imageOne: null,
            guestProfile_logo: null,
            exist: this.exists,
            cexist: this.cexists,
            oexist: this.oexists,
            fexist: this.ofxists,
            profileId: null,
            companyId: null,
            officeId: null,
            guestDetails: null,
            errors: null,
            sendCategory: [],
            catId: [],
            errors: null,
            defaultCategories: null,
            locationMaster: null,
            message: null,
            cprofileDisabled: false,
            pprofileDisabled: false,
            oprofileDisabled: false,
            fprofileDisabled: false,
            pedit: false,
            cedit: false,
            oedit: false,
            fedit: false,
            personalfileOpen: false,
            profilePicPreview: null,
            companyPicPreview: null,
            profileDataSubmitted: false,
            companyDataSubmitted: false,
            familyList: [],
            familyimageOne: null,
            familyimageTwo: null,
            familyimageOnePreview: null,
            familyimageTwoPreview: null,
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
            routeSlug: null,
        };
    },
    validations: {
        guestProfile: {
            name: {
                required,
                minLength: minLength(3),
                maxLength: maxLength(16),
                alpha: helpers.regex(
                    "alpha",
                    /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/
                ),
            },
            fatherName: {
                minLength: minLength(3),
                maxLength: maxLength(16),
                alpha: helpers.regex(
                    "alpha",
                    /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/
                ),
            },
            surname: {
                minLength: minLength(3),
                alpha: helpers.regex(
                    "alpha",
                    /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/
                ),
            },
            age: {
                maxLength: maxLength(3),
                numeric,
            },
            gender: {},
            relation: {
                minLength: minLength(3),
                alpha: helpers.regex(
                    "alpha",
                    /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/
                ),
            },
            email: {
                required,
                email,
            },
            phone: {
                digits_validate: helpers.regex("digits_validate", /^\d{10}$/),
                numeric,
            },
            mobile: {
                required,
                digits_validate: helpers.regex("digits_validate", /^\d{10}$/),
                numeric,
            },
            mobile1: {
                digits_validate: helpers.regex("digits_validate", /^\d{10}$/),
                numeric,
            },
            whatsup: {
                digits_validate: helpers.regex("digits_validate", /^\d{10}$/),
                numeric,
            },
        },
        guestHome: {
            complexName: {
                required,
                minLength: minLength(3),
                alpha: helpers.regex(
                    "alpha",
                    /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/
                ),
            },
            floor: {
                required,
                minLength: minLength(1),
            },
            doorNo: {
                required,
                minLength: minLength(1),
                numeric,
            },
            streetNo: {
                required,
                minLength: minLength(3),
            },
            area: {
                required,
                minLength: minLength(3),
                alpha: helpers.regex(
                    "alpha",
                    /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/
                ),
            },
            district: {
                required,
                minLength: minLength(1),
                alpha: helpers.regex(
                    "alpha",
                    /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/
                ),
            },
            state: {
                required,
                minLength: minLength(3),
                alpha: helpers.regex(
                    "alpha",
                    /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/
                ),
            },
            pin: {
                required,
                maxLength: maxLength(6),
                numeric,
            },
            zone: {
                required,
                minLength: minLength(3),
                alpha: helpers.regex(
                    "alpha",
                    /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/
                ),
            },
            country: {
                required,
                minLength: minLength(3),
                alpha: helpers.regex(
                    "alpha",
                    /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/
                ),
            },
            reachus: { required, url },
        },
        guestOffice: {
            officecompanyName: {
                required,
                minLength: minLength(3),
                alpha_num: helpers.regex("alpha_num", /^[\w\-\s]+$/),
            },
            officecomplexName: {
                required,
                minLength: minLength(3),
                alpha_num: helpers.regex("alpha_num", /^[\w\-\s]+$/),
            },
            officefloor: {
                required,
                minLength: minLength(3),
            },
            officedoorNo: {
                required,
                minLength: minLength(1),
                numeric,
            },
            officestreetNo: {
                required,
                minLength: minLength(3),
            },
            officearea: {
                required,
                minLength: minLength(3),
                alpha: helpers.regex(
                    "alpha",
                    /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/
                ),
            },
            officedistrict: {
                required,
                minLength: minLength(3),
                alpha: helpers.regex(
                    "alpha",
                    /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/
                ),
            },
            officestate: {
                required,
                minLength: minLength(3),
                alpha: helpers.regex(
                    "alpha",
                    /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/
                ),
            },
            officepin: {
                required,
                maxLength: maxLength(6),
                numeric,
            },
            officezone: {
                required,
                minLength: minLength(3),
                alpha: helpers.regex(
                    "alpha",
                    /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/
                ),
            },
            officecountry: {
                required,
                minLength: minLength(3),
                alpha: helpers.regex(
                    "alpha",
                    /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/
                ),
            },
            officereachus: { required, url },
        },
        guestFamily: {
            familyname: {
                required,
                minLength: minLength(3),
                alpha: helpers.regex(
                    "alpha",
                    /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/
                ),
            },
            familyage: {
                required,
                maxLength: maxLength(3),
                numeric,
            },
            familygender: {
                required,
            },
            familyrelation: {
                required,
                minLength: minLength(3),
                alpha: helpers.regex(
                    "alpha",
                    /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/
                ),
            },
            familymobile: {
                required,
                digits_validate: helpers.regex("digits_validate", /^\d{10}$/),
                numeric,
            },
        },
    },
    methods: {
        checkImage(url) {
            var request = new XMLHttpRequest();
            request.open("GET", url, true);
            request.send();
            request.onload = function () {
                let status = request.status;
                if (request.status == 200) {
                    //if(statusText == OK)
                    return true;
                } else {
                    return false;
                }
            };
        },
        deleteFamily(e, id) {
            let _this = this;
            this.loader = true;
            axios
                .delete(`/api/guest/profile/${id}`)
                .then(function (response) {
                    _this.loader = false;
                    _this.message = "Deleted";
                    console.log(response.data);
                    _this.familyList = response.data;
                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                })
                .catch((error) => {
                    _this.loader = false;
                    console.log(error.response.data.errors);
                });
        },
        editFamilyForm(e, id) {
            let _this = this;
            _this.$v.guestFamily.$reset();
            if (id == "new") {
                for (const key in this.guestFamily) {
                    _this.guestFamily[key] = null;
                }

                _this.familyimageOne = null;
                _this.familyimageTwo = null;
                _this.familyimageOnePreview = null;
                _this.familyimageTwoPreview = null;
                $("#guestfamilyimagetwo").val("");
                $("#guestfamilyimageone").val("");
                _this.guestFamily.guest_id = _this.guestId;
                let txt = $("#addClose").text().trim();
                if (txt == "Add") {
                    $("#addClose").text("Close");
                }
                if (txt == "Close") {
                    $("#addClose").text("Add");
                }
                $(".guest-details-family-form-cont").slideToggle("linear");
                _this.fedit = false;
            } else {
                let txt = $("#addClose").text().trim();
                if (txt == "Add") {
                    $("#addClose").text("Close");
                }
                if (txt == "Close") {
                    $("#addClose").text("Add");
                }
                $(".guest-details-family-form-cont").slideDown("linear");

                _this.guestFamily = { ..._this.familyList[id] };
                _this.fedit = true;
                //console.log(_this.guestFamily);
            }
        },
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
                this.guestProfile_logo = e.target.files[0];
                this.companyPicPreview = URL.createObjectURL(
                    this.guestProfile_logo
                );
                if (this.guestProfile.imageOne) {
                    delete this.guestProfile.imageOne;
                }
            }

            if (type == "familyOne") {
                this.familyimageOne = e.target.files[0];
                this.familyimageOnePreview = URL.createObjectURL(
                    this.familyimageOne
                );
            }
            if (type == "familyTwo") {
                this.familyimageTwo = e.target.files[0];
                this.familyimageTwoPreview = URL.createObjectURL(
                    this.familyimageTwo
                );
            }
        },
        // editForm(e) {
        //     let id = e.currentTarget.parentElement.parentElement.id;
        //     $(`#${id} .ven-profile-form-submit button[type=submit]`).css(
        //         "display",
        //         "block"
        //     );
        //     $(`#${id} input`).removeAttr("disabled");
        //     $(`#guest-logo`).removeAttr("required");
        //     $("#company-logo").removeAttr("required");
        //     $(`#${id} input`).eq(1).focus();
        //     if (id == "guest-details") {
        //         this.pedit = true;
        //         this.pprofileDisabled = false;
        //     }
        //     if (id == "company-details") {
        //         this.cedit = true;
        //         this.cprofileDisabled = false;
        //     }
        //     if (id == "office-details") {
        //         this.oedit = true;
        //         this.oprofileDisabled = false;
        //     }
        // },
        toggleForm(e, bool) {
            //console.log(bool);
            let id = null;
            if (bool == true) {
                id = e.currentTarget.dataset.id;
            }
            if (bool == false) {
                id = e;
            }
            this.showForm = true;
            this.$nextTick(function () {
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
            });
        },
        submitProfile(e) {
            var _this = this;
            _this.errors = null;
            this.$v.guestHome.$touch();
            if (_this.$v.guestHome.$invalid == true) {
                _this.message =
                    "Kindly enter the correct inputs to submit the form!";
                setTimeout(function () {
                    _this.message = null;
                }, 3000);
                return;
            }
            this.pprofileDisabled = true;
            let formData = new FormData();
            let data = JSON.stringify(_this.guestHome);
            formData.append("data", data);
            formData.append("type", "home");
            this.loader = true;
            if (this.pedit) {
                formData.append("_method", "PATCH");
                let updateId = this.guestHome.id;
                if (this.profileId != null) {
                    updateId = parseInt(this.profileId);
                }
                axios
                    .post(`/api/guest/profile/${updateId}`, formData)
                    .then(function (response) {
                        _this.loader = false;
                        _this.pedit = false;
                        _this.toggleForm("office-details", false);
                        _this.message = "Home Profile updated";
                        _this.exist = 1;
                        _this.pprofileDisabled = false;
                        // _this.updateEdit();
                        // $(
                        //     `#guest-details .ven-profile-form-submit button[type=submit]`
                        // ).css("display", "none");
                        setTimeout(function () {
                            _this.message = null;
                        }, 3000);
                    })
                    .catch((error) => {
                        _this.pprofileDisabled = false;
                        _this.loader = false;
                        _this.errors = error.response.data.errors;
                        console.log(error.response.data.errors);
                    });
                return;
            }
            axios
                .post(`/api/guest/profile`, formData)
                .then(function (response) {
                    _this.loader = false;
                    _this.toggleForm("office-details", false);
                    _this.message = "Home Profile Uploaded";
                    _this.exist = 1;
                    _this.pprofileDisabled = false;
                    _this.profileId = response.data;
                    _this.guestHome.id = response.data;
                    // _this.updateEdit();
                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                })
                .catch((error) => {
                    _this.pprofileDisabled = false;
                    _this.loader = false;
                    _this.errors = error.response.data.errors;
                });
        },
        submitCProfile(e) {
            var _this = this;
            _this.errors = null;
            this.$v.guestProfile.$touch();
            if (_this.$v.guestProfile.$invalid == true) {
                _this.message =
                    "Kindly enter the correct inputs to submit the form!";
                setTimeout(function () {
                    _this.message = null;
                }, 3000);
                return;
            }
            this.cprofileDisabled = true;
            //this.guestProfile.guest_id = _this.guestId;
            const config = {
                headers: { "content-type": "multipart/form-data" },
            };
            let formData = new FormData();
            let data = JSON.stringify(_this.guestProfile);
            let img = this.guestProfile_logo;
            formData.append("type", "personal");
            formData.append("personalimg", img);
            formData.append("data", data);
            this.loader = true;
            if (this.cedit) {
                formData.append("_method", "PATCH");
                let updateId = this.guestProfile.id;
                if (this.companyId != null) {
                    updateId = this.companyId;
                }
                axios
                    .post(`/api/guest/profile/${updateId}`, formData, config)
                    .then(function (response) {
                        _this.cedit = false;
                        _this.loader = false;
                        _this.toggleForm("guest-details", false);
                        _this.personalfileOpen = true;
                        _this.message = "Personal Profile updated";
                        _this.cprofileDisabled = false;
                        // _this.updateEdit();
                        // $(
                        //     `#company-details .ven-profile-form-submit button[type=submit]`
                        // ).css("display", "none");
                        //_this.companyId = response.data;
                        setTimeout(function () {
                            _this.message = null;
                        }, 3000);
                    })
                    .catch((error) => {
                        _this.cprofileDisabled = false;
                        _this.loader = false;
                        _this.errors = error.response.data.errors;
                        console.log(error.response.data.errors);
                    });
                return;
            }
            if (this.guestProfile_logo == null) {
                _this.errors = { companyimg: ["Profile picture is required"] };
                _this.loader = false;
                _this.cprofileDisabled = false;
                return;
            }
            axios
                .post(`/api/guest/profile`, formData, config)
                .then(function (response) {
                    _this.loader = false;
                    _this.toggleForm("guest-details", false);

                    _this.personalfileOpen = true;
                    _this.guestProfile_logo = null;
                    _this.message = "Personal Profile Uploaded";
                    _this.cexist = 1;
                    _this.cprofileDisabled = false;
                    // _this.updateEdit();
                    _this.companyId = response.data;
                    _this.guestProfile.id = response.data;
                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                })
                .catch((error) => {
                    //console.log(error);
                    _this.cprofileDisabled = false;
                    _this.loader = false;
                    _this.errors = error.response.data.errors;
                    //console.log(error.response.data.errors);
                });
        },
        submitOProfile(e) {
            var _this = this;
            _this.errors = null;
            this.$v.guestOffice.$touch();
            if (_this.$v.guestOffice.$invalid == true) {
                _this.message =
                    "Kindly enter the correct inputs to submit the form!";
                setTimeout(function () {
                    _this.message = null;
                }, 3000);
                return;
            }
            this.oprofileDisabled = true;
            let formData = new FormData();
            let data = JSON.stringify(_this.guestOffice);
            formData.append("data", data);
            formData.append("type", "office");
            this.loader = true;
            if (this.oedit) {
                formData.append("_method", "PATCH");
                let updateId = this.guestOffice.id;
                if (this.officeId != null) {
                    updateId = parseInt(this.officeId);
                }
                axios
                    .post(`/api/guest/profile/${updateId}`, formData)
                    .then(function (response) {
                        _this.loader = false;
                        _this.oedit = false;
                        _this.toggleForm("family-details", false);
                        _this.message = "Office Profile updated";
                        _this.oexist = 1;
                        // _this.updateEdit();
                        _this.oprofileDisabled = false;
                        // $(
                        //     `#office-details .ven-profile-form-submit button[type=submit]`
                        // ).css("display", "none");
                        setTimeout(function () {
                            _this.message = null;
                        }, 3000);
                    })
                    .catch((error) => {
                        _this.oprofileDisabled = false;
                        _this.loader = false;
                        _this.errors = error.response.data.errors;
                        console.log(error.response.data.errors);
                    });
                return;
            }
            axios
                .post(`/api/guest/profile`, formData)
                .then(function (response) {
                    console.log(response.data);
                    _this.loader = false;
                    _this.toggleForm("family-details", false);
                    _this.message = "office Profile Uploaded";
                    _this.oexist = 1;
                    _this.oprofileDisabled = false;
                    _this.officeId = response.data;
                    _this.guestOffice.id = response.data;
                    // _this.updateEdit();
                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                })
                .catch((error) => {
                    _this.oprofileDisabled = false;
                    _this.loader = false;
                    _this.errors = error.response.data.errors;
                });
        },
        submitFProfile(e) {
            var _this = this;
            _this.errors = null;
            this.$v.guestFamily.$touch();
            if (_this.$v.guestFamily.$invalid == true) {
                _this.message =
                    "Kindly enter the correct inputs to submit the form!";
                setTimeout(function () {
                    _this.message = null;
                }, 3000);
                return;
            }
            this.fprofileDisabled = true;
            const config = {
                headers: { "content-type": "multipart/form-data" },
            };
            let formData = new FormData();
            let data = JSON.stringify(_this.guestFamily);
            if (this.familyimageOne != null) {
                formData.append("familyimageOne", _this.familyimageOne);
                delete _this.guestFamily.familyimageOne;
            }
            if (this.familyimageTwo != null) {
                formData.append("familyimageTwo", _this.familyimageTwo);
                delete _this.guestFamily.familyimageTwo;
            }
            formData.append("data", data);
            formData.append("type", "family");
            this.loader = true;
            if (this.fedit) {
                formData.append("_method", "PATCH");
                let updateId = this.guestFamily.id;
                delete this.guestFamily.id;
                delete this.guestFamily.familyimageOne;
                delete this.guestFamily.familyimageTwo;
                axios
                    .post(`/api/guest/profile/${updateId}`, formData)
                    .then(function (response) {
                        _this.loader = false;
                        // _this.toggleForm("family-details", false);
                        _this.familyList = response.data;
                        _this.editFamilyForm(e, "new");
                        _this.message = "Family Member updated";
                        // _this.updateEdit();
                        _this.fedit = false;
                        _this.fprofileDisabled = false;
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
                    console.log(response.data);
                    _this.loader = false;
                    // _this.toggleForm("family-details", false);
                    _this.familyList = response.data;
                    _this.editFamilyForm(e, "new");
                    _this.message = "Family Member added";
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
        getguestprofile() {
            var _this = this;
            var v = this.guestId;
            axios
                .get(`/api/guest/profile/${v}`)
                .then(function (response) {
                    console.log(response);
                    _this.guestDetails = response.data[0];
                    _this.routeSlug = response.data[0].slug;
                    _this.locationMaster = response.data[2];
                    if (response.data[1]) {
                        _this.guestProfile = response.data[1];
                        _this.guestProfile.guest_id = _this.guestId;
                        delete _this.guestProfile.created_at;
                        delete _this.guestProfile.deleted_at;
                        delete _this.guestProfile.updated_at;
                        if (_this.guestProfile.imageOne == null) {
                            delete _this.guestProfile.imageOne;
                        }
                    }
                    if (response.data[2]) {
                        _this.guestOffice = response.data[2];
                        _this.guestOffice.guest_id = _this.guestId;
                        delete _this.guestOffice.created_at;
                        delete _this.guestOffice.deleted_at;
                        delete _this.guestOffice.updated_at;
                    }
                    if (response.data[3]) {
                        _this.guestHome = response.data[3];
                        _this.guestHome.guest_id = _this.guestId;
                        delete _this.guestHome.created_at;
                        delete _this.guestHome.deleted_at;
                        delete _this.guestHome.updated_at;
                    }
                    if (response.data[4]) {
                        _this.familyList = response.data[4];
                    }
                })
                .catch((errors) => {
                    console.log("Get All: " + errors);
                });
        },
        count(e) {
            let dropZone = document.querySelector(
                "#guest-preview-upload-dropzone"
            );
            dropZone.lastElementChild.textContent =
                e.target.files.length + " files uploaded";
        },
        // updateEdit() {
        //     if (this.exist == 1) {
        //         //console.log($("#guest-details input"));
        //         $("#guest-details input").attr("disabled", true);
        //         $("#guest-details select").attr("disabled", true);
        //         this.pprofileDisabled = true;
        //     }
        //     if (this.cexist == 1) {
        //         //console.log($("#company-details input"));
        //         $("#company-details input").attr("disabled", true);
        //         $("#company-details select").attr("disabled", true);
        //         this.cprofileDisabled = true;
        //         // if (this.exist == 0) {
        //         //     this.toggleForm("guest-details", false);
        //         //     this.personalfileOpen = true;
        //         // }
        //     }
        //     if (this.oexist == 1) {
        //         //console.log($("#guest-details input"));
        //         $("#office-details input").attr("disabled", true);
        //         $("#office-details select").attr("disabled", true);
        //         this.oprofileDisabled = true;
        //     }
        //     // if (this.fexist == 1) {
        //     //     //console.log($("#guest-details input"));
        //     //     $("#family-details input").attr("disabled", true);
        //     //     this.fprofileDisabled = true;
        //     // }
        // },
    },
    mounted() {
        this.$nextTick(function () {
            this.getguestprofile();
            if (
                this.exist == 1 ||
                this.cexist == 1 ||
                this.oexist == 1 ||
                this.fexist == 1
            ) {
                this.showForm = false;
            }
            //this.updateEdit();
        });
    },
};
</script>

<style scoped>
.form-group--error label {
    border-color: #f79483 !important;
    color: #f04124 !important;
}
.form-group--error .error {
    font-size: 10px;
    color: #f57f6c;
}
.form-upload-vue {
    display: block !important;
}
.guest-details-family-form-cont {
    /* max-height: 0;
    transition: max-height 0.15s ease-out;
    overflow: hidden; */
    display: none;
}
.guest-details-family-form-cont > div:nth-child(2) {
    padding: 0.5em;
}
.edit-btn-tab > button {
    background-color: #461952;
    color: white;
    outline: none;
    border: none;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    padding: 1px 0px 0px 1px;
    margin-bottom: 10px;
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
.v-enter-active,
.v-leave-active {
    transition: opacity 0.15s linear;
}
.v-enter-from,
.v-leave-to {
    opacity: 0;
}
.guest-preview-upload {
    border: 0.162319px solid #959595;
    box-sizing: border-box;
    border-radius: 8.11594px;
    grid-column-start: 1;
    grid-column-end: -1;
    padding: 1.5em;
}
.guest-preview-upload > label {
    background: #efefef;
    border-radius: 4.05797px;
    width: 100%;
    cursor: pointer;
    position: relative;
}
#guest-preview-upload-dropzone {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 2em;
}
#guest-preview-upload-dropzone > span:nth-child(1) {
    width: 45px;
    height: 45px;
    background: #dfdfdf;
    border-radius: 50%;
    margin-bottom: 5px;
}
#guest-preview-upload-dropzone > span:nth-child(1) > img {
    width: 21px;
    height: 21px;
    margin-top: 12px;
    margin-left: 12px;
}
#guest-preview-upload-dropzone > span:nth-child(2) {
    font-family: Poppins;
    font-style: normal;
    font-weight: 500;
    font-size: 9.58349px;
    line-height: 14px;
    color: #000000;
    margin-bottom: 5px;
}
#guest-preview-upload-dropzone > span:nth-child(3) {
    font-family: Poppins;
    font-style: normal;
    font-weight: 300;
    font-size: 6.59415px;
    line-height: 10px;
    color: #7c7c7c;
}
#guest-preview-upload-dragtext {
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
.guest-logo-upload > label {
    display: flex;
    flex-direction: column;
    width: max-content;
    text-align: center;
    margin: 0.5em auto;
    position: relative;
    cursor: pointer;
}
.guest-logo-upload img {
    width: 61px;
    height: 61px;
    border-radius: 50%;
}
.guest-logo-upload > label > span:nth-child(2) {
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

#guest-details > h1 {
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
#company-details > h1,
#office-details > h1,
#family-details > h1 {
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
.guest-details-form-fields {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    grid-auto-rows: max-content;
    column-gap: 12px;
    row-gap: 4px;
}
.guest-details-form-fields > div > label {
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
.guest-details-form-fields > div > label input,
.guest-details-form-fields > div > label select {
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

.guest-address-form-fields {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    column-gap: 12px;
    row-gap: 4px;
}
/* .guest-address-form-fields > label:first-child {
    grid-column-start: 1;
    grid-column-end: -1;
} */
/* .guest-address-form-fields > label:last-child {
    grid-column-start: 1;
    grid-column-end: -1;
    position: relative;
} */
.guest-address-form-fields > label {
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
#guestCategories {
    padding: 0px 25px 9px 0px;
    margin-left: -4px;
    border: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    background: #ffffff;
    border-radius: 5px;
    background-image: url("/assets/guests/dashboard/dropdown-arrow.svg");
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
#guestCategories > option {
    font-family: Segoe UI;
    font-style: normal;
    font-weight: normal;
    font-size: 10px;
    line-height: 13px;
    color: #3d3838;
}
.guest-address-form-fields > label > input {
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

/* Profile Finale View */
.profile-view-cont {
    /* background: #f4f3fa; */
    background: #ffffff;
    border: 0.5px solid #dadada;
    border-radius: 10px;
    padding: 44px;
}
.profile-view-cont > h1 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 17.6px;
    line-height: 26px;
    color: #000000;
}
.profile-view-details {
    border: 0.5px solid #dcdcdc;
    border-radius: 5px;
    padding: 29px 18px;
}
.profile-view-details > div {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
}
.left-details {
    width: 100%;
}
.right-details {
    width: max-content;
    display: flex;
}
.right-details > span,
.fam-rel {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 13.9535px;
    line-height: 21px;
    color: #1d3354;
    background: rgba(29, 51, 84, 0.1);
    border-radius: 6.97674px;
    padding: 7px;
    margin-right: 10px;
}
.right-details > img {
    cursor: pointer;
}
.name-age-gender > span {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 16px;
    line-height: 24px;
    color: #000000;
}
.name-age-gender > span:nth-child(1) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 16px;
    line-height: 24px;
    color: #c4456f;
    margin-right: 20px;
}
.name-age-gender > span:nth-child(2) {
    margin-right: 15px;
}
.contact-details {
    margin: 5px 0;
}
.contact-details > h3,
.contact-details > p,
.address-head,
.address-mid,
.address-end {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 16px;
    line-height: 24px;
    color: #000000;
    margin-bottom: 0px;
}
.contact-details > p,
.address-mid,
.address-end {
    font-weight: 300;
}
.contact-phone > img {
    margin-right: 10px;
}
.contact-phone > a {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 16px;
    line-height: 24px;
    text-decoration-line: underline;
    color: #428bc1;
    margin-right: 4px;
}
.address-end > a {
    color: #138ab3;
}
.filter-pink {
    filter: invert(32%) sepia(76%) saturate(1107%) hue-rotate(303deg)
        brightness(90%) contrast(81%);
}
@media screen and (max-width: 992px) {
    .guest-details-form-fields {
        grid-template-columns: repeat(2, 1fr);
    }
    .guest-address-form-fields {
        grid-template-columns: repeat(2, 1fr);
    }
    .guest-preview-form-fields {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media screen and (max-width: 762px) {
    .guest-details-form-fields {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    }
    .guest-address-form-fields {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    }
    .guest-preview-form-fields {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    }
    .contact-details > h3,
    .contact-details > p {
        width: 100%;
    }
}
@media screen and (max-width: 576px) {
    .name-age-gender {
        display: flex;
        flex-wrap: wrap;
    }
    .name-age-gender > span {
        width: 100%;
    }
    .profile-view-cont {
        padding: 12px;
    }
    .profile-view-details > div {
        flex-wrap: wrap-reverse;
        margin-bottom: 5px;
    }
    .right-details {
        margin-left: auto;
    }
}
</style>
