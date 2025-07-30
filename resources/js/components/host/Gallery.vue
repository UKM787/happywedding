
<template>
    <div>
        <div class="gallery-all-cont wed-host-gallery container-md">
            <div>
                <div
                    @click="
                        activeGallery = 'Pictures';
                        clickedAlbum = [];
                    "
                    :class="{
                        'wed-host-gallery-active': activeGallery == 'Pictures',
                    }"
                >
                    Pictures
                </div>
                <div
                    @click="
                        activeGallery = 'Albums';
                        clickedAlbum = [];
                    "
                    :class="{
                        'wed-host-gallery-active': activeGallery == 'Albums',
                    }"
                >
                    Albums
                </div>
                <div
                    @click="
                        activeGallery = 'Videos';
                        clickedAlbum = [];
                    "
                    :class="{
                        'wed-host-gallery-active': activeGallery == 'Videos',
                    }"
                >
                    Videos
                </div>
            </div>
            <div class="wed-host-gallery-items">
                <div v-if="activeGallery == 'Pictures'">
                    <form
                        @submit.prevent="sendPictures($event)"
                        class="wed-image-form gallery_upload_form"
                    >
                        <div class="p-3">
                            <div class="row mb-2 p-2">
                                <label for="image" class="form-label">Add Images</label>
                                <input
                                    type="file"
                                    name="galleryImage[]"
                                    class="form-control form-control-sm"
                                    id=""
                                    multiple
                                    @change="uploadImages($event)"
                                />
                                <span
                                    v-if="errorsSubmit && errorsSubmit.galleryImage"
                                    class="errMsg"
                                >{{ errorsSubmit.galleryImage[0] }}</span>
                                <div>{{ uploadMultiMessage }}</div>
                            </div>
                            <div class="row p-3">
                                <button
                                    type="submit"
                                    class="btn btn-sm btn-primary"
                                    :disabled="disablePictures"
                                >
                                    Upload Images
                                </button>
                            </div>
                        </div>
                    </form>
                    <div
                        v-for="(item, index) in nonAlbumImages"
                        :key="index"
                        class="img-cont"
                    >
                        <img
                            :src="'/files/' + invitations.id + '/' + item.imageName"
                            alt=""
                        />
                    </div>
                </div>
                <div
                    id="all-albums"
                    v-if="activeGallery == 'Albums' && clickedAlbum.length == 0"
                >
                    <form
                        @submit.prevent="createAlbum($event)"
                        class="wed-image-form gallery_upload_form"
                    >
                        <div class="p-3">
                            <div class="row p-2">
                                <label for="album" class="form-label">
                                    Album Name</label
                                >
                                <input
                                    type="text"
                                    name="album"
                                    class="form-control"
                                    v-model="albumName"
                                    required
                                />
                            </div>
                            <div class="row mb-2 p-2">
                                <label for="image" class="form-label">Add Images</label>
                                <input
                                    type="file"
                                    name="galleryImage[]"
                                    class="form-control form-control-sm"
                                    id=""
                                    multiple
                                    accept="image/*"
                                    @change="uploadImages($event)"
                                />
                                <span
                                    v-if="errorsSubmit && errorsSubmit.galleryImage"
                                    class="errMsg"
                                >{{ errorsSubmit.galleryImage[0] }}</span>
                                <div>{{ uploadMultiMessage }}</div>
                            </div>
                            <div class="row p-3">
                                <button
                                    type="submit"
                                    class="btn btn-sm btn-primary"
                                    :disabled="disablePictures"
                                >
                                    Create Album
                                </button>
                            </div>
                        </div>
                    </form>
                    <div
                        v-for="(item, index) in allAlbums"
                        :key="index"
                        @click="clickedAlbum = item.images; albumName = item.name"
                        class="album-cont"
                    >
                        <span>
                            {{ item.images.length }}
                            <img src="/assets/guestInvi/bi_image-fill.svg" />
                        </span>
                        <img src="/assets/guestInvi/Frame-5602-1.png" alt="" />
                        <span> {{ item.name }} </span>
                    </div>
                </div>
                <div v-if="activeGallery == 'Albums' && clickedAlbum.length > 0" class="album-pics">
                    <div class="album-header">
                        <button @click="clickedAlbum = []; albumName = null" class="btn btn-sm btn-secondary mb-3">
                            ← Back to Albums
                        </button>
                        <h4>{{ albumName }}</h4>
                    </div>
                    <div
                        v-for="single in clickedAlbum"
                        :key="single.imageName"
                        class="img-cont"
                    >
                        <img
                            :src="
                                '/files/' +
                                invitations.id +
                                '/' +
                                single.imageName
                            "
                            alt=""
                        />
                    </div>
                </div>
                <div v-if="activeGallery == 'Videos'">
                    <form
                        class="wed-image-form gallery_upload_form"
                        @submit.prevent="sendVideos($event)"
                    >
                        <div class="p-3">
                            <div class="row mb-2 p-2">
                                <label for="video" class="form-label"
                                    >Add Video</label
                                >
                                <input
                                    type="file"
                                    name="galleryVideo[]"
                                    class="form-control form-control-sm"
                                    id=""
                                    multiple
                                    accept="video/*"
                                    @change="uploadVideos($event)"
                                />
                                <span
                                    v-if="
                                        errorsSubmit &&
                                        errorsSubmit.galleryVideo
                                    "
                                    class="errMsg"
                                    >{{ errorsSubmit.galleryVideo[0] }}</span
                                >
                                <div>{{ uploadMultiMessage }}</div>
                            </div>
                            <div class="row p-3">
                                <button
                                    type="submit"
                                    :disabled="disablePictures"
                                    class="btn btn-sm btn-primary"
                                >
                                    Upload Video
                                </button>
                            </div>
                        </div>
                    </form>
                    <div
                        v-for="(item, index) in allVideos"
                        :key="index"
                        class="img-cont"
                    >
                        <video controls>
                            <source
                                :src="
                                    '/videos/' +
                                    invitations.id +
                                    '/' +
                                    item.name
                                "
                            />
                            Your browser does not support the video tag.
                        </video>
                    </div>
                </div>
            </div>
        </div>
        <flashMessage :message="message"></flashMessage>
    </div>
