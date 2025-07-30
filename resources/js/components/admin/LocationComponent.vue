<template>
  <div class="location-list" :class="{ 'loading': loading }">
    <h1>Marriage Locations</h1>
    <ul v-for="(location, id) in locations" :key="id">
      <li>{{ location.name }}{{ location.state }}</li>
    </ul>
  </div>
</template>

<script>
export default {
  data() {
    return {
      locations: [],
      loading: true,
    };
  },
  mounted() {
    this.getLocations();
  },

  methods: {
    getLocations() {
      var _this = this;
      axios
        .get("/api/admin/locations")
        .then(function (response) {
          _this.locations = response.data.data;
          _this.loading = false;
        })
        .catch(error => {
          console.log("Get All: " + error);
        });
    },
  },
};
</script>

