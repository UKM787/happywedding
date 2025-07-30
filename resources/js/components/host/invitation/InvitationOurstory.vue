<template>
    <div>
        <div
            v-if="edit == true || showForm == true"
            class="wed-host-section container mx-auto"
        >
            <div class="wed-host-section-container">
                <form @submit.prevent="sendSaveDate" class="story-form-cont">
                    <h1
                        @click="
                            show == 'aboutUs'
                                ? (show = 'null')
                                : (show = 'aboutUs')
                        "
                    >
                        About Us
                        <img
                            v-if="screenWidth <= 576 && show != 'aboutUs'"
                            src="/assets/hosthome/pink-arr-up.svg"
                            alt=""
                        />
                        <img
                            v-if="screenWidth <= 576 && show == 'aboutUs'"
                            src="/assets/hosthome/pink-arr-down.svg"
                            alt=""
                        />
                    </h1>
                    <div v-if="show == 'aboutUs' || screenWidth >= 576">
                        <div class="form-group-custom">
                            <label for="groom_desc">
                                <span style="padding-left: 10px"
                                    >Hey {{ invitation.groomName }}! Introduce
                                    <span style="color: red">*</span></span
                                >
                                <textarea
                                    v-model="feilds.groom_desc"
                                    id="groom_desc"
                                    rows="5"
                                ></textarea>
                            </label>
                            <span
                                v-if="errorsSubmit && errorsSubmit.groom_desc"
                                class="errMsg"
                                >{{ errorsSubmit.groom_desc[0] }}</span
                            >
                        </div>
                        <div class="form-group-image">
                            <span>{{ uploadGroomMessage }}</span>
                            <button
                                @click="$refs.groomImageUpload.click()"
                                type="button"
                            >
                                <img
                                    src="/assets/miscellenous/upload.svg"
                                    alt=""
                                />
                                Upload picture
                            </button>
                            <input
                                @change="uploadFile($event, 'groom')"
                                type="file"
                                ref="groomImageUpload"
                            />
                        </div>
                        <img
                            style="width: 100px; height: 100px"
                            v-if="uploadGroomImagePreview"
                            :src="uploadGroomImagePreview"
                            alt=""
                        />
                        <span
                            v-if="errorsSubmit && errorsSubmit.groom_image"
                            class="errMsg"
                            >{{ errorsSubmit.groom_image[0] }}</span
                        >
                        <div class="form-group-custom">
                            <label for="bride_desc">
                                <span style="padding-left: 10px"
                                    >Hey {{ invitation.brideName }}! Introduce
                                    <span style="color: red">*</span></span
                                >
                                <textarea
                                    v-model="feilds.bride_desc"
                                    id="bride_desc"
                                    rows="5"
                                ></textarea>
                            </label>
                            <span
                                v-if="errorsSubmit && errorsSubmit.bride_desc"
                                class="errMsg"
                                >{{ errorsSubmit.bride_desc[0] }}</span
                            >
                        </div>
                        <div class="form-group-image">
                            <span>{{ uploadBrideMessage }}</span>
                            <button
                                @click="$refs.brideImageUpload.click()"
                                type="button"
                            >
                                <img
                                    src="/assets/miscellenous/upload.svg"
                                    alt=""
                                />
                                Upload picture
                            </button>
                            <input
                                @change="uploadFile($event, 'bride')"
                                type="file"
                                ref="brideImageUpload"
                            />
                        </div>
                        <img
                            style="width: 100px; height: 100px"
                            v-if="uploadBrideImagePreview"
                            :src="uploadBrideImagePreview"
                            alt=""
                        />
                        <span
                            v-if="errorsSubmit && errorsSubmit.bride_image"
                            class="errMsg"
                            >{{ errorsSubmit.bride_image[0] }}</span
                        >
                    </div>
                    <h1
                        @click="
                            show == 'ourStory'
                                ? (show = 'null')
                                : (show = 'ourStory')
                        "
                    >
                        Our Story
                        <img
                            v-if="screenWidth <= 576 && show != 'ourStory'"
                            src="/assets/hosthome/pink-arr-up.svg"
                            alt=""
                        />
                        <img
                            v-if="screenWidth <= 576 && show == 'ourStory'"
                            src="/assets/hosthome/pink-arr-down.svg"
                            alt=""
                        />
                    </h1>
                    <div v-if="show == 'ourStory' || screenWidth >= 576">
                        <!-- How We Met Toggle -->
                        <div class="toggle-section">
                            <span>How We Met</span>
                            <label class="switch">
                                <input type="checkbox" v-model="showHowWeMet">
                                <span class="slider round"></span>
                            </label>
                        </div>
                        
                        <!-- How We Met Form (conditionally shown) -->
                        <div v-if="showHowWeMet" class="form-section">
                            <div class="form-group-double">
                                <div class="form-group-custom">
                                    <label for="first_meet_date">
                                        <span style="padding-left: 10px">Date</span>
                                        <input
                                            v-model="feilds.first_meet_date"
                                            id="first_meet_date"
                                            type="date"
                                        />
                                    </label>
                                </div>
                                <div>
                                    <div class="form-group-image">
                                        <span>{{ uploadFirstMeetMessage }}</span>
                                        <button
                                            @click="$refs.firstMeetImageUpload.click()"
                                            type="button"
                                        >
                                            <img
                                                src="/assets/miscellenous/upload.svg"
                                                alt=""
                                            />
                                            Upload picture
                                        </button>
                                        <input
                                            @change="uploadFile($event, 'firstMeet')"
                                            type="file"
                                            ref="firstMeetImageUpload"
                                        />
                                    </div>
                                </div>
                            </div>
                            <img
                                style="width: 100px; height: 100px"
                                v-if="uploadFirstMeetImagePreview"
                                :src="uploadFirstMeetImagePreview"
                                alt=""
                            />
                            <div class="form-group-custom">
                                <label for="first_meet">
                                    <textarea
                                        v-model="feilds.first_meet"
                                        id="first_meet"
                                        rows="5"
                                        placeholder="Description"
                                    ></textarea>
                                </label>
                            </div>
                        </div>
                        
                        <!-- The day we exchanged hearts Toggle -->
                        <div class="toggle-section">
                            <span>The day we exchanged hearts</span>
                            <label class="switch">
                                <input type="checkbox" v-model="showExchangedHearts">
                                <span class="slider round"></span>
                            </label>
                        </div>
                        
                        <!-- The day we exchanged hearts Form (conditionally shown) -->
                        <div v-if="showExchangedHearts" class="form-section">
                            <div class="form-group-double">
                                <div class="form-group-custom">
                                    <label for="relation_start_date">
                                        <span style="padding-left: 10px">Date</span>
                                        <input
                                            v-model="feilds.relation_start_date"
                                            id="relation_start_date"
                                            type="date"
                                        />
                                    </label>
                                </div>
                                <div>
                                    <div class="form-group-image">
                                        <span>{{ uploadRelationStartMessage }}</span>
                                        <button
                                            @click="$refs.relationStartImageUpload.click()"
                                            type="button"
                                        >
                                            <img
                                                src="/assets/miscellenous/upload.svg"
                                                alt=""
                                            />
                                            Upload picture
                                        </button>
                                        <input
                                            @change="uploadFile($event, 'relationStart')"
                                            type="file"
                                            ref="relationStartImageUpload"
                                        />
                                    </div>
                                </div>
                            </div>
                            <img
                                style="width: 100px; height: 100px"
                                v-if="uploadRelationStartImagePreview"
                                :src="uploadRelationStartImagePreview"
                                alt=""
                            />
                            <div class="form-group-custom">
                                <label for="relation_start">
                                    <textarea
                                        v-model="feilds.relation_start"
                                        id="relation_start"
                                        rows="5"
                                        placeholder="Description"
                                    ></textarea>
                                </label>
                            </div>
                        </div>
                        
                        <!-- The day we decided to marry Toggle -->
                        <div class="toggle-section">
                            <span>The day we decided to marry</span>
                            <label class="switch">
                                <input type="checkbox" v-model="showDecidedMarry">
                                <span class="slider round"></span>
                            </label>
                        </div>
                        
                        <!-- The day we decided to marry Form (conditionally shown) -->
                        <div v-if="showDecidedMarry" class="form-section">
                            <div class="form-group-double">
                                <div class="form-group-custom">
                                    <label for="marriage_decide_date">
                                        <span style="padding-left: 10px">Date</span>
                                        <input
                                            v-model="feilds.marriage_decide_date"
                                            id="marriage_decide_date"
                                            type="date"
                                        />
                                    </label>
                                </div>
                                <div>
                                    <div class="form-group-image">
                                        <span>{{ uploadMarriageDecideMessage }}</span>
                                        <button
                                            @click="$refs.MarriageImageUpload.click()"
                                            type="button"
                                        >
                                            <img
                                                src="/assets/miscellenous/upload.svg"
                                                alt=""
                                            />
                                            Upload picture
                                        </button>
                                        <input
                                            @change="uploadFile($event, 'marriageImage')"
                                            type="file"
                                            ref="MarriageImageUpload"
                                        />
                                    </div>
                                </div>
                            </div>
                            <img
                                style="width: 100px; height: 100px"
                                v-if="uploadMarriageDecideImagePreview"
                                :src="uploadMarriageDecideImagePreview"
                            />
                            <div class="form-group-custom">
                                <label for="marriage_decide">
                                    <textarea
                                        v-model="feilds.marriage_decide"
                                        id="marriage_decide"
                                        rows="5"
                                        placeholder="Description"
                                    ></textarea>
                                </label>
                            </div>
                        </div>
                        <div class="multi-image-upload">
                            <h1>Story Gallery Images</h1>
                            <div
                                @dragover.prevent="drago($event)"
                                @dragleave.prevent="dragl($event)"
                                @drop.prevent="dragdrop($event)"
                                class="drag-drop-cont"
                            >
                                <img
                                    src="/assets/savedate/savedateupload.png"
                                    alt=""
                                />
                                <h5>{{ uploadMultiMessage }}</h5>
                                <span>OR</span>
                                <button
                                    type="button"
                                    @click="$refs.multiImageUpload.click()"
                                >
                                    Browse files
                                </button>
                                <input
                                    @change="uploadFile($event, 'multi')"
                                    type="file"
                                    ref="multiImageUpload"
                                    multiple
                                />
                            </div>
                        </div>
                        <div class="story-submit-cont">
                            <button :disabled="disableSubmit" type="submit">
                                Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <invitationStory
            v-else
            :invi="invitation"
            :ourStory="storyAll"
            :edit="true"
            @editstory="edit = true"
            ref="story"
            style="margin-top: -92px"
            id="story-outer-cont"
        ></invitationStory>
        <FlashMessage :message="message"></FlashMessage>
    </div>
