<template>
    <div class="venue-search-cont">
        <img src="/assets/venues/Frame540.png" alt="" />
        <div class="venue-search-cont-info">
            <h4>{{ title }}</h4>
            <p>
                {{ description }}
            </p>
            <div class="search-feilds">
                <multiselect
                    style="width: 35%"
                    v-model="selectedCity"
                    placeholder="Select City"
                    :options="cities"
                    :show-labels="false"
                    :allow-empty="false"
                    ref="citySelect"
                    ><span slot="noResult"
                        >No city exists.</span
                    ></multiselect
                >
                <multiselect
                    v-model="selectedVenue"
                    style="width: 35%"
                    :options="categories"
                    placeholder="Venue Type"
                    :show-labels="false"
                    :allow-empty="false"
                    ref="venueSelect"
                    track-by="name"
                    label="name"
                    ><span slot="noResult"
                        >No venue type exists.</span
                    ></multiselect
                >
                <button @click="searchVenues()" type="button">
                    Search
                </button>
            </div>
        </div>
    </div>
</template>
<script>
    import Multiselect from "vue-multiselect";
    export default {
        name: 'searchHeader',
        components: {
            Multiselect,
        },
        props: ['title', 'description', 'cities', 'categories', 'maincat', 'city', 'type'],
        data() {
            return {
                selectedVenue: this.type ?? null,
                selectedCity: this.city ?? null,
            }
        },
        methods: {
            searchVenues() {
            if (this.selectedCity == null) {
                this.$refs.citySelect.activate();
                return;
            }
            if (this.selectedVenue == null) {
                this.$refs.venueSelect.activate();
                return;
            }
            if(this.selectedVenue.path != null && this.selectedVenue.path != ''){
                if(this.selectedVenue.parent_id == null){
                    window.location.href = `/directory/vendors/${this.selectedVenue.path}`;
                }else{
                    if(!this.maincat){
                        const filteredObject = this.categories.filter(object => object.id == this.selectedVenue?.parent_id); 
                        //console.log(filteredObject);
                       window.location.href = `/directory/vendors/${filteredObject[0].path}/filtered?type=${this.selectedVenue.slug}&city=${this.selectedCity}`;
                    }else{
                        window.location.href = `/directory/vendors/${this.maincat.path}/filtered?type=${this.selectedVenue.slug}&city=${this.selectedCity}`;
                    }
                }
            }else{
                window.location.href = `/directory/vendors/venues/filtered?type=${this.selectedVenue.name}&city=${this.selectedCity}`;
            }           
        },
        }
    }
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

<style scoped>
.venue-search-cont {
    position: relative;
    width: 100%;
    min-height: 250px;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}
.venue-search-cont > img {
    position: absolute;
    top: 0;
    left: 0;
    object-fit: cover;
    width: 100%;
    z-index: 99;
    height: 100%;
}
.venue-search-cont-info {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    position: relative;
    z-index: 999;
}
.venue-search-cont-info > h4 {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 400;
    font-size: 20.1456px;
    line-height: 30px;
    color: #ffffff;
}
.venue-search-cont-info > p {
    font-family: "Poppins";
    font-style: normal;
    font-weight: 300;
    font-size: 13.0054px;
    line-height: 20px;
    text-align: center;

    color: #ffffff;
}
.search-feilds {
    display: flex;
    justify-content: space-between;
    width: 100%;
}
.search-feilds > button {
    background: #461952;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 500;
    font-size: 13.0054px;
    line-height: 20px;
    padding: 7px 43px;
    color: #ffffff;
    border: none;
    outline: none;
    height: 44px;
}
@media only screen and (max-width: 576px) {
    .venue-search-cont {
        min-height: 300px;
    }
    .venue-search-cont-info > h4 {
        font-size: 20.1456px;
        line-height: 30px;
    }
    .venue-search-cont-info > p {
        font-size: 12px;
        line-height: 18px;
    }
    .search-feilds > div {
        width: 90% !important;
        margin-bottom: 10px;
    }
    .search-feilds {
        flex-wrap: wrap;
        justify-content: center;
    }
}
</style>