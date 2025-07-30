<template>
  <div class="task-list" :class="{ 'loading': loading }">
    <h1>Task Categories</h1>
    <ul v-for="(task, id) in tasks" :key="id">
      <li>{{ task.name }}{{ task.priority }}{{ task.active }}{{ task.parent_id }}{{ task.priority }}{{ task.icon }}</li>
    </ul>
  </div>
</template>

<script>
export default {
  data() {
    return {
      tasks: [],
      loading: true,
    };
  },
  mounted() {
    this.gettasks();
  },

  methods: {
    gettasks() {
      var _this = this;
      axios
        .get("/api/admin/tasks")
        .then(function (response) {
          _this.tasks = response.data.data;
          _this.loading = false;
        })
        .catch(error => {
          console.log("Get All: " + error);
        });
    },
  },
};
</script>