</template>

<script>
import FlashMessage from "../../FlashMessage.vue";
import invitationStory from "../../guest/invitationDesigns/invitationDefault/InvitationStory.vue";

export default {
    props: ["loggedIn", "invitation", "story"],
    components: {
        FlashMessage,
        invitationStory,
    },
    data() {
        return {
            uploadMultiMessage: "Drag & Drop your files here",
            uploadMultiImage: [],
            uploadGroomMessage: "Upload Image of Groom",
            uploadGroomImage: null,
            uploadGroomImagePreview: null,
            uploadBrideMessage: "Upload Image of Bride",
            uploadBrideImage: null,
            uploadBrideImagePreview: null,
            uploadFirstMeetMessage: "",
            uploadFirstMeetImage: null,
            uploadFirstMeetImagePreview: null,
            uploadRelationStartMessage: "",
            uploadRelationStartImage: null,
            uploadRelationStartImagePreview: null,
            uploadMarriageDecideMessage: "",
            uploadMarriageDecideImage: null,
            uploadMarriageDecideImagePreview: null,
            feilds: {
                groom_desc: null,
                bride_desc: null,
                first_meet: null,
                first_meet_date: "",
                relation_start: null,
                relation_start_date: "",
                marriage_decide: null,
                marriage_decide_date: "",
            },
            storyAll: this.story,
            disableSubmit: false,
            edit: false,
            message: null,
            errorsSubmit: null,
            showForm: true,
            screenWidth: window.screen.width,
            show: null,
            showHowWeMet: false,
            showExchangedHearts: false,
            showDecidedMarry: false,
        };
    },
    methods: {
        setImage() {
            let _this = this;
            _this.uploadMultiMessage = "Drag & Drop your files here";
            _this.uploadMultiImage = [];
            _this.uploadGroomMessage = "Upload Image of Groom";
            _this.uploadGroomImage = null;
            _this.uploadGroomImagePreview = null;
            _this.uploadBrideMessage = "Upload Image of Bride";
            _this.uploadBrideImage = null;
            _this.uploadBrideImagePreview = null;
            _this.uploadFirstMeetMessage = "";
            _this.uploadFirstMeetImage = null;
            _this.uploadFirstMeetImagePreview = null;
            _this.uploadRelationStartMessage = "";
            _this.uploadRelationStartImage = null;
            _this.uploadRelationStartImagePreview = null;
            _this.uploadMarriageDecideMessage = "";
            _this.uploadMarriageDecideImage = null;
            _this.uploadMarriageDecideImagePreview = null;
        },
        sendSaveDate() {
            let _this = this;
            _this.disableSubmit = true;
            _this.errorsSubmit = null;
            let formData = new FormData();
            formData.append("type", "store");
            for (var key in _this.feilds) {
                if(_this.feilds[key] != null && _this.feilds[key] != ""){
                    formData.append(key, _this.feilds[key]);
                }
            }
            if (_this.uploadGroomImage) {
                formData.append("groom_image", _this.uploadGroomImage);
            }
            if (_this.uploadBrideImage) {
                formData.append("bride_image", _this.uploadBrideImage);
            }
            if (_this.uploadFirstMeetImage) {
                formData.append("first_meet_image", _this.uploadFirstMeetImage);
            }
            if (_this.uploadRelationStartImage) {
                formData.append(
                    "relation_start_image",
                    _this.uploadRelationStartImage
                );
            }
            if (_this.uploadMarriageDecideImage) {
                formData.append(
                    "marriage_decide_image",
                    _this.uploadMarriageDecideImage
                );
            }
            console.log(_this.uploadMultiImage);
            if (_this.uploadMultiImage.length > 0) {
                let leng = _this.uploadMultiImage.length;
                let index = 0;
                for (let singleKey in _this.uploadMultiImage) {
                    console.log(singleKey);

                    if (singleKey != "length" && singleKey != "item") {
                        formData.append(
                            "images[" + singleKey + "]",
                            _this.uploadMultiImage[singleKey]
                        );
                        index++;
                    }
                }
            }
            console.log(formData);
            let link = route("hoststory.store", _this.invitation);
            console.log(link);
            let meth = "POST";
            if (_this.edit == true) {
                link = route("hoststory.update", [
                    _this.invitation,
                    _this.storyAll,
                ]);
                formData.append("_method", "PATCH");
                formData.append("type", "update");
            }
            axios({
                method: meth,
                url: link,
                data: formData,
                headers: { "content-type": "multipart/form-data" },
            })
                .then((response) => {
                    if (_this.edit == false) {
                        window.location.href = `/host/invitedguests/${_this.invitation?.slug}`;
                        return;
                    }
                    
                    console.log("Full response:", response.data);
                    console.log("Story data received:", response.data["data"]);
                    console.log("Groom image path:", response.data["data"].groom_image);
                    console.log("Bride image path:", response.data["data"].bride_image);
                    console.log("First meet image path:", response.data["data"].first_meet_image);
                    console.log("Relation start image path:", response.data["data"].relation_start_image);
                    console.log("Marriage decide image path:", response.data["data"].marriage_decide_image);
                    console.log("Gallery images:", response.data["data"].images);
                    
                    _this.edit = false;
                    _this.showForm = false;
                    _this.storyAll = response.data["data"];
                    
                    // Force a re-render of the component
                    _this.$forceUpdate();
                    
                    _this.$nextTick(() => {
                        if (_this.$refs.story) {
                            _this.$refs.story.spliderEvent();
                            _this.$refs.story.countDown();
                        }
                    });
                    _this.disableSubmit = false;
                    _this.message = response.data["message"];
                    for (let single in _this.feilds) {
                        _this.feilds[single] = response.data["data"][single];
                    }
                    _this.uploadMessage = "Drag & Drop your file here";
                    _this.imageOne = null;
                    _this.setImage();
                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                })
                .catch((error) => {
                    _this.errorsSubmit = error.response.data?.errors;
                    console.log(error.response.data);
                    // _this.message = response.data["message"];
                    _this.disableSubmit = false;
                    if (error.response.data["message"]) {
                        _this.message = error.response.data["message"];
                        setTimeout(function () {
                            _this.message = null;
                        }, 3000);
                    }
                });
        },
        drago(e) {
            this.uploadMultiMessage = "Drop your File";
        },
        dragl(e) {
            if (this.uploadMultiImage.length > 0) {
                this.uploadMultiMessage =
                    this.uploadMultiImage.length + " Files Upoladed!!";
            } else {
                this.uploadMultiMessage = "Drag & Drop your file here";
            }
        },
        dragdrop(e) {
            this.uploadMultiImage = e.dataTransfer.files;
            this.uploadMultiMessage =
                this.uploadMultiImage.length + " Files Upoladed!!";
        },
        uploadFile(e, type) {
            if (type == "multi") {
                this.uploadMultiImage = e.target.files;
                this.uploadMultiMessage =
                    this.uploadMultiImage.length + " Files Upoladed!!";
            }
            if (type == "groom") {
                this.uploadGroomImage = e.target.files[0];
                this.uploadGroomMessage = e.target.files[0].name;
                this.uploadGroomImagePreview = URL.createObjectURL(
                    this.uploadGroomImage
                );
            }
            if (type == "bride") {
                this.uploadBrideImage = e.target.files[0];
                this.uploadBrideMessage = e.target.files[0].name;
                this.uploadBrideImagePreview = URL.createObjectURL(
                    this.uploadBrideImage
                );
            }
            if (type == "firstMeet") {
                this.uploadFirstMeetImage = e.target.files[0];
                this.uploadFirstMeetMessage = e.target.files[0].name;
                this.uploadFirstMeetImagePreview = URL.createObjectURL(
                    this.uploadFirstMeetImage
                );
            }
            if (type == "relationStart") {
                this.uploadRelationStartImage = e.target.files[0];
                this.uploadRelationStartMessage = e.target.files[0].name;
                this.uploadRelationStartImagePreview = URL.createObjectURL(
                    this.uploadRelationStartImage
                );
            }
            if (type == "marriageImage") {
                this.uploadMarriageDecideImage = e.target.files[0];
                this.uploadMarriageDecideMessage = e.target.files[0].name;
                this.uploadMarriageDecideImagePreview = URL.createObjectURL(
                    this.uploadMarriageDecideImage
                );
            }
        },
        setWidth() {
            this.screenWidth = window.screen.width;
        },
    },
    mounted() {
        this.$nextTick(() => {
            window.addEventListener("resize", this.setWidth);
            if (Object.keys(this.storyAll).length != 0) {
                this.showForm = false;
                for (let single in this.feilds) {
                    this.feilds[single] = this.storyAll[single];
                }
                
                // Set toggle states based on existing data
                this.showHowWeMet = !!this.storyAll.first_meet;
                this.showExchangedHearts = !!this.storyAll.relation_start;
                this.showDecidedMarry = !!this.storyAll.marriage_decide;
            }
        });
    },
};
</script>