</template>

<script>
import flashMessage from "../FlashMessage.vue";

export default {
    components: {
        flashMessage,
    },
    props: ["albums", "galleries", "videos", "host", "invitations"],
    data() {
        return {
            activeGallery: "Pictures",
            clickedAlbum: [],
            message: null,
            uploadMultiImage: [],
            uploadMultiMessage: null,
            albumName: null,
            allAlbums: this.albums,
            allGalleries: this.galleries,
            allVideos: this.videos,
            disablePictures: false,
            errorsSubmit: null,
        };
    },
    computed: {
        nonAlbumImages() {
            // Filter out images that have an album
            return this.allGalleries.filter(image => !image.album);
        }
    },
    methods: {
        uploadImages(e) {
            const files = e.target.files;
            const validFiles = [];
            const invalidFiles = [];

            // Check each file
            for (let i = 0; i < files.length; i++) {
                const file = files[i];

                // Check file type
                const fileType = file.type;
                const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/svg+xml'];

                // Check file size (10MB = 10485760 bytes for albums, 512KB for pictures)
                const fileSize = file.size;
                const maxSize = this.activeGallery === 'Albums' ? 10485760 : 524288;

                if (validTypes.includes(fileType) && fileSize <= maxSize) {
                    validFiles.push(file);
                } else {
                    invalidFiles.push({
                        name: file.name,
                        reason: !validTypes.includes(fileType) ? 'Invalid file type' : 'File too large'
                    });
                }
            }

            // Update the component state
            this.uploadMultiImage = validFiles;

            if (invalidFiles.length > 0) {
                const reasons = invalidFiles.map(f => `${f.name}: ${f.reason}`).join(', ');
                this.uploadMultiMessage = `${validFiles.length} valid files. Skipped: ${reasons}`;
            } else {
                this.uploadMultiMessage = validFiles.length > 0 ?
                    `${validFiles.length} Files Selected!` :
                    'No valid files selected';
            }

            // Disable the submit button if no valid files
            this.disablePictures = validFiles.length === 0;
        },
        uploadVideos(e) {
            const files = e.target.files;
            const validFiles = [];
            const invalidFiles = [];
            
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const fileType = file.type;
                const validTypes = ['video/mp4', 'video/avi', 'video/mpeg', 'video/quicktime', 'video/webm', 'video/ogg'];
                
                if (validTypes.includes(fileType) && file.size <= 10485760) {
                    validFiles.push(file);
                } else {
                    invalidFiles.push({
                        name: file.name,
                        reason: !validTypes.includes(fileType) ? 'Invalid file type' : 'File too large (max 10MB)'
                    });
                }
            }

            // Update the component state
            this.uploadMultiImage = validFiles;

            if (invalidFiles.length > 0) {
                const reasons = invalidFiles.map(f => `${f.name}: ${f.reason}`).join(', ');
                this.uploadMultiMessage = `${validFiles.length} valid files. Skipped: ${reasons}`;
            } else {
                this.uploadMultiMessage = validFiles.length > 0 ?
                    `${validFiles.length} Videos Selected!` :
                    'No valid files selected';
            }

            // Disable the submit button if no valid files
            this.disablePictures = validFiles.length === 0;
        },
        createAlbum(e) {
            // This is essentially the same as sendPictures but specifically for album creation
            let _this = this;
            _this.disablePictures = true;
            _this.errorsSubmit = null;
            let formData = new FormData();
            
            formData.append("album", _this.albumName);
            let images = null;
            if (_this.uploadMultiImage.length > 0) {
                images = [..._this.uploadMultiImage];
                images.forEach(function (item, index) {
                    formData.append("galleryImage[" + index + "]", item);
                });
            }
            
            axios({
                method: "POST",
                url: route("addAlbum", _this.host),
                data: formData,
                headers: { "content-type": "multipart/form-data" },
            })
                .then((response) => {
                    _this.allAlbums = response.data[0];
                    _this.allGalleries = response.data[1];
                    _this.allVideos = response.data[2];
                    _this.message = "Album Created Successfully!";
                    _this.uploadMultiMessage = null;
                    _this.uploadMultiImage = [];
                    _this.albumName = null;
                    _this.disablePictures = false;
                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                })
                .catch((error) => {
                    _this.disablePictures = false;
                    _this.errorsSubmit = {
                        galleryImage: Object.values(
                            error.response.data?.errors
                        )[0],
                    };
                });
        },
        sendPictures(e) {
            let _this = this;
            _this.disablePictures = true;
            _this.errorsSubmit = null;
            let formData = new FormData();
            let link = null;

            if (_this.activeGallery == "Pictures") {
                let images = null;
                if (_this.uploadMultiImage.length > 0) {
                    images = [..._this.uploadMultiImage];
                    images.forEach(function (item, index) {
                        formData.append("galleryImage[" + index + "]", item);
                    });
                }
                // Don't send albumId for Pictures section
                // The controller will handle it as NULL
                link = route("hostgallery.store", _this.host);
            }

            let meth = "POST";

            // Debug the form data before sending
            console.log("Form data contents:");
            for (let pair of formData.entries()) {
                console.log(pair[0] + ': ' + (pair[1] instanceof File ?
                    `File: ${pair[1].name}, size: ${pair[1].size}` : pair[1]));
            }

            axios({
                method: meth,
                url: link,
                data: formData,
                headers: { "content-type": "multipart/form-data" },
            })
                .then((response) => {
                    _this.allAlbums = response.data[0];
                    _this.allGalleries = response.data[1];
                    _this.allVideos = response.data[2];
                    _this.message = "Images Uploaded Successfully!";
                    _this.uploadMultiMessage = null;
                    _this.uploadMultiImage = [];
                    _this.disablePictures = false;
                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                })
                .catch((error) => {
                    _this.disablePictures = false;
                    _this.handleUploadError(error, "Pictures");
                });
        },
        sendVideos(e) {
            let _this = this;
            _this.disablePictures = true;
            _this.errorsSubmit = null;
            let formData = new FormData();
            
            if (_this.uploadMultiImage.length > 0) {
                let videos = [..._this.uploadMultiImage];
                videos.forEach(function (item, index) {
                    formData.append("galleryVideo[" + index + "]", item);
                });
            }
            let link = route("hostvideoUpload", _this.host);
            let meth = "POST";

            // Debug the form data before sending
            console.log("Video form data contents:");
            for (let pair of formData.entries()) {
                console.log(pair[0] + ': ' + (pair[1] instanceof File ?
                    `File: ${pair[1].name}, size: ${pair[1].size}` : pair[1]));
            }

            axios({
                method: meth,
                url: link,
                data: formData,
                headers: { "content-type": "multipart/form-data" },
            })
                .then((response) => {
                    _this.allAlbums = response.data[0];
                    _this.allGalleries = response.data[1];
                    _this.allVideos = response.data[2];
                    _this.message = "Videos Uploaded Successfully!";
                    _this.uploadMultiMessage = null;
                    _this.uploadMultiImage = [];
                    _this.disablePictures = false;
                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                })
                .catch((error) => {
                    _this.disablePictures = false;
                    _this.handleUploadError(error, "Videos");
                });
        },
        handleUploadError(error, type) {
            let _this = this;
            // Log the full error for debugging
            console.error("Full error response:", error.response);

            // For 500 errors, show a more helpful message
            if (error.response && error.response.status === 500) {
                _this.message = "Server error occurred. Please check with administrator.";
                console.error("Server error details:", error.response.data);

                // You could also add a more specific message based on common issues
                if (error.response.data && error.response.data.message) {
                    if (error.response.data.message.includes("Permission denied")) {
                        _this.message = "Server error: Permission denied when saving files.";
                    } else if (error.response.data.message.includes("No such file or directory")) {
                        _this.message = "Server error: Upload directory does not exist.";
                    }
                }
            } else {
                // Handle validation errors as before
                console.error("Validation errors:", error.response?.data?.errors);

                if (type == "Pictures") {
                    if (error.response && error.response.data && error.response.data.errors) {
                        // Get the first error message from each field
                        const errorMessages = {};
                        Object.keys(error.response.data.errors).forEach(field => {
                            errorMessages[field] = error.response.data.errors[field][0];
                        });
                        console.log("Validation error messages:", errorMessages);

                        _this.errorsSubmit = {
                            galleryImage: errorMessages.galleryImage || ["Unknown validation error"]
                        };
                    } else {
                        _this.errorsSubmit = {
                            galleryImage: ["An error occurred while uploading images"]
                        };
                    }
                }
                if (type == "Videos") {
                    _this.errorsSubmit = {
                        galleryVideo: error.response && error.response.data && error.response.data.errors
                            ? Object.values(error.response.data.errors)[0]
                            : ["An error occurred while uploading videos"]
                    };
                }
            }

            setTimeout(function () {
                _this.message = null;
            }, 5000);
        },
    },
};
</script>

