<template>
    <div class="single-card-inner">
        <img src="/assets/heart.svg" alt="">
        <img v-if="dummyimage == true" :src="item.image" alt="" />
        <img v-else-if="dummyimage == 'makeup'" :src="'/assets/makeupdummy.png'" alt="" />
        <img v-else :src="'/assets/defaults/categories/images/'+item.imageOne" alt="" />
        <div style="display: flex; flex-direction: column; height: 100%;">
            <p>
                <span>{{ item.name }}</span>
                <span>4.9(29 Reviews)</span>
            </p>
            <p>
                <img
                    src="/assets/venues/map-pin.svg"
                    alt=""
                />
                Kilpauk, Chennai
            </p>
            <p style="margin-top: auto;">Starting From <span>₹60,000</span></p>
        </div>
        <a v-if="single == true" :href="'/directory/vendors/'+maincat?.path+'/'+item.slug">Enquire</a>
        <!-- <a v-else-if="(item.path != '' && item.path != null)" :href="'/directory/vendors/'+item.path">Enquire</a> -->
        <a v-else href="">Enquire</a>
    </div>
</template>
<script>

    export default {
        props: ['item', 'dummyimage', 'maincat', 'single'],
    }
</script>
<style scoped>
.single-card-inner {
    display: flex;
    flex-direction: column;
    max-width: 260px;
    height: 100%;
    justify-content: space-between;
    position: relative;
}
.single-card-inner > img:nth-child(1){
    position: absolute;
    top: 15px;
    right: 15px;
}
.single-card-inner > img:nth-child(2) {
    object-fit: cover;
    box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.25);
    max-height: 161px;
    width: 100%;
    height: 100%;
    border-radius: 3px;
}
.single-card-inner > a {
    text-decoration: none;
    background: #461952;
    padding: 7px 0px 8px 0px;
    color: #FFF;
    font-family: Poppins;
    font-size: 11px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
    text-align: center;
}
.single-card-inner > div > p:nth-child(1) {
    color: #000;
    font-family: Poppins;
    font-size: 15px;
    font-style: normal;
    font-weight: 500;
    line-height: normal;
    margin-top: 15px;
    margin-bottom: 7px;
    display: flex;
    justify-content: space-between;
    align-items: baseline;
}
.single-card-inner > div > p:nth-child(1) > span:nth-child(1){
    text-overflow: ellipsis;
    width: 55%;
}
.single-card-inner > div > p:nth-child(1) > span:nth-child(2){
    color: #303030;
    font-family: Poppins;
    font-size: 11px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
}
.single-card-inner > div > p:nth-child(2) > img {
    margin-right: 10px;
    height: 11px;
}
.single-card-inner > div > p:nth-child(2) {
    color: #31373A;
    font-family: Poppins;
    font-size: 9.838px;
    font-style: normal;
    font-weight: 300;
    line-height: normal;
    margin-bottom: 7px;
    display: flex;
    align-items: flex-start;
}
.single-card-inner > div > p:nth-child(3) {
    color: #000;
    font-family: Poppins;
    font-size: 12px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
    margin-bottom: 7px;
}
.single-card-inner > div > p:nth-child(3) > span {
    font-size: 16px;
    font-weight: 600;
}
</style>