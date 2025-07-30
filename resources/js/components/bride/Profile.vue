<template>
    <div>
        <div class="container ven-profile-form">
            <div class="row">
                <h2 id="ven-profile-form-head">PROFILE</h2>

                <div class="bride-logo-upload">
                    <label v-if="!personalfileOpen" for="company-logo">
                        <img
                            v-if="companyPicPreview"
                            :src="companyPicPreview"
                            alt=""
                        />
                        <img
                            v-else-if="brideProfile.imageOne"
                            :src="
                                '/assets/brides/uploads/' +
                                brideProfile.imageOne
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
                    <!-- <label v-if="personalfileOpen" for="bride-logo">
                        <img
                            v-if="profilePicPreview"
                            :src="profilePicPreview"
                            alt=""
                        />
                        <img
                            v-else-if="sendProfile.imageOne"
                            :src="
                                '/assets/brides/uploads/' + sendProfile.imageOne
                            "
                            alt=""
                        />
                        <img
                            v-else
                            src="/assets/brides/dashboard/ven-logo-upload.png"
                            alt=""
                        />
                        <span>Add</span>
                        <span v-if="errors && errors.img" class="errMsg">{{
                            errors.img[0]
                        }}</span>
                    </label> -->
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
                        data-id="bride-details"
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
                                v-if="cexist == 1 && cedit == false"
                                @click="editForm($event)"
                                style="
                                    outline: none;
                                    border: none;
                                    margin-bottom: 10px;
                                    margin-right: 20px;
                                    padding: 0;
                                "
                                type="button"
                            >
                                <img
                                    src="/assets/miscellenous/Frame-929.svg"
                                    alt=""
                                />
                            </button>
                            <a
                                style="
                                    margin-bottom: 10px;
                                    margin-right: 20px;
                                    text-decoration: none;
                                "
                                :href="'/bride/' + routeSlug + '/Welcome'"
                                data-id="office-details"
                            >
                                <img
                                    src="/assets/miscellenous/Frame-930.svg"
                                    alt=""
                                />
                            </a>
                        </div>
                        <div class="bride-details-form-fields">
                            <div
                                class="form-group"
                                :class="{
                                    'form-group--error':
                                        $v.brideProfile.name.$error,
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
                                            $v.brideProfile.name.$model
                                        "
                                    />
                                    <span
                                        v-if="errors && errors.name"
                                        class="errMsg"
                                        >{{ errors.name[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.brideProfile.name"
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
                                        $v.brideProfile.fatherName.$error,
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
                                            $v.brideProfile.fatherName.$model
                                        "
                                    />
                                    <span
                                        v-if="errors && errors.fatherName"
                                        class="errMsg"
                                        >{{ errors.fatherName[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.brideProfile.fatherName"
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
                                        $v.brideProfile.surname.$error,
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
                                            $v.brideProfile.surname.$model
                                        "
                                    />
                                    <span
                                        v-if="errors && errors.surname"
                                        class="errMsg"
                                        >{{ errors.surname[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.brideProfile.surname"
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
                                        $v.brideProfile.age.$error,
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
                                            $v.brideProfile.age.$model
                                        "
                                    />
                                    <span
                                        v-if="errors && errors.age"
                                        class="errMsg"
                                        >{{ errors.age[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.brideProfile.age"
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
                                        $v.brideProfile.gender.$error,
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
                                                    $v.brideProfile.gender
                                                        .$model
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
                                                    $v.brideProfile.gender
                                                        .$model
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
                                        :nestedName="$v.brideProfile.gender"
                                        :validation="['required']"
                                    ></vue-validation>
                                </label>
                            </div>
                            <!-- <div
                                class="form-group"
                                :class="{
                                    'form-group--error':
                                        $v.brideProfile.relation.$error,
                                }"
                            >
                                <label for="relation">
                                    Relation
                                    <select
                                        v-model.trim="
                                            $v.brideProfile.relation.$model
                                        "
                                        name="accType"
                                        id="accType"
                                        required
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
                                        :nestedName="$v.brideProfile.relation"
                                        :validation="['required']"
                                    ></vue-validation>
                                </label>
                            </div> -->
                            <div
                                class="form-group"
                                :class="{
                                    'form-group--error':
                                        $v.brideProfile.email.$error,
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
                                            $v.brideProfile.email.$model
                                        "
                                    />
                                    <span
                                        v-if="errors && errors.email"
                                        class="errMsg"
                                        >{{ errors.email[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.brideProfile.email"
                                        :validation="['required', 'email']"
                                    ></vue-validation>
                                </label>
                            </div>
                            <div
                                class="form-group"
                                :class="{
                                    'form-group--error':
                                        $v.brideProfile.phone.$error,
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
                                            $v.brideProfile.phone.$model
                                        "
                                    />
                                    <span
                                        v-if="errors && errors.phone"
                                        class="errMsg"
                                        >{{ errors.phone[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.brideProfile.phone"
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
                                        $v.brideProfile.mobile.$error,
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
                                            $v.brideProfile.mobile.$model
                                        "
                                    />
                                    <span
                                        v-if="errors && errors.mobile"
                                        class="errMsg"
                                        >{{ errors.mobile[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.brideProfile.mobile"
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
                                        $v.brideProfile.mobile1.$error,
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
                                            $v.brideProfile.mobile1.$model
                                        "
                                    />
                                    <span
                                        v-if="errors && errors.mobile1"
                                        class="errMsg"
                                        >{{ errors.mobile1[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.brideProfile.mobile1"
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
                                        $v.brideProfile.whatsup.$error,
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
                                            $v.brideProfile.whatsup.$model
                                        "
                                    />
                                    <span
                                        v-if="errors && errors.whatsup"
                                        class="errMsg"
                                        >{{ errors.whatsup[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.brideProfile.whatsup"
                                        :validation="[
                                            'required',
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
                                data-id="bride-categories"
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
                                data-id="bride-details"
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
                        id="bride-details"
                        data-id="company-details"
                    >
                        <!-- <input
                            v-show="personalfileOpen"
                            type="file"
                            id="bride-logo"
                            name="bride-logo"
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
                                v-if="exist == 1 && pedit == false"
                                @click="editForm($event)"
                                style="
                                    outline: none;
                                    border: none;
                                    margin-bottom: 10px;
                                    margin-right: 20px;
                                    padding: 0;
                                "
                                type="button"
                            >
                                <img
                                    src="/assets/miscellenous/Frame-929.svg"
                                    alt=""
                                />
                            </button>
                            <a
                                style="
                                    margin-bottom: 10px;
                                    margin-right: 20px;
                                    text-decoration: none;
                                "
                                :href="'/bride/' + routeSlug + '/Welcome'"
                                data-id="office-details"
                                type="button"
                            >
                                <img
                                    src="/assets/miscellenous/Frame-930.svg"
                                    alt=""
                                />
                            </a>
                        </div>
                        <div class="bride-details-form-fields">
                            <div
                                class="form-group"
                                :class="{
                                    'form-group--error':
                                        $v.brideHome.complexName.$error,
                                }"
                            >
                                <label for="bridecomplexName">
                                    Complex Name
                                    <input
                                        type="text"
                                        name="complexName"
                                        id="bridecomplexName"
                                        placeholder="Enter your complex name"
                                        v-model.trim="
                                            $v.brideHome.complexName.$model
                                        "
                                    />
                                    <span
                                        v-if="errors && errors.complexName"
                                        class="errMsg"
                                        >{{ errors.complexName[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.brideHome.complexName"
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
                                        $v.brideHome.floor.$error,
                                }"
                            >
                                <label for="bridefloor">
                                    Floor
                                    <input
                                        type="text"
                                        name="floor"
                                        id="bridefloor"
                                        placeholder="Enter your floor"
                                        v-model.trim="$v.brideHome.floor.$model"
                                    />
                                    <span
                                        v-if="errors && errors.floor"
                                        class="errMsg"
                                        >{{ errors.floor[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.brideHome.floor"
                                        :validation="['required', 'minLength']"
                                    ></vue-validation>
                                </label>
                            </div>
                            <div
                                class="form-group"
                                :class="{
                                    'form-group--error':
                                        $v.brideHome.doorNo.$error,
                                }"
                            >
                                <label for="bridedoorNo">
                                    Door No.
                                    <input
                                        type="text"
                                        name="doorNo"
                                        id="bridedoorNo"
                                        placeholder="Enter your doorNo"
                                        v-model.trim="
                                            $v.brideHome.doorNo.$model
                                        "
                                    />
                                    <span
                                        v-if="errors && errors.doorNo"
                                        class="errMsg"
                                        >{{ errors.doorNo[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.brideHome.doorNo"
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
                                        $v.brideHome.streetNo.$error,
                                }"
                            >
                                <label for="bridestreetNo">
                                    Street Name/No.
                                    <input
                                        type="text"
                                        name="streetNo"
                                        id="bridestreetNo"
                                        placeholder="Enter your streetNo"
                                        v-model.trim="
                                            $v.brideHome.streetNo.$model
                                        "
                                    />
                                    <span
                                        v-if="errors && errors.streetNo"
                                        class="errMsg"
                                        >{{ errors.streetNo[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.brideHome.streetNo"
                                        :validation="['required', 'minLength']"
                                    ></vue-validation>
                                </label>
                            </div>
                            <div
                                class="form-group"
                                :class="{
                                    'form-group--error':
                                        $v.brideHome.area.$error,
                                }"
                            >
                                <label for="bridearea">
                                    Area
                                    <input
                                        type="text"
                                        name="area"
                                        id="bridearea"
                                        placeholder="Enter your area"
                                        v-model.trim="$v.brideHome.area.$model"
                                    />
                                    <span
                                        v-if="errors && errors.area"
                                        class="errMsg"
                                        >{{ errors.area[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.brideHome.area"
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
                                        $v.brideHome.state.$error,
                                }"
                            >
                                <label for="bridestate">
                                    State
                                    <select
                                        v-model.trim="$v.brideHome.state.$model"
                                        name="accstate"
                                        id="accstate"
                                        @change="getDistricts($event, 'home')"
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
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.brideHome.state"
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
                                        $v.brideHome.district.$error,
                                }"
                            >
                                <label for="bridedistrict">
                                    District
                                    <select
                                        v-model.trim="
                                            $v.brideHome.district.$model
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
                                        :nestedName="$v.brideHome.district"
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
                                        $v.brideHome.pin.$error,
                                }"
                            >
                                <label for="bridepin">
                                    Pin
                                    <input
                                        type="text"
                                        name="pin"
                                        id="bridepin"
                                        placeholder="Enter your pin"
                                        v-model.trim="$v.brideHome.pin.$model"
                                    />
                                    <span
                                        v-if="errors && errors.pin"
                                        class="errMsg"
                                        >{{ errors.pin[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.brideHome.pin"
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
                                        $v.brideHome.reachus.$error,
                                }"
                            >
                                <label for="bridereachus">
                                    Map location
                                    <input
                                        type="text"
                                        name="reachus"
                                        id="bridereachus"
                                        placeholder="Enter your map location"
                                        v-model.trim="
                                            $v.brideHome.reachus.$model
                                        "
                                    />
                                    <span
                                        v-if="errors && errors.reachus"
                                        class="errMsg"
                                        >{{ errors.reachus[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.brideHome.reachus"
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
                                style="display: none"
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
                            id="bride-logo"
                            name="bride-logo"
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
                                v-if="oexist == 1 && oedit == false"
                                @click="editForm($event)"
                                style="
                                    outline: none;
                                    border: none;
                                    padding: 0;
                                    margin-bottom: 10px;
                                    margin-right: 20px;
                                "
                                type="button"
                            >
                                <img
                                    src="/assets/miscellenous/Frame-929.svg"
                                    alt=""
                                />
                            </button>
                            <a
                                style="
                                    margin-bottom: 10px;
                                    margin-right: 20px;
                                    text-decoration: none;
                                "
                                :href="'/bride/' + routeSlug + '/Welcome'"
                                data-id="office-details"
                                type="button"
                            >
                                <img
                                    src="/assets/miscellenous/Frame-930.svg"
                                    alt=""
                                />
                            </a>
                        </div>
                        <div class="bride-details-form-fields">
                            <div
                                class="form-group"
                                :class="{
                                    'form-group--error':
                                        $v.brideOffice.officecompanyName.$error,
                                }"
                            >
                                <label for="brideofficecompanyName">
                                    Company Name
                                    <input
                                        type="text"
                                        name="officecompanyName"
                                        id="brideofficecompanyName"
                                        placeholder="Enter your company name"
                                        v-model.trim="
                                            $v.brideOffice.officecompanyName
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
                                            $v.brideOffice.officecompanyName
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
                                        $v.brideOffice.officecomplexName.$error,
                                }"
                            >
                                <label for="brideofficecomplexName">
                                    Complex Name
                                    <input
                                        type="text"
                                        name="officecomplexName"
                                        id="brideofficecomplexName"
                                        placeholder="Enter your company complex name"
                                        v-model.trim="
                                            $v.brideOffice.officecomplexName
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
                                            $v.brideOffice.officecomplexName
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
                                        $v.brideOffice.officefloor.$error,
                                }"
                            >
                                <label for="brideofficefloor">
                                    Floor
                                    <input
                                        type="text"
                                        name="officefloor"
                                        id="brideofficefloor"
                                        placeholder="Enter your company floor"
                                        v-model.trim="
                                            $v.brideOffice.officefloor.$model
                                        "
                                    />
                                    <span
                                        v-if="errors && errors.officefloor"
                                        class="errMsg"
                                        >{{ errors.officefloor[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.brideOffice.officefloor"
                                        :validation="['required', 'minLength']"
                                    ></vue-validation>
                                </label>
                            </div>
                            <div
                                class="form-group"
                                :class="{
                                    'form-group--error':
                                        $v.brideOffice.officedoorNo.$error,
                                }"
                            >
                                <label for="brideofficedoorNo">
                                    Door No
                                    <input
                                        type="text"
                                        name="officedoorNo"
                                        id="brideofficedoorNo"
                                        placeholder="Enter your company door no"
                                        v-model.trim="
                                            $v.brideOffice.officedoorNo.$model
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
                                            $v.brideOffice.officedoorNo
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
                                        $v.brideOffice.officestreetNo.$error,
                                }"
                            >
                                <label for="brideofficestreetNo">
                                    Street Name/No
                                    <input
                                        type="text"
                                        name="officestreetNo"
                                        id="brideofficestreetNo"
                                        placeholder="Enter your company street no"
                                        v-model.trim="
                                            $v.brideOffice.officestreetNo.$model
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
                                            $v.brideOffice.officestreetNo
                                        "
                                        :validation="['required', 'minLength']"
                                    ></vue-validation>
                                </label>
                            </div>
                            <div
                                class="form-group"
                                :class="{
                                    'form-group--error':
                                        $v.brideOffice.officearea.$error,
                                }"
                            >
                                <label for="brideofficearea">
                                    Area
                                    <input
                                        type="text"
                                        name="officearea"
                                        id="brideoofficearea"
                                        placeholder="Enter your company area"
                                        v-model.trim="
                                            $v.brideOffice.officearea.$model
                                        "
                                    />
                                    <span
                                        v-if="errors && errors.officearea"
                                        class="errMsg"
                                        >{{ errors.officearea[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.brideOffice.officearea"
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
                                        $v.brideOffice.officestate.$error,
                                }"
                            >
                                <label for="brideofficestate">
                                    State
                                    <select
                                        v-model.trim="
                                            $v.brideOffice.officestate.$model
                                        "
                                        name="oaccstate"
                                        id="oaccstate"
                                        @change="getDistricts($event, 'office')"
                                    >
                                        <option hidden disabled selected>
                                            Select state
                                        </option>
                                        <option
                                            v-for="(
                                                item, index
                                            ) in officeStates"
                                            :key="index"
                                            :value="item"
                                        >
                                            {{ item }}
                                        </option>
                                    </select>
                                    <span
                                        v-if="errors && errors.officestate"
                                        class="errMsg"
                                        >{{ errors.officestate[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.brideOffice.officestate"
                                        :validation="['required']"
                                    ></vue-validation>
                                </label>
                            </div>
                            <div
                                class="form-group"
                                :class="{
                                    'form-group--error':
                                        $v.brideOffice.officedistrict.$error,
                                }"
                            >
                                <label for="brideofficedistrict">
                                    District
                                    <select
                                        v-model.trim="
                                            $v.brideOffice.officedistrict.$model
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
                                            $v.brideOffice.officedistrict
                                        "
                                        :validation="['required']"
                                    ></vue-validation>
                                </label>
                            </div>
                            <div
                                class="form-group"
                                :class="{
                                    'form-group--error':
                                        $v.brideOffice.officepin.$error,
                                }"
                            >
                                <label for="brideofficepint">
                                    Pin
                                    <input
                                        type="text"
                                        name="officepin"
                                        id="brideofficepin"
                                        placeholder="Enter your company pin"
                                        v-model.trim="
                                            $v.brideOffice.officepin.$model
                                        "
                                    />
                                    <span
                                        v-if="errors && errors.officepin"
                                        class="errMsg"
                                        >{{ errors.officepin[0] }}</span
                                    >
                                    <vue-validation
                                        :instance="$v"
                                        :nestedName="$v.brideOffice.officepin"
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
                                        $v.brideOffice.officereachus.$error,
                                }"
                            >
                                <label for="brideofficereachus">
                                    Map Location
                                    <input
                                        type="text"
                                        name="officereachus"
                                        id="brideofficereachus"
                                        placeholder="Enter your company map location"
                                        v-model.trim="
                                            $v.brideOffice.officereachus.$model
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
                                            $v.brideOffice.officereachus
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
                                style="display: none"
                                id="oprofilebtn"
                                :disabled="oprofileDisabled"
                                type="submit"
                            >
                                Update
                            </button>
                            <!-- <a
                                :href="
                                    '/bride/' + brideDetails.slug + '/Welcome'
                                "
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
    props: ["brideId", "exists", "cexists", "oexists"],
    data() {
        return {
            loader: false,
            brideProfile: {
                name: null,
                fatherName: null,
                surname: null,
                age: null,
                gender: null,
                email: null,
                phone: null,
                mobile: null,
                mobile1: null,
                whatsup: null,
                bride_id: this.brideId,
            },
            brideHome: {
                complexName: null,
                floor: null,
                doorNo: null,
                streetNo: null,
                area: null,
                district: null,
                pin: null,
                state: null,
                reachus: null,
                bride_id: this.brideId,
            },
            brideOffice: {
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
                bride_id: this.brideId,
            },
            sendProfile_imageOne: null,
            brideProfile_logo: null,
            exist: this.exists,
            cexist: this.cexists,
            oexist: this.oexists,
            profileId: null,
            companyId: null,
            officeId: null,
            brideDetails: null,
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
            routeSlug: null,
        };
    },
    validations: {
        brideProfile: {
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
                required,
                minLength: minLength(3),
                maxLength: maxLength(16),
                alpha: helpers.regex(
                    "alpha",
                    /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/
                ),
            },
            surname: {
                required,
                minLength: minLength(3),
                alpha: helpers.regex(
                    "alpha",
                    /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/
                ),
            },
            age: {
                required,
                maxLength: maxLength(3),
                numeric,
            },
            gender: {
                required,
            },
            email: {
                required,
                email,
            },
            phone: {
                required,
                digits_validate: helpers.regex("digits_validate", /^\d{10}$/),
                numeric,
            },
            mobile: {
                required,
                digits_validate: helpers.regex("digits_validate", /^\d{10}$/),
                numeric,
            },
            mobile1: {
                required,
                digits_validate: helpers.regex("digits_validate", /^\d{10}$/),
                numeric,
            },
            whatsup: {
                required,
                digits_validate: helpers.regex("digits_validate", /^\d{10}$/),
                numeric,
            },
        },
        brideHome: {
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
        brideOffice: {
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
                    _this.states = [
                        ...new Set(
                            _this.locationMaster.map((item) => item.state)
                        ),
                    ];
                    _this.officeStates = [
                        ...new Set(
                            _this.locationMaster.map((item) => item.state)
                        ),
                    ];
                })
                .catch((errors) => {
                    console.log("Get All: " + errors);
                });
        },
        getDistricts(e, type) {
            let _this = this;
            let val = e.currentTarget.value;

            if (type == "home") {
                _this.district = [];
                this.locationMaster.map(function (el) {
                    if ('"' + el.state + '"' == '"' + val + '"') {
                        _this.district.push({ id: el.id, name: el.name });
                    }
                });
            }

            if (type == "office") {
                _this.officeDistrict = [];
                this.locationMaster.map(function (el) {
                    if ('"' + el.state + '"' == '"' + val + '"') {
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
                this.brideProfile_logo = e.target.files[0];
                this.companyPicPreview = URL.createObjectURL(
                    this.brideProfile_logo
                );
                if (this.brideProfile.imageOne) {
                    delete this.brideProfile.imageOne;
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
            $(`#bride-logo`).removeAttr("required");
            $("#company-logo").removeAttr("required");
            $(`#${id} input`).eq(1).focus();
            if (id == "bride-details") {
                this.pedit = true;
                this.pprofileDisabled = false;
            }
            if (id == "company-details") {
                this.cedit = true;
                this.cprofileDisabled = false;
            }
            if (id == "office-details") {
                this.oedit = true;
                this.oprofileDisabled = false;
            }
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
        submitProfile(e) {
            var _this = this;
            this.$v.brideHome.$touch();
            if (_this.$v.brideHome.$invalid == true) {
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
            let data = JSON.stringify(_this.brideHome);
            formData.append("data", data);
            formData.append("type", "home");
            this.loader = true;
            if (this.pedit) {
                formData.append("_method", "PATCH");
                let updateId = this.brideHome.id;
                if (this.profileId != null) {
                    updateId = parseInt(this.profileId);
                }
                axios
                    .post(`/api/bride/profile/${updateId}`, formData)
                    .then(function (response) {
                        _this.loader = false;
                        _this.pedit = false;
                        _this.toggleForm("office-details", false);
                        _this.message = "Home Profile updated";
                        _this.exist = 1;
                        _this.updateEdit();
                        $(
                            `#bride-details .ven-profile-form-submit button[type=submit]`
                        ).css("display", "none");
                        setTimeout(function () {
                            _this.message = null;
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
                .post(`/api/bride/profile`, formData)
                .then(function (response) {
                    console.log(response.data);
                    _this.loader = false;
                    _this.toggleForm("office-details", false);
                    _this.message = "Home Profile Uploaded";
                    _this.exist = 1;
                    _this.updateEdit();
                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                })
                .catch((error) => {
                    this.pprofileDisabled = false;
                    _this.loader = false;
                    _this.errors = error.response.data.errors;
                });
        },
        submitCProfile(e) {
            var _this = this;
            this.$v.brideProfile.$touch();
            if (_this.$v.brideProfile.$invalid == true) {
                _this.message =
                    "Kindly enter the correct inputs to submit the form!";
                setTimeout(function () {
                    _this.message = null;
                }, 3000);
                return;
            }
            _this.errors = null;
            this.cprofileDisabled = true;
            //this.brideProfile.bride_id = _this.brideId;
            const config = {
                headers: { "content-type": "multipart/form-data" },
            };

            // if (_this.brideProfile.phone.length > 10) {
            //     _this.brideProfile.phone = _this.brideProfile.phone.substring(
            //         0,
            //         _this.brideProfile.phone.length - 1
            //     );
            // }
            // if (_this.brideProfile.mobile.length > 10) {
            //     _this.brideProfile.mobile = _this.brideProfile.mobile.substring(
            //         0,
            //         _this.brideProfile.mobile.length - 1
            //     );
            // }
            // if (_this.brideProfile.mobile1.length > 10) {
            //     _this.brideProfile.mobile1 = _this.brideProfile.mobile1.substring(
            //         0,
            //         _this.brideProfile.mobile1.length - 1
            //     );
            // }
            // if (_this.brideProfile.whatsup.length > 10) {
            //     _this.brideProfile.whatsup = _this.brideProfile.whatsup.substring(
            //         0,
            //         _this.brideProfile.whatsup.length - 1
            //     );
            // }

            let formData = new FormData();
            let data = JSON.stringify(_this.brideProfile);
            let img = this.brideProfile_logo;
            formData.append("type", "personal");
            formData.append("personalimg", img);
            formData.append("data", data);
            this.loader = true;
            if (this.cedit) {
                formData.append("_method", "PATCH");
                let updateId = this.brideProfile.id;
                if (this.companyId != null) {
                    updateId = this.profileId;
                }
                axios
                    .post(`/api/bride/profile/${updateId}`, formData, config)
                    .then(function (response) {
                        _this.loader = false;
                        _this.cedit = false;
                        _this.toggleForm("bride-details", false);
                        _this.personalfileOpen = true;
                        _this.message = "Personal Profile updated";
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
            if (this.brideProfile_logo == null) {
                _this.errors = { companyimg: ["Profile picture is required"] };
                _this.loader = false;
                _this.cprofileDisabled = false;
                return;
            }
            axios
                .post(`/api/bride/profile`, formData, config)
                .then(function (response) {
                    _this.loader = false;
                    _this.toggleForm("bride-details", false);

                    _this.personalfileOpen = true;
                    _this.brideProfile_logo = null;
                    _this.message = "Personal Profile Uploaded";
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
        submitOProfile(e) {
            var _this = this;
            this.$v.brideOffice.$touch();
            if (_this.$v.brideOffice.$invalid == true) {
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
            let data = JSON.stringify(_this.brideOffice);
            formData.append("data", data);
            formData.append("type", "office");
            this.loader = true;
            if (this.oedit) {
                formData.append("_method", "PATCH");
                let updateId = this.brideOffice.id;
                if (this.officeId != null) {
                    updateId = parseInt(this.officeId);
                }
                axios
                    .post(`/api/bride/profile/${updateId}`, formData)
                    .then(function (response) {
                        _this.loader = false;
                        _this.oedit = false;
                        // _this.toggleForm("office-details", false);
                        _this.message = "Office Profile updated";
                        _this.oexist = 1;
                        _this.updateEdit();
                        $(
                            `#office-details .ven-profile-form-submit button[type=submit]`
                        ).css("display", "none");
                        setTimeout(function () {
                            _this.message = null;
                        }, 3000);
                    })
                    .catch((error) => {
                        this.oprofileDisabled = false;
                        _this.loader = false;
                        _this.errors = error.response.data.errors;
                        console.log(error.response.data.errors);
                    });
                return;
            }
            axios
                .post(`/api/bride/profile`, formData)
                .then(function (response) {
                    console.log(response.data);
                    _this.loader = false;
                    //_this.toggleForm("office-details", false);
                    _this.message = "office Profile Uploaded";
                    _this.oexist = 1;
                    _this.updateEdit();
                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                })
                .catch((error) => {
                    this.oprofileDisabled = false;
                    _this.loader = false;
                    _this.errors = error.response.data.errors;
                });
        },
        getbrideprofile() {
            var _this = this;
            var v = this.brideId;
            axios
                .get(`/api/bride/profile/${v}`)
                .then(function (response) {
                    console.log(response);
                    _this.brideDetails = response.data[0];
                    _this.routeSlug = response.data[0].slug;
                    if (response.data[1]) {
                        _this.brideProfile = response.data[1];
                        delete _this.brideProfile.created_at;
                        delete _this.brideProfile.deleted_at;
                        delete _this.brideProfile.updated_at;
                    }
                    if (response.data[2]) {
                        _this.brideOffice = response.data[2];
                        delete _this.brideOffice.created_at;
                        delete _this.brideOffice.deleted_at;
                        delete _this.brideOffice.updated_at;

                        setTimeout(function () {
                            if (
                                _this.brideOffice.officedistrict != null &&
                                _this.brideOffice.officedistrict != ""
                            ) {
                                let stateOffice = _this.brideOffice.officestate;
                                _this.officeDistrict = [];
                                _this.locationMaster.map(function (el) {
                                    if (
                                        '"' + el.state + '"' ==
                                        '"' + stateOffice + '"'
                                    ) {
                                        _this.officeDistrict.push({
                                            id: el.id,
                                            name: el.name,
                                        });
                                    }
                                });
                            }
                        }, 1000);
                    }
                    if (response.data[3]) {
                        _this.brideHome = response.data[3];
                        delete _this.brideHome.created_at;
                        delete _this.brideHome.deleted_at;
                        delete _this.brideHome.updated_at;
                        setTimeout(function () {
                            if (
                                _this.brideHome.district != null &&
                                _this.brideHome.district != ""
                            ) {
                                let stateHome = _this.brideHome.state;
                                _this.district = [];
                                _this.locationMaster.map(function (el) {
                                    if (
                                        '"' + el.state + '"' ==
                                        '"' + stateHome + '"'
                                    ) {
                                        _this.district.push({
                                            id: el.id,
                                            name: el.name,
                                        });
                                    }
                                });
                            }
                        }, 1000);
                    }
                })
                .catch((errors) => {
                    console.log("Get All: " + errors);
                });
        },
        drago(e) {
            e.preventDefault();
            let dragTest = document.querySelector(
                "#bride-preview-upload-dragtext"
            );

            if ((e.currentTarget.className = "dropzone")) {
                e.currentTarget.style.opacity = "0";
                dragTest.textContent = "Drop File to Upload";
            }
        },
        dragl(e) {
            if ((e.currentTarget.className = "dropzone")) {
                let dragTest = document.querySelector(
                    "#bride-preview-upload-dragtext"
                );
                dragTest.textContent = "";
                e.currentTarget.style.opacity = "1";
            }
        },
        dragdrop(e) {
            let dragTest = document.querySelector(
                "#bride-preview-upload-dragtext"
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
                "#bride-preview-upload-dropzone"
            );
            dropZone.lastElementChild.textContent =
                e.target.files.length + " files uploaded";
        },
        updateEdit() {
            if (this.exist == 1) {
                //console.log($("#bride-details input"));
                $("#bride-details input").attr("disabled", true);
                $("#bride-details select").attr("disabled", true);
                this.pprofileDisabled = true;
            }
            if (this.cexist == 1) {
                console.log($("#company-details"));
                $("#company-details input").attr("disabled", true);
                $("#company-details select").attr("disabled", true);
                this.cprofileDisabled = true;
                // if (this.exist == 0) {
                //     this.toggleForm("bride-details", false);
                //     this.personalfileOpen = true;
                // }
            }
            if (this.oexist == 1) {
                //console.log($("#bride-details input"));
                $("#office-details input").attr("disabled", true);
                $("#office-details select").attr("disabled", true);
                this.oprofileDisabled = true;
            }
        },
    },
    mounted() {
        this.$nextTick(function () {
            this.getStates();
            this.getbrideprofile();
            this.updateEdit();
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
.bride-preview-upload {
    border: 0.162319px solid #959595;
    box-sizing: border-box;
    border-radius: 8.11594px;
    grid-column-start: 1;
    grid-column-end: -1;
    padding: 1.5em;
}
.bride-preview-upload > label {
    background: #efefef;
    border-radius: 4.05797px;
    width: 100%;
    cursor: pointer;
    position: relative;
}
#bride-preview-upload-dropzone {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 2em;
}
#bride-preview-upload-dropzone > span:nth-child(1) {
    width: 45px;
    height: 45px;
    background: #dfdfdf;
    border-radius: 50%;
    margin-bottom: 5px;
}
#bride-preview-upload-dropzone > span:nth-child(1) > img {
    width: 21px;
    height: 21px;
    margin-top: 12px;
    margin-left: 12px;
}
#bride-preview-upload-dropzone > span:nth-child(2) {
    font-family: Poppins;
    font-style: normal;
    font-weight: 500;
    font-size: 9.58349px;
    line-height: 14px;
    color: #000000;
    margin-bottom: 5px;
}
#bride-preview-upload-dropzone > span:nth-child(3) {
    font-family: Poppins;
    font-style: normal;
    font-weight: 300;
    font-size: 6.59415px;
    line-height: 10px;
    color: #7c7c7c;
}
#bride-preview-upload-dragtext {
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
.bride-logo-upload > label {
    display: flex;
    flex-direction: column;
    width: max-content;
    text-align: center;
    margin: 0.5em auto;
    position: relative;
    cursor: pointer;
}
.bride-logo-upload img {
    width: 61px;
    height: 61px;
    border-radius: 50%;
}
.bride-logo-upload > label > span:nth-child(2) {
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

#bride-details > h1 {
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
.bride-details-form-fields {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    grid-auto-rows: max-content;
    column-gap: 12px;
    row-gap: 4px;
}
.bride-details-form-fields > div > label {
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
.bride-details-form-fields > div > label input,
.bride-details-form-fields > div > label select {
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

.bride-address-form-fields {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    column-gap: 12px;
    row-gap: 4px;
}
/* .bride-address-form-fields > label:first-child {
    grid-column-start: 1;
    grid-column-end: -1;
} */
/* .bride-address-form-fields > label:last-child {
    grid-column-start: 1;
    grid-column-end: -1;
    position: relative;
} */
.bride-address-form-fields > label {
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
#brideCategories {
    padding: 0px 25px 9px 0px;
    margin-left: -4px;
    border: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    background: #ffffff;
    border-radius: 5px;
    background-image: url("/assets/brides/dashboard/dropdown-arrow.svg");
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
#brideCategories > option {
    font-family: Segoe UI;
    font-style: normal;
    font-weight: normal;
    font-size: 10px;
    line-height: 13px;
    color: #3d3838;
}
.bride-address-form-fields > label > input {
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

@media screen and (max-width: 762px) {
    .bride-details-form-fields {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    }
    .bride-address-form-fields {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    }
    .bride-preview-form-fields {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    }
}
</style>
