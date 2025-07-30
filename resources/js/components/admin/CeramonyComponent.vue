<template>
  <div class="ceramony-list" :class="{ 'loading': loading }">
    <h1>Ceramony List</h1>
    <ul v-for="(ceramony, id) in ceramonies" :key="id">
      <li>{{ ceramony.name }}{{ ceramony.type }}{{ ceramony.imageOne }}{{ ceramony.parent_id }}</li>
    </ul>
  </div>
</template>

<script>
export default {
  data() {
    return {
      ceramonies: [],
      loading: true,
    };
  },
  mounted() {
    this.getCeramonies();
  },

  methods: {
    getCeramonies() {
      var _this = this;
      axios
        .get("/api/admin/ceramonies")
        .then(function (response) {
          _this.ceramonies = response.data.data;
          _this.loading = false;
        })
        .catch(error => {
          console.log("Get All: " + error);
        });
    },
  },
};
</script>

