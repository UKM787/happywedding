<template>
  <div class="vendor-list" :class="{ 'loading': loading }">
    <h1>Vendor Categories</h1>
    <ul v-for="(vendor, id) in vendors" :key="id">
      <li>{{ vendor.name }}{{ vendor.description }}{{ vendor.active }}{{ vendor.priority }}{{ vendor.icon }}</li>
    </ul>
  </div>
</template>

<script>
export default {
  data() {
    return {
      vendors: [],
      loading: true,
    };
  },
  mounted() {
    this.getVendors();
  },

  methods: {
    getVendors() {
      var _this = this;
      axios
        .get("/api/admin/vendors")
        .then(function (response) {
          _this.vendors = response.data.data;
          _this.loading = false;
        })
        .catch(error => {
          console.log("Get All: " + error);
        });
    },
  },
};
</script>

