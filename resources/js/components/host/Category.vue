<template>
    <div class="container bg-white mb-4" :class="{'loading': loading}">
        <h1 class="my-4">Looking for ?</h1>
            <div class="d-flex flex-wrap justify-content-around">
                <a class="btn btn-red m-2" v-for="category in categories" :key="category.id">
                    {{ category.name }}
                </a>
            </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                categories: [],
                loading: true
            }
        },

        mounted() {
            this.loadCategories();
        },

        methods: {
            loadCategories: function () {
                axios.get('api/admin/tasks')
                    .then((response) => {
                        this.categories = response.data.data;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },

            loadProducts: function () {
                axios.get('/api/services')
                    .then((response) => {
                        this.services = response.data.data;
                        this.loading = false;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        }
    }
</script>
