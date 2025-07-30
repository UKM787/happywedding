<template>
    <div>
        <div v-show="showForm == false" class="profile-view-cont cotainer-md">
            <h1>Profile Details</h1>
            <div class="profile-view-details">
                <div>
                    <div v-if="cexist == 1" class="left-details">
                        <div class="name-age-gender">
                            <span v-if="hostProfile?.name">{{
                                hostProfile?.name
                            }}</span>
                            <span v-if="hostProfile?.age">{{
                                hostProfile?.age
                            }}</span>
                            <span v-if="hostProfile?.gender">{{
                                hostProfile?.gender
                            }}</span>
                        </div>
                        <div class="contact-details">
                            <h3>Contact Details:</h3>
                            <p v-if="hostProfile?.email">
                                {{ hostProfile?.email }}
                            </p>
                        </div>
                        <div class="contact-phone">
                            <img src="/assets/phoneblue.svg" alt="" />
                            <a
                                v-if="hostProfile?.mobile"
                                href="tel:+91837423849"
                                >+91 {{ hostProfile?.mobile }}</a
                            >
                            <a
                                v-if="hostProfile?.mobile1"
                                href="tel:+913942030239"
                                >+91 {{ hostProfile?.mobile1 }}</a
                            >
                            <i
                                v-if="hostProfile?.whatsup"
                                class="fab fa-whatsapp-square"
                            ></i>
                            <a
                                v-if="hostProfile?.whatsup"
                                href="tel:+913942030239"
                                >+91 {{ hostProfile?.whatsup }}</a
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
                        <span v-if="hostProfile?.relation">{{
                            hostProfile?.relation
                        }}</span>
                        <img
                            @click="toggleForm('company-details', false)"
                            src="/assets/miscellenous/Frame-929.svg"
                            alt=""
                        />
                    </div>
                </div>
                <div>
                    <div class="left-details" style="margin: 15px 0">
                        <h1 class="address-head">Home Details:</h1>
                        <p v-if="exist == 1" class="address-mid">
                            {{ hostHome?.doorNo }}
                            {{ hostHome?.floorNo }}
                            {{ hostHome?.area }}, {{ hostHome?.complexName }},
                            {{ hostHome?.district }},
                            {{ hostHome?.state }}
                            {{ hostHome?.pin }}
                        </p>
                        <p v-else class="address-mid">No details added!</p>
                        <p
                            v-if="exist == 1"
                            class="address-end"
                            style="word-wrap: break-word"
                        >
                            Map Location:
                            <a :href="hostHome?.reachus">{{
                                hostHome?.reachus
                            }}</a>
                        </p>
                    </div>
                    <div class="right-details">
                        <img
                            @click="toggleForm('host-details', false)"
                            src="/assets/miscellenous/Frame-929.svg"
                            alt=""
                        />
                    </div>
                </div>
                <div>
                    <div class="left-details" style="margin: 15px 0">
                        <h1 class="address-head">Office Details:</h1>
                        <p v-if="oexist == 1" class="address-mid">
                            {{ hostOffice?.officedoorNo }}
                            {{ hostOffice?.officefloorNo }}
                            {{ hostOffice?.officearea }},
                            {{ hostOffice?.officecomplexName }},
                            {{ hostOffice?.officedistrict }},
                            {{ hostOffice?.officestate }}
                            {{ hostOffice?.officepin }}
                        </p>
                        <p v-else class="address-mid">No details added!</p>
                        <p
                            v-if="oexist == 1"
                            class="address-end"
                            style="word-wrap: break-word"
                        >
                            Map Location:
                            <a :href="hostOffice?.officereachus">{{
                                hostOffice?.officereachus
                            }}</a>
                        </p>
                    </div>
                    <div class="right-details">
                        <img
                            @click="toggleForm('office-details', false)"
                            src="/assets/miscellenous/Frame-929.svg"
                            alt=""
                        />
                    </div>
                </div>
            </div>
            <div class="profile-view-plan-cont">
                <div v-if="subscription" class="plan-detail-head">
                    <h1>Current plan</h1>
                    <a :href="route('subscribePage')">Upgrade Plan</a>
                </div>
                <div v-else class="plan-detail-head">
                    <h1>No Active Plan</h1>
                    <a :href="route('subscribePage')">Buy Plan</a>
                </div>
                <div v-if="subscription" style="width: 70%">
                    <div style="display: flex; margin-bottom: 25px">
                        <div class="plan-head-name">
                            <div class="type">
                                <img src="/assets/silver-medal.svg" alt="" />
                                <span>{{
                                    subscription.subscribeable.name
                                }}</span>
                            </div>
                            <span class="price">
                                <img
                                    style="
                                        margin-bottom: 18px;
                                        margin-right: -5px;
                                    "
                                    src="/assets/rupee.svg"
                                    alt=""
                                />
                                <span>{{
                                    subscription.subscribeable.price
                                }}</span>
                            </span>
                            <span class="validity"
                                >{{
                                    subscription.subscribeable.validity
                                }}
                                Months</span
                            >
                        </div>
                        <div class="plan-head-expiry">
                            <div>Subscription ends</div>
                            <div>
                                On
                                {{
                                    subscription.expiry_at
                                        | moment("MMMM DD ,YYYY")
                                }}
                            </div>
                        </div>
                    </div>
                    <div class="plan-feature-details">
                        <div>
                            <span>Guest Count : </span>
                            <span>100</span>
                        </div>
                        <div>
                            <span>Invitation Card Design:</span>
                            <span>Standard</span>
                        </div>
                        <div>
                            <span>Email Reminders:</span>
                            <span>1</span>
                        </div>
                        <div>
                            <span>SMS Reminders:</span>
                            <span>1</span>
                        </div>
                        <div>
                            <span>Events Allowed:</span>
                            <span>3</span>
                        </div>
                        <div>
                            <span>Image Count- Img Size/Event:</span>
                            <span>50-100kb / Event</span>
                        </div>
                        <div>
                            <span>Video Count- Vid Size/Event:</span>
                            <span>50-100kb / Event</span>
                        </div>
                        <div>
                            <span>Wedding Venues:</span>
                            <span
                                ><img src="/assets/login/check.svg" alt=""
                            /></span>
                        </div>
                        <div>
                            <span>Guest Accommodation:</span>
                            <span
                                ><img src="/assets/login/check.svg" alt=""
                            /></span>
                        </div>
                        <div>
                            <span>Guest Transport:</span>
                            <span
                                ><img src="/assets/login/check.svg" alt=""
                            /></span>
                        </div>
                        <div>
                            <span>Wedding URL (Standard):</span>
                            <span
                                ><img
                                    src="/assets/login/iconoir_cancel.svg"
                                    alt=""
                            /></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div
            v-show="showForm == true"
            class="container-md ven-profile-form"
            style="padding-top: 10px"
        >
            <div>
                <h2 id="ven-profile-form-head">PROFILE</h2>

                <div class="host-logo-upload">
                    <label v-if="!personalfileOpen" for="company-logo">
                        <img
                            v-if="companyPicPreview"
                            :src="companyPicPreview"
                            alt=""
                        />
                        <img
                            v-else-if="
                                hostProfile.imageOne &&
                                hostProfile.imageOne != '/defautlsv1/avatar.png'
                            "
                            :src="
                                '/assets/hosts/uploads/' + hostProfile.imageOne
                            "
                            alt=""
                        />
                        <img
                            v-else
                            src="/storage/defaultsv1/avatar.png"
                            alt=""
                            onerror="this.onerror=null; this.src='/assets/hosts/hostDefault.png'; this.onerror=null;"
                        />
                    </label>
                </div>
            </div>
            <div :class="[loader ? 'blur about' : 'about']">
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
                        data-id="host-details"
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
                            ref="profilepic"
                            style="display: none"
                            @change="uploadImg($event, 'company')"
                        />
                        <h1><span v-if="cedit">Edit</span> Personal details</h1>
                        <div style="display: flex; justify-content: flex-end">
                            <button
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
                                    src="/assets/miscellenous/Frame-930.svg"
                                    alt=""
                                />
                            </button>
                            <!-- <a
                                style="
                                    margin-bottom: 10px;
                                    margin-right: 20px;
                                    text-decoration: none;
                                "
                                href="/host/welcome"
                                data-id="office-details"
                            >
                                <img
                                    src="/assets/miscellenous/Frame-930.svg"
                                    alt=""
                                />
                            </a> -->
                        </div>
                        <div class="host-details-form-fields">
                            <div
                                class="form-group"
                                :class="{
                                    'form-group--error':
                                        $v.hostProfile.name.$error,
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
                                            $v.hostProfile.name.$model
                                        "
                                    />
                                    <span
                                        v-if="errors && errors.name"
                                        class="errMsg"
                                        >{{ errors.name[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.hostProfile.name"
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
                                        $v.hostProfile.fatherName.$error,
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
                                            $v.hostProfile.fatherName.$model
                                        "
                                    />
                                    <span
                                        v-if="errors && errors.fatherName"
                                        class="errMsg"
                                        >{{ errors.fatherName[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.hostProfile.fatherName"
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
                                        $v.hostProfile.surname.$error,
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
                                            $v.hostProfile.surname.$model
                                        "
                                    />
                                    <span
                                        v-if="errors && errors.surname"
                                        class="errMsg"
                                        >{{ errors.surname[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.hostProfile.surname"
                                        :validation="['minLength', 'alpha']"
                                    ></vue-validation>
                                </label>
                            </div>
                            <div
                                class="form-group"
                                :class="{
                                    'form-group--error':
                                        $v.hostProfile.age.$error,
                                }"
                            >
                                <label for="age">
                                    Age
                                    <input
                                        type="text"
                                        name="age"
                                        id="age"
                                        placeholder="Enter your age"
                                        v-model.trim="$v.hostProfile.age.$model"
                                    />
                                    <span
                                        v-if="errors && errors.age"
                                        class="errMsg"
                                        >{{ errors.age[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.hostProfile.age"
                                        :validation="['maxLength', 'numeric']"
                                    ></vue-validation>
                                </label>
                            </div>
                            <div
                                class="form-group"
                                :class="{
                                    'form-group--error':
                                        $v.hostProfile.gender.$error,
                                }"
                            >
                                <label for="gender">
                                    Gender
                                    <div class="inside-label">
                                        <label for="male">
                                            <input
                                                type="radio"
                                                id="male"
                                                value="male"
                                                v-model.trim="
                                                    $v.hostProfile.gender.$model
                                                "
                                            />
                                            Male
                                        </label>
                                        <label for="female">
                                            <input
                                                type="radio"
                                                id="female"
                                                value="female"
                                                v-model.trim="
                                                    $v.hostProfile.gender.$model
                                                "
                                            />Female</label
                                        >
                                    </div>
                                    <span
                                        v-if="errors && errors.gender"
                                        class="errMsg"
                                        >{{ errors.gender[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.hostProfile.gender"
                                        :validation="[]"
                                    ></vue-validation>
                                </label>
                            </div>
                            <div
                                class="form-group"
                                :class="{
                                    'form-group--error':
                                        $v.hostProfile.relation.$error,
                                }"
                            >
                                <label for="relation">
                                    Relation
                                    <select
                                        v-model.trim="
                                            $v.hostProfile.relation.$model
                                        "
                                        name="accType"
                                        id="accType"
                                    >
                                        <option disabled value="">
                                            Select Relation
                                        </option>
                                        <option
                                            v-for="(
                                                item, index
                                            ) in relationList"
                                            :key="index"
                                            :value="item"
                                        >
                                            {{ item }}
                                        </option>
                                    </select>
                                    <span
                                        v-if="errors && errors.relation"
                                        class="errMsg"
                                        >{{ errors.relation[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.hostProfile.relation"
                                        :validation="[]"
                                    ></vue-validation>
                                </label>
                            </div>
                            <div
                                class="form-group"
                                :class="{
                                    'form-group--error':
                                        $v.hostProfile.email.$error,
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
                                            $v.hostProfile.email.$model
                                        "
                                    />
                                    <span
                                        v-if="errors && errors.email"
                                        class="errMsg"
                                        >{{ errors.email[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.hostProfile.email"
                                        :validation="['required', 'email']"
                                    ></vue-validation>
                                </label>
                            </div>
                            <div
                                class="form-group"
                                :class="{
                                    'form-group--error':
                                        $v.hostProfile.phone.$error,
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
                                            $v.hostProfile.phone.$model
                                        "
                                    />
                                    <span
                                        v-if="errors && errors.phone"
                                        class="errMsg"
                                        >{{ errors.phone[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.hostProfile.phone"
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
                                        $v.hostProfile.mobile.$error,
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
                                            $v.hostProfile.mobile.$model
                                        "
                                    />
                                    <span
                                        v-if="errors && errors.mobile"
                                        class="errMsg"
                                        >{{ errors.mobile[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.hostProfile.mobile"
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
                                        $v.hostProfile.mobile1.$error,
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
                                            $v.hostProfile.mobile1.$model
                                        "
                                    />
                                    <span
                                        v-if="errors && errors.mobile1"
                                        class="errMsg"
                                        >{{ errors.mobile1[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.hostProfile.mobile1"
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
                                        $v.hostProfile.whatsup.$error,
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
                                            $v.hostProfile.whatsup.$model
                                        "
                                    />
                                    <span
                                        v-if="errors && errors.whatsup"
                                        class="errMsg"
                                        >{{ errors.whatsup[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.hostProfile.whatsup"
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
                                data-id="host-categories"
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
                                data-id="host-details"
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
                        id="host-details"
                        data-id="company-details"
                    >
                        <!-- <input
                            v-show="personalfileOpen"
                            type="file"
                            id="host-logo"
                            name="host-logo"
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
                                    src="/assets/miscellenous/Frame-930.svg"
                                    alt=""
                                />
                            </button>
                            <!-- <a
                                style="
                                    margin-bottom: 10px;
                                    margin-right: 20px;
                                    text-decoration: none;
                                "
                                href="/host/welcome"
                                data-id="office-details"
                            >
                                <img
                                    src="/assets/miscellenous/Frame-930.svg"
                                    alt=""
                                />
                            </a> -->
                        </div>
                        <div class="host-details-form-fields">
                            <div
                                class="form-group"
                                :class="{
                                    'form-group--error':
                                        $v.hostHome.complexName.$error,
                                }"
                            >
                                <label for="hostcomplexName">
                                    Complex Name
                                    <input
                                        type="text"
                                        name="complexName"
                                        id="hostcomplexName"
                                        placeholder="Enter your complex name"
                                        v-model.trim="
                                            $v.hostHome.complexName.$model
                                        "
                                    />
                                    <span
                                        v-if="errors && errors.complexName"
                                        class="errMsg"
                                        >{{ errors.complexName[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.hostHome.complexName"
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
                                        $v.hostHome.floor.$error,
                                }"
                            >
                                <label for="hostfloor">
                                    Floor
                                    <input
                                        type="text"
                                        name="floor"
                                        id="hostfloor"
                                        placeholder="Enter your floor"
                                        v-model.trim="$v.hostHome.floor.$model"
                                    />
                                    <span
                                        v-if="errors && errors.floor"
                                        class="errMsg"
                                        >{{ errors.floor[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.hostHome.floor"
                                        :validation="['required', 'minLength']"
                                    ></vue-validation>
                                </label>
                            </div>
                            <div
                                class="form-group"
                                :class="{
                                    'form-group--error':
                                        $v.hostHome.doorNo.$error,
                                }"
                            >
                                <label for="hostdoorNo">
                                    Door No.
                                    <input
                                        type="text"
                                        name="doorNo"
                                        id="hostdoorNo"
                                        placeholder="Enter your doorNo"
                                        v-model.trim="$v.hostHome.doorNo.$model"
                                    />
                                    <span
                                        v-if="errors && errors.doorNo"
                                        class="errMsg"
                                        >{{ errors.doorNo[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.hostHome.doorNo"
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
                                        $v.hostHome.streetNo.$error,
                                }"
                            >
                                <label for="hoststreetNo">
                                    Street Name/No.
                                    <input
                                        type="text"
                                        name="streetNo"
                                        id="hoststreetNo"
                                        placeholder="Enter your streetNo"
                                        v-model.trim="
                                            $v.hostHome.streetNo.$model
                                        "
                                    />
                                    <span
                                        v-if="errors && errors.streetNo"
                                        class="errMsg"
                                        >{{ errors.streetNo[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.hostHome.streetNo"
                                        :validation="['required', 'minLength']"
                                    ></vue-validation>
                                </label>
                            </div>
                            <div
                                class="form-group"
                                :class="{
                                    'form-group--error':
                                        $v.hostHome.area.$error,
                                }"
                            >
                                <label for="hostarea">
                                    Area
                                    <input
                                        type="text"
                                        name="area"
                                        id="hostarea"
                                        placeholder="Enter your area"
                                        v-model.trim="$v.hostHome.area.$model"
                                    />
                                    <span
                                        v-if="errors && errors.area"
                                        class="errMsg"
                                        >{{ errors.area[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.hostHome.area"
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
                                        $v.hostHome.state.$error,
                                }"
                            >
                                <label for="hoststate">
                                    State
                                    <select
                                        v-model.trim="$v.hostHome.state.$model"
                                        name="accstate"
                                        id="accstate"
                                        @change="getDistricts($event, 'home')"
                                    >
                                        <option hidden disabled selected>
                                            Select vendor’s category
                                        </option>
                                        <option
                                            v-for="item in states"
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
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.hostHome.state"
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
                                        $v.hostHome.district.$error,
                                }"
                            >
                                <label for="hostdistrict">
                                    District
                                    <select
                                        v-model.trim="
                                            $v.hostHome.district.$model
                                        "
                                        name="accdistrict"
                                        id="accdistrict"
                                    >
                                        <option disabled value="">
                                            Select District
                                        </option>
                                        <option
                                            v-for="(item, index) in district"
                                            :key="index"
                                            :value="item.name"
                                        >
                                            {{ item.name }}
                                        </option>
                                    </select>
                                    <span
                                        v-if="errors && errors.district"
                                        class="errMsg"
                                        >{{ errors.district[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.hostHome.district"
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
                                    'form-group--error': $v.hostHome.pin.$error,
                                }"
                            >
                                <label for="hostpin">
                                    Pin
                                    <input
                                        type="text"
                                        name="pin"
                                        id="hostpin"
                                        placeholder="Enter your pin"
                                        v-model.trim="$v.hostHome.pin.$model"
                                    />
                                    <span
                                        v-if="errors && errors.pin"
                                        class="errMsg"
                                        >{{ errors.pin[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.hostHome.pin"
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
                                        $v.hostHome.reachus.$error,
                                }"
                            >
                                <label for="hostreachus">
                                    Map location
                                    <input
                                        type="text"
                                        name="reachus"
                                        id="hostreachus"
                                        placeholder="Enter your map location"
                                        v-model.trim="
                                            $v.hostHome.reachus.$model
                                        "
                                    />
                                    <span
                                        v-if="errors && errors.reachus"
                                        class="errMsg"
                                        >{{ errors.reachus[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.hostHome.reachus"
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
                            id="host-logo"
                            name="host-logo"
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
                                    src="/assets/miscellenous/Frame-930.svg"
                                    alt=""
                                />
                            </button>
                            <!-- <a
                                style="
                                    margin-bottom: 10px;
                                    margin-right: 20px;
                                    text-decoration: none;
                                "
                                href="/host/welcome"
                                data-id="office-details"
                                type="button"
                            >
                                <img
                                    src="/assets/miscellenous/Frame-930.svg"
                                    alt=""
                                />
                            </a> -->
                        </div>
                        <div class="host-details-form-fields">
                            <div
                                class="form-group"
                                :class="{
                                    'form-group--error':
                                        $v.hostOffice.officecompanyName.$error,
                                }"
                            >
                                <label for="hostofficecompanyName">
                                    Company Name
                                    <input
                                        type="text"
                                        name="officecompanyName"
                                        id="hostofficecompanyName"
                                        placeholder="Enter your company name"
                                        v-model.trim="
                                            $v.hostOffice.officecompanyName
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
                                            $v.hostOffice.officecompanyName
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
                                        $v.hostOffice.officecomplexName.$error,
                                }"
                            >
                                <label for="hostofficecomplexName">
                                    Complex Name
                                    <input
                                        type="text"
                                        name="officecomplexName"
                                        id="hostofficecomplexName"
                                        placeholder="Enter your company complex name"
                                        v-model.trim="
                                            $v.hostOffice.officecomplexName
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
                                            $v.hostOffice.officecomplexName
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
                                        $v.hostOffice.officefloor.$error,
                                }"
                            >
                                <label for="hostofficefloor">
                                    Floor
                                    <input
                                        type="text"
                                        name="officefloor"
                                        id="hostofficefloor"
                                        placeholder="Enter your company floor"
                                        v-model.trim="
                                            $v.hostOffice.officefloor.$model
                                        "
                                    />
                                    <span
                                        v-if="errors && errors.officefloor"
                                        class="errMsg"
                                        >{{ errors.officefloor[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.hostOffice.officefloor"
                                        :validation="['required', 'minLength']"
                                    ></vue-validation>
                                </label>
                            </div>
                            <div
                                class="form-group"
                                :class="{
                                    'form-group--error':
                                        $v.hostOffice.officedoorNo.$error,
                                }"
                            >
                                <label for="hostofficedoorNo">
                                    Door No
                                    <input
                                        type="text"
                                        name="officedoorNo"
                                        id="hostofficedoorNo"
                                        placeholder="Enter your company door no"
                                        v-model.trim="
                                            $v.hostOffice.officedoorNo.$model
                                        "
                                    />
                                    <span
                                        v-if="errors && errors.officedoorNo"
                                        class="errMsg"
                                        >{{ errors.officedoorNo[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.hostOffice.officedoorNo"
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
                                        $v.hostOffice.officestreetNo.$error,
                                }"
                            >
                                <label for="hostofficestreetNo">
                                    Street Name/No
                                    <input
                                        type="text"
                                        name="officestreetNo"
                                        id="hostofficestreetNo"
                                        placeholder="Enter your company street no"
                                        v-model.trim="
                                            $v.hostOffice.officestreetNo.$model
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
                                            $v.hostOffice.officestreetNo
                                        "
                                        :validation="['required', 'minLength']"
                                    ></vue-validation>
                                </label>
                            </div>
                            <div
                                class="form-group"
                                :class="{
                                    'form-group--error':
                                        $v.hostOffice.officearea.$error,
                                }"
                            >
                                <label for="hostofficearea">
                                    Area
                                    <input
                                        type="text"
                                        name="officearea"
                                        id="hostoofficearea"
                                        placeholder="Enter your company area"
                                        v-model.trim="
                                            $v.hostOffice.officearea.$model
                                        "
                                    />
                                    <span
                                        v-if="errors && errors.officearea"
                                        class="errMsg"
                                        >{{ errors.officearea[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.hostOffice.officearea"
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
                                        $v.hostOffice.officestate.$error,
                                }"
                            >
                                <label for="hostofficestate">
                                    State
                                    <select
                                        v-model.trim="
                                            $v.hostOffice.officestate.$model
                                        "
                                        name="oaccstate"
                                        id="oaccstate"
                                        @change="getDistricts($event, 'office')"
                                    >
                                        <option hidden disabled selected>
                                            Select state
                                        </option>
                                        <option
                                            v-for="item in officeStates"
                                            :key="item.name"
                                            :value="item.name"
                                        >
                                            {{ item.name }}
                                        </option>
                                    </select>
                                    <span
                                        v-if="errors && errors.officestate"
                                        class="errMsg"
                                        >{{ errors.officestate[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.hostOffice.officestate"
                                        :validation="['required']"
                                    ></vue-validation>
                                </label>
                            </div>
                            <div
                                class="form-group"
                                :class="{
                                    'form-group--error':
                                        $v.hostOffice.officedistrict.$error,
                                }"
                            >
                                <label for="hostofficedistrict">
                                    District
                                    <select
                                        v-model.trim="
                                            $v.hostOffice.officedistrict.$model
                                        "
                                        name="accdistrict"
                                        id="accdistrict"
                                        required
                                    >
                                        <option disabled value="">
                                            Select District
                                        </option>
                                        <option
                                            v-for="(
                                                item, index
                                            ) in officeDistrict"
                                            :key="index"
                                            :value="item.name"
                                        >
                                            {{ item.name }}
                                        </option>
                                    </select>
                                    <span
                                        v-if="errors && errors.officedistrict"
                                        class="errMsg"
                                        >{{ errors.officedistrict[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="
                                            $v.hostOffice.officedistrict
                                        "
                                        :validation="['required']"
                                    ></vue-validation>
                                </label>
                            </div>
                            <div
                                class="form-group"
                                :class="{
                                    'form-group--error':
                                        $v.hostOffice.officepin.$error,
                                }"
                            >
                                <label for="hostofficepint">
                                    Pin
                                    <input
                                        type="text"
                                        name="officepin"
                                        id="hostofficepin"
                                        placeholder="Enter your company pin"
                                        v-model.trim="
                                            $v.hostOffice.officepin.$model
                                        "
                                    />
                                    <span
                                        v-if="errors && errors.officepin"
                                        class="errMsg"
                                        >{{ errors.officepin[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.hostOffice.officepin"
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
                                        $v.hostOffice.officereachus.$error,
                                }"
                            >
                                <label for="hostofficereachus">
                                    Map Location
                                    <input
                                        type="text"
                                        name="officereachus"
                                        id="hostofficereachus"
                                        placeholder="Enter your company map location"
                                        v-model.trim="
                                            $v.hostOffice.officereachus.$model
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
                                            $v.hostOffice.officereachus
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
                            <!-- <a
                                href="/host/welcome"
                                data-id="office-details"
                                type="button"
                            >
                                <i class="fas fa-home"></i>
                            </a> -->
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
//const digits_validate = (value) => value.length == 10;
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
    props: ["hostId", "exists", "cexists", "oexists", "subscription"],
    data() {
        return {
            loader: false,
            hostProfile: {
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
                host_id: this.hostId,
            },
            hostHome: {
                complexName: null,
                floor: null,
                doorNo: null,
                streetNo: null,
                area: null,
                district: null,
                pin: null,
                state: null,
                reachus: null,
                host_id: this.hostId,
            },
            hostOffice: {
                officecompanyName: null,
                officecomplexName: null,
                officefloor: null,
                officedoorNo: null,
                officestreetNo: null,
                officearea: null,
                officedistrict: null,
                officepin: null,
                officestate: null,
                officereachus: null,
                host_id: this.hostId,
            },
            sendProfile_imageOne: null,
            hostProfile_logo: null,
            exist: this.exists,
            cexist: this.cexists,
            oexist: this.oexists,
            profileId: null,
            companyId: null,
            officeId: null,
            hostDetails: null,
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
            pedit: false,
            cedit: false,
            oedit: false,
            personalfileOpen: false,
            profilePicPreview: null,
            companyPicPreview: null,
            profileDataSubmitted: false,
            companyDataSubmitted: false,
            relationList: ["Bride", "Groom"],
            states: [],
            district: [],
            officeStates: [],
            officeDistrict: [],
            showForm: false,
        };
    },
    validations: {
        hostProfile: {
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
            relation: {},
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
        hostHome: {
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
                minLength: minLength(1),
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
                minLength: minLength(1),
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
            reachus: { required, url },
        },
        hostOffice: {
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
            },
            officestate: {
                required,
            },
            officepin: {
                required,
                maxLength: maxLength(6),
                numeric,
            },

            officereachus: { required, url },
        },
    },
    methods: {
        getStates() {
            var _this = this;
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
                    _this.officeStates = _this.locationMaster.filter(function (
                        item
                    ) {
                        if (item.parent_id == 1) {
                            return { name: item.name, id: item.id };
                        }
                    });
                    _this.$nextTick(function () {
                        _this.gethostprofile();
                    });
                })
                .catch((errors) => {
                    console.log("Get All: " + errors);
                });
        },
        getDistricts(e, type) {
            let _this = this;
            let val = e.currentTarget.value;
            let customID = _this.locationMaster.find(function (item) {
                return item.name == val;
            });

            if (type == "home") {
                _this.district = [];
                this.locationMaster.map(function (el) {
                    if ('"' + el.parent_id + '"' == '"' + customID.id + '"') {
                        _this.district.push({ id: el.id, name: el.name });
                    }
                });
            }

            if (type == "office") {
                _this.officeDistrict = [];
                this.locationMaster.map(function (el) {
                    if ('"' + el.parent_id + '"' == '"' + customID.id + '"') {
                        _this.officeDistrict.push({ id: el.id, name: el.name });
                    }
                });
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
                this.hostProfile_logo = e.target.files[0];
                this.companyPicPreview = URL.createObjectURL(
                    this.hostProfile_logo
                );
                if (this.hostProfile.imageOne) {
                    delete this.hostProfile.imageOne;
                }
            }
        },
        // editForm(e) {
        //     let id = e.currentTarget.parentElement.parentElement.id;
        //     $(`#${id} .ven-profile-form-submit button[type=submit]`).css(
        //         "display",
        //         "block"
        //     );
        //     $(`#${id} input`).removeAttr("disabled");
        //     $(`#host-logo`).removeAttr("required");
        //     $("#company-logo").removeAttr("required");
        //     $(`#${id} input`).eq(1).focus();
        //     if (id == "host-details") {
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
            this.showForm = true;
            this.$nextTick(function () {
                let id = null;
                if (bool == true) {
                    id = e.currentTarget.dataset.id;
                }
                if (bool == false) {
                    id = e;
                }
                if (id != "company-details") {
                    this.personalfileOpen = true;
                } else {
                    this.personalfileOpen = false;
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
            });
        },
        submitProfile(e) {
            var _this = this;
            this.$v.hostHome.$touch();
            if (_this.$v.hostHome.$invalid == true) {
                _this.message =
                    "Kindly enter the correct inputs to submit the form!";
                setTimeout(function () {
                    _this.message = null;
                }, 3000);
                return;
            }
            _this.errors = null;
            this.pprofileDisabled = true;
            let formData = new FormData();
            let data = JSON.stringify(_this.hostHome);
            formData.append("data", data);
            formData.append("type", "home");
            this.loader = true;
            if (this.pedit) {
                formData.append("_method", "PATCH");
                let updateId = this.hostHome.id;
                if (this.profileId != null) {
                    updateId = parseInt(this.profileId);
                }
                axios
                    .post(`/api/host/profile/${updateId}`, formData)
                    .then(function (response) {
                        _this.loader = false;
                        _this.pedit = false;
                        _this.toggleForm("office-details", false);
                        _this.message = "Home Profile updated";
                        _this.exist = 1;
                        _this.pprofileDisabled = false;
                        // _this.updateEdit();
                        // $(
                        //     `#host-details .ven-profile-form-submit button[type=submit]`
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
                .post(`/api/host/profile`, formData)
                .then(function (response) {
                    console.log(response.data);
                    _this.loader = false;
                    _this.toggleForm("office-details", false);
                    _this.message = "Home Profile Uploaded";
                    _this.exist = 1;
                    _this.pprofileDisabled = false;
                    _this.profileId = response.data;
                    _this.hostHome.id = response.data;
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
            this.$v.hostProfile.$touch();
            if (_this.$v.hostProfile.$invalid == true) {
                _this.message =
                    "Kindly enter the correct inputs to submit the form!";
                setTimeout(function () {
                    _this.message = null;
                }, 3000);
                return;
            }
            _this.errors = null;
            this.cprofileDisabled = true;
            //this.hostProfile.host_id = _this.hostId;
            const config = {
                headers: { "content-type": "multipart/form-data" },
            };

            let formData = new FormData();
            let data = JSON.stringify(_this.hostProfile);
            let img = this.hostProfile_logo;
            formData.append("type", "personal");
            formData.append("personalimg", img);
            formData.append("data", data);
            this.loader = true;
            if (this.cedit) {
                formData.append("_method", "PATCH");
                let updateId = this.hostProfile.id;
                if (this.companyId != null) {
                    updateId = this.companyId;
                }
                axios
                    .post(`/api/host/profile/${updateId}`, formData, config)
                    .then(function (response) {
                        _this.loader = false;
                        _this.cedit = false;
                        _this.toggleForm("host-details", false);
                        _this.personalfileOpen = true;
                        _this.message = "Personal Profile updated";
                        // _this.updateEdit();
                        _this.cprofileDisabled = false;
                        // $(
                        //     `#company-details .ven-profile-form-submit button[type=submit]`
                        // ).css("display", "none");
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
            // if (this.hostProfile_logo == null) {
            //     _this.errors = { companyimg: ["Profile picture is required"] };
            //     _this.loader = false;
            //     _this.cprofileDisabled = false;
            //     return;
            // }
            axios
                .post(`/api/host/profile`, formData, config)
                .then(function (response) {
                    _this.loader = false;
                    _this.toggleForm("host-details", false);

                    _this.personalfileOpen = true;
                    _this.hostProfile_logo = null;
                    _this.message = "Personal Profile Uploaded";
                    _this.cexist = 1;
                    _this.cprofileDisabled = false;
                    //_this.updateEdit();
                    _this.companyId = response.data;
                    _this.hostProfile.id = response.data;
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
            this.$v.hostOffice.$touch();
            if (_this.$v.hostOffice.$invalid == true) {
                _this.message =
                    "Kindly enter the correct inputs to submit the form!";
                setTimeout(function () {
                    _this.message = null;
                }, 3000);
                return;
            }
            _this.errors = null;
            this.oprofileDisabled = true;
            let formData = new FormData();
            let data = JSON.stringify(_this.hostOffice);
            formData.append("data", data);
            formData.append("type", "office");
            this.loader = true;
            if (this.oedit) {
                formData.append("_method", "PATCH");
                let updateId = this.hostOffice.id;
                if (this.officeId != null) {
                    updateId = parseInt(this.officeId);
                }
                axios
                    .post(`/api/host/profile/${updateId}`, formData)
                    .then(function (response) {
                        _this.loader = false;
                        _this.oedit = false;
                        // _this.toggleForm("office-details", false);
                        _this.oprofileDisabled = false;
                        _this.message = "Office Profile updated";
                        _this.oexist = 1;
                        //_this.updateEdit();
                        // $(
                        //     `#office-details .ven-profile-form-submit button[type=submit]`
                        // ).css("display", "none");
                        setTimeout(function () {
                            _this.message = null;
                        }, 3000);
                    })
                    .catch((error) => {
                        console.log(error);
                        _this.oprofileDisabled = false;
                        _this.loader = false;
                        _this.errors = error.response.data.errors;
                        console.log(error.response.data.errors);
                    });
                return;
            }
            axios
                .post(`/api/host/profile`, formData)
                .then(function (response) {
                    console.log(response.data);
                    _this.loader = false;
                    //_this.toggleForm("office-details", false);
                    _this.message = "office Profile Uploaded";
                    _this.oexist = 1;
                    _this.oprofileDisabled = false;
                    _this.officeId = response.data;
                    _this.hostOffice.id = response.data;
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
        gethostprofile() {
            var _this = this;
            var v = this.hostId;

            axios
                .get(`/api/host/profile/${v}`)
                .then(function (response) {
                    console.log(response);
                    _this.hostDetails = response.data[0];
                    if (response.data[1]) {
                        _this.hostProfile = response.data[1];
                        delete _this.hostProfile.created_at;
                        delete _this.hostProfile.deleted_at;
                        delete _this.hostProfile.updated_at;
                    }
                    if (response.data[2]) {
                        _this.hostOffice = response.data[2];
                        delete _this.hostOffice.created_at;
                        delete _this.hostOffice.deleted_at;
                        delete _this.hostOffice.updated_at;

                        _this.$nextTick(function () {
                            if (
                                _this.hostOffice.officedistrict != null &&
                                _this.hostOffice.officedistrict != ""
                            ) {
                                let stateOffice = _this.hostOffice.officestate;
                                let customID = _this.locationMaster.find(
                                    function (item) {
                                        return item.name == stateOffice;
                                    }
                                );
                                _this.officeDistrict = [];
                                _this.locationMaster.map(function (el) {
                                    if (
                                        '"' + el.parent_id + '"' ==
                                        '"' + customID.id + '"'
                                    ) {
                                        _this.officeDistrict.push({
                                            id: el.id,
                                            name: el.name,
                                        });
                                    }
                                });
                            }
                        });
                        setTimeout(function () {}, 1000);
                    }
                    if (response.data[3]) {
                        _this.hostHome = response.data[3];
                        delete _this.hostHome.created_at;
                        delete _this.hostHome.deleted_at;
                        delete _this.hostHome.updated_at;

                        _this.$nextTick(function () {
                            if (
                                _this.hostHome.district != null &&
                                _this.hostHome.district != ""
                            ) {
                                let stateHome = _this.hostHome.state;
                                let customID = _this.locationMaster.find(
                                    function (item) {
                                        return item.name == stateHome;
                                    }
                                );
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
                        });
                        setTimeout(function () {}, 1000);
                    }
                })
                .catch((errors) => {
                    console.log("Get All: " + errors);
                });
        },
        // updateEdit() {
        //     if (this.exist == 1) {
        //         //console.log($("#host-details input"));
        //         $("#host-details input").attr("disabled", true);
        //         $("#host-details select").attr("disabled", true);
        //         this.pprofileDisabled = true;
        //     }
        //     if (this.cexist == 1) {
        //         //console.log($("#company-details input"));
        //         $("#company-details input").attr("disabled", true);
        //         $("#company-details select").attr("disabled", true);
        //         $("#company-logo").attr("disabled", true);
        //         this.cprofileDisabled = true;
        //         // if (this.exist == 0) {
        //         //     this.toggleForm("host-details", false);
        //         //     this.personalfileOpen = true;
        //         // }
        //     }
        //     if (this.oexist == 1) {
        //         //console.log($("#host-details input"));
        //         $("#office-details input").attr("disabled", true);
        //         $("#office-details select").attr("disabled", true);
        //         this.oprofileDisabled = true;
        //     }
        // },
    },
    mounted() {
        this.$nextTick(function () {
            this.getStates();
            //this.gethostprofile();
            // this.updateEdit();
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
.host-preview-upload {
    border: 0.162319px solid #959595;
    box-sizing: border-box;
    border-radius: 8.11594px;
    grid-column-start: 1;
    grid-column-end: -1;
    padding: 1.5em;
}
.host-preview-upload > label {
    background: #efefef;
    border-radius: 4.05797px;
    width: 100%;
    cursor: pointer;
    position: relative;
}
#host-preview-upload-dropzone {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 2em;
}
#host-preview-upload-dropzone > span:nth-child(1) {
    width: 45px;
    height: 45px;
    background: #dfdfdf;
    border-radius: 50%;
    margin-bottom: 5px;
}
#host-preview-upload-dropzone > span:nth-child(1) > img {
    width: 21px;
    height: 21px;
    margin-top: 12px;
    margin-left: 12px;
}
#host-preview-upload-dropzone > span:nth-child(2) {
    font-family: Poppins;
    font-style: normal;
    font-weight: 500;
    font-size: 9.58349px;
    line-height: 14px;
    color: #000000;
    margin-bottom: 5px;
}
#host-preview-upload-dropzone > span:nth-child(3) {
    font-family: Poppins;
    font-style: normal;
    font-weight: 300;
    font-size: 6.59415px;
    line-height: 10px;
    color: #7c7c7c;
}
#host-preview-upload-dragtext {
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
    color: red !important;
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
    background: #f4f3fa;
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
.host-logo-upload > label {
    display: flex;
    flex-direction: column;
    width: max-content;
    text-align: center;
    margin: 0.5em auto;
    position: relative;
    cursor: pointer;
}
.host-logo-upload img {
    width: 61px;
    height: 61px;
    border-radius: 50%;
}
/* .host-logo-upload > label > span:nth-child(2) {
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
} */

#host-details > h1 {
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
#office-details > h1 {
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
.host-details-form-fields {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    grid-auto-rows: max-content;
    column-gap: 12px;
    row-gap: 4px;
}
.host-details-form-fields > div > label {
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
.host-details-form-fields > div > label input,
.host-details-form-fields > div > label select {
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
.inside-label {
    display: flex;
}
.inside-label > label {
    flex: 1;
    font-size: 13px;
}
.inside-label > label > input {
    margin-right: 10px;
}
.guest-address-form-fields {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    column-gap: 12px;
    row-gap: 4px;
}

.host-address-form-fields {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    column-gap: 12px;
    row-gap: 4px;
}
/* .host-address-form-fields > label:first-child {
    grid-column-start: 1;
    grid-column-end: -1;
} */
/* .host-address-form-fields > label:last-child {
    grid-column-start: 1;
    grid-column-end: -1;
    position: relative;
} */
.host-address-form-fields > label {
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
#hostCategories {
    padding: 0px 25px 9px 0px;
    margin-left: -4px;
    border: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    background: #ffffff;
    border-radius: 5px;
    background-image: url("/assets/hosts/dashboard/dropdown-arrow.svg");
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
#hostCategories > option {
    font-family: Segoe UI;
    font-style: normal;
    font-weight: normal;
    font-size: 10px;
    line-height: 13px;
    color: #3d3838;
}
.host-address-form-fields > label > input {
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

.ven-profile-form-submit > button:nth-child(1),
.subscribe > a {
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
.ven-profile-form-submit > a {
    display: flex;
    justify-content: center;
    align-items: center;
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
.right-details > span {
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
.profile-view-plan-cont {
    border: 0.5px solid #dcdcdc;
    border-radius: 5px;
    padding: 29px 18px;
    margin-top: 30px;
}
.plan-detail-head {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
}
.plan-detail-head > h1 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 17.6px;
    line-height: 26px;
    color: #000000;
}
.plan-detail-head > a {
    text-decoration: none;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 13.9535px;
    line-height: 21px;
    color: #c4456f;
    background: rgba(196, 69, 111, 0.1);
    border-radius: 6.97674px;
    padding: 4px 12px;
}
.plan-head-name {
    display: flex;
    align-items: flex-end;
}
.plan-head-name > .type {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 600;
    font-size: 20.4084px;
    line-height: 31px;
    text-align: center;
    color: #5b5252;
    margin-right: 10px;
}
.plan-head-name > .price {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 31.5434px;
    line-height: 36px;
    text-align: center;
    color: #138ab3;
    margin-right: 10px;
}
.plan-head-name > .validity {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 10.4717px;
    line-height: 16px;
    color: #ada2a2;
}
.plan-head-expiry {
    border: 0.448598px solid #d1d1d1;
    border-radius: 7.17757px;
    padding: 9px 12px;
    margin-left: 15px;
    margin-bottom: -15px;
}
.plan-head-expiry > div:nth-child(1) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 300;
    font-size: 12.519px;
    line-height: 19px;
    color: #000000;
}
.plan-head-expiry > div:nth-child(2) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 15.0555px;
    line-height: 23px;
    color: #000000;
}
.plan-feature-details > div {
    background: #f6f7f9;
    border-radius: 3.62305px;
    padding: 9px 22px;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 15.3063px;
    line-height: 23px;
    color: #5b5252;
    display: flex;
}
.plan-feature-details > div:nth-child(even) {
    background: #ffffff;
}
.plan-feature-details > div > span:nth-child(1) {
    display: inline-block;
    width: 60%;
}
.plan-feature-details > div > span:nth-child(2) {
    display: inline-block;
    width: 40%;
    text-align: center;
}
.filter-pink {
    filter: invert(32%) sepia(76%) saturate(1107%) hue-rotate(303deg)
        brightness(90%) contrast(81%);
}
@media screen and (max-width: 762px) {
    .host-details-form-fields {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    }
    .host-address-form-fields {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    }
    .host-preview-form-fields {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    }
    .profile-view-plan-cont > div:nth-child(2) {
        width: 100% !important;
    }
    .profile-view-plan-cont > div:nth-child(2) > div:nth-child(1) {
        flex-wrap: wrap;
        justify-content: center;
    }
    .plan-head-name {
        width: 100%;
        justify-content: center;
        margin-bottom: 10px;
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






