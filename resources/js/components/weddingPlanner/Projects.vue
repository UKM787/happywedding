<template>
    <div>
        <h1 id="total-projects">Projects (20)</h1>
        <div id="planner-search-cont">
            <input type="text" placeholder="Search..." />
            <button>
                <img
                    style="margin-right: 5px"
                    src="/assets/wedding_planner/carbon_add.svg"
                    alt=""
                />
                <span>Create new project</span>
            </button>
            <div>
                <button>
                    <img
                        style="margin-right: 5px"
                        src="/assets/wedding_planner/bi_sort-up.svg"
                        alt=""
                    />
                    <span>Sort by</span>
                    <img
                        style="margin-left: 5px"
                        src="/assets/wedding_planner/ant-design_caret-down-filled.svg"
                        alt=""
                    />
                </button>
            </div>
        </div>

        <div class="main-invi-cont">
            <div
                v-for="(item, index) in invitations"
                :key="index"
                class="single-invi-cont"
            >
                <div class="single-invi-cont-top">
                    <img src="/assets/wedding_planner/Ellipse_77.png" alt="" />
                    <div class="single-invi-details">
                        <div>Antony weds nisha</div>
                        <div>
                            <img
                                src="/assets/wedding_planner/calendarIcon.svg"
                                alt=""
                            />
                            <span>Jan 02</span>
                            <span>-</span>
                            <span>Jan 08</span>
                        </div>
                        <div>
                            <div></div>
                        </div>
                    </div>
                    <div>
                        <i class="fas fa-bell"></i>
                        <span></span>
                    </div>
                </div>
                <div class="single-invi-cont-middle">
                    <div>
                        5 Vendors Finalised. 12 More vendors to be finalised.
                        <a href="">check now</a>
                    </div>
                    <div>
                        <img
                            src="/assets/wedding_planner/Ellipse_84.png"
                            alt=""
                        />
                        <img
                            src="/assets/wedding_planner/Ellipse_84.png"
                            alt=""
                        />
                        <img
                            src="/assets/wedding_planner/Ellipse_84.png"
                            alt=""
                        />
                        <img
                            src="/assets/wedding_planner/Ellipse_84.png"
                            alt=""
                        />
                        <img
                            src="/assets/wedding_planner/Ellipse_84.png"
                            alt=""
                        />
                        <img
                            src="/assets/wedding_planner/Ellipse_84.png"
                            alt=""
                        />
                        <img
                            src="/assets/wedding_planner/Ellipse_84.png"
                            alt=""
                        />
                    </div>
                </div>
                <hr />
                <div
                    class="splide planner-project-splide"
                    :id="'projects-invi-splide' + item.id"
                >
                    <div class="splide__arrows">
                        <button
                            class="splide__arrow splide__arrow--prev"
                            style="
                                border-radius: 5.86667px;
                                width: 25px;
                                height: 25px;
                            "
                        >
                            <i class="fas fa-angle-left"></i>
                        </button>
                        <button
                            class="splide__arrow splide__arrow--next"
                            style="
                                border-radius: 5.86667px;
                                width: 25px;
                                height: 25px;
                            "
                        >
                            <i class="fas fa-angle-right"></i>
                        </button>
                    </div>
                    <div class="splide__track">
                        <ul class="splide__list d-flex">
                            <li class="splide__slide">
                                <div>
                                    <img
                                        src="/assets/wedding_planner/ep_todolist.png"
                                        alt=""
                                    />
                                </div>
                            </li>
                            <li class="splide__slide">
                                <div>
                                    <img
                                        src="/assets/wedding_planner/ep_guestlist.png"
                                        alt=""
                                    />
                                </div>
                            </li>
                            <li class="splide__slide">
                                <div>
                                    <img
                                        src="/assets/wedding_planner/ep_vendors.png"
                                        alt=""
                                    />
                                </div>
                            </li>
                            <li class="splide__slide">
                                <div>
                                    <img
                                        src="/assets/wedding_planner/ep_invi.png"
                                        alt=""
                                    />
                                </div>
                            </li>
                            <li class="splide__slide">
                                <div>
                                    <img
                                        src="/assets/wedding_planner/ep_location.png"
                                        alt=""
                                    />
                                </div>
                            </li>
                            <li class="splide__slide">
                                <div>
                                    <img
                                        src="/assets/wedding_planner/ep_accommodation.png"
                                        alt=""
                                    />
                                </div>
                            </li>
                            <li class="splide__slide">
                                <div>
                                    <img
                                        src="/assets/wedding_planner/ep_accommodation.png"
                                        alt=""
                                    />
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            cont: [],
            invitations: [
                { id: 1, name: "first" },
                { id: 2, name: "second" },
                { id: 3, name: "third" },
                { id: 4, name: "fourth" },
                { id: 5, name: "fifth" },
                { id: 6, name: "sixth" },
                { id: 7, name: "seventh" },
            ],
        };
    },
    methods: {
        showSpliders() {
            let _this = this;
            _this.invitations.forEach(function (item, index) {
                _this.cont[item.id] = new Splide(
                    `#projects-invi-splide${item.id}`,
                    {
                        type: "slide",
                        perPage: 5,
                        perMove: 1,
                        gap: "1em",
                        drag: true,
                        arrows: true,
                        trimSpace: true,
                        pagination: false,
                        isNavigation: true,
                    }
                );
                _this.cont[item.id].mount();
                _this.cont = _this.cont.filter(
                    (value) => Object.keys(value).length !== 0
                );
            });
        },
    },
    mounted() {
        document.onreadystatechange = () => {
            if (document.readyState == "complete") {
                this.showSpliders();
            }
        };
    },
};
</script>

