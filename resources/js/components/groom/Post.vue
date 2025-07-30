<template>
    <div>
        <div class="bride-fav-cont">
            <div
                v-for="(item, index) in brideFavPosts"
                :key="index"
                class="bride-fav-single"
            >
                <a href="">
                    <img
                        :src="'/assets/bride/' + item.img"
                        alt=""
                        style="
                            width: 100%;
                            border-radius: 7.66941px;
                            height: 100%;
                            object-fit: cover;"
                    />
                </a>
                <div class="bride-fav-single-info">
                    <div>#weddingcard #rsh</div>
                    <div class="bride-fav-single-buttons">
                        <div>{{ item.name }}</div>
                        <div>
                            <button>
                                <img src="\assets\bride\vector2.svg" alt="" />
                            </button>
                            <button>
                                <img src="\assets\bride\vector1.svg" alt="" />
                            </button>
                        </div>
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
            brideFavPosts: [
                {
                    id: 1,
                    name: "Infinite memories",
                    img: "fav1.jpg"
                },
                { id: 2, name: "Infinite memories", img: "fav2.jpg" },
                { id: 3, name: "Infinite memories", img: "fav3.jpg" },
                { id: 4, name: "Infinite memories", img: "fav4.jpg" },
                { id: 6, name: "Infinite memories", img: "fav1.jpg" },
                { id: 7, name: "Infinite memories", img: "fav2.jpg" },
                { id: 8, name: "Infinite memories", img: "fav3.jpg" },
                { id: 9, name: "Infinite memories", img: "fav4.jpg" },
                { id: 10, name: "Infinite memories", img: "fav1.jpg" },
                { id: 11, name: "Infinite memories", img: "fav2.jpg" },
                { id: 12, name: "Infinite memories", img: "fav3.jpg" },
                { id: 13, name: "Infinite memories", img: "fav4.jpg" }
            ]
        };
    }
};
</script>

<style>
.bride-fav-cont {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    row-gap: 2em;
    column-gap: 2em;
    justify-content: space-around;
    padding: 1em 3em;
}
.bride-fav-single {
    border-radius: 7.66941px;
    width: 100%;
    position: relative;
    aspect-ratio: 4/3;
}
.bride-fav-single-info {
    background: #ffffff;
    border: 0.173726px solid #000000;
    border-radius: 7.66941px;
    position: absolute;
    width: 100%;
    bottom: 0;
    padding: 10px 15px;
}
.bride-fav-single-info > div:nth-child(1) {
    font-family: Segoe UI;
    font-style: normal;
    font-weight: 300;
    font-size: 9.86745px;
    line-height: 13px;
    color: #a79c9c;
    width: 70%;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.bride-fav-single-buttons {
    display: flex;
    justify-content: space-between;
}
.bride-fav-single-buttons > div:nth-child(1) {
    font-family: Segoe UI;
    font-style: normal;
    font-weight: normal;
    font-size: 13.1566px;
    line-height: 17px;
    color: #000000;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    width: 70%;
}
.bride-fav-single-buttons button {
    outline: 0;
    border: none;
    background-color: inherit;
}
</style>
