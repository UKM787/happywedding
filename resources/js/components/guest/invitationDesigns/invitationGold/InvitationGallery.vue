<template>
    <!-- <div style="background-color: white">
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
    </div> -->
    <div class="gallery-cont container-lg">
        <h1>Gallery</h1>
        <div id="guest-gallery-slider" class="splide">
            <div class="splide__track">
                <ul class="splide__list" style="align-items: stretch">
                    <li
                        v-for="(item, index) in inviImages"
                        :key="index"
                        style="border: none !important"
                        class="splide__slide"
                    >
                        <div>
                            <img
                                :src="
                                    '/files/' + invi.id + '/' + item.imageName
                                "
                                alt=""
                            />
                        </div>
                    </li>
                </ul>
            </div>
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
            cont: null,
        };
    },
    methods: {
        // showPics(e) {
        //     this.clickedAlbum = e.images;
        //     // let currEle = e.currentTarget;
        //     // let all = document.getElementsByClassName("album-pics");
        //     // let conts = document.getElementsByClassName("album-cont");
        //     // let mainCont = $("#all-albums");
        //     // all.forEach(function (item) {
        //     //     if (item.classList.contains("active")) {
        //     //         item.classList.remove("active");
        //     //     }
        //     // });
        //     // conts.forEach(function (item) {
        //     //     if (item.classList.contains("active")) {
        //     //         item.classList.remove("active");
        //     //     }
        //     // });
        //     // mainCont.css("display", "block");
        //     // currEle.classList.add("active");
        //     // currEle.nextElementSibling.classList.add("active");
        // },
        // showAlbums(e) {
        //     let all = document.getElementsByClassName("album-pics");
        //     let conts = document.getElementsByClassName("album-cont");
        //     let mainCont = $("#all-albums");
        //     all.forEach(function (item) {
        //         if (item.classList.contains("active")) {
        //             item.classList.remove("active");
        //         }
        //     });
        //     conts.forEach(function (item) {
        //         if (item.classList.contains("active")) {
        //             item.classList.remove("active");
        //         }
        //     });
        //     mainCont.css("display", "grid");
        // },
        setSplider() {
            let _this = this;
            this.$nextTick(function () {
                _this.cont = new Splide(`#guest-gallery-slider`, {
                    gap: 5,
                    rewind: true,
                    pagination: false,
                    cover: true,
                    isNavigation: true,
                    arrows: true,
                    gap: 10,
                    perPage: 3,
                    breakpoints: {
                        768: {
                            perPage: 2,
                        },
                        567: {
                            perPage: 1,
                            padding: { right: "20%" },
                            arrows: false,
                            wheel: true,
                            direction: "ltr",
                            releaseWheel: false,
                        },
                    },
                });
                _this.cont.mount();
            });
        },
    },
    computed: {
        nonAlbumImages() {
            return this.inviImages.filter(image => !image.album_id);
        }
    },
    mounted() {
        // document.onreadystatechange = () => {
        //     if (document.readyState == "complete") {
        //         this.setSplider();
        //     }
        // };
    },
};
</script>

<style scoped>
.gallery-cont {
    background: rgba(255, 255, 255, 0.4);
    backdrop-filter: blur(17px);
    border-radius: 18px;
    padding: 120px 0;
    margin-top: 150px;
}
.gallery-cont > h1 {
    width: max-content;
    background: #ffffff;
    box-shadow: 0px 7px 49px #ffd2b1;
    border-radius: 20px;
    padding: 30px 110px;
    font-family: "Style Script";
    font-style: normal;
    font-weight: 400;
    font-size: 70px;
    line-height: 70px;
    letter-spacing: 0.03em;
    color: #ebaa79;
    margin: auto;
    margin-top: -165px;
}
#guest-gallery-slider {
    margin-top: 50px;
}
#guest-gallery-slider div {
    height: 100%;
}
#guest-gallery-slider img {
    display: block !important;
    border: 2px solid #ffffff;
    border-radius: 20px;
    max-width: 546px;
    max-height: 374px;
    min-width: 250px;
    min-height: 220px;
    object-fit: cover;
    width: 100%;
    height: 100%;
}
/* .guest-invi-gallary-cont {
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
        grid-template-columns: repeat(auto-fill, minmax(182px, 1fr)); 
    }
}
@media screen and (max-width: 910px) {
    .guest-invi-gallary {
        width: 100% !important;
    }
}
*/
@media screen and (max-width: 576px) {
    .gallery-cont > h1 {
        padding: 14px 30px;
        font-weight: 400;
        font-size: 40px;
        line-height: 40px;
    }
}
</style>


