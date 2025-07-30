<template>
    <div>
        <div class="review-disp-cont container">
            <div id="venue-slider" class="splide">
                    <div class="splide__track">
                        <ul class="splide__list">
                            <li
                                v-for="(item, index) in reviews"
                                :key="index"
                                style="
                                    max-width: 280px;
                                    width: 100%;
                                    min-width: 200px;
                                    margin-right: 12px;
                                    border: none !important;
                                "
                                class="splide__slide"
                            >
                                <div class="review-single-view">
                                    <div>
                                        <img :src="'/assets/'+item.img" alt="">
                                        <div>
                                            <div class="name">{{item.name}}</div>
                                            <div class="date">{{item.date}}</div>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="custom-rate"
                                            ><i
                                                class="fas fa-star"
                                            ></i
                                        ></span>
                                        <span class="custom-rate"
                                            ><i
                                                class="fas fa-star"
                                            ></i
                                        ></span>
                                        <span class="custom-rate"
                                            ><i
                                                class="fas fa-star"
                                            ></i
                                        ></span>
                                        <span class="custom-rate"
                                            ><i
                                                class="fas fa-star"
                                            ></i
                                        ></span>
                                        <span class="custom-rate"
                                            ><i
                                                class="fas fa-star"
                                            ></i
                                        ></span>
                                    </div>
                                    <p>{{ item.desc }}</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            
        </div>
        <section class="wed-venue-rating container">
            <div class="rating-distribution">
                <div>
                    <div>Rating Distribution</div>
                    <div>
                        5
                        <img
                            src="/assets/single-venue-page/Rating Star.svg"
                            alt=""
                        />
                    </div>
                </div>
                <div>
                    <div class="rating-bar-box">
                        <div>
                            5&nbsp<img
                                src="/assets/single-venue-page/rating-star-small.svg"
                                alt=""
                                style="margin-top: -4px"
                            />
                        </div>
                        <div>
                            <div class="rating-percent"></div>
                        </div>
                        <div>20 ratings</div>
                    </div>
                    <div class="rating-bar-box">
                        <div>
                            4&nbsp<img
                                src="/assets/single-venue-page/rating-star-small.svg"
                                alt=""
                                style="margin-top: -4px"
                            />
                        </div>
                        <div>
                            <div class="rating-percent"></div>
                        </div>
                        <div>16 ratings</div>
                    </div>
                    <div class="rating-bar-box">
                        <div>
                            3&nbsp<img
                                src="/assets/single-venue-page/rating-star-small.svg"
                                alt=""
                                style="margin-top: -4px"
                            />
                        </div>
                        <div>
                            <div class="rating-percent"></div>
                        </div>
                        <div>0 ratings</div>
                    </div>
                    <div class="rating-bar-box">
                        <div>
                            2&nbsp<img
                                src="/assets/single-venue-page/rating-star-small.svg"
                                alt=""
                                style="margin-top: -4px"
                            />
                        </div>
                        <div>
                            <div class="rating-percent"></div>
                        </div>
                        <div>0 ratings</div>
                    </div>
                    <div class="rating-bar-box">
                        <div>
                            1&nbsp<img
                                src="/assets/single-venue-page/rating-star-small.svg"
                                alt=""
                                style="margin-top: -4px"
                            />
                        </div>
                        <div>
                            <div class="rating-percent"></div>
                        </div>
                        <div>0 ratings</div>
                    </div>
                </div>
            </div>
            <div class="rv-cont">
                <div class="head">Rate your experience</div>
                <form @submit.prevent="submitreview($event)">
                    <div style="display: flex; justify-content: space-between;">
                        <div class="form-rating">
                        <span class="custom-rate"
                            ><i
                                @click="toggleRating($event)"
                                class="fas fa-star"
                            ></i
                        ></span>
                        <span class="custom-rate"
                            ><i
                                @click="toggleRating($event)"
                                class="fas fa-star"
                            ></i
                        ></span>
                        <span class="custom-rate"
                            ><i
                                @click="toggleRating($event)"
                                class="fas fa-star"
                            ></i
                        ></span>
                        <span class="custom-rate"
                            ><i
                                @click="toggleRating($event)"
                                class="fas fa-star"
                            ></i
                        ></span>
                        <span class="custom-rate"
                            ><i
                                @click="toggleRating($event)"
                                class="fas fa-star"
                            ></i
                        ></span>
                        </div>
                        <button type="submit">submit</button>
                    </div>
                    <div class="rating-form">
                        <label for="">Write a review</label>
                        <div style="position: relative;">
                            <textarea
                            placeholder="Type here..."
                            maxlength="100"
                            rows="4"
                            required
                            v-model="submitReview.description"
                            @keydown.enter.prevent
                        />
                            <span style="position: absolute; top: 15px; right:5px">1/100</span>
                        </div>
                    </div>
                    <!-- <div v-if="logginFirst">{{ logginFirst }}</div> -->
                </form>
            </div>
        </section>
    </div>