<style scoped>
#total-projects {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 24.1668px;
    line-height: 36px;
    color: #2c2c2c;
}
#planner-search-cont {
    display: flex;
}
#planner-search-cont > input {
    padding: 11px;
    background-color: #ffffff !important;
    border-radius: 5px;
    border-bottom-right-radius: 0px;
    border: none;
    background-image: url("/assets/single-venue-page/Group.svg");
    background-repeat: no-repeat;
    background-position: 1.5% 49%;
    background-size: 20px;
    padding-left: 40px;
    margin-right: 1.5em;
}
#planner-search-cont > input::placeholder {
    font-family: Segoe UI;
    font-style: normal;
    font-weight: normal;
    font-size: 10px;
    line-height: 13px;
    color: rgba(0, 0, 0, 0.3);
}
#planner-search-cont > button {
    background: #c4456f;
    border-radius: 5.54054px;
    padding: 11px 35px;
    padding-left: 25px;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 11.7714px;
    line-height: 18px;
    color: #ffffff;
    border: none;
    outline: none;
    margin-right: 1.5em;
}
#planner-search-cont > div > button {
    background: #ffffff;
    border-radius: 5.54054px;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 11.0309px;
    line-height: 17px;
    color: #616161;
    border: none;
    outline: none;
    padding: 14px 35px;
}
.main-invi-cont {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    margin-top: 2em;
    column-gap: 1em;
    row-gap: 1em;
}
.single-invi-cont {
    background: #ffffff;
    border-radius: 5px;
    padding: 22px;
}
.single-invi-cont-top {
    display: flex;
}
.single-invi-cont-top > img:nth-child(1) {
    width: 61px;
    height: 61px;
    object-fit: cover;
    border-radius: 50%;
    margin-right: 10px;
}
.single-invi-details {
    width: 70%;
}
.single-invi-details > div:nth-child(1) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 600;
    font-size: 13.959px;
    line-height: 21px;
    /* identical to box height */
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;

    color: #000000;
}
.single-invi-details > div:nth-child(2) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 11.4589px;
    line-height: 17px;

    color: #9d9d9d;
}
.single-invi-details > div:nth-child(2) > span {
    vertical-align: text-top;
}
.single-invi-details > div:nth-child(3) {
    background: #e9e7f1;
    border-radius: 10px;
    height: 5px;
    width: 100%;
    margin-top: 10px;
}
.single-invi-details > div:nth-child(3) > div {
    background: #e03a4d;
    border-radius: 10px;
    height: 5px;
    width: 34%;
}
.single-invi-cont-top > div:nth-child(3) {
    display: flex;
    justify-content: flex-end;
    width: 15%;
    align-self: center;
    padding-right: 14px;
    padding-bottom: 10px;
    color: #afafaf;
    position: relative;
}
.single-invi-cont-top > div:nth-child(3) > span {
    background: #eb1b3d;
    display: inline-block;
    width: 5px;
    height: 5px;
    border-radius: 50%;
    border: 1px solid white;
    position: absolute;
}
.single-invi-cont-middle {
    margin: 1em 0;
}
.single-invi-cont-middle > div:nth-child(1) {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 11.4589px;
    line-height: 17px;

    color: #000000;
}
.single-invi-cont-middle > div:nth-child(2) > img {
    border-radius: 50%;
    width: 30px;
    height: 30px;
    object-fit: cover;
    margin-left: -15px;
    border: 1px solid white;
    margin-top: 5px;
}
.single-invi-cont-middle > div:nth-child(2) > img:nth-child(1) {
    margin-left: 0 !important;
}
.planner-project-splide ul > li > div > img {
    width: 38px;
    height: 38px;
}
.planner-project-splide ul > li {
    border: none !important;
}
.splide__track {
    border-left: 3.3em solid white;
    border-right: 3em solid white;
}
.custom-arrows > button {
    border-radius: 5.86667px;
}
</style>