<style scoped>
/* Add these new styles for the toggle switches */
.toggle-section {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 0;
    margin: 15px 0;
    border-bottom: 1px solid #f7dae4;
}

.toggle-section span {
    font-family: "Poppins";
    font-weight: 500;
    font-size: 15px;
    color: #000000;
}

.switch {
    position: relative;
    display: inline-block;
    width: 50px;
    height: 24px;
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
    background-color: #ccc;
    transition: .4s;
}

.slider:before {
    position: absolute;
    content: "";
    height: 16px;
    width: 16px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    transition: .4s;
}

input:checked + .slider {
    background-color: #c4456f;
}

input:focus + .slider {
    box-shadow: 0 0 1px #c4456f;
}

input:checked + .slider:before {
    transform: translateX(26px);
}

.slider.round {
    border-radius: 34px;
}

.slider.round:before {
    border-radius: 50%;
}

.form-section {
    margin-top: 15px;
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 1px dashed #f7dae4;
}

/* Existing styles */
.story-form-cont {
    max-width: 582px;
    width: 100%;
    margin: auto;
}
.story-form-cont > h1 {
    font-family: "Perpetua";
    font-style: normal;
    font-weight: 700;
    font-size: 30px;
    line-height: 34px;
    text-align: center;
    color: #9e3e5e;
}
.form-group-custom {
    margin-top: 7px;
}
.form-group-custom > label > span {
    white-space: nowrap;
    padding-bottom: 5px;
}
.form-group-custom > label {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 15px;
    line-height: 22px;
    color: #000000;
    display: flex;
    flex-direction: column;
}
.form-group-custom textarea,
.form-group-custom input {
    background: #c4456f1a;
    border: 0.643349px solid #f7dae4;
    border-radius: 7.72019px;
    border: none;
    outline: none;
    padding: 12px 21px;
}
.form-group-image {
    background: #c4456f1a;
    border: 0.643349px solid #f7dae4;
    border-radius: 7.72019px;
    border: none;
    outline: none;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 13.5px 21px;
    margin: 10px 0;
}
.form-group-image > span {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 12px;
    line-height: 8px;
    color: #000000;
    display: block;
    margin-left: 10px;
}
.form-group-image > button {
    border: none;
    outline: none;
    background: #f2f1f1;
    border-radius: 7px;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 11.29px;
    line-height: 17px;
    color: #828282;
}
.form-group-image > input {
    display: none;
}
.form-group-double {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    margin-top: 10px;
}
.form-group-double > div {
    width: 48%;
}
.form-group-double .form-group-image {
    margin: 0;
}
.form-group-double .form-group-image > button {
    display: block;
    width: 148px;
}
.form-group-double .form-group-image > span {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    margin-right: 3px;
}
.multi-image-upload {
    margin: 15px 0;
}
.multi-image-upload > h1 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 16px;
    color: #000000;
    margin-bottom: 10px;
}
.drag-drop-cont {
    width: 100%;
    background: linear-gradient(180deg, #fafcff 0%, #f1f6ff 100%);
    border: 2px dashed #c8c3c3;
    padding: 28px;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    margin: auto;
}
.drag-drop-cont > img {
    width: 41px;
    height: 34px;
    margin-bottom: 15px;
}
.drag-drop-cont > h5 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 12.1302px;
    line-height: 18px;
    color: #8b8b8b;
}
.drag-drop-cont > span {
    font-family: "Montserrat";
    font-style: normal;
    font-weight: 500;
    font-size: 9.79749px;
    line-height: 12px;
    color: #c8c3c3;
}
.drag-drop-cont > button {
    background: #dcdcdb;
    border-radius: 4.47811px;
    border: none;
    outline: none;
    padding: 10px 19px;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 10.2347px;
    line-height: 15px;
    text-align: center;
    color: #747474;
    margin-top: 10px;
}
.drag-drop-cont > input {
    display: none;
}
.story-submit-cont > button {
    border: none;
    outline: none;
    background: #c4456f;
    border-radius: 7.72px;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 600;
    font-size: 9.10182px;
    line-height: 14px;
    padding: 11px;
    text-align: center;
    color: #ffffff;
    display: block;
    width: 100%;
}
@media screen and (max-width: 768px) {
    .form-group-double {
        flex-wrap: wrap;
    }
    .form-group-double > div {
        width: 100%;
        margin-bottom: 10px;
    }
    #story-outer-cont {
        margin-top: 26px !important;
    }
}
@media screen and (max-width: 576px) {
    .story-form-cont > h1 {
        text-align: center;
        margin-bottom: 15px;
    }
    .wed-host-section-container {
        padding: 4em 0.5em !important;
    }
}
</style>