</template>
<script>
export default{
    data() {
        return{
            loginFirst:null,
            submitReview : {
                description: null,
            },
            cont: {},
            ids: [
                "venue-slider",
            ],
            reviews:[
                {
                    name: 'Roderick Decker',
                    date: 'Aug 3rd, 2023',
                    img: 'e6d6d6ddb585223f158e1048ca0c9485.png',
                    desc: 'Duis augue in quis eu elit semper. Egestas dolor placerat porta viverra non vitae amet. Ultricies facilisi ut purus in massa. Velit eu eget ullamcorper tincidunt pellentesque tristique nunc justo pharetra. Sit euismod sed nisl netus sed nisl sociis.',
                },
                {
                    name: 'Roderick Decker',
                    date: 'Aug 3rd, 2023',
                    img: 'e6d6d6ddb585223f158e1048ca0c9485.png',
                    desc: 'Duis augue in ue tristique nunc justo pharetra. Sit euismod sed nisl netus sed nisl sociis.',
                },
            ],
        }
    },
    methods: {
        submitreview(e) {
            return;
            var _this = this;
            if (this.logged == "") {
                this.message = "Log in  as host First";
                setTimeout(function () {
                    _this.message = null;
                }, 3000);
                return;
            }
            let ownerId = JSON.parse(_this.owner).id;
            this.logginFirst = null;
            let user = JSON.parse(this.logged);

            axios
                .post(`/api/vendor/review`, [
                    _this.submitReview,
                    _this.vendorCategory.id,
                    _this.venueDetails.id,
                    ownerId,
                    "Venue",
                    user,
                ])
                .then(function (response) {
                    //_this.getReviews();
                    _this.reviews.unshift(response.data);
                    _this.submitReview.title = null;
                    _this.submitReview.description = null;
                    _this.submitReview.keywords = null;
                    _this.message = "Review Submitted";
                    setTimeout(function () {
                        _this.message = null;
                    }, 3000);
                    const customRate =
                        document.querySelectorAll(".custom-rate > i");
                    customRate.forEach(function (item) {
                        console.log(item);
                        if (item.classList.contains("far")) {
                            item.classList.remove("far");
                            item.classList.add("fas");
                        }
                    });
                    $("");
                    _this.cont.destroy();

                    var element = _this.$refs["reviewCont"];
                    setTimeout(function () {
                        element.scrollIntoView(true);
                        _this.cont.mount();
                    }, 100);
                })
                .catch((error) => {
                    console.log(error.response.data.errors);
                });
        },
        toggleRating(e) {
            const customRate = document.querySelectorAll(".wed-venue-rating .custom-rate > i");
            //console.log(indexOf(item));
            let stars = e.currentTarget;
            var clicked = Array.from(customRate).indexOf(stars);
            // console.log(clicked)
            if (stars.classList.contains("fas")) {
                for (let i = clicked + 1; i <= 4; i++) {
                    customRate.item(i).classList.remove("fas");
                    customRate.item(i).classList.add("far");
                }
            } else {
                for (let j = 0; j <= clicked; j++) {
                    customRate.item(j).classList.remove("far");
                    customRate.item(j).classList.add("fas");
                }
            }
            this.submitReview.rating = clicked + 1;
            // console.log(rate.item(clicked));
        },
        setSplider() {
            let _this = this;
            this.$nextTick(function () {
                this.ids.forEach(function (item, index) {
                    _this.cont[item] = new Splide(`#${item}`, {
                        gap: 5,
                        rewind: true,
                        pagination: false,
                        cover: true,
                        isNavigation: true,
                        arrows: true,
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
    }
}

</script>
<style scoped>
.wed-venue-rating {
    margin: auto;
    display: grid;
    grid-template-columns: minmax(300px, 500px) minmax(350px, 700px);
    grid-column-gap: 7em;
    justify-content: space-between;
    margin-top: 30px;
}

.rating-distribution > div {
    display: flex;
    justify-content: space-between;
}

.rating-distribution > div:nth-child(1) > div:nth-child(1) {
    color: #000;
font-family: Poppins;
font-size: 18px;
font-style: normal;
font-weight: 600;
line-height: normal;
}
.rating-distribution > div:nth-child(1) > div:nth-child(2) {
    background: #2fa706;
    border-radius: 2.10938px;
    color: #EBEBEB;
font-family: Roboto;
font-size: 18.683px;
font-style: normal;
font-weight: 500;
line-height: normal;
    padding: 5px 7px;
}

.rating-distribution > div:nth-child(2) {
    margin-top: 1.5em;
    display: flex;
    flex-direction: column;
}
.rating-bar-box {
    display: flex;
    margin-bottom: 20px;
}
.rating-bar-box > div:nth-child(1) {
    font-family: Roboto;
    font-style: normal;
    font-weight: 500;
    font-size: 18.683px;
    line-height: 22px;
    color: #868686;
    align-self: center;
    width: 2em;
}

.rating-bar-box > div:nth-child(2) {
    border-radius: 100px;
    background: linear-gradient(0deg, #EBEBEB 0%, #EBEBEB 100%), linear-gradient(0deg, #EBEBEB 0%, #EBEBEB 100%), #EBEBEB;
    margin: auto 1em;
    height: 13px;
    width: 75%;
}
.rating-bar-box > div:nth-child(3) {
    font-family: Roboto;
    font-style: normal;
    font-weight: 500;
    font-size: 11.412px;
    line-height: 13px;
    color: #868686;
    align-self: center;
    width: 5em;
}
.rating-percent {
    width: 70%;
    background-color: #2fa706;
    border-radius: 100px;
    height: 100%;
}
.form-rating {
    position: relative;
}
.rate {
    display: none;
}
.custom-rate {
    color: #fed21e;
    font-size: 30px;
}
.rating-form {
    display: flex;
    flex-direction: column;
    position: relative;
}
.rating-form label {
    color: #000;
font-family: Roboto;
font-size: 16px;
font-style: normal;
font-weight: 500;
line-height: normal;
    padding: 0.7em 0;
}
.rating-form textarea {
    outline: none;
    border-radius: 6px;
    border: 1.5px solid #CBCBCB;
    padding: 15px;
    padding-right: 4em;
    width: 100%;
    background-color: #ffffff !important;
}
.rating-form textarea::placeholder {
    font-family: Roboto;
    font-style: normal;
    font-weight: 500;
    font-size: 12.4666px;
    line-height: 15px;
    color: #b5b5b5;

}
.rating-form > span {
    position: absolute;
    bottom: 0;
    right: 0;
    padding: 0 10px 5px 0;
    font-family: Roboto;
    font-style: normal;
    font-weight: 500;
    font-size: 12.4666px;
    line-height: 15px;
    color: #b5b5b5;
}

.wed-venue-rating form  button {
    color: #FFF;
    text-align: center;
    font-family: Inter;
    font-size: 14px;
    font-style: normal;
    font-weight: 500;
    line-height: normal;
    border-radius: 5px;
    border: 1px solid #C4456F;
    background: #C4456F;
    padding: 15px;
}
.head{
    color: #000;
    font-family: Poppins;
    font-size: 18px;
    font-style: normal;
    font-weight: 600;
    line-height: normal;
}
.review-single-view {
    border-radius: 7.096px;
    border: 4.435px solid #E7E7E7;
    background: #FFF;
    max-width: 350px;
    min-width: 280px;
    padding:23px;
    height: 100%;
}
.review-single-view > div:nth-child(1){
    display: flex;
}
.review-single-view img {
    border-radius: 58.545px;
    width: 58.545px;
    height: 58.545px;
    margin-right: 15px;
}
.review-single-view .name{
    color: #000;
    text-align: center;
    font-family: Inter;
    font-size: 15.967px;
    font-style: normal;
    font-weight: 600;
    line-height: normal;
    text-transform: capitalize;
    margin-bottom: 10px;
}
.review-single-view .date{
    color: #878787;
    font-family: Inter;
    font-size: 12.419px;
    font-style: normal;
    font-weight: 500;
    line-height: normal;
    text-transform: capitalize;
}
.review-single-view p{
    color: #000;
    font-family: Inter;
    font-size: 14.193px;
    font-style: normal;
    font-weight: 400;
    line-height: 133.023%; /* 18.88px */
    text-transform: capitalize;
}

@media screen and (max-width: 840px) {
    .wed-venue-rating{
        flex-wrap: wrap;
        display:flex;
    }
    .rating-distribution{
        width: 100%;
    }
    .rv-cont {
        width: 100%;
    }
}

</style>