<style scoped>
/* Gallery all css start */
.wed-host-gallery {
    background-color: white;
    margin-top: 2em;
    padding: 10px 0;
}

.wed-host-gallery > div:nth-child(1) {
    display: flex;
    justify-content: center;
}

.wed-host-gallery-active {
    font-weight: bold !important;
    color: #7f004b !important;
    border-bottom: 4px solid #7f004b !important;
}

.wed-host-gallery > div:nth-child(1) > div {
    font-family: Roboto;
    font-style: normal;
    font-weight: normal;
    font-size: 17.8211px;
    line-height: 21px;
    color: #968585;
    flex: 1;
    text-align: center;
    padding: 2em 0;
    border-right: 0.891053px solid #cbc7c7;
    border-bottom: 0.891053px solid #cbc7c7;
    cursor: pointer;
}
.wed-host-gallery > div:nth-child(1) > div:last-child {
    border-right: none;
}
.wed-host-gallery-items {
    padding-bottom: 1em;
}
.wed-host-gallery-items > div {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    grid-auto-rows: max-content;
    padding: 1em;
    grid-column-gap: 1em;
    grid-row-gap: 1.5em;
}
.img-cont,
.album-cont {
    position: relative;
    padding-top: 100%;
    border-radius: 20px;
}
.img-cont > img,
.img-cont > video,
.album-cont > img {
    position: absolute;
    top: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 20px;
    z-index: 99;
}
.album-cont > span:nth-child(1) {
    position: absolute;
    top: 15px;
    right: 15px;
    z-index: 999;
    font-family: "Roboto";
    font-style: normal;
    font-weight: 400;
    font-size: 16px;
    line-height: 19px;
    color: #ffffff;
}
.album-cont > span:nth-child(3) {
    position: absolute;
    bottom: 15px;
    left: 15px;
    z-index: 999;
    font-family: "Roboto";
    font-style: normal;
    font-weight: 500;
    font-size: 15px;
    line-height: 18px;
    color: #ffffff;
}
.album-pics {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    grid-auto-rows: max-content;
    padding: 1em;
    grid-column-gap: 1em;
    grid-row-gap: 1.5em;
}

