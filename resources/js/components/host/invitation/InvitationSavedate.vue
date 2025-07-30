<template>
    <div class="wed-host-section container-md mx-auto">
        <div class="wed-host-section-container">
            <form
                v-if="edit == true || showForm == true"
                @submit.prevent="sendSaveDate"
                class="save-date-form"
            >
                <h1>Save The Date</h1>
                <h3>Upload the image for countdown</h3>
                <div
                    @dragover.prevent="drago($event)"
                    @dragleave.prevent="dragl($event)"
                    @drop.prevent="dragdrop($event)"
                    class="drag-drop-cont"
                >
                    <img src="/assets/savedate/savedateupload.png" alt="" />
                    <h5>{{ uploadMessage }}</h5>
                    <img
                        style="width: 100px; height: 100px"
                        v-if="uploadedImg"
                        :src="uploadedImg"
                        alt=""
                    />
                    <span>OR</span>
                    <button type="button" @click="$refs.savedateUpload.click()">
                        Browse files
                    </button>
                    <input
                        @change="uploadFile($event)"
                        type="file"
                        ref="savedateUpload"
                    />
                </div>
                <span
                    v-if="errorsSubmit && errorsSubmit.imageOne"
                    class="errMsg"
                    >{{ errorsSubmit.imageOne[0] }}</span
                >
                <div class="save-date-submit-cont">
                    <button :disabled="disableSubmit" type="submit">
                        Submit
                    </button>
                </div>
            </form>
            <div v-else>
                <h1 class="heading">Save The Date</h1>
                <div class="guest-banner-cont">
                    <img 
                        :src="getImagePath(dateSave?.imageOne)" 
                        @error="handleImageError" 
                        alt="Save the date" 
                        class="save-date-image"
                    />
                    <div class="overlay"></div>
                    <div class="guest-banner-content">
                        <div class="guest-banner-couple-name">
                            <span>{{ invitation?.side == 'bride' ? invitation?.brideName : invitation?.groomName }}</span>
                            <span>weds</span>
                            <span>{{ invitation?.side == 'groom' ? invitation?.brideName : invitation?.groomName }}</span>
                        </div>
                        <div>
                            <img
                                src="/assets/guestInvi/banner-invite.svg"
                                alt=""
                            />
                        </div>
                        <!-- Add countdown timer elements here -->
                        <div class="guest-banner-timer">
                            <div class="guest-banner-timer-single">
                                <span>00</span>
                                <span>Days</span>
                            </div>
                            <div class="guest-banner-timer-single">
                                <span>00</span>
                                <span>Hours</span>
                            </div>
                            <div class="guest-banner-timer-single">
                                <span>00</span>
                                <span>Minutes</span>
                            </div>
                            <div class="guest-banner-timer-single">
                                <span>00</span>
                                <span>Seconds</span>
                            </div>
                        </div>
                        <div class="guest-banner-slogan">
                            <div>We can't wait to celebrate with you!</div>
                            <div>
                                With pride and joy, we invite you to share a
                                special day in our lives as we…
                            </div>
                        </div>
                    </div>
                    <div>
                        <img
                            @click="
                                edit = true;
                                uploadMessage = 'Change Old Image';
                            "
                            src="/assets/miscellenous/edit.svg"
                            alt=""
                        />
                    </div>
                </div>
            </div>
        </div>
        <!-- Add debug info during development -->
        <div v-if="debug" class="debug-info">
            <p>Original path: {{ dateSave?.imageOne }}</p>
            <p>Processed path: {{ getImagePath(dateSave?.imageOne) }}</p>
        </div>
        <FlashMessage :message="message"></FlashMessage>
    </div>
</template>

<script>
import FlashMessage from "../../FlashMessage.vue";

