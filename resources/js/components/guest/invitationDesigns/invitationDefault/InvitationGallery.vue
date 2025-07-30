<template>
    <div style="background-color: white">
        <div class="guest-invi-gallary-cont">
            <h1 class="guest-invi-heading">Gallery</h1>
            <div class="guest-invi-gallary">
                <div v-for="(item, index) in sixImages" :key="index">
                    <img
                        v-if="item.type == 'img'"
                        :src="'/files/' + invi.id + '/' + item.imageName"
                        alt=""
                    />
                    <video v-if="item.type == 'vid'" controls>
                        <source :src="'/videos/' + invi.id + '/' + item.name" />
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
            <button @click="$emit('all')" type="button">View All</button>
        </div>
    </div>
</template>

<script>
export default {
    props: ["inviAlbum", "inviImages", "inviVideos", "invi", "showAll"],
    data() {
        return {
            active: "Pictures",
            clickedAlbum: [],
        };
    },
    methods: {
        showPics(e) {
            this.clickedAlbum = e.images;
        },
        showAlbums(e) {
            let all = document.getElementsByClassName("album-pics");
            let conts = document.getElementsByClassName("album-cont");
            let mainCont = $("#all-albums");
            all.forEach(function (item) {
                if (item.classList.contains("active")) {
                    item.classList.remove("active");
                }
            });
            conts.forEach(function (item) {
                if (item.classList.contains("active")) {
                    item.classList.remove("active");
                }
            });
            mainCont.css("display", "grid");
        },
    },
    computed: {
        // Filter out images that belong to albums
        nonAlbumImages() {
            return this.inviImages.filter(image => !image.album_id);
        },
        sixImages() {
            let images = [];
            let all = this.nonAlbumImages; // Use filtered images instead of all images
            let index = 0;
            if (all.length > 0) {
                all.every((item) => {
                    item["type"] = "img";
                    images.push(item);
                    index++;
                    if (index == 6) {
                        return false;
                    } else {
                        return true;
                    }
                });
            }
            if (images.length < 6) {
                let videos = this.inviVideos;
                if (videos.length > 0) {
                    videos.every((item) => {
                        item["type"] = "vid";
                        images.push(item);
                        index++;
                        if (index == 6) {
                            return false;
                        } else {
                            return true;
                        }
                    });
                }
            }
            return images;
        },
    },
};
</script>

<style scoped>
.guest-invi-gallary-cont {
    padding: 68px;
    background: #ffffff;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}
.guest-invi-heading {
    font-family: "Perpetua";
    font-style: normal;
    font-weight: 700;
    font-size: 29.5136px;
    line-height: 34px;
    text-align: center;
    color: #333333;
    margin-bottom: 15px;
}
.guest-invi-gallary {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    grid-template-rows: max-content;
    grid-column-gap: 10px;
    grid-row-gap: 20px;
    align-items: flex-start;
    background: #f8edf0;
    width: 55%;
    padding: 19px 25px;
    margin: auto;
}
.guest-invi-gallary > div {
    position: relative;
    padding-top: 85%;
}
.guest-invi-gallary > div > img,
.guest-invi-gallary > div > video {
    position: absolute;
    top: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.guest-invi-gallary-cont > button:nth-child(3) {
    outline: none;
    border: 1px solid #d8839f;
    border-radius: 10px;
    background: white;
    padding: 12px 32px;
    width: max-content;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 13px;
    line-height: 20px;
    text-align: center;
    color: #c4456f;
    margin-top: 46px;
}
@media screen and (max-width: 1140px) {
    .guest-invi-gallary {
        width: 80% !important;
        /* grid-template-columns: repeat(auto-fill, minmax(182px, 1fr)); */
    }
}
@media screen and (max-width: 910px) {
    .guest-invi-gallary {
        width: 100% !important;
    }
}
@media screen and (max-width: 576px) {
    .guest-invi-gallary-cont {
        padding: 68px 15px;
    }
    .guest-invi-gallary {
        padding: 8px;
    }
}
</style>