.album-header {
    grid-column: 1 / -1;
    margin-bottom: 1em;
}

.album-header h4 {
    margin: 0;
    color: #7f004b;
    font-weight: bold;
}
/* .album-pics.active {
    display: grid !important;
}
.album-cont.active {
    display: none !important;
} */

/* Gallery all css end */
.wed-image-form {
    grid-column-start: 1;
    grid-column-end: 3;
}

.gallery_upload_form {
    background: rgba(226, 226, 226, 0.6);
    backdrop-filter: blur(4px);
    border-radius: 17.8211px;
    height: max-content;
}

.gallery_album_form {
    background: rgba(226, 226, 226, 0.6);
    backdrop-filter: blur(4px);
    border-radius: 17.8211px;
}

/* .gallery_upload_form>input {
            display:none;
        } */

.gallery_upload_form1 > label {
    display: flex;
    justify-content: center;
    width: 100%;
    height: 100%;
    cursor: pointer;
    flex-direction: column;
}

.gallery_upload_form1 > label > span {
    align-self: center;
}

.gallery_upload_form > label {
    display: flex;
    justify-content: center;
    width: 100%;
    height: 100%;
    cursor: pointer;
    flex-direction: column;
}

.gallery_upload_form > label > span {
    align-self: center;
}
@media screen and (max-width: 769px) {
    .wed-host-gallery {
        padding: 14px 0 !important;
    }
}
@media screen and (max-width: 576px) {
    .wed-host-gallery-items > div {
        display: grid;
        grid-template-columns: repeat(2, 1fr) !important;
        grid-auto-rows: max-content;
        padding: 1em;
        grid-column-gap: 1em;
        grid-row-gap: 1.5em;
    }
}
</style>




