export default {
    props: ["loggedIn", "invitation", "savedate"],
    components: {
        FlashMessage,
    },
    data() {
        return {
            dateSave: this.savedate || null,
            uploadMessage: "Drag & Drop your file here",
            imageOne: null,
            disableSubmit: false,
            edit: false,
            message: null,
            errorsSubmit: null,
            showForm: this.savedate ? false : true,
            uploadedImg: null,
            countdownInterval: null,
            debug: false, // Set to true to show debugging info
            imageLoaded: false
        };
    },
    mounted() {
        console.log("Component mounted with savedate:", this.savedate);
        
        if (this.savedate) {
            this.dateSave = this.savedate;
            console.log("Image path from savedate:", this.dateSave.imageOne);
        }
        
        // Check if we can access the storage directory
        this.checkStorageAccess();
    },
    methods: {
        sendSaveDate() {
            let _this = this;
            _this.disableSubmit = true;
            _this.errorsSubmit = null;
            
            // Create FormData object
            let formData = new FormData();
            
            // Check if we have a file to upload
            if (!_this.imageOne && !_this.edit) {
                _this.errorsSubmit = { imageOne: ["Please select an image file"] };
                _this.disableSubmit = false;
                return;
            }
            
            // Add the image file if it exists
            if (_this.imageOne) {
                formData.append("imageOne", _this.imageOne);
            }
            
            // Set the request type
            if (_this.edit) {
                let link = route("hostsavedate.update", [
                    _this.invitation,
                    _this.dateSave,
                ]);
                formData.append("_method", "PATCH");
                formData.append("type", "update");
                
                // Make the request
                axios.post(link, formData, {
                    headers: { "Content-Type": "multipart/form-data" }
                })
                .then(response => {
                    console.log("Success response:", response.data);
                    _this.handleSuccessResponse(response);
                })
                .catch(error => {
                    _this.handleErrorResponse(error);
                });
            } else {
                // For new save date
                let link = route("hostsavedate.store", _this.invitation);
                formData.append("type", "store");
                
                // Make the request
                axios.post(link, formData, {
                    headers: { "Content-Type": "multipart/form-data" }
                })
                .then(response => {
                    console.log("Success response:", response.data);
                    _this.handleSuccessResponse(response);
                })
                .catch(error => {
                    _this.handleErrorResponse(error);
                });
            }
        },
        drago(e) {
            this.uploadMessage = "Drop your File";
        },
        dragl(e) {
            if (this.imageOne) {
                this.uploadMessage = this.imageOne.name;
                this.uploadedImg = URL.createObjectURL(this.imageOne);
            } else {
                this.uploadMessage = "Drag & Drop your file here";
                this.uploadedImg = null;
            }
        },
        dragdrop(e) {
            if (!e.dataTransfer.files || !e.dataTransfer.files[0]) {
                console.log("No file dropped");
                return;
            }
            
            const file = e.dataTransfer.files[0];
            
            // Check file type
            if (!file.type.match('image.*')) {
                this.errorsSubmit = { imageOne: ["Please select an image file"] };
                return;
            }
            
            // Check file size (max 5MB)
            if (file.size > 5 * 1024 * 1024) {
                this.errorsSubmit = { imageOne: ["Image size should be less than 5MB"] };
                return;
            }
            
            this.imageOne = file;
            this.uploadMessage = file.name;
            this.uploadedImg = URL.createObjectURL(file);
            this.errorsSubmit = null;
        },
        uploadFile(e) {
            if (!e.target.files || !e.target.files[0]) {
                console.log("No file selected");
                return;
            }
            
            const file = e.target.files[0];
            console.log("Selected file:", file);
            
            // Check file type
            if (!file.type.match('image.*')) {
                this.errorsSubmit = { imageOne: ["Please select an image file"] };
                return;
            }
            
            // Check file size (max 5MB)
            if (file.size > 5 * 1024 * 1024) {
                this.errorsSubmit = { imageOne: ["Image size should be less than 5MB"] };
                return;
            }
            
            // Store the file object directly
            this.imageOne = file;
            this.uploadMessage = file.name;
            this.uploadedImg = URL.createObjectURL(file);
            this.errorsSubmit = null;
        },
        countDown() {
            if (!this.invitation || !this.invitation.startDate) {
                console.error("No start date available for countdown");
                return;
            }

            console.log("Initializing countdown with date:", this.invitation.startDate);
            
            // Wait for DOM to be ready
            this.$nextTick(() => {
                const deadlineTimer = document.querySelectorAll(
                    ".guest-banner-timer-single > span:nth-child(1)"
                );

                if (!deadlineTimer || deadlineTimer.length === 0) {
                    console.error("Countdown elements not found in DOM");
                    return;
                }

                console.log("Found countdown elements:", deadlineTimer.length);
                
                const futureDate = new Date(this.invitation.startDate);
                const futureTime = futureDate.getTime();
                
                // Initialize countdown
                this.updateCountdown(deadlineTimer, futureTime);
                
                // Clear existing interval if any
                if (this.countdownInterval) {
                    clearInterval(this.countdownInterval);
                }
                
                // Set new interval
                this.countdownInterval = setInterval(() => {
                    this.updateCountdown(deadlineTimer, futureTime);
                }, 1000);
            });
        },
        updateCountdown(deadlineTimer, futureTime) {
            const today = new Date().getTime();
            const gap = futureTime - today;

            if (gap <= 0) {
                if (this.countdownInterval) {
                    clearInterval(this.countdownInterval);
                }
                deadlineTimer.forEach((item, i) => {
                    item.innerHTML = "00";
                });
                return;
            }

            const second = 1000;
            const minute = second * 60;
            const hour = minute * 60;
            const day = hour * 24;

            const d = Math.floor(gap / day);
            const h = Math.floor((gap % day) / hour);
            const m = Math.floor((gap % hour) / minute);
            const s = Math.floor((gap % minute) / second);

            if (deadlineTimer[0]) deadlineTimer[0].innerHTML = d < 10 ? "0" + d : d;
            if (deadlineTimer[1]) deadlineTimer[1].innerHTML = h < 10 ? "0" + h : h;
            if (deadlineTimer[2]) deadlineTimer[2].innerHTML = m < 10 ? "0" + m : m;
            if (deadlineTimer[3]) deadlineTimer[3].innerHTML = s < 10 ? "0" + s : s;
        },
        getImagePath(path) {
            if (!path) {
                return '/assets/savedate/savedateupload.png';
            }
            
            // For debugging
            console.log('Original path:', path);
            
            // Normalize path
            let normalizedPath = path;
            
            // Remove leading backslash if present
            if (normalizedPath.startsWith('\\')) {
                normalizedPath = normalizedPath.substring(1);
            }
            
            // Convert all backslashes to forward slashes
            normalizedPath = normalizedPath.replace(/\\/g, '/');
            
            // Remove any leading slashes
            normalizedPath = normalizedPath.replace(/^\/+/, '');
            
            console.log('Normalized path:', normalizedPath);
            
            // Check if it's a full URL
            if (normalizedPath.startsWith('http://') || normalizedPath.startsWith('https://')) {
                return normalizedPath;
            }
            
            // Return the path directly - no need to add /storage prefix
            return '/' + normalizedPath;
        },
        // Handle successful response
        handleSuccessResponse(response) {
            console.log("Success response data:", response.data);
            this.edit = false;
            this.showForm = false;
            this.disableSubmit = false;
            this.message = response.data["message"];
            this.dateSave = response.data["data"];
            
            // Log the image path from the response
            if (this.dataSave && this.dataSave.imageOne) {
                console.log("Image path from response:", this.dataSave.imageOne);
            }
            
            this.uploadMessage = "Drag & Drop your file here";
            this.imageOne = null;
            this.uploadedImg = null;
            
            // Wait for DOM to update before initializing countdown
            setTimeout(() => {
                this.countDown();
                this.$forceUpdate();
            }, 100);
            
            setTimeout(() => {
                this.message = null;
            }, 3000);
        },
        // Handle error response
        handleErrorResponse(error) {
            console.error("Error response:", error.response);
            this.disableSubmit = false;
            
            if (error.response && error.response.data) {
                if (error.response.data.errors) {
                    this.errorsSubmit = error.response.data.errors;
                    console.log("Validation errors:", error.response.data.errors);
                }
                
                if (error.response.data.message) {
                    this.message = error.response.data.message;
                    setTimeout(() => {
                        this.message = null;
                    }, 3000);
                }
            }
        },
        // Add this method to debug form data
        debugFormData(formData) {
            console.log("Form data contents:");
            for (let pair of formData.entries()) {
                console.log(pair[0] + ': ' + (pair[1] instanceof File ? 
                    `File: ${pair[1].name}, size: ${pair[1].size}, type: ${pair[1].type}` : 
                    pair[1]));
            }
        },
        handleImageError(event) {
            console.error('Image failed to load:', event.target.src);
            
            // Try alternative paths
            const originalSrc = event.target.src;
            const url = new URL(originalSrc);
            const pathOnly = url.pathname;
            
            // Try different paths
            const alternatives = [];
            
            // 1. Try with storage prefix
            if (!pathOnly.includes('/storage/')) {
                const parts = pathOnly.split('/');
                parts.splice(1, 0, 'storage');
                alternatives.push(url.origin + parts.join('/'));
            }
            
            // 2. Try without storage prefix
            if (pathOnly.includes('/storage/')) {
                alternatives.push(url.origin + pathOnly.replace('/storage/', '/'));
            }
            
            // 3. Try with different case for 'uploads'
            if (pathOnly.toLowerCase().includes('/uploads/')) {
                const fixedPath = pathOnly.replace(/\/uploads\//i, '/Uploads/');
                alternatives.push(url.origin + fixedPath);
            }
            
            console.log('Trying alternatives:', alternatives);
            
            // Try each alternative
            let alternativeIndex = 0;
            
            const tryNextAlternative = () => {
                if (alternativeIndex >= alternatives.length) {
                    // If all alternatives fail, use default image
                    event.target.src = '/assets/savedate/savedateupload.png';
                    return;
                }
                
                const alternative = alternatives[alternativeIndex++];
                console.log('Trying alternative:', alternative);
                
                const img = new Image();
                img.onload = () => {
                    event.target.src = alternative;
                };
                img.onerror = tryNextAlternative;
                img.src = alternative;
            };
            
            tryNextAlternative();
        },
        checkStorageAccess() {
            // Try to access a known path in storage
            fetch('/storage/test-access.txt')
                .then(response => {
                    if (response.ok) {
                        console.log('Storage is accessible');
                    } else {
                        console.warn('Storage might not be accessible:', response.status);
                    }
                })
                .catch(error => {
                    console.warn('Error accessing storage:', error);
                });
            
            // Also check if we can access the assets directory
            fetch('/assets/savedate/savedateupload.png')
                .then(response => {
                    if (response.ok) {
                        console.log('Assets directory is accessible');
                    } else {
                        console.warn('Assets directory might not be accessible:', response.status);
                    }
                })
                .catch(error => {
                    console.warn('Error accessing assets directory:', error);
                });
        },
    },
    mounted() {
        this.$nextTick(() => {
            // Initialize component based on whether we have savedate data
            if (this.savedate) {
                this.dateSave = this.savedate;
                this.showForm = false;
                
                // If we have both invitation and savedate data, initialize countdown
                if (this.invitation && this.invitation.startDate) {
                    console.log("Initializing countdown on mount");
                    setTimeout(() => {
                        this.countDown();
                    }, 500); // Give DOM time to render
                }
            } else {
                this.showForm = true;
            }
        });
    },
    beforeDestroy() {
        // Clean up interval when component is destroyed
        if (this.countdownInterval) {
            clearInterval(this.countdownInterval);
        }
    },
};
</script>

<style scoped>
.save-date-form > h1,
.heading {
    font-family: "Perpetua";
    font-style: normal;
    font-weight: 700;
    font-size: 30px;
    line-height: 34px;
    text-align: center;
    width: 100%;
    color: #9e3e5e;
}
.save-date-form > h3 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 300;
    font-size: 16px;
    line-height: 24px;
    text-align: center;
    width: 100%;
    color: #000000;
}
.drag-drop-cont {
    max-width: 493px;
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

.save-date-submit-cont {
    width: 100%;
    text-align: center;
    margin: 48px 0;
}
.save-date-submit-cont > button {
    background: #c4456f;
    border-radius: 7.72px;
    padding: 11px 82px;
    border: none;
    outline: none;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 600;
    font-size: 13px;
    line-height: 20px;
    text-align: center;
    color: #ffffff;
}
.save-date-form > .errMsg {
    display: block;
    text-align: center;
    margin-top: 12px;
}
/* Banner css start */
.guest-banner-cont {
    padding-top: 55%;
    position: relative;
    width: 100%;
    height: 100%;
    top: 0;
}
.guest-banner-cont > img:nth-child(1) {
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    object-fit: cover;
}
.guest-banner-cont > .overlay {
    background: rgba(0, 0, 0, 0.5);
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    z-index: 999;
}
.guest-banner-cont > div:nth-child(4) {
    position: absolute;
    top: 15px;
    right: 15px;
    z-index: 99999;
    cursor: pointer;
}
.guest-banner-content {
    margin: auto;
    position: absolute;
    top: 3%;
    text-align: center;
    display: flex;
    flex-direction: column;
    width: 100%;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}
/* .guest-banner-content {
    margin-bottom: 3em;
} */
.guest-banner-accept > button {
    font-family: "Segoe UI";
    font-style: normal;
    font-weight: 700;
    font-size: 13.052px;
    line-height: 17px;
    text-transform: uppercase;
    padding: 13px 38px;
}
.guest-banner-accept > button:nth-child(1) {
    outline: none;
    background: rgba(196, 69, 111, 0.5);
    border: 1.12998px solid #c4456f;
    border-radius: 6.81176px;
    color: #ffffff;
    margin-right: 15px;
}
.guest-banner-accept > button:nth-child(2) {
    outline: none;
    background: rgba(72, 72, 72, 0.2);
    border: 1.12998px solid #696969;
    border-radius: 6.81176px;
    color: #ffffff;
}
.guest-banner-couple-name {
    margin-top: 2em;
}
.guest-banner-couple-name > span {
    font-family: "STSong";
    font-style: normal;
    font-weight: 400;
    font-size: 29.2084px;
    line-height: 38px;
    text-transform: uppercase;
    color: #ffffff;
}
.guest-banner-couple-name > span:nth-child(2) {
    font-family: "Stalemate";
    font-style: normal;
    font-weight: 400;
    font-size: 53.1063px;
    line-height: 78px;
    color: #ffffff;
    text-transform: none;
    margin: 0 20px;
}
.guest-banner-venue-date {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 16px;
    line-height: 24px;
    text-transform: capitalize;
    color: #ffffff;
    position: relative;
    display: flex;
    flex-wrap: nowrap;
}
.guest-banner-venue-date > span {
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
}
.guest-banner-venue-date > span:nth-child(2) {
    margin: 0 7px;
}

.guest-banner-venue-date > span:nth-child(1)::after {
    content: "";
    position: relative;
    width: 50px;
    height: 2px;
    top: -1px;
    background: #ffffff;
    display: inline-block;
    right: 0;
    z-index: 99999;
}
.guest-banner-venue-date > span:nth-child(3)::before {
    content: "";
    position: relative;
    width: 50px;
    height: 2px;
    top: -1px;
    background: #ffffff;
    display: inline-block;
    right: 0;
    z-index: 99999;
}
.guest-banner-timer {
    display: flex;
    margin: 42px auto;
}
.guest-banner-timer-single {
    background: rgba(255, 255, 255, 0.3);
    box-shadow: 0px 0px 4px 1px rgba(0, 0, 0, 0.25);
    padding: 12px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    margin-right: 12px;
    width: 76px;
    height: 76px;
}
.guest-banner-timer:last-child {
    margin-right: 0;
}
.guest-banner-timer-single > span:nth-child(1) {
    font-family: "Perpetua";
    font-style: normal;
    font-weight: 400;
    font-size: 44.083px;
    line-height: 51px;
    text-align: center;
    display: block;
    color: #ffffff;
}
.guest-banner-timer-single > span:nth-child(2) {
    font-family: "Segoe UI";
    font-style: normal;
    font-weight: 400;
    font-size: 7.62142px;
    line-height: 10px;
    display: block;
    text-align: center;
    color: #ffffff;
}
.guest-banner-slogan > div:nth-child(1) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 24.7422px;
    line-height: 37px;
    text-align: center;
    text-transform: capitalize;
    color: #ffffff;
}
.guest-banner-slogan > div:nth-child(2) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 14.8453px;
    line-height: 22px;
    text-align: center;
    text-transform: lowercase;

    color: #dfdfdf;
}
@media screen and (max-width: 1600px) {
    .guest-banner-cont {
        padding-top: 50%;
    }
}
@media screen and (max-width: 1300px) {
    .guest-banner-cont {
        padding-top: 60%;
    }
}
@media screen and (max-width: 1200px) {
    .guest-banner-cont {
        padding-top: 70%;
    }
}
@media screen and (max-width: 991px) {
    .guest-banner-cont {
        padding-top: 80%;
    }
    .guest-banner-timer {
        margin: 22px auto;
    }
    .guest-banner-timer-single {
        width: 76px;
        height: 76px;
    }
    /* .guest-banner-timer-single > span:nth-child(1) {
        font-size: 60px;
        line-height: 60px;
    } */
    .guest-banner-content {
        top: 3%;
    }
    .wed-host-section-container {
        padding: 4em 0 !important;
        padding-bottom: 6em !important;
    }
}
@media screen and (max-width: 768px) {
    .guest-banner-cont {
        padding-top: 100%;
    }
    .guest-banner-couple-name {
        margin-top: 1px;
    }
    .guest-banner-cont {
        padding-top: 83%;
    }
}
@media screen and (max-width: 576px) {
    .guest-banner-couple-name > span {
        font-weight: 400;
        font-size: 18.2232px;
        line-height: 24px;
    }
    .guest-banner-couple-name > span:nth-child(2) {
        font-weight: 400;
        font-size: 33.1331px;
        line-height: 49px;
    }
    .guest-banner-venue-date {
        font-weight: 500;
        font-size: 10px;
        line-height: 15px;
    }
    .guest-banner-timer-single > span:nth-child(1) {
        font-weight: 400;
        font-size: 35.2648px;
        line-height: 40px;
    }
    .guest-banner-timer-single {
        width: 66px;
        height: 65px;
        padding: 0;
    }
    .guest-banner-slogan > div:nth-child(1) {
        font-weight: 400;
        font-size: 10.6195px;
        line-height: 16px;
    }
    .guest-banner-slogan > div:nth-child(2) {
        font-weight: 400;
        font-size: 6.37168px;
        line-height: 10px;
    }
    .guest-banner-content {
        top: 8%;
    }
    .wed-host-section-container {
        padding: 4em 0 !important;
    }
}
.save-date-image {
    max-width: 100%;
    height: auto;
    object-fit: cover;
}
.debug-info {
    margin-top: 20px;
    padding: 10px;
    background-color: #f8f9fa;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-family: monospace;
}
</style>

