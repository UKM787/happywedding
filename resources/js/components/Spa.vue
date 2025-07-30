<template>
    <div>
        <h1>Vue Router Demo App</h1>
        <p>
            <router-link :to="{ name: 'home' }">Home</router-link> |
            <router-link :to="{ name: 'manager_tools' }"
                >Hello World</router-link
            >
        </p>
        <div class="container">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        console.log(this.$refs);
    },
};
</script>

<style></style>
