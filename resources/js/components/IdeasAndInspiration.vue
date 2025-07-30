<template>
    <div class="container" style="margin-bottom: 130px">
        <!-- {{ categories, articles }} -->
        <div v-show="currentIdea != null">
            <div class="selected-invi-cont">
                <div class="selected-invi-img-cont">
                    <div>
                        <div id="main-slider" class="splide main-splide">
                            <div class="splide__track">
                                <ul class="splide__list">
                                    <li
                                        v-for="item in currentIdea?.imageGallery"
                                        :key="item"
                                        class="splide__slide"
                                    >
                                        <img
                                            :src="
                                                '/assets/defaults/articles/images/' +
                                                item
                                            "
                                            alt="idea Gallery"
                                        />
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div id="thumbnail-slider" class="splide">
                            <div class="splide__track">
                                <ul class="splide__list">
                                    <li
                                        v-for="item in currentIdea?.imageGallery"
                                        :key="item"
                                        class="splide__slide"
                                    >
                                        <img
                                            :src="
                                                '/assets/defaults/articles/images/' +
                                                item
                                            "
                                            alt="idea Gallery"
                                        />
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <button @click="currentIdea = null">
                        <img src="/assets/ideas/Group1702.svg" alt="" />
                    </button>
                </div>
                <div class="selected-invi-info-cont">
                    <div class="selected-invi-vendor-name">
                        <img
                            :src="
                                '/assets/defaults/articles/images/' +
                                currentIdea?.imageOne
                            "
                            alt=""
                        />
                        <span>
                            <span>{{ currentIdea?.title }} </span>
                            <span>{{ currentIdea?.body }}</span>
                        </span>
                    </div>
                    <h4>Details</h4>
                    <div class="idea-single-details">
                        <img src="/assets/ideas/6.svg" alt="" />
                        <span>Category : Bridal henna</span>
                    </div>
                    <div class="idea-single-details">
                        <img src="/assets/ideas/7.svg" alt="" />
                        <span>Uploaded : Feb 16, 2022</span>
                    </div>
                    <div class="idea-single-tags-cont">
                        <div
                            v-for="(ele, index) in currentIdea?.tags"
                            :key="index"
                        >
                            {{ ele.name }}
                        </div>
                    </div>
                    <div class="idea-insp-like-single-cont">
                        <span class="idea-like-inner">
                            <img src="/assets/ideas/heart.svg" alt="" />
                            <span>{{ currentIdea?.likes }} Likes</span>
                        </span>
                        <span class="idea-share-inner">
                            <img src="/assets/ideas/share.svg" alt="" />
                            <img src="/assets/ideas/bookmark.svg" alt="" />
                        </span>
                    </div>
                </div>
            </div>
            <div class="similar-idea-cont">
                <!-- <h1>Similar Ideas & Inspiration</h1> -->
                <div class="ideas-insp-content-cont">
                    <!-- <div
                        v-for="(item, index) in similarIdeas"
                        :key="index"
                        class="ideas-insp-content-single"
                        @mouseover="showLike($event, true)"
                        @mouseleave="showLike($event, false)"
                        @click="currentIdea = item"
                    >
                        <div class="ideas-insp-single-img-cont">
                            <img :src="'/assets/' + item.mainImg" alt="" />
                            <img
                                src="/assets/ideas/clarity_image-gallery-solid.svg"
                                alt=""
                            />
                            <div class="idea-insp-like-cont">
                                <span class="idea-like-inner">
                                    <img src="/assets/ideas/heart.svg" alt="" />
                                    <span>{{ item.likes }} Likes</span>
                                </span>
                                <span class="idea-share-inner">
                                    <img src="/assets/ideas/share.svg" alt="" />
                                    <img
                                        src="/assets/ideas/bookmark.svg"
                                        alt=""
                                    />
                                </span>
                            </div>
                        </div>
                        <div class="ideas-insp-single-content">
                            <div>
                                <img :src="'/assets/' + item.profile" alt="" />
                                <span>{{ item.name }}</span>
                                <span>{{ item.time }}</span>
                            </div>
                            <div>{{ item.time }}</div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
        <div v-show="currentIdea == null">
            <div class="idea-navigation">Home > All Photos</div>
            <div class="ideas-all-cont">
                <input
                    class="idea-search-input"
                    type="text"
                    placeholder="Search..."
                />
                <div
                    id="cat-btns-slider"
                    class="splide"
                    style="overflow: hidden"
                >
                    <div class="splide__track">
                        <ul class="splide__list idea-all-btns">
                            <li
                                @click="filterIdeas(item.id, 'main')"
                                v-for="(item, index) in maincats"
                                :key="index"
                                style="border: none !important"
                                class="splide__slide"
                            >
                                <div :class="{ active: index === 0 }">
                                    {{ item.name }}
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- <div class="idea-all-btns">
                    <div
                        :class="{ active: index === 0 }"
                        v-for="(item, index) in categories"
                        :key="index"
                    >
                        {{ item.name }}
                    </div>
                </div> -->
            </div>
            <div class="ideas-all-pic-cont">
                <div
                    id="catImgs-slider"
                    class="splide"
                    style="overflow: hidden"
                >
                    <div class="splide__track">
                        <ul class="splide__list">
                            <li
                                @click="filterIdeas(item.id, 'filter')"
                                v-for="(item, index) in categories"
                                :key="index"
                                style="border: none !important"
                                class="splide__slide ideas-pic-btn-single"
                            >
                                <div
                                    :class="{ active: index === 0 }"
                                    class="pic-btn-single-img"
                                >
                                    <img
                                        :src="
                                            '/assets/defaults/categories/images/' +
                                            item.imageOne
                                        "
                                        alt=""
                                    />
                                </div>
                                <div>{{ item.name }}</div>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- <div
                    v-for="(item, index) in categories"
                    :key="index"
                    class="ideas-pic-btn-single"
                >
                    <div
                        :class="{ active: index === 0 }"
                        class="pic-btn-single-img"
                    >
                        <img
                            :src="
                                '/assets/defaults/vendors/images/' +
                                item.imageOne
                            "
                            alt=""
                        />
                    </div>
                    <div>{{ item.name }}</div>
                </div> -->
            </div>
            <div
                @click="filterIdeas(null, 'clear')"
                v-if="filterClicked"
                class="filter-clear"
            >
                All
            </div>
            <div v-if="allIdeas.length > 0" class="ideas-insp-content-cont">
                <div
                    v-for="(item, index) in allIdeas"
                    :key="index"
                    class="ideas-insp-content-single"
                    @mouseover="showLike($event, true)"
                    @mouseleave="showLike($event, false)"
                    @click="
                        currentIdea = item;
                        setSplider();
                    "
                >
                    <div class="ideas-insp-single-img-cont">
                        <img
                            :src="
                                '/assets/defaults/articles/images/' +
                                item.imageOne
                            "
                            alt=""
                        />
                        <img
                            src="/assets/ideas/clarity_image-gallery-solid.svg"
                            alt=""
                        />
                        <div class="idea-insp-like-cont">
                            <span class="idea-like-inner">
                                <img src="/assets/ideas/heart.svg" alt="" />
                                <span>{{ item.likes }} Likes</span>
                            </span>
                            <span class="idea-share-inner">
                                <img src="/assets/ideas/share.svg" alt="" />
                                <img src="/assets/ideas/bookmark.svg" alt="" />
                            </span>
                        </div>
                    </div>
                    <div class="ideas-insp-single-content">
                        <!-- <div>
                            <img :src="'/assets/articles' + item.profile" alt="" />
                            <span>{{ item.name }}</span>
                            <span>{{ item.time }}</span>
                        </div> -->
                        <div>{{ item.time }}</div>
                    </div>
                </div>
            </div>
            <div v-else class="idea-navigation">
                No Ideas exist for selected category
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["categories", "articles", "maincats"],
    data() {
        return {
            // showLike: false,
            currentIdea: null,
            allIdeas: this.articles,
            filterClicked: false,
            splider: {},
            mainSplider: {},
            cont: {},
            ids: ["cat-btns-slider", "catImgs-slider"],
        };
    },
    methods: {
        filterIdeas(id, type) {
            if (type == "filter") {
                this.filterClicked = true;
                this.allIdeas = this.articles.filter(
                    (obj) => obj.category_id == id
                );
            }
            if (type == "main") {
                this.filterClicked = true;
                let subCats = [];
                subCats = this.categories.filter((obj) => obj.parent_id == id);
                this.allIdeas = this.articles.filter((obj) => {
                    let matchFound = false;
                    for (let i = 0; i < subCats.length; i++) {
                        if (obj.category_id == subCats[i].id) {
                            matchFound = true;
                            break;
                        }
                    }
                    return matchFound;
                });
            }
            if (type == "clear") {
                this.filterClicked = false;
                this.allIdeas = this.articles;
            }
        },
        showLike(e, bool) {
            if (bool == true) {
                e.currentTarget.classList.add("show");
            }
            if (bool == false) {
                e.currentTarget.classList.remove("show");
            }
        },
        setSplider() {
            let _this = this;
            this.$nextTick(function () {
                _this.mainSplider = new Splide(`#main-slider`, {
                    type: "fade",
                    rewind: true,
                    pagination: false,
                    arrows: false,
                });
                _this.splider = new Splide(`#thumbnail-slider`, {
                    fixedWidth: 100,
                    fixedHeight: 60,
                    gap: 5,
                    rewind: true,
                    pagination: false,
                    cover: true,
                    isNavigation: true,
                    breakpoints: {
                        600: {
                            fixedWidth: 60,
                            fixedHeight: 44,
                        },
                    },
                });
                _this.mainSplider.sync(_this.splider);
                _this.mainSplider.mount();
                _this.splider.mount();
            });
        },
        setSpliderSingle() {
            let _this = this;
            this.$nextTick(function () {
                this.ids.forEach(function (item, index) {
                    console.log($(`#${item}`));
                    _this.cont[item] = new Splide(`#${item}`, {
                        gap: 5,
                        rewind: true,
                        pagination: false,
                        cover: true,
                        //isNavigation: true,
                        arrows: true,
                        autoWidth: true,
                        breakpoints: {
                            567: {
                                arrows: false,
                                wheel: true,
                                direction: "ltr",
                                releaseWheel: false,
                            },
                        },
                    });
                    _this.cont[item].mount();
                });
            });
        },
    },
    mounted() {
        this.$nextTick(function () {
            document.onreadystatechange = () => {
                if (document.readyState == "complete") {
                    this.setSpliderSingle();
                }
            };
        });
    },
};
</script>

