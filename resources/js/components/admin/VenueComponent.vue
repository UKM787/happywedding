<template>
  <div class="venue-list" :class="{ 'loading': loading }">
    <h1>Venue List</h1>
    <ul v-for="(venue, id) in venues" :key="id">
      <li>
        {{ venue.nameOfPlace }}{{ venue.nameOfHall }}{{ venue.address }}{{ venue.city }}{{ venue.pincode }}{{ venue.state }}{{ venue.priority }}{{ venue.reachHere }}
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  data() {
    return {
      venues: [],
      loading: true,
    };
  },
  mounted() {
    this.getVenues();
  },

  methods: {
    getVenues() {
      var _this = this;
      axios
        .get("/api/admin/venues")
        .then(function (response) {
          _this.venues = response.data.data;
          _this.loading = false;
        })
        .catch(error => {
          console.log("Get All: " + error);
        });
    },
  },
};
</script>