<style scoped>
.idea-navigation {
    font-family: "Segoe UI";
    font-style: normal;
    font-weight: 400;
    font-size: 13.6563px;
    line-height: 18px;
    color: #929090;
}
.idea-search-input {
    background-color: #ffffff !important;
    border: 0.5px solid #dedede;
    border-radius: 7px;
    padding-left: 30px;
    background-image: url("/assets/ideas/search-idea.svg");
    background-repeat: no-repeat;
    background-position: 6px 9px;
    height: 36px;
    margin-right: 15px;
    margin-top: 5px;
}
.ideas-all-cont {
    display: flex;
    margin-top: 15px;
}
.idea-all-btns {
    display: flex;
    width: 100%;
}
.idea-all-btns > li > div {
    background: #ffffff;
    border: 0.5px solid #afafaf;
    border-radius: 7px;
    padding: 10px 15px;
    margin: 5px;
    white-space: nowrap;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 9.63911px;
    line-height: 14px;
    color: #afafaf;
}
.filter-clear {
    color: #ffffff;
    background: #c4456f;
    border: 0.5px solid #ffffff;
    border-radius: 7px;
    padding: 10px 15px;
    margin: 5px;
    white-space: nowrap;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 9.63911px;
    line-height: 14px;
    width: max-content;
}
.idea-all-btns .active {
    color: #ffffff;
    background: #c4456f;
    border: 0.5px solid #ffffff;
    border-radius: 7px;
}
.ideas-all-pic-cont {
    display: flex;
    width: 100%;
    overflow-x: auto;
    scrollbar-width: thin;
    padding-bottom: 15px;
    margin: 15px 0;
}
.ideas-pic-btn-single {
    padding: 10px;
    min-width: 167px;
    background: #ffffff;
    border: 1.5px solid #ededf0;
    border-radius: 5px;
    margin: 0 5px;
}
.pic-btn-single-img {
    padding-top: 75%;
    max-width: 147px;
    position: relative;
    border-radius: 5px;
}
.pic-btn-single-img > img {
    position: absolute;
    width: 100%;
    top: 0;
    height: 100%;
    border-radius: 5px;
    object-fit: cover;
}
.ideas-pic-btn-single > div:nth-child(2) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 10.3071px;
    line-height: 15px;
    text-align: center;
    padding-top: 10px;
    color: #000000;
    max-width: 147px;
}
.ideas-pic-btn-single > div:nth-child(2).active {
    color: #c4456f;
}
.ideas-insp-content-cont {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(210px, 1fr));
    grid-template-rows: max-content;
    grid-column-gap: 10px;
    grid-row-gap: 20px;
    align-items: flex-start;
}
.ideas-insp-single-img-cont {
    position: relative;
    padding-top: 150%;
}
.ideas-insp-single-img-cont > img:nth-child(1) {
    position: absolute;
    width: 100%;
    top: 0;
    height: 100%;
    object-fit: cover;
}
.ideas-insp-single-img-cont > img:nth-child(2) {
    position: absolute;
    top: 15px;
    right: 15px;
}
.ideas-insp-single-content {
    background: #ffffff;
    padding: 16px;
}
.ideas-insp-single-content > div:nth-child(1) {
    display: flex;
    align-items: center;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 6.26072px;
    line-height: 9px;
    /* identical to box height */

    color: #c4c4c4;
}
.ideas-insp-single-content > div:nth-child(2) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 12px;
    line-height: 18px;
    margin-top: 7px;
    color: #000000;
}
.ideas-insp-single-content > div:nth-child(1) > img {
    margin-right: 7px;
}
.ideas-insp-single-content > div:nth-child(1) > span:nth-child(1) {
    margin-right: 10px;
}
.idea-insp-like-cont {
    padding: 15px;
    background: #ffffff;
    justify-content: space-between;
    align-items: center;
    bottom: 0;
    width: 100%;
    position: absolute;
    z-index: 9999999;
    display: none;
}
.show .idea-insp-like-cont {
    display: flex;
}
.idea-insp-like-cont > span {
    display: flex;
    align-items: center;
}
.idea-like-inner {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 300;
    font-size: 11.29px;
    line-height: 17px;
    /* identical to box height */

    color: #000000;
}
.idea-like-inner > img,
.idea-share-inner > img {
    margin: 0 5px;
}
/* scroobar css */
.idea-all-btns::-webkit-scrollbar,
.ideas-all-pic-cont::-webkit-scrollbar {
    /* background-color: #fff;
    height: 5px;
    position: absolute;
    bottom: 0; */
    display: none;
}
.idea-all-btns::-webkit-scrollbar-track.active,
.ideas-all-pic-cont::-webkit-scrollbar-track.active {
    background-color: #ebebf5;
}
.idea-all-btns::-webkit-scrollbar-track:hover,
.ideas-all-pic-cont::-webkit-scrollbar-track:hover {
    background-color: #f4f4f4;
}
.idea-all-btns::-webkit-scrollbar-thumb,
.ideas-all-pic-cont::-webkit-scrollbar-thumb {
    background-color: #babac0;
    border-radius: 16px;
    border: 1px solid #fff;
}
.selected-invi-cont {
    display: flex;
    /* height: 100%;
    min-height: 70vh;
    max-height: 90vh; */
}
.selected-invi-img-cont {
    width: 55%;
    position: relative;
    padding-top: 45%;
    border-radius: 0px 0px 0px 12.718px;
}
.selected-invi-img-cont > button {
    position: absolute;
    top: 20px;
    left: 20px;
    background: rgba(255, 255, 255, 0.2);
    box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
    backdrop-filter: blur(7.09677px);
    display: flex;
    justify-content: center;
    align-items: center;
    width: 44px;
    height: 44px;
    border-radius: 5px;
    border: none;
    outline: none;
}
.selected-invi-img-cont > div {
    position: absolute;
    top: 0;
    left: 0;
    object-fit: cover;
    width: 100%;
    height: 100%;
    border-radius: 0px 0px 0px 12.718px;
}
.selected-invi-info-cont {
    padding: 20px 20px 0 20px;
    display: flex;
    flex-direction: column;
    width: 45%;
}
.selected-invi-vendor-name {
    display: flex;
}
.selected-invi-vendor-name > img {
    width: 39px;
    height: 39px;
    border-radius: 50%;
}
.selected-invi-vendor-name > span > span:nth-child(1) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 16px;
    line-height: 24px;
    color: #000000;
    display: block;
    width: 100%;
}
.selected-invi-vendor-name > span > span:nth-child(2) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 300;
    font-size: 16px;
    line-height: 24px;
    color: #000000;
    display: block;
    width: 100%;
}
.selected-invi-info-cont > h4 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 14.0782px;
    line-height: 21px;
    color: #000000;
    margin: 20px 0;
}
.idea-single-details {
    display: flex;
}
.idea-single-details {
    margin-bottom: 12px;
}
.idea-single-details > img {
    margin-right: 7px;
}
.idea-single-details > span {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 300;
    font-size: 12.836px;
    line-height: 19px;
    color: #000000;
}
.idea-single-tags-cont {
    display: flex;
    flex-wrap: wrap;
    margin: 20px 0;
}
.idea-single-tags-cont > div {
    background: #ffffff;
    border: 0.573411px solid #afafaf;
    border-radius: 8.02776px;
    padding: 12px 17px;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 11.0543px;
    line-height: 17px;
    color: #afafaf;
    margin-right: 12px;
    margin-bottom: 10px;
}
.idea-insp-like-single-cont {
    background: #ffffff;
    width: 100%;
    display: flex;
    justify-content: space-between;
    border-top: 0.5px solid #cdcdcd;
    border-bottom: 0.5px solid #cdcdcd;
    padding: 15px 20px;
    margin-top: auto;
}
.similar-idea-cont > h1 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 15px;
    line-height: 22px;
    margin: 20px;
    color: #000000;
}
.main-splide {
    width: 100%;
    height: 100%;
}
.main-splide > .splide__track {
    width: 100%;
    height: 100%;
}
.main-splide img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 5px;
}
.main-splide {
    margin-bottom: 10px;
}
@media screen and (max-width: 768px) {
    .selected-invi-cont {
        flex-wrap: wrap;
    }
    .selected-invi-cont > div {
        width: 100%;
    }
}
</style>
